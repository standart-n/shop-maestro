<? class tpl_article {

function article($q,$r,$img) { $u=$q->url; $s="";
	foreach (array("SNAME","SERIA","SCOUNTRY","PRICE","REALQUANT") as $key) { 
		$k=strtolower($key); $$k=$q->fn->toUTF($r->$key);
	}
	if ($realquant > 0) {
		$quant = 'есть';
	} else {
		$quant = 'мало';
	}
	$s.='<div id="article">';
	$s.='	<div id="article-left">';
	$s.='		<div id="article-image">';
	$s.='		'.$this->showImg($q,$r,$img);
	$s.='		</div>';
	$s.='		<div id="article-icons">';
	$s.='		</div>';
	$s.='	</div>';
	$s.='	<div id="article-right">';
	$s.='	<form action="index.php" method="GET" onSubmit="return articleFormSubmit();">';
	$s.='		<div id="article-caption">';
	$s.='		'.$q->tpl_price->label("name",$sname,'label');
	$s.='		</div>';
	$s.='		<div id="article-seria">';
	$s.='		<span class="label-var">Артикул:</span>';
	$s.='		'.$q->tpl_price->label("seria",$seria,'label');
	$s.='		<span class="label-var">Cтрана:</span>';
	$s.='		'.$q->tpl_price->label("seria",$scountry,'label');
	$s.='		</div>';
	$s.='		<div id="article-dop">';
	$s.='		[dopinfo]';
	$s.='		</div>';
	$s.='		<div id="article-price">';
	$s.='		<span class="label-var">Количество:</span>';
	$s.='		<input id="article-quant-need" name="article-quant-need" class="input-count" type="text" value="1" maxlength="40">';
	$s.='		<span class="label-lquant">Наличие:</span>';
	$s.='		'.$q->tpl_price->label("quant",$quant,'label');
	$s.='		<span class="label-cenn">Цена:</span>';
	$s.='		'.$q->tpl_price->label("price",$price,'label');
	$s.='		</div>';
	if ($q->results->showAddButton) {
		// if ($realquant>=0) {
			$s.=		'<div id="article-buy">';
			$s.=		'<input onMouseOver="articleBtnAddOver();" onMouseLeave="articleBtnAddLeave();" ';
			$s.=		'class="btn-article-add-disable" type="submit" id="btn-article-add" value="Добавить в корзину">';
			$s.=		'</div>';
		// } else {
		// 	$s.=		'<div id="article-buy">';
		// 	$s.=		'<span class="label-zero">Нет в наличии</span>';
		// 	$s.=		'</div>';
		// }
	}
	if (isset($q->results->add)) {
		$s.=		'<div id="article-result">';
		$s.=		'<span class="label-positive">'.$q->results->add.'</span>';
		$s.=		'</div>';
	}
	if (isset($q->errors->add)) {
		$s.=		'<div id="article-result">';
		$s.=		'<span class="label-zero">'.$q->errors->add.'</span>';
		$s.=		'</div>';
	}
	if (isset($q->labels->add)) {
		$s.=		'<div id="article-result">';
		$s.=		'<span class="label-silver">'.$q->labels->add.'</span>';
		$s.=		'</div>';
	}
 	$s.='	</form>';
	$s.='	</div>';
	$s.='</div>';
	return $s;	
}

function dopInfo($q,$r) { $u=$q->url; $s="";
	$var=$r->SDESCRIPTION; $val=$r->VALS;
	$q->validate->baseStr($var);
	$q->validate->baseStr($val);
	$s.='<div class="label-dop-line">';
	$s.='<div class="label-dop-var">'.$var.':</div>';
	$s.='<div class="label-dop-value">'.$val.'</div>';
	$s.='</div>';
	return $s;
}

function showImg($q,$r,$img) { $s=""; 
	if ($img!="") {
		$seria=$q->fn->toUTF($r->SERIA);
		$seria=preg_replace('/"/i','',$seria);
		$s.='<img width="250px" align="center" alt="'.$seria.'" src="'.$img.'">';
	}
	return $s;
}

} ?>
