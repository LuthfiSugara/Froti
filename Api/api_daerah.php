<?php
	require 'config.php';
	$pdo = new \PDO('mysql:host=' . $server . ';dbname=' . $dbname, $dbuser, $dbpass);
	$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	$query = $pdo->prepare('SELECT * FROM daerah');
	$query->execute();
	$dataList = array(array('id' => 0, 'daerah' => 'Semua'));
	$read = $query->fetchAll(\PDO::FETCH_ASSOC);
	foreach ($read as $key => $value) {
		$read[$key]['id'] = intval($value['id']);
	}

	echo json_encode(array_merge($dataList, $read));
?>