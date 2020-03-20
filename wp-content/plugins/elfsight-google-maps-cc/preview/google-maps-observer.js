/*
    Elfsight Google Maps
    Version: 1.6.1
    Release date: Wed Aug 29 2018

    https://elfsight.com

    Copyright (c) 2018 Elfsight, LLC. ALL RIGHTS RESERVED
*/

(function (eapps) {
    var colorSchemes = {
        'default': {
            'colorGeometry': '',
            'colorLabelsTextFill': '',
            'colorLabelsTextStroke': '',
            'colorAdministrativeGeometryStroke': '',
            'colorAdministrativeLandParcel': '',
            'colorLandscapeNaturalGeometry': '',
            'colorPoiGeometry': '',
            'colorPoiLabelsTextFill': '',
            'colorPoiParkGeometryFill': '',
            'colorPoiParkLabelsTextFill': '',
            'colorRoadGeometry': '',
            'colorRoadArterial': '',
            'colorRoadHighway': '',
            'colorRoadHighwayGeometryStroke': '',
            'colorRoadHighwayControlledAccessGeometry': '',
            'colorRoadHighwayControlledAccessGeometryStroke': '',
            'colorRoadLocalLabelsTextFill': '',
            'colorTransitLineGeometry': '',
            'colorTransitLineLabelsTextFill': '',
            'colorTransitLineLabelsTextStroke': '',
            'colorTransitStationGeometry': '',
            'colorWaterGeometryFill': '',
            'colorWaterLabelTextFill': ''
        },
        'silver': {
            'colorGeometry': convertHex("#f5f5f5"),
            'colorLabelsTextFill': convertHex("#616161"),
            'colorLabelsTextStroke': convertHex("#f5f5f5"),
            'colorAdministrativeGeometryStroke': '',
            'colorAdministrativeLandParcel': convertHex("#bdbdbd"),
            'colorLandscapeNaturalGeometry': '',
            'colorPoiGeometry': convertHex("#eeeeee"),
            'colorPoiLabelsTextFill': convertHex("#757575"),
            'colorPoiParkGeometryFill': convertHex("#e5e5e5"),
            'colorPoiParkLabelsTextFill': convertHex("#9e9e9e"),
            'colorRoadGeometry': convertHex("#ffffff"),
            'colorRoadArterial': convertHex("#ffffff"),
            'colorRoadHighway': convertHex("#dadada"),
            'colorRoadHighwayGeometryStroke': convertHex("#dadada"),
            'colorRoadHighwayControlledAccessGeometry': convertHex("#ffffff"),
            'colorRoadHighwayControlledAccessGeometryStroke': convertHex("#ffffff"),
            'colorRoadLocalLabelsTextFill': convertHex("#9e9e9e"),
            'colorTransitLineGeometry': convertHex("#e5e5e5"),
            'colorTransitLineLabelsTextFill': convertHex("#616161"),
            'colorTransitLineLabelsTextStroke': convertHex("#f5f5f5"),
            'colorTransitStationGeometry': convertHex("#eeeeee"),
            'colorWaterGeometryFill': convertHex("#c9c9c9"),
            'colorWaterLabelTextFill': convertHex("#9e9e9e")
        },
        'night': {
            'colorGeometry': convertHex("#242f3e"),
            'colorLabelsTextFill': convertHex("#746855"),
            'colorLabelsTextStroke': convertHex("#242f3e"),
            'colorAdministrativeGeometryStroke': convertHex("#d59563"),
            'colorAdministrativeLandParcel': convertHex("#d59563"),
            'colorLandscapeNaturalGeometry': convertHex("#242f3e"),
            'colorPoiGeometry': convertHex("#263c3f"),
            'colorPoiLabelsTextFill': convertHex("#d59563"),
            'colorPoiParkGeometryFill': convertHex("#263c3f"),
            'colorPoiParkLabelsTextFill': convertHex("#6b9a76"),
            'colorRoadGeometry': convertHex("#38414e"),
            'colorRoadArterial': convertHex("#746855"),
            'colorRoadHighway': convertHex("#746855"),
            'colorRoadHighwayGeometryStroke': convertHex("#1f2835"),
            'colorRoadHighwayControlledAccessGeometry': convertHex("#f3d19c"),
            'colorRoadHighwayControlledAccessGeometryStroke': '',
            'colorRoadLocalLabelsTextFill': convertHex("#6b9a76"),
            'colorTransitLineGeometry': convertHex("#2f3948"),
            'colorTransitLineLabelsTextFill': convertHex("#d6d6d6"),
            'colorTransitLineLabelsTextStroke': convertHex("#d6d6d6"),
            'colorTransitStationGeometry': convertHex("#d59563"),
            'colorWaterGeometryFill': convertHex("#17263c"),
            'colorWaterLabelTextFill': convertHex("#515c6d")
        },
        'retro': {
            'colorGeometry': convertHex("#ebe3cd"),
            'colorLabelsTextFill': convertHex("#523735"),
            'colorLabelsTextStroke': convertHex("#f5f1e6"),
            'colorAdministrativeGeometryStroke': convertHex("#c9b2a6"),
            'colorAdministrativeLandParcel': convertHex("#ae9e90"),
            'colorLandscapeNaturalGeometry': convertHex("#dfd2ae"),
            'colorPoiGeometry': convertHex("#dfd2ae"),
            'colorPoiLabelsTextFill': convertHex("#93817c"),
            'colorPoiParkGeometryFill': convertHex("#a5b076"),
            'colorPoiParkLabelsTextFill': convertHex("#447530"),
            'colorRoadGeometry': convertHex("#f5f1e6"),
            'colorRoadArterial': convertHex("#fdfcf8"),
            'colorRoadHighway': convertHex("#f8c967"),
            'colorRoadHighwayGeometryStroke': convertHex("#e9bc62"),
            'colorRoadHighwayControlledAccessGeometry': convertHex("#e98d58"),
            'colorRoadHighwayControlledAccessGeometryStroke': convertHex("#db8555"),
            'colorRoadLocalLabelsTextFill': convertHex("#806b63"),
            'colorTransitLineGeometry': convertHex("#dfd2ae"),
            'colorTransitLineLabelsTextFill': convertHex("#8f7d77"),
            'colorTransitLineLabelsTextStroke': convertHex("#ebe3cd"),
            'colorTransitStationGeometry': convertHex("#dfd2ae"),
            'colorWaterGeometryFill': convertHex("#b9d3c2"),
            'colorWaterLabelTextFill': convertHex("#92998d")
        },
        'custom': {},
    };

    var colorKeys = ['colorGeometry', 'colorLabelsTextFill', 'colorLabelsTextStroke', 'colorAdministrativeGeometryStroke', 'colorAdministrativeLandParcel', 'colorLandscapeNaturalGeometry', 'colorPoiGeometry', 'colorPoiLabelsTextFill', 'colorPoiParkGeometryFill',
        'colorPoiParkLabelsTextFill', 'colorRoadGeometry', 'colorRoadArterial', 'colorRoadHighway', 'colorRoadHighwayGeometryStroke', 'colorRoadHighwayControlledAccessGeometry','colorRoadHighwayControlledAccessGeometryStroke','colorRoadLocalLabelsTextFill',
        'colorTransitLineLabelsTextStroke','colorTransitStationGeometry','colorWaterGeometryFill','colorWaterLabelTextFill'];
    var watchColorKeys = [];
    for (var i = 0, j = colorKeys.length; i < j; i++) {
        watchColorKeys.push('widget.data.' + colorKeys[i]);
    }
    var watchColorTimer;
    var customPrestine = true;
    var colorSchemeChanging = false;

    function convertHex(hex){
        hex = hex.replace('#','');
        r = parseInt(hex.substring(0,2), 16);
        g = parseInt(hex.substring(2,4), 16);
        b = parseInt(hex.substring(4,6), 16);

        result = 'rgba('+r+','+g+','+b+','+1+')';
        return result;
    }

    eapps.observer = function ($scope, properties, $rootScope) {
        $scope.$watch('widget.data.style', function (newValue, oldValue) {
            if (newValue !== undefined && newValue !== oldValue && newValue in colorSchemes) {
                angular.extend($scope.widget.data, colorSchemes[newValue]);
                colorSchemeChanging = true;
            }
        });

        $scope.$watchGroup(watchColorKeys, function (newValues, oldValues) {
            if (!colorSchemeChanging) {
                customPrestine = false;
            }

            clearTimeout(watchColorTimer);

            watchColorTimer = setTimeout(function () {
                if (newValues !== undefined && newValues !== oldValues) {
                    // don't change the custom scheme colors if any color was changed before
                    if ((customPrestine && colorSchemeChanging) || (!customPrestine && !colorSchemeChanging)) {
                        for (var i = 0, j = colorKeys.length; i < j; i++) {
                            colorSchemes['custom'][colorKeys[i]] = newValues[i];
                        }
                    }

                    if (!colorSchemeChanging && $scope.widget.data.style !== 'custom') {
                        $scope.widget.data.style = 'custom';
                    }

                    colorSchemeChanging = false;
                }
            }, 300);
        });

        if ($rootScope) {
            var auto = false;

            $rootScope.$watch('currentComplex', function (currentComplex) {
                if (currentComplex) {
                    setVisibility('iconUrl', (currentComplex.icon && currentComplex.icon === 'custom'), properties);
                    setVisibility('infoWindowOpenedByDefault', currentComplex.infoWindow, properties);
                }

                if (currentComplex && currentComplex.position && currentComplex.position !== '') {
                    var zoom = $scope.widget.data.zoom;
                    var markersCnt = $scope.widget.data.markers.length;

                    if((zoom === '16' || zoom === 16) && !auto && markersCnt > 1) {
                        $scope.widget.data.zoom = 'auto';

                        auto = true;
                    }
                }
            }, true);


        }
    };

    var setVisibility = function(id, value, properties) {
        properties.forEach(function(property, index) {
            if (property.id === id) {
                properties[index].visible = value;
                return false;
            }

            if (property && property.properties) {
                setVisibility(id, value, property.properties);
            }

            if (property.complex && property.complex.properties) {
                setVisibility(id, value, property.complex.properties);
            }

            if (property.subgroup && property.subgroup.properties) {
                setVisibility(id, value, property.subgroup.properties);
            }
        });
    };
})(window.eapps = window.eapps || {});