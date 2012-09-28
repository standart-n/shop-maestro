<?php class groups {

function engine(&$q) {
	toModel($q,$this->groupsShow($q),"groups");
}

function groupsShow(&$q,$show=true) { $mdl=""; $ms=array(); $i=0; $s="";
	$rr->ID=0; $rr->CAPTION="Все товары";
	if ($show) { $s.=$q->tpl_groups->groupLine($q,$rr,"main",false); }
	$sql_groups=$q->sql_groups->groups($q,-100);
	if (query($q,$sql_groups,$m)) {
		foreach ($m as $r) {
			if ($show) { $s.=$q->tpl_groups->groupLine($q,$r,"main"); }
			$sql_sub=$q->sql_groups->groups($q,$r->ID);
			if (query($q,$sql_sub,$m_sub)) {
				$ms[$r->ID][]=$r->ID;
				foreach ($m_sub as $r_sub) {
					if ($show) { $s.=$q->tpl_groups->groupLine($q,$r_sub,"sub"); }
					$sql_resub=$q->sql_groups->groups($q,$r_sub->ID);
					if (query($q,$sql_resub,$m_resub)) {
						$ms[$r->ID][]=$r_sub->ID; $ms[$r_sub->ID][]=$r_sub->ID;
						foreach ($m_resub as $r_resub) {
							if ($show) { $s.=$q->tpl_groups->groupLine($q,$r_resub,"resub"); }
							$ms[$r->ID][]=$r_resub->ID; $ms[$r_sub->ID][]=$r_resub->ID; $ms[$r_resub->ID][]=$r_resub->ID;
						}
					}
				}
			}
		}
	}
	$q->tree=$ms;
	return $s;
}

} ?>
