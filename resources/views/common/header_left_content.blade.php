<div class="header-vertical scrollbar" data-spy="affix" data-offset-top="0" data-offset-bottom="216">
    <header class="bp-header cf">
        <div class="navbar-logo">
            <a class="navbar-logo-wrap" href="/">
                <img class="navbar-logo-img logo2-disply" src="/client-assets/img/logo-default.png" alt="Ark">
                <img class="navbar-logo-img logo-disply" src="/client-assets/img/logo-default2.png" alt="Ark">
            </a>
        </div>
    </header>
    <button class="action action--open" aria-label="Open Menu"><span class="icon icon--menu"></span></button>
    <nav id="ml-menu" class="menu">
        <button class="action action--close" aria-label="Close Menu"><span class="icon icon--cross"></span></button>
        <div class="menu__wrap">
            <ul data-menu="main" class="menu__level">
                <li class="menu__item" ng-show="categories && categories.length">
                    <a class="menu__link" data-submenu="submenu-1">Jewellery</a>
                </li>
                <li class="menu__item"><a class="menu__link" href="/" id="home">THE MAISON</a></li>
                <li class="menu__item">
                    <a class="menu__link" data-submenu="submenu-2" id="collection">Collections</a>
                </li>
                @if(isset($webModules) && count($webModules))
                    @foreach($webModules as $key=>$module)

                        @if(isset($module['subMenus']) && count($module['subMenus']))
                            <li class="menu__item">
                                <a class="menu__link menu-module-with-submenu"
                                   id="{{$module['code']}}"
                                   data-submenu="submenu-{{$module['_id']}}">
                                    {{$module['title']}}
                                </a>
                            </li>
                        @else
                            <li class="menu__item">
                                <a class="menu__link" href="web-content/{{$module['code']}}"
                                   id="{{$module['code']}}">{{$module['title']}}</a>
                            </li>
                        @endif

                    @endforeach
                @else
                    <li class="menu__item">
                        <a class="menu__link" href="/essence-of-beauty" id="essence-of-beauty">ESSENCE OF BEAUTY</a>
                    </li>
                    <li class="menu__item">
                        <a class="menu__link" href="/our-craft" id="our-craft">OUR CRAFT</a>
                    </li>
                    <li class="menu__item"><a class="menu__link" data-submenu="submenu-3" id="the-company">DRIVE DE
                            ELVEE</a>
                    </li>
                @endif
                <li class="menu__item"><a class="menu__link" href="/contact" id="contact">Contact</a>
                </li>

            </ul>
            <!-- Submenu 1 -->
            <ul data-menu="submenu-1" class="menu__level">
                <li class="menu__item"
                    ng-repeat="cat in categories">
                    <a class="menu__link" href="/product#?categoryid=<% cat.name %>">
                        <span ng-bind="cat.name"></span>
                        {{--<% cat.name %>--}}
                    </a>
                </li>

                {{--<li class="menu__item" ng-if="!categories.length">
                    <h3> Loading... </h3>
                </li>--}}
            </ul>

            <ul data-menu="submenu-2" class="menu__level">

                <li class="menu__item" ng-repeat="collection in vm.collections | orderBy:'sequence'">
                    <a class="menu__link"
                       href="/collection-detail/<% collection.slug %>"
                       id="<% collection.slug %>"
                       ng-bind="collection.title"></a>
                </li>

                {{--    @if(isset($collections) && count($collections))
                        @foreach($collections as $collectt)
                            <li class="menu__item">
                                <a class="menu__link" href="/collection-detail/{{$collectt['slug']}}"
                                   id="{{$collectt['slug']}}">{{isset($collectt['title']) ? $collectt['title'] : ''}}</a>
                            </li>
                        @endforeach
                    @endif--}}

                {{-- <li class="menu__item">
                     <a class="menu__link" href="/collection-detail/lattice" id="lattice">Lattice</a>
                 </li>
                 <li class="menu__item">
                     <a class="menu__link" href="/collection-detail/limelight" id="limelight">Lime Light</a>
                 </li>
                 <li class="menu__item">
                     <a class="menu__link" href="/collection-detail/stella" id="stella">Stella</a>
                 </li>
                 <li class="menu__item">
                     <a class="menu__link" href="/collection-detail/the-sweet-heart" id="the-sweet-heart">The Sweet
                         Heart</a>
                 </li>--}}
                {{--<li class="menu__item">
                    <a class="menu__link" href="/collection/alvin" id="alvin">After Hours</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="/collection/inspiration" id="inspiration">Aurora</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="/collection/mantra" id="mantra">En Circle</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="/collection/parampara" id="parampara">Hue Legacy</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="/collection/raisa" id="raisa">Lattice</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="/collection/reevaz" id="reevaz">Lime Light</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="/collection/vedant" id="vedant">Moon Star</a>
                </li>
                <li class="menu__item">
                    <a class="menu__link" href="/collection/zaira" id="zaira">One & Only</a>
                </li>--}}
            </ul>

            @if(isset($webModules) && count($webModules))
                @foreach($webModules as $key=>$module)

                    @if(isset($module['subMenus']) && count($module['subMenus']))
                        <ul data-menu="submenu-{{$module['_id']}}" class="menu__level"
                            id="submenu-id-{{$module['code']}}">
                            @foreach($module['subMenus'] as $subMenu)
                                <li class="menu__item">
                                    <a class="menu__link"
                                       href="/web-content/{{$subMenu['code']}}?module={{$module['code']}}"
                                       id="{{$subMenu['code']}}">
                                        {{$subMenu['title']}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                @endforeach

            @else
                <ul data-menu="submenu-3" class="menu__level">

                    <li class="menu__item">
                        <a class="menu__link" href="/the-company/about" id="about">About Us</a>
                    </li>
                    <li class="menu__item">
                        <a class="menu__link" href="/the-company/our-management" id="our-management">Our Management</a>
                    </li>
                    <li class="menu__item">
                        <a class="menu__link" href="/the-company/exhibitions" id="exhibitions">Exhibitions</a>
                    </li>
                </ul>
            @endif
        </div>

        {{-- <div class="col-xs-12 fd-rg-leftPanel" style="position: absolute; top: 280px;">
             <div class="fd-fieldcontainer">
                 <form name="loginform" class="fd-rg-fields js_fd-validate" autocomplete="off">
                     <label class="fake-input">
                         <span class="fake-placeholder fastTransition fadeIn">
                             Email
                         </span>
                         <input type="email" class="fd-visible" required="">
                     </label>
                     <label class="fake-input">
                         <span class="fake-placeholder fastTransition fadeIn">
                             Password
                         </span>
                         <input type="password" class="fd-visible" required="">
                     </label>

                     <div class="fd-rg-rememberPsw">
                         <a data-toggle="modal" data-target="#forgot-pwd">
                             Forgot your password?
                         </a>
                     </div>
                     <button type="submit" class="btn btn-lg btn-md btn-sm btn-default fd-rg-btn-login" style="margin-top: 20px;">
                         Log in
                     </button>
                 </form>
             </div>

         </div>--}}

    </nav>
</div>