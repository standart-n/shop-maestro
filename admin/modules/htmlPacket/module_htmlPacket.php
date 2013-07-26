<?php class htmlPacket {
var $module_caption=	"HTML пакеты";
var $module_group=		"user";
var $module_name=		"htmlPacket";
var $module_key=        "html";
var $module_obj=        "modern";
var $module_about=      "Данное приложение позволяет сохранить сайт в виде html файлов.";
var $module_fn=         "fn_ajax|fn_files|fn_url|fn_mdl";
var $module_get=        "action|id|value";
var $module_header=     "left:150px|center:500px|right:150px";
var $module_footer=     "left:150px|center:500px|right:150px";

function engine() { $ms=array(); $show=""; $js=""; $css=""; $m=$this->fn_mdl;
	$mdl="module_name"; /*$this->install();*/ $m->$mdl=$this->$mdl;
	if ($this->page==$this->$mdl) { $js=$m->js(); $css=$m->css();
        $show.=$m->info($this->module_name);
        $show.=$m->about($this->module_about).$m->statusBox();
        $show.=$m->form($this->module_header,$this->module_footer);
	    $ms['title']=$this->module_caption;  $ms['description']=$this->module_caption;
        $ms['keywords']=$this->module_key; $ms['html']=$show; $ms['result']="TRUE";
        $ms['js']=$js; $ms['css']=$css;
    } return $ms;
}

function start() { $m=$this->fn_mdl; 
	$m->caption("Пакеты");
    $m->button("header","left","build");
    $m->button("header","right","settings");
    $m->button("footer","right","delete");
    echo $m->body($this->body());
}
function packets() { $this->start(); }
function delete() { $m=$this->fn_mdl; $m->caption("Пакеты"); }
function remove() { $m=$this->fn_mdl; $m->caption("Пакеты"); $id=$this->id; $a=$this->fn_ajax;
    $sql="SELECT * FROM `".$this->prefix."_dataHTMLpackets` WHERE (id=".$id.") ORDER by post_dt DESC";
    $ms=$m->getRow($sql); $this->code=$ms['name'];
    if (file_exists($m->local().$this->file_path())) { unlink($m->local().$this->file_path()); }
    $sql="DELETE FROM `".$this->prefix."_dataHTMLpackets` WHERE (id=".$id.")";
    $m->delRow($sql);
    echo $a->css('#id_part_line_'.$id,'display','none');
}
function line() { $m=$this->fn_mdl; $m->caption("Информация"); $m->body(""); $id=$this->id;
    $m->clear("header","right");
    $m->clear("footer","right");
    $m->button("header","left","packets");
    $ms=$m->getRow("SELECT * FROM `".$this->prefix."_dataHTMLpackets` WHERE (id=".$id.") ORDER by post_dt DESC");
    $this->date=$ms['post_d']; $this->time=$ms['post_t']; $this->code=$ms['name'];
    $m->add($m->addLine("Код",$ms['name']));
    $m->add($m->addLine("Дата сборки",$this->getDate()));
    if (file_exists($m->local().$this->file_path())) {
        $m->add($m->addLine("Время сборки",$ms['time']." сек."));
        $m->add($m->addLine("Размер",$this->file_size()));
        $m->add($m->addLine("Файлы",$ms['count']));
        $m->add($m->addLine("Папки",$ms['folders']));
        $m->add($m->addLine("&nbsp;",$this->down_load()));
    } else {
        $m->add($m->addLine("Ошибка","Файл не найден!"));
    }
}

function getDate() { $date_ms=explode("-",$this->date); $time_ms=explode(":",$this->time);
  return $date_ms[2].".".$date_ms[1]." ".$time_ms[0].":".$time_ms[1];
}
function down_load() { $m=$this->fn_mdl; return "<a id=\"id_btn_download\" href=\"../".$this->file_path($this->code)."\"></a>"; }
function file_path() { $m=$this->fn_mdl; return "html/htmlPacket_".$this->code.".zip";  }
function file_size() { $m=$this->fn_mdl; return strval(round((filesize($m->local().$this->file_path()))/1024))." кб"; }

function body() { $show=""; $m=$this->fn_mdl;
    $sql="SELECT * FROM `".$this->prefix."_dataHTMLpackets` WHERE (1=1) ORDER by post_dt DESC";
    $show.=$m->getList($sql,"caption"); return $show;
}

function build() { $m=$this->fn_mdl;
	foreach (explode("|","urls|history|files|fold|arh") as $key) $this->$key=array();
    $work_time=time();  $this->zip_code=substr(md5($work_time),0,8);
    $this->flag="FALSE"; $this->h=0;
    require_once($m->local()."external/pclzip.lib.php");
    $this->getOpt(); $this->urls[0]=$this->index;
    $this->archive=new PclZip($m->local()."html/htmlPacket_".$this->zip_code.".zip");
    while ($this->flag=="FALSE") {
        for ($i=0;$i<sizeof($this->urls);$i++) { if ($this->urls[$i]!="none") { $this->getURL($i); } }
    }
    $folder_ms=explode(",",$this->folders);
    for ($i=0;$i<sizeof($folder_ms);$i++) { $this->fold[]=$m->local().$folder_ms[$i]; }
    $this->arh=array_merge($this->files,$this->fold);
    /*$list=$this->archive->add($this->arh,PCLZIP_OPT_REMOVE_ALL_PATH);
    foreach ($this->files as $key) { unlink($key); }
    $this->count=sizeof($this->files);
    $this->fold_count=sizeof($this->fold);
    $this->work_time=time()-$work_time;
    $this->date=date("d.m H:i");
    $this->caption=$this->getCaption();
    $zip_id=$this->insPacket();
    $this->id=$zip_id; $this->line();*/
}
function getCaption() { return "Пакет от ".$this->date; }
function insPacket() { $m=$this->fn_mdl;
    $sql="INSERT INTO `".$this->prefix."_dataHTMLpackets` (name,caption,post_dt,post_d,post_t,time,count,folders)
          values ('".$this->zip_code."','".$this->caption."',NOW(),NOW(),NOW(),".$this->work_time.",".$this->count.",".$this->fold_count.")";
    $id=$m->insRow($sql); return $id;
}
function getURL($i) { $m=$this->fn_mdl; $mas=array(); $url=$this->urls[$i];
 foreach (explode("|","files:|ftp:|http:|//| |www.") as $key) $url=str_replace($key,"",$url);
 $url=$this->url.$url;
 if ($this->fn_url->isValidUrl($url)) { if (fopen($url,"r")) {
        $path=$m->local()."html/".$this->urls[$i].$this->postfix;
        //if (!file_exists($path)) {
            $page=file_get_contents($url);
            $this->fn_files->saveTextInFile($path,$page);
            $this->files[]=$path;
            preg_match_all('/href="'.$this->mask.'"/si',$page,$mas);
            foreach ($mas[0] as $fo) { $fo=trim($fo); $cut_ms=explode(",",$this->cut);
                for ($l=0;$l<sizeof($cut_ms);$l++) $fo=str_replace($cut_ms[$l],'',$fo);
                $fo=str_replace('"','',$fo); $fo=str_replace("'","",$fo);
                if ($this->checkHistory($fo)=="FALSE") $this->urls[]=$fo;
            }
        //}
  } }
  $this->history[]=$this->urls[$i]; $this->urls[$i]="none"; $this->checkFlag();
}
function checkHistory($url) { $check="FALSE";
    foreach ($this->history as $key) if ($key==$url) $check="TRUE";
    return $check;
}
function checkFlag() { $this->flag="TRUE";
    for ($i=0;$i<sizeof($this->urls);$i++) if ($this->urls[$i]!="none") $this->flag="FALSE";
}

function settings() { $m=$this->fn_mdl;
	$m->caption("Настройки"); 
    $m->button("header","left","packets");
    $m->clear("header","right");
    $m->clear("footer","right");
    $m->body($m->settings($m->ini()));
}
function settingsSave() { $m=$this->fn_mdl; 
	$m->fn_files=$this->fn_files;
    $m->settingsSave($this->id,$this->value,$m->ini());
}
function getOpt() { $m=$this->fn_mdl;
	$ini_p=parse_ini_file($m->ini(),true);
	while (list($option,$line)=each($ini_p)) { $mark=$line['name']; $this->$mark=$line['value']; } 
}

function install() {
   $sql="CREATE TABLE IF NOT EXISTS `".$this->prefix."_dataHTMLpackets` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `caption` varchar(255) NOT NULL default '',
  `post_dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `post_d` date NOT NULL default '0000-00-00',
  `post_t` time NOT NULL default '00:00:00',
  `count` int(10) NOT NULL default '0',
  `time` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
  $res=mysql_query($sql,$this->db);
}

} ?>
