//请使用charset=utf-8来引用
//这个是传递编辑器到被POST页的函数
function getmyeditorHTML(){
if (isIE){//用不着再判断了，FCK封装好了?
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