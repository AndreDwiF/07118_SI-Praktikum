<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Nilai</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <center>
        <div class="container">

            <div class="card mt-5">
                <div class=" card-header">
                    <h2>Create Nilai</h2>
                    <!-- id Diganti saat modul 2 -->
                    <a href="index.php?page=aslab&aksi=nilai&id=#" class="btn btn-info float-right">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="index.php?page=aslab&aksi=storeNilai&id=" method="POST">
                        <!-- Diganti saat modul 3 -->
                        <div class="row">
                            <div class="col">
                                <label for="">Jumlah Modul : </label>
                                <select name="modul" class="form-control" required>
                                    <option value="1">Modul 1</option>
                                    <option value="2">Modul 2</option>
                                    <option value="3">Modul 3</option>
                                    <option value="4">Modul 4</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="">Nilai : </label>
                                <input type="text" name="nilai" class="form-control">
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