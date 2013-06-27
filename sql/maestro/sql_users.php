<?php class sql_users {

function addUser($q) { $s="";
	$s.="INSERT INTO MAGAZINE_USERS (M_ID,SESSION_ID,KEY) VALUES ('".$q->user->mid."','".$q->user->sessid."','".$q->user->key."')";
	return $s;	
}

function getUserIdByMid($q) { $s="";
	$s.="SELECT ID, M_ID, KEY FROM MAGAZINE_USERS WHERE (M_ID='".$q->user->mid."')";
	return $s;
}

function updateUserById($q) { $s=""; $tm=time();
	$s.="UPDATE MAGAZINE_USERS SET ";
	$s.="M_ID='".$q->user->mid."', ";
	$s.="KEY='".$q->user->key."', ";
	$s.="USERAGENT='".$q->user->agent."', ";
	$s.="IP='".$q->user->ip."', ";
	$s.="POSTDATE=CURRENT_TIMESTAMP, ";
	$s.="POSTTIME=".$tm." ";
	$s.="WHERE (ID=".$q->user->id.") ";	
	return $s;
}

function editField($q,$field,$value) { $s="";
	$s.="UPDATE MAGAZINE_USERS SET ";
	$s.="".$field."='".$value."' ";
	$s.="WHERE (ID=".$q->user->id.") ";	
	return $s;
}

function getUserData($q) { $s="";
	$s.="SELECT * FROM MAGAZINE_USERS WHERE (1=1) ";
	$s.="AND (ID=".$q->user->id.") ";	
	return $s;
}

function checkEnter($q,$pwd) { $s="";
	$s.="SELECT * FROM MAGAZINE_USERS WHERE (1=1) ";
	$s.="AND (EMAIL='".$q->url->email."') ";
	$s.="AND (PASSWORD='".$pwd."') ";
	return $s;
}

} ?>
