function deShowEffect(object,effect,speed) {
	if (effect=="MovingUp") { deShowMovingUp(object,speed); }				
	if (effect=="MovingLeft") { deShowMovingLeft(object,speed); }
	if (effect=="MovingRight") { deShowMovingRight(object,speed); }
	if (effect=="MovingDown") { deShowMovingDown(object,speed); }
	if (effect=="MovingUpLeft") {  
		deShowMovingUpLeft(object,speed); }
	if (effect=="MovingUpRight") {
		deShowMovingUpRight(object,speed); }
	if (effect=="MovingDownLeft") {
		deShowMovingDownLeft(object,speed); }
	if (effect=="MovingDownRight") {
		deShowMovingDownRight(object,speed); }
	if (effect=="UncoverUp") { deShowUncoverUp(object,speed); }
	if (effect=="OpacityEffect") { deShowOpacityEffect(object,speed); }
	if (effect=="SharpEffect") { deShowSharpEffect(object,speed); }
}
function deShowSharpEffect(object,speed) {
	deObject_hddn=$(object+':hidden'); deObject_vsbl=$(object+':visible');	
	deObject_vsbl.css({'display': 'none'});	deObject_hddn.css({'display': 'block'});		
}
function deShowOpacitySlow(object,startOpacity,finishOpacity,speed) { 
	deObject=$(object);			
	deShowOpacitySharp(object,startOpacity);
	deObject.css({'display': 'block'});		
   	deObject.animate({ opacity: (finishOpacity/100) }, speed );
}
function deShowOpacitySharp(object,opacity) { 
	deObject=$(object);
	deObject.css({'filter': 'progid:DXImageTransform.Microsoft.Alpha(opacity='+opacity+')'});		
	deObject.css({'-moz-opacity': opacity/100});		
	deObject.css({'-khtml-opacity': opacity/100});		
	deObject.css({'opacity': opacity/100});		
}
function deShowOpacityEffect(object,speed) {
	deObject_hddn=$(object+':hidden');					
	deObject_vsbl=$(object+':visible');					
	deObject_vsbl.animate({ opacity: 0 }, speed, "linear", function(){ deObject_vsbl.css({'display': 'none'}); });
	deShowOpacitySharp(deObject_hddn,0);
	deObject_hddn.css({'display': 'block'});		
    deObject_hddn.animate({ opacity: 1 }, speed );
}
function deShowMovingUp(object,speed) {
	deObject_hddn=$(object+':hidden');
	deObject_vsbl=$(object+':visible');
	screenHeight=deGetScreenSize().height; 	
	deTop=deObject_vsbl.css('top');
   	deObject_vsbl.animate({ top: -screenHeight }, speed, "linear", function(){ 
   	    deObject_vsbl.css({'display': 'none'});
		deObject_vsbl.css({'top': deTop});
	});
	deTop=deObject_hddn.css('top');							
	deObject_hddn.css({'top': -screenHeight}); 
	deObject_hddn.css({'display': 'block'}); 	
   	deObject_hddn.animate({ top: deTop }, speed ); 
}
function deShowMovingDown(object,speed) {
	deObject_hddn=$(object+':hidden'); deObject_vsbl=$(object+':visible');	
	screenHeight=deGetScreenSize().height; 
	deTop=deObject_vsbl.css('top');
   	deObject_vsbl.animate({ top: +screenHeight }, speed, "linear", function(){
	   deObject_vsbl.css({'display': 'none'});
	   deObject_vsbl.css({'top': deTop});
	});
	deTop=deObject_hddn.css('top');
	deObject_hddn.css({'top': +screenHeight});		
	deObject_hddn.css({'display': 'block'}); 	
	deObject_hddn.animate({ top: deTop }, speed );
}
function deShowMovingLeft(object,speed) {
	deObject_hddn=$(object+':hidden'); deObject_vsbl=$(object+':visible');	
	screenWidth=deGetScreenSize().width; 
	deLeft=deObject_vsbl.css('left');
   	deObject_vsbl.animate({ left: -screenWidth }, speed, "linear", function(){
	   deObject_vsbl.css({'display': 'none'});
	   deObject_vsbl.css({'left': deLeft});
	});
	deLeft=deObject_hddn.css('left');
	deObject_hddn.css({'left': -screenWidth});		
	deObject_hddn.css({'display': 'block'});		
  	deObject_hddn.animate({ left: deLeft }, speed );
}
function deShowMovingRight(object,speed) {
	deObject_hddn=$(object+':hidden'); deObject_vsbl=$(object+':visible');	
	screenWidth=deGetScreenSize().width; 
	deLeft=deObject_vsbl.css('left');
   	deObject_vsbl.animate({ left: +screenWidth }, speed, "linear", function(){
	   deObject_vsbl.css({'display': 'none'});
	   deObject_vsbl.css({'left': deLeft});
	});
	deLeft=deObject_hddn.css('left');
	deObject_hddn.css({'left': +screenWidth});		
	deObject_hddn.css({'display': 'block'});		
  	deObject_hddn.animate({ left: deLeft }, speed );
}
function deShowMovingUpLeft(object,speed) {
	deObject_hddn=$(object+':hidden'); deObject_vsbl=$(object+':visible');	
	screenWidth=deGetScreenSize().width; screenHeight=deGetScreenSize().height; 
	deLeft=deObject_vsbl.css('left'); deTop=deObject_vsbl.css('top');
   	deObject_vsbl.animate({ left: -screenWidth, top: -screenHeight }, speed, "linear", function(){
        deObject_vsbl.css({'display': 'none'});
        deObject_vsbl.css({'left': deLeft});
		deObject_vsbl.css({'top': deTop});
	});
	deLeft=deObject_hddn.css('left');
	deTop=deObject_hddn.css('top');
	deObject_hddn.css({'left': -screenWidth});		
	deObject_hddn.css({'top': -screenHeight});		
	deObject_hddn.css({'display': 'block'});		
    deObject_hddn.animate({ left: deLeft, top: deTop }, speed );
}
function deShowMovingUpRight(object,speed) {
	deObject_hddn=$(object+':hidden'); deObject_vsbl=$(object+':visible');	
	screenWidth=deGetScreenSize().width; screenHeight=deGetScreenSize().height; 
	deLeft=deObject_vsbl.css('left');
	deTop=deObject_vsbl.css('top');
   	deObject_vsbl.animate({ left: +screenWidth, top: -screenHeight }, speed, "linear", function(){
	   deObject_vsbl.css({'display': 'none'});
	   deObject_vsbl.css({'left': deLeft});
	   deObject_vsbl.css({'top': deTop});
	});
	deLeft=deObject_hddn.css('left');
	deTop=deObject_hddn.css('top');
	deObject_hddn.css({'left': +screenWidth});		
	deObject_hddn.css({'top': -screenHeight});		
	deObject_hddn.css({'display': 'block'});		
  	deObject_hddn.animate({ left: deLeft, top: deTop }, speed );
}
function deShowMovingDownLeft(object,speed) {
	deObject_hddn=$(object+':hidden'); deObject_vsbl=$(object+':visible');	
	screenWidth=deGetScreenSize().width; screenHeight=deGetScreenSize().height; 
	deLeft=deObject_vsbl.css('left');
	deTop=deObject_vsbl.css('top');
   	deObject_vsbl.animate({ left: -screenWidth, top: +screenHeight }, speed, "linear", function(){
	   deObject_vsbl.css({'display': 'none'});
	   deObject_vsbl.css({'left': deLeft});
	   deObject_vsbl.css({'top': deTop});
	});
	deLeft=deObject_hddn.css('left');
	deTop=deObject_hddn.css('top');
	deObject_hddn.css({'left': -screenWidth});		
	deObject_hddn.css({'top': +screenHeight});		
	deObject_hddn.css({'display': 'block'});		
   	deObject_hddn.animate({ left: deLeft, top: deTop }, speed );
}
function deShowMovingDownRight(object,speed) {
	deObject_hddn=$(object+':hidden'); deObject_vsbl=$(object+':visible');	
	screenWidth=deGetScreenSize().width; screenHeight=deGetScreenSize().height; 
	deLeft=deObject_vsbl.css('left');
	deTop=deObject_vsbl.css('top');
   	deObject_vsbl.animate({ left: +screenWidth, top: +screenHeight }, speed, "linear", function(){
	   deObject_vsbl.css({'display': 'none'});
	   deObject_vsbl.css({'left': deLeft});
	   deObject_vsbl.css({'top': deTop});
	});
	deLeft=deObject_hddn.css('left');
	deTop=deObject_hddn.css('top');
	deObject_hddn.css({'left': +screenWidth});		
	deObject_hddn.css({'top': +screenHeight});		
	deObject_hddn.css({'display': 'block'});		
   	deObject_hddn.animate({ left: deLeft, top: deTop }, speed );
}
function deShowUncoverUp(object,speed) {
	deObject=$(object); deObject_id=object.replace("#","");
	deObject.css({'overflow': 'hidden'});
	deObject_hddn=$(object+':hidden'); deObject_vsbl=$(object+':visible');	
	deHeight=deObject.height();
   	deObject_vsbl.animate({ height: '1px' }, speed, "linear", function(){
	   deObject.height(deHeight);
	   deObject_vsbl.css({'display': 'none'});
	});
	deObject_hddn.css({'height': '1px'});		
	deObject_hddn.css({'display': 'block'});		
  	deObject_hddn.animate({ height: deHeight }, speed );
}
