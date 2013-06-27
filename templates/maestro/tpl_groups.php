<?php class tpl_groups {

function groupLine($q,$r,$type,$conv=true) { $u=$q->url; $s=""; $cl="group-tree-".$type;
	if ($conv) {
		$id=intval($q->fn->toUTF($r->ID));
		$cap=$q->fn->toUTF($r->CAPTION);
	} else {
		$id=intval($r->ID); 
		$cap=trim(strval($r->CAPTION));
	}
	if ($id==$u->group) { $cl.=" group-tree-active"; }
	$s.='<div class="group-tree-'.$type.'">';
	$s.='<a ';
	$s.=	'class="'.$cl.'" ';
	//$s.=	'link-method="ajax" ';
	//$s.=	'link-action="group" ';
	$s.=	'href="'.$q->fn->getUrlPrice($u->site,"price",$u->page,$id,$u->portion,0,'','tree','0',$u->sort,$u->grad,$u->presence).'" ';
	$s.='>';
	$s.=	$cap;
	$s.='</a>';
	$s.='</div>';
	return $s;
}


} ?>
