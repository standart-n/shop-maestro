<?php class sql_price {

function steps($q,$id) { $s="";
	$q->validate->urlInt($id);
	$s.="SELECT * FROM GROUPS WHERE GROUPTABLE='PART_FOLDER' AND STATUS=0 AND ID=".$id." ORDER by PARENT_ID ASC";
	return $s;
}

function table($q) { $u=$q->url; $s=""; $k=""; $i=0;
	foreach (array("id","group","first","sort","grad","search","presence") as $key) { $$key=$u->$key; }
	//if (($search!="") && ($search!="Поиск по всем товарам...")) {
	//	$search=$q->fn->toUTF($search);
	//}
	$q->validate->skipForSql($first);
	$q->validate->urlSort($sort);
	$q->validate->urlGrad($grad);
	$q->validate->urlPresence($presence);
	$s.="SELECT SKIP ".$first." * FROM VW_WAREBASE WHERE (1=1) ";
	if (isset($q->tree[$group])) {
		$s.="AND ( ";
		foreach ($q->tree[$group] as $key) { $i++;
			if ($i>1) { $s.="OR "; }
			$q->validate->urlInt($key);
			$s.="(GROUP_ID=".$key.") ";
		}
		$s.=") ";
	}
	if ($q->validate->searchForSql($search)) {
		$s.="AND (";
		$s.="(SNAME CONTAINING '".$search."')";
		$s.=" OR ";
		$s.="(SERIA CONTAINING '".$search."')";
		$s.=") ";
	}
	if ($presence=="true") {
		$s.="AND (REALQUANT>0) ";
	}
	$s.="ORDER by ".$sort." ".$grad." ";

	return $s;
}





} ?>
