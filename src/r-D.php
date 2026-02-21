<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - Tire Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
     * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: white;
            min-height: 100vh;
            padding: 20px;
        }

        .product-container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
            overflow: hidden;
            border: 3px solid #000;
        }

        .product-header {
            background: linear-gradient(135deg, #dc143c, #b91c3c);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .product-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
            flex: 1;
        }

        .product-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .back-to-shop {
            background: rgba(255,255,255,0.2);
            border: 2px solid white;
            color: white;
            padding: 12px 20px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .back-to-shop:hover {
            background: white;
            color: #dc143c;
            transform: scale(1.05);
        }

        .cart-link {
            background: rgba(255,255,255,0.2);
            border: 2px solid white;
            color: white;
            padding: 12px 20px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
            position: relative;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .cart-link:hover {
            background: white;
            color: #dc143c;
            transform: scale(1.05);
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #dc143c;
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            border: 2px solid white;
            min-width: 24px;
        }

        .product-content {
            padding: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: start;
        }

        /* Image Gallery Section */
        .product-gallery {
            position: sticky;
            top: 20px;
        }

        .main-image-container {
            position: relative;
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 20px;
            border: 3px solid #000;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .main-image {
            max-width: 90%;
            max-height: 90%;
            width: auto;
            height: auto;
            object-fit: contain;
            border-radius: 15px;
            transition: transform 0.3s ease;
            display: block;
        }

        .main-image:hover {
            transform: scale(1.05);
        }

        .zoom-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(0,0,0,0.7);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .zoom-icon:hover {
            background: #dc143c;
            transform: scale(1.1);
        }

        .thumbnail-gallery {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding: 10px 0;
        }

        .thumbnail {
            min-width: 60px;
            max-width: 60px;
            height: 60px;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            flex-shrink: 0;
        }

        .thumbnail.active {
            border-color: #dc143c;
            transform: scale(1.1);
        }

        .thumbnail:hover {
            border-color: #000;
            transform: scale(1.05);
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Product Details Section */
        .product-details {
            padding-left: 20px;
        }

        .product-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #000;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .product-brand {
            font-size: 1.3rem;
            color: #dc143c;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .stars {
            color: #ffd700;
            font-size: 1.2rem;
        }

        .rating-text {
            color: #666;
            font-size: 0.9rem;
        }

        .product-price {
            font-size: 2.5rem;
            font-weight: 700;
            color: #dc143c;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .original-price {
            font-size: 1.5rem;
            color: #999;
            text-decoration: line-through;
        }

        .discount-badge {
            background: #dc143c;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .product-description {
            color: #333;
            line-height: 1.6;
            margin-bottom: 30px;
            font-size: 1rem;
        }

        .product-features {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            border: 2px solid #e9ecef;
        }

        .product-features h3 {
            color: #dc143c;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        .features-list {
            list-style: none;
            padding: 0;
        }

        .features-list li {
            padding: 8px 0;
            color: #333;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .features-list li:last-child {
            border-bottom: none;
        }

        .features-list i {
            color: #dc143c;
            width: 20px;
        }

        /* Size Selection */
        .size-selection {
            margin-bottom: 30px;
        }

        .size-selection h3 {
            color: #000;
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .size-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .size-option {
            border: 2px solid #000;
            background: white;
            color: #000;
            padding: 12px 20px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            text-align: center;
            min-width: 120px;
        }

        .size-option:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
        }

        .size-option.selected {
            background: #dc143c;
            color: white;
            border-color: #dc143c;
        }

        /* Quantity and Actions */
        .quantity-section {
            margin-bottom: 30px;
        }

        .quantity-section h3 {
            color: #000;
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .qty-btn {
            background: #000;
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.3rem;
            font-weight: bold;
            transition: all 0.2s ease;
        }

        .qty-btn:hover {
            background: #dc143c;
            transform: scale(1.1);
        }

        .qty-display {
            font-weight: 700;
            font-size: 1.5rem;
            min-width: 50px;
            text-align: center;
            color: #000;
            background: white;
            border: 2px solid #000;
            border-radius: 10px;
            padding: 10px 20px;
        }

        .product-actions {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .action-btn {
            flex: 1;
            padding: 15px 25px;
            border: none;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 55px;
        }

        .add-to-cart-btn {
            background: #000;
            color: white;
            border: 2px solid #000;
        }

        .add-to-cart-btn:hover {
            background: #dc143c;
            border-color: #dc143c;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(220, 20, 60, 0.3);
        }

        .buy-now-btn {
            background: #dc143c;
            color: white;
            border: 2px solid #dc143c;
        }

        .buy-now-btn:hover {
            background: #b91c3c;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(185, 28, 60, 0.3);
        }

        .policy-section {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .policy-btn {
            background: white;
            color: #000;
            border: 2px solid #000;
            padding: 12px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .policy-btn:hover {
            background: #000;
            color: white;
            transform: translateY(-2px);
        }

        .warranty-info {
            background: linear-gradient(135deg, #e8f5e8, #f0f8f0);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            border: 2px solid #28a745;
        }

        .warranty-info h4 {
            color: #28a745;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .warranty-info p {
            color: #333;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* Toast Notifications */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 1000;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease;
            max-width: 300px;
            border-left: 4px solid;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(0);
        }

        .toast-content {
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .toast-success { border-left-color: #10b981; }
        .toast-error { border-left-color: #ef4444; }
        .toast-info { border-left-color: #3b82f6; }
        .toast-warning { border-left-color: #f59e0b; }

        .toast-success i { color: #10b981; }
        .toast-error i { color: #ef4444; }
        .toast-info i { color: #3b82f6; }
        .toast-warning i { color: #f59e0b; }

        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .product-container {
                border-radius: 15px;
                margin: 0;
            }

            .product-content {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 20px;
            }

            .product-details {
                padding-left: 0;
                text-align: center;
            }

            .product-title {
                font-size: 1.8rem;
                text-align: center;
                margin-bottom: 15px;
            }

            .product-brand {
                font-size: 1.1rem;
                text-align: center;
            }

            .product-rating {
                justify-content: center;
            }

            .product-price {
                font-size: 2rem;
                justify-content: center;
                text-align: center;
            }

            .original-price {
                font-size: 1.2rem;
            }

            .product-description {
                text-align: center;
                font-size: 0.95rem;
            }

            .product-features {
                text-align: left;
                margin: 20px 0;
            }

            .product-features h3 {
                text-align: center;
            }

            .product-actions {
                flex-direction: column;
                gap: 12px;
            }

            .action-btn {
                padding: 12px 20px;
                font-size: 1rem;
            }

            .size-options {
                justify-content: center;
            }

            .size-option {
                min-width: 100px;
                padding: 10px 15px;
            }

            .quantity-controls {
                justify-content: center;
            }

            .qty-btn {
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
            }

            .qty-display {
                font-size: 1.3rem;
                padding: 8px 15px;
            }

            .product-header {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
                text-align: center;
            }

            .product-header h1 {
                font-size: 1.8rem;
                text-align: center;
            }

            .back-to-shop,
            .cart-link {
                position: static;
                padding: 10px 15px;
                font-size: 0.9rem;
            }

            .main-image-container {
                height: 300px;
                padding: 20px;
            }

            .main-image {
                max-width: 85%;
                max-height: 85%;
            }

            .thumbnail {
                min-width: 50px;
                max-width: 50px;
                height: 50px;
            }

            .thumbnail {
                min-width: 60px;
                height: 60px;
            }

            .policy-section {
                justify-content: center;
                gap: 10px;
            }

            .policy-btn {
                padding: 10px 15px;
                font-size: 0.9rem;
            }

            .warranty-info {
                text-align: center;
                padding: 15px;
            }

            .toast {
                right: 10px;
                left: 10px;
                max-width: none;
            }
        }

        /* Extra small screens */
        @media (max-width: 480px) {
            .main-image-container {
                height: 250px;
                padding: 15px;
            }

            .main-image {
                max-width: 90%;
                max-height: 90%;
            }

            .thumbnail {
                min-width: 45px;
                max-width: 45px;
                height: 45px;
            }

            .product-title {
                font-size: 1.5rem;
            }

            .product-price {
                font-size: 1.7rem;
                flex-direction: column;
                gap: 8px;
            }

            .original-price {
                font-size: 1rem;
            }

            .discount-badge {
                font-size: 0.8rem;
                padding: 4px 8px;
            }

            .size-option {
                min-width: 80px;
                padding: 8px 12px;
                font-size: 0.9rem;
            }

            .action-btn {
                padding: 10px 15px;
                font-size: 0.95rem;
                min-height: 50px;
            }

            .product-features {
                padding: 15px;
            }

            .features-list li {
                font-size: 0.9rem;
                padding: 6px 0;
            }
        }
    </style>
</head>
<body>
    <div class="product-container">
        <div class="product-header">
            <a href="#" class="back-to-shop" onclick="goToShop()">
                <i class="fas fa-arrow-left"></i> Back to Shop
            </a>
            <div>
                <h1><i class="fas fa-wheel"></i> Product Details</h1>
                <p>Premium tire selection for your vehicle</p>
            </div>
            <a href="#" class="cart-link" onclick="goToCart()">
                <i class="fas fa-shopping-cart"></i> Cart
                <span class="cart-count" id="cartCount">0</span>
            </a>
        </div>
        
        <div class="product-content">
            <!-- Image Gallery -->
            <div class="product-gallery">
                <div class="main-image-container">
                    <img id="mainImage" class="main-image" src="amar.webp" alt="Tire Image">
                    <div class="zoom-icon" onclick="zoomImage()">
                        <i class="fas fa-search-plus"></i>
                    </div>
                </div>
                
                <div class="thumbnail-gallery" id="thumbnailGallery">
                    <!-- Thumbnails will be populated by JavaScript -->
                </div>
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <h1 class="product-title" id="productTitle">Amar Gold-D</h1>
                <p class="product-brand" id="productBrand">Apollo</p>
                
                <div class="product-rating">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="rating-text">(4.5/5 - 324 reviews)</span>
                </div>

                <div class="product-price">
                    <span id="currentPrice">₹14,435</span>
                    <span class="original-price" id="originalPrice">₹14,868.00</span>
                    <span class="discount-badge">3% OFF</span>
                </div>

                <p class="product-description" id="productDescription">
              The Apollo Amar Gold‑D is a heavy-duty bias-ply ribbed tyre designed for mixed/regional haul operations. Engineered for both durability and mileage, it combines a deep rib pattern with a reinforced casing and heat-resistant compound, making it suitable for heavy payloads and long-distance operations.
                </p>

                <div class="product-features">
                    <h3><i class="fas fa-star"></i> Key Features</h3>
                    <ul class="features-list" id="featuresList">
                        <li><i class="fas fa-check"></i> Modular matrix rib tread delivers smooth steering and even wear under load  .</li>
                        <li><i class="fas fa-check"></i> Superior cord insulation enhances casing integrity to resist structural fatigue and puncture damage. </li>
                        <li><i class="fas fa-check"></i> Heat-resistant compound reduces thermal build-up by about 6–7%, supporting longer tyre life. </li>
                        <li><i class="fas fa-check"></i> Universal steer compatibility, offering stable tracking and driving ease across different axle positions.</li>
                        <li><i class="fas fa-check"></i>Strong casing construction, designed for multiple retreads and long service duration—even under challenging mixed-use conditions .</li>
                    </ul>
                </div>

                <div class="warranty-info">
                    <h4><i class="fas fa-shield-alt"></i> Warranty Information</h4>
                    <p>Apollo provides a standard 2‑year manufacturer’s warranty on the Amar Gold‑D tyre. It covers defects such as radial splits not caused by external trauma, ply or bead separation, and premature wear. Claims are handled on a pro‑rated basis upon inspection at authorized Apollo centers. </p>
                </div>

                <!-- Size Selection -->
                <div class="size-selection">
                    <h3><i class="fas fa-ruler"></i> Select Size</h3>
                    <div class="size-options" id="sizeOptions">
                        <!-- Size options will be populated by JavaScript -->
                    </div>
                </div>

                <!-- Quantity Selection -->
                <div class="quantity-section">
                    <h3><i class="fas fa-sort-numeric-up"></i> Quantity</h3>
                    <div class="quantity-controls">
                        <button class="qty-btn" onclick="decreaseQuantity()">-</button>
                        <div class="qty-display" id="quantity">1</div>
                        <button class="qty-btn" onclick="increaseQuantity()">+</button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="product-actions">
                    <button class="action-btn add-to-cart-btn" onclick="addToCart()">
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                    <button class="action-btn buy-now-btn" onclick="buyNow()">
                        <i class="fas fa-bolt"></i> Buy Now
                    </button>
                </div>

                <!-- Policy Links -->
                <div class="policy-section">
                    <a href="#" class="policy-btn" onclick="showPolicy('warranty')">
                        <i class="fas fa-file-contract"></i> Warranty Policy
                    </a>
                    <a href="#" class="policy-btn" onclick="showPolicy('shipping')">
                        <i class="fas fa-shipping-fast"></i> Shipping Policy
                    </a>
                    <a href="#" class="policy-btn" onclick="showPolicy('returns')">
                        <i class="fas fa-undo"></i> Return Policy
                    </a>
                </div>
            </div>
        </div>
    </div>
<script src="path/to/user-detector.js"></script>
    <script>
// Enhanced Product data with real-time stock integration
const products = {
    'michelin-pilot-sport': {
        id: '50',
        inventoryId: 50, // Links to inventory system tire ID
        name: 'Amar Gold-D',
        brand: 'Apollo',
        price: 14435,
        originalPrice: 14868,
        category: 'high-performance',
        description: 'TThe Apollo Amar Gold‑D is a heavy-duty bias-ply ribbed tyre designed for mixed/regional haul operations. Engineered for both durability and mileage, it combines a deep rib pattern with a reinforced casing and heat-resistant compound, making it suitable for heavy payloads and long-distance operations.',
        features: [
            'Modular matrix rib tread delivers smooth steering and even wear under load.',
            'Superior cord insulation enhances casing integrity to resist structural fatigue and puncture damage.',
            'Heat-resistant compound reduces thermal build-up by about 6–7%, supporting longer tyre life.',
            'Universal steer compatibility, offering stable tracking and driving ease across different axle positions. ',
            'Strong casing construction, designed for multiple retreads and long service duration—even under challenging mixed-use conditions.' 
        ],
        specifications: {
            loadIndex: '91-98',
            speedRating: 'W-Y',
            sidewallType: 'Performance',
            treadDepth: '8.5mm'
        },
        sizes: ['295/95 D20'],
        images: [
            'amar.webp',
        ],
        inStock: true,
        stockCount: 25
    }
};

// Global cart variable
let cart = [];
let currentStockLevels = {};

// Stock synchronization functions
function loadStockFromInventory() {
    try {
        const savedStock = localStorage.getItem('tireStockLevels') || sessionStorage.getItem('tireStockLevels');
        if (savedStock) {
            currentStockLevels = JSON.parse(savedStock);
            console.log('Stock loaded from inventory system:', currentStockLevels);
            updateProductStockStatus();
            return true;
        }
    } catch (error) {
        console.error('Error loading stock from inventory:', error);
    }
    return false;
}

function updateProductStockStatus() {
    // Update all products based on current stock levels
    Object.keys(products).forEach(productKey => {
        const product = products[productKey];
        const inventoryStock = currentStockLevels[product.inventoryId];
        
        if (inventoryStock !== undefined) {
            product.stockCount = inventoryStock;
            product.inStock = inventoryStock > 0;
            
            console.log(`Updated ${product.name}: Stock = ${inventoryStock}, In Stock = ${product.inStock}`);
        }
    });
    
    // Update UI if product is currently displayed
    if (window.app && window.app.currentProduct) {
        window.app.updateStockDisplay();
        window.app.updateAddToCartButton();
    }
}

function saveStockToInventory(inventoryId, newStock) {
    try {
        currentStockLevels[inventoryId] = newStock;
        const stockData = JSON.stringify(currentStockLevels);
        
        localStorage.setItem('tireStockLevels', stockData);
        sessionStorage.setItem('tireStockLevels', stockData);
        
        // Trigger stock update event
        window.dispatchEvent(new CustomEvent('stockUpdated', {
            detail: { 
                stockLevels: currentStockLevels,
                timestamp: Date.now(),
                source: 'product-page',
                updatedProduct: inventoryId
            }
        }));
        
        console.log(`Stock updated for inventory ID ${inventoryId}: ${newStock}`);
    } catch (error) {
        console.error('Error saving stock to inventory:', error);
    }
}

// Enhanced cart functions with stock validation
function loadCart() {
    const savedCart = localStorage.getItem('unifiedTireShopCart') || sessionStorage.getItem('unifiedTireShopCart');
    if (savedCart) {
        try {
            cart = JSON.parse(savedCart);
            console.log('Cart loaded:', cart);
            updateCartCount();
        } catch (e) {
            console.error('Error loading cart:', e);
            cart = [];
        }
    }
}

function saveCart() {
    try {
        const cartData = JSON.stringify(cart);
        localStorage.setItem('unifiedTireShopCart', cartData);
        sessionStorage.setItem('unifiedTireShopCart', cartData);
        
        window.dispatchEvent(new StorageEvent('storage', {
            key: 'unifiedTireShopCart',
            newValue: cartData,
            storageArea: localStorage
        }));
    } catch (e) {
        console.error('Error saving cart:', e);
    }
}

function addToCartOriginal(productId, quantity = 1, selectedSize = '') {
    console.log('Adding product ID:', productId, 'with quantity:', quantity, 'and size:', selectedSize);
    
    const product = Object.values(products).find(p => p.id === productId);
    if (!product) {
        console.log('Product not found with ID:', productId);
        return false;
    }

    // STOCK VALIDATION - Check if product is in stock
    if (!product.inStock || product.stockCount <= 0) {
        showToastOriginal(`${product.name} is currently out of stock!`);
        return false;
    }

    // Check if requested quantity is available
    if (quantity > product.stockCount) {
        showToastOriginal(`Only ${product.stockCount} units of ${product.name} are available!`);
        return false;
    }

    // Check total quantity in cart + new quantity
    const uniqueId = selectedSize ? `${productId}-${selectedSize}` : productId;
    const existing = cart.find(item => item.uniqueId === uniqueId);
    const currentCartQty = existing ? existing.qty : 0;
    const totalRequestedQty = currentCartQty + quantity;

    if (totalRequestedQty > product.stockCount) {
        const availableToAdd = product.stockCount - currentCartQty;
        if (availableToAdd <= 0) {
            showToastOriginal(`Maximum available quantity of ${product.name} already in cart!`);
            return false;
        }
        showToastOriginal(`Only ${availableToAdd} more units can be added to cart!`);
        return false;
    }

    // Add to cart if validation passes
    if (existing) {
        existing.qty += quantity;
        console.log('Increased quantity for:', product.name, 'size:', selectedSize, 'by', quantity);
    } else {
        const cartItem = { 
            ...product, 
            qty: quantity,
            uniqueId: uniqueId,
            selectedSize: selectedSize
        };
        cart.push(cartItem);
        console.log('Added new product to cart:', product.name, 'size:', selectedSize, 'with quantity:', quantity);
    }

    // Update inventory stock (simulate purchase reservation)
    const newStock = product.stockCount - quantity;
    saveStockToInventory(product.inventoryId, newStock);
    
    // Update product stock locally
    product.stockCount = newStock;
    product.inStock = newStock > 0;

    updateCartCount();
    saveCart();
    const sizeText = selectedSize ? ` (${selectedSize})` : '';
    showToastOriginal(`${product.name}${sizeText} (x${quantity}) added to cart!`);
    console.log('Current cart after adding:', cart);
    
    return true;
}

function removeFromCartWithStockRestore(uniqueId) {
    const itemIndex = cart.findIndex(item => item.uniqueId === uniqueId);
    if (itemIndex !== -1) {
        const removedItem = cart[itemIndex];
        
        // Restore stock when removing from cart
        const product = Object.values(products).find(p => p.id === removedItem.id);
        if (product) {
            const newStock = product.stockCount + removedItem.qty;
            saveStockToInventory(product.inventoryId, newStock);
            
            // Update product stock locally
            product.stockCount = newStock;
            product.inStock = newStock > 0;
        }
        
        // Remove from cart
        cart.splice(itemIndex, 1);
        updateCartCount();
        saveCart();
        
        const sizeText = removedItem.selectedSize ? ` (${removedItem.selectedSize})` : '';
        showToastOriginal(`Removed ${removedItem.name}${sizeText} from cart`);
        
        return removedItem;
    }
    return null;
}

function updateCartCount() {
    const count = cart.reduce((sum, item) => sum + item.qty, 0);
    const countEl = document.getElementById('cartCount');
    
    if (countEl) {
        countEl.textContent = count;
        
        if (count > 0) {
            countEl.style.display = 'block';
            countEl.classList.add('cart-count-animation');
            
            setTimeout(() => {
                countEl.classList.remove('cart-count-animation');
            }, 300);
        } else {
            countEl.style.display = 'none';
        }
    }
    
    const allCountElements = document.querySelectorAll('.cart-count, [data-cart-count]');
    allCountElements.forEach(el => {
        el.textContent = count;
        if (count > 0) {
            el.style.display = 'block';
        } else {
            el.style.display = 'none';
        }
    });
}

function goToCartOriginal() {
    console.log('Navigating to cart page');
    saveCart();
    window.location.href = 'cart.php';
}

function handleCartClick(event) {
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }
    
    console.log('Cart icon clicked');
    goToCartOriginal();
}

function showToastOriginal(msg, type = 'info') {
    const toast = document.getElementById('toast');
    if (!toast) {
        const newToast = document.createElement('div');
        newToast.id = 'toast';
        newToast.className = 'toast';
        newToast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'error' ? '#f44336' : '#4CAF50'};
            color: white;
            padding: 16px;
            border-radius: 4px;
            z-index: 1000;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            max-width: 300px;
        `;
        document.body.appendChild(newToast);
    }
    
    const toastEl = document.getElementById('toast');
    toastEl.textContent = msg;
    toastEl.style.background = type === 'error' ? '#f44336' : '#4CAF50';
    toastEl.style.opacity = '1';
    toastEl.style.transform = 'translateX(0)';
    
    setTimeout(() => {
        toastEl.style.opacity = '0';
        toastEl.style.transform = 'translateX(100%)';
    }, 3000);
}

// Enhanced Application class with stock management
class TireShop {
    constructor() {
        this.currentProduct = null;
        this.selectedSize = '';
        this.quantity = 1;
        this.maxQuantityPerItem = 1000;
        this.maxCartItems = 50;
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.loadProduct();
        loadCart();
        loadStockFromInventory();
        this.setupStockEventListeners();
    }

    setupStockEventListeners() {
        // Listen for stock updates from inventory system
        window.addEventListener('stockUpdated', (e) => {
            console.log('Product page received stock update:', e.detail);
            if (e.detail.source !== 'product-page') {
                loadStockFromInventory();
                this.showToast('Stock levels updated!', 'info');
            }
        });

        // Listen for storage changes (cross-tab sync)
        window.addEventListener('storage', (e) => {
            if (e.key === 'tireStockLevels') {
                console.log('Stock storage change detected');
                loadStockFromInventory();
            }
        });
    }

    bindEvents() {
        document.addEventListener('DOMContentLoaded', () => this.onDOMLoaded());
        document.addEventListener('keydown', (e) => this.handleKeyboardShortcuts(e));
        window.addEventListener('resize', this.debounce(() => this.handleResize(), 250));
    }

    onDOMLoaded() {
        this.setupImageLazyLoading();
        this.setupSmoothScrolling();
        this.setupAccessibility();
        
        const cartIcons = document.querySelectorAll('[data-cart-action="go-to-cart"], .cart-icon, #cartIcon');
        cartIcons.forEach(icon => {
            icon.addEventListener('click', handleCartClick);
            icon.style.cursor = 'pointer';
        });
        
        window.addEventListener('storage', function(e) {
            if (e.key === 'unifiedTireShopCart') {
                loadCart();
            }
        });
    }

    loadProduct() {
        const urlParams = new URLSearchParams(window.location.search);
        const productId = urlParams.get('id') || 'michelin-pilot-sport';
        
        this.currentProduct = products[productId] || products['michelin-pilot-sport'];
        this.renderProduct();
    }

    renderProduct() {
        if (!this.currentProduct) return;

        this.updateProductDetails();
        this.loadImages();
        this.loadSizes();
        this.setDefaultSize();
        this.updateStockDisplay();
        this.updateAddToCartButton();
    }

    updateProductDetails() {
        const elements = {
            productTitle: this.currentProduct.name,
            productBrand: this.currentProduct.brand,
            currentPrice: `₹${this.formatPrice(this.currentProduct.price)}`,
            originalPrice: `₹${this.formatPrice(this.currentProduct.originalPrice)}`,
            productDescription: this.currentProduct.description
        };

        Object.entries(elements).forEach(([id, content]) => {
            const element = document.getElementById(id);
            if (element) element.textContent = content;
        });

        this.updateDiscountBadge();
        this.updateFeaturesList();
    }

    updateStockDisplay() {
        const stockElement = document.getElementById('stockStatus');
        if (stockElement) {
            const { inStock, stockCount } = this.currentProduct;
            if (inStock && stockCount > 0) {
                if (stockCount <= 5) {
                    stockElement.innerHTML = `<span class="low-stock">⚠ Low Stock (${stockCount} remaining)</span>`;
                } else {
                    stockElement.innerHTML = `<span class="in-stock">✓ In Stock (${stockCount} available)</span>`;
                }
            } else {
                stockElement.innerHTML = `<span class="out-of-stock">❌ Out of Stock</span>`;
            }
        }

        // Update quantity selector based on stock
        this.updateQuantityLimits();
    }

    updateQuantityLimits() {
        const quantityElement = document.getElementById('quantity');
        const increaseBtn = document.querySelector('.quantity-increase');
        const decreaseBtn = document.querySelector('.quantity-decrease');
        
        if (quantityElement) {
            // Reset quantity if it exceeds stock
            if (this.quantity > this.currentProduct.stockCount) {
                this.quantity = Math.min(this.quantity, this.currentProduct.stockCount);
                this.updateQuantityDisplay();
            }
        }

        // Disable increase button if at stock limit
        if (increaseBtn) {
            increaseBtn.disabled = this.quantity >= this.currentProduct.stockCount || !this.currentProduct.inStock;
        }

        if (decreaseBtn) {
            decreaseBtn.disabled = this.quantity <= 1;
        }
    }

    updateAddToCartButton() {
        const addToCartBtn = document.querySelector('.add-to-cart-btn');
        const buyNowBtn = document.querySelector('.buy-now-btn');
        
        if (addToCartBtn) {
            if (!this.currentProduct.inStock || this.currentProduct.stockCount <= 0) {
                addToCartBtn.textContent = 'Out of Stock';
                addToCartBtn.disabled = true;
                addToCartBtn.classList.add('disabled');
            } else {
                addToCartBtn.textContent = 'Add to Cart';
                addToCartBtn.disabled = false;
                addToCartBtn.classList.remove('disabled');
            }
        }

        if (buyNowBtn) {
            if (!this.currentProduct.inStock || this.currentProduct.stockCount <= 0) {
                buyNowBtn.textContent = 'Out of Stock';
                buyNowBtn.disabled = true;
                buyNowBtn.classList.add('disabled');
            } else {
                buyNowBtn.textContent = 'Buy Now';
                buyNowBtn.disabled = false;
                buyNowBtn.classList.remove('disabled');
            }
        }
    }

    updateDiscountBadge() {
        const discount = this.calculateDiscount();
        const badge = document.querySelector('.discount-badge');
        if (badge) {
            badge.textContent = `${discount}% OFF`;
            badge.style.display = discount > 0 ? 'block' : 'none';
        }
    }

    calculateDiscount() {
        const { price, originalPrice } = this.currentProduct;
        return Math.round(((originalPrice - price) / originalPrice) * 100);
    }

    updateFeaturesList() {
        const featuresList = document.getElementById('featuresList');
        if (!featuresList) return;

        featuresList.innerHTML = this.currentProduct.features
            .map(feature => `<li><i class="fas fa-check" aria-hidden="true"></i> ${this.escapeHtml(feature)}</li>`)
            .join('');
    }

    loadImages() {
        const mainImage = document.getElementById('mainImage');
        const thumbnailGallery = document.getElementById('thumbnailGallery');
        
        if (mainImage) {
            mainImage.src = this.currentProduct.images[0];
            mainImage.alt = `${this.currentProduct.name} main view`;
        }

        if (thumbnailGallery) {
            thumbnailGallery.innerHTML = this.currentProduct.images
                .map((image, index) => `
                    <div class="thumbnail ${index === 0 ? 'active' : ''}" 
                         onclick="app.changeMainImage('${image}', ${index})"
                         role="button" 
                         tabindex="0"
                         aria-label="View image ${index + 1}">
                        <img src="${image}" alt="Product view ${index + 1}" loading="lazy">
                    </div>
                `).join('');
        }
    }

    loadSizes() {
        const sizeOptions = document.getElementById('sizeOptions');
        if (!sizeOptions) return;

        sizeOptions.innerHTML = this.currentProduct.sizes
            .map(size => `
                <div class="size-option" 
                     onclick="app.selectSize('${size}')"
                     role="button"
                     tabindex="0"
                     aria-label="Select size ${size}">
                    ${this.escapeHtml(size)}
                </div>
            `).join('');
    }

    setDefaultSize() {
        if (this.currentProduct.sizes.length > 0) {
            this.selectedSize = this.currentProduct.sizes[0];
            this.updateSizeSelection();
        }
    }

    changeMainImage(imageSrc, index) {
        const mainImage = document.getElementById('mainImage');
        if (mainImage) {
            mainImage.src = imageSrc;
            mainImage.alt = `${this.currentProduct.name} view ${index + 1}`;
        }

        document.querySelectorAll('.thumbnail').forEach((thumb, i) => {
            thumb.classList.toggle('active', i === index);
        });
    }

    selectSize(size) {
        console.log('Size selected:', size);
        this.selectedSize = size;
        this.updateSizeSelection();
        this.showToast(`Size ${size} selected`, 'info');
    }

    updateSizeSelection() {
        document.querySelectorAll('.size-option').forEach(option => {
            option.classList.toggle('selected', option.textContent.trim() === this.selectedSize);
        });
        
        const selectedSizeDisplay = document.getElementById('selectedSizeDisplay');
        if (selectedSizeDisplay) {
            selectedSizeDisplay.textContent = this.selectedSize;
        }
    }

    increaseQuantity() {
        if (!this.currentProduct.inStock || this.currentProduct.stockCount <= 0) {
            this.showToast('Product is out of stock', 'error');
            return;
        }

        if (this.quantity >= this.maxQuantityPerItem) {
            this.showToast(`Maximum quantity is ${this.maxQuantityPerItem} per order`, 'error');
            return;
        }
        
        if (this.quantity >= this.currentProduct.stockCount) {
            this.showToast(`Only ${this.currentProduct.stockCount} units available`, 'error');
            return;
        }

        this.quantity++;
        this.updateQuantityDisplay();
        this.updateQuantityLimits();
    }

    decreaseQuantity() {
        if (this.quantity > 1) {
            this.quantity--;
            this.updateQuantityDisplay();
            this.updateQuantityLimits();
        }
    }

    updateQuantityDisplay() {
        const quantityElement = document.getElementById('quantity');
        if (quantityElement) {
            quantityElement.textContent = this.quantity;
        }
    }

    addToCart() {
        if (!this.validateAddToCart()) return;

        const success = addToCartOriginal(this.currentProduct.id, this.quantity, this.selectedSize);
        
        if (success) {
            this.addVisualFeedback('.add-to-cart-btn');
            // Update the display after successful add to cart
            this.updateStockDisplay();
            this.updateAddToCartButton();
        }
    }

    validateAddToCart() {
        if (!this.selectedSize) {
            this.showToast('Please select a tire size', 'error');
            return false;
        }

        if (!this.currentProduct.inStock || this.currentProduct.stockCount <= 0) {
            this.showToast('Product is out of stock', 'error');
            return false;
        }

        if (this.quantity > this.currentProduct.stockCount) {
            this.showToast(`Only ${this.currentProduct.stockCount} units available`, 'error');
            return false;
        }

        return true;
    }

    addVisualFeedback(selector) {
        const element = document.querySelector(selector);
        if (element) {
            element.style.transform = 'scale(0.95)';
            setTimeout(() => {
                element.style.transform = 'scale(1)';
            }, 150);
        }
    }

    buyNow() {
        if (!this.validateAddToCart()) return;

        const success = addToCartOriginal(this.currentProduct.id, this.quantity, this.selectedSize);
        
        if (success) {
            this.showToast('M751 HL product added to cart...', 'info');
            
            setTimeout(() => {
                const total = this.formatPrice(this.currentProduct.price * this.quantity);
                this.showCheckoutModal(total);
            }, 1000);
        }
    }

   
        
    

    processCheckout() {
        this.showToast('Processing checkout...', 'info');
        this.closeModal();
    }

    goToCart() {
        goToCartOriginal();
    }

    removeFromCart(uniqueId) {
        const removedItem = removeFromCartWithStockRestore(uniqueId);
        if (removedItem) {
            // Update display if the removed item is the current product
            if (removedItem.id === this.currentProduct.id) {
                this.updateStockDisplay();
                this.updateAddToCartButton();
            }
            
            const existingModal = document.querySelector('.modal');
            if (existingModal && existingModal.querySelector('.cart-contents')) {
                existingModal.remove();
                this.goToCart();
            }
        }
    }

    clearCart() {
        if (cart.length === 0) return;
        
        // Restore stock for all items in cart
        cart.forEach(item => {
            const product = Object.values(products).find(p => p.id === item.id);
            if (product) {
                const newStock = product.stockCount + item.qty;
                saveStockToInventory(product.inventoryId, newStock);
                product.stockCount = newStock;
                product.inStock = newStock > 0;
            }
        });
        
        cart = [];
        updateCartCount();
        saveCart();
        this.showToast('Cart cleared', 'info');
        this.closeModal();
        
        // Update display
        this.updateStockDisplay();
        this.updateAddToCartButton();
    }

    getCartTotal() {
        return cart.reduce((total, item) => total + (item.price * item.qty), 0);
    }

    createModal(title, content) {
        const modal = document.createElement('div');
        modal.className = 'modal';
        modal.innerHTML = `
            <div class="modal-overlay" onclick="app.closeModal()"></div>
            <div class="modal-content">
                <div class="modal-header">
                    <h2>${this.escapeHtml(title)}</h2>
                    <button onclick="app.closeModal()" class="modal-close">&times;</button>
                </div>
                <div class="modal-body">
                    ${content}
                </div>
            </div>
        `;
        return modal;
    }

    closeModal() {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => modal.remove());
    }

    showToast(message, type = 'info') {
        showToastOriginal(message, type);
    }

    handleKeyboardShortcuts(e) {
        if (e.ctrlKey || e.altKey || e.metaKey) return;
        
        const shortcuts = {
            'c': () => this.goToCart(),
            'a': () => this.addToCart(),
            'b': () => this.buyNow(),
            '+': () => { e.preventDefault(); this.increaseQuantity(); },
            '=': () => { e.preventDefault(); this.increaseQuantity(); },
            '-': () => { e.preventDefault(); this.decreaseQuantity(); }
        };

        if (e.key >= '1' && e.key <= '4') {
            const sizeIndex = parseInt(e.key) - 1;
            if (this.currentProduct && this.currentProduct.sizes[sizeIndex]) {
                this.selectSize(this.currentProduct.sizes[sizeIndex]);
            }
            return;
        }

        if (e.key === 'Escape') {
            this.closeModal();
            return;
        }

        const shortcut = shortcuts[e.key.toLowerCase()];
        if (shortcut) shortcut();
    }

    setupImageLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src || img.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[loading="lazy"]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    }

    setupSmoothScrolling() {
        document.documentElement.style.scrollBehavior = 'smooth';
    }

    setupAccessibility() {
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                const activeElement = document.activeElement;
                if (activeElement && activeElement.hasAttribute('role') && activeElement.getAttribute('role') === 'button') {
                    e.preventDefault();
                    activeElement.click();
                }
            }
        });
    }

    handleResize() {
        const mainImage = document.getElementById('mainImage');
        if (mainImage && window.innerWidth < 768) {
            mainImage.style.maxHeight = '300px';
        } else if (mainImage) {
            mainImage.style.maxHeight = '400px';
        }
    }

    formatPrice(price) {
        return price.toLocaleString('en-IN');
    }

    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func.apply(this, args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    trackEvent(eventName, properties = {}) {
        console.log(`Analytics: ${eventName}`, properties);
    }

    handleError(error, context = '') {
        console.error(`Error in ${context}:`, error);
        this.showToast('Something went wrong. Please try again.', 'error');
    }
}
// Initialize the application
const app = new TireShop();

// Export for global access (if needed)
window.TireShop = TireShop;
window.app = app;

// Legacy function support for onclick handlers
function addToCart() { app.addToCart(); }
function buyNow() { app.buyNow(); }
function increaseQuantity() { app.increaseQuantity(); }
function decreaseQuantity() { app.decreaseQuantity(); }
function goToCart() { app.goToCart(); }

// FIXED: Back to shopping function now redirects to bridgestone.php
function goToShop() { 
    console.log('Redirecting to bridgestone.php');
    app.showToast('Going back to shop...', 'info'); 
    setTimeout(() => {
        window.location.href = 'apollo.php';
    }, 500);
}

function selectSize(size) { app.selectSize(size); }
function changeMainImage(src, index) { app.changeMainImage(src, index); }
function zoomImage() { 
    const mainImage = document.getElementById('mainImage');
    if (mainImage) {
        window.open(mainImage.src, '_blank', 'width=800,height=600');
    }
}

// FIXED: Policy function now redirects to policy.php
function showPolicy(type) {
    console.log(`Redirecting to policy page for: ${type}`);
    
    // Show loading toast
    app.showToast(`Loading ${type} policy...`, 'info');
    
    // Redirect to policy.php with policy type as parameter
    setTimeout(() => {
        window.location.href = `policy.php?type=${encodeURIComponent(type)}`;
    }, 500);
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