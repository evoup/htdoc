<?php
// 启动 word
$word = new COM("word.application") or die("Unable to instanciate Word");
print "Loaded Word, version {$word->Version}\n";

//将其置前
$word->Visible = 1;

//打开一个空文档
$word->Documents->Add();

//随便做些事情
$word->Selection->TypeText("This is a test...");
$word->Documents[1]->SaveAs("Useless test.doc");

//关闭 word
$word->Quit();

//释放对象
$word->Release();
$word = null; 


?>