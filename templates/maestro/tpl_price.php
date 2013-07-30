<?php class tpl_price {

function line($q,$r) { $u=$q->url; $s=""; $i=0;
	$s.='<tr valign="top">';
	$id=intval($q->fn->toUTF($r->PART_ID));
	foreach (array("SNAME","PHOTO","EXISTS","BUY","PRICE") as $key) { $i++;
		switch ($key) {
			case "SNAME": 
				$a=$q->fn->toUTF($r->SNAME);
				$a=$this->label("name",$a); $align="left"; 
			break;
			case "PHOTO":
				$a='';
				$img=$q->fn->getImage($r);
				if ($img !== '') {
					$hash=md5($img);
					$a.='<div class="price-icon-image" data-image="'.$hash.'"></div>';
					$a.='<div class="price-image-preview" data-preview="'.$hash.'"><img width="100px" src="'.$img.'"></div>';
				}
			break;
			case "EXISTS": 
				if ($r->REALQUANT>0) {
					//$a=$this->label("country","есть");
					$a='<div class="price-exists-true"></div>';
				} else {
					$a='<div class="price-exists-false"></div>';
					//$a=$this->label("country","нет");
				}
				$align="center"; 
			break;
			case "BUY": 
				$a="Купить"; $align="right"; 
			break;
			case "PRICE": 
				$a=$q->fn->toUTF($r->PRICE);
				$a=$this->label("price",$a); $align="right"; 
			break;
			default: $align="left";
		}
		switch ($key) {
			case "SNAME": 
				$s.='<td class="table-price-link" align="'.$align.'">';
				$s.='<a ';
				$s.='href="';
				$s.=	$q->fn->getUrlPrice($u->site,"price",$u->page,$u->group,$u->portion,$u->first,$u->search,'line',$id,$u->sort,$u->grad,$u->presence);
				$s.='">';
				if ($q->url->id==$id) { $s.='<b>'.$a.'</b>'; } else { $s.=$a; }				
				$s.='</a></td>'; 
			break;
			case "BUY":
				$s.='<td class="table-price-link" align="'.$align.'">';
				$s.='<a class="price-icon-buy" ';
				$s.='href="';
				$s.=	$q->fn->getUrlPrice($u->site,"price",$u->page,$u->group,$u->portion,$u->first,$u->search,'line',$id,$u->sort,$u->grad,$u->presence);
				$s.='">';
				//if ($q->url->id==$id) { $s.='<b>'.$a.'</b>'; } else { $s.=$a; }
				$s.='</a></td>'; 
			break;
			default: $s.='<td class="table-price-line" align="'.$align.'">'.$a.'</td>';
		}
	}
	$s.='</tr>';	
	return $s;
}


/*
function line($q,$r) { $u=$q->url; $s=""; $i=0;
	$s.='<tr valign="top">';
	$id=intval($q->fn->toUTF($r->PART_ID));
	foreach (array("SNAME","SCOUNTRY","SERIA","PRICE") as $key) { $i++;
		$a=$q->fn->toUTF($r->$key);
		switch ($key) {
			case "SNAME": $a=$this->label("name",$a); $align="left"; break;
			case "SCOUNTRY": $a=$this->label("country",$a); $align="center"; break;
			case "SERIA": $a=$this->label("seria",$a); $align="right"; break;
			case "PRICE": $a=$this->label("price",$a); $align="right"; break;
			default: $align="left";
		}
		switch ($key) {
			case "SNAME": 
				$s.='<td class="table-price-link" align="'.$align.'">';
				$s.='<a ';
				$s.='href="';
				$s.=	$q->fn->getUrlPrice($u->site,"price",$u->page,$u->group,$u->portion,$u->first,$u->search,'line',$id,$u->sort,$u->grad,$u->presence);
				$s.='">';
				if ($q->url->id==$id) { $s.='<b>'.$a.'</b>'; } else { $s.=$a; }				
				$s.='</a></td>'; 
			break;
			default: $s.='<td class="table-price-line" align="'.$align.'">'.$a.'</td>';
		}
	}
	$s.='</tr>';	
	return $s;
}
*/

function portion($q) { $u=$q->url; $s="";
	$s.='<div id="portion">';
	$s.='<div class="portion-caption">Выводить по</div>';
	foreach (explode("|","10|20|30|50") as $key) {
		if ($u->portion==$key) { $cl="-active"; } else { $cl=""; }
		$s.='<a class="portion-link'.$cl.'" ';
		$s.=	'link-method="none" ';
		$s.=	'link-action="portion" ';
		$s.=	'link-portion="'.$key.'" ';
		$s.=	'href="';
		$s.=	$q->fn->getUrlPrice($u->site,"price",$u->page,$u->group,$key,$u->first,$u->search,'portion','0',$u->sort,$u->grad,$u->presence);
		$s.=	'"';
		$s.='>';
		$s.=$key;
		$s.='</a>';
	}
	$s.='<div class="portion-caption">позиций</div>';
	$s.='</div>';
	return $s;
}

function listButtons($q) { $u=$q->url; $s=""; $cl_prev=""; $cl_next="";
	if ($u->first>=$u->portion) { $prev=$u->first-$u->portion; } else { $prev=$u->first; $cl_prev.="-disable"; }
	if ($u->count<$u->portion) { $next=$u->first; $cl_next.="-disable"; } else { $next=$u->first+$u->portion; }
	$s.='<div id="list-buttons">';
	$s.='<a ';
	$s.=	'link-method="ajax" ';
	$s.=	'link-action="prev" ';
	$s.=	'class="list-btn'.$cl_prev.'" ';
	$s.=	'id="list-prev" ';
	$s.=	'href="'.$this->linkForButtons($q,$prev,'prev').'" ';
	$s.='>';
	$s.=	'< Предыдущая';
	$s.='</a>';
	$s.='<a ';
	$s.=	'link-method="ajax" ';
	$s.=	'link-action="next" ';
	$s.=	'class="list-btn'.$cl_next.'" ';
	$s.=	'id="list-next" ';
	$s.=	'href="'.$this->linkForButtons($q,$next,'next').'" ';
	$s.='>';
	$s.=	'Следующая >';
	$s.='</a>';
	$s.='</div>';
	return $s;
}

function steps($q,$cats=array('Все товары:0')) { $u=$q->url; $s=""; $i=0;
	$s.='<div id="steps">';
	$s.='<div class="steps-caption">Выбрано:</div>';
	foreach ($cats as $key) { $ms=explode(":",$key); $i++; $arrow=false;
		$caption=$ms[0]; $id=$ms[1];
		if ($caption!="Все товары") { $caption=$q->fn->toUTF($caption); }
		if (($i>=(sizeof($cats))) || (sizeof($cats)<=1)) { $cl="-active"; } else { $cl=""; $arrow=true; }
		$s.='<a ';
		$s.=	'class="steps-link'.$cl.'" ';
		$s.=	'link-method="ajax" ';
		$s.=	'href="'.$q->fn->getUrlPrice($u->site,"price",$u->page,$id,$u->portion,0,'','step','0',$u->sort,$u->grad,$u->presence).'" ';
		$s.='>';
		$s.=	$caption;
		$s.='</a>';
		if ($arrow) { $s.='<div class="steps-arrow"></div>'; }
	}
	$s.='</div>';
	return $s;
}

function searchInput($q) { $s="";
	$s.='<div id="search">';
	$s.='<form action="index.php" method="GET" onSubmit="return searchFormSubmit();">';
	$s.='<input ';
	$s.=	'id="search-value" ';
	$s.=	'class="input-search" ';
	$s.=	'maxlength="30" ';
	$s.=	'type="text" ';
	$s.=	'value="'.$q->url->search.'"';
	$s.='>';
	$s.='</form>';
	$s.='</div>';
	$s.='<div id="search-icon"></div>';
	return $s;
}

function presence($q) { $s="";
	$s.='<div id="presence">';
	$s.='<span class="presence-box-wrap">';
	$s.='<input ';
	$s.=	'id="presence-checkbox" ';
	$s.=	'link-method="none" ';
	$s.=	'type="checkbox" ';
	$s.=	'value="zero" ';
	if ($q->url->presence=="true") {
		$s.='checked';
	}
	$s.='>';
	$s.='</span>';
	$s.='<span class="presence-caption">Есть в наличии</span>';
	$s.='</div>';
	return $s;
}

function priceCorner($q) { $s=""; $i=0;
	$s.='<div id="price-corner" ';
	switch(intval($q->url->group_parent)) {
		case 587: $i=1; break;
		case 593: $i=2; break;
		case 594: $i=3; break;
		case 588: $i=4; break;
		case 632: $i=5; break;
		case 590: $i=6; break;
		case 591: $i=7; break;
		case 592: $i=8; break;
		case 612: $i=9; break;
	}
	$l=20+($i-1)*99;
	if ($i>0) {
		$s.='style="left:'.$l.'px;"';
	} else {
		$s.='style="background:none;"';
	}
	$s.='></div>';
	return $s;
}

function tableFooter() { $s="";
	$s.='</table>';
	return $s;
}

function price(&$q) { $s="";
	$s.='	<div id="table-price">';
	$s.='		[price-corner]';
	$s.='		<div id="table-tools">';
	$s.='			<div id="search-wrap" class="search-wrap">';
	$s.='				[search]';
	$s.='			</div>';
	$s.='			<div id="portion-wrap">';
	$s.='				[portion]';
	$s.='			</div>';
	$s.='			<div id="presence-wrap">';
	$s.='				[presence]';
	$s.='			</div>';
	$s.='		</div>';
	$s.='		<div id="table-steps">';
	$s.='			<div id="steps-wrap">';
	$s.='				[steps]';
	$s.='			</div>';			
	$s.='		</div>';
	$s.='		<div id="table-data">';
	$s.='			[table-price]';
	$s.='		</div>';
	$s.='		<div id="table-list">';
	$s.='			[table-list]';
	$s.='		</div>';
	$s.='	</div>';
	return $s;
}


function label($type="name",$a="",$cl="field") { $s=$a;
	switch ($type) {
	case "name":
		$s=str_replace("!","",$s);
	break;
	case "seria":
		if ($s=="") { $s="-"; }
		$s='<span class="'.$cl.'-seria">'.$s.'</span>';
	break;
	case "country":
		if ($s=="") { $s="-"; }
		$s='<span class="'.$cl.'-country">'.$s.'</span>';
	break;
	case "price":
		$s=str_replace(",",".",$s);
		$s=round($s,2);
		$s=str_replace(".",",",$s);
		if ($s=="") { $s="-"; }
		$s='<span class="'.$cl.'-price">'.$s.'</span><span class="'.$cl.'-rub">р.</span>';
	break;
	}	
	return $s;
}

function tableHead($q) { $s="";
	$s.='<table align="center" cellpadding="0" cellspacing="2" border="0" width="100%">';
	$s.='<tr valign="top">';
		$s.='<td id="th-SNAME" class="table-price-caption" width="600px" align="left">';
		$s.=$this->linkForSort($q,"SNAME","Наименование");
		$s.='</td>';
		$s.='<td id="th-SERIA" class="table-price-caption" width="50px" align="right">';
		//$s.="Купить";
		//$s.=$this->linkForSort($q,"SERIA","Артикул");
		$s.='</td>';
		$s.='<td id="th-SCOUNTRY" class="table-price-caption" width="50px" align="center">';
		$s.='<span class="table-price-exists">Наличие</span>';
		//$s.=$this->linkForSort($q,"SCOUNTRY","Страна");
		$s.='</td>';
		$s.='<td id="th-PRICE" class="table-price-caption" width="100px" align="right">';
		$s.=$this->linkForSort($q,"PRICE","Цена");
		$s.='</td>';
	$s.='</tr>';
	return $s;
}

function linkForButtons($q,$start,$type) { $u=$q->url; $s="";
	$s=$q->fn->getUrlPrice($u->site,"price",$u->page,$u->group,$u->portion,$start,$u->search,$type,'0',$u->sort,$u->grad,$u->presence);
	return $s;
}

function linkForSort($q,$type,$caption) { $u=$q->url; $s=""; $cl="sort";
	if ($type!=$u->sort) {
		$sort=$type; $grad="ASC";
	} else {
		$sort=$u->sort; 
		if ($u->grad=="ASC") { 
			$grad="DESC"; $cl.="-up"; 
		} else {
			$grad="ASC"; $cl.="-down"; 
		}
	}
	$url=$q->fn->getUrlPrice($u->site,"price",$u->page,$u->group,$u->portion,0,$u->search,$sort.'-'.$grad,'0',$sort,$grad,$u->presence);
	$s.='<a ';
	$s.=	'link-method="ajax" ';
	$s.=	'href="'.$url.'" ';
	$s.='>';
	$s.=	$caption;
	$s.='</a>';
	$s.='<div class="'.$cl.'"></div>';
	return $s;
}



} ?>
