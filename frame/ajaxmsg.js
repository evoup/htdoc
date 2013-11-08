var xmlHttp;
function createXMLHttpRequest(){
if (window.ActiveXObject){xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}
else if (window.XMLHttpRequest){xmlHttp=new XMLHttpRequest();}
}
function go() {
            createXMLHttpRequest();            
            xmlHttp.open("GET", "news.php?time=new Date().getTime()", true);
            xmlHttp.onreadystatechange = goCallback;
            xmlHttp.send("");


//�ڼ��ϸ���





        }
function goCallback() {
            if (xmlHttp.readyState == 4) {
                if (xmlHttp.status == 200) {
					var msg = document.getElementById("msgunread");

					msg.innerHTML=xmlHttp.responseText;
					
                    setTimeout("pollServer()", 5000);
                }
            }
        }
function pollServer() {
go();
        }
