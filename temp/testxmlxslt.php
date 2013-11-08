<?php
$xml   =   new   DOMDocument;  
  $xml->load($_SERVER['DOCUMENT_ROOT']   .   '\test.xml');  
   
  $xsl   =   new   DOMDocument;  
  $xsl->load($_SERVER['DOCUMENT_ROOT']   .   '\test.xsl');  
   
  $proc   =   new   XSLTProcessor;  
  $proc->importStyleSheet($xsl);  
   
  echo   $proc->transformToXML($xml);   
?>