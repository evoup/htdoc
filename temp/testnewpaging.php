<?php 
// �������ݿ����� 
$link = mysql_connect("localhost", "mysql_user", "mysql_password") 
or die("Could not connect: " . mysql_error()); 
// ��ȡ��ǰҳ�� 
if( isset($_GET[page]) ){ 
$page = intval( $_GET[page] ); 
} 
else{ 
$page = 1; 
} 
// ÿҳ���� 
$PageSize = 10; 
// ��ȡ�������� 
$sql = "select count(*) as amount from table"; 
$result = mysql_query($sql); 
$row = mysql_fetch_row($result); 
$amount = $row[amount]; 
// �����ܹ��ж���ҳ 
if( $amount ){ 
if( $amount < $page_size ){ $page_count = 1; } //�����������С��$PageSize����ôֻ 
��һҳ 
if( $amount % $page_size ){ //ȡ������������ÿҳ�������� 
$page_count = (int)($amount / $page_size) + 1; //�������������ҳ���������������� 
��ÿҳ���Ľ��ȡ���ټ�һ 
}else{ 
$page_count = $amount / $page_size; //���û����������ҳ������������������ÿҳ���� 
��� 
} 
} 
else{ 
$page_count = 0; 
} 

// ��ҳ���� 
$page_string = ; 
if( $page == 1 ){ 
$page_string .= ��һҳ|��һҳ|; 
} 
else{ 
$page_string .= <a href=?page=1>��һҳ</a>|<a 
href=?page=.($page-1).>��һҳ</a>|; 
} 
if( ($page == $page_count) || ($page_count == 0) ){ 
$page_string .= ��һҳ|βҳ; 
} 
else{ 
$page_string .= <a href=?page=.($page+1).>��һҳ</a>|<a 
href=?page=.$page_count.>βҳ</a>; 
} 
// ��ȡ���ݣ��Զ�ά�����ʽ���ؽ�� 
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
// û�а�����ʾ����Ĵ��룬�ǲ������۷�Χ��ֻҪ��foreach�Ϳ��Ժܼ򵥵��õõ��Ķ�ά 
��������ʾ��� 
?> 

4��OO������ 
���´����е����ݿ�������ʹ�õ�pear db����д��� 

<?php 
// FileName: Pager.class.php 
// ��ҳ�࣬�����������ڴ������ݽṹ������������ʾ�Ĺ��� 
Class Pager 
{ 
var $PageSize; //ÿҳ������ 
var $CurrentPageID; //��ǰ��ҳ�� 
var $NextPageID; //��һҳ 
var $PreviousPageID; //��һҳ 
var $numPages; //��ҳ�� 
var $numItems; //�ܼ�¼�� 
var $isFirstPage; //�Ƿ��һҳ 
var $isLastPage; //�Ƿ����һҳ 
var $sql; //sql��ѯ��� 

function Pager($option) 
{ 
global $db; 
$this->_setOptions($option); 
// ������ 
if ( !isset($this->numItems) ) 
{ 
$res = $db->query($this->sql); 
$this->numItems = $res->numRows(); 
} 
// ��ҳ�� 
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
* ���ؽ���������ݿ����� 
* �ڽ�����Ƚϴ��ʱ�����ֱ��ʹ���������������ݿ����ӣ�Ȼ������֮������������� 
����С 
* �����������Ǻܴ󣬿���ֱ��ʹ��getPageData�ķ�ʽ��ȡ��ά�����ʽ�Ľ�� 
* getPageData����Ҳ�ǵ��ñ���������ȡ����� 
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
$link = $db->limitQuery($this->sql, $from, $count); //ʹ��Pear DB::limitQuery���� 
��֤���ݿ������ 

return $link; 
} 
else 
{ 
return false; 
} 
} 

/*** 
* 
* �Զ�ά����ĸ�ʽ���ؽ���� 
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
// ����һ�μ򵥵�ʾ�����룬ǰ��ʡ����ʹ��pear db�ཨ�����ݿ����ӵĴ��� 
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
$turnover = "��ҳ|��һҳ|"; 
} 
else 
{ 
$turnover = "<a href=?page=1&numItems=".$pager->numItems.">��ҳ</a>|<a 
href=?page=".$pager->PreviousPageID."&numItems=".$pager->numItems.">��һҳ</a>|" 
; 
} 
if ( $pager->isLastPage ) 
{ 
$turnover .= "��һҳ|βҳ"; 
} 
else 
{ 
$turnover .= "<a 
href=?page=".$pager->NextPageID."&numItems=".$pager->numItems.">��һҳ</a>|<a 
href=?page=".$pager->numPages."&numItems=".$pager->numItems.">βҳ</a>"; 
} 

Class MemberPager extends Pager 
{ 
function showMemberList() 
{ 
global $db; 

$data = $this->getPageData(); 
// ��ʾ����Ĵ��� 
// ...... 
} 
} 
/// ���� 
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

