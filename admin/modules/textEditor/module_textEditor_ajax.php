<?php
    session_start();
    
	include_once('../../../class/class_base.php');
	include_once('../../../functions/fn_ajax.php');
	include_once('../../../functions/fn_frame.php');
	include_once('../../../functions/fn_js.php');
	include_once('../../../functions/fn_admin.php');
	
	$main_act=intval(trim($_GET['main_act']));
	$sub_act=intval(trim($_GET['sub_act']));
	$main_hov=intval(trim($_GET['main_hov']));
	$sub_hov=intval(trim($_GET['sub_hov']));

	$type=strval(trim($_GET['type']));
	$table=strval(trim($_GET['tbl']));
	$action=strval(trim($_GET['act']));
	$module=strval(trim($_GET['mdl']));
	$text=strval(trim($_GET['text']));

	include_once('module_'.$module.'.php');

	$base=new base;
	$fn_ajax=new fn_ajax;
	$unit=new $module;

	$base->getBaseFromModule();
	$db=							$base->db;
	$prefix=						$base->prefix;

	$unit->prefix=		$prefix;
	$unit->db=			$db;
	$unit->base=		$base;
    $unit->fn_frame=    new fn_frame;
    $unit->fn_js=       new fn_js;
    $unit->fn_admin=    new fn_admin;

    switch ($type) {
    case 'main' :
        switch ($action) {
        case 'open' :
            $unit->init();
            $unit->id=$main_hov;
            $unit->fn_admin->sub_id=$main_hov;
            $show=$unit->showSub();
    		echo $fn_ajax->innerHTML('mdl_sub','place',$show);
    		echo $fn_ajax->editCSS('#mdl_sub','display','block');
    		echo $fn_ajax->editCSS('#idSubCreate','display','block');
    		echo $fn_ajax->editCSS('#idSubButtons','display','none');
    		echo $fn_ajax->editCSS('#idSubSettings','display','none');
    		echo $fn_ajax->editCSS('#idSubBox','display','none');
            $main_act=$main_hov;
        break;   
        case 'delete' :
            $unit->init();
            $unit->id=$main_hov;
            $unit->main_delete();
            $show=$unit->showMain();
    		echo $fn_ajax->innerHTML('mdl_main','place',$show);
        break;   
        case 'deleteAct' :
            $unit->init();
            $unit->id=$main_act;
            $unit->main_delete();
            $show=$unit->showMain();
    		echo $fn_ajax->innerHTML('mdl_main','place',$show);
            $unit->fn_admin->sub_id=$main_act;
            $show=$unit->showSub();
    		echo $fn_ajax->innerHTML('mdl_sub','place',$show);
    		echo $fn_ajax->editCSS('#mdl_sub','display','none');
    		echo $fn_ajax->editCSS('#idSubCreate','display','none');
    		echo $fn_ajax->editCSS('#idSubBox','display','none');
    		echo $fn_ajax->editCSS('#idSubSettings','display','none');
	       	echo $fn_ajax->editCSS('#idSubButtons','display','none');
    		echo $fn_ajax->editCSS('#idSubBox','display','none');
    		echo $fn_ajax->editCSS('#idSubSettings','display','none');
	       	echo $fn_ajax->editCSS('#idSubButtons','display','none');
        break;   
        case 'rename' :
            $unit->init();
            $unit->id=$main_hov;
            $unit->text=$text;
            $unit->main_rename();
            $show=$unit->showMain();
    		echo $fn_ajax->innerHTML('mdl_main','place',$show);
        break;   
        case 'renameAct' :
            $unit->init();
            $unit->id=$main_act;
            $unit->text=$text;
            $unit->main_rename();
            $show=$unit->showMain();
    		echo $fn_ajax->innerHTML('mdl_main','place',$show);
        break;   
        case 'create' :
            $unit->init();
            $unit->id=$main_act;
            $unit->text=$text;
            $unit->main_create();
            $show=$unit->showMain();
    		echo $fn_ajax->innerHTML('mdl_main','place',$show);
        break;   
        case 'list_next' :
            $unit->init();
            $unit->id=$main_act;
        	$_SESSION['main:list_now']=$_SESSION['main:list_now']+1;
            $show=$unit->showMain();
    		echo $fn_ajax->innerHTML('mdl_main','place',$show);
        break;   
        case 'list_prev' :
            $unit->init();
            $unit->id=$main_act;
        	$_SESSION['main:list_now']=$_SESSION['main:list_now']-1;
            $show=$unit->showMain();
    		echo $fn_ajax->innerHTML('mdl_main','place',$show);
        break;   
        case 'limit_five' :
            $unit->init();
            $unit->id=$main_act;
        	$_SESSION['main:row_max']=5;
            $show=$unit->showMain();
    		echo $fn_ajax->innerHTML('mdl_main','place',$show);
        break;   
        case 'limit_ten' :
            $unit->init();
            $unit->id=$main_act;
        	$_SESSION['main:row_max']=10;
            $show=$unit->showMain();
    		echo $fn_ajax->innerHTML('mdl_main','place',$show);
        break;   
        case 'limit_twenty' :
            $unit->init();
            $unit->id=$main_act;
        	$_SESSION['main:row_max']=20;
            $show=$unit->showMain();
    		echo $fn_ajax->innerHTML('mdl_main','place',$show);
        break;   
        case 'limit_fivty' :
            $unit->init();
            $unit->id=$main_act;
        	$_SESSION['main:row_max']=50;
            $show=$unit->showMain();
    		echo $fn_ajax->innerHTML('mdl_main','place',$show);
        break;   
        }
		//echo $fn_ajax->editCSS('#main_li_'.$main_act,'border-top','#888888 solid 1px');
		//echo $fn_ajax->editCSS('#main_li_'.$main_act,'border-bottom','#666666 solid 1px');
		echo $fn_ajax->editCSS('#idmain_ul li','background','url(http://www.dement.ru/!php/img/bg_blue.png) repeat-x left top');
		echo $fn_ajax->editCSS('#main_li_'.$main_act,'background','url(http://www.dement.ru/!php/img/bg_gold.png) repeat-x left top');
    break;
    case 'sub':
        switch ($action) {
        case 'open' :
            $unit->init();
            $unit->id=$sub_hov;
            $ms=$unit->sub_open();
            if (isset($ms['html'])) {
    	   	   echo $fn_ajax->insertIntoFrame('deDoc',$ms['html']);
            }
            if (isset($ms['caption'])) {
        		echo $fn_ajax->value('idTextCaption','place',$ms['caption']);
            }
            if (isset($ms['title'])) {
        		echo $fn_ajax->value('idTextTitle','place',$ms['title']);
            }
            if (isset($ms['name'])) {
        		echo $fn_ajax->value('idTextName','place',$ms['name']);
            }
            if (isset($ms['group'])) {
        		echo $fn_ajax->value('idTextGroup','place',$ms['group']);
            }
            if (isset($ms['key'])) {
        		echo $fn_ajax->value('idTextKey','place',$ms['key']);
            }
            if (isset($ms['descr'])) {
        		echo $fn_ajax->value('idTextDescr','place',$ms['descr']);
            }
            if (isset($ms['keywords'])) {
        		echo $fn_ajax->value('idTextKeywords','place',$ms['keywords']);
            }
            $sub_act=$sub_hov;
    		echo $fn_ajax->editCSS('#idSubButtons','display','block');
    		echo $fn_ajax->editCSS('#idSubSettings','display','block');
    		echo $fn_ajax->editCSS('#idSubBox','display','block');
        break;
        case 'delete' :
            $unit->init();
            $unit->id=$sub_hov;
            $unit->sub_delete();
            $unit->fn_admin->sub_id=$main_act;
            $show=$unit->showSub();
    		echo $fn_ajax->innerHTML('mdl_sub','place',$show);
        break;
        case 'deleteAct' :
            $unit->init();
            $unit->id=$sub_act;
            $unit->sub_delete();
            $unit->fn_admin->sub_id=$main_act;
            $show=$unit->showSub();
    		echo $fn_ajax->innerHTML('mdl_sub','place',$show);
    		echo $fn_ajax->editCSS('#idSubBox','display','none');
    		echo $fn_ajax->editCSS('#idSubSettings','display','none');
	       	echo $fn_ajax->editCSS('#idSubButtons','display','none');
        break;
        case 'setAct' :
            $unit->init();
            $unit->id=$main_act;
            $unit->sub_act=$sub_act;
            $unit->sub_set();
            $show=$unit->showMain();
    		echo $fn_ajax->innerHTML('mdl_main','place',$show);
            $unit->fn_admin->sub_id=$main_act;
            $show=$unit->showSub();
    		echo $fn_ajax->innerHTML('mdl_sub','place',$show);
    		echo $fn_ajax->editCSS('#idSubBox','display','none');
    		echo $fn_ajax->editCSS('#idSubSettings','display','none');
	       	echo $fn_ajax->editCSS('#idSubButtons','display','none');
    		echo $fn_ajax->editCSS('#idmain_ul li','background','url(http://www.dement.ru/!php/img/bg_blue.png) repeat-x left top');
	       	echo $fn_ajax->editCSS('#main_li_'.$main_act,'background','url(http://www.dement.ru/!php/img/bg_gold.png) repeat-x left top');
        break;
        case 'create' :
            $unit->init();
            $unit->id=$main_act;
            $unit->text=$text;
            $unit->sub_create();
            $unit->fn_admin->sub_id=$main_act;
            $show=$unit->showSub();
    		echo $fn_ajax->innerHTML('mdl_sub','place',$show);
        break;
        case 'list_next' :
            $unit->init();
            $unit->id=$sub_act;
        	$_SESSION['sub:list_now']=$_SESSION['sub:list_now']+1;
            $unit->fn_admin->sub_id=$main_act;
            $show=$unit->showSub();
    		echo $fn_ajax->innerHTML('mdl_sub','place',$show);
        break;   
        case 'list_prev' :
            $unit->init();
            $unit->id=$sub_act;
        	$_SESSION['sub:list_now']=$_SESSION['sub:list_now']-1;
            $unit->fn_admin->sub_id=$main_act;
            $show=$unit->showSub();
    		echo $fn_ajax->innerHTML('mdl_sub','place',$show);
        case 'limit_five' :
            $unit->init();
            $unit->id=$main_act;
        	$_SESSION['sub:row_max']=5;
            $unit->fn_admin->sub_id=$main_act;
            $show=$unit->showSub();
    		echo $fn_ajax->innerHTML('mdl_sub','place',$show);
        break;   
        case 'limit_ten' :
            $unit->init();
            $unit->id=$main_act;
        	$_SESSION['sub:row_max']=10;
            $unit->fn_admin->sub_id=$main_act;
            $show=$unit->showSub();
    		echo $fn_ajax->innerHTML('mdl_sub','place',$show);
        break;   
        case 'limit_twenty' :
            $unit->init();
            $unit->id=$main_act;
        	$_SESSION['sub:row_max']=20;
            $unit->fn_admin->sub_id=$main_act;
            $show=$unit->showSub();
    		echo $fn_ajax->innerHTML('mdl_sub','place',$show);
        break;   
        case 'limit_fivty' :
            $unit->init();
            $unit->id=$main_act;
        	$_SESSION['sub:row_max']=50;
            $unit->fn_admin->sub_id=$main_act;
            $show=$unit->showSub();
    		echo $fn_ajax->innerHTML('mdl_sub','place',$show);
        break;   
        break;   
        }   
		echo $fn_ajax->editCSS('#idsub_ul li','background','url(http://www.dement.ru/!php/img/bg_blue.png) repeat-x left top');
		echo $fn_ajax->editCSS('#sub_li_'.$sub_act,'background','url(http://www.dement.ru/!php/img/bg_gold.png) repeat-x left top');
    break;
    }


/*
		echo $fn_ajax->innerHTML('idStatusItems','place','');
		echo $fn_ajax->innerHTML('idSelectItems','place','');
		echo $fn_ajax->editCSS('#idBoxText','display','none');
		echo $fn_ajax->editCSS('#idBoxButtons','display','none');
		echo $fn_ajax->insertIntoFrame('deDoc','');

	
*/															


  
?>		






