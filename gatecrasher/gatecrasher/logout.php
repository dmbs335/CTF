<?php
if(!defined("__BOARD__")) {exit("not allowed");}
unset($_SESSION['id']);
redirect("login");
?>