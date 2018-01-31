var locationCity="";

/*
$(document).ready(function(){
                  
                  displayCityLocation();
                  });
$("#locationBtn").click(function(){
                        displayCityLocation();
                        });

function displayCityLocation(){
    
    $.get("http://ipinfo.io", function(response) {
          $("#locationCity").html(response.city);
          }, "jsonp");
    
}
*/



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
            //console.log(result.city);
            $("#locationCity").html(result.city);
                        //alert("hello");
        }
    } else {
        return result.info;
    }
});
