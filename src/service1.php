<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Truck Tire Services | Premium On-Demand Solutions</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #d32f2f;
            --primary-dark: #b71c1c;
            --secondary: #2c2c2c;
            --accent: #ff6b35;
            --background: #fefefe;
            --surface: #f8f8f8;
            --text: #2c2c2c;
            --text-muted: #666666;
            --glass: rgba(255, 255, 255, 0.9);
            --warm-white: #fefefe;
            --cream: #faf9f7;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--warm-white);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
            opacity: 0;
            animation: pageLoad 1.2s ease-out forwards;
        }

        @keyframes pageLoad {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animated Background */
        .bg-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .bg-gradient {
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 20% 50%, rgba(211, 47, 47, 0.1) 0%, transparent 30%),
                        radial-gradient(circle at 80% 20%, rgba(255, 107, 53, 0.08) 0%, transparent 20%),
                        radial-gradient(circle at 40% 80%, rgba(183, 28, 28, 0.05) 0%, transparent 25%);
            animation: bgMove 20s ease-in-out infinite;
            opacity: 0.3;
        }

        @keyframes bgMove {
            0%, 100% { transform: translate(-20%, -20%) rotate(0deg); }
            33% { transform: translate(-30%, -10%) rotate(120deg); }
            66% { transform: translate(-10%, -30%) rotate(240deg); }
        }

        /* Navigation */
        .nav {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 20px 0;
            background: rgba(254, 254, 254, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(211, 47, 47, 0.1);
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 0 2px 20px rgba(211, 47, 47, 0.05);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: logoGlow 3s ease-in-out infinite alternate;
        }

        @keyframes logoGlow {
            0% { filter: drop-shadow(0 0 5px rgba(211, 47, 47, 0.3)); }
            100% { filter: drop-shadow(0 0 15px rgba(211, 47, 47, 0.5)); }
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 40px;
        }

        .nav-links a {
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 10px 20px;
            border-radius: 25px;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            background: rgba(211, 47, 47, 0.05);
            color: var(--primary);
        }

        .nav-links a:hover::after {
            width: 60%;
        }

        /* Mobile Menu */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 10px;
            z-index: 1001;
            position: relative;
        }

        .hamburger-line {
            width: 25px;
            height: 3px;
            background: var(--text);
            margin: 3px 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .mobile-menu-toggle.active .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
            background: var(--primary);
        }

        .mobile-menu-toggle.active .hamburger-line:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-toggle.active .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
            background: var(--primary);
        }

        .mobile-menu {
            position: fixed;
            top: 0;
            left: -100%;
            width: 280px;
            height: 100vh;
            background: rgba(254, 254, 254, 0.98);
            backdrop-filter: blur(20px);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            z-index: 1000;
            padding-top: 100px;
            padding-left: 40px;
            box-shadow: 2px 0 20px rgba(211, 47, 47, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .mobile-menu.active {
            left: 0;
        }

        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .mobile-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .mobile-menu-links {
            list-style: none;
            text-align: left;
            width: 100%;
        }

        .mobile-menu-links li {
            margin: 20px 0;
            opacity: 0;
            transform: translateX(-30px);
            transition: all 0.4s ease;
        }

        .mobile-menu.active .mobile-menu-links li {
            opacity: 1;
            transform: translateX(0);
        }

        .mobile-menu-links li:nth-child(1) { transition-delay: 0.1s; }
        .mobile-menu-links li:nth-child(2) { transition-delay: 0.2s; }
        .mobile-menu-links li:nth-child(3) { transition-delay: 0.3s; }
        .mobile-menu-links li:nth-child(4) { transition-delay: 0.4s; }

        .mobile-menu-links a {
            color: var(--text);
            text-decoration: none;
            font-size: 1.3rem;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
            display: block;
            padding: 12px 20px;
            border-radius: 10px;
            margin-right: 20px;
        }

        .mobile-menu-links a:hover {
            color: var(--primary);
            background: rgba(211, 47, 47, 0.1);
            transform: translateX(5px);
        }

        .mobile-menu-links a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 3px;
            background: var(--primary);
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .mobile-menu-links a:hover::before {
            width: 4px;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
            padding-top: 80px;
            background: linear-gradient(135deg, var(--warm-white) 0%, var(--cream) 100%);
        }

        .hero-content {
            max-width: 1200px;
            z-index: 2;
            padding: 0 20px;
            animation: heroSlideUp 1.5s ease-out 0.3s both;
        }

        @keyframes heroSlideUp {
            0% {
                opacity: 0;
                transform: translateY(60px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-title {
            font-size: clamp(3rem, 8vw, 7rem);
            font-weight: 800;
            margin-bottom: 30px;
            background: linear-gradient(135deg, var(--text) 0%, var(--primary) 50%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: titlePulse 4s ease-in-out infinite alternate;
        }

        @keyframes titlePulse {
            0% { filter: drop-shadow(0 0 10px rgba(211, 47, 47, 0.2)); }
            100% { filter: drop-shadow(0 0 25px rgba(211, 47, 47, 0.4)); }
        }

        .hero-subtitle {
            font-size: 1.4rem;
            color: var(--text-muted);
            margin-bottom: 50px;
            font-weight: 300;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            animation: subtitleFade 1.8s ease-out 0.6s both;
        }

        @keyframes subtitleFade {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 15px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 18px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(211, 47, 47, 0.3);
            position: relative;
            overflow: hidden;
            animation: ctaFloat 2s ease-out 0.9s both;
        }

        @keyframes ctaFloat {
            0% {
                opacity: 0;
                transform: translateY(40px) scale(0.9);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .hero-cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .hero-cta:hover::before {
            left: 100%;
        }

        .hero-cta:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 20px 50px rgba(211, 47, 47, 0.4);
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            pointer-events: none;
            opacity: 0.3;
        }

        .tire-icon {
            width: 60px;
            height: 60px;
            border: 3px solid var(--primary);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .tire-icon:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
        .tire-icon:nth-child(2) { top: 70%; right: 15%; animation-delay: 2s; }
        .tire-icon:nth-child(3) { top: 40%; left: 5%; animation-delay: 4s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.3; }
            50% { transform: translateY(-30px) rotate(180deg); opacity: 0.6; }
        }

        /* Scroll Animations */
        .scroll-element {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .scroll-element.in-view {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll-element.slide-left {
            transform: translateX(-50px);
        }

        .scroll-element.slide-left.in-view {
            transform: translateX(0);
        }

        .scroll-element.slide-right {
            transform: translateX(50px);
        }

        .scroll-element.slide-right.in-view {
            transform: translateX(0);
        }

        /* Services Section */
        .services {
            padding: 120px 0;
            position: relative;
            background: var(--warm-white);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section-title {
            text-align: center;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--text), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: var(--text-muted);
            margin-bottom: 80px;
            font-weight: 300;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 40px;
            margin-top: 60px;
        }

        .service-card {
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(211, 47, 47, 0.1);
            border-radius: 24px;
            padding: 50px 40px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0 10px 40px rgba(211, 47, 47, 0.1);
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .service-card:hover::before {
            opacity: 0.05;
        }

        .service-card:hover {
            transform: translateY(-20px) scale(1.02);
            border-color: var(--primary);
            box-shadow: 0 30px 80px rgba(211, 47, 47, 0.2);
        }

        .service-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            position: relative;
            overflow: hidden;
            animation: iconBounce 2s ease-in-out infinite;
        }

        @keyframes iconBounce {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-5px) scale(1.05); }
        }

        .service-icon::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(var(--accent), var(--primary), var(--accent));
            animation: iconRotate 4s linear infinite;
            opacity: 0.2;
        }

        @keyframes iconRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .service-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text);
        }

        .service-description {
            color: var(--text-muted);
            margin-bottom: 30px;
            font-size: 1.1rem;
            line-height: 1.7;
        }

        .service-features {
            list-style: none;
            text-align: left;
        }

        .service-features li {
            padding: 12px 0;
            color: var(--text);
            position: relative;
            padding-left: 35px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .service-features li::before {
            content: '⚡';
            position: absolute;
            left: 0;
            color: var(--accent);
            font-size: 1.2rem;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.2); }
        }

        .service-features li:hover {
            color: var(--primary);
            transform: translateX(10px);
        }

        /* Stats Section */
        .stats {
            padding: 100px 0;
            background: var(--cream);
            position: relative;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }

        .stat-card {
            text-align: center;
            padding: 40px 20px;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-10px);
        }

        .stat-number {
            font-size: 4rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            animation: countUp 2s ease-out;
        }

        @keyframes countUp {
            0% { transform: scale(0.5); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        .stat-label {
            font-size: 1.1rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        /* Brands Section */
        .brands {
            padding: 120px 0;
            background: var(--warm-white);
        }

        .brands-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-top: 60px;
        }

        .brand-card {
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(211, 47, 47, 0.1);
            border-radius: 20px;
            padding: 40px 20px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(211, 47, 47, 0.05);
        }

        .brand-card:hover {
            transform: translateY(-10px) rotate(1deg);
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(211, 47, 47, 0.15);
        }

        .brand-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 1.5rem;
            position: relative;
            overflow: hidden;
            animation: logoSpin 3s ease-in-out infinite;
        }

        @keyframes logoSpin {
            0%, 100% { transform: rotateY(0deg); }
            50% { transform: rotateY(180deg); }
        }

        .brand-logo::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
        }

        .brand-card:hover .brand-logo::after {
            left: 100%;
        }

        /* CTA Section */
        .cta {
            padding: 120px 0;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            animation: bgPattern 20s linear infinite;
        }

        @keyframes bgPattern {
            0% { transform: translateX(0) translateY(0); }
            100% { transform: translateX(100px) translateY(100px); }
        }

        .cta-content {
            position: relative;
            z-index: 2;
        }

        .cta-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            margin-bottom: 30px;
            color: white;
            animation: ctaTitleGlow 3s ease-in-out infinite alternate;
        }

        @keyframes ctaTitleGlow {
            0% { text-shadow: 0 0 20px rgba(255, 255, 255, 0.3); }
            100% { text-shadow: 0 0 40px rgba(255, 255, 255, 0.6); }
        }

        .cta-subtitle {
            font-size: 1.3rem;
            margin-bottom: 50px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 300;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 15px;
            background: white;
            color: var(--primary);
            padding: 20px 50px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.2rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .cta-button:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-toggle {
                display: flex;
            }
            
            .services-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .service-card {
                padding: 40px 30px;
            }
            
            .brands-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-title {
                font-size: clamp(2.5rem, 10vw, 4rem);
            }

            .hero-subtitle {
                font-size: 1.2rem;
                padding: 0 10px;
            }

            .section-title {
                font-size: clamp(2rem, 8vw, 3rem);
            }

            .cta-title {
                font-size: clamp(2rem, 8vw, 3rem);
            }
        }

        @media (max-width: 480px) {
            .hero-content {
                padding: 0 15px;
            }

            .service-card {
                padding: 30px 20px;
            }

            .brands-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .mobile-menu {
                width: 260px;
                padding-left: 30px;
            }

            .mobile-menu-links a {
                font-size: 1.2rem;
                padding: 10px 15px;
            }
        }

        /* Fade in animation classes */
        .fade-in {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Scroll to top button */
        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            z-index: 1000;
        }

        .scroll-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 10px 25px rgba(211, 47, 47, 0.4);
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-container">
        <div class="bg-gradient"></div>
    </div>

    <!-- Navigation -->
    <nav class="nav">
        <div class="nav-container">
            <div class="logo">Prabhat Tyre House</div>
            <ul class="nav-links">
                <li><a href="frontage.php">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#brands">Brands</a></li>
                <li><a href="contactus1.php">Contact</a></li>
            </ul>
            <div class="mobile-menu-toggle" id="mobileMenuToggle">
                <div class="hamburger-line"></div>
                <div class="hamburger-line"></div>
                <div class="hamburger-line"></div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <ul class="mobile-menu-links">
            <li><a href="frontage.php">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#brands">Brands</a></li>
            <li><a href="contacts1.php">Contact</a></li>
        </ul>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="floating-element tire-icon"></div>
        <div class="floating-element tire-icon"></div>
        <div class="floating-element tire-icon"></div>
        
        <div class="hero-content">
            <h1 class="hero-title">Elite Truck Tire Solutions</h1>
            <p class="hero-subtitle">Revolutionary on-demand tire services that redefine convenience, quality, and professional excellence for commercial vehicles</p>
            <a href="#services" class="hero-cta">
                <span>🚀</span>
                Discover Premium Services
            </a>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card scroll-element">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Emergency Service</div>
                </div>
                <div class="stat-card scroll-element">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Premium Brands</div>
                </div>
                <div class="stat-card scroll-element">
                    <div class="stat-number">99%</div>
                    <div class="stat-label">Customer Satisfaction</div>
                </div>
                <div class="stat-card scroll-element">
                    <div class="stat-number">10K+</div>
                    <div class="stat-label">Tires Delivered</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="container">
            <h2 class="section-title scroll-element">Elite Service Portfolio</h2>
            <p class="section-subtitle scroll-element">Cutting-edge solutions designed for the modern commercial vehicle industry</p>
            
            <div class="services-grid">
                <div class="service-card scroll-element slide-left">
                    <div class="service-icon">🚚</div>
                    <h3 class="service-title">Instant Doorstep Delivery</h3>
                    <p class="service-description">Revolutionary on-site service that brings professional tire installation directly to your location with military precision timing.</p>
                    <ul class="service-features">
                        <li>Lightning-fast 30-minute response time</li>
                        <li>Advanced GPS tracking with live updates</li>
                        <li>Professional installation by certified technicians</li>
                        <li>Free delivery within metropolitan areas</li>
                        <li>Emergency services available 24/7/365</li>
                        <li>Multi-vehicle fleet support</li>
                    </ul>
                </div>

                <div class="service-card scroll-element">
                    <div class="service-icon">☎️</div>
                    <h3 class="service-title">AI-Powered Warranty Claims</h3>
                    <p class="service-description">Revolutionary warranty processing system that eliminates paperwork and delivers instant resolution through advanced automation.</p>
                    <ul class="service-features">
                        <li>Instant claim processing via AI system</li>
                        <li>Zero paperwork - fully digital process</li>
                        <li>Direct manufacturer API integration</li>
                        <li>Real-time claim status tracking</li>
                        <li>Expert technical assessment on-demand</li>
                        <li>Same-day replacement guarantee</li>
                    </ul>
                </div>

                <div class="service-card scroll-element slide-right">
                    <div class="service-icon">🏪</div>
                    <h3 class="service-title">Unlimited Inventory Access</h3>
                    <p class="service-description">Access to the world's largest tire database with intelligent matching system that finds the perfect tire for any commercial vehicle.</p>
                    <ul class="service-features">
                        <li>50+ premium international brands</li>
                        <li>Complete size range from compact to heavy-duty</li>
                        <li>Specialized tires for extreme conditions</li>
                        <li>AI-powered tire recommendation engine</li>
                        <li>Bulk pricing with volume discounts</li>
                        <li>Latest eco-friendly tire technologies</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands Section -->
    <section class="brands" id="brands">
        <div class="container">
            <h2 class="section-title scroll-element">World-Class Tire Partners</h2>
            <p class="section-subtitle scroll-element">Exclusively partnered with the globe's most innovative tire manufacturers</p>
            
                <div class="brand-card scroll-element">
                    <div class="brand-logo">JK</div>
                    <h4>JK Tyre & Industries</h4>
                </div>
                <div class="brand-card scroll-element">
                    <div class="brand-logo">AP</div>
                    <h4>Apollo Tyres</h4>
                </div>
                <div class="brand-card scroll-element">
                    <div class="brand-logo">BR</div>
                    <h4>Bridgestone</h4>
                </div>
                <div class="brand-card scroll-element">
                    <div class="brand-logo">MI</div>
                    <h4>Michelin</h4>
                </div>
                <div class="brand-card scroll-element">
                    <div class="brand-logo">AS</div>
                    <h4>Ascenso</h4>
                </div>
                
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta" id="contact">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title scroll-element">Ready for the Future?</h2>
                <p class="cta-subtitle scroll-element">Join thousands of satisfied customers who've revolutionized their tire service experience</p>
                <a href="#" class="cta-button scroll-element">
                    <span>🔥</span>
                    Start Your Elite Experience
                </a>
            </div>
        </div>
    </section>

    <!-- Scroll to Top Button -->
    <div class="scroll-top" id="scrollTop">
        ↑
    </div>

    <script>
        // Page load animation
        window.addEventListener('load', () => {
            document.body.style.opacity = '1';
        });

        // Enhanced scroll animations with intersection observer
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('in-view');
                        if (entry.target.classList.contains('fade-in')) {
                            entry.target.classList.add('visible');
                        }
                    }, index * 100);
                }
            });
        }, observerOptions);

        // Observe all scroll elements
        document.querySelectorAll('.scroll-element, .fade-in').forEach(el => {
            observer.observe(el);
        });

        // Scroll to top functionality
        const scrollTopBtn = document.getElementById('scrollTop');
        
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('.nav');
            const scrollY = window.scrollY;
            
            // Dynamic navigation background
            if (scrollY > 100) {
                nav.style.background = 'rgba(254, 254, 254, 0.98)';
                nav.style.borderBottomColor = 'rgba(211, 47, 47, 0.2)';
                nav.style.boxShadow = '0 2px 30px rgba(211, 47, 47, 0.1)';
            } else {
                nav.style.background = 'rgba(254, 254, 254, 0.95)';
                nav.style.borderBottomColor = 'rgba(211, 47, 47, 0.1)';
                nav.style.boxShadow = '0 2px 20px rgba(211, 47, 47, 0.05)';
            }
            
            // Show/hide scroll to top button
            if (scrollY > 500) {
                scrollTopBtn.classList.add('visible');
            } else {
                scrollTopBtn.classList.remove('visible');
            }
            
            // Parallax effect for floating elements
            const floatingElements = document.querySelectorAll('.floating-element');
            floatingElements.forEach((element, index) => {
                const speed = 0.5 + (index * 0.1);
                element.style.transform = `translateY(${scrollY * speed}px)`;
            });
        });

        // Scroll to top button click
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Enhanced service card interactions
        document.querySelectorAll('.service-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-20px) scale(1.02) rotateX(5deg)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) scale(1) rotateX(0deg)';
            });
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
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

        // Enhanced button interactions with ripple effect
        document.querySelectorAll('.hero-cta, .cta-button').forEach(button => {
            button.addEventListener('click', (e) => {
                // Create ripple effect
                const ripple = document.createElement('span');
                const rect = button.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: rgba(255, 255, 255, 0.3);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple 0.6s ease-out;
                    pointer-events: none;
                `;
                
                button.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple animation keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Counter animation for stats
        const animateCounters = () => {
            const counters = document.querySelectorAll('.stat-number');
            counters.forEach(counter => {
                const target = counter.textContent;
                const isPercentage = target.includes('%');
                const isTime = target.includes('/');
                const isPlus = target.includes('+');
                
                if (!isTime) {
                    let currentValue = 0;
                    const targetValue = parseInt(target.replace(/[^0-9]/g, ''));
                    const increment = targetValue / 50;
                    
                    const timer = setInterval(() => {
                        currentValue += increment;
                        if (currentValue >= targetValue) {
                            currentValue = targetValue;
                            clearInterval(timer);
                        }
                        
                        let displayValue = Math.floor(currentValue);
                        if (isPercentage) displayValue += '%';
                        if (isPlus) displayValue += '+';
                        
                        counter.textContent = displayValue;
                    }, 30);
                }
            });
        };

        // Trigger counter animation when stats section is visible
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    statsObserver.unobserve(entry.target);
                }
            });
        });

        const statsSection = document.querySelector('.stats');
        if (statsSection) {
            statsObserver.observe(statsSection);
        }

        // Add stagger animation to brand cards
        const brandCards = document.querySelectorAll('.brand-card');
        brandCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });

        // Add mouse move parallax effect to hero section
        document.addEventListener('mousemove', (e) => {
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            
            const hero = document.querySelector('.hero');
            const heroTitle = document.querySelector('.hero-title');
            
            if (hero && heroTitle) {
                const moveX = (mouseX - 0.5) * 20;
                const moveY = (mouseY - 0.5) * 20;
                
                heroTitle.style.transform = `translate(${moveX}px, ${moveY}px)`;
            }
        });

        // Add loading animation for service icons
        const serviceIcons = document.querySelectorAll('.service-icon');
        serviceIcons.forEach((icon, index) => {
            setTimeout(() => {
                icon.style.animation = 'iconBounce 2s ease-in-out infinite';
            }, index * 200);
        });

        // Add scroll-based brand logo animations
        window.addEventListener('scroll', () => {
            const brandLogos = document.querySelectorAll('.brand-logo');
            const scrollY = window.scrollY;
            
            brandLogos.forEach((logo, index) => {
                const speed = 0.1 + (index * 0.02);
                logo.style.transform = `rotateY(${scrollY * speed}deg)`;
            });
        });

        // Enhanced mobile menu implementation
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const mobileMenuLinks = document.querySelectorAll('.mobile-menu-links a');

        const openMobileMenu = () => {
            mobileMenuToggle.classList.add('active');
            mobileMenu.classList.add('active');
            mobileMenuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        const closeMobileMenu = () => {
            mobileMenuToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
            mobileMenuOverlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        };

        mobileMenuToggle.addEventListener('click', () => {
            if (mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });

        // Close mobile menu when clicking on overlay
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);

        // Close mobile menu when clicking on a link
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });

        // Close mobile menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });

        // Close menu on window resize to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768 && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });

        // Enhanced mobile menu (for future implementation)
        const mobileMenuToggleOld = () => {
            // Implementation for mobile menu toggle
            console.log('Mobile menu toggle');
        };

        // Add keyboard navigation support
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Home') {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
            if (e.key === 'End') {
                e.preventDefault();
                window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
            }
        });

        // Performance optimization: Throttle scroll events
        let scrollTimeout;
        const throttledScroll = () => {
            if (!scrollTimeout) {
                scrollTimeout = setTimeout(() => {
                    // Scroll-dependent animations go here
                    scrollTimeout = null;
                }, 16); // ~60fps
            }
        };

        window.addEventListener('scroll', throttledScroll);
    </script>
</body>
</html>