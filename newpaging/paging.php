<?php 
/* 
** File: class.pagenumber.php 
** Class: PageNumber 
** Version: none 
** Created: 5/12/2004 
** Author: Morgan Woo 
** Email: morgan.woo@163.com 
** Update:huabing lv
** Email:hb_lv@hotmail.com
** 
** Copyright (c) 2004 Mr.Woo .  All rights reserved. 
*/ 
class Pager{ 
   //生成的页码（事实上不用也行） 
   var $pageNumber=''; 
    
   //需要分类的条目总数 
    var $totalItems=0; 
    //数据连接相关
   var $conn;
   var $sql; 
   //每页显示几个条目 
   var $itemsPerPage=3; 
    
   //总页数 
   var $totalPageNumber=0; 
   //当前页码！ 
   var   $currentPageNumber=1; 
    
   //一个页面显示几个页码 
   var $length=10; 
    
    
   //需要分页的url 
   var $url=''; 
   function Pager($conn,$sql,$currentPageNumber,$itemsPerPage,$length,$url){
     $this->currentPageNumber=$currentPageNumber; 
       $this->conn=$conn; 
       $this->sql=$sql;
        $this->itemsPerPage=$itemsPerPage;
         $this->length=$length; 
  $this->url=$url; 
  $this->url.=(stristr($this->url,'?')!=false)?'&':'?';  //Url里有"?"就加"&"没有就加"?" 
  $this->getTotalPageNumber();
   }
    function getTotalItems(){
     //for adodb
     $rs=$this->conn->Execute($this->sql);
     $this->totalItems=$rs->RecordCount();
     return $this->totalItems;
    }
     function getTotalPageNumber(){ 
      $this->totalPageNumber=ceil($this->getTotalItems()/$this->itemsPerPage);   
 return $this->totalPageNumber;
   } 

   //SQL里 LIMIT start，length 中的起始值 
   function getLimitStart(){ 
      $start=($this->currentPageNumber-1)*$this->itemsPerPage; 
      return $start; 
   } 
   //SQL里 LIMIT start，length 中的length 
   function getLimitItems(){ 
      return $this->itemsPerPage; 
   } 
   function getRsPerPage(){
     $modiSQL=$this->sql." limit ".$this->getLimitStart()." ,".$this->getLimitItems();
//偶用的是adodb的说
$link =mysql_connect('localhost','root','getter');
mysql_select_db('jzoa',$link);

$rs=mysql_query($modiSQL);
    // $modiRS=$this->conn->Execute($modiSQL);
$modiRS=$rs;


 //    $arr=$modiRS->GetArray();
$arr=mysql_fetch_array($rs);
     return $arr;
   }

   //主函数.中文分页 
   function getPageNumber(){ 
      if ($this->getTotalPageNumber()>1){ 
          
         $pageNumber='当前第'.$this->currentPageNumber.'页/共'.$this->totalPageNumber.'页'; 
          //显示第一页和前一页
         if ($this->currentPageNumber>1){ 
    //第一页
            //First Page 
            $pageNumber.="<B><A HREF=".$this->url."page=1>第一页</A> </B> "; 
   //前一页
            //Previous Page 
            $pageNumber.="<B><A HREF=".$this->url."page=".($this->currentPageNumber-1).">前一页</A> </B>"; 
         } 
         //The start number is the first number of all pages which show on the current page. 
         $startNumber=intval($this->currentPageNumber/$this->length)*$this->length; 
         //Prev N page 
   //交界处
         if ($this->currentPageNumber>=$this->length){ 
            $pageNumber.="[<B><A HREF=".$this->url."page=".($startNumber-1).">".($startNumber-1)."</A></B>]..."; 
         } 
          
         $leftPageNumber=0; 
         for ($i=$startNumber;$i<=$this->totalPageNumber;$i++){ 
            if ($i==0)continue; 
            if ($i-$startNumber<$this->length){ 
               if ($i==$this->currentPageNumber){ 
                  $pageNumber.="[<b>$i</b>]"; 
               }else{ 
                  $pageNumber.="[<A HREF=".$this->url."page=".$i.">".$i."</A>]"; 
               } 
            }else{ 
               $leftPageNumber=$this->totalPageNumber-$i+1; 
               break; 
            } 
         } 
   //显示下一个分页列表
         if ($leftPageNumber>=1){ 
            $pageNumber.="...[<B><A HREF=".$this->url."page=".($startNumber+$this->length).">".($startNumber+$this->length)."</A></B>] "; 
         } 
          
         if ($this->currentPageNumber!=$this->totalPageNumber){ 
            //Next page 
            $pageNumber.="<B><A HREF=".$this->url."page=".($this->currentPageNumber+1).">下一页</A> </B>"; 
            //Last page 
            $pageNumber.="<B><A HREF=".$this->url."page=".$this->totalPageNumber.">最后页</A> </B>"; 
         } 
          
         $this->pageNumber=$pageNumber; 
         return $this->pageNumber; 
          
      } 
       
       
   } 
    
 
//英文分页
function getPageNumber2(){ 
      if ($this->getTotalPageNumber()>1){ 
          
         $pageNumber='P'.$this->currentPageNumber.'/'.$this->totalPageNumber.''; 
          //显示第一页和前一页
         if ($this->currentPageNumber>1){ 
    //第一页
            //First Page 
            $pageNumber.="<B><A HREF=".$this->url."page=1>FIRST</A> </B> "; 
   //前一页
            //Previous Page 
            $pageNumber.="<B><A HREF=".$this->url."page=".($this->currentPageNumber-1).">PREV</A> </B>"; 
         } 
         //The start number is the first number of all pages which show on the current page. 
         $startNumber=intval($this->currentPageNumber/$this->length)*$this->length; 
         //Prev N page 
   //交界处
         if ($this->currentPageNumber>=$this->length){ 
            $pageNumber.="[<B><A HREF=".$this->url."page=".($startNumber-1).">".($startNumber-1)."</A></B>]..."; 
         } 
          
         $leftPageNumber=0; 
         for ($i=$startNumber;$i<=$this->totalPageNumber;$i++){ 
            if ($i==0)continue; 
            if ($i-$startNumber<$this->length){ 
               if ($i==$this->currentPageNumber){ 
                  $pageNumber.="[<b>$i</b>]"; 
               }else{ 
                  $pageNumber.="[<A HREF=".$this->url."page=".$i.">".$i."</A>]"; 
               } 
            }else{ 
               $leftPageNumber=$this->totalPageNumber-$i+1; 
               break; 
            } 
         } 
   //显示下一个分页列表
         if ($leftPageNumber>=1){ 
            $pageNumber.="...[<B><A HREF=".$this->url."page=".($startNumber+$this->length).">".($startNumber+$this->length)."</A></B>] "; 
         } 
          
         if ($this->currentPageNumber!=$this->totalPageNumber){ 
            //Next page 
            $pageNumber.="<B><A HREF=".$this->url."page=".($this->currentPageNumber+1).">NEXT</A> </B>"; 
            //Last page 
            $pageNumber.="<B><A HREF=".$this->url."page=".$this->totalPageNumber.">LAST</A>  </B>"; 
         } 
          
         $this->pageNumber=$pageNumber; 
         return $this->pageNumber; 
          
      } 
       
       
   } 
    
}






//test
$currentPageNumber=( isset($_GET['page']) ) ? intval($_GET['page']) : 1; 
//include("PAGENUMBER/class.pagenumber.php");
$sql='select * from msg';
$pageNumber= new PageNumber($adodbConn,$sql,$currentPageNumber,10,3,3,"paging.php");
echo $pageNumber->getPageNumber2();
echo "<br>";
echo $pageNumber->getPageNumber();
?> 

