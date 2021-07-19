<?php
    require 'functions.php';

    if (isset($_POST["tambahdaerah"])) {
        if (tambahDaerah($_POST) > 0) {
            echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'daerah.php';
                </script>
    
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal ditambahkan!');
                    document.location.href = 'daerah.php';
                </script>
    
            ";
        }
    }

    $daerah = query("SELECT * FROM daerah ORDER BY id ASC");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Historas</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="bootstrap/style5.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Historas</h3>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="index.php">Berita</a>
                </li>
                <li>
                    <a href="daerah.php">Daerah</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">
            <div class="container">
                <button class="btn btn-sm btn-success float-right mb-2" data-toggle="modal" data-target="#exampleModal">Tambah Daerah</button>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Daerah</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                    <?php foreach($daerah as $dr => $value) : ?>
                        <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <td><?= $value['daerah'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-success"><a href="edit-daerah.php?id=<?= $value["id"]; ?>">Edit</a></button>
                                <button class="btn btn-sm btn-danger"><a href="hapus-daerah.php?id=<?= $value["id"]; ?>">Hapus</a></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daerah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="daerah">Nama Daerah</label>
                            <input type="text" name="daerah" class="form-control" id="daerah" placeholder="Masukkan nama daerah">
                        </div>
                        <button type="submit" name="tambahdaerah" class="btn btn-primary float-right">Simpan</button>
                        <button type="button" class="btn btn-secondary float-right mr-1" data-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="bootstrap/jquery.js"></script>
    <!-- Popper.JS -->
    <script src="bootstrap/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="bootstrap/bootstrap.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>

</html>