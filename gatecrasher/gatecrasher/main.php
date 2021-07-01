<?php
if(is_login()) {
	if(get_sess_ip() === $_SERVER['REMOTE_ADDR'] && $_SESSION['id'] == 'admin') {
		solve();
	} else {
		exit("<p>Logged in!</p><a href='index.php?action=logout'>logout</a>");
	}
} else {
	exit("not logged in");
}

?>