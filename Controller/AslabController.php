<?php

class AslabController
{

    private $model;

    /**
     * function __construct ini adalah constructor yg berfungsi menginisialisasi object AslabModel
     */
    public function __construct()
    {
        $this->model=new AslabModel();
    }

    
    //function index berfungsi mengatur tampilan awal
    public function index()
    {
        $idAslab = $_SESSION['aslab']['id'];
        $data= $this->model->get($idAslab);
        extract($data);
        require_once("View/aslab/index.php");
    }

      //function nilai berfungsi mengatur tampilan data nilai praktikan
      public function nilai()
      {
          $idPraktikan = $_GET['id'];
          $modul= $this->model->getModul();
          $nilai= $this->model->getNilaiPraktikan($idPraktikan);
          extract($modul);
          extract($nilai);
  
          require_once("View/aslab/nilai.php");
  
      }

       /**
     * function createNilai untuk mengatur ke halaman createNilai
     */
     public function createNilai()
     {
         $modul=$this->model->getModul();
         extract($modul);
         require_once("View/aslab/createNilai.php");
     }

       /**
     * function storeNilai berfungsi menyimpan data nilai sesuai idpraktikan dari form yang telah diisi aslab
     * pada halaman create nilai
     */
    public function storeNilai()
    {
       $idModul=$_POST['modul'];
       $idPraktikan=$_GET['id'];
       $nilai=$_POST['nilai'];

       if($this->model->prosesStoreNilai($idModul,$idPraktikan,$nilai))
       {
           header("location: index.php?page=aslab&aksi=nilai&pesan=Berhasil Tambah Data&id=$idPraktikan"); //jangan ada spasi setelah location
       }
       else {
           header("location: index.php?page=aslab&aksi=createNilai&pesan=Gagal Tambah Data&id=$idPraktikan"); //jangan ada spasi setelah location
       }
    }



}
