// Dement.ru				 
										 
var deAddClassEvent = jQuery.Class.create({ 
										 
  init: function(deTarget_id,		// ������ �� ������� ������� ������� 	
				 deEvent,			// �������
				 deObject,			// ������
				 deClass			// �����
				 ){						 
										
  
$(document).ready(function () {		

  $('#'+deTarget_id).live(deEvent, function(){   	// ������� �������� 
															
	$(deObject).addClass(deClass);

  });														


  $('#'+deTarget_id).live("mouseover", function(e){  	

	$('#'+deTarget_id).css({'cursor': 'pointer'});		// ������ ������ ����

  });


});														

	return "Dement.ru";						
  }				// 2010 ��� "��������-�"


});	

