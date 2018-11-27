/*-------------------------------------------
	Page - Connections
-------------------------------------------*/

	/* global Modernizr */
	/* global google */
	/* global MapBrowserData */
	/* global templateurl */

	Site.modules.AlumniMap = (function($, Site) {

		var $map,
			map,
			mapStyles = [
				{
					"featureType": "all",
					"elementType": "all",
					"stylers": [
						{
							"visibility": "off"
						}
					]
				},
				{
					"featureType": "road",
					"elementType": "geometry",
					"stylers": [
						{
							"visibility": "off"
						}
					]
				},
				{
					"featureType": "road",
					"elementType": "labels.text",
					"stylers": [
						{
							"visibility": "off"
						}
					]
				},
				{
					"featureType": "transit.station",
					"elementType": "all",
					"stylers": [
						{
							"visibility": "off"
						}
					]
				},
				{
					"featureType": "landscape",
					"elementType": "geometry",
					"stylers": [
						{
							"visibility": "on"
						}
					]
				},
				{
					"featureType": "water",
					"elementType": "geometry",
					"stylers": [
						{
							"visibility": "on"
						}
					]
				},
				{
					"featureType": "poi",
					"elementType": "geometry",
					"stylers": [
						{
							"visibility": "simplified"
						}
					]
				},
				{
					"featureType": "administrative.locality",
					"elementType": "all",
					"stylers": [
						{
							"visibility": "on"
						}
					]
				},
				{
					"featureType": "administrative.neighborhood",
					"elementType": "all",
					"stylers": [
						{
							"visibility": "on"
						}
					]
				},
				{
					"featureType": "administrative.province",
					"elementType": "all",
					"stylers": [
						{
							"visibility": "on"
						}
					]
				},
				{
					"featureType": "administrative.country",
					"elementType": "all",
					"stylers": [
						{
							"visibility": "on"
						}
					]
				}
			],
			mapData,
			mapMarkers = [],
			visibleMapMarkers = [],
			mapMarker,
			mapMarkerActive,
			mapMarkerZindex = 10,
			mapBounds,
			mapCenter = {
				lat: 40.2827799,
				lng: -83.1406454
			},
			mapBoundLimits,
			validBounds,
			$infoWindow,
			$infoWindowDetails,
			$infoWindowClose,
			activeMarker,
			imageType = ".png";

		function init() {
			$map = $(".js-map");

			if ($map.length) {
				$.loadGoogleMaps(3, "@google_maps_key").done(mapReady);

				$map.on("click", ".js-map_button", function(e) {
					e.preventDefault();
					e.stopPropagation();
				});

				$infoWindow = $(".js-map_info_window");
				$infoWindowDetails = $infoWindow.find(".js-map_info_window_details");
				$infoWindowClose = $infoWindow.find(".js-map_info_window_close");

				if (Modernizr.svg) {
					imageType = ".svg";
				}
			}
		}

		function mapReady() {
			if (google && google.maps) {

				mapBoundLimits = new google.maps.LatLngBounds(
					new google.maps.LatLng(-85, -180),
					new google.maps.LatLng(85, 180)
				);

				map = new google.maps.Map($map[0], {
					minZoom: 3,
					zoom: 5,
					center: new google.maps.LatLng(mapCenter.lat, mapCenter.lng),
					disableDefaultUI: true,
					scrollwheel: false,
					zoomControl: true,
					zoomControlOptions: {
						position: google.maps.ControlPosition.RIGHT_TOP
					},
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					styles: (mapStyles) ? mapStyles : {}
				});

				validBounds = map.getBounds();

				// Create markers

				mapMarker = {
					scaledSize: new google.maps.Size(18, 18),
					origin:     new google.maps.Point(0, 0),
					anchor:     new google.maps.Point(9, 9)
				};

				mapMarkerActive = {
					url:        templateurl + "/images/marker_active" + imageType,
					scaledSize: new google.maps.Size(25, 25),
					origin:     new google.maps.Point(0, 0),
					anchor:     new google.maps.Point(12.5, 12.5)
				};

				drawMapMarkers();
			}
		}

		function drawMapMarkers() {
			if (map && $.type(MapBrowserData) !== "undefined") {
				mapBounds = new google.maps.LatLngBounds();
				mapData = MapBrowserData;

				var marker,
					active;

				for (var i = 0, count = mapData.length; i < count; i++) {
					var icon = templateurl + "/images/marker_inactive" + imageType,
						point = new google.maps.LatLng(mapData[i].latitude, mapData[i].longitude);

					marker = new google.maps.Marker({
						map: map,
						icon: $.extend({ url: icon }, mapMarker),
						position: point,
						title: mapData[i].name,
						data: mapData[i],
						zIndex: mapMarkerZindex++
					});

					google.maps.event.addListener(marker, "click", openInfoWindow);

					mapMarkers.push(marker);
					visibleMapMarkers.push(marker);

					mapBounds.extend(point);
				}

				if (active) {
					openInfoWindow.call(active);
				}

				map.fitBounds(mapBounds);

				google.maps.event.addListener(map, 'dragstart', closeInfoWindow);

				google.maps.event.addListener(map, 'bounds_changed', checkBounds);
			}
		}

		function openInfoWindow() {
			var marker = this,
				data = this.data;

			resetMarker();

			if (data) {
				var html = '';
				if (data.link && data.link !== '') {
					html += '<a href="#" class="block_link">';
				}
				if (data.image && data.image !== '') {
					html += '<figure class="alumni_map_details_figure"><img src="' + data.image + '" alt=""></figure>';
				}
				html += '<div class="alumni_map_details_wrap">';
				html += '<div class="alumni_map_details_content">';
				if (data.name && data.name !== '') {
					html += '<h3 class="alumni_map_details_name">' + data.name + '</h3>';
				}
				if (data.location && data.location !== '') {
					html += '<p class="alumni_map_details_location">' + data.location + '</p>';
				}
				if (data.title && data.title !== '') {
					html += '<p class="alumni_map_details_title">' + data.title + '</p>';
				}
				html += '</div>';
				html += '<div class="alumni_map_details_content_footer">';
				if (data.graduation && data.graduation !== '') {
					html += '<p class="alumni_map_details_degree">' + data.graduation + '</p>';
				}
				if (data.degree && data.degree !== '') {
					html += '<p class="alumni_map_details_text">' + data.degree + '</p>';
				}
				html += '</div></div></div>';
				if (data.link !== '') {
					html += '</a>';
				}

				marker.setZIndex(mapMarkerZindex);
				marker.setIcon(mapMarkerActive);

				var point = checkMapCenter(new google.maps.LatLng(data.latitude, data.longitude));
				map.panTo(point);

				activeMarker = marker;
				mapMarkerZindex++;

				$infoWindowDetails.html(html);

				$infoWindowClose.on("click", closeInfoWindow);

				$infoWindow.addClass("on");
			}
		}

		function resetMarker() {
			if (activeMarker) {
				var icon = templateurl + "/images/marker_inactive" + ".png";
				activeMarker.setIcon($.extend({ url: icon }, mapMarker));
				activeMarker = null;
			}
		}

		function closeInfoWindow() {
			if ($infoWindow.hasClass("on")) {
				$infoWindow.removeClass("on");

				setTimeout(function() {
					$infoWindowDetails.empty();
				}, 500);
			}

			resetMarker();
		}

		function checkBounds() {
			var mapBounds = map.getBounds();
			var mapNe = mapBounds.getNorthEast();
			var mapSw = mapBounds.getSouthWest();
			var center = map.getCenter();

			if( mapBoundLimits.contains(mapNe) && mapBoundLimits.contains(mapSw) ) {
				// the user is scrolling within the bounds.
				validBounds = center;
				return;
			}

			// the user has scrolled beyond the edge.
			var mapWidth = mapNe.lng() - mapSw.lng();
			var mapHeight = mapNe.lat() - mapSw.lat();
			var x = center.lng();
			var y = center.lat();
			var maxX = mapBoundLimits.getNorthEast().lng();
			var maxY = mapBoundLimits.getNorthEast().lat();
			var minX = mapBoundLimits.getSouthWest().lng();
			var minY = mapBoundLimits.getSouthWest().lat();

			// shift the min and max dimensions by 1/2 of the screen size, so the bounds remain at the edge of the screen

			maxX -= (mapWidth / 2);
			minX += (mapWidth / 2);
			maxY -= (mapHeight / 2);
			minY += (mapHeight / 2);

			if (x < minX) {
				x = minX;
			}
			if (x > maxX) {
				x = maxX;
			}
			if (y < minY){
				y = minY;
			}
			if (y > maxY){
				y = maxY;
			}

			map.panTo(new google.maps.LatLng(y, x));
		}

		function resize() {
			if (activeMarker) {
				var data = activeMarker.data;
				var point = checkMapCenter(new google.maps.LatLng(data.latitude, data.longitude));
				map.setCenter(point);
			}
		}

		function checkMapCenter(point) {
			if (Site.minWidth >= Site.minMD && Site.minWidth < Site.maxLG) {
				// http://stackoverflow.com/questions/10656743/how-to-offset-the-center-point-in-google-maps-api-v3
				var offsetx = -150;
				var offsety = 0;

				var scale = Math.pow(2, map.getZoom());

				var worldCoordinateCenter = map.getProjection().fromLatLngToPoint(point);
				var pixelOffset = new google.maps.Point( (offsetx/scale) || 0,(offsety/scale) || 0 );

				var worldCoordinateNewCenter = new google.maps.Point(
					worldCoordinateCenter.x - pixelOffset.x,
					worldCoordinateCenter.y + pixelOffset.y
				);

				point = map.getProjection().fromPointToLatLng(worldCoordinateNewCenter);
			}

			return point;
		}

		// Hook into main init routine
		Site.onInit.push(init);
		Site.onResize.push(resize);

		return {
			//
		};
	})(jQuery, Site);