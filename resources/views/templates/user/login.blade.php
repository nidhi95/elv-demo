@extends('index')

@section('content')

    <style type="text/css">
        .fake-textarea {
            width: 100%;
            background-color: #f5e9e0;
            border: none;
        }
    </style>

    <div class="header-vertical-container" ng-controller="AuthCtrl as vm">
        <div class="content" style="padding-bottom: 0 !important;">
            <div class="fd-bordered-container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Login or Registration</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">

            <div class="">
                <section class="row fd-loginContainer">


                    <div class="col-xs-6 fd-rg-leftPanel">


                        <div class="fd-rg-header">
                            <h2>Sign in to your account</h2>

                            <p>Please enter your email and password to access your account and personalised
                                services.</p>

                        </div>

                        {{--ng-init="vm.login={userId : 'martin432@orail.co.in',password:'icpmed'}"--}}
                        <div class="fd-fieldcontainer">
                            <form name="loginform" class="fd-rg-fields js_fd-validate" autocomplete="off"
                                  ng-submit="loginFn()">
                                <label class="fake-input">
                                    <span class="fake-placeholder fastTransition fadeIn">
                                        Email
                                    </span>
                                    <input type="email" ng-model="vm.login.userid"
                                           class="fd-visible" required>
                                </label>
                                <label class="fake-input">
                                    <span class="fake-placeholder fastTransition fadeIn">
                                        Password
                                    </span>

                                    <input type="password" ng-model="vm.login.password"
                                           class="fd-visible" required>
                                </label>

                                <div class="fd-rg-rememberPsw">
                                    <a data-toggle="modal" data-target="#forgot-pwd">
                                        Forgot your password?
                                    </a>
                                </div>
                                {{--<div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="fendiRememberMe">
                                        Remember me
                                    </label>
                                </div>--}}
                                <button type="submit"
                                        class="btn btn-lg btn-md btn-sm btn-default fd-rg-btn-login">
                                    <img ng-if="vm.show_loading_login" src="/client-assets/img/load-xs.gif"> Log in
                                </button>
                            </form>
                        </div>

                    </div>

                    <div class="col-xs-6 fd-rg-rightPanel text-center">

                        <div class="fd-rg-header">
                            <h2>Don't have an account?</h2>

                            <p class="login-width">
                                The Elvee provides a full range of gold rings, necklaces, bracelets, earrings and
                                pendants, set with diamonds and other precious stones, including ruby, sapphire and
                                emerald. Elvee has built its reputation on four pillars of strength like Style, Quality,
                                Innovation and Price.
                            </p>
                            <p>
                                To access our latest collections please registered yourself with the exact details in
                                the given form.
                            </p>

                        </div>

                        <div class="fd-fieldcontainer">

                            <button type="submit"
                                    ng-click="goToFn('/kyc')"
                                    class="btn btn-lg btn-md btn-sm btn-default fd-rg-btn-login">
                                <img ng-if="vm.show_loading_reg" src="/client-assets/img/load-xs.gif"> Register Now
                            </button>
                        </div>

                        {{--<div class="fd-fieldcontainer">
                            <form class="fd-rg-fields js_fd-validate" autocomplete="off">

                                <label class="fake-input">
                                    <span class="fake-placeholder fastTransition fadeIn">Email</span>
                                    <input type="email" class="fd-visible">
                                </label>
                                <label class="fake-input">
                                    <span class="fake-placeholder fastTransition fadeIn">Password</span>

                                    <input type="password" class="fd-visible">
                                </label>
                                <button type="submit" class="btn btn-lg btn-md btn-sm btn-default fd-rg-btn-login">
                                    Register Now
                                </button>
                            </form>
                        </div>--}}

                    </div>


                </section>
            </div>

        </div>
        @include('templates.user.forgot-password')

    </div>

@endsection