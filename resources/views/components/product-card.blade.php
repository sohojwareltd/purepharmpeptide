@props(['product'])
<div class="product-card">
    <a href="{{ route('products.show', $product) }}" class="product-card-link">
        <!-- Product Image -->
        <div class="position-relative overflow-hidden">
            <img src="{{ $product->image_url ?? 'https://via.placeholder.com/300x300?text=Peptide' }}"
                alt="{{ $product->name }}" class="product-image w-100">
        </div>

        <!-- Card Body -->
        <div class="card-body d-flex flex-column">
            <!-- Product Name -->
            <h5 class="card-title mb-2 text-center product-name">{{ $product->name }}</h5>

            <!-- Price -->
            <div class="mb-3 text-center product-price">
                ${{ number_format($product->price, 2) }}
            </div>
            <span class="btn btn-link">
                <span>See Details</span>
                <i class="fas fa-arrow-right"></i>
            </span>
        </div>
    </a>
</div>
