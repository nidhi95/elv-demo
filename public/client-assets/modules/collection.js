/**
 * Created by tejaswi.tandel on 5/29/2017.
 */
var Collection = angular.module('Collection', []);
modules.push('Collection');

Collection.controller('CollectionDetailCtrl', function ($scope, CollectionService, $timeout) {
    var vm = this;
    vm.collection = []; // collection details

    $timeout(function () {
        vm.all_collection = angular.copy($scope.$parent.vm.collections);
        var current_slug = _.last((window.location.pathname).split('collection-detail/'));
        vm.collection = _.findWhere($scope.$parent.vm.collections, {slug: current_slug});

    }, 500);

});


Collection.service('CollectionService', function ($http, ELVEE_ADMIN) {
    return {
        collectionList: function (obj) {
            return $http.post(ELVEE_ADMIN.URL + 'customer/collection/paginate', obj);
        }
    };
});