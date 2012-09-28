<? class article {

function engine(&$q) {
	$this->settings($q);
	$this->actions($q);
	toModel($q,$this->articleShow($q),"article");
	toModel($q,$this->dopInfo($q),"dopinfo");
}

function actions(&$q) {
	switch ($q->url->act) {
	case "add":
		$this->actionAdd($q);
	break;
	}
}

function settings(&$q) {
	$q->results->showAddButton=true;
	if ($q->orders->partIsAdded($q)) { 
		$q->labels->add="Данный товар уже находится в Вашей корзине";
		$q->results->showAddButton=false;
		$q->actions->add=false;
		$q->results->partExists=true;
	}
}

function actionAdd(&$q) { $add=false;
	if (!$q->orders->partIsAdded($q)) { 
		if ($this->getRealQuant($q)-$q->url->count>=0) {
			if ((isset($q->user->id)) && (isset($q->user->order->id))) {
				if ($q->orders->addPartToOrder($q,$q->url->id,$q->url->count)) {
					$add=true;
				}
			}
		}
		$q->results->partExists=false;
		if ($add) {
			$q->results->add="Данный товар успешно добавлен в корзину";
			$q->results->showAddButton=false;
			$q->actions->add=true;
		} else {
			$q->errors->add="Вы выбрали недопустимое количество товара";
			$q->results->showAddButton=true;
			$q->actions->add=false;
		}
	}
}

function articleShow(&$q) { $s="";
	if ($q->url->type=="price") {
		if ($q->url->id>0) {
			$r=$this->getArticleInfo($q,$q->url->id);
			if (isset($r)) { if (isset($r->PART_ID)) { if ($r->PART_ID>0) {
				$q->url->name_id=$r->NAME_ID;
				$img=$q->fn->getImage($r);
				$s.=$q->tpl_article->article($q,$r,$img);
			} } }
		}
	}
	return $s;
}

function getArticleInfo(&$q,$id) {
	$sql=$q->sql_article->article($q,$id);
	if (query($q,$sql,$r)) return $r;
}

function getRealQuant(&$q) { $count=0;
	if (isset($q->url->id)) { if ($q->url->id>0) {
		$sql=$q->sql_article->getRealQuant($q,$q->url->id);
		if (query($q,$sql,$r)) {
			if (isset($r)) { if (isset($r->REALQUANT)) { if ($r->REALQUANT>0) {
				$count=$r->REALQUANT;
			} } }
		}
	} }
	return $count;
}

function dopInfo(&$q) { $s="";
	if ($q->url->type=="price") {
		if (($q->url->id>0) && ($q->url->name_id>0)) {
			$sql=$q->sql_article->dopInfo($q,$q->url->name_id);
			if (query($q,$sql,$ms)) {
				foreach ($ms as $r) {
					$s.=$q->tpl_article->dopInfo($q,$r);
				}
			}
		}
	}
	return $s;
}


} ?>
