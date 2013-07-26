<?php


	include_once('../../../class/class_base.php');
	include_once('../../../functions/fn_ajax.php');
	include_once('module_cssImport.php');
	
	$selector_id=strval(trim($_GET['selector_vl']));
	$pattern_tb=strval(trim($_GET['pattern_tb']));

	$base=new base;
	$fn_ajax=new fn_ajax;
	$cssImport=new cssImport;

	$base->getBaseFromModule();

	$db=							$base->db;
	$prefix=						$base->prefix;

	$sql="SELECT * FROM `pt_".$pattern_tb."_legoSelectors` WHERE (id=".$selector_id.") ";
	$res=mysql_query($sql,$db);
	$row=mysql_fetch_array($res);
	$selector=$row['selector'];
	$stage=$row['stage'];


	$cssImport->db=			$db;
	$cssImport->base=		$base;
	$de=$cssImport->show_stages($stage,$pattern_tb);
	$item_html=			$de['html'];								
	$item_count=		$de['rows_count'];
	$item_sql=			$de['sql'];
	$item_sql_error=	$de['sql_error'];

	echo $fn_ajax->innerHTML('idSelectStages','place',$item_html);



		echo $fn_ajax->value('idCSS','place','');
		echo $fn_ajax->value('idCSS','after',$selector);
		echo $fn_ajax->value('idCSS','after','{\r\n');

	$sql="SELECT l.id, l.value as 'value', 
				(SELECT d.name FROM `pt_".$pattern_tb."_dataParams` d WHERE (d.id=l.param_id)) as 'param'
			FROM `pt_".$pattern_tb."_legoParams` l WHERE (l.selector_id=".$selector_id.") ORDER by id ASC ";
	$res=mysql_query($sql,$db);
		while($row=mysql_fetch_array($res)) {

		echo $fn_ajax->value('idCSS','after',$row['param']);
		echo $fn_ajax->value('idCSS','after',':');
		$param=$row['value'];	    	
		$param=addslashes(stripslashes($param));
		echo $fn_ajax->value('idCSS','after',$param);
		echo $fn_ajax->value('idCSS','after',';\n');
		
		}

		echo $fn_ajax->value('idCSS','after','}\n');



  
?>		






