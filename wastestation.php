<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Waste Station in map</title>
    <meta name="description" content="Expanding Search Bar Deconstructed" />
    <meta name="keywords" content="transition, search, expanding, search input, sliding input, css3, javascript" />
    <meta name="author" content="Codrops" />
    <!--
        Google Fonts
        ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet" type="text/css">

    <!--
    CSS
    ============================================= -->
    <!-- Fontawesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Fancybox -->
    <link rel="stylesheet" href="css/jquery.fancybox.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <!-- Animate -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="css/main.css">
    <!-- Main Responsive -->
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />
    <script src="js/modernizr.custom.js"></script>
</head>
<body>
 <header id="navigation" >
            <div class="container">

                <div class="navbar-header">
                    <!-- responsive nav button -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- /responsive nav button -->

                    <!-- logo -->
                    <h1 class="navbar-brand">
                        <a href="index.html">
                            <img src="img/logo.jpg" alt="Kasper Logo">
                        </a>
                    </h1>
                    <!-- /logo -->

                    </div>

                    <!-- main nav -->
                    <nav class="collapse navigation navbar-collapse navbar-right" role="navigation">
                        <ul id="nav" class="nav navbar-nav">
                            <li class="current"><a href="index.html">Home</a></li>                           
							<li><a href="postBin.html">Post</a></li>
                            <li><a href="searchBin.html">Provider</a></li>
                            <li><a href="display.php">Display</a></li>
							<li><a href="wastestation.php">Waste Station</a></li>
                        </ul>
                    </nav>
                    <!-- /main nav -->
                </div>

            
     

</header>

<!-- Map-->



<section>

    <?php

    $mysql_server_name="au-cdbr-azure-southeast-a.cloudapp.net"; //host name
    $mysql_username="bcde0439f22304"; // username
    $mysql_password="c4367224"; //password
    $mysql_database="binshare"; // database name
    $conn=mysql_connect($mysql_server_name, $mysql_username,$mysql_password);

    function book()
    {
        echo 'hello';
    }
    
    $strsql="select * from wastestation where LANDFILL='Operating'";
    
    $result=mysql_db_query($mysql_database, $strsql, $conn);
 


    ?>
    <?php while($row = mysql_fetch_array($result)) {
        $address[] = $row['SITEADDRES'];
        $suburb[] = $row['SITESUBURB'];
        $lat[] = $row['LAT'];
        $lng[] = $row['LNG'];
        $name[] = $row['NAME'];
        $postcode[] = $row['POSTCODE'];
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="main clearfix">
                    <!-- Optional columns for small components -->
                    <div class="section-title text-center wow fadeInUp">
                        <h2>Search For Waste Management Facilities</h2>
                        <p>This Map shows locations of Victoria's known landfills, waste transfer stations and a large number of waste reprocessing facilities.</p>
                    </div>

                    <div class="section-title text-center wow fadeInUp"></div>

                    <div class="section-title text-center wow fadeInUp"></div>
                    <input type="text" style="height:70px" class="form-control" placeholder="Your Address" id="address" name="address" required data-validation-required-message="Please enter your Address.">
                    <p class="help-block text-danger"></p>
                    <a type="button" id="submit" class="btn btn-primary btn-xl page-scroll">Search</a>

                    <div id="map">
                    </div>
                </div>
            </div><!-- /container -->
            <script src="js/classie.js"></script>
            <script src="js/uisearch.js"></script>
</section>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places">
</script>
<script type="text/javascript">
    var address = <?php echo json_encode($address); ?>;
    var lat = <?php echo json_encode($lat); ?>;
    var lng = <?php echo json_encode($lng); ?>;
    var name1 = <?php echo json_encode($name); ?>;
    var postcode = <?php echo json_encode($postcode); ?>;
    var suburb = <?php echo json_encode($suburb); ?>;
	var iconBase = 'http://maps.google.com/mapfiles/kml/pal3/';
    function displayMarkers(){

        // this variable sets the map bounds and zoom level according to markers position
        var bounds = new google.maps.LatLngBounds();

        // For loop that runs through the info on markersData making it possible to createMarker function to create the markers
        for (var i = 0; i < address.length; i++){

            var latlng = new google.maps.LatLng(lat[i], lng[i]);
            var name = name1[i];
            var address1 = address[i];
            var address2 = suburb[i];
            var postalCode = postcode[i];

            createMarker(latlng, name, address1, address2, postalCode);

            // Marker’s Lat. and Lng. values are added to bounds variable
            bounds.extend(latlng);
        }

        // Finally the bounds variable is used to set the map bounds
        // with API’s fitBounds() function
        map.fitBounds(bounds);
    }

    // This function creates each marker and sets their Info Window content
    function createMarker(latlng, name, address1, address2, postalCode){
        var marker = new google.maps.Marker({
            map: map,
            position: latlng,
            title: name			
        });

        // This event expects a click on a marker
        // When this event is fired the infowindow content is created
        // and the infowindow is opened
        google.maps.event.addListener(marker, 'click', function() {

            // Variable to define the HTML content to be inserted in the infowindow
            var iwContent = '<div id="iw_container">' +
                '<div class="iw_title">' + name + '</div>' +
                '<div class="iw_content">' + address1 + '<br />' +
                address2 + '<br />' +
                postalCode + '</div></div>';

            // including content to the infowindow
            infoWindow.setContent(iwContent);

            // opening the infowindow in the current map and at the current marker location
            infoWindow.open(map, marker);
        });
    }

    function initialize() {
        var mapOptions = {
            center: new google.maps.LatLng(-37.814107, 144.96328),
            zoom: 8,
            mapTypeId: 'roadmap',
        };
        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        // a new Info Window is created
        infoWindow = new google.maps.InfoWindow();

        // Event that closes the InfoWindow with a click on the map
        google.maps.event.addListener(map, 'click', function() {
            infoWindow.close();
        });

        // Finally displayMarkers() function is called to begin the markers creation
        displayMarkers();
        var geocoder = new google.maps.Geocoder();
        var input = (document.getElementById('address'));
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        document.getElementById('submit').addEventListener('click', function() {
            geocodeAddress(geocoder, map);
        });
    }

    function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                resultsMap.setCenter(results[0].geometry.location);
                resultsMap.setZoom(16);
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location,
					icon: iconBase + 'icon31.png'
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>

</body>
</html>