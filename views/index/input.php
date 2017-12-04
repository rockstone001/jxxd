<style>
    #btn_area {
        margin: auto;
        z-index: 1;
    }
    #btn_area input {
        height: 50px;
        line-height: 50px;
        border-radius: 50px;
        color: #575757;
        background-color: #fff;
    }
    .weui_input {
        text-align: center;
    }
    #saveBtn {
        position: absolute;
        z-index: 5;
        top: 333px;
        left: 60px;
        width: 200px;
        height: 50px;
    }
    #loading {
        background-color: #fac529;
        display: none;
        text-align: center;
    }
    #loading .box {
        border-radius: 50%;
        border-radius: 50%;
        border: 1px solid #000;
        position: absolute;
        left: 50%;
    }
    #loading .rocket {
        position: absolute;
        left: 50%;
    }
    #loading .text {
        position: absolute;
        text-align: center;
        width: 100%;
    }

</style>
<div class="page" style="width: 100%; height: 100%; overflow:hidden;">
    <img id="bj" src="<?php echo config_item('img_url')?>/input2.png" style="width: 100%; height: 100%; position: absolute; top: 0px; left: 0px; z-index: -1;" />
    <div id="btn_area">
        <input class="weui_input" type="text" id="datetime" placeholder="请输入您的出生时间">
        <input class="weui_input" type="text" id="location" placeholder="请输入您的出生地址" style="margin-top: 10px">
    </div>
    <div id="saveBtn"></div>
    <div class="weui_mask weui_mask_visible" id="loading">
        <div class="box">
        </div>
        <img src="<?php echo config_item('img_url')?>loading.png" class="rocket"/>
        <div class="text">正在为您导航</div>
    </div>
</div>
<script>
window.onload = function() {
    adjust();
    $(window).on('resize', adjust);
    $("#datetime").datetimePicker({
        inputValue: '1990-01-01 00:00',
        title: '请选择出生时间',
        min: "1920-01-01",
        max: "2018-01-01",  //2022-12-12 12:12
        onChange: function (picker, values, displayValues) {
            console.log(values);
        }
    });
    $("#location").cityPicker({
        title: "请选择出生地址"
    });
    $('#saveBtn').on('click', function(){
        var birthday = $('#datetime').val();
        var location = $('#location').val();
        if (!/^\s*$/.test(birthday) && !/^\s*$/.test(location)) {
            $('#loading').show();
            $.ajax({
                type: "POST",
                url: "<?php echo config_item('index_url');?>/user/test",
                data: "birthday=" + birthday +"&location=" + location,
                dataType: 'json',
                success: function(res){
                    console.log(res);
                    if (res.code != 0) {
                        $.toast(res.msg, "forbidden", function () {
                            if (res.code == '400000') {
                                window.location.href = "<?php echo config_item('index_url')?>/user/result";
                            } else {
                                $('#loading').hide();
                            }
                        });
                    } else {
                        console.log('<?php echo config_item('index_url')?>/user/result');
                        window.location.href = "<?php echo config_item('index_url')?>/user/result";
                    }
                }
            });
        }
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

var boxWidth = 160;
function adjust()
{
    var width = $(window).width();
    var height = $(window).height();
    var xScale = width / 760;
    var yScale = height / 1206;
    //暂时不做任何事  不做热区标点 整图做链接  看后面的需求
    $('#btn_area').css({
        marginTop: 382 * yScale,
        width: 565 * xScale
    });

    $('#btn_area a').css({
        height: 105 * yScale,
        lineHeight: 105 * yScale + 'px',
    });

    $('#saveBtn').css({
        width: 471 * xScale,
        height: 99 * yScale,
        left: 146 * xScale,
        top: 703 * yScale
    });

    $('#loading .rocket').css({
        width: xScale * 75,
        height: yScale * 52,
        marginLeft: - (xScale * 75) * 0.5,
        top: yScale * 500
    });

    $('#loading .box').css({
        width: boxWidth * xScale,
        height: boxWidth * xScale,
        marginLeft: -(boxWidth * xScale) * 0.5,
        top: yScale * 500 - (boxWidth * xScale) * 0.5 + (yScale * 52) * 0.5
    });

    $('#loading .text').css({
        top: yScale * 700
    });
}

function wave()
{
    boxWidth = 300;
    var width = $(window).width();
    var height = $(window).height();
    var xScale = width / 760;
    var yScale = height / 1206;

    $('#loading .box').animate({
        width: boxWidth * xScale,
        height: boxWidth * xScale,
        marginLeft: -(boxWidth * xScale) * 0.5,
        top: yScale * 500 - (boxWidth * xScale) * 0.5 + (yScale * 52) * 0.5
    }, 1000, function() {
        setTimeout(function() {
            boxWidth = 160;
            $('#loading .box').css({
                opacity: 0,
                width: boxWidth * xScale,
                height: boxWidth * xScale,
                marginLeft: -(boxWidth * xScale) * 0.5,
                top: yScale * 500 - (boxWidth * xScale) * 0.5 + (yScale * 52) * 0.5
            });
            setTimeout(function(){
                $('#loading .box').css({
                    opacity: 1
                });
                wave();
            }, 100);

        }, 150)
    });
}

    setTimeout(wave, 500);

</script>

