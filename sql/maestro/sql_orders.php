<?php class sql_orders {

function getOrderId($q,$st=1) { $s="";
	$s.="SELECT * FROM MAGAZINE_ORDERS WHERE (MAGAZINE_USER_ID=".$q->user->id.") AND (STATUS=".$st.") ";
	return $s;
}

function createOrder($q,$st=1) { $s=""; $tm=time();
	$s.="INSERT INTO MAGAZINE_ORDERS ";
	$s.="(MAGAZINE_USER_ID,STATUS,INSERTDT,INSTIME) VALUES ";
	$s.="(".$q->user->id.",".$st.",CURRENT_TIMESTAMP,".$tm.") ";
	return $s;	
}

function countPartsInOrder($q,$st=1) {
	$s.="SELECT count(ID) as COUNT_PARTS FROM MAGAZINE_ORDER_DETAIL WHERE (1=1) ";
	$s.="AND (ORDER_ID=".$q->user->order->id.") ";
	$s.="AND (STATUS=".$st.") ";
	return $s;
}

function addPartToOrder($q,$r,$count,$price,$summ,$st=1) { $s=""; $tm=time();
	$s.="INSERT INTO MAGAZINE_ORDER_DETAIL ";
	$s.="(ORDER_ID,PART_ID,STATUS,QUANT,PRICE,SUMMA,INSERTDT,INSTIME) VALUES ";
	$s.="(".$q->user->order->id.",".$r->PART_ID.",".$st.",".$count.",".$price.",".$summ.",CURRENT_TIMESTAMP,".$tm.") ";
	return $s;	
}

function getOrderDetailList($q,$st=1) { $s="";
	$s.="SELECT ";
	$s.="base.SNAME as SNAME, base.SERIA as SERIA, base.SCOUNTRY as SCOUNTRY, base.PRICE as PRICE_BASE, ";
	$s.="detail.QUANT as QUANT, detail.PRICE as PRICE, detail.SUMMA as SUMM, detail.PART_ID as ID, detail.INSTIME as INSTIME ";
	$s.="FROM MAGAZINE_ORDER_DETAIL detail ";
	$s.="LEFT JOIN VW_WAREBASE base on (detail.PART_ID=base.PART_ID) ";
	$s.="WHERE (1=1) ";
	$s.="AND (detail.ORDER_ID=".$q->user->order->id.") ";
	$s.="AND (detail.STATUS=".$st.") ";
	$s.="ORDER by detail.INSTIME Desc ";
	return $s;
}

function getOrderDetailCount($q,$st=1) { $s="";
	$s.="SELECT count(ID) as COUNT_ID ";
	$s.="FROM MAGAZINE_ORDER_DETAIL ";
	$s.="WHERE (1=1) ";
	$s.="AND (ORDER_ID=".$q->user->order->id.") ";
	$s.="AND (STATUS=".$st.") ";
	return $s;
}


function editQuant($q,$count) { $s="";
	$s.="UPDATE MAGAZINE_ORDER_DETAIL SET ";
	$s.="QUANT=".$count.", ";
	$s.="SUMMA=(".$count."*PRICE) ";	
	$s.="WHERE (1=1) ";
	$s.="AND (ORDER_ID=".$q->user->order->id.") ";
	$s.="AND (PART_ID=".$q->url->id.") ";
	return $s;
}

function sendOrder($q,$st=2) { $s=""; $tm=time();
	$s.="UPDATE MAGAZINE_ORDERS SET ";
	$s.="STATUS=".$st.", ";
	$s.="POSTDT=CURRENT_TIMESTAMP, ";
	$s.="POSTTIME=".$tm." ";
	$s.="WHERE (1=1) ";
	$s.="AND (ID=".$q->user->order->id.") ";
	$s.="AND (MAGAZINE_USER_ID=".$q->user->id.") ";
	return $s;
}

function deleteLine($q) { $s="";
	$s.="DELETE FROM MAGAZINE_ORDER_DETAIL WHERE (1=1) ";
	$s.="AND (ORDER_ID=".$q->user->order->id.") ";
	$s.="AND (PART_ID=".$q->url->id.") ";
	return $s;
}

function partIsAdded($q,$st=1) { $s="";
	$s.="SELECT * FROM MAGAZINE_ORDER_DETAIL WHERE (1=1) ";
	$s.="AND (PART_ID=".$q->url->id.") ";
	$s.="AND (ORDER_ID=".$q->user->order->id.") ";
	$s.="AND (STATUS=".$st.") ";
	return $s;
}

function addComment($q,$comment) { $s="";
	$s.="UPDATE MAGAZINE_ORDERS SET ";
	$s.="COMMENT='".$comment."' ";
	$s.="WHERE (1=1) ";
	$s.="AND (ID=".$q->user->order->id.") ";
	$s.="AND (MAGAZINE_USER_ID=".$q->user->id.") ";
	return $s;
}

function getComment($q) { $s="";
	$s.="SELECT COMMENT FROM MAGAZINE_ORDERS WHERE (1=1) ";
	$s.="AND (ID=".$q->user->order->id.") ";
	$s.="AND (MAGAZINE_USER_ID=".$q->user->id.") ";
	return $s;
}

function getHistoryOrder($q,$st=1) { $s="";
	$s.="SELECT ";
	$s.="ord.ID as ID, ord.POSTDT as POSTDT, ord.POSTTIME as POSTTIME, ";
	$s.="st.CAPTION as STATUS ";
	$s.="FROM MAGAZINE_ORDERS ord ";
	$s.="LEFT JOIN VW_STATUS st on (ord.STATUS=st.ID) ";
	$s.="WHERE (1=1) ";
	$s.="AND (ord.STATUS>".$st.") ";
	$s.="AND (ord.MAGAZINE_USER_ID=".$q->user->id.") ";
	$s.="ORDER by POSTDT Desc ";
	return $s;
}

function getHistoryOrderDetail($q,$order_id) { $s="";
	$s.="SELECT ";
	$s.="base.SNAME as SNAME, base.SERIA as SERIA, base.SCOUNTRY as SCOUNTRY, base.PRICE as PRICE_BASE, ";
	$s.="detail.QUANT as QUANT, detail.PRICE as PRICE, detail.SUMMA as SUMM, detail.PART_ID as ID, detail.INSTIME as INSTIME ";
	$s.="FROM MAGAZINE_ORDER_DETAIL detail ";
	$s.="LEFT JOIN VW_WAREBASE base on (detail.PART_ID=base.PART_ID) ";
	$s.="WHERE (1=1) ";
	$s.="AND (detail.ORDER_ID=".$order_id.") ";
	$s.="ORDER by detail.INSTIME Desc ";
	return $s;
}


} ?>
