<?php

class jsEditor { 

var $module_caption=	"JavaScript";
var $module_group=		"master";
var $module_name=		"jsEditor";
var $module_key=        "js";
var $module_obj=        "modern";

var $page;
var $action;
var $show;
var $ndx;
var $html;
var $prefix;
var $code;

var $db;
var $base;
var $fn_js;
var $run="\r\n";
var $runn="\r\n\r\n";


function engine() {

	$ms=array();	
	$show="";
	$this->install();
	switch ($this->page) {

	case 'jsEditor':
		$title="JavaScript редактор";
		$descr="JavaScript редактор, управление js кодом, добавление анимации на сайт";
		$keywords="JavaScript, jQuery, JS, код, редактор, управление";

		$show.= 	$this->js();
		$show.=		$this->actions();
		$show.= 	$this->about();
		$show.= 	$this->settings();
		$show.= 	$this->form_st();
		$show.=		$this->frame();
		$show.= 	$this->form_nd();
		$show.= 	$this->buttons();

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

	if (isset($this->db)) {
		if (isset($this->prefix)) {
		$sql="CREATE TABLE IF NOT EXISTS `".$this->prefix."_dataScripts` (
		  `id` int(10) unsigned NOT NULL auto_increment,
		  `caption` varchar(255) NOT NULL default '',
		  `name` varchar(255) NOT NULL default '',
		  `script` text NOT NULL,
		  `activation` int(2) NOT NULL default '0',
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;
		";
		$res=mysql_query($sql,$this->db);
		}
	}

}


function actions() {

	$show="";
	switch ($this->action) {

	case 'save_code':
		$ms=$this->save_code();
		if ($ms['result']=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Данные успешно сохранились!";
			$this->fn_js->id=		'deAskFunText';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Ошибка!";
			$this->fn_js->text=		"Не получилось сохранить!";
			$this->fn_js->id=		'deAskErrorText';
			$show.=$this->fn_js->showOk();
		}
	break;

	case 'new_js':
		$ms=$this->new_js();
		if ($ms['result']=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Данные успешно сохранились";
			$this->fn_js->id=		'deAskFunText';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Ошибка!";
			$this->fn_js->text=		"Не получилось сохранить!";
			$this->fn_js->id=		'deAskErrorText';
			$show.=$this->fn_js->showOk();
		}
	break;

	case 'del_js':
		$ms=$this->del_js();
		if ($ms['result']=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Скрипт удален";
			$this->fn_js->id=		'deAskFunText';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Ошибка!";
			$this->fn_js->text=		"Не получилось удалить!";
			$this->fn_js->id=		'deAskErrorText';
			$show.=$this->fn_js->showOk();
		}
	break;


	
	}
	return $show;
}

function del_js() {

	$ms=array();
	$ms['result']="FALSE";
	if (isset($_POST['nmDelJS']))	{
		$id=$_POST['nmDelJS'];
		$sql_upd="DELETE FROM `".$this->prefix."_dataScripts` WHERE (id=".$id.") ";
		$res=mysql_query($sql_upd,$this->db);
	}
	if (isset($res))	{
		if ($res) {
			$ms['result']="TRUE";
		} else {
			$ms['result']="FALSE";
		}	
	}
	return $ms;

}


function new_js() {

	$ms=array();
	$ms['result']="FALSE";
	if (isset($_POST['nmNewJS']))	{
		$name=	$_POST['nmNewJS'];
		$sql_upd="INSERT into `".$this->prefix."_dataScripts` (name) values (\"$name\") ";
		$res=mysql_query($sql_upd,$this->db);
	}
	if (isset($res))	{
		if ($res) {
			$ms['result']="TRUE";
		} else {
			$ms['result']="FALSE";
		}	
	}
	return $ms;

}

function save_code() {

	$ms=array();
	$ms['result']="FALSE";
	if (isset($_POST['nmSave_txt'])) {
		if (isset($_POST['nmSave_sub'])) {
			if (isset($_POST['nmScriptName']))	{
				if (isset($_POST['nmScriptDescr']))	{
					$new_name=	$_POST['nmScriptName'];
					$new_descr=	$_POST['nmScriptDescr'];
					$code=		$_POST['nmSave_txt'];
					$id=		$_POST['nmSave_sub'];
					//$propertys=str_replace("\r\n"," ",$propertys);
					$code=str_replace('"','\"',$code);
					$sql_upd="UPDATE `".$this->prefix."_dataScripts` SET script=\"$code\", name=\"$new_name\", caption=\"$new_descr\" WHERE (id=".$id.") ";
					$res=mysql_query($sql_upd,$this->db);

					if (isset($_POST['nmActiv']))	{
						$activ=intval(trim(htmlspecialchars($_POST['nmActiv'])));
						if ($activ>1)	{	$activ=0;	}
						$sql_upd="UPDATE `".$this->prefix."_dataScripts` SET activation=".$activ." WHERE (id=".$id.") ";
						$res=mysql_query($sql_upd,$this->db);
					}

				}
			}
		}
	}
	if (isset($res))	{
		if ($res) {
			$ms['result']="TRUE";
		} else {
			$ms['result']="FALSE";
		}	
	}
	return $ms;

}


function js() {

	$show=		$this->runn;
	$show.=		'<script src="modules/jsEditor/module_jsEditor_events.js" type="text/javascript"></script>'.$this->run; 
	$show.= 		$this->js_save();
	$show.= 		$this->js_new_js();
	$show.= 		$this->js_del_js();
	return $show;

}


function about() {

	$show=	$this->runn;
	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		"На этой странице, Вы можете полностью <b>управлять javascript'ом</b>, который есть у вас на сайте.<br>".$this->run;
	$show.=		'Вы можете разбить <b>JavaScript</b> код на тематические разделы, чтобы его было удобно хранить.<br> '.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;
}


function settings() {

	$show=	$this->runn;
	$show.='<div id="idMainButtons">'.$this->run;
	$show.=	'<div class="clButtonLine">'.$this->run;
	$show.=		'<a id="idBtnNewJS" href="#de">Новый скрипт</a>'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;

	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<span class="clLabelText">Настройки</span><br>'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<table id="idTblOptions" width="100%" valign="top" align="center" border="0" cellpadding="1" cellspacing="1">'.$this->run;
	$show.=		'<tr>'.$this->run;
	$show.=		'<td align="left" width="300px">'.$this->run;
	$show.=			'<span cl="clLabel"><div id="idStatusMain"><b>Шаг 1</b>: Выберите нужный скрипт </div></span>'.$this->run;
	$show.=		'</td>'.$this->run;
	$show.=		'<td>'.$this->run;
	$show.=			'<div id="idSelectMain">'.$this->show_main().'</div>'.$this->run;
	$show.=		'</td>'.$this->run;
	$show.=		'</tr>'.$this->run;
	$show.=		'</table>'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;

}


function form_st() {

	$show=	$this->runn;
	$show.='<form id="idFrmSave" name="nmFrmSave" action="index.php?page=jsEditor&action=save_code" method="POST">'.$this->run;
	$show.='<input type="hidden" name="nmSave_id"	id="idSave_id"		>'.$this->run;
	$show.='<input type="hidden" name="nmSave_txt"	id="idSave_txt"		>'.$this->run;
	$show.='<input type="hidden" name="nmSave_sub"	id="idSave_sub"		>'.$this->run;
	$show.='<input type="hidden" name="nmSave_type"	id="idSave_type"	>'.$this->runn;
	return $show;

}

function form_nd() {

	$show='</form>'.$this->runn;
	return $show;

}


function show_main() {

	$show=	$this->runn;
	$ndx=0;
	$sql="SELECT * FROM `".$this->prefix."_dataScripts` WHERE (1=1) ORDER by id ASC";
	$show.=$sql;
	$res=mysql_query($sql,$this->db);
	$rows_count=mysql_num_rows($res);
	if ($rows_count>0) {
	  $show="<select class=\"option_input\" id=\"idListMain\" name=\"nmListMain\" onChange=\"listmain_change();\">".$this->run;
	  $show.='<option value="none" selected></option>'.$this->run;
		while($row=mysql_fetch_array($res)) {
			$show.='<option value="'.$row['id'].'" ';
			$show.='>'.$this->run;
			$show.=$row['name'];
			if ($row['caption']) {
				$show.=' ('.$row['caption'].')';
			}
			$show.='</option>'.$this->run;
			$ndx++;
		}
	  $show.='</select>'.$this->runn;
	}
	return $show;

}

function show_activation($activ) {

	$show="";
	$ndx=0;
	  $show="<select class=\"option_input\" id=\"idActiv\" name=\"nmActiv\">";
	  $show.='<option value="0"';
	  	if ($activ==0)	{	$show.=' selected ';	}
		$show.='>Выводить скрипт автоматич. на всех страницах</option>';
	  $show.='<option value="1"';
	  	if ($activ==1)	{	$show.=' selected ';	}
		$show.='>Выводить скрипт вручную на опред. страницах</option>';
	  $show.='</select>';
	return $show;

}

function frame() {

	$show=	$this->runn;
	$show.='<div id="idBoxEl">'.$this->run;

	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<b>Шаг 2</b>: Вы можете изменить <b>название</b> этого скрипта.<br>'.$this->run;
	$show.=		'Название должно быть <b>латинскими</b> буквами!<br>'.$this->run;
	$show.=		'<input class="option_input" type="text" name="nmScriptName" id="idScriptName" size="40" value="">'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;

	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<b>Шаг 3</b>: Вы можете изменить <b>кратное описание</b>.<br>'.$this->run;
	$show.=		'<input class="option_input" type="text" name="nmScriptDescr" id="idScriptDescr" size="40" value="">'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;

	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<b>Шаг 4</b>: Вы можете изменить тип отображения скрипта на страницах сайта.<br>'.$this->run;
	$show.=		'<div id="idSelectActiv"></div>'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;

	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<b>Шаг 5</b>: Измените старый или напишите новый <b>javascript код</b>.<br>'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;

	$show.='<div class="clTextLine">'.$this->run;
	$show.='<div id="idEditor">'.$this->run;
	$show.=$this->module();
	$show.='</div>'.$this->run;
	$show.='</div>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;
	
}

function module() {

	$show=	$this->runn;
	$show.='<textarea class="option_input" name="nmEl" id="idEl" rows="30" wrap="hard">'.$this->run;
	$show.='</textarea>'.$this->runn;			
	return $show;

}

function buttons() {

	$show=	$this->runn;
	$show.='<div id="idElButtons">'.$this->run;

	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<b>Шаг 6</b>: Не забудьте сохранить!<br>'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;

	$show.='<div class="clButtonLine">'.$this->run;
	$show.=		'<a id="idBtnSave" href="#de">Сохранить код</a>'.$this->run;
	$show.=		'<a id="idBtnDelJS" href="#de">Удалить скрипт</a>'.$this->run;
	$show.='</div>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;

}


function js_save() {

	$this->fn_js->object_id=		"idBtnSave";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Подтверждение</strong>";
	$this->fn_js->text=				"Вы действительно хотите сохранить этот скрипт?";
	$this->fn_js->functionYES=		"btnSave_click();";
	$this->fn_js->id=				"deAskSave";
	$this->fn_js->zindex=			"210";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}


function js_new_js() {

	$this->fn_js->object_id=		"idBtnNewJS";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Новый скрипт</strong>";
	$this->fn_js->text=				"Введите <b>название</b> нового скрипта:</b><br>";
	$this->fn_js->text.=			"<div class='clInput'>";
	$this->fn_js->text.=			"<form id='idFrmNewJS' name='nmFrmNewJS' action='index.php?page=jsEditor&action=new_js' method='POST'>";
	$this->fn_js->text.=			"<input class='dialog_input' type='text' name='nmNewJS' id='idNewJS' value='new_script' size='30'>";
	$this->fn_js->text.=			"</form>";
	$this->fn_js->text.=			"</div>";
	$this->fn_js->functionYES=		"btnNewJS_click();";
	$this->fn_js->buttonYES=		"Создать";
	$this->fn_js->buttonNO=			"Отмена";
	$this->fn_js->id=				"deAskNewJS";
	$this->fn_js->zindex=			"200";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}


function js_del_js() {

	$this->fn_js->object_id=		"idBtnDelJS";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Удаление</strong>";
	$this->fn_js->text=				"Вы действительно хотите <b>удалить</b> этот скрипт?<br>";
	$this->fn_js->text.=			"<div class='clInput'>";
	$this->fn_js->text.=			"<form id='idFrmDelJS' name='nmFrmDelJS' action='index.php?page=jsEditor&action=del_js' method='POST'>";
	$this->fn_js->text.=			"<input class='dialog_input' type='hidden' name='nmDelJS' id='idDelJS' size='30'>";
	$this->fn_js->text.=			"</form>";
	$this->fn_js->text.=			"</div>";
	$this->fn_js->functionYES=		"btnDelJS_click();";
	$this->fn_js->buttonYES=		"Да";
	$this->fn_js->buttonNO=			"Нет";
	$this->fn_js->id=				"deAskDelJS";
	$this->fn_js->zindex=			"200";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}




}



?>