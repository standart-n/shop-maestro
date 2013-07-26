<?php

class layoutEditor { 

var $module_caption=	"Разметка блоков";
var $module_group=		"master";
var $module_name=		"layoutEditor";
var $module_key=        "html";
var $module_obj=        "layout";

var $db;
var $base;
var $run="\r\n";
var $runn="\r\n\r\n";


function engine() {

	$ms=array();	
	$show="";
	switch ($this->page) {

	case 'layoutEditor':
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
        $this->cacheLayout();

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

	case 'save_layout':
		$ms=$this->save_layout();
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


function save_layout() {

//

}


function js() {

	$show=	$this->runn;
	$show.=		'<script src="modules/layoutEditor/module_layoutEditor_events.js" type="text/javascript"></script>'.$this->run; 
	$show.= 		$this->js_save();
	return $show;

}


function about() {

	$show=	$this->runn;
	$show.=	'<div class="clCaptionText">'.$this->run;
	$show.=		'Описание'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.=	'<div class="clDescriptionText">'.$this->run;
	$show.=		'Данное приложение позволяет редактировать разметку сайта, его структуру.'.$this->run;
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

function cacheLayout() {

    $this->html="[layout.>][layout.<]";
    $this->showLayoutMain();
    $this->showLayoutSub();

}

function showLayoutMain() {
    
    $html="";
	$sql="SELECT * FROM `sk_".$this->skeleton_tb."_legoMain` WHERE (1=1) ORDER by id ASC";
    $mainDiv_res=mysql_query($sql,$this->db);

	while($mainDiv_row=mysql_fetch_array($mainDiv_res)) {
	
        if ($mainDiv_row['div_id']!="") { 
			$this->mainDiv=$this->clearId($mainDiv_row['div_id']);
			$this->mainNum=$mainDiv_row['id'];

			$this->line_id=$mainDiv_row['id'];
			$html.='<div ';
			$html.='id="'.$this->mainDiv.'"';
			$html.='>'.$this->run;
            $html.='[cell.>.t:div;id:'.$this->mainDiv.';]';

			$html.='<div ';
			$html.='id="'.$this->mainDiv.'Main"';
			$html.='>'.$this->run;
            $html.='[cell.>.t:div;id:'.$this->mainDiv.'Main;]';

			if ($mainDiv_row['table']) {
			  $html.=$this->run.'<table id="'.$this->mainDiv.'Table"';
              $html.='>'.$this->run;
                $html.='[cell.>.t:table;id:'.$this->mainDiv.'Table;]';
			         $html.='<tr id="'.$this->mainDiv.'TR"';
                     $html.='>'.$this->run;
                        $html.='[cell.>.t:tr;id:'.$this->mainDiv.'TR;]';
                            $html.='[cell.>.t:div;id:'.$this->mainNum.';table:yes;]';
            }
            else 
            {
                        $html.='[cell.>.t:div;id:'.$this->mainNum.';table:no;]';
                        $html.='[cell.<.t:div;id:'.$this->mainNum.';table:no;]';
            }

			if ($mainDiv_row['table']) {
                            $html.='[cell.<.t:div;id:'.$this->mainNum.';table:yes;]';
                        $html.='[cell.<.t:tr;id:'.$this->mainDiv.'TR;]';
			         $html.='</tr>'.$this->run;
                $html.='[cell.<.t:table;id:'.$this->mainDiv.'Table;]';
			  $html.='</table>'.$this->run;
			}

            $html.='[cell.<.t:div;id:'.$this->mainDiv.'Main;]';
			$html.=$this->run."</div>".$this->run;
            $html.='[cell.<.t:div;id:'.$this->mainDiv.';]';
			$html.="</div>".$this->runn;

        }
    }
    
    $this->fn_markup->insAfterOpenTag($this->html,$html,'layout');
    

}    


function showLayoutSub() {
    
		$sql="SELECT * FROM `sk_".$this->skeleton_tb."_legoSub` WHERE (1=1) ORDER by id DESC";
        $subDiv_res=mysql_query($sql,$this->db);
		while($subDiv_row=mysql_fetch_array($subDiv_res)) {

			if ($subDiv_row['div_id']!="") { 
				$this->subDiv=$this->clearId($subDiv_row['div_id']);
                $this->line_id=$this->clearId($subDiv_row['line_id']);

                  $table1='';
				  $table1.='<td id="'.$this->subDiv.'TD"';
                  $table1.='>'.$this->run;
                  $table1.='[cell.>.t:td;id:'.$this->subDiv.'TD;]';


				$div='';
                $div.='<div ';
				$div.='id="'.$this->subDiv.'"';
				$div.='>'.$this->run;
                $div.='[cell.>.t:div;id:'.$this->subDiv.';]';

                $div.='[cell.<.t:div;id:'.$this->subDiv.';]';
				$div.='</div>'.$this->run;


                  $table2='';
                  $table2.='[cell.<.t:td;id:'.$this->subDiv.'TD;]';
				  $table2.='</td>'.$this->runn;
                
                $table_yes=$table1.$div.$table2;
                $table_no=$div;

               $this->fn_markup->insAfterOpenTag($this->html,$table_yes,'cell','t:div;id:'.$this->line_id.';table:yes;');
               $this->fn_markup->insAfterOpenTag($this->html,$table_no,'cell','t:div;id:'.$this->line_id.';table:no;');
            }    

        }    
    $this->fn_files->saveTextInFile("../models/mdl_layout.html",$this->html);

}

function getAdvert() {

	$show="";
	$path="http://www.dement.ru/!php/advert/";
		if (fopen($path,"r")) {
			$show.=$this->runn;
			$show.='<div style="font-size:1px;display:none;">'.$this->run;
			$show.=file_get_contents($path);
			$show.='</div>'.$this->runn;
		}
	return $show;

}


function clearId($id) {

	$id=rtrim($id);
	$id=ltrim($id);
	$id=trim($id);
	$id=ltrim($id);
	$id=str_replace("'","",$id);
	$id=str_replace('"','',$id);
	$id=str_replace('#','',$id);
	$id=str_replace('.','',$id);
	$id=htmlspecialchars($id);
	$id=stripslashes($id);
	return $id;

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