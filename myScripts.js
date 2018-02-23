

// function to load all sectoins


// each section has html for and php for it to do stuff on clicks


// map hover over area of intersest shows small box. click moves view down and loads location info https://www.w3schools.com/howto/howto_js_scroll_to_top.asp


// change every element containing info about a city
function loadDetailsOf(city)
{
    myMap(city);

    todaysWeatherVertical(city)

    todaysWeatherHorizontal(city)

    cityInfo(city)

    locationInfo(city)

}

// change which map is shown 
function myMap(city) 
{

// ADVANCED: generate polygon as per instructions below
// https://gis.stackexchange.com/questions/183248/how-to-get-polygon-boundaries-of-city-in-json-from-google-maps-api
   
    // set map to be centered on city selected and passed in
    if (city == 'Leic') 
    {     

        var mapOptions = 
        {
            center: new google.maps.LatLng(52.6342853,-1.1415731),
            zoom:13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

    }
    else if (city == 'Stra')
    {

       var  mapOptions = 
        {
            center: new google.maps.LatLng(48.5696602,7.7447545),
            zoom:12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

    }

    // create instance of map within googleMap div
    var map = new google.maps.Map(document.getElementById("googleMap"),mapOptions);

    // place markers in places of interest in each city
    if (city == 'Leic') 
    {     
        var theBestPlace = new google.maps.LatLng(52.6432064,-1.1296815);

        var marker = new google.maps.Marker({position:theBestPlace});
        marker.setMap(map);

        // possible events https://developers.google.com/maps/documentation/javascript/events

        google.maps.event.addListener(marker,'mouseover',function() 
        {
            var infowindow = new google.maps.InfoWindow({
                content:"Hello World!"
            });
            infowindow.open(map,marker);
        });

        google.maps.event.addListener(marker,'click',function() 
        {

            // load location info 
            loadDetailsOf('bestPlace');

            // scroll view to the div with loaction details
            locationScroll();
        });

    }
    else if (city == 'Stra')
    {


    }

}

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("returnBtn").style.display = "block";
    } else {
        document.getElementById("returnBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topScroll() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

// will move the veiw so that the locationInfo Div is at the top
function locationScroll() 
{
    var locationDiv = document.getElementById("locationInfo");
    locationDiv.scrollIntoView();
}

// will populate the vertical box next to the map with todays weather data
function todaysWeatherVertical(city)
{



    document.getElementById("todaysWeatherVertical")

}

// will populate the horizontal box below the map with todays weather data
function todaysWeatherHorizontal(city)
{



}

// will populate the box below the map/horizontal weather with info about the selected city
function cityInfo(city)
{



}

// will populate the horizontal box below the city info with the forecast weather data
function todaysWeatherHorizontal(city)
{



}

// will populate the box below the image gallery with info about the location chosen 
function locationInfo(location)
{
    var content = ""

    // default output before any location has been chosen
    if ((location == 'Leic') || (location == 'Stra'))
    {

        content = ` <h1> Looks like you haven't chosen a location on the map yet! </h1>
                    <h1> Simply scroll back up there or use the handy button in the bottom right</h1>
                  `;

    }

    // change info output base on location passed in 
    switch(location) {
        case 'bestPlace':

            content = ` <h1> Parkers The Parts People </h1>
                      `;


            break;
        case 'notBestPlace':
            


            break;

    }

    // apply the content of 
    var locationDiv = document.getElementById("locationInfo");
    locationDiv.innerHTML = content;

}

