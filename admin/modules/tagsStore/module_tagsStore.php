<?php

class tagsStore { 

var $module_caption=	"HTML блоки";
var $module_group=		"master";
var $module_name=		"tagsStore";
var $module_key=        "html";
var $module_obj=        "layout";

var $page;
var $action;
var $show;
var $ndx;
var $html;
var $prefix;
var $skeleton;
var $skeleton_nm;
var $param;
var $box_id;
var $sub_id;
var $str;
var $str_id;

var $db;
var $base;
var $fn_js;
var $img="modules/tagsStore/img/";
var $run="\r\n";
var $runn="\r\n\r\n";


function engine() {

	$ms=array();	
	$show="";
	switch ($this->page) {

	case 'tagsStore':
		$title="Блоки HTML кода";
		$descr="Изменение статической информации на сайте, html редактор, управление контентом";
		$keywords="блоки, управление, html, редактор, теги";

		$show.= 	$this->js();
		$show.=		$this->actions();
		$show.=		$this->js_dialogs();
		$show.= 	$this->about();
		$show.= 	$this->settings();
		$show.= 	$this->buttons();
		$show.= 	$this->form_st();
		$show.=		$this->frame();
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

function actions() {

	$show="";
	$this->install();
	switch ($this->action) {
	
	case 'save_box':
		$ms=$this->save_box();
		if ($ms['result']=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Данные успешно сохранились";
			$this->fn_js->id=		'deAskFunText';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Ошибка при сохранении!";
			$this->fn_js->id=		'deAskErrorText';
			$show.=$this->fn_js->showOk();
		}
	break;

	case 'new_box':
		$ms=$this->new_box();
		if ($ms['result']=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Раздел успешно добавлен";
			$this->fn_js->id=		'deAskFunText';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Произошла ошибка!";
			$this->fn_js->id=		'deAskErrorText';
			$show.=$this->fn_js->showOk();
		}
	break;

	case 'del_box':
		$ms=$this->del_box();
		if ($ms['result']=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Раздел удален";
			$this->fn_js->id=		'deAskFunText';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Ошибка удаления";
			$this->fn_js->id=		'deAskErrorText';
			$show.=$this->fn_js->showOk();
		}
	break;

	case 'new_shelf':
		$ms=$this->new_shelf();
		if ($ms['result']=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Новый блок добавлен";
			$this->fn_js->id=		'deAskFunText';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Произошла ошибка!";
			$this->fn_js->id=		'deAskErrorText';
			$show.=$this->fn_js->showOk();
		}
	break;

	case 'set_shelf':
		$ms=$this->set_shelf();
		if ($ms['result']=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Блок перенесен в другой раздел";
			$this->fn_js->id=		'deAskFunText';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Произошла ошибка!";
			$this->fn_js->id=		'deAskErrorText';
			$show.=$this->fn_js->showOk();
		}
	break;

	case 'del_shelf':
		$ms=$this->del_shelf();
		if ($ms['result']=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Выбранный блок был удален";
			$this->fn_js->id=		'deAskFunText';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"При удалении блока произошла ошибка !";
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

		$sql="CREATE TABLE IF NOT EXISTS `".$this->prefix."_legoBoxes` (
			  `id` int(10) unsigned NOT NULL auto_increment,
			  `caption` varchar(255) NOT NULL default '',
			  `name` varchar(255) NOT NULL default '',
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
		$res=mysql_query($sql,$this->db);


		$sql="CREATE TABLE IF NOT EXISTS `".$this->prefix."_legoShelfs` (
			  `id` int(10) unsigned NOT NULL auto_increment,
			  `box_id` int(10) NOT NULL default '0',
			  `caption` varchar(255) NOT NULL default '',
			  `name` varchar(255) NOT NULL default '',
			  `text` text NOT NULL,
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
		$res=mysql_query($sql,$this->db);

		}
	}

}



function saveHTML() {

	$this->html=addslashes(stripslashes($this->html));
	$sql_upd="UPDATE `".$this->prefix."_legoShelfs` SET text='$this->html' WHERE id=".$this->box_id." ";
	$res=mysql_query($sql_upd,$this->db);
	if ($res) {
		$show="TRUE";
	} else {
		$show="FALSE";
	}	
	return $show;
}


function save_box() {
	
	$ms=array();
	$ms['result']="FALSE";
		if (isset($_POST['nmSave_txt']))	{
			if (isset($_POST['nmSave_sub']))	{
				$html=		$_POST['nmSave_txt'];
				$box_id=	intval(trim(htmlspecialchars($_POST['nmSave_sub'])));
				if ($box_id>0)	{
					$this->box_id=$box_id;
					$html=str_replace('"','\"',$html);
					$this->html=$html;
					$ms['result']=$this->saveHTML();

					if (isset($_POST['nmShelfCaption'])) {	
						$caption=strval(htmlspecialchars($_POST['nmShelfCaption']));
						$sql_upd="UPDATE `".$this->prefix."_legoShelfs` SET caption=\"$caption\" WHERE id=".$box_id." ";
						$res=mysql_query($sql_upd,$this->db);
					}

					if (isset($_POST['nmShelfName'])) {	
						$name=strval(htmlspecialchars($_POST['nmShelfName']));
						$sql_upd="UPDATE `".$this->prefix."_legoShelfs` SET name=\"$name\" WHERE id=".$box_id." ";
						$res=mysql_query($sql_upd,$this->db);
					}

				}
			}
		}

	return $ms;

}


function new_box() {

	$ms=array();
	$ms['result']="FALSE";
	$part="";
	$sql_upd="";
	if (isset($_POST['nmNewBox']))	{
		$part=strval(htmlspecialchars($_POST['nmNewBox']));
		if ($part!="") {
			$sql_upd="INSERT INTO `".$this->prefix."_legoBoxes` (name) values (\"$part\") ";
			$res=mysql_query($sql_upd,$this->db);
		}
	}
	
	$ms['part']=	$part;
	$ms['sql']=		$sql_upd;
	if (isset($res)) {
		if ($res) {
			$ms['result']="TRUE";
			$ms['sql_error']="NO";
		} else {
			$ms['result']="FALSE";
			$ms['sql_error']=$sql_upd;
		}	
	}

	return $ms;
}


function new_shelf() {

	$ms=array();
	$ms['result']="FALSE";
	$part="";
	$sql_upd="";
	$text="HTML";
	$name="new_block";
	if (isset($_POST['nmBoxDlg']))	{
		if (isset($_POST['nmNewShelf']))	{
			$part=intval(htmlspecialchars($_POST['nmBoxDlg']));
			$item=strval(htmlspecialchars($_POST['nmNewShelf']));
			if ($part!="") {
				$sql_upd="INSERT INTO `".$this->prefix."_legoShelfs` 
							(caption,box_id,text,name) 
								values (\"$item\",".$part.",\"$text\",\"$name\") ";
				$res=mysql_query($sql_upd,$this->db);
			}
		}
	}
	
	$ms['part']=	$part;
	$ms['sql']=		$sql_upd;
	if (isset($res)) {
		if ($res) {
			$ms['result']="TRUE";
			$ms['sql_error']="NO";
		} else {
			$ms['result']="FALSE";
			$ms['sql_error']=$sql_upd;
		}	
	}

	return $ms;
}


function del_box() {

	$ms=array();
	$ms['result']="FALSE";
	$part="";
	$sql_upd="";
	if (isset($_POST['nmBoxDlg']))	{
		$part=intval(htmlspecialchars($_POST['nmBoxDlg']));
		if ($part!="") {
			$sql_upd="DELETE FROM `".$this->prefix."_legoShelfs` WHERE (box_id=".$part.") ";
			$res=mysql_query($sql_upd,$this->db);
			$sql_upd="DELETE FROM `".$this->prefix."_legoBoxes` WHERE (id=".$part.") ";
			$res=mysql_query($sql_upd,$this->db);
		}
	}
	
	$ms['part']=	$part;
	$ms['sql']=		$sql_upd;
	if (isset($res)) {
		if ($res) {
			$ms['result']="TRUE";
			$ms['sql_error']="NO";
		} else {
			$ms['result']="FALSE";
			$ms['sql_error']=$sql_upd;
		}
	}

	return $ms;
}


function show_box_dialog() {

	$show="";
	$ndx=0;
	$sql="SELECT * FROM `".$this->prefix."_legoBoxes` WHERE (1=1) ORDER by caption ASC";
	$res=mysql_query($sql,$this->db);
	$rows_count=mysql_num_rows($res);
	if ($rows_count>0) {
	  $show="<select class='dialog_input' id='idBoxDlg' name='nmBoxDlg'>";
	 // $show.='<option value="none" selected></option>';
		while($row=mysql_fetch_array($res)) {
			$show.="<option value='".$row['id']."' ";
			$show.=">";
			$show.=$row['name'];
			$show.="</option>";
			$ndx++;
		}
	  $show.="</select>";
	}
	return $show;

}

function set_shelf() {

	$ms=array();
	$ms['result']="FALSE";
	$part="";
	$sql_upd="";
	if (isset($_POST['nmBoxDlg']))	{
		if (isset($_POST['nmSetShelf']))	{
			$part=intval(htmlspecialchars($_POST['nmBoxDlg']));
			$item=strval(htmlspecialchars($_POST['nmSetShelf']));
			if ($part!="") {
				$sql_upd="UPDATE `".$this->prefix."_legoShelfs` set box_id=".$part." WHERE (id=".$item.") ";
				$res=mysql_query($sql_upd,$this->db);
				echo $sql_upd;
			}
		}
	}
	
	$ms['part']=	$part;
	$ms['sql']=		$sql_upd;
	if (isset($res)) {
		if ($res) {
			$ms['result']="TRUE";
			$ms['sql_error']="NO";
		} else {
			$ms['result']="FALSE";
			$ms['sql_error']=$sql_upd;
		}	
	}

	return $ms;
}


function del_shelf() {

	$ms=array();
	$ms['result']="FALSE";
	$part="";
	$sql_upd="";
	if (isset($_POST['nmSave_id']))	{
		$item=intval(htmlspecialchars($_POST['nmSave_id']));
		if ($item!="") {
			$sql_upd="DELETE FROM `".$this->prefix."_legoShelfs` WHERE (id=".$item.") ";
			$res=mysql_query($sql_upd,$this->db);
		}
	}
	
	$ms['item']=	$item;
	$ms['sql']=		$sql_upd;
	if (isset($res)) {
		if ($res) {
			$ms['result']="TRUE";
			$ms['sql_error']="NO";
		} else {
			$ms['result']="FALSE";
			$ms['sql_error']=$sql_upd;
		}	
	}

	return $ms;
}


function js() {

	$show=	$this->runn;
	$show.=		'<script src="modules/tagsStore/module_tagsStore_events.js" type="text/javascript"></script>'.$this->run; 
	$show.= 		$this->js_save();
	return $show;

}


function js_dialogs() {

	$show=	$this->runn;
	$show.= 		$this->js_new_box();
	$show.= 		$this->js_new_shelf();
	$show.= 		$this->js_del_box();
	$show.= 		$this->js_del_shelf();
	$show.= 		$this->js_set_shelf();
	return $show;

}

function about() {

	$show=$this->runn;
	$show.='<div class="clCaptionText">'.$this->run;
	$show.=		'Описание'.$this->run;
	$show.='</div>'.$this->run;
	$show.='<div class="clDescriptionText">'.$this->run;
	$show.=		'В этом редакторе Вы можете хранить HTML код в специальных блоках и использовать их при верстке.<br>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;
}


function settings() {

	$show=	$this->runn;
	$show.='<div id="idMainButtons">'.$this->run;
	$show.=	'<div class="clButtonLine">'.$this->run;
	$show.=		'<a class="clBtnLink" id="idBtnNewBox" href="#de"><img src="'.$this->img.'new.png">Новый раздел</a>'.$this->run;
	$show.=		'<a class="clBtnLink" id="idBtnNewShelf" href="#de"><img src="'.$this->img.'edit.png">Новый блок</a>'.$this->run;
	$show.=		'<a class="clBtnLink" id="idBtnDelBox" href="#de"><img src="'.$this->img.'delete.png">Удалить раздел</a>'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->run;

	$show.=	$this->runn;
	$show.=	'<div class="clCaptionText">'.$this->run;
	$show.=		'Выбор блока'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<table width="100%" valign="top" align="center" border="0" cellpadding="1" cellspacing="1">'.$this->run;
	$show.=		'<tr>'.$this->run;
	$show.=		'<td align="left" width="200px">'.$this->run;
	$show.=			'<span cl="clLabel"><div id="idStatusMain">Выберите раздел </div></span>'.$this->run;
	$show.=		'</td>'.$this->run;
	$show.=		'<td>'.$this->run;
	$show.=			'<div id="idSelectMain">'.$this->show_main().'</div>'.$this->run;
	$show.=		'</td>'.$this->run;
	$show.=		'</tr>'.$this->run;
	$show.=		'<tr>'.$this->run;
	$show.=		'<td align="left" width="200px">'.$this->run;
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
	$show.='<form id="idFrmSave" name="nmFrmSave" action="index.php?page=tagsStore&action=save_box" method="POST">'.$this->run;
	$show.='<input type="hidden" name="nmSave_id"	id="idSave_id"		>'.$this->run;
	$show.='<input type="hidden" name="nmSave_txt"	id="idSave_txt"		>'.$this->run;
	$show.='<input type="hidden" name="nmSave_sub"	id="idSave_sub"		>'.$this->run;
	$show.='<input type="hidden" name="nmSave_type"	id="idSave_type"	>'.$this->run;
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
	$sql="SELECT * FROM `".$this->prefix."_legoBoxes` WHERE (1=1) ORDER by id ASC";
	$res=mysql_query($sql,$this->db);
	$rows_count=mysql_num_rows($res);
	if ($rows_count>0) {
	  $show="<select class=\"option_input\" id=\"idListMain\" name=\"nmListMain\" onChange=\"listmain_change();\">".$this->run;
	  $show.='<option value="none" selected></option>'.$this->run;
		while($row=mysql_fetch_array($res)) {
			$show.='<option value="'.$row['id'].'" ';
			$show.='>'.$this->run;
			$show.=$row['name'];
			$show.=$this->run.'</option>'.$this->run;
			$ndx++;
		}
	  $show.='</select>'.$this->runn;
	}
	return $show;

}

function show_sub($line_id) {

	$ms=array();
	$show="";
	$ndx=0;
	$sql="SELECT * 
			FROM `".$this->prefix."_legoShelfs` 
			WHERE (box_id=\"".$line_id."\") ORDER by id ASC";
	$res=mysql_query($sql,$this->db);
	$rows_count=mysql_num_rows($res);
	if ($rows_count>0) {
	  $show="<select class=\"option_input\" id=\"idListSub\" name=\"nmListSub\" onChange=\"listsub_change();\">";
	  $show.='<option value="none" selected></option>';
		while($row=mysql_fetch_array($res)) {
			$show.='<option value="'.$row['id'].'" ';
			$show.='>';
			//$show.=$row['name'];
			$show.=$row['caption'].' ('.$row['id'].')';
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
	$show.='<div id="idEditor">'.$this->run;
	$show.=$this->module();
	$show.='</div>'.$this->run;
	$show.='</div>'.$this->run;


	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<table width="100%" valign="top" align="center" border="0" cellpadding="1" cellspacing="0">'.$this->run;

	$show.=		'<tr>'.$this->run;
	$show.=		'<td align="left" width="200px">'.$this->run;
	$show.=		'<span class="clLabel">Заголовок</span>'.$this->run;
	$show.=		'</td>'.$this->run;
	$show.=		'<td>'.$this->run;
	$show.=		'<input class="option_input" type="text" name="nmShelfCaption" id="idShelfCaption" size="40" value="">'.$this->run;
	$show.=		'</tr>'.$this->run;

	$show.=		'<tr>'.$this->run;
	$show.=		'<td align="left" width="200px">'.$this->run;
	$show.=		'<span class="clLabel">Псевдоним блока</span>'.$this->run;
	$show.=		'</td>'.$this->run;
	$show.=		'<td>'.$this->run;
	$show.=		'<input class="option_input" type="text" name="nmShelfName" id="idShelfName" size="40" value="">'.$this->run;
	$show.=		'</tr>'.$this->run;

	$show.=		'</table>'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;



	$show.='</div>'.$this->runn;
	return $show;
	
}

function module() {

	$show=	$this->runn;
	$show.='<textarea class="option_input" name="nmEl" id="idEl" rows="30" wrap="hard">';
	$show.='</textarea>'.$this->runn;			
	return $show;

}

function buttons() {

	$show=	$this->runn;
	$show.='<div id="idElButtons">'.$this->run;
	$show.='<div class="clButtonLine">'.$this->run;
	$show.='<a class="clBtnLink" id="idBtnSave" href="#de"><img src="'.$this->img.'save.png">Сохранить</a>'.$this->run;
	$show.='<a class="clBtnLink" id="idBtnSetShelf" href="#de"><img src="'.$this->img.'shuffle.png">Перенести блок</a>'.$this->run;
	$show.='<a class="clBtnLink" id="idBtnDelShelf" href="#de"><img src="'.$this->img.'delete.png">Удалить блок</a>'.$this->run;
	$show.='</div>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;

}


function js_save() {

	$this->fn_js->object_id=		"idBtnSave";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Подтверждение</strong>";
	$this->fn_js->text=				"Вы действительно хотите сохранить данный HTML код?";
	$this->fn_js->functionYES=		"btnSave_click();";
	$this->fn_js->id=				"deAskSave";
	$this->fn_js->zindex=			"210";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}

function js_new_box() {

	$this->fn_js->object_id=		"idBtnNewBox";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Создание раздела</strong>";
	$this->fn_js->text=				"Введите <b>название нового раздела:</b><br>";
	$this->fn_js->text.=			"<div class='clInput'>";
	$this->fn_js->text.=			"<form id='idFrmNewBox' name='nmFrmNewBox' action='index.php?page=tagsStore&action=new_box' method='POST'>";
	$this->fn_js->text.=			"<input class='dialog_input' type='text' name='nmNewBox' id='idNewBox' value='Новый раздел' size='30'>";
	$this->fn_js->text.=			"</form>";
	$this->fn_js->text.=			"</div>";
	$this->fn_js->functionYES=		"btnNewBox_click();";
	$this->fn_js->buttonYES=		"Создать";
	$this->fn_js->buttonNO=			"Отмена";
	$this->fn_js->id=				"deAskNewBox";
	$this->fn_js->zindex=			"200";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}

function js_new_shelf() {

	$this->fn_js->object_id=		"idBtnNewShelf";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Новый блок</strong>";
	$this->fn_js->text=				"Введите название нового блока и раздел, в котором он будет содержаться:<br>";
	$this->fn_js->text.=			"<div class='clInput'>";
	$this->fn_js->text.=			"<form id='idFrmNewShelf' name='nmFrmNewShelf' action='index.php?page=tagsStore&action=new_shelf' method='POST'>";
	$this->fn_js->text.=			$this->show_box_dialog();
	$this->fn_js->text.=			"<input class='dialog_input' type='text' name='nmNewShelf' id='idNewShelf' value='Новый блок' size='30'>";
	$this->fn_js->text.=			"</form>";
	$this->fn_js->text.=			"</div>";
	$this->fn_js->functionYES=		"btnNewShelf_click();";
	$this->fn_js->buttonYES=		"Создать";
	$this->fn_js->buttonNO=			"Отмена";
	$this->fn_js->id=				"deAskNewShelf";
	$this->fn_js->zindex=			"200";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}

function js_del_box() {

	$this->fn_js->object_id=		"idBtnDelBox";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Удаление раздела</strong>";
	$this->fn_js->text=				"Вы действительно хотите <b>удалить этот раздел и все его тексты?</b><br>";
	$this->fn_js->text.=			"Если <b>да</b>, то выберите раздел, который Вы хотите удалить и нажмите <b>Удалить</b><br>";
	$this->fn_js->text.=			"Если <b>нет</b>, то нажмите <b>Отмена</b><br>";
	$this->fn_js->text.=			"<div class='clInput'>";
	$this->fn_js->text.=			"<form id='idFrmDelBox' name='nmFrmDelBox' action='index.php?page=tagsStore&action=del_box' method='POST'>";
	$this->fn_js->text.=			$this->show_box_dialog();
	$this->fn_js->text.=			"</form>";
	$this->fn_js->text.=			"</div>";
	$this->fn_js->functionYES=		"btnDelBox_click();";
	$this->fn_js->buttonYES=		"Удалить";
	$this->fn_js->buttonNO=			"Отмена";
	$this->fn_js->id=				"deAskDelBox";
	$this->fn_js->zindex=			"204";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}


function js_set_shelf() {

	$this->fn_js->object_id=		"idBtnSetShelf";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Перенести блок</strong>";
	$this->fn_js->text=				"Выберите раздел, в который вы хотите <b>перенести</b> данный блок?<br>";
 	$this->fn_js->text.=			"<div class='clInput'>";
	$this->fn_js->text.=			"<form id='idFrmSetShelf' name='nmFrmSetShelf' action='index.php?page=tagsStore&action=set_shelf' method='POST'>";
	$this->fn_js->text.=			$this->show_box_dialog();
	$this->fn_js->text.=			"<input class='dialog_input' type='hidden' name='nmSetShelf' id='idSetShelf' value='Новая статья' size='30'>";
	$this->fn_js->text.=			"</form>";
	$this->fn_js->text.=			"</div>";
	$this->fn_js->functionYES=		"btnSetShelf_click();";
	$this->fn_js->buttonYES=		"Перенести";
	$this->fn_js->buttonNO=			"Отмена";
	$this->fn_js->id=				"deAskSetShelf";
	$this->fn_js->zindex=			"204";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}

function js_del_shelf() {

	$this->fn_js->object_id=		"idBtnDelShelf";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Удаление блока</strong>";
	$this->fn_js->text=				"Вы действительно хотите <b>удалить</b> этот блок?<br>";
	$this->fn_js->functionYES=		"btnDelShelf_click();";
	$this->fn_js->buttonYES=		"Удалить";
	$this->fn_js->buttonNO=			"Отмена";
	$this->fn_js->id=				"deAskDelShelf";
	$this->fn_js->zindex=			"204";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}




}



?>