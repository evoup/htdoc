<?php

����// ����һ��ָ����COM���������

����$word = new COM("word.application") or die("Can't start Word!");

����// ��ʾĿǰ����ʹ�õ�Word�İ汾��

����echo "Loading Word, v. {$word->Version}<br>";

����// �����Ŀɼ�������Ϊ0���٣������Ҫʹ������ǰ�˴򿪣�ʹ��1���棩

����// to open the application in the forefront, use 1 (true)

����$word->Visible = 0;

����// ��Word�д����µ��ĵ�

����$word->Documents->Add();

����// �����ĵ����������

����$word->Selection->TypeText("Testing 1-2-3...");

����//���ĵ�������Windows��ʱĿ¼��

����$word->Documents[1]->SaveAs("/Windows/temp/comtest.doc");

����// �ر���COM���֮�������

����$word->Quit();

����// ����Ļ����ʾ������Ϣ

����echo "Check for the file...";

����?>
