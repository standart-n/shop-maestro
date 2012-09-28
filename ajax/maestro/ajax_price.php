<? class ajax_price {

function engine(&$q) {
	if ($q->url->type=="price") {
		$q->groups->groupsShow($q,false);
		$this->price($q);
	}
}

function price(&$q) { $s="";$j=&$q->json; $u=&$q->url;
		$j['steps']=$q->price->steps($q);
		$j['table']=$q->price->table($q);
		$j['lists']=$q->price->lists($q);
		$j['shadow']=$q->design->shadow($q);
}

} ?>
