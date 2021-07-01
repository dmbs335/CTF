<?php
function redirect($action) {
	header("Location: index.php?action=$action");
}

function is_login() {
	return isset($_SESSION['id']);
}

function pdo_query($query, $param) {
	global $config;
	try {
		$db = new PDO("mysql:host=localhost;dbname={$config['db']};charset=utf8",$config['username'],$config['password']);
		$db->exec("set sql_mode='STRICT_TRANS_TABLES'");
		// $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		$stmt = $db->prepare($query);
		$stmt->execute($param);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$db = null;

		return $result;
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

function set_sess_ip($restrict) {
	if($_SESSION['id'] === 'admin' || $restrict) {
		return FALSE;
	}
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	return TRUE;
}

function get_sess_ip() {
	if(!empty($_SESSION['ip'])) {
		return $_SESSION['ip'];
	} else if($_SESSION['id'] === 'admin') {
		return '127.0.0.1';
	} else {
		$result = pdo_query("SELECT ip FROM user WHERE id=:id and pw=:pw",[':id'=>$_POST['id']]);
		return $result['ip'];
	}
}

function sanitize($str) {
	$str = preg_replace('/^\s+|\s+$/', '', $str);
	return strtolower($str);
}

function solve() {
	exit("Congratulation!!! Flag is FLAG{FLAG}");
}
?>