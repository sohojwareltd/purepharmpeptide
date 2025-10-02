@extends('frontend.layouts.app')

@section('content')
    <main>
        <div class="framer"
            style="background-color: rgb(243, 243, 248);
                    margin: 5px;
                    border-radius: 10px;
                    padding: 8px;">
            <div class="text" style="justify-content: center;display: flex;font-weight: bold;color: #6d7582">Need help? Text
                us,
                and a team member
                will reply in mins <br>
                <samp style="color: rgb(27, 119, 177); margin-left: 5px;">example@example.com</samp>
            </div>
        </div>
        <section class="hero-section"
            style="background: linear-gradient(180deg, var(--token-a409bc3c-6abc-43a1-9adf-53ef9b45db63, rgb(250, 250, 250)) 0%, var(--token-a6d10e5a-39b6-4177-b1c3-03a50ebc7f8b, rgb(243, 243, 248)) 100%);
                        opacity: 1;
                        border-radius: 8px;
                        margin:12px;">
            <div class="hero-section__content" style="border-radius:10px;">
                <article class="text-center">
                    <h1>Pure-Pharm-Peptides</h1>
                    <p>Proudly synthesized by industry <br> leading scientists</p>
                    <a class="mt-5" href="{{ route('products.index') }}">SHOP PEPTIDES</a>
                </article>
                <figure>
                    <img src="{{ asset('assets/peptideHero.png') }}" alt="Peptides"
                        style="max-width:340px;border-radius:12px;">
                </figure>
            </div>
        </section>

        <section class="features-marquee">
            <div class="marquee-container">
                <div class="marquee-content">
                    {{-- Original --}}
                    <div class="marquee-group">
                        <div class="feature-item">✅ Fast and Discreet Shipping</div>
                        <div class="feature-item">✅ Affordable Pricing</div>
                        <div class="feature-item">✅ 24/7 Support</div>
                        <div class="feature-item">✅ Shipped in the USA</div>
                        <div class="feature-item">✅ Quality-assured Ingredients</div>
                    </div>

                    {{-- 1st Duplicate --}}
                    <div class="marquee-group">
                        <div class="feature-item">✅ Fast and Shipping</div>
                        <div class="feature-item">✅ Affordable Pricing</div>
                        <div class="feature-item">✅ 24/7 Support</div>
                        <div class="feature-item">✅ Shipped in the USA</div>
                        <div class="feature-item">✅ Quality-assured Ingredients</div>
                    </div>

                    {{-- 2nd Duplicate --}}
                    <div class="marquee-group">
                        <div class="feature-item">✅ Fast and Discreet Shipping </div>
                        <div class="feature-item">✅ Affordable Pricing</div>
                        <div class="feature-item">✅ 24/7 Support</div>
                        <div class="feature-item">✅ Shipped in the USA</div>
                        <div class="feature-item">✅ Quality-assured Ingredients</div>
                    </div>
                </div>
            </div>
        </section>
        <section class="products-section">
            <h2>Our Peptides</h2>
            <div class="products-marquee">
                <div class="products-track">
                    @foreach ($products as $product)
                        <div class="product-item">
                            <x-product-card :product="$product" />
                        </div>
                    @endforeach

                </div>
                <div class="text-center mt-4">
                    <a class="btn btn-primary" href="{{ route('products.index') }}">View All Products</a>
                </div>
            </div>
        </section>
        <section class="container py-5">

            <div class="row g-4">

                <!-- Left Card -->
                <div class="col-lg-6">
                    <div class="promo-card d-flex flex-column justify-content-between h-100 gradient-left text-white">
                        <div>
                            <h4 class="fw-bold">Verified compounds.<br>Ready to ship.</h4>
                            <p class="text-light">highest purity.</p>
                            <a href="{{ route('products.index') }}" class="promo-btn">View products</a>
                        </div>
                    </div>
                </div>

                <!-- Right Card -->
                <div class="col-lg-6">
                    <div class="promo-card d-flex flex-column justify-content-between h-100 gradient-right text-white">
                        <div>
                            <h4 class="fw-bold">Over many peptides available.<br>Manufactured in the USA.</h4>
                            <p>Proudly crafted in the USA to the highest research standards.</p>
                            <a href="{{ route('products.index') }}" class="promo-btn">Shop Now</a>
                        </div>
                    </div>
                </div>

            </div>

        </section>



        <section class="section">
            <div class="container">
                <h2 class="section-title">How It Works</h2>

                <div class="row g-4">
                    <!-- Step 1 -->
                    <div class="col-md-4">
                        <div class="how-it-works-card">
                            <div class="step-number">1</div>
                            <div class="icon-wrapper">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <h3>Order in seconds</h3>
                            <p>Create and place orders with our intuitive platform designed for researchers.</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="col-md-4">
                        <div class="how-it-works-card">
                            <div class="step-number">2</div>
                            <div class="icon-wrapper">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <h3>Fast & reliable shipping</h3>
                            <p>Same-day dispatch with tracking for all your lab needs.</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="col-md-4">
                        <div class="how-it-works-card">
                            <div class="step-number">3</div>
                            <div class="icon-wrapper">
                                <i class="fas fa-headset"></i>
                            </div>
                            <h3>Get support anytime</h3>
                            <p>24/7 chat support with scientific experts ready to assist you.</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-5 pt-5">
                    <div class="col-lg-10 mx-auto">
                        <div class="why-choose-us">
                            <div class="decoration-circle circle-1"></div>
                            <div class="decoration-circle circle-2"></div>
                            <div class="guarantee-badge">Quality<br>Guaranteed</div>

                            <h2 class="text-center mb-4">Why choose Direct Peptides?</h2>
                            <p class="text-center lead">At Direct Peptides, we're committed to supporting scientific
                                research with the highest quality compounds available.</p>

                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <ul class="feature-list">
                                        <li>Manufactured in FDA-registered facilities in the USA</li>
                                        <li>Rigorous HPLC testing for purity verification</li>
                                        <li>Comprehensive certificates of analysis</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="feature-list">
                                        <li>99% minimum purity guarantee</li>
                                        <li>Transparent manufacturing processes</li>
                                        <li>Trusted by research institutions worldwide</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <span class="purity-badge">99% Purity Guaranteed</span>
                            </div>

                            <p class="text-center mt-4">This ensures researchers receive consistent, high-quality materials
                                backed by full transparency and trusted lab standards.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Section -->
        <section class="contact-section">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center text-lg-start">
                    <!-- Left side -->
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <h2>Text us, our dedicated team is here to help</h2>
                        <p>Reach out and get a response within minutes.</p>
                        <a href="mailto:example@example.com" class="phone-number"><i
                                class="bi bi-envelope me-2"></i>example@example.com</a>

                    </div>
                    <!-- Right side -->
                    <div class="col-lg-6 text-center">
                        <div class="phone-gradient">
                            <h3>24/7 Live Chat</h3>
                            <p>Quick answers from our support team.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>




        <hr class="container">

        <!-- FAQ Section -->
        <section class="faq-section container">
            <h2 class="text-center mb-4">Frequently Asked Questions</h2>
            <div class="accordion custom-accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            What are peptides and how do they work?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                        <div class="accordion-body">
                            Peptides are short chains of amino acids that occur naturally in organisms,
                            where they act as messengers in many biological systems.
                            Some are developed for medical use, while laboratory research focuses on
                            their cellular-level activity.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Does my order come with instructions?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                        <div class="accordion-body">
                            Orders are for research use only and do not include medical instructions.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            How long do products take to deliver?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
                        <div class="accordion-body">
                            Typical delivery time is 3–7 business days depending on your location.
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Newsletter Section -->
        <x-product.newsletter-section />


    </main>
@endsection
