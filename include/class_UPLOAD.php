<?php
/**
 * <p>
 * Class UPLOAD_FILES.<br>
 *
 * This class has the purpose of ease and secure the upload of files.<br>
 *
 * It executes several tests on the uploaded files and the upload directory
 * to validate and secure the upload. It checks the file name extension,
 * type, size and directory permissions.<br>
 *
 * It may also create the uploading directory structure, generate a unique
 * random name for the uploaded file, upload multiples files, and keep track
 * of the upload success or failure.<br>
 *
 * @author    Marcos Thiago <fabismt@yahoo.com.br>
 * @version   1.0
 * @copyright Freeware
 * @package   UPLOAD_FILES
 * @example   example.php
 * @since     06/2004
**/

class UPLOAD_FILES
{

  /**
   * Receives the original name of the uploaded file.
   *
   * @var     string
   * @access  private
  **/
  var $name;
  
  /**
   * Receives the type of the uploaded file.
   *
   * @var     string
   * @access  private
  **/    
  var $type;
  
  /**
   * Receives the temporary path and name of the uploaded file.
   *
   * @var     string
   * @access  private
  **/        
  var $tmp_name;

  /**
   * Receives the error of the uploaded file.
   *
   * @var     string
   * @access  private
  **/            
  var $error;
  
  /**
   * Store the size of the uploaded file.
   *
   * @var     string
   * @access  private
  **/            
  var $size;

  /**
   * Keep track of the files successfully uploaded.
   *
   * @var     array
   * @access  private
   * @see     moveFileToDestination()
  **/
  var $succeed_files_track;
  
  /**
   * Keep track of the files which fail the upload.
   *
   * @var     array
   * @access  private
   * @see     moveFileToDestination()
  **/
  var $fail_files_track;

  /**
   * Keep the index of the succeed_files_track array.
   *
   * @var     int
   * @access  private
   * @see     moveFileToDestination()
   **/
  var $succeed_track_index;

  /**
   * Keep the index of the fail_files_track array.
   *
   * @var     int
   * @access  private
   * @see     moveFileToDestination()
   **/
  var $fail_track_index;
  
  /**
   * Receives an array with the supported file extensions and types.
   *
   * @var     array
   * @access  private
   * @see     checkUploadConditions()
   **/    
  var $supported_extensions;

  /**
   * Receives the destination directory for uploaded files.
   *
   * @var     string
   * @access  private
   * @see     checkUploadConditions(),createDiretoryStructure(),moveFileToDestination()
  **/    
  var $dst_dir;

  /**
   * Store the permission for the uploaded file. 
   * Default value is 0444(read only).
   *
   * @var     string
   * @access  private
   * @see     moveFileToDestination()
  **/    
  var $file_perm;

  /**
   * Store the field name of the uploaded file.
   *
   * @var     string
   * @access  private
   * @see     moveFileToDestination()
  **/    
  var $fld_name;

  /**
   * Store the file maximum size allowed in bytes.
   * Default value is 40960 bytes (40 KB).
   *
   * @var     int
   * @access  private
   * @see     checkUploadConditions()
  **/        
  var $max_file_size; //bytes.

  /**
   * Store messages of upload status.
   *
   * @var     array
   * @access  private
   * @see     moveFileToDestination()
  **/            
  var $msg;

  /**
   * Store the error code of upload.
   * It became the index for array msg.
   *
   * @var     int
   * @access  private
  **/            
  var $error_type; // error code.

  /**
   * If TRUE generate a random name to the file else maintain the original name.
   * Default value is TRUE;
   *
   * @var     boolean
   * @access  private
   * @see     moveFileToDestination()
  **/            
  var $randon_name;  

  /**
   * If TRUE replace a existent file, else mantain the original file.
   * Default value is TRUE;
   *
   * @var     boolean
   * @access  private
   * @see     moveFileToDestination()
  **/            
  var $replace;  



var $realname;//实际上传的名字

///////////////////////////////////////////////////////////////////
  /**
   * Constructor
   *
   * @access  public
  **/
  function UPLOAD_FILES(){

    $this->name                 = "";
	$this->realname				= "";
    $this->type                 = "";
    $this->tmp_name             = "";
    $this->error                = "";
    $this->size                 = "";
    $this->succeed_files_track  = array();
    $this->fail_files_track     = array();
    $this->succeed_track_index  = 0;
    $this->fail_track_index     = 0;
    $this->supported_extensions = array();
    $this->dst_dir              = "";
    $this->file_perm            = "0444";
    $this->fld_name             = "";
    $this->max_file_size        = 40960; //bytes.
    $this->msg                  = array (
                                  "0" => "上传成功!",
                                  "1" => "文件错误或扩展名不被允许!",
                                  "2" => "超过文件大小限制!",
                                  "3" => "尝试创建目录失败!",
                                  "4" => "路径错误!",          
                                  "5" => "溢出!",
                                  "6" => "未找到的文件!",
                                  "7" => "文件已经存在!"
                                  );
    $this->error_type           = 0; // error code.
    $this->randon_name          = TRUE;
    $this->replace              = TRUE;
	$this->dstname				= "";//evoupV1.1我加上的用来返回生成的文件名字给略图函数用
  }
///////////////////////////////////////////////////////////////////
  /**
   * Set value to class variables.
   *
   * @param   string  $var
   * @param   string  $value
   * @access  public
  **/
  function set($var,$value){//这个方法很不错，再对象里初始化类的成员，但是不要学，还是用PHP5的OO
    $this->$var = $value;
	  }
///////////////////////////////////////////////////////////////////  
  /**
   * Get value of class variables.
   *
   * @param   string  $var
   * @access  public
  **/
  function get($var){
    return $this->$var;
  }
///////////////////////////////////////////////////////////////////
  /**
   * Generate a unique name to the uploaded file.
   *
   * @access  private
  **/
  function generateUniqueId(){
    return md5(uniqid(mt_rand(),TRUE));
  }
///////////////////////////////////////////////////////////////////  
  /**
   * Generate the file unique name with extension.
   * 
   * @access  private
   * @return  string $dst_file_name
   * @uses    generateUniqueId()
  **/
  function generateFileName(){
    $dst_file_name = $this->generateUniqueId();
    $arr = split("\.",$this->name);
    $dst_file_name .= ".".$arr[count($arr)-1];
    return $dst_file_name;
  }
///////////////////////////////////////////////////////////////////  
  /**
   * Replace accents and special chars from file name.
   * 
   * @access  private
   * @return  string $string
  **/
  function fixFileName($string){
    $string = strtr ( $string, "懒旅呐噌忏溴矣哉重蝮趱鲽壬仕栝觌晴掏蜗祉铒仝圮疡", "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn");
    for($i=0 ; $i < strlen($string); $i++){
       if(!ereg("([0-9A-Za-z_\.])",$string[$i]))
         $string[$i] = "_";
    }
    return $string;
  }
///////////////////////////////////////////////////////////////////
  /**
   * Check upload condictions for file and directory.
   * 
   * @access  private
   * @return  bool (true/false)
   * @uses    createDiretoryStructure()
  **/
  function checkUploadConditions(){

    //-------- extension and type check -----------//
    $arr = split("\.",$this->name);
    $ext = $arr[count($arr)-1];
    foreach($this->supported_extensions as $each_ext => $type)
		//去掉了下面的一个条件,因为不支持forefox不知道未什么
     // if(strtolower($each_ext) == strtolower($ext) && $this->type == $type) $allow = TRUE;
     if(strtolower($each_ext) == strtolower($ext)) $allow = TRUE;
    if(!$allow) {
      $this->error_type = 1;
      return FALSE;
    }
    //----------------------------------------------//

    //------ size check ----------------------------//
    if($this->size > $this->max_file_size) {
      $this->error_type = 2;
      return FALSE;
    }
    //----------------------------------------------//


    //----- directory check ------------------------//
    if(!file_exists($this->dst_dir)){
      if(!$this->createDiretoryStructure()){
        $this->error_type = 3;
        return FALSE;
      } else {
        return TRUE; 
      }
    } elseif (!is_writable($this->dst_dir)){ 
      $this->error_type = 4;
      return FALSE;
    } else {
      return TRUE;
    }
    //----------------------------------------------//

  }
///////////////////////////////////////////////////////////////////  
  /**
   * Try to create directory structure for upload.
   * 
   * @access  private
   * @return  bool (true/false)
  **/
  function createDiretoryStructure(){

    $arr = split("/",$this->dst_dir);

    /* Dumping possible garbage inside vector like 
       empty indexes leaved by repeated slashes.  */
    $j=0;
    for($i=0; $i < count($arr); $i++)
      if($arr[$i]) $new_arr[$j++] = $arr[$i];
    //---------------------------------------------//

    $arr = $new_arr;
    $end = count($arr);

    for($i=0; $i < $end; $i++){
      $path .= "/".$arr[$i];
      if(!file_exists($path)) {
        if(!@mkdir($path,0755)) { 
          $fail = TRUE; 
          break; 
        }
      }
    }

    if($fail) return FALSE; else return TRUE;
  }
///////////////////////////////////////////////////////////////////  
  /**
   * Execute the upload. 
   * This is the main function that should be used outside this class.
   * Also is responsable for keep track of succeed and failure uploads.
   * 
   * @access  public
   * @return  bool (true/false)
   * uses     checkUploadConditions(),generateFileName()
  **/
  function moveFileToDestination(){

    if(is_uploaded_file($this->tmp_name) && $this->dst_dir){
      if($this->checkUploadConditions()){
        $dst_file_name = ($this->randon_name) ? $this->generateFileName() : $this->fixFileName($this->name);
        $full_destination_path = $this->dst_dir."/".$dst_file_name;
        if(file_exists($full_destination_path) && !$this->replace) {
          $this->error_type = 7;
        } else {
          if(@move_uploaded_file($this->tmp_name,$full_destination_path)){
            @chmod ($this->dst_dir."/".$dst_file_name,$this->file_perm);
            $this->error_type = 0; 
          } else {
            $this->error_type = 5; 
          }
        }
      }
    } else {
      $this->error_type = 6; 
    }

    if($this->error_type != 0){
      $this->fail_files_track[$this->succeed_track_index]["file_name"]             = $this->name;
	$this->fail_files_track[$this->succeed_track_index]["real_file_name"]             = $this->realname;//实际上传文件名，因为可能重复的，所以这里用了唯一生产file_name
	
      $this->fail_files_track[$this->succeed_track_index]["new_file_name"]         = $dst_file_name;
      $this->fail_files_track[$this->succeed_track_index]["destination_directory"] = $this->dst_dir;
      $this->fail_files_track[$this->succeed_track_index]["field_name"]            = $this->fld_name;
      $this->fail_files_track[$this->succeed_track_index]["file_size"]             = $this->size;
      $this->fail_files_track[$this->succeed_track_index]["file_type"]             = $this->type;
      $this->fail_files_track[$this->succeed_track_index]["error_type"]            = $this->error_type;
      $this->fail_files_track[$this->succeed_track_index++]["msg"]                 = $this->msg[$this->error_type];
      return FALSE;
    } else {
      $this->succeed_files_track[$this->fail_track_index]["file_name"]             = $this->name;
	  	$this->succeed_files_track[$this->fail_track_index]["real_file_name"]             = $this->realname;//实际上传文件名，因为可能重复的，所以这里用了唯一生产file_name

      $this->succeed_files_track[$this->fail_track_index]["new_file_name"]         = $dst_file_name;
      $this->succeed_files_track[$this->fail_track_index]["destination_directory"] = $this->dst_dir;
      $this->succeed_files_track[$this->fail_track_index]["field_name"]            = $this->fld_name;
      $this->succeed_files_track[$this->fail_track_index]["file_size"]             = $this->size;
      $this->succeed_files_track[$this->fail_track_index]["file_type"]             = $this->type;
      $this->succeed_files_track[$this->fail_track_index]["error_type"]            = $this->error_type;
      $this->succeed_files_track[$this->fail_track_index++]["msg"]                 = $this->msg[$this->error_type];
	  $this->dstname=$dst_file_name;//evoupV1.1返回生成文件名成员
      return TRUE;
    }
  }
  function returnOKfilename(){//返回如果上传新的图片并且成功后的文件名,注意这是我加的，要上传OK了后才调用之
  return $this->dstname;
  }
///////////////////////////////////////////////////////////////////
}
?>