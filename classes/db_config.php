<?php

class DB_conn{
    private $database;

    public function open_conn(){
        try {
            $this->database = new PDO('sqlite:wiedzmin.db');
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function close_conn(){
        $this->database = null;
    }

    public function zapisz_postac($sila, $zycie, $szybkosc, $zrecznosc, $typ){
        $insert = "INSERT INTO Postacie (zycie, sila, szybkosc, zrecznosc, typ)
                    VALUES (:zycie, :sila, :szybkosc, :zrecznosc, :typ)";
        $stmt = $this->database->prepare($insert);

        $stmt->bindParam(':zycie', $zycie);
        $stmt->bindParam(':sila', $sila);
        $stmt->bindParam(':szybkosc', $szybkosc);
        $stmt->bindParam(':zrecznosc', $zrecznosc);
        $stmt->bindParam(':typ', $typ);

        $stmt->execute();
    }

    public function wczytaj_postac($typ){
        $select = "SELECT * FROM Postacie WHERE typ = :typ";

        $stmt = $this->database->prepare($select);
        $stmt->bindParam(':typ', $typ);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    public function wczytaj_gre(){

    }

    public function zapisz_gre(){

    }
}