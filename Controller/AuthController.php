<?php

class AuthController
{

    private $model;

    /**
     * function __construct ini adalah constructor yg berfungsi menginisialisasi object AuthModel
     */
    public function __construct()
    {
        $this->model=new AuthModel();
    }

    // function index berfungsi mengatur tampilan awal
    public function index()
    {
        require_once("View/auth/index.php");
    }

    // function login_aslab berfungsi mengatur halaman login pada aslab
    public function login_aslab()
    {
        require_once("View/auth/login_aslab.php");
    }

    // function login_praktikan berfungsi mengatur halaman login pada praktikan
    public function login_praktikan()
    {
        require_once("View/auth/login_praktikan.php");
    }

     //function authAslab berfungsi authentication aslab
     public function authAslab()
     {
         $npm= $_POST['npm'];
         $password= $_POST['password'];
         $data= $this->model->prosesauthAslab($npm,$password);
 
         if($data)
         {
             $_SESSION['role']='aslab';
             $_SESSION['aslab']= $data;
 
             header("location:index.php?page=aslab&aksi=view&pesan=Berhasil Login");
         }
         else
         {
             header("location:index.php?page=auth&aksi=loginAslab&pesan=Npm atau Password Salah");
         }
     }

     //function authPraktikan berfungsi authentication praktikan
    public function authPraktikan()
    {
        $npm= $_POST['npm'];
        $password= $_POST['password'];
        $data= $this->model->prosesAuthPraktikan($npm,$password);

        if($data)
        {
            $_SESSION['role']='praktikan';
            $_SESSION['praktikan']= $data;

        header("location: index.php?page=praktikan&aksi=view&pesan=Berhasil Login");
        }
        else
        {
            header("location: index.php?page=auth&aksi=loginPraktikan&pesan=Npm atau Password Salah");
        }
    }

     // function daftarPraktikan berfungsi mengatur tampilan halaman daftar 
     public function daftarPraktikan()
     {
         require_once("View/auth/daftar_praktikan.php");
     }

     /**
     * function storePraktikan berfungsi memproses data untuk ditambahkan
     * function ini membutuhkan data nama,npm,password,no_hp dengan metode http request POST
     */

    public function storePraktikan()
    {
        $nama=$_POST['nama'];
        $npm=$_POST['npm'];
        $no_hp=$_POST['no_hp'];
        $password=$_POST['password'];

        if($this->model->prosesStorePraktikan($nama,$npm,$no_hp,$password))
        {
           header("location: index.php?page=auth&aksi=view&pesan=Berhasil Daftar"); //jangan ada spasi setelah location
        }
        else
        {
           header("location: index.php?page=auth&aksi=daftarPraktikan&pesan=Gagal Daftar"); //jangan ada spasi setelah location
        }


        
    }

    /**
     * function logout untuk destroy session login sebelumnya
     */

    public function logout()
    {
        session_destroy();
        header("location: index.php?page=auth&aksi=view&pesan=Berhasil Login");
    }


}
