function marquee1() 
{ 
document.write("<marquee behavior=scroll direction=l  scrollamount=3 scrolldelay=60 onmouseover='this.stop()' onmouseout='this.start()'>") 
} 
function marquee2() 
{ 
document.write("</marquee>") 
} 
document.writeln("<SCRIPT language=JavaScript>marquee1();</SCRIPT> ");
document.writeln("<span style='margin-right:270px;'><a href=bulletin/readbulletin.php?id=8>嘉定365 V1.0 内测。。。2</a></span>");
document.writeln("<SCRIPT language=JavaScript>marquee2();</SCRIPT> ");
