	//Dement.ru										// ������ ��� �������� �� ����� ������������ ���� 
var deShowEasyDialog = jQuery.Class.create({		
	init: function(deObject_id,								// ������, � ������� �������� ������� ������ ���������� ����
				   deStartEvent,							// ������� ��� ������� ������� ����������� ����
				   deWidth,									//	������ ����
				   deContent_text,							//	����� ������ ����
				   deMDialog_zindex,						//	z-index ������� ����
				   deMDialog_id,							//	id �������� ���� ����
                   deCloseClass,                                 //  ������ ��� ������� �� ������� ����� ����������� ������� ����                       
				   deTimeBefore     						//	����� �������� �� ������ �������
				   ){		
								 										
								  	
$(document).ready(function() {		

	deCode='<div id="'+deMDialog_id+'Dement"></div>'+
				'<div id="'+deMDialog_id+'">'+								// ������ ������ �������� � ����������� �����	
    				'<div id="'+deMDialog_id+'Line">'+
                        '<span class="'+deCloseClass+'">'+
                            '<a title="�������" id="'+deMDialog_id+'Close" href="#de">x</a>'+
                        '</span>'+
                    '</div>'+		
					'<div id="'+deMDialog_id+'content">'+deContent_text+'</div>'+
				'</div>';  													// ��������� 
				
	document.body.innerHTML+=deCode;										// ��������� ��������������� ��� � �������� 	

	deEasyDialog_css(); 													// ��������� ��� ������� ��������� ������� ������� ������� �����	


});

$('#'+deObject_id).live(deStartEvent, function(){   						// ���� �� �������� ������� ��������� ����������� ������� �� ���������� ������� ���� ����

  $('#'+deMDialog_id+'Dement').animate({top: '1px'},deTimeBefore,"linear",function(){		// ������ �������� ����� ��������� ����� ���������� ��� ���������� ������� �� ��������

	deEasyDialog_css();


	deMDialog=$('#'+deMDialog_id);											// ��������� ������� 
	deMDialog.css({'display': 'none'});		

	deMDialogTop=100;
	deMDialogLeft=100;

	deShowOpacitySharp('#'+deMDialog_id,100);					// ������������� �������������� ��� ������� ��������
	deShowEffect('#'+deMDialog_id,"SharpEffect",200);				// 	������ ������� ��������� ������������ ����

  });																		// � ����� ������� ��� �� �����

});

$('.'+deCloseClass+' a').live("click", function(){   				// ���� ������ �� ������ ����������� ���� ��������� ���� 

	deShowEffect('#'+deMDialog_id,"SharpEffect",200);			// �������� ������ ������� ������ ������ ���� ���� 

	//$('#'+deMDialog_id+'Dement').animate({top: '1px'},200,"linear",function(){		// ������ �������� ����� ��������� ����� ���������� ��� �������
		deEasyDialog_css();	
	//});											// � ����� ������� ��� �� �����

});




function deEasyDialog_css() {
							// CSS 											// ����������� �����
	deMDialog=$('#'+deMDialog_id);											// ����� ��� �������� ����
	deMDialog.css({'position': 'absolute'});		
	deMDialog.css({'display': 'none'});		
	deMDialog.css({'float': 'left'});		
	deMDialog.css({'width': deWidth});		
	deMDialog.css({'height': 'auto'});										// ������ ������������ �������. ( ����� ������ �������.+�������� ����)
	deMDialog.css({'border': '#999999 solid 1px'});							
	deMDialog.css({'z-index': deMDialog_zindex});							// z-index ������������� �����������
	deMDialog.css({'background': '#ffffff'});		

	deContent=$('#'+deMDialog_id+'content');			
	deContent.css({'font-family': 'Verdana, Arial, Helvetica, sans-serif'});					// ����� ��� ���� � ������� ����� �����
	deContent.css({'font-size': '12px'});		
	deContent.css({'color': '#000000'});		
	deContent.css({'display': 'block'});		
	deContent.css({'float': 'left'});		
	deContent.css({'width': (deMDialog.width()-4)});		
	deContent.css({'height': 'auto'});		
	deContent.css({'padding': '2px'});		
	deContent.css({'clear': 'both'});		
	deContent.css({'text-align': 'left'});		

	deLine=$('#'+deMDialog_id+'Line');			
	deLine.css({'display': 'block'});		
	deLine.css({'float': 'left'});		
	deLine.css({'width': (deMDialog.width()-4)});		
	deLine.css({'height': '15px'});		
	deLine.css({'clear': 'both'});		

	deClose=$('#'+deMDialog_id+'Close');			
	deClose.css({'font-family': 'Verdana, Arial, Helvetica, sans-serif'});
	deClose.css({'font-weight': 'bold'});
	deClose.css({'font-size': 'small'});
	deClose.css({'display': 'block'});		
	deClose.css({'float': 'right'});		
	deClose.css({'color': '#666699'});		
	deClose.css({'text-decoration': 'none'});		

}


	return "Dement.ru";
				// 2010  ��� "��������-�" 
	}
});
									 



