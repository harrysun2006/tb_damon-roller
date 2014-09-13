<?php

// �slenska fyrir joomlaXplorer ver 1.2.1 (translated by gudjon@247.is)
global $_VERSION;

$GLOBALS["charset"] = "iso-8859-1";
$GLOBALS["text_dir"] = "ltr"; // ('ltr' for left to right, 'rtl' for right to left)
$GLOBALS["date_fmt"] = "Y/m/d H:i";
$GLOBALS["error_msg"] = array(
	// error
	"error"			=> "Villa(ur)",
	"back"			=> "Bakka",

	// root
	"home"			=> "Mappa heimasv��isins er ekki til, vinsamlegast kanna�u stillingarnar.",
	"abovehome"		=> "�essi mappa getur ekki veri� sta�sett fyrir ofan heimasv��i� �itt.",
	"targetabovehome"	=> "Mappan getur ekki veri� sta�sett fyrir ofan heimasv��i� �itt.",

	// exist
	"direxist"		=> "�essi mappa er ekki til.",
	//"filedoesexist"	=> "�etta skjal er �egar til.",
	"fileexist"		=> "�essi skr� er ekki til.",
	"itemdoesexist"		=> "�essi hlutur er �egar til.",
	"itemexist"		=> "�essi hlutur er ekki til.",
	"targetexist"		=> "�essi mappa er ekki til.",
	"targetdoesexist"	=> "�essi hlutur er �egar til.",

	// open
	"opendir"		=> "Gat ekki opna� m�ppuna.",
	"readdir"		=> "Gat ekki lesi� m�ppuna.",

	// access
	"accessdir"		=> "�� hefur ekki a�gang a� �essari m�ppu.",
	"accessfile"		=> "�� hefur ekki a�gang a� �essari skr�.",
	"accessitem"		=> "�� hefur ekki a�gang a� �essum hlut.",
	"accessfunc"		=> "�� hefur ekki a�gang a� �essari skipun.",
	"accesstarget"		=> "�� hefur ekki a�gang a� �essari m�ppu.",

	// actions
	"permread"		=> "Gat ekki s�tt a�gangsst�ringar.",
	"permchange"		=> "Gat ekki breytt a�gangsst�ringum.",
	"openfile"		=> "Gat ekki opna� skjali�.",
	"savefile"		=> "Vistun skjalsins mist�kst.",
	"createfile"		=> "Gat ekki b�i� til skr�nna.",
	"createdir"		=> "Gat ekki b�i� til skr�nna.",
	"uploadfile"		=> "Gat ekki s�tt skr�nna.",
	"copyitem"		=> "Afritun mist�kst.",
	"moveitem"		=> "Ekki t�kst a� f�ra skr�nna.",
	"delitem"		=> "Ekki t�kst a� ey�a skr�nni.",
	"chpass"		=> "Mist�kst a� breyta lykilor�inu.",
	"deluser"		=> "Gat ekki fjarl�gt notanda.",
	"adduser"		=> "Gat ekki b�tt inn notanda.",
	"saveuser"		=> "Saving user failed.",
	"searchnothing"		=> "You must supply something to search for.",

	// misc
	"miscnofunc"		=> "Virknin er ekki tilt�k.",
	"miscfilesize"		=> "Skr�inn er of st�r.",
	"miscfilepart"		=> "Hluti af skr�nni var s�ttur.",
	"miscnoname"		=> "Vinsamlegast skr��u inn nafn.",
	"miscselitems"		=> "�� hefur ekki vali� neina hluti.",
	"miscdelitems"		=> "Ertu viss um a� ey�a �essum \"+num+\" hlut(um)?",
	"miscdeluser"		=> "Ertu viss um a� vilja ey�a �essum notanda '\"+user+\"'?",
	"miscnopassdiff"	=> "N�a lykilor�i� er eins.",
	"miscnopassmatch"	=> "Lykilor�in standast ekki.",
	"miscfieldmissed"	=> "Ekki voru allir reiti r�tt �tfylltir.",
	"miscnouserpass"	=> "Notendanafn e�a lykilor� rangt.",
	"miscselfremove"	=> "�� getur ekki fjarl�gt sj�fan �ig.",
	"miscuserexist"		=> "Notandi er �egar til.",
	"miscnofinduser"	=> "Finn ekki notanda.",
	"extract_noarchive" => "Skr�inn er ekki �j�ppu� safnskr�.",
	"extract_unknowntype" => "��ekkt safnskr�"
);
$GLOBALS["messages"] = array(
	// links
	"permlink"		=> "BREYTA A�GANGSST�RINGUM",
	"editlink"		=> "BREYTA",
	"downlink"		=> "NI�URHALA",
	"uplink"		=> "UPP",
	"homelink"		=> "HEIM",
	"reloadlink"		=> "ENDURHLA�A",
	"copylink"		=> "AFRITA",
	"movelink"		=> "F�RA",
	"dellink"		=> "EY�A",
	"comprlink"		=> "GEYMA",
	"adminlink"		=> "ADMIN",
	"logoutlink"		=> "�TSKR�",
	"uploadlink"		=> "UPPHALA",
	"searchlink"		=> "LEIT",
	"extractlink"	=> "Af�jappa",
	'chmodlink'		=> 'Breyta (chmod) A�gangsst�ringum (m�ppu/skr�(a))', // new mic
	'mossysinfolink'	=> $_VERSION->PRODUCT.' uppl�singar ('.$_VERSION->PRODUCT.', Server, PHP, mySQL)', // new mic
	'logolink'		=> 'Fara � heimas��u joomlaXplorer (new window)', // new mic

	// list
	"nameheader"		=> "Nafn",
	"sizeheader"		=> "St�r�",
	"typeheader"		=> "Ger�",
	"modifheader"		=> "Breytt",
	"permheader"		=> "A�gangur",
	"actionheader"		=> "A�ger�ir",
	"pathheader"		=> "Sl��",

	// buttons
	"btncancel"		=> "H�tta",
	"btnsave"		=> "Vista",
	"btnchange"		=> "Breyta",
	"btnreset"		=> "Endurstilla",
	"btnclose"		=> "Loka",
	"btncreate"		=> "B�a til",
	"btnsearch"		=> "Leita",
	"btnupload"		=> "Upphala",
	"btncopy"		=> "Afrita",
	"btnmove"		=> "F�ra",
	"btnlogin"		=> "Innskr�",
	"btnlogout"		=> "�tskr�",
	"btnadd"		=> "B�ta inn",
	"btnedit"		=> "Breyta",
	"btnremove"		=> "Taka �t",

	// user messages, new in joomlaXplorer 1.3.0
	'renamelink'	=> 'RENAME',
	'confirm_delete_file' => 'Are you sure you want to delete this file? \\n%s',
	'success_delete_file' => 'Item(s) successfully deleted.',
	'success_rename_file' => 'The directory/file %s was successfully renamed to %s.',
	
	// actions
	"actdir"		=> "Mappa",
	"actperms"		=> "Breyta a�gangsst�ringum",
	"actedit"		=> "Breyta skjali",
	"actsearchresults"	=> "Ni�urst��ur leitar",
	"actcopyitems"		=> "Afrita hlut(i)",
	"actcopyfrom"		=> "Afrita fr� /%s til /%s ",
	"actmoveitems"		=> "F�ra hlut(i)",
	"actmovefrom"		=> "F�ra fr� /%s til /%s ",
	"actlogin"		=> "Innskr�",
	"actloginheader"	=> "Innskr� til a� nota QuiXplorer",
	"actadmin"		=> "Kerfisstj�rn",
	"actchpwd"		=> "Breyta lykilor�i",
	"actusers"		=> "Notendur",
	"actarchive"		=> "Geyma hlut(i)",
	"actupload"		=> "Upphala skr�(m)",

	// misc
	"miscitems"		=> "Hlut(i)",
	"miscfree"		=> "Fr�tt",
	"miscusername"		=> "Notendanafn",
	"miscpassword"		=> "Lykilor�",
	"miscoldpass"		=> "Gamla lykilor�i�",
	"miscnewpass"		=> "N�tt lykilor�",
	"miscconfpass"		=> "Sta�festa lykilor�",
	"miscconfnewpass"	=> "Sta�festa n�tt lykilor�",
	"miscchpass"		=> "Breyta lykilor�i",
	"mischomedir"		=> "Heimasv��i",
	"mischomeurl"		=> "Sl��",
	"miscshowhidden"	=> "S�na falda hluti",
	"mischidepattern"	=> "Hylja sl��",
	"miscperms"		=> "A�gangsst�ring",
	"miscuseritems"		=> "(nafn, heimasv��i, s�na falda hluti, a�gangsst�ringar, virkur)",
	"miscadduser"		=> "B�ta vi� notenda",
	"miscedituser"		=> "breyta notanda '%s'",
	"miscactive"		=> "Virkur",
	"misclang"		=> "Tungum�l",
	"miscnoresult"		=> "Engar ni�urst��ur fengust.",
	"miscsubdirs"		=> "Leita � undirm�ppum",
	"miscpermnames"		=> array("Sko�a eing�ngu","Breyta","Breyta lykilor�i","Breyta & Breyta lykior�i",
					"Administrator"),
	"miscyesno"		=> array("J�","Nei","J","N"),
	"miscchmod"		=> array("Eigandi", "H�pur", "Almennt"),

	// from here all new by mic
	'miscowner'			=> 'Eigandi',
	'miscownerdesc'		=> '<strong>L�sing:</strong><br />Notandi (UID) /<br />H�pur (GID)<br />Leyfi:<br /><strong> %s ( %s ) </strong>/<br /><strong> %s ( %s )</strong>',

	// sysinfo (new by mic)
	'simamsysinfo'		=> $_VERSION->PRODUCT.' Uppl�singar',
	'sisysteminfo'		=> 'Kerfisuppl�singar',
	'sibuilton'			=> 'St�rikerfi',
	'sidbversion'		=> '�tg�fa gagnagrunns (MySQL)',
	'siphpversion'		=> 'PHP �tg�fa',
	'siphpupdate'		=> 'Uppl�singar: <span style="color: red;">PHP sem �� ert a� nota er <strong>ekki</strong> raunverulega!</span><br />To guarantee all functions and features of '.$_VERSION->PRODUCT.' and addons,<br />you should use as minimum <strong>PHP.Version 4.3</strong>!',
	'siwebserver'		=> 'Webserver',
	'siwebsphpif'		=> 'WebServer - PHP Interface',
	'simamboversion'	=> $_VERSION->PRODUCT.' �tg�fa',
	'siuseragent'		=> '�tg�fa Vafrara',
	'sirelevantsettings' => 'Important PHP Settings',
	'sisafemode'		=> 'Safe Mode',
	'sibasedir'			=> 'Open basedir',
	'sidisplayerrors'	=> 'PHP Errors',
	'sishortopentags'	=> 'Short Open Tags',
	'sifileuploads'		=> 'Datei Uploads',
	'simagicquotes'		=> 'Magic Quotes',
	'siregglobals'		=> 'Register Globals',
	'sioutputbuf'		=> 'Output Buffer',
	'sisesssavepath'	=> 'Session Savepath',
	'sisessautostart'	=> 'Session auto start',
	'sixmlenabled'		=> 'XML enabled',
	'sizlibenabled'		=> 'ZLIB enabled',
	'sidisabledfuncs'	=> 'Non enabled functions',
	'sieditor'			=> 'WYSIWYG Editor',
	'siconfigfile'		=> 'Config file',
	'siphpinfo'			=> 'PHP Info',
	'siphpinformation'	=> 'PHP Information',
	'sipermissions'		=> 'Permissions',
	'sidirperms'		=> 'Directory permissions',
	'sidirpermsmess'	=> 'To be shure that all functions and features of '.$_VERSION->PRODUCT.' are working correct, following folders should have permission to write [chmod 0777]',
	'sionoff'			=> array( '�', 'Af' ),
	
	'extract_warning' => "Villtu af�jappa �essari skr�? H�r?\\nA�rar skr�r g�tu veri� yfirskrifa�ar ef ekki er fari� varlega!",
	'extract_success' => "A�j�ppun t�kst",
	'extract_failure' => "Af�j�ppun mist�kst",
	
	'overwrite_files' => 'Overwrite existing file(s)?',
	"viewlink"		=> "VIEW",
	"actview"		=> "Showing source of file"
);
?>
