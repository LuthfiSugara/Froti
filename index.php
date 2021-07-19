<?php
    require 'functions.php';

    if (isset($_POST["tambahberita"])) {
        if (tambahBerita($_POST) > 0) {
            echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'index.php';
                </script>
    
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal ditambahkan!');
                    document.location.href = 'index.php';
                </script>
    
            ";
        }
    }

    $berita = query('SELECT berita.id, berita.judul, berita.penulis, berita.konten, berita.id_daerah, berita.gambar, daerah.daerah FROM berita LEFT JOIN daerah ON berita.id_daerah = daerah.id ORDER BY berita.id ASC');
    
    $daerah = query("SELECT * FROM daerah ORDER BY id ASC");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Froti</title>

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
                <h3>Froti</h3>
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
            <button class="btn btn-sm btn-success float-right mb-2" data-toggle="modal" data-target="#exampleModal">Tambah Berita</button>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Gambar</th>
                <th scope="col">Judul</th>
                <th scope="col">Daerah</th>
                <th scope="col">Penulis</th>
                <th scope="col">Konten</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
	            <?php foreach ($berita as $brt => $value) : ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><img src="images/<?= $value['gambar'] ?>" style="height:50px; width: 50px;" class="rounded-sm rounded-circle mx-auto" alt="..."></td>
                        <td><?= $value['judul'] ?></td>
                        <td><?= $value['daerah'] ?></td>
                        <td><?= $value['penulis'] ?></td>
                        <td><?= limitKata($value['konten']) ?></td>
                        <td>
                            <button class="btn btn-sm btn-success"><a href="edit-berita.php?id=<?= $value["id"]; ?>">Edit</a></button>
                            <button class="btn btn-sm btn-danger"><a href="hapus-berita.php?id=<?= $value["id"]; ?>">Hapus</a></button>
                        </td>
                    </tr>
                    <?php $i++; ?>
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
            <h5 class="modal-title" id="exampleModalLabel">Berita</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" class="form-control" id="judul">
            </div>
            <div class="form-group">
                <label for="Penulis">Penulis</label>
                <input type="text" name="penulis" class="form-control" id="Penulis">
            </div>
            <div class="form-group">
                <label for="daerah">Daerah</label>
                <select name="daerah" class="form-control" id="daerah">
                    <?php foreach($daerah as $dr => $drh) : ?>
                        <option value="<?= $drh['id']?>"><?= $drh['daerah'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="custom-file mb-3 mt-3">
                <input type="file" name="gambar">
                <!-- <label class="custom-file-label" for="gambar">Choose file...</label> -->
            </div>
            <div class="form-group">
                <label for="konten">Konten</label>
                <textarea class="form-control ckeditor" id="contentupload" name="konten" id="konten" rows="3"></textarea>

            </div>

            <div class="container">
                <button type="submit" name="tambahberita" class="btn btn-primary float-right ml-1">Simpan</button>
                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Tutup</button>
            </div>
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
    <!-- CK Editor -->
    <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });

        CKEDITOR.replace( 'contentupload', {

        height: 300,

        filebrowserUploadUrl: "upload.php"

        });

    </script>
</body>

</html>