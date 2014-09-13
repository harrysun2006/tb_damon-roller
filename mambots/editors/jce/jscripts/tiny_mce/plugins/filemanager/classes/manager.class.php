<?php
/**
 * ImageManager Class.
 * @author $Original Author: Wei Zhuo $
 * @author $Author: Ryan Demmer $
 * @version $Id: common.class.php 27 2005-09-14 17:51:00 Ryan Demmer $
 */
class FileManager
{
        //Configuration array.
        var $base_dir;
        var $base_url;

        /**
         * Constructor. Create a new Manager instance.
         * @param array $config configuration array, see config.inc.php
         * @param array $lang language array, see langs/en.php;
         * @param string $$mosConfig_live_site Joomla/Mambo configuration variable
         * @param string $$mosConfig_absolute_path Joomla/Mambo configuration variable
         */
        function FileManager( $base_dir, $base_url )
        {
                $this->base_dir = $base_dir;
                $this->base_url = $base_url;
        }
        /**
         * Get the base directory.
         * @return string base dir, see config.inc.php
         */
        function getBaseDir()
        {
                global $mosConfig_absolute_path;
				Return JPath::makePath( $mosConfig_absolute_path, $this->base_dir );
        }
        /**
         * Get the base URL.
         * @return string base url, see config.inc.php
         */
        function getBaseURL()
        {
                global $mosConfig_live_site;
				Return JPath::makePath( $mosConfig_live_site, $this->base_url );
        }
        /**
         * Get a list of dirs in the base dir
         * @return array $dirs
        */
        function getDirs()
        {
            $list = JFolder::listFolderTree( $this->getBaseDir(), '.' );
            
            $dirs = array();
            
            if( $list ){			
				foreach( $list as $dir )
	            {
	                $dir['relname'] = str_replace( "\\", "/", $dir['relname']);
	                $dirs[] = str_replace( $this->base_dir, '', '/'.$dir['relname'] );
	            }
	        }
	        return $dirs;
        }
        function getFiles( $relative, $filter )
        {
            $path = JPath::makePath( $this->getBaseDir(), $relative );
            $url = JPath::makePath( $this->getBaseUrl(), $relative );
            $relative_url = JPath::makePath( $this->base_url, $relative );
            $list = JFolder::files( $path, $filter );
            if( !empty( $list ) ){
                for ($i = 0; $i < count( $list ); $i++) {
                    $file = $list[$i];
                    $fullpath = JPath::makePath( $path, $file );
                    $stat = stat( $fullpath );
                    $files[] = array(
                        'name' => $file,
                        'relative' => JPath::makePath( $relative, $file ),
                        'ext' => JFile::getExt( $file ),
                        'fullurl' => JPath::makePath( $url, $file),
                        'relative_url' => JPath::makePath( $relative_url, $file ),
                        'short_name' => JFile::stripExt( $file ),
                        'date' => JCEUtils::formatDate($stat['mtime']),
                        'size' => JCEUtils::formatSize($stat['size'])
                    );
                }
                return $files;
            }else{
                return $list;
            }
        }
        function getFolders( $relative )
        {
            $path = JPath::makePath( $this->getBaseDir(), $relative );
            $url = JPath::makePath( $this->getBaseUrl(), $relative );
            $list = JFolder::folders( $path );
            if( !empty( $list ) ){
                for ($i = 0; $i < count( $list ); $i++) {
                    $folder = $list[$i];
                    $fullpath = JPath::makePath( $path, $folder );
                    $stat = stat( $fullpath );
                    $folders[] = array(
                        'name' => $folder,
                        'relative' => JPath::makePath( $relative, $folder ),
                        'date' => JCEUtils::formatDate($stat['mtime'])
                    );
                }
                return $folders;
            }else{
                return $list;
            }
        }
        function doUpload( $dir, $file, $ext, $max_size, $overwrite, $unique )
        {
            global $cmnlang;
			$error = false;

            $format = substr( $file['name'], -3 );
            $allowable = explode( ',', $ext );
            $size = $file['size'];

            $noMatch = 0;
		    foreach( $allowable as $ext ) {
                if ( strcasecmp( $format, $ext ) == 0 ) $noMatch = 1;
            }
            if( $size > $max_size )
            {
                $error = $cmnlang['upload_size_err'];
            }elseif( !$noMatch ){
                $error = $cmnlang['upload_ext_err'];
            }else{
                $path = JPath::makePath( $this->getBaseDir(), $dir );
                $file_path = JPath::makePath( $path, JFile::makeSafe( $file['name'] ) );
                $result = JFile::upload( $file['tmp_name'], $file_path, $overwrite, $unique );
                
                if( !JFile::exists( $result ) ){
                    $error = $result;
                }
            }
            return $error;
        }
        /**
         * Delete the relative file(s), and any thumbnails.
         * @param $files the relative path to the file name or comma seperated list of multiple paths.
         * @return string $error on failure.
         */
        function deleteFiles( $files )
        {
            global $cmnlang;
			$error = false;
            $files = explode( ",", $files );
            foreach( $files as $file ){
                $fullpath = JPath::makePath( $this->getBaseDir(), $file );

                if( JFile::exists( $fullpath ) ){
                    if( @!JFile::delete( $fullpath ) ){
                        $error = $cmnlang['del_file_err'];
                    }
                }
            }
        }
        /**
	     * Delete a folder
         * @param string $relative The relative path of the folder to delete
	     * @return string $error on failure
	     */
        function deleteFolder( $relative )
        {
            global $cmnlang;
			$error = false;
            $folder = rawurldecode( $relative );
            $folder = JPath::makePath( $this->getBaseDir(), $folder );
            if( JFile::countFiles( $folder, '^[(index.html)]' ) != 0 || JFolder::countDirs( $folder ) != 0 ){
                $error =  $cmnlang['not_empty_err'];
            }else{
                if( @!JFolder::delete( $folder ) ){
                    $error = $cmnlang['del_dir_err'];
                }
            }
            return $error;
        }
        /*
        * Rename a file.
        * @param string $src The relative path of the source file
        * @param string $dest The name of the new file
        * @return string $error
        */
        function renameFile( $src, $dest )
        {
            global $cmnlang, $manager;
            $error = false;

            $src = JPath::makePath( $this->getBaseDir(), $src );

            $dir = dirname( $src );
            $ext = JFile::getExt( $src );

            $dest = JPath::makePath( $dir, $dest.'.'.$ext );
            $error = JFile::rename( $src, $dest );
            
            return $error;
        }
        /*
        * Rename a file.
        * @param string $src The relative path of the source file
        * @param string $dest The name of the new file
        * @return string $error
        */
        function renameDir( $src, $dest )
        {
            global $cmnlang, $manager;
            $error = false;

            $src = JPath::makePath( $this->getBaseDir(), $src );

            $dir = dirname( $src );

            $dest = JPath::makePath( $dir, $dest );
            $error = JFolder::rename( $src, $dest );

            return $error;
        }
        /*
        * Copy a file.
        * @param string $files The relative file or comma seperated list of files
        * @param string $dest The relative path of the destination dir
        * @return string $error on failure
        */
        function copy( $files, $dest_dir )
        {
            global $cmnlang;
			$error = false;
			
            $files = explode( ",", $files );
            foreach( $files as $file ){
                $filepath = JPath::makePath( $dest_dir, basename( $file ) );
                $src = JPath::makePath( $this->getBaseDir(), $file );
                $dest = JPath::makePath( $this->getBaseDir(), $filepath );
                $error = JFile::copy( $src, $dest );
            }
            return $error;
        }
        /*
        * Copy a file.
        * @param string $files The relative file or comma seperated list of files
        * @param string $dest The relative path of the destination dir
        * @return string $error on failure
        */
        function move( $files, $dest_dir )
        {
            global $cmnlang;
			$error = false;

            $files = explode( ",", $files );
            foreach( $files as $file ){
                $filepath = JPath::makePath( $dest_dir, basename( $file ) );
                $src = JPath::makePath( $this->getBaseDir(), $file );
                $dest = JPath::makePath( $this->getBaseDir(), $filepath );
                $error = JFile::rename( $src, $dest );
            }
            return $error;
        }
}
?>
