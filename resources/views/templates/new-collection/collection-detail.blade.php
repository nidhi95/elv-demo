@extends('index')

@section('content')

    <style>
        .br-none {
            border: none !important;
        }
    </style>
    <script src="/client-assets/modules/collection.js"></script>
    {{--ng-controller="CollectionDetailCtrl as vm"--}}
    @if(isset($collection) && $collection != null)
        <div ng-controller="CollectionDetailCtrl as vm">
            <div class="header-vertical-container">
                <div class="collections-main-banner-left in-detail-collection">
                    <div class="banner-inner">
                        <div class="banner-overly">
                            <div class="banner-over-content2">
                                <div class="collection-logo-banner animated zoomIn">
                                    <img src="{{($collection['logo']) ? ELVEE_ADMIN_URL.$collection['logo'] : ''}}"
                                         class="max-collection"
                                         alt="{{$collection['title']}}">
                                </div>
                            </div>
                            <img src="/client-assets/img/collections/hover-overly.png" alt="">
                        </div>
                        <img src="{{($collection['detailHeaderImage']) ? (ELVEE_ADMIN_URL.$collection['detailHeaderImage']) : ''}}"
                             alt="{{$collection['title']}}">
                    </div>
                </div>

                <section class="collection collection-set collection-block-img">
                    <div class="row margin-scroll">
                        @if(isset($collection['longDescription']))
                            <div class="col-sm-12">
                                <div class="content-inside" style="padding: 30px 0; padding-top: 15px;">
                                    <div class="desc">
                                        <p>{{$collection['longDescription']}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>


                <section class="collection-set collection-block-img indetail-img">
                    <div class="row margin-scroll">
                        @if(isset($collection['detailMainImage']))
                            <div class="col-sm-offset-2 col-sm-4  margin-b-30">
                                <img src="{{($collection['detailMainImage']) ? (ELVEE_ADMIN_URL.$collection['detailMainImage']) : ''}}"
                                     alt="{{$collection['title']}}">
                            </div>
                        @endif
                        @if(isset($collection['detailSubImages']) && count($collection['detailSubImages']))
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            @foreach($collection['detailSubImages'] as $subImg)
                                                <div class="col-sm-6 margin-b-30">
                                                    <img src="{{($subImg['path']) ? (ELVEE_ADMIN_URL.$subImg['path']) : ''}}"
                                                         alt="{{$collection['title']}}">
                                                </div>
                                            @endforeach
                                            <div class="col-sm-6">
                                                <a href="/login">
                                                    <img src="/client-assets/img/collections/lime-light/thumb/5.jpg"
                                                         alt="">
                                                </a>
                                            </div>
                                            {{--   <div class="col-sm-6 margin-b-30">
                                                   <img src="/client-assets/img/collections/encircle/thumb/Encircle_03.jpg" alt="">
                                               </div>--}}
                                        </div>
                                        {{-- <div class="row">
                                             <div class="col-sm-6 margin-b-30">
                                                 <img src="/client-assets/img/collections/encircle/thumb/Encircle_04.jpg" alt="">
                                             </div>
                                             <div class="col-sm-6">
                                                 <a href="/login">

                                                     <img src="/client-assets/img/collections/lime-light/thumb/5.jpg" alt="">
                                                 </a>
                                             </div>
                                         </div>--}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>

                <div class="row text-center margin-scroll" ng-if="$parent.vm.collections.length">
                    <div class="col-sm-12">
                        <div class="login-to-explore">
                            <a>Explore the collection</a>
                        </div>
                    </div>
                </div>

                <div class="row margin-scroll" ng-if="$parent.vm.collections.length">

                    <div class="col-md-12">
                        <div class="collection_icon">
                            <a ng-repeat="collect in vm.all_collection"
                               ng-if="collect.slug != vm.collection.slug"
                               style="background: url(<% vm.collection.prefix_by + collect.logo %>) no-repeat;"
                               href="/collection-detail/<% collect.slug %>"
                               class="collections_img <% $last ? 'br-none' : '' %>"></a>
                            {{-- <a href="/collection-detail/limelight" class="collections_img lime-light"></a>
                             <a href="/collection-detail/stella" class="collections_img stella"></a>
                             <a href="/collection-detail/the-sweet-heart" class="collections_img sweet-heart"
                                style="border: none"></a>--}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif
@endsection