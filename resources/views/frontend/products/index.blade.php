@extends('frontend.layouts.app')

@section('title', 'Research Peptides - Premium Peptide Supplier')
@section('meta_description',
    'Explore our collection of high-quality research peptides for laboratory use. Find the
    perfect peptides for your research needs with guaranteed purity and quality.')
@section('meta_keywords',
    'research peptides, peptide supplier, laboratory peptides, peptide research, high purity
    peptides, research chemicals')

@section('content')

    <div class="container">
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


                </div>
            </div>
        </section>


        <div class="row">
            <h2 class="section-title">Explore Our Products</h2>
            <!-- Sidebar Filters (Desktop) -->
            <div class="col-lg-3 mb-4 d-none d-lg-block">
                <div class="position-sticky" style="top: 70px;"> <!-- one sticky wrapper -->

                    <!-- Search -->
                    <form method="GET" action="{{ route('products.index') }}"
                        class="search-form card border-0 shadow-sm mb-3">
                        <div class="card-header text-white"
                            style="background: #0483c6; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                            <h6 class="mb-0 d-flex align-items-center">
                                <i class="bi bi-search me-2"></i>
                                <small>Name / Sequence / Catalog No.</small>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="input-group smart-search">
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                    placeholder="Search peptides..." aria-label="Search peptides">
                                <button class="btn btn-primary px-3" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Filters -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header text-white" style="background: #0483c6;">
                            <h6 class="mb-0">
                                <i class="bi bi-funnel me-2"></i>Filters
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            @include('frontend.products._filters', [
                                'categories' => $categories,
                            ])
                        </div>
                    </div>
                </div>
            </div>


            <!-- Mobile Filter Toggle -->
            <div class="col-12 d-lg-none mb-4">
                <button class="btn btn-outline-primary w-100 py-3" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#filtersOffcanvas" aria-controls="filtersOffcanvas">
                    <i class="bi bi-funnel me-2"></i>Filters & Search
                    <span class="badge bg-primary ms-2">{{ collect(request()->all())->filter()->count() }}</span>
                </button>
            </div>

            <!-- Mobile Offcanvas Filters -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="filtersOffcanvas"
                aria-labelledby="filtersOffcanvasLabel">
                <div class="offcanvas-header bg-primary text-white">
                    <h5 class="offcanvas-title" id="filtersOffcanvasLabel">
                        <i class="bi bi-funnel me-2"></i>Filters & Search
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-4">
                    @include('frontend.products._filters', [
                        'categories' => $categories,
                    ])
                </div>
            </div>

            <!-- Main Content: Products -->
            <div class="col-lg-9">
                <!-- Active Filters Display -->
                @if (request('search') ||
                        request('category') ||
                        request('brand') ||
                        request('min_price') ||
                        request('max_price') ||
                        request('sort'))
                    <div class="active-filters mb-4">
                        <div class="card border-0 bg-light">
                            <div class="card-body py-3">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <span class="text-muted fw-medium me-2">Active Filters:</span>
                                    @if (request('search'))
                                        <span class="badge bg-primary rounded-pill">
                                            <i class="bi bi-search me-1"></i>
                                            "{{ request('search') }}"
                                            <a href="{{ route('products.index', request()->except('search')) }}"
                                                class="text-white text-decoration-none ms-1">×</a>
                                        </span>
                                    @endif
                                    @if (request('category'))
                                        @php $category = $categories->firstWhere('slug', request('category')) @endphp
                                        @if ($category)
                                            <span class="badge bg-primary rounded-pill">
                                                <i class="bi bi-tag me-1"></i>
                                                {{ $category->name }}
                                                <a href="{{ route('products.index', request()->except('category')) }}"
                                                    class="text-white text-decoration-none ms-1">×</a>
                                            </span>
                                        @endif
                                    @endif
                                    @if (request('min_price') || request('max_price'))
                                        <span class="badge bg-primary rounded-pill">
                                            <i class="bi bi-currency-dollar me-1"></i>
                                            ${{ request('min_price', '0') }} - ${{ request('max_price', '∞') }}
                                            <a href="{{ route('products.index', request()->except(['min_price', 'max_price'])) }}"
                                                class="text-white text-decoration-none ms-1">×</a>
                                        </span>
                                    @endif
                                    @if (request('sort'))
                                        @php
                                            $sortLabels = [
                                                'name' => 'Name A-Z',
                                                'name_desc' => 'Name Z-A',
                                                'price' => 'Price Low-High',
                                                'price_desc' => 'Price High-Low',
                                                'newest' => 'Newest First',
                                                'popular' => 'Most Popular',
                                            ];
                                        @endphp
                                        <span class="badge bg-primary rounded-pill">
                                            <i class="bi bi-sort-down me-1"></i>
                                            {{ $sortLabels[request('sort')] ?? request('sort') }}
                                            <a href="{{ route('products.index', request()->except('sort')) }}"
                                                class="text-white text-decoration-none ms-1">×</a>
                                        </span>
                                    @endif
                                    <a href="{{ route('products.index') }}"
                                        class="btn btn-sm btn-outline-secondary ms-auto">
                                        <i class="bi bi-x-circle me-1"></i>Clear All
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif



                <!-- Products Grid -->
                @if ($products->count() > 0)
                    <div class="products-container">
                        <div class="row">

                            @foreach ($products as $product)
                                <div class="col-md-4 col-lg-3 col-sm-6 mb-3">
                                    <x-product-card :product="$product" />
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="pagination-section mt-5">
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    </div>
                @else
                    <!-- No Results State -->
                    <div class="no-results text-center py-5">
                        <div class="no-results-icon mb-4">
                            <i class="bi bi-search display-1 text-muted"></i>
                        </div>
                        <h4 class="text-muted mb-3">No peptides found</h4>
                        <p class="text-muted mb-4">Try adjusting your search criteria or browse our complete research
                            peptide collection.</p>
                        <div class="d-flex gap-3 justify-content-center">
                            <a href="{{ route('products.index') }}" class="btn btn-primary">
                                <i class="bi bi-arrow-clockwise me-2"></i>Clear Filters
                            </a>
                            <button class="btn btn-outline-primary" data-bs-toggle="offcanvas"
                                data-bs-target="#filtersOffcanvas">
                                <i class="bi bi-funnel me-2"></i>Adjust Filters
                            </button>
                        </div>
                    </div>
                @endif
            </div>
            <section class="container py-5">

                <div class="row g-4">

                    <!-- Left Card -->
                    <div class="col-lg-6">
                        <div class="promo-card d-flex flex-column justify-content-between h-100 gradient-left text-white">
                            <div>
                                <h4 class="fw-bold">Have a question?</h4>
                                <p class="text-light">We're here to help.</p>
                                <a href="tel:+8801303550622" class="btn btn-light"><i class="bi bi-telephone me-2"></i> +88 (013) 0355-0622</a>
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
        </div>


    </div>


    <!-- Enhanced Product Card Styles -->
    <style>
        .hero-section {
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            position: relative;
            overflow: hidden;
        }

        .hero-decoration {
            transform: translate(50%, -50%);
        }

        .lead {
            padding: 0px 10%;
            font-size: 30px !important;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .smart-search .form-control {
            border-radius: 50px 0 0 50px;
            padding-left: 18px;
            border-right: none;
            box-shadow: none;
            transition: all 0.2s ease-in-out;
        }

        .smart-search .form-control:focus {
            border-color: #0483c6;
            box-shadow: 0 0 0 0.2rem rgba(4, 131, 198, 0.25);
        }

        .smart-search .btn {
            border-radius: 0 50px 50px 0;
            background: #0483c6;
            border: none;
        }

        .smart-search .btn:hover {
            background: #036ba0;
        }

        .card {
            transition: all 0.3s ease;
            border-radius: 12px;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }


        .badge {
            font-weight: 500;
        }

        .btn-group .btn {
            border-radius: 8px;
        }

        .btn-group .btn.active {
            background-color: #667eea;
            border-color: #667eea;
            color: white;
        }

        .dropdown-menu {
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item.active {
            background-color: #667eea;
        }

        .pagination .page-link {
            border-radius: 8px;
            margin: 0 4px;
            border: none;
            color: #000000;
        }

        .pagination .page-item.active .page-link {
            background-color: #667eea;
            border-color: #667eea;
        }

        .offcanvas {
            border-radius: 0 12px 12px 0;
        }

        .stat-item {
            padding: 1rem;
            border-radius: 12px;
        }

        .active-filters .badge {
            font-size: 0.875rem;
            padding: 0.5rem 0.75rem;
        }

        .results-header {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 12px;
            border: 1px solid #e9ecef;
        }

        .no-results-icon {
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .hero-stats {
                gap: 2rem;
            }

            .stat-item {
                padding: 0.75rem;
            }

            .search-form .input-group {
                border-radius: 12px;
            }

            .search-form .btn {
                border-radius: 0 12px 12px 0;
            }
        }
    </style>

    <script>
        // Enhanced addToCart function
        function addToCart(productId) {
            fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: 1
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Optimistically update cart count in UI
                        const cartElements = document.querySelectorAll(
                            '#cart-count, #cart-count-navbar, #cart-count-mobile, #cart-count-offcanvas, .cart-badge'
                        );
                        cartElements.forEach(el => {
                            let current = parseInt(el.textContent, 10) || 0;
                            el.textContent = current + 1;
                        });
                        showToast('Product added to cart successfully!', 'success');
                        // Sync with server in background
                        if (typeof updateCartCount === 'function') {
                            setTimeout(updateCartCount, 1000);
                        }
                    } else {
                        showToast(data.message || 'Error adding product to cart', 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Error adding product to cart', 'danger');
                });
        }

        // Enhanced toast function
        function showToast(message, type = 'success') {
            const alert = document.createElement('div');
            alert.className =
                `alert alert-${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3`;
            alert.style.zIndex = '9999';
            alert.style.borderRadius = '12px';
            alert.style.boxShadow = '0 8px 25px rgba(0,0,0,0.15)';
            alert.innerHTML = `
                <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(alert);

            // Auto-remove after 3 seconds
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.remove();
                }
            }, 3000);
        }

        // View toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const gridView = document.getElementById('gridView');
            const listView = document.getElementById('listView');
            const productsGrid = document.getElementById('productsGrid');

            if (gridView && listView && productsGrid) {
                gridView.addEventListener('click', function() {
                    gridView.classList.add('active');
                    listView.classList.remove('active');
                    productsGrid.className = 'row g-4';
                    productsGrid.querySelectorAll('.col-md-6, .col-xl-4').forEach(col => {
                        col.className = 'col-md-6 col-xl-4';
                    });
                });

                listView.addEventListener('click', function() {
                    listView.classList.add('active');
                    gridView.classList.remove('active');
                    productsGrid.className = 'row g-3';
                    productsGrid.querySelectorAll('.col-md-6, .col-xl-4').forEach(col => {
                        col.className = 'col-12';
                    });
                });
            }

            // Auto-submit form on filter change
            const filterForm = document.getElementById('filterForm');
            if (filterForm) {
                const autoSubmitElements = filterForm.querySelectorAll('select, input[type="number"]');
                autoSubmitElements.forEach(element => {
                    element.addEventListener('change', function() {
                        filterForm.submit();
                    });
                });
            }
        });
    </script>
@endsection
