<?php class tpl_design {

function toolbar($q) { $s="";
	$s.='<table id="table-nav" align="center" cellpadding="0" cellspacing="0" border="0">';
	$s.='<tr valign="top">';
	$s.=	'<td>';
	$s.=	$this->toolbarLine($q,"main","Главная","disable",false);
	$s.=	$this->toolbarLine($q,"company","О нас","disable",true);
	$s.=	$this->toolbarLine($q,"service","Сервис","disable",true);
	$s.=	$this->toolbarLine($q,"contacts","Контакты","disable",true);
	$s.=	$this->toolbarLine($q,"test","Тест","active",false,true);
	$s.=	'</td>';
	$s.='</tr>';
	$s.='</table>';
	return $s;
}

function toolbarLine($q,$type,$caption,$act,$url=false,$hidden=false) { $u=$q->url; $s="";
	$s.='<a id="button-'.$type.'" ';
	if ($hidden) { $s.='style="display:none;" '; }
	$s.='class="toolbar-button ';
	$s.='toolbar-button-'.$act.'" ';
	if ($url) {
		$s.='href="'.$q->fn->getUrlText($u->site,"text",$type).'" ';
	} else {
		$s.='href="http://'.$u->site.'" ';
	}
	$s.='>';
	$s.=$caption;
	$s.='</a>';
	return $s;
}

function bar($q,$count=0,$enter=false,$name="") { $u=$q->url; $s="";
	$s.='<div id="bar">';
	if ($name!="") {
		$s.=	'<div id="bar-welcome">';
		$s.=		'<div id="bar-welcome-caption">';
		$s.=			'Здравствуйте, ';
		$s.=		'</div>';
		$s.=		'<div id="bar-welcome-name">';
		$s.=			$name;
		$s.=		'</div>';
		$s.=	'</div>';
	}
	$s.=	'<div id="bar-line">';
	$s.=		'<div class="bar-icon" id="bar-icon-cart"></div>';
	$s.=		'<a ';
	$s.=			'class="bar-link" ';
	$s.=			'href="'.$q->fn->getUrlText($u->site,"order","basket").'" ';
	$s.=		'>';
	$s.=		'Корзина ('.$count.')';
	$s.=		'</a>';
	$s.=		'<div class="bar-icon" id="bar-icon-enter"></div>';
	if (!$enter) {
		$s.=		'<a class="bar-link" ';
		$s.=			'href="'.$q->fn->getUrlText($u->site,"user","enter").'" ';
		$s.=		'>';
		$s.=			'Вход с паролем';
		$s.=		'</a>';
	} else {
		$s.=		'<a class="bar-link" ';
		$s.=			'href="'.$q->fn->getUrlText($u->site,"price","exit").'" ';
		$s.=		'>';
		$s.=			'Выход';
		$s.=		'</a>';
	}
	$s.=	'</div>';
	$s.='</div>';
	return $s;
}


function icons($q) { $s="";
	$s.=$this->linkForIcons($q,"ico-tools","ico-nav",587);
	$s.=$this->linkForIcons($q,"ico-chemistry","ico-nav",593);
	$s.=$this->linkForIcons($q,"ico-safeguard","ico-nav",594);
	$s.=$this->linkForIcons($q,"ico-fasteners","ico-nav",588);
	$s.=$this->linkForIcons($q,"ico-handtools","ico-nav",632);
	$s.=$this->linkForIcons($q,"ico-electric","ico-nav",590);
	$s.=$this->linkForIcons($q,"ico-gear","ico-nav",591);
	$s.=$this->linkForIcons($q,"ico-svarka","ico-nav",592);
	$s.=$this->linkForIcons($q,"ico-laser","ico-nav",612);
	return $s;
}

function linkForIcons($q,$type,$cl,$id) { $u=$q->url; $s="";
	$s.='<a ';
	$s.=	'id="'.$type.'" ';
	$s.=	'class="'.$cl.'" ';
	$s.=	'href="'.$q->fn->getUrlPrice($u->site,"price",$u->page,$id,$u->portion,'0','','icon','0',$u->sort,$u->grad).'" ';
	$s.='>';
	$s.='</a>';
	return $s;
}


function shadow($q) {$s="";
	$s.='<div id="shadow">';
	foreach ($q->url as $key=>$value) {
		$s.='<input type="hidden" id="sh-'.$key.'" value="'.$value.'">';
	}
	$s.='</div>';
	return $s;
}

} ?>
