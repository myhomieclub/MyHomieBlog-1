/**
 * [loadScript 加载js]
 * @date        2017-12-25
 * @anotherdate 2017-12-25T20:52:36+0800
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
    loadScript("http://webapi.amap.com/maps?v=1.4.2&key=b0446b3b39bdac2770722ebaacbcad94&plugin=AMap.CitySearch", function(){
        getCity();
    })
});

/**
 * [getCity 获取用户所在城市]
 * @date        2017-12-25
 * @anotherdate 2017-12-25T20:52:01+0800
 */
var getCity = function(){
    //获取用户所在城市信息
    //实例化城市查询类
    var citysearch = new AMap.CitySearch();
    //自动获取用户IP，返回当前城市
    citysearch.getLocalCity(function (status, result) {
        if (status === 'complete' && result.info === 'OK') {
            if (result && result.city && result.bounds) {
                //用户所在的城市
                var cityinfo = result.city;
                var len = cityinfo.length;
                var last_element = cityinfo[len-1];
                if (last_element == "市" || last_element == "县"  || last_element == "村"|| last_element == "乡" ||last_element == "镇") {
                    cityinfo = cityinfo.substring(0, len - 1);
                }
                var en_cityinfo = translate(cityinfo);
                var position = result.rectangle.split(';')[0];
                var lng = position.split(',')[0];
                var lat = position.split(',')[1];
                //将用户地址信息存储到session中
                $.ajax({
                    url: 'blog/GdMap/uploadAddress.php',
                    type: 'POST',
                    dataType: 'text',
                    data: {address: en_cityinfo, lng: lng, lat: lat}
                })
                    .done(function(returnValue) {
                        console.log(returnValue);
                    })
                    .fail(function(msg) {
                        console.log(msg);
                    });
                $("#locationCity").html(en_cityinfo);
            }
        } else {
            return result.info;
        }
    });
};

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
