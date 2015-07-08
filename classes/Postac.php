<?php

class Postac{
    protected $szybkosc;
    protected $sila;
    protected $zrecznosc;
    protected $zycie;

    function __construct($szybkosc, $sila, $zrecznosc, $zycie){
        $this->$szybkosc = $szybkosc;
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
}