<?php

include 'autoloader.php';
include 'classes/db_config.php';

include 'header.php';

$db_conn = new DB_conn();
$db_conn->open_conn();

$wiedzmin_dane = $db_conn->wczytaj_postac(0);
$potwor_dane = $db_conn->wczytaj_postac(1);

if($wiedzmin_dane != null)
    $wiedzmin = new Wiedzmin($wiedzmin_dane->szybkosc, $wiedzmin_dane->sila, $wiedzmin_dane->zrecznosc, $wiedzmin_dane->zycie);
if($potwor_dane != null)
    $potwor = new Potwor($potwor_dane->szybkosc, $potwor_dane->sila, $potwor_dane->zrecznosc, $potwor_dane->zycie);

?>
    <div class="col-md-4 text-center">
        <?php
        if(isset($wiedzmin)){
            ?>
            <img src="img/geralt.jpg">
            <table class="table">
                <tr><th>Siła</th><th>Życie</th><th>Zręczność</th><th>Szybkość</th></tr>
                <tr><td><?= $wiedzmin->sila; ?></td><td><?= $wiedzmin->zycie; ?></td><td><?= $wiedzmin->zrecznosc; ?></td><td><?= $wiedzmin->szybkosc; ?></td></tr>
            </table>
        <?php
        }else{
        ?>
        <h1>Statystyki Wiedźmina</h1>
        <form name="nowy_wiedzmin" method="post" action="post.php">
            <div class="form-group">
                <label for="sila">Siła</label>
                <input type="text" class="form-control" name="sila" placeholder="Siła 1 - 20">
            </div>
            <div class="form-group">
                <label for="zycie">Życie</label>
                <input type="text" class="form-control" name="zycie" placeholder="Życie 1 - 100">
            </div>
            <div class="form-group">
                <label for="zrecznosc">Zręczność</label>
                <input type="text" class="form-control" name="zrecznosc" placeholder="Zręczność 1 - 20">
            </div>
            <div class="form-group">
                <label for="szybkosc">Szybkość</label>
                <input type="text" class="form-control" name="szybkosc" placeholder="Szybkość 1 - 20">
            </div>
            <div>
                <button type="submit" name="wiedzmin-submit" class="btn btn-danger">Dodaj</button>
            </div>
        </form>
        <?php } ?>
    </div>
    <div class="col-sm-4 text-center">
        <img src="img/vs.png">
    </div>
    <div class="col-md-4 text-center">
        <?php
        if(isset($potwor)){
            ?>
            <img src="img/monster.jpg">
            <table class="table">
                <tr><th>Siła</th><th>Życie</th><th>Zręczność</th><th>Szybkość</th></tr>
                <tr><td><?= $potwor->sila; ?></td><td><?= $potwor->zycie; ?></td><td><?= $potwor->zrecznosc; ?></td><td><?= $potwor->szybkosc; ?></td></tr>
            </table>
        <?php
        }else{
        ?>
        <h1>Statystyki Potwora</h1>
        <form name="nowy_potwor" method="post" action="post.php">
            <div class="form-group">
                <label for="sila">Siła</label>
                <input type="text" class="form-control" name="sila" placeholder="Siła 1 - 20">
            </div>
            <div class="form-group">
                <label for="zycie">Życie</label>
                <input type="text" class="form-control" name="zycie" placeholder="Życie 1 - 100">
            </div>
            <div class="form-group">
                <label for="zrecznosc">Zręczność</label>
                <input type="text" class="form-control" name="zrecznosc" placeholder="Zręczność 1 - 20">
            </div>
            <div class="form-group">
                <label for="szybkosc">Szybkość</label>
                <input type="text" class="form-control" name="szybkosc" placeholder="Szybkość 1 - 20">
            </div>
            <div>
                <button type="submit" name="potwor-submit" class="btn btn-danger">Dodaj</button>
            </div>
        </form>
        <?php } ?>
    </div>
</div>

<?php
    include 'footer.php';
    $db_conn->close_conn();
?>


