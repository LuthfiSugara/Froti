<?php
	require 'config.php';
	$pdo = new \PDO('mysql:host=' . $server . ';dbname=' . $dbname, $dbuser, $dbpass);
	$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	if(intval($_GET['id']) > 0) {
		$query = $pdo->prepare('SELECT * FROM berita WHERE id_daerah = ?');
		$query->execute(array($_GET['id']));
	} else {
		$query = $pdo->prepare('SELECT * FROM berita');
		$query->execute();
	}

	$read = $query->fetchAll(\PDO::FETCH_ASSOC);
	foreach ($read as $key => $value) {
		$read[$key]['konten'] = substr($value['konten'], 0, 20).'......';
	}
	echo json_encode(array(
		'response' => $read
	));
?>