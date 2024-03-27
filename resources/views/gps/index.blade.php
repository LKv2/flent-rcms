<x-app-layout>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
       
       #map-container {
            position: relative;
            height: calc(100vh - 65px);

        }


        #carList {
            background-color: #fff;
            padding: 10px;
            overflow: auto;
        }

        #historicalRoute {
            background-color: #fff;
            padding: 10px;
            overflow:hidden;
        }
    </style>
    <div id="map-container" class="flex flex-row gap-4">
        <div id="carList" class=" w-1/5 h-full">
            <h5 class="card-header">Car List</h5>
            @include('gps.adddevice')
            <div class="card-body">
                <ul class="list-group" id="cars">
                    <!-- Car list items will be added dynamically using JavaScript -->
                </ul>
            </div>
        </div>
        <div id="map" class="w-3/5 h-full"></div>
        
        <div id="historicalRoute" class=" w-1/5 h-full">
            <h5 class="card-header">Historical Route <button type="button" id="clearRoute">clear</button></h5>
            <div class="card-body">
                <ul class="list-group overflow-y-auto" id="historicalRouteList">
                    <!-- Historical route items will be added dynamically using JavaScript -->
                </ul>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            const map = L.map('map').setView([33.570341, -7.588230], 20);
            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; Carto'
            }).addTo(map);
            map.zoomControl.remove();

            const carList = $('#cars');
            const markers = L.layerGroup().addTo(map);
            const marker = L.layerGroup().addTo(map);
            let currentDayPositions = [];
            let currentPositionIndex = 0;

            // Function to clear all markers from the map
            const clearMarkers = () => markers.clearLayers();

            const clearMarker = () => marker.clearLayers();

            const clearMap = () => {
                // Clear existing map layers
                map.eachLayer(layer => {
                    if (layer instanceof L.circleMarker || layer instanceof L.Polyline) {
                        layer.remove();
                        clearMarker();
                    }
                });
            };

            const updateFocusPosition = () => {
                clearMarker();
                const position = currentDayPositions[currentPositionIndex];
                console.log(position);
                if (position) {
                    const marker1 = L.circleMarker([position.latitude, position.longitude], {
                            color: 'blue'
                        })
                        .addTo(map)
                        .bindPopup(
                            `Position ${currentPositionIndex + 1} => Latitude: ${position.latitude}, Longitude: ${position.longitude}`
                            )
                        .addTo(marker);
                    map.setView([position.latitude, position.longitude]);
                    $('#valPosition').text(`${currentPositionIndex+1}/${currentDayPositions.length} \n ${position.time}`)
                }
            };

            const displayRouteOnMap = (routePositions) => {
                currentPositionIndex = 0;
                if (document.getElementById('navPosition')) {
                    $('#navPosition').remove();
                }
                
                const polylineCoordinates = [];
                routePositions.forEach((position, index) => {
                    const marker1 = L.circleMarker([position.latitude, position.longitude], {
                            color: 'red'
                        })
                        .addTo(map)
                        .bindPopup(
                            `Position ${index} => Latitude: ${position.latitude}, Longitude: ${position.longitude}`
                            )
                        .addTo(marker);
                    polylineCoordinates.push([position.latitude, position.longitude]);
                });

                const polyline = L.polyline(polylineCoordinates, {
                    color: 'red'
                }).addTo(map);

                if (routePositions.length > 0) {
                    const lastPosition = routePositions[routePositions.length - 1];
                    map.setView([lastPosition.latitude, lastPosition.longitude]);
                }

                const cardFooter = $('<div>').addClass('card-footer text-center').attr('id','navPosition').addClass('flex flex-row justify-between items-center');
                const btnPrevious = $('<button>').attr('type', 'button').attr('id', 'btnPrevious').addClass(
                    'btn btn-primary me-2').text('Previous');
                var currenttext = $('<p>').attr('id', 'valPosition').addClass('text-center').text(`${currentPositionIndex+1}/${routePositions.length}\n ${routePositions[0].time}`);
                    const btnNext = $('<button>').attr('type', 'button').attr('id', 'btnNext').addClass(
                    'btn btn-primary').text('Next');
                cardFooter.append(btnPrevious,currenttext, btnNext);
                $('#historicalRoute').append(cardFooter);

                btnNext.on('click', () => {
                    currentPositionIndex = Math.min(currentPositionIndex + 1, routePositions.length -
                    1);
                    updateFocusPosition();
                });

                btnPrevious.on('click', () => {
                    currentPositionIndex = Math.max(currentPositionIndex - 1, 0);
                    updateFocusPosition();
                });

                updateFocusPosition();
            };
            $('#clearRoute').on('click',()=>{
                clearMap();
                $('#navPosition').remove();
                currentPositionIndex = 0;
            });
            const updateHistoricalRouteList = (deviceId) => {
                const historicalRouteList = $('#historicalRouteList');
                

                $.ajax({
                    url: `/traccar/device/${deviceId}/historical-route`,
                    type: 'GET',
                    dataType: 'json',
                    success: (classifiedRoute) => {
                        console.log(classifiedRoute);
                        historicalRouteList.empty();
                        for (const [date, positions] of Object.entries(classifiedRoute)) {
                            const dateHeader = $('<h5>').text(`${date}`).addClass(
                                'date-header');
                            dateHeader.on('click', () => {
                                currentDayPositions = positions;
                                clearMap();
                                displayRouteOnMap(positions);
                            });
                            historicalRouteList.append(dateHeader);
                        }
                    },
                    error: (xhr, status, error) => {
                        console.error(xhr.responseText);
                    }
                });
            };

            const fetchRealTimePositions = () => {
                $.ajax({
                    url: '/traccar/devices',
                    type: 'GET',
                    dataType: 'json',
                    success: (devices) => {
                        carList.empty();
                        clearMarkers();

                        devices.forEach(device => {
                            const listItem = $('<div>').addClass(
                                'flex items-center gap-4 px-2 py-2 border-b-4 border-b-indigo-500'
                                );

                            const statusClass = (device.status === 'online') ?
                                'bg-green-500' : 'bg-red-500';
                            listItem.append($('<div>').addClass(
                                `flex w-3 h-3 me-3 ${statusClass} rounded-full`));

                            $.ajax({
                                url: `/traccar/device/${device.id}/positions`,
                                type: 'GET',
                                dataType: 'json',
                                success: (data) => {
                                    try {
                                        L.marker([data[0].latitude, data[0]
                                                .longitude
                                            ])
                                            .addTo(map)
                                            .bindPopup(device.name)
                                            .addTo(markers);
                                        listItem.unbind('click').click(function() {
                                            map.setView([data[0]
                                                .latitude, data[
                                                    0].longitude
                                            ]);
                                            clearMap();
                                            $('#navPosition').remove();
                                            updateHistoricalRouteList(
                                                device.id);

                                        });
                                    } catch (error) {}
                                },
                                error: (xhr, status, error) => {
                                    console.error(xhr.responseText);
                                }
                            });

                            listItem.append($('<span>').text(device.name));
                            carList.append(listItem);
                        });
                    },
                    error: (xhr, status, error) => {
                        console.error(xhr.responseText);
                    }
                });
            };

            fetchRealTimePositions();

            setInterval(fetchRealTimePositions, 5000);

        });
    </script>

</x-app-layout>
