<?php

class main {

function head() {

	echo	'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	echo	'<html xmlns="http://www.w3.org/1999/xhtml">';
	echo	'<head>';
	echo		'<title>Dement.ru :: ���������� �����</title>';												
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

	$inner1='<div id=\"Caption_off\">����������</div>';
	$inner2='<div id=\"Caption_on\">����������</div>';
	$innerBox='����� ����� ���������� ����� ���������� ��� ����� html-���';
												
	echo		'<script type="text/javascript">';						
	echo			'new deSliderBlock(';									// ����� ������ 
	echo			'"box1",';												// id ���� ������� ����� �������� ������������ � � �������� �������� ��� 
	echo			'"click",';												// ������� ��� ������� ���� �������� 
	echo			'"click",';												// ������� ��� ������� ���� ����������
	echo			'"100",';												// �������� ���������
	echo			'"relative",';											// ���������������� �����
	echo			'"0px",';												// left ������ �� ������ ����
	echo			'"0px",';												// top ������ ������

	echo			'"'.$inner1.'",';										// text1 OFF ���������� ��������� ����� ������� �������
	echo			'"'.$inner2.'",';										// text2 ON ����� ��������� ����� ��� ��������
	echo			'"300px",';												// width ������ ��������
	echo			'"20px",';												// height ������ ��������
	echo			'"#9ccaea",';											// background OFF ������ ��� ��� �������� �������
	echo			'"#cdd8e0",';											// background ON ������ ��� ��� ��������� �������
	echo			'"#799fba solid 2px",';									// border OFF ������� ��� �������� ������� 
	echo			'"#acacac solid 2px",';									// border ON ������� ��� ��������� �������

	echo			'"'.$innerBox.'",';										// text inside ���������� ����� �������� ���������� � �������� 
	echo			'"302px",';												// width ������ ����� ����� 
	echo			'"100px",';												// height ������ ����� �����
 	echo			'"#ffffff",';											// background ������ ��� 
	echo			'"#cccccc solid 1px",';									// border ��������� 
	
	echo			'"OFF",';												// ON/OFF with start ��������� ��������� �������� (�������� ��� �������� 
	echo			'"9",';													// css Z_INDEX		
	echo			'"deSliderDiv_1"';		//***							//  id ����� ������� ����� ������ (�������� ��� ������������� ������������� ������� � ��� ���. �������) 
	echo			');';						//***  ���������, ������� ������ ���� ����������� ��� ������������ ������������� �������										
	echo		'</script>';			

	$inner1='<div id=\"Caption_off\">����������� (1)</div>';
	$inner2='<div id=\"Caption_on\">�����������</div>';
	$innerBox='<img src=\"http://www.dement.ru/!lib/_img/strelka.jpg\">';

	echo		'<script type="text/javascript">';						
	echo			'new deSliderBlock(';									// ����� ������ 
	echo			'"box2",';												// id ���� ������� ����� �������� ������������ � � �������� �������� ��� 
	echo			'"click",';												// ������� ��� ������� ���� �������� 
	echo			'"click",';												// ������� ��� ������� ���� ����������
	echo			'"100",';												// �������� ���������
	echo			'"relative",';												// ���������������� �����
	echo			'"0px",';												// left
	echo			'"0px",';												// top

	echo			'"'.$inner1.'",';										// text1 OFF
	echo			'"'.$inner2.'",';										// text2 ON
	echo			'"300px",';												// width
	echo			'"20px",';												// height
	echo			'"#9ccaea",';											// background OFF
	echo			'"#cdd8e0",';											// background ON
	echo			'"#799fba solid 2px",';									// border OFF
	echo			'"#acacac solid 2px",';									// border ON

	echo			'"'.$innerBox.'",';											// text inside
	echo			'"302px",';												// width
	echo			'"200px",';												// height
	echo			'"#ffffff",';											// background
	echo			'"#cccccc solid 1px",';									// border 
	
	echo			'"OFF",';												// ON/OFF with start
	echo			'"9",';													// css Z_INDEX		
	echo			'"deSliderDiv_2"';		//***							//  id ����� ������� ����� ������ (�������� ��� ������������� ������������� ������� � ��� ���. �������) 
	echo			');';					//***  ���������, ������� ������ ���� ����������� ��� ������������ ������������� �������										
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
	echo	'<div id="middle"></div>';
	echo	'<div id="box2"></div>';
	echo	'</div>';
}


}




?>