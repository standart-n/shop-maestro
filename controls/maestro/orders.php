<?php class orders {

function engine(&$q) {
	toModel($q,$this->ordersShow($q),"orders");
}

function ordersShow(&$q) { $s="";
	if ($q->url->type=="order") {
		switch ($q->url->page) {
		case "basket":
			$s.=$this->showBasket($q);
		break;
		case "mount":
			$s.=$this->showMount($q);
		break;
		case "history":
			$s.=$this->showHistory($q);
		break;
		}
	}
	return $s;	
}

function showBasket(&$q) { $s="";
	$a=$this->getOrderDetailList($q);
	$s.=$q->tpl_orders->basket($q,$a['ms'],$a['total'],$a['count']); 
	return $s;
}

function showHistory(&$q) { $s="";
	$a=$this->getHistoryOrder($q);
	$s.=$q->tpl_orders->history($q,$a); 
	return $s;
}

function showMount(&$q) { $s="";
	$a=$this->getOrderDetailList($q);
	$userData=$q->users->getUserData($q);
	$comment=$this->getComment($q);
	$s.=$q->tpl_orders->mount($q,$a['ms'],$a['total'],$userData,$a['count'],$comment); 
	return $s;
}


function getOrderDetailCount($q) { $count=0;
	if (isset($q->user->id)) { if (isset($q->user->order->id)) {
		$sql=$q->sql_orders->getOrderDetailCount($q);
		if (query($q,$sql,$r)) {
			if (isset($r)) { if (isset($r->COUNT_ID)) { if ($r->COUNT_ID>0) {
				$count=$r->COUNT_ID;
			} } }
		}
	} }
	return $count;
}		

function getOrderDetailList($q) { $ms=array(); $a=array(); $i=0; $total=0;
	if (isset($q->user->id)) { if (isset($q->user->order->id)) {
		$sql=$q->sql_orders->getOrderDetailList($q);
		if (query($q,array("sql"=>$sql,"collection"=>"array"),$m)) {
			foreach ($m as $r) { unset($row);
				$i++; $row=new r;
				foreach (array("ID","SNAME","QUANT","SERIA","SCOUNTRY","PRICE") as $key) {
					if (isset($r->$key)) { 
						$row->$key=$q->validate->toUTF($r->$key);
					} else {
						$row->$key="";
					}
				}
				$row->i=$i;
				$row->SERIA=strval($row->SERIA);
				$row->SCOUNTRY=strval($row->SCOUNTRY);
				$row->PRICE=floatval($row->PRICE);
				$row->SUMM=floatval($row->SUMM);
				$row->QUANT=floatval($row->QUANT);
				$row->RSUMM=floatval($row->PRICE*$row->QUANT);
				$total+=$row->RSUMM;
				$ms[]=$row;
			}
		}
	} }
	$a['ms']=$ms; $a['total']=$total; $a['count']=$i;
	return $a;
}

function getHistoryOrder(&$q) { $s=""; $j=0; $ms=array(); $a=array();
	if (isset($q->user->id)) {
		$sql=$q->sql_orders->getHistoryOrder($q);
		if (query($q,$sql,$m)) {
			foreach ($m as $r) { $j++;
				foreach (array("ID","STATUS","POSTDT","POSTTIME") as $key) {
					if (isset($r->$key)) { 
						$r->$key=$q->validate->toUTF($r->$key);
					} else {
						$r->$key="";
					}
				}
				$r->i=$j;
				$r->MS=array();
				if (isset($r->ID)) { if (intval($r->ID)>0) {
					//if (intval($r->STATUS)>1) {
						$sql_sub=$q->sql_orders->getHistoryOrderDetail($q,$r->ID);
						$query_sub=ibase_query($q->fdb->it,$sql_sub);
						if (isset($query_sub)) { if ($query_sub) { $i=0; $total=0;
							while ($r_sub=ibase_fetch_object($query_sub)) { $i++;
								foreach (array("ID","SNAME","QUANT","SERIA","SCOUNTRY","PRICE") as $key) {
									if (isset($r_sub->$key)) { 
										$r_sub->$key=$q->validate->toUTF($r_sub->$key);
									} else {
										$r_sub->$key="";
									}
								}
								$r_sub->i=$i;
								$r_sub->SERIA=strval($r_sub->SERIA);
								$r_sub->SCOUNTRY=strval($r_sub->SCOUNTRY);
								$r_sub->PRICE=floatval($r_sub->PRICE);
								$r_sub->SUMM=floatval($r_sub->SUMM);
								$r_sub->QUANT=floatval($r_sub->QUANT);
								$r_sub->RSUMM=floatval($r_sub->PRICE*$r_sub->QUANT);
								$total+=$r_sub->SUMM;
								$r->MS[]=$r_sub;
							}

						} }
					//}
				} }
				$r->TOTAL=$total;
				$a[]=$r;
			}
		}
	}
	return $a;
}

function countPartsInOrder(&$q) { $count=0;
	if ((isset($q->user->id)) && (isset($q->user->order->id))) {
		$sql=$q->sql_orders->countPartsInOrder($q);
		if (query($q,$sql,$r)) {
			if (isset($r)) { if (isset($r->COUNT_PARTS)) { if ($r->COUNT_PARTS>0) {
				$count=$r->COUNT_PARTS;
			} } }
		}
	}
	return $count;
}

function addPartToOrder(&$q,$id,$count) { $add=false; $count=floatval($count);
	if ((isset($q->user->id)) && (isset($q->user->order->id))) {
		if (($id>0) && ($count>0)) {
			$r=$q->article->getArticleInfo($q,$id);
			if (isset($r)) { if (isset($r->PART_ID)) { if ($r->PART_ID>0) {
				$price=round(floatval($r->PRICE),2);
				$summ=round(floatval($price*$count),2);
				$sql=$q->sql_orders->addPartToOrder($q,$r,$count,$price,$summ);
				if (query($q,$sql)) {
					$add=true;
				}
			} } }
		}
	}
	return $add;
}



function getOrder(&$q) { $order_exists=false;
	if (isset($q->user->id)) {
		if (isset($q->user->order->id)) { $order_exist=true; } else {
			$sql=$q->sql_orders->getOrderId($q);
			if (query($q,$sql,$r)) {
				if (isset($r)) { if (isset($r->ID)) { if ($r->ID>0) {
					$q->user->order->id=$r->ID;
					$order_exists=true;
				} } } 
			}
		}
	}
	return $order_exists;
}

function createOrder(&$q) { $create=false;
	if (isset($q->user->id)) {
		$sql=$q->sql_orders->createOrder($q);
		if (query($q,$sql)) {
			$create=true;
		}
	}
	return $create;
}

function editQuant(&$q,$count) { $edit=false;
	if (isset($q->user->id)) { if (isset($q->user->order->id)) {
		$sql=$q->sql_orders->editQuant($q,$count);
		if (query($q,$sql)) {
			$edit=true;
		}
	} }
	return $edit;
}

function deleteLine(&$q) { $del=false;
	if (isset($q->user->id)) { if (isset($q->user->order->id)) {
		$sql=$q->sql_orders->deleteLine($q);
		if (query($q,$sql)) {
			$del=true;
		}
	} }
	return $del;
}

function sendOrder(&$q) { $send=false;
	if (isset($q->user->id)) { if (isset($q->user->order->id)) {
		$sql=$q->sql_orders->sendOrder($q);
		if (query($q,$sql)) {
			$send=true;
		}
	} }
	return $send;
}

function sendMailAfterSendOrder(&$q,$pwd) { $ms=array(); $a=array(); $i=0; $total=0;
	if (isset($q->user->id)) { if (isset($q->user->order->id)) {
		$sql=$q->sql_orders->getOrderDetailList($q);
		if (query($q,array("sql"=>$sql,"collection"=>"array"),$m)) {
			foreach ($m as $r) { unset($row);
				$i++; $row=new r;
				foreach (array("ID","SNAME","QUANT","SERIA","SCOUNTRY","PRICE") as $key) {
					if (isset($r->$key)) { 
						$row->$key=$q->validate->toUTF($r->$key);
					} else {
						$row->$key="";
					}
				}
				$row->i=$i;
				$row->SERIA=strval($row->SERIA);
				$row->SCOUNTRY=strval($row->SCOUNTRY);
				$row->PRICE=floatval($row->PRICE);
				$row->SUMM=floatval($row->SUMM);
				$row->QUANT=floatval($row->QUANT);
				$row->RSUMM=floatval($row->PRICE*$row->QUANT);
				$total+=$row->RSUMM;
				$ms[]=$row;
			}
		}
	} }
	if (sizeof($ms)>0) {
		$mu=$q->users->getUserData(&$q);
		$m=$q->tpl_mail->sendOrder(array("user"=>$mu[0],
										 "order"=>$ms,
										 "total"=>$total,
										 "orderId"=>$q->user->order->id,
										 "pwd"=>$pwd
										 ));
		$m["text"]=$q->validate->toWin($m["text"]);
		if (isset($mu[0])) {
			if (isset($mu[0]->EMAIL)) {
				if (($mu[0]->EMAIL!="") && ($m["theme"]!="") && ($m["text"]!="")) {
					sendMail($q,$mu[0]->EMAIL,$m["theme"],$m["text"]);
				}
			}
		}
	}	
}

function partIsAdded(&$q) { $part_exists=false;
	if (isset($q->user->id)) { if (isset($q->user->order->id)) { if ($q->url->id>0) {
		$sql=$q->sql_orders->partIsAdded($q);
		$query=ibase_query($q->fdb->it,$sql);
		if (isset($query)) { if ($query) {
			$r=ibase_fetch_object($query);
			if (isset($r)) { if (isset($r->ID)) { if ($r->ID>0) {
				$part_exists=true;
			} } } 
		} }
	} } }
	return $part_exists;
}

function addComment(&$q,$comment="") { $add=false; $m=array();
	$comment=$q->validate->toWin($comment);
	if (isset($q->user->id)) { if (isset($q->user->order->id)) {
		if (isset($comment)) {
			$sql=$q->sql_orders->addComment($q,$comment);
			if (query($q,$sql)) {
				$add=true;
			}
		}
	} }
	return $add;
}

function getComment(&$q) { $s="";
	if (isset($q->user->id)) { if (isset($q->user->order->id)) {
		$sql=$q->sql_orders->getComment($q);
		$query=ibase_query($q->fdb->it,$sql);
		if (query($q,$sql,$r)) {
			if (isset($r)) { if (isset($r->COMMENT)) {
				$s=$q->validate->toUTF($r->COMMENT);
			} }
		}
	} }
	return $s;
}

} ?>
