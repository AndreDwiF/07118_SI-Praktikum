<?php

// fungsi koneksi berfungsi membuat koneksi dengan database

function koneksi()
{
$db_host="localhost";
$db_user="root";
$db_password="";
$db_database="db_pendaftaranpraktikum";

try{
return new mysqli($db_host, $db_user, $db_password, $db_database);
}catch(Exception $e) // catch ini berfungsi jika dia gagal menampilkan output "terjadi kesalahan koneksi database"
{
echo"terjadi kesalahan koneksi database";
}
}