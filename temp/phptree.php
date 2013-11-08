<?
class TreeList 
{
var $tree=array();
/*********************************************/
/* tree[x][0] -> tree level */
/* tree[x][1] -> image link */
/* tree[x][2] -> image query */
/* tree[x][3] -> item text */
/* tree[x][4] -> item link */
/* tree[x][5] -> link query */
/* tree[x][6] -> link target */
/* tree[x][7] -> text image */
/* tree[x][8] -> last item in subtree */
/*********************************************/

var $p="";//string like B_encode('0|1|3|')
var $explevels=array();//like array(0=>0,1=>1,2=>3,4=>)
var $expand=array();
var $visible=array();
var $img_dir="";//tree images dir
var $max_depth=0;//tree maximum depth
var $text_width=100;
var $exp_link=true;

var $images=array();
/*********************************************/
/* images['expand'] -> expand */
/* images['collapse'] -> collapse */
/* images['vertline'] -> vertline */
/* images['paralline'] -> paralline */
/* images['split'] -> split */
/* images['end'] -> end */
/* images['leaf'] -> leaf */
/* images['space'] -> space */
/*********************************************/

var $html;//Output String

//Class Constructor
function TreeList($tree,$exp="",$img_dir="",$images=array())
{ $this->tree=$tree;
for ($i=0; $i<count($this->tree); $i++)
{ $this->expand[$i]=0;
$this->visible[$i]=0;
$this->tree[$i][8]=0;
}
$this->p=$exp;

//if ($exp!="") $this->explevels = explode("|",B_decode($exp));
if ($exp!="") $this->explevels = explode("|",$exp);
if(!is_array($this->explevels))$this->explevels=array();
sort($this->explevels);
reset($this->explevels);

$this->SetExpand();
$this->SetVisible();
$this->SetImagesDir($img_dir);
$this->SetTreeImages($images);
$this->GetTreeMaxDepth();
}


//Private Methods
function SetExpand()
{ 
$i=0;
while($i<count($this->explevels))
{ $this->expand[$this->explevels[$i]]=1;
$i++;
}
}

function SetVisible()
{ 
$this->visible[0]=1; // root is always visible
for ($i=0; $i<count($this->explevels); $i++)
{ $n=$this->explevels[$i];
if ( ($this->visible[$n]==1) && ($this->expand[$n]==1) )
{ $j=$n+1;
while ( $this->tree[$j][0] > $this->tree[$n][0] )
{ if ($this->tree[$j][0]==$this->tree[$n][0]+1) $this->visible[$j]=1;
$j++;
}
}
}
}

function GetTreeMaxDepth()
{ 
$this->max_depth=0;
for($i=0; $i<count($this->tree); $i++)
{ if ($this->tree[$i][0] > $this->max_depth)
{ $this->max_depth=$this->tree[$i][0];
}
}
}

function GetTreeList()
{ 
$lastlevel=$this->max_depth;
for ($i=count($this->tree)-1; $i>=0; $i--)
{
if ( $this->tree[$i][0] < $lastlevel )
{ for ($j=$this->tree[$i][0]+1; $j<=$this->max_depth; $j++)
{ $levels[$j]=0;
}
}
if ( $levels[$this->tree[$i][0]]==0 )
{ $levels[$this->tree[$i][0]]=1;
$this->tree[$i][8]=1;
}
else
{ $this->tree[$i][8]=0;
}
$lastlevel=$this->tree[$i][0];
}

for ($i=0; $i<$this->max_depth; $i++) $levels[$i]=1;

$this->max_depth++;

$this->html = "\n<table cellspacing=0 cellpadding=0 border=0 cols=".($this->max_depth+3)." width=".(($this->max_depth-1)*16+100+1).">\n";
$this->html.= "<tr>\n";
$this->html.= "\t<td width=1></td>\n";
for ($i=0; $i<$this->max_depth; $i++) $this->html .= "\t<td
width=16></td>\n";

$this->html.= "\t<td width=".$this->text_width."></td></tr>\n";

$cnt=0;
while ($cnt<count($this->tree))
{
if ($this->visible[$cnt])
{
//start new row 
$this->html .= "<tr>\n";

// vertical lines from higher levels
$i=0;
if ($cnt==0) $this->html.="\t<td width=16></td>\n";
while ($i<$this->tree[$cnt][0]-1)
{
if ($levels[$i]==1)
$this->html.= "\t<td height=16><img src=\"".$this->images["vertline"]."\"></td>\n";
else
$this->html.= "\t<td><img src=\"".$this->images["space"]."\" style='height:100%;width:100%'></td>\n";
$i++;
}
// corner at end of subtree or t-split
if ($this->tree[$cnt][8]==1)
{ if ($cnt!=0)
$this->html.= "\t<td><img src=\"".$this->images["end"]."\"></td>\n";
/*else
$this->html.="\t<td width=1></td>\n";*/
$levels[$this->tree[$cnt][0]-1]=0;
}
else
{ $this->html.= "\t<td><img src=\"".$this->images["split"]."\"></td>\n";
$levels[$this->tree[$cnt][0]-1]=1;
}

// Node (with subtree) or Leaf (no subtree)
if ($this->tree[$cnt+1][0]>$this->tree[$cnt][0])
{
// Create expand/collapse parameters
$i=0; $params="?p="; $params1="";
while($i<count($this->expand))
{ if ( ($this->expand[$i]==1) && ($cnt!=$i) || ($this->expand[$i]==0 && $cnt==$i))
{ $params1=$params1.$i;
$params1=$params1."|";
}
$i++;
}
//$params=$params.B_encode($params1)."&".$this->tree[$cnt][3];
$params=$params.$params1."&".$this->tree[$cnt][2];
if ($this->tree[$cnt][1]=="")
$script=$PATH_INFO;
else
$script=$this->tree[$cnt][1];

if ($this->expand[$cnt]==0)
if ($this->exp_link) 
$this->html.= "\t<td><a href=\"".$script.$params."\"><img src=\"".$this->images["expand"]."\" border=no></a></td>\n";
else
$this->html.= "\t<td><img src=\"".$this->images["expand"]."\" border=no></td>\n";
else
if ($this->exp_link)
$this->html.= "\t<td><a href=\"".$script.$params."\"><img src=\"".$this->images["collapse"]."\" border=no></a></td>\n";
else
$this->html.= "\t<td><img src=\"".$this->images["collapse"]."\" border=no></td>\n";
}
else
{
// Tree Leaf
$this->html.= "\t<td><img src=\"".$this->images["leaf"]."\"></td>\n";
}
if ($this->tree[$cnt][7]!="")
{ 
if ($this->tree[$cnt][4]=="")
$this->html.= "\t<td
valign=top>".$this->tree[$cnt][7]."</td>\n";
else
$this->html.= "\t<td
valign=top><a href=\"".$this->tree[$cnt][4]."?p=".$this->p."&".$this->tree[$cnt][5]."\" target=\"".$this->tree[$cnt][6]."\">".$this->tree[$cnt][7]."</a></td>\n";
$tmpcolspan=0;
}
else
{ $tmpcolspan=1;
}
// output item text
if ($this->tree[$cnt][4]=="")
$this->html.= "\t<td
colspan=".($this->max_depth-$this->tree[$cnt][0]+$tmpcolspan)." valign=bottom>".$this->tree[$cnt][3]."</td>\n";
else
$this->html.= "\t<td colspan=".($this->max_depth-$this->tree[$cnt][0]+$tmpcolspan)." valign=bottom><a href=\"".$this->tree[$cnt][4]."?p=".$this->p."&".$this->tree[$cnt][5]."\" target=\"".$this->tree[$cnt][6]."\">".$this->tree[$cnt][3]."</a></td>";

// end row
$this->html.= "</tr>\n";
}//visible

$cnt++;
}
$this->html.= "</table>\n";
}


//Public Methods
function SetTextWidth($w)
{ $this->text_width=$w;
}

function SetExpandLink($r=true)
{ $this->exp_link=$r;
}

function SetImagesDir($dir)
{ $this->img_dir=$dir;
}

function SetTreeImages($images)
{ if (is_array($images))
{ 
if (count($images)>1)
{ $this->images=array(
"expand" => $this->img_dir.$images['expand'],
"collapse" => $this->img_dir.$images['collapse'],
"vertline" => $this->img_dir.$images['vertline'],
"paralline" => $this->img_dir.$images['paralline'],
"split" => $this->img_dir.$images['split'],
"end" => $this->img_dir.$images['end'],
"leaf" => $this->img_dir.$images['leaf'],
"space" => $this->img_dir.$images['space']
);
}
else
{ $this->images=array(
"expand" => $this->img_dir."tree_expand.gif",
"collapse" => $this->img_dir."tree_collapse.gif",
"vertline" => $this->img_dir."tree_vertline.gif",
"paralline" => $this->img_dir."tree_paralline.gif",
"split" => $this->img_dir."tree_split.gif",
"end" => $this->img_dir."tree_end.gif",
// "leaf" => $this->img_dir."tree_leaf.gif",
"leaf" => $this->img_dir."tree_paralline.gif",
"space" => $this->img_dir."tree_space.gif"
);
}
}
else
{ die("Class TreeList: Images setup error!");
}
}

function Output()
{ $this->GetTreeList();
return $this->html;
}
}

?>