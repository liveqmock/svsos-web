<?php $this->load->view('admin/header');?>
<div id="content">
    <?php $this->load->view('admin/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">添加网点</strong></h2>
            </div>
            <div class="cont mh400 pa15">
                <table class="table_data">
                    <tbody class="reg_form">
                    <tr class="bg">
                        <td class="tl td_bt">网点名称：</td>
                        <td class="tl td_cont"><input type="text" value="" id="sp_name" class="login-input6" /></td>
                    </tr>
                    <tr>
                        <td class="tl td_bt">网点电话：</td>
                        <td class="tl td_cont"><input type="text" value="" id="phone" class="login-input6" /></td>
                    </tr>
                    <tr class="bg">
                        <td class="tl td_bt">网点审核：</td>
                        <td class="tl td_cont">
                            <input type="radio" value="2" class="status" checked name="status"/>已审核&nbsp;&nbsp;
                            <input type="radio" value="1" class="status" name="status" />未审核
                        </td>
                    </tr>
                    <tr>
                        <td class="tl td_bt">合作伙伴：</td>
                        <td class="tl td_cont">
                            <input type="radio" value="2" class="status" checked name="verify"/>是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" value="1" class="status" name="verify" />否
                        </td>
                    </tr>
                    <tr class="bg">
                        <td class="tl td_bt">产&nbsp; &nbsp; &nbsp; 品：</td>
                        <td class="tl td_cont"><ul id="tags"></ul></td>
                    </tr>
                    <tr>
                        <td class="tl td_bt">封面图标：</td>
                        <td class="tl td_cont">
                            <div class="browser">
                                <input type="file" class="uplodfile" id="upload" name="userfile" accept="image/jpeg,image/png,image/gif,image/jpg" style="filter:alpha(opacity=0);opacity:0;cursor:pointer;width:210px;height:30px;overflow:hidden;" /> （宽:300px，高:225px）
                                <input type="hidden" value="" id="uploadPath" />
                            </div>
                        </td>
                    </tr>
                    <tr id="upImgStatus" style="display: none;">
                        <td class="tl td_bt">预览效果：</td>
                        <td class="tl td_cont" colspan="3">
                            <div class="showarea" style="width: 300px;height: 225px;text-align:center;">
                                <img src="<?php echo site_url('assets/images/nopic_sp.png');?>" style="width:300px;height: 225px;" class="showimg" id="showUpload"/>
                                <img src="<?php  echo site_url('assets/images/upload.gif');?>" id="showUpload1" style="display:none;margin-top:52px;" />
                            </div>
                        </td>
                    </tr>
                    <tr class="bg">
                        <td class="tl td_bt">详细信息：</td>
                        <td class="tl td_cont"><textarea class="textarea_sy3" id="intro"></textarea></td>
                    </tr>
                    <tr>
                        <td class="tl td_bt">网点地址：</td>
                        <td class="tl td_cont">
                            <input type="text" value="" id="address" class="login-input6" style="width: 300px;margin-right: 10px;" />
                            <input type="hidden" value="" id="lat" />
                            <input type="hidden" value="" id="lng" />
                            <input type="hidden" value="" id="province" />
                            <input type="hidden" value="" id="city" />
                            <input type="hidden" value="" id="district" />
                            <input class="sub_4 getPos" type="button" name="loginsubmit" value="获取坐标">
                        </td>
                    </tr>
                    <tr class="bg">
                        <td colspan="4"><div id="map" style="width: 755px;height: 400px;"></div></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <input type="button" value="确认提交" name="loginsubmit" class="sub_4 submit">&nbsp;&nbsp;
                            <a href="<?php echo site_url('admin/sp');?>" class="sub_4">返   回</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ ui_box2-->
    </div>
    <!--/ w800-->
    <div class="clear"></div>
</div>
<link href="<?php echo site_url('assets/css/custom-theme/jquery-ui-1.8.7.custom.css');?>" rel="stylesheet" type="text/css" />
<link href="<?php echo site_url('assets/css/jquery.taghandler.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=459869f4de552c01a4b51b18767a2d65"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery-ui-1.8.20.custom.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery.taghandler.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/upload.js');?>"></script>
<script type="text/javascript">
    eval(function(p,a,c,k,e,d){e=function(c){return c.toString(36)};if(!''.replace(/^/,String)){while(c--){d[c.toString(a)]=k[c]||c.toString(a)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('3 0=1 2.b("0"),9=[],d=[];0.e(1 2.6(7.8,c.i),k);f 5(a){0.j(a.g)}3 4=1 2.h;4.l(5);',22,22,'map|new|BMap|var|myCity|myFun|Point|120|577483|marker||Map|31|text|centerAndZoom|function|name|LocalCity|312582|setCenter|12|get'.split('|'),0,{}));

    $(document).ready(function(){
        var lat = '';
        var lng = '';

        eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('g d=f e.J,2,j=f e.I(7,6);c.u(j,v);2=f e.w(j);c.t(2);2.y(!0);2.p("q",8(){g b=2.x();$("#6").1(b.6);$("#7").1(b.7);d.n(b,8(a){a=a.l;$("#h").1(a.3+a.5+a.4+a.i+a.m);$("#3").1(a.3.9(/\\k/,""));$("#5").1(a.5.9(/\\o/,""));$("#4").1(a.4)})});$(".L").N(8(){g b=$("#h").1();$.M(b)?C.A({B:{z:"\\H\\G\\D\\F\\E\\O\\T"},s:r}):(c.V(2),d.P(b,8(a){a?($("#6").1(a.6),$("#7").1(a.7),c.u(a,v),2=f e.w(a),c.t(2),d.n(a,8(a){a=a.l;$("#h").1(a.3+a.5+a.4+a.i+a.m);$("#3").1(a.3.9(/\\k/,""));$("#5").1(a.5.9(/\\o/,""));$("#4").1(a.4)}),2.y(!0),2.p("q",8(){g a=2.x();$("#6").1(a.6);$("#7").1(a.7);d.n(a,8(a){a=a.l;$("#h").1(a.3+a.5+a.4+a.i+a.m);$("#3").1(a.3.9(/\\k/,""));$("#5").1(a.5.9(/\\o/,""));$("#4").1(a.4)})})):C.A({B:{z:"\\Q\\R\\S\\U\\W\\X"},s:r})}))});c.K(f e.Y);',61,61,'|val|market|province|district|city|lat|lng|function|replace|||map|myGeo|BMap|new|var|address|street|dbPoint|u7701|addressComponents|streetNumber|getLocation|u5e02|addEventListener|dragend|2E3|autoClose|addOverlay|centerAndZoom|16|Marker|getPosition|enableDragging|content|open|container|easyDialog|u680f|u80fd|u4e0d|u5740|u5730|Point|Geocoder|addControl|getPos|isEmpty|click|u4e3a|getPoint|u65e0|u6cd5|u83b7|u7a7a|u53d6|removeOverlay|u4f4d|u7f6e|NavigationControl'.split('|'),0,{}));

        $("#upload").ajaxfileupload({
            'action': '<?php echo site_url('up/upload');?>',
            'onComplete': function(response) {
                if(response.error == 0)
                {
                    var url = '<?php echo site_url();?>'+response.url;
                    $('#uploadPath').val(response.url);
                    $('#showUpload').attr('src', url).show();
                    $('#upImgStatus').show();
                }
                else
                {
                    easyDialog.open({
                        container : {
                            content : response.msg
                        },
                        autoClose : 2000
                    });
                }
                $("#showUpload1").hide();
            },
            'onStart': function() {
                $('#uploadPath').val("");
                $("#showUpload1").show();
                $("#showUpload").hide();
            }
        });

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

            },
            onDelete: function (tag) { //删除操作

                var addflag = false;
                var answer = confirm("您确定删除此标签？");
                if (answer) {
                    addflag = true;
                }
                return addflag;
            }
        });

        $(".submit").click(function(){
            var sp_name = $("#sp_name").val();
            var phone = $("#phone").val();
            var status = $(".status:checked").val();
            var verify = $(".verify:checked").val();
            var product = $('#tags').tagHandler("getTags");
            var intro = $("#intro").val();
            var address = $("#address").val();
            var lat = $("#lat").val();
            var lng = $("#lng").val();
            var province = $("#province").val();
            var city = $("#city").val();
            var district = $("#district").val();
            var cover = $("#uploadPath").val();

            if($.isEmpty(sp_name))
            {
                easyDialog.open({
                    container : {
                        content : '网点名称不能为空'
                    },
                    autoClose : 2000
                });
                return false;
            }

            if(!$.isPhone(phone) && !$.isFixedPhone(phone))
            {
                easyDialog.open({
                    container : {
                        content : '网点电话格式不正确'
                    },
                    autoClose : 2000
                });
                return false;
            }

            if($.isEmpty(address))
            {
                easyDialog.open({
                    container : {
                        content : '地址不能为空'
                    },
                    autoClose : 2000
                });
                return false;
            }

            if($.isEmpty(lat) || $.isEmpty(lng))
            {
                easyDialog.open({
                    container : {
                        content : '请点击获取坐标'
                    },
                    autoClose : 2000
                });
                return false;
            }

            $.post('<?php echo site_url('admin/sp_action/add');?>',
                {sp_name:sp_name,phone:phone,status:status,product:product,intro:intro,address:address,lat:lat,lng:lng,province:province,city:city,district:district,verify:verify,cover:cover},
                function(data)
                {
                    if(data.error == 0)
                    {
                        easyDialog.open({
                            container : {
                                content : '添加网点成功。'
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

