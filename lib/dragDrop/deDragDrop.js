	//Dement.ru										// ������ ��� �������� �� ����� ������������ ���� 
var deDragDrop = jQuery.Class.create({		
	init: function(deObject_id,			// ������� ������� ����� ������������ ����� �� �������� ����
				   deTarget_id			// ������ ��� ������� �� ������� ��������� ������ 
				   ){		

$(document).ready(function() {		

	deFlag="false"; 					// ������������� ���� 

});

$('#'+deTarget_id).live("mouseover", function(e){  	

	deFlag="false"; 									// �������� ���� ���� ������� ������� ����
	$('#'+deTarget_id).css({'cursor': 'move'});		// ������ ������ ����

});

$('#'+deTarget_id).live("click", function(e){  	

	deFlag="true"; 									// �������� ���� ���� ������� ������� ����

});

$('#'+deTarget_id).live("mousedown", function(e){  		// ��� ������� ������ ����	

	deObject=$('#'+deObject_id);						
	deLeft=deGetObjectPosition('#'+deObject_id).left;		// ���������� ��������� �������
	deTop=deGetObjectPosition('#'+deObject_id).top;

	deDeltaX=dePosition(e).x-deLeft;					// ����������� ������� �/� ����������� ���� � ���������� �������
	deDeltaY=dePosition(e).y-deTop;
	deFlag="true"; 										// ��������� ���� : �������������� �������� 			
	$('#'+deTarget_id).css({'cursor': 'move'});			// ������ ������ ����	



$('#'+deTarget_id).live("mousemove", function(e){		// ��� �������� �����
	
	if (deFlag=="true") {								// ���� ���� ������

		dePosX=dePosition(e).x-deDeltaX;				// ����������� ����� ���������� �������
		dePosY=dePosition(e).y-deDeltaY;	
		document.getElementById(deObject_id).style.left=dePosX + "px";	// ����������� ������
		document.getElementById(deObject_id).style.top=dePosY + "px";
		$('#'+deTarget_id).css({'cursor': 'move'});		// ������ ������ ����

	}

  }); 





});


	return "Dement.ru";
				// 2010  ��� "��������-�" 
	}
});
									 



