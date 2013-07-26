<?php


	include_once('../../../class/class_base.php');
	include_once('../../../functions/fn_ajax.php');
	include_once('module_tagsStore.php');
	
	$main_id=strval(trim($_GET['main_vl']));

	$base=new base;
	$fn_ajax=new fn_ajax;
	$tagsStore=new tagsStore;

	//echo $fn_ajax->alert('js');

	$base->getBaseFromModule();

	$db=							$base->db;
	$prefix=						$base->prefix;

	$tagsStore->prefix=		$prefix;
	$tagsStore->db=			$db;
	$tagsStore->base=		$base;
	$de=$tagsStore->show_sub($main_id);
	$item_html=			$de['html'];								
	$item_count=		$de['rows_count'];
	$item_sql=			$de['sql'];
	$item_sql_error=	$de['sql_error'];
	
	if ($item_count>0) {
		//echo $fn_ajax->fn_alert('part_change');
		echo $fn_ajax->innerHTML('idStatusSub','place','Выберите нужный блок ');
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






