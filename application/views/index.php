
<?php $this->load->view('header');?>
<form action="<?php echo site_url('welcome/searchSP');?>">

    <div id="content">
        <div class="search_box mb20">
            <div class="boxcont">
                <div class="tith">您也可以在这里选择您的所在区域过滤</div>
                <!--/ tith-->
                <div class="formbox">
                        您的IP地址是<strong class="red"><?php echo $ip;?></strong><span>来自于</span>
                        <select name="province" class="input-medium" id="province">
                        </select>
                        <span>省/直辖市</span>
                        <select name="city" class="input-medium" id="city">
                        </select>
                        <span>市/县</span>
                        <select name="district" class="input-medium" id="district">
                        </select>
                        <span>区/镇</span>
                </div>
                <!--/ formbox-->
            </div>
            <!--/ boxcont-->
        </div>
        <!--/ search_box-->

        <div class="w660 fl mr20">
            <a name="map"></a><div class="map" id="map"></div>
        </div>

        <div class="w320 fl">
            <div class="ui_box2">
                <div class="title">
                    <h2 class="tith"><strong class="i1">共有<?php echo $total_items;?>条结果</strong></h2>
                </div>
                <!--/ title-->
                <div class="cont map_list">
                    <?php if(!empty($lists)):?>
                    <ul>
                        <?php
                        $abc = 'A';
                        $session = $this->session->userdata('userInfo');
                        foreach($lists as $v):
                            $verify = ($v['verify'] == 1) ? 'y2.png' : 'y1.png';
                        ?>
                        <li class="clearfix">
                            <div class="icon"><?php echo $abc;?></div>
                            <div class="nr">
                                <p class="alinks"><a onclick="clickMarker('<?php echo $abc;?>')" class="blue" style="cursor: pointer;"><?php echo $v['sp_name'];?><img class="vm" width="15" height="16" src="<?php echo site_url("assets/images/{$verify}");?>"></a></p>
                                <p class="rn">
                                    地址：<?php echo $v['address'];?>
                                    <?php if($session):?>
                                    <br />
                                    电话：<?php echo $v['phone'];?><br/>
                                    详情：<a href="<?php echo site_url("welcome/info/{$v['sp_id']}");?>" class="blue">查看详细信息</a>
                                    <?php endif;?>
                                </p>
                            </div>
                        </li>
                        <?php
                            $abc++;
                        endforeach;
                        ?>
                    </ul>
                    <?php
                        $this->load->view('sp_pagination');
                    endif;
                    ?>
                </div>
                <!--/ cont-->
            </div>
            <!--/ ui_box1-->

        </div>

        <div class="clear"></div>
    </div>
</form>
<!--/ content-->
<?php $this->load->view('footer');?>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=459869f4de552c01a4b51b18767a2d65"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/city.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/citydata.js');?>"></script>
<script type="text/javascript">
    eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('8 7=3 0.p("7"),4=[],6=[];7.q(3 0.r(u.t,o.v),n);9 i(b,a,c){4[a]=3 0.j(b);7.k(4[a]);b=3 0.m(a,{l:3 0.s(5,2)});b.D({F:"E",B:"h",w:"h"});4[a].C(b);6[a]=c;8 d=3 0.e(6[a],{g:!1});4[a].x("y",9(){z.f(d)})}9 A(b){8 a=3 0.e(6[b],{g:!1});4[b].f(a)};',42,42,'BMap|||new|marker||text|map|var|function|||||InfoWindow|openInfoWindow|enableMessage|none|addMarker|Marker|addOverlay|offset|Label|16|39|Map|centerAndZoom|Point|Size|404|116|915|background|addEventListener|click|this|clickMarker|border|setLabel|setStyle|white|color'.split('|'),0,{}));

    $(document).ready(function(){
        var points = new Array();
        var i = 0;
        <?php
        $i = 0;
        if(!empty($lists)):
            $abc = 'A';
            //$session = $this->session->userdata('userInfo');
            foreach($lists as $v):
                if($session):
                    $content = '<div style="margin:0;line-height:20px;padding:2px;"><h3>'.$v['sp_name'].'</h3>地址：'.$v['address'].'<br/>电话：'.$v['phone'].'</div>';
                else:
                    $content = '<div style="margin:0;line-height:20px;padding:2px;"><h3>'.$v['sp_name'].'</h3>地址：'.$v['address'].'</div>';
                endif;
        ?>
        var point = new BMap.Point("<?php echo $v['lng_baidu'];?>","<?php echo $v['lat_baidu'];?>");
        points[i] = point;
        addMarker(point,'<?php echo $abc;?>','<?php echo $content;?>');
        i++;
        <?php
            $abc++;
            endforeach;
        endif;
        ?>
        if( points !== '' )
        {
            map.centerAndZoom(points[5], 16);
            map.setViewport(points);
        }
        map.addControl(new BMap.NavigationControl());

        var province = "<?php echo (isset($province) && !empty($province)) ? $province : '';?>";
        var city = "<?php echo (isset($city) && !empty($city)) ? $city : '';?>";
        var district = "<?php echo (isset($area) && !empty($area)) ? $area : '';?>";
        AddressInit("province",province,"city",city,"district",district);

        $("#province").change(function(){
            var sp = $(".ss_search_input").val();
             alert(sp);
            var province = $(this).val();
            window.location.href="<?php echo site_url('main/search?');?>sp="+sp+'&province='+province;
        });
        $("#city").change(function(){
            var sp = $(".sr").val();

            var province = $("#province").val();
            var city = $(this).val();
            window.location.href="<?php echo site_url('main/search?');?>sp="+sp+'& province='+province+'&city='+city;
        });
        $("#district").change(function(){
            var sp = $(".sr").val();
            var province = $("#province").val();
            var city = $("#city").val();
            var area = $(this).val();
             window.location.href="<?php echo site_url('main/search?');?>sp="+sp+'&province='+province+'&city='+city+'&area='+area;
        })
    });
</script>