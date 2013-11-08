<?php 
// 建立数据库连接 
$link = mysql_connect("localhost", "mysql_user", "mysql_password") 
or die("Could not connect: " . mysql_error()); 
// 获取当前页数 
if( isset($_GET[page]) ){ 
$page = intval( $_GET[page] ); 
} 
else{ 
$page = 1; 
} 
// 每页数量 
$PageSize = 10; 
// 获取总数据量 
$sql = "select count(*) as amount from table"; 
$result = mysql_query($sql); 
$row = mysql_fetch_row($result); 
$amount = $row[amount]; 
// 记算总共有多少页 
if( $amount ){ 
if( $amount < $page_size ){ $page_count = 1; } //如果总数据量小于$PageSize，那么只 
有一页 
if( $amount % $page_size ){ //取总数据量除以每页数的余数 
$page_count = (int)($amount / $page_size) + 1; //如果有余数，则页数等于总数据量除 
以每页数的结果取整再加一 
}else{ 
$page_count = $amount / $page_size; //如果没有余数，则页数等于总数据量除以每页数的 
结果 
} 
} 
else{ 
$page_count = 0; 
} 

// 翻页链接 
$page_string = ; 
if( $page == 1 ){ 
$page_string .= 第一页|上一页|; 
} 
else{ 
$page_string .= <a href=?page=1>第一页</a>|<a 
href=?page=.($page-1).>上一页</a>|; 
} 
if( ($page == $page_count) || ($page_count == 0) ){ 
$page_string .= 下一页|尾页; 
} 
else{ 
$page_string .= <a href=?page=.($page+1).>下一页</a>|<a 
href=?page=.$page_count.>尾页</a>; 
} 
// 获取数据，以二维数组格式返回结果 
if( $amount ){ 
$sql = "select * from table order by id desc limit ". ($page-1)*$page_size .", 
$page_size"; 
$result = mysql_query($sql); 

while ( $row = mysql_fetch_row($result) ){ 
$rowset[] = $row; 
} 
}else{ 
$rowset = array(); 
} 
// 没有包含显示结果的代码，那不在讨论范围，只要用foreach就可以很简单的用得到的二维 
数组来显示结果 
?> 

4、OO风格代码 
以下代码中的数据库连接是使用的pear db类进行处理 

<?php 
// FileName: Pager.class.php 
// 分页类，这个类仅仅用于处理数据结构，不负责处理显示的工作 
Class Pager 
{ 
var $PageSize; //每页的数量 
var $CurrentPageID; //当前的页数 
var $NextPageID; //下一页 
var $PreviousPageID; //上一页 
var $numPages; //总页数 
var $numItems; //总记录数 
var $isFirstPage; //是否第一页 
var $isLastPage; //是否最后一页 
var $sql; //sql查询语句 

function Pager($option) 
{ 
global $db; 
$this->_setOptions($option); 
// 总条数 
if ( !isset($this->numItems) ) 
{ 
$res = $db->query($this->sql); 
$this->numItems = $res->numRows(); 
} 
// 总页数 
if ( $this->numItems > 0 ) 
{ 
if ( $this->numItems < $this->PageSize ){ $this->numPages = 1; } 
if ( $this->numItems % $this->PageSize ) 
{ 
$this->numPages= (int)($this->numItems / $this->PageSize) + 1; 
} 
else 
{ 
$this->numPages = $this->numItems / $this->PageSize; 
} 
} 
else 
{ 
$this->numPages = 0; 
} 

switch ( $this->CurrentPageID ) 
{ 
case $this->numPages == 1: 
$this->isFirstPage = true; 
$this->isLastPage = true; 
break; 
case 1: 
$this->isFirstPage = true; 
$this->isLastPage = false; 
break; 
case $this->numPages: 
$this->isFirstPage = false; 
$this->isLastPage = true; 
break; 
default: 
$this->isFirstPage = false; 
$this->isLastPage = false; 
} 

if ( $this->numPages > 1 ) 
{ 
if ( !$this->isLastPage ) { $this->NextPageID = $this->CurrentPageID + 1; } 
if ( !$this->isFirstPage ) { $this->PreviousPageID = $this->CurrentPageID - 1; } 
} 

return true; 
} 

/*** 
* 
* 返回结果集的数据库连接 
* 在结果集比较大的时候可以直接使用这个方法获得数据库连接，然后在类之外遍历，这样开 
销较小 
* 如果结果集不是很大，可以直接使用getPageData的方式获取二维数组格式的结果 
* getPageData方法也是调用本方法来获取结果的 
* 
***/ 

function getDataLink() 
{ 
if ( $this->numItems ) 
{ 
global $db; 

$PageID = $this->CurrentPageID; 

$from = ($PageID - 1)*$this->PageSize; 
$count = $this->PageSize; 
$link = $db->limitQuery($this->sql, $from, $count); //使用Pear DB::limitQuery方法 
保证数据库兼容性 

return $link; 
} 
else 
{ 
return false; 
} 
} 

/*** 
* 
* 以二维数组的格式返回结果集 
* 
***/ 

function getPageData() 
{ 
if ( $this->numItems ) 
{ 
if ( $res = $this->getDataLink() ) 
{ 
if ( $res->numRows() ) 
{ 
while ( $row = $res->fetchRow() ) 
{ 
$result[] = $row; 
} 
} 
else 
{ 
$result = array(); 
} 

return $result; 
} 
else 
{ 
return false; 
} 
} 
else 
{ 
return false; 
} 
} 

function _setOptions($option) 
{ 
$allow_options = array( 
PageSize, 
CurrentPageID, 
sql, 
numItems 
); 

foreach ( $option as $key => $value ) 
{ 
if ( in_array($key, $allow_options) && ($value != null) ) 
{ 
$this->$key = $value; 
} 
} 

return true; 
} 
} 
?> 
<?php 
// FileName: test_pager.php 
// 这是一段简单的示例代码，前边省略了使用pear db类建立数据库连接的代码 
require "Pager.class.php"; 
if ( isset($_GET[page]) ) 
{ 
$page = (int)$_GET[page]; 
} 
else 
{ 
$page = 1; 
} 
$sql = "select * from table order by id"; 
$pager_option = array( 
"sql" => $sql, 
"PageSize" => 10, 
"CurrentPageID" => $page 
); 
if ( isset($_GET[numItems]) ) 
{ 
$pager_option[numItems] = (int)$_GET[numItems]; 
} 
$pager = @new Pager($pager_option); 
$data = $pager->getPageData(); 
if ( $pager->isFirstPage ) 
{ 
$turnover = "首页|上一页|"; 
} 
else 
{ 
$turnover = "<a href=?page=1&numItems=".$pager->numItems.">首页</a>|<a 
href=?page=".$pager->PreviousPageID."&numItems=".$pager->numItems.">上一页</a>|" 
; 
} 
if ( $pager->isLastPage ) 
{ 
$turnover .= "下一页|尾页"; 
} 
else 
{ 
$turnover .= "<a 
href=?page=".$pager->NextPageID."&numItems=".$pager->numItems.">下一页</a>|<a 
href=?page=".$pager->numPages."&numItems=".$pager->numItems.">尾页</a>"; 
} 

Class MemberPager extends Pager 
{ 
function showMemberList() 
{ 
global $db; 

$data = $this->getPageData(); 
// 显示结果的代码 
// ...... 
} 
} 
/// 调用 
if ( isset($_GET[page]) ) 
{ 
$page = (int)$_GET[page]; 
} 
else 
{ 
$page = 1; 
} 
$sql = "select * from members order by id"; 
$pager_option = array( 
"sql" => $sql, 
"PageSize" => 10, 
"CurrentPageID" => $page 
); 
if ( isset($_GET[numItems]) ) 
{ 
$pager_option[numItems] = (int)$_GET[numItems]; 
} 
$pager = @new MemberPager($pager_option); 
$pager->showMemberList(); 
?> 

