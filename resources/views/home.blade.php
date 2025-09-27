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
                <samp style="color: rgb(27, 119, 177); margin-left: 5px;">+88 (013) 0355-0622</samp>
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
                    <div class="promo-card bg-light d-flex flex-column justify-content-between h-100">
                        <div>
                            <h4 class="fw-bold">Verified compounds.<br>Ready to ship.</h4>
                            <p class="text-muted">HPLC-tested for 99% purity.</p>
                            <a href="#" class="promo-btn">View products</a>
                        </div>
                        <div class="mt-4">
                            <img src="https://via.placeholder.com/400x150?text=DirectPeptides+Box" alt="purepeptides Box"
                                class="promo-img">
                        </div>
                    </div>
                </div>

                <!-- Right Card -->
                <div class="col-lg-6">
                    <div class="promo-card text-white shadow-sm h-100" style="background:#2e334f;">
                        <div class="d-flex flex-column justify-content-between h-100">
                            <div>
                                <h4 class="fw-bold">Over 50 peptides available.<br>Manufactured in the USA.</h4>
                                <p class="">Proudly crafted in the USA to the highest research standards.
                                </p>
                                <a href="#" class="promo-btn">Shop Now</a>
                            </div>
                            <div class="text-end">
                                <img src="https://via.placeholder.com/120x120?text=Logo" alt="Logo" class="promo-img">
                            </div>
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
        <section class="contact-section container">
            <div class="row align-items-center">
                <!-- Left side -->
                <div class="col-lg-6 mb-4 mb-lg-0 text-lg-start text-center">
                    <h2>Text us, our dedicated team is here to help</h2>
                    <p>Reach out and get a response within minutes.</p>
                    <a href="tel:+8801303550622" class="phone-number">+88 (013) 0355-0622</a>
                    <div class="mt-4 d-flex justify-content-lg-start justify-content-center gap-3">
                        <img src="https://via.placeholder.com/150x220?text=Box" class="img-fluid product-img"
                            alt="Product Box">
                        <img src="https://via.placeholder.com/120x180?text=Vial" class="img-fluid product-img"
                            alt="Product Vial">
                    </div>
                </div>
                <!-- Right side -->
                <div class="col-lg-6 text-center">
                    <img src="https://via.placeholder.com/300x500?text=Phone+Mockup" alt="Phone Chat"
                        class="img-fluid phone-mockup">
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
        <section class="newsletter-section container my-5">
            <div class="newsletter-box p-4 p-md-5 rounded-4 text-white position-relative overflow-hidden">
                <div class="row align-items-center">
                    <!-- Left content -->
                    <div class="col-lg-7">
                        <h3 class="fw-bold">Your source for peptide research updates</h3>
                        <p class="mb-4">Get all of the latest peptide news, curated for you</p>
                        <form class="row g-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control rounded-pill" placeholder="First Name">
                            </div>
                            <div class="col-md-5">
                                <input type="email" class="form-control rounded-pill" placeholder="me@gmail.com">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary w-100 rounded-pill">Subscribe</button>
                            </div>
                        </form>
                    </div>
                    <!-- Right button -->
                    <div class="col-lg-5 text-lg-end text-center mt-4 mt-lg-0">
                        <a href="{{ route('products.index') }}" class="btn btn-primary px-4 py-2 rounded-pill">Shop
                            Now</a>
                    </div>
                </div>
                <!-- Decorative background -->
                <div class="newsletter-bg"></div>
            </div>
        </section>


    </main>
@endsection
