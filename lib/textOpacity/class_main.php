<?php

class main {

function head() {

	echo	'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	echo	'<html xmlns="http://www.w3.org/1999/xhtml">';
	echo	'<head>';
	echo		'<title>Dement.ru :: ��������� ������������ ������ � ��� ����</title>';												
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

												
	echo		'<script type="text/javascript">';						
	echo			'new deTextOpacity(';									// ����� ������ ��������� �������������� ���� �������
	echo			'"deText1",';											// id ���� ������� ����� �������� ������������ � � �������� �������� ��� 
	echo			'"mouseover",';											// ������� � �������� ���������� �������� ��������
	echo			'"mouseout",';											// ������� ����� �������� ������������� �����������
	echo			'"2000",';												// �������� ���������
	echo			'"60",';												// ��������� �������������� ������
	echo			'"90",';												// �������������� ������ ��� ��������� �� ���� 
	echo			'"50",';												// �������������� ���� ��� ���������
	echo			'"90",';												// �������������� ���� � ������� ��������� 
	echo			'"url(http://www.dement.ru/!lib/_img/strelka.jpg) no-repeat center",'; // ���� � ����� �������� � ����������� ���������� 
	echo			'"9",';													// css Z_INDEX		
	echo			'"deTextOpacityDiv_1"';		//***						//  id ����� ������� ����� ������ (�������� ��� ������������� ������������� ������� � ��� ���. �������) 
	echo			');';						//***  ���������, ������� ������ ���� ����������� ��� ������������ ������������� �������										
	echo		'</script>';			

	echo		'<script type="text/javascript">';						
	echo			'new deTextOpacity(';									// ����� ������ ��������� �������������� ���� �������
	echo			'"deText2",';											// id ���� ������� ����� �������� ������������ � � �������� �������� ��� 
	echo			'"mouseover",';											// ������� � �������� ���������� �������� ��������
	echo			'"mouseout",';											// ������� ����� �������� ������������� �����������
	echo			'"2000",';												// �������� ���������
	echo			'"60",';												// ��������� �������������� ������
	echo			'"90",';												// �������������� ������ ��� ��������� �� ���� 
	echo			'"50",';												// �������������� ���� ��� ���������
	echo			'"90",';												// �������������� ���� � ������� ��������� 
	echo			'"url(http://www.dement.ru/!lib/_img/bridge.jpg) no-repeat center",'; // ���� � ����� �������� � ����������� ���������� 
	echo			'"12",';													// css Z_INDEX		
	echo			'"deTextOpacityDiv_2"';		//***						//  id ����� ������� ����� ������ (�������� ��� ������������� ������������� ������� � ��� ���. �������) 
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
	echo		'<div id="deText1">';
	echo		'����� ����� ���� ���������� ����� ���� ��� ������ ����������: ��������, <br>�������, ����� � �.�.';
	echo		'</div>';
	echo		'<div id="deText2">';
	echo		'����� ���� �� ������ ������� �� �������� ������� ������ � ��� ������ ������ ����������� ���������';
	echo		'</div>';
	echo	'</div>';
}


}




?>