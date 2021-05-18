<?php

class ModulModel {
    
    // function get untuk mengambil seluruh data modul 
    public function get()
    {
        $sql = "SELECT modul.id as id , praktikum.nama
        as praktikum , praktikum.status as status, 
        modul.nama as nama FROM modul JOIN praktikum 
        ON modul.praktikum_id = praktikum.id 
        WHERE praktikum.status = 1";

        $query = koneksi()->query($sql);
        $hasil=[];

        while ($data = $query->fetch_assoc())
        {
            $hasil[]=$data;
        }
        return $hasil;
            }
           
    //function index untuk mengatur tampilan awal halaman modul
    public function index()
        {
                $data = $this->get();
                extract($data);
                require_once("View/modul/index.php");
                       
        }
        
        /**
         * function getLastData berfungsi mengambil data modul
         */

         public function getLastData()
         {
             $sql= "SELECT modul.id as id , modul.nama as nama from modul
             join praktikum on modul.praktikum_id=praktikum.id
             where praktikum.status=1
             order by id desc limit 1";

            $query = koneksi()->query($sql);
            return $query->fetch_assoc();
         }

         /**
          * function prosesStore berfungsi untuk menambahkan data modul ke database
          * @param string modul berisi nama modul
          * @param string idPraktikum berisi idPraktikum
          */

          public function prosesStore($modul, $idPraktikum)
          {
              $sql="INSERT into modul(nama,praktikum_id) values ('$modul','$idPraktikum')";
              return koneksi()->query($sql);
          }

         /**
          * function prosesDelete berfungsi untuk menghapus data modul ke database
          * @param integer id berisi id
          */

          public function prosesDelete($id)
          {
              $sql="DELETE from modul where id=$id";
              return koneksi()->query($sql);
          }

           /**
          * function getPraktikum berfungsi untuk mengambil seluruh data dari database
          */

          public function getPraktikum()
        {
        $sql = "SELECT * FROM Praktikum where status=1";
        $query = koneksi()->query($sql);
        $hasil=[];

        while ($data = $query->fetch_assoc())
        {
            $hasil[]=$data;
        }
        return $hasil;
        }

         /**
          * function create berfungsi untuk mengatur ke halaman create modul
          */

          public function create()
          {
              $data=$this->getPraktikum();
              extract($data);
              require_once("View/modul/create.php");
          }

          
         /**
          * function store berfungsi untuk menyimpan data modul yang telah diinputkan oleh aslab
          */

          public function store()
          {
              $modul=$_POST['modul'];
              $praktikum=$_POST['praktikum'];
              $getLastData=$this->getLastData();
              if($getLastData==null)
              {
                for($i=1;$i<=$modul;$i++)
                {
                    $nama='Modul ' . $i;
                    $post=$this->prosesStore($nama,$praktikum);
                }
              }
              else {
                  $modulLast=explode(" ", $getLastData['nama']);
                  for($i=1;$i<=$modul;$i++)
                {
                    $a=$modulLast['1']+=1;
                    $nama='Modul ' . $a;
                    $post=$this->prosesStore($nama,$praktikum);
                }
              }

              if($post)
              {
                header("location: index.php?page=modul&aksi=view&pesan=Berhasil Menambah Data"); //jangan ada spasi setelah location
              }
              else {
                header("location: index.php?page=modul&aksi=create&pesan=Gagal Menambah Data"); //jangan ada spasi setelah location
              }

          }

          /**
           * function delete berfungsi untuk menghapus modul
           */

           public function delete()
           {
               $id=$_GET['id'];
               if($this->prosesDelete($id))
               {
                header("location: index.php?page=modul&aksi=view&pesan=Berhasil Delete Data"); //jangan ada spasi setelah location
               }
               else {
                header("location: index.php?page=modul&aksi=view&pesan=Gagal Delete Data"); //jangan ada spasi setelah location
               }
           }
}
