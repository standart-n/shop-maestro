<?php

class textEditor { 

var $module_caption=	"Текстовый редактор";
var $module_group=		"user";
var $module_name=		"textEditor";
var $module_key=        "тексты";
var $module_obj=        "content";

var $page;
var $action;
var $show;
var $prefix;
var $db;
var $base;
var $fn_js;
var $run="\r\n";
var $runn="\r\n\r\n";


function init() {
    
    $this->img="modules/".$this->module_name."/img/";
    $this->css="modules/".$this->module_name.".css";
    $this->main_module=$this->module_name;
    $this->main_title="Разделы";
    $this->main_name="main";
    $this->main_order="caption asc";
    $this->main_tbl=$this->prefix."_dataParts";
    $this->main_captions="Название";
    $this->main_fields="id;caption";
    $this->main_widths="40;600";
    $this->main_buttons="rename;delete";
    $this->connect="part_id";

    $this->sub_module=$this->module_name;
    $this->sub_title="Статьи";
    $this->sub_name="sub";
    $this->sub_order="name asc";
    $this->sub_tbl=$this->prefix."_dataTexts";
    $this->sub_captions="Название";
    $this->sub_fields="id;caption;path";
    $this->sub_widths="40;300;400";
    $this->sub_buttons="delete";


}

function engine() {


	$ms=array();	
	$show="";
    $this->init();
	$this->install();
	switch ($this->page) {

	case 'textEditor':
		$title="Текстовый редактор";
		$descr="Текстовый редактор, форматирование текстов, написание статей, word";
		$keywords="текстовый редактор, word, on-line редактор текстов, форматирование";

		$show.= 	$this->js();
		$show.=		$this->actions();
		$show.= 	$this->about();
		$show.= 	$this->showMainBtn();
        $show.=     "<div id=\"mdl_main\">".$this->showMain()."</div>";
		$show.= 	$this->showSubCreate();
        $show.=     "<div id=\"mdl_sub\">".$this->showSub()."</div>";
		$show.= 	$this->showSubBtn();
		$show.= 	$this->form_st();
		$show.= 	$this->frame();
		$show.= 	$this->showSubSettings();
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


function js() {

	$show="";
	$show.='<script src="modules/textEditor/module_textEditor_events.js" type="text/javascript"></script>'; 
    $show.=$this->js_main_delete();
    $show.=$this->js_main_deleteAct();
    $show.=$this->js_main_rename();
    $show.=$this->js_main_renameAct();
    $show.=$this->js_main_create();
    $show.=$this->js_sub_delete();
    $show.=$this->js_sub_deleteAct();
    $show.=$this->js_sub_create();
    $show.=$this->js_sub_save();
    $show.=$this->js_sub_setAct();
	return $show;

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
			//$show.=$this->fn_js->showOk();
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



function about() {

	$show=	$this->runn;
	$show.=	'<div class="clCaptionText">';
	$show.=		'Описание';
	$show.=	'</div><div id="#demented"></div>';
	$show.=	'<div class="clDescriptionText">';
	$show.=		'Данное приложение позволяет полностью управлять статьями, которые находятся на сайте.';
	$show.=		'Вы можете создавать новые, изменять или удалять уже существующие.';
	$show.=		'Для работы с контентом вы можете использовать панель инструментов, которая поможет вам отформатировать текст именно так, как вы хотите.';
	$show.=	'</div>';
	return $show;
}


function showMain() {
    
    $this->fn_admin->db=$this->db;
    $this->fn_admin->prefix=$this->prefix;
    $show='';
    $show.=$this->fn_admin->showTable(      "main",
                                            $this->main_module,
                                            $this->main_title,
                                            $this->main_name,
                                            $this->main_tbl,
                                            $this->main_captions,
                                            $this->main_fields,
                                            $this->main_widths,
                                            $this->main_buttons,
                                            $this->main_order
                                         );
    return $show;    
}

function showSub() {
    
    $this->fn_admin->db=$this->db;
    $this->fn_admin->prefix=$this->prefix;
    $this->fn_admin->connect=$this->connect;
    $show='';
    $show.=$this->fn_admin->showTable(      "sub",
                                            $this->sub_module,
                                            $this->sub_title,
                                            $this->sub_name,
                                            $this->sub_tbl,
                                            $this->sub_captions,
                                            $this->sub_fields,
                                            $this->sub_widths,
                                            $this->sub_buttons,
                                            $this->sub_order
                                         );
    return $show;    
}

function save_text() {

	$ms=array();
	$ms['result']="FALSE";
	$id="";
	$text="";
	$sql_upd="";
	if (isset($_POST['nmSave_sub_id']))	{
		if (isset($_POST['nmSave_txt']))	{
			$id=	$_POST['nmSave_sub_id'];
			$text=	$_POST['nmSave_txt'];
			$text=	str_replace('"','\"',$text);
			$text=addslashes(stripslashes($text));
            $sql_upd="UPDATE `".$this->sub_tbl."` SET text=\"$text\",last_dt=NOW(),last_t=NOW(),last_d=NOW() WHERE id=".$id." ";
			$res=mysql_query($sql_upd,$this->db);
		}
	}
	$ms['id']=		$id;
	$ms['text']=	$text;
	$ms['sql']=		$sql_upd;

	if (isset($res)) {


		if ($res) {
			$ms['result']="TRUE";
			$ms['sql_error']="NO";
		} else {
			$ms['result']="FALSE";
			$ms['sql_error']=$sql_upd;
		}

		if (isset($_POST['nmTextCaption'])) {
			$caption=strval(htmlspecialchars($_POST['nmTextCaption']));
			$sql_upd="UPDATE `".$this->sub_tbl."` SET `caption`=\"$caption\" WHERE id=".$id." ";
			$res=mysql_query($sql_upd,$this->db);
		}
	
		if (isset($_POST['nmTextName'])) {	
			$name=strval(htmlspecialchars($_POST['nmTextName']));
			$sql_upd="UPDATE `".$this->sub_tbl."` SET `name`=\"$name\" WHERE id=".$id." ";
			$res=mysql_query($sql_upd,$this->db);
		}

		if (isset($_POST['nmTextTitle'])) {	
			$name=strval(htmlspecialchars($_POST['nmTextTitle']));
			$sql_upd="UPDATE `".$this->sub_tbl."` SET `title`=\"$name\" WHERE id=".$id." ";
			$res=mysql_query($sql_upd,$this->db);
		}

		if (isset($_POST['nmTextGroup'])) {	
			$name=strval(htmlspecialchars($_POST['nmTextGroup']));
			$sql_upd="UPDATE `".$this->sub_tbl."` SET `group`=\"$name\" WHERE id=".$id." ";
			$res=mysql_query($sql_upd,$this->db);
		}

		if (isset($_POST['nmTextKey'])) {	
			$name=strval(htmlspecialchars($_POST['nmTextKey']));
			$sql_upd="UPDATE `".$this->sub_tbl."` SET `key`=\"$name\" WHERE id=".$id." ";
			$res=mysql_query($sql_upd,$this->db);
		}
	
		if (isset($_POST['nmTextDescr'])) {
			$descr=strval(htmlspecialchars($_POST['nmTextDescr']));
			$sql_upd="UPDATE `".$this->sub_tbl."` SET `description`=\"$descr\" WHERE id=".$id." ";
			$res=mysql_query($sql_upd,$this->db);
		}
	
		if (isset($_POST['nmTextKeywords'])) {
			$keywords=strval(htmlspecialchars($_POST['nmTextKeywords']));
			$sql_upd="UPDATE `".$this->sub_tbl."` SET `keywords`=\"$keywords\" WHERE id=".$id." ";
			$res=mysql_query($sql_upd,$this->db);
		}

		if ((isset($_POST['nmTextGroup'])) && (isset($_POST['nmTextName']))) {	
			$name=strval(htmlspecialchars($_POST['nmTextName']));
			$group=strval(htmlspecialchars($_POST['nmTextGroup']));
            //$path="/de.".$group.".".$name."/";
            $path="";
            if ($group!="") { $path.=".".$group; }
            if ($name!="") { $path.=".".$name; }
            if ($path!="") { $path="/de".$path."/"; }
             
			$sql_upd="UPDATE `".$this->sub_tbl."` SET `path`=\"$path\" WHERE id=".$id." ";
			$res=mysql_query($sql_upd,$this->db);
		}
	
	}

	return $ms;
}

function showSubDialog() {

	$show="";
	$ndx=0;
	$sql="SELECT * FROM `".$this->main_tbl."` WHERE (1=1) ORDER by caption ASC";
	$res=mysql_query($sql,$this->db);
	$rows_count=mysql_num_rows($res);
	if ($rows_count>0) {
	  $show="<select class='dialog_input' id='sub_input_set' name='sub_input_set'>";
	 // $show.='<option value="none" selected></option>';
		while($row=mysql_fetch_array($res)) {
			$show.="<option value='".$row['id']."' ";
			$show.=">";
			$show.=$row['caption'];
			$show.="</option>";
			$ndx++;
		}
	  $show.="</select>";
	}
	return $show;

}


function set_item() {

	$ms=array();
	$ms['result']="FALSE";
	$part="";
	$sql_upd="";
	if (isset($_POST['nmDelPart']))	{
		if (isset($_POST['nmSetItem']))	{
			$part=intval(htmlspecialchars($_POST['nmDelPart']));
			$item=strval(htmlspecialchars($_POST['nmSetItem']));
			if ($part!="") {
				$sql_upd="UPDATE `".$this->prefix."_dataTexts` set part_id=".$part." WHERE (id=".$item.") ";
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


function main_delete() {

  if ((isset($this->db)) && (isset($this->prefix)) && (isset($this->id)) && (isset($this->connect)) && (isset($this->main_tbl)) && (isset($this->sub_tbl))) {
	if ($this->id>0)	{
			$sql="DELETE FROM `".$this->sub_tbl."` WHERE (".$this->connect."=".$this->id.") ";
			$res=mysql_query($sql,$this->db);
			$sql="DELETE FROM `".$this->main_tbl."` WHERE (id=".$this->id.") ";
			$res=mysql_query($sql,$this->db);
	}
  }
}

function main_rename() {

  if ((isset($this->db)) && (isset($this->prefix)) && (isset($this->id))  && (isset($this->text)) && (isset($this->connect)) && (isset($this->main_tbl)) && (isset($this->sub_tbl))) {
	if ($this->id>0)	{
			$sql="UPDATE `".$this->main_tbl."` set caption='$this->text' WHERE (id=".$this->id.") ";
			$res=mysql_query($sql,$this->db);
	}
  }
}

function main_create() {

  if ((isset($this->db)) && (isset($this->text))) {
			$sql="INSERT into `".$this->main_tbl."`  (caption) values ('$this->text') ";
			$res=mysql_query($sql,$this->db);
  }
}





function sub_delete() {

  if ((isset($this->db)) && (isset($this->id)) && (isset($this->sub_tbl))) {
	if ($this->id>0)	{
			$sql="DELETE FROM `".$this->sub_tbl."` WHERE (id=".$this->id.") ";
			$res=mysql_query($sql,$this->db);
	}
  }
}

function sub_set() {

  if ((isset($this->db)) && (isset($this->id)) && (isset($this->sub_tbl))) {
	if ($this->id>0)	{
			$sql="UPDATE `".$this->sub_tbl."` set ".$this->connect."=".$this->id." WHERE (id=".$this->sub_act.") ";
			$res=mysql_query($sql,$this->db);
	}
  }
}

function sub_create() {

  if ((isset($this->db)) && (isset($this->id)) && (isset($this->sub_tbl)) && (isset($this->text))) {
				$sql="INSERT INTO `".$this->sub_tbl."` 
							(caption,part_id,text,name,post_dt,post_t,post_d,last_dt,last_d,last_t) 
								values (\"$this->text\",'".$this->id."','текст...','name',NOW(),NOW(),NOW(),NOW(),NOW(),NOW()) ";
    			$res=mysql_query($sql,$this->db);
  }
}

function sub_open() {
    
    $ms=array();
    if ((isset($this->db)) && (isset($this->prefix)) && (isset($this->id))) {
   	$sql="SELECT * FROM `".$this->sub_tbl."` WHERE (id=".$this->id.") ";
	$res=mysql_query($sql,$this->db);
	$row=mysql_fetch_array($res);
	if ($row['id']) {

		$ms['caption']=	    strval(htmlspecialchars($row['caption']));
		$ms['name']=		strval(htmlspecialchars($row['name']));
		$ms['title']=	    strval(htmlspecialchars($row['title']));
		$ms['group']=	    strval(htmlspecialchars($row['group']));
		$ms['key']=	        strval(htmlspecialchars($row['key']));
		$ms['descr']=	    strval(htmlspecialchars($row['description']));
		$ms['keywords']=	strval(htmlspecialchars($row['keywords']));

		$text=			$row['text'];
		$text=			str_replace('"photo/','"../photo/',$text);
		$text=			str_replace('"files/','"../files/',$text);
		$text=			str_replace("<o:p>","",$text);
		$text=			str_replace("</o:p>","",$text);
		$text=			str_replace("'",'"',$text);
		$text=			str_replace("\r\n","",$text);
       	$text=          ltrim($text);
        $text=          rtrim($text);
		$text=addslashes(stripslashes($text));
        $ms['text']=$text;
        
		$html=			"";
		$html.=			$this->fn_frame->start();
		$html.=			'<link href=\"modules/textEditor/module_textEditor_style.css\" rel=\"stylesheet\" type=\"text/css\">';
		$html.=			$this->fn_frame->body();
		$html.=			$text;
		$html.=			$this->fn_frame->finish();
        $ms['html']=$html;
    }
  }
  return $ms;

}

function showMainBtn() {

	$show="";
    $show.='<div id="idMainButtons">';
	$show.=	'<div class="clButtonLine">';
	$show.=		'<a class="clBtnLink" id="btn_main_create" href="#de"><img src="'.$this->img.'new.png">Новый<br>раздел</a>';
	$show.=	'</div>';
	$show.='</div>';
	return $show;

}

function showSubCreate() {

	$show="";
	$show.='<div style="display:none;" id="idSubCreate">';
	$show.='<div class="clButtonLine">';
	$show.='<a class="clBtnLink" id="btn_sub_create" href="#de"><img src="'.$this->img.'new.png">Новая<br>статья</a>';
	$show.='<a class="clBtnLink" id="btn_main_renameAct" href="#de"><img src="'.$this->img.'shuffle.png">Переимен.<br>раздел</a>';
	$show.='<a class="clBtnLink" id="btn_main_deleteAct" href="#de"><img src="'.$this->img.'delete.png">Удалить<br>раздел</a>';
	$show.='</div>';
	$show.='</div>';
	return $show;
    
}

function showSubBtn() {

	$show="";
	$show.='<div style="display:none;" id="idSubButtons">';
	$show.='<div class="clButtonLine">';
	$show.='<a class="clBtnLink" id="btn_sub_save" href="#de"><img src="'.$this->img.'save.png">Сохранить</a>';
	$show.='<a class="clBtnLink" id="idBtnHTML" href="#de"><img src="'.$this->img.'code.png">HTML<br>код</a>';
	$show.='<a class="clBtnLink" id="btn_sub_setAct" href="#de"><img src="'.$this->img.'shuffle.png">Перенести<br>статью</a>';
	$show.='<a class="clBtnLink" id="btn_sub_deleteAct" href="#de"><img src="'.$this->img.'delete.png">Удалить<br>статью</a>';
	$show.='</div>';
	$show.='</div>';
	return $show;

}

function showSubSettings() {
    
   	$show='';
	$show.='<div style="display:none;" id="idSubSettings">';
   	$show.=	'<div class="clCaptionText">';
	$show.=		'Настройки';
	$show.=	'</div>';

	$show.='<div class="clTextLine">';
	$show.=	'<div class="clSomeText">';
	$show.=		'<table width="100%" valign="top" align="center" border="0" cellpadding="1" cellspacing="0">';

	$show.=		'<tr>';
	$show.=		'<td align="left" width="200px">';
	$show.=		'<span class="clLabel">Заголовок статьи</span>';
	$show.=		'</td>';
	$show.=		'<td>';
	$show.=		'<input class="option_input" type="text" name="nmTextCaption" id="idTextCaption" size="40" value="">';
	$show.=		'</tr>';

	$show.=		'<tr>';
	$show.=		'<td align="left" width="200px">';
	$show.=		'<span class="clLabel">Подзаголовок</span>';
	$show.=		'</td>';
	$show.=		'<td>';
	$show.=		'<input class="option_input" type="text" name="nmTextTitle" id="idTextTitle" size="40" value="">';
	$show.=		'</tr>';

	$show.=		'<tr>';
	$show.=		'<td align="left" width="200px">';
	$show.=		'<span class="clLabel">Псевдоним</span>';
	$show.=		'</td>';
	$show.=		'<td>';
	$show.=		'<input class="option_input" type="text" name="nmTextName" id="idTextName" size="40" value="">';
	$show.=		'</tr>';

	$show.=		'<tr>';
	$show.=		'<td align="left" width="200px">';
	$show.=		'<span class="clLabel">Группа</span>';
	$show.=		'</td>';
	$show.=		'<td>';
	$show.=		'<input class="option_input" type="text" name="nmTextGroup" id="idTextGroup" size="40" value="">';
	$show.=		'</tr>';

	$show.=		'<tr>';
	$show.=		'<td align="left" width="200px">';
	$show.=		'<span class="clLabel">Метка</span>';
	$show.=		'</td>';
	$show.=		'<td>';
	$show.=		'<input class="option_input" type="text" name="nmTextKey" id="idTextKey" size="40" value="">';
	$show.=		'</tr>';

	$show.=		'<tr>';
	$show.=		'<td align="left" width="200px">';
	$show.=		'<span class="clLabel">Краткое описание</span>';
	$show.=		'</td>';
	$show.=		'<td>';
	$show.=		'<input class="option_input" type="text" name="nmTextDescr" id="idTextDescr" size="40" value="">';
	$show.=		'</tr>';

	$show.=		'<tr>';
	$show.=		'<td align="left" width="200px">';
	$show.=		'<span class="clLabel">Ключевые слова</span>';
	$show.=		'</td>';
	$show.=		'<td>';
	$show.=		'<input class="option_input" type="text" name="nmTextKeywords" id="idTextKeywords" size="40" value="">';
	$show.=		'</tr>';

	$show.=		'</table>';
	$show.=	'</div>';
	$show.='</div>';
	$show.='</div>';
    return $show;
    
}

function form_st() {

	$show=	$this->runn;
	$show.='<form id="idFrmSave" name="nmFrmSave" action="index.php?page=textEditor&action=save_text" method="POST">';
	$show.='<input type="hidden" name="nmSave_sub_id"	id="idSave_sub_id"		 >';
	$show.='<input type="hidden" name="nmSave_main_id"	id="idSave_main_id"      >';
	$show.='<input type="hidden" name="nmSave_txt"	    id="idSave_txt"	 	     >';
	return $show;

}

function frame() {

	$show=	$this->runn;
	$show.='<div style="display:none;" id="idSubBox">';
	$show.='<div class="clTextLine">';
	$show.='<div id="idEditor">';
	$show.=$this->module();
	$show.='</div>';
	$show.='</div>';
	$show.='</div>';
	return $show;
	
}

function form_nd() {

	$show='</form>';
	return $show;

}


function js_askWindow($obj,$type,$action,$title,$text) {

	$this->fn_js->object=	     	$obj."btn_".$type."_".$action;
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>".$title."</strong>";
	$this->fn_js->text=				$text;
	$this->fn_js->functionYES=		$type."_".$action."();";
	$this->fn_js->buttonYES=		"Да";
	$this->fn_js->buttonNO=			"Отмена";
	$this->fn_js->id=				"deAsk".$type.$action;
	$this->fn_js->zindex=			"100";
	$this->fn_js->timeBefore=		"1";
	$show=$this->fn_js->showYesNoObj();
    return $show;
    
    
}

function js_main_delete() {

	$text="Вы действительно хотите удалить этот раздел?";
    $show=$this->js_askWindow(".","main","delete","Удалить?",$text);
    return $show;
}

function js_main_deleteAct() {

	$text="Вы действительно хотите удалить этот раздел?";
    $show=$this->js_askWindow("#","main","deleteAct","Удалить?",$text);
    return $show;
}

function js_main_rename() {

    $text="Введите новое название этого раздела<br>";
	$text.="<input class='dialog_input' type='text' name='main_input_rename' id='main_input_rename' value='Новое название' size='30'>";
    $show=$this->js_askWindow(".","main","rename","Переименовать?",$text);
    return $show;
}

function js_main_renameAct() {

    $text="Введите новое название этого раздела<br>";
	$text.="<input class='dialog_input' type='text' name='main_input_renameAct' id='main_input_renameAct' value='Новое название' size='30'>";
    $show=$this->js_askWindow("#","main","renameAct","Переименовать?",$text);
    return $show;
}

function js_main_create() {

    $text="Введите название нового раздела<br>";
	$text.="<input class='dialog_input' type='text' name='main_input_create' id='main_input_create' value='Новый раздел' size='30'>";
    $show=$this->js_askWindow("#","main","create","Новый раздел?",$text);
    return $show;
}


function js_sub_delete() {

	$text="Вы действительно хотите удалить эту статью?";
    $show=$this->js_askWindow(".","sub","delete","Удалить?",$text);
    return $show;
}

function js_sub_deleteAct() {

	$text="Вы действительно хотите удалить эту статью?";
    $show=$this->js_askWindow("#","sub","deleteAct","Удалить?",$text);
    return $show;
}

function js_sub_create() {

    $text="Введите название новой статьи<br>";
	$text.="<input class='dialog_input' type='text' name='sub_input_create' id='sub_input_create' value='Новая статья' size='30'>";
    $show=$this->js_askWindow("#","sub","create","Новая статья?",$text);
    return $show;
}

function js_sub_save() {

	$text="Вы действительно хотите сохранить?";
    $show=$this->js_askWindow("#","sub","save","Сохранить?",$text);
    return $show;
}

function js_sub_setAct() {

	$text="Вы действительно хотите перенести эту статью в другой раздел?<br>";
    $text.=$this->showSubDialog();
    $show=$this->js_askWindow("#","sub","setAct","Перенести?",$text);
    return $show;
}


function module() {

	$show=	$this->runn;
	$show.='<script type="text/javascript" src="script_frame_init.js"></script>';  
	
	$show.='<script type="text/javascript">';						
	$show.='new deTextEditor_mod(';	
	$show.='"idEditor",';  
	$show.='"deTextEditorFrame",';
	$show.='"",';
    $show.='"500px"';		
	$show.=');';			
	$show.='</script>';			

	$show.='<script type="text/javascript">';						
	$show.='new deShowEasyDialog('; 	
	$show.='"deTextEditorFramebtnFontColor",';	
	$show.='"click",';	
	$show.='"313px",';
	$show.='"<div id=\'idDivFontColor\'></div>",';
	$show.='"110",'; 	 
	$show.='"deDlgFontColor",';					
    $show.='"clCloseDlg",'; 	
	$show.='"10"'; 
	$show.=');';													
	$show.='</script>';			

	$show.='<script type="text/javascript">';						
	$show.='new deSelectColorTable(';
	$show.='"idDivFontColor",';  
	$show.='"deMdlFontColor"'; 
	$show.=');';												
	$show.='</script>';			

	$show.='<script type="text/javascript">';						
	$show.='new deShowEasyDialog('; 	
	$show.='"deTextEditorFramebtnBackColor",';	
	$show.='"click",';
	$show.='"313px",';
	$show.='"<div id=\'idDivBackColor\'></div>",'; 
	$show.='"120",'; 	
	$show.='"deDlgBackColor",';						
    $show.='"clCloseDlg",';	
	$show.='"10"'; 
	$show.=');';													
	$show.='</script>';			

	$show.='<script type="text/javascript">';						
	$show.='new deSelectColorTable(';
	$show.='"idDivBackColor",';   
	$show.='"deMdlBackColor"'; 
	$show.=');';												
	$show.='</script>';			

	$show.='<script type="text/javascript">';						
	$show.='new deShowEasyDialog('; 	
	$show.='"deTextEditorFramebtnFontSize",';	
	$show.='"click",';
	$show.='"100px",';
	$show.='"<div id=\'idDivFontSize\'></div>",';
	$show.='"130",'; 	
	$show.='"deDlgFontSize",';						
    $show.='"clCloseDlg",'; 	
	$show.='"10"'; 
	$show.=');';													
	$show.='</script>';			
        
	$show.='<script type="text/javascript">';						
    $show.='new deSelectFontSize_easy(';
	$show.='"idDivFontSize",';   
	$show.='"deMdlFontSize"'; 
	$show.=');';
	$show.='</script>';			

	$show.='<script type="text/javascript">';						
	$show.='new deShowEasyDialog('; 	
	$show.='"deTextEditorFramebtnFontType",';	
	$show.='"click",';
	$show.='"200px",';
	$show.='"<div id=\'idDivFontType\'></div>",';
	$show.='"130",'; 	
	$show.='"deDlgFontType",'; 						
    $show.='"clCloseDlg",'; 	
	$show.='"10"'; 
	$show.=');';													
	$show.='</script>';			
    
	$show.='<script type="text/javascript">';						
    $show.='new deSelectFontType_easy('; 
	$show.='"idDivFontType",';  
	$show.='"deMdlFontType"'; 
	$show.=');';
	$show.='</script>';			

	$show.='<script type="text/javascript">';						
	$show.='new deShowEasyDialog('; 	
	$show.='"deTextEditorFramebtnSmile",';	
	$show.='"click",';
	$show.='"350px",';
	$show.='"<div id=\'idDivSmile\'></div>",';
	$show.='"130",'; 	 
	$show.='"deDlgSmile",';						
    $show.='"clCloseDlg",';	
	$show.='"10"'; 
	$show.=');';													
	$show.='</script>';			
    
	$show.='<script type="text/javascript">';						
    $show.='new deSelectSmile('; 
	$show.='"idDivSmile",';   
	$show.='"deMdlSmile"'; 
	$show.=');';
	$show.='</script>';			
/*
	$show.='<script type="text/javascript">';						
	$show.='new deShowEasyDialog('; 	
	$show.='"deTextEditorFramebtnImg",';	
	$show.='"click",';
	$show.='"200px",';
	$show.='"<div id=\'idDivImg\'></div>",';
	$show.='"130",'; 
	$show.='"deDlgImg",'; 						
    $show.='"clCloseDlg",';	
	$show.='"10"'; 
	$show.=');';													
	$show.='</script>';			

	$show.='<script type="text/javascript">';						
	$show.='new deShowEasyDialog('; 	
	$show.='"deTextEditorFramebtnFile",';	
	$show.='"click",';
	$show.='"200px",';
	$show.='"<div id=\'idDivFile\'></div>",'; 
	$show.='"130",'; 	 
	$show.='"deDlgFile",'; 						
    $show.='"clCloseDlg",';	
	$show.='"10"'; 
	$show.=');';													
	$show.='</script>';			
*/
	
    return $show;

}


function install() {

	if (isset($this->db)) {
		if (isset($this->prefix)) {
		$sql="CREATE TABLE IF NOT EXISTS `".$this->prefix."_dataTexts` (
			   `id` int(10) unsigned NOT NULL auto_increment,
               `part_id` int(10) NOT NULL default '0',
               `caption` varchar(255) NOT NULL default '',
               `name` varchar(255) NOT NULL default '',
               `text` text NOT NULL,
               `title` varchar(255) NOT NULL default '',
               `group` varchar(255) NOT NULL default '',
               `key` varchar(255) NOT NULL default '',
               `description` varchar(255) NOT NULL default '',
               `keywords` varchar(255) NOT NULL default '',
               `post_dt` datetime NOT NULL default '0000-00-00 00:00:00',
               `post_d` date NOT NULL default '0000-00-00',
               `post_t` time NOT NULL default '00:00:00',
               `last_dt` datetime NOT NULL default '0000-00-00 00:00:00',
               `last_d` date NOT NULL default '0000-00-00',
               `last_t` time NOT NULL default '00:00:00',
              PRIMARY KEY  (`id`),
              KEY `name` (`name`),
              KEY `caption` (`caption`),
              KEY `part_id` (`part_id`),
              KEY `title` (`title`),
              KEY `group` (`group`),
              KEY `key` (`key`),
              KEY `description` (`description`),
              KEY `keywords` (`keywords`)
              ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
		$res=mysql_query($sql,$this->db);

		$sql="CREATE TABLE IF NOT EXISTS `".$this->prefix."_dataParts` (
			  `id` int(10) unsigned NOT NULL auto_increment,
			  `caption` varchar(255) NOT NULL default '',
			  `name` varchar(255) NOT NULL default '',
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
		$res=mysql_query($sql,$this->db);
		}
	}

}


}



?>