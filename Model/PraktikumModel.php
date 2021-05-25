<?php

class PraktikumModel {
    
    //function get untuk mengambil seluruh data praktikum
    public function get()
    {
        $sql = "SELECT * FROM Praktikum";
        $query = koneksi()->query($sql);
        $hasil=[];

        while ($data = $query->fetch_assoc())
        {
            $hasil[]=$data;
        }
        return $hasil;
    }

    

    /**
     * function prosesStore berfungsi untuk input data praktikum 
     * @param String $nama berisi nama praktikum
     * @param String $tahun berisi tahun praktikum
     */ 
     
     public function prosesStore($nama, $tahun )
     {
         $sql= "INSERT INTO praktikum(nama,tahun) VALUES ('$nama','$tahun')";
         return koneksi()->query($sql);

     }

     /**
     * function update berfungsi untuk mengubah data pada database
     * @param String $nama berisi data nama
     * @param String $tahun berisi data tahun
     * @param Integer $id berisi id dari data pada database
     */

     public function storeUpdate($nama,$tahun, $id)
     {
         $sql="UPDATE praktikum SET nama='$nama', tahun='$tahun' WHERE id=$id";
         return koneksi()->query($sql);
     }

     /**
     * function aktifkan berfungsi merubah salah satu field di database
     * @param Integer $id berisi id dari data di database
     */

     public function prosesAktifkan($id)
     {
         koneksi()->query("UPDATE praktikum SET status=0"); // merubah status praktikum yang aktif menjadi tidak aktif
         $sql= "UPDATE praktikum SET status=1 WHERE id=$id";
         return koneksi()->query($sql);
     }


     /**
     * function nonAktifkan berfungsi merubah salah satu field di database
     * @param Integer $id berisi id dari data di database
     */
     public function prosesnonAktifkan($id)
     {
        $sql= "UPDATE praktikum SET status=0 WHERE id=$id";
        return koneksi()->query($sql);
     }

     /**
     * function getById berfungsi untuk mengambil suatu data dari database
     * @param Integer $id berisi id dari suatu data di database
     */

    public function getById($id)
    {
        $sql="SELECT * FROM praktikum WHERE id=$id ";
        $query= koneksi()->query($sql);
        return $query->fetch_assoc();

    }

     
}

/* 
$tes = new PraktikumModel();
var_export($tes->prosesAktifkan(1));
die();
*/