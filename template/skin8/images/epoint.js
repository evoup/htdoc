 function CheckEmail(InputID)
 {
		var list=document.getElementById(InputID);
		if(list.value!="")
		{
			if (list.value.search(/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/)==-1)
			{
			alert('�Ƿ����ʼ���ַ');
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
	c = s.charAt(i);//�ַ���s�е��ַ� 
	if (bag.indexOf(c) > -1) 
	return c; 
	} 
	return ""; 
} 
//��麯��: 
function ischinese(s) 
{ 
	var errorChar; 
	var badChar = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789><,<>{}?/+=|\\��\":;~!#$%()`"; 
	errorChar = isCharsInBag( s, badChar) 
	if (errorChar != "" ) 
	{ 
	alert('����������������д'); 
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
			//alert('�Ƿ��ĵ绰����');
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
						alert('��������ַ����ȳ�����'+InputLength+'���ַ�');
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
							
							alert('��������ַ��а����зǷ��ַ�!�㲻�����������ַ�');
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
					
						
						alert('��������ַ����ȳ�����'+InputLength+'���ַ�');
						list2[i].focus();
						return false;
						
					}
					var SpList=SpecialTxt.split('-');
					for(var j=0;j<SpList.length;j++)
					{
					
						if(list2[i].value.indexOf(SpList[j])>=0)
						{
							
							alert('��������ַ��а����зǷ��ַ�!');
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
			
				
				alert('��������ַ����ȳ�����'+InputLength+'���ַ�');
				list.focus();
				return false;
				
			}
			var SpList=SpecialTxt.split('');
			for(var j=0;j<SpList.length;j++)
			{
			
				if(list.value.indexOf(SpList[j])>=0)
				{
					
					alert('��������ַ��а����зǷ��ַ�!�㲻�����������ַ�'+SpecialTxt);
					list.focus();
					return false;
				}
				
			}
					
			
			return true;
}
function   cidInfo(sId){   
                  var   aCity={11:"����",12:"���",13:"�ӱ�",14:"ɽ��",15:"���ɹ�",21:"����",22:"����",23:"������",31:"�Ϻ�",32:"����",33:"�㽭",34:"����",35:"����",36:"����",37:"ɽ��",41:"����",42:"����",43:"����",44:"�㶫",45:"����",46:"����",50:"����",51:"�Ĵ�",52:"����",53:"����",54:"����",61:"����",62:"����",63:"�ຣ",64:"����",65:"�½�",71:"̨��",81:"���",82:"����",91:"����"}   
              var   iSum=0   
              var   info=""   
              if(!/^\d{17}(\d|[x])$/i.test(sId)){   
                  return   "false@��Ч�����֤����";   
              }   
              sId=sId.replace(/[x]$/i,"a");   
              
              if(aCity[parseInt(sId.substr(0,2))]==null){   
                  return   "Error:�Ƿ�����";   
              }   
              sBirthday=sId.substr(6,4)+"-"+Number(sId.substr(10,2))+"-"+Number(sId.substr(12,2));   
              var   d=new   Date(sBirthday.replace(/-/g,"/"));   
              if(sBirthday!=(d.getFullYear()+"-"+   (d.getMonth()+1)   +   "-"   +   d.getDate())){   
                  return   "Error:�Ƿ�����";   
              }   
              for(var   i   =   17;i>=0;i   --){   
                  iSum   +=   (Math.pow(2,i)   %   11)   *   parseInt(sId.charAt(17   -   i),11);   
              }   
              if(iSum%11!=1){   
                  return   "Error:�Ƿ�֤��";   
              }   
              return   aCity[parseInt(sId.substr(0,2))]+","+sBirthday+","+(sId.substr(16,1)%2?"��":"Ů");   
  } 
  //������֤�ţ�֧��15��18λ������ֵ��ʾ����ԭ��""��ʾ�޴�
		function CheckIDCard(strID)
		{
			//��֤��λ�ַ��Ƿ�Ϸ���������ʽ
			ReDigital15 = /\d{15}/;
			ReDigital18 = /\d{17}[0-9xX]{1}/;
			//��ȡ���ں�У���������ʽ
			ReDate15 = /\d{6}(\d{6})\d{3}/;
			ReDate18 = /\d{6}(\d{8})\d{3}/;
			switch(strID.length)
			{
				case 15:
					if( ReDigital15.test( strID ) == false )
						return "�Ƿ��ַ�";	
					Arr = ReDate15.exec( strID );
					strDate = "19" + Arr[1];
					if( CheckDate(strDate, new Date(1900,0,1), new Date(1999,11,31)) == false )
						return "������Ч";
				break;
				case 18:
					if( ReDigital18.test( strID ) == false )
						return "�Ƿ��ַ�";		
					Arr = ReDate18.exec( strID );
					strDate = Arr[1];
					if( CheckDate(strDate, new Date(1900,0,1), new Date()) == false )
						return "������Ч";
					if( CheckSum( strID ) == false )
						return "У�����";
				break;
				default:
					return "λ������";
				break;
			}
			return "";
		}

		//�����֤��У��λ������֤
		function CheckSum( strID )
		{
			//debugger;
			//18λ������ȡ������ʽ
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
//�����ָ����Χ֮�ڵ����ڣ�֧��ѡ����Զ����ɸ�ʽ���ֶ������ʽ������bool��true��ʾ������Ч��false��ʾ������Ч��
		function CheckDate( strDate, DateFrom, DateTo )
		{
			//�ֶ�������֤������ʽ
			ReDigital8 = /\d{8}/;
			//�Զ�������֤������ʽ
			ReAutoDate = /\d{4}-{1}\d{1,2}-\d{1,2}/;
			//�Զ�������ȡ������ʽ
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
			//������Ч����֤
			if(strMyDate!=strDate)
				return false;
			//���ڷ�Χ��֤
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