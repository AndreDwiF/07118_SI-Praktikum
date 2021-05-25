<?php

class DaftarPrakModel {
    
    //function get untuk mengambil selruh data praktikan yg telah daftar praktikum
    public function get()
    {
        $sql= "SELECT daftarprak.id as idDaftar , daftarprak.praktikan_id 
        as idPraktikan , praktikan.nama as namaPraktikan , daftarprak.status
        as status , praktikum.nama as namaPraktikum FROM daftarprak
        JOIN praktikan ON praktikan.id = daftarprak.praktikan_id 
        JOIN praktikum ON praktikum.id = daftarprak.praktikum_id
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
     * function prosesVerif berfungsi untuk mengupdate status di database yang telah diverifikasi
     * @param integer id berisi id
     * @param integer idAslab berisi id aslab
     */

     public function prosesVerif($id,$idAslab)
     {
         $sql= "UPDATE daftarprak set status =1, aslab_id=$idAslab where id=$id";
         $query = koneksi()->query($sql);
         return $query;
     }

     /**
      * function prosesUnverif berfungsi membatalkan status verifikasi
      * @param integer id berisi id
      *  @param integer idPraktikan berisi idPraktikannya
      */

      public function prosesUnVerif($id, $idPraktikan)
      {
          $sqlDelete="DELETE from nilai where praktikan_id=$idPraktikan";
          koneksi()->query($sqlDelete);
          $sqlUpdate="UPDATE daftarprak SET status=0, aslab_id= NULL where id=$id";
          $query = koneksi()->query($sqlUpdate);
          return $query;
      }
   
}


   