var g_is_signin = false;
var g_user_domain = "";

var g_guest_nickname = "";
var g_guest_uid = "";
var g_guest_domain = "";

var g_chk_signin = false;

var g_return_url = "";
var g_reg_popup = false;

if (window.ActiveXObject) window.ie = window[window.XMLHttpRequest ? 'ie7' : 'ie6'] = true;

var Cookie=
{
    get:function(name)
    {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++)
        {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return "";
    },
    set:function(name,value,days)
    {
        if (days)
        {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
        document.cookie = name+"="+value+expires+"; path=/; domain=.360quan.com";
    },
    del:function(name)
    {
        this.set(name,"",-1);
    },
    sup:function(){cookie.set('c',true);return cookie.del('c')}
};

function checkSigninStatus()
{

    if(g_chk_signin)
    {
        return;
    }

    g_chk_signin = true;

    g_guest_nickname = decodeURIComponent(Cookie.get("pt_nickname"));
    g_guest_domain = decodeURIComponent(Cookie.get("pt_cdm"));
    g_guest_uid = decodeURIComponent(Cookie.get("pt_uid"));

    if( g_guest_nickname == "" || g_guest_domain == "" || g_guest_uid == "" )
    {
        // not sign in
        g_is_signin = false;
        return false;

    }
    else
    {
        g_is_signin = true;
        g_user_domain = g_guest_domain;
    }
    return g_is_signin;

}

function print_im_swf_obj(){
    document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="0" height="0" id="myMovie" align="middle"><param name="allowScriptAccess" value="always" /><param name="movie" value="http://image.360quan.com/images/im/listen.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="http://image.360quan.com/images/im/listen.swf" quality="high" bgcolor="#ffffff" width="0" height="0" name="myMovie" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" ></embed></object>');
}

function listen_im_new() {
    try{
        getMovieName("myMovie").flAlert("http://im.360quan.com/chatevent.php?time=" + (new Date()).getTime());
        window.setTimeout(listen_im_new, 30000);
    }catch(e){
    }
}
function  listen_im_swf(){
    window.setTimeout(listen_im_new, 30000);
}
function getMovieName(movieName) {
    if (navigator.appName.indexOf("Microsoft") != -1) {
        return window[movieName]
   }
   else {
       return document[movieName]
   }
}
function progress(data){
    var icon = document.getElementById('im_message_icon');
    if(data.indexOf("On") != -1){
       icon.style.display = "";
    }else{
        icon.style.display = "none";
    }
}

function im_openNew(){
    try{
        var opened = Cookie.get("isOpenImWindow");
        if(opened != 'true')
        {
            Cookie.set("im_have_msg", "true", 1/24/360);
            Cookie.set('isOpenImWindow', 'true', 1/24/720);
            window.open("http://im.360quan.com/index.html");
        }
    }catch(e){
        alert(e.message);
    }
}

function g_strip_nouse(s)
{
    return s.replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&apos;");
}

var force_redirect = "";
function ptSignout(){
    Cookie.set("pt_s", "");
    Cookie.set("pt_uid", "");
    Cookie.set("pt_pwd", "");
    Cookie.set("pt_nickname", "");
    Cookie.set("pt_cdm", "");
    Cookie.set("pt_ver", "");


    if(force_redirect != ""){
        window.location.href = force_redirect;
    } else {
        window.location.reload();
    }
    return false;
}


function getUnreadMsgCount()
{
    if( typeof msg_status == "undefined" || typeof msg_status.unread == "undefined" )
    {
        window.setTimeout("getUnreadMsgCount()", 1000);
        return;
    }

    if (window.ie6) {
        document.getElementById("fm_msg_unread_ie6").innerHTML = "(" + parseInt(msg_status.unread) + ")";
    } else {
        document.getElementById("fm_msg_unread").innerHTML = "(" + parseInt(msg_status.unread) + ")";
    }
}

function printSigninStatusLite() {
    checkSigninStatus();

    document.write('<div class="temponline"><a href="http://member.360quan.com/online">'+ online_number +'人在线</a></div>');
    if( g_is_signin == true ) {
        document.write('<div class="tempmenu">');
        document.write('<ul>');
        document.write('<li><a class="hide" href="http://space.360quan.com/' + g_guest_domain + '" target="_self">' + g_strip_nouse(g_guest_nickname) + '▼</a>');
        document.write('<!--[if lte IE 6]>');
        document.write('<a class="username" href="http://space.360quan.com/' + g_guest_domain + '" target="_self">' + g_strip_nouse(g_guest_nickname));
        document.write('▼<table><tr><td>');
        document.write('<![endif]-->');
        document.write('	<ul>');
        document.write('	<li class="tempmenu_clear"><a href="http://my.360quan.com/">个人中心</a></li>');
        document.write('	<li class="tempmenu_clear"><a href="http://space.360quan.com/' + g_guest_domain + '">我的空间</a></li>');
        document.write('	</ul>');
        document.write('<!--[if lte IE 6]>');
        document.write('</td></tr></table>');
        document.write('</a>');
        document.write('<![endif]-->');
        document.write('</li>');
        document.write('<li><a class="hide" href="http://album.360quan.com/album/add">秀自己▼</a>');
        document.write('<!--[if lte IE 6]>');
        document.write('<a class="username" href="http://album.360quan.com/album/add">秀自己▼');
        document.write('<table><tr><td>');
        document.write('<![endif]-->');
        document.write('	<ul>');
        document.write('	<li class="tempmenu_clear"><a href="http://album.360quan.com/album/add">传照片</a></li>');
        document.write('	<li class="tempmenu_clear"><a href="http://blog.360quan.com/blog/add">写日志</a></li>');
        document.write('	<li class="tempmenu_clear"><a href="http://video.360quan.com/video/add">录视频</a></li>');
        document.write('	<li class="tempmenu_clear"><a href="http://album.360quan.com/album/addBigHead">大头贴</a></li>');
        document.write('	</ul>');
        document.write('<!--[if lte IE 6]>');
        document.write('</td></tr></table>');
        document.write('</a>');
        document.write('<![endif]-->');
        document.write('</li>');
        document.write('<li><a class="hide" href="http://message.360quan.com">新消息</a><span class="fig"><span id="fm_msg_unread"></span></span>');
        document.write('<!--[if lte IE 6]>');
        document.write('<a class="username" href="http://message.360quan.com">新消息</a><span class="figie"><span id="fm_msg_unread_ie6"></span></span>');
        document.write('<![endif]-->');
        document.write('</li>');
        document.write('<li class="im_lite" id="im_message_icon" style="display:none;"><a href="javascript:im_openNew();"><img src="../css/cssimg/im.gif" /></a></li>');
        document.write('</ul>');
        document.write('<a class="temp_quit" href="###" onclick="ptSignout()">退出</a>');
        document.write('<div class="clear">&nbsp;</div>');
        document.write('</div>');
        document.write('<scr'+'ipt type="text/javascr'+'ipt" src="http://passport.360quan.com/passport.php?action=messageStatusJs&channel_id='+ g_guest_uid +'" defer="true"></scr'+'ipt>');
        window.setTimeout("getUnreadMsgCount()", 1000);

        try{
            print_im_swf_obj();
            setTimeout("listen_im_swf()",20000);
        }catch(e){
            // do nothing
        }
    } else {
        if (g_reg_popup) {
            var popup = " target='_blank' ";
        }
        document.write('<div class="tempoffline"><a href="http://passport.360quan.com/passport.php?action=signup"' + popup + '>加入360圈</a><a href="http://passport.360quan.com/passport.php?action=signin&return=' + encodeURIComponent(g_return_url) + '">用户登录</a></div>');
    }
}

function printSigninStatus()
{
    checkSigninStatus();
alert("g_is_signin");
    if( g_is_signin == true )
    {return;
	
        document.write('<div class="onlineuser" ><a href="http://member.360quan.com/online">'+ online_number +'人在线</a></div>');
        document.write('<div class="topmenu">');
        document.write('<ul>');
        document.write('<li><div class="menuleft"></div><a class="hide" href="http://space.360quan.com/'+ g_guest_domain + '"><img class="navhead" src="http://passport.360quan.com/passport.php?action=userlogo&userid='+ g_guest_uid +'&width=16&height=16"/>'+ g_strip_nouse(g_guest_nickname) + '<img class="menudoc" src="../css/cssimg/menudoc.gif"></a><div class="menudoc"></div><div class="menuright"></div>');
        document.write('<!--[if lte IE 6]>');
        document.write('<a class="username" href="http://space.360quan.com/'+ g_guest_domain +'"><img class="navhead" src="http://passport.360quan.com/passport.php?action=userlogo&userid='+ g_guest_uid +'&width=16&height=16" />'+ g_strip_nouse(g_guest_nickname));
        document.write('<table><tr><td>');
        document.write('<![endif]-->');
        document.write('<ul>');
        document.write('<li class="navclear"><a href="http://my.360quan.com">个人中心</a></li>');
        document.write('<li class="navclear"><a href="http://space.360quan.com/'+ g_guest_domain +'">我的空间</a></li>');
        document.write('</ul>');
        document.write('<!--[if lte IE 6]>');
        document.write('</td></tr></table>');
        document.write('</a><div class="menudoc2"></div><div class="menuright2"></div>');
        document.write('<![endif]-->');
        document.write('</li>');
        document.write('<li><div class="menuleft"></div><a class="hide" href="http://space.360quan.com/' + g_guest_domain + '?action=myFriend">朋友<img class="menudoc" src="../css/cssimg/menudoc.gif"></a><div class="menudoc"></div><div class="menuright"></div>');
        document.write('<!--[if lte IE 6]>');
        document.write('<a href="#">朋友');
        document.write('<table><tr><td>');
        document.write('<![endif]-->');
        document.write('<ul>');
        document.write('<li class="navclear"><a href="http://space.360quan.com/' + g_guest_domain + '?action=myFriend">我的朋友</a></li>');
        document.write('<li class="navclear"><a href="http://passport.360quan.com/passport.php?action=invite">邀请朋友</a></li>');
        document.write('<li class="navclear"><a href="http://www.360quan.com/search?type=find">找朋友</a></li>');
        document.write('</ul>');
        document.write('<!--[if lte IE 6]>');
        document.write('</td></tr></table>');
        document.write('</a><div class="menudoc2"></div><div class="menuright2"></div>');
        document.write('<![endif]-->');
        document.write('</li>');
        document.write('<li><div class="menuleft"></div><a class="hide" href="http://www.360quan.com/maps.html">圈子<img class="menudoc" src="../css/cssimg/menudoc.gif"></a><div class="menudoc"></div><div class="menuright"></div>');
        document.write('<!--[if lte IE 6]>');
        document.write('<a href="http://www.360quan.com/maps.html">圈子');
        document.write('<table><tr><td>');
        document.write('<![endif]-->');
        document.write('<ul>');
        document.write('<li class="navclear"><a href="http://space.360quan.com/' + g_guest_domain + '?action=myGroup">我的圈子</a></li>');
        document.write('<li class="navclear"><a href="http://www.360quan.com/search?q=&type=group">找圈子</a></li>');
        document.write('</ul>');
        document.write('<!--[if lte IE 6]>');
        document.write('</td></tr></table>');
        document.write('</a><div class="menudoc2"></div><div class="menuright2"></div>');
        document.write('<![endif]-->');
        document.write('</li>');
        document.write('<li><div class="im"><img id="im_message_icon" ;="" onclick="im_openNew()" src="../css/cssimg/im.gif" style="cursor: pointer; float: none; margin-left: 1px; vertical-align: middle;display:none;"/></div><div class="menuleft"></div><a class="hide" href="http://message.360quan.com">消息<span id = "fm_msg_unread"></span></a><div class="menuright"></div>');
        document.write('<!--[if lte IE 6]>');
        document.write('<a href="http://message.360quan.com">消息<span id="fm_msg_unread_ie6"></span>');
        document.write('<table><tr><td>');
        document.write('<![endif]-->');
        document.write('<!--[if lte IE 6]>');
        document.write('</td></tr></table>');
        document.write('</a><div class="menuright2"></div>');
        document.write('<![endif]-->');
        document.write('</li>');
        document.write('<li><div class="menuleft"></div><a class="hide" href="http://album.360quan.com/album/add">秀自己<img class="menudoc" src="../css/cssimg/menudoc.gif"></a><div class="menudoc"></div><div class="menuright"></div>');
        document.write('<!--[if lte IE 6]>');
        document.write('<a href="http://album.360quan.com/album/add">秀自己');
        document.write('<table><tr><td>');
        document.write('<![endif]-->');
        document.write('<ul>');
        document.write('<li class="navclear"><a href="http://album.360quan.com/album/add">传照片</a></li>');
        document.write('<li class="navclear"><a href="http://blog.360quan.com/blog/add">写日志</a></li>');
        document.write('<li class="navclear"><a href="http://video.360quan.com/video/add">录视频</a></li>');
        document.write('<li class="navclear"><a href="http://album.360quan.com/album/addBigHead">大头贴</a></li>');
        document.write('</ul>');
        document.write('<!--[if lte IE 6]>');
        document.write('</td></tr></table>');
        document.write('</a><div class="menudoc2"></div><div class="menuright2"></div>');
        document.write('<![endif]-->');
        document.write('</li>');
        document.write('</ul>');
        document.write('<a class="navquit" href="###" onclick="ptSignout()">退出</a>');
        document.write('<div class="clear">&nbsp;</div>');
        document.write('</div>');
	document.write('<scr'+'ipt type="text/javascr'+'ipt" src="http://passport.360quan.com/passport.php?action=messageStatusJs&channel_id='+ g_guest_uid +'" defer="true"></scr'+'ipt>');
        window.setTimeout("getUnreadMsgCount()", 1000);

        try{
            print_im_swf_obj();
            setTimeout("listen_im_swf()",20000);
        }catch(e){
            // do nothing
        }
    }else{return;
	// not sign in
	var site_dir='[##site_dir##]/';
	var site_dir='';
        document.write('<img style="float:left;" src="./'+site_dir+'css/cssimg/slogen.gif">');
        document.write('<div class="onlineuser2">');
	document.write('<a class="onlinefig"><a href="http://member.360quan.com/online">'+ online_number +'人在线</a>');
	document.write('<a class="sethome" href="#" onclick = "this.style.behavior=\'url(#default#homepage)\'; this.setHomePage(\'http://www.360quan.com\');">设为首页</a></div>');
	document.write('<div class="navlogin"><a href="http://passport.360quan.com/passport.php?action=signin">登录</a><a href="http://passport.360quan.com/passport.php?action=signup">注册</a></div>');
    }
}
