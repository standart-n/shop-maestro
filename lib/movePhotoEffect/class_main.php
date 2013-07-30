<?php

class main {

function head() {

	echo	'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	echo	'<html xmlns="http://www.w3.org/1999/xhtml">';
	echo	'<head>';
	echo		'<title>Dement.ru :: Перемещение фотографии внутри блока</title>';												
	echo		'<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />';								
   	echo		'<meta http-equiv="Content-Language" content="ru" />';
   	echo		'<meta name="robots" content="all" />';
	echo		'<meta name="Copyright" Lang="ru" content="2010 НВП Стандарт-Н">';
	echo		'<meta name="Document-state" content="Dynamic">';
	echo		'<meta name="Revesit" content="7">';
   	echo		'<meta name="description" content="Dement.ru - записки разработчиков компании НВП Стандарт-Н, веб-студия :: срипты, уроки, советы, модули, исходные коды, программирование, вебмастеру" />';
   	echo		'<meta name="keywords" content="демент, дизайн, веб-студия, скрипты, уроки, сайты, дизайн, верстка, программирование, фриланс,
											dement, web, internet, css, mysql, ajax, html, php, js, javascript, functions, script, code, design" />';

	echo		'<link	 href="http://www.dement.ru/img/favico.ico" rel="shortcut icon" type="image/x-icon" />';
	echo		'<link   href="style_main.css"  rel="stylesheet"   type="text/css">'; 									

	echo		'<script type="text/javascript" src="http://www.dement.ru/!lib/_js/De.js"></script>';  						 // библиотека dement.ru

													
	echo		'<script type="text/javascript">';					
	echo			'new dePhotoEffect(';							
	echo			'"idMainDiv",';										// id дива в который будет вставлена оболочка с увеличенным просмотром
	echo			'"http://www.dement.ru/!lib/_img/bridge_full.jpg",'; // путь к файлу картинки с увеличенным просмотром 
	echo			'"mousedown",';											// событие с которого начинается движение картинки
	echo			'"mouseup",';											// событие после которого заканчивается перемещение
	echo			'"200",';												// начальный горизонтальный скролл
	echo			'"200",';												// начальный вертикальный скролл
	echo			'"1600px",';											// css WIDTH ширина окна с увеличенным просмотром 
	echo			'"1067px",';											// css HEIGHT высота окна с увеличенным просмотром 
	echo			'"FALSE",';												// возвращать или нет начальный скролл по окончании перемещения
	echo			'"9",';													// css Z_INDEX		
	echo			'"deMovePhotoEffect_1"';		//***				//  id DIV блока с увеличенным просмотрам (выведено для многократного использования скрипта и для доп. функций) 
	echo			');';							//***  параметры, которые должны быть уникальными при многократном использовании скрипта	
	echo		'</script>';			

	echo		'<script type="text/javascript">';					
	echo			'new dePhotoEffect(';							
	echo			'"idMainDiv2",';										// id дива в который будет вставлена оболочка с увеличенным просмотром
	echo			'"http://www.dement.ru/!lib/_img/kanal_full.jpg",'; // путь к файлу картинки с увеличенным просмотром 
	echo			'"mouseover",';											// событие с которого начинается движение картинки
	echo			'"mouseout",';											// событие после которого заканчивается перемещение
	echo			'"200",';												// начальный горизонтальный скролл
	echo			'"200",';												// начальный вертикальный скролл
	echo			'"1600px",';											// css WIDTH ширина окна с увеличенным просмотром 
	echo			'"1067px",';											// css HEIGHT высота окна с увеличенным просмотром 
	echo			'"FALSE",';												// возвращать или нет начальный скролл по окончании перемещения
	echo			'"9",';													// css Z_INDEX		
	echo			'"deMovePhotoEffect_2"';		//***				//  id DIV блока с увеличенным просмотрам (выведено для многократного использования скрипта и для доп. функций) 
	echo			');';							//***  параметры, которые должны быть уникальными при многократном использовании скрипта	
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
	echo	'</div>';
	echo	'<div id="idMainDiv2">';
	echo	'</div>';
}


}




?>