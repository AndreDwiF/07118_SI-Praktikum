<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Praktikan</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <center>
        <div class="container">
            <div class="card mt-5">
                <div class=" card-header">
                    <h2>Nilai Praktikan</h2>
                    <a href="index.php?page=praktikan&aksi=praktikum" class="btn btn-info float-right ">Kembali</a>
                </div>
                <div class="card-body">
                    <!-- Diganti Saat Modul 2 -->
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <?php foreach ($modul as $row) : ?>
                                <td><?=$row['namaModul']?></td>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php foreach ($nilai as $row) : ?>
                                <td><?=$row['nilai']?></td>
                                <?php endforeach; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </center>

    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.css"></script>
</body>

</html>