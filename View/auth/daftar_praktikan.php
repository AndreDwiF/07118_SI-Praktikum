<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Daftar Praktikan</title>
</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h2>Daftar Praktikan</h2>
            </div>
            <div class="card-body">
                <form action="index.php?page=auth&aksi=storePraktikan" method="POST">
                    <div class="form-group">
                        <label>Nama : </label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="form-group">
                        <label>Npm : </label>
                        <input type="text" class="form-control" name="npm">
                    </div>
                    <div class="form-group">
                        <label>Password : </label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label>No.Telpon : </label>
                        <input type="text" class="form-control" name="no_hp">
                    </div>
                    <button type="submit" class="btn btn-success btn-lg btn-block">Daftar</button>
                    <a href="index.php?page=auth&aksi=view" class="btn btn-danger btn-lg btn-block">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>