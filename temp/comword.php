<?php
// ���� word
$word = new COM("word.application") or die("Unable to instanciate Word");
print "Loaded Word, version {$word->Version}\n";

//������ǰ
$word->Visible = 1;

//��һ�����ĵ�
$word->Documents->Add();

//�����Щ����
$word->Selection->TypeText("This is a test...");
$word->Documents[1]->SaveAs("Useless test.doc");

//�ر� word
$word->Quit();

//�ͷŶ���
$word->Release();
$word = null; 


?>