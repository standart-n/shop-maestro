<?php

class elementEditor { 

var $module_caption=	"Статичная верстка";
var $module_group=		"master";
var $module_name=		"elementEditor";
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

	case 'elementEditor':
		$title="Редактор статичной информации на сайте";
		$descr="Изменение статической информации на сайте, html редактор, управление контентом";
		$keywords="элементы, управление, html, редактор, теги";

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

function actions() {

	$show="";
	$this->install();
	switch ($this->action) {

	case 'save_element':
		$ms=$this->save_element();
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

	if (isset($this->db)) {
		if (isset($this->prefix)) {
		$sql="CREATE TABLE IF NOT EXISTS `".$this->prefix."_dataElements` (
			  `id` int(10) unsigned NOT NULL auto_increment,
			  `div_id` varchar(255) NOT NULL default '0',
			  `html` text NOT NULL,
			  `property` varchar(255) NOT NULL default '',
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 
			";
		$res=mysql_query($sql,$this->db);
		}
	}

}

function getSubId() {

		$id="";
		$sql="SELECT * FROM `".$this->prefix."_dataElements` 
				WHERE (div_id=\"".$this->div_id."\") ";
		$res=mysql_query($sql,$this->db);
		if ($res) {
			$rows_count=mysql_num_rows($res);

			if ($rows_count>0) {
				$row=mysql_fetch_array($res);
				$id=$row['id'];
			} else {
				$sql="INSERT INTO `".$this->prefix."_dataElements` 
						(div_id) values (\"".$this->div_id."\") ";
				$res=mysql_query($sql,$this->db);
				$id=mysql_insert_id();
			}
		}
		//echo $sql;
		return $id;
}

function saveHTML() {

	$this->div_id=addslashes(stripslashes($this->div_id));
	$this->html=addslashes(stripslashes($this->html));
    $sql_upd="UPDATE `".$this->prefix."_dataElements` SET html='$this->html' WHERE div_id='$this->div_id' ";
	$res=mysql_query($sql_upd,$this->db);
	if ($res) {
		$show="TRUE";
	} else {
		$show="FALSE";
	}	
	return $show;
}


function save_element() {

	$ms=array();
	$ms['result']="FALSE";
	if (isset($_POST['nmSave_id']))	{
		if (isset($_POST['nmSave_txt']))	{
			if (isset($_POST['nmSave_sub']))	{
				$skeleton=	$_POST['nmSave_id'];
				$html=		$_POST['nmSave_txt'];
				$div_id=	$_POST['nmSave_sub'];
				$this->skeleton_tb=$skeleton;
				$this->div_id=$div_id;
				$html=str_replace('"','\"',$html);
				$this->html=$html;
				$this->str_id=$this->getSubId(); 
				$ms['result']=$this->saveHTML();
			}
		}
	}
	return $ms;

}


function js() {

	$show=	$this->runn;
	$show.=		'<script src="modules/elementEditor/module_elementEditor_events.js" type="text/javascript"></script>'.$this->run; 
	$show.= 		$this->js_save();
	return $show;

}


function about() {

	$show=	$this->runn;
	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'В этом редакторе <b>Вы можете изменять содержимое блоков</b>, т.е. статичное содержимое сайта, '.$this->run;
	$show.=		'которое почти не будет меняться на разных страницах. '.$this->run;
	$show.=		'Например: меню, шапка сайта, футер и т.п. '.$this->run;
	$show.=		'Для этого <b>Вам нужно выбрать блок</b>, в который Вы хотите чтото добавить <b>и написать текст или HTML код.</b> '.$this->run;
	$show.=		'К тегам, которые Вы напишите, Вы легко сможете добавить CSS стилизацию. '.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;
}


function settings() {

	$show=	$this->runn;
	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<span class="clLabelText">Настройки</span><br>'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<table id="idTblOptions" width="100%" valign="top" align="center" border="0" cellpadding="1" cellspacing="1">'.$this->run;
	$show.=		'<tr>'.$this->run;
	$show.=		'<td align="left" width="300px">'.$this->run;
	$show.=			'<span cl="clLabel"><div id="idStatusMain"><b>Шаг 1</b>: Выберите главный блок </div></span>'.$this->run;
	$show.=		'</td>'.$this->run;
	$show.=		'<td>'.$this->run;
	$show.=			'<div id="idSelectMain">'.$this->show_main().'</div>'.$this->run;
	$show.=		'</td>'.$this->run;
	$show.=		'</tr>'.$this->run;
	$show.=		'<tr>'.$this->run;
	$show.=		'<td align="left" width="300px">'.$this->run;
	$show.=			'<span cl="clLabel"><div id="idStatusSub"></div></span>'.$this->run;
	$show.=		'</td>'.$this->run;
	$show.=		'<td>'.$this->run;
	$show.=			'<div id="idSelectSub"></div>'.$this->run;
	$show.=		'</td>'.$this->run;
	$show.=		'</tr>'.$this->run;
	$show.=		'</table>'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;

}


function form_st() {

	$show=	$this->runn;
	$show.='<form id="idFrmSave" name="nmFrmSave" action="index.php?page=elementEditor&action=save_element" method="POST">'.$this->run;
	$show.='<input type="hidden" name="nmSave_id"	id="idSave_id"		>'.$this->run;
	$show.='<input type="hidden" name="nmSave_txt"	id="idSave_txt"		>'.$this->run;
	$show.='<input type="hidden" name="nmSave_sub"	id="idSave_sub"		>'.$this->run;
	$show.='<input type="hidden" name="nmSave_type"	id="idSave_type"	>'.$this->run;
	$show.='<input type="hidden" name="nmPattern"	id="idSkeleton"	value="'.$this->skeleton_tb.'">'.$this->run;
	$show.='<input type="hidden" name="nmPrefix"	id="idPrefix"	value="'.$this->prefix.'">'.$this->runn;
	return $show;

}

function form_nd() {

	$show='</form>'.$this->runn;
	return $show;

}


function show_main() {

	$show=$this->runn;
	$ndx=0;
	$sql="SELECT * FROM `sk_".$this->skeleton_tb."_legoMain` WHERE (1=1) ORDER by id ASC";
	$res=mysql_query($sql,$this->db);
	$rows_count=mysql_num_rows($res);
	if ($rows_count>0) {
	  $show="<select class=\"option_input\" id=\"idListMain\" name=\"nmListMain\" onChange=\"listmain_change();\">".$this->run;
	  $show.='<option value="none" selected></option>'.$this->run;
		while($row=mysql_fetch_array($res)) {
			$show.='<option value="'.$row['id'].'" ';
			$show.='>'.$this->run;
			$show.=$row['div_id'].' ('.$row['comment'].')';
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
	  $show="<select class=\"option_input\" id=\"idListSub\" name=\"nmListSub\" onChange=\"listsub_change();\">";
	  $show.='<option value="none" selected></option>';
		while($row=mysql_fetch_array($res)) {
			$show.='<option value="'.$row['div_id'].'" ';
			$show.='>';
			$show.=$row['div_id'];
			//$show.=$row['caption'].'	(id='.$row['id'].')';
			$show.='</option>';
			$ndx++;
		}
	  $show.='</select>';
	}
	$ms['rows_count']=$rows_count;
	$ms['html']=$show;
	$ms['sql']=$sql;
	$ms['sql_error']=mysql_errno($this->db).":".mysql_error($this->db);
	return $ms;
}

function frame() {

	$show=	$this->runn;
	$show.='<div id="idBoxEl">'.$this->run;

	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<b>Шаг 3</b>: Отредактируйте содержимое данного блока.<br>'.$this->run;
	$show.=		'Вы можете записывать в блоки не только текст, но и HTML код.<br>'.$this->run;
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
	$show.='<textarea name="nmEl" id="idEl" rows="30" wrap="hard">';
	$show.='</textarea>'.$this->runn;			
	return $show;

}

function buttons() {

	$show=	$this->runn;
	$show.='<div id="idElButtons">'.$this->run;

	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<b>Шаг 4</b>: Не забудьте сохранить то, что Вы написали!<br>'.$this->run;
	$show.=		'После сохранения, Вы сразу сможете увидеть результат на сайте.<br>'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->run;

	$show.='<div class="clButtonLine">'.$this->run;
	$show.='<a id="idBtnSave" href="#de">Сохранить</a>'.$this->run;
	//$show.='<a id="idBtnImport" href="#de">Импорт</a>';
	$show.='</div>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;

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