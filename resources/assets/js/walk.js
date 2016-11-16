$( ".spot .miamHeader" ).on( "click", function() {
   	
    miamCurrent=$(this).parent();
    miamCurrent.find(".miamList").toggle(400);
    miamCurrent.find(".miamOpen").toggleClass("glyphicon-minus");   
});

var map;
function initMap() {
    
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 48.8600299, lng: 2.3495251},
    zoom: 18
  });
}
genBottomForRead();
$( window ).resize(function() {

    genBottomForRead();
});

function genBottomForRead(){
    $(".spotContent").css("margin-bottom",($(window).height()-$("#map").height()-$(".spotContent ul li:last-child").height()));
}



