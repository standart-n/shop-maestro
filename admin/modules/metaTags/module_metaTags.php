<?php

class metaTags { 

var $module_caption=	"Мета-информация";
var $module_group=		"settings";
var $module_name=		"metaTags";
var $module_key=        "meta-tags";
var $module_obj=        "content";

var $db;
var $base;
var $run="\r\n";
var $runn="\r\n\r\n";


function engine() {

	$ms=array();	
	$show="";
	switch ($this->page) {

	case 'metaTags':
		$title="Редактор html разметки сайта";
		$descr="Изменение структуры сайта, расположения блоков, фундамент сайта";
		$keywords="расположение, управление, html, редактор, теги";

		$show.= 	$this->js();
		$show.=		$this->actions();
		$show.= 	$this->about();
		$show.= 	$this->settings();
		$show.= 	$this->form_st();
		$show.=		$this->frame();
		$show.= 	$this->form_nd();
		$show.= 	$this->buttons();
        $this->cacheMeta();

		$ms['title']=		$title;
		$ms['description']=	$descr;
		$ms['keywords']=	$keywords;
		$ms['html']=		$show;
		$ms['result']=		"TRUE";
	break;
	
	}

	return $ms;
}

function actions() {

	$show="";
	$this->install();
	switch ($this->action) {

	case 'save_meta':
		$ms=$this->save_meta();
		if ($ms['result']=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Данные успешно сохранились!";
			$this->fn_js->id=		'deAskFunText';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Ошибка при сохранении";
			$this->fn_js->id=		'deAskErrorText';
			$show.=$this->fn_js->showOk();
		}
	break;
	
	}
	return $show;
}

function install() {

//
}

function getSubId() {

//

}

function saveHTML() {

//

}


function save_meta() {

//

}


function js() {

	$show=	$this->runn;
	$show.=		'<script src="modules/metaTags/module_metaTags_events.js" type="text/javascript"></script>'.$this->run; 
	$show.= 		$this->js_save();
	return $show;

}


function about() {

	$show=	$this->runn;
	$show.=	'<div class="clCaptionText">'.$this->run;
	$show.=		'Описание'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.=	'<div class="clDescriptionText">'.$this->run;
	$show.=		'Данное приложение позволяет изменять мета-информацию на Вашем сайте.'.$this->run;
	$show.=	'</div>'.$this->run;
	return $show;
}


function settings() {

//

}


function form_st() {

//

}

function form_nd() {

//

}


function show_main() {

//

}

function show_sub($line_id,$skeleton_tb) {

//

}

function frame() {

//
	
}

function module() {

//

}

function buttons() {

//

}

function cacheMeta() {

    $this->html="";
    $this->showMeta();

}


function showMeta() {
    
        $sql="SELECT * FROM `".$this->prefix."_dataMeta` WHERE (1=1) ORDER by id DESC";
        $meta_res=mysql_query($sql,$this->db);
		if ($meta_res) {
		$this->html.="[meta_tags.>]".$this->run;
          while($meta_row=mysql_fetch_array($meta_res)) {
            $name=$meta_row['name'];
            $value=$meta_row['value'];
            $type=$meta_row['type'];
            $this->html.="[meta_".$name.".>]".$this->run;
            switch ($type) {
                case'http-equiv':
                    $this->html.='<meta '.$type.'="'.$name.'" content="'.$value.'" />';
                break;
                case'name':
                    $this->html.='<meta '.$type.'="'.$name.'" content="'.$value.'" />';
                break;
                case'name_ru':
                    $this->html.='<meta name="'.$name.'" Lang="ru" content="'.$value.'" />';
                break;
                case'name_eng':
                    $this->html.='<meta name="'.$name.'" Lang="eng" content="'.$value.'" />';
                break;
            }
            $this->html.=$this->run."[meta_".$name.".<]".$this->run;
          }    
        }
		$this->html.="[meta_tags.<]";
        $this->fn_files->saveTextInFile("../models/mdl_meta.html",$this->html);

}


function js_save() {

	$this->fn_js->object_id=		"idBtnSave";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Подтверждение</strong>";
	$this->fn_js->text=				"Вы действительно хотите сохранить HTML код для данного блока?";
	$this->fn_js->functionYES=		"btnSave_click();";
	$this->fn_js->id=				"deAskSave";
	$this->fn_js->zindex=			"210";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}


}



?>