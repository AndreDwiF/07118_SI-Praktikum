<?php

class PraktikanModel {

    /**
     * functionb get berfungsi mengambil seluruh data praktikan
    *@param integer $id berisi id praktikan
    */
    public function get($id)
    {
        $sql = "SELECT * FROM praktikan WHERE id = $id";
        $query= koneksi()->query($sql);
        return $query->fetch_assoc();
    }

    //function index yaitu untuk mengatur tampilan awal halaman praktikan
    public function index()
    {
        $id = $_SESSION['praktikan']['id'];
        $data = $this->get($id);
        extract($data);
        require_once("View/praktikan/index.php");

    }

    //function getPraktikum berfungsi mengambil seluruh data praktikum yg aktif
    public function getPraktikum()
    {
        $sql = "select * from praktikum where status =1";
        $query = koneksi()->query($sql);
        $hasil=[];
    
        while ($data = $query->fetch_assoc())
        {
             $hasil=$data;
        }
        return $hasil;
        
    }

    //function daftarPraktikum berfungsi untuk mengatur tampilan halaman awal praktikum
    public function daftarPraktikum()
    {
        $data = $this->getPraktikum();
        extract($data);
        require_once("View/praktikan/daftarPraktikum.php");
    }

    /**
     * function getPendaftaranPraktikum berfungsi untuk mengambil data pendaftaran praktikum praktikan
     * @param integer $idPraktikan berisi idpraktikan 
     */
    public function getPendaftaranPraktikum($idPraktikan)
    {
        $sql= "SELECT daftarprak.id as idDaftar , praktikum.nama as 
        namaPraktikum , praktikum.id as idPraktikum, daftarprak.status FROM
         daftarprak JOIN praktikum on praktikum.id  = daftarprak.praktikum_id
         WHERE daftarprak.praktikan_id =$idPraktikan";

        $query = koneksi()->query($sql);
        $hasil=[];

        while ($data = $query->fetch_assoc())
        {
            $hasil[]=$data;
        }
        return $hasil;

    }

    //function praktikum berfungsi mengatur tampilan halaman awal praktikum
    public function praktikum()
    {
        $idPraktikan= $_SESSION['praktikan']['id'];
        $data = $this->getPendaftaranPraktikum($idPraktikan);
        extract($data);

        require_once("View/praktikan/praktikum.php");
    }

    //function getModul untuk mengambil data praktikum yg aktif
    public function getModul()
    {
        $sql = "SELECT modul.id as idModul , modul.nama as namaModul FROM modul
        JOIN praktikum on praktikum.id = modul.praktikum_id
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
     * function getNilaiPraktikan untuk mengambil data nilai praktikan tiap praktikum
     * @param integer $idpPraktikan berisi idpraktikan
     * @param integer $idPraktikum berisi idpraktikum
     */
    public function getNilaiPraktikan($idPraktikan,$idPraktikum)
    {
        $sql = "SELECT * FROM nilai 
        JOIN modul on modul.id = nilai.modul_id
        WHERE praktikan_id = 1
        AND praktikum_id = 2
        ORDER BY modul.id";
        $query = koneksi()->query($sql);
        $hasil=[];

        while ($data = $query->fetch_assoc())
        {
            $hasil[]=$data;
        }
        return $hasil;
        
    }

    //function nilaiPraktikan untuk mengatur halaman nilai praktikum
    public function nilaiPraktikan()
    {
        $idPraktikan = $_SESSION['praktikan']['id'];
        $idPraktikum = $_GET['idPraktikum'];
        $modul = $this->getModul();
        $nilai = $this->getNilaiPraktikan($idPraktikan,$idPraktikum);
        extract($modul);
        extract($nilai);
        require_once("View/praktikan/nilaiPraktikan.php");
    }

    /**
     * function prosesUpdate untuk update data praktikan pada database
     * @param String nama berisi nama praktikan
     * @param String npm berisi npm praktikan
     * @param String no_hp berisi no hp praktikan
     * @param String password berisi password praktikan
     * @param integer id berisi id praktikan
     */

     public function prosesUpdate($nama,$npm,$no_hp,$password,$id)
     {
        $sql="UPDATE praktikan set nama='$nama', npm='$npm', nomor_hp='$no_hp', password='$password' where id='$id'";
        $query = koneksi()->query($sql);
        return $query;
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

          if($this->prosesUpdate($nama,$npm,$no_hp,$password,$id))
          {
            header("location: index.php?page=praktikan&aksi=view&pesan=Berhasil Ubah Data"); //jangan ada spasi setelah location
          }
          else {
            header("location: index.php?page=praktikan&aksi=edit&pesan=Gagal Ubah Data"); //jangan ada spasi setelah location
          }
      }

      /**
       * function edit berfungsi untuk menampilkan form edit
       * 
       */

      public function edit()
      {
        $id=$_SESSION['praktikan']['id'];
        $data=$this->get($id);
        extract ($data);
        require_once("View/praktikan/edit.php");
      }

      /**
       * function prosesStorePraktikum untuk input data daftarpraktikum ke database  
       * @param Integer idPraktikan berisi id praktikan
       * @param Integer idPraktikum berisi id praktikum
       */

      public function prosesStorePraktikum($idPraktikan,$idPraktikum)
      {
        $sql="INSERT INTO daftarprak(praktikan_id,praktikum_id,status) VALUES ($idPraktikan,$idPraktikum,0)";
        $query = koneksi()->query($sql);
        return $query;
      }

      /**
       * function storePraktikum berfungsi untuk memproses data praktikum yg dipilih untuk ditambahkan
       * 
       */

       public function storePraktikum()
       {
           $praktikum=$_POST['praktikum'];
           $idPraktikan=$_SESSION['praktikan']['id'];

           if($this->prosesStorePraktikum($idPraktikan,$idPraktikum))
           {
            header("location: index.php?page=praktikan&aksi=praktikum&pesan=Berhasil Daftar Praktikum"); //jangan ada spasi setelah location
           }
           else {
            header("location: index.php?page=praktikan&aksi=daftarPraktikum&pesan=Gagal Daftar Praktikum"); //jangan ada spasi setelah location
           }
       }
}

// $tes=new PraktikanModel();
// var_export($tes->prosesStorePraktikum(2,2));
// die();


