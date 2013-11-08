function resizeImg() {
//window.alert("ss");
var imageAll=document.getElementById("content").getElementsByTagName("img");
 

if (imageAll !=null) {
for (i=0;i<100;i++)
if   (imageAll[i].getAttribute("width")   !=   null) {  
if (imageAll[i].width>500) {

  imageAll[i].style.width="99%";
  imageAll[i].title='µã»÷¿´´óÍ¼';
  imageAll[i].style.border='1px solid gray';
 
  imageAll[i].onclick=function(){window.open(this.src,1);};
  imageAll[i].style.cursor="hand";
 }
}
}
}

if (window.addEventListener)
window.addEventListener("load", resizeImg, false);
else if (window.attachEvent)
window.attachEvent("onload", resizeImg);
else
window.onload=resizeImg 


