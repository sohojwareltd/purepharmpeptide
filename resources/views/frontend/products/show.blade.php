@extends('frontend.layouts.app')

@section('title', $product->name . ' - MyShop')

@section('content')
    <style>
        /* ---------------------- Variant removed ---------------------- */
        /* Only gallery, main image, thumbnail, list/grid view, and general product styling remains */

        .product-gallery {
            position: relative;
        }

        .main-image-container {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            background: #f8f9fa;
            cursor: pointer;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-image {
            width: 100%;
            height: 600px;
            object-fit: contain;
            transition: transform 0.3s ease;
            background: #f8f9fa;
        }

        .main-image:hover {
            transform: scale(1.02);
        }

        .thumbnail-gallery {
            margin-top: 15px;
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding-bottom: 5px;
        }

        .thumbnail-item {
            flex: 0 0 100px;
            height: 120px;
            border-radius: 6px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .thumbnail-item:hover {
            border-color: #007bff;
            transform: translateY(-2px);
        }

        .thumbnail-item.active {
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.2);
        }

        .thumbnail-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
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

    <div class="container">
        <br>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('products.index', ['category' => $product->category_id]) }}">{{ $product->category->name ?? 'Category' }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Product Images -->
            <div class="col-lg-6 mb-4">
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
                                <img src="{{ asset('storage/' . $galleryImage) }}" alt="Product Image {{ $i + 2 }}"
                                    class="thumbnail-image">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h3 mb-3">{{ $product->name }}</h1>

                        <!-- Price -->
                        <div class="mb-3">
                            <span class="price fs-2">
                                ${{ number_format($product->price, 2) }}
                            </span>
                        </div>

                        <!-- Product Meta -->
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="bi bi-eye"></i> {{ $product->views ?? 0 }} views
                                <span class="mx-2">|</span>
                                <i class="bi bi-box"></i> SKU: {{ $product->sku }}
                               
                            </small>
                        </div>

                        <!-- Stock Status -->
                        @if ($product->track_quantity)
                            <div class="mb-3">
                                @if ($product->stock > 0)
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> In Stock ({{ $product->stock }} available)
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle"></i> Out of Stock
                                    </span>
                                @endif
                            </div>
                        @endif

                        <!-- Add to Cart Form -->
                        <form id="add-to-cart-form" class="mb-4">
                            <input type="hidden" id="product_price" name="price" value="{{ $product->price }}">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" value="1" min="1"
                                        max="{{ $product->track_quantity ? $product->stock : 999 }}">
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary w-100 btn-lg"
                                        {{ $product->track_quantity && $product->stock <= 0 ? 'disabled' : '' }}>
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Description -->
                        <div class="mb-4">
                            <h6>Description</h6>
                            <p class="text-muted">{{ $product->description ?: 'No description available.' }}</p>
                        </div>

                        <!-- Similar Products -->
                        @if ($similarProducts->count() > 0)
                            <div class="row mt-5">
                                <div class="col-12">
                                    <h3>
                                        <i class="bi bi-grid"></i> Similar Products
                                    </h3>
                                </div>
                                <div class="col-12">
                                    <div class="row" id="relatedProductsContainer">
                                        @foreach ($similarProducts as $similarProduct)
                                            <div class="col-md-6 col-lg-3 mb-4 related-product-item">
                                                <x-product-card :product="$similarProduct" />

                                                <!-- Add to Cart button for related product -->
                                                <button class="btn btn-primary w-100 mt-2"
                                                    onclick="addToCart({{ $similarProduct->id }}, {{ $similarProduct->price }}, this)">
                                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            // Gallery
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

            // Add to Cart
            $(document).on('submit', '#add-to-cart-form', function(e) {
                e.preventDefault();
                const quantity = parseInt($('#quantity').val());
                const price = parseFloat($('#product_price').val());
                const button = $(this).find('button[type="submit"]');
                const originalText = button.html();

                button.html('Adding...');
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
            });
        });
    </script>
    <script>
        // Add to Cart for related products (like main product)
        window.addToCart = function(productId, price, button) {
            const originalText = button.innerHTML;

            // Show loading state
            button.innerHTML = 'Adding...';
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
                    button.innerHTML = originalText;
                    button.disabled = false;
                }
            });
        };
    </script>
@endpush
