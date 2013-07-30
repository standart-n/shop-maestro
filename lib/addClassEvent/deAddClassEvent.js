// Dement.ru				 
										 
var deAddClassEvent = jQuery.Class.create({ 
										 
  init: function(deTarget_id,		// объект на который повесим событие 	
				 deEvent,			// событие
				 deObject,			// объект
				 deClass			// класс
				 ){						 
										
  
$(document).ready(function () {		

  $('#'+deTarget_id).live(deEvent, function(){   	// скрытие слайдера 
															
	$(deObject).addClass(deClass);

  });														


  $('#'+deTarget_id).live("mouseover", function(e){  	

	$('#'+deTarget_id).css({'cursor': 'pointer'});		// меняем курсор мыши

  });


});														

	return "Dement.ru";						
  }				// 2010 НВП "Стандарт-Н"


});	

