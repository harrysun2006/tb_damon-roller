<?php

// Íslenska fyrir joomlaXplorer ver 1.2.1 (translated by gudjon@247.is)
global $_VERSION;

$GLOBALS["charset"] = "iso-8859-1";
$GLOBALS["text_dir"] = "ltr"; // ('ltr' for left to right, 'rtl' for right to left)
$GLOBALS["date_fmt"] = "Y/m/d H:i";
$GLOBALS["error_msg"] = array(
	// error
	"error"			=> "Villa(ur)",
	"back"			=> "Bakka",

	// root
	"home"			=> "Mappa heimasvæðisins er ekki til, vinsamlegast kannaðu stillingarnar.",
	"abovehome"		=> "Þessi mappa getur ekki verið staðsett fyrir ofan heimasvæðið þitt.",
	"targetabovehome"	=> "Mappan getur ekki verið staðsett fyrir ofan heimasvæðið þitt.",

	// exist
	"direxist"		=> "Þessi mappa er ekki til.",
	//"filedoesexist"	=> "Þetta skjal er þegar til.",
	"fileexist"		=> "Þessi skrá er ekki til.",
	"itemdoesexist"		=> "Þessi hlutur er þegar til.",
	"itemexist"		=> "Þessi hlutur er ekki til.",
	"targetexist"		=> "Þessi mappa er ekki til.",
	"targetdoesexist"	=> "Þessi hlutur er þegar til.",

	// open
	"opendir"		=> "Gat ekki opnað möppuna.",
	"readdir"		=> "Gat ekki lesið möppuna.",

	// access
	"accessdir"		=> "Þú hefur ekki aðgang að þessari möppu.",
	"accessfile"		=> "Þú hefur ekki aðgang að þessari skrá.",
	"accessitem"		=> "Þú hefur ekki aðgang að þessum hlut.",
	"accessfunc"		=> "Þú hefur ekki aðgang að þessari skipun.",
	"accesstarget"		=> "Þú hefur ekki aðgang að þessari möppu.",

	// actions
	"permread"		=> "Gat ekki sótt aðgangsstýringar.",
	"permchange"		=> "Gat ekki breytt aðgangsstýringum.",
	"openfile"		=> "Gat ekki opnað skjalið.",
	"savefile"		=> "Vistun skjalsins mistókst.",
	"createfile"		=> "Gat ekki búið til skránna.",
	"createdir"		=> "Gat ekki búið til skránna.",
	"uploadfile"		=> "Gat ekki sótt skránna.",
	"copyitem"		=> "Afritun mistókst.",
	"moveitem"		=> "Ekki tókst að færa skránna.",
	"delitem"		=> "Ekki tókst að eyða skránni.",
	"chpass"		=> "Mistókst að breyta lykilorðinu.",
	"deluser"		=> "Gat ekki fjarlægt notanda.",
	"adduser"		=> "Gat ekki bætt inn notanda.",
	"saveuser"		=> "Saving user failed.",
	"searchnothing"		=> "You must supply something to search for.",

	// misc
	"miscnofunc"		=> "Virknin er ekki tiltæk.",
	"miscfilesize"		=> "Skráinn er of stór.",
	"miscfilepart"		=> "Hluti af skránni var sóttur.",
	"miscnoname"		=> "Vinsamlegast skráðu inn nafn.",
	"miscselitems"		=> "Þú hefur ekki valið neina hluti.",
	"miscdelitems"		=> "Ertu viss um að eyða þessum \"+num+\" hlut(um)?",
	"miscdeluser"		=> "Ertu viss um að vilja eyða þessum notanda '\"+user+\"'?",
	"miscnopassdiff"	=> "Nýa lykilorðið er eins.",
	"miscnopassmatch"	=> "Lykilorðin standast ekki.",
	"miscfieldmissed"	=> "Ekki voru allir reiti rétt útfylltir.",
	"miscnouserpass"	=> "Notendanafn eða lykilorð rangt.",
	"miscselfremove"	=> "Þú getur ekki fjarlægt sjáfan þig.",
	"miscuserexist"		=> "Notandi er þegar til.",
	"miscnofinduser"	=> "Finn ekki notanda.",
	"extract_noarchive" => "Skráinn er ekki þjöppuð safnskrá.",
	"extract_unknowntype" => "Óþekkt safnskrá"
);
$GLOBALS["messages"] = array(
	// links
	"permlink"		=> "BREYTA AÐGANGSSTÝRINGUM",
	"editlink"		=> "BREYTA",
	"downlink"		=> "NIÐURHALA",
	"uplink"		=> "UPP",
	"homelink"		=> "HEIM",
	"reloadlink"		=> "ENDURHLAÐA",
	"copylink"		=> "AFRITA",
	"movelink"		=> "FÆRA",
	"dellink"		=> "EYÐA",
	"comprlink"		=> "GEYMA",
	"adminlink"		=> "ADMIN",
	"logoutlink"		=> "ÚTSKRÁ",
	"uploadlink"		=> "UPPHALA",
	"searchlink"		=> "LEIT",
	"extractlink"	=> "Afþjappa",
	'chmodlink'		=> 'Breyta (chmod) Aðgangsstýringum (möppu/skrá(a))', // new mic
	'mossysinfolink'	=> $_VERSION->PRODUCT.' upplýsingar ('.$_VERSION->PRODUCT.', Server, PHP, mySQL)', // new mic
	'logolink'		=> 'Fara á heimasíðu joomlaXplorer (new window)', // new mic

	// list
	"nameheader"		=> "Nafn",
	"sizeheader"		=> "Stærð",
	"typeheader"		=> "Gerð",
	"modifheader"		=> "Breytt",
	"permheader"		=> "Aðgangur",
	"actionheader"		=> "Aðgerðir",
	"pathheader"		=> "Slóð",

	// buttons
	"btncancel"		=> "Hætta",
	"btnsave"		=> "Vista",
	"btnchange"		=> "Breyta",
	"btnreset"		=> "Endurstilla",
	"btnclose"		=> "Loka",
	"btncreate"		=> "Búa til",
	"btnsearch"		=> "Leita",
	"btnupload"		=> "Upphala",
	"btncopy"		=> "Afrita",
	"btnmove"		=> "Færa",
	"btnlogin"		=> "Innskrá",
	"btnlogout"		=> "Útskrá",
	"btnadd"		=> "Bæta inn",
	"btnedit"		=> "Breyta",
	"btnremove"		=> "Taka út",

	// user messages, new in joomlaXplorer 1.3.0
	'renamelink'	=> 'RENAME',
	'confirm_delete_file' => 'Are you sure you want to delete this file? \\n%s',
	'success_delete_file' => 'Item(s) successfully deleted.',
	'success_rename_file' => 'The directory/file %s was successfully renamed to %s.',
	
	// actions
	"actdir"		=> "Mappa",
	"actperms"		=> "Breyta aðgangsstýringum",
	"actedit"		=> "Breyta skjali",
	"actsearchresults"	=> "Niðurstöður leitar",
	"actcopyitems"		=> "Afrita hlut(i)",
	"actcopyfrom"		=> "Afrita frá /%s til /%s ",
	"actmoveitems"		=> "Færa hlut(i)",
	"actmovefrom"		=> "Færa frá /%s til /%s ",
	"actlogin"		=> "Innskrá",
	"actloginheader"	=> "Innskrá til að nota QuiXplorer",
	"actadmin"		=> "Kerfisstjórn",
	"actchpwd"		=> "Breyta lykilorði",
	"actusers"		=> "Notendur",
	"actarchive"		=> "Geyma hlut(i)",
	"actupload"		=> "Upphala skrá(m)",

	// misc
	"miscitems"		=> "Hlut(i)",
	"miscfree"		=> "Frítt",
	"miscusername"		=> "Notendanafn",
	"miscpassword"		=> "Lykilorð",
	"miscoldpass"		=> "Gamla lykilorðið",
	"miscnewpass"		=> "Nýtt lykilorð",
	"miscconfpass"		=> "Staðfesta lykilorð",
	"miscconfnewpass"	=> "Staðfesta nýtt lykilorð",
	"miscchpass"		=> "Breyta lykilorði",
	"mischomedir"		=> "Heimasvæði",
	"mischomeurl"		=> "Slóð",
	"miscshowhidden"	=> "Sýna falda hluti",
	"mischidepattern"	=> "Hylja slóð",
	"miscperms"		=> "Aðgangsstýring",
	"miscuseritems"		=> "(nafn, heimasvæði, sýna falda hluti, aðgangsstýringar, virkur)",
	"miscadduser"		=> "Bæta við notenda",
	"miscedituser"		=> "breyta notanda '%s'",
	"miscactive"		=> "Virkur",
	"misclang"		=> "Tungumál",
	"miscnoresult"		=> "Engar niðurstöður fengust.",
	"miscsubdirs"		=> "Leita í undirmöppum",
	"miscpermnames"		=> array("Skoða eingöngu","Breyta","Breyta lykilorði","Breyta & Breyta lykiorði",
					"Administrator"),
	"miscyesno"		=> array("Já","Nei","J","N"),
	"miscchmod"		=> array("Eigandi", "Hópur", "Almennt"),

	// from here all new by mic
	'miscowner'			=> 'Eigandi',
	'miscownerdesc'		=> '<strong>Lýsing:</strong><br />Notandi (UID) /<br />Hópur (GID)<br />Leyfi:<br /><strong> %s ( %s ) </strong>/<br /><strong> %s ( %s )</strong>',

	// sysinfo (new by mic)
	'simamsysinfo'		=> $_VERSION->PRODUCT.' Upplýsingar',
	'sisysteminfo'		=> 'Kerfisupplýsingar',
	'sibuilton'			=> 'Stýrikerfi',
	'sidbversion'		=> 'Útgáfa gagnagrunns (MySQL)',
	'siphpversion'		=> 'PHP útgáfa',
	'siphpupdate'		=> 'Upplýsingar: <span style="color: red;">PHP sem þú ert að nota er <strong>ekki</strong> raunverulega!</span><br />To guarantee all functions and features of '.$_VERSION->PRODUCT.' and addons,<br />you should use as minimum <strong>PHP.Version 4.3</strong>!',
	'siwebserver'		=> 'Webserver',
	'siwebsphpif'		=> 'WebServer - PHP Interface',
	'simamboversion'	=> $_VERSION->PRODUCT.' útgáfa',
	'siuseragent'		=> 'Útgáfa Vafrara',
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
	'sionoff'			=> array( 'Á', 'Af' ),
	
	'extract_warning' => "Villtu afþjappa þessari skrá? Hér?\\nAðrar skrár gætu verið yfirskrifaðar ef ekki er farið varlega!",
	'extract_success' => "Aþjöppun tókst",
	'extract_failure' => "Afþjöppun mistókst",
	
	'overwrite_files' => 'Overwrite existing file(s)?',
	"viewlink"		=> "VIEW",
	"actview"		=> "Showing source of file"
);
?>
