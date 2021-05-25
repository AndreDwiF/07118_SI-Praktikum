<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Praktikum</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <center>
        <div class="container">
            <div class="card mt-5">
                <div class=" card-header">
                    <h2>Pendaftaran Praktikum</h2>
                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Praktikan</th>
                                <th>Praktikum</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Diganti Saat Modul 2 -->
                            <?php $no=1;
                            foreach ($data as $row) : ?>

                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $row['namaPraktikan']; ?></td>
                                <td><?= $row['namaPraktikum']; ?></td>
                                <td>
                                    <!-- # nanti di ganti saat modul 3 -->
                                    <?php if($row['status']=='0') : ?>
                                    <a href="index.php?page=daftarprak&aksi=verif&id=<?= $row['idDaftar']; ?>" class="btn btn-success">Verif</a>
                                    <?php else : ?>
                                    <a href="index.php?page=daftarprak&aksi=unVerif&id=<?= $row['idDaftar'];?>&idPraktikan=<?= $row['idPraktikan']; ?>" class="btn btn-danger">Un-Verif</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php $no++;
                            endforeach; ?>
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