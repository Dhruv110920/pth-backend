<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reflect.app Header & Slider</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    /* Global Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body { 
      margin: 0; 
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #000;
      color: white;
      line-height: 1.6;
    }

    /* Header - MODIFIED: reduced padding and height */ 
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 50px;
      background-color: white;  
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 4px 15px rgba(255, 0, 0, 0.3);
      transition: all 0.3s ease;
    }

    .header.scrolled {
      padding: 8px 50px;
    }

    .separator {
      height: 4px; 
      background: linear-gradient(to right, #d00, #ff3333, #d00);
      box-shadow: 0 2px 8px rgba(255, 0, 0, 0.5);
      z-index: 999;
      position: relative;
    }

    .logo {
      height: 60px;
      transition: all 0.3s ease;
    }

    .header.scrolled .logo {
      height: 38px;
    }

    .nav-links {
      display: flex;
      gap: 40px;
    }

    .nav-links a {
      text-decoration: none;
      color: #222;
      font-size: 16px;
      font-weight: 500;
      position: relative;
      transition: all 0.3s ease;
      padding: 5px 0;
    }

    .nav-links a:after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: red;
      transition: width 0.3s ease;
    }

    .nav-links a:hover {
      color: red;
    }

    .nav-links a:hover:after {
      width: 100%;
    }

    /* Search Box Styles */
    .search-container {
      position: relative;
      margin: 0 20px;
      min-width: 300px;
    }

    .search-box {
      position: relative;
      display: flex;
      align-items: center;
    }

    .search-input {
      width: 100%;
      padding: 10px 40px 10px 15px;
      border: 2px solid #ddd;
      border-radius: 25px;
      font-size: 14px;
      outline: none;
      transition: all 0.3s ease;
      background-color: #f8f9fa;
    }

    .search-input:focus {
      border-color: red;
      box-shadow: 0 0 0 3px rgba(255, 0, 0, 0.1);
    }

    .search-btn {
      position: absolute;
      right: 5px;
      background: red;
      border: none;
      border-radius: 50%;
      width: 35px;
      height: 35px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .search-btn:hover {
      background: #cc0000;
      transform: scale(1.05);
    }

    .search-btn i {
      color: white;
      font-size: 14px;
    }

    .search-dropdown {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background: white;
      border: 1px solid #ddd;
      border-top: none;
      border-radius: 0 0 15px 15px;
      max-height: 300px;
      overflow-y: auto;
      z-index: 1001;
      display: none;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .search-dropdown.show {
      display: block;
    }

    .search-item {
      padding: 12px 15px;
      border-bottom: 1px solid #eee;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .search-item:hover {
      background-color: rgba(255, 0, 0, 0.05);
      padding-left: 20px;
    }

    .search-item:last-child {
      border-bottom: none;
    }

    .search-item-brand {
      font-size: 12px;
      color: #666;
      font-weight: 500;
    }

    .search-item-name {
      color: #222;
      font-weight: 500;
    }

    .search-item-price {
      color: red;
      font-weight: bold;
      margin-left: auto;
    }

    /* Action buttons */
    .action-buttons {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    /* Cart icon styles */
    .cart-wrapper {
      position: relative;
      margin-right: 15px;
    }

    .cart-icon {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 38px;
      height: 38px;
      background-color: #ffffff;
      border: 1px solid rgba(255, 0, 0, 0.2);
      border-radius: 50%;
      transition: all 0.3s ease;
      color: #000000;
      text-decoration: none;
      cursor: pointer;
      box-shadow: 0 2px 4px rgba(255, 0, 0, 0.2);
    }

    .cart-icon i {
      font-size: 18px;
      color: red;
    }

    .cart-icon:hover {
      background-color: #eaeaea;
      transform: translateY(-2px);
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .cart-count {
      position: absolute;
      top: -5px;
      right: -5px;
      background-color: red;
      color: white;
      font-size: 11px;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
    }

    /* Cart Modal Styles - IMPROVED */
    .cart-modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.7);
      z-index: 2000;
      display: none;
      align-items: center;
      justify-content: center;
      backdrop-filter: blur(5px);
    }

    .cart-modal.show {
      display: flex;
    }

    .cart-content {
      background: white;
      width: 90%;
      max-width: 650px;
      max-height: 85vh;
      border-radius: 20px;
      overflow: hidden;
      position: relative;
      box-shadow: 0 20px 40px rgba(0,0,0,0.3);
      animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
      from {
        transform: translateY(-50px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .cart-header {
      background: linear-gradient(135deg, #ff3333, #cc0000);
      color: white;
      padding: 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .cart-header h2 {
      font-size: 24px;
      font-weight: 600;
    }

    .cart-close {
      background: rgba(255,255,255,0.2);
      border: none;
      color: white;
      font-size: 24px;
      cursor: pointer;
      padding: 8px 12px;
      border-radius: 50%;
      transition: all 0.3s ease;
    }

    .cart-close:hover {
      background: rgba(255,255,255,0.3);
      transform: scale(1.1);
    }

    .cart-items {
      padding: 25px;
      max-height: 400px;
      overflow-y: auto;
    }

    /* FIXED: Cart item styles with proper image display */
    .cart-item {
      display: flex;
      align-items: center;
      gap: 20px;
      padding: 20px 0;
      border-bottom: 1px solid #eee;
      transition: all 0.3s ease;
    }

    .cart-item:hover {
      background: rgba(255,0,0,0.02);
      border-radius: 10px;
      padding: 20px 15px;
    }

    .cart-item:last-child {
      border-bottom: none;
    }

    .cart-item-image {
      width: 80px;
      height: 80px;
      background: #f8f9fa;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      border: 2px solid #eee;
      flex-shrink: 0;
    }

    .cart-item-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 10px;
    }

    .cart-item-image i {
      font-size: 32px;
      color: #999;
    }

    .cart-item-details {
      flex: 1;
      min-width: 0;
    }

    .cart-item-name {
      font-weight: 600;
      color: #222;
      margin-bottom: 5px;
      font-size: 16px;
    }

    .cart-item-brand {
      font-size: 12px;
      color: #666;
      text-transform: uppercase;
      font-weight: 500;
      margin-bottom: 5px;
    }

    .cart-item-specs {
      font-size: 13px;
      color: #888;
      margin-bottom: 8px;
    }

    .cart-item-price {
      color: red;
      font-weight: bold;
      font-size: 18px;
    }

    .cart-item-actions {
      display: flex;
      align-items: center;
      gap: 15px;
      flex-shrink: 0;
    }

    .quantity-controls {
      display: flex;
      align-items: center;
      gap: 8px;
      background: #f8f9fa;
      border-radius: 25px;
      padding: 5px;
    }

    .quantity-btn {
      width: 32px;
      height: 32px;
      border: none;
      background: white;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: #666;
      transition: all 0.3s ease;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .quantity-btn:hover {
      background: red;
      color: white;
      transform: scale(1.1);
    }

    .quantity-display {
      min-width: 30px;
      text-align: center;
      font-weight: 600;
      color: #333;
    }

    .remove-item {
      color: #999;
      cursor: pointer;
      padding: 8px;
      border-radius: 50%;
      transition: all 0.3s ease;
    }

    .remove-item:hover {
      color: red;
      background: rgba(255,0,0,0.1);
    }

    .cart-total {
      padding: 25px;
      border-top: 2px solid #f0f0f0;
      background: linear-gradient(135deg, #f8f9fa, #ffffff);
      text-align: center;
    }

    .cart-total-amount {
      font-size: 28px;
      font-weight: bold;
      color: red;
      margin-bottom: 20px;
      text-shadow: 0 2px 4px rgba(255,0,0,0.1);
    }

    .checkout-btn {
      background: linear-gradient(135deg, #ff3333, #cc0000);
      color: white;
      border: none;
      padding: 15px 40px;
      border-radius: 30px;
      font-size: 18px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(255,0,0,0.3);
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .checkout-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(255,0,0,0.4);
    }

     /* Company Sidebar Styles */
        .company-sidebar {
            position: fixed;
            left: -250px; /* Hidden by default on all devices */
            top: 50%;
            transform: translateY(-50%);
            width: 200px;
            background: white;
            border-radius: 0 15px 15px 0;
            box-shadow: 2px 0 15px rgba(0,0,0,0.1);
            padding: 20px 10px;
            z-index: 999;
            transition: all 0.5s ease;
        }

        /* When sidebar is shown */
        .company-sidebar.show {
            left: 0;
        }

        /* Sidebar toggle button styles */
        .sidebar-toggle {
            position: absolute;
            right: -40px;
            top: 20px;
            width: 40px;
            height: 60px;
            background: #dc3545;
            border: none;
            border-radius: 0 10px 10px 0;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: #c82333;
        }

        /* Company items styling */
        .company-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #eee;
            text-decoration: none;
            color: inherit;
        }

        .company-item:hover {
            background: rgba(220, 53, 69, 0.05);
            border-color: #dc3545;
            transform: translateX(5px);
            text-decoration: none;
            color: inherit;
        }

        .company-logo {
            width: 40px;
            height: 40px;
            background: #f5f5f5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #666;
            font-size: 12px;
        }

        .company-name {
            font-weight: 500;
            color: #222;
            font-size: 14px;
        }

        /* Desktop styles - sidebar can be toggled */
        @media (min-width: 768px) {
            .main-content {
                transition: margin-left 0.5s ease;
            }
            
            /* When sidebar is shown on desktop, push content to the right */
            body.sidebar-open .main-content {
                margin-left: 200px;
            }
        }

        /* Mobile specific adjustments */
        @media (max-width: 767px) {
            .company-sidebar {
                width: 250px;
                left: -250px;
            }
            
            .company-sidebar.show {
                left: 0;
            }
        }

/* Search Bar */
.search-bar {
  display: flex;
  align-items: center;
  margin-top: 20px;
  margin-bottom: 20px;
}

.search-bar input[type="text"] {
  flex: 1;
  padding: 10px 20px;
  border: 2px solid red;
  border-radius: 25px 0 0 25px;
  outline: none;
  font-size: 16px;
  background: white;
}

.search-bar button {
  background: red;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 0 25px 25px 0;
  cursor: pointer;
  transition: background 0.3s ease;
}

.search-bar button:hover {
  background: #cc0000;
}

/* Responsive Search Bar */
@media (max-width: 768px) {
  .search-bar {
    flex-direction: column; 
  }
  
  .search-bar input[type="text"],
  .search-bar button {
    width: 100%;
    border-radius: 25px;
    margin-bottom: 10px;
  }
}


   /* Mobile Navigation Styles */
.menu-toggle {
  display: none;
  font-size: 24px;
  cursor: pointer;
  padding: 10px;
  color: #222;
  transition: all 0.3s ease;
  position: relative;
  z-index: 21000;
}

.menu-toggle:hover {
  color: red;
  transform: scale(1.1);
}

.menu-toggle.active {
  color: red;
}

.close-menu {
  position: absolute;
  top: 20px;
  right: 20px;
  font-size: 24px;
  color: #666;
  cursor: pointer;
  transition: all 0.3s ease;
}

.close-menu:hover {
  color: red;
  transform: scale(1.1);
}

.mobile-nav {
  position: fixed;
  top: 0;
  left: 0;
  width: 80%;
  height: 100%;
  background-color: white;
  box-shadow: 2px 0 15px rgba(0, 0, 0, 0.3);
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding: 80px 25px;
  transform: translateX(-100%);
  transition: transform 0.5s cubic-bezier(0.4, 0.0, 0.2, 1);
  z-index: 2000;
  overflow-y: auto; /* Allow scrolling within mobile nav */
}

.mobile-nav a {
  text-decoration: none;
  color: #333;
  font-size: 20px;
  padding: 15px 0;
  display: block;
  border-bottom: 1px solid #eee;
  transition: all 0.3s ease;
  opacity: 0;
  transform: translateX(-20px);
}

.mobile-nav.show {
  transform: translateX(0);
}

.mobile-nav.show a {
  opacity: 1;
  transform: translateX(0);
  transition: opacity 0.5s ease, transform 0.5s ease;
}

.mobile-nav.show a:nth-child(2) { 
  transition-delay: 0.1s; 
}

.mobile-nav a:hover {
  color: red;
  padding-left: 10px;
  background-color: rgba(255, 0, 0, 0.05);
  border-radius: 4px;
}

.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  z-index: 1500;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.4s ease, visibility 0.4s ease;
  backdrop-filter: blur(3px);
  -webkit-backdrop-filter: blur(3px);
}

.overlay.show {
  opacity: 1;
  visibility: visible;
}

/* Prevent body scroll when mobile nav is open */
body.mobile-nav-open {
  overflow: hidden;
  position: fixed;
  width: 100%;
}

/* Mobile dropdown box */
.mobile-dropdown {
  position: relative;
}

.mobile-dropbtn {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  padding: 10px 15px;
  text-decoration: none;
  border: none;
  background: none;
  cursor: pointer;
}

.mobile-dropdown-content {
  display: none;
  background-color: rgba(255, 255, 255, 0.1);
  padding-left: 20px;
  max-height: 200px; /* Limit height of dropdown */
  overflow-y: auto; /* Add scroll to dropdown content */
  border-radius: 4px;
  margin: 5px 0;
}

/* Custom scrollbar for mobile dropdown */
.mobile-dropdown-content::-webkit-scrollbar {
  width: 4px;
}

.mobile-dropdown-content::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.1);
  border-radius: 2px;
}

.mobile-dropdown-content::-webkit-scrollbar-thumb {
  background: rgba(255, 0, 0, 0.3);
  border-radius: 2px;
}

.mobile-dropdown-content::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 0, 0, 0.5);
}

.mobile-dropdown-content a {
  padding: 8px 15px;
  text-decoration: none;
  display: block;
  font-size: 16px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.mobile-dropdown-content a:last-child {
  border-bottom: none;
}

.mobile-dropdown.active .mobile-dropdown-content {
  display: block;
}

.mobile-dropdown.active .fa-chevron-down {
  transform: rotate(180deg);
  transition: transform 0.3s ease;
}

/* Hide other dropdowns when one is active */
.mobile-nav:has(.mobile-dropdown.active) .mobile-dropdown:not(.active) {
  opacity: 0.3;
  pointer-events: none;
  transition: opacity 0.3s ease;
}

/* Dropdown Styles */
.dropdown {
  position: relative;
  display: inline-block;
}

.dropbtn {
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 6px;
  text-decoration: none;
  color: #222;
  font-size: 16px;
  font-weight: 500;
  position: relative;
  transition: all 0.3s ease;
  padding: 5px 0;
}

.dropbtn::after {
  content: '▼';
  font-size: 10px;
  transition: transform 0.3s ease;
}

.dropdown:hover .dropbtn {
  color: red;
}

.dropdown:hover .dropbtn::after {
  transform: rotate(180deg);
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 180px;
  max-height: 300px; /* Limit height */
  overflow-y: auto; /* Add scroll */
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  z-index: 1000;
  top: 100%;
  left: 0;
  border-radius: 5px;
  margin-top: 10px;
  padding-top: 8px;
}

/* Custom scrollbar for desktop dropdown */
.dropdown-content::-webkit-scrollbar {
  width: 6px;
}

.dropdown-content::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 3px;
}

.dropdown-content::-webkit-scrollbar-thumb {
  background: rgba(255, 0, 0, 0.3);
  border-radius: 3px;
}

.dropdown-content::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 0, 0, 0.5);
}

.dropdown:hover .dropdown-content,
.dropdown-content:hover,
.dropdown-content:focus-within {
  display: block !important;
}

.dropdown-content a {
  color: #222;
  padding: 10px 16px;
  text-decoration: none;
  display: block;
  transition: all 0.3s ease;
  font-size: 15px;
}

.dropdown-content a:hover {
  background-color: rgba(255, 0, 0, 0.1);
  color: red;
  padding-left: 20px;
}

.dropdown .dropbtn:before {
  content: '';
  position: absolute;
  width: 0;
  height: 2px;
  bottom: 0;
  left: 0;
  background-color: red;
  transition: width 0.3s ease;
}

.dropdown:hover .dropbtn:before {
  width: 100%;
}

/* Additional mobile-specific enhancements */
@media (max-width: 768px) {
  .mobile-dropdown-content {
    max-height: 150px; /* Smaller height on mobile */
  }
  
  /* Smooth scrolling for better mobile experience */
  .mobile-dropdown-content,
  .dropdown-content {
    scroll-behavior: smooth;
  }
}
    /* User Dropdown Styles */
    .user-dropdown {
      position: relative;
      display: inline-block;
    }

    .user-dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      background-color: white;
      min-width: 180px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      border-radius: 5px;
      overflow: hidden;
      margin-top: 10px;
      padding-top: 8px;
    }

    .user-dropdown:hover .user-dropdown-content,
    .user-dropdown-content:hover,
    .user-dropdown-content:focus-within {
      display: block !important;
    }

    .user-login {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #222;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      padding: 6px 12px;
      border-radius: 20px;
      background-color: #f5f5f5;
    }

    .user-login i {
      font-size: 18px;
      color: red;
    }

    .user-login span {
      font-size: 15px;
    }

    .user-login:hover {
      background-color: #eaeaea;
      transform: translateY(-2px);
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .user-dropdown-content a {
      color: #222;
      padding: 10px 16px;
      text-decoration: none;
      display: block;
      transition: all 0.3s ease;
      font-size: 15px;
    }

    .user-dropdown-content a:hover {
      background-color: rgba(255, 0, 0, 0.1);
      color: red;
      padding-left: 20px;
    }

    .user-dropdown-content a i {
      margin-right: 8px;
      color: red;
      width: 20px;
      text-align: center;
    }

    /* Hero Section */
    .hero-section {
      background: linear-gradient(135deg, #222 0%, #444 100%);
      padding: 80px 50px;
      text-align: center;
      color: white;
    }

    .hero-title {
      font-size: 48px;
      font-weight: bold;
      margin-bottom: 20px;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .hero-subtitle {
      font-size: 20px;
      margin-bottom: 30px;
      opacity: 0.9;
    }

    .hero-cta {
      background: red;
      color: white;
      padding: 15px 40px;
      border: none;
      border-radius: 30px;
      font-size: 18px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .hero-cta:hover {
      background: #cc0000;
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(255, 0, 0, 0.3);
    }

    /* Footer */
    footer {
      background-color: #222;
      padding: 60px 50px;
      color: #eee;
    }

    .footer-columns {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 40px;
    }

    .footer-column {
      flex: 1;
      min-width: 300px;
    }

    .footer-column h4 {
      color: #ff3333;
      margin-bottom: 20px;
      font-size: 20px;
      position: relative;
      padding-bottom: 10px;
    }

    .footer-column h4:after {
      content: '';
      position: absolute;
      width: 50px;
      height: 2px;
      background-color: #ff3333;
      bottom: 0;
      left: 0;
    }

    .footer-column p,
    .footer-column a {
      font-size: 15px;
      line-height: 1.8;
      color: #ddd;
      text-decoration: none;
      margin-bottom: 10px;
    }

    .footer-info {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }

    .footer-info i {
      width: 25px;
      color: #ff3333;
      margin-right: 10px;
    }

    .footer-form {
      margin-top: 20px;
    }

    .footer-form input,
    .footer-form select {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: none;
      background-color: rgba(255, 255, 255, 0.1);
      color: white;
      border-radius: 4px;
    }

    .footer-form input::placeholder,
    .footer-form select {
      color: #aaa;
    }

    .footer-form button {
      padding: 12px 24px;
      background-color: #ff3333;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: all 0.3s;
      font-weight: 500;
    }

    .footer-form button:hover {
      background-color: #cc0000;
    }

    .copyright {
      text-align: center;
      padding-top: 30px;
      margin-top: 30px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: #aaa;
      font-size: 14px;
    }

    /* Empty Cart State */
    .empty-cart {
      text-align: center;
      padding: 40px 20px;
      color: #666;
    }

    .empty-cart i {
      font-size: 64px;
      color: #ddd;
      margin-bottom: 20px;
    }

    .empty-cart h3 {
      margin-bottom: 10px;
      color: #333;
    }

    /* Media Queries */
    @media (max-width: 992px) {
      .header {
        padding: 10px 30px;
      }
      .search-container {
        min-width: 250px;
      }
      .main-content {
        padding: 20px 30px;
      }
      .hero-section {
        padding: 60px 30px;
      }
      .hero-title {
        font-size: 36px;
      }
    }

    @media (max-width: 768px) {
      .header {
        padding: 10px 20px;
        flex-wrap: wrap;
      }
      .nav-links {
        display: none;
      }
      .menu-toggle {
        display: block;
      }
      .search-container {
        order: 3;
        width: 100%;
        margin: 10px 0 0 0;
        min-width: auto;
      }
      .action-buttons {
        position: absolute;
        right: 60px;
      }
      .user-dropdown span {
        display: none;
      }
      .user-login {
        padding: 6px;
        background: transparent;
      }
      .user-login i {
        font-size: 22px;
      }
      .cart-wrapper {
        margin-right: 10px;
      }
      .cart-icon {
        background: transparent;
      }
      .cart-icon i {
        font-size: 22px;
      }
      .main-content {
        padding: 20px 15px;
      }
      .products-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
      }
      .company-sidebar {
        width: 180px;
        left: -200px;
      }
      .hero-section {
        padding: 50px 20px;
      }
      .hero-title {
        font-size: 28px;
      }
      .hero-subtitle {
        font-size: 16px;
      }
    }

    @media (max-width: 480px) {
      .products-grid {
        grid-template-columns: 1fr;
      }
      .cart-content {
        width: 95%;
        margin: 10px;
      }
      .hero-title {
        font-size: 24px;
      }
      .footer-columns {
        flex-direction: column;
      }
      .footer-column {
        min-width: auto;
      }
    }

    .close-menu {
      position: absolute;
      top: 20px;
      right: 20px;
      font-size: 24px;
      color: #333;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .close-menu:hover {
      color: red;
      transform: rotate(90deg);
    }
  </style>
</head>
<body>

<!-- Header -->
<header class="header" id="header">
  <img src="logo.png" alt="Reflect Logo" class="logo"> 

  <nav class="nav-links">
     <a href="frontage.php">Home</a> 
    <a href="aboutus1.php">About Us</a>
    <div class="dropdown">
      <a href="product1.php"><span class="dropbtn">Products</span></a>
      <div class="dropdown-content">
        <a href="bridgestone1.php" onclick="filterProducts('bridgestone')">Bridgestone</a>
        <a href="michlen1.php" onclick="filterProducts('michelin')">Michelin</a>
        <a href="ascenso1.php" onclick="filterProducts('ascenso')">Ascenso</a>
        <a href="apollo1.php" onclick="filterProducts('apollo')">Apollo</a>
        <a href="jk1.php" onclick="filterProducts('jk')">JK</a>
      </div>
    </div>
    <a href="service1.php">Services</a>
    <a href="contactus1.php">Contact Us</a>
  </nav>

  <!-- Search Container -->
  <div class="search-container">
    <div class="search-box">
      <input type="text" class="search-input" id="searchInput" placeholder="Search for tires...">
      <button class="search-btn" onclick="performSearch()">
        <i class="fas fa-search"></i>
      </button>
    </div>
    <div class="search-dropdown" id="searchDropdown"></div>
  </div>
 
<div class="action-buttons">

  <div class="action-buttons">
    <!-- Cart icon -->
    <div class="cart-wrapper">
      <div class="cart-icon" onclick="toggleCart()">
        <i class="fas fa-shopping-cart"></i>
        <span class="cart-count" id="cartCount">0</span>
      </div>
    </div>
    
    <!-- User dropdown separated from cart -->
    <div class="user-dropdown">
      <div class="user-login" id="userLoginToggle">
        <i class="fas fa-user-circle"></i>
        <span>Hi User</span>
      </div>
      <div class="user-dropdown-content" id="userDropdownContent">
        <a href="welcomr.php"><i class="fas fa-sign-in-alt"></i> Login</a>
        <a href="welcomr.php"><i class="fas fa-user-plus"></i> Sign Up</a>
        <a href="#orders"><i class="fas fa-box"></i> My Orders</a>
        <a href="#profile"><i class="fas fa-user-cog"></i> Profile</a>
      </div>
    </div>
  </div>
  <!-- Mobile menu toggle -->
  <div class="menu-toggle" id="mobileMenuToggle" onclick="toggleMobileMenu()">
  <i class="fas fa-bars"></i>
</div>
</header>

<!-- Separator -->
<div class="separator"></div>

<!-- Mobile navigation -->
<div class="mobile-nav" id="mobileNav">
    <i class="fas fa-times close-menu" id="closeMenu"></i>
    <a href="frontage.php">Home</a>
    <a href="aboutus1.php">About Us</a>
    
    <!-- Mobile dropdown for Products -->
    <div class="mobile-dropdown">
        <a href="product1.php" class="mobile-dropbtn">Products <i class="fas fa-chevron-down"></i></a>
        <div class="mobile-dropdown-content">
            <a href="bridgestone1.php" onclick="filterProducts('bridgestone')">Bridgestone</a>
            <a href="michlen1.php" onclick="filterProducts('michelin')">Michelin</a>
            <a href="ascenso1.php" onclick="filterProducts('ascenso')">Ascenso</a>
            <a href="apollo1.php" onclick="filterProducts('apollo')">Apollo</a>
            <a href="jk1.php" onclick="filterProducts('jk')">JK</a>
        </div>
    </div>
    
    <a href="service1.php">Services</a>
    <a href="contactus1.php">Contact Us</a>
    <a href="profile1.php"><i class="fas fa-user"></i> My Profile</a>
    <a href="policy1.php"><i class="fas fa-user"></i> Policies</a>
    <a href="myorder1.php"><i class="fas fa-shopping-bag"></i> My Orders</a>
    <a href="past-orders1.php"><i class="fas fa-shopping-bag"></i> Past Orders</a>

</div>

<!-- Overlay for mobile menu -->
<div class="overlay" id="overlay" onclick="toggleMobileMenu()"></div>

<!-- Cart Modal -->
<div class="cart-modal" id="cartModal">
  <div class="cart-content">
    <div class="cart-header">
      <h3>Shopping Cart</h3>
      <button class="cart-close" onclick="toggleCart()">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="cart-items" id="cartItems">
      <div class="empty-cart">
        <i class="fas fa-shopping-cart"></i>
        <h3>Your cart is empty</h3>
        <p>Add some tires to get started!</p>
      </div>
    </div>
    <div class="cart-total" id="cartTotal" style="display: none;">
      <div class="cart-total-amount">Total: $0.00</div>
      <button class="checkout-btn">Proceed to Checkout</button>
    </div>
  </div>
</div>

<!-- Company Sidebar -->
    <div class="company-sidebar" id="companySidebar">
        <!-- Toggle button for both mobile & desktop -->
        <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
            <i class="fas fa-chevron-right"></i>
        </button>
        
        <!-- Company items as links -->
        <a class="company-item" href="bridgestone1.php">
            <div class="company-logo">BS</div>
            <div class="company-name">Bridgestone</div>
        </a>
        <a class="company-item" href="michlen1.php">
            <div class="company-logo">MC</div>
            <div class="company-name">Michelin</div>
        </a>
        <a class="company-item" href="ascenso1.php">
            <div class="company-logo">AS</div>
            <div class="company-name">Ascenso</div>
        </a>
        <a class="company-item" href="apollo1.php">
            <div class="company-logo">AP</div>
            <div class="company-name">Apollo</div>
        </a>
        <a class="company-item" href="jk1.php">
            <div class="company-logo">JK</div>
            <div class="company-name">JK Tyre</div>
        </a>
    </div>

   

<!-- Main Content -->
<main class="main-content">
  <!-- Hero Section -->
  <section class="hero-section">
    <h1 class="hero-title">Premium Tires for Every Journey</h1>
    <p class="hero-subtitle">Discover top-quality tires from leading brands. Safety, performance, and durability guaranteed.</p>
    <a href="#products" class="hero-cta" onclick="showAllProducts()">Shop Now</a>
  </section>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tire Shop</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
 font-family: Arial, sans-serif;
 background: #f8f9fa;
}

/* Main Content */
.main-container {
 min-height: 100vh;
 background: #f8f9fa;
 padding: 20px 50px;
}

/* Products Section */
.products-section {
 display: block;
 background: white;
 border-radius: 15px;
 padding: 30px;
 margin-top: 20px;
 box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

/* Section Titles */
.section-header {
 text-align: center;
 margin-bottom: 30px;
}

.section-title {
 font-size: 28px;
 color: #222;
 margin-bottom: 10px;
}

.section-subtitle {
 color: #666;
 font-size: 16px;
}

/* Products Grid */
.products-grid {
 display: grid;
 grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
 gap: 30px;
 margin-top: 30px;
}

/* Product Card */
.product-card {
 background: white;
 border-radius: 15px;
 padding: 20px;
 box-shadow: 0 4px 15px rgba(0,0,0,0.1);
 transition: all 0.3s ease;
 border: 1px solid #eee;
 cursor: pointer;
}

.product-card:hover {
 transform: translateY(-5px);
 box-shadow: 0 8px 25px rgb(254, 111, 111);
}

/* Product Image */
.product-image {
 width: 100%;
 height: 350px;
 background: #f5f5f5;
 border-radius: 10px;
 display: flex;
 align-items: center;
 justify-content: center;
 margin-bottom: 15px;
 overflow: hidden;
 border: 2px solid #eee;
}

.product-image img {
 width: auto;
 height: 100%;
 object-fit: contain;
 border-radius: 8px;
}

/* Image Placeholder for missing images */
.product-image-placeholder {
 color: #999;
 font-size: 48px;
}

/* Product Text */
.product-brand {
 font-size: 12px;
 color: red;
 font-weight: 600;
 text-transform: uppercase;
 margin-bottom: 8px;
}

.product-name {
 font-size: 18px;
 font-weight: 600;
 color: #222;
 margin-bottom: 10px;
}

.product-specs {
 font-size: 14px;
 color: #666;
 margin-bottom: 15px;
}

.product-price {
 font-size: 20px;
 font-weight: bold;
 color: red;
 margin-bottom: 15px;
}

/* Mobile-only centering */
@media (max-width: 768px) {
 .main-container {
   padding: 10px;
   display: flex;
   justify-content: center;
   align-items: center;
 }
 
 .products-section {
   padding: 20px;
   margin-top: 10px;
   max-width: 100%;
 }
 
 .products-grid {
   display: flex;
   flex-direction: column;
   align-items: center;
   gap: 20px;
 }
 
 .product-card {
   width: 100%;
   max-width: 350px;
   text-align: center;
   display: flex;
   flex-direction: column;
   align-items: center;
 }
 
 .product-brand,
 .product-name,
 .product-specs,
 .product-price {
   text-align: center;
   width: 100%;
 }
}

/* Add to Cart Button */
.add-to-cart-btn {
    width: 100%;
    background: red;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.add-to-cart-btn:hover {
    background: #cc0000;
    transform: translateY(-2px);
}

/* Toast notification */
.toast {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #4caf50;
    color: white;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transform: translateX(400px);
    transition: transform 0.3s ease;
    z-index: 1000;
}

.toast.show {
    transform: translateX(0);
}

/* ===== CART MODAL STYLES ===== */

/* Cart Modal Overlay */
.cart-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}

/* Cart Content Container */
.cart-content {
    background: white;
    width: 90%;
    max-width: 500px;
    max-height: 80vh;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
    display: flex;
    flex-direction: column;
}

/* Cart Header */
.cart-header {
    background: #333;
    color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cart-header h3 {
    margin: 0;
    font-size: 1.3rem;
    font-weight: 600;
}

.cart-close {
    background: none;
    border: none;
    color: white;
    font-size: 1.8rem;
    cursor: pointer;
    padding: 8px;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s;
}

.cart-close:hover {
    background: rgba(255, 255, 255, 0.2);
}

/* Cart Items Container */
.cart-items {
    flex: 1;
    overflow-y: auto;
    max-height: 400px;
    padding: 20px;
}

/* Empty Cart State */
.empty-cart {
    text-align: center;
    padding: 50px 20px;
    color: #666;
}

.empty-cart i {
    font-size: 4rem;
    margin-bottom: 20px;
    color: #ddd;
}

.empty-cart h3 {
    margin: 15px 0 10px 0;
    color: #333;
    font-size: 1.3rem;
}

.empty-cart p {
    color: #666;
    font-size: 1rem;
}

/* Individual Cart Item */
.cart-item {
    display: flex;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid #eee;
    gap: 15px;
}

.cart-item:last-child {
    border-bottom: none;
}

/* Cart Item Info */
.cart-item-info {
    flex: 1;
}

.cart-item-info h4 {
    margin: 0 0 8px 0;
    font-size: 1.1rem;
    color: #333;
    font-weight: 600;
}

.cart-item-info p {
    margin: 0;
    font-size: 0.9rem;
    color: #666;
}

/* Quantity Controls */
.cart-item-controls {
    display: flex;
    align-items: center;
    gap: 12px;
}

.cart-item-controls button {
    width: 35px;
    height: 35px;
    border: 2px solid #ddd;
    background: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    font-size: 1.2rem;
    font-weight: bold;
    transition: all 0.3s;
}

.cart-item-controls button:hover {
    background: #f5f5f5;
    border-color: #999;
}

.cart-item-controls .qty {
    min-width: 35px;
    text-align: center;
    font-weight: bold;
    font-size: 1.1rem;
}

/* Item Price */
.cart-item-price {
    font-weight: bold;
    color: red;
    min-width: 90px;
    text-align: right;
    font-size: 1.1rem;
}

/* Remove Item Button */
.remove-item {
    background: none;
    border: none;
    color: #ff4757;
    cursor: pointer;
    padding: 8px;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s;
    font-size: 1.1rem;
}

.remove-item:hover {
    background: rgba(255, 71, 87, 0.1);
}

/* Cart Total Section */
.cart-total {
    border-top: 2px solid #eee;
    padding: 25px;
    background: #f8f9fa;
}

.cart-total-amount {
    font-size: 1.4rem;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: right;
    color: #333;
}

.checkout-btn {
    width: 100%;
    background: red;
    color: white;
    border: none;
    padding: 15px;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.checkout-btn:hover {
    background: #cc0000;
    transform: translateY(-2px);
}

/* Mobile Responsiveness for Cart */
@media (max-width: 768px) {
    .cart-content {
        width: 95%;
        max-height: 90vh;
    }
    
    .cart-header {
        padding: 15px;
    }
    
    .cart-items {
        padding: 15px;
    }
    
    .cart-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
        padding: 15px 0;
    }
    
    .cart-item-controls {
        align-self: flex-end;
    }
    
    .cart-item-price {
        align-self: flex-end;
        min-width: auto;
    }
    
    .cart-total {
        padding: 20px 15px;
    }
}
</style>
</head>
<body>
    <div class="main-container">
        <main>
            <!-- Products Section -->
            <section class="products-section" id="productsSection">
                <div class="section-header">
                    <h2 class="section-title" id="sectionTitle">All Truck Tyres</h2>
                    <p class="section-subtitle" id="sectionSubtitle">All Type of Truck Tyres</p>
                </div>
                <div class="products-grid" id="productsGrid">
                    
                    <!-- Product 1: Apollo Endu -->
<div class="product-card" data-id="1" data-redirect="m751hl1.php" data-name="M751 HL">
    <div class="product-image">
        <img src="m751hl.jpg" alt="M751 HL" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
        <div class="product-image-placeholder" style="display: none;">🛞</div>
    </div>
    <div class="product-brand">Bridgestone</div>
    <div class="product-name">M751 HL</div>
    <div class="product-specs">295/90 R 20</div>
    <div class="product-price">₹20,750</div>
    <button class="add-to-cart-btn">Add to Cart</button>
</div>


                    <!-- Product 2: Bridgestone Turanza T005 -->
                    <div class="product-card" data-redirect="R2711.php" data-name="R271">
                        <div class="product-image">
                            <img src="R271.png" alt="R271" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <div class="product-image-placeholder" style="display: none;">🛞</div>
                        </div>
                        <div class="product-brand">Bridgestone</div>
                        <div class="product-name">R271</div>
                        <div class="product-specs">295/90 R20</div>
                        <div class="product-price">₹19,852</div>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>

                    <!-- Product 3: Michelin Pilot Sport 4 -->
                    <div class="product-card" data-redirect="M7251.php" data-name="M725">
                        <div class="product-image">
                            <img src="M725.jpg" alt="M725" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <div class="product-image-placeholder" style="display: none;">🛞</div>
                        </div>
                        <div class="product-brand">Bridgestone</div>
                        <div class="product-name">M725</div>
                        <div class="product-specs">295/90 R20</div>
                        <div class="product-price">₹20,476</div>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>

                    <!-- Product 4: Michelin Energy XM2+ -->
                    <div class="product-card" data-redirect="R1561.php" data-name="R156">
                        <div class="product-image">
                            <img src="R156.png" alt="R156" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <div class="product-image-placeholder" style="display: none;">🛞</div>
                        </div>
                        <div class="product-brand">Bridgestone</div>
                        <div class="product-name">R156(TL)</div>
                        <div class="product-specs">295/80 R22.5</div>
                        <div class="product-price">₹20,827</div>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>

                    <!-- Product 5: Bridgestone G611 -->
                    <div class="product-card" data-redirect="G6111.php" data-name="G611">
                        <div class="product-image">
                            <img src="G611.png" alt="G611" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <div class="product-image-placeholder" style="display: none;">🛞</div>
                        </div>
                        <div class="product-brand">Bridgestone</div>
                        <div class="product-name">G611</div>
                        <div class="product-specs">295/90 R20</div>
                        <div class="product-price">₹20,085</div>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>

                   
                </div>
            </section>
        </main>
    </div>
    <div data-product-id="1"> <!-- Product ID here -->
    <div id="stock-display"></div>
    <div id="stock-status"></div>
    <!-- Toast Notification -->
    <div id="toast" class="toast"></div>
    <!-- Footer -->
<footer>
  <div class="footer-columns">
    <div class="footer-column">
      <h4>About Us</h4>
      <p>Prabhat Tyre House is a leading distributor of premium tyre brands, providing quality products and exceptional service to our customers since 1995.</p>
      <div class="footer-info">
        <i class="fas fa-map-marker-alt"></i>
        <p>Shop no-8, private bus stand opp Ramlila gate,<br>
        Delhi - Meerut Expy,<br>
        Hapur, Uttar Pradesh 245101</p>
      </div>
      <div class="footer-info">
        <i class="fas fa-phone"></i>
        <p>(+91) 9897540275</p>
      </div>
      <div class="footer-info"> 
        <i class="fas fa-envelope"></i>
        <p>prabhattyrehouse@gmail.com</p>
      </div>
    </div>
    
<div class="footer-column">
    <h4>Quick Links</h4>
    <p><a href="frontpage.php">Home</a></p>
    <p><a href="aboutus1.php">About Us</a></p>
    <p><a href="product1.php">Products</a></p>
    <p><a href="service1.php">Services</a></p>
    <p><a href="contactus1.php">Contact Us</a></p>
</div>
    <div class="footer-column">
      <h4>Join our mailing list</h4>
      <p>Subscribe to receive newsletters, price lists and special offers.</p>
      <div class="footer-form">
        <input type="text" placeholder="Name *" required>
        <input type="email" placeholder="Email Address *" required>
        <input type="text" placeholder="Company">
        <select>
          <option value="">Select Country</option>
          <option value="India">India</option>
          <option value="USA">USA</option>
          <option value="UK">UK</option>
          <option value="Other">Other</option>
        </select>
        <button>Sign Up</button>
      </div>
    </div>
  </div>
  <div class="copyright">
    &copy; 2025-2026 Prabhat Tyre House. All Rights Reserved.
  </div>
</footer>
<script src="path/to/user-detector.js"></script>
    <script>
// Fixed Product Page Stock Control System - Each tire ID tracked separately
class ProductStockController {
    constructor(productId) {
        this.productId = productId;
        this.stockData = this.loadStockData();
        this.init();
    }

    // Load stock data from storage - each product ID has separate stock
    loadStockData() {
        const savedStock = sessionStorage.getItem('tireStockLevels') || localStorage.getItem('tireStockLevels');
        if (savedStock) {
            try {
                const data = JSON.parse(savedStock);
                // Ensure each tire ID has a stock entry if not present
                this.initializeDefaultStock(data);
                return data;
            } catch (e) {
                console.error('Error parsing stock data:', e);
                return this.getDefaultStockData();
            }
        }
        return this.getDefaultStockData();
    }

    // Initialize default stock for all tires if not present
    initializeDefaultStock(stockData) {
        const allTires = this.getAllTires();
        let updated = false;
        
        allTires.forEach(tire => {
            if (stockData[tire.id] === undefined) {
                // Set different stock levels based on tire brand/price for demo
                stockData[tire.id] = this.getInitialStockForTire(tire);
                updated = true;
            }
        });

        if (updated) {
            this.saveStockData(stockData);
        }
    }

    // Get initial stock based on tire characteristics
    getInitialStockForTire(tire) {
        // Different stock levels for different brands/price ranges
        if (tire.brand === 'Bridgestone') return Math.floor(Math.random() * 20) + 15; // 15-35
        if (tire.brand === 'Michelin') return Math.floor(Math.random() * 15) + 10; // 10-25
        if (tire.brand === 'Apollo' && tire.price > 25000) return Math.floor(Math.random() * 12) + 8; // 8-20
        if (tire.brand === 'Apollo') return Math.floor(Math.random() * 25) + 20; // 20-45
        if (tire.brand === 'JK') return Math.floor(Math.random() * 18) + 12; // 12-30
        if (tire.brand === 'Ascenso') return Math.floor(Math.random() * 30) + 25; // 25-55
        return Math.floor(Math.random() * 20) + 10; // Default 10-30
    }

    // Get default stock data for all tires
    getDefaultStockData() {
        const stockData = {};
        const allTires = this.getAllTires();
        
        allTires.forEach(tire => {
            stockData[tire.id] = this.getInitialStockForTire(tire);
        });
        
        this.saveStockData(stockData);
        return stockData;
    }

    // Get all tires from the global tires array
    getAllTires() {
        // This should reference your global tires array
        return window.tires || tires || [];
    }

    // Save stock data to storage
    saveStockData(data) {
        try {
            sessionStorage.setItem('tireStockLevels', JSON.stringify(data));
            localStorage.setItem('tireStockLevels', JSON.stringify(data));
        } catch (e) {
            console.error('Error saving stock data:', e);
        }
    }

    // Get current stock level for this specific product ID
    getCurrentStock() {
        return this.stockData[this.productId] || 0;
    }

    // Check if this specific product is in stock
    isInStock() {
        return this.getCurrentStock() > 0;
    }

    // Get stock status with styling classes
    getStockStatus() {
        const stock = this.getCurrentStock();
        if (stock === 0) return { class: 'out-of-stock', text: 'Out of Stock', color: '#dc3545' };
        if (stock <= 5) return { class: 'low-stock', text: `Only ${stock} left!`, color: '#ff8c00' };
        if (stock <= 10) return { class: 'low-stock', text: `${stock} in stock`, color: '#ffa500' };
        return { class: 'in-stock', text: `${stock} in stock`, color: '#28a745' };
    }

    // Update stock level for this product (when item is purchased)
    updateStock(newQuantity) {
        this.stockData[this.productId] = Math.max(0, newQuantity);
        this.saveStockData(this.stockData);
        
        // Dispatch event for other components to listen
        window.dispatchEvent(new CustomEvent('stockUpdated', {
            detail: {
                productId: this.productId,
                newStock: this.stockData[this.productId],
                allStock: this.stockData
            }
        }));
        
        this.updateBuyButton();
    }

    // Reduce stock when item is added to cart
    reduceStock(quantity = 1) {
        const currentStock = this.getCurrentStock();
        const newStock = Math.max(0, currentStock - quantity);
        this.updateStock(newStock);
        return newStock;
    }

    // Get tire info for this product ID
    getTireInfo() {
        const allTires = this.getAllTires();
        return allTires.find(tire => tire.id == this.productId) || null;
    }

    // Update buy button state
    updateBuyButton() {
        const buyButtons = document.querySelectorAll('.buy-btn, .add-to-cart, [data-action="buy"], [data-action="add-to-cart"]');
        const quantityInputs = document.querySelectorAll('.quantity-input, input[name="quantity"]');
        const stockDisplays = document.querySelectorAll('.stock-display, .stock-status, .availability');
        
        const isAvailable = this.isInStock();
        const status = this.getStockStatus();
        const tireInfo = this.getTireInfo();

        // Update buy buttons
        buyButtons.forEach(button => {
            if (isAvailable) {
                button.disabled = false;
                button.classList.remove('disabled', 'out-of-stock');
                button.textContent = button.dataset.originalText || 'Add to Cart';
                button.style.backgroundColor = '';
                button.style.cursor = 'pointer';
            } else {
                button.disabled = true;
                button.classList.add('disabled', 'out-of-stock');
                button.dataset.originalText = button.dataset.originalText || button.textContent;
                button.textContent = 'Out of Stock';
                button.style.backgroundColor = '#6c757d';
                button.style.cursor = 'not-allowed';
            }
        });

        // Update quantity inputs
        quantityInputs.forEach(input => {
            if (isAvailable) {
                input.disabled = false;
                input.max = this.getCurrentStock();
                input.style.backgroundColor = '';
                // Set default value if empty
                if (!input.value || input.value === '0') {
                    input.value = 1;
                }
            } else {
                input.disabled = true;
                input.value = 0;
                input.style.backgroundColor = '#f8f9fa';
            }
        });

        // Update stock displays with product info
        stockDisplays.forEach(display => {
            let displayText = status.text;
            if (tireInfo) {
                displayText += ` - ${tireInfo.name} (ID: ${tireInfo.id})`;
            }
            display.textContent = displayText;
            display.className = `stock-display ${status.class}`;
            display.style.color = status.color;
            display.style.fontWeight = 'bold';
        });

        console.log(`Stock updated for Product ID ${this.productId}: ${this.getCurrentStock()} units`);
    }

    // Validate quantity selection
    validateQuantity(requestedQty) {
        const currentStock = this.getCurrentStock();
        const tireInfo = this.getTireInfo();
        const productName = tireInfo ? `${tireInfo.name} (ID: ${tireInfo.id})` : `Product ID ${this.productId}`;
        
        if (!this.isInStock()) {
            this.showStockAlert(`${productName} is currently out of stock.`, 'error');
            return false;
        }

        if (requestedQty > currentStock) {
            this.showStockAlert(`Only ${currentStock} units of ${productName} available. Please reduce quantity.`, 'warning');
            return false;
        }

        if (requestedQty <= 0) {
            this.showStockAlert('Please select a valid quantity.', 'warning');
            return false;
        }

        return true;
    }

    // Show stock alert/notification
    showStockAlert(message, type = 'info') {
        // Remove existing alerts
        const existingAlert = document.querySelector('.stock-alert');
        if (existingAlert) {
            existingAlert.remove();
        }

        // Create alert element
        const alert = document.createElement('div');
        alert.className = `stock-alert alert-${type}`;
        alert.innerHTML = `
            <div class="alert-content">
                <span class="alert-icon">${this.getAlertIcon(type)}</span>
                <span class="alert-message">${message}</span>
                <button class="alert-close" onclick="this.parentElement.parentElement.remove()">×</button>
            </div>
        `;

        // Add styles
        alert.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            animation: slideInRight 0.3s ease;
            font-family: Arial, sans-serif;
            ${this.getAlertStyles(type)}
        `;

        document.body.appendChild(alert);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (alert && alert.parentNode) {
                alert.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => alert.remove(), 300);
            }
        }, 5000);
    }

    // Get alert icon based on type
    getAlertIcon(type) {
        const icons = {
            error: '⚠️',
            warning: '⚡',
            info: 'ℹ️',
            success: '✅'
        };
        return icons[type] || icons.info;
    }

    // Get alert styles based on type
    getAlertStyles(type) {
        const styles = {
            error: 'background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;',
            warning: 'background: #fff3cd; color: #856404; border: 1px solid #ffeaa7;',
            info: 'background: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb;',
            success: 'background: #d4edda; color: #155724; border: 1px solid #c3e6cb;'
        };
        return styles[type] || styles.info;
    }

    // Add CSS animations
    addAnimationStyles() {
        if (document.getElementById('stock-alert-styles')) return;

        const style = document.createElement('style');
        style.id = 'stock-alert-styles';
        style.textContent = `
            @keyframes slideInRight {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOutRight {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
            .stock-alert .alert-content {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .stock-alert .alert-close {
                background: none;
                border: none;
                font-size: 20px;
                cursor: pointer;
                margin-left: auto;
                opacity: 0.7;
            }
            .stock-alert .alert-close:hover {
                opacity: 1;
            }
            .buy-btn:disabled, .add-to-cart:disabled {
                opacity: 0.6;
                cursor: not-allowed !important;
            }
            .stock-display.out-of-stock {
                background: #f8d7da;
                padding: 5px 10px;
                border-radius: 3px;
                display: inline-block;
            }
            .stock-display.low-stock {
                background: #fff3cd;
                padding: 5px 10px;
                border-radius: 3px;
                display: inline-block;
            }
            .stock-display.in-stock {
                background: #d4edda;
                padding: 5px 10px;
                border-radius: 3px;
                display: inline-block;
            }
            .cart-count-animation {
                animation: pulse 0.3s ease-in-out;
            }
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.2); }
                100% { transform: scale(1); }
            }
        `;
        document.head.appendChild(style);
    }

    // Listen for stock updates from inventory system
    listenForStockUpdates() {
        // Listen for storage events (when stock is updated in another tab/window)
        window.addEventListener('storage', (e) => {
            if (e.key === 'tireStockLevels') {
                console.log('Stock data updated in storage, refreshing...');
                this.stockData = this.loadStockData();
                this.updateBuyButton();
            }
        });

        // Custom event listener for same-page stock updates
        window.addEventListener('stockUpdated', (e) => {
            console.log('Stock update event received:', e.detail);
            // Only update if this event is for a different product or affects all products
            if (!e.detail.productId || e.detail.productId !== this.productId) {
                this.stockData = this.loadStockData();
                this.updateBuyButton();
            }
        });

        // Poll for stock updates every 10 seconds
        this.stockUpdateInterval = setInterval(() => {
            const newStockData = this.loadStockData();
            const currentStock = newStockData[this.productId];
            const oldStock = this.stockData[this.productId];
            
            if (currentStock !== oldStock) {
                console.log(`Stock changed for Product ID ${this.productId}: ${oldStock} -> ${currentStock}`);
                this.stockData = newStockData;
                this.updateBuyButton();
            }
        }, 10000);
    }

    // Setup form validation
    setupFormValidation() {
        const forms = document.querySelectorAll('form[data-product-form], .product-form');
        
        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                const quantityInput = form.querySelector('input[name="quantity"], .quantity-input');
                const quantity = quantityInput ? parseInt(quantityInput.value) || 1 : 1;
                
                if (!this.validateQuantity(quantity)) {
                    e.preventDefault();
                    return false;
                }

                // If validation passes, reduce stock
                this.reduceStock(quantity);
                this.showStockAlert(`Added ${quantity} item(s) to cart successfully!`, 'success');
            });
        });

        // Validate quantity input changes
        const quantityInputs = document.querySelectorAll('.quantity-input, input[name="quantity"]');
        quantityInputs.forEach(input => {
            input.addEventListener('change', (e) => {
                const value = parseInt(e.target.value) || 0;
                const maxStock = this.getCurrentStock();
                
                if (value > maxStock) {
                    e.target.value = maxStock;
                    this.showStockAlert(`Maximum available quantity for this product is ${maxStock}`, 'warning');
                }
                
                if (value < 1 && maxStock > 0) {
                    e.target.value = 1;
                }
            });

            // Set initial value
            if (!input.value && this.isInStock()) {
                input.value = 1;
            }
        });
    }

    // Initialize the controller
    init() {
        this.addAnimationStyles();
        this.updateBuyButton();
        this.listenForStockUpdates();
        this.setupFormValidation();
        
        // Update display every 30 seconds
        this.displayUpdateInterval = setInterval(() => {
            this.updateBuyButton();
        }, 30000);

        console.log(`ProductStockController initialized for Product ID: ${this.productId}`);
    }

    // Cleanup method to clear intervals
    destroy() {
        if (this.stockUpdateInterval) {
            clearInterval(this.stockUpdateInterval);
        }
        if (this.displayUpdateInterval) {
            clearInterval(this.displayUpdateInterval);
        }
    }
}

// Updated Tire Data with unique IDs and cleaner structure
const tires = [
    // Bridgestone Tires
    {
        id: 1,
        name: "M751 HL",
        brand: "Bridgestone",
        specs: "295/90 R 20",
        price: 20750,
        image: "m751hl.jpg",
        redirectPage: "m751hl1.php"
    },
    {
        id: 2,
        name: "R271",
        brand: "Bridgestone",
        specs: "295/90 R20",
        price: 19852,
        image: "R271.png",
        redirectPage: "R2711.php"
    },
    {
        id: 3,
        name: "M725",
        brand: "Bridgestone",
        specs: "295/90 R20",
        price: 20476,
        image: "M725.jpg",
        redirectPage: "M7251.php"
    },
    {
        id: 4,
        name: "R156(TL)",
        brand: "Bridgestone",
        specs: "295/80 R22.5",
        price: 20827,
        image: "R156.png",
        redirectPage: "R1561.php"
    },
    {
        id: 5,
        name: "G611",
        brand: "Bridgestone",
        specs: "295/90 R20",
        price: 20085,
        image: "G611.png",
        redirectPage: "G6111.php"
    },

    // Ascenso Tires
    {
        id: 6,
        name: "BOSS TS 10",
        brand: "Ascenso",
        specs: "6.00-16",
        price: 3112,
        image: "ts-10.png",
        redirectPage: "TS1.php"
    },
    {
        id: 7,
        name: "BOSS TS 10",
        brand: "Ascenso",
        specs: "6.50-16",
        price: 4025,
        image: "ts-10.png",
        redirectPage: "s1.php"
    },
    {
        id: 8,
        name: "BOSS TS 10",
        brand: "Ascenso",
        specs: "7.50-16",
        price: 4847,
        image: "ts-10.png",
        redirectPage: "t1.php"
    },
    {
        id: 9,
        name: "BOSS TD 16",
        brand: "Ascenso",
        specs: "13.6-28",
        price: 15724,
        image: "td-16.png",
        redirectPage: "td-161.php"
    },
    {
        id: 10,
        name: "BOSS TD 16",
        brand: "Ascenso",
        specs: "14.9-28",
        price: 18695,
        image: "td-16.png",
        redirectPage: "d1.php"
    },
    {
        id: 11,
        name: "BOSS TD 16",
        brand: "Ascenso",
        specs: "16.9-28",
        price: 23497,
        image: "td-16.png",
        redirectPage: "161.php"
    },
    {
        id: 12,
        name: "TDB 120",
        brand: "Ascenso",
        specs: "8.00-18 HD",
        price: 5236,
        image: "tdb120.png",
        redirectPage: "TDB1.php"
    },
    {
        id: 13,
        name: "TDB 120",
        brand: "Ascenso",
        specs: "9.5-24",
        price: 8113,
        image: "tdb120.png",
        redirectPage: "B1.php"
    },
    {
        id: 14,
        name: "TDB 120",
        brand: "Ascenso",
        specs: "8.3-32",
        price: 6152,
        image: "tdb120.png",
        redirectPage: "DB1.php"
    },
    {
        id: 15,
        name: "BOSS TR 20",
        brand: "Ascenso",
        specs: "9.00-16",
        price: 9582,
        image: "tr20.png",
        redirectPage: "TR1.php"
    },
    {
        id: 16,
        name: "BOSS TR 21",
        brand: "Ascenso",
        specs: "10.00-20",
        price: 14869,
        image: "tr21.png",
        redirectPage: "211.php"
    },

    // Apollo Tires
    {
        id: 17,
        name: "Endu Race LD(s)",
        brand: "Apollo",
        specs: "295/90 R20",
        price: 20312,
        image: "LD.png",
        redirectPage: "LD1.php"
    },
    {
        id: 18,
        name: "Endu Race RD HD",
        brand: "Apollo",
        specs: "295/90 R20",
        price: 20312,
        image: "RDHD.png",
        redirectPage: "RDHD1.php"
    },
    {
                id: 19,
                name: "Endu Race ED",
                brand: "Apollo",
                specs: "295/90 R20",
                price: 18945,
                image: "ED.png",
                redirectPage: "ED1.php"
            },
            {
                id: 20,
                name: "Endu Race RA",
                brand: "Apollo",
                specs: "295/80 R20",
                price: 18906,
                image: "RA.png",
                redirectPage: "RA1.php"
            },
            {
                id: 21,
                name: " Endu Race RA NRG",
                brand: "Apollo",
                specs: "295/90 R20",
                price: 18672,
                image: "NRG.png",
                redirectPage: "NRG1.php"
            },
            {
                id: 22,
                name: " Endu Race RD NRG",
                brand: "Apollo",
                specs: "295/90 R20",
                price: 19101,
                image: "RDNRG.png",
                redirectPage: "RDNRG1.php"
            },
            {
                id: 23,
                name: " Endu Race RA(T)",
                brand: "Apollo",
                specs: "295/90 R20",
                price: 19297,
                image: "RA(T).png",
                redirectPage: "RA(T)1.php"
            },
            {
                id: 24,
                name: " Endu Mile LHD",
                brand: "Apollo",
                specs: "295/90 R20",
                price: 20000,
                image: "LHD.png",
                redirectPage: "LHD1.htmll"
            },
            {
                id: 25,
                name: " Endu Trax MA",
                brand: "Apollo",
                specs: "295/90 R20",
                price: 18672 ,
                image: "MA.png",
                redirectPage: "MA1.php"
            },
            {
                id: 26,
                name: " Endu Trax MD+",
                brand: "Apollo",
                specs: "295/90 R20",
                price: 20195,
                image: "MD+.png",
                redirectPage: "MD+1.php"
            },
            {
                id: 27,
                name: " Endu Race LD+",
                brand: "Apollo",
                specs: "9.00 R20",
                price: 16172,
                image: "LD+.png",
                redirectPage: "LD+1.php"
            },
            {
                id: 28,
                name: " Endu Race RA",
                brand: "Apollo",
                specs: "9.00 R20",
                price: 15391,
                image: "RA.png",
                redirectPage: "r1.php"
            },
            {
                id: 29,
                name: " Endu Race LD",
                brand: "Apollo",
                specs: "8.25 R20",
                price: 14453,
                image: "LD.png",
                redirectPage: "l1.php"
            },
            {
                id: 30,
                name: " Endu Race RA",
                brand: "Apollo",
                specs: "8.25 R20",
                price: 13594,
                image: "RA.png",
                redirectPage: "A1.php"
            },
            {
                id: 31,
                name: " Endu Trax MD",
                brand: "Apollo",
                specs: "11.00 R20",
                price: 21719,
                image: "MD.png",
                redirectPage: "MD1.php"
            },
            {
                id: 32,
                name: "  Endu Trax MA",
                brand: "Apollo",
                specs: "11.00 R20",
                price: 20664,
                image: "MA.png",
                redirectPage: "m1.php"
            },
            {
                id: 33,
                name: " Endu Race RA(N) TL-D ",
                brand: "Apollo",
                specs: "235/75 R17.5",
                price: 11713,
                image: "RA.png",
                redirectPage: "TL-D1.php"
            },
            {
                id: 34,
                name: " Endu Race LD-D",
                brand: "Apollo",
                specs: "8.25 R16",
                price: 10691,
                image: "LD-D.png",
                redirectPage: "LD-D1.php"
            },
            {
                id: 35,
                name: "  Endu Race RA-D",
                brand: "Apollo",
                specs: "8.25 R16",
                price: 10498,
                image: "RA.png",
                redirectPage: "RA-D1.php"
            },
            {
                id: 36,
                name: " Endu Maxx LT HD(LV)-D",
                brand: "Apollo",
                specs: "7.00 R15",
                price: 6787,
                image: "LTHD.png",
                redirectPage: "LTHD1.php"
            },
            {
                id: 37,
                name: " VIHAAN LUG (SV)-D",
                brand: "Apollo",
                specs: "7.00-15",
                price: 6258,
                image: "lug.png",
                redirectPage: "LUG1.php"
            },
            {
                id: 38,
                name: " VIHAAN RIB (SV)-D",
                brand: "Apollo",
                specs: "7.00-15",
                price: 5384,
                image: "rib.png",
                redirectPage: "RIB1.php"
            },
            {
                id: 39,
                name: " VIHAAN LUG (SV)-D",
                brand: "Apollo",
                specs: "7.00-15",
                price: 6258,
                image: "lug.png",
                redirectPage: "LUG1.php"
            },
            {
                id: 40,
                name: " VIHAAN LUG-D",
                brand: "Apollo",
                specs: "8.25-16",
                price: 9157,
                image: "lug.png",
                redirectPage: "LUG-D1.php"
            },
            {
                id: 41,
                name: " VIHAAN LUG HD-D",
                brand: "Apollo",
                specs: "8.25-16",
                price: 9380,
                image: "lug.png",
                redirectPage: "LUGHD-D1.php"
            },
            {
                id: 42,
                name: "  VIHAAN RIB-D",
                brand: "Apollo",
                specs: "8.25-16",
                price: 8041,
                image: "rib.png",
                redirectPage: "RIB-D1.php"
            },
            {
                id: 43,
                name: " Endu Comfort CA2",
                brand: "Apollo",
                specs: "295/80 R22.5",
                price: 19440,
                image: "ca2.png",
                redirectPage: "CA21.php"
            },
            {
                id: 44,
                name: "  Endu Race RA(N)",
                brand: "Apollo",
                specs: "295/80 R22.5",
                price: 19156,
                image: "RA.png",
                redirectPage: "RA(N)1.php"
            },
            {
                id: 45,
                name: " Endu Race RD",
                brand: "Apollo",
                specs: "295/80 R22.5",
                price: 20042,
                image: "rd.png",
                redirectPage: "RD1.php"
            },
            {
                id: 46,
                name: " XT7 Gold HD-D",
                brand: "Apollo",
                specs: "9.00-20",
                price: 13273,
                image: "xt7.png",
                redirectPage: "XT71.php"
            },
            { 
                id: 47,
                name: " Amar Gold-D",
                brand: "Apollo",
                specs: "9.00-20",
                price: 12337,
                image: "amar.webp",
                redirectPage: "Amar1.php"
            },
            {
                id: 48,
                name: " XT7 Gold HD-D",
                brand: "Apollo",
                specs: "8.25-20",
                price: 12080,
                image: "xt7.png",
                redirectPage: "XT7-D1.php"
            },
            {
                id: 49,
                name: "  Amar Gold-D",
                brand: "Apollo",
                specs: "8.25-20",
                price: 10269,
                image: "amar.webp",
                redirectPage: "Amar-D1.php"
            },
            {
                id: 50,
                name: " Amar Gold-D",
                brand: "Apollo",
                specs: "295/95 D20",
                price: 14235,
                image: "amar.webp",
                redirectPage: "r-D1.php"
            },
            {
                id: 51,
                name: " XT7 Gold HD-D",
                brand: "Apollo",
                specs: "10.00-20",
                price: 15759,
                image: "xt7.png",
                redirectPage: "7-d1.php"
            },
            {
                id: 52,
                name: " Terra BT-D",
                brand: "Apollo",
                specs: "10.00-20",
                price: 17740,
                image: "terra.png",
                redirectPage: "Terra1.php"
            },
            {
                id: 53,
                name: " Amar Deluxe X-D",
                brand: "Apollo",
                specs: "10.00-20",
                price: 13565,
                image: "deluxe.png",
                redirectPage: "Deluxe1.php"
            },
            {
                id: 54,
                name: " XT 100 HD X-D",
                brand: "Apollo",
                specs: "10.00-20",
                price: 15131,
                image: "xt100.png",
                redirectPage: "XT1.php"
            },
            {
                id: 55,
                name: " Haulug X-D",
                brand: "Apollo",
                specs: "10.00-20",
                price: 14508,
                image: "haulage.png",
                redirectPage: "Haulug1.php"
            },
            {
                id: 56,
                name: " XT9 Gold-D",
                brand: "Apollo",
                specs: "295/95 D20",
                price: 15144,
                image: "xt9.png",
                redirectPage: "XT91.php"
            },
            {
                id: 57,
                name: " XT-100 HD-D",
                brand: "Apollo",
                specs: "295/95 D20",
                price: 15748,
                image: "xt100.png",
                redirectPage: "XT-1001.php"
            },

    // JK Tires
     {
        id: 58,
        name: "Jet R Miles",
        brand: "JK",
        specs: "295/90 D20",
        price: 13723,
        image: "Rmile.png",
        redirectPage: "jetR1.php"
    },
    {
        id: 59,
        name: "Jet R Xtra Miles",
        brand: "JK",
        specs: "10.00-20",
        price: 14492,
        image: "Rxtra.png",
        redirectPage: "RX1.php"
    },
    {
        id: 60,
       name: "Jet Xtra XLM",
        brand: "JK",
        specs: "10.00-20",
        price: 16016,
        image: "XLM.png",
        redirectPage: "X1.php"
    },
    {
        id: 61,
        name: "Vikrant Trak LUG+",
        brand: "JK",
        specs: "10.00-20",
        price: 13905,
        image: "lug+.png",
        redirectPage: "LUG+1.php"
    },
    {
        id: 62,
       name: "JUH 5",
        brand: "JK",
        specs: "295/90 R20",
        price: 17969,
        image: "juh5.png",
        redirectPage: "JUH51.php"
    },
    {
        id: 63,
       name: "JDE++",
        brand: "JK",
        specs: "295/90 R20",
        price: 18945,
        image: "jde++.jpg",
        redirectPage: "jde++1.php"
    },
    {
        id: 64,
       name: "JDC XD",
        brand: "JK",
        specs: "295/90 R20",
        price: 18945,
        image: "jdc.png",
        redirectPage: "jdc1.php"
    },

    // Michelin Tires
    {
        id: 65, 
        name: "X Multi Energy Z+",
        brand: "Michelin",
        specs: "295/80 R 22.5",
        price: 22578,
        image: "Z+.png.webp",
        redirectPage: "Z+1.php"
    },
    {
        id: 66,
        name: "X Multi Energy D",
        brand: "Michelin",
        specs: "295/80 R22.5",
        price: 24062,
        image: "D.png.webp",
        redirectPage: "xD1.php"
    },
    {
        id: 67,
        name: "X Multi Z 2",
        brand: "Michelin",
        specs: "295/80 R22.5",
        price: 23711,
        image: "Z2.png.webp",
        redirectPage: "Z21.php"
    },
    {
        id: 68,
        name: "X Multi D+",
        brand: "Michelin",
        specs: "295/80 R22.5",
        price: 24844,
        image: "D+.png.webp",
        redirectPage: "D+1.php"
    },
];


// Make tires array globally available
if (typeof window !== 'undefined') {
    window.tires = tires;
}

// Usage example:
// On each product page, initialize the controller with the specific product ID
// const productStock = new ProductStockController(1); // For M751 HL
// const productStock = new ProductStockController(17); // For Endu Race LD

// Example cart system integration
class CartManager {
    constructor() {
        this.cart = JSON.parse(localStorage.getItem('cart') || '[]');
    }

    addToCart(productId, quantity = 1) {
        const tire = tires.find(t => t.id == productId);
        if (!tire) {
            console.error('Tire not found:', productId);
            return false;
        }

        const existingItem = this.cart.find(item => item.id == productId);
        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            this.cart.push({
                id: productId,
                name: tire.name,
                brand: tire.brand,
                specs: tire.specs,
                price: tire.price,
                image: tire.image,
                quantity: quantity
            });
        }

        localStorage.setItem('cart', JSON.stringify(this.cart));
        this.updateCartDisplay();
        return true;
    }

    updateCartDisplay() {
        const cartCount = this.cart.reduce((total, item) => total + item.quantity, 0);
        const cartElements = document.querySelectorAll('.cart-count');
        cartElements.forEach(el => {
            el.textContent = cartCount;
            el.classList.add('cart-count-animation');
            setTimeout(() => el.classList.remove('cart-count-animation'), 300);
        });
    }
}

let cart = [];

// Global function to check stock availability - now uses sessionStorage first
function getStockLevel(productId) {
    const stockData = JSON.parse(sessionStorage.getItem('tireStockLevels') || localStorage.getItem('tireStockLevels') || '{}');
    return stockData[productId] || 0;
}

// Global function to check if product is in stock
function isProductInStock(productId) {
    return getStockLevel(productId) > 0;
}

// Global function to validate if we can add quantity to cart
function canAddToCart(productId, requestedQty = 1) {
    const currentStock = getStockLevel(productId);
    const cartItem = cart.find(item => item.id === productId);
    const currentCartQty = cartItem ? cartItem.qty : 0;
    
    return (currentCartQty + requestedQty) <= currentStock;
}

// Load cart from storage on page load - prioritize sessionStorage for consistency
function loadCart() {
    const savedCart = sessionStorage.getItem('unifiedTireShopCart') || localStorage.getItem('unifiedTireShopCart');
    if (savedCart) {
        try {
            cart = JSON.parse(savedCart);
            console.log('Cart loaded from storage:', cart);
            updateCartCount();
        } catch (e) {
            console.error('Error loading cart from storage:', e);
            cart = [];
        }
    }
}

// Save cart to both sessionStorage and localStorage for better persistence
function saveCart() {
    try {
        const cartData = JSON.stringify(cart);
        sessionStorage.setItem('unifiedTireShopCart', cartData);
        localStorage.setItem('unifiedTireShopCart', cartData);
        console.log('Cart saved to storage:', cart);
        
        // Trigger storage event for real-time sync across pages
        window.dispatchEvent(new StorageEvent('storage', {
            key: 'unifiedTireShopCart',
            newValue: cartData,
            storageArea: sessionStorage
        }));
    } catch (e) {
        console.error('Error saving cart to storage:', e);
    }
}

// Enhanced addToCart function with stock validation
function addToCart(productId, quantity = 1) {
    console.log('Adding product ID:', productId, 'Quantity:', quantity);
    
    const product = tires.find(t => t.id === productId);
    if (!product) {
        console.log('Product not found with ID:', productId);
        showStockAlert('Product not found.', 'error');
        return false;
    }

    console.log('Found product:', product.name);

    // Check if product is in stock
    if (!isProductInStock(productId)) {
        console.log('Product is out of stock:', product.name);
        showStockAlert(`${product.name} is currently out of stock.`, 'error');
        return false;
    }

    // Check if we can add the requested quantity
    if (!canAddToCart(productId, quantity)) {
        const availableStock = getStockLevel(productId);
        const currentCartQty = cart.find(item => item.id === productId)?.qty || 0;
        const maxCanAdd = availableStock - currentCartQty;
        
        if (maxCanAdd <= 0) {
            showStockAlert(`${product.name} - Maximum available quantity already in cart.`, 'warning');
        } else {
            showStockAlert(`${product.name} - Only ${maxCanAdd} more units can be added to cart.`, 'warning');
        }
        return false;
    }

    const existing = cart.find(item => item.id === productId);
    if (existing) {
        existing.qty += quantity;
        console.log('Increased quantity for:', product.name, 'New qty:', existing.qty);
    } else {
        cart.push({ ...product, qty: quantity });
        console.log('Added new product to cart:', product.name);
    }

    updateCartCount();
    saveCart();
    showToast(`${product.name} added to cart!`);
    console.log('Current cart after adding:', cart);
    return true;
}

// NEW: Function to remove item from cart completely
function removeFromCart(productId) {
    console.log('Removing product ID:', productId);
    
    const itemIndex = cart.findIndex(item => item.id === productId);
    if (itemIndex > -1) {
        const removedItem = cart[itemIndex];
        cart.splice(itemIndex, 1);
        
        console.log('Removed product:', removedItem.name);
        updateCartCount();
        saveCart();
        showToast(`${removedItem.name} removed from cart!`);
        
        // Trigger cart update event for other pages
        triggerCartUpdateEvent();
        
        // Update cart display if we're on cart page
        updateCartDisplay();
        
        return true;
    }
    
    console.log('Product not found in cart with ID:', productId);
    return false;
}

// NEW: Function to update quantity of item in cart
function updateCartItemQuantity(productId, newQuantity) {
    console.log('Updating quantity for product ID:', productId, 'New quantity:', newQuantity);
    
    const cartItem = cart.find(item => item.id === productId);
    if (!cartItem) {
        console.log('Product not found in cart with ID:', productId);
        return false;
    }

    // If quantity is 0 or less, remove the item
    if (newQuantity <= 0) {
        return removeFromCart(productId);
    }

    // Check if the new quantity exceeds stock
    if (!canAddToCart(productId, newQuantity - cartItem.qty)) {
        const availableStock = getStockLevel(productId);
        const maxAllowed = availableStock;
        
        showStockAlert(`${cartItem.name} - Maximum available quantity is ${maxAllowed}.`, 'warning');
        return false;
    }

    cartItem.qty = newQuantity;
    console.log('Updated quantity for:', cartItem.name, 'New qty:', cartItem.qty);
    
    updateCartCount();
    saveCart();
    
    // Trigger cart update event for other pages
    triggerCartUpdateEvent();
    
    // Update cart display if we're on cart page
    updateCartDisplay();
    
    return true;
}

// NEW: Function to decrease quantity by 1 (with removal if qty becomes 0)
function decreaseCartItemQuantity(productId) {
    const cartItem = cart.find(item => item.id === productId);
    if (!cartItem) {
        return false;
    }
    
    if (cartItem.qty <= 1) {
        return removeFromCart(productId);
    } else {
        return updateCartItemQuantity(productId, cartItem.qty - 1);
    }
}

// NEW: Function to increase quantity by 1
function increaseCartItemQuantity(productId) {
    const cartItem = cart.find(item => item.id === productId);
    if (!cartItem) {
        return false;
    }
    
    return updateCartItemQuantity(productId, cartItem.qty + 1);
}

// NEW: Function to clear entire cart
function clearCart() {
    cart = [];
    updateCartCount();
    saveCart();
    showToast('Cart cleared!');
    
    // Trigger cart update event for other pages
    triggerCartUpdateEvent();
    
    // Update cart display if we're on cart page
    updateCartDisplay();
    
    console.log('Cart cleared');
}

// NEW: Function to trigger custom cart update event
function triggerCartUpdateEvent() {
    // Create custom event for cart updates
    const cartUpdateEvent = new CustomEvent('cartUpdated', {
        detail: {
            cart: [...cart],
            totalItems: cart.reduce((sum, item) => sum + item.qty, 0)
        }
    });
    
    window.dispatchEvent(cartUpdateEvent);
}

// Enhanced updateCartCount function with better display
function updateCartCount() {
    const count = cart.reduce((sum, item) => sum + item.qty, 0);
    const countEl = document.getElementById('cartCount');
    
    if (countEl) {
        countEl.textContent = count;
        
        // Add visual feedback when count changes
        if (count > 0) {
            countEl.style.display = 'block';
            countEl.classList.add('cart-count-animation');
            
            // Remove animation class after animation completes
            setTimeout(() => {
                countEl.classList.remove('cart-count-animation');
            }, 300);
        } else {
            countEl.style.display = 'none';
        }
    }
    
    // Update all cart count elements on the page
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

// Enhanced goToCart function with validation
function goToCart() {
    console.log('Navigating to cart page');
    
    // Save cart before navigation
    saveCart();
    
    // Navigate to cart page
    window.location.href = 'cart1.php';
}

// Alternative function for cart icon click with event handling
function handleCartClick(event) {
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }
    
    console.log('Cart icon clicked');
    goToCart();
}

// NEW: Enhanced initialization function
function initializeCart() {
    // Load cart from storage
    loadCart();
    
    // Listen for storage changes from other tabs/pages
    window.addEventListener('storage', function(e) {
        if (e.key === 'unifiedTireShopCart' || e.key === null) {
            console.log('Storage changed, reloading cart');
            loadCart();
        }
    });
    
    // Listen for custom cart update events
    window.addEventListener('cartUpdated', function(e) {
        console.log('Cart updated event received:', e.detail);
        updateCartCount();
    });
    
    // Update cart count on page load
    updateCartCount();
}

// NEW: Call initialization when DOM is ready
document.addEventListener('DOMContentLoaded', initializeCart);

// Also initialize if DOM is already loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeCart);
} else {
    initializeCart();
}

// NEW: Function to update cart page display (call this from your cart.php)
function updateCartDisplay() {
    // Only update if we're on the cart page
    const cartContainer = document.getElementById('cartItems') || 
                         document.getElementById('cart-items') || 
                         document.querySelector('.cart-items') ||
                         document.querySelector('[data-cart-items]');
    
    if (!cartContainer) {
        console.log('Cart display container not found - not on cart page');
        return;
    }
    
    console.log('Updating cart display...');
    
    // Clear current display
    cartContainer.innerHTML = '';
    
    // Check if cart is empty
    if (cart.length === 0) {
        cartContainer.innerHTML = `
            <div class="empty-cart-message">
                <p>Your cart is empty</p>
                <a href="index.php" class="continue-shopping-btn">Continue Shopping</a>
            </div>
        `;
        
        // Update total display
        updateCartTotals();
        return;
    }
    
    // Generate HTML for each cart item
    let cartHTML = '';
    cart.forEach(item => {
        cartHTML += `
            <div class="cart-item" data-product-id="${item.id}">
                <div class="item-image">
                    <img src="${item.image || 'images/default-tire.jpg'}" alt="${item.name}">
                </div>
                <div class="item-details">
                    <h3>${item.name}</h3>
                    <p class="item-price">${item.price}</p>
                    <div class="quantity-controls">
                        <button onclick="decreaseCartItemQuantity('${item.id}')" class="qty-btn">-</button>
                        <input type="number" value="${item.qty}" min="1" max="${getStockLevel(item.id)}" 
                               onchange="updateCartItemQuantity('${item.id}', parseInt(this.value))" 
                               class="qty-input">
                        <button onclick="increaseCartItemQuantity('${item.id}')" class="qty-btn">+</button>
                    </div>
                    <p class="item-total">Subtotal: ${(item.price * item.qty).toFixed(2)}</p>
                </div>
                <div class="item-actions">
                    <button onclick="removeFromCart('${item.id}')" class="remove-btn">Remove</button>
                </div>
            </div>
        `;
    });
    
    cartContainer.innerHTML = cartHTML;
    
    // Update totals
    updateCartTotals();
}

// NEW: Function to update cart totals display
function updateCartTotals() {
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
    const tax = subtotal * 0.08; // 8% tax rate - adjust as needed
    const total = subtotal + tax;
    
    // Update subtotal display
    const subtotalElements = document.querySelectorAll('.cart-subtotal, [data-cart-subtotal]');
    subtotalElements.forEach(el => {
        el.textContent = `${subtotal.toFixed(2)}`;
    });
    
    // Update tax display
    const taxElements = document.querySelectorAll('.cart-tax, [data-cart-tax]');
    taxElements.forEach(el => {
        el.textContent = `${tax.toFixed(2)}`;
    });
    
    // Update total display
    const totalElements = document.querySelectorAll('.cart-total, [data-cart-total]');
    totalElements.forEach(el => {
        el.textContent = `${total.toFixed(2)}`;
    });
    
    console.log('Cart totals updated:', { subtotal, tax, total });
}

// NEW: Function to refresh cart page (call this on cart page load)
function refreshCartPage() {
    console.log('Refreshing cart page...');
    loadCart();
    updateCartDisplay();
    updateCartCount();
}

// Enhanced toast function for better user feedback
function showToast(message, type = 'success') {
    // Remove existing toasts
    const existingToast = document.querySelector('.toast-notification');
    if (existingToast) {
        existingToast.remove();
    }

    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    toast.innerHTML = `
        <div class="toast-content">
            <span class="toast-icon">${type === 'success' ? '✅' : type === 'error' ? '❌' : '⚠️'}</span>
            <span class="toast-message">${message}</span>
        </div>
    `;

    // Add styles
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10000;
        padding: 12px 20px;
        border-radius: 6px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: slideDown 0.3s ease;
        font-family: Arial, sans-serif;
        font-weight: 500;
        ${type === 'success' ? 'background: #d4edda; color: #155724; border: 1px solid #c3e6cb;' : 
          type === 'error' ? 'background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;' :
          'background: #fff3cd; color: #856404; border: 1px solid #ffeaa7;'}
    `;

    // Add animation styles if not already present
    if (!document.getElementById('toast-styles')) {
        const style = document.createElement('style');
        style.id = 'toast-styles';
        style.textContent = `
            @keyframes slideDown {
                from { transform: translateX(-50%) translateY(-100%); opacity: 0; }
                to { transform: translateX(-50%) translateY(0); opacity: 1; }
            }
            @keyframes slideUp {
                from { transform: translateX(-50%) translateY(0); opacity: 1; }
                to { transform: translateX(-50%) translateY(-100%); opacity: 0; }
            }
            .toast-content {
                display: flex;
                align-items: center;
                gap: 8px;
            }
        `;
        document.head.appendChild(style);
    }

    document.body.appendChild(toast);

    // Auto remove after 3 seconds
    setTimeout(() => {
        if (toast && toast.parentNode) {
            toast.style.animation = 'slideUp 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }
    }, 3000);
}

// Enhanced stock alert function (can be used globally)
function showStockAlert(message, type = 'info') {
    // Remove existing alerts
    const existingAlert = document.querySelector('.stock-alert');
    if (existingAlert) {
        existingAlert.remove();
    }

    // Create alert element
    const alert = document.createElement('div');
    alert.className = `stock-alert alert-${type}`;
    alert.innerHTML = `
        <div class="alert-content">
            <span class="alert-icon">${type === 'error' ? '⚠️' : type === 'warning' ? '⚡' : type === 'success' ? '✅' : 'ℹ️'}</span>
            <span class="alert-message">${message}</span>
            <button class="alert-close" onclick="this.parentElement.parentElement.remove()">×</button>
        </div>
    `;

    // Add styles
    alert.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        max-width: 400px;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: slideInRight 0.3s ease;
        font-family: Arial, sans-serif;
        ${type === 'error' ? 'background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;' :
          type === 'warning' ? 'background: #fff3cd; color: #856404; border: 1px solid #ffeaa7;' :
          type === 'success' ? 'background: #d4edda; color: #155724; border: 1px solid #c3e6cb;' :
          'background: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb;'}
    `;

    document.body.appendChild(alert);

    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alert && alert.parentNode) {
            alert.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => alert.remove(), 300);
        }
    }, 5000);
}

// Auto-initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Load cart on page load
    loadCart();
    
    // Try to get product ID from various sources
    let productId = null;
    
    // Method 1: From data attribute
    const productElement = document.querySelector('[data-product-id]');
    if (productElement) {
        productId = parseInt(productElement.dataset.productId);
    }
    
    // Method 2: From URL parameter
    if (!productId) {
        const urlParams = new URLSearchParams(window.location.search);
        productId = parseInt(urlParams.get('id') || urlParams.get('product_id'));
    }
    
    // Method 3: From page filename (e.g., m751hl.php -> find matching tire)
    if (!productId) {
        const filename = window.location.pathname.split('/').pop().replace('.php', '');
        // This would need to match your tire data structure
        // You might need to add a mapping object for filename to ID
    }
    
    // Method 4: Manually set for specific pages
    if (!productId) {
        // You can manually set product IDs for specific pages
        const pageMap = {
            'm751hl.php': 1,
            'bridgestone-turanza.php': 2,
            'michelin-pilot-sport.php': 3,
            'michelin-energy.php': 4,
            'ascenso-th201.php': 5,
            'ascenso-cx688.php': 6,
            'continental-premium.php': 7,
            'continental-eco.php': 8,
            'apollo-alnac.php': 9,
            'apollo-aspire.php': 10,
            'jk-ux-royale.php': 11,
            'jk-vectra.php': 12
        };
        
        const currentPage = window.location.pathname.split('/').pop();
        productId = pageMap[currentPage];
    }
    
    if (productId) {
        window.productStockController = new ProductStockController(productId);
        console.log(`Stock controller initialized for product ID: ${productId}`);
        
        // Log current stock for debugging
        console.log(`Current stock for product ${productId}:`, window.productStockController.getCurrentStock());
    } else {
        console.warn('Could not determine product ID for stock control');
    }

    // Enhanced storage event listener to handle both sessionStorage and localStorage
    window.addEventListener('storage', (e) => {
        if (e.key === 'tireStockLevels' || e.key === 'unifiedTireShopCart') {
            console.log('Storage event detected:', e.key);
            if (e.key === 'unifiedTireShopCart') {
                loadCart();
            }
            if (window.productStockController) {
                window.productStockController.stockData = window.productStockController.loadStockData();
                window.productStockController.updateBuyButton();
            }
        }
    });

    // Listen for custom stock update events
    window.addEventListener('stockUpdated', (e) => {
        console.log('Custom stock update event received');
        if (window.productStockController) {
            window.productStockController.stockData = window.productStockController.loadStockData();
            window.productStockController.updateBuyButton();
        }
    });
});

// Global functions for manual control
function checkProductStock(productId) {
    const controller = new ProductStockController(productId);
    return {
        stock: controller.getCurrentStock(),
        inStock: controller.isInStock(),
        status: controller.getStockStatus()
    };
}

function refreshStockDisplay() {
    if (window.productStockController) {
        window.productStockController.stockData = window.productStockController.loadStockData();
        window.productStockController.updateBuyButton();
        console.log('Stock display refreshed manually');
    }
}

// Function to trigger stock update event (useful for manual updates)
function triggerStockUpdate() {
    window.dispatchEvent(new CustomEvent('stockUpdated', {
        detail: { timestamp: Date.now() }
    }));
}
// FIXED: Product redirection function - now properly handles both ID and page parameters
function redirectToProductPage(pageOrId, name) {
    console.log('Redirecting to product page:', pageOrId, name);
    
    // If pageOrId is a number, find the product by ID
    if (typeof pageOrId === 'number') {
        const product = tires.find(t => t.id === pageOrId);
        if (product && product.redirectPage) {
            console.log('Redirecting to:', product.redirectPage);
            window.location.href = product.redirectPage;
        } else {
            console.error('Product not found with ID:', pageOrId);
        }
    } 
    // If pageOrId is a string, treat it as a direct page URL
    else if (typeof pageOrId === 'string' && pageOrId.includes('.php')) {
        console.log('Redirecting to:', pageOrId);
        window.location.href = pageOrId;
    }
    // If it's a product name, find by name
    else if (name || pageOrId) {
        const searchName = name || pageOrId;
        const product = tires.find(t => t.name.toLowerCase().includes(searchName.toLowerCase()));
        if (product && product.redirectPage) {
            console.log('Redirecting to:', product.redirectPage);
            window.location.href = product.redirectPage;
        } else {
            console.error('Product not found with name:', searchName);
        }
    }
}

// NEW: Redirect by product ID specifically
function redirectToProductById(productId) {
    console.log('Redirecting to product by ID:', productId);
    const product = tires.find(t => t.id === productId);
    if (product && product.redirectPage) {
        console.log('Found product, redirecting to:', product.redirectPage);
        window.location.href = product.redirectPage;
    } else {
        console.error('Product not found with ID:', productId);
    }
}

// NEW: Redirect by product name specifically
function redirectToProductByName(productName) {
    console.log('Redirecting to product by name:', productName);
    const product = tires.find(t => t.name.toLowerCase().includes(productName.toLowerCase()));
    if (product && product.redirectPage) {
        console.log('Found product, redirecting to:', product.redirectPage);
        window.location.href = product.redirectPage;
    } else {
        console.error('Product not found with name:', productName);
    }
}

// NEW: Get product details by ID
function getProductById(productId) {
    return tires.find(t => t.id === productId);
}

// NEW: Get product details by name
function getProductByName(productName) {
    return tires.find(t => t.name.toLowerCase().includes(productName.toLowerCase()));
}

function showToast(msg) {
    const toast = document.getElementById('toast');
    if (!toast) {
        // Create toast if it doesn't exist
        const newToast = document.createElement('div');
        newToast.id = 'toast';
        newToast.className = 'toast';
        newToast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #4CAF50;
            color: white;
            padding: 16px;
            border-radius: 4px;
            z-index: 1000;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        `;
        document.body.appendChild(newToast);
    }
    const toastEl = document.getElementById('toast');
    toastEl.textContent = msg;
    toastEl.style.opacity = '1';
    toastEl.style.transform = 'translateX(0)';
    
    setTimeout(() => {
        toastEl.style.opacity = '0';
        toastEl.style.transform = 'translateX(100%)';
    }, 2000);
}

// Initialize cart on page load
document.addEventListener('DOMContentLoaded', function() {
    loadCart();
    
    // Set up cart icon click handlers
    const cartIcons = document.querySelectorAll('[data-cart-action="go-to-cart"], .cart-icon, #cartIcon');
    cartIcons.forEach(icon => {
        icon.addEventListener('click', handleCartClick);
        icon.style.cursor = 'pointer';
    });
    
    // Listen for storage changes to sync cart across tabs
    window.addEventListener('storage', function(e) {
        if (e.key === 'unifiedTireShopCart') {
            loadCart();
        }
    });
});

// Sidebar toggle function
function toggleSidebar() {
  const sidebar = document.getElementById('companySidebar');
  const toggle = sidebar.querySelector('.sidebar-toggle i');
  const body = document.body;

  // Toggle the sidebar
  sidebar.classList.toggle('show');

  // Toggle body class for desktop content shifting
  body.classList.toggle('sidebar-open');

  // Change the arrow direction 
  if (sidebar.classList.contains('show')) {
    toggle.className = 'fas fa-chevron-left';
  } else {
    toggle.className = 'fas fa-chevron-right';
  }
}

// Product filtering and display
function filterProducts(brand) {
  currentFilter = brand;
  const productsSection = document.getElementById('productsSection');
  const sectionTitle = document.getElementById('sectionTitle');
  const sectionSubtitle = document.getElementById('sectionSubtitle');
  
  productsSection.classList.add('show');
  
  if (brand === 'all') {
    sectionTitle.textContent = 'All Tires';
    sectionSubtitle.textContent = 'Choose from our wide selection of premium tires';
    displayProducts(tires);
  } else {
    const filteredTires = tires.filter(tire => tire.brand === brand);
    const brandName = filteredTires[0]?.brand || brand.charAt(0).toUpperCase() + brand.slice(1);
    sectionTitle.textContent = `${brandName} Tires`;
    sectionSubtitle.textContent = `Premium ${brandName} tires for optimal performance`;
    displayProducts(filteredTires);
  }
  
  productsSection.scrollIntoView({ behavior: 'smooth' });
}

function showAllProducts() {
  filterProducts('all');
}

function displayProducts(products) {
  const productsGrid = document.getElementById('productsGrid');
  
  if (products.length === 0) {
    productsGrid.innerHTML = `
      <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #666;">
        <i class="fas fa-search" style="font-size: 48px; margin-bottom: 20px; color: #ddd;"></i>
        <h3>No products found</h3>
        <p>Try a different search or browse all products.</p>
      </div>
    `;
    return;
  }
  
  productsGrid.innerHTML = products.map(tire => `
    <div class="product-card" data-id="${tire.id}" data-name="${tire.name}" data-redirect="${tire.redirectPage}">
      <div class="product-image"><img src="${tire.image}" alt="${tire.name}" onerror="this.src='placeholder-tire.jpg'"></div>
      <div class="product-brand">${tire.brand}</div>
      <div class="product-name">${tire.name}</div>
      <div class="product-specs">${tire.specs}</div>
      <div class="product-price">₹${tire.price.toFixed(2)}</div>
      <button class="add-to-cart-btn" onclick="addToCart(${tire.id})">
        Add to Cart
      </button>
    </div>
  `).join('');
}

// Search functionality - Fixed Version
function performSearch() {
    const searchInput = document.getElementById('searchInput');
    
    if (!searchInput) {
        console.error('Search input element not found');
        return;
    }
    
    const query = searchInput.value.trim().toLowerCase();
    
    if (query === '') {
        console.log('Empty search query');
        return;
    }
    
    // Check if tires array exists
    if (typeof tires === 'undefined' || !Array.isArray(tires)) {
        console.error('Tires array is not defined or not an array');
        return;
    }
    
    const searchResults = tires.filter(tire => {
        // More robust null/undefined checks
        if (!tire) return false;
        
        const name = tire.name ? tire.name.toString().toLowerCase() : '';
        const brand = tire.brand ? tire.brand.toString().toLowerCase() : '';
        const specs = tire.specs ? tire.specs.toString().toLowerCase() : '';
        const category = tire.category ? tire.category.toString().toLowerCase() : '';
        const description = tire.description ? tire.description.toString().toLowerCase() : '';
        
        return name.includes(query) || 
               brand.includes(query) || 
               specs.includes(query) ||
               category.includes(query) ||
               description.includes(query);
    });
    
    console.log(`Search results for "${query}":`, searchResults);
    
    const productsSection = document.getElementById('productsSection');
    const sectionTitle = document.getElementById('sectionTitle');
    const sectionSubtitle = document.getElementById('sectionSubtitle');
    
    // Check if elements exist
    if (!productsSection || !sectionTitle || !sectionSubtitle) {
        console.error('Required DOM elements not found');
        return;
    }
    
    productsSection.classList.add('show');
    sectionTitle.textContent = `Search Results for "${searchInput.value}"`;
    sectionSubtitle.textContent = `Found ${searchResults.length} product(s)`;
    
    // Check if displayProducts function exists
    if (typeof displayProducts === 'function') {
        displayProducts(searchResults);
    } else {
        console.error('displayProducts function is not defined');
    }
    
    productsSection.scrollIntoView({ behavior: 'smooth' });
    hideSearchDropdown();
}

function showSearchDropdown() {
    const dropdown = document.getElementById('searchDropdown');
    const searchInput = document.getElementById('searchInput');
    
    if (!dropdown || !searchInput) {
        console.error('Search dropdown or input element not found');
        return;
    }
    
    const query = searchInput.value.trim().toLowerCase();
    
    if (query === '') {
        hideSearchDropdown();
        return;
    }
    
    // Check if tires array exists
    if (typeof tires === 'undefined' || !Array.isArray(tires)) {
        console.error('Tires array is not defined');
        hideSearchDropdown();
        return;
    }
    
    const searchResults = tires.filter(tire => {
        // More robust null/undefined checks
        if (!tire) return false;
        
        const name = tire.name ? tire.name.toString().toLowerCase() : '';
        const brand = tire.brand ? tire.brand.toString().toLowerCase() : '';
        const specs = tire.specs ? tire.specs.toString().toLowerCase() : '';
        const category = tire.category ? tire.category.toString().toLowerCase() : '';
        const description = tire.description ? tire.description.toString().toLowerCase() : '';
        
        return name.includes(query) || 
               brand.includes(query) || 
               specs.includes(query) ||
               category.includes(query) ||
               description.includes(query);
    }).slice(0, 5);
    
    if (searchResults.length > 0) {
        dropdown.innerHTML = searchResults.map(tire => `
            <div class="search-item" onclick="selectSearchItem('${tire.name ? tire.name.replace(/'/g, "\\'") : ''}')">
                <div>
                    <div class="search-item-brand">${tire.brand || 'Unknown Brand'}</div>
                    <div class="search-item-name">${tire.name || 'Unknown Product'}</div>
                </div>
                <div class="search-item-price">₹${tire.price ? tire.price.toFixed(2) : 'N/A'}</div>
            </div>
        `).join('');
        dropdown.classList.add('show');
    } else {
        hideSearchDropdown();
    }
}

function hideSearchDropdown() {
    const dropdown = document.getElementById('searchDropdown');
    if (dropdown) {
        dropdown.classList.remove('show');
    }
}

function selectSearchItem(tireName) {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.value = tireName;
        hideSearchDropdown();
        performSearch();
    }
}

// Event listeners for search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    
    if (searchInput) {
        // Add input event listener for dropdown
        searchInput.addEventListener('input', function() {
            showSearchDropdown();
        });
        
        // Add keypress event listener for Enter key
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
        
        // Add focus event listener
        searchInput.addEventListener('focus', function() {
            if (this.value.trim() !== '') {
                showSearchDropdown();
            }
        });
        
        // Add blur event listener to hide dropdown
        searchInput.addEventListener('blur', function() {
            // Use setTimeout to allow click events on dropdown items
            setTimeout(() => {
                hideSearchDropdown();
            }, 200);
        });
    }
});

// Debug function to check your tires array
function debugTires() {
    console.log('Tires array exists:', typeof tires !== 'undefined');
    console.log('Tires is array:', Array.isArray(tires));
    if (typeof tires !== 'undefined' && Array.isArray(tires)) {
        console.log('Tires array length:', tires.length);
        console.log('Sample tire object:', tires[0]);
        console.log('Available properties:', Object.keys(tires[0] || {}));
    }
}
// Fixed Mobile Menu JavaScript - Clean Solution

// Main toggle function for mobile menu
function toggleMobileMenu() {
    const mobileNav = document.getElementById('mobileNav');
    const overlay = document.getElementById('overlay');
    const menuToggle = document.getElementById('mobileMenuToggle') || 
                      document.getElementById('menuToggle') ||
                      document.querySelector('.hamburger');
    
    if (mobileNav && overlay) {
        const isOpen = mobileNav.classList.contains('show');
        
        if (isOpen) {
            closeMobileMenu();
        } else {
            mobileNav.classList.add('show');
            overlay.classList.add('show');
            if (menuToggle) menuToggle.classList.add('active');
            document.body.style.overflow = 'hidden';
            document.body.classList.add('menu-open');
        }
    }
}

// Function to close mobile menu
function closeMobileMenu() {
    const mobileNav = document.getElementById('mobileNav');
    const overlay = document.getElementById('overlay');
    const menuToggle = document.getElementById('mobileMenuToggle') || 
                      document.getElementById('menuToggle') ||
                      document.querySelector('.hamburger');
    const header = document.getElementById('header');
    
    if (mobileNav) mobileNav.classList.remove('show');
    if (overlay) overlay.classList.remove('show');
    if (menuToggle) menuToggle.classList.remove('active');
    if (header) header.classList.remove('menu-open');
    
    // Close all open dropdowns when closing menu
    closeAllDropdowns();
    
    // Restore body scroll
    document.body.style.overflow = '';
    document.body.classList.remove('menu-open');
}

// FIXED: Dropdown toggle function with better mobile support
function toggleDropdown(event) {
    event.preventDefault();
    event.stopPropagation();
    
    const trigger = event.currentTarget;
    const dropdownContent = trigger.querySelector(".dropdown-content") || 
                           trigger.nextElementSibling;
    
    if (!dropdownContent) {
        console.log("No dropdown content found for:", trigger);
        return;
    }
    
    const isCurrentlyVisible = dropdownContent.style.display === 'block' || 
                              dropdownContent.classList.contains('show');
    
    // Close all other dropdowns first
    closeAllDropdowns();
    
    // Toggle current dropdown
    if (!isCurrentlyVisible) {
        dropdownContent.style.display = 'block';
        dropdownContent.classList.add('show');
        trigger.classList.add('active');
        
        console.log("Opened dropdown for:", trigger);
        
        // Ensure mobile nav can scroll if dropdown extends beyond viewport
        const mobileNav = document.getElementById('mobileNav');
        if (mobileNav && window.innerWidth <= 768) {
            // Add a small delay to ensure content is rendered
            setTimeout(() => {
                mobileNav.style.overflowY = 'auto';
                mobileNav.style.maxHeight = '100vh';
            }, 10);
        }
    }
}

// Close all dropdowns helper function
function closeAllDropdowns() {
    const allDropdowns = document.querySelectorAll('.dropdown-content');
    allDropdowns.forEach(dd => {
        dd.style.display = 'none';
        dd.classList.remove('show');
    });
    
    // Remove active classes from all triggers
    document.querySelectorAll('.dropdown.active, .mobile-dropdown.active').forEach(el => {
        el.classList.remove('active');
    });
    
    // Reset mobile nav overflow
    const mobileNav = document.getElementById('mobileNav');
    if (mobileNav) {
        mobileNav.style.overflowY = '';
        mobileNav.style.maxHeight = '';
    }
}

// Enhanced click outside handler
document.addEventListener('click', function(event) {
    // Check if click is inside dropdown area
    const isDropdownClick = event.target.closest('.dropdown') || 
                           event.target.closest('.mobile-dropdown') ||
                           event.target.closest('.dropdown-content');
    
    // Check if click is on mobile menu toggle
    const isMenuToggle = event.target.closest('.hamburger') ||
                        event.target.closest('.menu-toggle') ||
                        event.target.closest('#mobileMenuToggle') ||
                        event.target.closest('#menuToggle');
    
    if (!isDropdownClick && !isMenuToggle) {
        closeAllDropdowns();
    }
});

// Close mobile menu when clicking overlay
document.addEventListener('click', function(event) {
    if (event.target.id === 'overlay') {
        closeMobileMenu();
    }
});

// Close mobile menu on window resize
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        closeMobileMenu();
    }
});

// Handle escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeMobileMenu();
        closeAllDropdowns();
    }
});

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log("Initializing mobile dropdown functionality...");
    
    // Add click events to all dropdown triggers
    const dropdownTriggers = document.querySelectorAll('.dropdown, .mobile-dropdown');
    console.log(`Found ${dropdownTriggers.length} dropdown triggers`);
    
    dropdownTriggers.forEach((trigger, index) => {
        // Remove any existing event listeners to avoid duplicates
        const newTrigger = trigger.cloneNode(true);
        trigger.parentNode.replaceChild(newTrigger, trigger);
        
        // Add the click event
        newTrigger.addEventListener('click', toggleDropdown);
        console.log(`Added click event to trigger ${index + 1}:`, newTrigger);
    });
    
    // Add click event to close button
    const closeButton = document.getElementById('closeMenu') || 
                       document.querySelector('.close-menu') ||
                       document.querySelector('.mobile-close');
    if (closeButton) {
        closeButton.addEventListener('click', closeMobileMenu);
        console.log("Added click event to close button");
    }
    
    // Add click event to hamburger menu if it doesn't have onclick
    const hamburger = document.querySelector('.hamburger') || 
                     document.querySelector('.menu-toggle') ||
                     document.getElementById('menuToggle') ||
                     document.getElementById('mobileMenuToggle');
    if (hamburger && !hamburger.getAttribute('onclick')) {
        hamburger.addEventListener('click', toggleMobileMenu);
        console.log("Added click event to hamburger menu");
    }
    
    console.log("Mobile dropdown initialization complete");
});

// Debug function to help troubleshoot
function debugDropdowns() {
    console.log("=== DROPDOWN DEBUG INFO ===");
    console.log("Mobile Nav:", document.getElementById('mobileNav'));
    console.log("Overlay:", document.getElementById('overlay'));
    
    const triggers = document.querySelectorAll('.dropdown, .mobile-dropdown');
    console.log("Dropdown triggers:", triggers);
    triggers.forEach((trigger, index) => {
        const content = trigger.querySelector('.dropdown-content') || trigger.nextElementSibling;
        console.log(`Trigger ${index + 1}:`, trigger);
        console.log(`  - Content:`, content);
        console.log(`  - Has click listener:`, trigger.onclick !== null);
    });
    
    console.log("Dropdown contents:", document.querySelectorAll('.dropdown-content'));
    console.log("Close button:", document.getElementById('closeMenu') || document.querySelector('.close-menu'));
    console.log("Hamburger:", document.querySelector('.hamburger') || document.querySelector('.menu-toggle'));
    console.log("Window width:", window.innerWidth);
    console.log("========================");
}

// Call debug function (remove in production)
window.addEventListener('load', debugDropdowns);
// Logout function
function logout() {
    try {
        localStorage.removeItem('userData');
        // Redirect to login page or refresh
        location.reload();
    } catch (error) {
        console.error('Error during logout:', error);
    }
}

// Main DOMContentLoaded event listener
document.addEventListener('DOMContentLoaded', function() {
    // Load cart from localStorage FIRST - this is crucial
    loadCart();
    
    // Set up product cards
    const cards = document.querySelectorAll('.product-card');
    console.log('Found product cards:', cards.length); // Debug log

    cards.forEach((card, index) => {
        // Get the ID from data attribute, or use index + 1 as fallback
        let id = parseInt(card.getAttribute('data-id'));
        if (!id || isNaN(id)) {
            id = index + 1; // Use index + 1 as fallback ID
            card.setAttribute('data-id', id);
            console.log(`Set fallback ID ${id} for card ${index}`);
        }

        // Get name from data attribute or from the card content
        let name = card.getAttribute('data-name');
        if (!name) {
            const nameElement = card.querySelector('.product-name');
            name = nameElement ? nameElement.textContent.trim() : `Product ${id}`;
            card.setAttribute('data-name', name);
            console.log(`Set fallback name "${name}" for card ${index}`);
        }

        const redirect = card.getAttribute('data-redirect');

        console.log(`Card ${index}: ID=${id}, Name="${name}", Redirect="${redirect}"`); // Debug log

        // Add click handler for product page navigation
        card.addEventListener('click', (e) => {
            // Don't navigate if clicking the add to cart button
            if (e.target.classList.contains('add-to-cart-btn') || e.target.closest('.add-to-cart-btn')) {
                return;
            }
            redirectToProductPage(redirect, name);
        });

        // Find and set up the add to cart button
        const button = card.querySelector('.add-to-cart-btn');
        if (button) {
            button.addEventListener('click', e => {
                e.stopPropagation();
                console.log(`Add to cart clicked for ID: ${id}, Name: ${name}`); // Debug log
                addToCart(id);
                showToast(`${name} added to cart!`);
            });
            console.log(`Set up button for product ${id}: ${name}`);
        } else {
            console.log(`No add-to-cart button found for product ${id}`);
        }
    });

    // Set up cart button click handlers
    const cartButtons = document.querySelectorAll('#cartButton, .cart-icon, .cart-btn, [data-cart-toggle]');
    cartButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            toggleCart();
        });
    });

    // Make cart count clickable if it exists
    const cartCount = document.getElementById('cartCount');
    if (cartCount) {
        cartCount.style.cursor = 'pointer';
        cartCount.addEventListener('click', toggleCart);
    }

    // Set up checkout button
    const checkoutBtn = document.getElementById('checkoutBtn');
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', checkout);
    }

    // Set up clear cart button
    const clearCartBtn = document.getElementById('clearCartBtn');
    if (clearCartBtn) {
        clearCartBtn.addEventListener('click', clearCart);
    }

    // Close cart when clicking outside
    document.addEventListener('click', (e) => {
        const cartModal = document.getElementById('cartModal');
        if (cartModal && cartModal.style.display === 'flex') {
            if (e.target === cartModal) {
                toggleCart();
            }
        }
    });

    // Search functionality setup
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', showSearchDropdown);
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
    }

    // Click outside search to close dropdown
    document.addEventListener('click', function(e) {
        const searchContainer = document.querySelector('.search-container');
        if (searchContainer && !searchContainer.contains(e.target)) {
            hideSearchDropdown();
        }
    });

    // Header scroll effect
    window.addEventListener('scroll', function() {
        const header = document.getElementById('header');
        if (header) {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }
    });

    // Single DOMContentLoaded event listener that handles everything
document.addEventListener('DOMContentLoaded', function() {
    // Get all the elements
    const dropdown = document.querySelector('.dropdown');
    const dropdownContent = document.querySelector('.dropdown-content');
    const userDropdown = document.querySelector('.user-dropdown');
    const userDropdownContent = document.querySelector('.user-dropdown-content');
    const menuToggle = document.getElementById('mobileMenuToggle') || document.getElementById('menuToggle');
    const mobileNav = document.getElementById('mobileNav');
    const overlay = document.getElementById('overlay');
    const closeMenu = document.getElementById('closeMenu');
    const mobileDropdown = document.querySelector('.mobile-dropdown');
    const mobileDropbtn = document.querySelector('.mobile-dropbtn');
    const header = document.getElementById('header');
    const body = document.body;

    // Add some timeout to prevent immediate disappearance
    let dropdownTimeout;
    let userDropdownTimeout;

    // For Products dropdown (desktop)
    if (dropdown && dropdownContent) {
        dropdown.addEventListener('mouseleave', function() {
            dropdownTimeout = setTimeout(function() {
                dropdownContent.style.display = 'none';
            }, 300); // 300ms delay before hiding
        });

        dropdownContent.addEventListener('mouseenter', function() {
            clearTimeout(dropdownTimeout);
        });
    }

    // For User dropdown (desktop)
    if (userDropdown && userDropdownContent) {
        userDropdown.addEventListener('mouseleave', function() {
            userDropdownTimeout = setTimeout(function() {
                userDropdownContent.style.display = 'none';
            }, 300); // 300ms delay before hiding
        });

        userDropdownContent.addEventListener('mouseenter', function() {
            clearTimeout(userDropdownTimeout);
        });

        userDropdownContent.addEventListener('mouseleave', function() {
            userDropdownContent.style.display = 'none';
        });
    }

    // Handle mobile dropdown toggle
    if (mobileDropbtn) {
        mobileDropbtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (mobileDropdown) {
                mobileDropdown.classList.toggle('active');
            }
        });
    }

    // Close menu when close button is clicked
    if (closeMenu) {
        closeMenu.addEventListener('click', function() {
            closeMobileMenu();
        });
    }

    // Toggle mobile menu
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            if (mobileNav) {
                mobileNav.classList.toggle('show');
            }
            if (overlay) {
                overlay.classList.toggle('show');
            }
            menuToggle.classList.toggle('active');
            if (header) {
                header.classList.toggle('menu-open');
            }
            body.classList.toggle('menu-open');
            
            // Handle body scroll - prevent scrolling when menu is open
            if (mobileNav && mobileNav.classList.contains('show')) {
                body.style.overflow = 'hidden';
            } else {
                body.style.overflow = '';
            }

            // Animate menu toggle
            menuToggle.classList.add('animate');
            setTimeout(() => {
                menuToggle.classList.remove('animate');
            }, 500);
        });
    }

    // Close mobile menu when clicking overlay
    if (overlay) {
        overlay.addEventListener('click', function() {
            closeMobileMenu();
        });
    }

    // User authentication handling (if userData exists)
    try {
        const userDataRaw = localStorage.getItem('userData');
        if (userDataRaw) {
            const userData = JSON.parse(userDataRaw);
            
            if (userData && userData.name) {
                const firstName = userData.name.split(' ')[0];
                const userLoginElement = document.querySelector('.user-login span');
                
                if (userLoginElement) {
                    userLoginElement.textContent = `Hi ${firstName}`;
                }
                
                const dropdownContentElement = document.getElementById('userDropdownContent');
                if (dropdownContentElement) {
                    const dropdownHTML = `
                        <a href="profile.php"><i class="fas fa-user"></i> My Profile</a>
                        <a href="#orders"><i class="fas fa-shopping-bag"></i> My Orders</a>
                        <a href="#order-history"><i class="fas fa-history"></i> Order History</a>
                        <a href="#logout" onclick="logout()"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    `;
                    dropdownContentElement.innerHTML = dropdownHTML;
                }
            }
        }
    } catch (error) {
        console.error("Error handling user data:", error);
    }

    // Add click event to dropdowns
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', toggleDropdown);
    });

    // Header scroll effect
    window.addEventListener('scroll', function() {
        if (header) {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }
    });

    // Slider Functionality (if slider exists)
    const slides = document.getElementById("slides");
    const dotsContainer = document.getElementById("dots");
    
    if (slides && dotsContainer) {
        let currentSlide = 0;
        const totalSlides = slides.children.length;
        let autoSlideInterval;

        function createDots() {
            for (let i = 0; i < totalSlides; i++) {
                const dot = document.createElement("span");
                dot.classList.add("dot");
                if (i === 0) dot.classList.add("active");
                dot.addEventListener("click", () => goToSlide(i));
                dotsContainer.appendChild(dot);
            }
        }

        function updateSlider() {
            slides.style.transform = `translateX(-${currentSlide * 100}%)`;
            // Update dots
            const dots = document.querySelectorAll(".dot");
            dots.forEach((dot, i) => {
                dot.classList.toggle("active", i === currentSlide);
            });
            // Reset animation on slide content
            const allContents = document.querySelectorAll('.slide-content');
            allContents.forEach(content => {
                content.style.animation = 'none';
                content.offsetHeight; // Trigger reflow
                content.style.animation = 'fadeInUp 0.8s forwards';
            });
            // Reset auto slide timer
            resetAutoSlide();
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateSlider();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateSlider();
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            autoSlideInterval = setInterval(nextSlide, 5000);
        }

        // Make functions global for slider controls
        window.nextSlide = nextSlide;
        window.prevSlide = prevSlide;
        window.goToSlide = goToSlide;

        // Initialize slider
        createDots();
        resetAutoSlide();

        // Touch Events for Slider
        let touchstartX = 0;
        let touchendX = 0;
        const slider = document.querySelector('.slider');
        
        if (slider) {
            slider.addEventListener('touchstart', e => {
                touchstartX = e.changedTouches[0].screenX;
            });

            slider.addEventListener('touchend', e => {
                touchendX = e.changedTouches[0].screenX;
                handleSwipe();
            });

            function handleSwipe() {
                if (touchendX < touchstartX - 50) nextSlide();
                if (touchendX > touchstartX + 50) prevSlide();
            }
        }
    }
});

// Main toggle function - matches your HTML onclick="toggleMobileMenu()"
function toggleMobileMenu() {
    const mobileNav = document.getElementById('mobileNav');
    const overlay = document.getElementById('overlay');
    const menuToggle = document.getElementById('mobileMenuToggle') || document.getElementById('menuToggle');
    
    if (mobileNav && overlay) {
        // Toggle the show class
        mobileNav.classList.toggle('show');
        overlay.classList.toggle('show');
        
        // Toggle menu button active state
        if (menuToggle) {
            menuToggle.classList.toggle('active');
        }
        
        // Handle body scroll - prevent scrolling when menu is open
        if (mobileNav.classList.contains('show')) {
            document.body.style.overflow = 'hidden';
            document.body.classList.add('menu-open');
        } else {
            document.body.style.overflow = '';
            document.body.classList.remove('menu-open');
        }
    }
}

// Function to close mobile menu
function closeMobileMenu() {
    const mobileNav = document.getElementById('mobileNav');
    const overlay = document.getElementById('overlay');
    const menuToggle = document.getElementById('mobileMenuToggle') || document.getElementById('menuToggle');
    const header = document.getElementById('header');
    
    if (mobileNav) {
        mobileNav.classList.remove('show');
    }
    if (overlay) {
        overlay.classList.remove('show');
    }
    if (menuToggle) {
        menuToggle.classList.remove('active');
    }
    if (header) {
        header.classList.remove('menu-open');
    }
    
    // Restore body scroll
    document.body.style.overflow = '';
    document.body.classList.remove('menu-open');
}

// Handle mobile dropdown functionality
function toggleMobileDropdown() {
    const mobileDropdown = document.querySelector('.mobile-dropdown');
    if (mobileDropdown) {
        mobileDropdown.classList.toggle('active');
    }
}

// Handle dropdowns in mobile mode
function toggleDropdown(event) {
    // Prevent closing other mobile navs
    event.stopPropagation();
    const dropdown = event.currentTarget;
    const dropdownContent = dropdown.querySelector(".dropdown-content");
    
    if (window.innerWidth <= 768) {
        event.preventDefault();
        if (dropdownContent) {
            const isCurrentlyVisible = dropdownContent.style.display === 'block';
            dropdownContent.style.display = isCurrentlyVisible ? 'none' : 'block';
            
            // Enable scrolling for the mobile nav when dropdown is open
            const mobileNav = document.getElementById('mobileNav');  
            if (mobileNav && !isCurrentlyVisible) {
                // Dropdown is being opened - allow scrolling within mobile nav
                mobileNav.style.overflowY = 'auto';
                mobileNav.style.maxHeight = '100vh';
            } else if (mobileNav && isCurrentlyVisible) {
                // Dropdown is being closed - reset mobile nav overflow
                mobileNav.style.overflowY = '';
                mobileNav.style.maxHeight = '';
            }
        }
    }
    
    // Close other open dropdowns
    document.addEventListener("click", function closeDropdown(e) {
        if (!dropdown.contains(e.target)) {
            if (dropdownContent) {
                dropdownContent.style.display = "none";
                // Reset mobile nav overflow when dropdown closes
                const mobileNav = document.getElementById('mobileNav');
                if (mobileNav) {
                    mobileNav.style.overflowY = '';
                    mobileNav.style.maxHeight = '';
                }
            }
            document.removeEventListener("click", closeDropdown);
        }
    });
}

// Mobile Menu Toggle (alternative function)
function toggleMenu() {
    const mobileNav = document.getElementById('mobileNav');
    const overlay = document.getElementById('overlay');
    if (mobileNav) {
        mobileNav.classList.toggle('show');
    }
    if (overlay) {
        overlay.classList.toggle('show');
    }
    document.body.style.overflow = mobileNav && mobileNav.classList.contains('show') ? 'hidden' : '';
}

// Filter products function (if needed for your product links)
function filterProducts(brand) {
    // Close mobile menu when navigating
    closeMobileMenu();
    
    // Add your product filtering logic here
    console.log('Filtering products for:', brand);
}

// Logout function (consolidated - only one definition)
function logout() {
    try {
        localStorage.removeItem('userData');
        // Redirect to login page or refresh
        location.reload();
    } catch (error) {
        console.error('Error during logout:', error);
    }
}
    // Setup dropdown functionality
    const dropdowns = document.querySelectorAll('.dropdown');
    const userDropdown = document.querySelector('.user-dropdown');
    const userDropdownContent = document.querySelector('.user-dropdown-content');
    const mobileDropdown = document.querySelector('.mobile-dropdown');
    const mobileDropbtn = document.querySelector('.mobile-dropbtn');
    const overlay = document.getElementById('overlay');
    const closeMenu = document.getElementById('closeMenu');
    const header = document.getElementById('header');
    const body = document.body;

    // Add timeout to prevent immediate disappearance
    let dropdownTimeout;
    let userDropdownTimeout;

    // For User dropdown (desktop)
    if (userDropdown && userDropdownContent) {
        userDropdown.addEventListener('mouseleave', function() {
            userDropdownTimeout = setTimeout(function() {
                userDropdownContent.style.display = 'none';
            }, 300); // 300ms delay before hiding
        });

        userDropdownContent.addEventListener('mouseenter', function() {
            clearTimeout(userDropdownTimeout);
        });

        userDropdownContent.addEventListener('mouseleave', function() {
            userDropdownContent.style.display = 'none';
        });
    }

    // Handle mobile dropdown toggle
    if (mobileDropbtn) {
        mobileDropbtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (mobileDropdown) {
                mobileDropdown.classList.toggle('active');
            }
        });
    }

    // Close menu when close button is clicked
    if (closeMenu) {
        closeMenu.addEventListener('click', function() {
            closeMobileMenu();
        });
    }

    // Close mobile menu when clicking overlay
    if (overlay) {
        overlay.addEventListener('click', function() {
            closeMobileMenu();
        });
    }

    // User authentication handling (if userData exists)
    try {
        const userDataRaw = localStorage.getItem('userData');
        if (userDataRaw) {
            const userData = JSON.parse(userDataRaw);
            
            if (userData && userData.name) {
                const firstName = userData.name.split(' ')[0];
                const userLoginElement = document.querySelector('.user-login span');
                
                if (userLoginElement) {
                    userLoginElement.textContent = `Hi ${firstName}`;
                }
                
                const dropdownContentElement = document.getElementById('userDropdownContent');
                if (dropdownContentElement) {
                    const dropdownHTML = `
                        <a href="profile.php"><i class="fas fa-user"></i> My Profile</a>
                        <a href="#orders"><i class="fas fa-shopping-bag"></i> My Orders</a>
                        <a href="#order-history"><i class="fas fa-history"></i> Order History</a>
                        <a href="#logout" onclick="logout()"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    `;
                    dropdownContentElement.innerHTML = dropdownHTML;
                }
            }
        }
    } catch (error) {
        console.error("Error handling user data:", error);
    }

  // Add click event to dropdowns
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', toggleDropdown);
    });

    // Slider Functionality (if slider exists)
    const slides = document.getElementById("slides");
    const dotsContainer = document.getElementById("dots");
    
    if (slides && dotsContainer) {
        let currentSlide = 0;
        const totalSlides = slides.children.length;
        let autoSlideInterval;

        function createDots() {
            for (let i = 0; i < totalSlides; i++) {
                const dot = document.createElement("span");
                dot.classList.add("dot");
                if (i === 0) dot = document.createElement("span");
                dot.classList.add("dot");
                if (i === 0) dot.classList.add("active");
                dot.addEventListener("click", () => goToSlide(i));
                dotsContainer.appendChild(dot);
            }
        }

        function updateSlider() {
            slides.style.transform = `translateX(-${currentSlide * 100}%)`;
            // Update dots
            const dots = document.querySelectorAll(".dot");
            dots.forEach((dot, i) => {
                dot.classList.toggle("active", i === currentSlide);
            });
            // Reset animation on slide content
            const allContents = document.querySelectorAll('.slide-content');
            allContents.forEach(content => {
                content.style.animation = 'none';
                content.offsetHeight; // Trigger reflow
                content.style.animation = 'fadeInUp 0.8s forwards';
            });
            // Reset auto slide timer
            resetAutoSlide();
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateSlider();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateSlider();
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            autoSlideInterval = setInterval(nextSlide, 5000);
        }

        // Make functions global for slider controls
        window.nextSlide = nextSlide;
        window.prevSlide = prevSlide;
        window.goToSlide = goToSlide;

        // Initialize slider
        createDots();
        resetAutoSlide();

        // Touch Events for Slider
        let touchstartX = 0;
        let touchendX = 0;
        const slider = document.querySelector('.slider');
        
        if (slider) {
            slider.addEventListener('touchstart', e => {
                touchstartX = e.changedTouches[0].screenX;
            });

            slider.addEventListener('touchend', e => {
                touchendX = e.changedTouches[0].screenX;
                handleSwipe();
            });

            function handleSwipe() {
                if (touchendX < touchstartX - 50) nextSlide();
                if (touchendX > touchstartX + 50) prevSlide();
            }
        }
    }
});

// Main toggle function - matches your HTML onclick="toggleMobileMenu()"
function toggleMobileMenu() {
    const mobileNav = document.getElementById('mobileNav');
    const overlay = document.getElementById('overlay');
    const menuToggle = document.getElementById('mobileMenuToggle') || document.getElementById('menuToggle');
    
    if (mobileNav && overlay) {
        // Toggle the show class
        mobileNav.classList.toggle('show');
        overlay.classList.toggle('show');
        
        // Toggle menu button active state
        if (menuToggle) {
            menuToggle.classList.toggle('active');
        }
        
        // Handle body scroll - prevent scrolling when menu is open
        if (mobileNav.classList.contains('show')) {
            document.body.style.overflow = 'hidden';
            document.body.classList.add('menu-open');
        } else {
            document.body.style.overflow = '';
            document.body.classList.remove('menu-open');
        }
    }
}

// Function to close mobile menu
function closeMobileMenu() {
    const mobileNav = document.getElementById('mobileNav');
    const overlay = document.getElementById('overlay');
    const menuToggle = document.getElementById('mobileMenuToggle') || document.getElementById('menuToggle');
    const header = document.getElementById('header');
    
    if (mobileNav) {
        mobileNav.classList.remove('show');
    }
    if (overlay) {
        overlay.classList.remove('show');
    }
    if (menuToggle) {
        menuToggle.classList.remove('active');
    }
    if (header) {
        header.classList.remove('menu-open');
    }
    
    // Restore body scroll
    document.body.style.overflow = '';
    document.body.classList.remove('menu-open');
}

// Handle mobile dropdown functionality
function toggleMobileDropdown() {
    const mobileDropdown = document.querySelector('.mobile-dropdown');
    if (mobileDropdown) {
        mobileDropdown.classList.toggle('active');
    }
}

// Handle dropdowns in mobile mode
function toggleDropdown(event) {
    // Prevent closing other mobile navs
    event.stopPropagation();
    const dropdown = event.currentTarget;
    const dropdownContent = dropdown.querySelector(".dropdown-content");
    
    if (window.innerWidth <= 768) {
        event.preventDefault();
        if (dropdownContent) {
            const isCurrentlyVisible = dropdownContent.style.display === 'block';
            dropdownContent.style.display = isCurrentlyVisible ? 'none' : 'block';
            
            // Enable scrolling for the mobile nav when dropdown is open
            const mobileNav = document.getElementById('mobileNav');  
            if (mobileNav && !isCurrentlyVisible) {
                // Dropdown is being opened - allow scrolling within mobile nav
                mobileNav.style.overflowY = 'auto';
                mobileNav.style.maxHeight = '100vh';
            } else if (mobileNav && isCurrentlyVisible) {
                // Dropdown is being closed - reset mobile nav overflow
                mobileNav.style.overflowY = '';
                mobileNav.style.maxHeight = '';
            }
        }
    }
    
    // Close other open dropdowns
    document.addEventListener("click", function closeDropdown(e) {
        if (!dropdown.contains(e.target)) {
            if (dropdownContent) {
                dropdownContent.style.display = "none";
                // Reset mobile nav overflow when dropdown closes
                const mobileNav = document.getElementById('mobileNav');
                if (mobileNav) {
                    mobileNav.style.overflowY = '';
                    mobileNav.style.maxHeight = '';
                }
            }
            document.removeEventListener("click", closeDropdown);
        }
    });
}

// Mobile Menu Toggle (alternative function)
function toggleMenu() {
    const mobileNav = document.getElementById('mobileNav');
    const overlay = document.getElementById('overlay');
    if (mobileNav) {
        mobileNav.classList.toggle('show');
    }
    if (overlay) {
        overlay.classList.toggle('show');
    }
    document.body.style.overflow = mobileNav && mobileNav.classList.contains('show') ? 'hidden' : '';
}

// Filter products function (if needed for your product links)
function filterProducts(brand) {
    // Close mobile menu when navigating
    closeMobileMenu();
    
    // Add your product filtering logic here
    console.log('Filtering products for:', brand);
}

// Logout function (consolidated - only one definition)
function logout() {
    try {
        localStorage.removeItem('userData');
        // Redirect to login page or refresh
        location.reload();
    } catch (error) {
        console.error('Error during logout:', error);
    }
}
window.addEventListener('DOMContentLoaded', () => {
    const userDataRaw = localStorage.getItem('userData');
    let userData;

    try {
        userData = JSON.parse(userDataRaw);
    } catch (e) {
        console.error("Invalid user data in localStorage");
    }

    if (userData && userData.name) {
        const firstName = userData.name.split(' ')[0];
        document.querySelector('.user-login span').textContent = `Hi ${firstName}`;

        const dropdownHTML = `
            <a href="profile.php"><i class="fas fa-user"></i> My Profile</a>
            <a href="#orders"><i class="fas fa-shopping-bag"></i> My Orders</a>
            <a href="#order-history"><i class="fas fa-history"></i> Order History</a>
            <a href="#logout" onclick="logout()"><i class="fas fa-sign-out-alt"></i> Logout</a>
        `;
        document.getElementById('userDropdownContent').innerHTML = dropdownHTML;
    }
});

// Logout function
function logout() {
    // Clear user data
    userData = null;
    
    // Clear all session storage
    sessionStorage.removeItem('userData');
    sessionStorage.removeItem('sellerData');
    sessionStorage.removeItem('dealerData');
    
    // Reset cart to zero
    resetCart();
    
    // Reset top navigation
    resetTopNavigation();
    
    const userWelcomeDiv = document.getElementById('userWelcome');
    if (userWelcomeDiv) {
        userWelcomeDiv.style.display = 'none';
    }
    
    // Restore original buttons if they exist
    const buttonsDiv = document.querySelector('.buttons');
    if (buttonsDiv) {
        buttonsDiv.innerHTML = `
            <button class="btn btn-login" onclick="openLoginModal()">Login</button>
            <button class="btn btn-signup" onclick="openSignupModal()">Sign Up</button>
            <button class="btn btn-seller" onclick="openSellerModal()">Seller Login</button>
            <button class="btn btn-dealer" onclick="openDealerModal()">Dealer Login</button>
        `;
    }
    
    // Show logout message
    alert('You have been logged out successfully!');
    
    // Redirect to welcome page
    try {
        window.location.href = 'welcome.php';
        setTimeout(() => {
            window.location.replace('welcome.php');
        }, 100);
        setTimeout(() => {
            if (window.location.pathname !== '/welcome.php' && !window.location.pathname.endsWith('welcome.php')) {
                window.location.assign('welcome.php');
            }
        }, 500);
    } catch (error) {
        console.error('Redirect failed:', error);
        setTimeout(() => {
            window.location = 'welcome.php';
        }, 1000);
    }
}

// Fixed codes for authentication
const DEALER_CODE = "PTH2024";
const SELLER_CODE = "SELL2024";

// In-memory storage for user data
let userData = null;
let registeredUsers = [];

// ADDED: Function to reset cart to zero
function resetCart() {
    try {
        // Clear cart from sessionStorage
        sessionStorage.removeItem('cart');
        sessionStorage.removeItem('cartItems');
        sessionStorage.removeItem('cartCount');
        
        // Reset cart display elements
        const cartCountElements = document.querySelectorAll('.cart-count, .cart-counter, .badge');
        cartCountElements.forEach(element => {
            element.textContent = '0';
            element.style.display = 'none';
        });
        
        // Reset cart total if exists
        const cartTotalElements = document.querySelectorAll('.cart-total, .total-amount');
        cartTotalElements.forEach(element => {
            element.textContent = '₹0';
        });
        
        // Clear cart items container if exists
        const cartItemsContainer = document.querySelector('.cart-items, .cart-container');
        if (cartItemsContainer) {
            cartItemsContainer.innerHTML = '<p>Your cart is empty</p>';
        }
        
        // Update global cart variables if they exist
        if (typeof window.cartItems !== 'undefined') {
            window.cartItems = [];
        }
        if (typeof window.cartCount !== 'undefined') {
            window.cartCount = 0;
        }
        if (typeof window.cartTotal !== 'undefined') {
            window.cartTotal = 0;
        }
        
        console.log('Cart reset successfully');
    } catch (error) {
        console.error('Error resetting cart:', error);
    }
}

// ADDED: Function to check if user is logged in
function isUserLoggedIn() {
    const storedUserData = sessionStorage.getItem('userData');
    const storedSellerData = sessionStorage.getItem('sellerData');
    const storedDealerData = sessionStorage.getItem('dealerData');
    
    return (storedUserData || storedSellerData || storedDealerData) && userData;
}

// ADDED: Function to show login required message
function showLoginRequiredMessage() {
    alert('Please sign in or login to continue accessing this feature.');
}

// ADDED: Function to check authentication before executing functions
function requireAuth(callback) {
    if (!isUserLoggedIn()) {
        showLoginRequiredMessage();
        return false;
    }
    callback();
    return true;
}

// IMPROVED: Function to find and update the top navigation user element
function updateTopNavigation(user, userType) {
    const firstName = user.name.split(' ')[0];
    let displayText = `Hi ${firstName}`;
    
    // Add user type indicator if needed
    if (userType === 'seller') {
        displayText += ' (Seller)';
    } else if (userType === 'dealer') {
        displayText += ' (Dealer)';
    }
    
    // Target multiple possible selectors for the user display
    const userSelectors = [
        '.user-login span',
        '.user-dropdown span',
        '.user-login .user-text',
        '.user-display span',
        '.nav-user span',
        '.header-user span',
        '.user-info span'
    ];
    
    let userElementFound = false;
    
    for (let selector of userSelectors) {
        const element = document.querySelector(selector);
        if (element) {
            element.textContent = displayText;
            console.log('Updated top navigation to:', displayText);
            userElementFound = true;
            break;
        }
    }
    
    if (!userElementFound) {
        console.warn('Could not find top navigation user element');
        createFallbackUserDisplay(displayText);
    }
    
    // Update dropdown content for logged-in users
    updateDropdownContent(user, userType);
}

// IMPROVED: Create a fallback user display that works with any header
function createFallbackUserDisplay(displayText) {
    // Check if fallback already exists
    if (document.getElementById('fallbackUserDisplay')) {
        document.getElementById('fallbackUserDisplay').textContent = displayText;
        return;
    }
    
    // Try to find existing header structure first
    const headerSelectors = [
        '.header',
        '.navbar',
        '.top-nav',
        '.navigation',
        '.header-container'
    ];
    
    let headerElement = null;
    for (let selector of headerSelectors) {
        headerElement = document.querySelector(selector);
        if (headerElement) break;
    }
    
    // Create fallback element
    const fallbackDiv = document.createElement('div');
    fallbackDiv.id = 'fallbackUserDisplay';
    fallbackDiv.className = 'user-login fallback-user-display';
    
    // Style the fallback to blend with existing header
    fallbackDiv.style.cssText = `
        position: fixed;
        top: 10px;
        right: 10px;
        z-index: 9999;
        background: rgba(255, 255, 255, 0.9);
        padding: 8px 12px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
    `;
    
    fallbackDiv.innerHTML = `
        <i class="fas fa-user-circle" style="margin-right: 5px;"></i>
        <span>${displayText}</span>
    `;
    
    // Add click event to show dropdown
    fallbackDiv.addEventListener('click', function() {
        const dropdown = document.createElement('div');
        dropdown.className = 'fallback-dropdown';
        dropdown.style.cssText = `
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            min-width: 150px;
            z-index: 10000;
        `;
        
        // Add dropdown content
        updateDropdownContent(userData, userData?.type || 'user');
        const dropdownContent = document.querySelector('.user-dropdown-content');
        if (dropdownContent) {
            dropdown.innerHTML = dropdownContent.innerHTML;
        }
        
        fallbackDiv.appendChild(dropdown);
        
        // Remove dropdown when clicking outside
        setTimeout(() => {
            document.addEventListener('click', function removeDropdown(e) {
                if (!fallbackDiv.contains(e.target)) {
                    if (dropdown.parentNode) {
                        dropdown.remove();
                    }
                    document.removeEventListener('click', removeDropdown);
                }
            });
        }, 100);
    });
    
    if (headerElement) {
        headerElement.appendChild(fallbackDiv);
    } else {
        document.body.appendChild(fallbackDiv);
    }
}

// IMPROVED: Initialize page on load - works on any page with better header handling
function initializeUserLogin() {
    // Check for stored user data from sessionStorage
    const storedUserData = sessionStorage.getItem('userData');
    const storedSellerData = sessionStorage.getItem('sellerData');
    const storedDealerData = sessionStorage.getItem('dealerData');
    
    if (storedUserData) {
        userData = JSON.parse(storedUserData);
        updateTopNavigation(userData, 'user');
    } else if (storedSellerData) {
        userData = JSON.parse(storedSellerData);
        updateTopNavigation(userData, 'seller');
    } else if (storedDealerData) {
        userData = JSON.parse(storedDealerData);
        updateTopNavigation(userData, 'dealer');
    } else {
        // No user logged in - show guest dropdown
        updateDropdownContent(null, null);
        
        // Ensure header shows default state
        const userSelectors = [
            '.user-login span',
            '.user-dropdown span',
            '.user-login .user-text',
            '.user-display span',
            '.nav-user span',
            '.header-user span',
            '.user-info span'
        ];
        
        for (let selector of userSelectors) {
            const element = document.querySelector(selector);
            if (element && element.textContent.includes('(')) {
                element.textContent = 'Hi User';
                break;
            }
        }
    }
    
    // Update other user-related elements if they exist
    if (userData && userData.name) {
        const firstName = userData.name.split(' ')[0];
        
        // Update welcome message if it exists
        const welcomeElement = document.getElementById('userName');
        if (welcomeElement) {
            welcomeElement.textContent = `Hi ${firstName}!`;
        }
        
        const userWelcomeDiv = document.getElementById('userWelcome');
        if (userWelcomeDiv) {
            userWelcomeDiv.style.display = 'block';
        }
        
        // Update buttons if they exist
        updateButtonsForLoggedInUser();
    }
}

// UPDATED: Functions for dropdown menu actions - removed wishlist and settings, added past orders
function viewProfile() {
    requireAuth(() => {
        window.location.href = 'profile1.php';
    });
}

function viewOrders() {
    requireAuth(() => {
        window.location.href = 'myorder1.php';
    });
}

function viewPastOrders() {
    requireAuth(() => {
        window.location.href = 'past-orders1.php';
    });
}

function viewPolicies() {
    requireAuth(() => {
        window.location.href = 'policy1.php';
    });
}

function viewSellerDashboard() {
    requireAuth(() => {
        if (userData && userData.type === 'seller') {
            window.location.href = 'seller-dashboard.php';
        } else {
            alert('Access denied. Seller privileges required.');
        }
    });
}

function viewDealerDashboard() {
    requireAuth(() => {
        if (userData && userData.type === 'dealer') {
            window.location.href = 'dealer-dashboard.php';
        } else {
            alert('Access denied. Dealer privileges required.');
        }
    });
}

// UPDATED: Function to update dropdown content - removed wishlist and settings, added past orders
function updateDropdownContent(user, userType) {
    const dropdownContent = document.querySelector('.user-dropdown-content');
    
    if (dropdownContent) {
        // Clear existing content
        dropdownContent.innerHTML = '';
        
        if (user) {
            // User is logged in - show logged-in options (updated list)
            const loggedInOptions = [
                { icon: 'fas fa-user', text: 'My Profile', action: 'viewProfile()' },
                { icon: 'fas fa-shopping-bag', text: 'My Orders', action: 'viewOrders()' },
                { icon: 'fas fa-history', text: 'Past Orders', action: 'viewPastOrders()' },
                { icon: 'fas fa-file-alt', text: 'Policies', action: 'viewPolicies()' },
                { icon: 'fas fa-sign-out-alt', text: 'Logout', action: 'logout()' }
            ];
            
            // Add user type specific options
            if (userType === 'seller') {
                loggedInOptions.splice(2, 0, { icon: 'fas fa-store', text: 'Seller Dashboard', action: 'viewSellerDashboard()' });
            } else if (userType === 'dealer') {
                loggedInOptions.splice(2, 0, { icon: 'fas fa-handshake', text: 'Dealer Dashboard', action: 'viewDealerDashboard()' });
            }
            
            // Create dropdown items
            loggedInOptions.forEach(option => {
                const link = document.createElement('a');
                link.href = '#';
                link.onclick = function(e) {
                    e.preventDefault();
                    eval(option.action);
                };
                link.innerHTML = `<i class="${option.icon}"></i> ${option.text}`;
                dropdownContent.appendChild(link);
            });
            
        } else {
            // User not logged in - show login/signup options that redirect to welcome.php
            const guestOptions = [
                { icon: 'fas fa-sign-in-alt', text: 'Login', action: 'redirectToWelcome()' },
                { icon: 'fas fa-user-plus', text: 'Sign Up', action: 'redirectToWelcome()' },
                { icon: 'fas fa-store', text: 'Seller Login', action: 'redirectToWelcome()' },
                { icon: 'fas fa-handshake', text: 'Dealer Login', action: 'redirectToWelcome()' }
            ];
            
            // Create dropdown items
            guestOptions.forEach(option => {
                const link = document.createElement('a');
                link.href = '#';
                link.onclick = function(e) {
                    e.preventDefault();
                    eval(option.action);
                };
                link.innerHTML = `<i class="${option.icon}"></i> ${option.text}`;
                dropdownContent.appendChild(link);
            });
        }
    }
}

// Function to redirect to welcome.php for login options
function redirectToWelcome() {
    try {
        window.location.href = 'welcome.php';
        setTimeout(() => {
            window.location.replace('welcome.php');
        }, 100);
        setTimeout(() => {
            if (window.location.pathname !== '/welcome.php' && !window.location.pathname.endsWith('welcome.php')) {
                window.location.assign('welcome.php');
            }
        }, 500);
    } catch (error) {
        console.error('Redirect failed:', error);
        setTimeout(() => {
            window.location = 'welcome.php';
        }, 1000);
    }
}

// IMPROVED: Function to reset top navigation to default
function resetTopNavigation() {
    // Target multiple possible selectors for the user display
    const userSelectors = [
        '.user-login span',
        '.user-dropdown span',
        '.user-login .user-text',
        '.user-display span',
        '.nav-user span',
        '.header-user span',
        '.user-info span'
    ];
    
    for (let selector of userSelectors) {
        const element = document.querySelector(selector);
        if (element) {
            element.textContent = 'Hi User';
            break;
        }
    }
    
    // Reset dropdown content to guest options
    updateDropdownContent(null, null);
    
    // Remove fallback if it exists
    const fallbackElement = document.getElementById('fallbackUserDisplay');
    if (fallbackElement) {
        fallbackElement.remove();
    }
}

function updateButtonsForLoggedInUser() {
    const buttonsDiv = document.querySelector('.buttons');
    if (buttonsDiv) {
        buttonsDiv.innerHTML = `
            <button class="btn btn-login" onclick="logout()">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
            <button class="btn btn-signup" onclick="viewProfile()">
                <i class="fas fa-user"></i> My Profile
            </button>
            <button class="btn btn-seller" onclick="openSellerModal()">Seller Login</button>
            <button class="btn btn-dealer" onclick="openDealerModal()">Dealer Login</button>
        `;
    }
}

// Modal functions - only work if modals exist on the page
function openLoginModal() {
    const modal = document.getElementById('loginModal');
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
}

function openSignupModal() {
    const modal = document.getElementById('signupModal');
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
}

function openSellerModal() {
    const modal = document.getElementById('sellerModal');
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
}

function openDealerModal() {
    const modal = document.getElementById('dealerModal');
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

// UPDATED: Handle user login - resets cart and redirects to welcome.php
function handleLogin(event) {
    event.preventDefault();
    
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;

    // Find user in registered users
    const user = registeredUsers.find(u => u.email === email && u.password === password);
    
    if (user) {
        userData = user;
        closeModal('loginModal');
        
        // Reset cart to zero
        resetCart();
        
        // Store user data in sessionStorage
        sessionStorage.setItem('userData', JSON.stringify(user));
        
        // Update top navigation immediately
        updateTopNavigation(user, 'user');
        
        alert(`Welcome back, ${user.name}! Redirecting to dashboard...`);
        
        setTimeout(() => {
            window.location.href = 'welcome.php';
        }, 1000);
    } else {
        alert('Invalid email or password. Please check your credentials or sign up first.');
    }
}

// UPDATED: Handle user signup - resets cart and redirects to welcome.php
function handleSignup(event) {
    event.preventDefault();
    
    const name = document.getElementById('signupName').value;
    const email = document.getElementById('signupEmail').value;
    const phone = document.getElementById('signupPhone').value;
    const password = document.getElementById('signupPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    // Validation
    if (!name || !email || !phone || !password || !confirmPassword) {
        alert('Please fill in all fields.');
        return;
    }

    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return;
    }

    if (password.length < 6) {
        alert('Password must be at least 6 characters long.');
        return;
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        return;
    }

    // Phone validation
    const phoneRegex = /^[\d\-\+\(\)\s]+$/;
    if (!phoneRegex.test(phone) || phone.length < 10) {
        alert('Please enter a valid phone number.');
        return;
    }

    // Check if user already exists
    if (registeredUsers.find(u => u.email === email)) {
        alert('User with this email already exists. Please login instead.');
        return;
    }

    // Create new user
    const newUser = {
        name: name,
        email: email,
        phone: phone,
        password: password,
        registrationTime: new Date().toISOString()
    };

    // Add to registered users
    registeredUsers.push(newUser);
    userData = newUser;

    closeModal('signupModal');
    
    // Reset cart to zero
    resetCart();
    
    // Store user data in sessionStorage
    sessionStorage.setItem('userData', JSON.stringify(newUser));
    
    // Update top navigation immediately
    updateTopNavigation(newUser, 'user');
    
    alert(`Welcome, ${name}! Your account has been created successfully. Redirecting to dashboard...`);
    
    setTimeout(() => {
        window.location.href = 'welcome.php';
    }, 1000);
}

// UPDATED: Handle seller login - resets cart and redirects to welcome.php
function handleSellerLogin(event) {
    event.preventDefault();
    
    const name = document.getElementById('sellerName').value;
    const email = document.getElementById('sellerEmail').value;
    const phone = document.getElementById('sellerPhone').value;
    const code = document.getElementById('sellerCode').value;

    // Validate seller code
    if (code !== SELLER_CODE) {
        alert('Invalid seller code. Please contact administration for the correct code.');
        return;
    }

    // Basic validation
    if (!name || !email || !phone || !code) {
        alert('Please fill in all fields.');
        return;
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        return;
    }

    // Phone validation
    const phoneRegex = /^[\d\-\+\(\)\s]+$/;
    if (!phoneRegex.test(phone) || phone.length < 10) {
        alert('Please enter a valid phone number.');
        return;
    }

    // Store seller data
    const sellerData = {
        name: name,
        email: email,
        phone: phone,
        code: code,
        type: 'seller',
        loginTime: new Date().toISOString()
    };

    closeModal('sellerModal');
    
    // Reset cart to zero
    resetCart();
    
    // Store seller data and update navigation
    sessionStorage.setItem('sellerData', JSON.stringify(sellerData));
    userData = sellerData;
    updateTopNavigation(sellerData, 'seller');
    
    alert(`Welcome ${name}! Redirecting to seller dashboard...`);
    
    setTimeout(() => {
        window.location.href = 'welcome.php';
    }, 1000);
}

// UPDATED: Handle dealer login - resets cart and redirects to welcome.php
function handleDealerLogin(event) {
    event.preventDefault();
    
    const name = document.getElementById('dealerName').value;
    const email = document.getElementById('dealerEmail').value;
    const phone = document.getElementById('dealerPhone').value;
    const code = document.getElementById('dealerCode').value;

    // Validate dealer code
    if (code !== DEALER_CODE) {
        alert('Invalid dealer code. Please contact administration for the correct code.');
        return;
    }

    // Basic validation
    if (!name || !email || !phone || !code) {
        alert('Please fill in all fields.');
        return;
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        return;
    }

    // Phone validation
    const phoneRegex = /^[\d\-\+\(\)\s]+$/;
    if (!phoneRegex.test(phone) || phone.length < 10) {
        alert('Please enter a valid phone number.');
        return;
    }

    // Store dealer data
    const dealerData = {
        name: name,
        email: email,
        phone: phone,
        code: code,
        type: 'dealer',
        loginTime: new Date().toISOString()
    };

    closeModal('dealerModal');
    
    // Reset cart to zero
    resetCart();
    
    // Store dealer data and update navigation
    sessionStorage.setItem('dealerData', JSON.stringify(dealerData));
    userData = dealerData;
    updateTopNavigation(dealerData, 'dealer');
    
    alert(`Welcome ${name}! Redirecting to dealer dashboard...`);
    
    setTimeout(() => {
        window.location.href = 'welcome.php';
    }, 1000);
}

// Global function to protect any page functionality
function protectPageFunction(functionName, callback) {
    if (!isUserLoggedIn()) {
        showLoginRequiredMessage();
        return false;
    }
    
    if (typeof callback === 'function') {
        callback();
    }
    return true;
}

// Function to add authentication protection to any element
function addAuthProtection(elementSelector, originalFunction) {
    const element = document.querySelector(elementSelector);
    if (element) {
        element.addEventListener('click', function(e) {
            if (!isUserLoggedIn()) {
                e.preventDefault();
                e.stopPropagation();
                showLoginRequiredMessage();
                return false;
            }
            // If user is logged in, execute original function
            if (typeof originalFunction === 'function') {
                originalFunction();
            }
        });
    }
}

// Enhanced event listeners that work on any page
document.addEventListener('DOMContentLoaded', function() {
    // Initialize user login on any page
    initializeUserLogin();
    
    // Add event listeners for modal close if they exist
    const modals = ['loginModal', 'signupModal', 'sellerModal', 'dealerModal'];
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        modals.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (modal && event.target === modal) {
                closeModal(modalId);
            }
        });
    }
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && modal.style.display === 'block') {
                    closeModal(modalId);
                }
            });
        }
    });
    
    // IMPROVED: Allow header functionality regardless of login status
    function setupHeaderProtection() {
        // Allow header elements to work without login requirement
        const allowedHeaderElements = [
            '.header',
            '.navbar',
            '.nav',
            '.navigation',
            '.user-login',
            '.user-dropdown',
            '.user-dropdown-content',
            '.user-dropdown-content a',
            '.logo',
            '.menu',
            '.nav-links',
            '.nav-item',
            '.nav-link',
            'nav',
            'header'
        ];
        
        // Block interactions but allow header elements
        document.addEventListener('click', function(e) {
            if (!isUserLoggedIn()) {
                // Check if click is on allowed elements
                const allowedElements = [
                    'button[onclick*="openLoginModal"]',
                    'button[onclick*="openSignupModal"]',
                    'button[onclick*="openSellerModal"]',
                    'button[onclick*="openDealerModal"]',
                    'button[onclick*="redirectToWelcome"]',
                    '#loginModal',
                    '#signupModal',
                    '#sellerModal',
                    '#dealerModal',
                    '#loginModal *',
                    '#signupModal *',
                    '#sellerModal *',
                    '#dealerModal *',
                    ...allowedHeaderElements
                ];
                
                let isAllowed = false;
                allowedElements.forEach(selector => {
                    if (e.target.matches(selector) || e.target.closest(selector)) {
                        isAllowed = true;
                    }
                });
                
                if (!isAllowed) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    showLoginRequiredMessage();
                    return false;
                }
            }
        }, true);
    }
    
    // Initialize header protection
    setupHeaderProtection();
    
    // Re-initialize after dynamic content changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                setupHeaderProtection();
            }
        });
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all functionality when DOM is loaded
    initializeNavigation();
    initializeUserLogin();
    initializeMobileMenu();
    initializeSlider();
    initializeCart();
});

function initializeNavigation() {
    // For Products dropdown
    const dropdown = document.querySelector('.dropdown');
    const dropdownContent = document.querySelector('.dropdown-content');
    
    // For User dropdown
    const userDropdown = document.querySelector('.user-dropdown');
    const userDropdownContent = document.querySelector('.user-dropdown-content');
    
    // Timeout variables for delayed hiding
    let dropdownTimeout;
    let userDropdownTimeout;
    
    if (dropdown && dropdownContent) {
        // Products dropdown hover handlers
        dropdown.addEventListener('mouseenter', function() {
            clearTimeout(dropdownTimeout);
            dropdownContent.style.display = 'block';
        });
        
        dropdown.addEventListener('mouseleave', function() {
            dropdownTimeout = setTimeout(function() {
                dropdownContent.style.display = 'none';
            }, 300); // 300ms delay before hiding
        });
        
        // Keep dropdown open when hovering over dropdown content
        dropdownContent.addEventListener('mouseenter', function() {
            clearTimeout(dropdownTimeout);
            dropdownContent.style.display = 'block';
        });
        
        dropdownContent.addEventListener('mouseleave', function() {
            dropdownTimeout = setTimeout(function() {
                dropdownContent.style.display = 'none';
            }, 300);
        });
    }
    
    if (userDropdown && userDropdownContent) {
        // User dropdown hover handlers
        userDropdown.addEventListener('mouseenter', function() {
            clearTimeout(userDropdownTimeout);
            userDropdownContent.style.display = 'block';
        });
        
        userDropdown.addEventListener('mouseleave', function() {
            userDropdownTimeout = setTimeout(function() {
                userDropdownContent.style.display = 'none';
            }, 300); // 300ms delay before hiding
        });
        
        // Keep dropdown open when hovering over dropdown content
        userDropdownContent.addEventListener('mouseenter', function() {
            clearTimeout(userDropdownTimeout);
            userDropdownContent.style.display = 'block';
        });
        
        userDropdownContent.addEventListener('mouseleave', function() {
            userDropdownTimeout = setTimeout(function() {
                userDropdownContent.style.display = 'none';
            }, 300);
        });
    }
    
    // Header scroll effect
    const header = document.getElementById('header');
    if (header) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }
    
    // Handle dropdowns in mobile mode
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', toggleDropdown);
    });
    
    // Close dropdowns when clicking outside (works for both mobile and desktop)
    document.addEventListener('click', function(e) {
        // Check all dropdown elements
        const allDropdowns = document.querySelectorAll('.dropdown, .user-dropdown');
        
        allDropdowns.forEach(dropdown => {
            const dropdownContent = dropdown.querySelector('.dropdown-content') || 
                                  dropdown.querySelector('.user-dropdown-content');
            
            if (dropdownContent && !dropdown.contains(e.target)) {
                // Clear any pending timeouts
                clearTimeout(dropdownTimeout);
                clearTimeout(userDropdownTimeout);
                
                // Hide the dropdown immediately
                dropdownContent.style.display = 'none';
            }
        });
    });
}

function toggleDropdown(event) {
    // Only handle mobile clicks
    if (window.innerWidth > 768) return;
    
    event.preventDefault();
    event.stopPropagation();
    
    const dropdown = event.currentTarget;
    const dropdownContent = dropdown.querySelector(".dropdown-content");
    
    if (!dropdownContent) return;
    
    // Close all other dropdowns first
    document.querySelectorAll('.dropdown-content').forEach(content => {
        if (content !== dropdownContent) {
            content.style.display = 'none';
        }
    });
    
    // Toggle current dropdown
    dropdownContent.style.display = 
        dropdownContent.style.display === "block" ? "none" : "block";
}

function initializeDropdownSystem() {
    const dropdownElements = [
        {
            trigger: '.dropdown',
            content: '.dropdown-content',
            timeout: null
        },
        {
            trigger: '.user-dropdown',
            content: '.user-dropdown-content',
            timeout: null
        }
    ];
    
    dropdownElements.forEach(element => {
        const trigger = document.querySelector(element.trigger);
        const content = document.querySelector(element.content);
        
        if (trigger && content) {
            // Show dropdown on hover
            trigger.addEventListener('mouseenter', () => {
                clearTimeout(element.timeout);
                content.style.display = 'block';
            });
            
            // Hide dropdown with delay when leaving trigger
            trigger.addEventListener('mouseleave', () => {
                element.timeout = setTimeout(() => {
                    content.style.display = 'none';
                }, 300);
            });
            
            // Keep dropdown open when hovering over content
            content.addEventListener('mouseenter', () => {
                clearTimeout(element.timeout);
            });
            
            // Hide dropdown when leaving content
            content.addEventListener('mouseleave', () => {
                element.timeout = setTimeout(() => {
                    content.style.display = 'none';
                }, 300);
            });
        }
    });
    
    // Global click handler to close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        dropdownElements.forEach(element => {
            const trigger = document.querySelector(element.trigger);
            const content = document.querySelector(element.content);
            
            if (trigger && content && !trigger.contains(e.target)) {
                // Clear timeout and hide dropdown immediately
                clearTimeout(element.timeout);
                content.style.display = 'none';
            }
        });
    });
}
// Mobile dropdown toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const mobileDropbtn = document.querySelector('.mobile-dropbtn');
    const mobileDropdownContent = document.querySelector('.mobile-dropdown-content');
    const mobileDropdown = document.querySelector('.mobile-dropdown');

    // Toggle dropdown on button click
    mobileDropbtn.addEventListener('click', function(e) {
        e.preventDefault();
        mobileDropdownContent.classList.toggle('show');
        
        // Toggle chevron icon direction
        const chevron = mobileDropbtn.querySelector('.fas.fa-chevron-down');
        if (mobileDropdownContent.classList.contains('show')) {
            chevron.classList.remove('fa-chevron-down');
            chevron.classList.add('fa-chevron-up');
        } else {
            chevron.classList.remove('fa-chevron-up');
            chevron.classList.add('fa-chevron-down');
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!mobileDropdown.contains(e.target)) {
            mobileDropdownContent.classList.remove('show');
            const chevron = mobileDropbtn.querySelector('.fas');
            chevron.classList.remove('fa-chevron-up');
            chevron.classList.add('fa-chevron-down');
        }
    });

    // Close dropdown when clicking on a dropdown item
    const dropdownItems = mobileDropdownContent.querySelectorAll('a');
    dropdownItems.forEach(item => {
        item.addEventListener('click', function() {
            mobileDropdownContent.classList.remove('show');
            const chevron = mobileDropbtn.querySelector('.fas');
            chevron.classList.remove('fa-chevron-up');
            chevron.classList.add('fa-chevron-down');
        });
    });
});

// Filter products function (if needed for your existing functionality)
function filterProducts(brand) {
    // Add your product filtering logic here
    console.log('Filtering products for:', brand);
    // Example: hide/show products based on brand
    // You can customize this based on your needs
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
// ===================================================================
// USER SESSION MANAGER - Cross-Page Authentication System
// Include this file in all your HTML pages before other scripts
// ===================================================================

// Configuration Constants
const USER_SESSION_CONFIG = {
    STORAGE_KEYS: {
        CURRENT_USER: 'currentUser',
        CURRENT_EMAIL: 'currentUserEmail', 
        REGISTERED_USERS: 'registeredUsers',
        USER_VISITS: 'userVisits',
        SESSION_DATA: 'userData',
        SELLER_DATA: 'sellerData',
        DEALER_DATA: 'dealerData'
    }
};

// Global variables for user session
let globalUserData = null;
let globalCurrentUserEmail = null;
let globalRegisteredUsers = [];

// ===================================================================
// STORAGE UTILITY FUNCTIONS
// ===================================================================

function getFromStorage(key, defaultValue = null) {
    try {
        const item = localStorage.getItem(key);
        return item ? JSON.parse(item) : defaultValue;
    } catch (e) {
        console.error(`Error reading ${key} from storage:`, e);
        return defaultValue;
    }
}

function setToStorage(key, value) {
    try {
        localStorage.setItem(key, JSON.stringify(value));
        return true;
    } catch (e) {
        console.error(`Error saving ${key} to storage:`, e);
        return false;
    }
}

function removeFromStorage(key) {
    try {
        localStorage.removeItem(key);
        sessionStorage.removeItem(key);
        return true;
    } catch (e) {
        console.error(`Error removing ${key} from storage:`, e);
        return false;
    }
}

// ===================================================================
// USER VISIT TRACKING FUNCTIONS
// ===================================================================

function isReturningUser(email) {
    if (!email) return false;
    
    const userVisits = getFromStorage(USER_SESSION_CONFIG.STORAGE_KEYS.USER_VISITS, {});
    return userVisits.hasOwnProperty(email.toLowerCase());
}

function markUserAsVisited(email) {
    if (!email) return;
    
    const normalizedEmail = email.toLowerCase();
    const userVisits = getFromStorage(USER_SESSION_CONFIG.STORAGE_KEYS.USER_VISITS, {});
    
    userVisits[normalizedEmail] = {
        firstVisit: userVisits[normalizedEmail]?.firstVisit || new Date().toISOString(),
        lastVisit: new Date().toISOString(),
        visitCount: (userVisits[normalizedEmail]?.visitCount || 0) + 1
    };
    
    setToStorage(USER_SESSION_CONFIG.STORAGE_KEYS.USER_VISITS, userVisits);
    console.log(`User visit tracked for: ${email}`);
}

function isNewUserSession() {
    try {
        const storedEmail = localStorage.getItem(USER_SESSION_CONFIG.STORAGE_KEYS.CURRENT_EMAIL);
        const currentEmail = globalUserData?.email;
        
        if (!currentEmail) return false;
        
        if (!storedEmail || storedEmail.toLowerCase() !== currentEmail.toLowerCase()) {
            localStorage.setItem(USER_SESSION_CONFIG.STORAGE_KEYS.CURRENT_EMAIL, currentEmail);
            return true;
        }
        
        return false;
    } catch (e) {
        console.error('Error checking new user session:', e);
        return false;
    }
}

// ===================================================================
// USER DATA MANAGEMENT FUNCTIONS
// ===================================================================

function loadRegisteredUsers() {
    console.log('Loading registered users from storage...');
    
    const stored = getFromStorage(USER_SESSION_CONFIG.STORAGE_KEYS.REGISTERED_USERS, []);
    
    if (stored && Array.isArray(stored) && stored.length > 0) {
        globalRegisteredUsers = stored;
        console.log(`Loaded ${globalRegisteredUsers.length} registered users from storage`);
    } else {
        // Initialize with empty array if no users found
        globalRegisteredUsers = [];
        console.log('No registered users found, initialized empty array');
    }
    
    return globalRegisteredUsers;
}

function saveRegisteredUsers() {
    if (!Array.isArray(globalRegisteredUsers)) {
        console.error('globalRegisteredUsers is not an array, cannot save');
        return false;
    }
    
    const success = setToStorage(USER_SESSION_CONFIG.STORAGE_KEYS.REGISTERED_USERS, globalRegisteredUsers);
    if (success) {
        console.log(`Successfully saved ${globalRegisteredUsers.length} users to storage`);
    }
    return success;
}

function findUserByEmail(email) {
    if (!email || !Array.isArray(globalRegisteredUsers)) return null;
    
    return globalRegisteredUsers.find(user => 
        user.email.toLowerCase() === email.toLowerCase()
    );
}

function isEmailRegistered(email) {
    return findUserByEmail(email) !== null;
}

// ===================================================================
// SESSION MANAGEMENT FUNCTIONS
// ===================================================================

function initializeUserSession() {
    console.log('Initializing user session...');
    
    // Load registered users first
    loadRegisteredUsers();
    
    // Check for persistent login in localStorage
    let storedUserData = getFromStorage(USER_SESSION_CONFIG.STORAGE_KEYS.CURRENT_USER);
    let userType = 'customer';
    
    // If no persistent login, check session storage for temporary sessions
    if (!storedUserData) {
        const sessionUserData = sessionStorage.getItem(USER_SESSION_CONFIG.STORAGE_KEYS.SESSION_DATA);
        const sessionSellerData = sessionStorage.getItem(USER_SESSION_CONFIG.STORAGE_KEYS.SELLER_DATA);
        const sessionDealerData = sessionStorage.getItem(USER_SESSION_CONFIG.STORAGE_KEYS.DEALER_DATA);
        
        if (sessionUserData) {
            try {
                storedUserData = JSON.parse(sessionUserData);
                userType = 'customer';
            } catch (e) {
                console.error('Error parsing session user data:', e);
            }
        } else if (sessionSellerData) {
            try {
                storedUserData = JSON.parse(sessionSellerData);
                userType = 'seller';
            } catch (e) {
                console.error('Error parsing session seller data:', e);
            }
        } else if (sessionDealerData) {
            try {
                storedUserData = JSON.parse(sessionDealerData);
                userType = 'dealer';
            } catch (e) {
                console.error('Error parsing session dealer data:', e);
            }
        }
    }
    
    // Initialize user if valid session found
    if (storedUserData && storedUserData.name && (storedUserData.email || userType === 'seller')) {
        globalUserData = storedUserData;
        globalCurrentUserEmail = storedUserData.email;
        
        console.log(`${userType} session initialized:`, storedUserData.name);
        
        // Update UI if elements exist
        updateUserInterface(userType);
        
        // Track user visit for customers
        if (userType === 'customer' && storedUserData.email) {
            markUserAsVisited(storedUserData.email);
        }
        
        return {
            isLoggedIn: true,
            user: storedUserData,
            userType: userType,
            isReturning: userType === 'customer' ? isReturningUser(storedUserData.email) : false
        };
    } else {
        console.log('No valid user session found');
        return {
            isLoggedIn: false,
            user: null,
            userType: null,
            isReturning: false
        };
    }
}

function updateUserInterface(userType = 'customer') {
    if (!globalUserData) return;
    
    const firstName = globalUserData.name.split(' ')[0];
    const userNameElement = document.getElementById('userName');
    
    if (userNameElement) {
        let welcomeText = `Hi ${firstName}!`;
        
        if (userType === 'customer') {
            const isReturning = isReturningUser(globalUserData.email);
            welcomeText = isReturning ? `Welcome back, ${firstName}!` : `Hi ${firstName}!`;
        } else if (userType === 'seller') {
            welcomeText = `Hi ${firstName} (Seller)!`;
        } else if (userType === 'dealer') {
            welcomeText = `Hi ${firstName} (Dealer)!`;
        }
        
        userNameElement.textContent = welcomeText;
    }
    
    const userWelcomeDiv = document.getElementById('userWelcome');
    if (userWelcomeDiv) {
        userWelcomeDiv.style.display = 'block';
    }
    
    // Update buttons if function exists
    if (typeof updateButtonsForLoggedInUser === 'function') {
        updateButtonsForLoggedInUser();
    }
}

function loginUser(userData, userType = 'customer', persistent = false) {
    console.log(`Logging in user: ${userData.name} as ${userType}`);
    
    globalUserData = userData;
    globalCurrentUserEmail = userData.email;
    
    // Always store in sessionStorage for temporary session
    if (userType === 'customer') {
        sessionStorage.setItem(USER_SESSION_CONFIG.STORAGE_KEYS.SESSION_DATA, JSON.stringify(userData));
    } else if (userType === 'seller') {
        sessionStorage.setItem(USER_SESSION_CONFIG.STORAGE_KEYS.SELLER_DATA, JSON.stringify(userData));
    } else if (userType === 'dealer') {
        sessionStorage.setItem(USER_SESSION_CONFIG.STORAGE_KEYS.DEALER_DATA, JSON.stringify(userData));
    }
    
    // Store in localStorage for persistent login if requested
    if (persistent) {
        setToStorage(USER_SESSION_CONFIG.STORAGE_KEYS.CURRENT_USER, userData);
        localStorage.setItem(USER_SESSION_CONFIG.STORAGE_KEYS.CURRENT_EMAIL, userData.email);
    }
    
    // Track user visit for customers
    if (userType === 'customer' && userData.email) {
        markUserAsVisited(userData.email);
    }
    
    // Update UI
    updateUserInterface(userType);
    
    return true;
}

function logoutUser() {
    console.log('Logging out user...');
    
    // Clear all user data
    globalUserData = null;
    globalCurrentUserEmail = null;
    
    // Clear storage
    removeFromStorage(USER_SESSION_CONFIG.STORAGE_KEYS.CURRENT_USER);
    removeFromStorage(USER_SESSION_CONFIG.STORAGE_KEYS.CURRENT_EMAIL);
    removeFromStorage(USER_SESSION_CONFIG.STORAGE_KEYS.SESSION_DATA);
    removeFromStorage(USER_SESSION_CONFIG.STORAGE_KEYS.SELLER_DATA);
    removeFromStorage(USER_SESSION_CONFIG.STORAGE_KEYS.DEALER_DATA);
    
    // Reset UI
    const userWelcomeDiv = document.getElementById('userWelcome');
    if (userWelcomeDiv) {
        userWelcomeDiv.style.display = 'none';
    }
    
    const userNameElement = document.getElementById('userName');
    if (userNameElement) {
        userNameElement.textContent = '';
    }
    
    console.log('User logged out successfully');
    return true;
}

// ===================================================================
// USER REGISTRATION FUNCTIONS
// ===================================================================

function registerNewUser(name, email, phone, password) {
    console.log('Registering new user:', { name, email: email.toLowerCase() });
    
    // Check if user already exists (case-insensitive)
    if (isEmailRegistered(email)) {
        console.log('User already exists with email:', email);
        return {
            success: false,
            message: 'User with this email already exists.',
            userExists: true
        };
    }
    
    const newUser = {
        name: name.trim(),
        email: email.toLowerCase().trim(),
        phone: phone.trim(),
        password: password,
        registrationTime: new Date().toISOString()
    };
    
    // Add to registered users array
    globalRegisteredUsers.push(newUser);
    
    // Save to storage
    const saveSuccess = saveRegisteredUsers();
    
    if (saveSuccess) {
        console.log('New user registered successfully:', newUser.name);
        return {
            success: true,
            message: 'User registered successfully.',
            user: newUser
        };
    } else {
        // Remove from array if save failed
        globalRegisteredUsers.pop();
        return {
            success: false,
            message: 'Failed to save user data.',
            userExists: false
        };
    }
}

// ===================================================================
// PUBLIC API FUNCTIONS
// ===================================================================

// Get current user information
function getCurrentUser() {
    return {
        isLoggedIn: globalUserData !== null,
        userData: globalUserData,
        email: globalCurrentUserEmail,
        isReturning: globalUserData ? isReturningUser(globalUserData.email) : false,
        isNewSession: isNewUserSession()
    };
}

// Check if current user is of specific type
function isUserType(type) {
    if (!globalUserData) return false;
    
    const sessionSellerData = sessionStorage.getItem(USER_SESSION_CONFIG.STORAGE_KEYS.SELLER_DATA);
    const sessionDealerData = sessionStorage.getItem(USER_SESSION_CONFIG.STORAGE_KEYS.DEALER_DATA);
    
    switch (type) {
        case 'customer':
            return !sessionSellerData && !sessionDealerData;
        case 'seller':
            return sessionSellerData !== null;
        case 'dealer':
            return sessionDealerData !== null;
        default:
            return false;
    }
}

// Redirect to login page if not authenticated
function requireAuthentication(redirectUrl = 'login.php') {
    const currentUser = getCurrentUser();
    if (!currentUser.isLoggedIn) {
        console.log('Authentication required, redirecting to:', redirectUrl);
        window.location.href = redirectUrl;
        return false;
    }
    return true;
}

// Get user statistics
function getUserStats() {
    const userVisits = getFromStorage(USER_SESSION_CONFIG.STORAGE_KEYS.USER_VISITS, {});
    const totalUsers = globalRegisteredUsers.length;
    const totalVisits = Object.keys(userVisits).length;
    
    return {
        totalRegisteredUsers: totalUsers,
        totalUniqueVisitors: totalVisits,
        currentUser: getCurrentUser()
    };
}

// ===================================================================
// INITIALIZATION AND EVENT LISTENERS
// ===================================================================

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('User Session Manager: DOM Content Loaded - Initializing...');
    
    try {
        const sessionInfo = initializeUserSession();
        console.log('User session initialized:', sessionInfo);
        
        // Dispatch custom event for other scripts to listen to
        window.dispatchEvent(new CustomEvent('userSessionInitialized', {
            detail: sessionInfo
        }));
        
    } catch (error) {
        console.error('Error during user session initialization:', error);
    }
});

// Backup initialization
window.addEventListener('load', function() {
    console.log('User Session Manager: Window loaded - Backup initialization...');
    
    setTimeout(() => {
        try {
            if (!globalUserData) {
                console.log('User data not found, reinitializing...');
                initializeUserSession();
            }
        } catch (error) {
            console.error('Error during backup initialization:', error);
        }
    }, 500);
});

// Handle page visibility change to refresh session
document.addEventListener('visibilitychange', function() {
    if (!document.hidden && globalUserData) {
        // Page became visible, refresh session if needed
        console.log('Page became visible, refreshing user session...');
        updateUserInterface(isUserType('seller') ? 'seller' : isUserType('dealer') ? 'dealer' : 'customer');
    }
});

// ===================================================================
// GLOBAL EXPORTS - Make functions available globally
// ===================================================================

// Make functions available globally
window.UserSessionManager = {
    // Core functions
    getCurrentUser,
    loginUser,
    logoutUser,
    registerNewUser,
    
    // User type checking
    isUserType,
    requireAuthentication,
    
    // User tracking
    isReturningUser,
    markUserAsVisited,
    isNewUserSession,
    
    // Data management
    findUserByEmail,
    isEmailRegistered,
    loadRegisteredUsers,
    
    // Statistics
    getUserStats,
    
    // Storage utilities
    getFromStorage,
    setToStorage,
    removeFromStorage,
    
    // Manual initialization
    initializeUserSession,
    updateUserInterface
};

// Legacy support - keep original function names available
window.getCurrentUserInfo = getCurrentUser;
window.isReturningUser = isReturningUser;
window.markUserAsVisited = markUserAsVisited;
window.isNewUserSession = isNewUserSession;

console.log('User Session Manager loaded successfully');
</script>
</body>
</html>