@extends('index')

@section('content')
    <script src="/client-assets/modules/search-product.js" ></script>
    <div ng-controller="SearchByStockCtrl as vm" loader id="loadingArea">
        <div class="header-vertical-container margin-t-10"   style="background: #f4e7dd;">
            <div class="promo-block-v9 full-width-container"
                 ng-if="!vm.showErr"
                 id="product-content">

                <div class="row margin-l-0 margin-r-0" >
                    <iframe name="stockReport"
                            style="border: 1px solid #e1d5cc !important;width: 96%;height: 600px;"
                            id="stockReport" src=""></iframe>
                </div>
            </div>

            <div class="promo-block-v9 margin-t-80 full-width-container"
                 ng-if=" vm.showErr"
                 id="product-content">
                <h3>Stock Not Found !!</h3>
            </div>
        </div>
    </div>
@endsection