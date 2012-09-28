<?php class ajax_users {

function engine(&$q) {
	if ($q->url->type=="user") {
		switch ($q->url->act) {
			case "enter" :
				$this->enter($q);
			break;
		}
	}
}

function enter(&$q) { $j=&$q->json; $u=&$q->url; $check=false; $e="";
	if ($q->referer=="http://".$u->site."/type:user/page:enter") {
		if (!isset($q->user->id)) { $e="Не найден ID пользователя"; } else {
			if ((!isset($u->email)) || (!isset($u->password))) { $e="Не найдены введенные данные"; } else {
				if (($u->email=="") || ($u->password=="")) { $e="Вы не заполнили логин или пароль"; } else {
					if (!$q->users->checkEnter($q)) { $e="Вы неверно ввели логин или пароль"; } else {
						$check=true;
					}
				}				
			}
		}	
	}
	if ($check) { $j["check"]="TRUE"; } else { $j["check"]="FALSE"; }
	$j["e"]=$e;
}

} ?>
