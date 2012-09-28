<?php class settings {

function engine(&$q) {
	$q->cookie_time=time()+60*60*24*365;	
}

} ?>
