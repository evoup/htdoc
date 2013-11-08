/*alert(document.cookie)*/
//from 360quan.com get cookie value foreach key
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
       // document.cookie = name+"="+value+expires+"; path=/; domain=.360quan.com";
	    document.cookie = name+"="+value+expires+"; path=/;";
    },
    del:function(name)
    {
        this.set(name,"",-1);
    },
    sup:function(){cookie.set('c',true);return cookie.del('c')}
};

	//g_guest_islogin = Cookie.get("islogin");
	
	//alert(g_guest_islogin);


var g_guest_islogin = Cookie.get("islogin");
//alert(g_guest_islogin);