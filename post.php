<?php

include 'autoloader.php';
include 'classes/db_config.php';

include 'header.php';

if(isset($_POST['wiedzmin-submit'])){
    $db_conn = new DB_conn();
    $db_conn->open_conn();

    $sila = $_POST['sila'];
    $zycie = $_POST['zycie'];
    $zrecznosc = $_POST['zrecznosc'];
    $szybkosc = $_POST['szybkosc'];

    $db_conn->zapisz_postac($sila, $zycie, $szybkosc, $zrecznosc, 0 );
    $db_conn->close_conn();

    header("Location:index.php");
}

if(isset($_POST['potwor-submit'])){
    $db_conn = new DB_conn();
    $db_conn->open_conn();

    $sila = $_POST['sila'];
    $zycie = $_POST['zycie'];
    $zrecznosc = $_POST['zrecznosc'];
    $szybkosc = $_POST['szybkosc'];

    $db_conn->zapisz_postac($sila, $zycie, $szybkosc, $zrecznosc, 1 );
    $db_conn->close_conn();

    header("Location:index.php");
}

?>

</div>

<?php
    include 'footer.php';
?>


