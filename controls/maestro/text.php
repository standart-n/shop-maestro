<? class text {

function engine(&$q) {
	toModel($q,$this->textShow($q),"text");
}

function textShow(&$q) { $s="";
	if ($q->url->type=="text") {
		$s.=$q->tpl_text->text($q);
	}
	return $s;
}

} ?>
