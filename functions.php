<?php
$conn = mysqli_connect('localhost', 'root', 'root', 'froti');

function limitKata($kata){
	$title = $kata;
    $arr = explode(" ", $title);
    $limit = 30;
    $new = [];

    if (count($arr) > $limit) {
        for($i = 0; $i < $limit; $i++) {
            array_push($new, $arr[$i]);
        }
    }

    if($new) {
        $new = implode(" ", $new);
        return $new;
    }
    else {
        return $title;
    }
}

function query($query){
	global $conn;

	$result = mysqli_query($conn, $query);
	$row = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}

	return $rows;
}

function tambahBerita($data){
	global $conn;

	$judul = htmlspecialchars($data["judul"]);
	$konten = $data["konten"];
	$penulis = htmlspecialchars($data["penulis"]);
	$daerah = htmlspecialchars($data["daerah"]);
	$gambar = htmlspecialchars($data["gambar"]);

	$gambar = upload();
	if (!$gambar) {
		return false;
	}

	$query = "INSERT INTO berita VALUES (null, '$judul', '$konten', '$penulis', '$daerah', '$gambar') ";

	mysqli_query($conn, $query);

	return(mysqli_affected_rows($conn));

}

function upload(){
	$namaFile = $_FILES["gambar"]["name"];
	$error = $_FILES["gambar"]["error"];
	$ukuranGambar = $_FILES["gambar"]["size"];
	$tmpName = $_FILES["gambar"]["tmp_name"];

	if ($ukuranGambar > 1000000) {
		echo
		"
			<script>
				alert('Ukuruan Gambar terlalu besar!');
			</script>
		";
		return false;
	}

	// if ($error === 4) {
		// echo
		// "
			// <script>
				// alert('Terjadi error saat mengupload gambar!');
			// </script>
		// ";
		// return false;
	// }

	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	// if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
	// 	echo 
	// 	"
	// 		<script>
	// 			alert('Format gambar harus jpg, jpeg, png!');
	// 		</script>
	// 	";
	// 	return false;
	// }

	
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .=  $ekstensiGambar;

	move_uploaded_file($tmpName, 'images/' . $namaFileBaru);
	return $namaFileBaru;
}

function hapusBerita($id){
	global $conn;

	mysqli_query($conn, "DELETE FROM berita WHERE id = '$id' ");

	return mysqli_affected_rows($conn);
}

function ubahBerita($data){
	global $conn;

	$id = $_GET["id"];
    $judul = $_POST["judul"];
    $penulis = $_POST["penulis"];
    $id_daerah = $_POST['id_daerah'];
	$konten = $_POST['konten'];
	$gambar = $_FILES['gambar'];
	
	$gambar = upload();
	$file = explode(".",$gambar);
	$namaFile = $gambar;
	$result = mysqli_query($conn, "SELECT * FROM berita WHERE id=$id");
	$row = mysqli_fetch_assoc($result);
	if ($file[1] == null) {
		$namaFile = $row['gambar'];
		
	}

	$query = "UPDATE berita SET judul = '$judul', konten = '$konten', penulis = '$penulis', id_daerah = '$id_daerah', gambar = '$namaFile' WHERE id = '$id' ";
	$ubah = mysqli_query($conn, $query);

	return mysqli_affected_rows($ubah);
	
}

function tambahDaerah($data){
	global $conn;

	$daerah = htmlspecialchars($data["daerah"]);

	$query = "INSERT INTO daerah VALUES (null, '$daerah') ";

	mysqli_query($conn, $query);

	return(mysqli_affected_rows($conn));

}

function hapusDaerah($id){
	global $conn;

	mysqli_query($conn, "DELETE FROM daerah WHERE id = '$id' ");

	return mysqli_affected_rows($conn);
}

function ubahDaerah($data){
	global $conn;

	$id = $data["id"];
	$daerah = htmlspecialchars($data["daerah"]);

	$query = "UPDATE daerah SET daerah = '$daerah' WHERE id = '$id' ";
	$ubah = mysqli_query($conn, $query);

	return mysqli_affected_rows($ubah);
	
}







?>