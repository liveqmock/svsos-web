<?php $this->load->view('header');?>
<div id="content">
    <div class="crumbs_nav mb">
        <span class="icon">当前位置：</span>
        <a href="<?php echo site_url();?>">首页</a> &gt;
        <a href="<?php echo site_url('service/order');?>">我的服务</a> &gt;
        修改服务工单
    </div>
    <!--/ search_box-->
    <?php $this->load->view('service/menu');?>
    <div class="w800 fl">
        <div class="ui_box4">
            <div class="title">
                <h2 class="tith"><strong class="i1">修改服务工单</strong></h2>
            </div>
            <!--/ title-->
            <div class="cont mh400 pa15">
                <form class="reg_form" action="<?php echo site_url('service/order_action/edit');?>">
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
                            <td class="tl td_cont"><input type="text" class="login-input6" name="sTime" id="sTime" value="<?php echo $info['start_time'];?>" onClick="WdatePicker({readOnly:true,minDate:'<?php echo date('Y-m-d',time());?>'})" /></td>
                        </tr>
                        <tr>
                            <td class="tr td_bt">要求日期：</td>
                            <td class="tl td_cont"><input type="text" class="login-input6" name="eTime" id="eTime" onClick="WdatePicker({readOnly:true,minDate:'#F{$dp.$D(\'sTime\')}'})" value="<?php echo $info['end_time'];?>"/></td>
                        </tr>
                        <tr class="bg">
                            <td class="tr td_bt"><span class="red">*</span> 报单客户：</td>
                            <td class="tl td_cont">
                                <input type="text" class="login-input6" name="client" id="client" value="<?php echo $info['client'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="tr td_bt"><span class="red">*</span> 服务类型：</td>
                            <td class="tl td_cont">
                                <select class="login-input6" id="service" name="service" style="padding-top: 5px;">
                                <?php
                                foreach($serviceCategory as $v):
                                    $checked = ($v['id'] == $info['service_type']) ? 'selected="selected"' : '';
                                ?>
                                    <option value="<?php echo $v['id'];?>" <?php echo $checked;?>><?php echo $v['name'];?></option>
                                <?php endforeach;?>
                                </select>
                            </td>
                        </tr>
                        <tr class="bg">
                            <td class="tr td_bt"><span class="red">*</span> 产品品牌：</td>
                            <td class="tl td_cont">
                                <input type="text" class="login-input6" name="brand" id="brand" value="<?php echo $info['product_brand'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="tr td_bt"><span class="red">*</span> 产品类型：</td>
                            <td class="tl td_cont">
                                <select class="login-input6" id="pCate" name="pCate" style="padding-top: 5px;">
                                    <?php
                                    foreach($productCategory as $v):
                                        $checked = ($v['id'] == $info['product_category']) ? 'selected="selected"' : '';
                                    ?>
                                        <option value="<?php echo $v['id'];?>" <?php echo $checked;?>><?php echo $v['name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </td>
                        </tr>
                        <tr class="bg">
                            <td class="tr td_bt">产品型号：</td>
                            <td class="tl td_cont">
                                <input type="text" class="login-input6" name="pModel" id="pModel" value="<?php echo $info['product_model'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="tr td_bt">产品序列号：</td>
                            <td class="tl td_cont">
                                <input type="text" class="login-input6" name="pSN" id="pSN" value="<?php echo $info['product_sn'];?>">
                            </td>
                        </tr>
                        <tr class="bg">
                            <td class="tr td_bt"><span class="red">*</span> 客户姓名：</td>
                            <td class="tl td_cont">
                                <input type="text" class="login-input6" name="name" id="name" value="<?php echo $info['name'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="tr td_bt"><span class="red">*</span> 联系电话：</td>
                            <td class="tl td_cont">
                                <input type="text" class="login-input6" name="tel" id="tel" value="<?php echo $info['tel'];?>">
                            </td>
                        </tr>
                        <tr class="bg">
                            <td class="tr td_bt"><span class="red">*</span> 客户地址：</td>
                            <td class="tl td_cont">
                                <input type="text" class="login-input6" name="address" id="address" style="width: 300px;margin-right: 10px;" value="<?php echo $info['address'];?>">
                                <input type="hidden" value="<?php echo $info['lat'];?>" name="lat" id="lat" class="login-input6" nullmsg="请获取坐标"/>
                                <input type="hidden" value="<?php echo $info['lng'];?>" name="lng" id="lng" />
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
                                <input type="submit" value="修改服务工单" name="loginsubmit" class="sub_4">
                                <a href="<?php echo site_url('service/order');?>" class="sub_4">返  回</a>
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
    var map = new BMap.Map("map");
    map.centerAndZoom(new BMap.Point(116.404, 39.915), 12);
    
    $(document).ready(function(){
        var lat = '<?php echo $info['lat'];?>';
        var lng = '<?php echo $info['lng'];?>';

        eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('g d=f e.J,2,j=f e.I(7,6);c.u(j,v);2=f e.w(j);c.t(2);2.y(!0);2.p("q",8(){g b=2.x();$("#6").1(b.6);$("#7").1(b.7);d.n(b,8(a){a=a.l;$("#h").1(a.3+a.5+a.4+a.i+a.m);$("#3").1(a.3.9(/\\k/,""));$("#5").1(a.5.9(/\\o/,""));$("#4").1(a.4)})});$(".L").N(8(){g b=$("#h").1();$.M(b)?C.A({B:{z:"\\H\\G\\D\\F\\E\\O\\T"},s:r}):(c.V(2),d.P(b,8(a){a?($("#6").1(a.6),$("#7").1(a.7),c.u(a,v),2=f e.w(a),c.t(2),d.n(a,8(a){a=a.l;$("#h").1(a.3+a.5+a.4+a.i+a.m);$("#3").1(a.3.9(/\\k/,""));$("#5").1(a.5.9(/\\o/,""));$("#4").1(a.4)}),2.y(!0),2.p("q",8(){g a=2.x();$("#6").1(a.6);$("#7").1(a.7);d.n(a,8(a){a=a.l;$("#h").1(a.3+a.5+a.4+a.i+a.m);$("#3").1(a.3.9(/\\k/,""));$("#5").1(a.5.9(/\\o/,""));$("#4").1(a.4)})})):C.A({B:{z:"\\Q\\R\\S\\U\\W\\X"},s:r})}))});c.K(f e.Y);',61,61,'|val|market|province|district|city|lat|lng|function|replace|||map|myGeo|BMap|new|var|address|street|dbPoint|u7701|addressComponents|streetNumber|getLocation|u5e02|addEventListener|dragend|2E3|autoClose|addOverlay|centerAndZoom|16|Marker|getPosition|enableDragging|content|open|container|easyDialog|u680f|u80fd|u4e0d|u5740|u5730|Point|Geocoder|addControl|getPos|isEmpty|click|u4e3a|getPoint|u65e0|u6cd5|u83b7|u7a7a|u53d6|removeOverlay|u4f4d|u7f6e|NavigationControl'.split('|'),0,{}));

        var demo=$(".reg_form").Validform({
            tiptype:4,
            postonce:true,
            showAllError:true,
            ajaxPost:true,
            callback:function(data)
            {
                if(data.error == 0)
                {
                    easyDialog.open({
                        container : {
                            content : '服务工单已成功修改。'
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
            ]
        );
    })
</script>
