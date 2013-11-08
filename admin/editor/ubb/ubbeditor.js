/* -----------------------------------------------------
UBB Code Editor for Bo-Blog 2
Code: Bob Shen <bob.shen@gmail.com>
Offical site: http://www.bo-blog.com
Copyright (c) Bob Shen
------------------------------------------------------- */

var clientVer = navigator.userAgent.toLowerCase(); // Get browser version
var is_firefox = ((clientVer.indexOf("gecko") != -1) && (clientVer.indexOf("firefox") != -1) && (clientVer.indexOf("opera") == -1)); //Firefox or other Gecko

var noweditorid;
var oldcontent;
function init_ubb(id) {
	//alert("�´�����Ҫ���ͣ�");
	noweditorid=document.getElementById(id);
	oldcontent=document.getElementById(id+"_old");
}

function AddText(myValue) { //From QuickTags
	var myField=noweditorid;
	//IE support
	if (document.selection) {
		myField.focus();
		sel = document.selection.createRange();
		sel.text = myValue;
		myField.focus();
	}
	//MOZILLA/NETSCAPE support
	else if (myField.selectionStart || myField.selectionStart == '0') {
		oldcontent.value=noweditorid.value; //Fx sometimes crashes using ubb, so this is for saving data back
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		var scrollTop = myField.scrollTop;
		myField.value = myField.value.substring(0, startPos)
		              + myValue 
                      + myField.value.substring(endPos, myField.value.length);
		myField.focus();
		myField.selectionStart = startPos + myValue.length;
		myField.selectionEnd = startPos + myValue.length;
		myField.scrollTop = scrollTop;
	} else {
		myField.value += myValue;
		myField.focus();
	}
}

// From http://www.massless.org/mozedit/
function FxGetTxt(open, close)
{
	var selLength = noweditorid.textLength;
	var selStart = noweditorid.selectionStart;
	var selEnd = noweditorid.selectionEnd;
	if (selEnd == 1 || selEnd == 2)  selEnd = selLength;
	var s1 = (noweditorid.value).substring(0,selStart);
	var s2 = (noweditorid.value).substring(selStart, selEnd)
	var s3 = (noweditorid.value).substring(selEnd, selLength);
	oldcontent.value=noweditorid.value; //Fx sometimes crashes using ubb, so this is for saving data back
	noweditorid.value = s1 + open + s2 + close + s3;
	return;
}

function undo_fx() {
	if (noweditorid.value=='' || noweditorid.value==null) alert('û�п�����ص����ݣ�');
	else noweditorid.value = oldcontent.value;
}

function showsize(size) {
if (document.selection && document.selection.type == "Text") {
	var range = document.selection.createRange();
	range.text = "[size=" +size+"]"+ range.text + "[/size]";
} else if (is_firefox && noweditorid.selectionEnd) {
	txt=FxGetTxt ("[size="+size+"]", "[/size]");
	return;
} else {
	txt=prompt('��С '+size,'����');
	if (txt!=null) {
		AddTxt="[size="+size+"]"+txt+"[/size]";
		AddText(AddTxt);
	}
}
}

function showfont(font) {
if (font=="#define#") {
		font = prompt('�������Զ����������');
}
if (document.selection && document.selection.type == "Text") {
		var range = document.selection.createRange();
		range.text = "[font=" +font+"]"+ range.text + "[/font]";
} else if (is_firefox && noweditorid.selectionEnd) {
	txt=FxGetTxt ("[font="+font+"]", "[/font]");
	return;
} else {
	txt=prompt('Ҫ�������������'+font,'����');
	if (txt!=null) {
		AddTxt="[font="+font+"]"+txt;
		AddText(AddTxt);
		AddTxt="[/font]";
		AddText(AddTxt);
	}
}
}


function showcolor(color) {
if (color=="#define#") {
		color = prompt('�������Զ�����ɫ�Ĵ���', '��ɫ');
}
if (document.selection && document.selection.type == "Text") {
		var range = document.selection.createRange();
		range.text = "[color=" +color+"]"+ range.text + "[/color]";
} else if (is_firefox && noweditorid.selectionEnd) {
	txt=FxGetTxt ("[color="+color+"]", "[/color]");
	return;
} else {
   	txt=prompt('��ɫ'+' '+color,'����');
	if(txt!=null) {
		AddTxt="[color="+color+"]"+txt;
		AddText(AddTxt);
		AddTxt="[/color]";
		AddText(AddTxt);
	}
}
}

function email() {
	txt=prompt('Email ��ַ',"name\@domain.com");      
	if (txt!=null) {
		AddTxt="[email]"+txt+"[/email]";
		AddText(AddTxt);
	}
}

function addfile() {
	txt=prompt('�ļ����ص�ַ',"http://");      
	if (txt!=null) {
		AddTxt="[file]"+txt+"[/file]";
		AddText(AddTxt);
	}
}

function addsfile() {
	txt=prompt('�ļ����ص�ַ',"http://");      
	if (txt!=null) {
		AddTxt="[sfile]"+txt+"[/sfile]";
		AddText(AddTxt);
	}
}

function addacronym() {
if (document.selection && document.selection.type == "Text") {
		var range = document.selection.createRange();
		txt=prompt('Ϊѡ���������ע��',"");
		range.text = "[acronym=" + txt + "]" + range.text + "[/acronym]";
} else if (is_firefox && noweditorid.selectionEnd) {
	txt=prompt('Ϊѡ���������ע��',"");
	txt=FxGetTxt ("[acronym=" + txt + "]", "[/acronym]");
	return;
} else {
	txt2=prompt('����������',"");
	if (txt2!=null && txt2!='') {
		txt=prompt('������ע��',"");
		if (txt!=null) {
			if (txt2=="") {
			} else {
				AddTxt="[acronym="+txt+"]"+txt2;
				AddText(AddTxt);
				AddTxt="[/acronym]";
				AddText(AddTxt);
			}
		}
	}
}
}

function bold() {
if (document.selection && document.selection.type == "Text") {
		var range = document.selection.createRange();
		range.text = "[b]" + range.text + "[/b]";
} 
else if (is_firefox && noweditorid.selectionEnd) {
	txt=FxGetTxt ("[b]", "[/b]");
	return;
} else {
	txt=prompt('���ֽ������','����');
	if (txt!=null) {
		AddTxt="[b]"+txt;
		AddText(AddTxt);
		AddTxt="[/b]";
		AddText(AddTxt);
	}
}
}

function italicize() {
if (document.selection && document.selection.type == "Text") {
		var range = document.selection.createRange();
		range.text = "[i]" + range.text + "[/i]";
} else if (is_firefox && noweditorid.selectionEnd) {
	txt=FxGetTxt ("[i]", "[/i]");
	return;
} else {
	txt=prompt('���ֽ���б��','����');
	if (txt!=null) {
		AddTxt="[i]"+txt;
		AddText(AddTxt);
		AddTxt="[/i]";
		AddText(AddTxt);
	}
}
}

function strike() {
if (document.selection && document.selection.type == "Text") {
		var range = document.selection.createRange();
		range.text = "[strike]" + range.text + "[/strike]";
} else if (is_firefox && noweditorid.selectionEnd) {
	txt=FxGetTxt ("[strike]", "[/strike]");
	return;
} else {
	txt=prompt('���ֽ���ɾ����','����');
	if (txt!=null) {
		AddTxt="[strike]"+txt;
		AddText(AddTxt);
		AddTxt="[/strike]";
		AddText(AddTxt);
	}
}
}

function underline() {
if (document.selection && document.selection.type == "Text") {
		var range = document.selection.createRange();
		range.text = "[u]" + range.text + "[/u]";
} else if (is_firefox && noweditorid.selectionEnd) {
	txt=FxGetTxt ("[u]", "[/u]");
	return;
} else {
	txt=prompt('���ֽ����»���','����');
	if (txt!=null) {
		AddTxt="[u]"+txt;
		AddText(AddTxt);
		AddTxt="[/u]";
		AddText(AddTxt);
	}
}
}

function subsup(way) {
if (way=='sub') var wayshow='���ֽ���Ϊ�±�';
else var wayshow='���ֽ���Ϊ�ϱ�';
if (document.selection && document.selection.type == "Text") {
		var range = document.selection.createRange();
		range.text = "["+way+"]" + range.text + "[/"+way+"]";
} else if (is_firefox && noweditorid.selectionEnd) {
	txt=FxGetTxt ("["+way+"]", "[/"+way+"]");
	return;
} else {
	txt=prompt(wayshow,'����');
	if (txt!=null) {
		AddTxt="["+way+"]"+txt;
		AddText(AddTxt);
		AddTxt="[/"+way+"]";
		AddText(AddTxt);
	}
}
}


function quoteme() {
if (document.selection && document.selection.type == "Text") {
		var range = document.selection.createRange();
		range.text = "[quote]" + range.text + "[/quote]";
} else if (is_firefox && noweditorid.selectionEnd) {
	txt=FxGetTxt ("[quote]", "[/quote]");
	return;
} else {
	txt=prompt('�����õ�����','����');
	if(txt!=null) {
		AddTxt="[quote]"+txt;
		AddText(AddTxt);
		AddTxt="[/quote]";
		AddText(AddTxt);
	}
}
}

function center() {
if (document.selection && document.selection.type == "Text") {
		txt2=prompt('������ʽ'+"\n"+"���� 'center' ��ʾ����, 'left' ��ʾ�����, 'right' ��ʾ�Ҷ���.","center");
		while ((txt2!="") && (txt2!="center") && (txt2!="left") && (txt2!="right") && (txt2!=null)) {
			txt2=prompt('����!'+"\n"+"����ֻ������ 'center' �� 'left' ���� 'right'.","");
		}
		var range = document.selection.createRange();
		range.text = "[p align="+txt2+"]"+ range.text + "[/p]";
} else {
	txt2=prompt('������ʽ'+"\n"+"���� 'center' ��ʾ����, 'left' ��ʾ�����, 'right' ��ʾ�Ҷ���.","center");
	while ((txt2!="") && (txt2!="center") && (txt2!="left") && (txt2!="right") && (txt2!=null)) {
		txt2=prompt('����!'+"\n"+"����ֻ������ 'center' �� 'left' ���� 'right'.","");
	}
	if (is_firefox && noweditorid.selectionEnd) {
		txt=FxGetTxt ("[p align="+txt2+"]", "[/p]");
		return;
	}
	txt=prompt('Ҫ������ı�','����');
	if (txt!=null) {
		AddTxt="[p align="+txt2+"]"+txt;
		AddText(AddTxt);
		AddTxt="[/p]";
		AddText(AddTxt);
	}
}
}


function hyperlink() {
if (document.selection && document.selection.type == "Text") {
		var range = document.selection.createRange();
		txt=prompt('����!',"http://");
		range.text = "[url=" + txt + "]" + range.text + "[/url]";
} else if (is_firefox && noweditorid.selectionEnd) {
	txt=prompt('����!',"http://");
	txt=FxGetTxt ("[url=" + txt + "]", "[/url]");
	return;
} else {
	txt2=prompt("�����ı���ʾ.\n�������ʹ��, ����Ϊ��, ��ֻ��ʾ�������ӵ�ַ. ","");
	if (txt2!=null) {
		txt=prompt('��������',"http://");
		if (txt!=null) {
			if (txt2=="") {
				AddTxt="[url]"+txt;
				AddText(AddTxt);
				AddTxt="[/url]";
				AddText(AddTxt);
			} else {
				AddTxt="[url="+txt+"]"+txt2;
				AddText(AddTxt);
				AddTxt="[/url]";
				AddText(AddTxt);
			}
		}
	}
}
}


function image() {
	txt2=prompt("������ʽ"+"\n"+"���� 'm' ��ʾ����, 'l' ��ʾ�����, 'r' ��ʾ�Ҷ���","m");
	if ((txt2!="") && (txt2!="m") && (txt2!="l") && (txt2!="r") && (txt2!="f") && (txt2!=null)) {
		txt2=prompt('����!'+"\n"+"����ֻ������ 'm' �� 'l' ���� 'r'.","");
	}

	txt=prompt('ͼƬ�� URL',"http://");

	if ((txt!="") && (txt!="http://")) {
		txt3=prompt("�޶�ͼƬ�ĳߴ磨��ʽ����,�ߣ�����400,300��\n���޶�������\nδ֪�ĸ߿����*���棬���� 400,* �� *,200","*,*");
	} else return;

	var align=(txt2=='m') ? '': ' align='+txt2;

	var addpicsize='';
	if (txt3.indexOf(',') != -1) {
		var sizeofpic=txt3.split(',');
		if (sizeofpic[0]!='*') addpicsize+=" width="+sizeofpic[0];
		if (sizeofpic[1]!='*') addpicsize+=" height="+sizeofpic[1];
	}

	if(txt!=null) {
		AddTxt="[img"+align+addpicsize+"]"+txt+"[/img]";
		AddText(AddTxt);
	}
}

function addmedia(mediatype) {
	txt=prompt('�ö�ý���ļ��ĵ�ַ',"http://");
	width=prompt('�ö�ý���ļ��Ŀ��',"400");
	height=prompt('�ö�ý���ļ��ĸ߶�',"300");
	if(txt!=null) {
		AddTxt="["+mediatype+"="+width+","+height+"]"+txt;
		AddText(AddTxt);
		AddTxt="[/"+mediatype+"]";
		AddText(AddTxt);
	}
}


function showcode() {
if (document.selection && document.selection.type == "Text") {
		var range = document.selection.createRange();
		range.text = "\r[code]" + range.text + "[/code]";
} else {
	txt=prompt('�������',"");
	if (txt!=null) { 
		AddTxt="[code]"+txt;
		AddText(AddTxt);
		AddTxt="[/code]";
		AddText(AddTxt);
	}
}
}

