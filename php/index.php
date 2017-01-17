<?php
include("db.php");

include("sesje.php");
$sesja = new Session($db);
if(isset($_POST['login']) && isset($_POST['pass'])) {
	$sesja->loginAs($_POST['login'], $_POST['pass']);
} else if(isset($_GET['logout'])) {
	$sesja->logout();
}

include("nav.php");
$nav = new Navigation($sesja);
$nav->add("Informacje", "info.html", 0);
$nav->add("Kategorie", "kategorie.html", 1);
$nav->add("Rejestracja", "rejestracja.html", -1);
$nav->add("Uzytkownicy", "uzytkownicy.php", 0);
$nav->add("Kontakt", "kontakt.html", 0);

if(isset($_GET['strona']) && $nav->isAvailable($_GET['strona'])) {
	$strona = $_GET['strona'];
} else {
	$strona = "index.html";
}
$nav->setCurrent($strona);

include("header.php");
include("./html/".$strona);
include("footer.php");
?>
