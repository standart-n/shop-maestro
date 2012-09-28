<?php class sql_groups {

function groups($q,$id) { $s="";
	//$q->validate->urlInt($id);
	$s.="SELECT * FROM GROUPS WHERE GROUPTABLE='PART_FOLDER' AND STATUS=0 AND PARENT_ID=".$id." ORDER by PARENT_ID ASC";
	return $s;
}


} ?>
