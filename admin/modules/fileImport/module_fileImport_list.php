<?php

	session_start();

	include_once('../../../class/class_base.php');
	include_once('../../../functions/fn_ajax.php');
	include_once('../../../functions/fn_js.php');
	include_once('module_fileImport.php');

	
	$type=			strval(trim($_GET['type']));
	$list_now=		strval(trim($_SESSION['fileImport:list_now']));
	$row_max=		strval(trim($_SESSION['fileImport:row_max']));

	$base=new base;
	$fn_ajax=new fn_ajax;
	$fn_js=new fn_js;
	$fileImport=new fileImport;
	$show="";
	$a=2;

	$base->getBaseFromModule();
	$db=							$base->db;
	$prefix=						$base->prefix;
	
	$fileImport->prefix=$prefix;
	$fileImport->fn_js=$fn_js;
	$fileImport->db=$db;

	switch ($type) {
	
	case 'prev' :

		$list_now=$list_now-1;

	break;

	case 'next' :

		$list_now=$list_now+1;
	
	break;	
	
	}

	$fileImport->list_now=		$list_now;
	$fileImport->row_max=		$row_max;
	$fileImport->display_set();
	$show=						$fileImport->display_line();
	echo $fn_ajax->innerHTML('idBoxDspLine','place',$show);
	$show=						$fileImport->display_list();
	echo $fn_ajax->innerHTML('idBoxDspList','place',$show);
	
															
//	echo "document.getElementById('id').innerHTML='".$show."';";   	   

  
?>		






