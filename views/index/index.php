<style>
    #start {
        position: absolute;;
    }
</style>
<div class="page" style="overflow:hidden;">
    <img id="bj" src="<?php echo config_item('img_url')?>/index.png?v=1.0.0" style="width: 100%; height: 100%;"/>
    <div id="start"></div>
</div>
<script>
    window.onload = function() {
        adjust();
        $(window).on('resize', adjust);
        $('#start').on('click', function(){
            window.location.href = "<?php echo config_item('index_url')?>/index/input";
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
            jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo', 'onMenuShareQZone', 'hideMenuItems'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });

        wx.ready(function(){
            wx.hideMenuItems({

                menuList: ['menuItem:share:appMessage', 'menuItem:share:timeline', 'menuItem:share:qq', 'menuItem:share:weiboApp', 'menuItem:share:QZone'] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3

            });
        });

    };
    function adjust()
    {
        var width = $(window).width();
        var height = $(window).height();
        var xScale = width / 750;
        var yScale = height / 1204;

        $('.page').css({
            width: width,
            height: height
        });

        console.log(width + ':' + height);
        $('#start').css({
            width: xScale * 180,
            height: yScale * 95,
            top: 1060 * yScale,
            left: 270 * xScale
        })
    }
</script>