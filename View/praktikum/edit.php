<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Praktikum</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <center>
        <div class="container">

            <div class="card mt-5">
                <div class=" card-header">
                    <h2>Edit Praktikum</h2>
                    <a href="index.php?page=praktikum&aksi=view" class="btn btn-info float-right">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="index.php?page=praktikum&aksi=update" method="POST">
                        <!-- Digant saat modul 3 -->
                        <input type="hidden" name="id" value="<?= $data['id'];?>">
                        <div class="row">
                            <div class="col">
                                <label for="">Nama :</label>
                                <input type="text" name="nama" class="form-control" value="<?= $data['nama']?>">
                            </div>
                            <div class=" col">
                                <label for="">Tahun : </label>
                                <input type="date" name="tahun" class="form-control" value="<?= $data['tahun']?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right mt-3">Simpan</button>
                    </form>


                </div>
            </div>
        </div>
    </center>

    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.css"></script>
</body>

</html>