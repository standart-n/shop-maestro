<?php

	include_once('../../../class/class_base.php');
	include_once('../../../functions/fn_frame.php');
	include_once('../../../functions/fn_ajax.php');
	
	$id=trim($_GET['pr_vl']);
	$skeleton=($_GET['skeleton_tb']);

	$base=new base;
	$fn_frame=new fn_frame;
	$fn_ajax=new fn_ajax;

	//echo $fn_ajax->alert($sub_type);

	$base->getBaseFromModule();

	$db=							$base->db;
	$prefix=						$base->prefix;

	$sql="SELECT * FROM `sk_".$skeleton."_dataPropertys` WHERE (id='".$id."') ";
	$res=mysql_query($sql,$db);
//	$rows_count=mysql_num_rows($res);
	$item_row=mysql_fetch_array($res);


	if ($item_row['id']) {

		$html=				$item_row['property'];
		//$text=			str_replace('<img src="photo','<img src="../photo',$text);
		//$text=			str_replace('href="files/','href="../files/',$text);
		//$text=			str_replace("'","''",$item_row['text']);
		//$text=			htmlspecialchars($item_row['text']);

		echo $fn_ajax->value('idElName','place',$item_row['div_id']);
		echo $fn_ajax->value('idEl','place','');


		$ms=explode("\r\n",$html);
		for ($i=0;$i<sizeof($ms);$i++) {
			$ms[$i]=str_replace('"','\"',$ms[$i]);
	                $ms[$i]=addslashes(stripslashes($ms[$i]));
			echo $fn_ajax->value('idEl','after',$ms[$i]);
			echo $fn_ajax->value('idEl','after','\r\n');
		}

		echo $fn_ajax->editCSS('#idBoxEl','display','block');
		echo $fn_ajax->editCSS('#idElButtons','display','block');
		//echo $fn_ajax->alert($html);
		
	} else { 
	
		echo $fn_ajax->editCSS('#idBoxEl','display','none');
		echo $fn_ajax->editCSS('#idElButtons','display','none');
		echo $fn_ajax->value('idEl','place','');
		
	}
	

	  
?>		






