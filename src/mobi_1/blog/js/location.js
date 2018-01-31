var locationCity="";

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
