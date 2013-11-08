<?php
$id = uniqid("");
?>
<html>
<head><title>Upload Example</title></head>
<body>
<script>
var xmlHttp;
var nowpercent=0;//当前%
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
			if (ss[1]=='') {//先检测APC是否获得到了字符串
				setTimeout("pollServer()", 2000);//防止连接未建立
				}
			else{
			sss=ss[0].split("\\");
			//alert(sss[sss.length-1]);//文件名
			//alert(ss[1]);//总共大小
			//alert(ss[2]);//当前大小
			document.getElementById('wjm').innerHTML="文件名"+sss[sss.length-1];
			document.getElementById('wjdx').innerHTML="文件大小"+(ss[1]/1024).toFixed(2)+"k";
			document.getElementById('ysc').innerHTML="已上传"+(ss[2]/1024).toFixed(2)+"k";
			percent=parseInt(ss[3]);//百分数
			if (nowpercent<=percent){//FIX APC有时候会返回不正确的上传数组,防止倒走进度条
				nowpercent=percent;
				}
			//alert(xmlHttp.status);
			document.getElementById("progressinner").style.width = nowpercent+"%";
			if (nowpercent < 100 && percent < 100 ){
				setTimeout("pollServer()", 2000);//不要时间太短，带宽限制
				}
				}
		}
}




function pollServer() {
if( parent.document.getElementById('uploadover').value!=1){//上传完成就不再请求了
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