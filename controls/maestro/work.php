<?php class work {

function engine(&$q) {
	toModel($q,$this->actions($q),"result");
}

function actions(&$q) { $s="";
	switch ($q->url->act) {
	case "add":
	break;
	}
	return $s;	
}


} ?>
