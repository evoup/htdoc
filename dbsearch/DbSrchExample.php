<?php
//******************************************************************************
//Test file for class DatabaseSearch
//change values in constructor and DoSearch to reflect your data structure
//******************************************************************************

require_once("DatabaseSearch.php");

/*
//simplest version - uncomment this, to see it working

//class construction
$DBSearch = new DatabaseSearch("localhost","database","user","pass");

//Draw form that calls itself (this file)
$DBSearch->DrawForm($_SERVER['PHP_SELF']);
echo "<hr>";

//Search in table news, return data from column id, search in column tresc
//It will use value from form (if defined) as needle.
$search_result = $DBSearch->DoSearch("news","id","tresc");

//returns false if form wasn't submitted yet or was submitted empty
var_dump($search_result);
exit;
*/
?>
<?php
//more sophisticated example
include("../include/session_mysql.php");
session_start();

?>
<html>
<head>
<!-- change this to your style sheet -->
<link rel="stylesheet" href="index.css" type="text/css">
</head>
<body>
<?php

//call constructor with true as the last parameter for debug mode (show sql query and error)
$DBSearch = new DatabaseSearch("localhost","jzoa","root","getter",true);

//All parameters for DrawForm: form action, input size, css class of infput,
//css class of submit, text for submit button, true if you want to choose between
// OR and AND logic if many words and phrases are typed in (if false, OR will be used)
$DBSearch->DrawForm($_SERVER['PHP_SELF'],100,"newsletter_input","submit","Szukaj",true);
echo "<hr>";

if (isset($_POST["DatabaseSearchNeedle"]))
{
 $query = $DBSearch->needle;
 echo "Your query: <b>$query</b>.<br>";
 echo "Query translated:<br><pre>";
 print_r($DBSearch->ProcessNeedle($DBSearch->needle));
 echo "</pre><br>";
 echo "Logical operator:".$DBSearch->logic."<br>";
 
 echo "Results (do what you want to with them):<br><pre>";

 //search in table news, return id, search in listed columns, text and logical operators
 //will be taken from form
 $search_result = $DBSearch->DoSearch("news","id",array("tresc","naglowek","streszczenie"),"","");

 if ($search_result) print_r($search_result);
 else echo "Nothing was found.";
 echo "</pre>";
}
else echo "No query yet.";
?>
</body>
</html>
