<?php

	include_once('../../../class/class_base.php');
	include_once('../../../functions/fn_frame.php');
	include_once('../../../functions/fn_ajax.php');
	include_once('module_jsEditor.php');
	
	$id=trim(intval($_GET['js_vl']));

	$base=new base;
	$fn_frame=new fn_frame;
	$fn_ajax=new fn_ajax;
	$jsEditor=new jsEditor;

	//echo $fn_ajax->alert($sub_type);

	$base->getBaseFromModule();

	$db=						$base->db;
	$prefix=					$base->prefix;
	$jsEditor->db=					$db;
	$jsEditor->base=				$base;
	$jsEditor->prefix=				$prefix;

	$sql="SELECT * FROM `".$prefix."_dataScripts` WHERE (id='".$id."') ";
	$res=mysql_query($sql,$db);
//	$rows_count=mysql_num_rows($res);
	$item_row=mysql_fetch_array($res);


	if ($item_row['id']) {

		$script=				$item_row['script'];
		$activ=					$item_row['activation'];
		$activ_select=			$jsEditor->show_activation($activ);
		//$text=			str_replace('<img src="photo','<img src="../photo',$text);
		//$text=			str_replace('href="files/','href="../files/',$text);
		//$text=			str_replace("'","''",$item_row['text']);
		//$text=			htmlspecialchars($item_row['text']);

		echo $fn_ajax->innerHTML('idSelectActiv','place',$activ_select);
		echo $fn_ajax->value('idScriptName','place',$item_row['name']);
		echo $fn_ajax->value('idScriptDescr','place',$item_row['caption']);
		echo $fn_ajax->value('idEl','place','');


		$ms=explode("\r\n",$script);
		for ($i=0;$i<sizeof($ms);$i++) {
			$ms[$i]=str_replace('"','\"',$ms[$i]);
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






