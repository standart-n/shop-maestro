<?php

class main {

function head() {

	echo	'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	echo	'<html xmlns="http://www.w3.org/1999/xhtml">';
	echo	'<head>';
	echo		'<title>Dement.ru :: ����������� �������� �����������</title>';													 // ������� �������� ����� ��� �� ����� �����		
	echo		'<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />';								 	 // !!!! ��� ������ ���������� ������� �� dement  		
   	echo		'<meta http-equiv="Content-Language" content="ru" />';
   	echo		'<meta name="robots" content="all" />';
	echo		'<meta name="Copyright" Lang="ru" content="2010 ��� ��������-�">';
	echo		'<meta name="Document-state" content="Dynamic">';
	echo		'<meta name="Revesit" content="7">';
   	echo		'<meta name="description" content="Dement.ru - ������� ������������� �������� ��� ��������-�, ���-������ :: ������, �����, ������, ������, �������� ����, ����������������, ����������" />';
   	echo		'<meta name="keywords" content="������, ������, ���-������, �������, �����, �����, ������, �������, ����������������, �������,
											dement, web, internet, css, mysql, ajax, html, php, js, javascript, functions, script, code, design" />';

	echo		'<link	 href="http://www.dement.ru/img/favico.ico" rel="shortcut icon" type="image/x-icon" />';
	echo		'<link   href="style_main.css"  rel="stylesheet"   type="text/css">'; 											 // ����� ������� ����������� ����� � ����� ������� 

	echo		'<script type="text/javascript" src="http://www.dement.ru/!lib/_js/De.js"></script>';  						 // ���������� dement.ru

																		// ����������� �������� �����������  - �� �������� �������� � ��� ����� ������ ����� 		
	echo		'<script type="text/javascript">';						// dePhotoPre    ����������� ��������� ��� ���������� ����� ���� ������� ��� ��� ������ 
	echo			'new dePhotoPre(';									// ����� ������ ������������ ��������� ����������� � ��� ���������
	echo			'"idMainDiv",';										// id ���� � ������� ����� ��������� �������� � ����������� ����������
	echo			'"imgStatic1",';									// id �������� (img) ��� ��������� �� ������� �������� ����������� ������� 			
	echo			'"http://www.dement.ru/!lib/_img/strelka_full.jpg",'; // ���� � ����� �������� � ����������� ���������� 
	echo			'"MovingUp",';										// ��� �������� ��������� ������������ ���������			
	echo			'"200",';											// �������� �������� ���������
	echo			'"absolute",';										// ����� ���� css POSIOTION ���������������� ����� � ����������� ����������
	echo			'"50px",';											// css 	TOP   ������������ ����� � ����������� ����������
	echo			'"400px",';											// css  LEFT  ������������ ����� � ����������� ����������
	echo			'"300px",';											// css WIDTH ������ ���� � ����������� ���������� 
	echo			'"300px",';											// css HEIGHT ������ ���� � ����������� ���������� 
	echo			'"9",';												// css Z_INDEX		
	echo			'"#0000FF solid 1px",';								// css BORDER
	echo			'"dePhotoPreDiv_id1",';		//***					//  id DIV ����� � ����������� ���������� (�������� ��� ������������� ������������� ������� � ��� ���. �������) 
	echo			'"dePhotoPreImg_id1",';		//***					//  id IMG ��������� � ����������� ���������� (�������� ��� ������������� ������������� ������� � ��� ���. �������) 
	echo			'"10"';												// !!! (��) ����� �������� �� ������ ������� (��� ���������� ������ �������), ����� ��� ������� ������� �� �������� ������ �����������
	echo			');';												// ��������� ����������� ��������
	echo		'</script>';			//***  ���������, ������� ������ ���� ����������� ��� ������������ ������������� �������




	echo		'<script type="text/javascript">';						// dePhotoPre    ����������� ��������� ��� ���������� ����� ���� ������� ��� ��� ������ 
	echo			'new dePhotoPre(';									// ����� ������ ������������ ��������� ����������� � ��� ���������
	echo			'"idMainDiv",';										// id ���� � ������� ����� ��������� �������� � ����������� ����������
	echo			'"imgStatic2",';									// id �������� (img) ��� ��������� �� ������� �������� ����������� ������� 			
	echo			'"http://www.dement.ru/!lib/_img/kanal_full.jpg",'; // ���� � ����� �������� � ����������� ���������� 
	echo			'"MovingDown",';									// ��� �������� ��������� ������������ ���������			
	echo			'"200",';											// �������� �������� ���������
	echo			'"absolute",';										// ����� ���� css POSIOTION ���������������� ����� � ����������� ����������
	echo			'"50px",';											// css 	TOP   ������������ ����� � ����������� ����������
	echo			'"400px",';											// css  LEFT  ������������ ����� � ����������� ����������
	echo			'"300px",';											// css WIDTH ������ ���� � ����������� ���������� 
	echo			'"300px",';											// css HEIGHT ������ ���� � ����������� ���������� 
	echo			'"9",';												// css Z_INDEX		
	echo			'"#00FF00 solid 1px",';								// css BORDER
	echo			'"dePhotoPreDiv_id2",';								//  id DIV ����� � ����������� ���������� (�������� ��� ������������� ������������� ������� � ��� ���. �������) 
	echo			'"dePhotoPreImg_id2"';								//  id IMG ��������� � ����������� ���������� (�������� ��� ������������� ������������� ������� � ��� ���. �������) 
	echo			');';												// ��������� ����������� ��������
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
	echo		'<img id="imgStatic1" align="center" src="http://www.dement.ru/!lib/_img/strelka.jpg">';
	echo		'<img id="imgStatic2" align="center" src="http://www.dement.ru/!lib/_img/kanal.jpg">'; 
	echo	'<br><strong>����������� �������� �����������.</strong><br>';
	//echo	'�������� �� �����������, ����� ������� ��� ����������� �������.';
	//echo	'����� ����������� ������ �� ����������, ����� �������� ������ ������������ �����������.';
	echo	'</div>';
}


}




?>