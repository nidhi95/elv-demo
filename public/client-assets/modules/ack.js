/**
 * Created by tejaswi.tandel on 10/20/2016.
 */
var Ack = angular.module('Ack', []);
modules.push('Ack');

Ack.controller('AckCtrl', function ($scope, AckService, $timeout) {
    var vm = this;
    $timeout(function () {
        var search_data = (window.location.search).split('?');
        vm.order_no = angular.copy(search_data[search_data.length - 1]);
    });

});


Ack.service('AckService', function () {
    return {};
});