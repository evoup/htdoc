<?php

　　// 建立一个指向新COM组件的索引

　　$word = new COM("word.application") or die("Can't start Word!");

　　// 显示目前正在使用的Word的版本号

　　echo "Loading Word, v. {$word->Version}<br>";

　　// 把它的可见性设置为0（假），如果要使它在最前端打开，使用1（真）

　　// to open the application in the forefront, use 1 (true)

　　$word->Visible = 0;

　　// 在Word中创建新的文档

　　$word->Documents->Add();

　　// 在新文档中添加文字

　　$word->Selection->TypeText("Testing 1-2-3...");

　　//把文档保存在Windows临时目录中

　　$word->Documents[1]->SaveAs("/Windows/temp/comtest.doc");

　　// 关闭与COM组件之间的连接

　　$word->Quit();

　　// 在屏幕上显示其他信息

　　echo "Check for the file...";

　　?>
