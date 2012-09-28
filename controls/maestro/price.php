<?php class price {

function engine(&$q) { 
	toModel($q,$this->priceLoad($q),"price");
	toModel($q,$this->steps($q),"steps");
	toModel($q,$this->presence($q),"presence");
	toModel($q,$this->priceCorner($q),"price-corner");
	toModel($q,$this->table($q),"table-price");
	toModel($q,$this->search($q),"search");
	toModel($q,$this->portion($q),"portion");
	toModel($q,$this->lists($q),"table-list");
}

function priceLoad(&$q) { $s="";
	if ($q->url->type=="price") {
		$s.=$q->tpl_price->price($q);
	}
	return $s;
}

function table(&$q) { $s="";
	if ($q->url->type=="price") {
		$s.=$q->tpl_price->tableHead($q);
		$sql=$q->sql_price->table($q);
		$limit=$q->url->portion;
		if (query($q,array("sql"=>$sql,"limit"=>$limit),$ms)) {
			foreach ($ms as $r) {
				$s.=$q->tpl_price->line($q,$r);
			}		
		}		
		$s.=$q->tpl_price->tableFooter();
		$q->url->count=sizeof($ms);
	}
	return $s;
}

function priceCorner(&$q) { $s="";
	if ($q->url->type=="price") {
		$s.=$q->tpl_price->priceCorner($q);
	}
	return $s;
}

function search(&$q) { $s="";
	if ($q->url->type=="price") {
		$s.=$q->tpl_price->searchInput($q);
	}
	return $s;
}

function lists(&$q) { $s="";
	if ($q->url->type=="price") {
		$s.=$q->tpl_price->listButtons($q);
	}
	return $s;
}

function portion(&$q) { $s="";
	if ($q->url->type=="price") {
		$s.=$q->tpl_price->portion($q);
	}
	return $s;
}

function presence(&$q) { $s="";
	if ($q->url->type=="price") {
		$s.=$q->tpl_price->presence($q);
	}
	return $s;
}

function steps(&$q) { $s=""; $i=0; $cats=array(); $gr_parent=0; $gr=$q->url->group;
	if ($q->url->type=="price") {
		if (($gr!=0) && ($gr!=-100)) { $flag=true; } else { $flag=false; }
		while ($flag) { $i++;
			$sql=$q->sql_price->steps($q,$gr);
			if (query($q,$sql,$r)) {
				$group=$r->ID; 
				$parent=$r->PARENT_ID; 
				$caption=$r->CAPTION;
				$cats[]=$caption.":".strval($group); 
				$gr_parent=$group;
				$gr=$parent;
				if (($gr==0) || ($gr==-100)) { $flag=false; }
				if ($i>5) { $flag=false; }
			}
		}
		$cats[]='Все товары:0'; 
		$cats=array_reverse($cats);
		$q->url->group_parent=$gr_parent;
		$s.=$q->tpl_price->steps($q,$cats);
	}
	return $s;
}



} ?>
