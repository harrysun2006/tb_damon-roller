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
    location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanager&file=images.php&dir="+encodeURI(newDir)+"&mode="+mode;
}
function changeDir(newDir)
{
    showMessage(topDoc, 'Loading', 'load', 'msg');
    location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanager&file=images.php&dir="+encodeURI(newDir)+"&mode="+mode;
}
function newFolder(dir, newDir)
{
    location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanager&file=images.php&opt=new_folder&dir="+dir+"&newd="+newDir+"&mode="+mode;
}
function delDir(dir, path)
{
    location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanager&file=images.php&opt=del_folder&dir="+dir+"&deld="+encodeURI(path)+"&mode="+mode;
}
function doUpload(dir)
{
    location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanager&file=images.php&dir="+dir+"&mode="+mode;
}
function delFile(dir, file)
{
    location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanager&file=images.php&opt=del_file&dir="+encodeURI(dir)+"&delf="+encodeURI(file)+"&mode="+mode;
}
function moveFile(file, dir, option)
{
    switch( option ){
        case 'copy':
            location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanager&file=images.php&opt=copy_file&dir="+dir+"&copyf="+file+"&dest="+dir+"&mode="+mode;
        break;
        case 'cut':
            location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanager&file=images.php&opt=move_file&dir="+dir+"&movef="+file+"&dest="+dir+"&mode="+mode;
        break;
    }
}
function renFile(dir, file, name )
{
    location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanager&file=images.php&opt=rename_file&dir="+dir+"&renf="+file+"&newf="+name+"&mode="+mode;
    hide( topDoc, 'renfiledlg' );
    topDoc.getElementById('newfilename').value = '';
    topDoc.getElementById('oldfilename').value = '';
}
function renDir(dir, name, relative)
{
    location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanager&file=images.php&opt=rename_folder&dir="+dir+"&rend="+relative+"&newd="+name+"&mode="+mode;
    hide( topDoc, 'rendirdlg' );
    topDoc.getElementById('newdirname').value = '';
    topDoc.getElementById('dirpath').value = '';
}
function switchMode(dir, newmode){
     location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanager&file=images.php&dir="+dir+"&mode="+newmode;
     topDoc.getElementById('viewMode').value = newmode;

}
function thumbAction( file, name, option, size, quality )
{
    var dir = getSelectValue(parent.document.forms[0], 'dirPath');
    switch( option ){
        case 'create':
            location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanager&file=images.php&opt=create_thumb&dir="+dir+"&thumb="+file+"&size="+size+"&quality="+quality+"&mode="+mode;
            hide( topDoc, 'thumbsizedlg' );
        break;
        case 'delete':
            location.href = "index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanager&file=images.php&opt=delete_thumb&dir="+dir+"&thumb="+file+"&mode="+mode;
        break;
    }
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
                show( topDoc, 'viewImg' );
            break;
            case 'multiple' :
                show( topDoc, 'delImg' );
                show( topDoc, 'copyImg' );
                show( topDoc, 'cutImg' );
                hide( topDoc, 'renImg' );
                hide( topDoc, 'viewImg' );
                hide( topDoc, 'thumbLink' );
            break;
        }
        break;
        case 'off' :
                hide( topDoc, 'delImg' );
                hide( topDoc, 'copyImg' );
                hide( topDoc, 'cutImg' );
                hide( topDoc, 'renImg' );
                hide( topDoc, 'viewImg' );
                hide( topDoc, 'thumbLink' );
        break;
    }
}
function selectImage(filename, title, w, h, thumb_src, thumb_name, thumb_w, thumb_h)
{
    var formObj = parent.document.forms[0];
    var topDoc = parent.document;

    formObj.title.value = title;
    formObj.alt.value = title;

    if(!topDoc.getElementById('popup_check').checked)
    {
        formObj.src.value = filename;
        formObj.width.value = w;
        formObj.height.value = h;
        formObj.tmp_width.value = w;
        formObj.tmp_height.value = h;
        
    }
    if(topDoc.getElementById('popup_panel').className == 'current' && topDoc.getElementById('popup_check').checked )
    {
        if( thumb_src != 'null' && thumb_src != filename ){
            if( confirm( lang['use_thumb'] ) )
            {
                formObj.popup_src.value = filename;
                formObj.popup_width.value = w;
                formObj.popup_height.value = h;
                
                formObj.src.value = thumb_src;
                formObj.width.value = thumb_w;
                formObj.height.value = thumb_h;
                formObj.tmp_width.value = thumb_w;
                formObj.tmp_height.value = thumb_h;
            }
        }

        formObj.popup_src.value = filename;
        formObj.popup_width.value = w;
        formObj.popup_height.value = h;
        formObj.popup_tmp_width.value = w;
        formObj.popup_tmp_height.value = h;
    }
    if( topDoc.getElementById('popup_check').checked && ( topDoc.getElementById('general_panel').className == 'current' ||  topDoc.getElementById('general_panel').className == 'panel current') )
    {
        formObj.src.value = filename;
        formObj.width.value = w;
        formObj.height.value = h;
        formObj.tmp_width.value = w;
        formObj.tmp_height.value = h;

    }
    if(topDoc.getElementById('swap_panel').className == 'current' && formObj.onmousemovecheck.checked )
    {
        if( formObj.onmouseoutsrc.value == '' ){
            formObj.src.value = filename;
            formObj.onmouseoutsrc.value = filename;
            formObj.width.value = w;
            formObj.height.value = h;
            formObj.tmp_width.value = w;
            formObj.tmp_height.value = h;
        }else{
            formObj.onmouseoversrc.value = filename;
        }
    }
}
function showImage(option, numfiles, relative, file, imgname, type, width, height, size, modified, time, thumbstate)
{
    type = type.toUpperCase();
    show( topDoc, 'info1' );
    show( topDoc, 'info2' );
    show( topDoc, 'info3' );
    show( topDoc, 'info4' );
    show( topDoc, 'info5' );

    if(option == 'single'){
        var f = type.toLowerCase();
        topDoc.getElementById('previewContainer').innerHTML = '<img src="' + im_url + '/classes/phpthumb/phpThumb.php?src=' + file + '&w=140&h=140&f=' + f +'" alt="Preview" title="Preview" />';
        show( topDoc, 'thumbLink' );
        switch( thumbstate ){
            case '0' :
                topDoc.getElementById('thumbLink').innerHTML = '<a href="javascript:void(0)" class="tools" onclick="showDlg(document, \'thumbsizedlg\');"><img src="' + im_url + '/images/thumb_create.gif" alt="Create Thumbnail" title="Create Thumbnail" border="0" width="20" height="20" /></a>';
            break;
            case '1' :
                topDoc.getElementById('thumbLink').innerHTML = '<a href="javascript:void(0)" class="tools"  onclick="imgManager.thumbAction(\''+relative+'\', \''+imgname+'\', \'delete\', \'\');"><img src="' + im_url + '/images/thumb_delete.gif" style="cursor:pointer;" alt="Delete Thumbnail" title="Delete Thumbnail" border="0" width="20" height="20" /></a>';
            break;
            case '2' :
                topDoc.getElementById('thumbLink').innerHTML = '<a href="javascript:void(0)" class="tools"><img src="' + im_url + '/images/thumb.gif" alt="' + lang['is_thumb'] + '" title="' + lang['is_thumb'] + '" border="0" width="20" height="20" /></a>';
            break;
        }
        var nameTxt =  ""+imgname+"";
        var dimTxt  = "Dimensions: "+width+" x "+height+"";
        var extTxt = ""+type+" Image";
        var sizeTxt = "Size: "+size+"";
        var modTxt = "Modified: "+modified+","+time;
    }else{
        topDoc.getElementById('previewContainer').innerHTML = '';
        var nameTxt =  ""+numfiles+" files selected.";
        var dimTxt  = "";
        var extTxt = "";
        var sizeTxt = "";
        var modTxt = "";
    }
    infoName = topDoc.getElementById('info1');
    infoExt = topDoc.getElementById('info2');
    infoDim = topDoc.getElementById('info3');
    infoSize = topDoc.getElementById('info4');
    infoMod = topDoc.getElementById('info5');

    topDoc.getElementById('info1Val').value = imgname;
    topDoc.getElementById('info2Val').value = type;
    topDoc.getElementById('info3Val').value = width+','+height;
    topDoc.getElementById('info4Val').value = size;

    createInfo(topDoc, 'info1', nameTxt);
    createInfo(topDoc, 'info2', extTxt);
    createInfo(topDoc, 'info3', dimTxt);
    createInfo(topDoc, 'info4', sizeTxt);
    createInfo(topDoc, 'info5', modTxt);

    hide( topDoc, 'delDir' );
    hide( topDoc, 'renDir' );

    topDoc.getElementById('dirList').value = '';
}
function showFolder(dirname, modified, time, files, folders)
{
    infoName = topDoc.getElementById('info1');
    infoExt = topDoc.getElementById('info2');
    infoSize = topDoc.getElementById('info3');
    infoMod = topDoc.getElementById('info4');
    
    show( topDoc, 'info1' );
    show( topDoc, 'info2' );
    show( topDoc, 'info3' );
    show( topDoc, 'info4' );

    topDoc.getElementById('previewContainer').innerHTML = '';

    var nameTxt =  ""+dirname+"";
    var nameType = "File Folder";
    var modTxt = files+" Files "+folders+" Folders";
    
    createInfo(topDoc, 'info1', nameTxt);
    createInfo(topDoc, 'info2', nameType);
    createInfo(topDoc, 'info3', modTxt);

    removeInfo(infoMod);

    hide( topDoc, 'viewImg' );
    hide( topDoc, 'thumbLink' );
    show( topDoc, 'renDir' );
    show( topDoc, 'delDir' );

    topDoc.getElementById('info1Val').value = dirname;

    topDoc.getElementById('imgList').value = '';

    iconState('off','');
}
function setReturnFile(file)
{
    var elm = document.getElementById('imgList');
    var child = ( elm.childNodes );
    var formObj = parent.document.forms[0];
    for ( var i = 0; i < child.length; i++ ) {
        if( child[i].tagName == 'LI' ){
            var val = child[i].getAttribute('value');
            var arr = val.split(',');
            if( file == arr[0] ){
                sf.setItemSelected(child[i], true);
                showImage('single', i, arr[0], arr[1], arr[2], arr[3], arr[4], arr[5], arr[6], arr[7], arr[8], arr[9]);
                iconState('on', 'single');
                parent.document.getElementById("imgList").value = arr[0];
            }
        }
    }
}
