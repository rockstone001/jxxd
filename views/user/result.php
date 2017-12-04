<style>
    body {
        background-color: #fac52d;
        background-image: url('<?php echo config_item('img_url')?>/bj.png');
        background-size: 35px 35px;
        background-position: 3px 0px;
    }
    .weui-btn-area a {
        height: 50px;
        line-height: 50px;
        border-radius: 50px;
    }
    .red {
        color: red;
    }
    .qrcode {
        /*position: absolute;*/
        right: 0px;
        top: 0px;
        width: 80px;
        font-size: 12px;
        text-align: center;
        font-weight: 500;
        line-height: 1.1em;
    }
    ul {
        list-style-type: none;
        font-size: 14px;
        /*margin-bottom: 50px;*/
    }
    h4 {
        padding: 5px 0px 10px 0px;
        background-image: url('<?php echo config_item('img_url')?>/banner.png');
        background-size: 100% 100%;
        font-size: 14px;
    }
    #close1, #close2, #pay {
        position: absolute;;
    }
</style>
<div class="page" style="width: 100%; height: 100%; overflow:hidden;">
    <div class="page__bd" style="margin: 10px;">
        <image src="<?php echo config_item('index_url')?>/user/get_result_png" style="width: 100%; height: 100%;"></image>
        <div style="font-size: 12px; display: flex; text-align: center;">
            <p style="flex: 1;">
                <img style="width: 12px;" src="<?php echo config_item('img_url')?>red_star.png" />表示测试者符合该指标
            </p>
            <p style="flex: 1;">
                <img style="width: 12px;" src="<?php echo config_item('img_url')?>star.png" />表示测试者不符合该指标
            </p>
        </div>
        <h4 style="text-align: center;margin:5px 0px;"><?php echo $result;?></h4>
        <div style="position:relative; display: flex; padding: 5px;">
            <ul style="flex:1">
                <?php if (!$if_view_professional) {?>
                    两种方式获得更多内容:
                    <li id="method1">1. 转发给好友查看<em class="red">专业报告</em></li>
                    <li id="method2">2. 随意打赏查看<em class="red">专业报告</em></li>
                <?php } else {?>
                    <li id="method3"><img style="height: 20px;" src="<?php echo config_item('img_url')?>view_professional.png" /></li>
                <?php }?>
            </ul>
            <div class="qrcode">
                <img src="<?php echo config_item('img_url')?>/qrcode.jpeg" style="width: 100%;"/>
                <p>识别二维码获<br/>得更多信息</p>
            </div>
        </div>
    </div>
    <div class="weui-mask" id="post2Friend" style="display: none"></div>
    <div class="weui_mask weui_mask_visible" id="payment" style="display: none;">
        <div style="text-align: center;">
            <div style="display: inline-block; position: relative;">
                <img id="dashang" src="<?php echo config_item('img_url')?>/pay.png" style="width: 100%;"/>
                <!--            <map id="links" name="links">-->
                <!--                <area id="close1" shape="rect" coords="200,20,225,45">-->
                <!--                <area id="close2" shape="rect" coords="13,294,104,328">-->
                <!--                <area id="pay" shape="rect" coords="111,294,200,328">-->
                <!--            </map>-->
                <!--            -->
                <a href="javascript:;" id="close1"></a>
                <a href="javascript:;" id="close2"></a>
                <a href="javascript:;" id="pay"></a>
            </div>

        </div>
    </div>

    <div class="weui_mask weui_mask_visible" id="transfer" style="display: none;">
        <div style="text-align: right">
            <img id="dashang" src="<?php echo config_item('img_url')?>/transfer.png?v=1.0.2" style="width: 50%;"/>
        </div>
    </div>

</div>
<script>
    window.onload = function() {
        $('#post2Friend').on('click', function(){
            $('#post2Friend').hide();
        });
        //自适应热区
        adjust_hot_area();
        $(window).on('resize', adjust_hot_area);
        $('#close1').on('click', function(){
            $('#payment').hide();
        });
        $('#close2').on('click', function(){
            $('#payment').hide();
        });
        $('#pay').on('click', function() {
            $.showLoading();
            $.ajax({
                type: "POST",
                url: "<?php echo config_item('index_url');?>/user/order",
                dataType: 'json',
                success: function(data){
                    $.hideLoading();
                    if (data && data.msg == "" && data.jsparams && data.tips) {
                        jsApiCall(data.jsparams, data.tips);
                    } else {
                        $('#tips_dialog .title').html('错误提示');
                        $('#tips_dialog').show().on('click', '.weui-dialog__btn', function () {
                            $('#tips_dialog').hide();
                        });

                        $.toast(data.msg, "forbidden", function () {

                        });
                    }
                }
            });
        });
        $('#method1').on('click', function() {
            $('#transfer').show();
        });
        $('#transfer').on('click', function() {
            $(this).hide();
        });
        $('#method2').on('click', function() {
            $('#payment').show();
        });
        $('#method3').on('click', function() {
            window.location.href = '<?php echo config_item('index_url')?>/user/result_professional';
        });

        //分享
        <?php
        $wechat = new WeChat();
        $jssdk = new JSSDK($wechat)
        ?>
        var _sdk = <?php echo json_encode($jssdk->getSignPackage($wechat))?>;
        wx.config({
            debug: false,// 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: _sdk.appId, // 必填，公众号的唯一标识
            timestamp: _sdk.timestamp, // 必填，生成签名的时间戳
            nonceStr: _sdk.nonceStr, // 必填，生成签名的随机串
            signature: _sdk.signature,// 必填，签名，见附录1
            jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo', 'onMenuShareQZone'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });
        wx.ready(function(){
            //分享给朋友
            wx.onMenuShareAppMessage({
                title: '创业前必做的自我测试：测测你适合创业吗？', // 分享标题
                desc: '<?php echo $nickname?>, <?php echo $result;?>', // 分享描述
                link: '<?php echo config_item('index_url') . '/index/index?token=' . $token ?>', // 分享链接
                imgUrl: '<?php echo config_item('img_url') . 'logo.png'?>', // 分享图标
                type: 'link', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function (res) {
                    // 用户确认分享后执行的回调函数
                    $.showLoading();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo config_item('index_url');?>/user/transfer",
                        dataType: 'json',
                        success: function(data){
                            $.hideLoading();
                            if (data && data.code == 0) {
                                $.toast("转发成功", function() {
                                    window.location.href = '<?php echo config_item('index_url')?>/user/result_professional';
                                });
                            }
                        }
                    });
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
            //分享到朋友圈
            wx.onMenuShareTimeline({
                title: '创业前必做的自我测试：测测你适合创业吗？', // 分享标题
                desc: '<?php echo $nickname?>, <?php echo $result;?>', // 分享描述
                link: '<?php echo config_item('index_url') . '/index/index?token=' . $token ?>', // 分享链接
                imgUrl: '<?php echo config_item('img_url') . 'logo.png'?>', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
        });
    };

    function adjust_hot_area()
    {
        var width = $(document.body).width();
        $('#dashang').width(width * 530 / 750);
        setTimeout(function(){
            var width = $('#dashang').width();
            var height = $('#dashang').height();
            var scale = width/226;
            console.log(scale);
//            $('#close1').attr('coords', scale * 200 + ',' + scale * 20 + ',' + scale * 225 + ',' + scale * 45);
//            $('#close2').attr('coords', scale * 13 + ',' + scale * 294 + ',' + scale * 104 + ',' + scale * 328);
//            $('#pay').attr('coords', scale * 111 + ',' + scale * 294 + ',' + scale * 200 + ',' + scale * 328);
            $('#close1').css({
                width: 25 * scale,
                height: 25 * scale,
                top: scale * 20,
                left: scale * 200
            });
            $('#close2').css({
                width: 91 * scale,
                height: 34 * scale,
                top: scale * 294,
                left: scale * 13
            });
            $('#pay').css({
                width: 89 * scale,
                height: 34 * scale,
                top: scale * 294,
                left: scale * 111
            });
        }, 200);

        $('#method3').css({
            lineHeight: $('.qrcode').height() + 'px'
        });
    }
    function jsApiCall(params, tips)
    {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            params,
            function(res){
//                WeixinJSBridge.log(res.err_msg);
                if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                    //支付成功
                    $.toast("支付成功", function() {
                        window.location.href = '<?php echo config_item('index_url')?>/user/result_professional';
                    });
                }
            }
        );
    }
</script>


