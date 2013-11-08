function popupDialog(url,width,height){ 
    //showx = event.screenX - event.offsetX - 4 - 10 ; // + deltaX;  这段代码只对IE有效，已经不用了 
    //showy = event.screenY - event.offsetY -168; // + deltaY; 这段代码只对IE有效，已经不用了 
     
        var x = parseInt(screen.width / 2.0) - (width / 2.0);  
    var y = parseInt(screen.height / 2.0) - (height / 2.0); 
        var isMSIE= (navigator.appName == "Microsoft Internet Explorer");  //判断浏览器 

        if (isMSIE) {           
            retval = window.showModalDialog(url, window, "dialogWidth:"+width+"px; dialogHeight:"+height+"px; dialogLeft:"+x+"px; dialogTop:"+y+"px; status:no; directories:yes;scrollbars:no;Resizable=no; "  ); 
       } else { 
        var win = window.open(url, "mcePopup", "top=" + y + ",left=" + x + ",scrollbars=" + scrollbars + ",dialog=yes,modal=yes,width=" + width + ",height=" + height + ",resizable=no" ); 
        eval('try { win.resizeTo(width, height); } catch(e) { }'); 
        win.focus();            
		
    } 
} 