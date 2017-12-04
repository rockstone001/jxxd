<style>
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
</style>
<div class="page" style="width: 100%; height: 100%; overflow:hidden;">
    <div class="page__bd" style="margin: 10px; position: relative;">
        <img onload="finish()" id="report" src="<?php echo config_item('index_url')?>/user/get_partner_png" style="width: 100%; height: 100%;" />
        <div style="position:relative; display: none; padding: 5px;" id="zzz">
            <ul style="flex:1">
                <li style="font-size: 12px; text-align: center;" id="ttt">
                    识别二维码获得更多信息<br />
                    版权所有@江村市隐智能科技有限公司
                </li>
            </ul>
            <div class="qrcode">
                <img src="<?php echo config_item('img_url')?>/qrcode.jpeg" style="width: 100%;"/>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function() {
        //自适应热区
        $('#ttt').css({
            lineHeight: $('.qrcode').height() * 0.25 + 'px',
            marginTop: $('.qrcode').height() * 0.25
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
                success: function () {
                    // 用户确认分享后执行的回调函数
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
    function finish() {
        $('#zzz').css({
            display: 'flex'
        });
    }
</script>


