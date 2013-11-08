<?php
 
/*
    
    Database table scheme:
    
    CREATE TABLE usersonline (
        timestamp int(15) DEFAULT '0' NOT NULL,
        ip varchar(40) NOT NULL,
        file varchar(100) NOT NULL,
        INDEX (timestamp),
        INDEX ip(ip),
        INDEX file(file)
       );

*/
    
class UsersOnline {

    /* public: connection parameters */
	var $host     = 'localhost';
	var $database = 'jzoa';
	var $user     = 'root';
	var $password = 'getter';
	var $page     = "";
	var $ip       = "";
	var $useTemplate = 1;	

	var $timeoutSeconds = 120;
    
	function version_check($vercheck)
	{
	
	$minver = explode(".", $vercheck);
	$curver = explode(".", phpversion());
	
	if(($curver[0] <= $minver[0]) && ($curver[1] <= $minver[1]) && ($curver[1] <= $minver[1]) && ($curver[2][0] < $minver[2][0])) return true;
		else return false;
	}


    function UsersOnline($visitor=true) 
	{


//evoupV1.1改成自己的获得真实IP，而不是代理的

if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
   $IP_ADDR = getenv( 'HTTP_X_FORWARDED_FOR' );
}
else if ( getenv( 'HTTP_CLIENT_IP' ) ) {
   $IP_ADDR = getenv( 'HTTP_CLIENT_IP' );
}
else {
   $IP_ADDR = getenv( 'REMOTE_ADDR' );
}
list($this->ip) = explode(",",$IP_ADDR);


//使用这类的remote_addr
	if($this->version_check("4.1.0"))
		{
	//	$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->page = $_SERVER['PHP_SELF'];	
		}
		else
		{		
	//	$this->ip = $REMOTE_ADDR;
		$this->page = $PHP_SELF;
		}
	  
	  $this->page = $_SERVER['REQUEST_URI'];
			

	 mysql_connect($this->host, $this->user, $this->password)
                       or die('Error conecting to database');


      if ($visitor)
	    $this->addVisitor();
    }    //constructor
    
    function getNumber($siteOrFile="site") 
	{
  	  $timeout = $this->getTimeOut();
	  if ($siteOrFile == "site")
	    $sql = "SELECT DISTINCT ip FROM usersonline WHERE timestamp >= $timeout";
	  else
	    $sql = "SELECT DISTINCT ip FROM usersonline WHERE file='" . $this->page . "' and  timestamp >= $timeout";

      $result = mysql_db_query($this->database, $sql )
            or die('Error reading from database');

      return mysql_num_rows($result); 
        
    }//getNumber
    
    function printNumber($siteOrFile="site") 
	{
	  echo $this->getNumberInfo($siteOrFile);
    }//printNumber
	
    function getNumberInfo($siteOrFile="site") 
	{
	  // I use templates so I just want to get the string and pass it to
	  // my template object
	  $cnt = $this->getNumber($siteOrFile);
	if($this->useTemplate==1)
		{
		if( $cnt == 0) $output = "1 User online";
			else 
		$output = "$cnt Users online";
		}
	else $output=$cnt;

	  return $output;
	mysql_close();
    }//getNumberInfo
	
    
    function refresh() {
        global $REMOTE_ADDR, $PHP_SELF;
        
		$timeout = $this->getTimeOut();
        $sql = "DELETE FROM usersonline WHERE timestamp < $timeout";
        mysql_db_query($this->database, $sql )
            or die('Error deleting from database');
    }//refresh
	
	function getTimeOut()
	{
        $currentTime = time();
        return $currentTime - $this->timeoutSeconds;	  
	}//getTimeOut
    
	function addVisitor() 
	{
        global $REMOTE_ADDR, $PHP_SELF;
        
        $currentTime = time();

        $sql = "INSERT INTO usersonline VALUES ('$currentTime','" . $this->ip . "','" . $this->page . "')";
        mysql_db_query($this->database, $sql ) 
            or die('Error writing to database');                       
     }//addVisitor
	

	// Very important things. 
	// If you get some thousands hits on your page for less than the maximum 
	// timeout to drop the connection then you'll reach the maximum sockets allowed!
} //class UsersOnline


/*
//E X A M P L E
//Remove this code and call from your proper script

//REPORTING ONLY
$ol = new UsersOnline(false);

//get rid of the old records
$ol->refresh();

//who is at my site?
$ol->printNumber("site");
//who is at this page?
$ol->printNumber("myPage.php");

//ADDING A USER, NO REPORTING
$ol = new UsersOnline(true);


*/

?>