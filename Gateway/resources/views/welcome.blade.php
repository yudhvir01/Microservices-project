<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Application Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #ffffff;
            color: #000000;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 300;
            line-height: 1.6;
        }

        .container {
            max-width: 480px;
            width: 100%;
            padding: 0 2rem;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 4rem;
        }

        .logo {
            width: 200px;
            height: auto;
            opacity: 0.9;
        }

        .main-card {
            background: #ffffff;
            border: 1px solid #000000;
            padding: 0;
            overflow: hidden;
        }

        .action-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .action-item {
            padding: 3rem 2rem;
            text-align: center;
            text-decoration: none;
            color: #000000;
            background: #ffffff;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 200px;
        }

        .action-item:first-child {
            border-right: 1px solid #000000;
        }

        .action-item:hover {
            background: #000000;
            color: #ffffff;
        }

        .action-icon {
            width: 32px;
            height: 32px;
            margin-bottom: 1.5rem;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.5;
        }

        .action-title {
            font-size: 1.125rem;
            font-weight: 400;
            letter-spacing: 0.025em;
        }

        .footer-text {
            text-align: center;
            margin-top: 3rem;
            font-size: 0.875rem;
            color: #666666;
            font-weight: 300;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .container {
                padding: 0 1.5rem;
            }

            .action-grid {
                grid-template-columns: 1fr;
            }

            .action-item:first-child {
                border-right: none;
                border-bottom: 1px solid #000000;
            }

            .action-item {
                min-height: 120px;
                padding: 2rem 1.5rem;
            }

            .logo-section {
                margin-bottom: 3rem;
            }

            .logo {
                width: 160px;
            }
        }

        /* Focus states for accessibility */
        .action-item:focus {
            outline: 2px solid #000000;
            outline-offset: -2px;
        }

        .action-item:focus:hover {
            outline-color: #ffffff;
        }

        /* Animation */
        .main-card {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="main-card">
            <div class="action-grid">
                <a href="{{ url(config('roro.prefix').'/login') }}" class="action-item">
                    <svg class="action-icon" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span class="action-title">Login</span>
                </a>

                <a href="{{ url(config('roro.prefix').'/register') }}" class="action-item">
                    <svg class="action-icon" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    <span class="action-title">Register</span>
                </a>
            </div>
        </div>

        <div class="footer-text">
            Secure • Simple • Reliable
        </div>
    </div>
</body>
</html>
