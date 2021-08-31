@extends('layouts.app')

@section('content')
<section class="pb-5">
    <div class="container pt-5 px-5">
        <!-- Privacy Policy -->
        <div class="text-center mb-4">
            <h1 class="color_b rounded-lg text-dark py-2 px-3 my-0">Frequently Asked Questions (FAQ)</h1>
        </div>

        <div class="text-dark">
            {!! ($companyData && $companyData->faq != '0') ? $companyData->faq : '' !!}
        </div>
        <!-- FAQ -->
        {{-- <div class="card">
            <div class="card-header text-dark text-center text-white color_b h4">Frequently Asked Questions (FAQ)</div>
            <div class="card-body px-5 py-4">
                <h3 class="text-dark">General FAQs :</h3>
                <!--Accordion wrapper-->
                <div class="accordion md-accordion" id="accordionEx1" role="tablist" aria-multiselectable="true">
                    <!-- Accordion card -->
                    <div class="card border-top border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingOne1">
                            <a data-toggle="collapse" data-parent="#accordionEx1" href="#collapseOne1"
                                aria-expanded="true" aria-controls="collapseOne1">
                                <h5 class="text-white font-weight-normal mb-0">
                                    What is OPLLY and how does it works?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
                            data-parent="#accordionEx1">
                            <div class="card-body text-dark">
                                OPLLY is online platform, operates by OPLLY app Ltd through website and app. OPLLY works personalized or promotional video message from your favorite celebrity and talent. You can place a request to us for a celebrity or talent video using our website/app. To make a request, open the OPLLY website/app, select your favorite celebrity or talent, type your message and make the payment.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingOne2">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#collapseOne2"
                                aria-expanded="false" aria-controls="collapseOne2">
                                <h5 class="text-white font-weight-normal mb-0">
                                    What is OPLLY mission?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseOne2" class="collapse" role="tabpanel" aria-labelledby="headingOne2"
                            data-parent="#accordionEx1">
                            <div class="card-body text-dark">
                                OPLLY mission is to create two-way personalize engagement with celebrity/talent and their fans globally.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingOne3">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#collapseOne3"
                                aria-expanded="false" aria-controls="collapseOne3">
                                <h5 class="text-white font-weight-normal mb-0">
                                    How do I contact the OPLLY team?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseOne3" class="collapse" role="tabpanel" aria-labelledby="headingOne3"
                            data-parent="#accordionEx1">
                            <div class="card-body text-dark">
                                For any further query please feel free to contact us here: hello@oplly.com. We will get back to you as soon as possible.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingOne4">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#collapseOne4"
                                aria-expanded="false" aria-controls="collapseOne4">
                                <h5 class="text-white font-weight-normal mb-0">
                                    How can I work at OPLLY?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseOne4" class="collapse" role="tabpanel" aria-labelledby="headingOne4"
                            data-parent="#accordionEx1">
                            <div class="card-body text-dark">
                                We’re always hunting for skilled and experienced character! To view carrier openings, email at job@oplly.com
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->
                </div>
                <!-- Accordion wrapper -->
                <h3 class="text-dark mt-4">Customer FAQs :</h3>
                <!--Accordion wrapper-->
                <div class="accordion md-accordion" id="accordionEx2" role="tablist" aria-multiselectable="true">
                    <!-- Accordion card -->
                    <div class="card border-top border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingTwo1">
                            <a data-toggle="collapse" data-parent="#accordionEx2" href="#collapseTwo1"
                                aria-expanded="true" aria-controls="collapseTwo1">
                                <h5 class="text-white font-weight-normal mb-0">
                                    How much does it cost for an OPLLY Video?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseTwo1" class="collapse show" role="tabpanel" aria-labelledby="headingTwo1"
                            data-parent="#accordionEx2">
                            <div class="card-body text-dark">
                                The cost of OPLLY video is set individually by each of the celebrity/talent in the OPLLY online platform; therefore, the price will be varying on which celebrity/talent you request for! The price is shown on the celebrity/talent’s image before you make your request. Celebrity/talent can change their price at any time, but you will be charged that price effect when you book your OPLLY video. If your request has expired (for example, the talent becomes unavailable for a short period of time, and the talent has increased the booking price when they become available again), you would pay the new (latest price) booking price.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingTwo2">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx2" href="#collapseTwo2"
                                aria-expanded="false" aria-controls="collapseTwo2">
                                <h5 class="text-white font-weight-normal mb-0">
                                    How do I buy an OPLLY video?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2"
                            data-parent="#accordionEx2">
                            <div class="card-body text-dark">
                                <ul>
                                    <li>Register/Login as an OPLLY user using OPLLY app or website and create your personal profile.</li>
                                    <li>OPLLY directs you to choose your favourite celebrity/talent from OPLLY directory on the homepage. You can easily browse through the app or website and search for your favourite celebrities/talent by various profession featured categories in the homepage such as 'Actors', Actresses', 'Singer', 'Athletes' like this.</li>
                                    <li>Once you have chosen your celebrity/talent, you need to fill out some particulars regarding the message. Give a brief description of your video message including-what do you wish them to convey on your behalf. You will be asked about the recipient, the occasion of celebration, and any pointers to help build your personalized or promotional video message.</li>
                                    <li>Once your request is accepted, it will be responded within 7-15 days. In case your request is not answered within the stipulated time, it will expire and a refund will be initiated.</li>
                                    <li>You requested video will be appear in your inbox and can be shared with ease on other social media platforms.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingTwo3">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx2" href="#collapseTwo3"
                                aria-expanded="false" aria-controls="collapseTwo3">
                                <h5 class="text-white font-weight-normal mb-0">
                                    Can I update or change my request after I already booked an OPLLY video?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseTwo3" class="collapse" role="tabpanel" aria-labelledby="headingTwo3"
                            data-parent="#accordionEx2">
                            <div class="card-body text-dark">
                                Yes! Using the link in your confirmation email or login into your profile on OPLLY, you can edit or cancel your order at any time before your OPLLY video has been completed.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingTwo4">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx2" href="#collapseTwo4"
                                aria-expanded="false" aria-controls="collapseTwo4">
                                <h5 class="text-white font-weight-normal mb-0">
                                    How long will my OPLLY video request take to be completed?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseTwo4" class="collapse" role="tabpanel" aria-labelledby="headingTwo4"
                            data-parent="#accordionEx2">
                            <div class="card-body text-dark">
                                It will be responded within 7-15 days. In case your request is not answered within the stipulated time, it will expire and a refund will be initiated.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingTwo5">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx2" href="#collapseTwo5"
                                aria-expanded="false" aria-controls="collapseTwo5">
                                <h5 class="text-white font-weight-normal mb-0">
                                    Am I guaranteed that the talent I select will make my requested an OPLLY video?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseTwo5" class="collapse" role="tabpanel" aria-labelledby="headingTwo5"
                            data-parent="#accordionEx2">
                            <div class="card-body text-dark">
                                Unfortunately we cannot guarantee that an OPLLY video request will be completed but we strive to provide a level of service to our clients to complete their request.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingTwo6">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx2" href="#collapseTwo6"
                                aria-expanded="false" aria-controls="collapseTwo6">
                                <h5 class="text-white font-weight-normal mb-0">
                                    How will I receive my OPLLY video once it’s completed?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseTwo6" class="collapse" role="tabpanel" aria-labelledby="headingTwo6"
                            data-parent="#accordionEx2">
                            <div class="card-body text-dark">
                                A email link will be sent to your email and a confirmation text will be sent to your contact number that you will provided when you OPLLY video will be completed.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingTwo7">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx2" href="#collapseTwo7"
                                aria-expanded="false" aria-controls="collapseTwo7">
                                <h5 class="text-white font-weight-normal mb-0">
                                    Can I download and keep my OPLLY video?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseTwo7" class="collapse" role="tabpanel" aria-labelledby="headingTwo7"
                            data-parent="#accordionEx2">
                            <div class="card-body text-dark">
                                Yes you can! If you are on a laptop or desktop, your OPLLY video can be downloaded via the link we emailed or texted you, just press the blue download button next to the video. If you received your Oplly video via the app, you can download it from the top right-hand corner. You have a non-commercial and personal license (Oplly watermark) to use it forever, subject to the (Site Terms of Service) link.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingTwo8">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx2" href="#collapseTwo8"
                                aria-expanded="false" aria-controls="collapseTwo8">
                                <h5 class="text-white font-weight-normal mb-0">
                                    When will I be charged for my Oplly personalized video?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseTwo8" class="collapse" role="tabpanel" aria-labelledby="headingTwo8"
                            data-parent="#accordionEx2">
                            <div class="card-body text-dark">
                                Once you complete request for your order you will be directed to our online payment portal to complete your payment. You must complete your payment during payment direction otherwise your request for your order will be cancelled or removed from Oplly. You can pay us through debit/credit card any mobile wallet account. To see your payment options please visit the link.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingTwo9">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx2" href="#collapseTwo9"
                                aria-expanded="false" aria-controls="collapseTwo9">
                                <h5 class="text-white font-weight-normal mb-0">
                                    What if I have already been charged, but haven’t received my Oplly personalized video yet?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseTwo9" class="collapse" role="tabpanel" aria-labelledby="headingTwo9"
                            data-parent="#accordionEx2">
                            <div class="card-body text-dark">
                                If your Oplly video was booked in the last 15 days but you haven’t received it yet, please feel free to contact hello@oplly.com for refund. The payment amount will be refund between next 7 working days to your desired account. N.B: A minimum transaction charge will be deducted from the payment amount during refund initiate.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->
                </div>
                <!-- Accordion wrapper -->
                <h3 class="text-dark mt-4">Oplly Customer Referral Program FAQs :</h3>
                <!--Accordion wrapper-->
                <div class="accordion md-accordion" id="accordionEx3" role="tablist" aria-multiselectable="true">
                    <!-- Accordion card -->
                    <div class="card border-top border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingThree1">
                            <a data-toggle="collapse" data-parent="#accordionEx3" href="#collapseThree1"
                                aria-expanded="true" aria-controls="collapseThree1">
                                <h5 class="text-white font-weight-normal mb-0">
                                    How can I earn credit from referring a friend to Oplly?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree1" class="collapse show" role="tabpanel" aria-labelledby="headingThree1"
                            data-parent="#accordionEx3">
                            <div class="card-body text-dark">
                                As a registered Oplly user, you can earn promo credits when a friend or family member that you have invited (who hasn’t previously registered or purchased a Oplly personalized video) uses your Oplly provided referral link to register on our site and purchases a paid Oplly personalized video price at any amount. The first step is to share your Oplly referral link with your friend or family member. Next, they need to sign-up with your referral link and purchase a paid Oplly video priced at at any amount. Once the order is completed (e.g., Oplly personalized video is fulfilled), we’ll send you an email confirmation and promo credit will be placed in your Oplly app to use on your next order.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingThree2">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx3" href="#collapseThree2"
                                aria-expanded="false" aria-controls="collapseThree2">
                                <h5 class="text-white font-weight-normal mb-0">
                                    How can I earn credit from signing up with Oplly?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree2" class="collapse" role="tabpanel" aria-labelledby="headingThree2"
                            data-parent="#accordionEx3">
                            <div class="card-body text-dark">
                                If you are a new and first time user, you can earn promo credit towards your paid Oplly personalized video by signing up with a referral link shared by a friend or family member who is an existing user.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingThree3">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx3" href="#collapseThree3"
                                aria-expanded="false" aria-controls="collapseThree3">
                                <h5 class="text-white font-weight-normal mb-0">
                                    How do I see my Oplly credit balance?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3"
                            data-parent="#accordionEx3">
                            <div class="card-body text-dark">
                                Log in to Oplly on the web or app and visit your account page to see your current credit balance.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingThree4">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx3" href="#collapseThree4"
                                aria-expanded="false" aria-controls="collapseThree4">
                                <h5 class="text-white font-weight-normal mb-0">
                                    What is the difference between a promotional Oplly video and a personal Oplly video?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree4" class="collapse" role="tabpanel" aria-labelledby="headingThree4"
                            data-parent="#accordionEx3">
                            <div class="card-body text-dark">
                                A Promotional Oplly video can be used to promote a company/organization/product on the company’s website and Facebook, Instagram, LinkedIn and Twitter accounts. You can see the terms specific to Promotional Oplly videos here. A personal Oplly video can be used only for personal, non-promotional, and non-commercial use. You can see terms for personal Oplly videos here.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingThree5">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx3" href="#collapseThree5"
                                aria-expanded="false" aria-controls="collapseThree5">
                                <h5 class="text-white font-weight-normal mb-0">
                                    How long can I use my Promotional Oplly video?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree5" class="collapse" role="tabpanel" aria-labelledby="headingThree5"
                            data-parent="#accordionEx3">
                            <div class="card-body text-dark">
                                A Promotional Oplly video can be used for 90 days from the date you have received. At the end of the 90 days the rights to the video automatically expire unless otherwise agreed. If you want to extend your license date, please contact to hello@oplly.com before expiration.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingThree6">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx3" href="#collapseThree6"
                                aria-expanded="false" aria-controls="collapseThree6">
                                <h5 class="text-white font-weight-normal mb-0">
                                    Can anyone purchase a Promotional Oplly video?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree6" class="collapse" role="tabpanel" aria-labelledby="headingThree6"
                            data-parent="#accordionEx3">
                            <div class="card-body text-dark">
                                Of course, you must have the right to make the purchase on behalf of the organization and be able to give permission to use any organization names, trademarks, brand etc. that you want included in the Promotional Oplly video.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingThree7">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx3" href="#collapseThree7"
                                aria-expanded="false" aria-controls="collapseThree7">
                                <h5 class="text-white font-weight-normal mb-0">
                                    Where Promotional Oplly videos can’t be used?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree7" class="collapse" role="tabpanel" aria-labelledby="headingThree7"
                            data-parent="#accordionEx3">
                            <div class="card-body text-dark">
                                Promotional Oplly videos cannot be used to promote a company/organization/product that is the subject which is not conform with the local law or that is involved in, connected with, or promotes illegal or unlawful activity, violence or hate speech.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingThree8">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx3" href="#collapseThree8"
                                aria-expanded="false" aria-controls="collapseThree8">
                                <h5 class="text-white font-weight-normal mb-0">
                                    Where can I post my Promotional Oplly video?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree8" class="collapse" role="tabpanel" aria-labelledby="headingThree8"
                            data-parent="#accordionEx3">
                            <div class="card-body text-dark">
                                Promotional Oplly videos can promote your company/organization/product on the company’s own website and the company’s “official” Facebook, Instagram, LinkedIn, TikTok and Twitter social media channels/pages.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingThree9">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx3" href="#collapseThree9"
                                aria-expanded="false" aria-controls="collapseThree9">
                                <h5 class="text-white font-weight-normal mb-0">
                                    Does the watermark have to stay on a Promotional Oplly video?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree9" class="collapse" role="tabpanel" aria-labelledby="headingThree9"
                            data-parent="#accordionEx3">
                            <div class="card-body text-dark">
                                Yes. Oplly watermark must remain visible on all Promotional Oplly or even Personal videos and cannot be removed, altered, modified, covered or cropped.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingThree10">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx3" href="#collapseThree10"
                                aria-expanded="false" aria-controls="collapseThree10">
                                <h5 class="text-white font-weight-normal mb-0">
                                    How fast do I get a completed Promotional Oplly video?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree10" class="collapse" role="tabpanel" aria-labelledby="headingThree10"
                            data-parent="#accordionEx3">
                            <div class="card-body text-dark">
                                We always strive to ensure the best customer experience so far, that’s why Oplly takes maximum 7 working days to complete the Promotional Oplly video.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingThree11">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx3" href="#collapseThree11"
                                aria-expanded="false" aria-controls="collapseThree11">
                                <h5 class="text-white font-weight-normal mb-0">
                                    How many characters are available in making a request?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree11" class="collapse" role="tabpanel" aria-labelledby="headingThree11"
                            data-parent="#accordionEx3">
                            <div class="card-body text-dark">
                                All Oplly requests must fit within the 250 character limit.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingThree12">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx3" href="#collapseThree12"
                                aria-expanded="false" aria-controls="collapseThree12">
                                <h5 class="text-white font-weight-normal mb-0">
                                    Can I edit the content in a Promotional Oplly video?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree12" class="collapse" role="tabpanel" aria-labelledby="headingThree12"
                            data-parent="#accordionEx3">
                            <div class="card-body text-dark">
                                Please be insure that all Oplly videos must be posted unedited to ensure information is not taken out of context.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingThree13">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx3" href="#collapseThree13"
                                aria-expanded="false" aria-controls="collapseThree13">
                                <h5 class="text-white font-weight-normal mb-0">
                                    Which celebrity/talent accept Promotional Oplly video requests?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree13" class="collapse" role="tabpanel" aria-labelledby="headingThree13"
                            data-parent="#accordionEx3">
                            <div class="card-body text-dark">
                                You can browse a list of our talent who are currently opted into offering Promotional Oplly video with pricing.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingThree14">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx3" href="#collapseThree14"
                                aria-expanded="false" aria-controls="collapseThree14">
                                <h5 class="text-white font-weight-normal mb-0">
                                    What happens if I am unhappy with my completed Promotional Oplly video?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree14" class="collapse" role="tabpanel" aria-labelledby="headingThree14"
                            data-parent="#accordionEx3">
                            <div class="card-body text-dark">
                                A Promotional Oplly video may not be returned or exchanged and non-refunds will be issued.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingThree15">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx3" href="#collapseThree15"
                                aria-expanded="false" aria-controls="collapseThree15">
                                <h5 class="text-white font-weight-normal mb-0">
                                    Can I send my product to celebrity/talent before he/she promote it?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree15" class="collapse" role="tabpanel" aria-labelledby="headingThree15"
                            data-parent="#accordionEx3">
                            <div class="card-body text-dark">
                                Products cannot be sent from customer to celebrity/talent for safety purposes. You are responsible for any information that you provide to celebrity/talent. Please make sure everything is factually correct and not misleading, is not disparaging or defamatory, and will allow celebrity/talent to offer their own true opinion.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card border-bottom-0 border-left border-right border-light">
                        <!-- Card header -->
                        <div class="card-header border-bottom border-light special-color-dark rounded" role="tab" id="headingThree16">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx3" href="#collapseThree16"
                                aria-expanded="false" aria-controls="collapseThree16">
                                <h5 class="text-white font-weight-normal mb-0">
                                    What else do I need to know?
                                    <i class="fas fa-angle-down rotate-icon float-right"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree16" class="collapse" role="tabpanel" aria-labelledby="headingThree16"
                            data-parent="#accordionEx3">
                            <div class="card-body text-dark">
                                You can always review our Site Terms of Service as well as the Additional Terms for Promotional Oplly videos and Privacy Policy for additional information.
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->
                </div>
                <!-- Accordion wrapper -->
            </div>
        </div> --}}
    </div>
</section>
@endsection