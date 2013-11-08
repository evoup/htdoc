<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<SCRIPT LANGUAGE="JavaScript">
<!--
function popupDialog(url,width,height){ 
    //showx = event.screenX - event.offsetX - 4 - 10 ; // + deltaX;  这段代码只对IE有效，已经不用了 
    //showy = event.screenY - event.offsetY -168; // + deltaY; 这段代码只对IE有效，已经不用了 
     
        var x = parseInt(screen.width / 2.0) - (width / 2.0);  
    var y = parseInt(screen.height / 2.0) - (height / 2.0); 
        var isMSIE= (navigator.appName == "Microsoft Internet Explorer");  //判断浏览器 

        if (isMSIE) {           
            retval = window.showModalDialog(url, window, "dialogWidth:"+width+"px; dialogHeight:"+height+"px; dialogLeft:"+x+"px; dialogTop:"+y+"px; status:no; directories:yes;scrollbars:no;Resizable=no; "  ); 
       } else { 
        var win = window.open(url, "mcePopup", "top=" + y + ",left=" + x + ",scrollbars=" + scrollbars + ",dialog=yes,modal=yes,width=" + width + ",height=" + height + ",resizable=no" ); 
        eval('try { win.resizeTo(width, height); } catch(e) { }'); 
        win.focus();             
    } 
} 


 function doReload(){    
     var isMSIE= (navigator.appName == "Microsoft Internet Explorer"); 
     if (isMSIE){ 
         parent.dialogArguments.location.reload(); 
     }else{ 
         parent.opener.document.location.reload(); 
     }      
     top.close();     
  } 



//-->
</SCRIPT>
<link rel=stylesheet href="../css/css.css" type="text/css">

<style type="text/css">
A:link    { color: #0000FF; TEXT-DECORATION: none;}
A:visited { COLOR: #0000FF; TEXT-DECORATION: none}
A:active  { COLOR: #3333ff; TEXT-DECORATION: none}
A:hover   { COLOR: #ff0000; TEXT-DECORATION: none}


body { font-size: 10pt; font-family:"Verdana", "Arial", "宋体"; SCROLLBAR-FACE-COLOR: rgb(158,180,214); SCROLLBAR-3DLIGHT-COLOR: rgb(158,180,214); SCROLLBAR-ARROW-COLOR:  #FFFFFF; }
.bodycolor { BACKGROUND: #ffffff}


.small  { font-size: 9pt;}
.big    { font-size: 9pt;}
.bigbak    { font-size: 12pt;}
.big1   { font-size: 12pt;COLOR: #000000;}
.big2   { font-size: 18pt}
.verybig{ font-size: 24pt}


input.SmallButton{ BORDER-RIGHT: #104a7b 1px solid;    BORDER-TOP: #afc4d5 1px solid;    BACKGROUND: #d6e7ef;    BORDER-LEFT: #afc4d5 1px solid;    CURSOR: hand;    COLOR: #000066;    BORDER-BOTTOM: #104a7b 1px solid;    HEIGHT: 19px;    FONT-SIZE: 9pt;    TEXT-DECORATION: none}
input.BigbakButton  { BORDER-RIGHT: #104a7b 1px solid;    BORDER-TOP: #afc4d5 1px solid;    BACKGROUND: #d6e7ef;    BORDER-LEFT: #afc4d5 1px solid;    CURSOR: hand;    COLOR: #000066;    BORDER-BOTTOM: #104a7b 1px solid;    HEIGHT: 24px;    FONT-SIZE: 12pt;    TEXT-DECORATION: none}
input.BigButton{ BORDER-RIGHT: #104a7b 1px solid;    BORDER-TOP: #afc4d5 1px solid;    BACKGROUND: #d6e7ef;    BORDER-LEFT: #afc4d5 1px solid;    CURSOR: hand;    COLOR: #000066;    BORDER-BOTTOM: #104a7b 1px solid;    HEIGHT: 19px;    FONT-SIZE: 9pt;    TEXT-DECORATION: none}

input.SmallInput { FONT-FAMILY: ??ì?,MS SONG,SimSun,tahoma,sans-serif; COLOR: #000066; BACKGROUND: #d6e7ef; border:1 solid black; FONT-SIZE: 9pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal; HEIGHT: 18px; LINE-HEIGHT: normal}
input.SmallInput1{ FONT-FAMILY: ??ì?,MS SONG,SimSun,tahoma,sans-serif; COLOR: #000066; BACKGROUND: #d6e7ef; border:1 solid black; BORDER-RIGHT:0; FONT-SIZE: 9pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal; HEIGHT: 18px; LINE-HEIGHT: normal}
input.BigInput { FONT-FAMILY: ??ì?,MS SONG,SimSun,tahoma,sans-serif; COLOR: #000066; BACKGROUND: #d6e7ef; border:1 solid black; FONT-SIZE: 9pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal; HEIGHT: 18px; LINE-HEIGHT: normal}
input.BigbakInput   { FONT-FAMILY: ??ì?,MS SONG,SimSun,tahoma,sans-serif; COLOR: #000066; BACKGROUND: #d6e7ef; border:1 solid black; BORDER-BOTTOM:1px double; FONT-SIZE: 12pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal; HEIGHT: 22px; LINE-HEIGHT: normal}
input.BigInputMoney { text-align: RIGHT; FONT-FAMILY: ??ì?,MS SONG,SimSun,tahoma,sans-serif; COLOR: #000066; BACKGROUND: #d6e7ef; border:1 solid black; BORDER-BOTTOM:1px double; FONT-SIZE: 12pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal; HEIGHT: 22px; LINE-HEIGHT: normal}
input.SmallStatic{ FONT-FAMILY: ??ì?,MS SONG,SimSun,tahoma,sans-serif; COLOR: #000066; BACKGROUND: #E0E0E0; border:1 solid black; FONT-SIZE: 9pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal; HEIGHT: 18px; LINE-HEIGHT: normal}
input.BigbakStatic  { FONT-FAMILY: ??ì?,MS SONG,SimSun,tahoma,sans-serif; COLOR: #000066; BACKGROUND: #E0E0E0; border:1 solid black; BORDER-BOTTOM:1px double; FONT-SIZE: 12pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal; HEIGHT: 22px; LINE-HEIGHT: normal}
input.BigStatic{ FONT-FAMILY: ??ì?,MS SONG,SimSun,tahoma,sans-serif; COLOR: #000066; BACKGROUND: #E0E0E0; border:1 solid black; FONT-SIZE: 9pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal; HEIGHT: 18px; LINE-HEIGHT: normal}

select.BigSelect{ FONT-FAMILY: ??ì?,MS SONG,SimSun,tahoma,sans-serif; COLOR: #000066; BACKGROUND: #d6e7ef; border:1 solid black; BORDER-BOTTOM:1px double; FONT-SIZE: 9pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal; HEIGHT: 18px; LINE-HEIGHT: normal}
select.BigbakSelect  { FONT-FAMILY: ??ì?,MS SONG,SimSun,tahoma,sans-serif; COLOR: #000066; BACKGROUND: #d6e7ef; border:1 solid black; BORDER-BOTTOM:1px double; FONT-SIZE: 12pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal; HEIGHT: 22px; LINE-HEIGHT: normal}
select.SmallSelect{ FONT-FAMILY: ??ì?,MS SONG,SimSun,tahoma,sans-serif; COLOR: #000066; BACKGROUND: #d6e7ef; border:1 solid black; BORDER-BOTTOM:1px double; FONT-SIZE: 9pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal; HEIGHT: 18px; LINE-HEIGHT: normal}
select.BigbakStatic  { FONT-FAMILY: ??ì?,MS SONG,SimSun,tahoma,sans-serif; COLOR: #000066; BACKGROUND: #E0E0E0; border:1 solid black; BORDER-BOTTOM:1px double; FONT-SIZE: 12pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal; HEIGHT: 22px; LINE-HEIGHT: normal}
select.BigStatic{ FONT-FAMILY: ??ì?,MS SONG,SimSun,tahoma,sans-serif; COLOR: #000066; BACKGROUND: #E0E0E0; border:1 solid black; FONT-SIZE: 9pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal; HEIGHT: 18px; LINE-HEIGHT: normal}
select.SmallStatic{ FONT-FAMILY: ??ì?,MS SONG,SimSun,tahoma,sans-serif; COLOR: #000066; BACKGROUND: #E0E0E0; border:1 solid black; FONT-SIZE: 9pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal; HEIGHT: 18px; LINE-HEIGHT: normal}

textarea.BigInput { FONT-FAMILY: ??ì?,MS SONG,SimSun,tahoma,sans-serif; COLOR: #000066; BACKGROUND: #d6e7ef; border:1 solid black; BORDER-BOTTOM:1px double; FONT-SIZE: 10pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal;LINE-HEIGHT: normal;}
textarea.BigStatic{ FONT-FAMILY: ??ì?,MS SONG,SimSun,tahoma,sans-serif; COLOR: #000066; BACKGROUND: #E0E0E0; border:1 solid black; BORDER-BOTTOM:1px double; FONT-SIZE: 10pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal;LINE-HEIGHT: normal;}

.Calender    { BACKGROUND: #00FCFC;}
.TableControl{ BACKGROUND: #EFF7FF;}
.TableHeader { BACKGROUND: #D3E5FA;}
.TableHeader1 { BACKGROUND: #D3E5FA; background-image: url("/images/button_back.gif");  CURSOR: hand; COLOR: #000066;}
.TableHeader2 { BACKGROUND: #D3E5FA; background-image: url("/images/menubg.gif");  CURSOR: hand; COLOR: #000066;FONT-WEIGHT: bold;}
.ED1B23 { BACKGROUND:  #ED1B23;}
.7EC0EE { BACKGROUND:  #7EC0EE;}
.0088FF { BACKGROUND:  #0088FF;}
.0000FF { BACKGROUND:  #0000FF;}
.000088 { BACKGROUND:  #000088;}
.8800FF { BACKGROUND:  #8800FF;}
.AB82FF { BACKGROUND:  #AB82FF;}
.FF88FF { BACKGROUND:  #FF88FF;}
.FF00FF { BACKGROUND:  #FF00FF;}
.FF0088 { BACKGROUND:  #FF0088;}
.FF0000 { BACKGROUND:  #FF0000;}
.F4A460 { BACKGROUND:  #F4A460;}
.CC9999 { BACKGROUND:  #CC9999;}
.888800 { BACKGROUND:  #888800;}
.888888 { BACKGROUND:  #888888;}
.CCCCCC { BACKGROUND:  #CCCCCC;}
.90E090 { BACKGROUND:  #90E090;}
.008800 { BACKGROUND:  #008800;}
.008888 { BACKGROUND:  #008888;}
.TableContent{ BACKGROUND: #E2E8FA;}
.TableData   { BACKGROUND: #FFFFFF;}
.TableLine1  { BACKGROUND: #F3F3F3;}
.TableLine2  { BACKGROUND: #FFFFFF;}
.TableLine3  { BACKGROUND: #FFFFFF;}

#write {BACKGROUND: #d6e7ef;}
.pagenav {font-size: 10pt; font-family:"Verdana", "Arial", "宋体";}
.bgcolor2 {font-size: 10pt; font-family:"Verdana", "Arial", "宋体";}
.bgcolor3 {font-size: 10pt; font-family:"Verdana", "Arial", "宋体";}
.bgcolor4 {color: green; font-size: 10pt; font-family:"Verdana", "Arial", "宋体";}



</style>


<title>无标题文档</title>
</head>

<body><img src="../image/mshr.gif" alt="1" height="20" /><strong> 公文管理&gt;&gt;发文起草</strong>
<br />
<table cellspacing="1" cellpadding="3" width="500" align="center" bgcolor="#d0d0c8" border="0">
  <tbody>
    <tr>
      <td><fieldset>
        <table width="500" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#d0d0c8" class="TableData">
          
          <tbody>
            <tr>
              <td nowrap="nowrap" class="TableContent">流程选择(模块)：</td>
              <td><input type="hidden" name="Flow_ID" />
                  <input type="hidden" name="TO_NAME1" />
                  <textarea name="TO_NAME2" cols="30" rows="" class=BigbakStatic></textarea>
                
                <input name="button" type="button" class="SmallButton" title="选择" onclick="popupDialog()" value="选 择" />
                
                <input name="button" type="button" class="SmallButton" title="清空" onclick="clear_user1()" value="清 空" />
              </td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="TableContent">固定流程：</td>
              <td><input type="hidden" value="熊志远," name="Leader_ID" />
              </td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="TableContent">公文标题：</td>
              <td><input name="flowname" class="BigInput" size="48" maxlength="200" />
              </td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="TableContent">公文说明：</td>
              <td><textarea name="flowinfo" rows="3" wrap="yes" cols="40"></textarea>
              </td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="TableContent">保密级别：</td>
              <td><input type="radio" checked="checked" value="公开" name="secrecy" />
                公开
                <input type="radio" value="保密" name="secrecy" />
                保密
                <input type="radio" value="机密" name="secrecy" />
                机密
                <input type="radio" value="绝密,测试" name="secrecy" />
                绝密,测试 </td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="TableContent">紧急程度：</td>
              <td><input type="radio" checked="checked" value="普通" name="speed" />
                普通
                <input type="radio" value="加急" name="speed" />
                加急
                <input type="radio" value="限时处理" name="speed" />
                限时处理
                <input type="radio" value="立即完成" name="speed" />
                立即完成 </td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="TableContent">选择快速通道：</td>
              <td>否
                <input onclick="show(1)" type="radio" checked="checked" value="0" name="quickpipe" />
                是
                <input onclick="show(0)" type="radio" value="1" name="quickpipe" />
              </td>
            </tr>
            <tr id="ksanswer">
              <td nowrap="nowrap" class="TableContent">选择快速通道理由：</td>
              <td><textarea name="quickreason" cols="50" rows="2" class="BigStatic"></textarea>
              </td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="TableContent">送阅对象：</td>
              <td><input type="hidden" name="TO_ID" />
                  <textarea name="TO_NAME" cols="30" readonly="readOnly" wrap="yes" class="BigStatic"></textarea>
                
                <input name="button" type="button" class="SmallButton" title="添加" onclick="popupDialog()" value="添 加" />
                
                <input name="button" type="button" class="SmallButton" title="清空" onclick="popupDialog()" value="清 空" />
              </td>
            </tr>
            
            <tr>
              <td nowrap="nowrap" class="TableContent">附件：</td>
              <td><input type="hidden" name="To_id" />
                  <textarea name="selectFile" cols="30" readonly="readOnly" wrap="yes" class="BigStatic"></textarea>
                
                <input name="button" type="button" class="SmallButton" onclick="popupDialog()" value="添 加" alt="选择附件" />
                
                <input name="button" type="button" class="SmallButton" title="清空附件" onclick="clear_f('0','93c4e838616fcfe60b0fa00fd23e8267')" value="清 空" />
              </td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="TableContent">附件说明：</td>
              <td><textarea name="ATTACHMENT_COMMENT" rows="3" wrap="yes" cols="40"></textarea>
              </td>
            </tr>
            <!--tr>        <td nowrap class="TableContent">提醒：</td>        <td class="TableData">          <input type="checkbox" name="SMS_REMIND" checked>使用短信息提醒收件人        </td>      </tr-->
            <tr align="middle">
              <td nowrap="nowrap" colspan="2"><input type="hidden" value="right" name="lor" />
                  <input type="hidden" value="93c4e838616fcfe60b0fa00fd23e8267" name="pid" />
                  <input type="hidden" name="ATTACHMENT_NAME" />
                  <input name="button" type="button" class="SmallButton" onclick="CheckForm();" value="提交" /> 
                   
                  <input name="button" type="button" class="SmallButton" onclick="location='index.php'" value="重填" />
              </td>
            </tr>
          </tbody>
        </table>
      </fieldset></td>
    </tr>
  </tbody>
</table>

</body>
</html>
