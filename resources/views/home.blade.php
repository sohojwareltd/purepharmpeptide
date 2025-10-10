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
                <samp style="color: rgb(27, 119, 177); margin-left: 5px;">{{ setting('store.email') }}</samp>
            </div>
        </div>
        <section class="hero-section"
            style="background: linear-gradient(180deg, var(--token-a409bc3c-6abc-43a1-9adf-53ef9b45db63, rgb(250, 250, 250)) 0%, var(--token-a6d10e5a-39b6-4177-b1c3-03a50ebc7f8b, rgb(243, 243, 248)) 100%);
                        opacity: 1;
                        border-radius: 8px;
                        margin:12px;">
            <div class="hero-section__content" style="border-radius:10px;">
                <article class="text-center">
                    <h1>{{ setting('homepage.hero_title') }}</h1>
                    <p>{{ setting('homepage.hero_subtitle') }}</p>
                    <a class="mt-5" href="{{ route('products.index') }}">{{ setting('homepage.hero_cta_text') }}</a>
                </article>
                <figure>
                    <img src="{{ Storage::url(setting('homepage.hero_image')) }}" alt="Peptides"
                        style="max-width:340px;border-radius:12px;">

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
                        <div
                            class="promo-card d-flex flex-column justify-content-between h-100 
                            {{ $index % 2 === 0 ? 'gradient-left text-white' : 'gradient-right text-white' }}">
                            <div>
                                <h4 class="fw-bold">{!! $card['title'] ?? '' !!}</h4>
                                <p class="text-light">{!! $card['description'] ?? '' !!}</p>
                            </div>
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
                                    style="max-width:120px;">
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


                            @if (setting('homepage.why_purity_text'))
                                <div class="text-center mt-4">
                                    <span class="purity-badge">{{ setting('homepage.why_purity_text') }}</span>
                                </div>
                            @endif

                            @if (setting('homepage.why_footer_text'))
                                <p class="text-center mt-4">{{ setting('homepage.why_footer_text') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="contact-section">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center text-lg-start">
             
                    <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                        <h2>Text us, our dedicated team is here to help</h2>
                        <p>Reach out and get a response within minutes.</p>
                        <a href="mailto:{{ setting('store.email') }}" class="phone-number"><i
                                class="bi bi-envelope me-2"></i>{{ setting('store.email') }}</a>

                    </div>
           
                </div>
            </div>
        </section>




        <hr class="container">


        <section class="faq-section container">
            <h2 class="text-center mb-4">Frequently Asked Questions</h2>
            <div class="accordion custom-accordion" id="faqAccordion">
                <div class="accordion-item">
                    @foreach ($faqitems as $faqitem)
                        <h2 class="accordion-header" id="heading{{ $faqitem->id }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $faqitem->id }}" aria-expanded="true"
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
                    @endforeach
                </div>
            </div>
        </section>
    
        <x-product.newsletter-section />


    </main>
@endsection
