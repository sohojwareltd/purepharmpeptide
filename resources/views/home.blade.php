@extends('frontend.layouts.app')

@section('content')
    <main>
        <div class="framer">
            <div class="text">
                Need help? Text us, and a team member will reply in email.
            </div>
            <div class="email">
                <samp>{{ setting('store.email') }}</samp>
            </div>
        </div>

        <section class="hero-section">
            <div class="hero-section__content">
                <article class="text-center">
                    <h1>{{ setting('homepage.hero_title') }}</h1>
                    <p>{{ setting('homepage.hero_subtitle') }}</p>
                    <a class="" href="{{ route('products.index') }}">{{ setting('homepage.hero_cta_text') }}</a>
                </article>
                <figure>
                    <img src="{{ Storage::url(setting('homepage.hero_image')) }}" alt="Peptides">
                </figure>
            </div>
        </section>

        <section class="features-marquee">
            <div class="marquee-container">
                <div class="marquee-content">
                    @for ($i = 0; $i < 2; $i++)
                        <div class="marquee-group">
                            @foreach (setting('homepage.features_marquee', []) as $feature)
                                <div class="feature-item">✅{{ $feature['text'] }}</div>
                            @endforeach
                        </div>
                    @endfor
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
        @php
            $promoCards = setting('homepage.promo_cards');
            $promoCards = is_array($promoCards) ? $promoCards : json_decode($promoCards ?? '[]', true);
        @endphp

        <section class="container py-5">
            <div class="row g-4">
                @foreach ($promoCards as $index => $card)
                    <div class="col-lg-6">
                        <div class="promo-card {{ $index % 2 === 0 ? 'gradient-left' : 'gradient-right' }}">
                            <h3 class="promo-title">{!! $card['title'] ?? '' !!}</h3>
                            <p class="promo-description">{!! $card['description'] ?? '' !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>




        <section class="section">
            <div class="container">
                <h2 class="section-title">How It Works</h2>
                @php
                    $howItWorks = setting('homepage.how_it_works');
                    $steps = is_string($howItWorks) ? json_decode($howItWorks, true) : $howItWorks;

                    $steps = is_array($steps) ? $steps : [];
                @endphp

                <div class="row g-4">
                    @foreach ($steps as $index => $step)
                        <div class="col-md-4">
                            <div class="how-it-works-card">
                                <div class="step-number">{{ $index + 1 }}</div>
                                <div class="icon-wrapper">
                                    @if ($index === 0)
                                        <i class="fas fa-rocket"></i>
                                    @elseif ($index === 1)
                                        <i class="fas fa-shipping-fast"></i>
                                    @else
                                        <i class="fas fa-headset"></i>
                                    @endif
                                </div>
                                <h3>{{ $step['title'] ?? '' }}</h3>
                                <p>{{ $step['description'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                @php
                    $leftFeatures = setting('homepage.why_left_features');
                    $rightFeatures = setting('homepage.why_right_features');

                    $leftFeatures = is_string($leftFeatures) ? json_decode($leftFeatures, true) : $leftFeatures;
                    $rightFeatures = is_string($rightFeatures) ? json_decode($rightFeatures, true) : $rightFeatures;

                    $leftFeatures = is_array($leftFeatures) ? $leftFeatures : [];
                    $rightFeatures = is_array($rightFeatures) ? $rightFeatures : [];
                @endphp


                <div class="row mt-5 pt-5">
                    <div class="col-lg-10 mx-auto">
                        <div class="why-choose-us">
                            <div class="decoration-circle circle-1"></div>
                            <div class="decoration-circle circle-2"></div>


                            <div class="guarantee-badge">
                                <img src="{{ Storage::url(setting('homepage.why_badge_image')) }}" alt="Badge"
                                    style="max-width:80px;">
                            </div>



                            <h2 class="text-center mb-4">
                                {{ setting('homepage.why_title') }}
                            </h2>

                            <p class="text-center lead">
                                {{ setting('homepage.why_description') }}
                            </p>


                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <ul class="feature-list">
                                        @foreach ($leftFeatures as $feature)
                                            <li>{{ $feature['text'] ?? '' }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="feature-list">
                                        @foreach ($rightFeatures as $feature)
                                            <li>{{ $feature['text'] ?? '' }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>




                            @if (setting('homepage.why_footer_text'))
                                <p class="text-center mt-4">{{ setting('homepage.why_footer_text') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </section>

        {{-- <section class="contact-section py-5">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center text-lg-start">
                    <div class="col-12 col-md-10 col-lg-6 mb-4 mb-lg-0 text-center">
                        <h2 class="fw-bold mb-3">Text us, our dedicated team is here to help</h2>
                        <p class="mb-4">Reach out and get a response within minutes.</p>
                        <a href="mailto:{{ setting('store.email') }}"
                            class="d-inline-flex align-items-center justify-content-center px-4 py-2 rounded-pill text-white bg-primary text-decoration-none shadow-sm hover-shadow-lg">
                            <i class="bi bi-envelope me-2 fs-5"></i>
                            <span class="fs-6">{{ setting('store.email') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </section> --}}





        <hr class="container">


        <section class="faq-section container">
            <h2 class="text-center mb-4">Frequently Asked Questions</h2>
            <div class="accordion custom-accordion" id="faqAccordion">
                @foreach ($faqitems as $faqitem)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $faqitem->id }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $faqitem->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $faqitem->id }}">
                                {{ $faqitem->question }}
                            </button>
                        </h2>
                        <div id="collapse{{ $faqitem->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $faqitem->id }}">
                            <div class="accordion-body">
                                {!! $faqitem->answer !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>


        <x-product.newsletter-section />


    </main>
@endsection
