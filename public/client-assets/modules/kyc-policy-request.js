/**
 * Created by tejaswi.tandel on 8/25/2017.
 */
var KycPolicyRequest = angular.module('KycPolicyRequest', []);
modules.push('KycPolicyRequest');

KycPolicyRequest.controller('KycPolicyRequestCtrl', function ($scope, $timeout,
                                                              kycPolicyStatus, ELVEE_ADMIN,
                                                              KycPolicyRequestService) {
    var vm = this;
    $timeout(function () {
        //get token from url
        var token = _.last((window.location.search).split('token='));
        vm.current_token = angular.copy(token);
        vm.imgFormat = ['jpeg', 'jpg', 'png', 'bmp', 'tiff', 'gif'];
        vm.getKycDetailFromTokenFn();
    });
    vm.img_url = ELVEE_ADMIN.URL;

    vm.approve = kycPolicyStatus.APPROVED;
    vm.reject = kycPolicyStatus.REJECTED;
    /**
     * Get Kyc details by using token
     */
    vm.getKycDetailFromTokenFn = function () {

        KycPolicyRequestService.policyDetails({token: vm.current_token}).success(function (res) {
            vm.no_data = !res.flag;
            if (res.flag) {
                vm.policyDetail = res.data.policy ? res.data.policy : undefined;
            } else {
                // $scope.setFlash('e', res.message);
                vm.errorMsg = res.message;
            }
        });
    };

    /**
     * policy update Function
     * @param status (approve/reject)
     */
    vm.policyUpdateFn = function (status) {
        var obj = {token: vm.current_token, status: status, remark: vm.remark};
        if (vm.uploaded_files && vm.uploaded_files.length) {
            var attach = [];
            _.each(vm.uploaded_files, function (file) {
                attach.push(_.pick(file, 'path'));
            });
            obj.attachments = (attach && attach.length) ? angular.copy(attach) : undefined;
        }
        if (vm.checkRemark && (!vm.remark || !vm.remark.length)) {
            $scope.setFlash('e', 'Please Enter Remark !');
        } else {
            KycPolicyRequestService.policyStatusUpdate(obj).success(function (res) {
                vm.no_data = !res.flag;
                if (res.flag) {
                    window.location.href = "/thank-you";
                } else {
                    $scope.setFlash('e', res.message);

                }
            });
        }

    }

    /**
     * File upload function
     */
    /**
     * File / image upload function
     * @param ele (file path
     */
    vm.uploaded_files = [];
    vm.fileUploadFn = function (ele) {
        if (ele.files[0]) {

            if (ele.files[0]) {
                var i = 0;
                var fd = new FormData();
                fd.append('folder', 'policy');
                _.each(ele.files, function (img) {
                    var img_fd = '';
                    var img_file = img;
                    fd.append('files', img_file);
                    i++;
                });
            }
            KycPolicyRequestService.uploadDocs(fd).success(function (res) {
                if (res.flag) {
                    var uploaded_files = (res.data.resources && res.data.resources.length) ? res.data.resources : [];

                    _.each(uploaded_files, function (file) {
                        var file_type = (_.last((file).split('.'))).toLowerCase();
                        var is_image_file = _.contains(vm.imgFormat, file_type);
                        vm.uploaded_files.push({file: (vm.img_url + file), is_image: is_image_file, path: file});
                    });
                    $scope.setFlash('s', res.message);
                } else {
                    $scope.setFlash('e', res.message);
                }
            })
        }
    }

    /**
     * Remove image
     * @param indx
     */
    vm.removeImgFn = function (indx) {
        vm.uploaded_files.splice(indx, 1);
    }


});

KycPolicyRequest.controller('AddKycPolicyRequestCtrl', function (KycPolicyRequestService) {
    var vm = this;

});


KycPolicyRequest.service('KycPolicyRequestService', function ($http, ELVEE_ADMIN) {
    return {
        policyDetails: function (obj) {

            return $http.post((ELVEE_ADMIN.URL) + 'customer/user/token-check', obj)
        },
        policyStatusUpdate: function (obj) {
            return $http.post((ELVEE_ADMIN.URL) + 'customer/user/update-status', obj)
        },
        uploadDocs: function (obj) {
            return $http.post((ELVEE_ADMIN.URL) + 'files-upload', obj, {
                transformRequest: angular.identity,
                headers: {
                    'Content-Type': undefined
                }
            })
        }
    };
});