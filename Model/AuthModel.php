<?php

class AuthModel {

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

    // function daftarPraktikan berfungsi mengatur tampilan halaman daftar 
    public function daftarPraktikan()
    {
        require_once("View/auth/daftar_praktikan.php");
    }

    
    public function prosesAuthAslab($npm, $password)
    {
        $sql = " select * from aslab where npm='$npm' and password='$password'";
        $query= koneksi()->query($sql);
        return $query->fetch_assoc();
    }

    //function authAslab berfungsi authentication aslab
    public function authAslab()
    {
        $npm= $_POST['npm'];
        $password= $_POST['password'];
        $data= $this->prosesauthAslab($npm,$password);

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

    // function untuk cek dari database dari param $npm yg berisi npm dan $password berisi passwordnya 
    public function prosesAuthPraktikan($npm, $password)
    {
        $sql = " select * from praktikan where npm='$npm' and password='$password'";
        $query= koneksi()->query($sql);
        return $query->fetch_assoc();
    }

    
    //function authPraktikan berfungsi authentication praktikan
    public function authPraktikan()
    {
        $npm= $_POST['npm'];
        $password= $_POST['password'];
        $data= $this->prosesAuthPraktikan($npm,$password);

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

    public function logout()
    {
        session_destroy();
        header("location: index.php?page=auth&aksi=view&pesan=Berhasil Login");
    }
}
  
