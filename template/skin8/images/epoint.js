 function CheckEmail(InputID)
 {
		var list=document.getElementById(InputID);
		if(list.value!="")
		{
			if (list.value.search(/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/)==-1)
			{
			alert('非法的邮件地址');
     	    		list.focus();
			list.select();
			return false;
			}
		}
		return true;
}
function isCharsInBag (s, bag) 
{ 
	var i,c; 
	for (i = 0; i < s.length; i++) 
	{ 
	c = s.charAt(i);//字符串s中的字符 
	if (bag.indexOf(c) > -1) 
	return c; 
	} 
	return ""; 
} 
//检查函数: 
function ischinese(s) 
{ 
	var errorChar; 
	var badChar = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789><,<>{}?/+=|\\′\":;~!#$%()`"; 
	errorChar = isCharsInBag( s, badChar) 
	if (errorChar != "" ) 
	{ 
	alert('姓名必须用中文填写'); 
	return false; 
	} 

	return true; 
} 
 function CheckPhone(InputID)
 {
		var list=document.getElementById(InputID);
		if(list.value!="")
		{
		   var patrn=/^(([0\+]\d{2,3}-)?(0\d{2,3})-)?(\d{7,8})(-(\d{3,}))?$/;  
		   if (!patrn.exec(list.value))
		   { 
    	    		list.focus();
			list.select();
		    
		   return false;
		   } 
		   
			//if (list.value.search(/(\(\d{4}\)|\d{4}-|\d{3}-|\d{3})?(\d{8}|\d{7})==-1)
			//{
			//alert('非法的电话号码');
     	  //  		list.focus();
			//list.select();
			//return false;
			//}
		}
		return true;
}
function CheckInput()
{
		
			var list=document.getElementsByTagName("Input");

			var SpecialTxt="!-#-$-^-*-+-'-update-insert-delete";
			var InputLength=100;
			for(var i=0;i<list.length;i++)
			{
				if(list[i].type=="text")
				{
				
					if(list[i].value.length>200)
					{
					
						if(list[i].id!="RichTextBox1")
						{
						alert('你输入的字符长度超过了'+InputLength+'个字符');
						list[i].focus();
						return false;
						}
					}
					var SpList=SpecialTxt.split('-');
					for(var j=0;j<SpList.length;j++)
					{
					if(list[i].id!="RichTextBox1")
						{
						if(list[i].value.indexOf(SpList[j])>=0)
						{
							
							alert('你输入的字符中包含有非法字符!你不能输入以下字符');
							list[i].focus();
							return false;
						}
						}
					}
					
				}
			}
			var list2=document.getElementsByTagName("textarea");
			for(var i=0;i<list2.length;i++)
			{
				
				
					if(list2[i].value.length>200)
					{
					
						
						alert('你输入的字符长度超过了'+InputLength+'个字符');
						list2[i].focus();
						return false;
						
					}
					var SpList=SpecialTxt.split('-');
					for(var j=0;j<SpList.length;j++)
					{
					
						if(list2[i].value.indexOf(SpList[j])>=0)
						{
							
							alert('你输入的字符中包含有非法字符!');
							list2[i].focus();
							return false;
						}
						
					}
					
				
			}
			
			
}
String.prototype.Trim = function() {return this.replace(/(^\s*)|(\s*$)/g,"");} 
function CheckInputParam(Ilength,InputID)
{
		
			var list=document.getElementById(InputID);

			var SpecialTxt="!#$^*+|'";
			var InputLength=Ilength;
				
			if(list.value.length>InputLength)
			{
			
				
				alert('你输入的字符长度超过了'+InputLength+'个字符');
				list.focus();
				return false;
				
			}
			var SpList=SpecialTxt.split('');
			for(var j=0;j<SpList.length;j++)
			{
			
				if(list.value.indexOf(SpList[j])>=0)
				{
					
					alert('你输入的字符中包含有非法字符!你不能输入以下字符'+SpecialTxt);
					list.focus();
					return false;
				}
				
			}
					
			
			return true;
}
function   cidInfo(sId){   
                  var   aCity={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外"}   
              var   iSum=0   
              var   info=""   
              if(!/^\d{17}(\d|[x])$/i.test(sId)){   
                  return   "false@无效的身份证号码";   
              }   
              sId=sId.replace(/[x]$/i,"a");   
              
              if(aCity[parseInt(sId.substr(0,2))]==null){   
                  return   "Error:非法地区";   
              }   
              sBirthday=sId.substr(6,4)+"-"+Number(sId.substr(10,2))+"-"+Number(sId.substr(12,2));   
              var   d=new   Date(sBirthday.replace(/-/g,"/"));   
              if(sBirthday!=(d.getFullYear()+"-"+   (d.getMonth()+1)   +   "-"   +   d.getDate())){   
                  return   "Error:非法生日";   
              }   
              for(var   i   =   17;i>=0;i   --){   
                  iSum   +=   (Math.pow(2,i)   %   11)   *   parseInt(sId.charAt(17   -   i),11);   
              }   
              if(iSum%11!=1){   
                  return   "Error:非法证号";   
              }   
              return   aCity[parseInt(sId.substr(0,2))]+","+sBirthday+","+(sId.substr(16,1)%2?"男":"女");   
  } 
  //检查身份证号，支持15和18位。返回值表示错误原因。""表示无错
		function CheckIDCard(strID)
		{
			//验证各位字符是否合法的正则表达式
			ReDigital15 = /\d{15}/;
			ReDigital18 = /\d{17}[0-9xX]{1}/;
			//提取日期和校验的正则表达式
			ReDate15 = /\d{6}(\d{6})\d{3}/;
			ReDate18 = /\d{6}(\d{8})\d{3}/;
			switch(strID.length)
			{
				case 15:
					if( ReDigital15.test( strID ) == false )
						return "非法字符";	
					Arr = ReDate15.exec( strID );
					strDate = "19" + Arr[1];
					if( CheckDate(strDate, new Date(1900,0,1), new Date(1999,11,31)) == false )
						return "日期无效";
				break;
				case 18:
					if( ReDigital18.test( strID ) == false )
						return "非法字符";		
					Arr = ReDate18.exec( strID );
					strDate = Arr[1];
					if( CheckDate(strDate, new Date(1900,0,1), new Date()) == false )
						return "日期无效";
					if( CheckSum( strID ) == false )
						return "校验错误";
				break;
				default:
					return "位数不对";
				break;
			}
			return "";
		}

		//对身份证的校验位进行验证
		function CheckSum( strID )
		{
			//debugger;
			//18位数字提取正则表达式
			Re18Digital = /(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})([0-9xX]{1})/;
			Arr = Re18Digital.exec(strID);
			var Wi = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
			Sum = 0;
			for(i=0;i<=16;i++)
				Sum += Arr[i+1] * Wi[i];
			ArrCheckSum = new Array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
			strCheckSum = ArrCheckSum[Sum%11];
			if( strCheckSum == Arr[18].toUpperCase() )
				return true;
			else
				return false;
		}
//检查在指定范围之内的日期，支持选择框自动生成格式和手动连打格式。返回bool，true表示日期有效，false表示日期无效。
		function CheckDate( strDate, DateFrom, DateTo )
		{
			//手动日期验证正则表达式
			ReDigital8 = /\d{8}/;
			//自动日期验证正则表达式
			ReAutoDate = /\d{4}-{1}\d{1,2}-\d{1,2}/;
			//自动日期提取正则表达式
			//ReGetDate = /(\d{4})-{1}(\d{1,2})-(\d{1,2})/;
			//debugger;
			if(strDate.indexOf("-")>-1)
			{
				if( ReAutoDate.test( strDate ) == false )
					return false;
			//	Arr = ReGetDate.exec( strDate );
				Arr = strDate.split("-");
				strDate = (Arr[0]) + "" + (Arr[1].length<2?"0":"") + Arr[1] + (Arr[2].length<2?"0":"") + (Arr[2]);
			}

			if(strDate.length!=8)
				return false;
			if( ReDigital8.test(strDate)==false )
				return false;
			MyDate = eval( strDate.replace( /^(\d{4})(\d{2})(\d{2})$/, "new Date($1,$2-1,$3)" ) );
			strMyDate = MyDate.getFullYear()+(MyDate.getMonth()<9?"0":"")+(MyDate.getMonth()+1)+""+(MyDate.getDate()<=9?"0":"")+MyDate.getDate();
			//日期有效性验证
			if(strMyDate!=strDate)
				return false;
			//日期范围验证
			if( MyDate>=DateFrom && MyDate<=DateTo )
				return true;
			else
				return false;
		}
function openWin(url,width,height)
  {  
		 var winoffice ; 
		 strFeatures='Width='+width+'px,Height='+height+'px,help:no,status:no,scrollbars=yes,resizable=yes';  
		 winoffice=window.open(url,'',strFeatures);   
		 winoffice.moveTo((screen.availWidth-width)/2,(screen.availHeight-height)/2);  
  
     }