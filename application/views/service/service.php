<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb">
        <span class="icon">当前位置：</span>
        <a href="<?php echo site_url();?>">首页</a> &gt;
        <a href="<?php echo site_url('service/order');?>">我的服务</a>
    </div>
    <!--/ search_box-->
    <?php $this->load->view('service/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">创建服务工单</strong></h2>
            </div>
            <!--/ title-->
            <div class="cont mh400 pa15">
                <form class="reg_form" action="<?php echo site_url('service/service_action');?>">
                    <ul class="reg_ul2">
                        <li class="clearfix">
                            <div class="sw">
                                <span class="s1"><span class="red">*号为必填项</span></span>
                            </div>
                        </li>
                    </ul>
                    <table class="table_data">
                        <tbody class="reg_form">
                        <tr class="bg">
                            <td class="tr td_bt"><span class="red">*</span> 报单日期：</td>
                            <td class="tl td_cont"><input type="text" class="login-input6" name="sTime" id="sTime" value="<?php echo date('Y-m-d',time());?>" onClick="WdatePicker({readOnly:true,minDate:'<?php echo date('Y-m-d',time());?>'})" /></td>
                        </tr>
                        <tr>
                            <td class="tr td_bt">要求日期：</td>
                            <td class="tl td_cont"><input type="text" class="login-input6" name="eTime" id="eTime" onClick="WdatePicker({readOnly:true,minDate:'#F{$dp.$D(\'sTime\')}'})" /></td>
                        </tr>
                        <tr class="bg">
                            <td class="tr td_bt"><span class="red">*</span> 报单客户：</td>
                            <td class="tl td_cont">
                                <input type="text" class="login-input6" name="client" id="client" />
                            </td>
                        </tr>
                        <tr>
                            <td class="tr td_bt"><span class="red">*</span> 服务类型：</td>
                            <td class="tl td_cont">
                                <select class="login-input6" id="service" name="service" style="padding-top: 5px;">
                                    <?php foreach($serviceCategory as $v):?>
                                        <option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </td>
                        </tr>
                        <tr class="bg">
                            <td class="tr td_bt"><span class="red">*</span> 产品品牌：</td>
                            <td class="tl td_cont">
                                <input type="text" class="login-input6" name="brand" id="brand" />
                            </td>
                        </tr>
                        <tr>
                            <td class="tr td_bt"><span class="red">*</span> 产品类型：</td>
                            <td class="tl td_cont">
                                <select class="login-input6" id="pCate" name="pCate" style="padding-top: 5px;">
                                    <?php foreach($productCategory as $v):?>
                                        <option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </td>
                        </tr>
                        <tr class="bg">
                            <td class="tr td_bt">产品型号：</td>
                            <td class="tl td_cont">
                                <input type="text" class="login-input6" name="pModel" id="pModel" />
                            </td>
                        </tr>
                        <tr>
                            <td class="tr td_bt">产品序列号：</td>
                            <td class="tl td_cont">
                                <input type="text" class="login-input6" name="pSN" id="pSN">
                            </td>
                        </tr>
                        <tr class="bg">
                            <td class="tr td_bt"><span class="red">*</span> 客户姓名：</td>
                            <td class="tl td_cont">
                                <input type="text" class="login-input6" name="name" id="name" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="tr td_bt"><span class="red">*</span> 联系电话：</td>
                            <td class="tl td_cont">
                                <input type="text" class="login-input6" name="tel" id="tel">
                            </td>
                        </tr>
                        <tr class="bg">
                            <td class="tr td_bt"><span class="red">*</span> 客户地址：</td>
                            <td class="tl td_cont">
                                <input type="text" class="login-input6" name="address" id="address" style="width: 300px;margin-right: 10px;">
                                <input type="hidden" value="" name="lat" id="lat" class="login-input6" nullmsg="请获取坐标"/>
                                <input type="hidden" value="" name="lng" id="lng" />
                                <input type="hidden" value="" name="province" id="province" />
                                <input type="hidden" value="" name="city" id="city" />
                                <input type="hidden" value="" name="district" id="district" />
                                <input type="button" value="获取坐标" name="loginsubmit" class="sub_4 getPos">
                            </td>
                        </tr>
                        <tr>
                            <td class="tr td_bt">备注：</td>
                            <td class="tl td_cont"><textarea class="textarea_sy3" name="remark" id="remark"></textarea></td>
                        </tr>
                        <tr class="bg">
                            <td colspan="4"><div id="map" style="width: 755px;height: 400px;"></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <input type="submit" value="发送服务工单" name="loginsubmit" class="sub_4">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <!--/ cont-->
        </div>
        <!--/ ui_box2-->
    </div>
    <!--/ w800-->
    <div class="clear"></div>
</div>
<?php $this->load->view('footer');?>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=459869f4de552c01a4b51b18767a2d65"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/city.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/citydata.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/My97DatePicker/WdatePicker.js');?>"></script>
<script type="text/javascript">
    eval(function(p,a,c,k,e,d){e=function(c){return c.toString(36)};if(!''.replace(/^/,String)){while(c--){d[c.toString(a)]=k[c]||c.toString(a)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('3 0=1 2.b("0"),9=[],d=[];0.e(1 2.6(7.8,c.i),k);f 5(a){0.j(a.g)}3 4=1 2.h;4.l(5);',22,22,'map|new|BMap|var|myCity|myFun|Point|120|577483|marker||Map|31|text|centerAndZoom|function|name|LocalCity|312582|setCenter|12|get'.split('|'),0,{}));

    $(document).ready(function(){

        eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('5 2;$(".u").A(3(){5 d=$("#C").1();E($.I(d))r.p({q:{o:"\\D\\G\\B\\H\\J\\v\\t"},i:m});s{f.w(2);5 c=g h.z;c.y(d,3(b){b?($("#9").1(b.9),$("#e").1(b.e),f.x(b,F),2=g h.S(b),f.U(2),c.k(b,3(a){a=a.n;$("#7").1(a.7.4(/\\j/,""));$("#6").1(a.6.4(/\\l/,""));$("#8").1(a.8)}),2.W(!0),2.X("K",3(){5 a=2.T();$("#9").1(a.9);$("#e").1(a.e);c.k(a,3(a){a=a.n;$("#7").1(a.7.4(/\\j/,""));$("#6").1(a.6.4(/\\l/,""));$("#8").1(a.8)})})):r.p({q:{o:"\\R\\Q\\V\\P\\O\\L"},i:m})})}});f.N(g h.M);',60,60,'|val|market|function|replace|var|city|province|district|lat|||||lng|map|new|BMap|autoClose|u7701|getLocation|u5e02|2E3|addressComponents|content|open|container|easyDialog|else|u7a7a|getPos|u4e3a|removeOverlay|centerAndZoom|getPoint|Geocoder|click|u680f|address|u5730|if|16|u5740|u4e0d|isEmpty|u80fd|dragend|u7f6e|NavigationControl|addControl|u4f4d|u53d6|u6cd5|u65e0|Marker|getPosition|addOverlay|u83b7|enableDragging|addEventListener'.split('|'),0,{}))


        var demo=$(".reg_form").Validform({
            tiptype:4,
            postonce:true,
            showAllError:true,
            ajaxPost:true,
            url:'<?php echo site_url('service/service_action');?>',
            callback:function(data)
            {
                if(data.error == 0)
                {
                    easyDialog.open({
                        container : {
                            content : '您的服务工单已提交。'
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
            }
        });

        demo.addRule(
        [
            {
                ele:".login-input6:eq(0)",
                datatype:"*"
            },
            {
                ele:".login-input6:eq(2)",
                datatype:"*2-50"
            },
            {
                ele:".login-input6:eq(4)",
                datatype:"*2-50"
            },
            {
                ele:".login-input6:eq(8)",
                datatype:"*2-30"
            },
            {
                ele:".login-input6:eq(9)",
                datatype:"*"
            },
            {
                ele:".login-input6:eq(10)",
                datatype:"*2-50"
            },
            {
                ele:".login-input6:eq(11)",
                datatype:"*"
            }
        ]);

    })
</script>
