<?php
$id = uniqid("");
?>
<html>
<head><title>Upload Example</title></head>
<body>
<script>
var xmlHttp;
var nowpercent=0;//��ǰ%
function createXMLHttpRequest(){
if (window.ActiveXObject){xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}
else if (window.XMLHttpRequest){xmlHttp=new XMLHttpRequest();}
return xmlHttp;
}
function go() {
	    document.getElementById("progressouter").style.display="block";
	var url="getprogress.php?progress_key=<?php echo $id;?>";
            xmlHttp=createXMLHttpRequest();
            xmlHttp.open("GET", url, true);
            xmlHttp.onreadystatechange = goCallback;
            xmlHttp.send("progress_key=<?php echo $id;?>");
}
function goCallback() {
        if (xmlHttp.readyState == 4) {
				//alert(xmlHttp.responseText);
		ss = xmlHttp.responseText.split("|");  
			if (ss[1]=='') {//�ȼ��APC�Ƿ��õ����ַ���
				setTimeout("pollServer()", 2000);//��ֹ����δ����
				}
			else{
			sss=ss[0].split("\\");
			//alert(sss[sss.length-1]);//�ļ���
			//alert(ss[1]);//�ܹ���С
			//alert(ss[2]);//��ǰ��С
			document.getElementById('wjm').innerHTML="�ļ���"+sss[sss.length-1];
			document.getElementById('wjdx').innerHTML="�ļ���С"+(ss[1]/1024).toFixed(2)+"k";
			document.getElementById('ysc').innerHTML="���ϴ�"+(ss[2]/1024).toFixed(2)+"k";
			percent=parseInt(ss[3]);//�ٷ���
			if (nowpercent<=percent){//FIX APC��ʱ��᷵�ز���ȷ���ϴ�����,��ֹ���߽�����
				nowpercent=percent;
				}
			//alert(xmlHttp.status);
			document.getElementById("progressinner").style.width = nowpercent+"%";
			if (nowpercent < 100 && percent < 100 ){
				setTimeout("pollServer()", 2000);//��Ҫʱ��̫�̣���������
				}
				}
		}
}




function pollServer() {
if( parent.document.getElementById('uploadover').value!=1){//�ϴ���ɾͲ���������
go();}
}
</script>



<iframe id="theframe" name="theframe" src="upload.php?id=<?php echo($id) ?>" style="border: none; height: 100px; width: 400px;" > </iframe><br/><br/>
<div id="progress_win"></div>

<div id="progressouter" style="width: 500px; height: 20px; border: 6px solid red; display:none;">
   <div id="progressinner" style="position: relative; height: 20px; background-color: purple; width: 0%; "> </div>
</div>
<input type=hidden id = "uploadover" name = "uploadover" style="display:none;" value=0></div>
<div id=wjm></div>
<div id=wjdx></div>
<div id=ysc></div>
</body>
</html>