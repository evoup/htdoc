//��ʹ��charset=utf-8������
//����Ǵ��ݱ༭������POSTҳ�ĺ���
function getmyeditorHTML(){
if (isIE){//�ò������ж��ˣ�FCK��װ����?
document.getElementById('hideditor').innerText=document.frames['editorfrm'].getEditorHTMLContents('FCKeditor1');
	//return document.frames['editorfrm'].getEditorHTMLContents('FCKeditor1');
}
if (isMozilla){
document.getElementById('hideditor').innerText	= editorfrm.getEditorHTMLContents('FCKeditor1');
	//return editorfrm.getEditorHTMLContents('FCKeditor1');
	}

	//document.getElementById('hideditor').value=document.getElementById('editorfrm').getEditorHTMLContents('FCKeditor1');
	//alert(document.getElementById('hideditor').value);
	//return document.getElementById('editorfrm').getEditorHTMLContents('FCKeditor1');
}