<?php class enter { 
function engine() { $tm=time()+(3600*24*31);
  if (isset($this->prefix)) { $fx=$this->prefix; $fa=$fx."_admin_";
	if (isset($_GET['action'])) { $act=strval(trim($_GET['action']));
		if ($act=="exit") {	unset($_SESSION[$fa.'in']);
			foreach(explode("|","in|id|name|login|password") as $key) { $_SESSION[$fa.$key]=""; unset($_SESSION[$fa.$key]); setcookie($fa.$key,"",$tm); }
		}
	}
	if ((isset($this->db)) && (isset($this->prefix)) && (!isset($_GET['action']))) {
		if (!isset($_SESSION[$fa.'in'])) {
			if ((isset($_COOKIE[$fa.'id'])) && (isset($_COOKIE[$fa.'name'])) && (isset($_COOKIE[$fa.'login'])) && (isset($_COOKIE[$fa.'password']))) {
				if (($_COOKIE[$fa.'id']!="") && ($_COOKIE[$fa.'name']!="") && ($_COOKIE[$fa.'login']!="") && ($_COOKIE[$fa.'password']!="")) {
					foreach(explode("|","id|name|login|password") as $key) { $$key=$_COOKIE[$fa.$key]; }
					$res=mysql_query("SELECT * FROM `".$this->prefix."_dataAdmins` WHERE (id=".$id.")",$this->db);
					if (isset($res)) { if ($res) {
						$row=mysql_fetch_array($res);
						if (isset($row)) { if ((isset($row['password'])) && (isset($row['login'])) && (isset($row['name'])) && (isset($row['id']))) {
							if (($row['password']!="") && ($row['login']!="") && ($row['name']!="") && ($row['id']!="")) { 
								if (($row['id']==$id) && ($row['name']==$name) && ($row['login']==$login) && ($row['password']==$password)) {
									$_SESSION[$fa.'in']="TRUE";
									foreach(explode("|","id|name|login|password") as $key) { $_SESSION[$fa.$key]=$$key; }
								}
							}
						}	}
					}	}
				}
			}
		}
	}
	if (isset($_GET['action'])) { $act=strval(trim($_GET['action']));
		if ($act=="enter") {
			if ((isset($_POST['nmLogin'])) && (isset($_POST['nmPassword']))) {
				if (($_POST['nmLogin']!="") && ($_POST['nmPassword']!="")) {
					$login=trim($_POST['nmLogin']);
					$password=$this->gen(trim($_POST['nmPassword']));
					if ((isset($this->db)) && (isset($this->prefix))) {
						$res=mysql_query("SELECT * FROM `".$this->prefix."_dataAdmins` WHERE (login=\"$login\")",$this->db);
						if (isset($res)) { if ($res) {
							$row=mysql_fetch_array($res);
							if (isset($row)) { if ((isset($row['password'])) && (isset($row['login'])) && (isset($row['name'])) && (isset($row['id']))) {
								if (($row['password']!="") && ($row['login']!="") && ($row['name']!="") && ($row['id']!="")) {
									if ($row['password']==$password) {
										$_SESSION[$fa.'in']="TRUE";
										foreach(explode("|","id|name|login|password") as $key) {
											$_SESSION[$fa.$key]=$row[$key];
											setcookie($fa.$key,$row[$key],$tm);
										}
									}
								}
							}	}
						}	}
					}
				}
			}		
		}
	}
  }
}
function check_user() {
	if (isset($this->prefix)) { $fx=$this->prefix; $fa=$fx."_admin_";
		if (isset($_SESSION[$fa."in"])) { return $_SESSION[$fa."in"]; } else { return "FALSE"; }
	} else { return "FALSE"; }
}
function gen($psw) { return sha1($psw); }

} ?>
