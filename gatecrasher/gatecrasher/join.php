<?php
if(!defined("__BOARD__")) {exit("not allowed");}

if(isset($_POST['id']) && isset($_POST['password'])) {
	$id = sanitize($_POST['id']);
	$password = sanitize($_POST['password']);
	$restrict = isset($_POST['restrict']) ? $_POST['restrict'] : 0;
	
	if(strlen($password) < 9) {
		exit("Password is too Short!");
	}
	
	$result = pdo_query("SELECT count(*) cnt FROM user WHERE id=:id", [
		':id'=>$id]);
	
	if($result['cnt']) {
		exit("User already exists!");
	}
	
	$result = pdo_query("INSERT INTO user (id, pw, ip, restrict_ip) VALUES (:id,:pw,:ip,:restrict)",
	[
		':id'=>trim($id),
		':pw'=>trim($password),
		':ip'=>$_SERVER['REMOTE_ADDR'],
		':restrict'=>$restrict
	]);
	
	if($result) {
		redirect('login');
	} else {
		exit("Join failed!");
	}
} else {
	include "skin/join.html";
}
?>