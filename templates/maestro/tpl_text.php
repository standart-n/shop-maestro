<?php class tpl_text { 

function text($q) { $u=$q->url; $s=""; $t="";
	switch ($u->page) {
		case "company":
			$t.='<h2>О компании</h2>';
			$t.='<hr>';
			$t.='<div class="text-body">';
			$t.='</div>';
		break;
		case "service":
			$t.='<h2>Сервис</h2>';
			$t.='<hr>';
			$t.='<div class="text-body">';
			$t.='Для постоянных клиентов, оптовых покупателей и сервисных центров предоставляются скидки.<br>';
			$t.='В зависисмости от объемов покупки цены могут быть пересмотрены в пользу покупателя.<br>';
			$t.='<br>';
			$t.='Наши преимущества:<br>';
			$t.='- Большой ассортимент деталей в наличии на складе<br>';
			$t.='- Максимально быстрая работа под заказ<br>';
			$t.='- Квалифицированные консультации, индивидуальный подход к каждому клиенту<br>';
			$t.='- Гибкая система прогрессирующих скидок для постоянных клиентов.<br>';
			$t.='</div>';
		break;
		case "contacts":
			$t.='<h2>Реквизиты</h2>';
			$t.='<hr>';
			$t.='<div class="text-body">';
			$t.='ИП Лебедев<br>';
			$t.='Почтовый адрес:<br>';
			$t.='г.Ижевск, ул. Пушкинская, 171, "Акватория"<br>';
			$t.='Тел.: 8 (3412) 52-95-62<br>';
			$t.='email: shop.maestro18.ru<br>';
			$t.='</div>';
		break;
	}
	$s.='<div id="text">';
	$s.=$t;
	$s.='</div>';
	return $s;
}

function show($caption,$text) { $s="";
	$s.='<div id="text">';
	$s.='<h2>'.$caption.'</h2>';
	$s.='<hr>';
	$s.='<div class="text-body">';
	$s.=$text;
	$s.='</div>';
	$s.='</div>';
	return $s;
}

} ?>
