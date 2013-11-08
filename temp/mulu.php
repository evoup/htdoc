<?php
//以树型结构列出指定目录里的所有文件，如果你想知道自己某个目录里有哪些子目录和文件，可以调用这个类来查看，很方便的。

    # 演示的例子:
    $t = new TreeClimber( "templates_c" ); //新建物件,设置需要列出的目录:在此为asp目录
    echo arrayValuesToString( $t->getFileList( $t->getPath() ), "<BR>\n" );
    
    function arrayValuesToString( $ar, $nl="", $dolast=true ) {//调用函数
    $str = "";
    reset( $ar );
    $size = sizeof( $ar );
    $i = 1;
    while( list( $k, $v ) = each( $ar ) ) {
    if ( $dolast == false ) {
    if ( $i < $size ) {
        $str .= $ar[$k].$nl;
    }
    else {
        $str .= $ar[$k];
    }
    }
    else {
    $str .= $ar[$k].$nl;
    }
    $i++;
    }
    return $str;
    }
    ?>
    <?
    //以下为类文件
    class TreeClimber {
    var $path;
    var $fileList = array();
    function TreeClimber( $path = "." ) {
    $this->path = $path;
    }
    
    # 存取路径
    function getPath() { return $this->path; }
    function setPath( $v ) { $this->path = $v; }
    
    // 返回指定目录里的文件列表，如果没有指定目录，将使用当前目录
    //如果不能打开目录（可能没权限或目录不存在，将返回为空
    //以递归方式进行
     function getFileList( $dirname=null, $returnDirs=false, $reset=true ) {
    if ( $dirname == null ) { $dirname = $this->path; }
    # else { $this->setPath( $dirname ); }
    # dout( "Recursing into $dirname..." );
    if ( $reset ) {  
    $this->fileList = array();
    }
    $dir = opendir( $dirname );
    if ( ! $dir ) {  
    print( "<B><FONT COLOR=#FF0000>注意: TreeClimber.getFileList( $dirname ): 不能打开 $dirname!</FONT></B>" );
    return null;  
    }
    while( $file = readdir( $dir ) ) {
    if ( ereg( "^\.$", $file ) || ereg( "^\.\.$", $file ) ) continue;
    if ( is_dir( $dirname."/".$file ) ) {
    $this->getFileList( $dirname."/".$file, $returnDirs, false );
    if ( $returnDirs ) { $this->fileList[] = $dirname."/".$file;}
    }
    else { $this->fileList[] = $dirname."/".$file; }
    }
    sort( $this->fileList );
    return $this->fileList;
    }
    } //至此类结束
    ?>
