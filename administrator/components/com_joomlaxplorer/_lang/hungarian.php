<?php

// Hungarian Language Module for v2.3 (translated by Jozsef Tamas Herczeg)
global $_VERSION;

$GLOBALS["charset"] = "iso-8859-2";
$GLOBALS["text_dir"] = "ltr"; // ('ltr' for left to right, 'rtl' for right to left)
$GLOBALS["date_fmt"] = "Y.m.d. H:i";
$GLOBALS["error_msg"] = array(
	// error
	"error"			=> "HIBÁ(K)",
	"back"			=> "Vissza",
	
	// root
	"home"			=> "Nem létezik a kiindulási könyvtár, ellenõrizd a beállításokat.",
	"abovehome"		=> "A jelenlegi könyvtár nem lehet följebb a kiindulás mappánál.",
	"targetabovehome"	=> "A célkönyvtár nem lehet följebb a kiindulási mappánál.",
	
	// exist
	"direxist"		=> "Ez a könyvtár nem létezik.",
	//"filedoesexist"	=> "Ez a fájl már létezik.",
	"fileexist"		=> "Ez a fájl nem létezik.",
	"itemdoesexist"		=> "Ez az elem már létezik.",
	"itemexist"		=> "Ez az elem nem létezik.",
	"targetexist"		=> "A célkönyvtár nem létezik.",
	"targetdoesexist"	=> "A célelem már létezik.",
	
	// open
	"opendir"		=> "Nem nyitható meg a könyvtár.",
	"readdir"		=> "Nem olvasható a könyvtár.",
	
	// access
	"accessdir"		=> "Nem engedélyezett a számodra az ehhez a könyvtárhoz való hozzáférés.",
	"accessfile"		=> "Nem engedélyezett a számodra az ehhez a fájlhoz való hozzáférés.",
	"accessitem"		=> "Nem engedélyezett a számodra az ehhez az elemhez való hozzáférés.",
	"accessfunc"		=> "Ennek a funkciónak a használata nem engedélyezett a számodra.",
	"accesstarget"		=> "Nem engedélyezett a célkönyvtárhoz való hozzáférés.",
	
	// actions
	"permread"		=> "Az engedélyek lekérése nem sikerült.",
	"permchange"		=> "Az engedélymódosítás nem sikerült.",
	"openfile"		=> "Nem lehet megnyitni a fájlt.",
	"savefile"		=> "Nem lehet menteni a fájlt.",
	"createfile"		=> "Nem lehet létrehozni a fájlt.",
	"createdir"		=> "Nem lehet létrehozni a könyvtárt.",
	"uploadfile"		=> "A fájl feltöltése nem sikerült.",
	"copyitem"		=> "A másolás nem sikerült.",
	"moveitem"		=> "Az áthelyezés nem sikerült.",
	"delitem"		=> "A törlés nem sikerült.",
	"chpass"		=> "Nem sikerült megváltoztatni a jelszót.",
	"deluser"		=> "A felhasználó eltávolítása nem sikerült.",
	"adduser"		=> "A felhasználó hozzáadása nem sikerült.",
	"saveuser"		=> "A felhasználó mentése nem sikerült.",
	"searchnothing"		=> "Meg kell adnod a keresendõ kulcsszót.",
	
	// misc
	"miscnofunc"		=> "Nem mûködik ez a funkció.",
	"miscfilesize"		=> "A fájl mérete nagyobb a megengedettnél.",
	"miscfilepart"		=> "Csak részben sikerült feltölteni a fájlt.",
	"miscnoname"		=> "Meg kell adnod egy nevet.",
	"miscselitems"		=> "Nem választottál ki egy elemet sem.",
	"miscdelitems"		=> "Biztosan törölni akarod ezt a(z) \"+num+\" elemet?",
	"miscdeluser"		=> "Biztosan törölni akarod a következõ felhasználót: '\"+user+\"'?",
	"miscnopassdiff"	=> "Az új jelszó ugyanaz, mint a jelenlegi.",
	"miscnopassmatch"	=> "Eltérõek a jelszavak.",
	"miscfieldmissed"	=> "Kihagytál egy fontos mezõt.",
	"miscnouserpass"	=> "Érvénytelen a felhasználónév vagy a jelszó.",
	"miscselfremove"	=> "Saját magadat nem távolíthatod el.",
	"miscuserexist"		=> "A felhasználó már létezik.",
	"miscnofinduser"	=> "Nem található a felhasználó.",
	"extract_noarchive" => "A fûjl nem kibontható archívum.",
	"extract_unknowntype" => "Ismeretlen típusú archívum"
);
$GLOBALS["messages"] = array(
	// links
	"permlink"		=> "ENGEDÉLYEK MÓDOSÍTÁSA",
	"editlink"		=> "SZERKESZTÉS",
	"downlink"		=> "LETÖLTÉS",
	"uplink"		=> "FEL",
	"homelink"		=> "KIINDULÁSI KÖNYVTÁR",
	"reloadlink"		=> "FRISSÍTÉS",
	"copylink"		=> "MÁSOLÁS",
	"movelink"		=> "ÁTHELYEZÉS",
	"dellink"		=> "TÖRLÉS",
	"comprlink"		=> "ARCHIVÁLÁS",
	"adminlink"		=> "ADMIN",
	"logoutlink"		=> "KILÉPÉS",
	"uploadlink"		=> "FELTÖLTÉS",
	"searchlink"		=> "KERESÉS",
	"extractlink"	=> "Archívum kibontása",
	'chmodlink'		=> 'Engedélyek módosítása (chmod) (Mappa/Fájl(ok))', // new mic
	'mossysinfolink'	=> 'Mambo rendszerinformáció (Mambo, kiszolgáló, PHP, mySQL)', // new mic
	'logolink'		=> 'Ugrás a mamboXplorer webhelyére (új ablak)', // new mic
	
	// list
	"nameheader"		=> "Név",
	"sizeheader"		=> "Méret",
	"typeheader"		=> "Típus",
	"modifheader"		=> "Módosítva",
	"permheader"		=> "Engedélyek",
	"actionheader"		=> "Mûveletek",
	"pathheader"		=> "Útvonal",
	
	// buttons
	"btncancel"		=> "Mégse",
	"btnsave"		=> "Mentés",
	"btnchange"		=> "Módosítás",
	"btnreset"		=> "Alaphelyzet",
	"btnclose"		=> "Bezárás",
	"btncreate"		=> "Létrehozás",
	"btnsearch"		=> "Keresés",
	"btnupload"		=> "Feltöltés",
	"btncopy"		=> "Másolás",
	"btnmove"		=> "Áthelyezés",
	"btnlogin"		=> "Bejelentkezés",
	"btnlogout"		=> "Kijelentkezés",
	"btnadd"		=> "Hozzáadás",
	"btnedit"		=> "Szerkesztés",
	"btnremove"		=> "Áthelyezés",
	
	// user messages, new in joomlaXplorer 1.3.0
	'renamelink'	=> 'ÁTNEVEZÉS',
	'confirm_delete_file' => 'Biztosan törölni akarod ezt a fájlt? \\n%s',
	'success_delete_file' => 'elem törlése sikerült.',
	'success_rename_file' => 'A(z) %s könyvtár/fájl átnevezése %s névre sikerült.',
	
	// actions
	"actdir"		=> "Könyvtár",
	"actperms"		=> "Engedélyek módosítása",
	"actedit"		=> "Fájl szerkesztése",
	"actsearchresults"	=> "A keresés eredménye",
	"actcopyitems"		=> "Elem(ek) másolása",
	"actcopyfrom"		=> "Másolás a(z) /%s mappából a(z) /%s mappába ",
	"actmoveitems"		=> "Elem(ek) áthelyezése",
	"actmovefrom"		=> "Áthelyezés a(z) /%s mappából a(z) /%s mappába ",
	"actlogin"		=> "Bejelentkezés",
	"actloginheader"	=> "Bejelentkezés a QuiXplorer használatára",
	"actadmin"		=> "Adminisztrálás",
	"actchpwd"		=> "A jelszó megváltoztatása",
	"actusers"		=> "Felhasználók",
	"actarchive"		=> "Elem(ek) archiválása",
	"actupload"		=> "Fájl(ok) feltöltése",
	
	// misc
	"miscitems"		=> "elem",
	"miscfree"		=> "Szabad terület",
	"miscusername"		=> "Felhasználónév",
	"miscpassword"		=> "Jelszó",
	"miscoldpass"		=> "A régi jelszó",
	"miscnewpass"		=> "Az új jelszó",
	"miscconfpass"		=> "A jelszó megerõsítése",
	"miscconfnewpass"	=> "Az új jelszó megerõsítése",
	"miscchpass"		=> "Jelszócsere",
	"mischomedir"		=> "Kiindulási könyvtár",
	"mischomeurl"		=> "Kezdõ URL",
	"miscshowhidden"	=> "A rejtett elemek láthatók",
	"mischidepattern"	=> "Minta elrejtése",
	"miscperms"		=> "Engedélyek",
	"miscuseritems"		=> "(név, kiindulási könyvtár, rejtett elemek megjelenítése, engedélyek, aktív)",
	"miscadduser"		=> "új felhasználó",
	"miscedituser"		=> "'%s' felhasználó módosítása",
	"miscactive"		=> "Aktív",
	"misclang"		=> "Nyelv",
	"miscnoresult"		=> "A keresés eredménytelen.",
	"miscsubdirs"		=> "Keresés az alkönyvtárakban",
	"miscpermnames"		=> array("Csak nézet","Módosítás","Jelszócsere","Módosítás és jelszócsere",
					"Adminisztrátor"),
	"miscyesno"		=> array("Igen","Nem","I","N"),
	"miscchmod"		=> array("Tulajdonos", "Csoport", "Közönség"),

	// from here all new by mic
	'miscowner'			=> 'Tulajdonos',
	'miscownerdesc'		=> '<strong>Leírás:</strong><br />Felhasználó (UID) /<br />Csoport (GID)<br />Jelenlegi engedélyek:<br /><strong> %s ( %s ) </strong>/<br /><strong> %s ( %s )</strong>',

	// sysinfo (new by mic)
	'simamsysinfo'		=> 'Mambo rendszerinformáció',
	'sisysteminfo'		=> 'Rendszer',
	'sibuilton'			=> 'Operációs rendszer',
	'sidbversion'		=> 'Adatbázis verziószáma (MySQL)',
	'siphpversion'		=> 'PHP verziószáma',
	'siphpupdate'		=> 'INFORMÁCIÓ: <span style="color: red;">Az általad használt PHP verzió <strong>elavult</strong>!</span><br />A Mambo és kiegészítõi valamennyi funkcióinak és szolgáltatásainak biztosításához<br />legalább <strong>PHP 4.3-as verziót</strong> kell használnod!',
	'siwebserver'		=> 'Webkiszolgáló',
	'siwebsphpif'		=> 'Webkiszolgáló - PHP felület',
	'simamboversion'	=> 'Mambo verziószáma',
	'siuseragent'		=> 'Böngészõ verziószáma',
	'sirelevantsettings' => 'Fontos PHP beállítások',
	'sisafemode'		=> 'Biztonságos mód',
	'sibasedir'			=> 'Open basedir',
	'sidisplayerrors'	=> 'PHP hibák',
	'sishortopentags'	=> 'Short Open Tags',
	'sifileuploads'		=> 'Fájlfeltöltés',
	'simagicquotes'		=> 'Mágikus idézõjelek',
	'siregglobals'		=> 'Register Globals',
	'sioutputbuf'		=> 'Kimeneti puffer',
	'sisesssavepath'	=> 'Munkamenet mentési útvonal',
	'sisessautostart'	=> 'Munkamenet automatikus indítása',
	'sixmlenabled'		=> 'XML engedélyezett',
	'sizlibenabled'		=> 'ZLIB engedélyezett',
	'sidisabledfuncs'	=> 'Nem engedélyezett funkciók',
	'sieditor'			=> 'WYSIWYG szerkesztõ',
	'siconfigfile'		=> 'Konfigurációs fájl',
	'siphpinfo'			=> 'PHP',
	'siphpinformation'	=> 'PHP tulajdonságai',
	'sipermissions'		=> 'Engedélyek',
	'sidirperms'		=> 'Könyvtárengedélyek',
	'sidirpermsmess'	=> 'Ha azt akarod, hogy a Mambo összes funkciója és szolgáltatása megfelelõen mûködjön, akkor írhatóvá kell tenned a következõ mappákat [chmod 0777]',
	'sionoff'			=> array( 'Be', 'Ki' ),
	
	'extract_warning' => "Valóban ki akarod bontani ezt a fájlt? Ide?\\nFelülfogja írni a létezõ fájlokat, ha nem körültekintõen használod!",
	'extract_success' => "A kibontás sikerült",
	'extract_failure' => "A kibontás nem sikerült",
	
	'overwrite_files' => 'Overwrite existing file(s)?',
	"viewlink"		=> "VIEW",
	"actview"		=> "Showing source of file"
);
?>
