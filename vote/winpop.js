function winPopup(w,h,flag) {
		/*if (document.all.aidValue.value == "" && flag == 0) { alert("您还未选择投票选项，谢谢!"); return false;}*/
		if (flag == 0) {
		url="/pcp/top/vote.do?tid=43&flag=0&aid="+document.all.aidValue.value;
		} else {
		url="vote.php?id="+flag;
		}
		if (flag == 2)
		url="vote.php?id=2";
		window.open(url,'myWin','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=1,width='+w+',height='+h);
		}
		function selectRadio(v) {
		document.all.aidValue.value=v;
		}