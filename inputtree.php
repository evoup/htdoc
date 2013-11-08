<?php
//使用方法<SCRIPT LANGUAGE="JavaScript" src="dbtreeselect.asp?id=id&pid=pid&text=text&table=table&sname=selectname&s_v=1&child=0/1"></SCRIPT>
//dim db_id,db_pid,db_text,db_table,select_name,select_value,dbpath
$db_id=$_GET["id"];
$db_pid=$_GET["pid"];// 父ID
$db_text=$_GET["text"];// 名
$db_table=$_GET["table"];// 表名
$select_name=$_GET["s_name"];// 下拉菜单名
$select_value=trim($_GET["s_v"]); //值
$MustChildFolder=$_GET["child"]; //是否必须选择没有子类的分类


echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";
echo "<!--\n";


echo "var select_value = \"".$select_value."\"\n";





echo "function TreeView(obj,target){\n";
echo " this.obj=obj;\n";
echo " this.root=new node(-1);\n";
echo " this.nodes=[]\n";
echo " this.currentNode=null;\n";
echo " this.html=\"\"\n";
echo " this.config={\n";
echo "\n";
echo "  blank  :'┣━',\n";
echo "  line  :'┣━'\n";
echo " }\n";
echo " for(i in this.config){var tem=this.config[i];this.config[i]=new Image();this.config\n";
echo "[i].txt=tem}\n";
echo "}\n";
echo "\n";
echo "function node(id,pid,txt){\n";
echo " this.id=id\n";
echo " this.pid=pid\n";
echo " this.txt=txt\n";
echo " this.indent=\"\"\n";
echo " this.open=false;\n";
echo " this.lastNode=false;\n";
echo " this.hasNode=false\n";
echo "}\n";
echo "\n";
echo "\n";
echo "TreeView.prototype.add=function(id,pid,txt){\n";
echo " var itemTxt=txt?txt:\"New Item\"\n";
echo " this.nodes[this.nodes.length]=new node(id,pid,itemTxt)\n";
echo "}\n";
echo "\n";
echo "TreeView.prototype.DrawTree=function(pNode){\n";
echo " var str=\"\"\n";
echo " for(var i=0;i<this.nodes.length;i++){\n";
echo "  if(this.nodes[i].pid==pNode.id){\n";
echo "   str+=this.DrawNode(this.nodes[i].id,i)\n";
echo "  }\n";
echo " }\n";
echo " return str\n";
echo "}\n";
echo "\n";
echo "TreeView.prototype.ChkPro=function(pNode){\n";
echo " var last;\n";
echo " for(var n=0;n<this.nodes.length;n++){\n";
echo "  if(this.nodes[n].pid==pNode.id)pNode.hasNode=true;\n";
echo "  if (this.nodes[n].pid == pNode.pid) last= this.nodes[n].id;\n";
echo " }\n";
echo " if (last==pNode.id) pNode.lastNode = true;\n";
echo "}\n";
echo "\n";
echo "TreeView.prototype.DrawNode=function(id,nid){\n";
echo " var str=\"\"\n";
echo " var select_ed = \"\"\n";
echo " var nNode=this.nodes[nid]\n";
echo " this.DrawLine(nNode,nNode)\n";
echo " if(nNode.hasNode)\n";
echo " nNode.indent+=(nNode.hasNode?\"\":\"\")\n";
echo " if (select_value==id){select_ed = \" selected\"}else{select_ed = \"\";}\n";

if ($MustChildFolder == "1") then
?>












 
 
 
 
 if(nNode.hasNode){
 str+="<option value="/\"\">"+nNode.indent+this.DrawLink(nid)+"</option>"
 str+=this.DrawTree(nNode)
 }
 else
 {
 str+=""<option value="/\""+id+"\""+select_ed+">"+nNode.indent+this.DrawLink(nid)+""</option>"
 }
<%else%>
 str+="<option value="/\""+id+"\""+select_ed+">"+nNode.indent+this.DrawLink(nid)+"</option>"
 if(nNode.hasNode){
 str+=this.DrawTree(nNode)
 }
<%end" if%>
 return str;
}


TreeView.prototype.DrawLine=function(nNode,tem){
 for(var i=1;i<this.nodes.length;i++){
  if(this.nodes[i].id==tem.pid){
  nNode.indent=(this.nodes[i].lastNode?this.config.blank.txt:this.config.line.txt)+nNode.indent
  this.DrawLine(nNode,this.nodes[i])
  }
 }
}
TreeView.prototype.DrawLink=function(nid){
 var nNode=this.nodes[nid]
 return nNode.txt
}

TreeView.prototype.toString=function(){
 var str=""
 for(var i=0;i<this.nodes.length;i++)this.ChkPro(this.nodes[i])
 str+=this.DrawTree(this.root)
 return str
}

var dbtree=new TreeView('dbtree','main')
dbtree.add(0,-1,'根目录');
<%
dim select_sql
select_sql = "Select " & db_id & "," & db_pid & "," & db_text & " from [" & db_table & "]"
Set rs = Conn.Execute(select_sql)
While rs.EOF =flase
Thisid=rs(db_id)
%>
dbtree.add(<%=rs(db_id)%>,<%=rs(db_pid)%>,'<%=rs(db_text)%>');<%
rs.MoveNext
Wend
rs.close 
Set rs=nothing
conn.close 
Set conn=nothing 
%>
document.write("<select name='<% = select_name %>'><option value=\"\">请选择</option>"+dbtree+"</select>");
 
//-->
</SCRIPT>


