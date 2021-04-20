<?php

// koneksi
require_once("Koneksi.php");


// Memanggil Model
require_once("Model/AslabModel.php");
require_once("Model/AuthModel.php");
require_once("Model/DaftarPrakModel.php");
require_once("Model/ModulModel.php");
require_once("Model/PraktikanModel.php");
require_once("Model/PraktikumModel.php");

//Routing dari URL ke Obyek Class PHP
if (isset($_GET['page']) && isset($_GET['aksi'])) {

    session_start();

    $page = $_GET['page']; // Berisi nama page
    $aksi = $_GET['aksi']; // Aksi Dari setiap page

    // require_once akan Dirubah Saat Modul 2
    if ($page == "auth") {

        $auth = new AuthModel();
        if ($aksi == 'view') {
            $auth->index();
        } else if ($aksi == 'loginAslab') {
            $auth->login_aslab();
        } else if ($aksi == 'loginPraktikan') {
            $auth->login_praktikan();
        } else if ($aksi == 'authAslab') {
            $auth->authAslab();
        } else if ($aksi == 'authPraktikan') {
            $auth->authPraktikan();
        } else if ($aksi == 'logout') {
            $auth->logout();
        } else if ($aksi == 'daftarPraktikan') {
            $auth->daftarPraktikan();
        } else if ($aksi == 'storePraktikan') {
            require_once("View/auth/index.php");
        } else {
            echo "Method Not Found";
        }
    } else if ($page == "aslab") {
        require_once("View/menu/menu_aslab.php");

        if($_SESSION['role']=='aslab')
        {
            $aslab = new AslabModel();
        if ($aksi == 'view') {
            $aslab->index();
        } else if ($aksi == 'nilai') {
            $aslab->nilai();
        } else if ($aksi == 'createNilai') {
            require_once("View/aslab/createNilai.php");
        } else if ($aksi == 'storeNilai') {
            require_once("View/aslab/nilai.php");
        } else {
            echo "Method Not Found";
        }
    }
    else
    {
        header("location: index.php?page=auth&aksi=loginAslab");
    }

    } else if ($page == "praktikum") {
        require_once("View/menu/menu_aslab.php");

        if($_SESSION['role']=='aslab'){
            $praktikum = new PraktikumModel();
        if ($aksi == 'view') {
            $praktikum->index();
        } else if ($aksi == 'create') {
            require_once("View/praktikum/create.php");
        } else if ($aksi == 'store') {
            require_once("View/praktikum/index.php");
        } else if ($aksi == 'edit') {
            require_once("View/praktikum/edit.php");;
        } else if ($aksi == 'update') {
            require_once("View/praktikum/index.php");
        } else if ($aksi == 'aktifkan') {
            require_once("View/praktikum/index.php");
        } else if ($aksi == 'nonAktifkan') {
            require_once("View/praktikum/index.php");
        } else {
            echo "Method Not Found";
        }
    } else
    {
        header("location: index.php?page=auth&aksi=loginAslab");
    }
    } else if ($page == "modul") {
        require_once("View/menu/menu_aslab.php");
        if($_SESSION['role']=='aslab'){
            $modul = new ModulModel();
        if ($aksi == 'view') {
            $modul->index();
        } else if ($aksi == 'create') {
            require_once("View/modul/create.php");
        } else if ($aksi == 'store') {
            require_once("View/modul/index.php");
        } else if ($aksi == 'delete') {
            require_once("View/modul/index.php");
        } else {
            echo "Method Not Found";
        }
    } else
    {
        header("location: index.php?page=auth&aksi=loginAslab");
    }

    } else if ($page == "praktikan") {
        require_once("View/menu/menu_praktikan.php");
        
        if($_SESSION['role']=='praktikan'){
            $praktikan = new PraktikanModel();
        if ($aksi == 'view') {
            $praktikan->index();
        } else if ($aksi == 'edit') {
            require_once("View/praktikan/edit.php");
        } else if ($aksi == 'update') {
            require_once("View/praktikan/index.php");
        } else if ($aksi == 'praktikum') {
            $praktikan->praktikum();
        } else if ($aksi == 'daftarPraktikum') {
            $praktikan->daftarPraktikum();
        } else if ($aksi == 'storePraktikum') {
            require_once("View/praktikan/index.php");
        } else if ($aksi == 'nilaiPraktikan') {
           $praktikan->nilaiPraktikan();
        } else {
            echo "Method Not Found";
        }
    }else
    {
         header("location: index.php?page=auth&aksi=loginPraktikan");
    }
    } else if ($page == 'daftarprak') {
        require_once("View/menu/menu_aslab.php");
         if($_SESSION['role']=='aslab'){
         $daftarprak = new DaftarPrakModel();
        if ($aksi == 'view') {
            $daftarprak->index();
        } else if ($aksi == 'verif') {
            require_once("View/daftarprak/index.php");
        } else if ($aksi == 'unVerif') {
            require_once("View/daftarprak/index.php");
        } else {
            echo "Method Not Found";
        }
    }else{
        header("location: index.php?page=auth&aksi=loginAslab");
    } 
}
    else {
        echo "Page Not Found";
    }
} else {
    header("location: index.php?page=auth&aksi=view"); //Jangan ada spasi habis location
}
