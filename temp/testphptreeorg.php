<?   
  //����Ŀ¼�ṹģ�����   
  //�˵�Ŀ¼���ֶ�˵����   
  //menu_id �˵���Ŀ id   
  //menu �˵�����   
  //menu_grade �˵��ȼ� 1 Ϊ���˵� 2 Ϊ�����˵� ........   
  //menu_superior ��һ���˵� id ��   
$temp1=$_GET['menu_grade_temp'];
$temp5=$_GET['menu_grade_temp'];
$temp6=$_GET['menu_superior_temp'];


  function my_menu($menu_content,$i,$menu_grade_temp,$menu_superior_temp)   
  {   
    global $php_self;   
    $temp1=$menu_grade_temp+1;   
    $menu_superior_temp_array=split("/",$menu_superior_temp);   
    for ($t=0;$t<$i;$t++)   
    {   
      $menu_array=split("/",$menu_content[$t]);   
      if(($menu_array[2]==$menu_grade_temp)&&($menu_array[3]==$menu_superior_temp_array[$menu_grade_temp-1]))   
      {   
        for($p=1;$p<=$menu_grade_temp;$p++){echo "&nbsp;&nbsp;";}   
        $temp3=$menu_superior_temp_array;   
        $temp3[$menu_grade_temp]=$menu_array[0];   
        $temp2=implode("/",$temp3);   
        if ($menu_array[0]==$menu_superior_temp_array[$temp1-1])   
        {   
          $temp5=$temp1-1;   
          $temp3[$menu_grade_temp]="";   
          $temp6=implode("/",$temp3);   
          echo "<a href=".$php_self."?menu_grade_temp=".$temp5."&menu_superior_temp=".$temp6.">".$menu_array[1]."</a><br>";   
          my_menu($menu_content,$i,$temp1,$temp2);   
        }   
        else   
        {   
          $temp3[$menu_grade_temp+1]="";   
          $temp6=implode("/",$temp3);   
          echo "<a href=".$php_self."?menu_grade_temp=".$temp1."&menu_superior_temp=".$temp6.">".$menu_array[1]."</a><br>";   
        }   
      }   
    }   
  }   
  // ���� mysql    
  $db_host="localhost";   
  $db_user="root";   
  $db_password="getter";   
  $db_name="jzoa";   
  mysql_connect($db_host,$db_user,$db_password); 
  mysql_query('set names "gbk"');
  mysql_select_db($db_name);   

  //����ȡ������   
  $query_string="select * from fsdcu order by grade";   
  $db_data=mysql_query($query_string);   

  //��һ��ִ�г�ʼ��   
  if ($menu_grade_temp=="")   
  {   
    $menu_superior_temp=0;   
  }   

  //�����е���Ϣ�������飬��ͳ���������   
  $i=0;   
  while (list($ID,$subdirname,$grade,$superior)=mysql_fetch_row($db_data))   
  {   
    $menu_content[$i]=$ID."/".$subdirname."/".$grade."/".$superior;   
    $i++;   
  }   
  my_menu($menu_content,$i,1,$menu_superior_temp);   
  ?>