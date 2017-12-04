<style>
    #zhun, #buzhun, #buqueding, #partner {
        position: absolute;
    }
</style>
<div class="page" style="width: 100%; height: 100%; overflow:hidden;">
    <div class="page__bd" style="margin: 0px; position: relative;">
        <image id="report" src="<?php echo config_item('index_url')?>/user/get_result_professional_png" style="width: 100%; height: 100%;"></image>
        <?php if (!$ypj) { ?>
        <div id="zhun"></div>
        <div id="buzhun"></div>
        <div id="buqueding"></div>
        <?php } else {?>
        <div id="partner"></div>
        <?php }?>
    </div>
    <input type="hidden" id="refreshed" value="yes">
</div>
<script>
    window.onload = function() {

        //自适应热区
        adjust_hot_area();
        $(window).on('resize', adjust_hot_area);
        <?php if (!$ypj) { ?>
        $('#zhun').on('click', function(){
            feedback('准');
        });
        $('#buzhun').on('click', function(){
            feedback('不准');
        });
        $('#buqueding').on('click', function () {
            feedback('不确定');
        }); <?php } else { ?>
        $('#partner').on('click', function() {

            window.location.href = '<?php echo config_item('index_url')?>/user/partner';

        });
        <?php }?>


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

    function adjust_hot_area()
    {
        setTimeout(function(){
            var width = $('#report').width();
            var height = $('#report').height();
            var scale = width/750;
            <?php if (!$ypj) { ?>
            $('#zhun').css({
                width: 85 * scale,
                height: 50 * scale,
                top: scale * 2750,
                left: scale * 180
            });
            $('#buzhun').css({
                width: 110 * scale,
                height: 50 * scale,
                top: scale * 2750,
                left: scale * 280
            });
            $('#buqueding').css({
                width: 140 * scale,
                height: 50 * scale,
                top: scale * 2750,
                left: scale * 410
            });
            <?php } else { ?>
            $('#partner').css({
                width: 185 * scale,
                height: 40 * scale,
                top: scale * 2750,
                left: scale * 277
            });
            <?php }?>
        }, 200);
    }

    function feedback(msg)
    {
        $.showLoading();
        $.ajax({
            type: "POST",
            url: "<?php echo config_item('index_url');?>/user/feedback",
            dataType: 'json',
            data: 'msg=' + msg,
            success: function(res){
                $.hideLoading();
                if (res.code != 0) {
                    $.toast(res.msg, "forbidden", function () {

                    });
                } else {
                    $.toast("评价成功", function() {
                        console.log('close');
                        window.location.href = '<?php echo config_item('index_url')?>/user/partner';
                    });
                }
            }
        });
    }
</script>


