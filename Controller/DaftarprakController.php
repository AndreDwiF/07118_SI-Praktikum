<?php

class DaftarprakController
{

    private $model;

    /**
     * function __construct ini adalah constructor yg berfungsi menginisialisasi object DaftarprakModel
     */
    public function __construct()
    {
        $this->model=new DaftarprakModel();
    }

      //function index untuk mengatur tampilan awal halaman daftar
      public function index()
      {
              $data = $this->model->get();
              extract($data);
              require_once("View/daftarprak/index.php");
                     
      }

       /**
       * function verif berfungsi untuk memverifikasi praktikan yang telah mendaftar praktikum
       * 
       */

      public function verif()
      {
           $id=$_GET['id'];
           $idAslab=$_SESSION['aslab']['id'];
           if($this->model->prosesVerif($id,$idAslab))
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
            $idPraktikan=$_GET['idPraktikan'];
        if($this->model->prosesUnVerif($id,$idPraktikan))
        {
            header("location: index.php?page=daftarprak&aksi=view&pesan=Berhasil Un-Verif Praktikan"); //jangan ada spasi setelah location
        }
        else {
            header("location: index.php?page=daftarprak&aksi=view&pesan=Gagal Un-Verif Praktikan"); //jangan ada spasi setelah location
        }

        }

}
