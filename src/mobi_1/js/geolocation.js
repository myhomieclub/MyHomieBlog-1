/**
 * [loadScript 加载js]
 * @date        2017-12-25
 * @another     joseph
 * @param       String                 url      加载的js文件的url
 * @param       Function               callback 回调函数
 */
var loadScript = function(url, callback){
    var script = document.createElement('script');
    script.type = "text/javascript";
    if(script.readyState){
        //IE
        script.onreadystatechange=function(){
            if(script.readyState=="loaded"||script.readyState=="complete"){
                script.onreadystatechange=null;
                callback();
            }
        };
    }else{
        //其他浏览器
        script.onload=function(){
            callback();
        };
    }
    script.src=url;
    document.getElementsByTagName('head')[0].appendChild(script);
};

//加载js
loadScript("http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js", function(){
    loadScript("http://webapi.amap.com/maps?v=1.4.2&key=b0446b3b39bdac2770722ebaacbcad94&plugin", function(){
        $.get('blog/GdMap/uploadAddress.php?type=city', function(data) {
            if (data == ''){
                positioning();
            }else{
                $("#locationCity").html(data);
            }
        });

        var positioning = function(){
            //添加定位插件
            AMap.plugin('AMap.Geolocation', function() {
                geolocation = new AMap.Geolocation({
                    enableHighAccuracy: true, //是否使用高精度定位，默认:true
                    timeout: 10000 //超过10秒后停止定位，默认：无穷大
                });

                geolocation.getCurrentPosition(function(status, result){
                    if (status == 'complete'){
                        onComplete(result);
                    }else{
                        onError(result);
                    }
                });

                //解析定位结果
                function onComplete(data) {
                    var city = data.addressComponent.city;
                    var len = city.length;
                    var last_element = city[len-1];
                    if (last_element == "市" || last_element == "县"  || last_element == "村"|| last_element == "乡" ||last_element == "镇") {
                        city = city.substring(0, len - 1);
                    }

                    var address = data.formattedAddress;
                    var position = data.position;

                    var en_cityinfo = translate(city);
                    var en_address = translate(address);

                    $("#locationCity").html(en_cityinfo);


                    uploadAddress(en_cityinfo, en_address, position);
                }

                //解析定位错误信息
                function onError(data) {
                    alert("定位失败");
                }
            });
        }

        function uploadAddress(cityinfo, addressinfo, position) {
            var lng = position.getLng();
            var lat = position.getLat();

            $.ajax({
                url: 'blog/GdMap/uploadAddress.php',
                type: 'POST',
                async: false,
                dataType: 'text',
                data: {city: cityinfo, address: addressinfo, lng: lng, lat: lat}
            })
                .done(function(returnValue) {
                    console.log(returnValue);
                })
                .fail(function(msg) {
                    console.log(msg);
                });
        }

    })
});

/**
 * [translate 翻译]
 * @date        2017-12-25
 * @anotherdate 2017-12-25T20:51:00+0800
 * @param       String                 q 待翻译的中文字符串
 * @return      String                   翻译结果
 */
var translate = function(q){
    var url = "baidu_transapi.php?q=" + q + "&from=" + "zh" + "&to=" + "en";
    var dst;
    $.ajax({
        url: url,
        async: false,
        type: 'GET',
        dataType: 'json'
    })
        .done(function(returnValue) {
            dst = returnValue['trans_result'][0]['dst']
        })
        .fail(function(msg) {
            console.log(msg);
        });
    return dst;
};
