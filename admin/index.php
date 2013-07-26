<?php session_start();
$cl="class/class_main.php|class/class_enter.php|../class/class_base.php";
foreach (explode("|",$cl) as $key) { if (file_exists($key)) { include_once($key); } }
if (class_exists("main")) { $main=new main; $html=$main->engine(); echo $html; } 
?>
