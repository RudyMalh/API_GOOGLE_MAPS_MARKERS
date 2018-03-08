<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 500px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

  <body>
    <div id="map"></div>

    <script>
      var customLabel = {
		  Ecole: {
		    label: 'E'
		  },
		  Monument: {
		    label: 'M'
		  },
		  Musee: {
		    label: 'MS'
		  }
	  };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(48.8604565 , 2.3447903),//La ou sera cenret la map
          zoom: 13 //Taille du zoom
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('http://localhost:8888/APIGoogleMaps/phpdomxml.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8VUXU2t3lcyWlbEbox3zPxNP3ejEtMRc&callback=initMap">
    </script>
  </body>
</html>

<!--<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 75%;
        margin: 0;
        padding: 5%;
      }
    </style>
  </head>
  <body>
  	<h3>My Google Maps Demo</h3>
    <div id="map"></div>
    <script>
      function initMap() {
        var paris = {lat: 48.8589507, lng: 2.2770203};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: paris
        });
        var marker = new google.maps.Marker({
          position: paris,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8VUXU2t3lcyWlbEbox3zPxNP3ejEtMRc&callback=initMap">
    </script>
  </body>
</html>
    <div id="map"></div>
    <input type="hidden" value="API KEY : AIzaSyB8VUXU2t3lcyWlbEbox3zPxNP3ejEtMRc"/>
    <script>
      var map;
      function initMap() {
        var paris = {lat: 48.8589507, lng: 2.2770203};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: paris
        });
        var eemi = new google.maps.Marker({
          position: paris;/*{lat:48.8688391, lng: 2.3390539};*/
          map: map
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8VUXU2t3lcyWlbEbox3zPxNP3ejEtMRc&callback=initMap"
    async defer></script>
  </body>
</html>-->
