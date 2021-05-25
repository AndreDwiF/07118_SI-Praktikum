<?php

class AuthModel {


    public function prosesAuthAslab($npm, $password)
    {
        $sql = " select * from aslab where npm='$npm' and password='$password'";
        $query= koneksi()->query($sql);
        return $query->fetch_assoc();
    }



    // function untuk cek dari database dari param $npm yg berisi npm dan $password berisi passwordnya 
    public function prosesAuthPraktikan($npm, $password)
    {
        $sql = " SELECT * from praktikan where npm='$npm' and password='$password'";
        $query= koneksi()->query($sql);
        return $query->fetch_assoc();
    }

   
    /**
     * function prosesStorePraktikan berfungsi menambahkan data ke database
     * @param String nama berisi data nama
     * @param String npm berisi data npm
     * @param String no_hp berisi data no_hp
     * @param String password berisi data password
     * 
     */

     public function prosesStorePraktikan($nama, $npm, $no_hp, $password)
     {
        $sql="INSERT INTO praktikan (nama,npm,nomor_hp,password) VALUES ('$nama','$npm','$no_hp','$password')";
        return koneksi()->query($sql);
     }

   
}

