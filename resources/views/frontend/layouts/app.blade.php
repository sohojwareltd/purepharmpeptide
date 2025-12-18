@php
    use Datlechin\FilamentMenuBuilder\Models\Menu;
    $menu = Menu::location('main');
    $mobileMenu = Menu::location('mobile');
    $quickLinks = Menu::location('quick_links');
    $customerService = Menu::location('customer_service');
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Purepharmpeptide')</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Font Awesome 6 Free -->
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cart_checkout.css') }}">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ uniqid() }}">
    <style>
        /*
         * ============================================
         * LAYOUT STYLES - Uses variables from custom.css
         * To change colors, edit: /public/assets/css/custom.css
         * ============================================
         */
        :root {
            /* ========== BRAND COLORS - Professional Blue Theme ========== */
            --primary: #0066FF;
            --primary-light: #3385FF;
            --primary-dark: #0052CC;
            --primary-rgb: 0, 102, 255;
            
            --secondary: #0F172A;
            --secondary-light: #1E293B;
            --secondary-rgb: 15, 23, 42;
            
            --accent: #FF6B35;
            --accent-light: #FF8F66;
            --accent-rgb: 255, 107, 53;
            
            --gold: #FF6B35;
            
            /* ========== NEUTRAL COLORS ========== */
            --light: #F8FAFC;
            --light-blue: #EBF5FF;
            --light-green: #EBF5FF;
            --white: #FFFFFF;
            --dark: #0F172A;
            
            --border: #E2E8F0;
            --border-light: #F1F5F9;
            
            --text: #475569;
            --text-dark: #1E293B;
            --text-muted: #94A3B8;
            
            /* ========== STATUS COLORS ========== */
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            
            /* ========== EFFECTS ========== */
            --transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-fast: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            
            --shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.04);
            --shadow-light: 0 4px 6px -1px rgba(0, 0, 0, 0.06), 0 2px 4px -2px rgba(0, 0, 0, 0.04);
            --shadow-medium: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -4px rgba(0, 0, 0, 0.04);
            --shadow-heavy: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            --shadow-glow: 0 0 40px rgba(var(--primary-rgb), 0.2);
            --shadow-blue: 0 20px 40px rgba(0, 102, 255, 0.15);
            
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
            
            /* ========== GRADIENTS ========== */
            --gradient-primary: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            --gradient-secondary: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-light) 100%);
            --gradient-accent: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            --gradient-blue: linear-gradient(135deg, #0066FF 0%, #3385FF 50%, #66A3FF 100%);
        }
        /* Import Premium Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--text);
            background: #FFFFFF;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* Table Styles */
        .table,
        .table th,
        .table td {
            color: var(--text-dark) !important;
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        .text-secondary {
            color: var(--text) !important;
        }

        .text-body-secondary {
            color: var(--text) !important;
        }

        /* Clean Professional Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            -webkit-backdrop-filter: blur(20px);
            backdrop-filter: blur(20px);
            transition: var(--transition);
            z-index: 1050;
            border-bottom: none !important;
            border: none !important;
            padding: 12px 0;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.06);
            padding: 8px 0;
        }

        .navbar .nav-link {
            color: var(--text-dark);
            font-weight: 600;
            margin: 0 4px;
            transition: var(--transition);
        }

        .navbar .nav-link.active,
        .navbar .nav-link:hover {
            color: var(--primary);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--secondary);
            text-decoration: none;
            transition: var(--transition);
        }

        .navbar-brand:hover {
            color: var(--primary);
            transform: translateY(-2px);
        }

        .navbar-brand img {
            height: 45px;
            width: auto;
            transition: var(--transition);
        }

        /* Desktop Navigation */
        .navbar-nav {
            flex-direction: row;
            align-items: center;
            gap: 0.25rem;
        }

        .navbar-nav .nav-link {
            color: var(--text-dark) !important;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.65rem 1rem;
            position: relative;
            transition: var(--transition);
            text-decoration: none;
            white-space: nowrap;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 2px;
            transition: var(--transition);
        }

        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after {
            width: 60%;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--primary) !important;
            background: transparent;
        }

        /* Clean Search Box */
        .search-box {
            flex: 1 1 350px;
            max-width: 420px;
            margin: 0 1.5rem;
            position: relative;
        }

        .search-box input[type="text"] {
            width: 100%;
            padding: 0.85rem 1.25rem 0.85rem 3rem;
            border: 2px solid var(--border);
            border-radius: 50px;
            font-size: 0.9rem;
            color: var(--text-dark);
            background: var(--light);
            outline: none;
            transition: var(--transition);
        }

        .search-box input[type="text"]:focus {
            border-color: var(--primary);
            background: #FFFFFF;
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1), 0 8px 25px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .search-box .fa-search {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .search-box input[type="text"]:focus+.fa-search {
            color: var(--primary);
        }

        /* Clean Icon Buttons */
        .icon-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-dark) !important;
            font-size: 0.95rem;
            background: none;
            border: none;
            padding: 0.7rem 1rem;
            border-radius: 50px;
            transition: var(--transition);
            text-decoration: none;
            font-weight: 600;
            position: relative;
        }

        .icon-btn:hover {
            color: var(--primary) !important;
            background: var(--light-green);
            transform: translateY(-2px);
        }

        .icon-btn i {
            font-size: 1.15rem;
            transition: var(--transition);
        }

        /* Clean Cart Badge */
        .cart-badge {
            position: absolute;
            top: 2px;
            right: 2px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light)) !important;
            color: var(--secondary) !important;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 0.25rem 0.5rem;
            border-radius: 50px;
            min-width: 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(245, 158, 11, 0.35);
        }

        /* Clean Dropdown */
        .dropdown-menu {
            border: none;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
            border-radius: 16px;
            padding: 0.75rem;
            margin-top: 0.75rem;
            animation: dropdownFadeIn 0.3s ease-out;
            overflow: hidden;
        }

        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(-12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            padding: 0.85rem 1.15rem;
            border-radius: 12px;
            transition: var(--transition);
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 4px;
        }

        .dropdown-item:last-child {
            margin-bottom: 0;
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
            color: var(--primary);
            transition: var(--transition);
            font-size: 1rem;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, var(--light-green) 0%, rgba(5, 150, 105, 0.08) 100%);
            color: var(--primary);
            transform: translateX(5px);
        }

        .dropdown-item:hover i {
            color: var(--primary);
            transform: scale(1.1);
        }

        /* Premium Mobile Menu Toggle */
        .navbar-toggler {
            border: none;
            background: none;
            padding: 0.5rem;
            border-radius: var(--radius-md);
            transition: var(--transition);
            position: relative;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar-toggler:focus {
            outline: none;
            box-shadow: none;
        }

        .navbar-toggler:hover {
            background: var(--light-blue);
            transform: scale(1.05);
        }

        .navbar-toggler-icon {
            width: 24px;
            height: 24px;
            background: none;
            position: relative;
            transition: var(--transition);
        }

        .navbar-toggler-icon::before,
        .navbar-toggler-icon::after,
        .navbar-toggler-icon div {
            content: '';
            display: block;
            height: 2.5px;
            width: 100%;
            background: var(--text-dark);
            border-radius: 2px;
            position: absolute;
            left: 0;
            transition: var(--transition);
        }

        .navbar-toggler-icon::before {
            top: 6px;
        }

        .navbar-toggler-icon div {
            top: 12px;
        }

        .navbar-toggler-icon::after {
            top: 18px;
        }

        /* Hamburger Animation */
        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::before {
            transform: rotate(45deg);
            top: 12px;
        }

        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon div {
            opacity: 0;
        }

        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::after {
            transform: rotate(-45deg);
            top: 12px;
        }

        /* Premium Offcanvas */
        .offcanvas {
            border: none;
            box-shadow: var(--shadow-heavy);
            background: #FFFFFF;
            width: 300px;
        }

        .offcanvas-header {
            border-bottom: 1px solid var(--border-light);
            padding: 1.25rem 1.5rem;
            background: #FFFFFF;
        }

        .offcanvas-header .navbar-brand {
            color: var(--primary);
            font-size: 1.1rem;
            font-weight: 700;
        }

        .offcanvas-header .btn-close {
            opacity: 0.6;
            transition: var(--transition);
            background: none;
            border: none;
            padding: 0.5rem;
        }

        .offcanvas-header .btn-close:hover {
            opacity: 1;
        }

        .offcanvas-body {
            padding: 0;
            background: #FFFFFF;
        }

        .offcanvas .search-box {
            max-width: 100%;
            margin: 0;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border-light);
        }

        .offcanvas .search-box input[type="text"] {
            background: var(--light);
            border: 2px solid var(--border-light);
            border-radius: var(--radius-md);
            padding: 0.85rem 1.1rem 0.85rem 2.75rem;
            font-size: 0.95rem;
            color: var(--text-dark);
        }

        .offcanvas .search-box input[type="text"]:focus {
            background: #FFFFFF;
            border-color: var(--primary);
            outline: none;
        }

        .offcanvas .search-box .fa-search {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .offcanvas .navbar-nav {
            flex-direction: column;
            gap: 0;
            margin: 0;
            padding: 0;
        }

        .offcanvas .nav-link {
            text-align: left;
            padding: 1.1rem 1.5rem;
            border: none;
            font-size: 1rem;
            color: var(--text-dark) !important;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.85rem;
            font-weight: 500;
            border-bottom: 1px solid var(--border-light);
        }

        .offcanvas .nav-link i {
            width: 22px;
            text-align: center;
            font-size: 1.05rem;
            color: var(--text-muted);
        }

        .offcanvas .nav-link:hover,
        .offcanvas .nav-link.active {
            color: var(--primary) !important;
            background: var(--light-blue);
        }

        .offcanvas .nav-link:hover i,
        .offcanvas .nav-link.active i {
            color: var(--primary);
        }

        .offcanvas .nav-link.active {
            color: var(--primary) !important;
            font-weight: 600;
        }

        /* Mobile Account Actions - Premium */
        .mobile-account-section {
            padding: 1.25rem 1.5rem;
            border-top: 1px solid var(--border-light);
            background: var(--light);
        }

        .mobile-account-section .section-title {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
        }

        .mobile-account-section .icon-btn {
            justify-content: flex-start;
            width: 100%;
            padding: 0.85rem 0;
            border: none;
            color: var(--text-dark) !important;
            font-size: 0.95rem;
            font-weight: 500;
            background: transparent;
            border-radius: 0;
            border-bottom: 1px solid var(--border-light);
        }

        .mobile-account-section .icon-btn:last-child {
            border-bottom: none;
        }

        .mobile-account-section .icon-btn:hover {
            color: var(--primary) !important;
            background: #FFFFFF;
        }

        .mobile-account-section .icon-btn i {
            width: 22px;
            text-align: center;
            font-size: 1.05rem;
            color: var(--text-muted);
        }

        .mobile-account-section .icon-btn span {
            margin-left: 0.5rem;
        }

        /* Cart badge in mobile menu */
        .mobile-account-section .cart-badge {
            position: static;
            margin-left: auto;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%) !important;
            color: white !important;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.25rem 0.5rem;
            border-radius: 50px;
            min-width: 20px;
            text-align: center;
        }

        /* Premium Floating Cart */
        .floating-cart {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 999;
            display: none;
        }

        @media (max-width: 991.98px) {
            .floating-cart {
                display: block;
            }
        }

        .cart-icon-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 65px;
            height: 65px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: 50%;
            text-decoration: none;
            box-shadow: 0 8px 30px rgba(5, 150, 105, 0.4);
            transition: var(--transition);
            position: relative;
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-12px);
            }
        }

        .cart-icon-link:hover {
            transform: translateY(-5px) scale(1.08);
            box-shadow: 0 15px 40px rgba(5, 150, 105, 0.5);
            color: white;
        }

        .cart-icon-link i {
            font-size: 1.5rem;
        }

        .nav-link {
            width: 100% !important;
        }

        /* Enhanced Responsive Design */
        @media (max-width: 991.98px) {
            .navbar .search-box {
                display: none;
            }

            .navbar-nav {
                display: none;
            }

            .navbar-brand img {
                height: 38px;
            }

            .navbar-brand {
                font-size: 1.3rem;
            }

            .icon-btn span {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0.6rem 0;
            }

            .navbar-brand {
                font-size: 1.2rem;
                gap: 0.5rem;
            }

            .navbar-brand img {
                height: 32px;
            }

            .icon-btn {
                padding: 0.45rem 0.65rem;
                font-size: 0.9rem;
            }

            .icon-btn i {
                font-size: 1.15rem;
            }

            .floating-cart {
                bottom: 20px;
                right: 20px;
            }

            .cart-icon-link {
                width: 55px;
                height: 55px;
            }

            .cart-icon-link i {
                font-size: 1.35rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.1rem;
            }

            .navbar-brand img {
                height: 30px;
            }

            .icon-btn {
                padding: 0.35rem 0.55rem;
                font-size: 0.85rem;
            }

            .icon-btn i {
                font-size: 1.05rem;
            }

            .offcanvas-body {
                padding: 0;
            }

            .floating-cart {
                bottom: 15px;
                right: 15px;
            }
        }

        /* Premium Main Content */
        main {
            margin-top: 80px;
            min-height: calc(100vh - 80px - 300px);
            position: relative;
        }


        .compliance-title {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .copyright {
            text-align: center;
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-light);
            position: relative;
            z-index: 1;
        }

        /* Premium Toast Notifications */
        #toast-container {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 9999;
        }

        .alert {
            border: none;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-heavy);
            margin-bottom: 12px;
            min-width: 320px;
            animation: slideInRight 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            padding: 1rem 1.25rem;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.95), rgba(5, 150, 105, 0.95));
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.95), rgba(220, 38, 38, 0.95));
            color: white;
        }

        .alert-warning {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.95), rgba(217, 119, 6, 0.95));
            color: white;
        }

        .alert-info {
            background: linear-gradient(135deg, rgba(0, 102, 255, 0.95), rgba(0, 82, 204, 0.95));
            color: white;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(120%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Premium Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Loading States */
        .btn-loading {
            position: relative;
            pointer-events: none;
            color: transparent !important;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            top: 50%;
            left: 50%;
            margin-left: -9px;
            margin-top: -9px;
            border: 2.5px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Premium Scroll to top button */
        .scroll-to-top {
            position: fixed;
            bottom: 100px;
            right: 30px;
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 8px 25px rgba(0, 102, 255, 0.35);
            transition: var(--transition);
            z-index: 999;
        }

        .scroll-to-top:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 12px 35px rgba(0, 102, 255, 0.5);
        }

        @media (max-width: 768px) {
            .scroll-to-top {
                bottom: 85px;
                right: 20px;
                width: 48px;
                height: 48px;
                font-size: 1.1rem;
            }
        }

        /* Premium Button Styles */
        .btn-premium {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #FFFFFF;
            border: none;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(5, 150, 105, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: var(--transition);
        }

        .btn-premium:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(5, 150, 105, 0.45);
            color: #FFFFFF;
        }

        .btn-premium:hover::before {
            left: 100%;
        }

        .btn-outline-premium {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            padding: 10px 26px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .btn-outline-premium:hover {
            background: var(--primary);
            color: #FFFFFF;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(5, 150, 105, 0.35);
        }

        /* Premium Form Styling */
        .form-control, .form-select {
            border: 2px solid var(--border);
            border-radius: var(--radius-md);
            padding: 0.85rem 1rem;
            font-size: 0.95rem;
            transition: var(--transition);
            background: #FFFFFF;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.12);
            outline: none;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        /* Premium Card Styling */
        .card {
            border: none;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-light);
            transition: var(--transition);
            overflow: hidden;
        }

        .card:hover {
            box-shadow: var(--shadow-medium);
        }

        .card-header {
            background: #FFFFFF;
            border-bottom: 1px solid var(--border-light);
            padding: 1.25rem 1.5rem;
            font-weight: 700;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow-heavy);
            margin-bottom: 10px;
            min-width: 300px;
            animation: slideInRight 0.3s ease;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Enhanced Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.5s ease-out;
        }

        /* Loading States */
        .btn-loading {
            position: relative;
            pointer-events: none;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            top: 50%;
            left: 50%;
            margin-left: -8px;
            margin-top: -8px;
            border: 2px solid transparent;
            border-top-color: currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Scroll to top button */
        .scroll-to-top {
            position: fixed;
            bottom: 100px;
            right: 30px;
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 8px 25px rgba(5, 150, 105, 0.35);
            transition: var(--transition);
            z-index: 999;
        }

        .scroll-to-top:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 12px 35px rgba(5, 150, 105, 0.5);
        }

        @media (max-width: 768px) {
            .scroll-to-top {
                bottom: 80px;
                right: 20px;
                width: 45px;
                height: 45px;
                font-size: 1rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid px-4">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ Storage::url(setting('store.logo')) }}" alt="logo" class="d-none d-lg-inline">
                <img src="{{ Storage::url(setting('store.logo')) }}" alt="logo" class="d-lg-none">
            </a>

            {{-- <!-- Desktop Search -->
            <form class="search-box d-none d-lg-block" action="{{ route('products.index') }}" method="get">
                <i class="fas fa-search"></i>
                <input type="text" name="q" placeholder="Search research peptides..."
                    value="{{ request('q') }}">
            </form> --}}

            <!-- Desktop Navigation -->
            <div class="d-none d-lg-flex flex-grow-1 justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
                            href="{{ route('products.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}"
                            href="{{ route('blog.index') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="mailto:+example@example.com"><i class="bi bi-envelope me-2"></i> Need Help ?</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                            href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                            href="{{ route('contact') }}">Contact</a>
                    </li> --}}
                </ul>
            </div>

            <!-- Desktop Actions -->
            <div class="d-none d-lg-flex align-items-center gap-3">
                <!-- Cart -->
                <a class="icon-btn position-relative" href="{{ route('cart.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="cart-count-navbar" class="cart-badge">{{ \App\Facades\Cart::getItemCount() }}</span>
                </a>

                <!-- Account -->
                <div class="dropdown">

                    <a class="icon-btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="far fa-user"></i>
                        <span>Account</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @guest
                            <li><a class="dropdown-item" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt"></i> Sign in
                                </a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus"></i> Register
                                </a></li>
                        @endguest
                        @auth
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>

            <!-- Mobile Actions -->
            <div class="d-lg-none d-flex align-items-center gap-2">
                <a class="icon-btn" href="{{ route('login') }}">
                    <i class="far fa-user"></i>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu"
                    aria-controls="mobileMenu">
                    <span class="navbar-toggler-icon">
                        <i class="fas fa-bars"></i>
                    </span>
                </button>
            </div>
        </div>
    </nav>


    <!-- Mobile Menu Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
        <div class="offcanvas-header">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ Storage::url(setting('logo.png')) }}" alt="American Peptide Mobile Logo">
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">


            <!-- Mobile Navigation -->
            <ul class="navbar-nav d-flex flex-column align-items-start mb-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                        href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
                        href="{{ route('products.index') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}"
                        href="{{ route('blog.index') }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}"
                        href="mailto:+example@example.com"><i class="bi bi-envelope me-2"></i> Need Help ?</a>
                </li>
            </ul>

            <!-- Mobile Account Actions -->
            <div class="mobile-account-section text-dark">

                <h6 class="section-title">Account</h6>
                @guest
                    <ul class="navbar-nav d-flex flex-column align-items-start mb-4">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Sign in</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i>
                                <span>Register</span>
                            </a>
                        </li>

                    </ul>
                @else
                    <ul class="navbar-nav d-flex flex-column align-items-start mb-4">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i>
                                <span>Register</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>

                    </ul>
                @endguest

            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="fade-in-up">
        @yield('content')
    </main>

    <footer class="footer-section">

        <div class="footer-box p-4 p-md-5 bg-white shadow-sm">
            <div class="row align-items-center">
                <!-- Left logo & text -->
                <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
                    <img src="{{ Storage::url(setting('store.footer_logo')) }}" alt="Logo" class="mb-3">
                    <h6 class="fw-bold mb-1">Verified compounds.</h6>
                    <p class="mb-0">Ready to ship.</p>
                </div>
                <!-- Right contact -->
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-1 text-muted">Need help? Text us, and a team member will reply in minutes.</p>
                    <a href="mailto:+{{ setting('store.email') }}"
                        class="fw-bold text-primary">{{ setting('store.email') }}</a>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6 text-center text-md-start text-primary">
                    © Purepharmpeptides 2025. All rights reserved
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="me-3 text-decoration-none text-primary">Privacy Policy</a>
                    <a href="#" class="text-decoration-none text-primary">Terms of Service</a>
                </div>
            </div>
            <p class="small mt-3 text-muted">
                Food and Drug Administration.– 3rd Party Verified.
                The products offered are not intended to diagnose, treat, cure, or prevent any disease.
                Pure-pharm-peptides is not a compounding pharmacy or chemical compounding facility as defined under
                Section 503A of the Federal Food, Drug, and Cosmetic Act,
                and all products are sold strictly for research purposes only and are not for human or animal
                consumption.
            </p>
        </div>

    </footer>

    <!-- Scroll to Top Button -->
    <button class="scroll-to-top" id="scrollToTop" style="background: var(--primary) !important; color: white !important;"
        title="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </button>
    <!-- Toast Container -->
    <div id="toast-container"></div>

    <!-- Floating Cart for Mobile -->
    <div class="floating-cart d-lg-none" id="floatingCart">
        <a href="{{ route('cart.index') }}" class="cart-icon-link">
            <i class="fas fa-shopping-cart"></i>
            <span id="cart-count-floating" class="cart-badge">0</span>
        </a>
    </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener("scroll", function() {
            const navbar = document.querySelector(".navbar");
            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
    </script>


    <script>
        function updateCartCount() {
            fetch('/cart/count')
                .then(response => {
                    if (!response.ok) throw new Error('Network error');
                    return response.json();
                })
                .then(data => {
                    console.log('Cart count response:', data);

                    const count = data.cart_count ?? 0;

                    const navbarBadge = document.getElementById('cart-count-navbar');
                    const floatingBadge = document.getElementById('cart-count-floating');

                    if (navbarBadge) navbarBadge.textContent = count;
                    if (floatingBadge) floatingBadge.textContent = count;
                })
                .catch(error => {
                    console.error('Error fetching cart count:', error);
                });
        }
        document.addEventListener('DOMContentLoaded', function() {


            updateCartCount(); // initial load
        });

        // Enhanced Toast notifications
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `alert alert-${type} alert-dismissible fade show`;
            toast.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('fade');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Auto-hide alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // Enhanced Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            // Show/hide scroll to top button
            const scrollToTop = document.getElementById('scrollToTop');
            if (window.scrollY > 300) {
                scrollToTop.style.display = 'flex';
            } else {
                scrollToTop.style.display = 'none';
            }
        });

        // Scroll to top functionality
        document.getElementById('scrollToTop').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Enhanced mobile menu close on link click
        document.querySelectorAll('.offcanvas .nav-link, .offcanvas .icon-btn').forEach(link => {
            link.addEventListener('click', function() {
                const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('mobileMenu'));
                if (offcanvas) {
                    offcanvas.hide();
                }
            });
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();

            // Add loading states to forms
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.classList.add('btn-loading');
                        submitBtn.disabled = true;
                    }
                });
            });
        });
    </script>



    @stack('scripts')
</body>

</html>
