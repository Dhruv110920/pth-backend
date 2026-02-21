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
      background-color: #ffffff;
      color: #000000;
      line-height: 1.6;
    }

    /* Header - White background with red accents */ 
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 50px;
      background-color: #ffffff;  
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 4px 15px rgba(255, 0, 0, 0.2);
      border-bottom: 1px solid rgba(255, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .header.scrolled {
      padding: 8px 50px;
      box-shadow: 0 2px 10px rgba(255, 0, 0, 0.3);
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
      filter: drop-shadow(0 2px 4px rgba(255, 0, 0, 0.3));
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
      color: #000000;
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
      box-shadow: 0 1px 3px rgba(255, 0, 0, 0.5);
    }

    .nav-links a:hover {
      color: red;
      text-shadow: 0 1px 3px rgba(255, 0, 0, 0.3);
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
      background-color: #ffffff;
      color: #000000;
    }

    .search-input:focus {
      border-color: red;
      box-shadow: 0 0 0 3px rgba(255, 0, 0, 0.2), 0 4px 8px rgba(255, 0, 0, 0.1);
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
      box-shadow: 0 2px 6px rgba(255, 0, 0, 0.4);
    }

    .search-btn:hover {
      background: #cc0000;
      transform: scale(1.05);
      box-shadow: 0 4px 12px rgba(255, 0, 0, 0.5);
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
      box-shadow: 0 4px 6px rgba(255, 0, 0, 0.1);
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
      background-color: #ffffff;
    }

    .search-item:hover {
      background-color: rgba(255, 0, 0, 0.05);
      padding-left: 20px;
      box-shadow: inset 3px 0 0 red;
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
      color: #000000;
      font-weight: 500;
    }

    .search-item-price {
      color: red;
      font-weight: bold;
      margin-left: auto;
      text-shadow: 0 1px 2px rgba(255, 0, 0, 0.2);
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
      background-color: rgba(255, 0, 0, 0.05);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(255, 0, 0, 0.3);
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
      box-shadow: 0 2px 4px rgba(255, 0, 0, 0.4);
    }

    /* Cart Modal Styles */
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
      box-shadow: 0 20px 40px rgba(255, 0, 0, 0.3);
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
      box-shadow: 0 2px 10px rgba(255, 0, 0, 0.3);
    }

    .cart-header h2 {
      font-size: 24px;
      font-weight: 600;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
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
      background-color: #ffffff;
    }

    .cart-item {
      display: flex;
      align-items: center;
      gap: 20px;
      padding: 20px 0;
      border-bottom: 1px solid #eee;
      transition: all 0.3s ease;
      background-color: #ffffff;
    }

    .cart-item:hover {
      background: rgba(255,0,0,0.02);
      border-radius: 10px;
      padding: 20px 15px;
      box-shadow: 0 2px 8px rgba(255, 0, 0, 0.1);
    }

    .cart-item:last-child {
      border-bottom: none;
    }

    .cart-item-image {
      width: 80px;
      height: 80px;
      background: #ffffff;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      border: 2px solid rgba(255, 0, 0, 0.1);
      flex-shrink: 0;
      box-shadow: 0 2px 4px rgba(255, 0, 0, 0.1);
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
      color: #000000;
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
      text-shadow: 0 1px 2px rgba(255, 0, 0, 0.2);
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
      background: #ffffff;
      border: 1px solid rgba(255, 0, 0, 0.2);
      border-radius: 25px;
      padding: 5px;
      box-shadow: 0 2px 4px rgba(255, 0, 0, 0.1);
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
      box-shadow: 0 2px 4px rgba(255, 0, 0, 0.1);
    }

    .quantity-btn:hover {
      background: red;
      color: white;
      transform: scale(1.1);
      box-shadow: 0 4px 8px rgba(255, 0, 0, 0.3);
    }

    .quantity-display {
      min-width: 30px;
      text-align: center;
      font-weight: 600;
      color: #000000;
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
      box-shadow: 0 2px 4px rgba(255, 0, 0, 0.2);
    }

    .cart-total {
      padding: 25px;
      border-top: 2px solid #f0f0f0;
      background: #ffffff;
      text-align: center;
      box-shadow: 0 -2px 10px rgba(255, 0, 0, 0.1);
    }

    .cart-total-amount {
      font-size: 28px;
      font-weight: bold;
      color: red;
      margin-bottom: 20px;
      text-shadow: 0 2px 4px rgba(255, 0, 0, 0.2);
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
      box-shadow: 0 4px 15px rgba(255, 0, 0, 0.3);
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .checkout-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(255, 0, 0, 0.4);
    }

     /* Company Sidebar Styles */
        .company-sidebar {
            position: fixed;
            left: -250px;
            top: 50%;
            transform: translateY(-50%);
            width: 200px;
            background: white;
            border-radius: 0 15px 15px 0;
            box-shadow: 2px 0 15px rgba(255, 0, 0, 0.2);
            padding: 20px 10px;
            z-index: 999;
            transition: all 0.5s ease;
            border: 1px solid rgba(255, 0, 0, 0.1);
        }

        .company-sidebar.show {
            left: 0;
        }

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
            box-shadow: 2px 0 8px rgba(255, 0, 0, 0.3);
        }

        .sidebar-toggle:hover {
            background: #c82333;
            box-shadow: 4px 0 12px rgba(255, 0, 0, 0.4);
        }

        .company-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 0, 0, 0.1);
            text-decoration: none;
            color: inherit;
            background-color: #ffffff;
        }

        .company-item:hover {
            background: rgba(220, 53, 69, 0.05);
            border-color: #dc3545;
            transform: translateX(5px);
            text-decoration: none;
            color: inherit;
            box-shadow: 0 2px 8px rgba(255, 0, 0, 0.2);
        }

        .company-logo {
            width: 40px;
            height: 40px;
            background: #ffffff;
            border: 1px solid rgba(255, 0, 0, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #666;
            font-size: 12px;
            box-shadow: 0 2px 4px rgba(255, 0, 0, 0.1);
        }

        .company-name {
            font-weight: 500;
            color: #000000;
            font-size: 14px;
        }

        @media (min-width: 768px) {
            .main-content {
                transition: margin-left 0.5s ease;
            }
            
            body.sidebar-open .main-content {
                margin-left: 200px;
            }
        }

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
  color: #000000;
  box-shadow: 0 2px 4px rgba(255, 0, 0, 0.1);
}

.search-bar input[type="text"]:focus {
  box-shadow: 0 0 0 3px rgba(255, 0, 0, 0.2), 0 2px 4px rgba(255, 0, 0, 0.1);
}

.search-bar button {
  background: red;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 0 25px 25px 0;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 2px 4px rgba(255, 0, 0, 0.3);
}

.search-bar button:hover {
  background: #cc0000;
  box-shadow: 0 4px 8px rgba(255, 0, 0, 0.4);
}

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
  color: #000000;
  transition: all 0.3s ease;
  position: relative;
  z-index: 21000;
}

.menu-toggle:hover {
  color: red;
  transform: scale(1.1);
  text-shadow: 0 2px 4px rgba(255, 0, 0, 0.3);
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
  box-shadow: 2px 0 15px rgba(255, 0, 0, 0.3);
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding: 80px 25px;
  transform: translateX(-100%);
  transition: transform 0.5s cubic-bezier(0.4, 0.0, 0.2, 1);
  z-index: 2000;
  overflow-y: auto;
  border-right: 2px solid rgba(255, 0, 0, 0.2);
}

.mobile-nav a {
  text-decoration: none;
  color: #000000;
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
  text-shadow: 0 1px 3px rgba(255, 0, 0, 0.3);
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

body.mobile-nav-open {
  overflow: hidden;
  position: fixed;
  width: 100%;
}

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
  color: #000000;
}

.mobile-dropdown-content {
  display: none;
  background-color: rgba(255, 0, 0, 0.05);
  padding-left: 20px;
  max-height: 200px;
  overflow-y: auto;
  border-radius: 4px;
  margin: 5px 0;
  border: 1px solid rgba(255, 0, 0, 0.1);
}

.mobile-dropdown-content::-webkit-scrollbar {
  width: 4px;
}

.mobile-dropdown-content::-webkit-scrollbar-track {
  background: rgba(255, 0, 0, 0.1);
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
  border-bottom: 1px solid rgba(255, 0, 0, 0.1);
  color: #000000;
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
  color: #000000;
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
  text-shadow: 0 1px 3px rgba(255, 0, 0, 0.3);
}

.dropdown:hover .dropbtn::after {
  transform: rotate(180deg);
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 180px;
  max-height: 300px;
  overflow-y: auto;
  box-shadow: 0px 4px 8px rgba(255, 0, 0, 0.2);
  z-index: 1000;
  top: 100%;
  left: 0;
  border-radius: 5px;
  margin-top: 10px;
  padding-top: 8px;
  border: 1px solid rgba(255, 0, 0, 0.1);
}

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
  color: #000000;
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
  text-shadow: 0 1px 2px rgba(255, 0, 0, 0.2);
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
  box-shadow: 0 1px 3px rgba(255, 0, 0, 0.5);
}

.dropdown:hover .dropbtn:before {
  width: 100%;
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
      box-shadow: 0 4px 15px rgba(255, 0, 0, 0.2);
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
      box-shadow: 0 4px 12px rgba(255, 0, 0, 0.3);
    }

    .hero-cta:hover {
      background: #cc0000;
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(255, 0, 0, 0.4);
    }

    /* Footer */
    footer {
      background-color: #222;
      padding: 60px 50px;
      color: #eee;
      box-shadow: 0 -4px 15px rgba(255, 0, 0, 0.15);
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
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(255, 0, 0, 0.1);
      background: rgba(255, 255, 255, 0.02);
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
      box-shadow: 0 2px 8px rgba(255, 0, 0, 0.1);
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
      box-shadow: 0 4px 12px rgba(255, 0, 0, 0.3);
    }

    .footer-form button:hover {
      background-color: #cc0000;
      box-shadow: 0 6px 16px rgba(255, 0, 0, 0.4);
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
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(255, 0, 0, 0.1);
      background: rgba(255, 255, 255, 0.9);
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
        box-shadow: 0 4px 12px rgba(255, 0, 0, 0.2);
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

       /* Hero Section - High Density Fix */
.hero-container {
  width: 100%;
  height: 80vh;
  max-height: 800px;
  margin-top: 0;
  overflow: hidden;
  position: relative;
  animation: fadeIn 1.5s ease-in;
  box-shadow: 0 8px 25px rgba(255, 0, 0, 0.2);
}

.hero-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 10s ease, filter 0.5s ease;
  filter: brightness(0.9) contrast(1.1) saturate(1.05);
  /* High-density rendering fixes */
  image-rendering: -webkit-optimize-contrast;
  image-rendering: crisp-edges;
  image-rendering: pixelated;
  image-rendering: high-quality;
  /* Prevent blurriness during scaling */
  transform: translateZ(0);
  backface-visibility: hidden;
  /* GPU acceleration for smoother rendering */
  will-change: transform, filter;
}

.hero-container:hover .hero-image {
  transform: scale(1.05) translateZ(0); /* Reduced scale to maintain quality */
  filter: brightness(1) contrast(1.1) saturate(1.05);
}

.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, white 0%, rgba(211, 47, 47, 0.4) 100%);
  background-size: 200% 200%;
  animation: gradientFlow 15s ease infinite;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  color: var(--light-color);
  text-align: center;
  padding: 0 20px;
  /* Prevent overlay from affecting image quality */
  pointer-events: none;
}

.hero-overlay h1 {
  font-size: 54px;
  margin-bottom: 20px;
  text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
  animation: slideInFromTop 1s ease-out 0.5s both;
  letter-spacing: 1px;
  pointer-events: auto;
}

.hero-overlay p {
  font-size: 22px;
  max-width: 700px;
  margin-bottom: 30px;
  text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
  animation: slideInFromBottom 1s ease-out 0.8s both;
  pointer-events: auto;
}

/* Additional optimization for high-DPI displays */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .hero-image {
    image-rendering: -webkit-optimize-contrast;
    image-rendering: optimize-contrast;
  }
}

/* Keyframes for animations */
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes gradientFlow {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

@keyframes slideInFromTop {
  from {
    transform: translateY(-50px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

@keyframes slideInFromBottom {
  from {
    transform: translateY(50px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}
        
        /* About Intro Section Styles */
        .about-intro {
            padding: 60px 20px;
            background-color: var(--light-color);
        }
        
        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            align-items: center;
            justify-content: space-between;
        }
        
        .about-content {
            flex: 1;
            min-width: 300px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(255, 0, 0, 0.15);
            background: rgba(255, 255, 255, 0.95);
        }
        
        .about-content h2 {
            font-size: 36px;
            margin-bottom: 20px;
            color: var(--secondary-color);
            position: relative;
            padding-bottom: 15px;
        }
        
        .about-content h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        .about-content p {
            margin-bottom: 15px;
            line-height: 1.8;
            color: var(--text-color);
        }
        
        .about-image {
            flex: 1;
            min-width: 300px;
            box-shadow: 0 10px 30px rgba(255, 0, 0, 0.25);
            border-radius: 8px;
            overflow: hidden;
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
        }
        
        .about-image:hover {
            transform: scale(1.03) translateY(-5px);
            box-shadow: 0 15px 40px rgba(255, 0, 0, 0.35);
        }
        
        .about-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Slider Styles */
        .slider-section {
            padding: 60px 0;
            background-color: var(--bg-color);
        }
        
        .slider-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
            padding: 0 20px;
        }
        
        .slider-container h2 {
            font-size: 36px;
            margin-bottom: 30px;
            text-align: center;
            color: var(--secondary-color);
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }
        
        .slider-container h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        .slider {
            width: 100%;
            position: relative;
            height: 400px;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(255, 0, 0, 0.2);
        }
        
        .slides {
            display: flex;
            transition: transform 0.5s ease;
            height: 100%;
        }
        
        .slide {
            min-width: 100%;
            position: relative;
            height: 100%;
        }
        
        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .slide:hover img {
            transform: scale(1.05);
        }
        
        .slide-content {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 25px;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: #ffffff;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.8s forwards;
        }
        
        .slide-content h3 {
            margin-bottom: 10px;
            font-size: 24px;
            color: #ffeb3b;
        }
        
        .slide-content p {
            font-size: 16px;
            color: #f0f0f0;
        }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .slider-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            padding: 0 20px;
            z-index: 10;
        }
        
        .slider-nav button {
            background: rgba(0,0,0,0.5);
            color: var(--light-color);
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 22px;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 4px 12px rgba(255, 0, 0, 0.3);
        }
        
        .slider-nav button:hover, .slider-nav button:focus {
            background: rgba(211,47,47,0.8);
            box-shadow: 0 6px 16px rgba(255, 0, 0, 0.4);
        }
        
        .dots {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        
        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #ccc;
            margin: 0 5px;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 2px 8px rgba(255, 0, 0, 0.2);
        }
        
        .dot.active, .dot:hover {
            background: var(--primary-color);
            box-shadow: 0 4px 12px rgba(255, 0, 0, 0.4);
        }
        
        /* Footer */
footer {
background-color: black;
color: black;
padding: 60px 20px 20px;
margin-top: 50px;
}

.footer-columns {
display: flex;
flex-wrap: wrap;
justify-content: space-between;
max-width: 1200px;
margin: 0 auto;
gap: 30px;
}

.footer-column {
flex: 1;
min-width: 250px;
padding: 25px;
border-radius: 8px;
background: transparent;
}

.footer-column h4 {
font-size: 20px;
margin-bottom: 20px;
padding-bottom: 10px;
border-bottom: 2px solid var(--primary-color);
display: inline-block;
color: white;
}

.footer-column p {
margin-bottom: 15px;
font-size: 14px;
line-height: 1.6;
color: white;
}

.footer-column a {
color: white;
transition: color var(--transition-speed) ease;
}

.footer-column a:hover, .footer-column a:focus {
color: var(--primary-light);
}

.footer-info {
display: flex;
gap: 10px;
margin-bottom: 15px;
}

.footer-info i {
margin-top: 4px;
color: var(--primary-light);
}

.footer-form input,
.footer-form select,
.footer-form button {
width: 100%;
padding: 12px;
margin-bottom: 12px;
border: none;
border-radius: 4px;
transition: all var(--transition-speed) ease;
}



.footer-form input:focus,
.footer-form select:focus {
outline: 1px solid var(--primary-color);
}

.footer-form button {
background-color: red;
color: white;
cursor: pointer;
transition: all var(--transition-speed) ease;
font-weight: bold;
}

.footer-form button:hover, .footer-form button:focus {
background-color: darkred;
transform: translateY(-2px);
}

.copyright {
text-align: center;
padding-top: 30px;
margin-top: 30px;
border-top: 1px solid #333;
font-size: 14px;
color: white;
}
        /* Responsive Styles */
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }
            
            .header.scrolled {
                padding: 10px 20px;
            }
            
            .nav-links {
                display: none;
            }
            
            .action-buttons .contact-us {
                display: none;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .hero-overlay h1 {
                font-size: 36px;
            }
            
            .hero-overlay p {
                font-size: 18px;
            }
            
            .about-content h2,
            .slider-container h2 {
                font-size: 28px;
            }
            
            .footer-column {
                flex: 100%;
            }
        }
        .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #000;
    min-width: 160px;
    box-shadow: 0px 6px 16px rgba(255, 0, 0, 0.2);
    z-index: 1000;
    border-radius: 5px;
  }

  .dropdown-content a {
    color: #fff;
    padding: 10px 16px;
    text-decoration: none;
    display: block;
  }

  .dropdown-content a:hover {
    background-color: #ff0000;
    color: #fff;
  }

  .dropdown:hover .dropdown-content {
    display: block;
  }
  /* Updated dropdown styles to match header design */
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
  box-shadow: 0px 6px 20px rgba(255, 0, 0, 0.25);
  z-index: 1000;
  top: 100%;
  left: 0;
  border-radius: 5px;
  overflow: hidden;
  margin-top: 10px;
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
  box-shadow: inset 0 0 10px rgba(255, 0, 0, 0.1);
}

.dropdown:hover .dropdown-content {
  display: block;
  animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

/* Add the line under dropdown */
.dropdown .dropbtn:after {
  content: '▼';
  font-size: 10px;
  transition: transform 0.3s ease;
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
    </style>
   
</head>
<body>
    
  <!-- Header -->
<header class="header" id="header"> 
  <img src="logo.png" alt="Reflect Logo" class="logo"> 

  <nav class="nav-links">
     <a href="index.php">Home</a> 
    <a href="Aboutus.php">About Us</a>
    <div class="dropdown">
      <a href="product.php"><span class="dropbtn">Products</span></a>
      <div class="dropdown-content">
        <a href="bridgestone.php" onclick="filterProducts('bridgestone')">Bridgestone</a>
        <a href="michlen.php" onclick="filterProducts('michelin')">Michelin</a>
        <a href="ascenso.php" onclick="filterProducts('ascenso')">Ascenso</a>
        <a href="apollo.php" onclick="filterProducts('apollo')">Apollo</a>
        <a href="jk.php" onclick="filterProducts('jk')">JK</a>
      </div>
    </div>
    <a href="service.php">Services</a>
    <a href="contactus.php">Contact Us</a>
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
    <a href="index.php">Home</a>
    <a href="Aboutus.php">About Us</a>
    
    <!-- Mobile dropdown for Products -->
    <div class="mobile-dropdown">
        <a href="product.php" class="mobile-dropbtn">Products <i class="fas fa-chevron-down"></i></a>
        <div class="mobile-dropdown-content">
            <a href="bridgestone.php" onclick="filterProducts('bridgestone')">Bridgestone</a>
            <a href="michlen.php" onclick="filterProducts('michelin')">Michelin</a>
            <a href="ascenso.php" onclick="filterProducts('ascenso')">Ascenso</a>
            <a href="apollo.php" onclick="filterProducts('apollo')">Apollo</a>
            <a href="jk.php" onclick="filterProducts('jk')">JK</a>
        </div>
    </div>
    
    <a href="service.php">Services</a>
    <a href="contactus.php">Contact Us</a>
    <a href="profile.php"><i class="fas fa-user"></i> My Profile</a>
    <a href="policy.php"><i class="fas fa-user"></i> Policies</a>
    <a href="myorder.php"><i class="fas fa-shopping-bag"></i> My Orders</a>
    <a href="past-orders.php"><i class="fas fa-shopping-bag"></i> Past Orders</a>

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
</header>

    <main id="main-content">
        <!-- Hero Section -->
        <section class="hero-container">
            <img src="shop.jpeg" alt="Prabhat Tyre House store front" class="hero-image">
            <div class="hero-overlay">
                <h1>Prabhat Tyre House</h1>
                <p>A premium tyre brand distributor and dealer since 1995</p>
                <a href="contact.php" class="contact-us">Get in Touch</a>
            </div>
        </section>
        
        <!-- About Prabhat Tyre House Section -->
        <section class="about-intro">
            <div class="about-container">
                <div class="about-content">
                    <h2>Welcome to Prabhat Tyre House</h2>
                    <p>Established in 1999, Prabhat Tyre House has earned a reputation as one of the most trusted and leading tyre distributors in Western Uttar Pradesh. With over two decades of experience, we are known for delivering top-quality products and outstanding customer service.</p>
                    <p>We are proud distributors of premium global tyre brands like Michelin, Bridgestone, Continental, and Ascenso, along with being authorized dealers of JK and Apollo tyres. Our extensive range ensures that customers have access to the best and most reliable tyres in the market.</p>
                    <p>While we specialize in truck tyres, we also offer car, bike, and scooty tyres on demand, ensuring we meet the needs of all types of vehicles.</p>    
                    <p>Recognized as one of the top tyre sellers in Western UP, Prabhat Tyre House also provides home delivery across the entire region, making tyre buying easier and more convenient than ever.</p>   
                    <p>At Prabhat Tyre House, quality, trust, and customer satisfaction are at the heart of everything we do.</p>
                </div>
                <div class="about-image">
                    <img src="logo.png" alt="Prabhat Tyre House Store">
                </div>
            </div>
        </section>
        
        <!-- Featured Products Slider -->
        <section class="slider-section">
            <div class="slider-container">
                <h2>All Brands We Deal With</h2>
                <div class="slider">
                    <div class="slides" id="slides">
                        <div class="slide">
                            <img src="bridstone.gif" alt="Premium Truck Tyres">
                            <div class="slide-content">
                                <h3>Premium Car Tyres</h3>
                                <p>High-performance tyres for luxury and everyday vehicles</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="conti.jpg" alt="Truck Tyres">
                            <div class="slide-content">
                                <h3>Heavy-Duty Truck Tyres</h3>
                                <p>Durable tyres built for the toughest roads and loads</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="mich.png" alt="Premium Tyres">
                            <div class="slide-content">
                                <h3>Premium Truck Tyres</h3>
                                <p>Known for its innovative tire designs and commitment to quality</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="asc.png" alt="Frams Tyres">
                            <div class="slide-content">
                                <h3>Premium Farm Tyres</h3>
                                <p>An off-highway tire brand owned and promoted by Mahansaria Tyres Private Limited (MTPL)</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="jk.jpeg" alt="Permium tyres">
                            <div class="slide-content">
                                <h3>Premium Truck Tyres</h3>
                                <p>Global presence and diverse product offerings</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="apollo.jpg" alt="Permium Tyres">
                            <div class="slide-content">
                                <h3>Premium Truck Tyres</h3>
                                <p>A leading global tire manufacturer, particularly strong in India, with a portfolio spanning passenger cars, SUVs, trucks, buses, and more</p>
                            </div>
                        </div>
                    </div>
                    <div class="slider-nav">
                        <button onclick="prevSlide()" aria-label="Previous slide">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button onclick="nextSlide()" aria-label="Next slide">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    
                    <div class="dots" id="dots"></div>
                </div>
            </div>
        </section>
    </main>

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
    <p><a href="index.php">Home</a></p>
    <p><a href="Aboutus.php">About Us</a></p>
    <p><a href="product.php">Products</a></p>
    <p><a href="service.php">Services</a></p>
    <p><a href="contactus.php">Contact Us</a></p>
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
    <!-- Scripts -->
    <script>
        const tires = [
 {
id: 1,
name: "M751 HL",
brand: "Bridgestone",
specs: "295/90 R 20",
price: 26400,
image: "m751hl.jpg",
redirectPage: "m751hl.php"
 },
 {
id: 2,
name: "Turanza T005",
brand: "Bridgestone",
specs: "215/60R16 99V",
price: 159.99,
image: "bridgestone-turanza.jpg",
redirectPage: "bridgestone-turanza.php"
 },
 {
id: 3,
name: "Pilot Sport 4",
brand: "Michelin",
specs: "245/40R18 97Y XL",
price: 249.99,
image: "michelin-pilot.jpg",
redirectPage: "michelin-pilot-sport.php"
 },
 {
id: 4,
name: "Energy XM2+",
brand: "Michelin",
specs: "185/65R15 88H",
price: 129.99,
image: "michelin-energy.jpg",
redirectPage: "michelin-energy.php"
 },
 {
id: 5,
name: "TH201",
brand: "Ascenso",
specs: "195/55R16 91V XL",
price: 89.99,
image: "ascenso-th201.jpg",
redirectPage: "ascenso-th201.php"
 },
 {
id: 6,
name: "CX688+",
brand: "Ascenso",
specs: "205/55R16 94V XL",
price: 99.99,
image: "ascenso-cx688.jpg",
redirectPage: "ascenso-cx688.php"
 },
 {
id: 7,
name: "PremiumContact 6",
brand: "Continental",
specs: "225/50R17 98Y XL",
price: 199.99,
image: "continental-premium.jpg",
redirectPage: "continental-premium.php"
 },
 {
id: 8,
name: "EcoContact 6",
brand: "Continental",
specs: "195/65R15 95H XL",
price: 139.99,
image: "continental-eco.jpg",
redirectPage: "continental-eco.php"
 },
 {
id: 9,
name: "Alnac 4G",
brand: "Apollo",
specs: "185/65R15 88T",
price: 79.99,
image: "apollo-alnac.jpg",
redirectPage: "apollo-alnac.php"
 },
 {
id: 10,
name: "Aspire 4G",
brand: "Apollo",
specs: "205/55R16 94V",
price: 109.99,
image: "apollo-aspire.jpg",
redirectPage: "apollo-aspire.php"
 },
 {
id: 11,
name: "UX Royale",
brand: "JK Tyre",
specs: "215/60R16 99H",
price: 119.99,
image: "jk-ux-royale.jpg",
redirectPage: "jk-ux-royale.php"
 },
 {
id: 12,
name: "Vectra",
brand: "JK Tyre",
specs: "195/65R15 91H",
price: 94.99,
image: "jk-vectra.jpg",
redirectPage: "jk-vectra.php"
 }
];

let cart = [];

// Load cart from localStorage on page load
function loadCart() {
    const savedCart = localStorage.getItem('unifiedTireShopCart') || sessionStorage.getItem('unifiedTireShopCart');
    if (savedCart) {
        try {
            cart = JSON.parse(savedCart);
            console.log('Cart loaded from localStorage:', cart);
            updateCartCount();
        } catch (e) {
            console.error('Error loading cart from localStorage:', e);
            cart = [];
        }
    }
}

// Save cart to localStorage
function saveCart() {
    try {
        const cartData = JSON.stringify(cart);
        localStorage.setItem('unifiedTireShopCart', cartData);
        sessionStorage.setItem('unifiedTireShopCart', cartData);
        console.log('Cart saved to localStorage:', cart);
        
        // Trigger storage event for real-time sync across pages
        window.dispatchEvent(new StorageEvent('storage', {
            key: 'unifiedTireShopCart',
            newValue: cartData,
            storageArea: localStorage
        }));
    } catch (e) {
        console.error('Error saving cart to localStorage:', e);
    }
}

function addToCart(productId) {
    console.log('Adding product ID:', productId);
    const product = tires.find(t => t.id === productId);
    if (!product) {
        console.log('Product not found with ID:', productId);
        return;
    }

    console.log('Found product:', product.name);

    const existing = cart.find(item => item.id === productId);
    if (existing) {
        existing.qty += 1;
        console.log('Increased quantity for:', product.name);
    } else {
        cart.push({ ...product, qty: 1 });
        console.log('Added new product to cart:', product.name);
    }

    updateCartCount();
    saveCart();
    showToast(`${product.name} added to cart!`);
    console.log('Current cart after adding:', cart);
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
    window.location.href = 'cart.php';
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
        window.location.href = 'profile.php';
    });
}

function viewOrders() {
    requireAuth(() => {
        window.location.href = 'myorder.php';
    });
}

function viewPastOrders() {
    requireAuth(() => {
        window.location.href = 'past-orders.php';
    });
}

function viewPolicies() {
    requireAuth(() => {
        window.location.href = 'policy.php';
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
        function toggleMenu() {
    const mobileNav = document.getElementById('mobileNav');
    const overlay = document.getElementById('overlay');
    mobileNav.classList.toggle('active');
    overlay.classList.toggle('active');
  }
        // Header Scroll Effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
        
        // Mobile Menu Toggle
        function toggleMenu() {
            const mobileNav = document.getElementById('mobileNav');
            const overlay = document.getElementById('overlay');
            mobileNav.classList.toggle('show');
            overlay.classList.toggle('show');
            document.body.style.overflow = mobileNav.classList.contains('show') ? 'hidden' : '';
            
            // Ensure proper focus management for accessibility
            if (mobileNav.classList.contains('show')) {
                document.querySelector('.close-menu').focus();
            } else {
                document.querySelector('.menu-toggle').focus();
            }
        }
        
        // Close menu with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const mobileNav = document.getElementById('mobileNav');
                if (mobileNav.classList.contains('show')) {
                    toggleMenu();
                }
            }
        });
        
        // Slider Functionality
        let currentSlide = 0;
        const slides = document.getElementById("slides");
        const totalSlides = slides ? slides.children.length : 0;
        const dotsContainer = document.getElementById("dots");
        let autoSlideInterval;
        
        if (totalSlides > 0) {
            function createDots() {
                for (let i = 0; i < totalSlides; i++) {
                    const dot = document.createElement("span");
                    dot.classList.add("dot");
                    if (i === 0) dot.classList.add("active");
                    dot.addEventListener("click", () => goToSlide(i));
                    dot.setAttribute("aria-label", `Slide ${i + 1}`);
                    dot.setAttribute("role", "button");
                    dot.setAttribute("tabindex", "0");
                    dotsContainer.appendChild(dot);
                }
            }
            
            function updateSlider() {
                slides.style.transform = `translateX(-${currentSlide * 100}%)`;
                
                // Update dots
                const dots = document.querySelectorAll(".dot");
                dots.forEach((dot, i) => {
                    dot.classList.toggle("active", i === currentSlide);
                    dot.setAttribute("aria-current", i === currentSlide ? "true" : "false");
                });
                
                // Reset animation on slide content
                const allContents = document.querySelectorAll('.slide-content');
                allContents.forEach((content, i) => {
                    if (i === currentSlide) {
                        content.style.animation = 'none';
                        content.offsetHeight; // Trigger reflow
                        content.style.animation = 'fadeInUp 0.8s forwards';
                    }
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
            
            // Initialize slider
            if (dotsContainer) {
                createDots();
                resetAutoSlide();
            }
            
            // Add keyboard navigation for slider
            document.addEventListener('keydown', function(event) {
                const slider = document.querySelector('.slider');
                if (slider && slider.contains(event.target)) {
                    if (event.key === 'ArrowLeft') {
                        prevSlide();
                    } else if (event.key === 'ArrowRight') {
                        nextSlide();
                    }
                }
            });
            
            // Touch Events for Slider
            const slider = document.querySelector('.slider');
            if (slider) {
                let touchstartX = 0;
                let touchendX = 0;
                
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
        
        // Enable dot navigation with keyboard
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' || event.key === ' ') {
                if (event.target.classList.contains('dot')) {
                    event.preventDefault();
                    const dots = Array.from(document.querySelectorAll('.dot'));
                    const index = dots.indexOf(event.target);
                    goToSlide(index);
                }
            }
        });
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