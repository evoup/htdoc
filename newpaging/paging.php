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
   //���ɵ�ҳ�루��ʵ�ϲ���Ҳ�У� 
   var $pageNumber=''; 
    
   //��Ҫ�������Ŀ���� 
    var $totalItems=0; 
    //�����������
   var $conn;
   var $sql; 
   //ÿҳ��ʾ������Ŀ 
   var $itemsPerPage=3; 
    
   //��ҳ�� 
   var $totalPageNumber=0; 
   //��ǰҳ�룡 
   var   $currentPageNumber=1; 
    
   //һ��ҳ����ʾ����ҳ�� 
   var $length=10; 
    
    
   //��Ҫ��ҳ��url 
   var $url=''; 
   function Pager($conn,$sql,$currentPageNumber,$itemsPerPage,$length,$url){
     $this->currentPageNumber=$currentPageNumber; 
       $this->conn=$conn; 
       $this->sql=$sql;
        $this->itemsPerPage=$itemsPerPage;
         $this->length=$length; 
  $this->url=$url; 
  $this->url.=(stristr($this->url,'?')!=false)?'&':'?';  //Url����"?"�ͼ�"&"û�оͼ�"?" 
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

   //SQL�� LIMIT start��length �е���ʼֵ 
   function getLimitStart(){ 
      $start=($this->currentPageNumber-1)*$this->itemsPerPage; 
      return $start; 
   } 
   //SQL�� LIMIT start��length �е�length 
   function getLimitItems(){ 
      return $this->itemsPerPage; 
   } 
   function getRsPerPage(){
     $modiSQL=$this->sql." limit ".$this->getLimitStart()." ,".$this->getLimitItems();
//ż�õ���adodb��˵
$link =mysql_connect('localhost','root','getter');
mysql_select_db('jzoa',$link);

$rs=mysql_query($modiSQL);
    // $modiRS=$this->conn->Execute($modiSQL);
$modiRS=$rs;


 //    $arr=$modiRS->GetArray();
$arr=mysql_fetch_array($rs);
     return $arr;
   }

   //������.���ķ�ҳ 
   function getPageNumber(){ 
      if ($this->getTotalPageNumber()>1){ 
          
         $pageNumber='��ǰ��'.$this->currentPageNumber.'ҳ/��'.$this->totalPageNumber.'ҳ'; 
          //��ʾ��һҳ��ǰһҳ
         if ($this->currentPageNumber>1){ 
    //��һҳ
            //First Page 
            $pageNumber.="<B><A HREF=".$this->url."page=1>��һҳ</A> </B> "; 
   //ǰһҳ
            //Previous Page 
            $pageNumber.="<B><A HREF=".$this->url."page=".($this->currentPageNumber-1).">ǰһҳ</A> </B>"; 
         } 
         //The start number is the first number of all pages which show on the current page. 
         $startNumber=intval($this->currentPageNumber/$this->length)*$this->length; 
         //Prev N page 
   //���紦
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
   //��ʾ��һ����ҳ�б�
         if ($leftPageNumber>=1){ 
            $pageNumber.="...[<B><A HREF=".$this->url."page=".($startNumber+$this->length).">".($startNumber+$this->length)."</A></B>] "; 
         } 
          
         if ($this->currentPageNumber!=$this->totalPageNumber){ 
            //Next page 
            $pageNumber.="<B><A HREF=".$this->url."page=".($this->currentPageNumber+1).">��һҳ</A> </B>"; 
            //Last page 
            $pageNumber.="<B><A HREF=".$this->url."page=".$this->totalPageNumber.">���ҳ</A> </B>"; 
         } 
          
         $this->pageNumber=$pageNumber; 
         return $this->pageNumber; 
          
      } 
       
       
   } 
    
 
//Ӣ�ķ�ҳ
function getPageNumber2(){ 
      if ($this->getTotalPageNumber()>1){ 
          
         $pageNumber='P'.$this->currentPageNumber.'/'.$this->totalPageNumber.''; 
          //��ʾ��һҳ��ǰһҳ
         if ($this->currentPageNumber>1){ 
    //��һҳ
            //First Page 
            $pageNumber.="<B><A HREF=".$this->url."page=1>FIRST</A> </B> "; 
   //ǰһҳ
            //Previous Page 
            $pageNumber.="<B><A HREF=".$this->url."page=".($this->currentPageNumber-1).">PREV</A> </B>"; 
         } 
         //The start number is the first number of all pages which show on the current page. 
         $startNumber=intval($this->currentPageNumber/$this->length)*$this->length; 
         //Prev N page 
   //���紦
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
   //��ʾ��һ����ҳ�б�
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

