<?php class pl_baseMysql {

function engine(&$q) {
	if (isset($q->database)) {
		if (isset($q->database->connections)) {
			foreach ($q->database->connections as $alias=>$cn){
				if (isset($cn->type)) {
					if (($cn->type=="mysql") || ($cn->type=="mysqli")) { 
						$cn->type="mysql";
						$q->$alias->type=$cn->type;
						if (isset($cn->charset)) { $q->$alias->charset=$cn->charset; }
						if ((isset($cn->path)) && (isset($cn->login)) && (isset($cn->password))) {
							if (($cn->path!="") && ($cn->login!="") && ($cn->password!="")) {
								$q->$alias->db=mysql_pconnect($cn->path,$cn->login,$cn->password);;
								mysql_select_db($cn->dbname);
								if (isset($cn->charset)) { if ($cn->charset!="") {
									mysql_query('SET NAMES '.$cn->charset,$q->$alias->db);
								} }
							}	
						}
					}
				}
			}
		}
	}
}

} ?>