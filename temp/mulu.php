<?php
//�����ͽṹ�г�ָ��Ŀ¼��������ļ����������֪���Լ�ĳ��Ŀ¼������Щ��Ŀ¼���ļ������Ե�����������鿴���ܷ���ġ�

    # ��ʾ������:
    $t = new TreeClimber( "templates_c" ); //�½����,������Ҫ�г���Ŀ¼:�ڴ�ΪaspĿ¼
    echo arrayValuesToString( $t->getFileList( $t->getPath() ), "<BR>\n" );
    
    function arrayValuesToString( $ar, $nl="", $dolast=true ) {//���ú���
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
    //����Ϊ���ļ�
    class TreeClimber {
    var $path;
    var $fileList = array();
    function TreeClimber( $path = "." ) {
    $this->path = $path;
    }
    
    # ��ȡ·��
    function getPath() { return $this->path; }
    function setPath( $v ) { $this->path = $v; }
    
    // ����ָ��Ŀ¼����ļ��б����û��ָ��Ŀ¼����ʹ�õ�ǰĿ¼
    //������ܴ�Ŀ¼������ûȨ�޻�Ŀ¼�����ڣ�������Ϊ��
    //�Եݹ鷽ʽ����
     function getFileList( $dirname=null, $returnDirs=false, $reset=true ) {
    if ( $dirname == null ) { $dirname = $this->path; }
    # else { $this->setPath( $dirname ); }
    # dout( "Recursing into $dirname..." );
    if ( $reset ) {  
    $this->fileList = array();
    }
    $dir = opendir( $dirname );
    if ( ! $dir ) {  
    print( "<B><FONT COLOR=#FF0000>ע��: TreeClimber.getFileList( $dirname ): ���ܴ� $dirname!</FONT></B>" );
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
    } //���������
    ?>
