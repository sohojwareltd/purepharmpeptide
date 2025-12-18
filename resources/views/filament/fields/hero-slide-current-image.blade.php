@php
    $url = $getRecord()?->image_url ?? null;
@endphp

@if ($url)
    <div style="margin-bottom: 0.75rem;">
        <div style="font-weight: 600; margin-bottom: 0.35rem;">Current Image</div>
        <div style="border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; background: #f8fafc;">
            <img src="{{ $url }}" alt="Current slide image" style="width: 100%; max-height: 260px; object-fit: cover; display: block;">
        </div>
    </div>
@endif
