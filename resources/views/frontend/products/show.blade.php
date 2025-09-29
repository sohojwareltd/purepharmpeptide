@extends('frontend.layouts.app')

@section('title', $product->name . ' - Pure-pharm-peptides')

@section('content')
    <style>
        /* Modern Product Page Styles */
        .product-page {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }

        .product-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .product-gallery {
            position: relative;
            padding: 30px;
            background: #f8f9fa;
        }

        .main-image-container {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            background: white;
            cursor: pointer;
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .main-image-container:hover {
            transform: translateY(-5px);
        }

        .main-image {
            width: 100%;
            height: 500px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .thumbnail-gallery {
            margin-top: 20px;
            display: flex;
            gap: 12px;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .thumbnail-item {
            flex: 0 0 100px;
            height: 100px;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s ease;
            background: white;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .thumbnail-item:hover {
            border-color: #6c5ce7;
            transform: translateY(-3px);
        }

        .thumbnail-item.active {
            border-color: #6c5ce7;
            box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.2);
        }

        .thumbnail-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-details {
            padding: 40px 30px;
            background: white;
            height: 100%;
        }

        .product-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2d3436;
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .product-price {
            font-size: 2.5rem;
            font-weight: 700;
            color: #6c5ce7;
            margin-bottom: 20px;
        }

        .product-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #636e72;
            font-size: 0.9rem;
        }

        .stock-badge {
            padding: 8px 15px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .in-stock {
            background: rgba(46, 204, 113, 0.15);
            color: #27ae60;
        }

        .out-of-stock {
            background: rgba(231, 76, 60, 0.15);
            color: #c0392b;
        }

        .action-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .quantity-label {
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 0;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            background: white;
        }

        .quantity-btn {
            background: #f8f9fa;
            border: none;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .quantity-btn:hover {
            background: #e9ecef;
        }

        .quantity-input {
            width: 60px;
            height: 40px;
            border: none;
            text-align: center;
            font-weight: 600;
            background: white;
        }

        .add-to-cart-btn {
            background: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%);
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 5px 15px rgba(108, 92, 231, 0.3);
        }

        .add-to-cart-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(108, 92, 231, 0.4);
        }

        .add-to-cart-btn:disabled {
            background: #b2bec3;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .product-description {
            margin-bottom: 30px;
        }

        .description-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f8f9fa;
        }

        .description-content {
            color: #636e72;
            line-height: 1.6;
        }

        .similar-products-section {
            margin-top: 50px;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2d3436;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .similar-products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }

        .similar-product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .similar-product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .similar-product-image {
            height: 280px;
            width: 100%;
            object-fit: cover;
        }


        .similar-product-info {
            padding: 20px;
        }

        .similar-product-name {
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .similar-product-price {
            font-weight: 700;
            color: #6c5ce7;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .similar-add-to-cart-btn {
            background: #6c5ce7;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }

        .similar-add-to-cart-btn:hover {
            background: #5b4fcf;
        }

        /* Toast notification */
        .toast-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            z-index: 1000;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transform: translateX(150%);
            transition: transform 0.3s ease;
        }

        .toast-success {
            background: #00b894;
        }

        .toast-danger {
            background: #d63031;
        }

        .toast-show {
            transform: translateX(0);
        }

        /* Breadcrumb styling */
        .breadcrumb-custom {
            background: transparent;
            padding: 0;
            margin-bottom: 30px;
        }

        .breadcrumb-custom .breadcrumb-item a {
            color: #6c5ce7;
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-custom .breadcrumb-item.active {
            color: #2d3436;
            font-weight: 600;
        }

        /* Scroll Popup Styling */
        .scroll-popup {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(120px);
            width: 90%;
            max-width: 800px;
            background: linear-gradient(135deg, #ffffff41 0%, #f8f9fa3a 100%);
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            z-index: 999;
            padding: 25px;
            display: flex;
            align-items: center;
            gap: 25px;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            opacity: 0;
            border: 1px solid rgba(108, 92, 231, 0.1);
            backdrop-filter: blur(10px);
        }

        .scroll-popup.active {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }

        .popup-image-container {
            position: relative;
            flex-shrink: 0;
        }

        .popup-image {
            width: 100px;
            height: 100px;
            border-radius: 15px;
            object-fit: cover;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border: 3px solid white;
            transition: transform 0.3s ease;
        }

        .popup-image:hover {
            transform: scale(1.05);
        }

        .popup-details {
            flex: 1;
            padding-right: 15px;
        }

        .popup-title {
            font-weight: 700;
            color: #2d3436;
            margin-bottom: 8px;
            font-size: 1.3rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            letter-spacing: -0.5px;
        }

        .popup-price {
            font-weight: 800;
            color: #6c5ce7;
            font-size: 1.8rem;
            margin-bottom: 12px;
            text-shadow: 0 2px 4px rgba(108, 92, 231, 0.1);
        }

        .popup-stock {
            font-size: 0.95rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .popup-in-stock {
            color: #27ae60;
            background: rgba(46, 204, 113, 0.1);
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
        }

        .popup-out-of-stock {
            color: #c0392b;
            background: rgba(231, 76, 60, 0.1);
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
        }

        .popup-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .popup-quantity-container {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .popup-quantity-label {
            font-size: 0.9rem;
            color: #636e72;
            font-weight: 600;
        }

        .popup-quantity {
            display: flex;
            align-items: center;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            overflow: hidden;
            background: white;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: border-color 0.3s;
        }

        .popup-quantity:focus-within {
            border-color: #6c5ce7;
        }

        .popup-quantity-btn {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: none;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
            font-size: 1.2rem;
            color: #6c5ce7;
        }

        .popup-quantity-btn:hover {
            background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
            transform: scale(1.05);
        }

        .popup-quantity-input {
            width: 50px;
            height: 36px;
            border: none;
            text-align: center;
            font-weight: 700;
            background: white;
            font-size: 1.1rem;
            color: #2d3436;
        }

        .popup-quantity-input:focus {
            outline: none;
        }

        .popup-add-to-cart {
            background: linear-gradient(135deg, #6c5ce7 0%, #8a7cff 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 700;
            transition: all 0.3s;
            white-space: nowrap;
            font-size: 1rem;
            box-shadow: 0 5px 15px rgba(108, 92, 231, 0.3);
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            justify-content: center;
        }

        .popup-add-to-cart:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 92, 231, 0.4);
            background: linear-gradient(135deg, #5b4fcf 0%, #7a6bff 100%);
        }

        .popup-add-to-cart:active {
            transform: translateY(-1px);
        }

        .popup-add-to-cart:disabled {
            background: #b2bec3;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .popup-close {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: none;
            font-size: 1.5rem;
            color: #636e72;
            cursor: pointer;
            padding: 0;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s;
            flex-shrink: 0;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .popup-close:hover {
            background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
            color: #2d3436;
            transform: rotate(90deg);
        }

      

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .scroll-popup {
                flex-direction: column;
                text-align: center;
                gap: 20px;
                padding: 20px;
                max-width: 95%;
            }

            .popup-details {
                padding-right: 0;
                width: 100%;
            }

            .popup-actions {
                flex-direction: column;
                width: 100%;
                gap: 15px;
            }

            .popup-quantity-container {
                width: 100%;
                align-items: center;
            }

            .popup-quantity {
                width: auto;
                display: inline-flex;
            }

            .popup-add-to-cart {
                width: 100%;
            }

            .popup-image {
                width: 80px;
                height: 80px;
            }

            .popup-title {
                font-size: 1.1rem;
            }

            .popup-price {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .scroll-popup {
                padding: 15px;
                gap: 15px;
            }

            .popup-image {
                width: 70px;
                height: 70px;
            }

            .popup-title {
                font-size: 1rem;
            }

            .popup-price {
                font-size: 1.3rem;
            }

            .popup-add-to-cart {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }
    </style>

    @php
        $similarProducts = collect($allProducts ?? [])->filter(function ($p) use ($product) {
            if ($p->id === $product->id) {
                return false;
            }
            similar_text(strtolower($p->name), strtolower($product->name), $percent);
            return $percent >= 80;
        });

        $galleryImages = [];
        if ($product->gallery && is_array(json_decode($product->gallery, true))) {
            $galleryImages = json_decode($product->gallery, true);
        }
    @endphp

    <div class="product-page">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="breadcrumb-custom">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('products.index', ['category' => $product->category_id]) }}">{{ $product->category->name ?? 'Category' }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>

            <div class="product-container">
                <div class="row no-gutters">
                    <!-- Product Images -->
                    <div class="col-lg-6">
                        <div class="product-gallery">
                            <div class="main-image-container" id="mainImageContainer">
                                <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://via.placeholder.com/600x400?text=No+Image' }}"
                                    class="main-image" id="mainImage" alt="{{ $product->name }}">
                            </div>

                            <div class="thumbnail-gallery" id="thumbnailGallery">
                                <div class="thumbnail-item active" data-index="0">
                                    <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://via.placeholder.com/600x400?text=No+Image' }}"
                                        alt="Product Image 1" class="thumbnail-image">
                                </div>
                                @foreach ($galleryImages as $i => $galleryImage)
                                    <div class="thumbnail-item" data-index="{{ $i + 1 }}">
                                        <img src="{{ asset('storage/' . $galleryImage) }}"
                                            alt="Product Image {{ $i + 2 }}" class="thumbnail-image">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="col-lg-6">
                        <div class="product-details">
                            <h1 class="product-title">{{ $product->name }}</h1>

                            <!-- Price -->
                            <div class="product-price">
                                ${{ number_format($product->price, 2) }}
                            </div>

                            <!-- Product Meta -->
                            <div class="product-meta">
                                <div class="meta-item">
                                    <i class="bi bi-eye"></i> {{ $product->views ?? 0 }} views
                                </div>
                                <div class="meta-item">
                                    <i class="bi bi-box"></i> SKU: {{ $product->sku }}
                                </div>
                            </div>

                            <!-- Stock Status -->
                            @if ($product->track_quantity)
                                <div class="mb-4">
                                    @if ($product->stock > 0)
                                        <span class="stock-badge in-stock">
                                            <i class="bi bi-check-circle"></i> In Stock ({{ $product->stock }} available)
                                        </span>
                                    @else
                                        <span class="stock-badge out-of-stock">
                                            <i class="bi bi-x-circle"></i> Out of Stock
                                        </span>
                                    @endif
                                </div>
                            @endif

                            <!-- Add to Cart Form -->
                            <div class="action-section">
                                <form id="add-to-cart-form">
                                    <input type="hidden" id="product_price" name="price" value="{{ $product->price }}">

                                    <div class="quantity-selector">
                                        <label class="quantity-label">Quantity:</label>
                                        <div class="quantity-control">
                                            <button type="button" class="quantity-btn" id="decreaseQty">-</button>
                                            <input type="number" class="quantity-input" id="quantity" value="1"
                                                min="1"
                                                max="{{ $product->track_quantity ? $product->stock : 999 }}">
                                            <button type="button" class="quantity-btn" id="increaseQty">+</button>
                                        </div>
                                    </div>

                                    <button type="submit" class="add-to-cart-btn"
                                        {{ $product->track_quantity && $product->stock <= 0 ? 'disabled' : '' }}>
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </form>
                            </div>

                            <!-- Description -->
                            <div class="product-description">
                                <h3 class="description-title">Product Description</h3>
                                <p class="description-content">{{ $product->description ?: 'No description available.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Similar Products -->
            @if ($similarProducts->count() > 0)
                <div class="similar-products-section">
                    <h2 class="section-title">
                        <i class="bi bi-grid"></i> Related Products
                    </h2>

                    <div class="similar-products-grid">
                        @foreach ($similarProducts as $similarProduct)
                            <div class="similar-product-card">
                                <img src="{{ $similarProduct->thumbnail ? asset('storage/' . $similarProduct->thumbnail) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
                                    class="similar-product-image" alt="{{ $similarProduct->name }}">

                                <div class="similar-product-info">
                                    <h4 class="similar-product-name">{{ $similarProduct->name }}</h4>
                                    <div class="similar-product-price">${{ number_format($similarProduct->price, 2) }}
                                    </div>

                                    <button class="similar-add-to-cart-btn"
                                        onclick="addToCart({{ $similarProduct->id }}, {{ $similarProduct->price }}, this)">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- FAQ Section -->
    <section class="faq-section container">
        <h2 class="text-center mb-4">Frequently Asked Questions</h2>
        <div class="accordion custom-accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
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

    <!-- Scroll Popup -->
    <div class="scroll-popup" id="scrollPopup">
        <div class="popup-image-container">
            <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
                alt="{{ $product->name }}" class="popup-image">
        </div>

        <div class="popup-details">
            <div class="popup-title">{{ $product->name }}</div>
            <div class="popup-price">${{ number_format($product->price, 2) }}</div>

            @if ($product->track_quantity)
                <div class="popup-stock {{ $product->stock > 0 ? 'popup-in-stock' : 'popup-out-of-stock' }}">
                    @if ($product->stock > 0)
                        <i class="bi bi-check-circle"></i> In Stock ({{ $product->stock }} available)
                    @else
                        <i class="bi bi-x-circle"></i> Out of Stock
                    @endif
                </div>
            @endif

            <div class="popup-actions">
                <div class="popup-quantity-container">
                    <div class="popup-quantity-label">Quantity</div>
                    <div class="popup-quantity">
                        <button type="button" class="popup-quantity-btn" id="popupDecreaseQty">-</button>
                        <input type="number" class="popup-quantity-input" id="popupQuantity" value="1"
                            min="1" max="{{ $product->track_quantity ? $product->stock : 999 }}">
                        <button type="button" class="popup-quantity-btn" id="popupIncreaseQty">+</button>
                    </div>
                </div>

                <button class="popup-add-to-cart" id="popupAddToCart"
                    {{ $product->track_quantity && $product->stock <= 0 ? 'disabled' : '' }}>
                    <i class="bi bi-cart-plus"></i> Add to Cart
                </button>
            </div>
        </div>

        <button class="popup-close" id="popupClose">&times;</button>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="toast-notification"></div>
@endsection

@push('scripts')
    <script>
        $(function() {
            // Gallery functionality
            const productGallery = {
                images: [
                    '{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://via.placeholder.com/600x400?text=No+Image' }}',
                    @foreach ($galleryImages as $galleryImage)
                        '{{ asset('storage/' . $galleryImage) }}',
                    @endforeach
                ],
                currentIndex: 0
            };

            function setActiveImage(index) {
                productGallery.currentIndex = index;
                const imageUrl = productGallery.images[index];
                $('#mainImage').attr('src', imageUrl);
                $('.thumbnail-item').removeClass('active');
                $(`.thumbnail-item[data-index="${index}"]`).addClass('active');
            }

            $('.thumbnail-item').on('click', function() {
                setActiveImage(parseInt($(this).data('index')));
            });

            // Quantity controls for main form
            $('#increaseQty').on('click', function() {
                const quantityInput = $('#quantity');
                const max = parseInt(quantityInput.attr('max'));
                let currentVal = parseInt(quantityInput.val());

                if (currentVal < max) {
                    quantityInput.val(currentVal + 1);
                    // Sync with popup
                    $('#popupQuantity').val(currentVal + 1);
                }
            });

            $('#decreaseQty').on('click', function() {
                const quantityInput = $('#quantity');
                let currentVal = parseInt(quantityInput.val());

                if (currentVal > 1) {
                    quantityInput.val(currentVal - 1);
                    // Sync with popup
                    $('#popupQuantity').val(currentVal - 1);
                }
            });

            // Quantity controls for popup
            $('#popupIncreaseQty').on('click', function() {
                const quantityInput = $('#popupQuantity');
                const max = parseInt(quantityInput.attr('max'));
                let currentVal = parseInt(quantityInput.val());

                if (currentVal < max) {
                    quantityInput.val(currentVal + 1);
                    // Sync with main form
                    $('#quantity').val(currentVal + 1);
                }
            });

            $('#popupDecreaseQty').on('click', function() {
                const quantityInput = $('#popupQuantity');
                let currentVal = parseInt(quantityInput.val());

                if (currentVal > 1) {
                    quantityInput.val(currentVal - 1);
                    // Sync with main form
                    $('#quantity').val(currentVal - 1);
                }
            });

            // Add to Cart for main form
            $(document).on('submit', '#add-to-cart-form', function(e) {
                e.preventDefault();
                addToCartMain();
            });

            // Add to Cart for popup
            $('#popupAddToCart').on('click', function() {
                addToCartPopup();
            });

            // Close popup
            $('#popupClose').on('click', function() {
                $('#scrollPopup').removeClass('active');
            });

            // Scroll detection for popup
            let scrollTimeout;
            $(window).on('scroll', function() {
                const scrollTop = $(this).scrollTop();
                const popup = $('#scrollPopup');

                // Show popup when scrolled down 200px
                if (scrollTop > 200 && !popup.hasClass('active')) {
                    popup.addClass('active');
                }

                // Hide popup when at top of page
                if (scrollTop <= 200) {
                    popup.removeClass('active');
                }

                // Auto-hide popup after 10 seconds of no scrolling
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(function() {
                    if (scrollTop > 200) {
                        popup.removeClass('active');
                    }
                }, 10000);
            });

            // Sync quantity inputs
            $('#quantity, #popupQuantity').on('change', function() {
                const value = $(this).val();
                const max = parseInt($(this).attr('max'));
                const min = parseInt($(this).attr('min'));

                if (value > max) {
                    $(this).val(max);
                    $('#quantity').val(max);
                    $('#popupQuantity').val(max);
                } else if (value < min) {
                    $(this).val(min);
                    $('#quantity').val(min);
                    $('#popupQuantity').val(min);
                } else {
                    // Sync both inputs
                    if ($(this).attr('id') === 'quantity') {
                        $('#popupQuantity').val(value);
                    } else {
                        $('#quantity').val(value);
                    }
                }
            });
        });

        // Add to Cart for main form
        function addToCartMain() {
            const quantity = parseInt($('#quantity').val());
            const price = parseFloat($('#product_price').val());
            const button = $('#add-to-cart-form').find('button[type="submit"]');
            const originalText = button.html();

            button.html('<i class="bi bi-hourglass-split"></i> Adding...');
            button.prop('disabled', true);

            $.ajax({
                url: '{{ route('cart.add') }}',
                method: 'POST',
                data: {
                    product_id: {{ $product->id }},
                    quantity: quantity,
                    price: price
                },
                success: function(response) {
                    if (response.success) {
                        showToast('Product added to cart successfully!', 'success');
                        updateCartCount();
                    } else {
                        showToast(response.message, 'danger');
                    }
                    button.html(originalText);
                    button.prop('disabled', false);
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    showToast(response?.message || 'Failed to add product to cart',
                        'danger');
                    button.html(originalText);
                    button.prop('disabled', false);
                }
            });
        }

        // Add to Cart for popup
        function addToCartPopup() {
            const quantity = parseInt($('#popupQuantity').val());
            const price = parseFloat($('#product_price').val());
            const button = $('#popupAddToCart');
            const originalText = button.html();

            button.html('<i class="bi bi-hourglass-split"></i> Adding...');
            button.prop('disabled', true);

            $.ajax({
                url: '{{ route('cart.add') }}',
                method: 'POST',
                data: {
                    product_id: {{ $product->id }},
                    quantity: quantity,
                    price: price
                },
                success: function(response) {
                    if (response.success) {
                        showToast('Product added to cart successfully!', 'success');
                        updateCartCount();
                        // Hide popup after adding to cart
                        $('#scrollPopup').removeClass('active');
                    } else {
                        showToast(response.message, 'danger');
                    }
                    button.html(originalText);
                    button.prop('disabled', false);
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    showToast(response?.message || 'Failed to add product to cart',
                        'danger');
                    button.html(originalText);
                    button.prop('disabled', false);
                }
            });
        }

        // Toast notification function
        function showToast(message, type) {
            const toast = $('#toast');
            toast.removeClass('toast-success toast-danger').addClass('toast-' + type);
            toast.text(message);
            toast.addClass('toast-show');

            setTimeout(function() {
                toast.removeClass('toast-show');
            }, 3000);
        }

        // Add to Cart for related products
        window.addToCart = function(productId, price, button) {
            const originalText = button.innerHTML;

            // Show loading state
            button.innerHTML = '<i class="bi bi-hourglass-split"></i> Adding...';
            button.disabled = true;

            $.ajax({
                url: '{{ route('cart.add') }}',
                method: 'POST',
                data: {
                    product_id: productId,
                    quantity: 1,
                    price: price
                },
                success: function(response) {
                    if (response.success) {
                        showToast(response.message || 'Product added to cart!', 'success');
                        updateCartCount();
                    } else {
                        showToast(response.message || 'Failed to add product', 'danger');
                    }
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    showToast(response?.message || 'Failed to add product', 'danger');
                },
                complete: function() {
                    // Restore button state
                    button.innerHTML = '<i class="bi bi-cart-plus"></i> Add to Cart';
                    button.disabled = false;
                }
            });
        };
    </script>
@endpush
