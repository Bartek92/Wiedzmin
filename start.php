<?php

include 'autoloader.php';

echo "Witaj w grze Wiedzmin!\n\n";

//pobieranie danych postaci

echo "Wprowadz statystyki Wiedzmina:";
$w_parametry = Helpers::set_init();

echo "Wprowadz statystyki Potwora:";
$p_parametry = Helpers::set_init();

//tworzenie obiektów

$wiedzmin = new Wiedzmin($w_parametry["szybkosc"], $w_parametry["sila"], $w_parametry["zrecznosc"], $w_parametry["zycie"]);
$potwor = new Potwor($p_parametry["szybkosc"], $p_parametry["sila"], $p_parametry["zrecznosc"], $p_parametry["zycie"]);

//dane testowe
//$wiedzmin = new Wiedzmin(5, 15, 5, 50);
//$potwor = new Potwor(16, 5, 7, 20);

//dane poczatkowe
$game_finished = false;

//glowna petla gry
while(!$game_finished){
    //obliczanie PA

    $wiedzmin->calculate_pa($potwor->szybkosc);
    $potwor->calculate_pa($wiedzmin->szybkosc);
    $wiedzmin->check_effect();

    $wiedzmin_moved = false;
    $potwor_moved = false;

    while($wiedzmin_moved == false || $potwor_moved == false){
        if((($wiedzmin->szybkosc >= $potwor->szybkosc) || ($potwor_moved == true)) && $wiedzmin_moved == false) {
            //sprawdzanie toksycznych efektow eliksirow

            //statystyki
            echo "Wiedzmin: \n";
            $wiedzmin->show_stats();
            echo "Potwor: \n";
            $potwor->show_stats();

            //akcja
            Helpers::show_actions();

            //jesli brakuje PA
            if($wiedzmin->PA > 0){
                $action = fgets(STDIN);
            }else{
                $action = 7;
            }

            switch ($action) {
                case 1:         //atak
                        $damage = $wiedzmin->attack($potwor->zrecznosc);
                        $potwor->zycie -= $damage;
                        echo "\n>>>>> Wiedzmin atakuje i zadaje ".$damage." obrazen!\n\n";
                    break;
                case 2:         //mikstura 1 poziomu
                    $wiedzmin->create_potion(1);
                    break;
                case 3:         //mikstura 2 poziomu
                    $wiedzmin->create_potion(2);
                    break;
                case 4:         //mikstura 3 poziomu
                    $wiedzmin->create_potion(3);
                    break;
                case 5:         //wypij miksture
                    Helpers::show_potions($wiedzmin->getPotions());     //listowanie mikstur
                    $potions = $wiedzmin->getPotions();
                    if(!empty($potions)){
                        $loop = true;
                        while($loop){
                            $potion = (int)fgets(STDIN);
                            if(array_key_exists($potion, $potions)){
                                $wiedzmin->drink_potion($potion);
                                $loop = false;
                            }else{
                                echo "\nNie masz takiej mikstury.\n\n";
                            }
                        }
                    }
                    else{
                        echo ">>>>> Nie masz zadnych eliksirow.\n\n";
                    }
                    break;
                case 6:         //obrona
                    $act_cost = 2;
                    if($wiedzmin->PA >= $act_cost){
                        $wiedzmin->defend();
                        $wiedzmin->PA -= $act_cost;
                        $wiedzmin_moved = true;
                        echo "\n>>>>> Wiedzmin się broni\n\n";
                    }else{
                        echo "\n>>>>> Masz za mało PA\n\n";
                    }
                    break;
                case 7:         //koniec tury
                    $wiedzmin->PA += 1;
                    $wiedzmin_moved = true;
                    break;
                default:
                    echo "Wybierz liczbe 1 -8\n";
            }
        }

        if((($potwor->szybkosc > $wiedzmin->szybkosc) || ($wiedzmin_moved == true)) && $potwor_moved == false) {
            while ($potwor->PA > 0) {
                $multi = 1;     //mnożnik zrecznosci za obrone wiedzmina
                if($wiedzmin->getObrona()){
                    $multi = 1.5;
                    echo "\nObroniony\n";
                }
                $damage = $potwor->attack($wiedzmin->zrecznosc*$multi);
                $wiedzmin->zycie -= $damage;
                echo "\n >>>>> Potwor atakuje i zadaje ".$damage." obrazen!\n\n";
            }
            $potwor_moved = true;
        }
    }

    //warunek konczacy gre
    if(($potwor->zycie <= 0) || ($wiedzmin->zycie <= 0)){
        $game_finished = true;
        echo ">>>>> KONIEC GRY <<<<<";
    }else{
        echo "\n>>>>> NOWA TURA <<<<<\n\n";
    }
}







