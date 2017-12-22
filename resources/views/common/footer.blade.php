<footer id="footer" class="footer footer-content">
    <div class="footer-set-pad">
        <div class="row">
            <div class="col-sm-6">
                <form name="newsLtrSubscription" ng-submit="vm.newsLetterSubscription(vm.subscribeEmail)">
                <h3>Subscribe to our Newsletter</h3>

                <div class="fake-input">
                    <input placeholder="Enter your email address" type="email" name="email" class="email"
                    ng-model="vm.subscribeEmail">
                    <button type="submit">SUBSCRIBE</button>
                </div>
                </form>
            </div>
            <div class="col-sm-6 text-right fd-foot-social">
                <div class="">
                    <span>Follow Elvee: </span>
                    <ul class="fd-social-list">
                        <li>
                            <a href="https://www.facebook.com/elveejewels" target="_blank"
                               class="sprite sprite-social-facebook"></a>
                        </li>
                        <li>
                            <a href="https://twitter.com/elvee_jewels" target="_blank"
                               class="sprite sprite-social-twitter"></a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/elvee_jewels" target="_blank"
                               class="sprite sprite-social-instagram"></a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/channel/UC_CByG-BScuNfP_FQLQopbQ" target="_blank"
                               class="sprite sprite-social-youtube-channel"></a>
                        </li>
                        <li>
                            <a href="https://in.pinterest.com/elvee_jewels" target="_blank"
                               class="sprite sprite-social-pinterest"></a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/in/elvee-jewels-private-limited-182ab9135" target="_blank" class="sprite sprite-social-linkdin"></a>
                        </li>
                        {{--<li>
                            <a class="sprite sprite-social-google-plus"></a>
                        </li>
                        <li>
                            <a class="sprite sprite-social-spotify"></a>
                        </li>--}}
                    </ul>
                </div>
                <div class="fd-foot-baguetteApp">
                    <span>Elvee App:</span>
                    <ul class="fd-social-list">
                        <li>
                            <a href="https://itunes.apple.com/in/app/elvee/id1198123795?mt=8" target="_blank"
                               class="sprite sprite-social-app-store"></a>
                        </li>
                        <li>
                            <a href="https://play.google.com/store/apps/details?id=com.coruscate.elvee&hl=it" target="_blank"
                               class="sprite sprite-social-android"></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>

    </div>
    <div class="fd-foot-note">
        <div class="col-sm-6">
            &copy; 2016 Elvee Design. All Rights Reserved.
        </div>
        <div class="col-sm-6 text-l">
            Design by <a href="http://www.coruscate.in/" target="_blank">Coruscate Solutions</a>
        </div>
        <div class="clearfix"></div>
    </div>
</footer>