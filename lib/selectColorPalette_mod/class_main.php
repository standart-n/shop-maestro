<?php

class main {

function head() {

	echo	'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	echo	'<html xmlns="http://www.w3.org/1999/xhtml">';
	echo	'<head>';
	echo		'<title>Dement.ru :: ����� ����� �� �������</title>';

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

	echo		'<script type="text/javascript" src="http://www.dement.ru/!lib/_js/De.js"></script>'; 				 // dement.ru

	echo		'<script type="text/javascript">';				// ����� ����� �� �������
	echo			'new deSelectColor(';						// ����� ������ ������������ ��������� ����������� � ��� ���������
	echo			'"idMainDiv",';								//  id ������������� ���� (��� , � ������� ��������� ���)
	echo			'"http://www.dement.ru/!lib/selectColorPalette/img/wheel.jpg",';	//  ���� � �������� � ��������
	echo			'"������� ����� ����� ������� ����",';		//  ����� ����������� ���������
	echo			'"#ffffff",';								//  CSS background
	echo			'"#333333 solid 10px",';						//  CSS border

	echo			'"<strong>������� ������</strong>",';						// ��������� �������		
	echo			'"TRUE",';									// ���������� ��� ��� ���� ���������
	echo			'"20px",';									// ��� ������ HEIGHT � ���� ���� ������ CSS ��� ����� ���������		
	echo			'"Verdana, Arial, Helvetica, sans-serif",'; //  CSS FONT 
	echo			'"12px",';									//  CCS FONT SIZE
	echo			'"#000000",';								//  CSS COLOR

	echo			'"��������� ����",';						// ������� ����� ������� ���������� ���� �� ������� ������ �����
	echo			'"TRUE",';									// ���������� ��� ����� ��� ��� 	
	echo			'"30px",';									// �� ������ HEIGHT � ���� ���� ������ CSS ��� ����� ���������
	echo			'"Verdana, Arial, Helvetica, sans-serif",'; //  CSS FONT 
	echo			'"10px",';									//  CCS FONT SIZE			
	echo			'"#000000",';								//  CSS COLOR

	echo			'"idPalette",';				//***			//  id �������� ����
	echo			'"idPaletteCaption",';		//***			//  id ���� � ���������� 
	echo			'"idPaletteHover",';		//***			//  id ����� ���������� ��������� ����
	echo			'"idPaletteImage",';		//***			//  id ���� � ��������� ������� 
	echo			'"idPaletteInputLine",';	//***			//  ��� ������ � ������� ������������ ��� ����� �� ������� ������
	echo			'"namePaletteHoverColor",';	//***			//  ��� ������ � ������� ������������ ��� ����� �� ������� ������
	echo			'"idPaletteHoverColor",';	//***			//  ID ������ � ������� ������������ ��� ����� �� ������� ������			
	echo			'"namePaletteClickColor",';	//***			//  ��� ������ � ������� ������������ ��� ����� ������� �������	
	echo			'"idPaletteClickColor"';	//***			//  ID ������ � ������� ������������ ��� ����� ������� �������
	echo			');';												
	echo		'</script>';					//*** ��� ��������� ������ ���� ����������� ��� ������������ ������������� ������� �� �������� 


	echo	'</head>';
	echo	'<body>';
}


function finish() {

	echo	'</body>';
	echo	'</html>';

}


function action() { 


	echo	'<div id="idMainDiv">';
	echo	'</div>';

}


}




?>