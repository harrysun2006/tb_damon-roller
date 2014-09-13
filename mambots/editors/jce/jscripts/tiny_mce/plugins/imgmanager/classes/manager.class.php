<?php
/**
 * ImageManager Class.
 * @author $Author: Ryan Demmer $
 * @version $Id: common.class.php 27 2005-09-14 17:51:00 Ryan Demmer $
 */
class ImageManager
{
        //Configuration array.
        var $base_dir;
        var $base_url;

        /**
         * Constructor. Create a new Manager instance.
         * @param array $lang language array, see langs/en.php;
         * @param string $$mosConfig_live_site Joomla/Mambo configuration variable
         * @param string $$mosConfig_absolute_path Joomla/Mambo configuration variable
         */
        function ImageManager( $base_dir, $base_url )
        {
                $this->base_dir = $base_dir;
                $this->base_url = $base_url;
        }
        /**
         * Get the base directory.
         * @return string base dir
         */
        function getBaseDir()
        {
                global $mosConfig_absolute_path;
				Return JPath::makePath( $mosConfig_absolute_path, $this->base_dir );
        }
        /**
         * Get the base URL.
         * @return string base url
         */
        function getBaseURL()
        {
                global $mosConfig_live_site;
				Return JPath::makePath( $mosConfig_live_site, $this->base_url );
        }
        /**
         * Get the tmp file prefix.
        * @return string tmp file prefix.
         */
        function getTmpPrefix()
        {
                global $params;
                Return $params->get( 'tmp_prefix', 'editor_temp_' );
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
                        'fullpath' => $fullpath,
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
        /**
         * Check if the file contains the thumbnail prefix.
         * @param string $file filename to be checked
         * @return true if the file contains the thumbnail prefix, false otherwise.
         */
        function isThumb( $file )
        {
            global $params;
            $thumb_prefix = $params->get( 'thumb_prefix', 'thumb_' );
            $length = strlen( $thumb_prefix );
            if( substr( $file, 0, $length ) == $thumb_prefix ){
                return true;
            }else{
                return false;
            }
        }
        /**
         * Check if the given file is an Editor temp file.
         * @param string $file file name
         * @return boolean true if it is a temp file, false otherwise
         */
        function isEditorTemp( $file )
        {
            global $params;
            $editor_prefix = $params->get( 'tmp_prefix', 'editor_temp_' );
            $length = strlen( $editor_prefix );
            if( substr( $file, 0, $length ) == $editor_prefix ){
                return true;
            }else{
                return false;
            }
        }
        /**
         * PHPThumb Resize function for resizing and thumbnailing
         * @param string $src Fullpath of the source file
         * @param string $dest Fullpath of the destination file if any
         * @param string $width Width to resize to.
         * @param string $height Height to resize to.
         * @param string $quality Quality of resizing.
         */
        function resize( $src, $dest=false, $width, $height, $quality )
        {
            global $im_path, $params, $mosConfig_absolute_path;
            if( !$dest  ) $dest = $src;

            require_once( $im_path.'/classes/phpthumb/phpthumb.class.php' );
            $phpThumb = new phpThumb();
            $phpThumb->src = $src;
            $phpThumb->config_temp_directory = $mosConfig_absolute_path."/media/jce_im_temp/";
            $phpThumb->w = $width;
            $phpThumb->h = $height;
            $phpThumb->q = $quality;
                    
            if ( $phpThumb->GenerateThumbnail() ) {
                $phpThumb->RenderToFile( $dest );
                @JPath::setPermissions( $dest );
                return true;
            }else{
                return false;
            }
        }
        function doUpload( $dir, $file, $ext, $resize, $resize_quality, $max_value, $thumb, $thumb_quality, $thumb_size, $overwrite, $unique )
        {
            global $cmnlang, $imlang;
			$error = false;

            $format = substr( $file['name'], -3 );
            //$allowable = explode( ',', $ext );
            $size = $file['size'];

            $noMatch = 0;
		    foreach( $ext as $valid_ext ) {
                if ( strcasecmp( $format, $valid_ext ) == 0 ) $noMatch = 1;
            }
            if( !$noMatch ){
                $error = $cmnlang['upload_ext_err'];
            }else{
                $path = JPath::makePath( $this->getBaseDir(), $dir );
                $file_path = JPath::makePath( $path, JFile::makeSafe( $file['name'] ) );
                $result = JFile::upload( $file['tmp_name'], $file_path, $overwrite, $unique );

                if( JFile::exists( $result ) ){
                    if( $resize ){
                        if( !$this->resize( $result, false, $max_value, $max_value, intval( $resize_quality ) ) ){
                            $error = $imlang['resize_error'];
                        }
                    }
                    if( $thumb ){
                        $file_name = JPath::makePath( $dir, basename( $result ) );
                        if( $this->newThumb( $file_name, $thumb_size, intval( $thumb_quality ) ) ){
                            $error = $imlang['new_thumb_err'];
                        }
                    }
                }else{
                    $error = $result;
                }
            }
            return $error;
        }
        /**
         * Check for the thumbnail for a given file
         * @param string $relative The relative path of the file
         * @return The thumbnail URL or false if none.
         */
        function getThumbnail( $relative )
        {
            global $thumb_size, $thumb_dir;
            $thumbnail = false;

            $fullpath = JPath::makePath( $this->getBaseDir(), $relative );
            $dim = @getimagesize( $fullpath );
                
            $thumbnail_dir = JPath::makePath( str_replace( "\\", "/", dirname( $relative ) ), $thumb_dir );
            $thumb = JPath::makePath( $thumbnail_dir, $this->getThumbName( $relative ) );

            //the original image is smaller than thumbnails,
            //so just return the url to the original image.
            if ( $dim[0] <= $thumb_size && $dim[1] <= $thumb_size ){
                $thumbnail = $relative;
            }
            //check for thumbnails, if exists return the thumbnail url
            if( JFile::exists( JPath::makePath( $this->getBaseDir(), $thumb ) ) ){
                $thumbnail = $thumb;
            }
            return $thumbnail;
        }
        /**
         * For a given image file, get the respective thumbnail filename
         * no file existence check is done.
         * @param string $file the full path to the image file
         * @return string of the thumbnail file
         */
        function getThumbName( $file )
        {
            global $params;
            $thumbname = $params->get( 'thumb_prefix', 'thumb_' ).basename( $file );
            
            return $thumbname;
        }
        /**
         * Create thumbnail.
         * @param string $dir The current directory
         * @param string $file The relative path of the file to create a thumbnail of
         * @return string $error on failure
         */
        function newThumb( $file, $size, $quality )
        {
            global $imlang, $thumb_dir;
            $error = false;
            
            $src = JPath::makePath( $this->getBaseDir(), $file );
            $thumb_dir = JPath::makePath( dirname( $src ), $thumb_dir );
            $new_thumb = JPath::makePath( $thumb_dir, $this->getThumbname( $file ) );
            if( !JFolder::exists( $thumb_dir ) ){
                if( !@JFolder::createFolder( dirname( $new_thumb ) ) ){
                    $error = $imlang['new_thumb_dir_err'];
                }else{
                    if ( !$this->resize( $src, $new_thumb, $size, $size, $quality ) ){
                        $error = $imlang['thumb_error_new'];
                    }
                }
            }else{
                if ( !$this->resize( $src, $new_thumb, $size, $size, $quality ) ){
                    $error = $imlang['thumb_error_new'];
                }
            }
            return $error;
        }
        /**
         * Delete thumbnail.
         * @param string $thumb the relative path to the file tat has a thumbnail
         * @return string $error on failure
         */
        function deleteThumb( $file )
        {
            global $imlang, $params;
            $error = false;
            $thumbnail_dir = JPath::makePath( JPath::makePath( $this->getBaseDir(), dirname( $file ) ), $params->get( 'thumb_dir', 'thumbnails' ) );
            $thumbnail = JPath::makePath( $thumbnail_dir, $this->getThumbName( $file ) );

            if( @!JFile::delete( $thumbnail ) ) {
                $error = $imlang['del_thumb_err'];
            }else{
                if( JFile::countFiles( $thumbnail_dir ) == 0 ) {
                    if( @!JFolder::delete( $thumbnail_dir ) ){
                        $error = $imlang['del_thumb_dir_err'];
                    }
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
            global $cmnlang, $params;
			$error = false;
            $files = explode( ",", $files );
            foreach( $files as $file ){
                $fullpath = JPath::makePath( $this->getBaseDir(), $file );

                if( JFile::exists( $fullpath ) ){
                    if( @!JFile::delete( $fullpath ) ){
                        $error = $cmnlang['del_file_err'];
                    }else{
                        $thumb_path = JPath::makePath( $this->getBaseDir(), $this->getThumbnail( $file ) );
                        if( JFile::exists( $thumb_path ) ){
                            $error = $this->deleteThumb( $file );
                        }
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
            if( JFile::countFiles( $folder ) != 0 || JFolder::countDirs( $folder ) != 0 ){
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
            global $cmnlang, $manager, $params;
            $error = false;

            $thumbnail_dir = JPath::makePath( $this->getBaseDir(), $params->get( 'thumb_dir', 'thumbnails' ) );
            $thumb_src = JPath::makePath( $thumbnail_dir, $this->getThumbName( $src ) );

            $src = JPath::makePath( $this->getBaseDir(), $src );

            $dir = dirname( $src );
            $ext = JFile::getExt( $src );
            
            $thumb_dest = JPath::makePath( $thumbnail_dir, $this->getThumbName( $dest.'.'.$ext ) );

            $dest = JPath::makePath( $dir, $dest.'.'.$ext );
            
            $error = JFile::rename( $src, $dest );
            if( !$error ){
                if( JFile::exists( $thumb_src ) ){
                    $error = JFile::rename( $thumb_src, $thumb_dest );
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
            global $cmnlang, $params;
			$error = false;

            $files = explode( ",", $files );
            foreach( $files as $file ){

                $thumbnail_dir = JPath::makePath( $this->getBaseDir(), $params->get( 'thumb_dir', 'thumbnails' ) );
                $thumb_src = JPath::makePath( $thumbnail_dir, $this->getThumbName( basename( $file ) ) );
               
                $filepath = JPath::makePath( $dest_dir, basename( $file ) );
                $src = JPath::makePath( $this->getBaseDir(), $file );
                $dest = JPath::makePath( $this->getBaseDir(), $filepath );
                $error = JFile::copy( $src, $dest );
                if( !$error ){
                    if( JFile::exists( $thumb_src ) ){
                        $thumb_dest_dir = JPath::makePath( $this->getBaseDir(), JPath::makePath( $dest_dir, $params->get( 'thumb_dir', 'thumbnails' ) ) );
                        if( !JFolder::exists( $thumb_dest_dir ) ){
                            !@JFolder::createFolder( $thumb_dest_dir );
                        }
                        $thumb_dest = JPath::makePath( $thumb_dest_dir, $this->getThumbName( basename( $filepath ) ) );
                        $error = JFile::copy( $thumb_src, $thumb_dest );
                    }
                }
            }
            return $error;
        }
        /*
        * Move a file.
        * @param string $files The relative file or comma seperated list of files
        * @param string $dest The relative path of the destination dir
        * @return string $error on failure
        */
        function move( $files, $dest_dir )
        {
            global $cmnlang, $params;
			$error = false;

            $files = explode( ",", $files );
            foreach( $files as $file ){
                $thumbnail_dir = JPath::makePath( $this->getBaseDir(), $params->get( 'thumb_dir', 'thumbnails' ) );
                $thumb_src = JPath::makePath( $thumbnail_dir, $this->getThumbName( basename( $file ) ) );

                $filepath = JPath::makePath( $dest_dir, basename( $file ) );
                $src = JPath::makePath( $this->getBaseDir(), $file );
                $dest = JPath::makePath( $this->getBaseDir(), $filepath );
                $error = JFile::rename( $src, $dest );
                
                if( !$error ){
                    if( JFile::exists( $thumb_src ) ){
                        $thumb_dest_dir = JPath::makePath( $this->getBaseDir(), JPath::makePath( $dest_dir, $params->get( 'thumb_dir', 'thumbnails' ) ) );
                        if( !JFolder::exists( $thumb_dest_dir ) ){
                            !@JFolder::createFolder( $thumb_dest_dir );
                        }
                        $thumb_dest = JPath::makePath( $thumb_dest_dir, $this->getThumbName( basename( $filepath ) ) );
                        $error = JFile::rename( $thumb_src, $thumb_dest );
                    }
                }
            }
            return $error;
        }
}

?>
