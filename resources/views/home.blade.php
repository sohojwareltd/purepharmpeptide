@extends('frontend.layouts.app')

@section('content')
    <main>
        <div class="framer"
            style="background-color: rgb(243, 243, 248);
                    margin: 5px;
                    border-radius: 10px;
                    padding: 8px;">
            <div class="text" style="justify-content: center;display: flex;font-weight: bold;color: #414141">Need help? Text
                us,
                and a team member
                will reply in mins <br>
                <samp style="color: blue; margin-left: 5px;">+1 (972) 919-0219</samp>
            </div>
        </div>
        <section class="hero-section"
            style="background: linear-gradient(180deg, var(--token-a409bc3c-6abc-43a1-9adf-53ef9b45db63, rgb(250, 250, 250)) 0%, var(--token-a6d10e5a-39b6-4177-b1c3-03a50ebc7f8b, rgb(243, 243, 248)) 100%);
                        opacity: 1;
                        border-radius: 8px;
                        margin:5px;">
            <div class="hero-section__content" style="border-radius:10px;">
                <article class="text-center">
                    <h1>99% Pure Peptides</h1>
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
            <h2>Explore Our Peptides</h2>
            <div class="products-marquee">
                <div class="products-track">
                    @foreach ($products as $product)
                        <div class="product-item">
                            <x-product-card :product="$product" />
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
