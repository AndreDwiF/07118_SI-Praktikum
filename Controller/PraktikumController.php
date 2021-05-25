<?php

class PraktikumController
{

    private $model;

    /**
     * function __construct ini adalah constructor yg berfungsi menginisialisasi object PraktikumModel
     */
    public function __construct()
    {
        $this->model=new PraktikumModel();
    }

    //function index untuk mengatur tampilan awal
    public function index()
    {
        $data = $this->model->get();
        extract($data);
        require_once("View/praktikum/index.php");

    }

    /**
     * function create berfungsi untuk mengatur tampilan tambah data
     */

    public function create ()
    {
        require_once("View/praktikum/create.php");
    }

    /**
     * function store berfungsi untuk memproses data untuk ditambahkan
     *fungsi ini membutuhkan data nama, tahun dengan metode http request POST
    */

    public function store()
    {
        $nama= $_POST['nama'];
        $tahun= $_POST['tahun'];

        if($this->model->prosesStore($nama,$tahun))
        {
            header("location: index.php?page=praktikum&aksi=view&pesan=Berhasil Menambah Data"); //jangan ada spasi setelah location
        }
        else
        {
            header("location: index.php?page=praktikum&aksi=create&pesan=Gagal Menambah Data"); //jangan ada spasi setelah location
        }
    }

    /** 
      * function ini berfungsi untuk menampilkan halaman edit dan mengambil data
      * dari database 
      * function ini membutuhkan data id dengan metode http request GET
      */

      public function edit()
      {
          $id=$_GET['id'];
          $data=$this->model->getById($id);

          extract($data);
          require_once("View/praktikum/edit.php");
      }

      /**
     * function update berfungsi untuk memproses data untuk di update 
     * function ini membutuhkan data nama, tahun dengan metode http request POST
     */

     public function update()
     {
        $id= $_POST['id'];
        $nama= $_POST['nama'];
        $tahun= $_POST['tahun'];

        if($this->model->storeUpdate($nama,$tahun,$id))
        {
            header("location: index.php?page=praktikum&aksi=view&pesan=Berhasil Mengubah Data"); //jangan ada spasi setelah location
        }
        else
        {
            header("location: index.php?page=praktikum&aksi=edit&pesan=Gagal Mengubah Data"); //jangan ada spasi setelah location
        }
     }

     /**
     * function ini berfungsi memproses update salah satu field data
     * function ini membutuhkan data id dengan metode http request GET
     */

    public function aktifkan()
    {
        $id=$_GET['id'];
        if($this->model->prosesAktifkan($id))
        {
           header("location: index.php?page=praktikum&aksi=view&pesan=Berhasil Mengaktifkan Data"); //jangan ada spasi setelah location
        }
        else
        {
           header("location: index.php?page=praktikum&aksi=view&pesan=Gagal Mengaktifkan Data"); //jangan ada spasi setelah location
        }
    }

    /**
     * function ini berfungsi memproses update salah satu field data
     * function ini membutuhkan data id dengan metode http request GET
     */

    public function nonAktifkan()
    {
        $id=$_GET['id'];
        if($this->model->prosesnonAktifkan($id))
        {
           header("location: index.php?page=praktikum&aksi=view&pesan=Berhasil Nonaktifkan Data"); //jangan ada spasi setelah location
        }
        else
        {
           header("location: index.php?page=praktikum&aksi=view&pesan=Gagal Nonaktifkan Data"); //jangan ada spasi setelah location
        }
    }
}
