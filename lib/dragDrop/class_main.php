<?php

class main {

function head() {

	echo	'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	echo	'<html xmlns="http://www.w3.org/1999/xhtml">';
	echo	'<head>';
	echo		'<title>Dement.ru :: Drag&Drop</title>';

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

	echo		'<script type="text/javascript" src="http://www.dement.ru/!lib/_js/De.js"></script>'; 						 // dement.ru

	echo		'<script type="text/javascript">';					// ������ :: drag&drop
	echo			'new deDragDrop(';			
	echo			'"deModalDialog",';								// ������ ������� ����� ��������������� 
	echo			'"deUpperLine"';								// ������ ��� ������� �� ������� ����� �������� ��������������
	echo			');';											// ������ �������� ��� ��� ����� ���� � ��� �� ������ - ������� �� �������������
	echo		'</script>';	


	echo		'<script type="text/javascript">';					// ����� :: ����������� ����
	echo			'new deShowDialog(';			
	echo			'"testLink",';			//***					// object 					������ � ������� ������� ������� ��������� ������������ ����	
	echo			'"click",';										// startEvent				������� ��� ������� ���������� ����������� ���� 				
	echo			'"UncoverUp",';								// 							������ ��������� ������� (MoveUp, MoveDown ... ) 
	echo			'"400px",';										// width dialog				������ ����
	echo			'"300px",';										// height dialog			������ ����	
	echo			'"#999999 solid 10px",';						// border dialog			������� ���� CSS 
	echo			'"100",';										// z-index dialog			������� ������� ����	
	echo			'"90",';										// opacity % dialog		    �������������� ����� ����  
	echo			'"200",';										// (��) effect speed  dialog     �������� ��������� ����
	echo			'"deModalDialog",';	//***						// dialog_id				id �������� ���� 									

	echo			'"<strong>��������� ����</strong>",';			// caption topLine			��������� ���� 
	echo			'"Verdana, Arial, Helvetica, sans-serif",';		// font-family topLine		��� ������ ��������� 
	echo			'"12px",';										// font-size topLine		������ ������ ���������	
	echo			'"#333333",';									// font-color topLne		���� ������ ��������� 
	echo			'"30px",';										// height topLne			������ ���������	
	echo			'"#dddddd",';									// background topLne		������ ��� ��������� 
	echo			'"center",';									// text-align topLine		������������ ������� ���������
	echo			'"deUpperLine",';	//***						// topLne_id				id ������ � ���������� 	

	echo			'"���������� ����������� ��� ���� ����� �� ������� ����� � ����������",';	// text content				���������� ������������ ����
	echo			'"Verdana, Arial, Helvetica, sans-serif",';		// font-family content		��� ������ ����� �����������
	echo			'"12px",';										// font-size content		������ ������ ����� �����������
	echo			'"#333333",';									// font-color content		���� ������ 
	echo			'"#ffffff",';									// background content		������ ��� 
	echo			'"left",';										// text-align content		������������� ������
	echo			'"deMainContent",';	//***						// content_id				id �������� � �������� ���������� 

	echo			'"FALSE",';										// ���������� �� ������ ���
	echo			'"#000000",';									// background backWall		���� ���� ������� ������������� ��� ������ ����. ���� �� ��� �� ����� �� ��������� none 
	echo			'"70",';										// opacity % backWall		�������������� ����� ����.  
	echo			'"deBackWall",';	//***						// backwall_id				id ���� � ���� ����� 	

	echo			'"TRUE",';										// ���������� ��� ��� ������ ������ � 
	echo			'"url(http://www.dement.ru/!lib/showModalDialog/img/btnClose.gif) no-repeat center",';	// ��� ������ ������
	echo			'"ClassButtonClose",';	//***					// ��������!!! ��� ����� ��� <span> ������ �������� ����� ������ ��� ������� �� ������� ����� ����������� ���� !!! 

	echo			'"10"';											// !!! (��) ����� �������� �� ������ ������� (��� ���������� ������ �������), ����� ��� ������� ������� �� �������� ������ �����������
	echo			');';											// <span class="btnClose"><a href="#close">������� ����</a></span>												
	echo		'</script>';			//*** - ���������� ��������� ��� ������������ ������������� ������� �� �������� 				





	echo	'</head>';
	echo	'<body>';
}


function finish() {

	echo	'</body>';
	echo	'</html>';

}


function action() { 


	echo	'<div id="idMainDiv">';
	echo		'��� �������� �������� ��� �������� ������ deDragDrop �� ����������� ���� (������ deShowDialog)<br><br>';
	echo		'<a id="testLink" href="#de">������� ���� ����� ������� ����������� ���� � �������� drag&drop</a>';
	echo	'</div>';

}


}




?>