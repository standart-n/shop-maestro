	//Dement.ru										// ������ ��� �������� �� ����� ������������ ���� 
var deShowDialog = jQuery.Class.create({		
	init: function(deObject_id,								// ������, � ������� �������� ������� ������ ���������� ����
				   deStartEvent,							// ������� ��� ������� ������� ����������� ����
				   deEffect,								// ������ ��������� ����
				   deWidth,									//	������ ����
				   deHeight,								//	������ ����
				   deMDialog_border,						//  ����� ������� ����	
				   deMDialog_zIndex,						//	z-index ������� ����
				   deMDialog_opacity,						//	�������������� ����
				   deSpeed,									//	�������� �������� �������
				   deMDialog_id,							//	id �������� ���� ����
				   deUpLine_caption,						//	��������� ����	
				   deUpLine_fontFamily,						//	�����	
				   deUpLine_fontSize,						//	������ ������
				   deUpLine_fontColor,						//	���� ������
				   deUpLine_height,							//	������ ����� ���������
				   deUpLine_background,						//	������ ��� ���������
				   deUpLine_textAlign,						//	������������� ���������
				   deUpLine_id,								//	id ����� � ����������
				   deContent_text,							//	����� ������ ����
				   deContent_fontFamily,					//	����� ����� ������
				   deContent_fontSize,						//	������ ������
				   deContent_fontColor,						//	���� ������
				   deContent_background,					//  ������ ��� �������� � ��������
				   deContent_textAlign,						//	������������ ����� ������	
				   deContent_id,							//	id ���� � �������
				   deWall_visible,							//	��� ������� ��� ������������� ������ ������������ ����
				   deWall_background,						//	��� ������� ��� ������������� ������ ������������ ����
				   deWall_opacity,							//	�������������� ����� ����
				   deWall_id,								//	id ���� c ���� ����� 
				   debtnClose_vsbl,							//	�������� ��� ��� ������ ��� ������� �� ������� ��������� ���� 
				   debtnClose_background,					//	CSS ��� ���� ������
				   debtnClose_class,						//	�������� ����� ������, ��� ������� �� ������� ����� ����������� ����
				   deTimeBefore     						//	����� �������� �� ������ �������
				   ){		
								// !!! ���������� ��������� ������ : deMDialog_id, deUpLine_id, deContent_id, deWall_id, debtnClose_class, deMDialog_zIndex 										
								// !!! ���� ������ �� �������� ������������ ��������� ��� �� ��� ��������� ������ ���� ���������� !!!  	
$(document).ready(function() {		

	deCode='<div id="'+deMDialog_id+'Dement"></div>'+
				'<div id="'+deWall_id+'"></div>'+							// ��������� � ��� �������� ��� � ������ ����� ������� ��� ������������� 
				'<div id="'+deMDialog_id+'">'+								// ������ ������ �������� � ����������� �����	
					'<div id="'+deUpLine_id+'">'+deUpLine_caption;			//	��������� ��� � ����������
	if (debtnClose_vsbl=="TRUE") {											// � ����������� �� ��������� ��������� ������ ��� ������� ��������� ��� ���� 
		deCode+=				'<span class="'+debtnClose_class+'"><a class="deModalDialogbtnClose" href="#de"></a></span>'; 
	}
	deCode+=			'</div>'+											// ��������� � �������� ��� � ������� ����� �������� ���������� ����
					'<div id="'+deContent_id+'">'+deContent_text+'</div>'+
				'</div>';  													// ��������� 
				
	document.body.innerHTML+=deCode;										// ��������� ��������������� ��� � �������� 	

	deShowDialog_css(); 													// ��������� ��� ������� ��������� ������� ������� ������� �����	

	/*deShowOpacitySharp('#'+deWall_id,0);*/
	deShowOpacitySharp('a.deModalDialogbtnClose',60);						//  �������������� ������ "�������" ( � ) ��� ��������� ����� 60% 

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
	deWall=$('#'+deWall_id);			

	deMDialog.css({'display': 'none'});		
	deWall.css({'display': 'none'});		

	deMDialogHeight=deMDialog.height();										// ���������� �������� ����, ����� ��� ��������� � ������ ������	
	deMDialogWidth=deMDialog.width();
	deMDialogTop=(screenHeight-deMDialogHeight)/2+scrollTop;
	deMDialogLeft=(screenWidth-deMDialogWidth)/2+scrollLeft;
	
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
	
	deWallHeight=screenHeight+scrollTop;
	deWallWidth=screenWidth+scrollLeft;										// ���������� ��� ��� ����� ����� ���� ����������

	deWall.width(documentWidth);		
	deWall.height(documentHeight);		


	deShowOpacitySharp('#'+deMDialog_id,deMDialog_opacity);					// ������������� �������������� ��� ������� ��������
	if (deWall_visible=="TRUE") {
		/*deShowOpacitySharp('#'+deWall_id,50);*/	// ������ ������� ��������� ������� ���� 
		deShowOpacitySlow('#'+deWall_id,0,deWall_opacity,1);	// ������ ������� ��������� ������� ���� 
	}
	deShowEffect('#'+deMDialog_id,deEffect,deSpeed);				// 	������ ������� ��������� ������������ ����

  });																		// � ����� ������� ��� �� �����

});

$('span.'+debtnClose_class+' a').live("click", function(){   				// ���� ������ �� ������ ����������� ���� ��������� ���� 

	deShowEffect('#'+deMDialog_id,deEffect,deSpeed);			// �������� ������ ������� ������ ������ ���� ���� 

	if (deWall_visible=="TRUE") {
		/*deShowOpacitySharp('#'+deWall_id,0);*/		// ������ ������� ��������� ������� ���� 
		deShowOpacitySlow('#'+deWall_id,deWall_opacity,0,1);	// ������ ������� ��������� ������� ���� 
	}


	$('#'+deMDialog_id+'Dement').animate({top: '1px'},deSpeed,"linear",function(){		// ������ �������� ����� ��������� ����� ���������� ��� �������
		deShowDialog_css();	
		});											// � ����� ������� ��� �� �����

});

$('a.deModalDialogbtnClose').live("mouseover", function(){   				// ����������� �������������� ������ ������� ��� ��������� �� ��� �����	

	deShowOpacitySlow('a.deModalDialogbtnClose',60,100,300);

});

$('a.deModalDialogbtnClose').live("mouseout", function(){   				// ��������� �������������� ������ ������� ���� ������ ���� ������ � ��� 	

	deShowOpacitySlow('a.deModalDialogbtnClose',100,60,300);

});



function deShowDialog_css() {
							// CSS 											// ����������� �����
	deMDialog=$('#'+deMDialog_id);											// ����� ��� �������� ����
	deMDialog.css({'position': 'absolute'});		
	deMDialog.css({'display': 'none'});		
	deMDialog.css({'float': 'left'});		
	deMDialog.css({'top': '0'});		
	deMDialog.css({'left': '0'});		
	deMDialog.css({'width': deWidth});		
	deMDialog.css({'height': 'auto'});										// ������ ������������ �������. ( ����� ������ �������.+�������� ����)
	deMDialog.css({'border': deMDialog_border});							
	deMDialog.css({'z-index': deMDialog_zIndex});							// z-index ������������� �����������

	deUpLine=$('#'+deUpLine_id);											// ����� ��� ����� � ���������� 
	deUpLine.css({'font-family': deUpLine_fontFamily});		
	deUpLine.css({'font-size': deUpLine_fontSize});		
	deUpLine.css({'color': deUpLine_fontColor});		
	deUpLine.css({'display': 'block'});		
	deUpLine.css({'float': 'left'});		
	deUpLine.css({'width': (deMDialog.width()-20)});		
	deUpLine.css({'line-height': deUpLine_height});		
	deUpLine.height(deUpLine_height);		
	//document.getElementById(deUpLine_id).offsetHeight=100;
	deUpLine.css({'padding': '0 10px 0 10px'});		
	deUpLine.css({'text-align': deUpLine_textAlign});		
	deUpLine.css({'background': deUpLine_background});		

	deContent=$('#'+deContent_id);			
	deContent.css({'font-family': deContent_fontFamily});					// ����� ��� ���� � ������� ����� �����
	deContent.css({'font-size': deContent_fontSize});		
	deContent.css({'color': deContent_fontColor});		
	deContent.css({'display': 'block'});		
	deContent.css({'float': 'left'});		
	deContent.css({'width': (deMDialog.width()-20)});		
	deContent.css({'height': deHeight});		
	//document.getElementById(deContent_id).offsetHeight=200;
	//deContent.width(deMDialog.width()-20);		
	//deContent.height(deHeight);		
	deContent.css({'padding': '10px 10px 10px 10px'});		
	deContent.css({'clear': 'both'});		
	deContent.css({'text-align': deContent_textAlign});		
	deContent.css({'background': deContent_background});		

	deWall=$('#'+deWall_id);												// ����� ��� ���� ������� ��������� � ��������� ���� ��������
	deWall.css({'position': 'absolute'});		
	deWall.css({'display': 'none'});		
	deWall.css({'float': 'left'});		
	deWall.css({'top': '0'});		
	deWall.css({'left': '0'});		
//	deWall.css({'width': deGetDocumentSize().width});		
//	deWall.css({'height': deGetDocumentSize().height});		
	deWall.css({'background': deWall_background});		
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
	deBtnClose.css({'background': debtnClose_background});		
	deBtnClose.css({'text-decoration': 'none'});		


}


	return "Dement.ru";
				// 2010  ��� "��������-�" 
	}
});
									 



