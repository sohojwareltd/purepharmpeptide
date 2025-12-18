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

        <!-- Hero Carousel Slider -->
        <section class="hero-carousel-section">
            <div class="swiper heroCarousel">
                <div class="swiper-wrapper">
                    @php
                        $carouselSlides = [
                            [
                                'title' => 'Premium Quality Peptides',
                                'subtitle' => 'Research-grade peptides for your scientific needs',
                                'image' => 'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=1920&q=80',
                                'cta_text' => 'Explore Products',
                                'cta_link' => route('products.index'),
                            ],
                            [
                                'title' => 'Fast & Secure Shipping',
                                'subtitle' => 'Worldwide delivery with temperature control',
                                'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=1920&q=80',
                                'cta_text' => 'Learn More',
                                'cta_link' => route('products.index'),
                            ],
                            [
                                'title' => 'Expert Support 24/7',
                                'subtitle' => 'Our team is here to assist you anytime',
                                'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=1920&q=80',
                                'cta_text' => 'Contact Us',
                                'cta_link' => route('products.index'),
                            ],
                        ];
                    @endphp
                    
                    @foreach($carouselSlides as $slide)
                    <div class="swiper-slide">
                        <div class="hero-slide" style="background-image: url('{{ $slide['image'] }}')">
                            <div class="hero-slide-overlay"></div>
                            <div class="container">
                                <div class="hero-slide-content">
                                    <h1 class="hero-slide-title" data-swiper-parallax="-300">{{ $slide['title'] }}</h1>
                                    <p class="hero-slide-subtitle" data-swiper-parallax="-200">{{ $slide['subtitle'] }}</p>
                                    <a href="{{ $slide['cta_link'] }}" class="btn btn-premium hero-slide-cta" data-swiper-parallax="-100">{{ $slide['cta_text'] }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </section>

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
                    <a class="btn btn-premium" href="{{ route('products.index') }}">View All Products</a>
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
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="how-it-works-card">
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

@push('styles')
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
/* Hero Carousel Styles */
.hero-carousel-section {
    position: relative;
    width: 100%;
    height: 600px;
    overflow: hidden;
}

.heroCarousel {
    width: 100%;
    height: 100%;
}

.hero-slide {
    width: 100%;
    height: 600px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    display: flex;
    align-items: center;
}

.hero-slide-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.7) 0%, rgba(10, 22, 40, 0.8) 100%);
    z-index: 1;
}

.hero-slide-content {
    position: relative;
    z-index: 2;
    color: white;
    max-width: 700px;
    padding: 2rem;
}

.hero-slide-title {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 800;
    margin-bottom: 1.5rem;
    line-height: 1.2;
    color: white;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
}

.hero-slide-subtitle {
    font-size: clamp(1.1rem, 2.5vw, 1.5rem);
    margin-bottom: 2rem;
    color: rgba(255, 255, 255, 0.95);
    line-height: 1.6;
}

.hero-slide-cta {
    display: inline-block;
    padding: 1rem 2.5rem;
    font-size: 1.1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
}

.heroCarousel .swiper-button-next,
.heroCarousel .swiper-button-prev {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    width: 55px;
    height: 55px;
    border-radius: 50%;
    color: white;
    transition: all 0.3s ease;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.heroCarousel .swiper-button-next:hover,
.heroCarousel .swiper-button-prev:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
}

.heroCarousel .swiper-button-next:after,
.heroCarousel .swiper-button-prev:after {
    font-size: 20px;
    font-weight: bold;
}

.heroCarousel .swiper-pagination {
    bottom: 30px;
}

.heroCarousel .swiper-pagination-bullet {
    width: 14px;
    height: 14px;
    background: white;
    opacity: 0.5;
    transition: all 0.3s ease;
}

.heroCarousel .swiper-pagination-bullet-active {
    opacity: 1;
    transform: scale(1.4);
    background: var(--primary);
}

@media (max-width: 768px) {
    .hero-carousel-section,
    .hero-slide {
        height: 450px;
    }
    
    .hero-slide-content {
        padding: 1.5rem;
    }
    
    .heroCarousel .swiper-button-next,
    .heroCarousel .swiper-button-prev {
        width: 40px;
        height: 40px;
    }
    
    .heroCarousel .swiper-button-next:after,
    .heroCarousel .swiper-button-prev:after {
        font-size: 16px;
    }
}
</style>
@endpush

@push('scripts')
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Hero Carousel
        const heroCarousel = new Swiper('.heroCarousel', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            speed: 1000,
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            parallax: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            on: {
                init: function() {
                    // Add animation class on init
                    this.slides.forEach(slide => {
                        slide.style.opacity = '1';
                    });
                },
            },
        });

        // Products track animation
        const track = document.querySelector('.products-track');
        if (track) {
            // Start from right side (off-screen)
            track.style.transform = 'translateX(100%)';
            
            // Small delay then start animation
            setTimeout(() => {
                track.style.animation = 'products-scroll 20s linear infinite';
            }, 100);
        }
    });
</script>
@endpush
