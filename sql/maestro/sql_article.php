<?php class sql_article {

function getRealQuant($q,$id) { $s="";
	$q->validate->idForSql($id);
	$s.="SELECT REALQUANT FROM VW_WAREBASE WHERE PART_ID=".$id."";
	return $s;
}

function dopInfo($q,$id) { $s="";
	$q->validate->idForSql($id);
	$s.="SELECT * FROM VW_DOPINFOCENN WHERE NAME_ID=".$id." ORDER by SORTING ASC";
	return $s;
}

function article($q,$id) { $s="";
	$q->validate->idForSql($id);
	$s.="SELECT * FROM VW_WAREBASE WHERE PART_ID=".$id."";
	return $s;
}

} ?>
