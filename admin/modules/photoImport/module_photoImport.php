<?php

class photoImport { 

var $module_caption=	"Фотографии";
var $module_group=		"user";
var $module_name=		"photoImport";
var $module_key=        "фото";
var $module_obj=        "content";

var $page;
var $action;
var $id;
var $mid;
var $show;
var $prefix;

var $fn_photo;
var $fn_js;

var $sql;
var $res;
var $row;
var $db;

var $list_now;
var $list_count;
var $row_count_all;
var $row_count_now;
var $row_max=10;
var $limit;

var $run="\r\n";
var $runn="\r\n\r\n";


function engine() {

	$ms=array();
	$show="";
	$this->install();
	switch ($this->page) {

	case 'photoImport':
		$title="Импорт фотографий";

		$show.= 	$this->js();
		$show.=		$this->clear_all();
		$show.=		$this->actions();
		$show.= 	$this->about();
		$show.= 	$this->settings();
		$show.=		$this->delphoto_dialog();
		$show.=		$this->scaleimg_dialog();
		$show.=		$this->display_set();
		$show.=		$this->display_line();
		$show.=		$this->display_list();
		
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
		$sql="CREATE TABLE IF NOT EXISTS `".$this->prefix."_dataPhotos` (
			  `id` int(10) unsigned NOT NULL auto_increment,
			  `group_id` int(10) NOT NULL default '0',
			  `filefullname` varchar(255) NOT NULL default '',
			  `filename` varchar(255) NOT NULL default '',
			  `filepath` varchar(255) NOT NULL default '',
			  `filesize` varchar(255) NOT NULL default '',
			  `filetype` varchar(255) NOT NULL default '',
			  `fileext` varchar(255) NOT NULL default '',
			  `post_dt` datetime NOT NULL default '0000-00-00 00:00:00',
			  `post_d` date NOT NULL default '0000-00-00',
			  `post_t` time NOT NULL default '00:00:00',
			  PRIMARY KEY  (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;
		";
		$res=mysql_query($sql,$this->db);

		$sql="CREATE TABLE IF NOT EXISTS `".$this->prefix."_dataPhotoFormats` (
		  `id` int(10) unsigned NOT NULL auto_increment,
		  `width` int(10) NOT NULL default '0',
		  `height` int(10) NOT NULL default '0',
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
		";
		$res=mysql_query($sql,$this->db);

		}
	}

}


function actions() {

	$show="";
	switch ($this->action) {
	
	case 'save_photo':
		$res=$this->save_photo();
		if ($res=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Файл успешно загружен!";
			$this->fn_js->id=		'deAskFunPhoto';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Ошибка загрузки!";
			$this->fn_js->id=		'deAskErrorPhoto';
			$show.=$this->fn_js->showOk();
		}
	break;

	case 'del_photo':
		$res=$this->del_photo();
		if ($res=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Файл успешно удален!";
			$this->fn_js->id=		'deAskFunPhoto';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Ошибка удаления!";
			$this->fn_js->id=		'deAskErrorPhoto';
			$show.=$this->fn_js->showOk();
		}
	break;

	case 'new_format':
		$res=$this->new_format();
		if ($res=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Формат добавлен! Значения ширины и высоты могли быть изменены, если они не удовлетворяли допустимым значениям";
			$this->fn_js->id=		'deAskFunPhoto';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Ошибка добавления формата! Возможно Вы задали недопустимые размеры, либо такой формат уже имеется.";
			$this->fn_js->id=		'deAskErrorPhoto';
			$show.=$this->fn_js->showOk();
		}
	break;

	case 'del_format':
		$res=$this->del_format();
		if ($res=="TRUE") {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Формат фотографий успешно удален!";
			$this->fn_js->id=		'deAskFunPhoto';
			$show.=$this->fn_js->showOk();
		}  else {
			$this->fn_js->caption=	"Результат операции";
			$this->fn_js->text=		"Ошибка удаления!";
			$this->fn_js->id=		'deAskErrorPhoto';
			$show.=$this->fn_js->showOk();
		}
	break;

	}
	return $show;
}

function js() {

	$show=		"";
	$show.=		'<script src="modules/photoImport/module_photoImport_events.js" type="text/javascript"></script>'; 
	$show.= 		$this->js_save_photo();
	$show.= 		$this->js_new_format();
	return $show;

}


function about() {

	$show='<div class="clTextLine">';
	$show.=	'<div class="clSomeText">';
	$show.=		'В импорте фотографий вы можете загружать на сайт любые фотографии.<br>';
	$show.=	'</div>';
	$show.='</div>';
	return $show;

}


function clear_all() {

	$show="";
	$sql="SELECT * 
			FROM `".$this->prefix."_dataPhotos` 
			WHERE (1=1) ";
	$res=mysql_query($sql,$this->db);
	while($row=mysql_fetch_array($res)) {
		if (!file_exists("../photo/100x80_".$row['filefullname']))  {
			$sql_del="DELETE FROM `".$this->prefix."_dataPhotos` WHERE (id=".$row['id'].") ";
			$res_del=mysql_query($sql_del,$this->db);
				if (file_exists('../photo/'.$row['filefullname']))	{
					unlink('../photo/'.$row['filefullname']);
				}
				$formats=$this->get_formats();
				for ($i=0;$i<sizeof($formats);$i++)	{
					if (file_exists('../photo/'.$formats[$i]['width'].'x'.$formats[$i]['height'].'_'.$row['filefullname']))	{
						unlink('../photo/'.$formats[$i]['width'].'x'.$formats[$i]['height'].'_'.$row['filefullname']);
					}
				}	
		}
	}
	
	return $show;

}

function delphoto_dialog() {

	$show="";
	$this->fn_js->object_id=".clDelPhotoDlg";
	$this->fn_js->event_start="click";
	$this->fn_js->width="300px";
	$this->fn_js->dialog_zindex="200";
	$this->fn_js->content_fontsize="10px";
	$this->fn_js->caption="<strong>Подтверждение</strong>";
	$this->fn_js->text="<div id='idDlgAnswer'>Вы действительно хотите удалить эту фотографию?</div><br><br>";
	$this->fn_js->text.="<div class='clLinkList' id='idDlgButtons'>";
	$this->fn_js->text.="<a style='border:#999999 1px dashed;padding:10px 30px;' href='index.php?page=photoImport&action=del_photo' id='idDlgYes'><b>Да</b></a>";
	$this->fn_js->text.="&nbsp;&nbsp;&nbsp;&nbsp;<span class='ClassButtonClose'>";
	$this->fn_js->text.="<a style='border:#999999 1px dashed;padding:10px 30px;' href='#de' id='idDlgNo'><b>Нет</b></a></span>";
	$this->fn_js->text.="</div><br><br>";
	$this->fn_js->dialog_border="#999999 solid 10px";
	$this->fn_js->timeBefore="200";
	$this->fn_js->content_align="center";
	$this->fn_js->dialog_id="deCMSDialog";
	$this->fn_js->topline_id="deCMSTopline";
	$this->fn_js->content_id="deCMSContent";
	$this->fn_js->backwall_id="deCMSBackwall";
	$show=$this->fn_js->showDialog();
	return $show;

}

function scaleimg_dialog() {

	$show="";
	$this->fn_js->object_id=".clDlgImgScale img";
	$this->fn_js->event_start="click";
	$this->fn_js->width="auto";
	$this->fn_js->dialog_zindex="200";
	$this->fn_js->content_fontsize="10px";
	$this->fn_js->caption="<strong>Увеличенный просмотр</strong>";
	$this->fn_js->text="text";
	$this->fn_js->dialog_border="#999999 solid 10px";
	$this->fn_js->timeBefore="400";
	$this->fn_js->content_align="center";
	$this->fn_js->dialog_id="deIMGDialog";
	$this->fn_js->topline_id="deIMGTopline";
	$this->fn_js->content_id="deIMGContent";
	$this->fn_js->backwall_id="deIMGBackwall";
	$show=$this->fn_js->showDialog();
	return $show;

}

function new_format() {

	$ms=array();
	$ms['result']="FALSE";
	if (isset($_POST['nmNewFormatWidth']))	{
		if (isset($_POST['nmNewFormatHeight']))	{
			$width=		intval(trim(htmlspecialchars($_POST['nmNewFormatWidth'])));
			$height=	intval(trim(htmlspecialchars($_POST['nmNewFormatHeight'])));
			if ($width<10) { $width=100; }
			if ($height<10) { $width=100; }
			if ($width>10000) { $width=1000; }
			if ($height>10000) { $height=1000; }
			$sql_sel="SELECT * FROM `".$this->prefix."_dataPhotoFormats` WHERE (width=".$width.") and (height=".$height.") ";
			$res_sel=mysql_query($sql_sel,$this->db);
			$count=mysql_num_rows($res_sel);
			if ($count<1)	{
				$sql_ins="INSERT into `".$this->prefix."_dataPhotoFormats` (width,height) values (".$width.",".$height.") ";
				$res=mysql_query($sql_ins,$this->db);
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
	return $ms['result'];

}


function del_format() {

	$ms=array();
	$ms['result']="FALSE";
	if (isset($_GET['id']))	{
			$id=intval(trim($_GET['id']));
			$sql_del="DELETE FROM `".$this->prefix."_dataPhotoFormats` WHERE (id=".$id.") ";
			$res=mysql_query($sql_del,$this->db);
	}
	if (isset($res))	{
		if ($res) {
			$ms['result']="TRUE";
		} else {
			$ms['result']="FALSE";
		}	
	}
	return $ms['result'];

}


function save_photo() {

	$uploaddir='../photo/';
	$this->fn_photo->uploaddir=$uploaddir;

	if ($this->fn_photo->upload_file()=="TRUE") {

		$fullname=$_FILES['filename']['name'];
		$path="photo/".$fullname;
		$fullname=strtolower($fullname);
		$type=$_FILES['filename']['type'];
		$size=$_FILES['filename']['size'];
		$size=($size/1024);
		$size=round($size);
		$len=strlen($fullname);
		$pos=strpos($fullname,'.');
		$name=substr($fullname,0,$pos);
		$ext=substr($fullname,($pos+1),($len-$pos));

		$this->fn_photo->infile=		$this->fn_photo->uploaddir.$_FILES['filename']['name'];
		$this->fn_photo->file_ext=		$ext;

		$formats=$this->get_formats();
		for ($i=0;$i<sizeof($formats);$i++)	{
				$width=intval($formats[$i]['width']);
				$height=intval($formats[$i]['height']);
				if (($width>0) && ($height>0) && ($width<10000) && ($height<10000))	{
					$this->fn_photo->outfile=		$this->fn_photo->uploaddir.$width."x".$height."_".$fullname;
					$this->fn_photo->new_width=		$width;
					$this->fn_photo->new_height=	$height;
					$this->fn_photo->image_resize();
				}
		}

					$this->fn_photo->outfile=		$this->fn_photo->uploaddir."100"."x"."80"."_".$fullname;
					$this->fn_photo->new_width=		"100";
					$this->fn_photo->new_height=	"80";
					$this->fn_photo->image_resize();
	
		$sql_ins="INSERT INTO `".$this->prefix."_dataPhotos` 
					(filefullname,filename,filepath,filetype,fileext,filesize,post_dt,post_d,post_t) values 
						(\"$fullname\",\"$name\",\"$path\",\"$type\",\"$ext\",'".$size."',NOW(),NOW(),NOW())";
		$res=mysql_query($sql_ins,$this->db);
		   $show="TRUE";

	} else {

	    $show="FALSE";
	}

	return $show;

}


function del_photo() {

	$id=intval(trim($_GET['id']));
	$sql="SELECT * FROM `".$this->prefix."_dataPhotos` WHERE (id=".$id.") ";
	$res=mysql_query($sql,$this->db);
	$row=mysql_fetch_array($res);
	if (file_exists('../photo/'.$row['filefullname']))	{
		unlink('../photo/'.$row['filefullname']);
	}
	if (file_exists('../photo/100x80_'.$row['filefullname']))	{
		unlink('../photo/100x80_'.$row['filefullname']);
	}
	$formats=$this->get_formats();
	for ($i=0;$i<sizeof($formats);$i++)	{
		if (file_exists('../photo/'.$formats[$i]['width'].'x'.$formats[$i]['height'].'_'.$row['filefullname']))	{
			unlink('../photo/'.$formats[$i]['width'].'x'.$formats[$i]['height'].'_'.$row['filefullname']);
		}
	}	

	$sql_del="DELETE FROM `".$this->prefix."_dataPhotos` WHERE (id=".$id.") ";
	$res_del=mysql_query($sql_del,$this->db);
	if (!$res_del) { $show="FALSE";		} else {	$show="TRUE";	}
	return $show;

}

function settings() {

	$show='<div class="clTextLine">'.$this->run;
	$show.=	'<span class="clLabelText">Разрешения фотографий</span>';
	$show.=	'<div class="clSomeText">'.$this->run;
	$show.= $this->show_formats();
	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;
	$show.='<div class="clButtonLine">';
	$show.='<a id="idBtnNewFormat" href="#de">Добавить формат</a>';
	$show.='</div>';

	$file_size=(1024*1024*1024);
	$show.='<div class="clTextLine">';
	$show.=	'<span class="clLabelText">Загрузка фотографий</span><br>';
	$show.=	'<div class="clSomeText">';
	$show.= '<form id="idFrmSave" name="nmFrmSave" enctype="multipart/form-data" action="index.php?page=photoImport&action=save_photo" method="post">';
	//$show.=		'<input type="hidden" name="MAX_FILE_SIZE" value="'.$file_size.'">';
	$show.= 	'<input name="filename" type="file">';
	//$show.= 	'<input type="submit" value="Отправить">';
	$show.= '</form>';
	$show.=	'</div>';
	$show.='</div>';
	$show.='<div class="clButtonLine">';
	$show.='<a id="idBtnSavePhoto" href="#de">Загрузить фото</a>';
	$show.='</div>';
	return $show;

}


function display_set() {

	$show="";
	$this->sql="SELECT * 
			FROM `".$this->prefix."_dataPhotos` 
			WHERE (1=1) 
			ORDER by post_dt DESC";

	$res=mysql_query($this->sql,$this->db);
	
	if (empty($this->list_now)) {	$this->list_now=1;		}
	if (empty($this->row_max)) 	{	$this->row_max=5;		}

	$this->row_count_all=mysql_num_rows($res);
	$this->list_count=ceil($this->row_count_all/$this->row_max);
	
	if ($this->list_now > $this->list_count) 	{   $this->list_now = $this->list_count;	}
	if ($this->list_now < 1) 					{  	$this->list_now = 1;					}
		
	$this->limit=($this->list_now-1)*$this->row_max;
	if ($this->limit<0) 						{ 	$this->limit=0; 						}
	$limit=$this->limit;
	$row_max=$this->row_max;
	
	$_SESSION['photoImport:list_now']=$this->list_now;
	$_SESSION['photoImport:row_max']=$this->row_max;

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
	if ($this->list_now>1) {
		$show.=			'<div class="clLinkList"><a id="idBtnPhotoImportPrev" href="#de">Предыдущая</a></div>';
	} else {
		$show.=			'<div class="clLinkList">Предыдущая</div>';
	}
	$show.=		'</td>';
	$show.=		'<td align="center">';
	$show.=			'<div class="clTextList">Страница <b>'.$this->list_now.'</b> из <b>'.$this->list_count.'</b>, показаны <b>'.$this->row_count_now.'</b> из <b>'.$this->row_count_all.'</b></div>';
	$show.=		'</td>';
	$show.=		'<td align="right">';
	if ($this->list_now<$this->list_count) {
		$show.=			'<div class="clLinkList"><a id="idBtnPhotoImportNext" href="#de">Следующая</a></div>';
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
	$show.=	'<table id="idTblPhotos" valign="top" align="center" border="0" cellpadding="4" cellspacing="0">';
		$show.=	'<tr>';
		$show.=	'<td class="clSomeText" align="center" width="120px"><b>Изобр.</b></td>';
		$show.=	'<td class="clSomeText" align="center" width="300px"><b>Путь к файлу</b></td>';
		$show.=	'<td class="clSomeText" align="center" width="100px"><b>Дата загрузки</b></td>';
		$show.=	'<td class="clSomeText" align="center" width="100px"></td>';
		$show.= '</tr>';
		$bgcolor="#ffffff";
		while($this->row=mysql_fetch_array($this->res)) {
			if ($bgcolor!="#ccffff") { $bgcolor="#ccffff"; } else { $bgcolor="#ffffff"; }

			if ((file_exists("../../../photo/100x80_".$this->row['filefullname'])) || (file_exists("../photo/100x80_".$this->row['filefullname']))) {
				$fullname=$this->row['filefullname'];
				//$show.=	'<tr bgcolor="'.$bgcolor.'">';
				$show.=	'<tr onMouseOver="link_over('.$this->row['id'].');" onMouseOut="link_leave('.$this->row['id'].');">';
				$show.=	'<td style="border:#ffffff solid 1px;" id="idTDLink1_'.$this->row['id'].'" class="clSomeText" align="center">';
				$show.=	'<div class="clDlgImgScale"><img id="idIMGLink_'.$this->row['id'].'" style="border:#ffffff solid 1px;" src="../photo/100x80_'.$fullname.'"></div>'; 
				$show.= '</td>';
				$show.=	'<td style="border:#ffffff solid 1px;" id="idTDLink2_'.$this->row['id'].'" class="clSomeText" align="left">';
					if ((file_exists('../../../photo/'.$fullname)) || (file_exists('../photo/'.$fullname))) {
						$show.='оригинал - <b>'.'photo/'.$fullname.'</b><br>';
					}
					$formats=$this->get_formats();
					for ($i=0;$i<sizeof($formats);$i++)	{
						$width=$formats[$i]['width'];
						$height=$formats[$i]['height'];
						$src='photo/'.$width.'x'.$height.'_'.$fullname;
						if ((file_exists('../../../'.$src)) || (file_exists('../'.$src))) {
							$show.=$width.'x'.$height.' - <b>'.$src.'</b><br>';
						}
					}
				
				$show.= '</td>';
				$show.=	'<td style="border:#ffffff solid 1px;" id="idTDLink3_'.$this->row['id'].'" class="clSomeText" align="right">';
					$postdt=explode('-',$this->row['post_d']);
					$show.=$postdt[2].'.'.$postdt[1].'.'.$postdt[0];
				$show.= '</td>';
				$show.=	'<td style="border:#ffffff solid 1px;" id="idTDLink4_'.$this->row['id'].'" class="clSomeText" align="center">';
				//$show.=	'<div class="clGetDlg"><div class="clLinkList" id="idLinkListDel_'.$this->row['id'].'"></div></div>'; 
				$show.=	'<div style="display:none;" id="idDelLink_'.$this->row['id'].'" class="clLinkList">';
				$show.=	'<a class="clDelPhotoDlg" id="idBtnDelPhoto_'.$this->row['id'].'" onclick="delurl('.$this->row['id'].');" href="#de">удалить</a></div>'; 
				$show.= '</td>';
				$show.=	'</tr>';
			}

		}

	$show.= '</table>';
	$show.= '</div>';
	$show.= '</div>';
//	}
	return $show;

}


function get_formats() {

	$ms=array();
	$sql="SELECT * FROM `".$this->prefix."_dataPhotoFormats` 
			WHERE (1=1) 
			ORDER by width ASC";
	$res=mysql_query($sql,$this->db);
	$rows_count=mysql_num_rows($res);
	$count=0;
	if ($rows_count>0) {
		while($row=mysql_fetch_array($res)) {
			$ms[$count]['id']=$row['id'];
			$ms[$count]['width']=$row['width'];
			$ms[$count]['height']=$row['height'];
			$count++;
		}
	}
	return $ms;

}

function show_formats() {

	$show="";
	$ndx=0;
	$formats=$this->get_formats();
	if (sizeof($formats)>0) {
	$show.='<table align="center" cellpadding="2" cellspacing="0" border="0">';
			$show.='<tr>';
			$show.='<td width="100px" align="center"></td>';
			$show.='<td width="150px" align="center"><b>Ширина/Высота</b></td>';
			$show.='<td width="100px" align="center"></td>';
			$show.='</tr>';

		for ($i=0;$i<sizeof($formats);$i++)	{
			$ndx++;
			$show.='<tr onMouseOver="format_over('.$formats[$i]['id'].');"  onMouseOut="format_leave('.$formats[$i]['id'].');">';
			$show.='<td>&nbsp;';
			$show.='</td>';
			$show.='<td style="border:#ffffff solid 1px;" id="idTDFormat_'.$formats[$i]['id'].'" align="center">';
			$show.=$formats[$i]['width'].' x '.$formats[$i]['height'];
			$show.='</td>';
			$show.='<td align="center">';
				$this->id=$formats[$i]['id'];
				$this->mid=($this->id+50);
			$show.=	'<div style="display:none;" id="idDelFormat_'.$formats[$i]['id'].'" class="clLinkList"><a id="idBtnDelFormat_'.$formats[$i]['id'].'" href="#de">удалить</a></div>'; 
			$show.= $this->js_del_format();
			$show.='</td>';
			$show.='</tr>';
		}
	$show.='</table>';

	} else {

		$show.='<b>Нет информации о необходимых разрешениях фотографий!</b>';
		
	}
	
	return $show;

}


function js_new_format() {

	$this->fn_js->object_id=		"idBtnNewFormat";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Новый формат</strong>";
	$this->fn_js->text=				"Пожалуйста, введите <b>ширину и высоту</b>в px для нового формата картинок.<br>";
	$this->fn_js->text.=			"<div class='clInput'>";
	$this->fn_js->text.=			"<form id='idFrmNewFormat' name='nmFrmNewFormat' action='index.php?page=photoImport&action=new_format' method='POST'>";
	$this->fn_js->text.=			"Ширина: <input class='dialog_input' type='text' name='nmNewFormatWidth' id='idNewFormatWidth' value='100' size='8'>";
	$this->fn_js->text.=			"Высота: <input class='dialog_input' type='text' name='nmNewFormatHeight' id='idNewFormatHeight' value='100' size='8'>";
	$this->fn_js->text.=			"</form>";
	$this->fn_js->text.=			"</div>";
	$this->fn_js->functionYES=		"btnNewFormat_click();";
	$this->fn_js->buttonYES=		"Да";
	$this->fn_js->buttonNO=			"Нет";
	$this->fn_js->id=				"deAskNewFormat";
	$this->fn_js->zindex=			"220";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}


function js_save_photo() {

	$this->fn_js->object_id=		"idBtnSavePhoto";
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Подтверждение</strong>";
	$this->fn_js->text=				"Вы действительно хотите сохранить эту фотографию?";
	$this->fn_js->functionYES=		"btnSavePhoto_click();";
	$this->fn_js->linkYES=			"#de";
	$this->fn_js->functionNO=		"";
	$this->fn_js->linkNO=			"#de";
	$this->fn_js->id=				"deAskSavePhoto";
	$this->fn_js->zindex=			"140";
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;

}


function js_del_photo() {

	$this->fn_js->object_id=		"idBtnDelPhoto_".$this->id;
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Подтверждение</strong>";
	$this->fn_js->text=				"Вы действительно хотите удалить эту фотографию?";
	$this->fn_js->functionYES=		"";
	$this->fn_js->linkYES=			"index.php?page=photoImport&action=del_photo&id=".$this->id;
	$this->fn_js->functionNO=		"";
	$this->fn_js->linkNO=			"#de";
	$this->fn_js->id=				"deAskDelPhoto".$this->id;
	$this->fn_js->zindex=			"1".$this->mid;
	$this->fn_js->timeBefore=		"10";
	$show=$this->fn_js->showYesNo();
	return $show;
}


function js_del_format() {

	$this->fn_js->object_id=		"idBtnDelFormat_".$this->id;
	$this->fn_js->event_start=		"click";
	$this->fn_js->caption=			"<strong>Подтверждение</strong>";
	$this->fn_js->text=				"Вы действительно хотите удалить этот формат?";
	$this->fn_js->functionYES=		"";
	$this->fn_js->linkYES=			"index.php?page=photoImport&action=del_format&id=".$this->id;
	$this->fn_js->functionNO=		"";
	$this->fn_js->linkNO=			"#de";
	$this->fn_js->id=				"deAskDelFormat".$this->id;
	$this->fn_js->zindex=			"1".$this->mid;
	$this->fn_js->timeBefore=		"200";
	$show=$this->fn_js->showYesNo();
	return $show;
}



}



?>