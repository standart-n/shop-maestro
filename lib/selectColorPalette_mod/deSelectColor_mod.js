	//Dement.ru								// ������� ������ 
var deSelectColor_mod = jQuery.Class.create({		
	init: function(deParentDiv_id,				// ������������ ��� � ������� ��������� ���� HTML ��� 
				   deHover_visible,				// �������� ��� ��� ��� ����� 
				   dePalette_id				// id �������� ���� � �������� 
				   ){	

$(document).ready(function () {
																				// innerHTML
		deCode='<div id="'+dePalette_id+'">';  									// ������� ���
		deCode+='<span class="clCloseDlg"><a title="�������, ����� ������� ���� ����" href="#de"><div id="'+dePalette_id+'Block">';			// �������� � �������� 
		deCode+='</div></a></span>';
		
	if (deHover_visible=="TRUE") {												// ������ � ������ �� ������� ������ �����
		deCode+='<div id="'+dePalette_id+'Line">';
		deCode+='��������� ����';
		deCode+='</div>';
	}
		deCode+='<div id="'+dePalette_id+'Buttons">';								// ��� � �������� 
		deCode+='<input id="id'+dePalette_id+'Hover" size="10" name="nm'+dePalette_id+'Hover" type="hidden">';
		deCode+='<input id="id'+dePalette_id+'Click" size="10" name="nm'+dePalette_id+'Click" type="hidden">';
		deCode+='</div>';
		deCode+='</div>';
				
	deParentDiv=document.getElementById(deParentDiv_id);						// ��������� ��������������� ��� � �������� 
	deParentDiv.innerHTML=deParentDiv.innerHTML+deCode;
		
		deSelectColor_css(); 													// CSS 
		
});

																				// functions

$('#'+dePalette_id+'Block').live("mouseover", function(){

	deSelectColor_css(); 													// CSS 

	palette=$('#'+dePalette_id+'Block');
	showColor=$('#'+dePalette_id+'Line');

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
	   document.getElementById('id'+dePalette_id+'Hover').value=color; 				// ������� ��������
	
		});

});

$('#'+dePalette_id+'Block').live("click", function(){
																				// ��� ������� ����� ������ ����� ��������� �������� ������ 
   document.getElementById('id'+dePalette_id+'Click').value=document.getElementById('id'+dePalette_id+'Hover').value; 

});


function deSelectColor_css() {
	
	dePalette=$('#'+dePalette_id);												// ������� ���
	dePalette.css({'display': 'block'});		
	dePalette.css({'float': 'left'});
	dePalette.css({'width': '512px'});
	dePalette.css({'height': 'auto'});
	dePalette.css({'text-align': 'center'});
	dePalette.css({'background': '#ffffff'});
	
	dePalette=$('#'+dePalette_id+'Block');											// ��� � ��������� �������
	dePalette.css({'display': 'block'});
	dePalette.css({'float': 'left'});
	dePalette.css({'width': '512px'});
	dePalette.css({'height': '512px'});
	dePalette.css({'background': '#ffffff url(http://www.dement.ru/!lib/selectColorPalette/img/wheel.jpg) no-repeat center'});

	dePalette=$('#'+dePalette_id+'Line');												// ��� ��� �������� ���������� ���� �� ������� ������ ���������� ����
	dePalette.css({'font-family': 'Verdana, Arial, Helvetica, sans-serif'});
	dePalette.css({'font-size': '12px'});
	dePalette.css({'color': '#000000'});
	dePalette.css({'display': 'block'});
	dePalette.css({'float': 'left'});
	dePalette.css({'width': '512px'});
	dePalette.css({'clear': 'both'});
	dePalette.css({'line-height': '30px'});
	dePalette.css({'text-align': 'center'});

	dePalette=$('#'+dePalette_id+'Buttons');											// ��� � �������� � ������� ���������� ��������� ���� � ���� �� ������� ������ ������
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
									 




