<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon - {{ config('app.name') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            overflow: hidden;
        }

        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 20s infinite ease-in-out;
        }

        .circle:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 20%;
            animation-delay: 0s;
        }

        .circle:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            left: 70%;
            animation-delay: 3s;
        }

        .circle:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 80%;
            left: 10%;
            animation-delay: 5s;
        }

        .circle:nth-child(4) {
            width: 100px;
            height: 100px;
            top: 30%;
            left: 80%;
            animation-delay: 7s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
                opacity: 0.7;
            }
            50% {
                transform: translateY(-100px) rotate(180deg);
                opacity: 0.3;
            }
        }

        .container {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 40px 20px;
            max-width: 800px;
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            margin-bottom: 30px;
            animation: pulse 2s infinite ease-in-out;
        }

        .logo h1 {
            font-size: 3.5rem;
            font-weight: 700;
            text-shadow: 2px 2px 20px rgba(0, 0, 0, 0.3);
            letter-spacing: 2px;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .content {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .content h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-shadow: 1px 1px 10px rgba(0, 0, 0, 0.2);
        }

        .content p {
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 30px;
            color: rgba(255, 255, 255, 0.9);
        }

        .spinner {
            width: 60px;
            height: 60px;
            margin: 30px auto;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-top: 5px solid #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .social-links {
            margin-top: 40px;
        }

        .social-links a {
            display: inline-block;
            width: 50px;
            height: 50px;
            margin: 0 10px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            line-height: 50px;
            color: #fff;
            text-decoration: none;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: translateY(-5px);
        }

        .footer {
            margin-top: 40px;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
        }

        @media (max-width: 768px) {
            .logo h1 {
                font-size: 2.5rem;
            }

            .content h2 {
                font-size: 1.8rem;
            }

            .content p {
                font-size: 1rem;
            }

            .content {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="background-animation">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <div class="container">
        <div class="logo">
            <h1>{{ config('app.name', 'PurePeptide') }}</h1>
        </div>

        <div class="content">
            <h2>🚀 Coming Soon</h2>
            <p>
                We're working hard to bring you something amazing! 
                Our website is currently under construction and will be live soon.
            </p>
            <p>
                Stay tuned for exciting updates and new features.
            </p>

            <div class="spinner"></div>

            <p style="font-size: 1rem; margin-top: 30px;">
                Thank you for your patience! 🙏
            </p>

            {{-- Uncomment if you want to add social links --}}
            {{-- <div class="social-links">
                <a href="#" title="Facebook">📘</a>
                <a href="#" title="Twitter">🐦</a>
                <a href="#" title="Instagram">📷</a>
                <a href="#" title="Email">✉️</a>
            </div> --}}

            <div class="footer">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
