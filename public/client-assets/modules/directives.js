/**
 * Created by User on 10/11/2016.
 */

var app = angular.module('appModule');
app.directive('ngConfirmClick', function () {
    return {
        link: function (scope, element, attr) {
            var msg = attr.ngConfirmClick || "Are you sure you want to delete?";
            var clickAction = attr.confirmedClick;
            element.bind('click', function (event) {
                if (window.confirm(msg)) {
                    console.log(scope);
                    scope.$apply(clickAction);
                }
                else {
                }
            });
        }
    };
})

/*Directive For Delete Confirmation*/
    .directive('confirmDelete', function () {
        return {
            template: '<div class="modal" id="DeleteModal" tabindex="-1" data-backdrop="static" aria-hidden="true">' +
            '<div class="modal-dialog" style="margin:10px auto;width:70%">' +
            '<div class="portlet box">' +
            '<div class="portlet-body">' +
            '<div class="wrapper-xs">' +
            '<div class="row">' +
            '<div class="col-sm-12" style="padding:10%">' +
            '<div class="panel panel-default" style="position: relative;">' +
            '<div class="panel-body">' +
            '<div class="form-group pull-in clearfix" style="font-size:22px">' +
            '<div class="col-md-12 wrapper-xs text-dark text-center"><span class="text-danger" style="font-size: 24px"><i class="fa fa-warning"></i></span> &nbsp; {{message}}</div>' +
            '<div class="col-md-11 m-t-xs m-l-lg text-md text-center" ng-if="description" ' +
            'style="word-break: break-all;color:#777"> {{description}}</div>' +
            '</div>' +
            '<div class="form-group pull-in clearfix">' +
            '<div class="text-right m-t">' + '<center>' +
            '<button type="submit"  ng-click = "confirmdeleteFn()" class = "btn btn-success m-r-xs" style="width:11%">  {{"Yes"}} </ button > &nbsp;' +
            '<button type="submit"  ng-click = "canceldeleteFn()" class = "btn btn-danger" style="width:11%">  {{"No"}} </ button >' +
            '</center>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>',
            restrict: 'E',
            transclude: true,
            replace: true,
            scope: true,
            link: function postLink(scope, element, attrs) {
                /*delete confirm fn*/
                scope.confirmdeleteFn = function () {
                    if (attrs.confirmDeleteFn) {
                        scope.$eval(attrs.confirmDeleteFn);
                        $(element).modal('hide');
                    }
                };

                /*cancel modal  fn*/
                scope.canceldeleteFn = function () {
                    if (attrs.cancelDeleteFn) {
                        scope.$eval(attrs.cancelDeleteFn);
                        $(element).modal('hide');
                    } else {
                        $(element).modal('hide');
                    }
                };

                scope.$watch(attrs.visible, function (value) {
                    scope.message = attrs.message || 'Are you sure want to delete ?';
                    scope.description = attrs.description;
                    if (value == true)
                        $(element).modal('show');
                    else
                        $(element).modal('hide');
                });

                $(element).on('shown.bs.modal', function () {
                    // scope.$apply(function () {
                    scope.$parent[attrs.visible] = true;
                    // });
                });

                $(element).on('hidden.bs.modal', function () {
                    //scope.$apply(function () {

                    scope.$parent[attrs.visible] = false;
                    //});
                });

                element.bind("keydown keypress", function (event) {
                    if (event.which === 27) {
                        scope.$apply(function () {
                            scope.$eval(attrs.cancelDeleteFn);
                        });
                        event.preventDefault();
                    }
                });

            }
        };
    })

    .directive('loader', ['$rootScope', '$location', '$anchorScroll', function ($rootScope, $location, $anchorScroll) {
        return {
            restrict: 'AC',
            link: function (scope, el, attrs) {
                scope.$on('startLoader', function (event) {

                    // $location.hash('app');
                    //$anchorScroll();
                    //el.addClass('loading');

                    // NIDHI
                    // $('#preloader').css('display', 'block');
                    // $('#preloader').removeAttr('opacity');
                    $('#loadingArea').addClass('section_loader');
                });
                scope.$on('stopLoader', function (event) {
                    //el.removeClass('loading');

                    // $('#preloader').css('display', 'none');

                    $('#loadingArea').removeClass('section_loader');
                });
            }
        };
    }])

    .directive('starRating',
        function () {
            return {
                restrict: 'A',
                template: '<ul class="rating">'
                + '	<li ng-repeat="star in stars" ng-class="star" ng-click="toggle($index)">'
                + '\u2605'
                + '</li>'
                + '</ul>',
                scope: {
                    ratingValue: '=',
                    max: '=',
                    onRatingSelected: '&'
                },
                link: function (scope, elem, attrs) {
                    var updateStars = function () {
                        scope.stars = [];
                        for (var i = 0; i < scope.max; i++) {
                            scope.stars.push({
                                filled: i < scope.ratingValue
                            });
                        }
                    };

                    scope.toggle = function (index) {
                        scope.ratingValue = index + 1;
                        scope.onRatingSelected({
                            rating: index + 1
                        });
                    };

                    scope.$watch('ratingValue',
                        function (oldVal, newVal) {
                            if (newVal) {
                                updateStars();
                            }
                        }
                    );
                }
            };
        }
    )

    .directive('numbersOnly', function () {
        return {
            require: 'ngModel',
            link: function (scope, element, attr, ngModelCtrl) {
                function fromUser(text) {
                    if (text) {
                        var transformedInput = text.replace(/[^0-9]/g, '');

                        if (transformedInput !== text) {
                            ngModelCtrl.$setViewValue(transformedInput);
                            ngModelCtrl.$render();
                        }
                        var transformed_Input = parseFloat(transformedInput);
                        return transformed_Input;
                    }
                    return '';
                }

                ngModelCtrl.$parsers.push(fromUser);
            }
        };
    })
;