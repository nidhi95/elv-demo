<div {{--ng-controller="CollectionDetailCtrl as vm"--}}>
    <div class="header-vertical-container">
        <div class="collections-main-banner-left in-detail-collection">
            <div class="banner-inner">
                <div class="banner-overly">
                    <div class="banner-over-content2">
                        <div class="collection-logo-banner animated zoomIn">
                            <img ng-src="<%  vm.collection.prefix_by  + vm.collection.logo %>"
                                 class="max-collection"
                                 alt="<%vm.collection.name%>">
                        </div>
                    </div>
                    <img src="/client-assets/img/collections/hover-overly.png" alt="">
                </div>
                <img ng-src="<%  vm.collection.prefix_by  +vm.collection.headerImage %>"
                     alt="<%vm.collection.name%>">
            </div>
        </div>

        <section class="collection collection-set collection-block-img">
            <div class="row margin-scroll">
                <div class="col-sm-12" ng-if="vm.collection.longDescription.length">
                    <div class="content-inside" style="padding: 30px 0; padding-top: 15px;">
                        <div class="desc">
                            <p ng-bind="vm.collection.longDescription"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="collection-set collection-block-img indetail-img">
            <div class="row margin-scroll">
                <div class="col-sm-offset-2 col-sm-4  margin-b-30">
                    <img ng-src="<%  vm.collection.prefix_by  +vm.collection.detailMainImage %>"
                         alt="<% vm.collection.name %>">
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">

                                <div class="col-sm-6 margin-b-30"
                                     ng-repeat="img in vm.collection.detailSubImages">
                                    <img ng-src="<% vm.collection.prefix_by + img.path %>" alt="">
                                </div>
                                <div class="col-sm-6">
                                    <a href="/login">
                                        <img src="/client-assets/img/collections/lime-light/thumb/5.jpg" alt="">
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
                       style="background: url(<% vm.collection.prefix_by+ collect.logo %>) no-repeat;"
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