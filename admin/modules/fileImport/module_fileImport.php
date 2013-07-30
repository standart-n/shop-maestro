<?php

class fileImport { 

var $module_caption=	"Файлы";
var $module_group=		"user";
var $module_name=		"fileImport";
var $module_key=        "файлы";
var $module_obj=        "content";

var $page;
var $action;
var $id;
var $show;
var $prefix;

var $fn_files;
var $fn_js;

var $sql;
var $res;
var $row;
var $db;

var $list_now;
var $list_count;
var $row_count_all;
var $row_count_now;
var $row_max=1000;
var $limit;

function engine() {

	$ms=array();
	$show="";
	$this->install();
	switch ($this->page) {

	case 'fileImport':
		$title="Импорт файлов";

		$show.= 	$this->js();
		$show.=		$this->actions();
		$show.= 	$this->about();
		$show.= 	$this->settings();
		$show.= 	$this->display_set();
		$show.= 	$this->display_line();
		$show.= 	$this->display_list();
		
		$ms['title']=		$title;
		$ms['html']=		$show;
		$ms['result']=		"TRUE";
	break;
	
	}

	return $ms;
}

function install() {

	if (isset($this->db)) {
		if (isset($this->prefix)) {
		$sql="CREATE TABLE IF NOT EXISTS `".$this->prefix."_dataFiles` (
		  `id` int(10) unsigned NOT NULL auto_increment,
		  `filename` varchar(255) NOT NULL default '',
		  `filepath` varchar(255) NOT NULL default '',
		  `filesize` varchar(255) NOT NULL default '',
		  `filetype` varchar(255) NOT NULL default '',
		  `postdt` datetime NOT NULL default '0000-00-00 00:00:00',
		  PRIMARY KEY  (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=66 ;
		";
		$res=mysql_query($sql,$this->db);
		}
	}

}


function actions() {

	$show="";
	switch ($this->action) {
	
	case 'save_file':
		$res=$this->save_file();
		if ($res=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Файл успешно загружен!";
			$this->fn_js->id=		'deAskFunFile';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Ошибка загрузки!";
			$this->fn_js->id=		'deAskErrorFile';
			$show.=$this->fn_js->showOk();
		}
	break;

	case 'del_file':
		$res=$this->del_file();
		if ($res=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Файл успешно удален!";
			$this->fn_js->id=		'deAskFunFile';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Ошибка удаления!";
			$this->fn_js->id=		'deAskErrorFile';
			$show.=$this->fn_js->showOk();
		}
	break;

	}
	return $show;
}

function js() {

	$show=		"";
	$show.=		'<script src="modules/fileImport/module_fileImport_events.js" type="text/javascript"></script>'; 
	$show.= 		$this->js_save_file();
//	$show.= 	$this->js_del_file();
	return $show;

}


function about() {

	$show='<div class="clTextLine">';
	$show.=	'<div class="clSomeText">';
	$show.=		'В импорте файлов вы можете загружать на сайт любые файлы.<br>';
	$show.=	'</div>';
	$show.='</div>';
	return $show;

}


function save_file() {

	$uploaddir='../files/';
	$this->fn_files->uploaddir=$uploaddir;
	if ($this->fn_files->upload_file()=="TRUE") {
		//$this->fn_photo->infile=		$this->fn_photo->uploaddir.$this->fn_photo->upl_file;
		//$this->fn_photo->outfile=		$this->fn_photo->uploaddir."s_".$this->fn_photo->upl_file;
		//$this->fn_photo->new_width=		"120";
		//$this->fn_photo->new_height=	"80";
		//$this->fn_photo->quality=		"100";
		//$this->fn_photo->image_resize();
		$name=$this->fn_files->upl_file;
		$path="files/".$name;
		$sql_ins="INSERT INTO `".$this->prefix."_dataFiles` (filename,filepath,postdt) values ('".$name."','".$path."',NOW())";
		$res=mysql_query($sql_ins,$this->db);
	    $show="TRUE";
	} else {
	    $show="FALSE";
	}

	return $show;

}


function del_file() {

	$id=intval(trim($_GET['id']));
	$sql="SELECT * FROM `".$this->prefix."_dataFiles` WHERE (id=".$id.") ";
	$res=mysql_query($sql,$this->db);
	$row=mysql_fetch_array($res);
	unlink('../files/'.$row['filename']);
	//unlink('../file/s_'.$row['filename']);

	$sql_del="DELETE FROM `".$this->prefix."_dataFiles` WHERE (id=".$id.") ";
	$res_del=mysql_query($sql_del,$this->db);
	if (!$res_del) { $show="FALSE";		} else {	$show="TRUE";	}
	return $show;

}

function settings() {

	$file_size=(1000*1024*1024);
	$show='<div class="clTextLine">';
	$show.=	'<span class="clLabelText">Загрузка файлов</span><br>';
	$show.=	'<div class="clSomeText">';
	$show.= '<form id="idFrmSave" name="nmFrmSave" enctype="multipart/form-data" action="index.php?page=fileImport&action=save_file" method="post">';
	$show.=		'<input type="hidden" name="MAX_FILE_SIZE" value="'.$file_size.'">';
	$show.= 	'<input name="filename" type="file">';
//	$show.= 	'<input type="submit" value="Отправить">';
	$show.= '</form>';
	$show.=	'</div>';
	$show.='</div>';
	$show.='<div class="clButtonLine">';
	$show.='<a id="idBtnSaveFile" href="#de">Загрузить</a>';
	$show.='</div>';
	return $show;

}


function display_set() {

	$show="";
	$this->sql="SELECT * 
			FROM `".$this->prefix."_dataFiles` 
			WHERE (1=1) 
			ORDER by postdt DESC";

	$res=mysql_query($this->sql,$this->db);
	
	//$this->list_now=1;
	//$this->row_max=40;

	if (empty($this->list_now)) {	$this->list_now=1;		}
	if (empty($this->row_max)) 	{	$this->row_max=10;		}

	$this->row_count_all=mysql_num_rows($res);
	$this->list_count=ceil($this->row_count_all/$this->row_max);
	
	if ($this->list_now > $this->list_count) 	{   $this->list_now = $this->list_count;	}
	if ($this->list_now < 1) 					{  	$this->list_now = 1;					}
		
	$this->limit=($this->list_now-1)*$this->row_max;
	if ($this->limit<0) 						{ 	$this->limit=0; 						}
	$limit=$this->limit;
	$row_max=$this->row_max;
	
	$_SESSION['fileImport:list_now']=$this->list_now;
	$_SESSION['fileImport:row_max']=$this->row_max;

	$this->sql.=" LIMIT {$this->limit},{$this->row_max}";
	$this->res=mysql_query($this->sql,$this->db);
	$this->row_count_now=mysql_num_rows($this->res);
	

	return $show;

}

function display_line() {

	$show="";
	$show.='<div id="idBoxDspLine">';
	$show.='<div class="clTextLine">';
	$show.='<table id="idTblList" name="nmTblList" align="center" border="0" cellpadding="3" cellspacing="0" width="600px">';
	$show.=	'<tr>';
	$show.=		'<td align="left">';
	//$show.=$this->list_count;
	if ($this->list_now>1) {
		$show.=			'<div class="clLinkList"><a id="idBtnFileImportPrev" href="#de">Предыдущая</a></div>';
	} else {
		$show.=			'<div class="clLinkList">Предыдущая</div>';
	}
	$show.=		'</td>';
	$show.=		'<td align="center">';
	$show.=			'<div class="clTextList">Страница <b>'.$this->list_now.'</b> из <b>'.$this->list_count.'</b>, показаны <b>'.$this->row_count_now.'</b> из <b>'.$this->row_count_all.'</b></div>';
	$show.=		'</td>';
	$show.=		'<td align="right">';
	if ($this->list_now<$this->list_count) {
		$show.=			'<div class="clLinkList"><a id="idBtnFileImportNext" href="#de">Следующая</a></div>';
	} else {
		$show.=			'<div class="clLinkList">Следующая</div>';
	}
	$show.=		'</td>';
	$show.=	'</tr>';
	$show.='</table>';
	$show.='</div>';
	$show.='</div>';
	return $show;

}

function display_list() {

	$show="";
	$show.='<div id="idBoxDspList">';
	$show.='<div class="clTextLine">';
	$show.=	'<table id="idTblFiles" valign="top" align="center" border="0" cellpadding="4" cellspacing="0">';
		$show.=	'<tr>';
		$show.=	'<td class="clSomeText" align="center" width="20px"><b>№</b></td>';
		//$show.=	'<td class="clSomeText" align="center" width="120px"><b>Изобр.</b></td>';
		/*$show.=	'<td class="clSomeText" align="left" width="100px"><b>Имя файла</b></td>';*/
		$show.=	'<td class="clSomeText" align="center" width="150px"><b>Путь к файлу</b></td>';
		$show.=	'<td class="clSomeText" align="center" width="150px"><b>Дата загрузки</b></td>';
		$show.=	'<td class="clSomeText" align="center" width="150px"><b>Действия</b></td>';
		$show.= '</tr>';
		$bgcolor="#ffffff";
		while($this->row=mysql_fetch_array($this->res)) {
			if ($bgcolor!="#ccffff") { $bgcolor="#ccffff"; } else { $bgcolor="#ffffff"; }
			$show.=	'<tr bgcolor="'.$bgcolor.'">';
			$show.=	'<td class="clSomeText" align="left">';
			$show.=	$this->row['id']; 
			$show.= '</td>';
			//$show.=	'<td class="clSomeText" align="left">';
			//$show.=	'<img src="../files/s_'.$this->row['filename'].'">'; 
			//$show.= 	'</td>';
			/*$show.=	'<td class="clSomeText" align="left">';
			$show.=	$row['filename']; 
			$show.= '</td>';*/
			$show.=	'<td class="clSomeText" align="left"><b>';
			$show.=	$this->row['filepath']; 
			$show.= '</b></td>';
			$show.=	'<td class="clSomeText" align="left">';
			$show.=	$this->row['postdt']; 
			$show.= '</td>';
			$show.=	'<td class="clSomeText" align="center">';
			$this->id=$this->row['id'];
			$show.= $this->js_del_file();
			$show.=	'<div class="clLinkList"><a id="idBtnDelFile_'.$this->row['id'].'" href="#de">Удалить файл</a></div>'; 
			$show.= '</td>';
			$show.=	'</tr>';
		}

	$show.= '</table>';
	$show.= '</div>';
	$show.= '</div>';
//	}
	return $show;

}

function js_save_file() {

	$this->fn_js->object_id=		"idBtnSaveFile";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Подтверждение</strong>";
	$this->fn_js->text=				"Вы действительно хотите сохранить этот файл?";
	$this->fn_js->functionYES=		"btnSaveFile_click();";
	$this->fn_js->linkYES=			"#de";
	$this->fn_js->functionNO=		"";
	$this->fn_js->linkNO=			"#de";
	$this->fn_js->id=				"deAskSaveFile";
	$this->fn_js->zindex=			"140";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}


function js_del_file() {

	$this->fn_js->object_id=		"idBtnDelFile_".$this->id;
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Подтверждение</strong>";
	$this->fn_js->text=				"Вы действительно хотите удалить этот файл?";
	$this->fn_js->functionYES=		"";
	$this->fn_js->linkYES=			"index.php?page=fileImport&action=del_file&id=".$this->id;
	$this->fn_js->functionNO=		"";
	$this->fn_js->linkNO=			"#de";
	$this->fn_js->id=				"deAskDelFile".$this->id;
	$this->fn_js->zindex=			"1".$this->id;
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;
}





}



?>