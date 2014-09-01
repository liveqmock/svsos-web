<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb"><span class="icon">当前位置：</span><a href="<?php echo site_url();?>">首页</a> &gt; <a href="javascript:void(0);">邀请加入</a></div>
    <!--/ w190-->
    <div class="gui_box_border ">
        <div class="ui_box2">
            <div class="title">
                <h2 class="tith"><strong class="i2">随售（SVSOS）诚邀全国各地服务网点加入</strong></h2>
            </div>
            <div class="cont about_box mh400">
                <div class="about_cont reg_box">
                    <div class="reg_form" style="margin-top: 20px;">
                        <ul class="reg_ul">
                            <li class="clearfix">
                                <label class="s1"><span class="red">*</span>名称：</label>
                                <input type="text" class="login-input3" name="name" id="name" placeholder="如：社区家电维修">
                                <span id="name_tip" class="Validform_checktip Validform_wrong hidden">名称不能为空！</span>
                            </li>
                            <li>
                                <label class="s1"><span class="red">*</span>电话：</label>
                                <input type="text" class="login-input3" name="tel" placeholder="固话或者移动电话" id="tel">
                                <span id="tel_tip" class="Validform_checktip Validform_wrong hidden">电话不能为空！</span>
                            </li>
                            <li>
                                <label class="s1"><span class="red">*</span>产品：</label>
                                <ul id="tags" style="width:320px;"></ul>
                            </li>
                            <li id="tags_tip" class="hidden">
                                <label class="s1">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <span class="Validform_checktip Validform_wrong">产品不能为空！</span>
                            </li>
                            <li>
                                <label class="s1">Q Q：</label>
                                <input type="text" class="login-input3" name="tel" placeholder="" id="qq">
                            </li>
                            <li>
                                <label class="s1"><span class="red">*</span>地址：</label>
                                <input type="text" class="login-input3" name="address" id="address" value="">
                                <input type="hidden" value="" id="lat" />
                                <input type="hidden" value="" id="lng" />
                                <input type="hidden" value="" id="province" />
                                <input type="hidden" value="" id="city" />
                                <input type="hidden" value="" id="district" />
                                <input type="button" value="获取坐标" name="loginsubmit" class="sub_4 getPos">
                                <span id="address_tip" class="Validform_checktip Validform_wrong hidden">地址不能为空！</span>
                                <span id="latLng_tip" class="Validform_checktip Validform_wrong hidden">请获取坐标！</span>
                            </li>
                        </ul>
                        <div class="reg_btn2">
                            <input type="submit" value="立即加盟" name="loginsubmit" class="sub_4 submit">
                        </div>
                        <div id="map" style="width: 950px;height: 550px;margin-top: 20px;"></div>
                    </div>
                </div>
            </div>
            <!--/ cont-->
        </div>
        <!--/ ui_box2-->
    </div>
    <!--/ w800-->
    <div class="clear"></div>
</div>
<?php $this->load->view('footer');?>
<link href="<?php echo site_url('assets/css/custom-theme/jquery-ui-1.8.7.custom.css');?>" rel="stylesheet" type="text/css" />
<link href="<?php echo site_url('assets/css/jquery.taghandler.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=459869f4de552c01a4b51b18767a2d65"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery-ui-1.8.20.custom.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery.taghandler.js');?>"></script>
<script type="text/javascript">
    eval(function(p,a,c,k,e,d){e=function(c){return c.toString(36)};if(!''.replace(/^/,String)){while(c--){d[c.toString(a)]=k[c]||c.toString(a)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('3 0=1 2.b("0"),9=[],d=[];0.e(1 2.6(7.8,c.i),k);f 5(a){0.j(a.g)}3 4=1 2.h;4.l(5);',22,22,'map|new|BMap|var|myCity|myFun|Point|120|577483|marker||Map|31|text|centerAndZoom|function|name|LocalCity|312582|setCenter|12|get'.split('|'),0,{}));

    $(document).ready(function(){

        eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('f 2;$(".G").F(6(){f d=$("#h").1();E($.H(d))u.t({r:{s:"\\I\\K\\D\\L\\A\\w\\v"},p:q});x{e.C(2);f c=g i.B;c.y(d,6(b){b?($("#9").1(b.9),$("#8").1(b.8),e.z(b,J),2=g i.W(b),e.Y(2),c.o(b,6(a){a=a.k;$("#h").1(a.5+a.3+a.4+a.l+a.m);$("#5").1(a.5.7(/\\n/,""));$("#3").1(a.3.7(/\\j/,""));$("#4").1(a.4)}),2.M(!0),2.X("Z",6(){f a=2.U();$("#9").1(a.9);$("#8").1(a.8);c.o(a,6(a){a=a.k;$("#h").1(a.5+a.3+a.4+a.l+a.m);$("#5").1(a.5.7(/\\n/,""));$("#3").1(a.3.7(/\\j/,""));$("#4").1(a.4)})})):u.t({r:{s:"\\S\\T\\R\\Q\\N\\P"},p:q})})}});e.V(g i.O);',62,62,'|val|market|city|district|province|function|replace|lng|lat|||||map|var|new|address|BMap|u5e02|addressComponents|street|streetNumber|u7701|getLocation|autoClose|2E3|container|content|open|easyDialog|u7a7a|u4e3a|else|getPoint|centerAndZoom|u80fd|Geocoder|removeOverlay|u680f|if|click|getPos|isEmpty|u5730|16|u5740|u4e0d|enableDragging|u4f4d|NavigationControl|u7f6e|u53d6|u83b7|u65e0|u6cd5|getPosition|addControl|Marker|addEventListener|addOverlay|dragend'.split('|'),0,{}));

        $('#tags').tagHandler({
            assignedTags: [],
            availableTags: <?php echo $productCategory;?>,
            autocomplete: true,
            onAdd: function (tag) {
                var addflag = true, tags = $('#tags').tagHandler("getTags");
                jQuery.each(tags, function (i, e) {
                    if (tag.toUpperCase() === e.toUpperCase()) {
                        $('#tags').find('.tagItem').each(function () {
                            if ($(this).html().toLocaleUpperCase() === tag.toLocaleUpperCase()) {
                                $(this).animate({ opacity: 0.55 }).delay(20).animate({ opacity: 1 }).animate({ opacity: 0.55 }).delay(20).animate({ opacity: 1 });
                            }
                        });
                        addflag = false;
                    }
                });
                return addflag;

            },onDelete: function (tag) {
                var addflag = false;
                var answer = confirm("您确定删除此标签？");
                if (answer) {
                    addflag = true;
                }
                return addflag;
            }
        });

        $(".submit").click(function(){
            var name = $("#name").val();
            var tel = $("#tel").val();
            var address = $("#address").val();
            var lat = $("#lat").val();
            var lng = $("#lng").val();
            var province = $("#province").val();
            var city = $("#city").val();
            var hometown = $("#district").val();
            var qq = $("#qq").val();
            var product = $('#tags').tagHandler("getTags");

            if($.isEmpty(name))
            {
                $("#name_tip").show();
                return false;
            }
            else
            {
                $("#name_tip").hide();
            }

            if($.isEmpty(tel))
            {
                $("#tel_tip").show();
                return false;
            }
            else
            {
                $("#tel_tip").hide();
            }

            if($.isEmpty(product))
            {
                $("#tags_tip").show();
                return false;
            }
            else
            {
                $("#tags_tip").hide();
            }

            if($.isEmpty(address))
            {
                $("#address_tip").show();
                return false;
            }
            else
            {
                $("#address_tip").hide();
            }

            if($.isEmpty(lat) || $.isEmpty(lng))
            {
                $("#latLng_tip").show();
                return false;
            }
            else
            {
                $("#latLng_tip").hide();
            }

            $.post('<?php echo site_url('join_action/index');?>',
                {name:name,tel:tel,address:address,lat:lat,lng:lng,province:province,city:city,hometown:hometown,qq:qq,product:product},
                function(data)
                {
                    if(data.error == 0)
                    {
                        easyDialog.open({
                            container : {
                                content : '感谢您的加盟。'
                            },
                            autoClose : 2000
                        });
                        setTimeout("window.location.href='"+data.url+"'",1000);
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