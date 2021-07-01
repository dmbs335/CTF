<?php
session_start();

ini_set("display_errors",1);
ini_set("open_basedir",".");

$root = $_GET['id'];
if(!file_exists($root)) {
	mkdir($root);
}

$scan_result = scandir($root);
if($scan_result) {
	foreach($scan_result as $scan) {
		$file = sprintf('%s/%s',$root,$scan);
		if(is_file($file)) {
			$diff = strtotime(date('Y-m-d H:i:s')) - filectime($file);
			if($diff > 3600) {
				unlink($file);
			}
		}
	}
} else {
	trigger_error("No scan result");
}

if(isset($_FILES['upload'])) {
	$error = $_FILES['upload']['error'];
	$ext = array_pop(explode('.', $_FILES['upload']['name']));
	$tmp_name = $_FILES['upload']['tmp_name'];
	$size = $_FILES['upload']['size'];
	
	if($size > 1024 * 1024) {
		trigger_error("File size is too big", E_USER_ERROR);
	}

	if($error === UPLOAD_ERROR_OK) {
		$random = bin2hex(random_bytes(10));
		@move_uploaded_file($tmp_name,
			sprintf('%s/%s.%s',
				$root, $random, $ext
			)
		);
	}
} else {
?>
<form enctype="multipart/form-data" action="index.php" method="POST">
	<input type="file" name="upload">
	<button>보내기</button>
</form>
<?php
}
highlight_file(__FILE__);
?>