<? class text {

function engine(&$q) {
	toModel($q,$this->textShow($q),"text");
}

function textShow(&$q) { $s="";
	// 	$s.=$q->tpl_text->text($q);
	// }
	if ($q->url->type=="text") {
		$sql="SELECT * FROM maestro_dataTexts where name = \"".$q->url->page."\"";
		// if (query($q,array("sql"=>$sql,"connection"=>"local"),$ms)) {
		// 	print_r($ms);
		// }
		$query = mysql_query($sql,$q->local->db);
		if (isset($query)) { if ($query) {
			$res = mysql_fetch_object($query);
			$s = $q->tpl_text->show($q->fn->toUTF($res->caption),$q->fn->toUTF($res->text));
		}	}
	}
	return $s;
}

} ?>
