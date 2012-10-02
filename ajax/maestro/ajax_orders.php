<?php class ajax_orders { 

function engine(&$q) {
	if ($q->url->type=="order") {
		switch ($q->url->act) {
			case "send" :
				$this->send($q);
			break;
			case "check" :
				$this->check($q);
			break;
			case "checkComment" :
				$this->checkComment($q);
			break;
			case "editquant" :
				$this->editQuant($q);
			break;
			case "delline" :
				$this->deleteLine($q);
			break;
		}
	}
}

function send(&$q) { $s=""; $e=""; $eL=""; $bar=""; $eT=""; $reg=""; $j=&$q->json; $u=&$q->url; $check=true;
	if ($q->referer=="http://".$q->url->site."/type:order/page:mount") {
		if (!isset($q->user->id)) { $e="Пользователь не определен"; $check=false; } else {
			if (!isset($q->user->order->id)) { $e="Информация о Вашем заказе не найдена"; $check=false; } else {
				if ($q->orders->getOrderDetailCount($q)<1) { $e="Ваша корзина пуста"; $check=false; } else {
					if (!$q->validate->checkName($u->firstname,$eL)) { $e="Некорректные данные в поле Имя"; $eT="firstname"; $check=false; }
					if (!$q->validate->checkName($u->lastname,$eL)) { $e="Некорректные данные в поле Фамилия"; $eT="lastname"; $check=false; }
					if (!$q->validate->checkPhone($u->phone,$eL)) { $e="Некорректные данные в поле Телефон"; $eT="phone"; $check=false; } 
					if (!$q->validate->checkEmail($u->email,$eL)) { $e="Некорректные данные в поле E-mail"; $eT="email"; $check=false; }
					if ($check) {
						if (!isset($_SESSION[$q->site->session."_user_mid"])) { $e="Не найдена открытая сессия"; $check=false; } else { 
							if ($q->user->mid!=$_SESSION[$q->site->session."_user_mid"]) { $e="Сессия не идентифицирована"; $check=false; } else { 
								//if (!isset($_COOKIE[$q->sess."_user_mid"])) { $e="Не найдены COOKIE"; $check=false; } else { 
									//if ($q->user->mid!=$_COOKIE[$q->sess."_user_mid"]) { $e="COOKIE не идентифицированы"; $check=false; } else { 
										if (!$q->orders->sendOrder($q)) { $e="Ваш заказ не удалось отправить"; $check=false; }
									//}
								//}
							}
						}
					}
				}
			}
		}
		if ($check) { $e="Ваш заказ успешно отправлен"; }
		if ($check) { $j['check']="TRUE"; } else { $j['check']="FALSE"; }
		if ($check) {
			$reg=$q->users->regUserAfterSendOrder($q);
		}
		if ($check) {
			$bar=$q->tpl_design->bar($q,0);
		}
		$j['e']=$e;
		$j['eL']=$eL;
		$j['eT']=$eT;
		$j['bar']=$bar;
		$j['reg']=$reg;
	}
}

function check(&$q) { $s=""; $e=""; $eT="red"; $j=&$q->json; $u=&$q->url; $check=false;
	if ($q->referer=="http://".$q->url->site."/type:order/page:mount") {		
		if ((isset($u->key)) && (isset($u->value))) {
			if ($u->key!="") {
				switch($u->key) {
					case "lastname":
						if ($q->validate->checkName($u->value,$e)) {
							$check=true;
						}					
					break;					
					case "firstname":
						if ($q->validate->checkName($u->value,$e)) {
							$check=true;
						}					
					break;					
					case "phone":
						if ($q->validate->checkPhone($u->value,$e)) {
							$check=true;
						}					
					break;					
					case "email":
						if ($q->validate->checkEmail($u->value,$e)) {
							$check=true;
						}					
					break;					
				}
				if ($check) {
					$q->users->editField($q,strtoupper($u->key),$u->value);					
				}
			}
		}
		if ($check) { $eT="silver"; }
		if ($check) { $j['check']="TRUE"; } else { $j['check']="FALSE"; }
		$j['e']=$e;
		$j['eT']=$eT;
	}
}

function checkComment(&$q) { $s=""; $e=""; $j=&$q->json; $u=&$q->url; $check=false;
	if ($q->referer=="http://".$q->url->site."/type:order/page:mount") {		
		if (isset($u->value)) {
			$u->value=$q->validate->comment($u->value);	
			$q->orders->addComment($q,$u->value);
		}
		//$j['e']=$e;
	}
}

function deleteLine(&$q) {  $s=""; $bar=""; $j=&$q->json; $u=&$q->url; 
	if ($q->referer=="http://".$q->url->site."/type:order/page:basket") {		
		$errorType=0; $summ=0; $total=0; $count=0; $userId=0;
		$id=$u->id;
		if ($id>0) {
			if (isset($q->user->order->id)) {
				if ($q->orders->deleteLine($q)) {
					$partId=$id;
					$a=$q->orders->getOrderDetailList($q);
					$total=$a['total'];
					$count=$a['count'];
					$bar=$q->design->bar($q);
				}
			}
		}		
		$j['res']=$s;
		$j['bar']=$bar;
		$j['total']=$total;
		$j['count']=$count;
		$j['partId']=$partId;
		$j['errorType']=$errorType;	
	}
}

function editQuant(&$q) {  $s=""; $j=&$q->json; $u=&$q->url; 
	if ($u->act=="editquant") {
		$errorType=0; $summ=0; $total=0; $userId=0;
		$id=$u->id; $count=$u->count;
		if ($id>0) {
			$r=$q->article->getArticleInfo($q,$q->url->id);
			if (isset($r)) { if (isset($r->PART_ID)) { if ($r->PART_ID>0) {
				$max=floatval($r->REALQUANT);
				$price=floatval($r->PRICE);
				if ($max>0) {
					if ($max-$count>=0) {
						$errorType=0;
					} else {
						$errorType=2;
						$count=$max;	
					}
				}
				$summ=floatval($price*$count);
				if (isset($q->user->order->id)) {
					if ($q->orders->editQuant($q,$count)) {
						$a=$q->orders->getOrderDetailList($q);
						$total=$a['total'];
					}
				}
			} } }
		}
		//$s.=$q->tpl_orders->editquant($q,$edit);
		$j['res']=$s;
		$j['summ']=$summ;
		$j['count']=$count;
		$j['total']=$total;
		$j['errorType']=$errorType;	
	}
}

} ?>
