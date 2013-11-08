var week; 
if(new Date().getDay()==0)          week="星期日"
if(new Date().getDay()==1)          week="星期一"
if(new Date().getDay()==2)          week="星期二" 
if(new Date().getDay()==3)          week="星期三"
if(new Date().getDay()==4)          week="星期四"
if(new Date().getDay()==5)          week="星期五"
if(new Date().getDay()==6)          week="星期六"
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




//document.write((new Date().getYear())+"年"+(new Date().getMonth()+1)+"月"+new Date().getDate()+"日 "+week);
document.write(week);
document.write("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
document.write('<font id="calendarClock4" >loading.</font>');
setInterval('refresh()',1000);
