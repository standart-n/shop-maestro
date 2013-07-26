<?php

class cssImport { 

var $module_caption=	"CSS";
var $module_group=		"master";
var $module_name=		"cssImport";
var $module_key=        "css";
var $module_obj=        "design";

var $page;
var $action;
var $show;
var $run="\r\n";
var $runn="\r\n\r\n";


function engine() {

	$ms=array();	
	$show="";
	switch ($this->page) {

	case 'cssImport':
		$title="Изменение стилизации на сайте (Редактор CSS)";
		$descr="Редактор стилей, изменение стилизации на сайте, импорт CSS, изменение дизайна на сайте";
		$keywords="редактор, стили, дизайн, css, стилизация, импорт";

		$show.= 	$this->js();
		$show.=		$this->actions();
		$show.= 	$this->about();
		$show.= 	$this->settings();
		$show.= 	$this->form_st();
		$show.=		$this->frame();
		$show.= 	$this->form_nd();
		$show.= 	$this->buttons();
        $this->cacheCSS();

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
		if (isset($this->pattern_tb)) {
		$sql="CREATE TABLE IF NOT EXISTS `pt_".$this->pattern_tb."_dataParams` (
			  `id` int(10) unsigned NOT NULL auto_increment,
			  `caption` varchar(255) NOT NULL default '',
			  `name` varchar(255) NOT NULL default '',
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;
			";
		$res=mysql_query($sql,$this->db);

		$sql="CREATE TABLE IF NOT EXISTS `pt_".$this->pattern_tb."_legoBrowsers` (
			  `id` int(10) unsigned NOT NULL auto_increment,
			  `pattern` varchar(255) NOT NULL default '',
			  `browser` varchar(255) NOT NULL default '',
			  `property` varchar(255) NOT NULL default '',
			  `comment` varchar(255) NOT NULL default '',
			  `order` int(10) NOT NULL default '0',
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;
			";
		$res=mysql_query($sql,$this->db);

		$sql="CREATE TABLE IF NOT EXISTS `pt_".$this->pattern_tb."_legoParams` (
			  `id` int(10) unsigned NOT NULL auto_increment,
			  `selector_id` int(10) NOT NULL default '0',
			  `param_id` int(10) NOT NULL default '0',
			  `value` varchar(255) NOT NULL default '',
			  `postdt` datetime NOT NULL default '0000-00-00 00:00:00',
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2127 ;
			";
		$res=mysql_query($sql,$this->db);

		$sql="CREATE TABLE IF NOT EXISTS `pt_".$this->pattern_tb."_legoSelectors` (
			  `id` int(10) unsigned NOT NULL auto_increment,
			  `browser_id` int(10) NOT NULL default '0',
			  `selector` varchar(255) NOT NULL default '',
			  `stage` int(10) NOT NULL default '0',
			  `postdt` datetime NOT NULL default '0000-00-00 00:00:00',
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;
			";
		$res=mysql_query($sql,$this->db);
		}
	}

}



function actions() {

	$show="";
	switch ($this->action) {

	case 'save_css':
		$ms=$this->save_css();
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

	case 'del_sel':
		$ms=$this->del_sel();
		if ($ms['result']=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Селектор удален";
			$this->fn_js->id=		'deAskFunText';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Ошибка!";
			$this->fn_js->text=		"Ошибка при удалении!";
			$this->fn_js->id=		'deAskErrorText';
			$show.=$this->fn_js->showOk();
		}
	break;
	
	}
	return $show;
}

function del_sel() {

	$ms=array();
	$ms['result']="FALSE";
	if (isset($_POST['nmDelSel']))	{
		$id=$_POST['nmDelSel'];
		$sql_upd="DELETE FROM `pt_".$this->pattern_tb."_legoSelectors` WHERE (id=".$id.") ";
		$res=mysql_query($sql_upd,$this->db);
		$sql_upd="DELETE FROM `pt_".$this->pattern_tb."_legoParams` WHERE (selector_id=".$id.") ";
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


function getSelectorId() {

		$sel_id="";
		$sql="SELECT * FROM `pt_".$this->pattern_tb."_legoSelectors` 
				WHERE (selector=\"".$this->selector."\") AND (browser_id='".$this->browser_id."') ";
		$res=mysql_query($sql,$this->db);
		$rows_count=mysql_num_rows($res);

		if ($rows_count>0) {
			$row=mysql_fetch_array($res);
			$sel_id=$row['id'];
		} else {
			$sql="INSERT INTO `pt_".$this->pattern_tb."_legoSelectors` 
					(selector,browser_id) values (\"".$this->selector."\",".$this->browser_id.") ";
			$res=mysql_query($sql,$this->db);
			$sel_id=mysql_insert_id();
		}


		if (isset($_POST['nmStages'])) {
			$this->stage=intval(trim($_POST['nmStages']));
			if ($this->stage>0)  {
				$sql="UPDATE `pt_".$this->pattern_tb."_legoSelectors` 
						SET stage=".$this->stage."  WHERE (id=".$sel_id.") ";
				$res=mysql_query($sql,$this->db);
			}
		} else {
				$sql="UPDATE `pt_".$this->pattern_tb."_legoSelectors` 
						SET stage=".$sel_id."  WHERE (id=".$sel_id.") ";
				$res=mysql_query($sql,$this->db);
		}
				
		//echo $sql;
		return $sel_id;
}

function getParamId() {

		$param_id="";
		$sql="SELECT * FROM `pt_".$this->pattern_tb."_dataParams` 
				WHERE (name=\"".$this->param_zn."\") ";
		$res=mysql_query($sql,$this->db);
		$rows_count=mysql_num_rows($res);

		if ($rows_count>0) {
			$row=mysql_fetch_array($res);
			$param_id=$row['id'];
		} else {
			$sql="INSERT INTO `pt_".$this->pattern_tb."_dataParams` 
					(name) values (\"".$this->param_zn."\") ";
			$res=mysql_query($sql,$this->db);
			$param_id=mysql_insert_id();
		}
		//echo $sql;
		return $param_id;
}

function getValueId() {

		$param_vl="";
		$sql="SELECT * FROM `pt_".$this->pattern_tb."_legoParams` 
				WHERE (param_id='".$this->param_zn_id."') AND (selector_id='".$this->selector_id."') ";
		$res=mysql_query($sql,$this->db);
		$rows_count=mysql_num_rows($res);

		if ($rows_count>0) {
			$row=mysql_fetch_array($res);
			$id=$row['id'];
			$param_vl=$id;
    	    $this->value=addslashes(stripslashes($this->value));
			$sql="UPDATE `pt_".$this->pattern_tb."_legoParams` 
					SET value='$this->value', postdt='NOW()' WHERE (id='".$id."') ";
			$res=mysql_query($sql,$this->db);
		} else {
			$sql="INSERT INTO `pt_".$this->pattern_tb."_legoParams` 
					(selector_id,param_id,value,postdt) values 
					('".$this->selector_id."','".$this->param_zn_id."',\"".$this->value."\",NOW()) ";
			$res=mysql_query($sql,$this->db);
			$param_vl=mysql_insert_id();
		}
		
		
		//echo $sql;
		return $param_vl;
}

function deleteParams() {

		$sql="DELETE FROM `pt_".$this->pattern_tb."_legoParams` 
				WHERE (selector_id='".$this->selector_id."') ";
		$res=mysql_query($sql,$this->db);

}

function save_css() {

	$ms=array();
	$ms['result']="FALSE";
	if (isset($_POST['nmSave_id']))	{
		if (isset($_POST['nmSave_txt']))	{
			if (isset($_POST['nmSave_br']))	{
				if (isset($_POST['nmSave_type']))	{
					//if (isset($_POST['nmStages']))	{
						$pattern=			$_POST['nmSave_id'];
						$css=				$_POST['nmSave_txt'];
						$browser_id=		intval(trim($_POST['nmSave_br']));
						$edit_type=			$_POST['nmSave_type'];
						
						$this->pattern_tb=$pattern;
						$this->browser_id=$browser_id;
						$this->css=$css;
						$this->edit_type=$edit_type;
						$this->sel_ms=explode("}",$this->css);
					
						for ($this->ndx=0;$this->ndx<sizeof($this->sel_ms);$this->ndx++) {
							$this->check_selectors();
						}
	
						$this->clearSelectors();
						$ms['result']="TRUE";
					//}
				}
			}
		}
	}
	return $ms;

}


function check_selectors() {

		$this->block=explode("{",$this->sel_ms[$this->ndx]);
		$this->selector=$this->block[0];
		$this->selector=ltrim($this->selector);
		$this->selector=rtrim($this->selector);
		if (strlen($this->selector)>4) {
			$this->selector_id=$this->getSelectorId();
			if ($this->edit_type=="edit") { $this->deleteParams(); }
			if (isset($this->block[1]))	{
				$this->code=$this->block[1];
				$this->param_zn_ms=explode(";",$this->code);
				for ($this->j=0;$this->j<sizeof($this->param_zn_ms);$this->j++) {
					$this->check_params();				
				}
			}
		}

}


function check_params() {

					$this->str=explode(":",$this->param_zn_ms[$this->j]);
					$this->param_zn=$this->str[0];
					$this->param_zn=ltrim($this->param_zn);
					$this->param_zn=rtrim($this->param_zn);
					if (strlen($this->param_zn)>2) {
						$this->param_zn_id=$this->getParamId();
						//echo $this->param_zn_id;
						if (isset($this->str[1]))	{
							$this->value=$this->str[1];
							$this->value=ltrim($this->value);
							$this->value=rtrim($this->value);
							if (strlen($this->value)>0) {
								$this->param_zn_vl=$this->getValueId();
							}
						}
					}

}

function clearSelectors() {

	$sql="SELECT s.id as 'id', count(p.id) as 'count'
			FROM `pt_".$this->pattern_tb."_legoSelectors` s
			LEFT JOIN `pt_".$this->pattern_tb."_legoParams` p on (p.selector_id=s.id)
			WHERE (1=1) 
			GROUP by s.id";
	$res=mysql_query($sql,$this->db);
	while ($row=mysql_fetch_array($res)) {
		if ($row['count']<1) {
			$sql_del="DELETE FROM `pt_".$this->pattern_tb."_legoSelectors` WHERE (id=".$row['id'].") ";
			$res_del=mysql_query($sql_del,$this->db);
		}
	}

}

function js() {

	$show=	$this->runn;
	$show.=		'<script src="modules/cssImport/module_cssImport_events.js" type="text/javascript"></script>'.$this->runn; 
	$show.= 		$this->js_import();
	$show.= 		$this->js_edit();
	$show.= 		$this->js_del_sel();
	return $show;

}


function about() {

	$show=	$this->runn;
	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'В импорте CSS <b>можно изменять всю стилизацию на сайте</b>.<br>'.$this->run;
	$show.=		'Вы можете описать <b>любой CSS код для любого селектора</b>, для этого Вам потребуется только знание CSS.<br>'.$this->run;
	$show.=		'Вы также можете делать специальные <b>условия для браузеров Internet Explorer</b> различной версии.<br>'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;
}


function save_text() {

	$ms=array();
	$id=	$_POST['nmSave_id'];
	$text=	$_POST['nmSave_txt'];
	$sql_upd="UPDATE `".$this->prefix."_dataTexts` SET text='".$text."' WHERE id=".$id." ";
	$res=mysql_query($sql_upd,$this->db);
	$ms['id']=		$id;
	$ms['text']=	$text;
	$ms['sql']=		$sql_upd;
	if ($res) {
		$ms['result']="TRUE";
		$ms['sql_error']="NO";
	} else {
		$ms['result']="FALSE";
		$ms['sql_error']=$sql_upd;
	}	
	return $ms;
}


function settings() {

	$show=	$this->runn;
	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<span class="clLabelText">Настройки</span><br>'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<table id="idTblOptions" width="100%" valign="top" align="center" border="0" cellpadding="1" cellspacing="1">'.$this->run;
	$show.=		'<tr>'.$this->run;
	$show.=		'<td align="left" width="300px">'.$this->run;
	$show.=			'<span cl="clLabel"><div id="idStatusBrowsers"><b>Шаг 1</b>: Выберите условие для браузера </div></span>'.$this->run;
	$show.=		'</td>'.$this->run;
	$show.=		'<td>'.$this->run;
	$show.=			'<div id="idSelectBrowsers">'.$this->show_browsers().'</div>'.$this->run;
	$show.=		'</td>'.$this->run;
	$show.=		'</tr>'.$this->run;
	$show.=		'<tr>'.$this->run;
	$show.=		'<td align="left" width="300px">'.$this->run;
	$show.=			'<span cl="clLabel"><div id="idStatusSelectors"></div></span>'.$this->run;
	$show.=		'</td>'.$this->run;
	$show.=		'<td>'.$this->run;
	$show.=			'<div id="idSelectSelectors"></div>'.$this->run;
	$show.=		'</td>'.$this->run;
	$show.=		'</tr>'.$this->run;
	$show.=		'</table>'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;

}


function form_st() {

	$show=	$this->runn;
	$show.='<form id="idFrmSave" name="nmFrmSave" action="index.php?page=cssImport&action=save_css" method="POST">'.$this->run;
	$show.='<input type="hidden" name="nmSave_id"	id="idSave_id"		>'.$this->run;
	$show.='<input type="hidden" name="nmSave_txt"	id="idSave_txt"		>'.$this->run;
	$show.='<input type="hidden" name="nmSave_br"	id="idSave_br"		>'.$this->run;
	$show.='<input type="hidden" name="nmSave_type"	id="idSave_type"	>'.$this->run;
	$show.='<input type="hidden" name="nmPattern"	id="idPattern"	value="'.$this->pattern_tb.'">'.$this->runn;
	return $show;

}

function form_nd() {

	$show='</form>'.$this->runn;
	return $show;

}


function show_browsers() {

	$show="";
	$ndx=0;
	$sql="SELECT * FROM `pt_".$this->pattern_tb."_legoBrowsers` WHERE (1=1) ORDER by id ASC";
	$show.=$sql;
	$res=mysql_query($sql,$this->db);
	$rows_count=mysql_num_rows($res);
	if ($rows_count>0) {
	  $show="<select id=\"idBrowser\" name=\"nmBrowser\" onChange=\"browser_change();\">";
	  $show.='<option value="none" selected></option>';
		while($row=mysql_fetch_array($res)) {
			$show.='<option value="'.$row['id'].'" ';
			$show.='>';
			$show.=$row['comment'];
			$show.='</option>';
			$ndx++;
		}
	  $show.='</select>';
	}
	return $show;

}

function show_selectors($browser_id,$pattern_tb) {

	$ms=array();
	$show="";
	$ndx=0;
	$sql="SELECT * 
			FROM `pt_".$pattern_tb."_legoSelectors` 
			WHERE (browser_id=\"".$browser_id."\") ORDER by stage,selector ASC";
	$res=mysql_query($sql,$this->db);
	$rows_count=mysql_num_rows($res);
	if ($rows_count>0) {
	  $show="<select id=\"idSelector\" name=\"nmSelector\" onChange=\"selector_change();\">";
	  $show.='<option value="none" selected></option>';
		while($row=mysql_fetch_array($res)) {
			$show.='<option value="'.$row['id'].'" ';
			$show.='>';
			$show.=$row['selector'];
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

function show_stages($stage,$pattern_tb) {

	$ms=array();
	$show="";
	$ndx=0;
	$sql="SELECT * 
			FROM `pt_".$pattern_tb."_legoSelectors` 
			WHERE (1=1) ORDER by id Desc";
	$res=mysql_query($sql,$this->db);
	$row=mysql_fetch_array($res);
	//$rows_count=mysql_num_rows($res);
	$count=intval($row['id'])+10;
	
	  $show="<select id=\"idStages\" name=\"nmStages\">";
		for ($i=0;$i<$count;$i++)	{
			$ndx=$i+1;
			$show.='<option value="'.$ndx.'" ';
			if ($ndx==$stage) {	$show.=' selected '; }
			$show.='>';
			$show.=$ndx;
			//$show.=$row['caption'].'	(id='.$row['id'].')';
			$show.='</option>';
			$ndx++;
		}
	  $show.='</select>';

	$ms['rows_count']=$count;
	$ms['html']=$show;
	$ms['sql']=$sql;
	$ms['sql_error']=mysql_errno($this->db).":".mysql_error($this->db);
	return $ms;
}


function frame() {

	$show=	$this->runn;
	$show.='<div id="idBoxCSS">'.$this->run;

	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<b>Шаг 3</b>: Добавьте или измените CSS код селектора, который вы выбрали.<br>'.$this->run;
	$show.=		'Если в текстовом поле Вы измените имя селектора, то добавиться новый - с измененным именем.<br>'.$this->run;
	$show.=		'Это удобно когда вы хотите создать новый селектор, со структурой, подобной другому селектору.<br>'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;

	$show.='<div class="clTextLine">'.$this->run;
	$show.='<div id="idEditor">'.$this->run;
	$show.=$this->module();
	$show.='</div>'.$this->run;
	$show.='</div>'.$this->runn;

	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText" alt="box">'.$this->run;
	$show.=		'<b>Шаг 4</b>: Вы можете изменить <b>порядок</b> этого селектора.<br>'.$this->run;
	$show.=		'<div id="idSelectStages"></div>'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;

	$show.='</div>'.$this->runn;
	return $show;
	
}

function module() {

	$show=	$this->runn;
	$show.='<textarea name="nmCSS" id="idCSS" rows="30">'.$this->run;
	$show.='</textarea>'.$this->runn;			
	return $show;

}

function buttons() {

	$show=	$this->runn;
	$show.='<div id="idCSSButtons">'.$this->runn;

	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.=		'<b>Шаг 5</b>: Сохраните написанный код.<br>'.$this->run;
	$show.=		'Если Вы нажмете на кнопку "Сохранить", то полностью замените старый код этого селектора на новый.<br>'.$this->run;
	$show.=		'Если Вы нажмете "Импорт", то параметры этого селектора, которые сейчас не были описаны в текстовом поле, не удалятся.<br>'.$this->run;
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;

	$show.='<div class="clButtonLine">'.$this->run;
	$show.='<a id="idBtnEdit" href="#de">Сохранить</a>'.$this->run;
	$show.='<a id="idBtnImport" href="#de">Импорт</a>'.$this->run;
	$show.='<a id="idBtnDelSel" href="#de">Удалить селектор</a>'.$this->run;
	$show.='</div>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;

}

function cacheCSS() {
    
    $this->generate_css();
}

function generate_css() {
	// генерация ксс кода 

	$show='';
	// начинаем с таблицы где указаны исключения для браузеров ИЕ 
    $show.="[style.>]".$this->run;
   	$sql="SELECT * FROM `pt_".$this->pattern_tb."_legoBrowsers` WHERE (1=1) ORDER by id ASC";
	$browser_res=mysql_query($sql,$this->db);
	while($browser_row=mysql_fetch_array($browser_res)) {

		$this->browser_nm=$browser_row['browser'];
		$this->browser_pr=$browser_row['property'];
		$this->browser_id=$browser_row['id'];
		if ($this->browser_nm=="IE") {
			// если данная строка - исключение ИЕ, то делаем условный комментарий
			$browser_st='<!--['.$this->browser_pr.']>'.$this->run;
			$browser_nd='<![endif]-->'.$this->run;
		} else {
			// если нет то просто получаем данные  
			$browser_st='';
			$browser_nd='';
		}
			$show.=$browser_st;
			//$show.="<style type='text/css'>".$this->run; 
            $show.='<link   href="style/css_main_'.$this->browser_id.'.css"  		rel="stylesheet"   type="text/css">'.$this->run;
            $css="";
            $sql="SELECT *
							FROM `pt_".$this->pattern_tb."_legoSelectors`
							WHERE (browser_id=\"$this->browser_id\")
							ORDER by stage,id ASC";
		    $selector_res=mysql_query($sql,$this->db);
		// идем по списку селекторов для данного условия браузеров 
		    while($selector_row=mysql_fetch_array($selector_res)) {
		
			$this->selector_id=$selector_row['id'];
			$this->selector_nm=$selector_row['selector'];
			$css.=$this->selector_nm.' { '.$this->run;

				// получаем список параметров и значений для данного селектора 
				$sql="SELECT 
								l.param_id as 'param_id', l.value as 'value',
								(SELECT d.name 
									FROM `pt_".$this->pattern_tb."_dataParams` d 
									WHERE (d.id=l.param_id) 
								) as 'param_nm'
							FROM `pt_".$this->pattern_tb."_legoParams` l 
							WHERE (l.selector_id=\"$this->selector_id\")
							ORDER by l.id ASC";
    		    $param_res=mysql_query($sql,$this->db);
				while($param_row=mysql_fetch_array($param_res)) {

					$this->param_nm=$param_row['param_nm'];
					$this->value=$param_row['value'];
					$css.=$this->param_nm.": ".$this->value.";".$this->run;
		
				}
		
			$css.="}".$this->run;
            $css=preg_replace("/url\(img/i","url(../img",$css);
            $css=preg_replace("/url\(photo/i","url(../photo",$css);
            $this->fn_files->saveTextInFile("../style/css_main_".$this->browser_id.".css",$css);
            //chmod("../style/css_main_".$this->browser_id.".css",777);
		}
			//$show.="</style>".$this->run;
			$show.=$browser_nd;
	}
    $show.="[style.<]".$this->run;
    $this->fn_files->saveTextInFile("../models/mdl_css.html",$show);
    //chmod("../models/mdl_css.html",777);

}


function js_import() {

	$this->fn_js->object_id=		"idBtnImport";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Подтверждение</strong>";
	$this->fn_js->text=				"Вы действительно хотите импортировать этот CSS код?";
	$this->fn_js->functionYES=		"btnImport_click();";
	$this->fn_js->id=				"deAskImport";
	$this->fn_js->zindex=			"200";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}

function js_edit() {

	$this->fn_js->object_id=		"idBtnEdit";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Подтверждение</strong>";
	$this->fn_js->text=				"Вы действительно хотите изменить CSS код данного селектора?";
	$this->fn_js->functionYES=		"btnEdit_click();";
	$this->fn_js->id=				"deAskEdit";
	$this->fn_js->zindex=			"210";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}

function js_new_sel() {

	$this->fn_js->object_id=		"idBtnDelSel";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Удаление</strong>";
	$this->fn_js->text=				"Введите <b>название</b> для нового селектора и выберите к <b>каким браузерам</b> он относится<br>";
	$this->fn_js->text.=			"<div class='clInput'>";
	$this->fn_js->text.=			"<form id='idFrmDelSel' name='nmFrmDelSel' action='index.php?page=cssImport&action=del_sel' method='POST'>";
	$this->fn_js->text.=			"<input class='dialog_input' type='text' name='nmDelSel' id='idDelSel' size='30'>";
	$this->fn_js->text.=			"</form>";
	$this->fn_js->text.=			"</div>";
	$this->fn_js->functionYES=		"btnDelSel_click();";
	$this->fn_js->buttonYES=		"Да";
	$this->fn_js->buttonNO=			"Нет";
	$this->fn_js->id=				"deAskDelSel";
	$this->fn_js->zindex=			"200";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}

function js_del_sel() {

	$this->fn_js->object_id=		"idBtnDelSel";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Удаление</strong>";
	$this->fn_js->text=				"Вы действительно хотите <b>удалить</b> этот селектор и его параметры?<br>";
	$this->fn_js->text.=			"<div class='clInput'>";
	$this->fn_js->text.=			"<form id='idFrmDelSel' name='nmFrmDelSel' action='index.php?page=cssImport&action=del_sel' method='POST'>";
	$this->fn_js->text.=			"<input class='dialog_input' type='hidden' name='nmDelSel' id='idDelSel' size='30'>";
	$this->fn_js->text.=			"</form>";
	$this->fn_js->text.=			"</div>";
	$this->fn_js->functionYES=		"btnDelSel_click();";
	$this->fn_js->buttonYES=		"Да";
	$this->fn_js->buttonNO=			"Нет";
	$this->fn_js->id=				"deAskDelSel";
	$this->fn_js->zindex=			"200";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}


}



?>