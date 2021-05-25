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
            $hasil[]=$data;
        }
        return $hasil;
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
         $hasil[]=$data;
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
     $hasil[]=$data;
}
return $hasil;
}

  

    /**
     * function prosesStoreNilai berfungsi untuk melakukan insert nilai praktikan ke database
     * @param integer idModul berisi id modul
     * @param integer idPraktikan berisi id praktikan
     * @param integer nilai berisi nilai praktikan
     * 
     */

     public function prosesStoreNilai($idModul,$idPraktikan,$nilai)
     {
         $sqlcek="SELECT * from nilai where modul_id=$idModul and praktikan_id= $idPraktikan ";
         $cek=koneksi()->query($sqlcek);
         if($cek->fetch_assoc()==null)
         {
             $sqlInsert="INSERT into nilai (modul_id, praktikan_id, nilai ) VALUES ($idModul,$idPraktikan,$nilai)";
             $query=koneksi()->query($sqlInsert);
         }
         else {
             $sqlUpdate="UPDATE nilai set nilai ='$nilai' where modul_id=$idModul and praktikan_id=$idPraktikan";
             $query=koneksi()->query($sqlUpdate);
         }
         return $query;

     }
     
  
   
 }

