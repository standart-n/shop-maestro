<?php class design {

function engine(&$q) {
	toModel($q,$this->toolbar($q),"toolbar");
	toModel($q,$this->icons($q),"icons");
	toModel($q,$this->bar($q),"bar");
	toModel($q,$this->shadow($q),"shadow");
}

function bar(&$q) { $s=""; $enter=false; $name=""; $ms=array();
	$ms=$q->users->getUserData(&$q);
	if (isset($ms[0])) {
		if ((isset($ms[0]->EMAIL)) && (isset($ms[0]->FIRSTNAME)) && (isset($ms[0]->PASSWORD))) {
			if (($ms[0]->EMAIL!="") && ($ms[0]->PASSWORD!="") && ($ms[0]->FIRSTNAME!="")) {
				$enter=true;
				$name=$ms[0]->FIRSTNAME;
			}
		}
	}
	$count=$q->orders->countPartsInOrder($q);
	$s.=$q->tpl_design->bar($q,$count,$enter,$name);
	return $s;
}

function shadow(&$q) { $s="";
	$s.=$q->tpl_design->shadow($q);
	return $s;
}

function toolbar(&$q) { $s="";
	$s.=$q->tpl_design->toolbar($q);
	return $s;
}

function icons(&$q) { $s="";
	//$s.=$q->tpl_design->icons($q);
	return $s;
}

} ?>
