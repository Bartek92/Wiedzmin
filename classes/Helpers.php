<?php

//funkcje pomocnicze
abstract class Helpers{
    static function val_numbers($num){
        if(is_int($num) && $num >= 1 && $num <= 20){
            return true;
        }else{
            return false;
        }
    }

    static function set_init(){
        $params = array("sila" => 0, "zycie" => 0, "szybkosc" => 0, "zrecznosc" => 0);

        foreach($params as $param => &$value){
            echo "\n".$param;
            $input = null;
            while(!self::val_numbers($input)){
                echo "\nWprowadź wartość 1 - 20\n";
                $input = (int)fgets(STDIN);
            }
            $value = $input;
        }

        return $params;
    }

    static function show_actions(){
        echo "Wybierz akcje: \n";
        echo "1 - Atak (1 PA) \n";
        echo "2 - Stworz eliksir poz 1 (2 PA) \n";
        echo "3 - Stworz eliksir poz 2 (3 PA) \n";
        echo "4 - Stworz eliksir poz 3 (4 PA) \n";
        echo "5 - Wypij eliksir (1 PA) \n";
        echo "6 - Obrona (2 PA) \n";
        echo "7 - Koniec tury (+1 PA) \n";
    }

    //listowanie mikstur
    static function show_potions($potions_arr){
        echo "Wybierz eliksir: \n";
        $index = 0;
        foreach($potions_arr as $potion){
            foreach($potion as $key => $value){
                echo $index." Mikstura ".$key.", $value\n";
            }
            $index++;
        }
    }
}

