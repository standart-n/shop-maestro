<?php

class main {

function head() {

	echo	'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	echo	'<html xmlns="http://www.w3.org/1999/xhtml">';
	echo	'<head>';
	echo		'<title>Dement.ru :: ���������� ����</title>';												
	echo		'<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />';								
   	echo		'<meta http-equiv="Content-Language" content="ru" />';
   	echo		'<meta name="robots" content="all" />';
	echo		'<meta name="Copyright" Lang="ru" content="2010 ��� ��������-�">';
	echo		'<meta name="Document-state" content="Dynamic">';
	echo		'<meta name="Revesit" content="7">';
   	echo		'<meta name="description" content="Dement.ru - ������� ������������� �������� ��� ��������-�, ���-������ :: ������, �����, ������, ������, �������� ����, ����������������, ����������" />';
   	echo		'<meta name="keywords" content="������, ������, ���-������, �������, �����, �����, ������, �������, ����������������, �������,
											dement, web, internet, css, mysql, ajax, html, php, js, javascript, functions, script, code, design" />';

	echo		'<link	 href="http://www.dement.ru/img/favico.ico" rel="shortcut icon" type="image/x-icon" />';
	echo		'<link   href="style_main.css"  rel="stylesheet"   type="text/css">'; 									

	echo		'<script type="text/javascript" src="http://www.dement.ru/!lib/_js/De.js"></script>';  						 // ���������� dement.ru

	$inner1='<div class=\"clLinkTop\"><a id=\"idBtn1\" href=\"#de\">������1</a></div>';
	$inner2='<div class=\"clLinkTop\"><a id=\"idBtn1\" href=\"#de\">������1</a></div>';
	$innerB='<div class=\"clLinkSide\"><a href=\"#de\">������1</a></div>';
	$innerB.='<div class=\"clLinkSide\"><a href=\"#de\">������2</a></div>';
	$innerB.='<div class=\"clLinkSide\"><a href=\"#de\">������3</a></div>';
												
	echo		'<script type="text/javascript">';						
	echo			'new deSliderMenu(';									// ����� ������ 
	echo			'"box1",';												// id ���� ������� ����� �������� ������������ � � �������� �������� ��� 
	echo			'"#idBtn1",';											// ������ �� ������� ���������� ����. �������
	echo			'"mouseover",';											// ������� ��� ������� ���� �������� 
	echo			'"#deSlider_1",';										// ������ �� ������� ���������� ����. �������
	echo			'"mouseleave",';										// ������� ��� ������� ���� ����������
	echo			'"100",';												// �������� ���������
	echo			'"relative",';											// ���������������� �����
	echo			'"0px",';												// left ������ �� ������ ����
	echo			'"0px",';												// top ������ ������

	echo			'"'.$inner1.'",';										// text1 OFF ���������� ��������� ����� ������� �������
	echo			'"'.$inner2.'",';										// text2 ON ����� ��������� ����� ��� ��������
	echo			'"100px",';												// width ������
	echo			'"30px",';												// height ������

	echo			'"'.$innerB.'",';										// text inside ���������� ����� �������� ���������� � �������� 
	echo			'"98px",';												// width ������
	echo			'"auto",';												// height ������
	echo			'"none",';												// ������ ���
	echo			'"#999999 solid 1px",';									// �������
	
	echo			'"OFF",';												// ON/OFF with start ��������� ��������� �������� (�������� ��� �������� 
	echo			'"9",';													// css Z_INDEX		
	echo			'"deSlider_1"';		//***							//  id ����� ������� ����� ������ (�������� ��� ������������� ������������� ������� � ��� ���. �������) 
	echo			');';						//***  ���������, ������� ������ ���� ����������� ��� ������������ ������������� �������										
	echo		'</script>';			


	$inner1='<div class=\"clLinkTop\"><a id=\"idBtn2\" href=\"#de\">������2</a></div>';
	$inner2='<div class=\"clLinkTop\"><a id=\"idBtn2\" href=\"#de\">������2</a></div>';
	$innerB='<div class=\"clLinkSide\"><a href=\"#de\">������1</a></div>';
	$innerB.='<div class=\"clLinkSide\"><a href=\"#de\">������2</a></div>';
	$innerB.='<div class=\"clLinkSide\"><a href=\"#de\">������3</a></div>';
	$innerB.='<div class=\"clLinkSide\"><a href=\"#de\">������4</a></div>';
	$innerB.='<div class=\"clLinkSide\"><a href=\"#de\">������5</a></div>';
												
	echo		'<script type="text/javascript">';						
	echo			'new deSliderMenu(';									// ����� ������ 
	echo			'"box2",';												// id ���� ������� ����� �������� ������������ � � �������� �������� ��� 
	echo			'"#idBtn2",';											// ������ �� ������� ���������� ����. �������
	echo			'"mouseover",';											// ������� ��� ������� ���� �������� 
	echo			'"#deSlider_2",';										// ������ �� ������� ���������� ����. �������
	echo			'"mouseleave",';										// ������� ��� ������� ���� ����������
	echo			'"100",';												// �������� ���������
	echo			'"relative",';											// ���������������� �����
	echo			'"0px",';												// left ������ �� ������ ����
	echo			'"0px",';												// top ������ ������

	echo			'"'.$inner1.'",';										// text1 OFF ���������� ��������� ����� ������� �������
	echo			'"'.$inner2.'",';										// text2 ON ����� ��������� ����� ��� ��������
	echo			'"100px",';												// width ������
	echo			'"30px",';												// height ������

	echo			'"'.$innerB.'",';										// text inside ���������� ����� �������� ���������� � �������� 
	echo			'"98px",';												// width ������
	echo			'"auto",';												// height ������
	echo			'"none",';												// ������ ���
	echo			'"#999999 solid 1px",';									// �������
	
	echo			'"OFF",';												// ON/OFF with start ��������� ��������� �������� (�������� ��� �������� 
	echo			'"9",';													// css Z_INDEX		
	echo			'"deSlider_2"';		//***							//  id ����� ������� ����� ������ (�������� ��� ������������� ������������� ������� � ��� ���. �������) 
	echo			');';						//***  ���������, ������� ������ ���� ����������� ��� ������������ ������������� �������										
	echo		'</script>';			


	$inner1='<div class=\"clLinkTop\"><a id=\"idBtn3\" href=\"#de\">������3</a></div>';
	$inner2='<div class=\"clLinkTop\"><a id=\"idBtn3\" href=\"#de\">������3</a></div>';
	$innerB='<div class=\"clLinkSide\"><a href=\"#de\">������1</a></div>';
	$innerB.='<div class=\"clLinkSide\"><a href=\"#de\">������2</a></div>';
	$innerB.='<div class=\"clLinkSide\"><a href=\"#de\">������3</a></div>';
	$innerB.='<div class=\"clLinkSide\"><a href=\"#de\">������4</a></div>';
												
	echo		'<script type="text/javascript">';						
	echo			'new deSliderMenu(';									// ����� ������ 
	echo			'"box3",';												// id ���� ������� ����� �������� ������������ � � �������� �������� ��� 
	echo			'"#idBtn3",';											// ������ �� ������� ���������� ����. �������
	echo			'"mouseover",';											// ������� ��� ������� ���� �������� 
	echo			'"#deSlider_3",';										// ������ �� ������� ���������� ����. �������
	echo			'"mouseleave",';										// ������� ��� ������� ���� ����������
	echo			'"100",';												// �������� ���������
	echo			'"relative",';											// ���������������� �����
	echo			'"0px",';												// left ������ �� ������ ����
	echo			'"0px",';												// top ������ ������

	echo			'"'.$inner1.'",';										// text1 OFF ���������� ��������� ����� ������� �������
	echo			'"'.$inner2.'",';										// text2 ON ����� ��������� ����� ��� ��������
	echo			'"100px",';												// width ������
	echo			'"30px",';												// height ������

	echo			'"'.$innerB.'",';										// text inside ���������� ����� �������� ���������� � �������� 
	echo			'"98px",';												// width ������
	echo			'"auto",';												// height ������
	echo			'"none",';												// ������ ���
	echo			'"#999999 solid 1px",';									// �������
	
	echo			'"OFF",';												// ON/OFF with start ��������� ��������� �������� (�������� ��� �������� 
	echo			'"9",';													// css Z_INDEX		
	echo			'"deSlider_3"';		//***							//  id ����� ������� ����� ������ (�������� ��� ������������� ������������� ������� � ��� ���. �������) 
	echo			');';						//***  ���������, ������� ������ ���� ����������� ��� ������������ ������������� �������										
	echo		'</script>';			


	$inner1='<div class=\"clLinkTop\"><a id=\"idBtn4\" href=\"#de\">������4</a></div>';
	$inner2='<div class=\"clLinkTop\"><a id=\"idBtn4\" href=\"#de\">������4</a></div>';
	$innerB='<div class=\"clLinkSide\"><a href=\"#de\">������1</a></div>';
	$innerB.='<div class=\"clLinkSide\"><a href=\"#de\">������2</a></div>';
												
	echo		'<script type="text/javascript">';						
	echo			'new deSliderMenu(';									// ����� ������ 
	echo			'"box4",';												// id ���� ������� ����� �������� ������������ � � �������� �������� ��� 
	echo			'"#idBtn4",';											// ������ �� ������� ���������� ����. �������
	echo			'"mouseover",';											// ������� ��� ������� ���� �������� 
	echo			'"#deSlider_4",';										// ������ �� ������� ���������� ����. �������
	echo			'"mouseleave",';										// ������� ��� ������� ���� ����������
	echo			'"100",';												// �������� ���������
	echo			'"relative",';											// ���������������� �����
	echo			'"0px",';												// left ������ �� ������ ����
	echo			'"0px",';												// top ������ ������

	echo			'"'.$inner1.'",';										// text1 OFF ���������� ��������� ����� ������� �������
	echo			'"'.$inner2.'",';										// text2 ON ����� ��������� ����� ��� ��������
	echo			'"100px",';												// width ������
	echo			'"30px",';												// height ������

	echo			'"'.$innerB.'",';										// text inside ���������� ����� �������� ���������� � �������� 
	echo			'"98px",';												// width ������
	echo			'"auto",';												// height ������
	echo			'"none",';												// ������ ���
	echo			'"#999999 solid 1px",';									// �������
	
	echo			'"OFF",';												// ON/OFF with start ��������� ��������� �������� (�������� ��� �������� 
	echo			'"9",';													// css Z_INDEX		
	echo			'"deSlider_4"';		//***							//  id ����� ������� ����� ������ (�������� ��� ������������� ������������� ������� � ��� ���. �������) 
	echo			');';						//***  ���������, ������� ������ ���� ����������� ��� ������������ ������������� �������										
	echo		'</script>';			




	echo	'</head>';
	echo	'<body>';
}


function finish() {

	echo	'</body>';
	echo	'</html>';

}


function action() { 

	echo	'<div id="idMainDiv">';
	echo	'<div id="box1"></div>';
	echo	'<div id="box2"></div>';
	echo	'<div id="box3"></div>';
	echo	'<div id="box4"></div>';
	echo	'</div>';
}


}




?>