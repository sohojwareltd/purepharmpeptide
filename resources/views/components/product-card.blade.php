@props(['product'])
<div class="product-card">
    <a href="{{ route('products.show', $product) }}">
        <!-- Product Image -->
        <div class="position-relative">
            <img src="{{ $product->image_url ?? 'https://via.placeholder.com/300x300?text=Peptide' }}"
                alt="{{ $product->name }}" class="product-image w-100">
        </div>

        <!-- Card Body -->
        <a style="text-decoration: none; color: inherit;" href="{{ route('products.show', $product) }}">
            <div class="card-body d-flex flex-column">
                <!-- Product Name -->
                <h5 class="card-title  mb-2 text-center product-name">{{ $product->name }}</h5>

                <!-- Price -->
                <div class=" mb-3 text-center product-price">

                    ${{ number_format($product->price, 2) }}

                </div>
                <a href="{{ route('products.show', $product) }}" class="btn btn-link">See Details</a>
            </div>
        </a>
</div>
