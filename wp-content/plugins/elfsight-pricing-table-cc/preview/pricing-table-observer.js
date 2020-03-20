/*
    Elfsight Pricing Table
    Version: 2.3.0
    Release date: Wed Jul 25 2018

    https://elfsight.com

    Copyright (c) 2018 Elfsight, LLC. ALL RIGHTS RESERVED
*/

(function (eapps) {

    eapps.observer = function ($scope, properties, $rootScope) {
        $scope.$watch('widget.data.layout', function () {
            if ($scope.widget.data.layout === 'table') {
                setVisibility('head', true, properties);
            } else {
                setVisibility('head', false, properties);
            }
        });

        $scope.$watch('widget.data.mainColor', function (newValue, oldValue) {
            if ($scope.widget.data.mainColor) {
                $scope.widget.data.columns.forEach(function(column, index) {
                    if (!$scope.widget.data.columns[index].mainColor) {
                        $scope.widget.data.columns[index].mainColor = $scope.widget.data.mainColor;
                    }

                    if (($scope.widget.data.mainColor || $scope.widget.data.mainColor === '') &&
                        ($scope.widget.data.columns[index].mainColor === oldValue)) {
                        $scope.widget.data.columns[index].mainColor = $scope.widget.data.mainColor;
                    }
                });
            }
        });

        if ($rootScope) {
            $rootScope.$watch('currentComplex', function () {
                if ($rootScope.currentComplex) {
                    $scope.widget.data.columns.forEach(function(column, index) {
                        if ($rootScope.currentComplex.priceCurrency || $rootScope.currentComplex.priceCurrency === '') {
                            $scope.widget.data.columns[index].priceCurrency = $rootScope.currentComplex.priceCurrency;
                        }
                    });

                    setVisibility('ribbonGroup', $rootScope.currentComplex.isFeatured === true, properties);
                    setVisibility('buttonTextColor', $rootScope.currentComplex.buttonType === "filled", properties);
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