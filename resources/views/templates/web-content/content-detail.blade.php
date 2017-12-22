@extends('index')

@section('content')

    <div class="header-vertical-container">

        <div class="promo-block-v9 full-width-container">
            <div class="html5-video-bg about-bg spirit-of-creation essence-height"
                 style="width: 100%;
                         background: url({{isset($contentDetail['bannerImageWeb']) ? (ELVEE_ADMIN_URL.$contentDetail['bannerImageWeb']) : ''}}) no-repeat">
            </div>
            <div class="heading_a_midle">
                <h2 class="title">{{isset($contentDetail['title']) ? $contentDetail['title'] : '' }}</h2>

                <pre class="sub max-width pre-desc">
                    {{isset($contentDetail['description']) ? $contentDetail['description'] : ''}}
                </pre>
            </div>
        </div>

        @if(isset($contentDetail['contents']) && count($contentDetail['contents']))
            @foreach($contentDetail['contents'] as $key=>$content)

                {{--View with Image and desc--}}
                @if(isset($content['webImage']))
                    <section class="collection">
                        <div class="row">
                            {{--Image Block--}}
                            @if ($key % 2 == 0)
                                <div class="col-sm-6">
                                    <div class="collection-img">
                                        <img src="{{isset($content['webImage']) ? (ELVEE_ADMIN_URL.$content['webImage']) : ''}}"
                                             alt="">
                                    </div>
                                </div>
                            @endif
                            {{--Image Block--}}

                            {{--Content description--}}
                            <div class="col-sm-6">
                                <div class="content-inside">
                                    <h1>{{isset($content['title']) ? $content['title'] : ''}}</h1>

                                    @if(isset($content['description']))
                                        <div class="desc">
                                            <pre class="pre-desc">
                                                <p>
                                                    {{$content['description']}}
                                                </p>
                                            </pre>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            {{--Content description--}}

                            {{--Image Block--}}
                            @if ($key % 2 != 0)
                                <div class="col-sm-6">
                                    <div class="collection-img">
                                        <img src="{{isset($content['webImage']) ? (ELVEE_ADMIN_URL.$content['webImage']) : ''}}"
                                             alt="">
                                    </div>
                                </div>
                            @endif
                            {{--Image Block--}}
                        </div>
                    </section>
                @else
                    <section class="collection {{$key % 2 == 0 ? 'exhibition_gray' : 'exhibition'}} ">
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="exhibition_content">
                                    <h1>{{isset($content['title']) ? $content['title'] : ''}}</h1>

                                    @if(isset($content['description']))
                                        <div class="desc">
                                            <pre class="pre-desc">
                                                <p>
                                                    {{$content['description']}}
                                                </p>
                                            </pre>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            @endforeach
        @endif

        @if($contentDetail['code'] == 'ABOUT_US')
            <section class="collection collection-set ">
                <div class="row">
                    <div class="content-inside" style="padding-bottom: 30px; padding-top: 30px;">
                        <h2 style="margin-bottom: 0">Membership</h2>
                    </div>
                </div>
            </section>

            <div class="row">
                <div class="col-md-12">
                    <!-- Owl Carousel Clients Five Item -->
                    <ul class="list-inline text-center owl-carousel-clients-five-item clients-v1">
                        <li class="item">
                            <div class="clients-v1-item">
                                <img class="clients-v1-img clients-v1-img-default"
                                     src="../client-assets/img/member/1.jpg" alt="">
                            </div>
                        </li>
                        <li class="item">
                            <div class="clients-v1-item">
                                <img class="clients-v1-img clients-v1-img-default"
                                     src="../client-assets/img/member/2.jpg" alt="">
                            </div>
                        </li>
                        <li class="item">
                            <div class="clients-v1-item">
                                <img class="clients-v1-img clients-v1-img-default"
                                     src="../client-assets/img/member/3.jpg" alt="">
                            </div>
                        </li>

                        <li class="item">
                            <div class="clients-v1-item">
                                <img class="clients-v1-img clients-v1-img-default"
                                     src="../client-assets/img/member/4.jpg" alt="">
                            </div>
                        </li>
                    </ul>
                    <!-- End Owl Carousel Clients Five Item -->
                </div>
            </div>
        @endif
    </div>
    {{--ABOUT_US--}}
@endsection