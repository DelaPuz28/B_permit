<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!---bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--OpenLayers CSS-->
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
    <!--OpenLayers JS-->
    <script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>
    <!--Custom CSS-->
    <link rel="stylesheet" href="custom/css/style.css">
    <script src="assets/js/search_ol-ext.js"></script>
    <script src="assets/js/crop_ol-ext.js"></script>
    <script src="assets/js/hays_ol-ext.js"></script>
    <script src="assets/js/control_ol-ext.js"></script>
    <link rel="stylesheet" href="assets/css/search_ol-ext.css">
    <link rel="stylesheet" href="assets/css/ol-ext.css">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>

</head>
<style>
.map {
    width: 100vw;
    height: 90vh;
}

/* popup style */
.ol-popup {
    max-width: 300px;
    min-width: 100px;
    min-height: 1em;
}

.draw-app {
    top: 65px;
    left: .5em;
}

.ol-touch .draw-app {
    top: 80px;
}

.tooltip-inner {
    white-space: nowrap;
}

.modal-container {
    max-width: 100%;
    padding: 0 10px;
}

.card {
    border: none;
}

@media only screen and (max-width: 800px) {

    /* Adjust the max-width value based on your design needs */
    .map {
        height: 90vh;
        /* Use viewport height (vh) instead of a fixed percentage */
    }
}
</style>


<body>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!--navbar-->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                </div>
            </div>
        </nav>


        <!-- Map Div-->
        <div class="map" id="map"></div>

        <?php
include ('shopinfo.php');
?>


        <!--start modify feature confirmation Modal -->
        <div class="modal fade" id="confirmModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifying Points - Lines - Polygons</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ARE YOU SURE?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            onclick="clearEditSource()">NO</button>
                        <button type="button" class="btn btn-primary" onclick="startedit()">YES</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end modify feature confirmation Modal -->


        <!--start save update modify feature confirmation Modal -->

        <div class="modal fade" id="confirmFeatureModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">SAVING MODIFIED Points - Lines - Polygons
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ARE YOU SURE?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            onclick="clearEditSource()">NO</button>
                        <button type="button" class="btn btn-primary" id="refreshButton2"
                            onclick="saveModitodb()">YES</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end save update modify feature confirmation Modal -->

        <!--begin: start draw Modal -->

        <div class="modal fade" id="startdrawModal" tabindex="-1" aria-labelledby="startdrawModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="startdrawModalLabel">Select Draw Type</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        <!--cards-->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Polygon</h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary">PUBLIC MARKET</h6>
                                        <p class="card-text"><i class="fa-solid fa-draw-polygon fa-2x"></i></p>
                                        <button type="button" class="btn btn-primary" <a onclick="startDraw('Polygon')"
                                            class="card-">Add Polygon</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end: start draw Modal -->

        <div class="modal fade" id="enterInformationModal" tabindex="-1" aria-labelledby="enterInformationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="enterInformationModalLabel">Enter Feature's Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body" style="text-align: center;">
                        <!-- Type of Feature selection -->
                        <div class="form-group">
                            <label for="typeoffeatures">TYPE OF FEATURE</label>
                            <select class="form-control" id="typeoffeatures">
                            </select>
                        </div>
                        <!-- Name and Address fields -->
                        <form id="newDrawn">
                            <div class="form-group">

                                <label for="exampleInputtext1">NAME</label>
                                <input type="text" class="form-control" id="exampleInputtext1" name="name"
                                    aria-describedby="textHelp">
                                <!-- <small id="textHelp" class="form-text text-muted">Address, Name, etc.</small>-->
                            </div>

                            <div class="form-group">

                                <label for="exampleInputtext1">ADDRESS</label>
                                <input type="text" class="form-control" id="exampleInputtext3" name="ADDRESS"
                                    aria-describedby="textHelp">
                                <!-- <small id="textHelp" class="form-text text-muted">Address, Name, etc.</small>-->
                            </div>

                            <div class="form-group">
                                <!-- BARANGAY -->
                                <label for="exampleInputtext2">BARANGAY NUMBER</label>
                                <input type="text" class="form-control" id="exampleInputtext2" name="barangayNo"
                                    aria-describedby="textHelp">
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                onclick="clearDrawSource()">Close</button>
                            <button type="button" class="btn btn-primary" id="refreshButton" onclick="savetodb()">Save
                                Feature</button>
                        </div>
                    </div>
                </div>
            </div>







        </div><!-- /.container-fluid -->
        <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous">
        </script>
        <!--boostrap   js-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>


        <!--Custom JS-->
        <script>
        // global variable
        var featureLayer
        var geoms
        var feature_id
        var selectInt
        var modi
        var editdrawLayer
        var draw
        var FlagisDrawingOn = false
        var FlagisModifyOn = false

        var PolygonType = ['BarberShop']
        var selectedGeomType


        // custom control
        window.apps = {};
        var apps = window.apps;

        /**
         * @constructor
         * @extends {ol.control.Control}
         * @param {Object=} opt_options Control options.
         */

        apps.DrawingApp = function(opt_options) {

            var options = opt_options || {};

            var button = document.createElement('button');
            button.id = 'drawbtn'
            button.innerHTML = '<i class="fa-solid fa-pen-ruler"></i>';

            var this_ = this;
            var startStopApp = function() {
                if (FlagisDrawingOn == false) {
                    $('#startdrawModal').modal('show')

                } else {
                    map.removeInteraction(draw)

                    FlagisDrawingOn = false
                    document.getElementById('drawbtn').innerHTML =
                        '<i class="fa-solid fa-pen-ruler"></i>'
                    defineTypeoffeature()
                    $('#enterInformationModal').modal('show')
                }
            };

            button.addEventListener('click', startStopApp, false);
            button.addEventListener('touchstart', startStopApp, false);

            var element = document.createElement('div');
            element.className = 'draw-app ol-unselectable ol-control';
            element.appendChild(button);

            ol.control.Control.call(this, {
                element: element,
                target: options.target
            });

        };
        ol.inherits(apps.DrawingApp, ol.control.Control);


        // custom control
        window.appss = {};
        var appss = window.appss;

        /**
         * @constructor
         * @extends {ol.control.Control}
         * @param {Object=} opt_options Control options.
         */
        appss.ModifyFeatureApp = function(opt_options) {

            var options = opt_options || {};

            var button = document.createElement('button');
            button.id = 'editbtn'
            button.innerHTML = '<i class="fa-solid fa-pen-to-square"></i>';

            var this_ = this;
            var startStopApp = function() {
                if (FlagisModifyOn == false) {
                    $('#confirmModal').modal('show')
                } else {

                    FlagisModifyOn = false
                    map.removeLayer(editdrawLayer)
                    map.removeInteraction(selectInt)
                    map.removeInteraction(modi)
                    editSource.clear()
                    document.getElementById('editbtn').innerHTML =
                        '<i class="fa-solid fa-pen-to-square"></i>'
                    $('#confirmFeatureModal').modal('show')
                }
            };

            button.addEventListener('click', startStopApp, false);
            button.addEventListener('touchstart', startStopApp, false);

            var element = document.createElement('div');
            element.className = 'modify-app ol-control ol-bar ol-left';
            element.appendChild(button);

            ol.control.Control.call(this, {
                element: element,
                target: options.target
            });

        };
        ol.inherits(appss.ModifyFeatureApp, ol.control.Control);



        //
        // view
        //
        var cityCenter = [13473779.769599514, 1659650.641159134];
        var radius = 8000;
        var extent = [
            cityCenter[0] - radius,
            cityCenter[1] - radius,
            cityCenter[0] + radius,
            cityCenter[1] + radius
        ];

        var myview = new ol.View({
            projection: 'EPSG:3857',
            zoom: 14,
            center: cityCenter,
            minZoom: 14,
            maxZoom: 20,
            extent: extent
        });


        //
        //osm layer
        /*
        var baselayer = new ol.layer.Tile({
            source : new ol.source.OSM({
                attributions:'GIS MPG'
            })
        })*/
        var accessToken =
            'pk.eyJ1IjoicmFjYW5lMTIzIiwiYSI6ImNscDJhZ2xmbDBwdmEybG9pa2w4Yms0emEifQ.vyLoKd0CBDl14MKI_9JDCQ';
        var baselayer = new ol.layer.Tile({
            source: new ol.source.XYZ({
                url: 'https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token=' +
                    accessToken,
                tileSize: 520,
                projection: 'EPSG:3857'
            })
        });

        //
        // source para sa featurelayer
        //
        var featureLayerSource = new ol.source.Vector();

        fetch('https://group68.towntechinnovations.com/apiFolder/api.php')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                // Parse the GeoJSON data and add features to the vector source
                var features = new ol.format.GeoJSON().readFeatures(data);
                featureLayerSource.addFeatures(features);
            })
            .catch(function(error) {
                console.error('Error fetching and processing GeoJSON:', error);
            });


        function refresh() {
            featureLayerSource.clear();
            fetch('https://group68.towntechinnovations.com/apiFolder/api.php?')
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    // Parse the GeoJSON data and add features to the vector source
                    var features = new ol.format.GeoJSON().readFeatures(data);
                    featureLayerSource.addFeatures(features);
                })
                .catch(function(error) {
                    console.error('Error fetching and processing GeoJSON:', error);
                });
        }

        document.getElementById("refreshButton").addEventListener("click", function() {
            // Call the refresh function when the button is clicked
            refresh();
        });
        document.getElementById("refreshButton2").addEventListener("click", function() {
            // Call the refresh function when the button is clicked
            refresh();
        });

        //
        // pag display ng mga feature sa map na may style depende kung point,linstring, or polygon
        //


        var featureLayer = new ol.layer.Vector({
            source: featureLayerSource,
            style: function(feature) {
                var geometry = feature.getGeometry().getType();
                var styles = [];

                if (geometry === 'Polygon') {
                    var name = feature.get('name');
                    var type = feature.get('type');
                    var polygonCoordinates = feature.getGeometry().getCoordinates()[0];
                    var centroid = calculateCentroid(polygonCoordinates);

                    var polygonExtent = feature.getGeometry().getExtent();
                    var polygonWidth = Math.abs(polygonExtent[0] - polygonExtent[2]);
                    var polygonHeight = Math.abs(polygonExtent[1] - polygonExtent[3]);
                    var maxSize = 30;
                    var sizeFactor = Math.min(polygonWidth, polygonHeight) / Math.max(
                        polygonWidth,
                        polygonHeight);
                    var iconSize = Math.round(sizeFactor * maxSize);

                    // Define a mapping between feature types and their respective icons
                    var iconMap = {
                        'BarberShop': 'assets/img/barbershop.png',
                    };

                    var iconPath = iconMap[type] || 'assets/img/default.png';
                    if (type === 'BarberShop') {
                        styles.push(
                            new ol.style.Style({
                                fill: new ol.style.Fill({
                                    color: 'rgba(0, 128, 0, 0.2)',
                                }),
                                stroke: new ol.style.Stroke({
                                    color: 'green',
                                    width: 1,
                                }),
                            }),
                            new ol.style.Style({
                                geometry: new ol.geom.Point(centroid),
                                image: new ol.style.Icon({
                                    src: iconPath,
                                    scale: iconSize / 50,
                                }),
                            }),
                            new ol.style.Style({
                                geometry: new ol.geom.Point(centroid),
                                text: new ol.style.Text({
                                    text: name,
                                    fill: new ol.style.Fill({
                                        color: 'black',
                                    }),
                                    stroke: new ol.style.Stroke({
                                        color: 'white',
                                        width: 1,
                                    }),
                                    font: '8px Arial',
                                    offsetX: 0,
                                    offsetY: 13,
                                }),
                            })

                        );

                    }
                }

                return styles;
            },

        });

        // Function to calculate centroid of a polygon
        function calculateCentroid(coordinates) {
            var totalX = 0;
            var totalY = 0;
            var totalPoints = coordinates.length;
            coordinates.forEach(function(point) {
                totalX += point[0];
                totalY += point[1];
            });
            var centroidX = totalX / totalPoints;
            var centroidY = totalY / totalPoints;
            return [centroidX, centroidY];
        }

        // Popup overlay with popupClass=anim
        var popup = new ol.Overlay.Popup({
            popupClass: "default anim",
            closeBox: true,
            onclose: function() {
                console.log("You close the box");
            },
            positioning: 'auto',
            autoPan: {
                animation: {
                    duration: 100
                }
            }
        });

        // draw vector layer
        // 1. define source
        var drawSource = new ol.source.Vector()
        // 2. define layer
        var drawLayer = new ol.layer.Vector({
            source: drawSource
        })

        // vector source para sa edit features
        var editSource = new ol.source.Vector()

        fetch('https://group68.towntechinnovations.com/apiFolder/api.php')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                // Parse the GeoJSON data and add features to the vector source
                var features = new ol.format.GeoJSON().readFeatures(data);
                editSource.addFeatures(features);

                // Zoom to the extent of the loaded features
                // map.getView().fit(featureLayerSource.getExtent());
            })
            .catch(function(error) {
                console.error('Error fetching and processing GeoJSON:', error);
            });


        // Layer array
        var layerArray = [baselayer, featureLayer, drawLayer]


        //Map
        var map = new ol.Map({
            controls: ol.control.defaults({
                attributionOptions: {
                    collapsible: false
                }
            }).extend([
                new apps.DrawingApp(),
                new appss.ModifyFeatureApp()
            ]),

            target: 'map',
            view: myview,
            layers: layerArray,
            overlays: [popup]

        })




        // Control Select 
        var select = new ol.interaction.Select({});
        map.addInteraction(select);

        // Set the control grid reference
        var search = new ol.control.SearchFeature({
            //target: $(".options").get(0),
            source: featureLayerSource,
            //property: $(".options select").val(),
            sort: function(f1, f2) {
                if (search.getSearchString(f1) < search.getSearchString(f2)) return -1;
                if (search.getSearchString(f1) > search.getSearchString(f2)) return 1;
                return 0;
            }
        });
        map.addControl(search);

        // Select feature when click on the reference index
        search.on('select', function(e) {
            select.getFeatures().clear();
            select.getFeatures().push(e.search);
            var p = e.search.getGeometry().getFirstCoordinate();
            map.getView().animate({
                center: p,
                zoom: 15,
                easing: ol.easing.easeOut
            });
        });

        // FOR ADD RESIDENT MODAL
        function handleButtonClick(baranggay_no, feature_id) {
            $('#myModals').modal('show');
            $('#barangay_no_input').val(baranggay_no);
            $('#feature_id_input').val(feature_id);
        }

        $('#cancel').on('click', function() {
            $('#myModals').modal('hide');
        });

        // FOR ADD SHOP INFO MODAL
        function forAddMoreInfo(baranggay_no, feature_id) {
            $('#addShopInfo').modal('show');
            $('#shop_barangayNo').val(baranggay_no);
            $('#shop_featureID').val(feature_id);
        }

        $('#canceladdShopInfo').on('click', function() {
            $('#addShopInfo').modal('hide');
        });

        $('#cancelViewMoreShopInfo').on('click', function() {
            $('#viewMoreShopInfo').modal('hide');
        });


        select.getFeatures().on(['add'], function(e) {
            if (!FlagisDrawingOn) {
                var feature = e.element;
                var type = feature.get("type");
                var brgy_no = feature.get("barangay_no");

                if (type === 'Boundary') {
                    var content =
                        '</br> <b> NAME </b>:' + feature.get("name") +
                        '</br><b> BRGY </b>:' + feature.get("barangay_no");
                } else {
                    var content =
                        '<b> TYPE </b>:' + feature.get("type") +
                        '</br> <b> NAME </b>:' + feature.get("name") +
                        '</br><b> BRGY </b>:' + feature.get("baranggay_no");
                }

                var geometryType = feature.getGeometry().getType();
                var coordinates;
                if (geometryType === 'Point') {
                    coordinates = feature.getGeometry().getCoordinates();
                } else if (geometryType === 'LineString') {
                    coordinates = ol.extent.getCenter(feature.getGeometry().getExtent());
                } else if (geometryType === 'Polygon') {
                    coordinates = ol.extent.getCenter(feature.getGeometry().getExtent());
                }



                // Check if the feature type is residential
                if (feature.get("type") === "Residential") {
                    content +=
                        '<hr style="margin: 0;">' +
                        '<button style="margin: 0; padding:0;" type="button" class="btn btn-secondary" id="yourButtonId">Add Resident</button>' +
                        '<button style="margin-left: 3px; padding:0;" type="button" class="btn btn-secondary" id="viewResButtonId">View Resident</button>';
                }



                // Check if the feature type is residential
                if (feature.get("type") === "BarberShop" || feature.get("type") ===
                    "MilkTea Shop" || feature
                    .get("type") === "Repair Shop") {
                    content +=
                        '<hr style="margin: 0;">' +
                        '<button style="margin-left: 3px; padding:0;" type="button" data-toggle="modal" data-target="#viewMoreShopInfoId" class="btn btn-secondary" id="viewMoreShopInfoId">More info</button>' +
                        '<button style="margin-left: 3px; padding:0;" type="button" class="btn btn-secondary" id="viewAddInfo">Add</button>';
                }


                popup.show(coordinates, content);

                // Attach click event listener to the button if it's added
                if (feature.get("type") === "BarberShop" || feature.get("type") ===
                    "MilkTea Shop" || feature
                    .get("type") === "Repair Shop") {
                    $('#viewAddInfo').on('click', function() {
                        var baranggay_no = feature.get(
                            "baranggay_no"
                        ); // Assuming barangay_no is part of the feature properties
                        var feature_id = feature.get(
                            "feature_id"
                        ); // Assuming feature_id is part of the feature properties
                        forAddMoreInfo(baranggay_no, feature_id);
                    });
                }

                // Attach click event listener to the button if it's added
                if (feature.get("type") === "Residential") {
                    $('#yourButtonId').on('click', function() {
                        var baranggay_no = feature.get(
                            "baranggay_no"
                        ); // Assuming barangay_no is part of the feature properties
                        var feature_id = feature.get(
                            "feature_id"
                        ); // Assuming feature_id is part of the feature properties
                        handleButtonClick(baranggay_no, feature_id);
                    });
                }

                if (feature.get("type") === "BarberShop" || feature.get("type") === "MilkTea Shop" || feature.get("type") === "Repair Shop") {
          $('#viewMoreShopInfoId').on('click', function() {
            var Feature_id = feature.get("feature_id");
             console.log(Feature_id)
    
             $.ajax({
              url: 'https://group68.towntechinnovations.com/apiFolder/viewShopInfoapi.php',
              type: 'POST',
              data: {
                  feature_id: Feature_id
              },
              success: function(response) {
                  // Handle the response data here
                  console.log(response);
                  // Assuming the response is JSON, you can parse it and process it accordingly
                  var data = JSON.parse(response);
                  var tableBod = document.querySelector('#shopinfo-tables tbody');
                  tableBod.innerHTML = ''; // Clear the table body before appending new data
                  data.forEach(shopinfo => {
                      var row = document.createElement('tr');
                      row.innerHTML = `
                          <td>${shopinfo.O_Name}</td>
                          <td>${shopinfo.O_age}</td>
                          <td>${shopinfo.O_gender}</td>
                          <td><a href="data:application/pdf;base64,${shopinfo.O_permit}" download="permit.pdf">Download Permit</a></td>
                          <td><button class="btn btn-primary" data-toggle="modal" data-target="#deleteOwner" onclick="editShopInfo('${shopinfo.OwnerID}')">Delete</button></td>

                          
                      `;
                      tableBod.appendChild(row);
                  });
              },
              error: function(xhr, status, error) {
                  console.error('Error fetching data:', error);
              }
          });
    
          $('#viewMoreShopInfo').modal('show'); 
          });
        }



                if (feature.get("type") === "Residential") {
                    $('#viewResButtonId').on('click', function() {
                        var Feature_id = feature.get("feature_id");
                        console.log(Feature_id)

                        $.ajax({
                            url: 'https://group68.towntechinnovations.com/apiFolder/viewresidentapi.php',
                            type: 'POST',
                            data: {
                                feature_id: Feature_id
                            },
                            success: function(response) {
                                // Handle the response data here
                                console.log(response);
                                // Assuming the response is JSON, you can parse it and process it accordingly
                                var data = JSON.parse(response);
                                var tableBody = document.querySelector(
                                    '#resident-tables tbody');
                                tableBody.innerHTML =
                                    ''; // Clear the table body before appending new data
                                data.forEach(resident => {
                                    var row = document.createElement(
                                        'tr');
                                    row.innerHTML = `
                      <td>${resident.name}</td>
                      <td>${resident.age}</td>
                      <td>${resident.gender}</td>
                      <td>${resident.height}</td>
                      <td>${resident.weight}</td>
                      <td><button class="btn btn-primary" data-toggle="modal" data-target="#editinfo" onclick="editResident(${resident.ResidentID}, '${resident.name}', ${resident.age}, '${resident.gender}', ${resident.height}, ${resident.weight})">Edit</button></td>
                  `;
                                    tableBody.appendChild(row);
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching data:', error);
                            }
                        });

                        $('#viewresident').modal('show');
                    });
                }

            }


        });

        // On deselected => hide popup
        select.getFeatures().on(['remove'], function(e) {
            //featureLayer.clear(true);
            popup.hide();
        });



        function removeViewRes() {
            $('#viewresident').modal('hide');
            $('#editinfo').modal('hide');
            $('#myModals').modal('hide');
            //$('#resident-table tbody').empty(); // Clear the table body
        }

        // FUNCTION TO START DRAWING FEATURES
        function startDraw(geomType) {
            selectedGeomType = geomType
            draw = new ol.interaction.Draw({
                type: geomType,
                source: drawSource
            })
            $('#startdrawModal').modal('hide')
            map.addInteraction(draw)

            FlagisDrawingOn = true
            document.getElementById('drawbtn').innerHTML = '<i class="fa-solid fa-circle-stop"></i>'
        }


        //function to add types based on feature
        function defineTypeoffeature() {
            var dropdownoftype = document.getElementById('typeoffeatures')
            dropdownoftype.innerHTML = ''
            if (selectedGeomType == 'Point') {
                for (i = 0; i < PointType.length; i++) {
                    var op = document.createElement('option')
                    op.value = PointType[i]
                    op.innerHTML = PointType[i]
                    dropdownoftype.appendChild(op)
                }
            } else if (selectedGeomType == 'LineString') {
                for (i = 0; i < LineType.length; i++) {
                    var op = document.createElement('option')
                    op.value = LineType[i]
                    op.innerHTML = LineType[i]
                    dropdownoftype.appendChild(op)
                }
            } else {
                for (i = 0; i < PolygonType.length; i++) {
                    var op = document.createElement('option')
                    op.value = PolygonType[i]
                    op.innerHTML = PolygonType[i]
                    dropdownoftype.appendChild(op)
                }
            }
        }


        // SAVE NEW DRAWN FEATURES TO DATABASE
        function savetodb() {
            var featureArray = drawSource.getFeatures();
            var geoJSONformat = new ol.format.GeoJSON();
            var featuresGeojson = geoJSONformat.writeFeaturesObject(featureArray);
            var geojsonFeatureArray = featuresGeojson.features;

            console.log(geojsonFeatureArray);

            for (var i = 0; i < geojsonFeatureArray.length; i++) {
                var type = document.getElementById('typeoffeatures').value;
                var name = document.getElementById('exampleInputtext1').value;
                var barangay_no = document.getElementById('exampleInputtext2').value;
                var address = document.getElementById('exampleInputtext3').value;
                var geom = JSON.stringify(geojsonFeatureArray[i].geometry);

                if (type !== '') {
                    if (type === 'Boundary') {
                        // Save boundary feature
                        $.ajax({
                            url: 'https://group68.towntechinnovations.com/save_to_database/saveboundary.php',
                            type: 'POST',
                            data: {
                                typeofgeom: type,
                                nameofgeom: name,
                                barangaynoofgeom: barangay_no,
                                stringofgeom: geom
                            },
                            success: function(dataResult) {
                                try {
                                    var result = JSON.parse(dataResult);
                                    console.log(result); // Log the entire parsed result

                                    if (result.statusCode === 200) {
                                        showToast('success', 'Feature updated successfully');
                                    } else {
                                        showToast('error', 'Feature not updated successfully');
                                    }
                                } catch (e) {
                                    console.error('Error parsing JSON:', e);
                                    console.log('Original dataResult:', dataResult);
                                }
                            }
                        });
                    } else {
                        // Save non-boundary feature
                        $.ajax({
                            url: 'https://group68.towntechinnovations.com/MAP/save_to_database/save.php',
                            type: 'POST',
                            data: {
                                typeofgeom: type,
                                nameofgeom: name,
                                barangaynoofgeom: barangay_no,
                                address: address,
                                stringofgeom: geom
                            },
                            success: function(dataResult) {
                                try {
                                    var result = JSON.parse(dataResult);
                                    console.log(result); // Log the entire parsed result

                                    if (result.statusCode === 200) {
                                        showToast('success', 'Feature updated successfully');
                                    } else {
                                        showToast('error', 'Feature not updated successfully');
                                    }
                                } catch (e) {
                                    console.error('Error parsing JSON:', e);
                                    console.log('Original dataResult:', dataResult);
                                }
                            }
                        });
                    }
                } else {
                    alert('Please select a type');
                }
            }
            $('#enterInformationModal').modal('hide');
            drawSource.clear();
        }

        function clearDrawSource() {
            drawSource.clear()
        }

        function clearEditSource() {
            editSource.clear()
        }

        // FUNCTION TO START EDIT FEATURES
        function startedit() {
            var editdrawLayer = new ol.layer.Vector({
                source: editSource,
                wrapX: false
            })
            map.addLayer(editdrawLayer);

            selectInt = new ol.interaction.Select({
                wrapX: false
            });
            modi = new ol.interaction.Modify({
                features: selectInt.getFeatures()
            });
            modi.on('modifyend', function(e) {
                var features = e.features.getArray();
                console.log("num of fetaures", features.length);
                for (var i = 0; i < features.length; i++) {
                    console.log("feature revision", features[i].getRevision())
                }
                console.log(features)
                var geoJSONformat = new ol.format.GeoJSON();
                var featuresGeojson = geoJSONformat.writeFeaturesObject(features);
                var geojsonFeatureArray = featuresGeojson.features;
                console.log(geojsonFeatureArray)
                for (var i = 0; i < geojsonFeatureArray.length; i++) {
                    geoms = JSON.stringify(geojsonFeatureArray[i].geometry);
                    console.log(geoms);
                    feature_id = geojsonFeatureArray[i].properties.feature_id;
                    console.log("Feature ID:", feature_id);

                }
            })

            $('#confirmModal').modal('hide')

            map.addInteraction(modi);
            map.addInteraction(selectInt);

            FlagisModifyOn = true
            document.getElementById('editbtn').innerHTML = '<i class="fa-solid fa-circle-stop"></i>'
        }

        // SAVE MODIFIED FEATURE TO DATABASE
        function saveModitodb() {
            var newgeom = geoms
            var Id = feature_id
            console.log(newgeom)
            console.log(Id)

            $.ajax({
                url: 'https://group68.towntechinnovations/MAP/save_to_database/savemodi.php',
                type: 'POST',
                data: {
                    feature_id_ofgeom: Id,
                    stringofgeom: newgeom
                },
                success: function(dataResult) {
                    try {
                        var result = JSON.parse(dataResult);
                        console.log(result); // Log the entire parsed result

                        if (result.statusCode === 200) {
                            console.log(' feature updated successfully');
                        } else {
                            console.log(' feature not updated successfully');
                        }
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                        console.log('Original dataResult:', dataResult);
                    }
                }
            });
            //close the modal
            $('#confirmFeatureModal').modal('hide')

            refresh()
        }



        // SAVE ADDED SHOP INFO TO DB
        function saveShopInfotodb() {
            // Get form data
            var O_name = $("#O_name").val();
            var O_age = parseInt($("#O_age").val());
            var O_gender = $("#O_gender").val();
            var O_permit = $("#O_permit")[0].files[0]; // Access the file input and get the first file
            var O_barangay_no = $("#shop_barangayNo").val();
            var O_feature_id = $("#shop_featureID").val();

            // Create FormData object to send file data along with other form data
            var formData = new FormData();
            formData.append("O_name", O_name);
            formData.append("O_age", O_age);
            formData.append("O_gender", O_gender);
            formData.append("O_permit", O_permit);
            formData.append("O_barangay_no", O_barangay_no);
            formData.append("O_feature_id", O_feature_id);

            // Send AJAX request
            $.ajax({
                type: "POST",
                url: "https://group68.towntechinnovations.com/save_to_database/saveShopInfo.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function(dataResult) {
                    try {
                        var result = JSON.parse(dataResult);
                        console.log(result); // Log the entire parsed result

                        if (result.statusCode === 200) {
                            showToast('success', 'Feature updated successfully');
                        } else {
                            showToast('error', 'Feature not updated successfully');
                        }
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                        console.log('Original dataResult:', dataResult);
                    }
                }
            });

            $('#addShopInfo').modal('hide');
        }

        // FUNCTION TO SHOW NOTIFICATION/TOAST
        function showToast(type, message) {
            var toastElement = document.getElementById('liveToast');
            toastElement.querySelector('.toast-body').textContent = message;
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        }

        // Function to handle editing shop info
function editShopInfo(OwnerID) {
  document.getElementById('deleteOwnerID').value = OwnerID;
  $('#deleteOwner').modal('show');
  $('#viewMoreShopInfo').modal('hide'); 
 
  
}

function deleteOwner(){
 $('#deleteOwner').modal('hide');
  var OwnerID = $("#deleteOwnerID").val();
  console.log(OwnerID);

    // Send AJAX request
    $.ajax({
      type: "POST",
      url: "https://group68.towntechinnovations.com/save_to_database/deleteOwner.php",
      data: {Owner_ID: OwnerID,
      },
      success: function(dataResult) {
        try {
          var result = JSON.parse(dataResult);
          console.log(result); // Log the entire parsed result
  
          if (result.statusCode === 200) {
            showToast('success', 'Shop Owner Deleted Successfully');
          } else {
            showToast('error', 'Shop Owner Deleted Unsuccessfully');
          }
        } catch (e) {
          console.error('Error parsing JSON:', e);
          console.log('Original dataResult:', dataResult);
        }
      
      }

    });

}

function closeModal(){
    $('#deleteOwner').modal('hide');
}


// FUNCTION TO SHOW NOTIFICATION/TOAST
function showToast(type, message) {
        var toastElement = document.getElementById('liveToast');
        toastElement.querySelector('.toast-body').textContent = message;
        var toast = new bootstrap.Toast(toastElement);
        toast.show();
      }   


        </script>

</body>

</html>