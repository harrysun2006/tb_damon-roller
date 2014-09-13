<?php
// Finnish Language Module for joomlaXplorer (translated by Jarmo Keränen)
// modifications and translation of new strings by Markku Suominen 10.11.2005
// Finnish Joomla translation team, http://www.joomlaportal.fi, admin@joomlaportal.fi
global $_VERSION;

$GLOBALS["charset"] = "iso-8859-1";
$GLOBALS["text_dir"] = "ltr"; // ('ltr' for left to right, 'rtl' for right to left)
$GLOBALS["date_fmt"] = "m.d.y H:i";
$GLOBALS["error_msg"] = array(
	// error
	"error"			=> "VIRHE(ET)",
	"back"			=> "Palaa",
	
	// root
	"home"			=> "Kotihakemistoa ei ole, tarkista asetuksesi.",
	"abovehome"		=> "Nykyinen hakemisto ei saa olla kotihakemiston yläpuolella.",
	"targetabovehome"	=> "Kohdehakemisto ei saa olla kotihakemiston yläpuolella.",
	
	// exist
	"direxist"		=> "Hakemistoa ei ole.",
	//"filedoesexist"	=> "This file already exists.",
	"fileexist"		=> "Tiedostoa ei ole.",
	"itemdoesexist"		=> "Nimike on jo olemassa.",
	"itemexist"		=> "Nimike ei ole olemassa.",
	"targetexist"		=> "Kohdehakemistoa ei ole.",
	"targetdoesexist"	=> "Kohdenimike on jo olemassa.",
	
	// open
	"opendir"		=> "Hakemistoa ei voi avata.",
	"readdir"		=> "Hakemistoa ei voi lukea.",
	
	// access
	"accessdir"		=> "Sinulla ei ole valtuuksia tähän hakemistoon.",
	"accessfile"		=> "Sinulla ei ole valtuuksia tähän tiedostoon.",
	"accessitem"		=> "Sinulla ei ole valtuuksia tähän nimikkeeseen.",
	"accessfunc"		=> "Sinulla ei ole valtuuksia tähän toimintoon.",
	"accesstarget"		=> "Sinulla ei ole valtuuksia kohdehakemistoon.",
	
	// actions
	"permread"		=> "Käyttöoikeuksien luku epäonnistui.",
	"permchange"		=> "Käyttöoikeuksien muutos epäonnistui.",
	"openfile"		=> "Tiedoston avaaminen epäonnistui.",
	"savefile"		=> "Tiedoston tallennus epäonnistui.",
	"createfile"		=> "Tiedoston luonti epäonnistui.",
	"createdir"		=> "Hakemiston luonti epäonnistui.",
	"uploadfile"		=> "Tiedoston vienti palvelimelle epäonnistui.",
	"copyitem"		=> "Kopiointi epäonnistui.",
	"moveitem"		=> "Siirto epäonnistui.",
	"delitem"		=> "Poisto epäonnistui.",
	"chpass"		=> "Salasanan vaihto epäonnistui.",
	"deluser"		=> "Käyttäjän poisto epäonnistui.",
	"adduser"		=> "Käyttäjän lisäys epäonnistui.",
	"saveuser"		=> "Käyttäjän tallennus epäonnistui.",
	"searchnothing"		=> "Sinun pitää antaa jotain etsittävää.",
	
	// misc
	"miscnofunc"		=> "Toiminto ei ole käytettävissä.",
	"miscfilesize"		=> "Tiedosto koko ylittää suurimman sallitun arvon.",
	"miscfilepart"		=> "Tiedoston vienti palvelimelle onnistui vain osittain.",
	"miscnoname"		=> "Anna nimi.",
	"miscselitems"		=> "Et ole valinnut yhtään nimikettä.",
	"miscdelitems"		=> "Haluatko varmasti poistaa nämä \"+num+\" nimikettä?",
	"miscdeluser"		=> "Haluatko varmasti poistaa käyttäjän '\"+user+\"'?",
	"miscnopassdiff"	=> "Uusi salasana ei eroa nykyisestä.",
	"miscnopassmatch"	=> "Salasanat eivät täsmää.",
	"miscfieldmissed"	=> "Ohitit tärkeän kentän.",
	"miscnouserpass"	=> "Käyttäjänimi tai salasana on väärä.",
	"miscselfremove"	=> "Et voi poistaa omaa tunnustasi.",
	"miscuserexist"		=> "Käyttäjä on jo olemassa.",
	"miscnofinduser"	=> "Käyttäjää ei löydy.",
	"extract_noarchive" => "Tiedoston tyyppi ei ole sellainen joka voidaan purkaa.",
	"extract_unknowntype" => "Tuntematon arkistointimuoto"
);
$GLOBALS["messages"] = array(
	// links
	"permlink"		=> "MUUTA OIKEUKSIA",
	"editlink"		=> "MUOKKAA",
	"downlink"		=> "LATAA",
	"uplink"		=> "YLÖS",
	"homelink"		=> "KOTI",
	"reloadlink"		=> "PÄIVITÄ",
	"copylink"		=> "KOPIOI",
	"movelink"		=> "SIIRRÄ",
	"dellink"		=> "POISTA",
	"comprlink"		=> "ARKISTOI",
	"adminlink"		=> "HALLINTA",
	"logoutlink"		=> "POISTU",
	"uploadlink"		=> "VIE PALVELIMELLE",
	"searchlink"		=> "ETSI",
	"extractlink"	=> "Pura arkistotiedosto",
	'chmodlink'		=> 'Muuta (chmod) oikeudet (kansio/tiedosto(t))', // new mic
	'mossysinfolink'	=> $_VERSION->PRODUCT.' Järjestelmätiedot ('.$_VERSION->PRODUCT.', Server, PHP, mySQL)', // new mic
	'logolink'		=> 'Siiry joomlaXplorer sivustolle(uusi ikkuna)', // new mic
	
	// list
	"nameheader"		=> "Nimi",
	"sizeheader"		=> "Koko",
	"typeheader"		=> "Tyyppi",
	"modifheader"		=> "Muutettu",
	"permheader"		=> "Oikeudet",
	"actionheader"		=> "Toiminnot",
	"pathheader"		=> "Polku",
	
	// buttons
	"btncancel"		=> "Peruuta",
	"btnsave"		=> "Tallenna",
	"btnchange"		=> "Muuta",
	"btnreset"		=> "Peru",
	"btnclose"		=> "Sulje",
	"btncreate"		=> "Luo",
	"btnsearch"		=> "Etsi",
	"btnupload"		=> "Vie palvelimelle",
	"btncopy"		=> "Kopioi",
	"btnmove"		=> "Siirrä",
	"btnlogin"		=> "Kirjaudu",
	"btnlogout"		=> "Poistu",
	"btnadd"		=> "Lisää",
	"btnedit"		=> "Muokka",
	"btnremove"		=> "Poista",
	
	// user messages, new in joomlaXplorer 1.3.0
	'renamelink'	=> 'NIMEÄ',
	'confirm_delete_file' => 'Haluatko varmasti poistaa tiedoston? \\n%s',
	'success_delete_file' => 'Nimike(ttä) poistettu .',
	'success_rename_file' => 'Hakemisto/tiedosto  %s nimettiin uudelleen, uusi nimi on %s.',
	
	
	// actions
	"actdir"		=> "Hakemisto",
	"actperms"		=> "Muuta oikeuksia",
	"actedit"		=> "Muokkaa tiedostoa",
	"actsearchresults"	=> "Etsinnän tulokset",
	"actcopyitems"		=> "Kopioi nimikkeet",
	"actcopyfrom"		=> "Kopioi kohteesta /%s kohteeseen /%s ",
	"actmoveitems"		=> "Siirrä nimikkeet",
	"actmovefrom"		=> "Siirrä kohteesta /%s kohteeseen /%s ",
	"actlogin"		=> "Kirjaudu",
	"actloginheader"	=> "Kirjaudu käyttääksesi joomlaXploreria",
	"actadmin"		=> "Hallinta",
	"actchpwd"		=> "Muuta salasana",
	"actusers"		=> "Käyttäjät",
	"actarchive"		=> "Arkistoi nimikkeet",
	"actupload"		=> "Vie tiedostot palvelimelle",
	
	// misc
	"miscitems"		=> "Nimikkeet",
	"miscfree"		=> "Vapaa",
	"miscusername"		=> "Käyttäjänimi",
	"miscpassword"		=> "Salasana",
	"miscoldpass"		=> "Vanha salasana",
	"miscnewpass"		=> "Uusi salasana",
	"miscconfpass"		=> "Vahvista salasana",
	"miscconfnewpass"	=> "Vahvista uusi salasana",
	"miscchpass"		=> "Muuta salasana",
	"mischomedir"		=> "Kotihakemisto",
	"mischomeurl"		=> "Koti URL",
	"miscshowhidden"	=> "Näytä piilotetut nimikkeet",
	"mischidepattern"	=> "Piilota kuvio",
	"miscperms"		=> "Oikeudet",
	"miscuseritems"		=> "(nimi, kotihakemisto, näytä piilotetut nimikkeet, oikeudet, aktiivi)",
	"miscadduser"		=> "lisää käyttäjä",
	"miscedituser"		=> "muokkaa käyttäjää '%s'",
	"miscactive"		=> "Aktiivi",
	"misclang"		=> "Kieli",
	"miscnoresult"		=> "Ei tuloksia.",
	"miscsubdirs"		=> "Etsi alahakemistoista",
	"miscpermnames"		=> array("Vain katselu","Muokkaa","Muuta salasana","Muokkaa & Muuta salasana",
					"Hallinta"),
	"miscyesno"		=> array("Kyllä","Ei","K","E"),
	"miscchmod"		=> array("Omistaja", "Ryhmä", "Julkinen"),
	// from here all new by mic
	'miscowner'			=> 'Omistaja',
	'miscownerdesc'		=> '<strong>Kuvaus:</strong><br />Käyttäjä (UID) /<br />Ryhmä (GID)<br />Nykyiset oikeudet:<br /><strong> %s ( %s ) </strong>/<br /><strong> %s ( %s )</strong>',

	// sysinfo (new by mic)
	'simamsysinfo'		=> $_VERSION->PRODUCT.' Järjestelmän tiedot',
	'sisysteminfo'		=> 'Järjestelmän tiedot',
	'sibuilton'			=> 'Operating System',
	'sidbversion'		=> 'Database Version (MySQL)',
	'siphpversion'		=> 'PHP Version',
	'siphpupdate'		=> 'INFORMATION: <span style="color: red;">The PHP version you use is <strong>not</strong> actual!</span><br />To guarantee all functions and features of '.$_VERSION->PRODUCT.' and addons,<br />you should use as minimum <strong>PHP.Version 4.3</strong>!',
	'siwebserver'		=> 'Webserver',
	'siwebsphpif'		=> 'WebServer - PHP Interface',
	'simamboversion'	=> $_VERSION->PRODUCT.' Version',
	'siuseragent'		=> 'Browser Version',
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
	'sieditor'			=> 'WYSIWYG-editori',
	'siconfigfile'		=> 'Config file',
	'siphpinfo'			=> 'PHP Info',
	'siphpinformation'	=> 'PHP Information',
	'sipermissions'		=> 'Käyttöoikeudet',
	'sidirperms'		=> 'Hakemiston käyttöoikeudet',
	'sidirpermsmess'	=> 'To be shure that all functions and features of '.$_VERSION->PRODUCT.' are working correct, following folders should have permission to write [chmod 0777]',
	'sionoff'			=> array( 'Pois', 'Päällä' ),
	
	'extract_warning' => "Haluatko purkaa tiedoston tänne? \\nKäytä toimintoa varoen sillä olemassa olevat tiedostot ylikirjoitetaan.",
	'extract_success' => "Tiedoston purkaminen onnistui",
	'extract_failure' => "Purkaminen epäonnistui",
	
	'overwrite_files' => 'Overwrite existing file(s)?',
	"viewlink"		=> "VIEW",
	"actview"		=> "Showing source of file"
);
?>