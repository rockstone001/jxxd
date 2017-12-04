
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <style type="text/css">
        body{width: 100%;height: 100%;margin: 0px;padding: 0px;font-size: 1em;font-family: "Microsoft YaHei";}
        body>div{margin: 20px auto;}
        .content{width: 99%;margin: 50px auto;max-width: 850px;}
        .infoData{border: 2px solid blue;max-width: 440px;}
        .infoData table{border-collapse: collapse;width: 100%;}
        .infoData table thead tr th{border-bottom: 2px solid #0000ff;}
        .infoData table tbody tr td{text-align: center;border-bottom: 1px solid #dbdbdb;}
        .infoData table tbody tr td:last-child{border-left: 2px solid #0000ff;}
        .infoData .infoTitle{border-bottom: 2px solid blue;}
        .infoData >div span{display: inline-block;vertical-align: middle;width: 100px;text-align: center;height: 35px;line-height: 35px;}
        .infoData .infoPanel > div{width: 100px;display: inline-block;margin-right: -8px;}
        .infoData .infoPanel > div > span{border-bottom: 1px solid #dbdbdb;}
        .infoData .infoPanel > div:last-child > span{border-left: 2px solid blue;}
        .showPanel{display: none;margin-bottom: 20px;}
        .atlwdg-trigger.atlwdg-TOP{left:auto!important; right:0!important;}
        .inputInfos h3{color: #9a332a;font-weight: bold;font-size: 20px;text-align: center;}
        .inputInfos form{display: none;text-align: center;margin-top: 20px;/*height:70px;*/}
        .inputInfos form > label{display: inline-block;width: 50px;height: 35px;}
        .inputInfos form > span input,.main form > span select{background-color:rgba(0,0,0,0);display: inline-block;width: 60px;border: none;outline: none;border-bottom: 1px solid #878887;}
        .inputInfos form > span select{width: 40px;}
        .inputInfos #subBtn{width: 60px;height: 28px;line-height: 28px;text-align: center;color: #fff;background-color: #878887;border-radius: 4px;outline: none;border: none;margin-left: 10px;}

        .showPanel{/*width: 850px;*/margin: auto;}
        .showPanel .module > h3{text-align: left;font-size: 1.4em;height: 45px;line-height: 45px;}
        .showPanel .module .chititle{font-weight: bold;}

        .showPanel .canContainer{padding:50px;width: 100%;margin: 0px auto;border: 1px solid #eee;background: url("http://report.jclife.com/bodyQua/shengXiang/images/yinyang.jpg") no-repeat center;background-size: 180px 180px;}
        .showPanel .canContainer .mark{width: 100%;height: 600px;position: relative;margin: auto;}
        .showPanel .canContainer .mark .xAxis{width: 100%;height: 10px;position: absolute;top: 100px;left: 0px;background: url("http://report.jclife.com/bodyQua/shengXiang/images/xAxis.png") no-repeat center;background-size: 100% 100%;/*background-color: blue;*/}
        .showPanel .canContainer .mark .yAxis{height: 100%;width: 10px;position: absolute;top: 0px;left: 100px;/* background-color: blue;*/background: url("http://report.jclife.com/bodyQua/shengXiang/images/yAxis.png") no-repeat center;background-size: 100% 100%;}
        .showPanel #svg{z-index: 2;position: absolute;}
        span > i.changeBr,p > i.changeBr{display: block;height:1px;}
        /*.canContainer .mark .fourAxis > span,.canContainer .mark .fourCon > span{font-size: 15px;z-index: 3;display: inline-block;width: 35px;line-height: 15px;}
        .canContainer .mark .fourAxis > span:nth-child(1){position: absolute;top: -30px;left: 188px;}
        .canContainer .mark .fourAxis > span:nth-child(2){position: absolute;top: 193px;left: -50px;width: 80px;}
        .canContainer .mark .fourAxis > span:nth-child(3){position: absolute;bottom: -30px;left: 188px;}
        .canContainer .mark .fourAxis > span:nth-child(4){position: absolute;top: 193px;right: -85px;width: 80px;}
*/
        .canContainer .mark .fourAxis > span,.canContainer .mark .fourCon > span, .canContainer .mark .xAxis > span, .canContainer .mark .yAxis > span{font-size: 15px;z-index: 3;display: inline-block;width: 35px;line-height: 15px;}
        .canContainer .mark .xAxis > span:nth-child(1){position: absolute;width: 100px;left: -50px;top: 0px;}
        .canContainer .mark .xAxis > span:nth-child(2){position: absolute;width: 100px;right: -100px;top: 0px;}
        .canContainer .mark .yAxis > span:nth-child(1){position: absolute;height: 50px;left: -10px;top: -26px;}
        .canContainer .mark .yAxis > span:nth-child(2){position: absolute;height: 50px;left: -10px;bottom: -50px;}

        /* .canContainer .mark .fourAxis > span:nth-child(1){position: absolute;top: -30px;left: 50%;}
         .canContainer .mark .fourAxis > span:nth-child(2){position: absolute;top: 50%;left: -50px;width: 80px;}
         .canContainer .mark .fourAxis > span:nth-child(3){position: absolute;bottom: -30px;left: 50%;}
         .canContainer .mark .fourAxis > span:nth-child(4){position: absolute;top: 50%;right: -85px;width: 80px;}*/

        .canContainer .mark .fourCon > span[con="1"]{position: absolute;top: 40%;right: 20%;color: #fff;}
        .canContainer .mark .fourCon > span[con="2"]{position: absolute;top: 40%;left: 20%;}
        .canContainer .mark .fourCon > span[con="3"]{position: absolute;bottom: 40%;left: 20%;}
        .canContainer .mark .fourCon > span[con="4"]{position: absolute;bottom: 40%;right: 20%;color: #fff;}

        #luckChart{display: none;}
        .locIcon{background: url("http://report.jclife.com/bodyQua/image/address.png") no-repeat center;  width: 10px;height: 14px;  display: inline-block;  cursor: pointer;  }
        .popFrame{display: none;background-color: rgba(255,255,255,1);position: absolute;top: 50px;left: 200px;right: 340px;bottom: 140px;z-index: 1000;overflow: hidden;border: 1px solid #1abc9c;}
        .popFrame .mapContainer{width: 100%;height: 100%;border: 1px solid #f0f0f0;padding-top: 10px;}
        .popFrame .mapContainer button{margin-left: 10px;display: inline-block;width: 50px;height: 25px;line-height: 25px;text-align: center;background-color: #1abc9c;color: #fff;border-radius: 4px;border: none;outline: none;}
        .popFrame input{width: 80px;}

        /* .role{display: none;position: absolute;top: -70px;left: 0px;right: 0px;bottom: 0px;background-color: #eee;z-index:1000;}
         .role .roleCon{width: 400px;height: 200px;background-color: #fff;margin: 100px auto;border-radius: 5px;padding-top: 50px;}
         .role .roleCon form{position: relative;width: 100%;height: 100%;}
         .role .roleCon p{text-align: center;}
         .role .roleCon p > label{display: inline-block;width: 90px;}
         .role .roleCon p button{border-radius: 5px;color: #fff;font-size: 16px;display: inline-block;width: 80px;height: 30px;line-height: 30px;text-align: center;background-color: #205081;border: none;outline: none;}
         .role .roleCon .error{display: none;color: #f00;text-align: right;font-size: 10px;margin-right: 30px;}
         #login{display: inline-block;position: fixed;right: 20px;bottom: 100px;font-size: 14px;width: 30px;text-align: center;height: 80px;background-color: #205081;color: #fff;border: none;outline: none;cursor: pointer;}
     */
        .errorBorder{border: 1px solid #f00!important;}
        @media screen and (max-width:775px){
            .popFrame,.popFrame2{left: 0px;right: 0px;}
            /*.canContainer .mark .fourAxis{display: none;}
            .canContainer .mark .fourCon{display: none;}*/

        }
        @media screen and (max-width:375px){
            .canContainer .mark .fourCon > span[con="1"]{top: 38%;}
            .canContainer .mark .fourCon > span[con="2"]{top: 38%;}
            .canContainer .mark .fourCon > span[con="3"]{bottom: 38%;}
            .canContainer .mark .fourCon > span[con="4"]{bottom: 38%;}
        }
    </style>
    <link type="text/css" rel="stylesheet" href="http://report.jclife.com/bodyQua/css/popFrame.css">
    <!--
        <script type="text/javascript" src="http://tech.taost.com:8090/s/8e7f1971884c2150f82e3ed7ee5d7bb3-T/en_US37tfov/64026/3/1.4.27/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=56d34f5d"></script>
    -->
    <script type="text/javascript" src="http://report.jclife.com/bodyQua/shengXiang/js/jquery-1.11.1.js"></script>
    <!--
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    -->
    <script type="text/javascript" src="http://report.jclife.com/bodyQua/shengXiang/js/snap.svg-min.js"></script>
    <script type="text/javascript" src="http://report.jclife.com/bodyQua/shengXiang/js/date/laydate.js"></script>
    <script type="text/javascript" src="http://report.jclife.com/bodyQua/shengXiang/js/date/laydate.dev.js"></script>
    <script type="text/javascript" src="http://report.jclife.com/bodyQua/shengXiang/js/highcharts.js"></script>
    <script type="text/javascript" src="http://report.jclife.com/bodyQua/shengXiang/js/roles.js"></script>
    <!--
        <script type="text/javascript" src="js/highcharts-more.js"></script>
    -->
</head>
<body>
<div id="bazi" class="content">
    <div class="inputInfos">
        <h3>八字专项研究报告</h3>
        <form class="form" id="starForm">
            <label>姓名</label>
            <span><input type="text" name="name" id="name" value="姓名" required></span>
            <label>性别</label>
            <span>
                <select name="sex" id="sex">
                    <option value="0">男</option>
                    <option value="1">女</option>
                </select>
            </span>
            <label>出生地</label>
                <span>
                    <input type="text" id="location" name="location" value="上海" required readonly>
                    <i id="setAddress" class="locIcon" title="查询经纬度"></i>
                </span>
            <label style="width: 120px;">出生时间(公历)</label>
            <span><input style="width: 120px;" type="text" name="birthday" id="birthday" required datetime></span>
            <label>时区</label>
            <span><select style="width: 120px;" name="zon" id="zon"></select></span>
            <label>经度</label>
            <span><input type="text" id="lon" name="longitude" value="120" required hasRangeName="lon" max="180" min="-180" readonly></span>
            <label>纬度</label>
            <span><input type="text" id="lat" name="latitude" value="30" required hasRangeName="lat" max="90" min="-90" readonly></span>
            <button id="subBtn">确定</button>
        </form>
    </div>
    <div class="showPanel">
        <div class="module">
            <h3>一、生命的原点</h3>
            <p>
                <label class="chititle">生命主型：</label>
                <span name="ZhuXingExplation"></span>
            </p>
            <p>
                <label class="chititle">核心特质：</label>
                <span name="RiGanExplanation"></span>
            </p>
            <p>
                <label class="chititle">才干：</label>
                <span name="CaiGanExplation" style="display: inline-block;margin-left: 40px;vertical-align: top;"></span>
            </p>
        </div>
        <div class="module">
            <h3>二、舒适的区域</h3>
            <div class="canContainer">
                <div class="mark">
                    <svg id="svg"></svg>
                    <div class="xAxis">
                        <span>从0到1</span>
                        <span>从1到N</span>
                    </div>
                    <div class="yAxis">
                        <span>独立个人</span>
                        <span>合作团队</span>
                    </div>
                    <diV class="fourCon">
                        <span con="1">宏观落地</span>
                        <span con="2">开拓战略</span>
                        <span con="3">专业创新</span>
                        <span con="4">细节执行</span>
                    </diV>
                </div>
            </div>
            <div id="explainInfo">
                <p>
                    <label class="chititle">性格：</label>
                    <span name="CharacterText"></span>
                </p>
                <p>
                    <label class="chititle">能力：</label>
                    <span name="AbilityText"></span>
                </p>
                <p id="matchText"></p>
            </div>
        </div>
        <div class="module">
            <h3>三、表达的出口</h3>
            <div>
                <p class="chititle">你表现最为突出的职场印象：</p>
                <p name="GeJuExplanation"></p>
                <p name="GeJuDaPeiExplanation"></p>
            </div>
        </div>
        <div class="module">
            <h3>四、后天发展领域</h3>
            <div>
                <p class="chititle">对你而言，最佳的发展环境应具备如下特质：</p>
                <p name="TiaoHouExplanation"></p>
            </div>
        </div>
        <div class="module">
            <h3>五、天然的喜欢</h3>
            <div>
                <p name="LikesExplanation"></p>
                <!--<p id="test">
                </p>-->
            </div>
        </div>
        <div id="luckChart" class="module">
            <h3>六、心境的起伏</h3>
            <div>
                <div>
                    <div id="luckValues" style="width: 850px;"></div>
                </div>
            </div>
        </div>
        <!--<div class="module">
            <h3>结语</h3>
            <div>
                <p>每个人在潜意识中都渴望找到一条破除障碍、释放真我的道路。</p>
                <p>天性报告的目的不仅仅是让人更好地认识自己，更是希望将此作为一个把手，帮助个体开启自我探索之路，去挖掘生命更深层次的本来，而活出美好人生。</p>
            </div>
        </div>-->
        <!--<div style="text-align: center;">面积：<span id="area">0</span></div>-->
        <!--<div class="infoData">
            <table>
                <thead>
                <tr>
                    <th>时柱</th>
                    <th>日柱</th>
                    <th>月柱</th>
                    <th>年柱</th>
                    <th>日期</th>
                </tr>
                </thead>
                <tbody>
                <tr name="ShiShen">
                    <td name="Shizhu"></td>
                    <td name="Rizhu"></td>
                    <td name="Yuezhu"></td>
                    <td name="Nianzhu"></td>
                    <td>主星</td>
                </tr>
                <tr name="TianGan">
                    <td name="Shizhu"></td>
                    <td name="Rizhu"></td>
                    <td name="Yuezhu"></td>
                    <td name="Nianzhu"></td>
                    <td>天干</td>
                </tr>
                <tr name="DiZhi">
                    <td name="Shizhu"></td>
                    <td name="Rizhu"></td>
                    <td name="Yuezhu"></td>
                    <td name="Nianzhu"></td>
                    <td>地支</td>
                </tr>
                <tr name="CangGan">
                    <td name="Shizhu"></td>
                    <td name="Rizhu"></td>
                    <td name="Yuezhu"></td>
                    <td name="Nianzhu"></td>
                    <td>藏干</td>
                </tr>
                <tr name="NaYin">
                    <td name="Shizhu"></td>
                    <td name="Rizhu"></td>
                    <td name="Yuezhu"></td>
                    <td name="Nianzhu"></td>
                    <td>纳音</td>
                </tr>
                <tr name="WangShuai">
                    <td name="Shizhu"></td>
                    <td name="Rizhu"></td>
                    <td name="Yuezhu"></td>
                    <td name="Nianzhu"></td>
                    <td>十二星运</td>
                </tr>
                <tr name="ShenSha">
                    <td name="Shizhu"></td>
                    <td name="Rizhu"></td>
                    <td name="Yuezhu"></td>
                    <td name="Nianzhu"></td>
                    <td>神煞</td>
                </tr>
                </tbody>
            </table>
        </div>-->

    </div>
    <!--<button id="login">登录</button>-->
</div>
<div class="popFrame">
    <div class="mapContainer">
        <div>
            要查询的地址：<input id="text_" type="text" value="上海"/>
            <button onclick="loadMapScenario();">查询</button>
            <button id="getAddValue">确认</button>
            <button id="cancelAddValue">取消</button>
        </div>
        <div id='myMap'></div>
    </div>
</div>
<div class="popFrame2">
    <div class="alertPanel" isSummer="">
        <p class="title"></p>
        <p class="sbtns isSummer">
            <button target="require">是</button>
            <button target="cancel">否</button>
        </p>
        <p class="sbtns notSummer">
            <button target="notRequire">确认</button>
        </p>
    </div>
</div>
</body>
<script type="text/javascript" src="http://report.jclife.com/bodyQua/shengXiang/js/config.js"></script>
<script type="text/javascript" src="http://report.jclife.com/bodyQua/shengXiang/js/info.js"></script>
<script type="text/javascript">
    $(function(){

        var roleType = "ordinary", formFlag=true,isAlertPanel= false;
        var xAxis = [],yAxixs = [],oyear=0;
        var summertime = "", isSummer = false, isNeedValDate = false;
        var urlAdds = {
            "nengliang": 'http://api.jclife.com/mingli/EnergyExplanation/CalcEnergyExplanation',
            "mingli": 'http://api.jclife.com/mingli/MingLi/CalcMingLi',
            "mingliExp": 'http://api.jclife.com/mingli/MingLiExplanation/CalcMingLiExplanation',
            "tizhi": 'http://api.jclife.com/mingli/TiZhi/CalcTiZhi',
            "fiveYunSixQi": 'http://api.jclife.com/mingli/YunQi/CalcYunQi',
            "liunian":'http://api.jclife.com/mingli/LiuNianCurve/CalcLiuNianCurve',
            "valSummer":'http://api.jclife.com/report/SummerTime/CalcSummerTime'
        };

        function compare(propertyName) {
            return function (object1, object2) {
                var value1 = object1[propertyName];
                var value2 = object2[propertyName];
                if (value2 < value1) {
                    return -1;
                }
                else if (value2 > value1) {
                    return 1;
                }
                else {
                    return 0;
                }
            }
        }
        function GetRequest() {
            var url = location.search, kvs = [];
            var params = [];
            if (url.indexOf("?") != -1) {
                var str = url.substr(1);
                strs = str.split("&");
                for(var i=0; i<strs.length; i++){
                    kvs = strs[i].split("=");
                    params.push({name: kvs[0], value: kvs[1]});
                }
                return params;
            }
        }
        function getQueryStringByName(name){
            var result = location.search.match(new RegExp("[\?\&]" + name+ "=([^\&]+)","i"));
            if(result == null || result.length < 1){
                return "";
            }
            return decodeURI(result[1]);
        }
        function getResInfo(data){
            if(data.status == "OK" && data.retcode == "100000"){
                return true;
            }else{
                return false;
            }
        }
        function showErrorMsg(data){
            if(data.retcode != undefined){
                if(data.retcode.substr(0,4) == "1003"){
                    alert("错误代码："+data.retcode+";\n错误信息：服务器异常");
                }/*else if(data.retcode == "100201"){
                 $('input[datetime]').addClass('errorBorder');
                 console.log("请输入正确的日期(YYYY-MM-DD hh:mm)");
                 }*/
            }
        }
        function isdatetime(datetimeArr){
            if(datetimeArr && datetimeArr.length>=5){
                var intYear=parseInt(datetimeArr[0]),
                    intMonth=parseInt(datetimeArr[1]),
                    intDay=parseInt(datetimeArr[2]),
                    intHour=parseInt(datetimeArr[3]),
                    intMin=parseInt(datetimeArr[4]);
                if(isNaN(intYear)||isNaN(intMonth)||isNaN(intDay)||isNaN(intHour)||isNaN(intMin)) return false;
                if(intMonth>12||intMonth<1) return false;
                if ( intDay<1||intDay>31) return false;
                if((intMonth==4||intMonth==6||intMonth==9||intMonth==11)&&(intDay>30)) return false;
                if(intMonth==2){
                    if(intDay>29) return false;
                    if((((intYear%100==0)&&(intYear%400!=0))||(intYear%4!=0))&&(intDay>28))return false;
                }
                if(intHour>23||intHour<0) return false;
                if(intMin>59||intMin<0) return false;
                return true;
            }else{
                return false;
            }
        }
        function setErrorInfo(form, msg, type){
            switch (type){
                case "ordinary":
                    if(isAlertPanel == "true"){
                        alert(msg);
                    }else{
                        console.log(msg);
                    }
                    break;
                case "range":
                    if(isAlertPanel == "true"){
                        alert(type+" in ["+msg+"]");
                    }else{
                        console.log(type+" in ["+msg+"]");
                    }
                    break;
            }

        }

        $('input', '#starForm').on('blur', function () {
            $(this).removeClass('errorBorder');
        });
        var initData = function(){
            laydate({
                elem: "#birthday",
                format: "YYYY-MM-DD hh:mm",
                istime: true,
                istoday: true,
                start: laydate.now(0, "YYYY/MM/DD hh:00:00")
            });
            $("#birthday").val(timeStamp2String(new Date()));

            $('#zon',"#starForm").html("");
            $.each(timezones, function(name, info){
                $('#zon',"#starForm").append('<option value="'+ info.value +'">'+ info.cname +'</option>');
            });
            $('#zon',"#starForm").val('+08:00');
        };

        var initParam = function(){
            if(getQueryStringByName("roleType")=="highRole"){
                $('#luckChart').show();
            }
            if(getQueryStringByName("isShowForm")=="false"){
                isNeedValDate = false;
                $('#starForm').hide();
                $.each($('[name]','#starForm'),function(i, input){
                    $(input).val(getQueryStringByName($(input).attr("id")).replace('%2B',"+").replace("%3A",":"));
                });
                var bir = getQueryStringByName('birthday').replace("+"," ").replace("%3A",":").replace('%20',' ');
                $('#birthday').val(bir);
                $('#subBtn').trigger('click');
            }else{
                isNeedValDate = true;
                $('#starForm').show();
            }
        };

        var drawLuckChart = function(cateSeries,series,oyear){
            $('#luckValues').highcharts({
                title: {
                    text: '',
                    x: -20 //center
                },
                credits: {
                    text: '',
                    href: ''
                },
                xAxis: {
                    categories: cateSeries
                },
                yAxis: {
                    title: "",
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }],
                    tickInterval: 1
                },
                tooltip:{
                    formatter: function() {
                        return '起伏指数:' + Highcharts.numberFormat(this.y, 1)+'<br/>年份:'+ this.x+'<br/>岁数：'+(parseInt(this.x)-parseInt(oyear)) ;
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'center',
                    verticalAlign: 'bottom',
                    borderWidth: 0
                },
                series: series
            });
        };
        var handleLuckData = function(infos){
            xAxis = [];
            yAxixs = [];
            $.each(infos.liuNianValuesList, function(i, item){
                xAxis.push(item.Year);
                yAxixs.push(item.YearValue);
            });

            var luckSeries = [
                {
                    name: "起伏指数",
                    data: yAxixs,
                    pointPlacement: 'on',
                    color: "#5B9BD5",
                    animation: false
                }
            ];

            drawLuckChart(xAxis,luckSeries,oyear);

        };

        function callbackFun(data){
        }

        function timeStamp2String(time){
            var datetime = new Date();
            datetime.setTime(time);
            var year = datetime.getFullYear();
            var month = datetime.getMonth() + 1 < 10 ? "0" + (datetime.getMonth() + 1) : datetime.getMonth() + 1;
            var date = datetime.getDate() < 10 ? "0" + datetime.getDate() : datetime.getDate();
            var hour = datetime.getHours()< 10 ? "0" + datetime.getHours() : datetime.getHours();
            var minute = datetime.getMinutes()< 10 ? "0" + datetime.getMinutes() : datetime.getMinutes();
            var second = datetime.getSeconds()< 10 ? "0" + datetime.getSeconds() : datetime.getSeconds();
            return year + "-" + month + "-" + date+" "+hour+":"+minute;
        }

        $("#subBtn").on("click", function(e){
            e.preventDefault();
            isAlertPanel = getQueryStringByName('isAlert');
            formFlag = true;

            var formChi = $('#starForm');
            $("[required]", formChi).each(function(i, item){
                if($(item).val()=="" || $(item).val()==null){
                    formFlag = false;
                    $(item).addClass("errorBorder");
                    setErrorInfo(formChi, "该字段不能为空", "ordinary");
                    return false;
                }else{
                    $(item).removeClass("errorBorder");
                }
            });
            if(formFlag){
                $("[datetime]", formChi).each(function(i, item){
                    var datetime = $(item).val();
                    var datetimeArr = datetime.replace(/(\:)|(\ )|\-/g,",").split(",");
                    if($(item).val()!="" && !isdatetime(datetimeArr)){
                        formFlag = false;
                        $(item).addClass("errorBorder");
                        setErrorInfo(formChi, "请输入正确的日期(YYYY-MM-DD hh:mm)", "ordinary");
                        return false;
                    }else{
                        $(item).removeClass("errorBorder");
                    }
                });
            }
            if(formFlag){
                $("[hasRangeName]", formChi).each(function(i, item){
                    if(isNaN(item.value)){
                        formFlag = false;
                        $(item).addClass("errorBorder");
                        setErrorInfo(formChi, "请输入浮点数", "ordinary");
                        return false;
                    }else{
                        var max = parseInt($(item).attr('max')),min=parseInt($(item).attr('min'));
                        if(item.value> max || item.value< min){
                            formFlag = false;
                            $(item).addClass("errorBorder");
                            setErrorInfo(formChi, max+ ","+min, "range");
                            return false;
                        }else{
                            $(item).removeClass("errorBorder");
                        }
                    }
                });
            }
            if(formFlag){
                var formdata = {
                    name: $("#name").val(),
                    sex: $('#sex').val(),
                    year: $('#birthday').val().slice(0,4),
                    month: $('#birthday').val().slice(5,7),
                    day: $('#birthday').val().slice(8,10),
                    hour: $('#birthday').val().slice(11,13),
                    minute: $('#birthday').val().slice(14,16),
                    longitude: $('#lon').val(),
                    latitude: $('#lat').val(),
                    location:$('#location').val(),
                    zon:$('#zon').val()
                };
                if(isNeedValDate){
                    if($('#birthday').val()!=""){
                        //如果是夏令时
                        isSummer = getIsSummer(formdata.year,formdata.month,formdata.day,formdata.hour,formdata.minute);
                        setTimeout(function(){
                            if(isSummer){
                                $('.alertPanel', '.popFrame2').attr('isSummer', 'true');
                                $('.title', '.popFrame2').html('您的出生日期在夏令时时段，请问是否启用夏令时？');
                                $('.popFrame2').show();
                                return false;
                            }else{
                                getMingli();
                            }
                        },500);
                    }
                }else{
                    getMingli();
                }
                function getMingli(){
                    $.ajax({
                        type: "get",
                        /*url:"http://api.jclife.com/mingli/mingli/calresult",*/
                        url: urlAdds.mingli,
                        data:formdata,
                        dataType: "jsonp",
                        contentType: "application/json; charset=utf-8",
                        jsonp: 'callbackFun',
                        error: function(x, textStatus, errorThrown) {
                            //showErrorMsg(data.data);
                        },
                        success: function(data) {
//                            getNengliang();
                            if(getResInfo(data.data)){
                                infos = data;
                                drawShengXiangFun();
                                $('.showPanel').show();
                            }else{
                                showErrorMsg(data.data);
                            }
                        }
                    });
                }
                function getNengliang(){
                    $.ajax({
                        type: "get",
                        /*url:"http://api.jclife.com/mingli/energyexplanation/calcenergyexplanation",*/
                        url: urlAdds.nengliang,
                        data:formdata,
                        dataType: "jsonp",
                        contentType: "application/json; charset=utf-8",
                        jsonp: 'callbackFun',
                        error: function(x, textStatus, errorThrown) {

                        },
                        success: function(data) {
                            if(getResInfo(data.data)){
                                getMingliExp();
                                $.each(data.data, function(name, value){
                                    $('[name="'+ name +'"]').html(value);
                                });
                            }else{
                                showErrorMsg(data.data);
                            }
                        }
                    });
                }
                function getMingliExp(){
                    $.ajax({
                        type: "get",
                        /*url:"http://api.jclife.com/mingli/mingliexplanation/calcmingLiexplanation",*/
                        url: urlAdds.mingliExp,
                        data:formdata,
                        dataType: "jsonp",
                        contentType: "application/json; charset=utf-8",
                        jsonp: 'callbackFun',
                        beforeSend: function (x) {
                            x.setRequestHeader("Content-Type", "application/json; charset=utf-8");
                        },
                        error: function(x, textStatus, errorThrown) {

                        },
                        success: function(data) {
                            getLiunian();
                            if(getResInfo(data.data)){
                                $.each(data.data, function(name, value){
                                    $('[name="'+ name +'"]').html(value.toString().replace(/[\\r\\n]/g,'<i class="changeBr"></i>'));
                                });
                            }else{
                                showErrorMsg(data.data);
                            }
                        }
                    });
                }
                oyear = parseInt($('#birthday').val().slice(0,4));
                function getLiunian(){
                    $.ajax({
                        type: "get",
                        /*url:"http://api.jclife.com/mingli/liuniancurve/calcliuniancurve",*/
                        url: urlAdds.liunian,
                        data:formdata,
                        dataType: "jsonp",
                        contentType: "application/json; charset=utf-8",
                        jsonp: 'callbackFun',
                        error: function(x, textStatus, errorThrown) {
                            alert(x);
                        },
                        success: function(data) {
                            if(getResInfo(data.data)){
                                handleLuckData(data.data);
                            }else{
                                showErrorMsg(data.data);
                            }
                        }
                    });
                }

            }
        });

        //initPageData();
        initData();
        initParam();
        var getIsSummer = function(year,month,day,hour,minute){
            var dt = {
                year: year,
                month: month,
                day: day,
                hour: hour,
                minute: minute
            };
            $.ajax({
                type: "get",
                url: urlAdds.valSummer,
                data:dt,
                async: false,
                dataType: "jsonp",
                contentType: "application/json; charset=utf-8",
                jsonp: 'callbackFun',
                error: function(x, textStatus, errorThrown) {
                    //showErrorMsg(data.data);
                },
                success: function(data) {
                    if(getResInfo(data.data)){
                        //test
                        isSummer = data.data.IsSummerTime;
                        summertime = data.data.ResultTime;
                        return true;
                    }else{
                        isSummer =  false;
                        console.log('夏令时校验出错，请重试');
                        return false;
                    }
                }
            });
        };
        var calculateArea = function(point1,point2,point3,point4){
            var point1x = Math.cos(point1 * Math.PI / 6);
            var point1y = Math.sin(point1 * Math.PI / 6);
            var point2x = Math.cos(point2 * Math.PI / 6);
            var point2y = Math.sin(point2 * Math.PI / 6);
            var point3x = Math.cos(point3 * Math.PI / 6);
            var point3y = Math.sin(point3 * Math.PI / 6);
            var point4x = Math.cos(point4 * Math.PI / 6);
            var point4y = Math.sin(point4 * Math.PI / 6);
            var area1 = triangleArea(point1x,point1y,point2x,point2y,point3x,point3y);
            var area2 = triangleArea(point4x,point4y,point1x,point1y,point3x,point3y);
            return area1 + area2;
        };
        var triangleArea = function(point1x,point1y,point2x,point2y,point3x,point3y){
            var a = Math.sqrt((point1x - point2x) * (point1x - point2x) + (point1y - point2y) * (point1y - point2y));
            var b = Math.sqrt((point3x - point2x) * (point3x - point2x) + (point3y - point2y) * (point3y - point2y));
            var c = Math.sqrt((point3x - point1x) * (point3x - point1x) + (point3y - point1y) * (point3y - point1y));
            var p = (a + b + c) / 2;
            var area = Math.sqrt(p*(p-a)*(p-b)*(p-c));
            return area;
        };


        function IsPC() {
            var userAgentInfo = navigator.userAgent;
            var Agents = ["Android", "iPhone",
                "SymbianOS", "Windows Phone",
                "iPad", "iPod"];
            var flag = true;
            for (var v = 0; v < Agents.length; v++) {
                if (userAgentInfo.indexOf(Agents[v]) > 0) {
                    flag = false;
                    break;
                }
            }
            return flag;
        }

        var drawShengXiangFun = function(){
            $("#svg").html("");
            var markWid = 0;
            /*if(IsPC()){
             markWid = 400;
             }else{
             if(getQueryStringByName('winWidth')!= undefined){
             markWid = parseInt(getQueryStringByName('winWidth'))-50;
             $('.fourAxis, .fourCon').hide();
             }else{
             markWid = parseInt(getQueryStringByName('winWidth'))-50;
             }
             if(isNaN(markWid)){
             markWid = $(window).width()-50;
             }
             }*/
            if(IsPC()){
                markWid = 400;
            }else{
                var winw = getQueryStringByName('winWidth');
                if(winw!= undefined && !isNaN(parseInt(winw))){
                    markWid = parseInt(winw);
                }else{
                    markWid = 300-50;
                }
            }
            $('.mark', '.canContainer').css("width", markWid+"px").css("height",markWid+"px");

            var x = markWid/2;
            var y = x, r1= x-30, r2=r1-40, defColor="blue";

            $('.canContainer').css("background-size",r1*2 +'px '+ r1*2+'px');
            $('.xAxis', '.mark').css("top", x-$('.xAxis', '.mark').height()/2);
            $('.yAxis', '.mark').css("left", x-$('.xAxis', '.mark').height()/2);


            var drawTwePoints = function(svg, x, y, r1, r2, twePoints, fillColor, mainDeg){


                svg.paper.circle(x, y, r1).attr({
                    fill: "rgba(256, 256, 256, 0)"
                });
                $.each(twePoints, function(name, info){
                    var rI = 2 * Math.PI * (info.range / 360);
                    var x1 = x + r2*Math.sin(rI);
                    var y1 = y - r2*Math.cos(rI);
                    var x2 = x + r1*Math.sin(rI);
                    var y2 = y - r1*Math.cos(rI);

                    info.pos.x = x1;
                    info.pos.y = y1;
                    info.pos.cx = x2;
                    info.pos.cy = y2;


                    var c = svg.paper.circle(info.pos.cx, info.pos.cy, 5).attr({
                        fill: fillColor,
                        idname: info.name
                    });
                    // var cname = svg.paper.text(info.pos.cx-8, info.pos.cy, info.name);

                    var mainrI = 2 * Math.PI * (mainDeg / 360);
                    var mainX = x + r1*Math.sin(mainrI);
                    var mainY = y - r1*Math.cos(mainrI);
                    svg.paper.circle(mainX, mainY, 8).attr({
                        fill: "orange"
                    });
                });
            };
            var drawLines = function(svg, WangShuai){
                $('path', '.canContainer .mark').remove();

                var diffPoint = [];
                $.each(WangShuai, function(name, info){
                    diffPoint.push(info);
                });

                diffPoint.sort(compare("id"));
                $.each(diffPoint, function(i, info){
                    var nexInfo = diffPoint[(i+1)%diffPoint.length];
                    var str = "M"+info.pos.cx+" "+info.pos.cy+"L"+ nexInfo.pos.cx +" "+nexInfo.pos.cy;
                    svg.paper.path(str).attr({
                        stroke: "#f00",
                        strokeWidth: 2,
                        strokeDasharray:2
                    });
                });
            };

            var twePoints = {
                "帝旺": {id: 1,name:"帝旺", range: "0", pos:{x:0,y:0,cx:0,cy:0},score:1000, direction:1},
                "衰": {id: 2,name:"衰", range: "30", pos:{x:0,y:0,cx:0,cy:0},score:800, direction:1},
                "病": {id: 3,name:"病", range: "60", pos:{x:0,y:0,cx:0,cy:0},score:600, direction:1},
                "死": {id: 4,name:"死", range: "90", pos:{x:0,y:0,cx:0,cy:0},score:400, direction:1},
                "墓": {id: 5,name:"墓", range: "120", pos:{x:0,y:0,cx:0,cy:0},score:200, direction:1},
                "绝": {id: 6,name:"绝", range: "150", pos:{x:0,y:0,cx:0,cy:0},score:0, direction:1},
                "胎": {id: 7,name:"胎", range: "180", pos:{x:0,y:0,cx:0,cy:0},score:0,direction:-1},
                "养": {id: 8,name:"养", range: "210", pos:{x:0,y:0,cx:0,cy:0},score:200, direction:-1},
                "长生": {id: 9,name:"长生", range: "240", pos:{x:0,y:0,cx:0,cy:0},score:400, direction:-1},
                "沐浴": {id: 10,name:"沐浴", range: "270", pos:{x:0,y:0,cx:0,cy:0},score:600, direction:-1},
                "冠带": {id: 11,name:"冠带", range: "300", pos:{x:0,y:0,cx:0,cy:0},score:800, direction:-1},
                "临官": {id: 12,name:"临官", range: "330", pos:{x:0,y:0,cx:0,cy:0},score:1000, direction:-1}
            };
            var needShow = ["ShiShen", "TianGan", "DiZhi", "CangGan", "NaYin", "WangShuai", "ShenSha"];


            /*var svg = Snap("#svg");
             $("#svg").width($(".mark").width()).height($('.mark').height());
             drawTwePoints(svg, x, y, r1, r2, twePoints, defColor);*/

            var baZiinfo = {};
            baZiinfo["Shizhu"] = infos.data.Shizhu;
            baZiinfo["Rizhu"] = infos.data.Rizhu;
            baZiinfo["Yuezhu"] = infos.data.Yuezhu;
            baZiinfo["Nianzhu"] = infos.data.Nianzhu;

            $.each(baZiinfo, function(name, info){
                info["TianGan"] = info.GanZhi.slice(0,1);
                info["DiZhi"] = info.GanZhi.slice(-1);
                info["CangGan"] = [];
                $.each(info.DiZhiCangGanList, function(i, cangan){
                    info["CangGan"].push(cangan.CangGan);
                });
                info["ShenSha"] = info.ShenShaList;

                $.each(needShow, function(i, key){
                    if(jQuery.isArray(info[key])){
                        $('td[name="'+ name +'"]', '.infoData table tr[name="'+ key +'"]').html('<span>'+ info[key].join("<br/>") +'</span>');
                    }else{
                        $('td[name="'+ name +'"]', '.infoData table tr[name="'+ key +'"]').html('<span>'+ info[key] +'</span>');
                    }
                });
            });


            var WangShuai = {},fourWangShuai = [];
            $('circle[idname]', '.canContainer .mark').attr("fill", defColor);
            var sum = 0, lnum= 0, rnum= 0, monZhi= 0,direc="";



            $.each(baZiinfo, function(name, info){
                WangShuai[info.WangShuai.toString()] = twePoints[info.WangShuai];
                var sinScore = twePoints[info.WangShuai].score;

//                console.log(WangShuai);

                if(name == "Yuezhu"){
                    sum += 0.4*parseFloat(sinScore);
                    monZhi = twePoints[info.WangShuai].direction;
                    if(monZhi>0){
                        //right
                        direc = "right";
                    }else{
                        //left
                        direc = "left";
                    }
                }else{
                    sum += 0.2*parseFloat(sinScore);
                }

                if(twePoints[info.WangShuai].direction>0){
                    rnum++;
                }else{
                    lnum++;
                }
                fourWangShuai.push(twePoints[info.WangShuai]);
                $('circle[idname="'+ info.WangShuai +'"]', '.canContainer .mark').attr("fill", "#f00");



            });



            var deg;
            if(lnum == rnum){
                if(direc == "right"){
                    //deg = parseFloat(sum/1000)*180;
                    deg = (180 - parseFloat(sum/1000)*180)%360;
                }else if(direc == "left"){
                    deg = 180+ parseFloat(sum/1000)*180;
                    // deg = (360 - parseFloat(sum/1000)*180)%360;
                }
            }else{
                if(lnum>rnum){
                    //left
                    deg = 180+ parseFloat(sum/1000)*180;
                }else{
                    //right
                    deg = (180 - parseFloat(sum/1000)*180)%360;
                }
            }

            fourWangShuai.sort(compare("id"));
            var area = calculateArea(fourWangShuai[0].id, fourWangShuai[1].id, fourWangShuai[2].id, fourWangShuai[3].id);
            $("#area").html(area);

            var svg = Snap("#svg");
            $("#svg").width($(".mark").width()).height($('.mark').height());

            console.log(twePoints);
            drawTwePoints(svg, x, y, r1, r2, twePoints, defColor, deg);
            drawLines(svg, WangShuai);
        };

        function showError(action){
            if(action == "hide"){
                $('.error').hide();
            }else{
                $('.error').show();
            }
        };
        $('#login').on('click', function(){
            $('.content').hide();
            $('.role').show();
        });
        $('#subUser').on('click', function(e){
            e.preventDefault();
            var users = {};
            var userinfo = $('#userForm').serialize().split('&');
            $.each(userinfo, function(i, infostr){
                var info = infostr.split("=");
                users[info[0]] = info[1];
            });
            var userFlag = false;
            if(users.username !="" && users.pwd !=""){
                $.each(roleUsers.highRoles, function(name, pwd){
                    if(users.username == name && users.pwd==pwd){
                        //alert("high role");
                        userFlag = true;
                        $('.role').hide();
                        roleType = "highRole";
                        $('#luckChart').show();
                    }
                });
                /*$.each(roleUsers.ordRoles, function(name, pwd){
                 if(users.username == name && users.pwd==pwd){
                 alert("ordinary role");
                 userFlag = true;
                 $('.role').hide();
                 }
                 });*/
            }
            /*else{
             alert("请输入正确的用户名和密码！");
             }*/
            $('.role').hide();
            $('.content').show();
            if(!userFlag){
                $('#luckChart').hide();
            }
        });

        $('#birthday').on('blur', function(){
            isNeedValDate = true;
        });
        $('button','.alertPanel').on('click', function(e){
            e.preventDefault();
            isNeedValDate = false;
            switch ($(this).attr('target')){
                case "require":
                    if(isSummer){
                        $('#birthday').val(summertime.substring(0,summertime.length-3));
                        $('.popFrame2').hide();
                    }else{
                        $('.popFrame2').hide();
                    }
                    break;
                case "cancel":
                    $('.popFrame2').hide();
                    break;
                case "notRequire":

                    break;
            }
            $('#subBtn').trigger('click');
        });
    });
</script>
<script type='text/javascript'>
    var lon = $('input[name="lon"]', "#starForm").val(),lat = $('input[name="lat"]', "#starForm").val();

    function loadMapScenario() {
        var keyword = document.getElementById("text_").value;
        var map = new Microsoft.Maps.Map(document.getElementById('myMap'), {
            credentials: 'Aj7D864itmewsQIvw6bOLpUY3v8_lv0ibL-aXWWOqrYNLgz33SpNMuV4sFL3o8x7'
        });
        Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
            var searchManager = new Microsoft.Maps.Search.SearchManager(map);
            var requestOptions = {
                bounds: map.getBounds(),
                where: keyword,
                callback: function (answer, userData) {
                    map.setView({ bounds: answer.results[0].bestView });
                    map.entities.push(new Microsoft.Maps.Pushpin(answer.results[0].location));
                    //document.getElementById("result_").value = answer.results[0].location.longitude + "," + answer.results[0].location.latitude;
                    lon = answer.results[0].location.longitude;
                    lat = answer.results[0].location.latitude;

                }
            };
            searchManager.geocode(requestOptions);
        });
        Microsoft.Maps.Events.addHandler(map, 'click', function (argus) {
            lon = argus.location.longitude;
            lat = argus.location.latitude;
            var updatePrintout = setTimeout(function () {
                for (var i = map.entities.getLength() - 1; i >= 0; i--) {
                    var pushpin = map.entities.get(i);
                    if (pushpin instanceof Microsoft.Maps.Pushpin) {
                        map.entities.removeAt(i);
                    }
                }
                var pushpin = new Microsoft.Maps.Pushpin(argus.location, null);
                map.entities.push(pushpin);
            }, 100);
        });
    }
    function highlight(id) {
        document.getElementById(id).style.background = 'LightGreen';
        setTimeout(function () { document.getElementById(id).style.background = 'white'; }, 1000);
    }
    $('#setAddress').on('click', function(){
        $('.popFrame').toggle();
    });
    $('#getAddValue').on('click', function(){
        $('input[name="longitude"]', "#starForm").val(lon);
        $('input[name="latitude"]', "#starForm").val(lat);
        $('input[name="location"]', "#starForm").val($('#text_').val());
        $('.popFrame').hide();
    });
    $('#cancelAddValue').on('click', function(){
        $('.popFrame').hide();
    });
</script>
</html>