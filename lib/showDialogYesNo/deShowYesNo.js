	//Dement.ru										// ������ ��� �������� �� ����� ������������ ���� 
var deShowYesNo = jQuery.Class.create({		
	init: function(deObject_id,								// ������, � ������� �������� ������� ������ ���������� ����
				   deStartEvent,							// ������� ��� ������� ������� ����������� ����
				   deUpLine_caption,						//	��������� ����	
				   deContent_text,							//	����� ������ ����
				   deButtonYes,								//	�������� ������ ��
				   deLinkYes,								// 	������ ������ ��
				   deFunctionYes,							//	������� ������ ��
				   deButtonNo,								//	�������� ������ ���
				   deLinkNo,								// 	������ ������ ���	
				   deFunctionNo,							//	������� ������ ���
				   deMDialog_id,							//	id �������� ���� ����
				   deMDialog_zIndex,						//	z-index ������� ����
				   deTimeBefore     						//	����� �������� �� ������ �������
				   ){		
								// !!! ���������� ��������� ������ : deMDialog_id, deUpLine_id, deContent_id, deWall_id, debtnClose_class, deMDialog_zIndex 										
								// !!! ���� ������ �� �������� ������������ ��������� ��� �� ��� ��������� ������ ���� ���������� !!!  	
$(document).ready(function() {		

	deCode='<div id="'+deMDialog_id+'Dement"></div>'+
				'<div id="'+deMDialog_id+'Wall"></div>'+							// ��������� � ��� �������� ��� � ������ ����� ������� ��� ������������� 
				'<div id="'+deMDialog_id+'">'+								// ������ ������ �������� � ����������� �����	
					'<div id="'+deMDialog_id+'Upline">'+deUpLine_caption+'</div>';			//	��������� ��� � ����������
			//deCode+='<span class="deClassButtonClose"><a class="deModalDialogbtnClose" href="#de"></a></span>'; 
			//	deCode+='</div>'+									
			deCode+='<div id="'+deMDialog_id+'Content">'+deContent_text+'</div>'+
					'<div id="'+deMDialog_id+'BtnLine">'+
						'<span class="deClassButtonClose"><a class="deModalDialogbtnAskYes" onClick="'+deFunctionYes+'" href="'+deLinkYes+'">'+deButtonYes+'</a></span>'+
						'<span class="deClassButtonClose"><a class="deModalDialogbtnAskNo" onClick="'+deFunctionNo+'" href="'+deLinkNo+'">'+deButtonNo+'</a></span>'+
					'</div>'+
				'</div>';  													// ��������� 
				
	document.body.innerHTML+=deCode;										// ��������� ��������������� ��� � �������� 	

	deShowDialog_css(); 													// ��������� ��� ������� ��������� ������� ������� ������� �����	

	deShowOpacitySharp('a.deModalDialogbtnClose',100);	
	deShowOpacitySharp('a.deModalDialogbtnAskYes',100);	
	deShowOpacitySharp('a.deModalDialogbtnAskNo',100);	

});

$('#'+deObject_id).live(deStartEvent, function(){   						// ���� �� �������� ������� ��������� ����������� ������� �� ���������� ������� ���� ����

  $('#'+deMDialog_id+'Dement').animate({top: '1px'},deTimeBefore,"linear",function(){		// ������ �������� ����� ��������� ����� ���������� ��� ���������� ������� �� ��������

	deShowDialog_css();

	documentHeight=deGetDocumentSize().height;								// ������ ����� ���������
	documentWidth=deGetDocumentSize().width;								// ������ ����� ���������
																			
	screenHeight=deGetScreenSize().height; 									// ������ ������� ������� ���������	
	screenWidth=deGetScreenSize().width; 									// ������ ������ �������
	
	scrollTop=deGetScrollSize().top; 										// ������� �������� �������� �������
	scrollLeft=deGetScrollSize().left; 

	deMDialog=$('#'+deMDialog_id);											// ��������� ������� 
	deWall=$('#'+deMDialog_id+'Wall');			

	deMDialog.css({'display': 'none'});		
	deWall.css({'display': 'none'});		

	deMDialogHeight=deMDialog.height();										// ���������� �������� ����, ����� ��� ��������� � ������ ������	
	deMDialogWidth=deMDialog.width();
	deMDialogTop=(screenHeight-deMDialogHeight)/2+scrollTop-100;
	deMDialogLeft=(screenWidth-deMDialogWidth)/2+scrollLeft;
	
	deMDialog.css({'top': deMDialogTop});	
	deMDialog.css({'left': deMDialogLeft});		
	
    if (deMDialogTop>0) {
        if ((deMDialogHeight+deMDialogTop)<(documentHeight+100)) {
            deMDialog.css({'top': deMDialogTop});	
        } else {
            deMDialog.css({'top': '50px'});	
        }
    } else {
            deMDialog.css({'top': '100px'});	
    }    

    if (deMDialogLeft>0) {
        if ((deMDialogWidth+deMDialogLeft)<(documentWidth+100)) {
            deMDialog.css({'left': deMDialogLeft});	
        } else {
            deMDialog.css({'left': '50px'});	
        }
    } else {
            deMDialog.css({'left': '100px'});	
    }    

	deWall.width(documentWidth);		
	deWall.height(documentHeight);		


	//deShowOpacitySharp('#'+deMDialog_id,90);					// ������������� �������������� ��� ������� ��������
	deShowOpacitySlow('#'+deMDialog_id+'Wall',0,70,170);	// ������ ������� ��������� ������� ���� 
	deShowEffect('#'+deMDialog_id,'OpacityEffect',170);				// 	������ ������� ��������� ������������ ����

  });																		// � ����� ������� ��� �� �����

});

$('span.deClassButtonClose a').live("click", function(){   				// ���� ������ �� ������ ����������� ���� ��������� ���� 

	deShowEffect('#'+deMDialog_id,'OpacityEffect',170);			// �������� ������ ������� ������ ������ ���� ���� 

	deShowOpacitySlow('#'+deMDialog_id+'Wall',70,0,170);	// ������ ������� ��������� ������� ���� 


	$('#'+deMDialog_id+'Dement').animate({top: '1px'},170,"linear",function(){		// ������ �������� ����� ��������� ����� ���������� ��� �������
		deShowDialog_css();	
		});											// � ����� ������� ��� �� �����

});

$('a.deModalDialogbtnClose').live("mouseover", function(){

	deShowOpacitySlow('a.deModalDialogbtnClose',100,60,300);

});

$('a.deModalDialogbtnClose').live("mouseout", function(){ 

	deShowOpacitySlow('a.deModalDialogbtnClose',60,100,300);

});


$('a.deModalDialogbtnAskYes').live("mouseover", function(){  

	deShowOpacitySlow('a.deModalDialogbtnAskYes',100,60,300);

});

$('a.deModalDialogbtnAskYes').live("mouseout", function(){   

	deShowOpacitySlow('a.deModalDialogbtnAskYes',60,100,300);

});

$('a.deModalDialogbtnAskNo').live("mouseover", function(){  

	deShowOpacitySlow('a.deModalDialogbtnAskNo',100,60,300);

});

$('a.deModalDialogbtnAskNo').live("mouseout", function(){   

	deShowOpacitySlow('a.deModalDialogbtnAskNo',60,100,300);

});



function deShowDialog_css() {
							// CSS 											// ����������� �����
	deMDialog=$('#'+deMDialog_id);											// ����� ��� �������� ����
	deMDialog.css({'position': 'absolute'});		
	deMDialog.css({'display': 'none'});		
	deMDialog.css({'float': 'left'});		
	deMDialog.css({'top': '0'});		
	deMDialog.css({'left': '0'});		
	deMDialog.css({'width': '300px'});		
	deMDialog.css({'height': 'auto'});										// ������ ������������ �������. ( ����� ������ �������.+�������� ����)
	deMDialog.css({'border': '#333333 solid 1px'});							
	deMDialog.css({'z-index': deMDialog_zIndex});							// z-index ������������� �����������

	deUpLine=$('#'+deMDialog_id+'Upline');											// ����� ��� ����� � ���������� 
	deUpLine.css({'font-family':'Verdana, Arial, Helvetica, sans-serif'});		
	deUpLine.css({'font-size':'12px'});		
	deUpLine.css({'color':'#ffffff'});		
	deUpLine.css({'display': 'block'});		
	deUpLine.css({'float': 'left'});		
	deUpLine.css({'width': '280px'});		
	deUpLine.css({'line-height': '30px'});		
	deUpLine.height('30px');		
	//document.getElementById(deUpLine_id).offsetHeight=100;
	deUpLine.css({'padding': '0 10px 0 10px'});		
	deUpLine.css({'text-align':'center'});		
	deUpLine.css({'background':'#003366'});		

	deContent=$('#'+deMDialog_id+'Content');			
	deContent.css({'font-family':'Verdana, Arial, Helvetica, sans-serif'});					// ����� ��� ���� � ������� ����� �����
	deContent.css({'font-size':'10px'});		
	deContent.css({'color':'#000000'});		
	deContent.css({'display': 'block'});		
	deContent.css({'float': 'left'});		
	deContent.css({'width': '280px'});		
	deContent.css({'height':'auto'});		
	deContent.css({'padding': '10px 10px 10px 10px'});		
	deContent.css({'clear': 'both'});		
	deContent.css({'text-align':'left'});		
	deContent.css({'background':'#ffffff'});		

	deContent=$('#'+deMDialog_id+'BtnLine');			
	deContent.css({'font-family':'Verdana, Arial, Helvetica, sans-serif'});					// ����� ��� ���� � ������� ����� �����
	deContent.css({'font-size':'10px'});		
	deContent.css({'color':'#000000'});		
	deContent.css({'display': 'block'});		
	deContent.css({'float': 'left'});		
	deContent.css({'width': '280px'});		
	deContent.css({'height':'auto'});		
	deContent.css({'padding': '10px 10px 10px 10px'});		
	deContent.css({'clear': 'both'});		
	deContent.css({'text-align':'center'});		
	deContent.css({'background':'#ffffff'});		

	deWall=$('#'+deMDialog_id+'Wall');												// ����� ��� ���� ������� ��������� � ��������� ���� ��������
	deWall.css({'position': 'absolute'});		
	deWall.css({'display': 'none'});		
	deWall.css({'float': 'left'});		
	deWall.css({'top': '0'});		
	deWall.css({'left': '0'});		
	deWall.css({'background':'#000000'});		
	deWall.css({'z-index': (deMDialog_zIndex-1)});							// ��� �������� �� ��� ��� z-index ������ ������ ��� � ����� ��������
	deWall.height(deGetDocumentSize().height);
	deWall.width(deGetDocumentSize().width);
	
	deBtnClose=$('a.deModalDialogbtnClose');								// ����� ��� ������ "�������" 
	deBtnClose.css({'position': 'absolute'});		
	deBtnClose.css({'display': 'block'});		
	deBtnClose.css({'float': 'left'});		
	deBtnClose.css({'top': '8px'});		
	deBtnClose.css({'right': '10px'});		
	deBtnClose.css({'width': '16px'});		
	deBtnClose.css({'height': '16px'});		
	deBtnClose.css({'background':'url(http://www.dement.ru/!lib/showModalDialog/img/btnClose.gif) no-repeat center'});		
	deBtnClose.css({'text-decoration': 'none'});		

	deBtnClose=$('a.deModalDialogbtnAskYes');								// ����� ��� ������ "�������" 
	deBtnClose.css({'display': 'block'});		
	deBtnClose.css({'float': 'left'});		
	deBtnClose.css({'width': '120px'});		
	deBtnClose.css({'color': '#000000'});	
	deBtnClose.css({'height': '20px'});	
	deBtnClose.css({'line-height': '20px'});	
	deBtnClose.css({'margin': '5px'});	
	deBtnClose.css({'background':'#cccccc'});		
	deBtnClose.css({'border':'#666666 solid 1px'});		
	deBtnClose.css({'text-decoration': 'none'});		
	deBtnClose.css({'text-align': 'center'});		

	deBtnClose=$('a.deModalDialogbtnAskNo');								// ����� ��� ������ "�������" 
	deBtnClose.css({'display': 'block'});		
	deBtnClose.css({'float': 'left'});		
	deBtnClose.css({'width': '120px'});		
	deBtnClose.css({'color': '#000000'});	
	deBtnClose.css({'height': '20px'});	
	deBtnClose.css({'line-height': '20px'});	
	deBtnClose.css({'margin': '5px'});	
	deBtnClose.css({'background':'#cccccc'});		
	deBtnClose.css({'border':'#666666 solid 1px'});		
	deBtnClose.css({'text-decoration': 'none'});		
	deBtnClose.css({'text-align': 'center'});		


}


	return "Dement.ru";
				// 2010  ��� "��������-�" 
	}
});
									 



