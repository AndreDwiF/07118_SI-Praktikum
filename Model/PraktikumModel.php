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

    //function index untuk mengatur tampilan awal
    public function index()
    {
        $data = $this->get();
        extract($data);
        require_once("View/praktikum/index.php");

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

        if($this->prosesStore($nama,$tahun))
        {
            header("location: index.php?page=praktikum&aksi=view&pesan=Berhasil Menambah Data"); //jangan ada spasi setelah location
        }
        else
        {
            header("location: index.php?page=praktikum&aksi=create&pesan=Gagal Menambah Data"); //jangan ada spasi setelah location
        }
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

     /**
     * function update berfungsi untuk memproses data untuk di update 
     * function ini membutuhkan data nama, tahun dengan metode http request POST
     */

     public function update()
     {
        $id= $_POST['id'];
        $nama= $_POST['nama'];
        $tahun= $_POST['tahun'];

        if($this->storeUpdate($nama,$tahun,$id))
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
         if($this->prosesAktifkan($id))
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
         if($this->prosesnonAktifkan($id))
         {
            header("location: index.php?page=praktikum&aksi=view&pesan=Berhasil Nonaktifkan Data"); //jangan ada spasi setelah location
         }
         else
         {
            header("location: index.php?page=praktikum&aksi=view&pesan=Gagal Nonaktifkan Data"); //jangan ada spasi setelah location
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
          $data=$this->getById($id);

          extract($data);
          require_once("View/praktikum/edit.php");
      }
}

/* 
$tes = new PraktikumModel();
var_export($tes->prosesAktifkan(1));
die();
*/