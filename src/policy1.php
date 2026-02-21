
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Policies - Warranty, Shipping, Returns, Terms & Privacy | Prabhat Tyre House</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            scroll-behavior: smooth;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px 0;
            animation: fadeInDown 1s ease-out;
        }

        .logo-container {
            display: inline-block;
            background: linear-gradient(45deg, rgba(220, 53, 69, 0.1), rgba(0, 0, 0, 0.05));
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(220, 53, 69, 0.2);
            transition: all 0.3s ease;
        }

        .logo-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .logo-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: block;
            margin: 0 auto 15px;
            object-fit: contain;
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.3);
            border: 3px solid rgba(220, 53, 69, 0.2);
        }

        .band-name {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, #dc3545, #000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 5px;
        }

        .band-tagline {
            color: #666;
            font-size: 0.9rem;
            font-style: italic;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
            animation: fadeInDown 1s ease-out 0.2s both;
        }

        .header h1 {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(45deg, #dc3545, #000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: relative;
        }

        .header h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(45deg, #dc3545, #000);
            border-radius: 2px;
        }

        .header p {
            font-size: 1.2rem;
            color: #666;
            max-width: 600px;
            margin: 20px auto 0;
        }

        .home-button {
            position: fixed;
            top: 30px;
            left: 30px;
            background: linear-gradient(45deg, #dc3545, #c82333);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
            transition: all 0.3s ease;
            z-index: 1000;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            backdrop-filter: blur(10px);
        }

        .home-button:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
            background: linear-gradient(45deg, #c82333, #a71e2a);
        }

        .home-button::before {
            content: '←';
            font-size: 1.2rem;
        }

        .policies-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .policy-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(220, 53, 69, 0.1);
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease-out forwards;
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .policy-card:nth-child(1) { animation-delay: 0.1s; }
        .policy-card:nth-child(2) { animation-delay: 0.2s; }
        .policy-card:nth-child(3) { animation-delay: 0.3s; }
        .policy-card:nth-child(4) { animation-delay: 0.4s; }
        .policy-card:nth-child(5) { animation-delay: 0.5s; }

        .policy-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
            border-color: rgba(220, 53, 69, 0.3);
        }

        .policy-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #dc3545;
            position: relative;
        }

        .policy-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #dc3545, #c82333);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-right: 15px;
            box-shadow: 0 6px 15px rgba(220, 53, 69, 0.4);
            transition: all 0.3s ease;
        }

        .policy-card:hover .policy-icon {
            transform: rotate(10deg) scale(1.1);
        }

        .policy-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #000;
            background: linear-gradient(45deg, #000, #dc3545);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .policy-content {
            color: #555;
            line-height: 1.8;
            position: relative;
        }

        .policy-content h3 {
            color: #dc3545;
            font-size: 1.2rem;
            margin: 20px 0 10px 0;
            font-weight: 600;
            position: relative;
            padding-left: 15px;
        }

        .policy-content h3::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 20px;
            background: linear-gradient(45deg, #dc3545, #c82333);
            border-radius: 2px;
        }

        .policy-content ul {
            margin: 15px 0;
            padding-left: 20px;
        }

        .policy-content ol {
            margin: 15px 0;
            padding-left: 20px;
        }

        .policy-content li {
            margin: 8px 0;
            position: relative;
            transition: all 0.3s ease;
            padding: 5px 0;
            border-radius: 5px;
        }

        .policy-content li:hover {
            background: rgba(220, 53, 69, 0.05);
            padding-left: 10px;
            transform: translateX(5px);
        }

        .policy-content li::marker {
            color: #dc3545;
        }

        .highlight {
            background: linear-gradient(120deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.05) 100%);
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border-left: 4px solid #dc3545;
            position: relative;
            transition: all 0.3s ease;
        }

        .highlight:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.2);
        }

        .contact-section {
            background: linear-gradient(135deg, #000 0%, #333 100%);
            color: white;
            padding: 50px;
            border-radius: 25px;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
            animation: fadeIn 1s ease-out 0.5s both;
            position: relative;
            overflow: hidden;
        }

        .contact-section h2 {
            font-size: 2.2rem;
            margin-bottom: 15px;
            color: #dc3545;
            position: relative;
            z-index: 1;
        }

        .contact-section p {
            font-size: 1.1rem;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .contact-button {
            background: linear-gradient(45deg, #dc3545, #c82333);
            color: white;
            border: none;
            padding: 18px 40px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .contact-button:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 30px rgba(220, 53, 69, 0.5);
        }

        .progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(45deg, #dc3545, #c82333);
            transition: width 0.3s ease;
            z-index: 1001;
        }

        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(45deg, #dc3545, #c82333);
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

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

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.2rem;
            }
            
            .policies-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .policy-card {
                padding: 25px;
            }
            
            .home-button {
                top: 20px;
                left: 20px;
                padding: 10px 20px;
                font-size: 0.9rem;
            }
            
            .contact-section {
                padding: 40px 25px;
            }

            .logo-image {
                width: 80px;
                height: 80px;
            }

            .band-name {
                font-size: 1.2rem;
            }
        }

        .tooltip {
            position: relative;
            cursor: help;
        }

        .tooltip::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.9);
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .tooltip:hover::after {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(-5px);
        }

        .indian-compliance {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            font-weight: 600;
        }

        .delivery-type {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin: 10px 0;
            font-weight: 600;
        }

        .section-divider {
            width: 100%;
            height: 2px;
            background: linear-gradient(45deg, #dc3545, #c82333);
            margin: 30px 0;
            border-radius: 1px;
        }
    </style>
</head>
<body>
    <div class="progress-bar"></div>

    <a href="frontage.php" class="home-button">Home</a>
    
    <button class="back-to-top">↑</button>

    <div class="container">
        <div class="logo-section">
            <div class="logo-container">
                <img src="logo.png" alt="Prabhat Tyre House Logo" class="logo-image">
                <div class="band-name">Prabhat Tyre House</div>
                <div class="band-tagline">Quality Products, Stellar Service</div>
            </div>
        </div>

        <div class="header"> 
            <h1>Our Policies</h1>
            <p>Comprehensive policies designed to protect your interests and ensure the best possible experience with our products and services, in compliance with Indian regulations.</p>
        </div>

        <div class="policies-grid">
            <div class="policy-card">
                <div class="policy-header">
                    <div class="policy-icon">🛡️</div>
                    <h2 class="policy-title">Warranty Policy</h2>
                </div>
                <div class="policy-content">
                    <p>We stand behind the quality of our products and offer comprehensive warranty coverage to ensure your complete satisfaction.</p>
                    
                    <h3>Coverage Period</h3>
                    <ul>
                        <li class="tooltip" data-tooltip="Varies by manufacturer and product type">Warranty coverage depends on the specific product and brand. It will remain valid as per the warranty period offered by the respective company. You can check the exact warranty details by visiting the product information section.</li>
                    </ul>

                    <h3>What's Covered</h3>
                    <ul>
                        <li>Manufacturing defects and material faults</li>
                        <li>Functional issues under normal use conditions</li>
                        <li>Performance degradation beyond specifications</li>
                        <li>Parts replacement and labor costs (as per manufacturer terms)</li>
                    </ul>

                    <div class="highlight">
                        <strong>Important Notice:</strong> Warranty does not cover damage from misuse, accidents, normal wear and tear, or unauthorized modifications. Original purchase receipt required for all warranty claims.
                    </div>

                    <h3>Quick Claim Process</h3>
                    <p>Contact our support team with your order number and description of the issue. We'll guide you through our streamlined warranty claim process and provide immediate assistance as per Consumer Protection Act, 2019.</p>
                </div>
            </div>
            
            <div class="policy-card">
                <div class="policy-header">
                    <div class="policy-icon">🚚</div>
                    <h2 class="policy-title">Delivery Policy</h2>
                </div>
                <div class="policy-content">
                    <p>Fast, reliable delivery with multiple options to meet your needs. We're committed to getting your order to you quickly and safely across India.</p>
                    
                    <h3>Delivery Options</h3>
                    <div class="delivery-type">
                        <strong>🏃‍♂️ Standard Delivery:</strong> Same day or 1-2 business days for local areas
                    </div>
                    
                    <div class="delivery-type">
                        <strong>🚛 Company Delivery:</strong> Available for bulk orders (14+ tyres of single brand)
                        <ul style="margin-top: 10px; color: #fff;">
                            <li>Within 50 km: 1-2 business days</li>
                            <li>Above 50-60 km: 3-5 business days (depending on location)</li>
                            <li>Installation service available on request</li>
                        </ul>
                    </div>

                    <h3>Processing Time</h3>
                    <ul>
                        <li>In-stock items: Same day processing</li>
                        <li>Custom orders: 2-3 business days</li>
                        <li>Special import items: 7-15 business days</li>
                        <li>Bulk orders: Contact for timeline</li>
                    </ul>

                    <div class="highlight">
                        <strong>Processing Note:</strong> Orders placed after 6 PM will be processed the next business day. Sunday orders are processed on Monday.
                    </div>

                    <h3>Real-Time Tracking</h3>
                    <p>All orders include comprehensive tracking information o our website. Monitor your delivery progress with our tracking system.</p>
                </div>
            </div>

            <div class="policy-card">
                <div class="policy-header">
                    <div class="policy-icon">↩️</div>
                    <h2 class="policy-title">Return & Replacement Policy</h2>
                </div>
                <div class="policy-content">
                    <p>We do not offer general returns or replacements. Returns and replacements are only applicable in specific circumstances as outlined below, in compliance with Indian consumer protection laws.</p>
                    
                    <h3>When Returns/Replacements Apply</h3>
                    <div class="highlight">
                        <strong>🔴 IMPORTANT:</strong> We do NOT offer returns or replacements for change of mind, size issues, or general dissatisfaction.
                    </div>
                    
                    <ul>
                        <li class="tooltip" data-tooltip="Physical damage during shipping">Damaged products received during delivery</li>
                        <li class="tooltip" data-tooltip="Incorrect specifications or model">Wrong product delivered (different from order)</li>
                        <li class="tooltip" data-tooltip="Quantity or specification mismatch">Order discrepancy (incorrect quantity/specifications)</li>
                    </ul>

                    <h3>Claim Window</h3>
                    <ul>
                        <li>Damaged products: Report within 24 hours of delivery</li>
                        <li>Wrong products: Report within 48 hours of delivery</li>
                        <li>Order discrepancies: Report within 48 hours of delivery</li>
                        <li>Photo/video evidence required for all claims</li>
                    </ul>

                    <h3>Claim Process</h3>
                    <ul>
                        <li>Contact customer service immediately upon discovery</li>
                        <li>Provide order number and detailed description</li>
                        <li>Submit clear photos/videos of the issue</li>
                        <li>Keep products in original condition for inspection</li>
                        <li>Our team will verify and approve valid claims</li>
                    </ul>

                    <h3>Resolution Process</h3>
                    <p>Valid claims will be resolved through replacement (subject to stock availability) or full refund within 7-14 business days. Bank refunds take additional 3-5 working days.</p>
                </div>
            </div>

            <div class="policy-card">
                <div class="policy-header">
                    <div class="policy-icon">📋</div>
                    <h2 class="policy-title">Terms & Conditions</h2>
                </div>
                <div class="policy-content">
                    <p>By using our services, you agree to these terms and conditions. These terms are governed by Indian law and regulations.</p>
                    
                    <h3>Acceptance of Terms</h3>
                    <ul>
                        <li>By placing an order, you accept these terms</li>
                        <li>Terms are subject to change with prior notice</li>
                        <li>Continued use implies acceptance of updated terms</li>
                    </ul>

                    <h3>Pricing & Taxation</h3>
                    <ul>
                        <li><strong>Website prices are displayed WITHOUT GST</strong></li>
                        <li>GST will be calculated and added during checkout process</li>
                        <li>Final invoice will clearly show GST amount and total</li>
                        <li>GST rates as per current government regulations</li>
                        <li>Prices are subject to change without prior notice</li>
                        <li>Additional charges (if any) will be communicated before payment</li>
                    </ul>

                    <h3>Product Information</h3>
                    <ul>
                        <li>All product specifications are as per manufacturer details</li>
                        <li>Images are for representation purposes only</li>
                        <li>Stock availability is updated regularly but not guaranteed</li>
                        <li>Product descriptions are based on manufacturer specifications</li>
                    </ul>

                    <h3>Payment Terms</h3>
                    <ul>
                        <li>Payment required before dispatch (except authorized credit accounts)</li>
                        <li>All payments processed through secure, PCI-compliant systems</li>
                        <li>GST applicable as per Indian tax regulations</li>
                        <li>Failed payments may result in order cancellation</li>
                    </ul>

                    <h3>Limitation of Liability</h3>
                    <ul>
                        <li>Our liability is limited to the value of products purchased</li>
                        <li>We are not liable for consequential or indirect damages</li>
                        <li>Force majeure events beyond our control are excluded</li>
                        <li>Installation services carry separate terms and liability</li>
                    </ul>

                    <h3>Dispute Resolution</h3>
                    <ol>
                        <li>Direct negotiation with our customer service team</li>
                        <li>Internal escalation to management level</li>
                        <li>Consumer forum mediation if required</li>
                        <li>Legal proceedings in appropriate jurisdiction</li>
                    </ol>
                </div>
            </div>

            <div class="policy-card">
                <div class="policy-header">
                    <div class="policy-icon">🔒</div>
                    <h2 class="policy-title">Privacy Policy</h2>
                </div>
                <div class="policy-content">
                    <p>We are committed to protecting your privacy and personal information in compliance with Indian data protection laws and regulations.</p>
                    
                    <h3>Information We Collect</h3>
                    <ul>
                        <li>Personal details: Name, address, phone number, email</li>
                        <li>Vehicle information: Registration details, tyre specifications</li>
                        <li>Payment information: Transaction details (securely processed)</li>
                        <li>Usage data: Website interactions and preferences</li>
                    </ul>

                    <h3>How We Use Your Information</h3>
                    <ul>
                        <li>Order processing and delivery coordination</li>
                        <li>Customer service and support communications</li>
                        <li>Product recommendations and service updates</li>
                        <li>Compliance with legal and regulatory requirements</li>
                    </ul>

                    <h3>Information Sharing</h3>
                    <ul>
                        <li>Delivery partners: Only necessary shipping details</li>
                        <li>Payment processors: Secure transaction processing</li>
                        <li>Government authorities: As required by Indian law</li>
                        <li>We never sell personal data to third parties</li>
                    </ul>

                    <h3>Data Security</h3>
                    <ul>
                        <li>Industry-standard encryption for data transmission</li>
                        <li>Secure servers with regular security audits</li>
                        <li>Access controls and employee confidentiality agreements</li>
                        <li>Regular backup and disaster recovery procedures</li>
                    </ul>

                    <h3>Contact for Privacy Concerns</h3>
                    <p>For any privacy-related questions or to exercise your rights, contact our Data Protection Officer at privacy@prabhattyrehouse.com or call our customer service.</p>
                </div>
            </div>
        </div>

        <div class="contact-section">
            <h2>Questions About Our Policies?</h2>
            <p>Our dedicated customer service team is here during business hours to help clarify any questions you might have about our policies. We're committed to your satisfaction and legal compliance!</p>
            <a href="mailto:support@prabhattyrehouse.com" class="contact-button">Contact Support Team</a>
        </div>
    </div>

    
<script src="path/to/user-detector.js"></script>
    <script>
        
        // Progress bar on scroll
        window.addEventListener('scroll', () => {
            const scrolled = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
            document.querySelector('.progress-bar').style.width = scrolled + '%';
        });

        // Back to top button
        const backToTop = document.querySelector('.back-to-top');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Enhanced smooth scrolling
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

        // Enhanced hover effects for policy cards
        const policyCards = document.querySelectorAll('.policy-card');
        
        policyCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
                this.style.zIndex = '10';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.zIndex = '1';
            });
        });

        // Improved intersection observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);

        // Observe all animated elements
        policyCards.forEach(card => {
            observer.observe(card);
        });

        // Add loading animation
        window.addEventListener('load', () => {
            document.body.style.opacity = '1';
        });

        // Enhanced keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });

        // Add click effects to buttons
        document.querySelectorAll('button, .contact-button, .home-button').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple effect styles
        const style = document.createElement('style');
        style.textContent = `
            .ripple {
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.6);
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
            }
            
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Add scroll-triggered animations for list items
        const listItems = document.querySelectorAll('.policy-content li');
        const listObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateX(0)';
                    }, index * 100);
                }
            });
        }, { threshold: 0.5 });

        listItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateX(-20px)';
            item.style.transition = 'all 0.5s ease';
            listObserver.observe(item);
        });

        // Logo hover effect
        const logoContainer = document.querySelector('.logo-container');
        if (logoContainer) {
            logoContainer.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.05)';
            });
            
            logoContainer.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        }

        // Universal New User Detection Script
// Add this script to every page to handle new vs returning users

(function() {
    'use strict';
    
    // Get current user data from session storage
    function getCurrentUser() {
        const userData = sessionStorage.getItem('userData');
        const sellerData = sessionStorage.getItem('sellerData');
        const dealerData = sessionStorage.getItem('dealerData');
        
        if (userData) return JSON.parse(userData);
        if (sellerData) return JSON.parse(sellerData);
        if (dealerData) return JSON.parse(dealerData);
        
        return null;
    }
    
    // Check if this email has visited before
    function isReturningUser(email) {
        if (!email) return false;
        const userVisits = JSON.parse(localStorage.getItem('userVisits') || '{}');
        return userVisits.hasOwnProperty(email);
    }
    
    // Mark user as visited and update visit count
    function markUserAsVisited(email) {
        if (!email) return;
        
        const userVisits = JSON.parse(localStorage.getItem('userVisits') || '{}');
        const now = new Date().toISOString();
        
        if (userVisits[email]) {
            // Returning user
            userVisits[email].lastVisit = now;
            userVisits[email].visitCount = (userVisits[email].visitCount || 1) + 1;
        } else {
            // New user
            userVisits[email] = {
                firstVisit: now,
                lastVisit: now,
                visitCount: 1,
                isNew: true
            };
        }
        
        localStorage.setItem('userVisits', JSON.stringify(userVisits));
    }
    
    // Check if user session has changed
    function hasUserSessionChanged() {
        const currentUser = getCurrentUser();
        if (!currentUser || !currentUser.email) return false;
        
        const lastSessionEmail = sessionStorage.getItem('lastSessionEmail');
        
        if (lastSessionEmail !== currentUser.email) {
            sessionStorage.setItem('lastSessionEmail', currentUser.email);
            return true;
        }
        
        return false;
    }
    
    // Get user status information
    function getUserStatus() {
        const currentUser = getCurrentUser();
        if (!currentUser || !currentUser.email) {
            return {
                isLoggedIn: false,
                isNewUser: false,
                isReturningUser: false,
                userData: null
            };
        }
        
        const isReturning = isReturningUser(currentUser.email);
        const sessionChanged = hasUserSessionChanged();
        
        return {
            isLoggedIn: true,
            isNewUser: !isReturning,
            isReturningUser: isReturning,
            sessionChanged: sessionChanged,
            userData: currentUser,
            email: currentUser.email
        };
    }
    
    // Update page elements based on user status
    function updatePageForUser() {
        const status = getUserStatus();
        
        if (status.isLoggedIn) {
            // Mark user as visited
            markUserAsVisited(status.email);
            
            // Update welcome message if element exists
            const userNameElement = document.getElementById('userName');
            if (userNameElement && status.userData.name) {
                const firstName = status.userData.name.split(' ')[0];
                let welcomeText = `Hi ${firstName}!`;
                
                if (status.isReturningUser) {
                    welcomeText = `Welcome back, ${firstName}!`;
                }
                
                // Add user type if seller or dealer
                if (status.userData.type === 'seller') {
                    welcomeText += ' (Seller)';
                } else if (status.userData.type === 'dealer') {
                    welcomeText += ' (Dealer)';
                }
                
                userNameElement.textContent = welcomeText;
            }
            
            // Show user welcome div if it exists
            const userWelcomeDiv = document.getElementById('userWelcome');
            if (userWelcomeDiv) {
                userWelcomeDiv.style.display = 'block';
            }
            
            // Add custom class to body for styling
            document.body.classList.add('user-logged-in');
            
            if (status.isNewUser) {
                document.body.classList.add('new-user');
                document.body.classList.remove('returning-user');
            } else {
                document.body.classList.add('returning-user');
                document.body.classList.remove('new-user');
            }
            
            // Trigger custom events
            if (status.sessionChanged) {
                const eventData = {
                    detail: {
                        isNewUser: status.isNewUser,
                        isReturningUser: status.isReturningUser,
                        userData: status.userData
                    }
                };
                
                // Dispatch custom event for new user
                if (status.isNewUser) {
                    window.dispatchEvent(new CustomEvent('newUserDetected', eventData));
                } else {
                    window.dispatchEvent(new CustomEvent('returningUserDetected', eventData));
                }
                
                // General user session change event
                window.dispatchEvent(new CustomEvent('userSessionChanged', eventData));
            }
        } else {
            // User not logged in
            document.body.classList.remove('user-logged-in', 'new-user', 'returning-user');
            
            const userWelcomeDiv = document.getElementById('userWelcome');
            if (userWelcomeDiv) {
                userWelcomeDiv.style.display = 'none';
            }
        }
    }
    
    // Public API - attach to window object for global access
    window.UserDetector = {
        getCurrentUser: getCurrentUser,
        getUserStatus: getUserStatus,
        isReturningUser: isReturningUser,
        markUserAsVisited: markUserAsVisited,
        updatePageForUser: updatePageForUser
    };
    
    // Initialize when DOM is ready
    function initialize() {
        updatePageForUser();
        
        // Set up storage event listener for cross-tab updates
        window.addEventListener('storage', function(e) {
            if (e.key === 'userVisits') {
                updatePageForUser();
            }
        });
    }
    
    // Initialize immediately if DOM is already loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initialize);
    } else {
        initialize();
    }
    
})();

// Usage Examples (you can customize these event listeners on each page):

// Listen for new user detection
window.addEventListener('newUserDetected', function(e) {
    console.log('New user detected:', e.detail.userData);
    // Add your custom logic for new users here
    // Example: Show onboarding tutorial, special offers, etc.
});

// Listen for returning user detection
window.addEventListener('returningUserDetected', function(e) {
    console.log('Returning user detected:', e.detail.userData);
    // Add your custom logic for returning users here
    // Example: Show "Welcome back" message, recent activity, etc.
});

// Listen for any user session change
window.addEventListener('userSessionChanged', function(e) {
    console.log('User session changed:', e.detail);
    // Add your custom logic for user session changes here
});
    </script>
</body>
</html>