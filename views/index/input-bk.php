<style>
    #btn_area {
        margin: auto;
    }
    #btn_area a {
        height: 50px;
        line-height: 50px;
        border-radius: 50px;
        color: #575757;
    }
</style>
<div class="page" style="width: 100%; height: 100%; overflow:hidden;">
<!--    <image id="bj" src="--><?php //echo config_item('img_url')?><!--/input2.png" style="width: 100%; height: 100%; position: absolute; top: 0px; left: 0px;"></image>-->
<!--    <div class="page__bd page__bd_spacing weui-btn-area" id="btn_area">-->
<!--        <a href="javascript:;" class="weui-btn weui-btn_default" id="showPicker">请输入您的出生时间</a>-->
<!--        <a href="javascript:;" class="weui-btn weui-btn_default" id="showDatePicker">请输入您的出生地址</a>-->
<!---->
<!--    </div>-->
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_hd"><label for="time" class="weui_label">默认配置</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" id="time" type="text" value="">
            </div>
        </div>
    </div>

</div>
<script>
    window.onload = function() {
        console.log('1222');
        adjust();
        $(window).on('resize', adjust);
        console.log($("#time"));
        $("#time").datetimePicker({
            title: '出发时间',
            min: "1990-12-12",
            max: "2022-12-12 12:12",
            onChange: function (picker, values, displayValues) {
                console.log(values);
            }
        });

    };
    function adjust()
    {
        var width = $('#bj').width();
        var height = $('#bj').height();
        console.log(height);
        //暂时不做任何事  不做热区标点 整图做链接  看后面的需求
        $('#btn_area').css({
            marginTop: 382 * height / 1206,
            width: 565 * width / 760
        });

        $('#btn_area a').css({
            height: 105 * height / 1206,
            lineHeight: 105 * height / 1206 + 'px',
        });

    }
</script>

