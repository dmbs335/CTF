<?php
if(!defined("__BOARD__")) {exit("not allowed");}

if(isset($_POST['id']) && isset($_POST['password'])) {
	$id = sanitize($_POST['id']);
	$pw = sanitize($_POST['password']);
	
	$result = pdo_query("SELECT * FROM user WHERE id=:id and pw=:pw", [
		':id'=>$id,
		':pw'=>$pw
	]);
	if($result) {
		$_SESSION['id'] = $id;
		set_sess_ip($result['restrict_ip']);
		redirect('main');
	} else {
		exit("<p>Login Failed</p><a href='index.php?action=login'>Back</a>");
	}
}
include "skin/login.html";
?>