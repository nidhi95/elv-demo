<div class="modal fade" id="forgot-pwd" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"></button>
                <h2 class="modal-title" id="myModalLabel">Forgot your password?</h2>
            </div>
            <div id="forgotPasswordStep1" class="modal-body">
                <p>
                    Please enter the email address you registered with. We will send you a link for changing your
                    password.
                </p>

                <div class="row fd-fieldcontainer">
                    <form name="forgotPswd" ng-submit="vm.forgotPasswordFn(vm.forgot_email)">
                        <div class="col-sm-12">
                            <label class="fake-input">
                                <span class="fake-placeholder">Email</span>
                                <input type="email" name="email" ng-model="vm.forgot_email"/>
                            </label>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-lg btn-md btn-sm btn-default">
                                <img ng-if="vm.show_loading" src="/client-assets/img/load-xs.gif"> Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>