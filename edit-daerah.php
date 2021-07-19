<?php
    require 'functions.php';

    $id = $_GET["id"];

    if (isset($_POST["ubahdaerah"])) {
        if (ubahDaerah($_POST) > 0 ) {
            echo 
            "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'daerah.php';
                </script>
            ";
        }
        else {
            echo 
            "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'daerah.php';
                </script>
            ";
        }
    }

    $daerah = query("SELECT * FROM daerah ORDER BY id ASC");
    $detail = query("SELECT * FROM daerah WHERE id = $id ")[0];
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
            <div class="card">
                <h5 class="card-header">Edit Daerah</h5>
                <div class="card-body">
                <form method="post" action="">
                <input type="hidden" name="id" value="<?= $detail['id'] ?>">
                    <div class="form-group">
                        <label for="daerah">Nama Daerah</label>
                        <input type="text" name="daerah" value="<?= $detail['daerah']?>" class="form-control" id="daerah">
                    </div>
                    <button type="submit" name="ubahdaerah" class="btn btn-primary">Submit</button>
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