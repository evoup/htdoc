<?php
/************************************************************************/
/* Rhadrix PHP-Scripts                                                  */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Silvio Ricci                                   */
/* http://www.rhadrix.com                                               */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */

/*
   Class name:
   Hours Difference

   Version:
   0.1

   Description: 
   Utility to get other server time's hour from a script.
   If your local time is *behind* the server time, then change the "+" to
   a "-" in the variable $h
   To adjust the format of the date, see the list of variables at the
   official PHP site (php.net): http://www.php.net/manual/function.date.php

   Example:
   Only four lines ...

   include("./diffhours.php");
   $h = -24;   // for yesterday
   $obj = new Hour_Diff();
   echo $obj->get_hour($obj->set_hour($h));
   
*/
/************************************************************************/
class Hour_Diff {
    var $hourdiff = "";
    var $timeadjust = "";
    var $my_time = "";
    function Hour_Diff() {
	    $this->hourdiff = "";
	    $this->timeadjust = "";
	    $this->my_time = "";
    }
    function set_hour($hourdiff) {
	    $this->hourdiff = $hourdiff;
    }
    function _get_hour() {
	    return $this->hourdiff;
    }
    function get_hour() {
            $this->timeadjust = ($this->_get_hour() * 60 * 60);
            $this->my_time = date("l, d F Y h:i a",time() + $this->timeadjust);
	    return $this->my_time;
    }
}

$h = 0;   // for yesterday
   $obj = new Hour_Diff();
   echo $obj->get_hour($obj->set_hour($h));


?>