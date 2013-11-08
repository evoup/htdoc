var whizzywig_version = 'Whizzywig v50'; 
//Copyright � 2005, John Goodman - john.goodman(at)unverse.net  *date 060201
//This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
//This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
//A copy of the GNU General Public License can be obtained at: http://www.gnu.org/licenses/gpl.html
//CONFIG VARIABLES (please set outside script)
var buttonPath;  //path to toolbar button images;  unset or "textbuttons" means don't use images
var cssFile;     //url of CSS stylesheet to attach to edit area
var imageBrowse; //path to page for image browser
var linkBrowse;  //path to page for link browser
var idTa;        //id of the textarea to whizzywig (param to makeWhizzyWig)
var gentleClean;  //if true, cleanUp preserves spans, inline styles and classes
//OTHER GLOBALS
var oWhizzy; //object of Whizzy
var rng;  //range at current selection
var sel;  //current selection
var papa; //parent of current selection IE only
var trail = ''; //DOM tree path IE only

function makeWhizzyWig(txtArea, controls){ // make a WhizzyWig from the textarea
 if ((navigator.userAgent.indexOf('Safari') != -1 ) || !document.getElementById || !document.designMode ) {//no designMode
  alert("Whizzywig "+t("editor not available for your browser"));
  return;
 }
 idTa = txtArea;
 var taContent = o(idTa).defaultValue ? o(idTa).defaultValue : o(idTa).innerHTML ? o(idTa).innerHTML: ''; //anything in the textarea?
 taWidth = o(idTa).style.width ? o(idTa).style.width : o(idTa).cols + "em";  //grab the width and...
 taHeight = o(idTa).style.height ? o(idTa).style.height : o(idTa).rows + "em";  //...height from the textarea
 o(idTa).style.color = '#060';
 o(idTa).style.zIndex = '2';
 if (!o(idTa).rows) o(idTa).rows='15';//IE won't use %
 h(idTa);
 var frm=o(idTa).parentNode;
 if (frm.addEventListener) frm.addEventListener("submit", syncTextarea, false);
  else frm.attachEvent("onsubmit", syncTextarea);

 w('<style type="text/css">button {vertical-align:middle;padding:0;margin:1px 0;background:#fff;border:1px solid #CCC} button img{vertical-align:middle;margin:-1px} select{vertical-align:middle;margin:1px}  .ctrl {background:#fff; border:1px solid #fff; padding:0px;width:'+taWidth+'} #sourceTa{color:#060;font-family:mono;}</style>');
 var sels = 'formatblock fontname fontsize';
 var buts = ' bold italic underline | left center right | number bullet indent outdent | undo redo  | color hilite rule | link image table | clean html file quotation mycodes superscript subscript wmp real swf flv separator newpage uploader emotions spellcheck';
 var tbuts = ' tstart add_row_above add_row_below delete_row | add_column_before add_column_after delete_column | table_in_cell';
 var t_end = ''; //table controls end, if needed
 buts += tbuts;
 controls = controls.toLowerCase();
 if (!controls || controls == "all") controls = sels +' newline '+ buts +' source';
 else controls += tbuts;
 w('<div id="CONTROLS" class="ctrl">');
 gizmos = controls.split(' ');
 for (var i = 0; i < gizmos.length; i++) {
   if (gizmos[i]){ //make buttons and selects for toolbar, in order requested
      if (gizmos[i] == 'tstart') {
        w('<div id="TABLE_CONTROLS" style="display:none" unselectable="on">');
        t_end = '</div>';
      }
      else if (gizmos[i] == '|') w(' <big style="padding-bottom:2em">|</big> ');
      else if (gizmos[i] == 'newline') w('<br>');

      //Add customized areas
	  else if (gizmos[i] == 'customized') w('<div id="CustomizedArea" style="display: none"></div>');
	  //End customized areas

    else if (sels.indexOf(gizmos[i]) != -1) makeSelect(gizmos[i])
    else if (buts.indexOf(gizmos[i]) != -1) makeButton(gizmos[i]);
   }
 }
 w(t_end) //table controls end
 w(fGo('LINK'));
 if (linkBrowse) w('<input type="button" onclick=doWin("'+linkBrowse+'"); value="'+t("Browse")+'"> ');
 w(t('Link address (URL)')+': <input type="text" id="lf_url" size="60"><br><input type="checkbox" id="lf_new">'+t("Open link in new window")+'<br>'+fNo(t("OK"),"insertLink()")+'</div>');//LINK_FORM end
 w(fGo('IMAGE'));
 if (imageBrowse) w('<input type="button" onclick=doWin("'+imageBrowse+'"); value="'+t("Browse")+'"> ');
 w(t('Image address (URL)')+': <input type="text" id="if_url" size="50"> <label title='+t("to display if image unavailable")+'><br>'+t("Alternate text")+':<input id="if_alt" type="text" size="50"></label><br>'+t("Align")+':<select id="if_side"><option value="none">'+t("normal")+'</option><option value="left">'+t("left")+'</option><option value="right">'+t("right")+'</option></select> '+t("Border")+':<input type="text" id="if_border" size="20" value="none" title="'+t("number or CSS e.g. 3px maroon outset")+'"> '+t("Margin")+':<input type="text" id="if_margin" size="20" value="0" title="'+t("number or CSS e.g. 5px 1em")+'"><br>'+fNo(t("Insert Image"),"insertImage()")+'</div>');//IMAGE_FORM end
 w(fGo('TABLE')+t("Rows")+':<input type="text" id="tf_rows" size="2" value="3"> <select id="tf_head"><option value="0">'+t("No header row")+'</option><option value="1">'+t("Include header row")+'</option></select> '+t("Columns")+':<input type="text" id="tf_cols" size="2" value="3"> '+t("Border width")+':<input type="text" id="tf_border" size="2" value="1"><br> '+fNo(t("Insert Table"),"makeTable()")+'</div>');//TABLE_FORM end
 w(fGo('COLOR')+'<input type="hidden" id="cf_cmd"><div style="background:#000;padding:1px;height:22px;width:125px;float:left"><div id="cPrvw" style="background-color:red; height:100%; width:100%"></div></div> <input type=text id="cf_color" value="red" size=17 onpaste=vC(value) onblur=vC(value)> <button type="button" onmouseover=vC() onclick=sC()>'+t("OK")+'</button>  <button type="button" onclick="hideDialogs();">'+t("Cancel")+' </button><br> '+t("click below or enter a")+' <a href="http://www.unverse.net/colortable.htm" target="_blank">'+t("color name")+'</a><br clear=all> <table border=0 cellspacing=1 cellpadding=0 width=480 bgcolor="#000000">');



 var wC = new Array("00","33","66","99","CC","FF")  //color table
 for (i=0; i<wC.length; i++){
  w("<tr>");
  for (j=0; j<wC.length; j++){
   for (k=0; k<wC.length; k++){
    var clr = wC[i]+wC[j]+wC[k];
    w('<td style="background:#'+clr+';height:12px;width:12px" onmouseover=vC("#'+clr+'") onclick=sC("#'+clr+'")></td>');
   }
  }
  w('</tr>');
 }
 w('</table></div>'); //end color table,COLOR_FORM
 w('</div>'); //controls end
 w('<div class="ctrl" id="showWYSIWYG" style="display:none"><button type="button" onclick="showDesign();">'+t("Hide HTML")+'</button></div>');
 
 w('<iframe style="width:'+taWidth+';height:'+taHeight+';font-size:9pt;font-family:Verdana;border:1px solid #CCC;" src="javascript:;" id="whizzyWig" frameborder=0></iframe><br>');

 w('<a href="http://www.unverse.net" style="color:buttonface" title="'+whizzywig_version+'">.</a> ');
 var startHTML = "<html>\n";
 startHTML += "<head>\n";
 if (cssFile) {
  startHTML += "<link media=\"all\" type=\"text/css\" href=\"" + cssFile + "\" rel=\"stylesheet\">\n";
 }
 startHTML += "</head>\n";
 startHTML += "<body>\n";
 startHTML += tidyD(taContent);
 startHTML += "</body>\n";
 startHTML += "</html>";
 if (document.frames) { //IE
  oWhizzy = frames['whizzyWig'];
 } else { //Moz
  oWhizzy = o("whizzyWig").contentWindow;
  try {
    o("whizzyWig").contentDocument.designMode = "on";
  } catch (e) { //not set? try again
    setTimeout('o("whizzyWig").contentDocument.designMode = "on";', 100);
  }
  oWhizzy.addEventListener("keypress", kb_handler, true); //make keyboard shortcuts work for Moz
 }
 oWhizzy.document.open();
 oWhizzy.document.write(startHTML);
 oWhizzy.document.close();
 if (document.frames) oWhizzy.document.designMode = "On";
 oWhizzy.focus();
 whereAmI();
} //end makeWhizzyWig


function makeButton(button){  // assemble the button requested NEW
 var ucBut = button.substring(0,1).toUpperCase();
 ucBut += button.substring(1);
 ucBut = t(ucBut.replace(/_/g,' '));
   var butHTML = '<img src="'+buttonPath+button+'.gif"  alt="'+ucBut+'" title="'+ucBut+'" onError="this.parentNode.innerHTML=this.alt") style="background-color:#fff; border: 1px solid #fff; padding: 2px; cursor: pointer;" onclick=makeSo("'+button+'") onmouseover="this.style.border=\'1px solid #999\'; this.style.backgroundColor=\'#CCC\'" onmouseout="this.style.border=\'1px solid #fff\'; this.style.backgroundColor=\'#fff\'">';
 w(butHTML);
}

function fGo(id){ return '<div id="'+id+'_FORM" style="display:none"><hr> '; }//new form

function fNo(txt,go){ //form do it/cancel buttons
 return ' <input type="button" onclick="'+go+'" value="'+txt+'"> <input type="button" onclick="hideDialogs();" value='+t("Cancel")+'>';
}

function makeSelect(select){ // assemble the <select> requested
 if (select == 'formatblock') {
  var h = "Heading";
 var values = ["<p>", "<p>", "<h1>", "<h2>", "<h3>", "<h4>", "<h5>", "<h6>", "<address>", "insHTML<big>",  "insHTML<small>", "insHTML<code>", "<pre>"];
 var options = [t("Choose style"), t("Paragraph"), t(h)+" 1 ", t(h)+" 2 ", t(h)+" 3 ", t(h)+" 4 ", t(h)+" 5 ", t(h)+" 6", t("Address"), t("Big"), t("Small"), t("Computer code"), t("Fixed width<pre>")];
 } else if (select == 'fontname') {
 var values = ["Verdana, Arial, Helvetica, sans-serif", "Arial, Helvetica, sans-serif", "Comic Sans MS, fantasy", "Courier New, Courier, mono", "Georgia, serif", "Times New Roman, Times, serif", "Verdana, Arial, Helvetica, sans-serif"];
 var options = [t("Font"), "Arial", "Comic", "Courier New", "Georgia", "Times New Roman", "Verdana"];
 } else if (select == 'fontsize') {
  var values = ["3", "1", "2", "3", "4", "5", "6", "7"];
  var options = [t("Font size"), "1 "+t("Small"), "2", "3", "4", "5", "6", "7 "+t("Big")];
 } else { return }
 w('<select id="' + select + '" onchange="doSelect(this.id);">');
 for (var i = 0; i < values.length; i++) {
  w('<option value="' + values[i] + '">' + options[i] + '</option>');
 }
 w('</select>');
}

function makeSo(command, option) {  //format selected text or line in the whizzy
 whereAmI();
 hideDialogs();
 if (!document.all) oWhizzy.document.execCommand('useCSS',false, true); //no spans for bold, italic
 if ("leftrightcenterjustify".indexOf(command) !=-1) command = "justify" + command;
 else if (command == "number") command = "insertorderedlist";
 else if (command == "bullet") command = "insertunorderedlist";
 else if (command == "rule") command = "inserthorizontalrule";
 switch (command) {
  case "color": o('cf_cmd').value="forecolor"; if (textSel()) s('COLOR_FORM'); break;
  case "hilite" : o('cf_cmd').value="backcolor"; if (textSel()) s('COLOR_FORM'); break;
  case "image" : s('IMAGE_FORM'); break;
  case "link" : if (textSel()) s('LINK_FORM'); break;
  case "html" : showHTML(); break;
  case "table" : doTable(); break;
  case "delete_row" : doRow('delete','0'); break;
  case "add_row_above" : doRow('add','0'); break;
  case "add_row_below" : doRow('add','1'); break;
  case "delete_column" : doCol('delete','0'); break;
  case "add_column_before" : doCol('add','0'); break;
  case "add_column_after" : doCol('add','1'); break;
  case "table_in_cell" : hideDialogs(); s('TABLE_FORM'); break;
  case "clean" : cleanUp(); break;
  case "spellcheck" : spellCheck(); break;

  //Start Customized ones by Bob
  case "file" : addFile(); break;
  case "quotation" : addQuotation(); break;
  case "mycodes" : addCode(); break;
  case "superscript" : if (textSel()) addSuperscript(); break;
  case "subscript" : if (textSel()) addSubscript(); break;
  case "wmp" : addMedia('wmp'); break;
  case "real" : addMedia('real'); break;
  case "swf" : addMedia('swf'); break;
  case "flv" : addMedia('flv'); break;
  case "separator" : insHTML('[separator]'); ajaxCheckSummary (oWhizzy.document.body.innerHTML); break;
  case "newpage" : insHTML('[newpage]'); ajaxCheckSummary (oWhizzy.document.body.innerHTML); break;
  case "uploader" : makeUploader(); break;
  case "emotions" : addEmots(); break;
  //End Customized ones
  
  default: oWhizzy.document.execCommand(command, false, option);
 }
 oWhizzy.focus;
}

function doSelect(selectname) {  //select on toolbar used - do it
 whereAmI();
 var idx = o(selectname).selectedIndex;
 var selected = o(selectname).options[idx].value;

 if ((selected.indexOf('insHTML') === 0)) {
  if (textSel()) insHTML(selected.replace(/insHTML/,''));
 } else {
 var cmd = selectname;
 oWhizzy.document.execCommand(cmd, false, selected);
 }
 o(selectname).selectedIndex = 0;
 oWhizzy.focus();
}

function vC(colour) { // view Colour
 if (!colour) colour = o('cf_color').value;
 o('cPrvw').style.backgroundColor = colour;
 o('cf_color').value = colour;
}

function sC(color) {  //set Color for text or background
 hideDialogs();
 var cmd = o('cf_cmd').value;
 if  (!color) color = o('cf_color').value;
 if (document.selection) rng.select(); //else IE gets lost
 if ((cmd == "backcolor") && (!document.all)) insHTML('<span style="background-color:'+color+'">');
 else oWhizzy.document.execCommand(cmd, false, color);
 oWhizzy.focus();
}

function insertLink(URL) {
 hideDialogs();
 if (!URL) URL = o("lf_url").value;
 cmd = URL ? "createlink" : "unlink";
 if (document.selection) rng.select(); //else IE gets lost
 if (URL && o("lf_new").checked) insHTML('<a href="'+URL+'" target="_blank">');
 else oWhizzy.document.execCommand(cmd, false, URL);
 oWhizzy.focus();
}

function insertImage(URL, side, border, margin, alt) { // insert image as specified
 hideDialogs();
 if (!URL) URL = o("if_url").value;
 if (URL) {
 if (!alt) alt = o("if_alt").value ? o("if_alt").value: URL.replace(/.*\/(.+)\..*/,"$1");
 img = '<img alt="' + alt + '" src="' + URL +'" ';
 if (!side) side = o("if_side").value;
 if ((side == "left") || (side == "right")) img += 'align="' + side + '"';
 if (!border)  border = o("if_border").value;
 if (border.match(/^\d+$/)) border+='px solid';
 if (!margin) margin = o("if_margin").value;
 if (margin.match(/^\d+$/)) margin+='px';
 if (border || margin) img += 'style="border:' + border + ';margin:' + margin + ';"';
 img += '/>';
  insHTML(img);
 }
}

function doTable(){ //show table controls if in a table, else make table
 if (trail.indexOf('TABLE') > 0) s('TABLE_CONTROLS');
  else s('TABLE_FORM');
}

function doRow(toDo,below) { //insert or delete a table row
 var paNode = papa;
 while (paNode.tagName != "TR") paNode = paNode.parentNode;
 var tRow = paNode.rowIndex;
 var tCols = paNode.cells.length;
 while (paNode.tagName != "TABLE") paNode = paNode.parentNode;
 if (toDo == "delete") paNode.deleteRow(tRow);
 else {
  var newRow = paNode.insertRow(tRow+parseInt(below)); //1=below  0=above
   for (i = 0; i < tCols; i++){
    var newCell = newRow.insertCell(i);
    newCell.innerHTML = "#";
   }
 }
}

function doCol(toDo,after) { //insert or delete a column
 var paNode = papa;
 while (paNode.tagName != 'TD') paNode = paNode.parentNode;
 var tCol = paNode.cellIndex;
 while (paNode.tagName != "TABLE") paNode = paNode.parentNode;
 var tRows = paNode.rows.length;
 for (i = 0; i < tRows; i++){
  if (toDo == "delete") paNode.rows[i].deleteCell(tCol);
  else {
   var newCell = paNode.rows[i].insertCell(tCol+parseInt(after)); //if after = 0 then before
   newCell.innerHTML = "#";
  }
 }
}

function makeTable() { //insert a table
 hideDialogs();
 var rows = o('tf_rows').value;
 var cols = o('tf_cols').value;
 var border = o('tf_border').value;
 var head = o('tf_head').value;
 if ((rows > 0) && (cols > 0)) {
  var table = '<table border="' + border + '">';
  for (var i=1; i <= rows; i++) {
   table = table + "<tr>";
   for (var j=1; j <= cols; j++) {
    if (i==1) {
     if (head=="1") table += "<th>Title"+j+"</th>"; //Title1 Title2 etc.
     else table += "<td>"+j+"</td>";
    }
    else if (j==1) table += "<td>"+i+"</td>";
   else table += "<td>#</td>";
   }
   table += "</tr>";
  }
  table += " </table>";
  insHTML(table);
 }
}

function doWin(URL) {  //popup  for browse function
 window.open(URL,'popWhizz','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=640,height=480,top=100');
}

function spellCheck() {  //check spelling with plugin if available
 if (document.all) {
 try {
  var tmpis = new ActiveXObject("ieSpell.ieSpellExtension");
  tmpis.CheckAllLinkedDocuments(document);
 }
 catch(exception) {
  if(exception.number==-2146827859) {
  if (confirm("ieSpell is not installed on your computer. \n Click [OK] to go to download page."))
    window.open("http://www.iespell.com/download.php","DownLoad");
  } else {
   alert("Error Loading ieSpell: Exception " + exception.number);
  }
 }
 } else {
   if (confirm("Click [OK] for instructions to download and install SpellBound on your computer. \n If you already have it, click [Cancel] then right click in the edit area and select 'Check Spelling'."))
     window.open("http://spellbound.sourceforge.net/install","DownLoad");
 }
}

function cleanUp(){  //clean up crud inserted by Micro$oft Orifice
 oWhizzy.document.execCommand("removeformat",false,null);
 whereAmI();
 var h = oWhizzy.document.body.innerHTML;
 if (!gentleClean) {
	h = h.replace(/<\/?SPAN[^>]*>/gi, "");
	h = h.replace(/<\/?DEL[^>]*>/gi, "");
	h = h.replace(/<\/?INS[^>]*>/gi, "");
  h = h.replace(/ CLASS=\"?[^\"]*\"?/gi, "");
  h = h.replace(/ STYLE=\"?[^\"]*\"?/gi, "");
 }
 h = h.replace(/<\/?PMARGIN[^>]*>/gi, "");
 h = h.replace(/<\/?DIR>/gi, "");
 h = h.replace(/<\/?FONT[^>]*>/gi, "");
 h = h.replace(/ class=\"?Mso[A-Za-z]*\"?/gi, "");
 h = h.replace(/<\/?o:[^>]*>/gi, "");
 h = h.replace(/<\/?st1:[^>]*>/gi, "");
 h = h.replace(/�/g,'-'); //long -
 h = h.replace(/[��]/g, "'"); //single smartquotes �� 
 h = h.replace(/[��]/g, '"'); //double smartquotes ��
 h = h.replace(/align="?justify"?/gi, ""); //justify sends some browsers mad
 h = h.replace(/<(TABLE|TD)(.*)WIDTH[^A-Za-z>]*/gi, "<$1$2"); //no fixed width tables
 h = h.replace(/<([^>]+)><\/\1>/gi, ""); //empty tag
 oWhizzy.document.body.innerHTML = h;
}

function hideDialogs() {
 h('LINK_FORM');
 h('IMAGE_FORM');
 h('COLOR_FORM');
 h('TABLE_FORM');
 h('TABLE_CONTROLS');
}

function showDesign() {
 oWhizzy.document.body.innerHTML = tidyD(o(idTa).value);
 h(idTa);
 h('showWYSIWYG');
 s('CONTROLS');
 s('whizzyWig');
 if(o("whizzyWig").contentDocument) o("whizzyWig").contentDocument.designMode = "on"; //FF loses it on hide
 oWhizzy.focus();
}

function showHTML() { 
 var t = (window.get_xhtml) ? get_xhtml(oWhizzy.document.body) : oWhizzy.document.body.innerHTML;
 o(idTa).value = tidyH(t);
 h('CONTROLS');
 h('whizzyWig');
 s(idTa);
 s('showWYSIWYG');
 o(idTa).focus();
}

function syncTextarea() { //tidy up before we go-go
 var b = oWhizzy.document.body;
 if (o(idTa).style.display == 'block') b.innerHTML = o(idTa).value;
 b.innerHTML = tidyH(b.innerHTML);
 o(idTa).value = (window.get_xhtml) ? get_xhtml(b) : b.innerHTML;
}

function tidyD(h){ //FF designmode likes <B>,<I>...
 h = h.replace(/<(\/?)strong>/gi, "<$1B>"); 
 h = h.replace(/<(\/?)em>/gi, "<$1I>");
 return h;
}

function tidyH(h){ //...but <B>,<I> deprecated
 h = h.replace(/<([A-Za-z1-6]+)><\/\1>/g, ""); //empty tag
 h = h.replace(/(<\/?)[Bb]>/g, "$1strong>");
 h = h.replace(/(<\/?)[Ii]>/g, "$1em>");
 return h;
}

function kb_handler(evt) { // keyboard controls for Mozilla
 var w = evt.target.id;
 if (evt.ctrlKey) {
  var key = String.fromCharCode(evt.charCode).toLowerCase();
  var cmd = '';
  switch (key) {
   case 'b': cmd = "bold"; break;
   case 'i': cmd = "italic"; break;
   case 'u': cmd = "underline"; break;
   case 'l': cmd = "link"; break;
   case 'm': cmd = "image"; break;
  };
  if (cmd) {
   makeSo(cmd, true);
   evt.preventDefault();  // stop the event bubble
   evt.stopPropagation();
  }
 }
}

function insHTML(html) { // insert arbitrary HTML at current selection
whereAmI();
 if (!html) html = prompt("Enter some HTML to insert:", "");
 if (!html) return;
 if (document.selection) {
  rng.select(); //else IE gets lost
  html = html + rng.htmlText;
  try { oWhizzy.document.selection.createRange().pasteHTML(html); } //
  catch (e) { }// catch error if range is bad for IE
 } else { //Moz
  if (sel) html = html + sel;
  var fragment = oWhizzy.document.createDocumentFragment();
  var div = oWhizzy.document.createElement("div");
  div.innerHTML = html;
  while (div.firstChild) {
   fragment.appendChild(div.firstChild);
  }
  sel.removeAllRanges();
  rng.deleteContents();
  var node = rng.startContainer;
  var pos = rng.startOffset;
  switch (node.nodeType) {
   case 3: if (fragment.nodeType == 3) {
    node.insertData(pos, fragment.data);
    rng.setEnd(node, pos + fragment.length);
    rng.setStart(node, pos + fragment.length);
   } else {
    node = node.splitText(pos);
    node.parentNode.insertBefore(fragment, node);
    rng.setEnd(node, pos + fragment.length);
    rng.setStart(node, pos + fragment.length);
   }
   break;
   case 1: node = node.childNodes[pos];
    node.parentNode.insertBefore(fragment, node);
    rng.setEnd(node, pos + fragment.length);
    rng.setStart(node, pos + fragment.length);
   break;
  }
  sel.addRange(rng);
 }
 oWhizzy.focus();
}

function whereAmI() {//get current selected range if available 
 oWhizzy.focus();
 if (document.all) { //IE
  sel = oWhizzy.document.selection;
  if (sel != null) {
   rng = sel.createRange();
   switch (sel.type) {
    case "Text":case "None":
     papa = rng.parentElement(); break;
    case "Control":
     papa = rng.item(0); break;
    default:
     papa = frames['whizzyWig'].document.body;
   }
   var paNode = papa;
   trail = papa.tagName + '>' +sel.type;
   while (paNode.tagName != 'BODY') {
    paNode = paNode.parentNode;
    trail = paNode.tagName + '>' + trail;
   }
   window.status = trail;
  }
 } else { //Moz
  sel = oWhizzy.getSelection();
  if (sel != null) rng = sel.getRangeAt(sel.rangeCount - 1).cloneRange();
 }
}

function textSel() {
	if (sel != "") return true; 
	else {alert(t("Select some text first")); return false;}
}

function s(id) {o(id).style.display = 'block';} //show element
function h(id) {o(id).style.display = 'none';} //hide element
function o(id) { return document.getElementById(id); } //get element by ID
function w(str) { return document.write(str); } //document write
function t(key) {return (window.language && language[key]) ? language[key] :  key;} //translation


/* Fix by Bob */
function getMyValue(areaid) { //Firefox doesn't get the content? Fix it
	document.getElementById(areaid).value=oWhizzy.document.body.innerHTML;
}

/* Extension by Bob */
function addFile() {
	hideCustomized();
	var inTxt="<hr>"+t("File address (URL)")+': <input type=text size=80 id=file_addr><br><input type=checkbox id=file_regi> '+t("For registered users only")+'<br>'+MyfNo(t('OK'), 'addFileAction()');
	document.getElementById('CustomizedArea').innerHTML=inTxt;
}

function addMedia(mediatype) {
	hideCustomized();
	var inTxt="<hr>"+t("Media file URL")+': <input type=text size=80 id=media_addr><br>'+t("Width")+': <input type=text id=media_widt value=400> &nbsp; '+t("Height")+': <input type=text id=media_heig value=300><input type=hidden id=media_type value='+mediatype+'><br>'+MyfNo(t('OK'), 'addMediaAction()');
	document.getElementById('CustomizedArea').innerHTML=inTxt;
}


function addEmots() {
	hideCustomized();
	var inTxt="<hr>"+t("Select a emotion")+': <br>'+document.getElementById('myEmotsel').innerHTML;
	document.getElementById('CustomizedArea').innerHTML=inTxt;
}


function addQuotation() {
	if (document.all) { //Mozilla has a strange behavior when < > are in the selected part
		insHTML('<div class="quote"><div class="quote-title">'+t('Quote')+'</div><div class="quote-content">');
		return;
	} else { //Mozilla has a strange behavior when < > are in the selected part
		if (sel != "") {
			alert (t('Because of a serious problem will ocuur in Mozilla, you cannot add this format to selected words. Please unselect all words, and press this button again.'));
			return;
		}
		else insHTML('<div class="quote"><div class="quote-title">'+t('Quote')+'</div><div class="quote-content">'+t('Input your stuff here'));
	}
}


function addCode() {
	if (document.all) { //Mozilla has a strange behavior when < > are in the selected part
		insHTML('<div class="code">');
		return;
	} else { //Mozilla has a strange behavior when < > are in the selected part
		if (sel != "") {
			alert (t('Because of a serious problem will ocuur in Mozilla, you cannot add this format to selected words. Please unselect all words, and press this button again.'));
			return;
		}
		else insHTML('<div class="code">'+t('Input your stuff here'));
	}
}

function addSubscript() {
	insHTML('<sub>');
}

function addSuperscript() {
	insHTML('<sup>');
}

function addFileAction() {
	var currentchk=document.getElementById('file_addr');
	var methodchk;
	if (currentchk) {
		if (currentchk.value=='') {
			alert (t("Please input a file address!"));
		}
		else {
			if (document.getElementById('file_regi').checked) methodchk='sfile';
			else methodchk='file';
			insHTML('['+methodchk+']'+currentchk.value+'[/'+methodchk+']');
			hideCustomized();
		}
	}
}

function addMediaAction() {
	var currentchk=document.getElementById('media_addr');
	if (currentchk) {
		if (currentchk.value=='') {
			alert (t("Please input a file address!"));
		}
		else {
			var mediatype=document.getElementById('media_type').value;
			insHTML('['+mediatype+'='+document.getElementById('media_widt').value+','+document.getElementById('media_heig').value+']'+currentchk.value+'[/'+mediatype+']');
			hideCustomized();
		}
	}
}

function insertemot (emotcode) {
	var emot="[emot]"+emotcode+"[/emot]";
	insHTML(emot);
	hideCustomized();
}

function MyfNo(txt,go){ //form do it/cancel buttons
	return ' <input type="button" onclick="'+go+'" value="'+txt+'"> <input type="button" onclick="hideCustomized();" value='+t("Cancel")+'>';
}

function hideCustomized() {
	var chkcustomized=document.getElementById('CustomizedArea');
	if (chkcustomized) {
		if (chkcustomized.style.display=='none') chkcustomized.style.display='block';
		else chkcustomized.style.display='none';
	}
}

function makeUploader() {
	var panelmoreless=document.getElementById('CustomizedArea');
	htmlin="<iframe width=90% frameborder=0 height=200 frameborder=0 src='admin.php?act=upload'></iframe>";
    if(panelmoreless){
      if(panelmoreless.style.display=='none'){
        panelmoreless.style.display='block';
		panelmoreless.innerHTML=htmlin;
		} else{
			panelmoreless.style.display='none';
		}
    }
}


function ajaxCheckSummary (str) {
	var gourl="editor/"+editortype+"/summarycheck.php";
	var postData = "unuse=unuse&strcheck="+blogencode(str);
	makeRequest(gourl, 'ajaxCheckSummaryAct', 'POST', postData);
}

function ajaxCheckSummaryAct (str) {
	if (http_request.readyState == 4) {
		if (http_request.status == 200) {
			var messagereturn = http_request.responseText;
			if (messagereturn.indexOf("<boblog_ajax::error>")!=-1) {
				messagereturn=messagereturn.replace("<boblog_ajax::error>", '');
				alert (warn[0]+'<'+messagereturn+'>'+warn[1]);
				showHTML();
				return false;
			} 
		} else {
		}
	}
}
