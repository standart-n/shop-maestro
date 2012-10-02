<?php class tpl_orders {

function basket($q,$ms,$total,$count) { $s=""; $u=$q->url;
	$s.='<div id="orders">';
	$s.='	<div class="orders-caption">Ваша корзина</div>';

	$s.=	'<div class="orders-message orders-message-error">';
	if ($count<1) { 
		$s.=		'<div>Ваша корзина пуста</div>';
	}
	$s.=	'</div>';

	$s.=	'<div id="orders-box">';
	if ($count>0) {
	$s.=		'<table cellspacing="1" cellpadding="2" border="0">';
	$s.=			'<tr>';
	$s.=				'<td align="center">';
	$s.=				'</td>';
	$s.=				'<td align="left">';
	$s.=					'<span class="orders-table-caption">';
	$s.=						'Наименование';
	$s.=					'</span>';
	$s.=				'</td>';
	$s.=				'<td align="left">';
	$s.=					'<span class="orders-table-caption">';
	$s.=						'Кол-во';
	$s.=					'</span>';
	$s.=				'</td>';
	$s.=				'<td align="right">';
	$s.=					'<span class="orders-table-caption">';
	$s.=						'Сумма';
	$s.=					'</span>';
	$s.=				'</td>';
	$s.=				'<td>';
	$s.=				'</td>';
	$s.=			'</tr>';
	foreach ($ms as $r) {
		$s.=		'<tr tr_part_id='.$r->ID.' valign="top">';
		$s.=			'<td width="50px" align="center">';
		$s.=				'<span class="orders-table-index">';
		$s.=					$r->i;
		$s.=				'</span>';
		$s.=			'</td>';
		$s.=			'<td width="480px">';
		$s.=				'<div class="orders-table-top">';
		$s.=					'<a class="orders-sname-link" ';
		$s.=						'href="'.$q->fn->getUrlPrice($u->site,"price",$u->page,$u->group,$u->portion,$u->first,$u->search,'line',$r->ID,$u->sort,$u->grad,$u->presence).'" ';
		$s.=					'>';
		$s.=						$r->SNAME;
		$s.=					'</a>'; 
		//$s.=					'<span class="orders-table-name">';
		//$s.=						$r->SNAME;
		//$s.=					'</span>';
		$s.=				'</div>';
		$s.=				'<div class="orders-table-middle">';
		if ($r->SCOUNTRY!="") {
			$s.=				'<span class="orders-table-field">';
			$s.=					' изготовитель: ';
			$s.=				'</span>';
			$s.=				'<span class="orders-table-country">';
			$s.=					$r->SCOUNTRY.',';
			$s.=				'</span> ';
		}
		if ($r->SERIA!="") {
			$s.=				'<span class="orders-table-field">';
			$s.=					' артикул: ';
			$s.=				'</span>';
			$s.=				'<span class="orders-table-seria">';
			$s.=					$r->SERIA;
			$s.=				'</span>';
		}
		$s.=				'</div>';
		$s.=				'<div class="orders-table-bottom">';
		$s.=					'<span class="orders-table-price">';
		$s.=						$r->PRICE;
		$s.=					'</span>';
		$s.=					'<span class="orders-table-rub">';
		$s.=						'р.';
		$s.=					'</span>';
		$s.=				'</div>';
		$s.=			'</td>';
		$s.=			'<td width="80px" align="left">';
		$s.=				'<div class="orders-table-input">';
		$s.=					'<input data-part='.$r->ID.' type="text" size="3" maxlength="5" value="'.$r->QUANT.'">';
		$s.=				'</div>';
		$s.=			'</td>';
		$s.=			'<td align="right" width="80px">';
		$s.=				'<div class="orders-table-summary">';
		$s.=					'<div class="orders-table-rubs">';
		$s.=						'р.';
		$s.=					'</div>';
		$s.=					'<div summ_part_id='.$r->ID.' class="orders-table-summ">';
		$s.=						$r->RSUMM;
		$s.=					'</div>';
		$s.=				'</div>';
		$s.=			'</td>';
		$s.=			'<td>';
		$s.=				'<a data-part='.$r->ID.' class="orders-table-delete" href="#delete"></a>';
		$s.=			'</td>';
		$s.=		'</tr>';
	}
	$s.=			'<tr valign="top">';
	$s.=				'<td colspan="2">';
	$s.=				'</td>';
	$s.=				'<td align="right">';
	$s.=					'<span class="orders-table-field">';
	$s.=						'итого: ';
	$s.=					'</span>';
	$s.=				'</td>';
	$s.=				'<td align="right">';
	$s.=					'<div class="orders-table-total">';
	$s.=						'<div class="orders-table-rubs">';
	$s.=							'р.';
	$s.=						'</div>';
	$s.=						'<div class="orders-table-summ">';
	$s.=							$total;
	$s.=						'</div>';
	$s.=					'</div>';
	$s.=				'</td>';
	$s.=				'<td>';
	$s.=				'</td>';
	$s.=			'</tr>';
	$s.=		'</table>';
	}

	$s.=		'<div class="orders-caption">';
	$s.=		'</div>';
	$s.=		'<div class="orders-footer">';
	$s.=			'<a ';
	$s.=				'class="orders-link-simple" ';
	$s.=				'href="'.$q->fn->getUrlText($u->site,"order","history").'"';
	$s.=			'>';
	$s.=				'История заказов';
	$s.=			'</a>';

	if ($count>0) {
		$s.=			'<a ';
		$s.=				'class="orders-link-mount orders-link-footer" ';
		$s.=				'href="'.$q->fn->getUrlText($u->site,"order","mount").'" ';
		$s.=			'>';
		$s.=				'Оформить заказ';
		$s.=			'</a>';
	}

	$s.=		'</div>';
	$s.=	'</div>';
	
	$s.='</div>';
	return $s;
}

function mount($q,$ms,$total,$userData,$count,$comment="") { $s=""; $u=$q->url; 
	$e=""; $cl_hint=""; $cl_icon="";
	$s.='<div id="orders">';
	$s.=	'<form action="index.php" onSubmit="return onMountSubmit();"  method="POST">';
	$s.=	'<div class="orders-caption">Оформление заказа</div>';
	
	$s.=	'<div class="orders-message orders-message-error">';
	if ($count<1) { 
		$s.=		'<div>Ваша корзина пуста</div>';
	}
	$s.=	'</div>';
	
	if ($count>0) {
	$s.=	'<div id="orders-box">';
	$s.=		'<table cellpadding="0" cellspacing="3" border="0" valign="top" width="820px">';
	$s.=		  '<tr valign="top">';
	$s.=		  '<td width="350px">';
	$s.=			'<table cellpadding="1" cellspacing="2" border="0" width="350px">';
	$s.=				'<tr>';
	$s.=					'<td colspan="2">';
	$s.=						'<div class="orders-mount-label">Контактная информация:</div>';
	$s.=					'</td>';
	$s.=				'</tr>';
	$s.=				'<tr valign="top">';
	$s.=					'<td width="100px">';
	$s.=						'<div class="orders-mount-line">';
	$s.=							'Фамилия:';
	$s.=						'</div>';
	$s.=					'</td>';
	$s.=					'<td width="250px">';
								$q->validate->checkByType("checkName",$userData[0]->LASTNAME,$e,$cl_hint,$cl_icon);
	$s.=						'<table cellpadding="0" cellspacing="0" border="0">';
	$s.=							'<tr>';
	$s.=								'<td>';
	$s.=									'<div class="orders-mount-input">';
	$s.=										'<input data-type="lastname" ';
	$s.=											'type="text" size="10" maxlength="40" value="'.$userData[0]->LASTNAME.'">';
	$s.=									'</div>';
	$s.=								'</td>';
	$s.=								'<td>';
	$s.=									'<div check_icon="lastname" class="orders-mount-check'.$cl_icon.'">';
	$s.=									'</div>';
	$s.=								'</td>';
	$s.=							'</tr>';
	$s.=						'</table>';
	$s.=						'<div check_hint="lastname" class="orders-mount-hint'.$cl_hint.'">';
	$s.=							$e;
	$s.=						'</div>';
	$s.=					'</td>';
	$s.=				'</tr>';
	$s.=				'<tr valign="top">';
	$s.=					'<td>';
	$s.=						'<div class="orders-mount-line">';
	$s.=							'Имя:';
	$s.=						'</div>';
	$s.=					'</td>';
	$s.=					'<td>';
								$q->validate->checkByType("checkName",$userData[0]->FIRSTNAME,$e,$cl_hint,$cl_icon);
	$s.=						'<table cellpadding="0" cellspacing="0" border="0">';
	$s.=							'<tr>';
	$s.=								'<td>';
	$s.=									'<div class="orders-mount-input">';
	$s.=										'<input data-type="firstname" ';
	$s.=											'type="text" size="10" maxlength="40" value="'.$userData[0]->FIRSTNAME.'">';
	$s.=									'</div>';
	$s.=								'</td>';
	$s.=								'<td>';
	$s.=									'<div check_icon="firstname" class="orders-mount-check'.$cl_icon.'">';
	$s.=									'</div>';
	$s.=								'</td>';
	$s.=							'</tr>';
	$s.=						'</table>';
	$s.=						'<div check_hint="firstname" class="orders-mount-hint'.$cl_hint.'">';
	$s.=							$e;
	$s.=						'</div>';
	$s.=					'</td>';
	$s.=				'</tr>';
	$s.=				'<tr valign="top">';
	$s.=					'<td>';
	$s.=						'<div class="orders-mount-line">';
	$s.=							'Телефон:';
	$s.=						'</div>';
	$s.=					'</td>';
	$s.=					'<td>';
								$q->validate->checkByType("checkPhone",$userData[0]->PHONE,$e,$cl_hint,$cl_icon);
	$s.=						'<table cellpadding="0" cellspacing="0" border="0">';
	$s.=							'<tr>';
	$s.=								'<td>';
	$s.=									'<div class="orders-mount-input">';
	$s.=										'<input data-type="phone" ';
	$s.=											'type="text" size="10" maxlength="40" value="'.$userData[0]->PHONE.'">';
	$s.=									'</div>';
	$s.=								'</td>';
	$s.=								'<td>';
	$s.=									'<div check_icon="phone" class="orders-mount-check'.$cl_icon.'">';
	$s.=									'</div>';
	$s.=								'</td>';
	$s.=							'</tr>';
	$s.=						'</table>';
	$s.=						'<div check_hint="phone" class="orders-mount-hint'.$cl_hint.'">';
	$s.=							$e;
	$s.=						'</div>';
	$s.=					'</td>';
	$s.=				'</tr>';
	$s.=				'<tr valign="top">';
	$s.=					'<td>';
	$s.=						'<div class="orders-mount-line">';
	$s.=							'E-mail:';
	$s.=						'</div>';
	$s.=					'</td>';
	$s.=					'<td>';
								$q->validate->checkByType("checkEmail",$userData[0]->EMAIL,$e,$cl_hint,$cl_icon);
	$s.=						'<table cellpadding="0" cellspacing="0" border="0">';
	$s.=							'<tr>';
	$s.=								'<td>';
	$s.=									'<div class="orders-mount-input">';
	$s.=										'<input data-type="email" ';
	$s.=											'type="text" size="10" maxlength="40" value="'.$userData[0]->EMAIL.'">';
	$s.=									'</div>';
	$s.=								'</td>';
	$s.=								'<td>';
	$s.=									'<div check_icon="email" class="orders-mount-check'.$cl_icon.'">';
	$s.=									'</div>';
	$s.=								'</td>';
	$s.=							'</tr>';
	$s.=						'</table>';
	$s.=						'<div check_hint="email" class="orders-mount-hint'.$cl_hint.'">';
	$s.=							$e;
	$s.=						'</div>';
	$s.=					'</td>';
	$s.=				'</tr>';
	$s.=				'<tr>';
	$s.=					'<td colspan="2">';
	$s.=						'<div class="orders-mount-label">Варианты доставки:</div>';
	$s.=						'<div class="orders-mount-radio">';
	$s.=							'<input type="radio" checked><span class="orders-mount-radio-caption">Самовывоз</span>';
	$s.=						'</div>';
	$s.=						'<div class="orders-mount-label">Способ оплаты:</div>';
	$s.=						'<div class="orders-mount-radio">';
	$s.=							'<input type="radio" checked><span class="orders-mount-radio-caption">Наличными</span>';
	$s.=						'</div>';
	$s.=					'</div>';
	$s.=					'</td>';
	$s.=				'</tr>';
	$s.=			'</table>';
	$s.=		  '</td>';
	$s.=		  '<td width="440px">';
	$s.=			'<div class="orders-mount-right">';
	$s.=				'<div class="orders-mount-label">Состав заказа:</div>';

	if (sizeof($ms)>0) {
	  $s.=				'<table cellpadding="1" cellspacing="2" border="0" width="400px">';
	  foreach ($ms as $r) { $i++;
		$s.=					'<tr valign="top" valign="top">';
		$s.=						'<td width="270px" align="left">';
		$s.=							'<div class="orders-mount-consist-sname">';
		$s.=								'<a class="orders-sname-link" ';
		$s.=									'href="'.$q->fn->getUrlPrice($u->site,"price",$u->page,$u->group,$u->portion,$u->first,$u->search,'line',$r->ID,$u->sort,$u->grad,$u->presence).'" ';
		$s.=								'>';
		$s.=									$r->SNAME;
		$s.=								'</a>'; 
		//$s.=								$r->SNAME;
		$s.=							'</div>';
		$s.=						'</td>';
		$s.=						'<td width="50px" align="right">';
		$s.=							'<span class="orders-mount-consist-quant">';
		$s.=								$r->QUANT;
		$s.=							'</span>';
		$s.=							'<span class="orders-mount-consist-sht">';
		$s.=								'шт.';
		$s.=							'</span>';
		$s.=						'</td>';
		$s.=						'<td width="80px" align="right">';
		$s.=							'<span class="orders-mount-consist-summ">';
		$s.=								$r->RSUMM;
		$s.=							'</span>';
		$s.=							'<span class="orders-mount-consist-rub">';
		$s.=								'р.';
		$s.=							'</span>';
		$s.=						'</td>';
		$s.=					'</tr>';
	  }

		$s.=					'<tr valign="top">';
		$s.=						'<td colspan="2" align="right">';
		$s.=							'<span class="orders-mount-consist-itogo">';
		$s.=								'итого:';
		$s.=							'</span>';
		$s.=						'</td>';
		$s.=						'<td align="right">';
		$s.=							'<span class="orders-mount-consist-total">';
		$s.=								$total;
		$s.=							'</span>';
		$s.=							'<span class="orders-mount-consist-rubs">';
		$s.=								'р.';
		$s.=							'</span>';
		$s.=						'</td>';
		$s.=					'</tr>';
		$s.=				'</table>';
	}


	$s.=				'<div class="orders-mount-label">Комментарий к заказу:</div>';	
	$s.=						'<div class="orders-mount-area">';
	$s.=							'<textarea rows="3" wrap="hard">'.$comment.'</textarea>';
	$s.=						'</div>';
	$s.=			'</div>';
	$s.=		  '</td>';
	$s.=		  '</tr>';
	$s.=		'</table>';
	$s.=		'<div class="orders-caption">';
	$s.=		'</div>';
	$s.=		'<div class="orders-footer">';
	$s.=			'<a ';
	$s.=				'class="orders-link-send orders-link-footer" ';
	$s.=				'href="#send';
	$s.=			'">';
	$s.=				'Отправить заказ';
	$s.=			'</a>';
	$s.=		'</div>';
	$s.=	'</div>';
	}
	
	$s.=	'</form>';
 	$s.='</div>';
	return $s;
	
} 


function history($q,$ms) { $s=""; $u=$q->url;
	$s.='<div id="orders">';
	$s.='	<div class="orders-caption">Ваши заказы</div>';

	$s.=	'<div class="orders-message orders-message-error">';
	if (sizeof($ms)<1) { 
		$s.=		'<div>У вас не было заказов</div>';
	}
	$s.=	'</div>';


	$s.=	'<div id="orders-box">';

	if (sizeof($ms)>0) { 
		$s.=		'<table cellspacing="1" cellpadding="2" border="0">';
		$s.=			'<tr>';
		$s.=				'<td align="center">';
		$s.=				'</td>';
		$s.=				'<td align="left">';
		$s.=					'<span class="orders-table-caption">';
		$s.=						'Номер заказа';
		$s.=					'</span>';
		$s.=				'</td>';
		$s.=				'<td align="center">';
		$s.=					'<span class="orders-table-caption">';
		$s.=						'Дата отправки';
		$s.=					'</span>';
		$s.=				'</td>';
		$s.=				'<td align="center">';
		$s.=					'<span class="orders-table-caption">';
		$s.=						'Статус заказа';
		$s.=					'</span>';
		$s.=				'</td>';
		$s.=				'<td align="right">';
		$s.=					'<span class="orders-table-caption">';
		$s.=						'Сумма заказа';
		$s.=					'</span>';
		$s.=				'</td>';
		$s.=			'</tr>';

		foreach ($ms as $r) {
			
			$s.=			'<tr>';
			$s.=				'<td width="50px" align="center">';
			$s.=					'<span class="orders-table-index">';
			$s.=						$r->i;
			$s.=					'</span>';
			$s.=				'</td>';
			$s.=				'<td width="120px" align="left">';
			$s.=					'<span class="orders-table-field">';
			$s.=						'№';
			$s.=					'</span>';
			$s.=					'<span class="orders-table-seria">';
			$s.=						$r->ID;
			$s.=					'</span>';
			$s.=				'</td>';
			$s.=				'<td width="160px" align="center">';
			$s.=					'<span class="orders-table-seria">';
			$s.=						$q->fn_date->setDate($r->POSTDT);
			$s.=					'</span>';
			$s.=				'</td>';
			$s.=				'<td width="160px" align="center">';
			$s.=					'<span class="orders-table-seria">';
			$s.=						$r->STATUS;
			$s.=					'</span>';
			$s.=				'</td>';
			$s.=				'<td width="140px" align="right">';
			$s.=					'<div class="orders-table-total">';
			$s.=						'<span class="orders-table-summ">';
			$s.=							$r->TOTAL;
			$s.=						'</span>';
			$s.=						'<span class="orders-table-rubs">';
			$s.=							'р.';
			$s.=						'</span>';
			$s.=					'</div>';
			$s.=				'</td>';
			$s.=			'</tr>';			


			$j=0;
			$s.=		'<tr>';
			$s.=			'<td>';
			$s.=			'</td>';
			$s.=			'<td colspan="4">';
			$s.=				'<table cellpadding="1" cellspacing="2" border="0">';
			foreach ($r->MS as $r_sub) { $j++;
				$s.=					'<tr valign="top" valign="top">';
				$s.=						'<td width="450px" align="left">';
				$s.=							'<div class="orders-mount-consist-sname">';
				$s.=								'<a class="orders-silver-link" ';
				$s.=									'href="'.$q->fn->getUrlPrice($u->site,"price",$u->page,$u->group,$u->portion,$u->first,$u->search,'line',$r->ID,$u->sort,$u->grad,$u->presence).'" ';
				$s.=								'>';
				$s.=									$r_sub->SNAME;
				$s.=								'</a>'; 
				$s.=							'</div>';
				$s.=						'</td>';
				$s.=						'<td width="50px" align="right">';
				$s.=							'<span class="orders-mount-consist-quant">';
				$s.=								$r_sub->QUANT;
				$s.=							'</span>';
				$s.=							'<span class="orders-mount-consist-sht">';
				$s.=								'шт.';
				$s.=							'</span>';
				$s.=						'</td>';
				$s.=						'<td width="80px" align="right">';
				$s.=							'<span class="orders-mount-consist-summ">';
				$s.=								$r_sub->SUMM;
				$s.=							'</span>';
				$s.=							'<span class="orders-mount-consist-rub">';
				$s.=								'р.';
				$s.=							'</span>';
				$s.=						'</td>';
				$s.=					'</tr>';
			}
				$s.=					'<tr valign="top" valign="top">';
				$s.=						'<td colspan="3">';
				$s.=							'<div class="orders-space">';
				$s.=							'</div>';
				$s.=						'</td>';
				$s.=					'</tr>';

			$s.=				'</table>';
			$s.=			'</td>';
			$s.=		'</tr>';			
			
		}

		$s.=		'</table>';
	}


	$s.=		'<div class="orders-caption">';
	$s.=		'</div>';
	$s.=		'<div class="orders-footer">';
	$s.=			'<a ';
	$s.=				'class="orders-link-simple" ';
	$s.=				'href="'.$q->fn->getUrlText($u->site,"order","basket").'" ';
	$s.=			'>';
	$s.=				'Ваша корзина';
	$s.=			'</a>';
	$s.=		'</div>';
	$s.=	'</div>';
	$s.='</div>';
	return $s;
}


} ?>
