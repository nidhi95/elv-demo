@extends('index')

@section('content')
    <script src="/client-assets/modules/contact.js"></script>

    <div class="header-vertical-container" ng-controller="ContactCtrl as vm">

        <div class="promo-block-v9 full-width-container">
            <div class="html5-video-bg about-bg contact_bg" style="width: 100%; height: 550px;">
            </div>
            <div class="heading_a_midle">
                <h2 class="title">Contact Customer Care</h2>

                <div class="sub" style="max-width: 720px;">
                    The Maison Elvee is at your disposition to answer any of your questions.
                </div>
            </div>
        </div>

        <div class="content-md container">
            <div class="row">
                <div class="col-md-3 col-sm-6 md-margin-b-50">
                    <!-- Contacts -->
                    <div class="text-center">
                        <i class="font-size-36 color-base margin-b-20 icon-phone"></i>

                        <h3 class="font-size-20">Telephone</h3>

                        <p>+91 261 6105100</p>
                    </div>
                    <!-- End Contacts -->
                </div>
                <div class="col-md-6 col-sm-6 sm-margin-b-50">
                    <!-- Contacts -->
                    <div class="text-center">
                        <i class="font-size-36 color-base margin-b-20 icon-map-pin"></i>

                        <h3 class="font-size-20">Address</h3>

                        <p>164/Pramukh Darshan,4th Floor,<br>
                            Opp.Katargam Community Hall,Vasta Devdi Road,<br>
                            Gotalavadi,Surat-395004,Gujarat(india).
                        </p>
                    </div>
                    <!-- End Contacts -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <!-- Contacts -->
                    <div class="text-center">
                        <i class="font-size-36 color-base margin-b-20 icon-envelope"></i>

                        <h3 class="font-size-20">E-mail</h3>

                        <p>info@elvee.in</p>
                    </div>
                    <!-- End Contacts -->
                </div>
            </div>
            <!-- // end row -->
        </div>

        <div class="bg-color-sky-light">
            <div class="content-md container">
                <div class="row">
                    <div class="col-md-6 md-margin-b-30">
                        <!-- Comment Form v1 -->
                        <form class="comment-form-v1 comment-form-error contact-us-equal-height bg-color-white padding-20"
                              ng-submit="vm.sendContactMailFn()">
                            <h2 class="font-size-28 margin-b-20">Get in Touch</h2>

                            <div class="row space-row-10">
                                <div class="col-md-6 margin-b-20">
                                    <input type="text" class="form-control comment-form-v1-input"
                                           ng-model="vm.contact.name"
                                           placeholder="Your Name *" name="firstname" required>
                                </div>

                                <div class="col-md-6 margin-b-20">
                                    <input type="email" class="form-control comment-form-v1-input"
                                           ng-model="vm.contact.email"
                                           placeholder="Your Email *" name="email" required>
                                </div>
                            </div>
                            <div class="row space-row-10">
                                <div class="col-md-12 margin-b-20">
                                    <input type="text" class="form-control comment-form-v1-input"
                                           ng-model="vm.contact.subject"
                                           placeholder="Subject" name="subject">
                                </div>
                            </div>
                            <!--// end row -->

                            <div class="margin-b-20">
                                <textarea class="form-control comment-form-v1-input" rows="5"
                                          ng-model="vm.contact.message"
                                          placeholder="Your message *" name="textarea" required></textarea>
                            </div>
                            <div class="margin-b-0">
                                <button type="submit" class="btn-dark-bg-slide btn-slide btn-slide-right btn-base-md">
                                    <img ng-if="vm.contactLoading" src="/client-assets/img/load-xs.gif">  Submit
                                </button>
                            </div>
                        </form>
                        <!-- End Comment Form v1 -->
                    </div>

                    <!-- Contact Timeline -->
                    <div class="col-md-6">
                        <div class="contact-us contact-us-equal-height bg-color-white">
                            <h2 class="font-size-28 margin-b-30">We are Open at</h2>

                            <p class="margin-b-40">
                                It would be great to hear from you for help with your Order Management, or any queries.
                                Please feel free to contact us, we will be delighted to assist you with your inquiry.
                            </p>

                            <div class="row margin-b-30 md-margin-b-20">
                                <div class="col-md-3 md-margin-b-20">
                                    <span class="contact-us-timeline-day">Monday</span>
                                    <span class="contact-us-timeline-time">09am - 09pm</span>
                                </div>
                                <div class="col-md-3 md-margin-b-20">
                                    <span class="contact-us-timeline-day">Tuesday</span>
                                    <span class="contact-us-timeline-time">09am - 09pm</span>
                                </div>
                                <div class="col-md-3 md-margin-b-20">
                                    <span class="contact-us-timeline-day">Wednesday</span>
                                    <span class="contact-us-timeline-time">09am - 09pm</span>
                                </div>
                                <div class="col-md-3">
                                    <span class="contact-us-timeline-day">Thursday</span>
                                    <span class="contact-us-timeline-time">09am - 09pm</span>
                                </div>
                            </div>
                            <!--// end row -->

                            <div class="row">
                                <div class="col-md-3 md-margin-b-20">
                                    <span class="contact-us-timeline-day">Friday</span>
                                    <span class="contact-us-timeline-time">09am - 09pm</span>
                                </div>
                                <div class="col-md-3 md-margin-b-20">
                                    <span class="contact-us-timeline-day">Saturday</span>
                                    <span class="contact-us-timeline-time">09am - 09pm</span>
                                </div>
                                <div class="col-md-3 md-margin-b-20">
                                    <span class="contact-us-timeline-day">Sunday</span>
                                    <span class="contact-us-timeline-time">Closed</span>
                                </div>
                                <div class="col-md-3">
                                    <span class="contact-us-timeline-day bg-color-red">Holiday</span>
                                    <span class="contact-us-timeline-time">Closed</span>
                                </div>
                            </div>
                            <!--// end row -->
                        </div>
                    </div>
                    <!-- End Contact Timeline -->
                </div>
                <!--// end row -->
            </div>
        </div>

    </div>

@endsection