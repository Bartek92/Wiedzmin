<?php

abstract class Postac{
    protected $szybkosc;
    protected $sila;
    protected $zrecznosc;
    protected $zycie;
    protected $PA;

    function __construct($szybkosc, $sila, $zrecznosc, $zycie){
        $this->szybkosc = $szybkosc;
        $this->sila = $sila;
        $this->zrecznosc = $zrecznosc;
        $this->zycie = $zycie;
    }

    public function __get($property){
        if(property_exists($this, $property)){
            return $this->$property;
        }
    }

    public function __set($property, $value){
        if(property_exists($this, $property)){
            $this->$property = $value;
        }
    }

    //wyswietlanie statystyk
    public function show_stats(){
        echo "-------------------------------------------------\n";
        echo "PA: ".$this->PA." | Zyc: ".$this->zycie." | Sil: ".$this->sila." | Szyb: ".$this->szybkosc." | Zre: ".$this->zrecznosc."\n";
        echo "-------------------------------------------------\n";
    }

    //obliczanie PA - zalozenie przenoszenia niewykorzystanych punktow do nastepnej tury
    public function calculate_pa($enemy_speed){
        $speed = $this->szybkosc;
        if($speed > $enemy_speed){
            $pa = $speed / $enemy_speed;
            $this->PA += (int)$pa;
        }else{
            $this->PA += 1;
        }
    }

    //atak
    public function attack($enemy_dex){
        //odjecie pa
        $this->PA -= 1;
        //skutecznosc ataku
        $dex = $this->zrecznosc;
        //skutecznosc ataku
        $ae = ($dex - $enemy_dex)/$enemy_dex * 100;
        //optymalizacja ae
        if($ae > 90){
            $ae = 90;
        }elseif($ae < 10){
            $ae = 10;
        }
        //rzut na skutecznosc
        $test = rand(1, 100);

        echo "ae: ".$ae." test ".$test." obr: ".$this->sila."\n";

        if($test <= $ae){
            return $this->sila;
        }else{
            return 0;
        }
    }
}