<?php
ini_set("display_errors",1);
define("__BOARD__",1);
session_start();

require_once "src/config.php";
require_once "src/common.php";

if(isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = 'login';
}

if(in_array($action,['join','login','delete','logout','main'])) {
	include_once "$action.php";
}
?>