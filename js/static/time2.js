var week; 
if(new Date().getDay()==0)          week="������"
if(new Date().getDay()==1)          week="����һ"
if(new Date().getDay()==2)          week="���ڶ�" 
if(new Date().getDay()==3)          week="������"
if(new Date().getDay()==4)          week="������"
if(new Date().getDay()==5)          week="������"
if(new Date().getDay()==6)          week="������"
function CurentTime(){ 
    var now = new Date(); 
    var hh = now.getHours(); 
    var mm = now.getMinutes(); 
    var ss = now.getTime() % 60000; 
    ss = (ss - (ss % 1000)) / 1000; 
    var clock = hh+':'; 
    if (mm < 10) clock += '0'; 
    clock += mm+':'; 
    if (ss < 10) clock += '0'; 
    clock += ss; 
    return(clock); } 

function refresh(){ 

document.getElementById('calendarClock4').innerHTML = CurentTime(); }




//document.write((new Date().getYear())+"��"+(new Date().getMonth()+1)+"��"+new Date().getDate()+"�� "+week);
document.write(week);
document.write("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
document.write('<font id="calendarClock4" >loading.</font>');
setInterval('refresh()',1000);
