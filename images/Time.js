<!-- Begin
var bsYear;  
var bsDate;  
var bsWeek;  
var arrLen=8; 
var sValue=0;  
var dayiy=0;  
var miy=0;  
var iyear=0; 

var dayim=0; 
var spd=86400; 
 
var year1999="30;29;29;30;29;29;30;29;30;30;30;29"; //354  
var year2000="30;30;29;29;30;29;29;30;29;30;30;29"; //354  
var year2001="30;30;29;30;29;30;29;29;30;29;30;29;30"; //384  
var year2002="30;30;29;30;29;30;29;29;30;29;30;29"; //354  
var year2003="30;30;29;30;30;29;30;29;29;30;29;30"; //355  
var year2004="29;30;29;30;30;29;30;29;30;29;30;29;30"; //384  
var year2005="29;30;29;30;29;30;30;29;30;29;30;29"; //354  
var year2006="30;29;30;29;30;30;29;29;30;30;29;29;30";  
 
var month1999="����;����;����;����;����;����;����;����;����;ʮ��;ʮһ��;ʮ����"  
var month2001="����;����;����;����;������;����;����;����;����;����;ʮ��;ʮһ��;ʮ����"  
var month2004="����;����;�����;����;����;����;����;����;����;����;ʮ��;ʮһ��;ʮ����"  
var month2006="����;����;����;����;����;����;����;������;����;����;ʮ��;ʮһ��;ʮ����"  
var Dn="��һ;����;����;����;����;����;����;����;����;��ʮ;ʮһ;ʮ��;ʮ��;ʮ��;ʮ��;ʮ��;ʮ��;ʮ��;ʮ��;��ʮ;إһ;إ��;إ��;إ��;إ��;إ��;إ��;إ��;إ��;��ʮ";  
 
var Ys=new Array(arrLen);  
Ys[0]=919094400;Ys[1]=949680000;Ys[2]=980265600;  
Ys[3]=1013443200;Ys[4]=1044028800;Ys[5]=1074700800;  
Ys[6]=1107878400;Ys[7]=1138464000;  
 
var Yn=new Array(arrLen); //ũ���������  
Yn[0]="��î��";Yn[1]="������";Yn[2]="������";  
Yn[3]="������";Yn[4]="��δ��";Yn[5]="������";  
Yn[6]="������";Yn[7]="������";  
var D=new Date();  
var yy=D.getYear();  
var mm=D.getMonth()+1;  
var dd=D.getDate();  
var Strww=D.getDay();  
if (Strww==0) Strww="<font color=RED>������</font>";  
if (Strww==1) Strww="����һ";  
if (Strww==2) Strww="���ڶ�";  
if (Strww==3) Strww="������";  
if (Strww==4) Strww="������";  
if (Strww==5) Strww="������";  
if (Strww==6) Strww="<font color=RED>������</font>";  
Strww=Strww;  
var ss=parseInt(D.getTime() / 1000);  
if (yy<100) yy="19"+yy;  
 
for (i=0;i<arrLen;i++)  
if (ss>=Ys[i]){  
iyear=i;  
sValue=ss-Ys[i]; //���������  
}  
dayiy=parseInt(sValue/spd)+1; //���������  
 
var dpm=year1999;  
if (iyear==1) dpm=year2000;  
if (iyear==2) dpm=year2001;  
if (iyear==3) dpm=year2002;  
if (iyear==4) dpm=year2003;  
if (iyear==5) dpm=year2004;  
if (iyear==6) dpm=year2005;  
if (iyear==7) dpm=year2006;  
dpm=dpm.split(";");  
 
var Mn=month1999;  
if (iyear==2) Mn=month2001;  
if (iyear==5) Mn=month2004;  
if (iyear==7) Mn=month2006;  
Mn=Mn.split(";");  
 
var Dn="��һ;����;����;����;����;����;����;����;����;��ʮ;ʮһ;ʮ��;ʮ��;ʮ��;ʮ��;ʮ��;ʮ��;ʮ��;ʮ��;��ʮ;إһ;إ��;إ��;إ��;إ��;إ��;إ��;إ��;إ��;��ʮ";  
Dn=Dn.split(";");  
 
dayim=dayiy;  
 
var total=new Array(13);  
total[0]=parseInt(dpm[0]);  
for (i=1;i<dpm.length-1;i++) total[i]=parseInt(dpm[i])+total[i-1];  
for (i=dpm.length-1;i>0;i--)  
if (dayim>total[i-1]){  
dayim=dayim-total[i-1];  
miy=i;  
}  
bssWeek=Strww;  
bsDate=yy+"��"+mm+"��";  
bsDate2=dd;  
bsYear="ũ��"+Yn[iyear];  
bsYear2=Mn[miy]+Dn[dayim-1];  
if (ss>=Ys[7]||ss<Ys[0]) bsYear=Yn[7];  
function CAL(){  
document.write("<table border='0' cellspacing='0' bordercolor='#000000'   cellpadding='0'");  
document.write("<tr><td nowarp align='center'><font color=#6B341B>"+bsDate+""+bsDate2+"��</font>&nbsp;");  
document.write(bssWeek+"&nbsp;ũ��"+bsYear);  
document.write("<font color=#6B341B></td></tr></table>");  

}  

//  End -->