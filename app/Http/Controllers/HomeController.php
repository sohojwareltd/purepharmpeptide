<?php
namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $products = Product::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

            
        if ($products->isEmpty()) {
            $products = Product::where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();
        }

        return view('home', compact('products'));
    }
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name'           => 'nullable|string|max:255',
            'email'          => 'required|email|unique:newsletter_subscriptions,email',
            'contact_number' => 'nullable|string|max:255',
        ]);

        NewsletterSubscription::create($validated);

        return back()->with('success', 'Thank you for subscribing!');
    }
}
