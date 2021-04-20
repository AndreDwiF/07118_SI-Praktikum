<?php

class PraktikanModel {

    /**
     * functionb get berfungsi mengambil seluruh data praktikan
    *@param integer $id berisi id praktikan
    */
    public function get($id)
    {
        $sql = "SELECT * FROM praktikan WHERE id = $id";
        $query= koneksi()->query($sql);
        return $query->fetch_assoc();
    }

    //function index yaitu untuk mengatur tampilan awal halaman praktikan
    public function index()
    {
        $id = $_SESSION['praktikan']['id'];
        $data = $this->get($id);
        extract($data);
        require_once("View/praktikan/index.php");

    }

    //function getPraktikum berfungsi mengambil seluruh data praktikum yg aktif
    public function getPraktikum()
    {
        $sql = "select * from praktikum where status =1";
        $query = koneksi()->query($sql);
        $hasil=[];
    
        while ($data = $query->fetch_assoc())
        {
             $hasil=$data;
        }
        return $hasil;
        
    }

    //function daftarPraktikum berfungsi untuk mengatur tampilan halaman awal praktikum
    public function daftarPraktikum()
    {
        $data = $this->getPraktikum();
        extract($data);
        require_once("View/praktikan/daftarPraktikum.php");
    }

    /**
     * function getPendaftaranPraktikum berfungsi untuk mengambil data pendaftaran praktikum praktikan
     * @param integer $idPraktikan berisi idpraktikan 
     */
    public function getPendaftaranPraktikum($idPraktikan)
    {
        $sql= "SELECT daftarprak.id as idDaftar , praktikum.nama as 
        namaPraktikum , praktikum.id as idPraktikum, daftarprak.status FROM
         daftarprak JOIN praktikum on praktikum.id  = daftarprak.praktikum_id
         WHERE daftarprak.praktikan_id =$idPraktikan";

        $query = koneksi()->query($sql);
        $hasil=[];

        while ($data = $query->fetch_assoc())
        {
            $hasil=$data;
        }
        return $hasil;

    }

    //function praktikum berfungsi mengatur tampilan halaman awal praktikum
    public function praktikum()
    {
        $idPraktikan= $_SESSION['praktikan']['id'];
        $data = $this->getPendaftaranPraktikum($idPraktikan);
        extract($data);

        require_once("View/praktikan/praktikum.php");
    }

    //function getModul untuk mengambil data praktikum yg aktif
    public function getModul()
    {
        $sql = "SELECT modul.id as idModul , modul.nama as namaModul FROM modul
        JOIN praktikum on praktikum.id = modul.praktikum_id
        WHERE praktikum.status = 1";
        
        $query = koneksi()->query($sql);
        $hasil=[];

        while ($data = $query->fetch_assoc())
        {
            $hasil=$data;
        }
        return $hasil;
    }


    /**
     * function getNilaiPraktikan untuk mengambil data nilai praktikan tiap praktikum
     * @param integer $idpPraktikan berisi idpraktikan
     * @param integer $idPraktikum berisi idpraktikum
     */
    public function getNilaiPraktikan($idPraktikan,$idPraktikum)
    {
        $sql = "SELECT * FROM nilai 
        JOIN modul on modul.id = nilai.modul_id
        WHERE praktikan_id = 1
        AND praktikum_id = 2
        ORDER BY modul.id";
        $query = koneksi()->query($sql);
        $hasil=[];

        while ($data = $query->fetch_assoc())
        {
            $hasil=$data;
        }
        return $hasil;
        
    }

    //function nilaiPraktikan untuk mengatur halaman nilai praktikum
    public function nilaiPraktikan()
    {
        $idPraktikan = $_SESSION['praktikan']['id'];
        $idPraktikum = $_GET['idPraktikum'];
        $modul = $this->getModul();
        $nilai = $this->getNilaiPraktikan($idPraktikan,$idPraktikum);
        require_once("View/praktikan/nilaiPraktikan.php");
    }

}

