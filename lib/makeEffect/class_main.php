<?php

class main {

function head() {

	echo	'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	echo	'<html xmlns="http://www.w3.org/1999/xhtml">';
	echo	'<head>';
	echo		'<title>Dement.ru :: �������� ������� ��������� ��� �������</title>';												
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
	echo			'new deMakeEffect(';								// �������� �������� ��������� � ���������	
	echo			'"idMainDiv",';										// ��� � ������� ����� �������� ������ ��� ���� 
	echo			'"<img src=\"http://www.dement.ru/!lib/_img/kanal.jpg\">",'; // html ��� ����������� ����� �����									
	echo			'"deDiv1",';										// ������ �� ������� ����� ���������� ������� ���������
	echo			'"click",';											// ������� ���������
	echo			'"MovingUp",';										// ������ ��������� 
	echo			'"deDiv1",';										// ������ �� ������� ����� ���������� ������� �������
	echo			'"click",';											// ������� �������	
	echo			'"MovingUp",';										// ������ �������
	echo			'"20",';											// �������� �������� ���������
	echo			'"absolute",';										// css POSIOTION ���������������� ����� 
	echo			'"20px",';											// css 	TOP   ������������ ����� 
	echo			'"330px",';											// css  LEFT  ������������ ����� 
	echo			'"300",';											// css WIDTH ������ ����
	echo			'"300",';											// css HEIGHT ������ ���� 
	echo			'"hidden",';										// ���������� ��� ��� �������������� ���� ��� �������� �������� 
	echo			'"9",';												// css Z_INDEX		
	echo			'"dePhotoPreDiv_id1",';		//***					//  id DIV ����� 
	echo			'"10"';												// !!! (��) ����� �������� �� ������ ������� (��� ���������� ������ �������) 
	echo			');';												//***  ���������, ������� ������ ���� ����������� ��� ������������ ������������� �������
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
	echo		'<div id="deDiv1">';
	echo		'<img src="http://www.dement.ru/!lib/_img/strelka.jpg">';
	echo		'</div>';
	echo	'</div>';
}


}




?>