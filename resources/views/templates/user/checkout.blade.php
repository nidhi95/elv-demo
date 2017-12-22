@extends('index')

@section('content')
    <script src="/client-assets/modules/checkout.js"></script>
    <div class="header-vertical-container" ng-controller="CheckoutCtrl as vm">
        <div class="content" style="padding-bottom: 0 !important;">
            <div class="fd-bordered-container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Checkout</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content" loader id="loadingArea">
            <div class="top-left-shadow"></div>
            <div class="bottom-right-shadow"></div>

            <div class="fd-wishlist-product">
                <div class="row">
{{--                    @include('common.loading')--}}
                    <div class="col-sm-4 margin-b-20" ng-if="vm.address_book.length" ng-repeat="address in vm.address_book">
                        <div class="address-hight card">
                            <h3><% address.FirstName + ' '+ address.LastName %></h3>

                            <div class="user-address">
                                <% address.Address +', ' %><% address.City + (address.ZipCode ? (' -
                                '+address.ZipCode) : '') +', ' %><% address.State + ', ' + address.Country
                                %>
                                {{--73.Vijay nagar 2 soc. Yogichiwk , punagaam, Surat - 395010,Gujarat.--}}
                            </div>
                            <div class="user-address">
                                Phone: <span><% address.Mobile %></span>
                            </div>
                            <div class="buttons-set address-btn text-center">
                                <a class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag"
                                   ng-click="showModal1= !showModal1;">
                                    Continue
                                </a>

                                <confirm-delete
                                        message="Are you sure want to select this address as your shipping address ?"
                                        description="<% address.FirstName + ' ' + address.LastName%>"
                                        uib-data-toggle="tooltip"
                                        uib-tooltip="Delete"
                                        visible="showModal1"
                                        confirm-delete-fn="vm.placeOrderFn(address.id)"
                                        cancel-delete-fn="">
                                </confirm-delete>
                                {{--vm.placeOrderFn(address.id)--}}
                                {{--
                                    <a ng-click="vm.address=address;vm.saveAddressFn()"
                                                                   class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag <% address.isDefault ? 'default-btn' : ''%>">
                                                                    <% address.isDefault ? 'Default' : 'Set As Default' %>
                                                                </a>
                                --}}

                            </div>
                            <div class="address-footer">
                                <span data-toggle="modal"
                                      ng-click="vm.editFn(address)"
                                      data-target="#add-address"><i
                                            class="fa fa-edit"></i>Edit</span>

                                <confirm-delete
                                        message="Are you sure want to delete this Address ?"
                                        description="<% address.FirstName + ' ' + address.LastName%>"
                                        uib-data-toggle="tooltip"
                                        uib-tooltip="Delete"
                                        visible="showModal"
                                        confirm-delete-fn="vm.deleteAddressFn(address.id)"
                                        cancel-delete-fn="">
                                </confirm-delete>


                                <span ng-click="showModal=!showModal;"><i
                                            class="fa fa-trash"></i>Delete</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="address-hight card" ng-if="!vm.show_loading">
                            <div class="buttons-set address-btn text-center add_new">
                                <a data-toggle="modal" data-target="#add-address"
                                   class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md move-to-bag">
                                    Add new Address
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        @include('templates.user.address')
    </div>





@endsection