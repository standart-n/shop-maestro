<?php class users {

function engine(&$q) {
	$this->actions($q);
	if (!$q->fn_bots->isBot()) {
		$this->getUser($q);	
		if (!$q->orders->getOrder($q)) { 
			if ($q->orders->createOrder($q)) {
				$q->orders->getOrder($q);
			}
		}
	}
	toModel($q,$this->usersShow($q),"users");
}

function usersShow(&$q) { $s="";
	if ($q->url->type=="user") {
		switch ($q->url->page) {
		case "enter":
			$s.=$this->showEnter($q);
		break;
		case "forgot":
			$s.=$this->showForgotPassword($q);
		break;
		case "registration":
			$s.=$this->showRegistration($q);
		break;
		}
	}
	return $s;	
}

function actions(&$q) {
	switch ($q->url->page) {
	case "exit":
		$this->unsetUserInfo(&$q);
	break;
	}
}

function showEnter(&$q) { $s="";
	$s.=$q->tpl_users->showEnter($q);
	return $s;	
}

function showForgotPassword(&$q) { $s="";
	$s.=$q->tpl_users->forgotPassword($q);
	return $s;	
}

function showRegistration(&$q) { $s="";
	$s.=$q->tpl_users->showRegistration($q);
	return $s;	
}

function getUser(&$q) {
	$q->user->sessid=session_id();
	if ((isset($_SESSION[$q->site->session."_user_key"])) && (isset($_SESSION[$q->site->session."_user_mid"]))) {
		$q->user->mid=$_SESSION[$q->site->session."_user_mid"];
		$q->user->key=$_SESSION[$q->site->session."_user_key"];
		$this->getUserIdByMid($q);
	} else { 
		if ((isset($_COOKIE[$q->site->session."_user_key"])) && (isset($_COOKIE[$q->site->session."_user_mid"]))) {
			$q->user->mid=$_COOKIE[$q->site->session."_user_mid"];
			$q->user->key=$_COOKIE[$q->site->session."_user_key"];
			$this->getUserIdByMid($q);
		}
	}
	$this->ifUnsetUserId($q);
	if (isset($q->user->id)) {
		$this->updateUser($q);
	}
	//echo "ID:".$q->user->id."-".$q->user->key.";";
}

function newUser(&$q) {
	$this->genMid($q);
	$this->addUser($q);
	$this->getUserIdByMid($q);
}

function ifUnsetUserId(&$q) {
	if (!isset($q->user->id)) {
		$this->unsetUserInfo($q);
		$this->newUser($q);
	}			
}

function getUserIdByMid(&$q) {
	if ((isset($q->user->mid)) && (isset($q->user->key))) {
		$sql=$q->sql_users->getUserIdByMid($q);
		if (query($q,$sql,$r)) {
			if (isset($r)) { if ((isset($r->ID)) && (isset($r->KEY))) { if (($r->ID>0) && ($r->KEY!="")) {
				if ($q->user->key==$r->KEY) {
					$q->user->id=$r->ID;
					$q->user->mid=$r->M_ID;
					$q->user->key=$r->KEY;
				}
			} } }
		}
	}
	$this->openSession($q);
}

function openSession($q) {
	if (isset($q->user->id)) {
		if ((isset($q->user->mid)) && (isset($q->user->key))) {
			$_SESSION[$q->site->session."_user_mid"]=$q->user->mid;
			$_SESSION[$q->site->session."_user_key"]=$q->user->key;
			setcookie($q->site->session."_user_mid",$q->user->mid,$q->cookie_time);
			setcookie($q->site->session."_user_key",$q->user->key,$q->cookie_time);
		}
	}	
}

function addUser(&$q) { $add=false;
	$sql=$q->sql_users->addUser($q);
	if (query($q,$sql)) {
		$add=true;
	}
	return $add;
}

function genMid(&$q) {
	$q->user->mid=md5($q->site->sessionion_id.time());	
	$q->user->key=md5(time().time());	
}

function genPwd(&$q,$len=6) { $s="";
	$s=strtolower(strval(md5(md5(time()))));
	$s=substr($s,0,$len);
	return $s;
}

function mdPwd($pwd) { $s="";
	$s=md5(md5(md5($pwd)));
	return $s;
}

function updateUser(&$q) { $update=false;
	if (isset($q->user->id)) {
		if ($q->user->id>0) {
			if (isset($_SERVER["HTTP_X_REAL_IP"])) {
				$q->user->ip=$_SERVER["HTTP_X_REAL_IP"];
			} else {
				$q->user->ip=$_SERVER["REMOTE_ADDR"];
			}
			$q->user->agent=$_SERVER["HTTP_USER_AGENT"];
			$sql=$q->sql_users->updateUserById($q);
			if (query($q,$sql)) {
				$update=true;
			}
		}
	}
	return $update;
}

function editField(&$q,$field,$value) { $edit=false;
	if (isset($q->user->id)) {
		$value=$q->validate->toWin($value);
		$sql=$q->sql_users->editField($q,$field,$value);
		if (query($q,$sql)) {
			$edit=true;
		}
	}
	return $edit;
}

function checkEnter(&$q) { $u=&$q->url; $check=false;
	if (isset($q->user->id)) {
		if ((isset($u->email)) && (isset($u->password))) {
			if (($u->email!="") && ($u->password!="")) {
				$pwd=$this->mdPwd($u->password);
				$sql=$q->sql_users->checkEnter($q,$pwd);
				if (query($q,$sql,$r)) {
					if (isset($r)) { if (isset($r->ID)) {
						if ((isset($r->M_ID)) && (isset($r->KEY))) {
							$q->user->id=$r->ID;
							$q->user->mid=$r->M_ID;
							$q->user->key=$r->KEY;
							$this->openSession($q);
							$check=true;
						}
					} }
				}
			}
		}
	}
	return $check;	
}

function getUserData(&$q) { $ms=array();
	if (isset($q->user->id)) {
		$sql=$q->sql_users->getUserData($q);
		if (query($q,$sql,$r)) {
			if (isset($r)) {
				foreach (array("FIRSTNAME","LASTNAME","EMAIL","PHONE","PASSWORD") as $key) {
					if (isset($r->$key)) {
						$r->$key=$q->validate->toUTF($r->$key);
					} else {
						$r->$key="";
					}
				}
				$ms[0]=$r;
			}
		}
	}
	return $ms;
}

function regUserAfterSendOrder(&$q,&$pwd="") { $s=""; $ms=array();
	if (isset($q->user->id)) {
		$ms=$this->getUserData($q);
		if ($ms[0]->PASSWORD=="") {
			$pwd=$this->genPwd($q);
			if (isset($pwd)) { if ($pwd!="") {
				if ($this->editField($q,"PASSWORD",$this->mdPwd($pwd))) {
					$s.=$q->tpl_users->showPwdAfterSendOrder($q,$ms,$pwd);
				}
			} }
		}
	}
	return $s;
}

function unsetUserInfo(&$q) {
	$this->unsetUserData($q);
	$this->unsetUserSession($q);
	$this->unsetUserCookie($q);
}

function unsetUserData(&$q) {
	unset($q->user->id);
	unset($q->user->mid);
	unset($q->user->key);
}

function unsetUserSession(&$q) {
	unset($_SESSION[$q->site->session."_user_mid"]);
	unset($_SESSION[$q->site->session."_user_key"]);
}

function unsetUserCookie(&$q) {
	unset($_COOKIE[$q->site->session."_user_mid"]);
	unset($_COOKIE[$q->site->session."_user_key"]);
}


} ?>
