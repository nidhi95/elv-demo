@extends('index')

@section('content')
    <div class="header-vertical-container">
        <div class="collections-main-banner-left in-detail-collection">
            <div class="banner-inner">
                <div class="banner-overly">
                    <div class="banner-over-content2">
                        <div class="collection-logo-banner animated zoomIn">
                            <img src="/client-assets/img/collections/lime-light/logo.png" class="max-collection" alt="">
                        </div>
                    </div>
                    <img src="/client-assets/img/collections/hover-overly.png" alt="">
                </div>
                <img src="/client-assets/img/collections/lime-light/banner.jpg" alt="">
            </div>
        </div>

        <section class="collection collection-set collection-block-img">
            <div class="row margin-scroll">
                <div class="col-sm-12">
                    <div class="content-inside" style="padding: 30px 0; padding-top: 15px;">
                        <div class="desc">
                            <p>Stylish and trendy , the LIMELIGHT collection draws inspiration from new generation.
                                Free-flowing shapes –oval, circles , square and straight lines – weave their way through
                                the design to create a minimalistic yet enchanting appeal. The LIMELIGHT collection
                                perfectly complements she who is edgy, trendy and smart, and goes well with her western
                                and ethno-contemporary ensembles. Sleek, elegant designs, crafted in gold and studded
                                with diamonds come together to make a range so stylish, they won’t be able to get their
                                eyes off of you!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="collection-set collection-block-img indetail-img">
            <div class="row margin-scroll">
                <div class="col-sm-offset-2 col-sm-4 margin-b-30">
                    <img src="/client-assets/img/collections/lime-light/thumb/LimeLight_01.jpg" alt="">
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6 margin-b-30">
                                    <img src="/client-assets/img/collections/lime-light/thumb/LimeLight_02.jpg" alt="">
                                </div>
                                <div class="col-sm-6 margin-b-30">
                                    <img src="/client-assets/img/collections/lime-light/thumb/LimeLight_03.jpg" alt="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 margin-b-30">
                                    <img src="/client-assets/img/collections/lime-light/thumb/LimeLight_04.jpg" alt="">
                                </div>
                                <div class="col-sm-6">
                                    <a href="/login">
                                        <img src="/client-assets/img/collections/lime-light/thumb/5.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="row text-center margin-scroll">
            <div class="col-sm-12">
                <div class="login-to-explore">
                    <a>Explore the collection</a>
                </div>
            </div>
        </div>

        <div class="row margin-scroll">
            <div class="col-md-12">
                <div class="collection_icon">
                    <a href="/collection-detail/encircle" class="collections_img encircle"></a>
                    <a href="/collection-detail/lattice" class="collections_img lattice"></a>
                    <a href="/collection-detail/stella" class="collections_img stella"></a>
                    <a href="/collection-detail/the-sweet-heart" class="collections_img sweet-heart" style="border: none"></a>
                </div>
            </div>
        </div>

    </div>
@endsection