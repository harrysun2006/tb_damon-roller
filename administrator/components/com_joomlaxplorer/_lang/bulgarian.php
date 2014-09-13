<?php

// Bulgarian Language Module for v2.3 (translated by the Ivo Apostolov)
global $_VERSION;

$GLOBALS["charset"] = "windows-1251";
$GLOBALS["text_dir"] = "ltr"; // ('ltr' for left to right, 'rtl' for right to left)
$GLOBALS["date_fmt"] = "Y/m/d H:i";
$GLOBALS["error_msg"] = array(
	// error
	"error"			=> "������",
	"back"			=> "�����",

	// root
	"home"			=> "���� ������ ����������.",
	"abovehome"		=> "���������� ���������� �� ���� �� ���� ��� ���������.",
	"targetabovehome"	=> "��������� ���������� �� ���� �� ���� ��� ���������.",

	// exist
	"direxist"		=> "������������ �� ����������.",
	//"filedoesexist"	=> "This file already exists.",
	"fileexist"		=> "����� �� ����������.",
	"itemdoesexist"		=> "���� ��� ����� �����.",
	"itemexist"		=> "������ �� ����������.",
	"targetexist"		=> "������������ �� ����������.",
	"targetdoesexist"	=> "�������� ����� ���� ����������.",

	// open
	"opendir"		=> "�� � �������� �� ���� �������� ������������.",
	"readdir"		=> "�� � �������� �� ���� ��������� ������������.",

	// access
	"accessdir"		=> "������ ������ �� ���� ����������.",
	"accessfile"		=> "������ ������ �� ���� ����.",
	"accessitem"		=> "������ ������ �� ���� �����.",
	"accessfunc"		=> "������ ������ �� ���������� ���� �������.",
	"accesstarget"		=> "������ ������ �� ��������� ����������.",

	// actions
	"permread"		=> "������ ��� ������� �� �������.",
	"permchange"	=> "������ ��� ����� �� �������.",
	"openfile"		=> "������ ��� ���������� �� �����.",
	"savefile"		=> "������ ��� ������ �� �����.",
	"createfile"	=> "������ ��� ����������� �� ����.",
	"createdir"		=> "������ ��� ����������� �� ����������.",
	"uploadfile"	=> "������ ��� ��������� �� ����.",
	"copyitem"		=> "������ ��� ��������.",
	"moveitem"		=> "������ ��� �����������.",
	"delitem"		=> "������ ��� ���������.",
	"chpass"		=> "������ ��� ����� �� ������.",
	"deluser"		=> "������ ��� ��������� �� ����������.",
	"adduser"		=> "������ ��� �������� �� ����������.",
	"saveuser"		=> "������ ��� ������ �� ����������.",
	"searchnothing"	=> "�������� �������� �� �������.",

	// misc
	"miscnofunc"		=> "��������� �� � �������.",
	"miscfilesize"		=> "������ � ��� ����������� ����.",
	"miscfilepart"		=> "������ �� ����� ��������.",
	"miscnoname"		=> "������ �� �������� ���.",
	"miscselitems"		=> "�� ��� ������� ����.",
	"miscdelitems"		=> "������� �� ��� � ����������� �� ���� \"+num+\" ������?",
	"miscdeluser"		=> "������� �� ��� � ����������� �� ����������� '\"+user+\"'?",
	"miscnopassdiff"	=> "������ ������ �� �� ��������� �� �������.",
	"miscnopassmatch"	=> "�������� �� ��������.",
	"miscfieldmissed"	=> "���������� ��� ������������ ����.",
	"miscnouserpass"	=> "��������������� ��� ��� �������� �� ������.",
	"miscselfremove"	=> "�� ������ �� �������� ���� ��.",
	"miscuserexist"		=> "���� ��� ����� ����������.",
	"miscnofinduser"	=> "�� ���� �� ���� ������ ����������.",
	"extract_noarchive" => "������ �� ���� �� ���� ������������.",
	"extract_unknowntype" => "���������� ��� �� ������"
);
$GLOBALS["messages"] = array(
	// links
	"permlink"		=> "����� �� �����",
	"editlink"		=> "��������",
	"downlink"		=> "�������",
	"uplink"		=> "������",
	"homelink"		=> "������",
	"reloadlink"		=> "������������",
	"copylink"		=> "��������",
	"movelink"		=> "�����������",
	"dellink"		=> "���������",
	"comprlink"		=> "����������",
	"adminlink"		=> "��������������",
	"logoutlink"		=> "�����",
	"uploadlink"		=> "�������",
	"searchlink"		=> "�������",
	"extractlink"	=> "�������������",
	'chmodlink'		=> '����� �� �������', // new mic
	'mossysinfolink'	=> $_VERSION->PRODUCT.' �������� ���������� ('.$_VERSION->PRODUCT.', ������, PHP, MySQL)', // new mic
	'logolink'		=> '������� � ����� �� joomlaXplorer', // new mic

	// list
	"nameheader"		=> "���",
	"sizeheader"		=> "������",
	"typeheader"		=> "���",
	"modifheader"		=> "�����������",
	"permheader"		=> "�����",
	"actionheader"		=> "��������",
	"pathheader"		=> "���",

	// buttons
	"btncancel"		=> "�����",
	"btnsave"		=> "�����",
	"btnchange"		=> "�������",
	"btnreset"		=> "�������",
	"btnclose"		=> "�������",
	"btncreate"		=> "������",
	"btnsearch"		=> "�����",
	"btnupload"		=> "����",
	"btncopy"		=> "�������",
	"btnmove"		=> "��������",
	"btnlogin"		=> "����",
	"btnlogout"		=> "�����",
	"btnadd"		=> "������",
	"btnedit"		=> "����������",
	"btnremove"		=> "������",
	
	// user messages, new in joomlaXplorer 1.3.0
	'renamelink'	=> '�����������',
	'confirm_delete_file' => '������� �� ��� � ����������� �� ���� ����? \\n%s',
	'success_delete_file' => '������ �� ������� �������.',
	'success_rename_file' => '������������/����� %s �� ������������ �� %s.',
	
	// actions
	"actdir"		=> "����������",
	"actperms"		=> "����� �� �������",
	"actedit"		=> "�������� �� ����",
	"actsearchresults"	=> "��������� �� �������",
	"actcopyitems"		=> "�������� �� ������",
	"actcopyfrom"		=> "������� �� /%s � /%s ",
	"actmoveitems"		=> "����������� �� ������",
	"actmovefrom"		=> "�������� �� /%s � /%s ",
	"actlogin"		=> "����",
	"actloginheader"	=> "���� �� ���������� �� �������� �������",
	"actadmin"		=> "�������������",
	"actchpwd"		=> "����� �� ������",
	"actusers"		=> "�����������",
	"actarchive"		=> "���������� �� ��������",
	"actupload"		=> "������� �� �������",

	// misc
	"miscitems"		=> "������",
	"miscfree"		=> "��������",
	"miscusername"		=> "����������",
	"miscpassword"		=> "������",
	"miscoldpass"		=> "����� ������",
	"miscnewpass"		=> "���� ������",
	"miscconfpass"		=> "�������� ������",
	"miscconfnewpass"	=> "�������� ������ ������",
	"miscchpass"		=> "����� ������",
	"mischomedir"		=> "������� ����������",
	"mischomeurl"		=> "������� �����",
	"miscshowhidden"	=> "������ �������� ������",
	"mischidepattern"	=> "����� ���������",
	"miscperms"		=> "�����",
	"miscuseritems"		=> "(���, ������� ����������, ������ �������� ������, �����, ��������)",
	"miscadduser"		=> "������ ����������",
	"miscedituser"		=> "���������� ����������� '%s'",
	"miscactive"		=> "���������",
	"misclang"		=> "����",
	"miscnoresult"		=> "���� ���������.",
	"miscsubdirs"		=> "������� � ���������������",
	"miscpermnames"		=> array("���� �������","������������","����� �� ������","������������ & ����� �� ������",
					"�������������"),
	"miscyesno"		=> array("��","��","�","�"),
	"miscchmod"		=> array("����������", "�����", "����������"),

	// from here all new by mic
	'miscowner'			=> '����������',
	'miscownerdesc'		=> '<strong>��������:</strong><br />��������� (UID) /<br />����� (GID)<br />�������� �����:<br /><strong> %s ( %s ) </strong>/<br /><strong> %s ( %s )</strong>',

	// sysinfo (new by mic)
	'simamsysinfo'		=> $_VERSION->PRODUCT." ������� ����������",
	'sisysteminfo'		=> '�������� ����������',
	'sibuilton'			=> '����������� �������',
	'sidbversion'		=> '������ �� MySQL',
	'siphpversion'		=> '������ �� PHP',
	'siphpupdate'		=> '����������: <span style="color: red;">�������� �� PHP ����� �������� <strong>�� �</strong> ��������!</span><br />�� �� ����������� ������ �������������� �� Joomla! ������ �� ��������,<br /> ������� <strong>������ �� PHP 4.3</strong>!',
	'siwebserver'		=> '��� ������',
	'siwebsphpif'		=> '��� ������ - PHP ���������',
	'simamboversion'	=> $_VERSION->PRODUCT.' ������',
	'siuseragent'		=> '������ �� ��������',
	'sirelevantsettings' => '����� PHP ���������',
	'sisafemode'		=> '������� �����',
	'sibasedir'			=> '�������� ������� ����������',
	'sidisplayerrors'	=> 'PHP ������',
	'sishortopentags'	=> '���� �������� �������',
	'sifileuploads'		=> '������� �� �������',
	'simagicquotes'		=> '��������� ������',
	'siregglobals'		=> '������������ �� ��������',
	'sioutputbuf'		=> '������� �����',
	'sisesssavepath'	=> '����� �� ���� �� �������',
	'sisessautostart'	=> '����������� ��������� �� �������',
	'sixmlenabled'		=> '��������� �� XML',
	'sizlibenabled'		=> '��������� �� ZLIB',
	'sidisabledfuncs'	=> '��������� �������',
	'sieditor'			=> 'WYSIWYG ��������',
	'siconfigfile'		=> '���� � ���������',
	'siphpinfo'			=> 'PHP ����������',
	'siphpinformation'	=> 'PHP ����������',
	'sipermissions'		=> '�����',
	'sidirperms'		=> '����� ����� ����������',
	'sidirpermsmess'	=> '�� �� ��� �������, �� ������ ������� �� '.$_VERSION->PRODUCT.' ������� ��������, �������� ���������� ������ �� �� � ����� [chmod 0777]',
	'sionoff'			=> array( '�������', '��������' ),
	
	'extract_warning' => "������� �� ��� � ��������������� �� ���� ����? ���?\\n���������� �� ����������� ���� ������� ����� ���������, ��� ������� �� ��������!",
	'extract_success' => "�������������� � �������",
	'extract_failure' => "������ ��� ���������������",
	
	'overwrite_files' => 'Overwrite existing file(s)?',
	"viewlink"		=> "VIEW",
	"actview"		=> "Showing source of file"
);
?>
