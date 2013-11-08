<?php
$xx=array(
"idx"=>"akata2.vicp.net"
);
echo serialize($xx);
echo "<br>--------------------------------------------";

$theVariable = array("Search Engines" => 
array (
    0=> "http//google.com", 
    1=> "http//yahoo.com",
    2=> "http//msn.com/"),

"Social Networking Sites" =>
array (
    0 => "http//www.facebook.com",
    1 => "http//www.myspace.com",
    2 => "http//vkontakte.ru",)
);
echo "The first array value is " . $theVariable['Search Engines'][0];
echo "<br>";
echo serialize($theVariable['Search Engines'][0]);
