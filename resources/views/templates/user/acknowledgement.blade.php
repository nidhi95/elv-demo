@extends('index')

@section('content')

    <script src="/client-assets/modules/ack.js"></script>
    <div class="header-vertical-container" ng-controller="AckCtrl as vm">
        <div class="content" style="padding-bottom: 0 !important;">
            <div class="fd-bordered-container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Thank you for your order!</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="top-left-shadow"></div>
            <div class="bottom-right-shadow"></div>

            <div class="fd-wishlist-product">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="split-box-card">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="inner-block">
                                        <div class="acknowledgement">
                                            <h3>Your Order Reference <span>#<% vm.order_no %></span></h3>

                                            <div class="contact-block">
                                                <p>A copy of your Order invoice has been sent to <span>
                                                        <% userId %></span>
                                                </p>

                                                <p>For further queries related to your order please call us on
                                                    <span>0261 6105100 </span></p>

                                                <a href="/product"
                                                   class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag">
                                                    Explore More Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>


@endsection