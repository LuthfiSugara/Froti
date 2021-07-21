<?php
    require 'functions.php';

    $id = $_GET["id"];

    $tumbuhan = query("SELECT * FROM tumbuhan WHERE id = $id ")[0];

    if (isset($_POST["ubahtumbuhan"])) {
        if (ubahTumbuhan($_POST) > 0 ) {
            echo 
            "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'index.php';
                </script>
            ";
        }
        else {
            echo 
            "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'index.php';
                </script>
            ";
        }
    }

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
                    <a href="index.php">Tumbuhan</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">
            <div class="card">
                <h5 class="card-header">Edit Tumbuhan</h5>
                <div class="card-body">
                <form method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $tumbuhan["id"]; ?>">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" value="<?= $tumbuhan['judul'] ?>" class="form-control" id="judul">
                    </div>
                    <div>
                        <img src="images/<?= $tumbuhan['gambar'] ?>" width="250px" height="250px" alt="..." class="img-thumbnail">
                    </div>
                    <div class="custom-file mb-3 mt-3">
                        <input type="file" name="gambar">
                    </div>
                    <div class="form-group">
                        <label for="konten">Konten</label>
                        <textarea class="form-control" name="konten" id="contentupload" rows="3"><?= $tumbuhan['konten']?></textarea>
                    </div>
                    <button type="submit" name="ubahtumbuhan" class="btn btn-primary">Submit</button>
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
    <!-- CkEditor -->
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