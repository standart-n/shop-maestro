<?php

	session_start();

	include_once('../../class/class_base.php');
	include_once('../../../functions/fn_ajax.php');
	include_once('../../../functions/fn_js.php');
	include_once('module_photoImport.php');

	
	$type=			strval(trim($_GET['type']));
	$list_now=		strval(trim($_SESSION['photoImport:list_now']));
	$row_max=		strval(trim($_SESSION['photoImport:row_max']));

	$base=new base;
	$fn_ajax=new fn_ajax;
	$fn_js=new fn_js;
	$photoImport=new photoImport;
	$show="";
	$base->getBaseFromModule();

	$db=							$base->db;
	$prefix=						$base->prefix;
	
	$photoImport->prefix=$prefix;
	$photoImport->fn_js=$fn_js;
	$photoImport->db=$db;

	switch ($type) {
	
	case 'prev' :

		$list_now=$list_now-1;

	break;

	case 'next' :

		$list_now=$list_now+1;
	
	break;	
	
	}

	$photoImport->list_now=		$list_now;
	$photoImport->row_max=		$row_max;
	$photoImport->display_set();

	$show=						$photoImport->display_line();
	echo $fn_ajax->innerHTML('idBoxDspLine','place',$show);
	$show=						$photoImport->display_list();
	echo $fn_ajax->innerHTML('idBoxDspList','place',$show);
	
															
//	echo "document.getElementById('id').innerHTML='".$show."';";   	   

  
?>		






