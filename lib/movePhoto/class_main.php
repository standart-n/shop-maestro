<?php

class main {

function head() {

	echo	'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	echo	'<html xmlns="http://www.w3.org/1999/xhtml">';
	echo	'<head>';
	echo		'<title>Dement.ru :: ������������ drag&drop �� �������� � �� ���� ������ ����</title>';												
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

	echo		'<script type="text/javascript">';					// ������ :: drag&drop
	echo			'new deDragDrop(';			
	echo			'"deMoving",';								// ������ ������� ����� ��������������� 
	echo			'"deMoving"';								// ������ ��� ������� �� ������� ����� �������� ��������������
	echo			');';										// ������ �������� ��� ��� ����� ���� � ��� �� ������ - ������� �� �������������
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
	echo		'<div id="deMoving">';
	echo		'</div>';
	echo	'</div>';
}


}




?>