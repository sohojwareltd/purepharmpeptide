<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HeroSlide;

class HeroSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'title' => 'Premium Research Peptides',
                'subtitle' => 'High-purity peptides for advanced research and development',
                'image' => 'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=1920&q=80',
                'button_text' => 'Explore Products',
                'button_link' => '/products',
                'order' => 0,
                'is_active' => true,
            ],
            [
                'title' => 'Laboratory Grade Quality',
                'subtitle' => 'Stringent quality control and testing for optimal results',
                'image' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?w=1920&q=80',
                'button_text' => 'Shop Now',
                'button_link' => '/products',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Advanced Peptide Solutions',
                'subtitle' => 'Cutting-edge compounds for your research needs',
                'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=1920&q=80',
                'button_text' => 'Browse Catalog',
                'button_link' => '/products',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Scientific Excellence',
                'subtitle' => 'Trusted by researchers worldwide for consistent quality',
                'image' => 'https://images.unsplash.com/photo-1585435557343-3b092031a831?w=1920&q=80',
                'button_text' => 'Learn More',
                'button_link' => '/products',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        // Prevent duplicates by clearing existing seeded slides with same titles
        HeroSlide::whereIn('title', collect($slides)->pluck('title'))->delete();

        foreach ($slides as $slide) {
            HeroSlide::create($slide);
        }
    }
}
