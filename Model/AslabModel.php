<?php

class AslabModel {

    //parameter $idAslab berisi id Aslabnya
    //function get berfungsi mengambil data praktikan dari database

    public function get($idAslab)
    {
        $sql = "SELECT praktikan.id as idPraktikan , praktikan.nama as namaPraktikan ,
         praktikan.npm as npmPraktikan , praktikan.nomor_hp as nohpPraktikan,
          praktikum.nama as namaPraktikum FROM praktikan JOIN daftarprak
         ON daftarprak.praktikan_id = praktikan.id
        JOIN praktikum ON daftarprak.praktikum_id = praktikum.id
        WHERE daftarprak.status = 1
        AND daftarprak.aslab_id = $idAslab
        AND praktikum.status = 1";

        $query = koneksi()->query($sql);
        $hasil=[];

        while ($data = $query->fetch_assoc())
        {
            $hasil=$data;
        }
        return $hasil;
    }


    //function index berfungsi mengatur tampilan awal
    public function index()
    {
        $idAslab = $_SESSION['aslab']['id'];
        $data= $this->get($idAslab);
        extract($data);
        require_once("View/aslab/index.php");
    }
    // function getModul berfungsi mengambil seluruh data dari modul 
    public function getModul()
    {
        $sql="SELECT modul.id as idModul , modul.nama as namaModul FROM modul
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
    

    // parameter $idPraktikan berisi id praktikan
    // function getNilaiPraktikan mengambil seluruh data nilai dari databasenya
    public function getNilaiPraktikan($idPraktikan)
    {
        $sql = "SELECT * from nilai
        JOIN modul on modul.id = nilai.modul_id
        WHERE praktikan_id = $idPraktikan
        ORDER BY modul.id";

$query = koneksi()->query($sql);
$hasil=[];

while ($data = $query->fetch_assoc())
{
     $hasil=$data;
}
return $hasil;
}

    //function nilai berfungsi mengatur tampilan data nilai praktikan
    public function nilai()
    {
        $idPraktikan = $_GET['id'];
        $modul= $this->getModul();
        $nilai=$this->getNilaiPraktikan($idPraktikan);
        extract($modul);
        extract($nilai);

        require_once("View/aslab/nilai.php");

    }
    }

