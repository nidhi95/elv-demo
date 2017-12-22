@extends('index')

@section('content')
    <div class="header-vertical-container">
        <div class="collections-main-banner-left in-detail-collection">
            <div class="banner-inner">
                <div class="banner-overly">
                    <div class="banner-over-content2">
                        <div class="collection-logo-banner animated zoomIn">
                            <img src="/client-assets/img/collections/sweet-heart/logo.png" class="max-collection"
                                 alt="">
                        </div>
                    </div>
                    <img src="/client-assets/img/collections/hover-overly.png" alt="">
                </div>
                <img src="/client-assets/img/collections/sweet-heart/banner.jpg" alt="">
            </div>
        </div>

        <section class="collection collection-set collection-block-img">
            <div class="row margin-scroll">
                <div class="col-sm-12">
                    <div class="content-inside" style="padding: 30px 0; padding-top: 15px;">
                        <div class="desc">
                            <p>My heart is yours. Today and always. Our bond is pure and true. When the arrow struck,
                                from the cupid's bow. I knew it was sent from you.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="collection-set collection-block-img indetail-img">
            <div class="row margin-scroll">
                <div class="col-sm-offset-2 col-sm-4 margin-b-30">
                    <img src="/client-assets/img/collections/sweet-heart/thumb/SweetHeart_01.jpg" alt="">
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6 margin-b-30">
                                    <img src="/client-assets/img/collections/sweet-heart/thumb/SweetHeart_02.jpg" alt="">
                                </div>
                                <div class="col-sm-6 margin-b-30">
                                    <img src="/client-assets/img/collections/sweet-heart/thumb/SweetHeart_03.jpg" alt="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 margin-b-30">
                                    <img src="/client-assets/img/collections/sweet-heart/thumb/SweetHeart_04.jpg" alt="">
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
                    <a href="/collection-detail/limelight" class="collections_img lime-light"></a>
                    <a href="/collection-detail/stella" class="collections_img stella" style="border: none"></a>
                </div>
            </div>
        </div>

    </div>
@endsection