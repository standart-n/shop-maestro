<?php

class mainPage { 

var $module_caption=	"�������";
var $module_group=		"main";
var $module_name=		"mainPage";

var $page;
var $run="\r\n";
var $runn="\r\n\r\n";


function engine() {

	$ms=array();	
	$show="";
	switch ($this->page) {

	case 'mainPage':
		$title="������� ��������";
		$descr="�������� ������, ���������� ������, CMS, �������������� ���������� � ���������� �� �����, ������������ �����, ���������� ������";
		$keywords="cms, �����, ����������, ��������, ��������������, ����������, ����������, ������, ���������";

		//$show.= 	$this->about();
		$show.= 	$this->show_modules();
		
		$ms['title']=		$title;
		$ms['description']=	$descr;
		$ms['keywords']=	$keywords;
		$ms['html']=		$show;
		$ms['result']=		"TRUE";
	break;
	
	}

	return $ms;
}

function show_modules() {

    $show="";
    $line=$this->show_box("content");
    if ($line['show']!="FALSE") {
        $show.='<div class="clGroupLine">';
        $show.= '<div class="clGroupName">���������� ��� ������ � ���������</div>';
        $show.='</div>';
        $show.='<div class="clGroupBox">';
        $show.=$line['show'];
        $show.='</div>';
    }
    $line=$this->show_box("layout");
    if ($line['show']!="FALSE") {
        $show.='<div class="clGroupLine">';
        $show.= '<div class="clGroupName">���������� ��� ������ � ��������</div>';
        $show.='</div>';
        $show.='<div class="clGroupBox">';
        $show.=$line['show'];
        $show.='</div>';
    }
    $line=$this->show_box("design");
    if ($line['show']!="FALSE") {
        $show.='<div class="clGroupLine">';
        $show.= '<div class="clGroupName">���������� ��� ������ � ��������</div>';
        $show.='</div>';
        $show.='<div class="clGroupBox">';
        $show.=$line['show'];
        $show.='</div>';
    }
    $line=$this->show_box("modern");
    if ($line['show']!="FALSE") {
        $show.='<div class="clGroupLine">';
        $show.= '<div class="clGroupName">���������� ��� ������ � ������������ �����</div>';
        $show.='</div>';
        $show.='<div class="clGroupBox">';
        $show.=$line['show'];
        $show.='</div>';
    }
    $line=$this->show_box("settings");
    if ($line['show']!="FALSE") {
        $show.='<div class="clGroupLine">';
        $show.= '<div class="clGroupName">��������� ������� � ��������</div>';
        $show.='</div>';
        $show.='<div class="clGroupBox">';
        $show.=$line['show'];
        $show.='</div>';
    }
    $line=$this->show_box("another");
    if ($line['show']!="FALSE") {
        $show.='<div class="clGroupLine">';
        $show.= '<div class="clGroupName">������ ���� ����������</div>';
        $show.='</div>';
        $show.='<div class="clGroupBox">';
        $show.=$line['show'];
        $show.='</div>';
    }
    return $show;
}

function show_box($obj) {
    
    $ms=array();
    $show="";
    $count=0;
        reset($this->modules);
        foreach ($this->modules as $mdl) {
    		$name=$mdl['name'];
            $this->$name = new $name;
            if (isset($this->$name->module_obj)) {
              if ($this->$name->module_obj==$obj) {
                $show.='<div class="clModuleBox">';
                $show.= '<div class="clModuleIcon"><a title="������� � ����� ����������" href="index.php?page='.$name.'">';
                $ico='modules/'.$name.'/ico_48.png';
                //if (file_exists($ico)) {
                    $show.=     '<img src="modules/'.$name.'/ico_48.png">';
                //}   else {
                //    $show.=     '<img src="modules/mainPage/ico_48.png">';
                //} 
                $show.= '</a></div>';
                $show.= '<div class="clModuleContent">';
                $show.=     '<div class="clModuleName"><a title="������� � ����� ����������" href="index.php?page='.$name.'">';
                if (isset($this->$name->module_caption)) {
                    $caption=$this->$name->module_caption;
                    if (strlen($caption)>18) {
                        $caption=substr($caption,0,17)."...";
                    }
                    $show.=$caption;
                }
                $show.=     '</a></div>';
                $show.=     '<div class="clModuleCaption">';
                if (isset($this->$name->module_key)) {
                    $key=$this->$name->module_key;
                    if (strlen($key)>8) {
                        $key=substr($key,0,7)."...";
                    }
                    $show.=$key;
                }
                $show.=     '</div>';
                $show.= '</div>';
                $show.= '</div>';
                $count++;
              }
            }
		}
    if ($count==0) { $show="FALSE"; }
    $ms['show']=$show;
    $ms['count']=$count;
    
    return $ms;
    
}

function about() {

	$show=	$this->run;
	$show.='<div class="clTextLine">'.$this->run;
	$show.=	'<div class="clSomeText">'.$this->run;
	//$show.=		'<b>CMS Dement</b><br><br>'.$this->run;
	$show.=		'<b>����� ����������</b> � ������� ���������� ������ <b>Dement</b>!<br>'.$this->run;
	$show.=		'<br>'.$this->run;

	$show.=		'������ ������� ��������� <b>�������������� ������ � �������� � �����������</b>, ����������� �� ����� ���-�����.<br>'.$this->run;
	$show.=		'��������� ������ �������, �� ������ ��������� �������������� <b>��� ����</b> � ������, ������� �� ��������.<br>'.$this->run;
	$show.=		'������� ����� ��������� �� ������ ����������� ������� ����, �� � <b>������� � ������� ����� ����� ���-������</b>.<br>'.$this->run;
	$show.=		'<br>'.$this->run;

	$show.=		'<b>�������� �����������</b> ���� C������:<br>'.$this->run;
	$show.=		'-����������� <b>������� ����������� ���� � "������� �����"</b><br>'.$this->run;
	$show.=		'-�������������� ���� ����������� <b>����������</b>, ����������� �� �����<br>'.$this->run;
	$show.=		'-����������� ������� <b>��������� �������</b> �����<br>'.$this->run;
	$show.=		'-<b>��������� ������</b> � �������� �����<br>'.$this->run;
	$show.=		'-<b>���������� ������������ �������������</b><br>'.$this->run;
	$show.=		'-<b>��������</b> �� ���� ����� <b>������</b> � ����������<br>'.$this->run;
	$show.=		'-���������� �� ���� <b>�������� � ��������</b><br>'.$this->run;
	$show.=		'<br>'.$this->run;

	$show.=		'<b>�������</b> ������ C������ �� ������:<br>'.$this->run;
	$show.=		'-<b>����������-�������� ���������</b>, ����������� ������ ��������� � ������ � ������ ��������<br>'.$this->run;
	$show.=		'-����������� ������ ����������� ��� ��������� �� ����� ����� <b>��������� �����</b><br>'.$this->run;
	$show.=		'-�������������� <b>����������� ����� ��� ��������� �������</b><br>'.$this->run;
	$show.=		'-<b>���������</b> ���������<br>'.$this->run;
	$show.=		'-<b>��������</b> � ���������� �������<br>'.$this->run;
	$show.=		'<br>'.$this->run;

	$show.=		'<b>����� �����</b> �������� ����������� ��������� ���������� ������ ����� �������� � ���-��������, ����� ���� ��� �� ��� ��������. '.$this->run;
	$show.=		'����������, �� ������ ��������� ������ ����������� ��������� ����� �������� � ������ ���������� � ������������ ���, ��� ��� ��������, '.$this->run;
	$show.=		'�� �� �������, ��� <b>��� ��� �����</b>, ����� �� ������ <b>�������������� ��������� ����� ��������</b> � � ����� ����� ������ ���������, ������� '.$this->run;
	$show.=		'�� ������ ������ ����� ����������.<br>'.$this->run;
	$show.=		'<br>'.$this->run;

	$show.=		'<b>������ ���</b> �������� ������!<br>'.$this->run;

	$show.=	'</div>'.$this->run;
	$show.='</div>'.$this->runn;
	return $show;
}


}



?>