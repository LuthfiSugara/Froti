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

function tambahTumbuhan($data){
	global $conn;

	$judul = htmlspecialchars($data["judul"]);
	$konten = $data["konten"];
	$gambar = htmlspecialchars($data["gambar"]);

	$gambar = upload();
	if (!$gambar) {
		return false;
	}

	$query = "INSERT INTO tumbuhan VALUES (null, '$judul', '$konten', '$gambar') ";

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

function hapusTumbuhan($id){
	global $conn;

	mysqli_query($conn, "DELETE FROM tumbuhan WHERE id = '$id' ");

	return mysqli_affected_rows($conn);
}

function ubahTumbuhan($data){
	global $conn;

	$id = $_GET["id"];
    $judul = $_POST["judul"];
	$konten = $_POST['konten'];
	$gambar = $_FILES['gambar'];
	
	$gambar = upload();
	$file = explode(".",$gambar);
	$namaFile = $gambar;
	$result = mysqli_query($conn, "SELECT * FROM tumbuhan WHERE id=$id");
	$row = mysqli_fetch_assoc($result);
	if ($file[1] == null) {
		$namaFile = $row['gambar'];
		
	}

	$query = "UPDATE tumbuhan SET judul = '$judul', konten = '$konten', gambar = '$namaFile' WHERE id = '$id' ";
	$ubah = mysqli_query($conn, $query);

	return mysqli_affected_rows($ubah);
	
}

?>