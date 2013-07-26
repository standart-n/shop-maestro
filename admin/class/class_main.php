<?php class main { 
var $source="";
var $menu=array();
var $ms=array();
var $de=array();
var $fn=array();
function engine() { $task=explode("|","classes|modules|functions|settings|enter|page");
	foreach ($task as $key) { $t="check_".$key; $this->$t(); }
	return $this->source;
}
function check_classes() { 
	foreach (explode("|","base|enter") as $key) { if (class_exists($key)) { $this->$key=new $key; } } 
}
function check_modules() {
	chdir("./modules"); $dir=opendir(".");
	while ($d=readdir($dir)) { if (is_dir($d)) { if (($d!=".") && ($d!="..")) { $this->modules[]['name']=$d; } } }
	closedir($dir); chdir("..");	
    asort($this->modules); reset($this->modules);
    foreach ($this->modules as $mdl) { 
		$nm=$mdl['name']; $mdl='modules/'.$nm.'/module_'.$nm.'.php';
		if (file_exists($mdl)) { include_once($mdl); if(class_exists($nm)) { $this->$nm=new $nm; } }
	}
}
function check_functions() {
	chdir("../functions"); $dir=opendir(".");
	while ($d=readdir($dir)) { if (is_file($d)) { $this->fn[]['path']=$d; } }
	closedir($dir);
    for ($i=0;$i<sizeof($this->fn);$i++) {
		include_once('../functions/'.$this->fn[$i]['path']);
		$name=str_replace('.php','',$this->fn[$i]['path']);
		if (class_exists($name)) {
			$this->$name=new $name;
			$this->fn[$i]['fn']=$this->$name;
			$this->fn[$i]['name']=$name;
		}
	}
}
function check_settings() { 		
	if (class_exists("base")) {
		$this->base=new base;
		$this->de=$this->base->getBaseFromAdmin($this->de); 	
		$this->de=$this->base->getSettings($this->de); 
		$this->de=$this->base->getPattern($this->de);
		$this->de=$this->base->getSkeleton($this->de); 
		$this->de['base']=$this->base;
	}
	$get=explode("|","id|page|action|task|node|subnode");
	foreach ($get as $key) { if (isset($_GET[$key])) { $this->de[$key]=strval(trim($_GET[$key])); } else { $this->de[$key]=""; } }
	if ($this->de['id']=="") { $this->de['id']="0"; }
	if ($this->de['page']=="") { $this->de['page']="mainPage"; }
    for ($i=0;$i<sizeof($this->fn);$i++) {
    	$fn=$this->fn[$i]['name'];
    	foreach ($this->de as $key => $value) { $this->$fn->$key=$value; }
    	$this->de[$fn]=$this->$fn;
	}
    asort($this->modules); reset($this->modules);
    foreach ($this->modules as $mdl) { $nm=$mdl['name'];
		if (isset($this->$nm)) { $m=$this->$nm;
			foreach ($this->de as $key => $value) { $this->$nm->$key=$value; }
			if (isset($m->module_group)) { if (isset($m->module_caption)) {
				$caption=$m->module_caption; $name=$m->module_name;  $mark="menu_".$m->module_group;
				if (strlen($caption)>18) { $caption=substr($caption,0,17)."..."; }
				$this->menu[$mark][]='<a href="index.php?page='.$name.'">'.$caption.'</a>';
			} }
		}
	}
    if (isset($this->mainPage)) { $this->mainPage->modules=$this->modules; }
}
function check_enter() { 
	if (class_exists("enter")) {
		if (isset($this->enter)) {
			foreach($this->de as $key => $value) { $this->enter->$key=$value; }
			$this->enter->engine();
		}
	} 
}
function check_page() {
  if ((isset($this->fn_markup)) && (isset($this->fn_models))) {
	$mu=$this->fn_markup; $mo=$this->fn_models; $mo->local="../admin/";
	$this->source=$mo->loadModel("admin_layout");
	if (isset($this->enter)) { $in=$this->enter->check_user(); } else { $in="TRUE"; }
	if ($in=="TRUE") {
        reset($this->modules);
        foreach ($this->modules as $mdl) { $nm=$mdl['name'];
			if (isset($this->$nm)) { $this->ms=$this->$nm->engine();
				if (isset($this->ms['result'])) { if ($this->ms['result']=="TRUE") {
					foreach (explode("|","html|title|keywords|description|js|css") as $key) { 
						if (isset($this->ms[$key])) { $this->$key=$this->ms[$key]; } 
					}
				} }
			}
        }
		if (isset($this->sitename)) {		$mu->insPlaceDualTag($this->source,$this->sitename,"project");		}
		if (isset($this->title)) 	{		$mu->insPlaceDualTag($this->source,$this->title,"title"); 			}
		if (isset($this->js))	 	{		$mu->insBeforeCloseTag($this->source,$this->js,"js");				}
		if (isset($this->css))	 	{		$mu->insBeforeCloseTag($this->source,$this->css,"style");			}
		if (isset($this->html)) 	{		$mu->insBeforeCloseTag($this->source,$this->html,"content");		}
		$mu->insBeforeCloseTag($this->source,$mo->loadModel("admin_menu"),"menu");
	    while (list($option,$line)=each($this->menu)) { while (list($field,$value)=each($line)) { 
			$mu->insBeforeCloseTag($this->source,$value,$option); 
		}	} 
	} else {
		$mu->insBeforeCloseTag($this->source,$mo->loadModel("admin_enter"),"content");
	}
    $this->fn_markup->insPlaceAllOpenTag($this->source,'');
    $this->fn_markup->insPlaceAllKeyTag($this->source,'');	
    $this->fn_markup->insPlaceAllCloseTag($this->source,'');
  }
  if (!isset($this->source)) { $this->source="..."; }
}
function read_module($name) {
  	if (isset($this->$name)) { $this->ms=$this->$name->engine();
		if (isset($this->ms['result'])) { if ($this->ms['result']=="TRUE") {
            foreach (explode("|","title|keywords|description|js|css") as $key) { 
				if (isset($this->ms[$key])) { $this->$key=$this->ms[$key]; } 
			}
            $this->html=$this->ms['html'];	unset($this->ms);
		} }
	}
}
} ?>
