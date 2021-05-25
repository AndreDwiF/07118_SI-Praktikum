<?php

class PraktikanController
{
    private $model;

    /**
     * function __construct ini adalah constructor yg berfungsi menginisialisasi object PraktikanModel
     */
    public function __construct()
    {
        $this->model=new PraktikanModel();
    }

    //function index yaitu untuk mengatur tampilan awal halaman praktikan
    public function index()
    {
        $id = $_SESSION['praktikan']['id'];
        $data = $this->model->get($id);
        extract($data);
        require_once("View/praktikan/index.php");

    }

     /**
       * function edit berfungsi untuk menampilkan form edit
       * 
       */

      public function edit()
      {
        $id=$_SESSION['praktikan']['id'];
        $data=$this->model->get($id);
        extract ($data);
        require_once("View/praktikan/edit.php");
      }

      /**
      * function update berfungsi untuk menyimpan hasil edit
      */
      
      public function update()
      {
          $id=$_POST['id'];
          $nama=$_POST['nama'];
          $npm=$_POST['npm'];
          $no_hp=$_POST['no_hp'];
          $password=$_POST['password'];

          if($this->model->prosesUpdate($nama,$npm,$no_hp,$password,$id))
          {
            header("location: index.php?page=praktikan&aksi=view&pesan=Berhasil Ubah Data"); //jangan ada spasi setelah location
          }
          else {
            header("location: index.php?page=praktikan&aksi=edit&pesan=Gagal Ubah Data"); //jangan ada spasi setelah location
          }
      }

      //function praktikum berfungsi mengatur tampilan halaman awal praktikum
        public function praktikum()
        {
            $idPraktikan= $_SESSION['praktikan']['id'];
            $data = $this->model->getPendaftaranPraktikum($idPraktikan);
            extract($data);

            require_once("View/praktikan/praktikum.php");
        }

         //function daftarPraktikum berfungsi untuk mengatur tampilan halaman awal praktikum
        public function daftarPraktikum()
        {
            $data = $this->model->getPraktikum();
            extract($data);
            require_once("View/praktikan/daftarPraktikum.php");
        }

         /**
       * function storePraktikum berfungsi untuk memproses data praktikum yg dipilih untuk ditambahkan
       * 
       */

       public function storePraktikum()
       {
           $praktikum=$_POST['praktikum'];
           $idPraktikan=$_SESSION['praktikan']['id'];

           if($this->model->prosesStorePraktikum($idPraktikan,$praktikum))
           {
            header("location: index.php?page=praktikan&aksi=praktikum&pesan=Berhasil Daftar Praktikum"); //jangan ada spasi setelah location
           }
           else {
            header("location: index.php?page=praktikan&aksi=daftarPraktikum&pesan=Gagal Daftar Praktikum"); //jangan ada spasi setelah location
           }
       }

       //function nilaiPraktikan untuk mengatur halaman nilai praktikum
        public function nilaiPraktikan()
        {
            $idPraktikan = $_SESSION['praktikan']['id'];
            $idPraktikum = $_GET['idPraktikum'];
            $modul = $this->model->getModul($idPraktikum);
            $nilai = $this->model->getNilaiPraktikan($idPraktikan,$idPraktikum);
            extract($modul);
            extract($nilai);
            require_once("View/praktikan/nilaiPraktikan.php");
        }



}
