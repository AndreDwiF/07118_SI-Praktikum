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

    

    //function getPraktikum berfungsi mengambil seluruh data praktikum yg aktif
    public function getPraktikum()
    {
        $sql = "select * from praktikum where status =1";
        $query = koneksi()->query($sql);
        $hasil=[];
    
        while ($data = $query->fetch_assoc())
        {
             $hasil[]=$data;
        }
        return $hasil;
        
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
            $hasil[]=$data;
        }
        return $hasil;

    }

    

    //function getModul untuk mengambil data praktikum yg aktif
    public function getModul($idPraktikum)
    {
        $sql = "SELECT modul.id as idModul , modul.nama as namaModul FROM modul
        JOIN praktikum on praktikum.id = modul.praktikum_id
        WHERE modul.praktikum_id=$idPraktikum";
        
        $query = koneksi()->query($sql);
        $hasil=[];

        while ($data = $query->fetch_assoc())
        {
            $hasil[]=$data;
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
        WHERE praktikan_id = $idPraktikan
        AND praktikum_id = $idPraktikum
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
     * function prosesUpdate untuk update data praktikan pada database
     * @param String nama berisi nama praktikan
     * @param String npm berisi npm praktikan
     * @param String no_hp berisi no hp praktikan
     * @param String password berisi password praktikan
     * @param integer id berisi id praktikan
     */

     public function prosesUpdate($nama,$npm,$no_hp,$password,$id)
     {
        $sql="UPDATE praktikan set nama='$nama', npm='$npm', nomor_hp='$no_hp', password='$password' where id='$id'";
        $query = koneksi()->query($sql);
        return $query;
     }


      /**
       * function prosesStorePraktikum untuk input data daftarpraktikum ke database  
       * @param Integer idPraktikan berisi id praktikan
       * @param Integer idPraktikum berisi id praktikum
       */

      public function prosesStorePraktikum($idPraktikan,$idPraktikum)
      {
        $sql="INSERT INTO daftarprak(praktikan_id,praktikum_id,status) VALUES ($idPraktikan,$idPraktikum,0)";
        $query = koneksi()->query($sql);
        return $query;
      }

     
}
