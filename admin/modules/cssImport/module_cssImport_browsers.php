<?php


	include_once('../../../class/class_base.php');
	include_once('../../../functions/fn_ajax.php');
	include_once('module_cssImport.php');
	
	$browser_id=strval(trim($_GET['browser_vl']));
	$pattern_tb=strval(trim($_GET['pattern_tb']));

	$base=new base;
	$fn_ajax=new fn_ajax;
	$cssImport=new cssImport;


	$base->getBaseFromModule();

	$cssImport->prefix=		$base->prefix;
	$cssImport->db=			$base->db;
	$cssImport->base=		$base;
	$de=$cssImport->show_selectors($browser_id,$pattern_tb);
	$item_html=			$de['html'];								
	$item_count=		$de['rows_count'];
	$item_sql=			$de['sql'];
	$item_sql_error=	$de['sql_error'];
	
	if ($item_count>0) {
		//echo $fn_ajax->fn_alert('part_change');
		echo $fn_ajax->innerHTML('idStatusSelectors','place','<b>Шаг 2</b>: Выберите селектор');
		echo $fn_ajax->innerHTML('idSelectSelectors','place',$item_html);
		echo $fn_ajax->editCSS('#idBoxCSS','display','block');
		echo $fn_ajax->editCSS('#idCSSButtons','display','block');
	} else { 
		echo $fn_ajax->innerHTML('idStatusSelectors','place','');
		echo $fn_ajax->innerHTML('idSelectSelectors','place','');
		echo $fn_ajax->editCSS('#idBoxCSS','display','none');
		echo $fn_ajax->editCSS('#idCSSButtons','display','none');
		//echo $fn_ajax->insertIntoFrame('deDoc','');
	}
	
															

//	echo "alert('js');";   	   

  
?>		






