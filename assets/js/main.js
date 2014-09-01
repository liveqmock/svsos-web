/*
 替换select为可编辑样式
 */
function repselect(className) {

    var se = $("." + className);
    var seli = se.find("ul li");
    se.hover(
            function() {
                $(this).css("z-index", "9999");
                $(this).find(".select_item").addClass("active");
                $(this).find("ul.item_list").css("display", "block");
            },
            function() {
                $(this).css("z-index", "");
                $(this).find("ul.item_list").css("display", "none");
                $(this).find(".select_item").removeClass("active");

            }
    );

    seli.click(function() {
        $(this).parent().parent().find("span.select_item").html($(this).find("a").html());
        $(this).parent().parent().find("input").val($(this).find("a").attr("dc"));
        if ($(this).find("a").attr("dc") == 'bldgcode') {
            $(this).parent().parent().find("input").attr('name', 'bldgcode');
            $(this).parent().parent().find("input").val('21');
            $('#houselr').val('0');
            $('#houseba').val('0');
        }
        $(this).parent().css("display", "none");
    });
}


/*header下拉菜单*/


function select_other(className) {

    $("#select_other").hover(
            function() {
                $(".user_kbox").addClass("hover");
            },
            function() {
                $(".user_kbox").removeClass("hover");
            }
    );
    $(".user_kbox").hover(
            function() {
                $(".user_kbox").addClass("hover");
            },
            function() {
                $(".user_kbox").removeClass("hover");
            }
    );
}

/*header下拉菜单*/


function listbg(className) {

    $("#listbg li").hover(
            function() {
                $(this).addClass("hover");
            },
            function() {
                $(this).removeClass("hover");
            }
    );
}


//左侧菜单
function detail_rm_menu(mpar, mtit, mcont, but, hide) {
    var mtitle = $(mpar + " " + mtit);
    var mbq = $(mpar + " " + mtit + " " + but);
    var menucount = $(mpar + " " + mcont);
    var hidebut = $(mpar + " " + mtit + " " + hide);
    mtitle.each(function(i) {
        //$(this).css("cursor","pointer");
        $(this).click(function() {
            if ($(menucount[i - 1]).css("display") == 'block') {
                $(menucount[i - 1]).css("display", "none");
                //$(mbq[i-2]).attr("class","reduction");
            } else {
                $(menucount[i - 1]).css("display", "block");
                //$(mbq[i-2]).attr("class","plus");
            }
        });
    });
    hidebut.each(function(i) {
        //$(this).css("cursor","pointer");
        $(this).click(function() {
            if ($(menucount[i - 1]).css("display") == 'block') {
                $(menucount[i - 1]).css("display", "none");
                //$(mbq[i-2]).attr("class","plus");
            } else {
                $(menucount[i - 1]).css("display", "block");
                //$(mbq[i-2]).attr("class","plus");
            }
        });
    });
}


//详细页面图片
function imgPlayha(imgpar, imgcont) {
    var imgparLink = $(imgcont + " a");

    var imgparcont = $(imgpar + " img")[0];

    var imgconts = $(imgcont + " img");

    var imgspans = $(imgcont + " li");

    var imgAnimate = $(imgcont + " ul")[0];

    var imgArray = [];
    var imgLen = imgconts.length;
    imgparcont.imgid = 0;

    var simgWidth = imgspans[0].offsetWidth;

    $(imgAnimate).css("width", "1000px");


    function spanBor(Item) { //小图样式
        imgspans.each(function(i) {
            if (Item == i) {
                $(this).addClass("active");
            } else {
                $(this).removeAttr("class");
            }
        });
    }
    imgconts.each(function(i) {
        this.imgid = i;
        imgArray.push(this.src); //初始化图片数组

        $(this).click(function() {
            $(imgparcont).attr("src", pUrl(this.src));
            $(imgparcont).attr("imgid", this.imgid);
            $("#adetail").attr("href", pUrl(this.src));
            spanBor(this.imgid);
        });
    });
    imgparLink.each(function(i) {
        $(this).click(function(evt) {
            evt = window.event || evt;
            if (evt.preventDefault) {
                evt.preventDefault();
            } else {
                evt.returnValue = false;
            }
            var nowimgid = $(imgparcont).attr("imgid");

            if (i == 0) { //向上
                if (nowimgid > 0) {
                    $(imgAnimate).animate({left: '-' + (simgWidth * (nowimgid - 1)) + 'px'}, "fast");
                    $(imgparcont).attr("src", pUrl(imgArray[nowimgid - 1]));
                    $(imgparcont).attr("imgid", nowimgid - 1);
                    $("#adetail").attr("href", pUrl(imgArray[nowimgid - 1]));
                    spanBor(nowimgid - 1);
                }
            } else if (i == 1) {//向下

                if (nowimgid < imgLen - 1) {
                    $(imgAnimate).animate({left: '-' + (61 * (nowimgid + 1)) + 'px'}, "fast");
                    $(imgparcont).attr("src", pUrl(imgArray[nowimgid + 1]));
                    $(imgparcont).attr("imgid", nowimgid + 1);
                    $("#adetail").attr("href", pUrl(imgArray[nowimgid + 1]));
                    spanBor(nowimgid + 1);
                }
            }

        });

        $(this).focus(function() {
            this.blur();
        });
    });

    function pUrl(str) {
        return str.replace(/\/small/, '/big');
    }
}

function setHomepage(){ 
    if (document.all){
        document.body.style.behavior='url(#default#homepage)';  
        document.body.setHomePage(window.location.href);  
    }else if(window.sidebar){  
        if(window.netscape){  
            try{  
                netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");  
            }catch (e){  
                alert( "该操作被浏览器拒绝，如果想启用该功能，请在地址栏内输入 about:config,然后将项 signed.applets.codebase_principal_support 值该为true" );  
            }  
        }  
        var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components. interfaces.nsIPrefBranch);  
        prefs.setCharPref('browser.startup.homepage',window.location.href);  
    }else{
        alert('您的浏览器不支持自动自动设置首页, 请使用浏览器菜单手动设置!');  
    }  
} 

function addFavorite(){  
    if (document.all){  
        try{  
            window.external.addFavorite(window.location.href,document.title);  
        }catch(e){  
            alert( "加入收藏失败，请使用Ctrl+D进行添加" );  
        }  
          
    }else if (window.sidebar){  
        window.sidebar.addPanel(document.title, window.location.href, "");  
     }else{  
        alert( "加入收藏失败，请使用Ctrl+D进行添加" );  
    }  
}

 

$(document).ready(function() {
    var bheight = $(window).height();
    $(".suspend").click(function() {
        $("#brg").css("display", "block");
        $("#showdiv").css("display", "block");
        $("#brg").height(bheight);
        //$("#testdiv").load("test.html");
    });
    $("#close").click(function() {
        $("#brg").css("display", "none");
        $("#showdiv").css("display", "none");
        //$("#testdiv").load("");
    });
});























		