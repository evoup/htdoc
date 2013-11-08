<?php
//******************************************************************************
//This class lets you search MySql tables for some text.
//To connect to a database, it uses functions built in PHP.
//The class recognizes words and phrases (using double quotes) and can use
//either AND or OR logical operators in the search. It doesn't display
//the results. It just returns them, letting user do with it, whatever he/she
//likes.
//If session is started, it stores the last needle there and can use it at the
//next page, while drawing search form.
//
//See documentation for details about methods and parameters
//******************************************************************************
class DatabaseSearch
{

      var $db_host;
      var $db_database;
      var $db_user;
      var $db_pass;
      var $needle;
      var $logic;
      var $debug;
      
//------------------------------------------------------------------------------

      //constructor
      function DatabaseSearch($host,$database,$user,$pass,$debug=false)
      {
       //initialize varibles
       $this->db_host = $host;
       $this->db_database = $database;
       $this->db_user = $user;
       $this->db_pass = $pass;
       $this->debug = $debug;
       
       if (session_id() == "") // if session doesn't exist
       {
        $this->needle = (isset($_POST['DatabaseSearchNeedle']))?$_POST['DatabaseSearchNeedle']:"";
        if (get_magic_quotes_gpc()) $this->needle = stripslashes($this->needle);
       }
       else
       {
        //initialize if not present
        if (!isset($_SESSION['DatabaseSearchNeedle']))$_SESSION['DatabaseSearchNeedle'] = "";
        //if search form was submitted, set new value
        $_SESSION['DatabaseSearchNeedle'] = (isset($_POST['DatabaseSearchNeedle']))?$_POST['DatabaseSearchNeedle']:$_SESSION['DatabaseSearchNeedle'];
        if (get_magic_quotes_gpc()) $this->needle = stripslashes($_SESSION['DatabaseSearchNeedle']);
        else $this->needle = $_SESSION['DatabaseSearchNeedle'];

       }
       if (isset($_POST['DatabaseSearchLogic'])&&$_POST['DatabaseSearchLogic']=="AND")
           $this->logic="AND";
       else
           $this->logic="OR";
      }//end DatabaseSearch

//------------------------------------------------------------------------------
      
      //draw search form (you do not have to use it - if you want a different look, override this)
      function DrawForm($action,$size=15,$input_class="",$submit_class="",$submit_text="Search",$logic=false)
      {
       $submit_class_txt = ($submit_class=="")?"":" class=".$submit_class;
       $input_class_txt = ($input_class=="")?"":" class=".$input_class;
       if ($logic) $logic_txt = '<INPUT TYPE="RADIO" NAME="DatabaseSearchLogic" VALUE="OR" checked>OR <INPUT TYPE="RADIO" NAME="DatabaseSearchLogic" VALUE="AND">AND <br>';
       else $logic_txt="";
       $value = htmlspecialchars($this->needle);
       echo <<<END
            <form method="post" action="$action">
            <input name="DatabaseSearchNeedle" value="$value" size="$size"$input_class_txt type="text">
            $logic_txt
            <input value="$submit_text" name="Go"$submit_class_txt type="submit">
            </form>
END;
      }// end DrawForm
      
//------------------------------------------------------------------------------

      //change text into array of words and phrases
      function ProcessNeedle($text)
      {
       $output = array();
       $output2 = array();
       $arr = explode('"',$text);

       for ($i=0;$i<count($arr);$i++)
       {
           if ($i%2==0)
           {
            $output=array_merge($output,explode(" ",$arr[$i]));
           }
           else $output[] = $arr[$i];
       }
       foreach($output as $word) if (trim($word)!="") $output2[]=$word;
       return $output2;
      }


//------------------------------------------------------------------------------
      
      //Main search function. Logic can take either AND or OR
      function DoSearch($table,$return_field,$fields,$text="",$logic="")
      {
       if ($logic=="") $logic = $this->logic;
       if ($text=="") $text = $this->needle;
       if (trim(str_replace("\""," ",$text))!="")
       {
        $words = $this->ProcessNeedle($text);
        $output = array();
        //init database connection
        $server_id = mysql_connect($this->db_host,$this->db_user,$this->db_pass);
        mysql_select_db($this->db_database,$server_id);
        if (!is_array($fields)) $fields=array($fields);

        $concat = "CONCAT(";
        foreach($fields as $field)
        {
         $concat.="$field,";
        }
        $concat.="'')";
        $sql = "SELECT DISTINCT $return_field FROM $table WHERE";
        if ($logic=="OR") $sql.=" 0";
        else $sql.=" 1";
        foreach ($words as $word) $sql.=" $logic $concat LIKE '%$word%'";
        $sql.=" ORDER BY $return_field DESC;";
        $result = mysql_query($sql,$server_id);
        if ($this->debug) echo "<br>SQL query: $sql <br>".mysql_error($server_id);
        while($row = mysql_fetch_row($result))
        {
         $output[] = $row[0];
        }
        mysql_free_result($result);
        mysql_close($server_id);
        return $output;
      }
      else return false;//return false if needle is empty
      }//end DoSearch
}
?>
