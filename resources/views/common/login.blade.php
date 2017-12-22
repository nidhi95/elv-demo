<div class="fd-login-register-layer">
    <div class="fd-login-register-close-container">
        <button type="button" id="fd-login-register-close" class="sprite sprite-gallery-zoom-close-light">
            <span>Close</span></button>
    </div>


    <div class="col-sm-6 login">
        <div class="fd-fieldcontainer fd-dark-field">
            <form id="command" class="js_fd-validate" action="/ii/login.html?originUrl=" method="POST"
                  autocomplete="off">
                <input name="_pecid" value="3dee321f-3508-4fc1-8172-a3a1b84be7de" type="hidden"/>

                <input type="hidden" name="originUrl" value="/ii/login.html"/>
                <div class="wrap">
                    <h3>Log in</h3>

                    <p>Please enter your e-mail and password to sign in to your account</p>

                    <label class="fake-input">
                        <span class="fake-placeholder">Email</span>

                        <input type="email" name="mgnlUserId" class="form-control email" data-empty="Email is required"
                               data-wrong-email="Email is required" value=""/>
                    </label>
                    <label class="fake-input">
                        <span class="fake-placeholder">Password</span>


                        <input type="password" name="mgnlUserPSWD" class="form-control password"
                               data-empty="Please check the password"/>
                    </label>
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <label>
                                <a href="#" class="underline" data-toggle="modal" data-target="#forgot-pwd">
                                    Forgot your password?
                                </a>
                            </label>
                        </div>
                        <div class="col-sm-6 text-right">
                            <div class="checkbox">
                                <label>

                                    <input type="checkbox" name="fendiRememberMe"/>
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-inverted btn-lg btn-md btn-sm">
                    Log in
                </button>
            </form>
        </div>
    </div>
</div>
