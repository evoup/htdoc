@echo On
@Rem ɾ��CVS�汾����Ŀ¼
@PROMPT [Com]#

@echo Find CVS

@for /r . %%a in (.) do @if exist "%%a\CVS" @echo "%%a\CVS"

@echo Find CVS Dir....OK
@pause

@for /r . %%a in (.) do @if exist "%%a\CVS" rd /s /q "%%a\CVS"

@echo Clear CVS Dir Mission Completed

@pause

