	//Dement.ru										// ������ ��� �������� �� ����� ������������ ���� 
var deShowDialog_mod = jQuery.Class.create({		
	init: function(deObject_id,								// ������, � ������� �������� ������� ������ ���������� ����
				   deStartEvent,							// ������� ��� ������� ������� ����������� ����
				   deEffect,								// ������ ��������� ����
				   deWidth,									//	������ ����
				   deHeight,								//	������ ����
				   deUpLine_caption,						//	��������� ����	
				   deContent_text,							//	����� ������ ����
				   deMDialog_zindex,						//	z-index ������� ����
				   deMDialog_id,							//	id �������� ���� ����
				   deTimeBefore     						//	����� �������� �� ������ �������
				   ){		
								// !!! ���������� ��������� ������ : deMDialog_id, deUpLine_id, deContent_id, deWall_id, debtnClose_class, deMDialog_zIndex 										
								// !!! ���� ������ �� �������� ������������ ��������� ��� �� ��� ��������� ������ ���� ���������� !!!  	
$(document).ready(function() {		

	deCode='<div id="'+deMDialog_id+'Dement"></div>'+
				'<div id="'+deMDialog_id+'wall"></div>'+							// ��������� � ��� �������� ��� � ������ ����� ������� ��� ������������� 
				'<div id="'+deMDialog_id+'">'+								// ������ ������ �������� � ����������� �����	
					'<div id="'+deMDialog_id+'upline">'+deUpLine_caption;			//	��������� ��� � ����������
		deCode+=				'<span class="clCloseDlg"><a class="deModalDialogbtnClose" href="#de"></a></span>'; 
	   deCode+=			'</div>'+											// ��������� � �������� ��� � ������� ����� �������� ���������� ����
					'<div id="'+deMDialog_id+'content">'+deContent_text+'</div>'+
				'</div>';  													// ��������� 
				
	document.body.innerHTML+=deCode;										// ��������� ��������������� ��� � �������� 	

	deShowDialog_css(); 													// ��������� ��� ������� ��������� ������� ������� ������� �����	

	deShowOpacitySharp('a.deModalDialogbtnClose',100);						//  �������������� ������ "�������" ( � ) ��� ��������� ����� 60% 

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
	deWall=$('#'+deMDialog_id+'wall');			

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


	deShowOpacitySharp('#'+deMDialog_id,90);					// ������������� �������������� ��� ������� ��������
	deShowOpacitySlow('#'+deMDialog_id+'wall',0,70,200);	// ������ ������� ��������� ������� ���� 
	deShowEffect('#'+deMDialog_id,deEffect,200);				// 	������ ������� ��������� ������������ ����

  });																		// � ����� ������� ��� �� �����

});

$('span.clCloseDlg a').live("click", function(){   				// ���� ������ �� ������ ����������� ���� ��������� ���� 

	deShowEffect('#'+deMDialog_id,deEffect,200);			// �������� ������ ������� ������ ������ ���� ���� 

	deShowOpacitySlow('#'+deMDialog_id+'wall',70,0,200);	// ������ ������� ��������� ������� ���� 

	$('#'+deMDialog_id+'Dement').animate({top: '1px'},200,"linear",function(){		// ������ �������� ����� ��������� ����� ���������� ��� �������
		deShowDialog_css();	
		});											// � ����� ������� ��� �� �����

});

$('a.deModalDialogbtnClose').live("mouseover", function(){   				// ����������� �������������� ������ ������� ��� ��������� �� ��� �����	

	deShowOpacitySlow('a.deModalDialogbtnClose',100,60,300);

});

$('a.deModalDialogbtnClose').live("mouseout", function(){   				// ��������� �������������� ������ ������� ���� ������ ���� ������ � ��� 	

	deShowOpacitySlow('a.deModalDialogbtnClose',60,100,300);

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
	deMDialog.css({'border': '#333333 solid 1px'});							
	deMDialog.css({'z-index': deMDialog_zindex});							// z-index ������������� �����������

	deUpLine=$('#'+deMDialog_id+'upline');											// ����� ��� ����� � ���������� 
	deUpLine.css({'font-family': 'Verdana, Arial, Helvetica, sans-serif'});		
	deUpLine.css({'font-size': '14px'});		
	deUpLine.css({'color': '#ffffff'});		
	deUpLine.css({'display': 'block'});		
	deUpLine.css({'float': 'left'});		
	deUpLine.css({'width': (deMDialog.width()-20)});		
	deUpLine.css({'line-height': '30px'});		
	//document.getElementById(deUpLine_id).offsetHeight=100;
	deUpLine.css({'padding': '0 10px 0 10px'});		
	deUpLine.css({'text-align': 'center'});		
	deUpLine.css({'background': '#003366'});		

	deContent=$('#'+deMDialog_id+'content');			
	deContent.css({'font-family': 'Verdana, Arial, Helvetica, sans-serif'});					// ����� ��� ���� � ������� ����� �����
	deContent.css({'font-size': '12px'});		
	deContent.css({'color': '#000000'});		
	deContent.css({'display': 'block'});		
	deContent.css({'float': 'left'});		
	deContent.css({'width': (deMDialog.width()-20)});		
	deContent.css({'height': deHeight});		
	//document.getElementById(deContent_id).offsetHeight=200;
	//deContent.width(deMDialog.width()-20);		
	//deContent.height(deHeight);		
	deContent.css({'padding': '10px 10px 10px 10px'});		
	deContent.css({'clear': 'both'});		
	deContent.css({'text-align': 'left'});		
	deContent.css({'background': '#ffffff'});		

	deWall=$('#'+deMDialog_id+'wall');												// ����� ��� ���� ������� ��������� � ��������� ���� ��������
	deWall.css({'position': 'absolute'});		
	deWall.css({'display': 'none'});		
	deWall.css({'float': 'left'});		
	deWall.css({'top': '0'});		
	deWall.css({'left': '0'});		
	deWall.css({'background': '#000000'});		
	deWall.css({'z-index': (deMDialog_zindex-1)});							// ��� �������� �� ��� ��� z-index ������ ������ ��� � ����� ��������
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
	deBtnClose.css({'background': 'url(http://www.dement.ru/!lib/showModalDialog_mod/img/btnClose.gif) no-repeat center'});		
	deBtnClose.css({'text-decoration': 'none'});		


}


	return "Dement.ru";
				// 2010  ��� "��������-�" 
	}
});
									 



