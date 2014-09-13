<?php

// Hungarian Language Module for v2.3 (translated by Jozsef Tamas Herczeg)
global $_VERSION;

$GLOBALS["charset"] = "iso-8859-2";
$GLOBALS["text_dir"] = "ltr"; // ('ltr' for left to right, 'rtl' for right to left)
$GLOBALS["date_fmt"] = "Y.m.d. H:i";
$GLOBALS["error_msg"] = array(
	// error
	"error"			=> "HIB�(K)",
	"back"			=> "Vissza",
	
	// root
	"home"			=> "Nem l�tezik a kiindul�si k�nyvt�r, ellen�rizd a be�ll�t�sokat.",
	"abovehome"		=> "A jelenlegi k�nyvt�r nem lehet f�ljebb a kiindul�s mapp�n�l.",
	"targetabovehome"	=> "A c�lk�nyvt�r nem lehet f�ljebb a kiindul�si mapp�n�l.",
	
	// exist
	"direxist"		=> "Ez a k�nyvt�r nem l�tezik.",
	//"filedoesexist"	=> "Ez a f�jl m�r l�tezik.",
	"fileexist"		=> "Ez a f�jl nem l�tezik.",
	"itemdoesexist"		=> "Ez az elem m�r l�tezik.",
	"itemexist"		=> "Ez az elem nem l�tezik.",
	"targetexist"		=> "A c�lk�nyvt�r nem l�tezik.",
	"targetdoesexist"	=> "A c�lelem m�r l�tezik.",
	
	// open
	"opendir"		=> "Nem nyithat� meg a k�nyvt�r.",
	"readdir"		=> "Nem olvashat� a k�nyvt�r.",
	
	// access
	"accessdir"		=> "Nem enged�lyezett a sz�modra az ehhez a k�nyvt�rhoz val� hozz�f�r�s.",
	"accessfile"		=> "Nem enged�lyezett a sz�modra az ehhez a f�jlhoz val� hozz�f�r�s.",
	"accessitem"		=> "Nem enged�lyezett a sz�modra az ehhez az elemhez val� hozz�f�r�s.",
	"accessfunc"		=> "Ennek a funkci�nak a haszn�lata nem enged�lyezett a sz�modra.",
	"accesstarget"		=> "Nem enged�lyezett a c�lk�nyvt�rhoz val� hozz�f�r�s.",
	
	// actions
	"permread"		=> "Az enged�lyek lek�r�se nem siker�lt.",
	"permchange"		=> "Az enged�lym�dos�t�s nem siker�lt.",
	"openfile"		=> "Nem lehet megnyitni a f�jlt.",
	"savefile"		=> "Nem lehet menteni a f�jlt.",
	"createfile"		=> "Nem lehet l�trehozni a f�jlt.",
	"createdir"		=> "Nem lehet l�trehozni a k�nyvt�rt.",
	"uploadfile"		=> "A f�jl felt�lt�se nem siker�lt.",
	"copyitem"		=> "A m�sol�s nem siker�lt.",
	"moveitem"		=> "Az �thelyez�s nem siker�lt.",
	"delitem"		=> "A t�rl�s nem siker�lt.",
	"chpass"		=> "Nem siker�lt megv�ltoztatni a jelsz�t.",
	"deluser"		=> "A felhaszn�l� elt�vol�t�sa nem siker�lt.",
	"adduser"		=> "A felhaszn�l� hozz�ad�sa nem siker�lt.",
	"saveuser"		=> "A felhaszn�l� ment�se nem siker�lt.",
	"searchnothing"		=> "Meg kell adnod a keresend� kulcssz�t.",
	
	// misc
	"miscnofunc"		=> "Nem m�k�dik ez a funkci�.",
	"miscfilesize"		=> "A f�jl m�rete nagyobb a megengedettn�l.",
	"miscfilepart"		=> "Csak r�szben siker�lt felt�lteni a f�jlt.",
	"miscnoname"		=> "Meg kell adnod egy nevet.",
	"miscselitems"		=> "Nem v�lasztott�l ki egy elemet sem.",
	"miscdelitems"		=> "Biztosan t�r�lni akarod ezt a(z) \"+num+\" elemet?",
	"miscdeluser"		=> "Biztosan t�r�lni akarod a k�vetkez� felhaszn�l�t: '\"+user+\"'?",
	"miscnopassdiff"	=> "Az �j jelsz� ugyanaz, mint a jelenlegi.",
	"miscnopassmatch"	=> "Elt�r�ek a jelszavak.",
	"miscfieldmissed"	=> "Kihagyt�l egy fontos mez�t.",
	"miscnouserpass"	=> "�rv�nytelen a felhaszn�l�n�v vagy a jelsz�.",
	"miscselfremove"	=> "Saj�t magadat nem t�vol�thatod el.",
	"miscuserexist"		=> "A felhaszn�l� m�r l�tezik.",
	"miscnofinduser"	=> "Nem tal�lhat� a felhaszn�l�.",
	"extract_noarchive" => "A f�jl nem kibonthat� arch�vum.",
	"extract_unknowntype" => "Ismeretlen t�pus� arch�vum"
);
$GLOBALS["messages"] = array(
	// links
	"permlink"		=> "ENGED�LYEK M�DOS�T�SA",
	"editlink"		=> "SZERKESZT�S",
	"downlink"		=> "LET�LT�S",
	"uplink"		=> "FEL",
	"homelink"		=> "KIINDUL�SI K�NYVT�R",
	"reloadlink"		=> "FRISS�T�S",
	"copylink"		=> "M�SOL�S",
	"movelink"		=> "�THELYEZ�S",
	"dellink"		=> "T�RL�S",
	"comprlink"		=> "ARCHIV�L�S",
	"adminlink"		=> "ADMIN",
	"logoutlink"		=> "KIL�P�S",
	"uploadlink"		=> "FELT�LT�S",
	"searchlink"		=> "KERES�S",
	"extractlink"	=> "Arch�vum kibont�sa",
	'chmodlink'		=> 'Enged�lyek m�dos�t�sa (chmod) (Mappa/F�jl(ok))', // new mic
	'mossysinfolink'	=> 'Mambo rendszerinform�ci� (Mambo, kiszolg�l�, PHP, mySQL)', // new mic
	'logolink'		=> 'Ugr�s a mamboXplorer webhely�re (�j ablak)', // new mic
	
	// list
	"nameheader"		=> "N�v",
	"sizeheader"		=> "M�ret",
	"typeheader"		=> "T�pus",
	"modifheader"		=> "M�dos�tva",
	"permheader"		=> "Enged�lyek",
	"actionheader"		=> "M�veletek",
	"pathheader"		=> "�tvonal",
	
	// buttons
	"btncancel"		=> "M�gse",
	"btnsave"		=> "Ment�s",
	"btnchange"		=> "M�dos�t�s",
	"btnreset"		=> "Alaphelyzet",
	"btnclose"		=> "Bez�r�s",
	"btncreate"		=> "L�trehoz�s",
	"btnsearch"		=> "Keres�s",
	"btnupload"		=> "Felt�lt�s",
	"btncopy"		=> "M�sol�s",
	"btnmove"		=> "�thelyez�s",
	"btnlogin"		=> "Bejelentkez�s",
	"btnlogout"		=> "Kijelentkez�s",
	"btnadd"		=> "Hozz�ad�s",
	"btnedit"		=> "Szerkeszt�s",
	"btnremove"		=> "�thelyez�s",
	
	// user messages, new in joomlaXplorer 1.3.0
	'renamelink'	=> '�TNEVEZ�S',
	'confirm_delete_file' => 'Biztosan t�r�lni akarod ezt a f�jlt? \\n%s',
	'success_delete_file' => 'elem t�rl�se siker�lt.',
	'success_rename_file' => 'A(z) %s k�nyvt�r/f�jl �tnevez�se %s n�vre siker�lt.',
	
	// actions
	"actdir"		=> "K�nyvt�r",
	"actperms"		=> "Enged�lyek m�dos�t�sa",
	"actedit"		=> "F�jl szerkeszt�se",
	"actsearchresults"	=> "A keres�s eredm�nye",
	"actcopyitems"		=> "Elem(ek) m�sol�sa",
	"actcopyfrom"		=> "M�sol�s a(z) /%s mapp�b�l a(z) /%s mapp�ba ",
	"actmoveitems"		=> "Elem(ek) �thelyez�se",
	"actmovefrom"		=> "�thelyez�s a(z) /%s mapp�b�l a(z) /%s mapp�ba ",
	"actlogin"		=> "Bejelentkez�s",
	"actloginheader"	=> "Bejelentkez�s a QuiXplorer haszn�lat�ra",
	"actadmin"		=> "Adminisztr�l�s",
	"actchpwd"		=> "A jelsz� megv�ltoztat�sa",
	"actusers"		=> "Felhaszn�l�k",
	"actarchive"		=> "Elem(ek) archiv�l�sa",
	"actupload"		=> "F�jl(ok) felt�lt�se",
	
	// misc
	"miscitems"		=> "elem",
	"miscfree"		=> "Szabad ter�let",
	"miscusername"		=> "Felhaszn�l�n�v",
	"miscpassword"		=> "Jelsz�",
	"miscoldpass"		=> "A r�gi jelsz�",
	"miscnewpass"		=> "Az �j jelsz�",
	"miscconfpass"		=> "A jelsz� meger�s�t�se",
	"miscconfnewpass"	=> "Az �j jelsz� meger�s�t�se",
	"miscchpass"		=> "Jelsz�csere",
	"mischomedir"		=> "Kiindul�si k�nyvt�r",
	"mischomeurl"		=> "Kezd� URL",
	"miscshowhidden"	=> "A rejtett elemek l�that�k",
	"mischidepattern"	=> "Minta elrejt�se",
	"miscperms"		=> "Enged�lyek",
	"miscuseritems"		=> "(n�v, kiindul�si k�nyvt�r, rejtett elemek megjelen�t�se, enged�lyek, akt�v)",
	"miscadduser"		=> "�j felhaszn�l�",
	"miscedituser"		=> "'%s' felhaszn�l� m�dos�t�sa",
	"miscactive"		=> "Akt�v",
	"misclang"		=> "Nyelv",
	"miscnoresult"		=> "A keres�s eredm�nytelen.",
	"miscsubdirs"		=> "Keres�s az alk�nyvt�rakban",
	"miscpermnames"		=> array("Csak n�zet","M�dos�t�s","Jelsz�csere","M�dos�t�s �s jelsz�csere",
					"Adminisztr�tor"),
	"miscyesno"		=> array("Igen","Nem","I","N"),
	"miscchmod"		=> array("Tulajdonos", "Csoport", "K�z�ns�g"),

	// from here all new by mic
	'miscowner'			=> 'Tulajdonos',
	'miscownerdesc'		=> '<strong>Le�r�s:</strong><br />Felhaszn�l� (UID) /<br />Csoport (GID)<br />Jelenlegi enged�lyek:<br /><strong> %s ( %s ) </strong>/<br /><strong> %s ( %s )</strong>',

	// sysinfo (new by mic)
	'simamsysinfo'		=> 'Mambo rendszerinform�ci�',
	'sisysteminfo'		=> 'Rendszer',
	'sibuilton'			=> 'Oper�ci�s rendszer',
	'sidbversion'		=> 'Adatb�zis verzi�sz�ma (MySQL)',
	'siphpversion'		=> 'PHP verzi�sz�ma',
	'siphpupdate'		=> 'INFORM�CI�: <span style="color: red;">Az �ltalad haszn�lt PHP verzi� <strong>elavult</strong>!</span><br />A Mambo �s kieg�sz�t�i valamennyi funkci�inak �s szolg�ltat�sainak biztos�t�s�hoz<br />legal�bb <strong>PHP 4.3-as verzi�t</strong> kell haszn�lnod!',
	'siwebserver'		=> 'Webkiszolg�l�',
	'siwebsphpif'		=> 'Webkiszolg�l� - PHP fel�let',
	'simamboversion'	=> 'Mambo verzi�sz�ma',
	'siuseragent'		=> 'B�ng�sz� verzi�sz�ma',
	'sirelevantsettings' => 'Fontos PHP be�ll�t�sok',
	'sisafemode'		=> 'Biztons�gos m�d',
	'sibasedir'			=> 'Open basedir',
	'sidisplayerrors'	=> 'PHP hib�k',
	'sishortopentags'	=> 'Short Open Tags',
	'sifileuploads'		=> 'F�jlfelt�lt�s',
	'simagicquotes'		=> 'M�gikus id�z�jelek',
	'siregglobals'		=> 'Register Globals',
	'sioutputbuf'		=> 'Kimeneti puffer',
	'sisesssavepath'	=> 'Munkamenet ment�si �tvonal',
	'sisessautostart'	=> 'Munkamenet automatikus ind�t�sa',
	'sixmlenabled'		=> 'XML enged�lyezett',
	'sizlibenabled'		=> 'ZLIB enged�lyezett',
	'sidisabledfuncs'	=> 'Nem enged�lyezett funkci�k',
	'sieditor'			=> 'WYSIWYG szerkeszt�',
	'siconfigfile'		=> 'Konfigur�ci�s f�jl',
	'siphpinfo'			=> 'PHP',
	'siphpinformation'	=> 'PHP tulajdons�gai',
	'sipermissions'		=> 'Enged�lyek',
	'sidirperms'		=> 'K�nyvt�renged�lyek',
	'sidirpermsmess'	=> 'Ha azt akarod, hogy a Mambo �sszes funkci�ja �s szolg�ltat�sa megfelel�en m�k�dj�n, akkor �rhat�v� kell tenned a k�vetkez� mapp�kat [chmod 0777]',
	'sionoff'			=> array( 'Be', 'Ki' ),
	
	'extract_warning' => "Val�ban ki akarod bontani ezt a f�jlt? Ide?\\nFel�lfogja �rni a l�tez� f�jlokat, ha nem k�r�ltekint�en haszn�lod!",
	'extract_success' => "A kibont�s siker�lt",
	'extract_failure' => "A kibont�s nem siker�lt",
	
	'overwrite_files' => 'Overwrite existing file(s)?',
	"viewlink"		=> "VIEW",
	"actview"		=> "Showing source of file"
);
?>
