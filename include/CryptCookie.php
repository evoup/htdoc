<?php

// Class LsmCryptCookie
// Autor : Claudio Adonai Muto
// WebSite : http://www.cam.pro.br
// Usage : Crypt and Decrypt datas on cookies
// 
//
// $cook->new LsmCryptCookie(43532) ;
// The parameter must be a integer, 123 is default value.
//
// $cook->_setCookie("nome","Lucas Sabbag Muto")
// It saves Lucas Sabbag Muto on cookie 'nome'. The value will be
// saved encrypted.
//
// $my_value=$cook->_getCookie("nome") ;
// It recovers the decrypted value of cookie 'nome' on my_value
//
// PS : LSM is a tribute to my son, Lucas Sabbag Muto


  class LsmCryptCookie {
  
    var $my_key ; 
    var $my_cookie ; 
    var $my_value ; 
    var $cookiearray ;
    var $cookie ;

    function LsmCryptCookie($key = 123) {
	  $this->my_key=$key ;
      $this->cookiearray = array() ;
      $this->cookie= "" ;
	  $this->my_cookie="" ;
	  $this->my_value="" ;
	}
  
    function cryptCookie() {
      $valuecrypt = base64_encode($this->my_value) ;
      for ($f=0 ; $f<=strlen($valuecrypt)-1; $f++) {
        $this->cookie .= intval(ord($valuecrypt[$f]))*$this->my_key."|" ;    
      }
	  setcookie($this->my_cookie,$this->cookie) ;
	}

    function decryptCookie() {
	  $this->cookiearray = explode("|",$_COOKIE["$this->my_cookie"]) ;
	  $this->my_value = "" ; 
      for ($f=0 ; $f<=count($this->cookiearray)-2; $f++) {
	    $this->my_value .= strval(chr($this->cookiearray[$f]/$this->my_key)) ;
	  }
      return(base64_decode($this->my_value)) ; 	   
	}

    function _setCookie($cookie, $value) {
	  $this->my_cookie = $cookie ;
	  $this->my_value = $value ;
	  $this->cryptCookie() ;
	}

    function _getCookie($cookie) {
	  $this->my_cookie = $cookie ;
	  return ($this->decryptCookie()) ;
	}

  }


?>
