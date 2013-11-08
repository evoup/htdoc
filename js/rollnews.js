var marqueeContent=new Array();   //滚动新闻
marqueeContent[0]='<font color="#0000CC">14:25 </font><a href=# target=_blank class="f12red"><span style="color:Red"><span style="font-size:15pt">evil blog</span></span></a><br>';
marqueeContent[1]='<font color="#0000CC">14:25 </font><a href=# target=_blank class="f12red"><span style="color:Blue">欢迎大家有时间来看看</span></a><br>';
marqueeContent[2]='<font color="#0000CC">14:25 </font><a href=#  target=_blank class="f12red"><span style="color:Teal">有什么问题可以在留言板留言</span></a><br>';
marqueeContent[3]='<font color="#0000CC">14:25 </font><a href=# target=_blank class="f12red"><span style="color:Brown">qq:876181 & 876929</span></a><br>';
var marqueeInterval=new Array();  //定义一些常用而且要经常用到的变量
var marqueeId=0;
var marqueeDelay=2000;
var marqueeHeight=20;
//接下来的是定义一些要使用到的函数
function initMarquee() {
 var str=marqueeContent[0];
 document.write('<div id=marqueeBox style="overflow:hidden;height:'+marqueeHeight+'px" onmouseover="clearInterval(marqueeInterval[0])" onmouseout="marqueeInterval[0]=setInterval(\'startMarquee()\',marqueeDelay)"><div>'+str+'</div></div>');
 marqueeId++;
 marqueeInterval[0]=setInterval("startMarquee()",marqueeDelay);
 }
function startMarquee() {
 var str=marqueeContent[marqueeId];
  marqueeId++;
 if(marqueeId>=marqueeContent.length) marqueeId=0;
 if(marqueeBox.childNodes.length==1) {
  var nextLine=document.createElement('DIV');
  nextLine.innerHTML=str;
  marqueeBox.appendChild(nextLine);
  }
 else {
  marqueeBox.childNodes[0].innerHTML=str;
  marqueeBox.appendChild(marqueeBox.childNodes[0]);
  marqueeBox.scrollTop=0;
  }
 clearInterval(marqueeInterval[1]);
 marqueeInterval[1]=setInterval("scrollMarquee()",20);
 }
function scrollMarquee() {
 marqueeBox.scrollTop++;
 if(marqueeBox.scrollTop%marqueeHeight==(marqueeHeight-1)){
  clearInterval(marqueeInterval[1]);
  }
 }
initMarquee();