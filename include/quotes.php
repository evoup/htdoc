<?php
//数据加撇号
function quotes($content){
if (!get_magic_quotes_gpc()) {
if(is_array($content)) {
foreach ($content as $key=>$value){
$content[$key] = quotes($value);
}
} else{
addslashes($content);
}
}
return$content;
}
//还原
function unquotes($content){
if(get_magic_quotes_gpc()) {
if (is_array($content)) {
foreach($content as $key=>$value) {
$content[$key] =unquotes($value);
}
} else{
stripslashes($content);
}
}
return$content;
}
?>