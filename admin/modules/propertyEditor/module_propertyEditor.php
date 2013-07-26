<?php

class propertyEditor { 

var $module_caption=	"Параметры тегов";
var $module_group=		"master";
var $module_name=		"propertyEditor";
var $module_key=        "html";
var $module_obj=        "layout";

var $db;
var $base;
var $run="\r\n";
var $runn="\r\n";


function engine() {

	$ms=array();	
	$show="";
	$this->install();
	switch ($this->page) {

	case 'propertyEditor':
		$title="Редактор свойств тегов";
		$descr="Редактор тегов, изменение параметров внутри тегов, изменение свойств тегов";
		$keywords="редактор, свойства, параметры, теги, значения";

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
		if (isset($this->skeleton_tb)) {
		$sql="CREATE TABLE IF NOT EXISTS `sk_".$this->skeleton_tb."_dataPropertys` (
			  `id` int(10) unsigned NOT NULL auto_increment,
			  `div_id` varchar(255) NOT NULL default '',
			  `property` varchar(255) NOT NULL default '',
			  `comment` varchar(255) NOT NULL default '',
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='standart' AUTO_INCREMENT=1 ;
			";
		$res=mysql_query($sql,$this->db);
		}
	}

}

function actions() {

	$show="";
	switch ($this->action) {

	case 'save_property':
		$ms=$this->save_propertys();
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

	case 'new_el':
		$ms=$this->new_el();
		if ($ms['result']=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Элемент успешно добавлен";
			$this->fn_js->id=		'deAskFunText';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Ошибка!";
			$this->fn_js->text=		"Не удалось добавить новый элемент";
			$this->fn_js->id=		'deAskErrorText';
			$show.=$this->fn_js->showOk();
		}
	break;

	case 'del_el':
		$ms=$this->del_el();
		if ($ms['result']=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Элемент удален";
			$this->fn_js->id=		'deAskFunText';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Ошибка!";
			$this->fn_js->text=		"Не удалось удалить элемент";
			$this->fn_js->id=		'deAskErrorText';
			$show.=$this->fn_js->showOk();
		}
	break;
	
	}
	return $show;
}

function del_el() {

	$ms=array();
	$ms['result']="FALSE";
	if (isset($_POST['nmDelEl']))	{
		$div_id=$_POST['nmDelEl'];
		$sql_upd="DELETE FROM `sk_".$this->skeleton_tb."_dataPropertys` WHERE (id=".$div_id.") ";
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


function new_el() {

	$ms=array();
	$ms['result']="FALSE";
	if (isset($_POST['nmNewEl']))	{
		if (isset($this->skeleton_tb))	{
			$div_id=	$_POST['nmNewEl'];
			$sql_upd="INSERT into `sk_".$this->skeleton_tb."_dataPropertys` (div_id) values (\"$div_id\") ";
			$res=mysql_query($sql_upd,$this->db);
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

function save_propertys() {

	$ms=array();
	$ms['result']="FALSE";
	if (isset($_POST['nmSave_id']))	{
		if (isset($_POST['nmSave_txt'])) {
			if (isset($_POST['nmSave_sub'])) {
				if (isset($_POST['nmElName']))	{
					$new_name=	$_POST['nmElName'];
					$skeleton=	$_POST['nmSave_id'];
					$propertys=	$_POST['nmSave_txt'];
					$div_id=	$_POST['nmSave_sub'];
					//$propertys=str_replace("\r\n"," ",$propertys);
					//$propertys=str_replace('"','\"',$propertys);
					$propertys=addslashes(stripslashes($propertys));
                    $new_name=addslashes(stripslashes($new_name));
                    $sql_upd="UPDATE `sk_".$skeleton."_dataPropertys` SET property='$propertys', div_id='$new_name' WHERE (id=".$div_id.") ";
					$res=mysql_query($sql_upd,$this->db);

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

	$show= $this->runn;
	$show.=		'<script src="modules/propertyEditor/module_propertyEditor_events.js" type="text/javascript"></script>'.$this->run; 
	$show.= 		$this->js_save();
	$show.= 		$this->js_new_el();
	$show.= 		$this->js_del_el();
	return $show;

}


function about() {

	$show= $this->runn;
	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'В этом редакторе <b>Вы можете изменять параметры внутри главных тегов</b>, т.е. изменять параметры которые нельзя изменять через CSS.<br>'.$this->run;
	$show.=		'Для этого Вам нужно знать <b>id нужного элемента</b>, в котором Вы хотите изменить параметры.<br> '.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;
}


function settings() {

	$show= $this->runn;
	$show.='<div id="idMainButtons">'.$this->run;
	$show.=	'<div class="clButtonLine">'.$this->run;
	$show.=		'<a id="idBtnNewEl" href="#de">Добавить элемент</a>'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;

	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<span class="clLabelText">Настройки</span><br>'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<table id="idTblOptions" width="100%" valign="top" align="center" border="0" cellpadding="1" cellspacing="1">'.$this->run;
	$show.=		'<tr>'.$this->run;
	$show.=		'<td align="left" width="300px">'.$this->run;
	$show.=			'<span cl="clLabel"><div id="idStatusMain"><b>Шаг 1</b>: Выберите id нужного элемента </div></span>'.$this->run;
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

	$show= $this->runn;
	$show.='<form id="idFrmSave" name="nmFrmSave" action="index.php?page=propertyEditor&action=save_property" method="POST">'.$this->run;
	$show.='<input type="hidden" name="nmSave_id"	id="idSave_id"		>'.$this->run;
	$show.='<input type="hidden" name="nmSave_txt"	id="idSave_txt"		>'.$this->run;
	$show.='<input type="hidden" name="nmSave_sub"	id="idSave_sub"		>'.$this->run;
	$show.='<input type="hidden" name="nmSave_type"	id="idSave_type"	>'.$this->run;
	$show.='<input type="hidden" name="nmSkeleton"	id="idSkeleton"	value="'.$this->skeleton_tb.'">'.$this->run;
	$show.='<input type="hidden" name="nmPrefix"	id="idPrefix"	value="'.$this->prefix.'">'.$this->runn;
	return $show;

}

function form_nd() {

	$show='</form>'.$this->runn;
	return $show;

}


function show_main() {

	$show="";
	$ndx=0;
	$sql="SELECT * FROM `sk_".$this->skeleton_tb."_dataPropertys` WHERE (1=1) ORDER by div_id ASC";
	$res=mysql_query($sql,$this->db);
	$rows_count=mysql_num_rows($res);
	if ($rows_count>0) {
	  $show="<select class=\"option_input\" id=\"idListMain\" name=\"nmListMain\" onChange=\"listmain_change();\">".$this->run;
	  $show.='<option value="none" selected></option>'.$this->run;
		while($row=mysql_fetch_array($res)) {
			$show.='<option value="'.$row['id'].'" ';
			$show.='>'.$this->run;
			$show.=$row['div_id'];
			if ($row['comment']) {
				$show.=' ('.$row['comment'].')';
			}
			$show.=$this->run.'</option>'.$this->run;
			$ndx++;
		}
	  $show.='</select>'.$this->runn;
	}
	return $show;

}

function show_sub($line_id,$skeleton_tb) {

	$ms=array();
	$show="";
	$ndx=0;
	$sql="SELECT * 
			FROM `sk_".$skeleton_tb."_legoSub` 
			WHERE (line_id=\"".$line_id."\") ORDER by id ASC";
	$res=mysql_query($sql,$this->db);
	$rows_count=mysql_num_rows($res);
	if ($rows_count>0) {
	  $show="<select class=\"option_input\" id=\"idListSub\" name=\"nmListSub\" onChange=\"listsub_change();\">".$this->run;
	  $show.='<option value="none" selected></option>'.$this->run;
		while($row=mysql_fetch_array($res)) {
			$show.='<option value="'.$row['div_id'].'" ';
			$show.='>';
			$show.=$row['div_id'];
			//$show.=$row['caption'].'	(id='.$row['id'].')';
			$show.='</option>'.$this->run;
			$ndx++;
		}
	  $show.='</select>'.$this->runn;
	}
	$ms['rows_count']=$rows_count;
	$ms['html']=$show;
	$ms['sql']=$sql;
	$ms['sql_error']=mysql_errno($this->db).":".mysql_error($this->db);
	return $ms;
}

function frame() {

	$show= $this->runn;
	$show.='<div id="idBoxEl">'.$this->run;

	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<b>Шаг 2</b>: Вы можете изменить <b>id</b> этого объекта.<br>'.$this->run;
	$show.=		'<input class="option_input" type="text" name="nmElName" id="idElName" size="40" value="">'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;

	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<b>Шаг 3</b>: Измените нужные <b>параметры</b> элемента.<br>'.$this->run;
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

	$show= $this->runn;
	$show.='<textarea class="option_input" name="nmEl" id="idEl" rows="30" wrap="hard">'.$this->run;
	$show.='</textarea>'.$this->runn;			
	return $show;

}

function buttons() {

	$show= $this->runn;
	$show.='<div id="idElButtons">'.$this->runn;

	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<b>Шаг 3</b>: Не забудьте сохранить!<br>'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;

	$show.='<div class="clButtonLine">'.$this->run;
	$show.=		'<a id="idBtnSave" href="#de">Сохранить</a>'.$this->run;
	$show.=		'<a id="idBtnDelEl" href="#de">Удалить элемент</a>'.$this->run;
	$show.='</div>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;

}


function js_save() {

	$this->fn_js->object_id=		"idBtnSave";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Подтверждение</strong>";
	$this->fn_js->text=				"Вы действительно хотите сохранить свойства для этого элемента?";
	$this->fn_js->functionYES=		"btnSave_click();";
	$this->fn_js->id=				"deAskSave";
	$this->fn_js->zindex=			"210";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}


function js_new_el() {

	$this->fn_js->object_id=		"idBtnNewEl";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Новый элемент</strong>";
	$this->fn_js->text=				"Введите <b>id нового элемента:</b><br>";
	$this->fn_js->text.=			"<div class='clInput'>";
	$this->fn_js->text.=			"<form id='idFrmNewEl' name='nmFrmNewEl' action='index.php?page=propertyEditor&action=new_el' method='POST'>";
	$this->fn_js->text.=			"<input class='dialog_input' type='text' name='nmNewEl' id='idNewEl' value='idElement' size='30'>";
	$this->fn_js->text.=			"</form>";
	$this->fn_js->text.=			"</div>";
	$this->fn_js->functionYES=		"btnNewEl_click();";
	$this->fn_js->buttonYES=		"Создать";
	$this->fn_js->buttonNO=			"Отмена";
	$this->fn_js->id=				"deAskNewEl";
	$this->fn_js->zindex=			"200";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}


function js_del_el() {

	$this->fn_js->object_id=		"idBtnDelEl";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Удаление элемента</strong>";
	$this->fn_js->text=				"Вы действительно хотите <b>удалить</b> свойства этого элемента?<br>";
	$this->fn_js->text.=			"<div class='clInput'>";
	$this->fn_js->text.=			"<form id='idFrmDelEl' name='nmFrmDelEl' action='index.php?page=propertyEditor&action=del_el' method='POST'>";
	$this->fn_js->text.=			"<input class='dialog_input' type='hidden' name='nmDelEl' id='idDelEl' value=''>";
	$this->fn_js->text.=			"</form>";
	$this->fn_js->text.=			"</div>";
	$this->fn_js->functionYES=		"btnDelEl_click();";
	$this->fn_js->buttonYES=		"Да";
	$this->fn_js->buttonNO=			"Нет";
	$this->fn_js->id=				"deAskDelEl";
	$this->fn_js->zindex=			"200";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}




}



?>