<?php

class ModulModel {
    
    // function get untuk mengambil seluruh data modul 
    public function get()
    {
        $sql = "SELECT modul.id as id , praktikum.nama
        as praktikum , praktikum.status as status, 
        modul.nama as nama FROM modul JOIN praktikum 
        ON modul.praktikum_id = praktikum.id 
        WHERE praktikum.status = 1";

        $query = koneksi()->query($sql);
        $hasil=[];

        while ($data = $query->fetch_assoc())
        {
            $hasil[]=$data;
        }
        return $hasil;
            }
           
       
        
        /**
         * function getLastData berfungsi mengambil data modul
         */

         public function getLastData()
         {
             $sql= "SELECT modul.id as id , modul.nama as nama from modul
             join praktikum on modul.praktikum_id=praktikum.id
             where praktikum.status=1
             order by id desc limit 1";

            $query = koneksi()->query($sql);
            return $query->fetch_assoc();
         }

         /**
          * function prosesStore berfungsi untuk menambahkan data modul ke database
          * @param string modul berisi nama modul
          * @param string idPraktikum berisi idPraktikum
          */

          public function prosesStore($modul, $idPraktikum)
          {
              $sql="INSERT into modul(nama,praktikum_id) values ('$modul','$idPraktikum')";
              return koneksi()->query($sql);
          }

         /**
          * function prosesDelete berfungsi untuk menghapus data modul dari database
          * @param integer id berisi id
          */

          public function prosesDelete($id)
          {
              $sql="DELETE from modul where id=$id";
              return koneksi()->query($sql);
          }

           /**
          * function getPraktikum berfungsi untuk mengambil seluruh data praktikum dari database
          */

          public function getPraktikum()
        {
        $sql = "SELECT * FROM Praktikum where status=1";
        $query = koneksi()->query($sql);
        $hasil=[];

        while ($data = $query->fetch_assoc())
        {
            $hasil[]=$data;
        }
        return $hasil;
        }
  
}
