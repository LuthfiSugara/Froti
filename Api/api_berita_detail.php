<?php
	require 'config.php';
	$pdo = new \PDO('mysql:host=' . $server . ';dbname=' . $dbname, $dbuser, $dbpass);
	$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	$query = $pdo->prepare('SELECT * FROM berita WHERE id = ?');
	$query->execute(array($_GET['id']));
	$read = $query->fetchAll(\PDO::FETCH_ASSOC);

	$daerah = $pdo->prepare('SELECT * FROM daerah WHERE id = ?');
	$daerah->execute(array($read[0]['id_daerah']));
	$readDaerah = $daerah->fetchAll(\PDO::FETCH_ASSOC);

	$read[0]['nama_daerah'] = $readDaerah[0]['daerah'];


	echo json_encode(array(
		'response' => array($read[0])
	));
?>