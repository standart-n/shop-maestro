<?php

	include_once('../../../class/class_base.php');
	include_once('../../../functions/fn_frame.php');
	include_once('../../../functions/fn_ajax.php');
	
	$sub_type=trim($_GET['sub_vl']);

	$base=new base;
	$fn_frame=new fn_frame;
	$fn_ajax=new fn_ajax;

	//echo $fn_ajax->alert($sub_type);

	$base->getBaseFromModule();

	$db=							$base->db;
	$prefix=						$base->prefix;

	$sql="SELECT * FROM `".$prefix."_legoShelfs` WHERE (id='".$sub_type."') ";
	$res=mysql_query($sql,$db);
	$item_row=mysql_fetch_array($res);

	if ($sub_type!="none") {

		if ($item_row['id']) {
	
			$html=				$item_row['text'];
			$shelf_caption=		$item_row['caption'];
			$shelf_name=		$item_row['name'];

			echo $fn_ajax->value('idShelfCaption','place',$shelf_caption);
			echo $fn_ajax->value('idShelfName','place',$shelf_name);
			echo $fn_ajax->value('idEl','place','');

			$ms=explode("\r\n",$html);
			for ($i=0;$i<sizeof($ms);$i++) {
				//$ms[$i]=str_replace('"','\"',$ms[$i]);
				$ms[$i]=addslashes(stripslashes($ms[$i]));
				echo $fn_ajax->value('idEl','after',$ms[$i]);
				echo $fn_ajax->value('idEl','after','\r\n');
			}
	
			echo $fn_ajax->editCSS('#idBoxEl','display','block');
			echo $fn_ajax->editCSS('#idElButtons','display','block');
			//echo $fn_ajax->alert($html);
			
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






