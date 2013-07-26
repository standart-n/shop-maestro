<?php

class eventsEditorMod { 

var $module_caption=	"Дин. верстка (модифицированная)";
var $module_group=	    "master";
var $module_name=	    "eventsEditorMod";
var $module_key=        "php";
var $module_obj=        "layout";

var $page;
var $action;
var $show;
var $prefix;
var $db;
var $base;
var $fn_js;
var $img="modules/eventsEditorMod/img/";
var $run="\r\n";
var $runn="\r\n\r\n";


function engine() {

	$ms=array();	
	$show="";
	//$this->install();
	switch ($this->page) {

	case 'eventsEditorMod':
		$title="Динамичная верстка";
		$descr="Этот модуль позволяет редактировать файл class_events.php, с помощью которого вы программируете переходы по страницам сайта";
		$keywords="верстка, сайт, cms, ссылки, переходы по страницам";

		$show.= 	$this->js();
		$show.=		$this->actions();
		$show.= 	$this->about();
		$show.= 	$this->buttons();
		$show.= 	$this->form_st();
		$show.= 	$this->frame();
		$show.= 	$this->form_nd();
		
		$ms['title']=		$title;
		$ms['description']=	$descr;
		$ms['keywords']=	$keywords;
		$ms['html']=		$show;
		$ms['result']=		"TRUE";
	break;
	
	}

	return $ms;
}

function install() {

	//
	$a=1;

}


function actions() {

	$show="";
	switch ($this->action) {

	case 'save_text':
		$ms=$this->save_text();
		if ($ms['result']=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Данные успешно сохранились!";
			$this->fn_js->id=		'deAskFunText';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Ошибка!";
			$this->fn_js->text=		"Не получилось сохранить текст";
			$this->fn_js->id=		'deAskErrorText';
			$show.=$this->fn_js->showOk();
		}
	break;
	
	}
	return $show;
}

function js() {

	$show=	$this->runn;
	$show.=		'<script src="modules/eventsEditorMod/module_eventsEditorMod_events.js" type="text/javascript"></script>'.$this->run; 
	$show.= 		$this->js_save_text();
	return $show;

}



function about() {

	$show=	$this->runn;
	$show.=	'<div class="clCaptionText">'.$this->run;
	$show.=		'Описание'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.=	'<div class="clDescriptionText">'.$this->run;
	$show.=		'Этот модуль позволяет редактировать файл class_events_mod.php, с помощью которого вы программируете переходы по страницам сайта.<br>'.$this->run;
	$show.=	'</div>'.$this->run;
	return $show;
}


function save_text() {

	$ms=array();
	$ms['result']="FALSE";
		if (isset($_POST['nmSave_txt']))	{
			$html_st=$this->loadModel('events_begin');
            		$html_middle=$_POST['nmSave_txt'];
			$html_end=$this->loadModel('events_end');
			$html=$html_st.$html_middle.$html_end;
            		$html=str_replace('\"','"',$html);
			if (file_exists('../class/class_events.php')) {
				$ms['result']=$this->saveTextInFile('../class/class_events_mod.php',$html);
				$ms['result']="TRUE";
			}
		}
	return $ms;

}


function saveTextInFile($file_path,$file_text) {

  $f=fopen($file_path,"w");
  if(!$f )
  {
	$show="FALSE";
  }
  else
  {
    //fputs($this->f,$this->file_text);
	fwrite($f,$file_text);
	$show="TRUE";
  }
  fclose($f);
  return $show;

}



function settings() {

	//

}


function form_st() {

	$show=	$this->runn;
	$show.='<form id="idFrmSave" name="nmFrmSave" action="index.php?page=eventsEditorMod&action=save_text" method="POST">'.$this->run;
	$show.='<input type="hidden" name="nmSave_id"	id="idSave_id"		>'.$this->run;
	$show.='<input type="hidden" name="nmSave_txt"	id="idSave_txt"		>'.$this->runn;
	return $show;

}

function form_nd() {

	$show='</form>';
	return $show;

}


function frame() {

	$show=	$this->runn;
	$show.='<div id="idBoxEv">'.$this->run;

	$show.='<div class="clTextLine">'.$this->run;
	$show.='<div id="idEventsBox">'.$this->run;
	if (file_exists('../class/class_events_mod.php')) {
		$show.=$this->module();
		}	else	{
		$show.='Не найден файл <b>class_events_mod.php</b>!';
	}
	$show.='</div>'.$this->run;
	$show.='</div>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;
	
}

function module() {

	$text=file_get_contents('../class/class_events_mod.php');
    $text=preg_replace("/\<\?php[\s\S]*?\/\*\[--- open ---\]\*\//i","",$text);
    $text=preg_replace("/\/\*\[--- close ---\]\*\/[\s\S]*?\?\>/i","",$text);
	$text=stripslashes($text);
	$show=	$this->runn;
	$show.='<textarea name="nmEv" id="idEv" class="option_input" rows="50" wrap="hard">';
	$show.=$text;			
	$show.='</textarea>'.$this->runn;			
	return $show;

}

function loadModel($name) {
    $mdl='../models/mdl_'.$name.'.html';
    if (file_exists($mdl)) {
        if (fopen($mdl,"r")) {
		   $model=file_get_contents($mdl);
         }
    }
    return $model;
    
}

function buttons() {

	$show=	$this->runn;
	$show.='<div id="idEventsButtons">'.$this->runn;
	$show.='<div class="clButtonLine">'.$this->run;
	$show.='<a class="clBtnLink" id="idBtnSaveText" href="#de"><img src="'.$this->img.'save.png">Сохранить</a>'.$this->run;
	$show.='</div>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;

}

function js_save_text() {

	$this->fn_js->object_id=		"idBtnSaveText";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Сохранение</strong>";
	$this->fn_js->text=				"Вы действительно хотите сохранить этот код?";
	$this->fn_js->functionYES=		"btnSaveText_click();";
	$this->fn_js->id=				"deAskSaveText";
	$this->fn_js->zindex=			"200";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}



}



?>