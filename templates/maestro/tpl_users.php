<? class tpl_users {

function showEnter(&$q) { $s="";
	$s.='<div id="users-enter-box">';
	$s.=	'<div class="users-enter-caption">';
	$s.=		'Авторизация';
	$s.=	'</div>';
	$s.=	'<div class="users-enter">';
	$s.=		'<form action="index.php" method="GET" onSubmit="return enterFormSubmit();">';
	$s.=		'<table cellpadding="2" cellspacing="1" border="0">';
	$s.=			'<tr>';
	$s.=				'<td align="left" width="80px">';
	$s.=					'<span class="users-enter-var">Email:</span>';
	$s.=				'</td>';
	$s.=				'<td align="left" width="220px">';
	$s.=					'<div class="users-enter-value">';
	$s.=						'<input id="users-enter-email" type="text" value="">';
	$s.=					'</div>';
	$s.=				'</td>';
	$s.=				'<td align="left" width="150px">';
	$s.=					'<a class="users-enter-link" href="#forgot">Забыли пароль?</a>';
	$s.=				'</td>';
	$s.=			'</tr>';
	$s.=			'<tr>';
	$s.=				'<td align="left">';
	$s.=					'<span class="users-enter-var">Пароль:</span>';
	$s.=				'</td>';
	$s.=				'<td align="left">';
	$s.=					'<div class="users-enter-value">';
	$s.=						'<input id="users-enter-password" type="password" value="">';
	$s.=					'</div>';
	$s.=				'</td>';
	$s.=				'<td align="left">';
	$s.=				'</td>';
	$s.=			'</tr>';
	$s.=			'<tr>';
	$s.=				'<td align="left">';
	$s.=				'</td>';
	$s.=				'<td align="left">';
	$s.=					'<input type="submit" class="users-enter-button" value="Войти">';
	$s.=				'</td>';
	$s.=				'<td align="left">';
	$s.=				'</td>';
	$s.=			'</tr>';
	$s.=			'<tr>';
	$s.=				'<td align="left" colspan="3">';
	$s.=					'<div id="users-enter-error"></div>';
	$s.=				'</td>';
	$s.=			'</tr>';
	$s.=		'</table>';
	$s.=		'</form>';
	$s.=	'</div>';
	$s.='</div>';
	return $s;
}

function showPwdAfterSendOrder($q,$ms,$pwd) { $s="";
	$s.='<div class="orders-after">';
	$s.=	'<div class="orders-after-text">';
	$s.=		'Для того, чтобы Вы могли отслеживать на сайте состояние ';
	$s.=		'Вашего заказа,<br>';
	$s.=		'мы сгенерировали для Вас логин и пароль.';
	$s.=	'</div>';
	$s.=	'<div class="orders-after-data">';
	$s.=		'<div class="orders-after-data-line">';
	$s.=			'<div class="orders-after-data-var">Ваш логин:</div>';
	$s.=			'<div class="orders-after-data-value">'.$ms[0]->EMAIL.'</div>';
	$s.=		'</div>';
	$s.=		'<div class="orders-after-data-line">';
	$s.=			'<div class="orders-after-data-var">Ваш пароль:</div>';
	$s.=			'<div class="orders-after-data-value">'.$pwd.'</div>';
	$s.=		'</div>';
	$s.=	'</div>';	
	$s.='</div>';
	return $s;
}

} ?>