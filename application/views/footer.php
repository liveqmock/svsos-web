<div id="footer">
    <div class="links">
        <a href="<?php echo site_url();?>">搜索</a><span class="line">|</span>
        <a href="<?php echo site_url('service/order');?>">我的服务</a><span class="line">|</span>
        <a href="<?php echo site_url('brand');?>">品牌服务热线</a><span class="line">|</span>
        <a href="<?php echo site_url('about/us');?>">关于我们</a></div>
    <div class="copyright">&copy; 2013 svsos.com All Rights Reserved.苏ICP备104002497</div>
</div>
<!--footer end-->
<!--头部下拉菜单js-->
<script type="text/javascript">
    select_other("select_other");

    function AddFavorite(sURL, sTitle)
    {
        try
        {
            window.external.addFavorite(sURL, sTitle);
        }
        catch (e)
        {
            try
            {
                window.sidebar.addPanel(sTitle, sURL, "");
            }
            catch (e)
            {
                alert("加入收藏失败，请使用Ctrl+D进行添加");
            }
        }
    }

    function SetHome(obj,vrl)
    {
        try
        {
            obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl);
        }
        catch(e){
            if(window.netscape) {
                try {
                    netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                }
                catch (e) {
                    alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将[signed.applets.codebase_principal_support]设置为'true'");
                }
                var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
                prefs.setCharPref('browser.startup.homepage',vrl);
            }
        }
    }

    $(document).ready(function(){
        $(".fastSubmit").click(function(){
            var name = $("#fastName").val();
            var pwd = $("#fastPwd").val();

            if( !$.isEmail(name) )
            {
                $("#fastTips").html('<span class="tips_no">您输入的登录名或者密码不正确</span>');
                return false;
            }
            else
            {
                $("#fastTips").html('');
            }

            if( !$.isPwd(pwd) )
            {
                $("#fastTips").html('<span class="tips_no">您输入的登录名或者密码不正确</span>');
                return false;
            }
            else
            {
                $("#fastTips").html('');
            }

            $.post('<?php echo site_url('login_action/fastLogin');?>',
                {name:name,pwd:pwd},
                function(data)
                {
                    if(data.error == 0)
                    {
                        window.location.href = data.url;
                    }
                    else
                    {
                        easyDialog.open({
                            container : {
                                content : data.msg
                            },
                            autoClose : 2000
                        });
                    }
                },'json'
            );
        });
    })

</script>
</body>
</html>