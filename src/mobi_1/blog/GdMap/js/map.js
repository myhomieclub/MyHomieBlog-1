var marker, defaultLang = 'en', result = '';

/**
 * 加载地图，调用浏览器定位服务
 *
 */
//实例化地图
var map = new AMap.Map('container', {
    resizeEnable: true,
    isHotspot: true,
    lang: defaultLang,
    showBuildingBlock: true
});

//添加定位插件
map.plugin('AMap.Geolocation', function() {
    geolocation = new AMap.Geolocation({
        enableHighAccuracy: true, //是否使用高精度定位，默认:true
        timeout: 10000, //超过10秒后停止定位，默认：无穷大
        buttonOffset: new AMap.Pixel(10, 20), //定位按钮与设置的停靠位置的偏移量，默认：Pixel(10, 20)
        zoomToAccuracy: true, //定位成功后调整地图视野范围使定位位置及精度范围视野内可见，默认：false
        buttonPosition: 'RB'
    });
    map.addControl(geolocation);
    geolocation.getCurrentPosition();
    AMap.event.addListener(geolocation, 'error', onError); //返回定位出错信息
});
//解析定位错误信息
function onError(data) {
    //alert("定位失败");
    console.log(data);
}


/**
 * 添加比例尺插件
 */
map.plugin(["AMap.Scale"], function() {
    map.addControl(new AMap.Scale());
});


/**
 * 添加缩放插件
 */
map.plugin(["AMap.ToolBar"], function() {
    map.addControl(new AMap.ToolBar());
});
if (location.href.indexOf('&guide=1') !== -1) {
    map.setStatus({
        scrollWheel: false
    })
}


/**
 * 添加查询服务
 */
AMap.service(["AMap.PlaceSearch", "AMap.Autocomplete"], function() {
    try {
        ready();
    } catch (e) {
        console.error(e);
    }
});

function ready() {
    rmMarker();
    //搜索框支持自动完成提示
    var auto = new AMap.Autocomplete({
        input: "tipinput"
    });
    //构造地点查询类
    var placeSearch = new AMap.PlaceSearch({
        pageSize: 5,
        pageIndex: 1,
        map: map,
        panel: "poiList",
        lang: defaultLang
    });
    //监听搜索框的提示选中事件
    AMap.event.addListener(auto, "select", function(e) {
        //设置搜索的城市
        placeSearch.setCity(e.poi.adcode);
        //开始搜索对应的poi名称
        placeSearch.search(e.poi.name, function(status, results) {
            //显示结果列表
            $('#panel').removeClass('hidden');
            //隐藏loading状态
            $(document.body).removeClass('searching');
        });
        //显示loading状态
        $(document.body).addClass('searching');
    });
    //检查结果列表是否为空， 为空时显示必要的提示，即#emptyTip
    function checkPoiList() {
        $('#panel').toggleClass('empty', !($.trim($('#poiList').html())));
    }
    checkPoiList();
    //监听搜索列表的渲染完成事件
    AMap.event.addListener(placeSearch, 'renderComplete', function() {
        checkPoiList();
    });
    //监听marker/列表的选中事件
    AMap.event.addListener(placeSearch, 'selectChanged', function(results) {
        //获取当前选中的结果数据
        var data = results.selected.data;
        if(confirm("您确定选择该地址吗?")){
            submitAddress(data.name, data.location);
        }
        else{
            return 0;
        }
    });
    AMap.event.addListener(map, 'click', function(){
        placeSearch.clear();
        //清除搜索框内容
        $('#tipinput').val('');
        //清除结果列表
        placeSearch.clear();
        $('#panel').addClass('hidden');
        checkPoiList();
    });
    $('#clearSearchBtn').click(function() {
        //清除搜索框内容
        $('#tipinput').val('');
        //清除结果列表
        placeSearch.clear();
        $('#panel').addClass('hidden');
        checkPoiList();
    });
}


/**
 * 添加热点点击事件
 *
 */
map.on('hotspotclick', function(result) {
    map.setCenter(result.lnglat);
    var placeSearch = new AMap.PlaceSearch({
        map: map,
        lang: defaultLang
    });
    placeSearch.getDetails(result.id, function(status, result) {
        if (status === 'complete' && result.info === 'OK') {
            var poiArr = result.poiList.pois;
            AMapUI.loadUI(['overlay/SimpleInfoWindow'], function(SimpleInfoWindow){
                poi = poiArr[0];
                address = translate(poi.address);

                title = '<strong>' + address + '</strong>';
                content = setInfoWindowContent(poi);

                var infoWindow = new SimpleInfoWindow({

                    closeWhenClickMap: true,
                    autoMove: true,
                    showShadow: true,
                    infoTitle: title,
                    infoBody: content
                });

                //构建自定义信息窗体的内容
                function setInfoWindowContent(poi){
                    var content = '<div id="poi-item">';
                    if (poi.address || poi.tel) {
                        if (poi.address) {
                            content += '<p class="poi-addr">address：' + address + '</p>';
                        }
                        if (poi.del) {
                            content += '<p class="poi-del">tel：' + poi.del + '</p>';
                        }
                    }
                    content += '<button id = "submit">Done</button></div>';

                    return content;
                }

                infoWindow.open(map, poi.location);

                $(document).on('click', '#submit', function() {
                    submitAddress(address, poi.location);
                });
            });
        }
    });
});


/**
 * [submitAddress 地址上传]
 * @date    2018-02-02
 * @another joseph
 * @param   string     name        地理位置名称
 * @param   c          location    地理位置经纬度信息
 */
function submitAddress(name, location){
    $.ajax({
        url: 'uploadAddress.php',
        type: 'POST',
        async: false,
        dataType: 'text',
        data: {address: name, lng: location['lng'], lat: location['lat']}
    })
        .done(function(returnValue) {
            console.log(returnValue);
            setTimeout(console.log('wait a second'), 1000);
            window.history.go(-1);
        })
        .fail(function(msg) {
            console.log(msg);
            window.history.go(-1);
        });

}

//清除点标记
function rmMarker(){
    if (marker) {
        marker.setMap(null);
        marker = null;
    }
}

$("#tipinput").focus(function(event) {
    rmMarker();
    $("#one_panel").addClass('hidden');
    map.clearInfoWindow();
});

//添加点标记
function addMarker(data){
    marker = new AMap.Marker({
        icon: "https://webapi.amap.com/theme/v1.3/markers/n/mark_b.png",
        position: data
    });
    marker.setMap(map);
}

/**
 * 为地图添加语言切换功能
 */

//给切换语言按钮绑定dom监听事件
['en', 'zh_cn'].forEach(function(btn) {
    var button = document.getElementById(btn);
    AMap.event.addDomListener(button, 'click', clickListener)
});

//点击切换语言按钮事件
function clickListener() {
    //构造地点查询类
    map.setLang(this.id);
    defaultLang = this.id;
}