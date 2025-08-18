                                        <style>
                                            #map {
                                              height: 400px;
                                            }
                                            </style>
                                            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_koD8I6bqp_8E9I5J1aWkwKdTWtab9Ic&callback=initMap" type="text/javascript"></script>
                                            <script src="https://maps.googleapis.com/maps/api/js"></script>
                                            <script>
                                            var directionsDisplay;
                                            var directionsService = new google.maps.DirectionsService();
                                            var map;
                                            var endMarker;

                                            function initialize() {
                                              directionsDisplay = new google.maps.DirectionsRenderer();
                                              var Rosario = new google.maps.LatLng(-32.96444404085618,-60.62095034122467);
                                              var mapOptions = {
                                                zoom: 16,
                                                center: Rosario,
                                                mapTypeId: 'hybrid'
                                              }
                                              map = new google.maps.Map(document.getElementById("map"), mapOptions);
                                              directionsDisplay.setMap(map);
                                            }

                                            function dropPin() {
                                              // if any previous marker exists, let's first remove it from the map
                                              if (endMarker) {
                                                endMarker.setMap(null);
                                              }
                                              // create the marker
                                              endMarker = new google.maps.Marker({
                                                position: map.getCenter(),
                                                map: map,
                                                draggable: true,
                                              });
                                              copyMarkerpositionToInput();
                                              // add an event "onDrag"
                                              google.maps.event.addListener(endMarker, 'dragend', function() {
                                                copyMarkerpositionToInput();
                                              });
                                            }

                                            function copyMarkerpositionToInput() {
                                              // get the position of the marker, and set it as the value of input
                                              document.getElementById("end").value = endMarker.getPosition().lat() +','+  endMarker.getPosition().lng();
                                            }

                                            function calcRoute() {
                                              var start = document.getElementById("start").value;
                                              var end = document.getElementById("end").value;
                                              var request = {
                                                origin:start,
                                                destination:end,
                                                travelMode: google.maps.TravelMode.DRIVING
                                              };
                                              directionsService.route(request, function(result, status) {
                                                if (status == google.maps.DirectionsStatus.OK) {
                                                  directionsDisplay.setDirections(result);
                                                }
                                              });
                                            }
                                            google.maps.event.addDomListener(window, 'load', initialize);
                                            </script>
                    <div class="row">
                        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Equipo</h4>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form action="<?=base_url?>equipos/salvar" method="post" name="nuevoequipo">
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required="true">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="tipo_equipo">Tipo</label>
                                                <select class="form-control" id="tipo" name="tipo" required="true">
                                                    <?php foreach ($tipos as $tip):?>
                                                    <option value="<?=$tip['id']?>"><?=$tip['tipo']?></option>
                                                    <?php     
                                                    endforeach;
                                                    ?>
                                                </select>
                                                
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="usuarios">Usuarios</label>
                                                <input type="text" class="form-control" id="usuarios" name="usuarios" placeholder="Usuarios">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="ip">Dirección IP</label>
                                                <input type="text" class="form-control" id="ip" name="ip" placeholder="127.0.0.1">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="mac">Mac Address</label>
                                                <input type="text" class="form-control" id="mac" name="mac" placeholder="xx:xx:xx:xx:xx:xx">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="sector">Sector</label>
                                                <select class="form-control" id="sector" name="sector" required="true">
                                                    <?php foreach ($sectores as $se):?>
                                                    <option value="<?=$se['id']?>"><?=$se['sector']?></option>
                                                    <?php     
                                                    endforeach;
                                                    ?>
                                                </select>
                                                
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="descripcion">Descripción</label>
                                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-3">
                                                <label for="reparacion">Reparación</label>
                                                <input type="checkbox" name="reparacion" id="reparacion" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="ssh">ssh</label>
                                                <input type="checkbox" name="ssh" id="ssh" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="vnc">vnc</label>
                                                <input type="checkbox" name="vnc" id="vnc" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="rdp">rdp</label>
                                                <input type="checkbox" name="rdp" id="rdp" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="http">http</label>
                                                <input type="checkbox" name="http" id="http" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="https">https</label>
                                                <input type="checkbox" name="https" id="https" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="telnet">telnet</label>
                                                <input type="checkbox" name="telnet" id="telnet" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="winbox">winbox</label>
                                                <input type="checkbox" name="winbox" id="winbox" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="sector">Sector</label>
                                                <input class="form-control" id="end" name="end" required="true">
                                                <input type="button" value="Ubicar Pin!" onclick="dropPin();return false;" class="btn btn-primary mt-3"> Ubica el marcador donde esta el equipo!
                                            </div>
                                        </div>
                                        <div id="map"></div>

                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>