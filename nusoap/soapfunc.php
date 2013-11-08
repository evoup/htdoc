<?
require_once('nusoap.php'); 
function reverse($str){ 
  $retval = "";
   if(strlen($str) < 1) {
    return new soap_fault('Client','','Invalid string'); 
   }
   for ($i = 1; $i <= strlen($str); $i++) {
      $retval .= $str[(strlen($str) - $i)]; 
   }
  return $retval; 
}

function add2numbers($num1, $num2) {
   if (trim($num1) != intval($num1)) {
      return new soap_fault('Client', '', 'The   first number is invalid'); 
  }
  if (trim($num2) != intval($num2)) {
    return new soap_fault('Client', '', 'The second number is invalid'); 
  }
  return ($num1 + $num2); 
}
function dumpsql($str){ 
  $retval = "";
   if(strlen($str) < 1) {
    return new soap_fault('Client','','Invalid string'); 
   }
   for ($i = 1; $i <= strlen($str); $i++) {
      $retval .= $str[(strlen($str) - $i)]; 
   }
  return $retval; 
}
?>