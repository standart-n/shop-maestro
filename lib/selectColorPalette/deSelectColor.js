	//Dement.ru								// ������� ������ 
var deSelectColor = jQuery.Class.create({		
	init: function(deParentDiv_id,				// ������������ ��� � ������� ��������� ���� HTML ��� 
				   deImagePath,					// ���� �� �������� � ��������
				   deHint,						// ����������� ��������� ��� ��������� ����� �� �������
				   deBackground,				// ������ ��� �������� ����, ����� �����
				   deBorder,					// ������� �������� ����  
				   deCaption,					// ����� �������� ���������, ��-��������� ������� ������
				   deCaption_visible,			// �������� ��� ��� ���� ��������� 
				   deCaption_height,			// ������ ����� ��������� 
				   deCaption_fontFamily,		// ����� ����� ���������	
				   deCaption_fontSize,			// ������ ������ ����� ���������
				   deCaption_color,				// ���� ������ ����� ��������� 
				   deHover,						// ����� ����� ������� ������������� ��������� ������, ��-��������� �������� ����  
				   deHover_visible,				// �������� ��� ��� ��� ����� 
				   deHover_height,				// ������ ���� ����� 
				   deHover_fontFamily,			// ����� ������ ���� ����� 
				   deHover_fontSize,			// ������ ������ ���� ����� 	
				   deHover_color,				// ���� ������ ���� ����� 
				   dePalette_id,				// ���� ������ ��������� ���������. ������� id �������� ���� � �������� 
				   deCaption_id,				// id ���� � ������� ���������� 
				   deHover_id,					// id ���� � ������� � �������� ���������� ��������������� ���� �� �������� ������ ����� 
				   deImagePalette_id,			// id ���� � ������� ������������ �������� 
				   deInputLine_id, 				// id ���� � ������� ������������ ������ 
				   deInputHoverColor_name,		// ��� ������ � ������� ������������ ���� �� ������� ������ 	
				   deInputHoverColor_id,		//  id ������ � ������� ������������ ���� �� ������� ������ 		
				   deInputClickColor_name,		// ��� ������ � ������� ������������ ���� ������� ������� 
				   deInputClickColor_id			//  id ������ � ������� ������������ ���� ������� �������
				   ){	
											// !!! ���������� ��������� ������ : deCaption_id, deHover_id, deImagePalette_id, deInputLine_id, 
											//			deInputHoverColor_name, deInputHoverColor_id, deInputClickColor_name, deInputClickColor_id 					
											// !!! ��� ������������ ������������� ������ �� �������� ��� ��������� ������ ���� ������ ��� ������� 	
$(document).ready(function () {
																				// innerHTML
		deCode='<div id="'+dePalette_id+'">';  									// ������� ���
	if (deCaption_visible=="TRUE") {											// ��������� 
		deCode+='<div id="'+deCaption_id+'">';
		deCode+=deCaption;
		deCode+='</div>';
	}
		deCode+='<div title="'+deHint+'" id="'+deImagePalette_id+'">';			// �������� � �������� 
		deCode+='</div>';
		
	if (deHover_visible=="TRUE") {												// ������ � ������ �� ������� ������ �����
		deCode+='<div id="'+deHover_id+'">';
		deCode+=deHover;
		deCode+='</div>';
	}
		deCode+='<div id="'+deInputLine_id+'">';								// ��� � �������� 
		deCode+='<input id="'+deInputHoverColor_id+'" size="10" name="'+deInputHoverColor_name+'" type="text">';
		deCode+='<input id="'+deInputClickColor_id+'" size="10" name="'+deInputClickColor_name+'" type="text">';
		deCode+='</div>';
		deCode+='</div>';
				
	deParentDiv=document.getElementById(deParentDiv_id);						// ��������� ��������������� ��� � �������� 
	deParentDiv.innerHTML=deParentDiv.innerHTML+deCode;
		
		deSelectColor_css(); 													// CSS 
		
});

																				// functions

$('#'+deImagePalette_id).live("mouseover", function(){

	deSelectColor_css(); 													// CSS 

	palette=$('#'+deImagePalette_id);
	showColor=$('#'+deHover_id);

	addary=new Array(255,1,1);
	clrary=new Array(360);														// ��������� ������ �������	
	for(i=0;i<6;i++) {
		for(j=0;j<60;j++) { 
			clrary[60*i+j]=new Array(3);
		    for(k=0;k<3;k++) { 
				clrary[60*i+j][k]=addary[k];
		       	addary[k]+=((Math.floor(65049010/Math.pow(3,i*3+k))%3)-1)*4; 
			 }; 
		};
	};

		palette.mousemove(function(e){
	
	   sx=(e.pageX-palette.offset().left)-256;
	   sy=(e.pageY-palette.offset().top)-256;

	   quad=new Array(-180,360,180,0);
	   xa=Math.abs(sx); ya=Math.abs(sy);
	   d=ya*45/xa;
	   if (ya>xa) { d=90-(xa*45/ya); }
	   deg=Math.floor(Math.abs(quad[2*((sy<0)?0:1)+((sx<0)?0:1)]-d))+15;   		// ��������� ���� ��������
	   if (deg>360) { deg-=360; }
	   n=0; c="000000";
	   r=Math.sqrt((xa*xa)+(ya*ya));

	   if(sx!=0 || sy!=0) {         											//  ��������� ���� 
	   	 for(i=0;i<3;i++) { 
		 	 r2=clrary[deg][i]*r/128;
	         if(r>128) r2+=Math.floor(r-128)*2;
	         if(r2>255) r2=255;
	         n=256*n+Math.floor(r2); 
		  };
	      c=(n.toString(16)).toUpperCase();
		  while(c.length<6) c="0"+c;       										// ���� ���� ����� ����� ��������� �� ������� �� 6��
	   };
	   

	   color="#"+c;   
	   showColor.css({'background': color });    								// ������ ���
	   document.getElementById(deInputHoverColor_id).value=color; 				// ������� ��������
	
		});

});

$('#'+deImagePalette_id).live("click", function(){
																				// ��� ������� ����� ������ ����� ��������� �������� ������ 
   document.getElementById(deInputClickColor_id).value=document.getElementById(deInputHoverColor_id).value; 

});


function deSelectColor_css() {
	
	dePalette=$('#'+dePalette_id);												// ������� ���
	dePalette.css({'display': 'block'});		
	dePalette.css({'float': 'left'});
	dePalette.css({'width': '512px'});
	dePalette.css({'height': 'auto'});
	dePalette.css({'text-align': 'center'});
	dePalette.css({'background': deBackground});
	dePalette.css({'border': deBorder});

	dePalette=$('#'+deImagePalette_id);											// ��� � ��������� �������
	dePalette.css({'display': 'block'});
	dePalette.css({'float': 'left'});
	dePalette.css({'width': '512px'});
	dePalette.css({'height': '512px'});
	dePalette.css({'background': '#ffffff url('+deImagePath+') no-repeat center'});

	dePalette=$('#'+deCaption_id);												//  ��� � ���������� ("������� ������")
	dePalette.css({'font-family': deCaption_fontFamily});
	dePalette.css({'font-size': deCaption_fontSize});
	dePalette.css({'color': deCaption_color});
	dePalette.css({'display': 'block'});
	dePalette.css({'float': 'left'});
	dePalette.css({'width': '512px'});
	dePalette.css({'clear': 'both'});
	dePalette.css({'line-height': deCaption_height});
	dePalette.css({'text-align': 'center'});

	dePalette=$('#'+deHover_id);												// ��� ��� �������� ���������� ���� �� ������� ������ ���������� ����
	dePalette.css({'font-family': deHover_fontFamily});
	dePalette.css({'font-size': deHover_fontSize});
	dePalette.css({'color': deHover_color});
	dePalette.css({'display': 'block'});
	dePalette.css({'float': 'left'});
	dePalette.css({'width': '512px'});
	dePalette.css({'clear': 'both'});
	dePalette.css({'line-height': deHover_height});
	dePalette.css({'text-align': 'center'});

	dePalette=$('#'+deInputLine_id);											// ��� � �������� � ������� ���������� ��������� ���� � ���� �� ������� ������ ������
	dePalette.css({'display': 'block'});
	dePalette.css({'float': 'left'});
	dePalette.css({'width': '512px'});
	dePalette.css({'clear': 'both'});
	dePalette.css({'text-align': 'center'});

}

	return "Dement.ru";
					// 2010 ��� "��������-�"
	}
});
									 




