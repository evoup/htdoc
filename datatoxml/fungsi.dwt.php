<?php


//constant
define ('HOST','localhost');
define ('USER','root');
define ('PASSWORD','getter');
define ('DATABASE','jzoa');
//define ('PAGING',10);
//CLASS
class mySqlConn // all connection into mysql extended from this class 
	{
				private $host;
				private $user;
				private $pass;
				private	$conn;
				private $database;
				private $row;
				private	$res;
				function setConn($host_,$user_,$pass_,$database_)
						{
								$this->host 	= $host_;
								$this->user 	= $user_;
								$this->pass 	= $pass_;
								$this->database = $database_;
						}
				function connectMySql()
						{
							$this->conn		=	mysql_connect($this->host,$this->user,$this->pass,"","") 
							or die("<b>Not connected !!! cause :".mysql_error()."</b>");
//mysql_query("SET NAMES 'gbk'");
							mysql_select_db($this->database,$this->conn);
						}
				
				function runQry($sql)
						{
							$this->res	=	mysql_query($sql,$this->conn);	
							return $this->res;
						}	
						
				function closeConn()
						{
							mysql_close($this->conn);		
						}
				
				function fetchRow()
						{
							$this->row 	=  mysql_fetch_row($this->res);
							return $this->row;
						}
						
				function fieldList(&$fieldRet,$sql,&$res)
						{	$i = 0;
							$res=$this->runQry($sql);
							while ($i < mysql_num_fields($this->res)) 
							{
  
  									 $meta = mysql_fetch_field($this->res, $i);
   											if (!$meta) {
       														echo "No Info<br />\n";
   														};
  
										$fieldRet[$i] = $meta->name;
   										$i++;
							}
							return $i;
							//echo mysql_tablename($this->res,0);
							
						}
	};

class dataToXML extends mySqlConn
		{
				private		$tabelName;
				private		$fileName;
				private		$fileHandle;
				private		$fieldName;
				private		$crlf	=	"\r\n";
				private		$numOfFields;
				private		$sql;
				private		$res;
				
				private		$header_;
				
				
				
				
				function __construct($fileName)
					{
						$this->fileName		=	$fileName;
						$this->setConn(HOST,USER,PASSWORD,DATABASE);
						$this->connectMysql();
						$this->fileHandle = fopen($this->fileName,"w");
						//$this->pages = 10;
					}				
				function	setXMLFile($filename)
					{
							$this->fileName	=	$filename;
					}	
				function	setQueryString($sql)
					{
							$this->sql = $sql;
							$this->numOfFields	=	$this->fieldList($this->fieldName,$this->sql,$this->res);	
							$this->tabelName	=	mysql_field_table($this->res,$this->fieldName[0]);
							}
				function	createXML()
					{
							fputs($this->fileHandle,"<?xml version='1.0'  encoding='GB2312' ?>".$this->crlf);
							fputs($this->fileHandle,'<'.$this->tabelName.'>'.$this->crlf);
							
							$this->runQry($this->sql);
							while ($row=$this->fetchRow())
							{
							fputs($this->fileHandle,'    <RECORD>'.$this->crlf);
							for($itr = 0 ; $itr < $this->numOfFields;$itr++)
								{
										//checking row from illegal XML character
										fputs($this->fileHandle,'     <'.htmlspecialchars($this->fieldName[$itr]).'>'.
										htmlspecialchars($row[$itr]).'</'.htmlspecialchars($this->fieldName[$itr]).'>'.$this->crlf);
										};
							fputs($this->fileHandle,'    </RECORD>'.$this->crlf);	
							};
							fputs($this->fileHandle,'</'.$this->tabelName.'>'.$this->crlf);
							echo '<XML ID ="dso'.$this->tabelName.'" src ="'.$this->fileName.'"/>'.$this->crlf;
							//	echo '<H2 align="center" class="style1">'.$this->header_.'</H2>'.$this->crlf;
							return true;
					}
				function __destruct()
					{
						$this->closeConn();
						fclose($this->fileHandle);
					}
				
		};
?>