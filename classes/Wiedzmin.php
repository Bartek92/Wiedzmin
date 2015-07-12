<?php

class Wiedzmin extends Postac{
    private $obrona = false;
    private $potions = array();
    private $max_zycie;

    //efekty uzycia eliksirow
    private $effects = array();

    function __construct($szybkosc, $sila, $zrecznosc, $zycie){
        parent::__construct($szybkosc, $sila, $zrecznosc, $zycie);

        //ograniczenie dla eliksiru zycia
        $this->max_zycie = $zycie;
    }

    //test obrony i przelaczenie flagi
    public function getObrona(){
        $is_active = $this->obrona;
        $this->obrona = false;
        return $is_active;
    }

    public function getPotions(){
        return $this->potions;
    }

    //obrona
    public function defend(){
        $this->obrona = true;
    }

    //tworzenie losowych eliksirow okreslonego poziomu
    public function create_potion($lev){
        if($this->PA > $lev){
            $types = ['zycie','sila', 'szybkosc'];
            $rand_key = array_rand($types);
            array_push($this->potions, [$types[$rand_key] => $lev]);
            $this->PA -= ($lev + 1);
            echo "\n>>>>> Wiedzmin stworzyl miksture ".$types[$rand_key]." poz ".$lev."\n\n";
        }else{
            echo "\n>>>>> Masz za malo PA\n\n";
        }
    }

    public function drink_potion($potion_key){
        foreach($this->potions[$potion_key] as $key => $value){
            switch($key){
                case 'zycie':
                    if(($this->zycie += $value) > $this->max_zycie){
                        $this->zycie = $this->max_zycie;
                        echo ">>>>>Wiedzmin wypij miksture Zycia +".$value."\n\n";
                    }
                    break;
                case 'sila':
                    $this->effects[$key] = $value;
                    $this->sila += $value;
                    echo ">>>>>Wiedzmin wypij miksture Sily +".$value."\n\n";
                    break;
                case 'szybkosc':
                    $this->effects[$key] = $value;
                    $this->szybkosc += $value;
                    echo ">>>>>Wiedzmin wypij miksture Szybkosci +".$value."\n\n";
                    break;
                default:
                    echo ">>>>> BŁĄD! Nie ma takiej mikstury\n\n";
            }

            unset($this->potions[$potion_key]);
            $temp_potions = array_values($this->potions);
            $this->potions = $temp_potions;

            $this->PA -= 1;
        }
    }

    //efekty eliksirow
    public function check_effect(){
        foreach($this->effects as $effect => $value){
            if($value < 1){
                unset($this->effects[$effect]);
            }else{
                if($effect == 'sila'){
                    $this->sila -= 1;
                }
                if($effect == 'szybkosc'){
                    $this->szybkosc -= 1;
                }
                $this->effects[$effect] -= 1;
                $this->zycie -= 1;
                echo ">>>>> Wiedzmin trac 1 pkt zycia z powodu eliksiru\n\n";
            }
        }
    }
}