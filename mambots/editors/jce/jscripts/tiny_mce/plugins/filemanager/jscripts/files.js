//Javascript functions for the Image Manager. Used by images.php and list.php
function resetEditor()
{
    topDoc.getElementById('imgList').value = '';
    topDoc.getElementById('dirList').value = '';
    if(topDoc.getElementById('clipboard').value != '')
        iconState('off', 'paste');
}
function refreshDir(newDir)
{
    showMessage(topDoc, 'Loading', 'load', 'msg');
    location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=filemanager&file=files.php&dir="+encodeURI(newDir);
}
function changeDir(newDir)
{
    showMessage(topDoc, 'Loading', 'load', 'msg');
    location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=filemanager&file=files.php&dir="+encodeURI(newDir);
}
function newFolder(dir, newDir)
{
    location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=filemanager&file=files.php&opt=new_folder&dir="+dir+"&newd="+newDir;
}
function delDir(dir, path)
{
    location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=filemanager&file=files.php&opt=del_folder&dir="+dir+"&deld="+encodeURI(path);
}
function doUpload(dir)
{
    location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=filemanager&file=files.php&dir="+dir+"&refresh=1";
}
function delFile(dir, file)
{
    location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=filemanager&file=files.php&opt=del_file&dir="+encodeURI(dir)+"&delf="+encodeURI(file);
}
function moveFile(file, dir, option)
{
    switch( option ){
        case 'copy':
            location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=filemanager&file=files.php&opt=copy_file&dir="+dir+"&copyf="+file+"&dest="+dir;
        break;
        case 'cut':
            location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=filemanager&file=files.php&opt=move_file&dir="+dir+"&movef="+file+"&dest="+dir;
        break;
    }
}
function renFile(dir, file, name )
{
    location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=filemanager&file=files.php&opt=rename_file&dir="+dir+"&renf="+file+"&newf="+name;
    hide( topDoc, 'renfiledlg' );
    topDoc.getElementById('newfilename').value = '';
    topDoc.getElementById('oldfilename').value = '';
}
function renDir(dir, name, relative)
{
    location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=filemanager&file=files.php&opt=rename_folder&dir="+dir+"&rend="+relative+"&newd="+name;
    hide( topDoc, 'rendirdlg' );
    topDoc.getElementById('newdirname').value = '';
    topDoc.getElementById('dirpath').value = '';
}

function resetPreview()
{
    hide( topDoc, 'info1' );
    hide( topDoc, 'info2' );
    hide( topDoc, 'info3' );
    hide( topDoc, 'info4' );
    hide( topDoc, 'info5' );
}
function iconState(state, opt){
    switch (state){
        case 'on' :
        switch(opt){
            case 'single' :
                show( topDoc, 'delImg' );
                show( topDoc, 'copyImg' );
                show( topDoc, 'cutImg' );
                show( topDoc, 'renImg' );
            break;
            case 'multiple' :
                show( topDoc, 'delImg' );
                show( topDoc, 'copyImg' );
                show( topDoc, 'cutImg' );
                hide( topDoc, 'renImg' );
                hide( topDoc, 'viewImg' );
            break;
        }
        break;
        case 'off' :
                hide( topDoc, 'delImg' );
                hide( topDoc, 'copyImg' );
                hide( topDoc, 'cutImg' );
                hide( topDoc, 'renImg' );
                hide( topDoc, 'viewImg' );
        break;
    }
}
function selectFile(filename, title, size, date, ext)
{
    var formObj = parent.document.forms[0];
    formObj.href.value = filename;
    formObj.title.value = title;
    formObj.file_size.value = size;
    formObj.file_date.value = date;
    formObj.file_ext.value = ext;
}
function showFile(option, numfiles, relative, file, imgname, type, size, modified, time)
{
    var view = false;
    if( view_files.match( type ) ) view = true;

    type = type.toUpperCase();
    
    if(option == 'single'){
        var nameTxt =  ""+imgname+"";
        var extTxt = ""+type+" "+ lang['file'] +"";
        var sizeTxt = lang['size'] + ": "+size+"";
        var modTxt = lang['modified'] + ": "+modified+","+time;
    }else{
        var nameTxt =  ""+numfiles+" files selected.";
        var extTxt = "";
        var sizeTxt = "";
        var modTxt = "";
    }
    show( topDoc, 'info1' );
    show( topDoc, 'info2' );
    show( topDoc, 'info3' );
    show( topDoc, 'info4' );

    topDoc.getElementById('info1Val').value = imgname;
    topDoc.getElementById('info2Val').value = type;
    topDoc.getElementById('info3Val').value = size;
    topDoc.getElementById('info4Val').value = modified+','+time;
    
    createInfo(topDoc, 'info1', nameTxt);
    createInfo(topDoc, 'info2', extTxt);
    createInfo(topDoc, 'info3', sizeTxt);
    createInfo(topDoc, 'info4', modTxt);

    hide( topDoc, 'delDir' );
    hide( topDoc, 'renDir' );

    hide( topDoc, 'viewImg' );
    if(view) show( topDoc, 'viewImg' );

    topDoc.getElementById('dirList').value = '';
}
function showFolder(dirname, modified, time, files, folders)
{
    show( topDoc, 'info1' );
    show( topDoc, 'info2' );
    show( topDoc, 'info3' );

    var nameTxt =  ""+dirname+"";
    var nameType = lang['folder'];
    var numTxt = files+" " + lang['files'] + " "+folders+" " + lang['folders'] + "";
    
    createInfo(topDoc, 'info1', nameTxt);
    createInfo(topDoc, 'info2', nameType);
    createInfo(topDoc, 'info3', numTxt);

    removeInfo(topDoc.getElementById('info4'));

    hide( topDoc, 'viewImg' );
    show( topDoc, 'renDir' );
    show( topDoc, 'delDir' );

    topDoc.getElementById('info1Val').value = dirname;

    topDoc.getElementById('imgList').value = '';

    iconState('off','');
}
function setReturnFile(file)
{
    var elm = document.getElementById('fileList');
    var child = ( elm.childNodes );
    var formObj = parent.document.forms[0];
    for ( var i = 0; i < child.length; i++ ) {
        if( child[i].tagName == 'LI' ){
            var val = child[i].getAttribute('value');
            var valstr = val.split(',');
            if( file == valstr[0] ){
                sf.setItemSelected(child[i], true);
                showFile('single', i, valstr[0], valstr[1], valstr[2], valstr[3], valstr[4], valstr[5], valstr[6]);
                iconState('on', 'single');
                formObj.file_size.value = valstr[4];
                formObj.file_date.value = valstr[5]+','+valstr[6];
                formObj.file_ext.value = valstr[3];
                parent.document.getElementById("imgList").value = valstr[0];
            }
        }
    }
}

