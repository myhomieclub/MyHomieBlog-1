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
}

loadScript("http://webapi.amap.com/maps?v=1.4.2&key=b0446b3b39bdac2770722ebaacbcad94&plugin=AMap.CitySearch", function(){
           getCity();
           })

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
                            //输出用户所在的城市
                            console.log(result.city);
                             $("#locationCity").html(result.city);
                            }
                            } else {
                            return result.info;
                            }
                            });
}
