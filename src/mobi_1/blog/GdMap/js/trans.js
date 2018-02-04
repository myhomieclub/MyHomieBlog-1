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