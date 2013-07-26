<?php session_start();
	if (isset($_GET['mdl'])) { $mdl=$_GET['mdl']; 
		include_once("module_".$mdl.".php"); include_once("../../../class/class_base.php"); 
		$base=new base; $unit=new $mdl;
		foreach (explode("|",$unit->module_get) as $key) { 
			if (isset($_GET[$key])) { $$key=strval(trim($_GET[$key])); $unit->$key=$$key; } else { $$key=""; $unit->$key=""; } 
		}
		$base->getBaseFromModule(); $db=$base->db; $prefix=$base->prefix;
		$unit->prefix=$prefix; $unit->db=$db; $unit->base=$base;
		foreach (explode("|",$unit->module_fn) as $key) {
			$f="../../../functions/".$key.".php";
			include_once($f); 
			$$key=new $key; $unit->$key=$$key;
			$unit->$key->db=$db; $unit->$key->base=$base; $unit->$key->prefix=$prefix; 
			$unit->$key->module_name=$unit->module_name;
		} 
       $unit->fn_mdl->fn_files=$fn_files; $unit->fn_mdl->fn_ajax=$fn_ajax; 
       if ($action=="button") { $action=$id; }
       $unit->$action();
    } 
?>
