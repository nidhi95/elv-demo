@extends('index')

@section('content')
    <div class="header-vertical-container">
        <div class="collections-main-banner-left in-detail-collection">
            <div class="banner-inner">
                <div class="banner-overly">
                    <div class="banner-over-content2">
                        <div class="collection-logo-banner animated zoomIn">
                            <img src="/client-assets/img/collections/lattice/logo.png" class="max-collection" alt="">
                        </div>
                    </div>
                    <img src="/client-assets/img/collections/hover-overly.png" alt="">
                </div>
                <img src="/client-assets/img/collections/lattice/banner2.jpg" alt="">
            </div>
        </div>

        <section class="collection collection-set collection-block-img">
            <div class="row margin-scroll">
                <div class="col-sm-12">
                    <div class="content-inside" style="padding: 30px 0; padding-top: 15px;">
                        <div class="desc">
                            <p>Experience the start of being the style sensation by coordinating up your most loved
                                attire with this precious diamond studded and lattice work created jewels. The elvee
                                lattice accumulation is an alluring, cool and pleasantly made jewels which is awesome
                                for your favorite. This very much created jewels can be an astounding present for
                                anybody inside your budget. This piece of jewelry accompanies the elvee affirmation of
                                value and toughness. We, at elvee, take care of every part of adornments.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="collection-set collection-block-img indetail-img">
            <div class="row margin-scroll">
                <div class="col-sm-offset-2 col-sm-4 margin-b-30">
                    <img src="/client-assets/img/collections/lattice/thumb/Lattice_01.jpg" alt="">
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6 margin-b-30">
                                    <img src="/client-assets/img/collections/lattice/thumb/Lattice_02.jpg" alt="">
                                </div>
                                <div class="col-sm-6 margin-b-30">
                                    <img src="/client-assets/img/collections/lattice/thumb/Lattice_03.jpg" alt="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 margin-b-30">
                                    <img src="/client-assets/img/collections/lattice/thumb/Lattice_04.jpg" alt="">
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
                    <a href="/collection-detail/limelight" class="collections_img lime-light"></a>
                    <a href="/collection-detail/stella" class="collections_img stella"></a>
                    <a href="/collection-detail/the-sweet-heart" class="collections_img sweet-heart" style="border: none"></a>
                </div>
            </div>
        </div>

    </div>
@endsection