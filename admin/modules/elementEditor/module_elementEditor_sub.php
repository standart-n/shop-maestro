<?php

	include_once('../../../class/class_base.php');
	include_once('../../../functions/fn_frame.php');
	include_once('../../../functions/fn_ajax.php');
	
	$sub_type=trim($_GET['sub_vl']);

	$base=new base;
	$fn_frame=new fn_frame;
	$fn_ajax=new fn_ajax;

	$base->getBaseFromModule();

	$db=							$base->db;
	$prefix=						$base->prefix;

	$sql="SELECT * FROM `".$prefix."_dataElements` WHERE (div_id='".$sub_type."') ";
	$res=mysql_query($sql,$db);
	$item_row=mysql_fetch_array($res);

	if ($sub_type!="none") {

		if ($item_row['id']) {
	
			$html=				$item_row['html'];

			echo $fn_ajax->value('idEl','place','');

			$ms=explode("\r\n",$html);
			for ($i=0;$i<sizeof($ms);$i++) {
				$line=$ms[$i];
				$line=addslashes(stripslashes($line));
				echo $fn_ajax->value('idEl','after',$line);
				echo $fn_ajax->value('idEl','after','\r\n');
			}
	
			echo $fn_ajax->editCSS('#idBoxEl','display','block');
			echo $fn_ajax->editCSS('#idElButtons','display','block');
			
		} else { 
		
			echo $fn_ajax->editCSS('#idBoxEl','display','block');
			echo $fn_ajax->editCSS('#idElButtons','display','block');
			echo $fn_ajax->value('idEl','place','');
			
		}
		
		
	} else {
		
			echo $fn_ajax->editCSS('#idBoxEl','display','none');
			echo $fn_ajax->editCSS('#idElButtons','display','none');
			echo $fn_ajax->value('idEl','place','');
		
	}	
	
	

	  
?>		






