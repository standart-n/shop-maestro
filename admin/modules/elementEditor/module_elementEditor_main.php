<?php


	include_once('../../../class/class_base.php');
	include_once('../../../functions/fn_ajax.php');
	include_once('module_elementEditor.php');
	
	$main_id=strval(trim($_GET['main_vl']));
	$skeleton_tb=strval(trim($_GET['skeleton_tb']));

	$base=new base;
	$fn_ajax=new fn_ajax;
	$elementEditor=new elementEditor;

	$base->getBaseFromModule();

	$elementEditor->prefix=		$base->prefix;
	$elementEditor->db=		$base->db;
	$elementEditor->base=		$base;
	$de=$elementEditor->show_sub($main_id,$skeleton_tb);
	$item_html=			$de['html'];								
	$item_count=		$de['rows_count'];
	$item_sql=			$de['sql'];
	$item_sql_error=	$de['sql_error'];
	
	if ($item_count>0) {
		$item_html=stripslashes($item_html);
		echo $fn_ajax->innerHTML('idStatusSub','place','<b>Шаг 2</b>: Выберите вложенный блок ');
		echo $fn_ajax->innerHTML('idSelectSub','place',$item_html);
		echo $fn_ajax->editCSS('#idBoxEl','display','none');
		echo $fn_ajax->editCSS('#idElButtons','display','none');
	} else { 
		echo $fn_ajax->innerHTML('idStatusSub','place','');
		echo $fn_ajax->innerHTML('idSelectSub','place','');
		echo $fn_ajax->editCSS('#idBoxEl','display','none');
		echo $fn_ajax->editCSS('#idElButtons','display','none');
		//echo $fn_ajax->insertIntoFrame('deDoc','');
	}
	
															

//	echo "alert('js');";   	   

  
?>		






