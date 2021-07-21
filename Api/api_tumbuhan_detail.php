<?php
	require 'config.php';
	$pdo = new \PDO('mysql:host=' . $server . ';dbname=' . $dbname, $dbuser, $dbpass);
	$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	$query = $pdo->prepare('SELECT * FROM tumbuhan WHERE id = ?');
	$query->execute(array($_GET['id']));
	$read = $query->fetchAll(\PDO::FETCH_ASSOC);

	echo json_encode(array(
		'response' => array($read[0])
	));
?>