<?php

class DaftarPrakModel {
    
    //function get untuk mengambil selruh data praktikan yg telah daftar praktikum
    public function get()
    {
        $sql= "SELECT daftarprak.id as idDaftar , daftarprak.praktikan_id 
        as id_Praktikan , praktikan.nama as namaPraktikan , daftarprak.status
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

     //function index untuk mengatur tampilan awal halaman daftar
    public function index()
    {
            $data = $this->get();
            extract($data);
            require_once("View/daftarprak/index.php");
                   
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

      /**
       * function verif berfungsi untuk memverifikasi praktikan yang telah mendaftar praktikum
       * 
       */

       public function verif()
       {
            $id=$_GET['id'];
            $idAslab=$_SESSION['aslab']['id'];
            if($this->prosesVerif($id,$idAslab))
            {
                header("location: index.php?page=daftarprak&aksi=view&pesan=Berhasil Verif Praktikan"); //jangan ada spasi setelah location
            }
            else {
                header("location: index.php?page=daftarprak&aksi=view&pesan=Gagal Verif Praktikan"); //jangan ada spasi setelah location
            }
       }

       /**
        * function unVerif untuk membatalkan verifikasi
        */

        public function unVerif()
        {
            $id=$_GET['id'];
            $idAslab=$_GET['idPraktikan'];
        

        if($this->prosesUnVerif($id,$idPraktikan))
        {
            header("location: index.php?page=daftarprak&aksi=view&pesan=Berhasil Un-Verif Praktikan"); //jangan ada spasi setelah location
        }
        else {
            header("location: index.php?page=daftarprak&aksi=view&pesan=Gagal Un-Verif Praktikan"); //jangan ada spasi setelah location
        }

        }
}

// $tes=new DaftarprakModel();
// var_export($tes->prosesUnVerif(2, 2));
// die();

   