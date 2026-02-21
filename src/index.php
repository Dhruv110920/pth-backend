<?php
require_once "db.php";
?>
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
      padding: 10px 50px; /* Reduced from 18px to 10px */
      background-color: white;  
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 4px 15px rgba(255, 0, 0, 0.3);
      transition: all 0.3s ease;
    }

    .header.scrolled {
      padding: 8px 50px; /* Reduced from 12px to 8px */
    }

    .separator {
      height: 4px; 
      background: linear-gradient(to right, #d00, #ff3333, #d00);
      box-shadow: 0 2px 8px rgba(255, 0, 0, 0.5);
      z-index: 999;
      position: relative;
    }

    /* Reduced logo size for smaller header */
    .logo {
      height: 60px; /* Reduced from 45px to 35px */
      transition: all 0.3s ease;
    }

    .header.scrolled .logo {
      height: 38px; /* Reduced from 35px to 28px */
    }

    .nav-links {
      display: flex;
      gap: 40px;
    }

    /* Modified to make all nav links similar */
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

    /* Modified action buttons - removed contact-us button styling */
    .action-buttons {
      display: flex;
      align-items: center;
      gap: 20px;
    }

   /* Updated Mobile Navigation Styles */
  .menu-toggle {
    display: none;
    font-size: 24px;
    cursor: pointer;
    padding: 10px;
    color: #222;
    transition: all 0.3s ease;
    position: relative;
    z-index: 2100; /* Higher than mobile nav */
  }

  .menu-toggle:hover {
    color: red;
    transform: scale(1.1);
  }
  
  .menu-toggle.active {
    color: red;
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
  
  /* Staggered animation delays for menu items */
  .mobile-nav a:nth-child(1) { transition-delay: 0.1s; }
  .mobile-nav a:nth-child(2) { transition-delay: 0.2s; }
  .mobile-nav a:nth-child(3) { transition-delay: 0.3s; }
  .mobile-nav a:nth-child(4) { transition-delay: 0.4s; }
  .mobile-nav a:nth-child(5) { transition-delay: 0.5s; }

  .mobile-nav a:hover {
    color: red;
    padding-left: 10px;
    background-color: rgba(255, 0, 0, 0.05);
    border-radius: 4px;
  }
  
  .mobile-nav a:active {
    transform: scale(0.98);
  }

  .mobile-nav .close-menu {
    position: absolute;
    top: 20px;
    right: 25px;
    font-size: 28px;
    cursor: pointer;
    color: #333;
    transition: all 0.3s ease;
    opacity: 0;
    transform: rotate(0deg);
    z-index: 2001; /* Added to ensure it's above other elements */
  }
  
  .mobile-nav.show .close-menu {
    opacity: 1;
    transform: rotate(180deg);
    transition: opacity 0.5s ease 0.3s, transform 0.5s ease 0.3s;
  }

  .mobile-nav .close-menu:hover {
    color: red;
    transform: rotate(180deg) scale(1.1);
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
  
  /* Mobile logo animation */
  .header.menu-open .logo {
    transform: scale(0.9);
  }
  
  /* Menu toggle animation */
  @keyframes menuPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
  }
  
  .menu-toggle.animate {
    animation: menuPulse 0.5s ease;
  }

  /* Mobile body lock */
  body.menu-open {
    overflow: hidden;
  }

    /* Distributor Banner */
    .distributor-banner {
      background-color: white;
      padding: 12px 0;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .distributor-banner:before,
    .distributor-banner:after {
      content: '';
      position: absolute;
      width: 100px;
      height: 2px;
      background: linear-gradient(to right, transparent, red, transparent);
      top: 50%;
    }

    .distributor-banner:before {
      left: 10%;
    }

    .distributor-banner:after {
      right: 10%;
    }

    .distributor-banner h2 {
      font-size: 18px;
      margin: 0;
      color: #222;
      letter-spacing: 1px;
      font-weight: 600;
      display: inline-block;
      position: relative;
    }

    /* Slider */
    .slider {
      width: 100%;
      overflow: hidden;
      position: relative;
      z-index: 1;
      height: 650px;
      box-shadow: 0 0 50px rgba(255, 0, 0, 0.5);
    }

    .slides {
      display: flex;
      transition: transform 0.7s cubic-bezier(0.645, 0.045, 0.355, 1);
      height: 100%;
    }

    .slide {
      min-width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      background-size: cover;
      background-position: center;
      position: relative;
      color: white;
      height: 100%;
    }

    .slide-overlay {
      background: linear-gradient(to right, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.5));
      width: 100%;
      height: 100%;
      padding: 60px;
      box-sizing: border-box;
      display: flex;
      align-items: center;
      box-shadow: inset 0 0 100px rgba(255, 0, 0, 0.2);
    }

    .first-slide .slide-overlay {
      justify-content: flex-end;
      background: linear-gradient(to left, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.5));
    }

    .second-slide .slide-overlay {
      justify-content: flex-start;
    }

    .third-slide .slide-overlay {
      justify-content: flex-end;
      background: linear-gradient(to left, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.5));
    }

    .slide-content {
      max-width: 700px;
      animation: fadeInUp 0.8s forwards;
      opacity: 0;
      transform: translateY(30px);
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .slide-content h2 {
      font-size: 48px;
      margin-bottom: 15px;
      letter-spacing: 1px;
    }

    .red-title {
      color: #ff3333;
      text-shadow: 0 0 10px rgba(255, 0, 0, 0.3);
      position: relative;
      display: inline-block;
    }

    .red-title:after {
      content: '';
      position: absolute;
      width: 60px;
      height: 3px;
      background-color: red;
      bottom: -5px;
      left: 0;
    }

    .slide-content p {
      font-size: 18px;
      line-height: 1.8;
      margin-bottom: 25px;
    }

    .slide-content strong {
      color: #ff6666;
      font-size: 20px;
      display: inline-block;
      margin-bottom: 10px;
    }

    .slide-content ul {
      list-style-type: none;
      padding-left: 5px;
      margin: 15px 0;
    }

    .slide-content li {
      position: relative;
      padding-left: 25px;
      margin-bottom: 10px;
    }

    .slide-content li:before {
      content: '•';
      color: red;
      position: absolute;
      left: 0;
      font-size: 20px;
    }

    .Enquiry-btn {
      background-color: red;
      color: #fff;
      padding: 16px 35px;
      border: none;
      border-radius: 4px;
      margin-top: 25px;
      font-size: 18px;
      font-weight: 500;
      cursor: pointer;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(255, 0, 0, 0.3);
      display: inline-block;
    }

    .Enquiry-btn:hover {
      background-color: #cc0000;
      transform: translateY(-3px);
      box-shadow: 0 6px 15px rgba(255, 0, 0, 0.4);
    }

    .slide-controls {
      position: absolute;
      bottom: 30px;
      left: 0;
      width: 100%;
      z-index: 100;
      display: flex;
      justify-content: center;
    }

    .dots {
      display: flex;
      gap: 8px;
    }

    .dot {
      height: 12px;
      width: 12px;
      background-color: white;
      opacity: 0.5;
      border-radius: 50%;
      cursor: pointer;
      transition: all 0.3s;
    }

    .dot.active {
      background-color: red;
      opacity: 1;
      transform: scale(1.2);
    }

    .slider-arrows {
      position: absolute;
      width: 100%;
      top: 50%;
      transform: translateY(-50%);
      display: flex;
      justify-content: space-between;
      padding: 0 20px;
      z-index: 100;
    }

    .arrow {
      width: 50px;
      height: 50px;
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s;
    }

    .arrow:hover {
      background-color: rgba(255, 0, 0, 0.7);
    }

    .arrow i {
      color: white;
      font-size: 24px;
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

    /* Media Queries */
    @media (max-width: 992px) {
      .header {
        padding: 10px 30px;
      }
      .slider {
        height: 550px;
      }
      .slide-overlay {
        padding: 40px;
      }
      .slide-content h2 {
        font-size: 40px;
      }
    }

    @media (max-width: 768px) {
      .header {
        padding: 10px 20px;
      }
      .nav-links {
        display: none;
      }
      .menu-toggle {
        display: block;
      }
      .distributor-banner h2 {
        font-size: 16px;
      }
      .distributor-banner:before, .distributor-banner:after {
        display: none;
      }
      .slider {
        height: 500px;
      }
      .slide-overlay {
        padding: 30px 20px;
        justify-content: center !important;
      }
      .slide-content {
        max-width: 100%;
        text-align: center;
      }
      .slide-content h2 {
        font-size: 36px;
      }
      .red-title:after {
        left: 50%;
        transform: translateX(-50%);
      }
      .slide-content p {
        font-size: 16px;
      }
      .slide-content li {
        text-align: left;
      }
      .footer-columns {
        flex-direction: column;
      }
      .arrow {
        width: 40px; 
        height: 40px;
      }
    }

    @media (max-width: 480px) {
      .slider {
        height: 600px;
      }
      .slide-content h2 {
        font-size: 30px;
      }
      .slide-content p {
        font-size: 14px;
      }
      .Enquiry-btn {
        padding: 12px 24px;
        font-size: 16px;
      }
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

/* IMPROVED: Added padding and margin to create a larger hover area */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 180px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  z-index: 1000;
  top: 100%;
  left: 0;
  border-radius: 5px;
  overflow: hidden;
  margin-top: 10px;
  padding-top: 8px; /* Added padding to create larger target */
}

/* IMPROVED: Added delay to dropdown disappearance */
.dropdown:hover .dropdown-content {
  display: block;
  animation: fadeIn 0.3s ease;
}

/* IMPROVED: Add this to keep dropdown open when moving to dropdown content */
.dropdown-content:hover {
  display: block;
}

/* IMPROVED: Set display:block explicitly when hovering dropdown or its content */
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

/* Updated styles for user login and header */
.user-dropdown {
  position: relative;
  display: inline-block;
}

/* IMPROVED: Added hover area and display timing for user dropdown */
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
  padding-top: 8px; /* Added padding to create larger target */
}

/* IMPROVED: Add this to keep dropdown open when moving to dropdown content */
.user-dropdown:hover .user-dropdown-content,
.user-dropdown-content:hover,
.user-dropdown-content:focus-within {
  display: block !important;
}

/* IMPROVED: Added cart icon and adjusted user login styling */
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

.user-dropdown:hover .user-dropdown-content {
  display: block;
  animation: fadeIn 0.3s ease;
}

/* Updated media queries for responsive design */
@media (max-width: 992px) {
  .nav-links {
    gap: 25px;
  }
  
  .user-login span {
    font-size: 14px;
  }
}

@media (max-width: 768px) {
  /* All nav links are hidden on mobile */
  .nav-links {
    display: none;
  }
  
  .user-dropdown {
    display: none; /* Hide user dropdown on mobile */
  }
  
  .menu-toggle {
    display: block; /* Show hamburger menu on mobile */
    position: absolute; /* Position it on the right side */
    right: 20px;
    top: 20px;
  }
}
 /* Cart Icon Styles */
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
      background-color: #f5f5f5;
      border-radius: 50%;
      transition: all 0.3s ease;
      color: #222;
      text-decoration: none;
      cursor: pointer;
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

    /* Cart Modal Styles */
    .cart-modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 2000;
      display: none;
      align-items: center;
      justify-content: center;
    }

    .cart-modal.show {
      display: flex;
    }

    .cart-content {
      background: white;
      width: 90%;
      max-width: 600px;
      max-height: 80vh;
      border-radius: 15px;
      overflow: hidden;
      position: relative;
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

    .cart-close {
      background: none;
      border: none;
      color: white;
      font-size: 24px;
      cursor: pointer;
      padding: 5px;
    }

    .cart-items {
      padding: 20px;
      max-height: 400px;
      overflow-y: auto;
    }

    .cart-item {
      display: flex;
      align-items: center;
      gap: 15px;
      padding: 15px 0;
      border-bottom: 1px solid #eee;
    }

    .cart-item-image {
      width: 60px;
      height: 60px;
      background: #f5f5f5;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #666;
    }

    .cart-item-details {
      flex: 1;
    }

    .cart-item-name {
      font-weight: 500;
      color: #222;
      margin-bottom: 5px;
    }

    .cart-item-brand {
      font-size: 12px;
      color: #666;
    }

    .cart-item-price {
      color: red;
      font-weight: bold;
    }

    .cart-item-actions {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .quantity-btn {
      width: 30px;
      height: 30px;
      border: 1px solid #ddd;
      background: white;
      border-radius: 5px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .quantity-btn:hover {
      background: #f5f5f5;
    }

    .cart-total {
      padding: 20px;
      border-top: 2px solid #eee;
      background: #f8f9fa;
      text-align: center;
    }

    .cart-total-amount {
      font-size: 20px;
      font-weight: bold;
      color: red;
      margin-bottom: 15px;
    }

    .checkout-btn {
      background: red;
      color: white;
      border: none;
      padding: 12px 30px;
      border-radius: 25px;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .checkout-btn:hover {
      background: #cc0000;
      transform: translateY(-2px);
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

    /* Demo Styles for this example */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 20px;
      background: #f8f9fa;
    }

    .demo-header {
      background: white;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .demo-products {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .product-demo {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px;
      border: 1px solid #eee;
      border-radius: 8px;
      margin-bottom: 10px;
    }

    .add-to-cart-btn {
      background: red;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .add-to-cart-btn:hover {
      background: #cc0000;
    }

    @media (max-width: 480px) {
      .cart-content {
        width: 95%;
        margin: 10px;
      }
    }

  /* Mobile responsive adjustments */
  @media (max-width: 768px) {
    .action-buttons {
      position: absolute;
      right: 60px; /* Position to the left of menu toggle */
    }
    
    .user-dropdown span {
      display: none; /* Hide "Hi User" text on mobile */
    }
    
    .user-login {
      padding: 6px;
      background: transparent;
    }
    
    .user-login i {
      font-size: 22px;
    }
    
    /* Keep cart visible on mobile */
    .cart-wrapper {
      margin-right: 10px;
    }
    
    .cart-icon {
      background: transparent;
    }
    
    .cart-icon i {
      font-size: 22px;
    }
  }
  .Enquiry-btn {
  text-decoration: none; /* removes the underline */
  /* Optional button styles below */
  display: inline-block;
  padding: 10px 20px;
  background-color: red;
  color: white;
  border-radius: 5px;
  font-weight: bold;
}

  
  </style>
  
</head>
<body>


<!-- Header - Modified with separate cart and user dropdown -->
<header class="header" id="header">
  <img src="logo.png" alt="Reflect Logo" class="logo"> 

  <nav class="nav-links">
    <a href="index.php">Home</a>
    <a href="Aboutus.php">About Us</a>
    <div class="dropdown">
      <a href="product.php"><span class="dropbtn">Products</span></a>
<div class="dropdown-content">
  <a href="bridgestone.php">Bridgestone</a>
  <a href="michlen.php">Michelin</a>
  <a href="ascenso.php">Ascenso</a>
  <a href="apollo.php">Apollo</a>
  <a href="jk.php">JK</a>
</div>

    </div>
    <a href="service.php">Services</a>
    <a href="contactus.php">Contact Us</a>
  </nav>

  <div class="action-buttons">
    <!-- Cart Icon -->
<div class="cart-wrapper">
  <div class="cart-icon" onclick="toggleCart()">
    <i class="fas fa-shopping-cart"></i>
    <span class="cart-count" id="cartCount">0</span>
  </div>
</div>
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
        <p>Add some products to get started!</p>
      </div>
    </div>
    <div class="cart-total" id="cartTotal" style="display: none;">
      <div class="cart-total-amount">Total: $0.00</div>
      <button class="checkout-btn">Proceed to Checkout</button>
    </div>
  </div>
</div>
    
    <!-- User dropdown separated from cart -->
    <div class="user-dropdown">
      <div class="user-login" id="userLoginToggle">
        <i class="fas fa-user-circle"></i>
        <span>Hi User</span>
      </div>
      <div class="user-dropdown-content" id="userDropdownContent">
        <a href="welcome.php"><i class="fas fa-sign-in-alt"></i> Login</a>
        <a href="welcome.php"><i class="fas fa-user-plus"></i> Sign Up</a>
        <a href="#orders"><i class="fas fa-box"></i> My Orders</a>
        <a href="#profile"><i class="fas fa-user-cog"></i> Profile</a>
      </div>
    </div>
  </div>

  <!-- Mobile menu toggle -->
  <div class="menu-toggle" id="mobileMenuToggle">
    <i class="fas fa-bars"></i>
  </div>
</header>

<!-- Mobile navigation -->
<div class="mobile-nav" id="mobileNav"> 
  <i class="fas fa-times close-menu" id="closeMenu"></i>
  <a href="index.php">Home</a>
  <a href="Aboutus.php">About Us</a>
  <a href="product.php">Products</a>
  <a href="service.php">Services</a>
  <a href="contactus.php">Contact Us</a>
  <a href="profile.php"><i class="fas fa-user"></i> My Profile</a>
  <a href="myorder.php"><i class="fas fa-shopping-bag"></i> My Orders</a>
  <a href="past-orders.php"><i class="fas fa-shopping-bag"></i> Past Orders</a>

</div>

<!-- Overlay for mobile menu -->
<div class="overlay" id="overlay"></div>

  
  <div class="overlay" id="overlay"></div>
</header>
<div class="separator"></div>
<!-- Slider -->
<section class="slider">
  <div class="slides" id="slides">

    <!-- Slide 1 -->
    <div class="slide first-slide" style="background-image: url('m751hl.jpg');">
      <div class="slide-overlay">
        <div class="slide-content">
          <h2 class="red-title">M751 HL</h2>
          <strong>GENERAL CARGO / TANKER / TRAILER | DRIVE ON ROAD TYRE</strong>
          <a href="m751hl.php" class="Enquiry-btn">Enquire Now</a>
        </div>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="slide second-slide" style="background-image: url('R271.jpg');">
      <div class="slide-overlay">
        <div class="slide-content">
          <h2 class="red-title">R-271</h2>
          <strong>GENERAL CARGO / TANKER / TRAILER | PREMIUM HIGHWAY TYRE</strong>
         <a href="R271.php" class="Enquiry-btn">Enquire Now</a>
        </div>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="slide third-slide" style="background-image: url('R156.png');">
      <div class="slide-overlay">
        <div class="slide-content">
          <h2 class="red-title">R-156</h2>
          <strong>GENERAL CARGO/ TANKER/ TRAILER | FUEL EFFICIENT - ALL POSITION TYRE</strong>
          <a href="R156.php" class="Enquiry-btn">Enquire Now</a>
        </div>
      </div>
    </div>
    
  
    
    
    
    <!-- Slide 6 -->
    <div class="slide second-slide" style="background-image: url('enduld.jpg');">
      <div class="slide-overlay">
        <div class="slide-content">
          <h2 class="red-title">Endu Race LD</h2>
          <a href="LD.php" class="Enquiry-btn">Enquire Now</a>
        </div>
      </div>
    </div>
    
   
    
    <!-- Slide 8 -->
    <div class="slide second-slide" style="background-image: url('X\ Multi\ Z2.jpg');">
      <div class="slide-overlay">
        <div class="slide-content">
          <h2 class="red-title">X Multi Z2</h2>
          <strong>Versatility and longevity in all climatic conditions</strong>
          
          <a href="Z2.php" class="Enquiry-btn">Enquire Now</a>
        </div>
      </div>
    </div>
    
    <!-- Slide 9 -->
    <div class="slide second-slide" style="background-image: url('X\ Multi\ Z+.jpg');">
      <div class="slide-overlay">
        <div class="slide-content">
          <h2 class="red-title">X Multi Energy Z+</h2>
          <strong>Optimised fuel consumption without compromising on service-life</strong>
        
         <a href="Z+.php" class="Enquiry-btn">Enquire Now</a>
        </div>
      </div>
    </div>
    
    <!-- Slide 10 -->
    <div class="slide second-slide" style="background-image: url('X\ Multi\ D+.png');">
      <div class="slide-overlay">
        <div class="slide-content">
          <h2 class="red-title">X Multi D+</h2>
          <strong>Maximized Tread Life</strong>
          <p>Co-Extruded Compounding Scrub Resistant Rubber</p>
          <a href="D+.php" class="Enquiry-btn">Enquire Now</a>
        </div>
      </div>
    </div>
    
    <!-- Slide 11 -->
    <div class="slide second-slide" style="background-image: url('td16.jpeg');">
      <div class="slide-overlay">
        <div class="slide-content">
          <h2 class="red-title">TD 16</h2>
          <strong>Dual-Lug Angle Design with High inner volume</strong>
          <a href="td-16.php" class="Enquiry-btn">Enquire Now</a>
        </div>
      </div>
    </div>
    
    <!-- Slide 12 -->
    <div class="slide second-slide" style="background-image: url('TR\ 21.png');">
      <div class="slide-overlay">
        <div class="slide-content">
          <h2 class="red-title">TR 21</h2>
          <strong>Specially designed Lug Pattern for transport applications</strong>
          
          <a href="21.php" class="Enquiry-btn">Enquire Now</a>
        </div>
      </div>
    </div>
  </div>
  <script src="path/to/user-detector.js"></script>
  <!-- Slide Navigation -->
  <div class="slide-controls">
    <div class="dots" id="dots"></div>
  </div>
  
  <div class="slider-arrows">
    <div class="arrow prev" onclick="prevSlide()">
      <i class="fas fa-chevron-left"></i>
    </div>
    <div class="arrow next" onclick="nextSlide()">
      <i class="fas fa-chevron-right"></i>
    </div>
  </div>

</section>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prabhat Tyre House</title>
  <style>
    /* Modern Clean Design System */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      line-height: 1.6;
      color: #333;
      background-color: #f5f7fa;
    }
    
    /* Distributor Banner */
    .distributor-banner {
      background-color: #d21e1e;
      color: white;
      text-align: center;
      padding: 15px 20px;
      font-weight: 600;
    }
    
    /* Category Headers */
    .category-header {
      text-align: center;
      padding: 50px 20px 30px;
      background-color: white;
    }
    .category-header h2 {
      font-size: 2.2rem;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 20px;
      letter-spacing: -0.5px;
    }
    .header-line {
      height: 4px;
      width: 80px;
      background: linear-gradient(90deg, #d21e1e, #ff5252);
      margin: 0 auto;
      border-radius: 2px;
    }
    .subheader {
      font-size: 1.1rem;
      color: #555;
      margin-top: 15px;
    }
    
    /* Brand Navigation */
    .brand-section {
      margin-bottom: 60px;
    }
    .brand-navigation {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 10px;
      padding: 20px;
      background-color: white;
      border-bottom: 1px solid #eaeaea;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    }
    .distributor-section .brand-nav-item {
      border: 2px solid #eaeaea;
    }
    .distributor-section .brand-nav-item.active {
      border-color: #d21e1e;
    }
    .reseller-section .brand-nav-item {
      border: 2px solid #eaeaea;
    }
    .reseller-section .brand-nav-item.active {
      border-color: #2e86de;
    }
    .brand-nav-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 15px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      min-width: 120px;
      background-color: #f9f9f9;
    }
    .brand-nav-item:hover {
      background-color: #f0f0f0;
      transform: translateY(-3px);
    }
    .brand-nav-item.active {
      background-color: #fff;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    .brand-logo {
      width: 60px;
      height: 60px;
      object-fit: contain;
      margin-bottom: 10px;
      border-radius: 50%;
      padding: 5px;
      background-color: white;
      border: 1px solid #eaeaea;
    }
    .brand-nav-item span {
      font-size: 14px;
      font-weight: 500;
      color: #555;
    }
    .distributor-section .brand-nav-item.active span {
      color: #d21e1e;
      font-weight: 600;
    }
    .reseller-section .brand-nav-item.active span {
      color: #2e86de;
      font-weight: 600;
    }
    
    /* Distributor Badge */
    .distributor-badge {
      background-color: #d21e1e;
      color: white;
      font-size: 12px;
      padding: 4px 8px;
      border-radius: 4px;
      margin-top: 8px;
      font-weight: 500;
    }
    .reseller-badge {
      background-color: #2e86de;
      color: white;
      font-size: 12px;
      padding: 4px 8px;
      border-radius: 4px;
      margin-top: 8px;
      font-weight: 500;
    }
    
    /* Brand Details */
    .brand-details-container {
      max-width: 1200px;
      margin: 40px auto;
      padding: 0 20px;
    }
    .brand-details {
      display: none;
      background-color: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      margin-bottom: 30px;
    }
    .brand-details.active {
      display: block;
      animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .brand-hero {
      position: relative;
      height: 400px;
      overflow: hidden;
    }
    .hero-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.8s ease;
    }
    .brand-details:hover .hero-image {
      transform: scale(1.05);
    }
    .brand-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 60px 40px 40px;
      background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
      color: white;
    }
    .distributor-section .brand-overlay {
      border-bottom: 5px solid #d21e1e;
    }
    .reseller-section .brand-overlay {
      border-bottom: 5px solid #2e86de;
    }
    .brand-overlay h3 {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 10px;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    }
    .tagline {
      font-size: 1.2rem;
      font-weight: 400;
      opacity: 0.9;
    }
    .brand-content {
      padding: 40px;
    }
    .brand-content p {
      font-size: 16px;
      color: #444;
      margin-bottom: 20px;
      line-height: 1.8;
    }
    .action-buttons {
      display: flex;
      gap: 15px;
      margin-top: 30px;
    }
    .distributor-section .primary-btn {
      background-color: #d21e1e;
      box-shadow: 0 4px 12px rgba(210, 30, 30, 0.2);
    }
    .distributor-section .primary-btn:hover {
      background-color: #b51818;
      box-shadow: 0 6px 16px rgba(210, 30, 30, 0.3);
    }
    .reseller-section .primary-btn {
      background-color: #2e86de;
      box-shadow: 0 4px 12px rgba(46, 134, 222, 0.2);
    }
    .reseller-section .primary-btn:hover {
      background-color: #2570bd;
      box-shadow: 0 6px 16px rgba(46, 134, 222, 0.3);
    }
    .primary-btn, .secondary-btn {
      padding: 12px 25px;
      border-radius: 6px;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      border: none;
      color: white;
    }
    .secondary-btn {
      background-color: #f5f5f5;
      color: #333;
      border: 1px solid #ddd;
    }
    .secondary-btn:hover {
      background-color: #eaeaea;
      transform: translateY(-2px);
    }
    .status-label {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 4px;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 20px;
    }
    .distributor-status {
      background-color: #ffecec;
      color: #d21e1e;
      border: 1px solid #ffcfcf;
    }
    .reseller-status {
      background-color: #e6f2ff;
      color: #2e86de;
      border: 1px solid #c9e2ff;
    }
    
    /* Responsive Design */
    @media (max-width: 992px) {
      .brand-hero {
        height: 350px;
      }
      .brand-overlay h3 {
        font-size: 2.5rem;
      }
      .brand-content {
        padding: 30px;
      }
    }
    @media (max-width: 768px) {
      .category-header h2 {
        font-size: 1.8rem;
      }
      .brand-navigation {
        gap: 8px;
        padding: 15px 10px;
        overflow-x: auto;
        justify-content: flex-start;
      }
      .brand-nav-item {
        min-width: 100px;
        padding: 10px;
      }
      .brand-logo {
        width: 50px;
        height: 50px;
      }
      .brand-hero {
        height: 280px;
      }
      .brand-overlay {
        padding: 40px 20px 20px;
      }
      .brand-overlay h3 {
        font-size: 2rem;
      }
      .brand-content {
        padding: 25px 20px;
      }
      .action-buttons {
        flex-direction: column;
        gap: 10px;
      }
      .primary-btn, .secondary-btn {
        width: 100%;
        text-align: center;
      }
    }
    @media (max-width: 480px) {
      .category-header {
        padding: 30px 15px 20px;
      }
      .brand-hero {
        height: 220px;
      }
      .brand-overlay h3 {
        font-size: 1.8rem;
      }
      .tagline {
        font-size: 1rem;
      }
      .distributor-badge, .reseller-badge {
        font-size: 10px;
        padding: 3px 6px;
      }
    }
    
  </style>
</head>
<body>
  
  <!-- Distributor Banner -->
  <div class="distributor-banner">
    <h2>Prabhat Tyre House Is Distributor of Premium Tyre Brands</h2>
  </div>
  
  <!-- DISTRIBUTOR SECTION -->
  <div class="brand-section distributor-section">
    <!-- Premium Brands Header -->
    <div class="category-header">
      <h2>Official Distributor Brands</h2>
      <div class="header-line"></div>
      <p class="subheader">We are authorized distributors for these premium tyre brands</p>
    </div>
    
    <!-- Distributor Brand Navigation -->
    <div class="brand-navigation">
      <div class="brand-nav-item active" data-brand="bridgestone" data-section="distributor">
        <img src="bridstone.gif" alt="Bridgestone" class="brand-logo">
        <span>Bridgestone</span>
        <div class="distributor-badge">Distributor</div>
      </div>
      <div class="brand-nav-item" data-brand="michelin" data-section="distributor">
        <img src="mich.png" alt="Michelin" class="brand-logo">
        <span>Michelin</span>
        <div class="distributor-badge">Distributor</div>
      </div>
      
      <div class="brand-nav-item" data-brand="ascenso" data-section="distributor">
        <img src="asc.png" alt="Ascenso" class="brand-logo">
        <span>Ascenso</span>
        <div class="distributor-badge">Distributor</div>
      </div>
    </div>
    
    <!-- Distributor Brand Details -->
    <div class="brand-details-container">
      <!-- Bridgestone Section -->
      <div class="brand-details active" id="bridgestone">
        <div class="brand-hero">
          <img src="bridstone.gif" alt="Bridgestone Tyres" class="hero-image">
          <div class="brand-overlay">
            <h3>Bridgestone</h3>
            <p class="tagline">Innovation for Every Journey</p>
          </div>
        </div>
        <div class="brand-content">
          <div class="status-label distributor-status">Official Distributor</div>
          <p>At Bridgestone, we believe in pushing the boundaries of performance, safety, and innovation. As one of the world's leading tyre manufacturers, we are committed to providing high-quality products that deliver exceptional comfort, reliability, and durability—no matter the road ahead.</p>
          <p>With decades of experience and a strong global presence, Bridgestone continues to set the standard in tyre technology. From passenger cars to heavy-duty commercial vehicles, our tyres are designed to enhance driving experiences and ensure peace of mind.</p>
          <p>Driven by a passion for excellence and sustainability, Bridgestone is not just a tyre company—we are a mobility solution provider, dedicated to building a safer and more connected future for all.</p>
          <div class="action-buttons">
            <a href="bridgestone.php">
  <button class="primary-btn">View Products</button>
</a>

          </div>
        </div>
      </div>
      
      <!-- Michelin Section -->
      <div class="brand-details" id="michelin">
        <div class="brand-hero">
          <img src="mich.png" alt="Michelin Tyres" class="hero-image">
          <div class="brand-overlay">
            <h3>Michelin</h3>
            <p class="tagline">A Better Way Forward</p>
          </div>
        </div>
        <div class="brand-content">
          <div class="status-label distributor-status">Official Distributor</div>
          <p>At Michelin, we believe that mobility is essential for human development. Our mission is to make transportation safer, more efficient, and more sustainable for everyone. As a global leader in the tyre industry, Michelin is known for its cutting-edge technology, unmatched quality, and commitment to innovation.</p>
          <p>From everyday passenger vehicles to high-performance sports cars, commercial trucks, and even aircraft, Michelin tyres are designed to deliver superior grip, exceptional durability, and a comfortable ride—no matter the road or weather conditions.</p>
          <p>With a strong presence in over 170 countries and a legacy spanning more than 130 years, Michelin continues to push the boundaries of performance and environmental responsibility. Choose Michelin—because every journey deserves the best.</p>
          <div class="action-buttons">
            <a href="michlen.php">
            <button class="primary-btn">View Products</button>
            </a>
          </div>
        </div>
      </div>
      
       
      <!-- Ascenso Section -->
      <div class="brand-details" id="ascenso">
        <div class="brand-hero">
          <img src="asc.png" alt="Ascenso Tyres" class="hero-image">
          <div class="brand-overlay">
            <h3>Ascenso</h3>
            <p class="tagline">Built for the Toughest Demands</p>
          </div>
        </div>
        <div class="brand-content">
          <div class="status-label distributor-status">Official Distributor</div>
          <p>At Ascenso Tyres, we're driven by a bold vision—to become a global force in off-highway tyre solutions. Designed for agriculture, industrial, construction, and earthmoving applications, Ascenso tyres are built to meet the toughest demands of today's working environments.</p>
          <p>Our products combine cutting-edge technology, innovative design, and superior durability to deliver performance that professionals can rely on. Backed by Mahansaria Tyres Private Limited (MTPL), Ascenso leverages decades of industry experience and world-class manufacturing capabilities.</p>
          <p>We are committed to empowering our customers with high-performance tyres that offer exceptional value, longer service life, and lower operating costs. With a growing global presence in over 100 countries, Ascenso is not just a tyre brand—we're your trusted partner on the road to productivity.</p>
          <div class="action-buttons">
            <a href="ascenso.php">
            <button class="primary-btn">View Products</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- RESELLER SECTION -->
  <div class="brand-section reseller-section">
    <!-- Other Brands Header -->
    <div class="category-header">
      <h2>Additional Tyre Brands</h2>
      <div class="header-line" style="background: linear-gradient(90deg, #2570bd, #2e86de);"></div>
      <p class="subheader">We also sell these quality tyre brands</p>
    </div>
    
    <!-- Reseller Brand Navigation -->
    <div class="brand-navigation">
      <div class="brand-nav-item active" data-brand="apollo" data-section="reseller">
        <img src="apollo.jpg" alt="Apollo" class="brand-logo">
        <span>Apollo</span>
        <div class="reseller-badge">Retailer</div>
      </div>
      <div class="brand-nav-item" data-brand="jk" data-section="reseller">
        <img src="jk.jpeg" alt="JK Tyres" class="brand-logo">
        <span>JK Tyres</span>
        <div class="reseller-badge">Retailer</div>
      </div>
    </div>
    
    <!-- Reseller Brand Details -->
    <div class="brand-details-container">
      <!-- Apollo Section -->
      <div class="brand-details active" id="apollo">
        <div class="brand-hero">
          <img src="apollo.jpg" alt="Apollo Tyres" class="hero-image">
          <div class="brand-overlay">
            <h3>Apollo</h3>
            <p class="tagline">Driving Innovation Forward</p>
          </div>
        </div>
        <div class="brand-content">
          <div class="status-label reseller-status">Official Retailer</div>
          <p>Apollo Tyres is a global tyre manufacturer known for delivering high-quality, durable tyres specifically engineered for diverse Indian road conditions. With state-of-the-art manufacturing facilities and cutting-edge research capabilities, Apollo continues to set new standards in the tyre industry.</p>
          <p>Our extensive range of tyres caters to passenger cars, SUVs, commercial vehicles, and more. Each Apollo tyre is designed with precision engineering to ensure superior grip, excellent handling, and maximum fuel efficiency.</p>
          <p>Apollo Tyres combines international expertise with a deep understanding of local conditions to create products that stand up to the toughest challenges on Indian roads.</p>
          <div class="action-buttons">
           <a href="apollo.php">
            <button class="primary-btn">View Products</button>
            </a>
          </div>
        </div>
      </div>
      
      <!-- JK Tyre Section -->
      <div class="brand-details" id="jk">
        <div class="brand-hero">
          <img src="jk.jpeg" alt="JK Tyres" class="hero-image">
          <div class="brand-overlay">
            <h3>JK Tyres</h3>
            <p class="tagline">Total Control, Maximum Performance</p> 
          </div>
        </div>
        <div class="brand-content">
          <div class="status-label reseller-status">Official Retailer</div>
          <p>JK Tyres stands as one of India's most respected tyre manufacturers, delivering reliable performance across all terrains and conditions. With pioneering technology and constant innovation, JK Tyres has established itself as a trusted brand for millions of vehicle owners across the country.</p>
          <p>Our comprehensive range includes tyres for passenger cars, commercial vehicles, farm equipment, and off-road applications. Each product is engineered to deliver optimal performance, superior grip, and enhanced fuel efficiency.</p>
          <p>JK Tyres combines world-class manufacturing standards with deep local market insights to create products that perfectly address the unique challenges of Indian roads and driving conditions.</p>
          <div class="action-buttons">
            <a href="jk.php">
            <button class="primary-btn">View Products</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    
window.addEventListener('DOMContentLoaded', () => {
    const userData = JSON.parse(localStorage.getItem('userData'));
    if (userData) {
        document.getElementById('userInfo').innerHTML = `
            <h3>Welcome, ${userData.name}</h3>
            <p><strong>Email:</strong> ${userData.email}</p>
            <p><strong>Phone:</strong> ${userData.phone}</p>
            <p><strong>Address:</strong> ${userData.address}, ${userData.city}</p>
        `;
    }
});
</script>
 
  <script>

    
    document.addEventListener('DOMContentLoaded', function() {
      // Navigation functionality
      const navItems = document.querySelectorAll('.brand-nav-item');
      
      navItems.forEach(item => {
        item.addEventListener('click', function() {
          // Get brand ID and section from data attribute
          const brandId = this.getAttribute('data-brand');
          const section = this.getAttribute('data-section');
          
          // Remove active class only from nav items in the same section
          const sectionNavItems = document.querySelectorAll(`.${section}-section .brand-nav-item`);
          sectionNavItems.forEach(navItem => {
            navItem.classList.remove('active');
          });
          
          // Add active class to clicked nav item
          this.classList.add('active');
          
          // Hide all brand details in the section
          const sectionDetails = document.querySelectorAll(`.${section}-section .brand-details`);
          sectionDetails.forEach(detail => {
            detail.classList.remove('active');
          });
          
          // Show selected brand details
          document.getElementById(brandId).classList.add('active');
          
          // Smooth scroll to content
          document.getElementById(brandId).scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        });
      });
      
      // Make navigation sticky on scroll
      window.addEventListener('scroll', function() {
        const navs = document.querySelectorAll('.brand-navigation');
        navs.forEach(nav => {
          if (window.scrollY > 100) {
            nav.style.boxShadow = '0 4px 20px rgba(0,0,0,0.1)';
          } else {
            nav.style.boxShadow = '0 2px 15px rgba(0,0,0,0.05)';
          }
        });
      });
    });
  </script>
</body>
</html>

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

<!-- Scripts -->
<script>
// Combined JavaScript for Navigation, Dropdowns, Mobile Menu, Slider, and Cart Functionality

// ==================== NAVIGATION & DROPDOWN FUNCTIONALITY ====================

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

// ==================== USER LOGIN FUNCTIONALITY ====================
// Mobile-specific login functions with person icon and red-white theme
// Updated to align with cart and hamburger menu icons

// Function to check if device is mobile
function isMobileDevice() {
    return window.innerWidth <= 768 || /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

// Function to calculate position aligned with other navigation icons
function calculateAlignedPosition() {
    const cart = document.querySelector('.cart, [class*="cart"], [id*="cart"]') || 
                 document.querySelector('svg[class*="cart"], i[class*="cart"]');
    const hamburger = document.querySelector('.hamburger, [class*="hamburger"], [class*="menu-toggle"]') ||
                     document.querySelector('svg[class*="menu"], i[class*="menu"]');
    
    // Try to find the navigation container or header
    const navContainer = document.querySelector('nav, header, .header, .navbar, .nav-container') ||
                        document.querySelector('[class*="header"], [class*="nav"]');
    
    let topPosition = 15; // Default top position
    let rightPosition = 60; // Default right position
    
    // If we found navigation icons, align with them
    if (cart || hamburger) {
        const referenceElement = cart || hamburger;
        const rect = referenceElement.getBoundingClientRect();
        
        // Align vertically with the reference element
        topPosition = rect.top + (rect.height / 2) - 20; // Center align with 40px icon height
        
        // Position to the left of cart with proper spacing
        if (cart) {
            rightPosition = window.innerWidth - rect.left + 15;
        } else {
            rightPosition = 60;
        }
    } else if (navContainer) {
        // If no specific icons found, align with navigation container
        const navRect = navContainer.getBoundingClientRect();
        topPosition = navRect.top + (navRect.height / 2) - 20;
    }
    
    // Ensure positions stay within reasonable bounds
    topPosition = Math.max(10, Math.min(topPosition, 80));
    rightPosition = Math.max(50, Math.min(rightPosition, window.innerWidth - 50));
    
    return { top: topPosition, right: rightPosition };
}

// Function to create mobile "Hi User" element with person icon
function createMobileLoginIcon() {
    // Check if mobile element already exists
    if (document.getElementById('mobileLoginIcon')) {
        return;
    }
    
    const mobileUserElement = document.createElement('div');
    mobileUserElement.id = 'mobileLoginIcon';
    mobileUserElement.className = 'mobile-user-login user-login';
    
    // Calculate initial position aligned with other icons
    const position = calculateAlignedPosition();
    
    // Aligned style to match other navigation icons
    mobileUserElement.style.cssText = `
        position: fixed;
        top: ${position.top}px;
        right: ${position.right}px;
        z-index: 9999;
        background: #fff;
        border: 1px solid #dc3545;
        border-radius: 50%;
        padding: 8px;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.15);
        transition: all 0.3s ease;
        font-size: 18px;
        color: #dc3545;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        backdrop-filter: blur(5px);
    `;
    
    // Add hover effect
    mobileUserElement.addEventListener('mouseenter', function() {
        this.style.background = '#dc3545';
        this.style.color = '#fff';
        this.style.transform = 'scale(1.1)';
        this.style.boxShadow = '0 4px 12px rgba(220, 53, 69, 0.25)';
    });
    
    mobileUserElement.addEventListener('mouseleave', function() {
        this.style.background = '#fff';
        this.style.color = '#dc3545';
        this.style.transform = 'scale(1)';
        this.style.boxShadow = '0 2px 8px rgba(220, 53, 69, 0.15)';
    });
    
    // Create person icon
    const personIcon = document.createElement('i');
    personIcon.className = 'fas fa-user';
    personIcon.style.cssText = `
        font-size: 18px;
        line-height: 1;
    `;
    
    // Create dropdown container
    const dropdownContainer = document.createElement('div');
    dropdownContainer.className = 'mobile-user-dropdown';
    dropdownContainer.style.cssText = `
        position: relative;
        display: inline-block;
    `;
    
    // Create dropdown content
    const dropdownContent = document.createElement('div');
    dropdownContent.className = 'mobile-user-dropdown-content user-dropdown-content';
    dropdownContent.style.cssText = `
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background: #fff;
        min-width: 200px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        border-radius: 8px;
        z-index: 10000;
        border: 1px solid #dc3545;
        margin-top: 8px;
        overflow: hidden;
        animation: slideDown 0.3s ease;
    `;
    
    // Add click event to show/hide dropdown
    mobileUserElement.addEventListener('click', function(e) {
        e.stopPropagation();
        const dropdown = this.querySelector('.mobile-user-dropdown-content');
        if (dropdown.style.display === 'block') {
            dropdown.style.display = 'none';
        } else {
            dropdown.style.display = 'block';
        }
    });
    
    // Append icon to main element
    mobileUserElement.appendChild(personIcon);
    
    // Append dropdown elements
    dropdownContainer.appendChild(dropdownContent);
    mobileUserElement.appendChild(dropdownContainer);
    
    // Add to document
    document.body.appendChild(mobileUserElement);
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!mobileUserElement.contains(e.target)) {
            const dropdown = mobileUserElement.querySelector('.mobile-user-dropdown-content');
            if (dropdown) {
                dropdown.style.display = 'none';
            }
        }
    });
}

// Function to update mobile login icon position
function updateMobileIconPosition() {
    const mobileUserElement = document.getElementById('mobileLoginIcon');
    if (!mobileUserElement) return;
    
    const position = calculateAlignedPosition();
    mobileUserElement.style.top = `${position.top}px`;
    mobileUserElement.style.right = `${position.right}px`;
}

// Function to update mobile "Hi User" element based on user status
function updateMobileLoginIcon() {
    const mobileUserElement = document.getElementById('mobileLoginIcon');
    if (!mobileUserElement) return;
    
    const personIcon = mobileUserElement.querySelector('i');
    
    let iconClass = 'fas fa-user';
    
    if (userData) {
        // User is logged in - show personalized greeting
        const firstName = userData.name.split(' ')[0];
        const userType = userData.type;
        
        // Change icon based on user type
        if (userType === 'seller') {
            iconClass = 'fas fa-store';
        } else if (userType === 'dealer') {
            iconClass = 'fas fa-handshake';
        } else {
            iconClass = 'fas fa-user-check';
        }
        
        // Logged in styling - filled red theme
        mobileUserElement.style.background = '#dc3545';
        mobileUserElement.style.color = '#fff';
        mobileUserElement.style.borderColor = '#a71e2a';
        mobileUserElement.style.boxShadow = '0 2px 8px rgba(220, 53, 69, 0.25)';
        
        // Update hover effects for logged in state
        mobileUserElement.onmouseenter = function() {
            this.style.background = '#a71e2a';
            this.style.transform = 'scale(1.1)';
            this.style.boxShadow = '0 4px 12px rgba(220, 53, 69, 0.35)';
        };
        
        mobileUserElement.onmouseleave = function() {
            this.style.background = '#dc3545';
            this.style.transform = 'scale(1)';
            this.style.boxShadow = '0 2px 8px rgba(220, 53, 69, 0.25)';
        };
        
    } else {
        // User not logged in - show default white theme
        iconClass = 'fas fa-user';
        
        mobileUserElement.style.background = '#fff';
        mobileUserElement.style.color = '#dc3545';
        mobileUserElement.style.borderColor = '#dc3545';
        mobileUserElement.style.boxShadow = '0 2px 8px rgba(220, 53, 69, 0.15)';
        
        // Update hover effects for logged out state
        mobileUserElement.onmouseenter = function() {
            this.style.background = '#dc3545';
            this.style.color = '#fff';
            this.style.transform = 'scale(1.1)';
            this.style.boxShadow = '0 4px 12px rgba(220, 53, 69, 0.25)';
        };
        
        mobileUserElement.onmouseleave = function() {
            this.style.background = '#fff';
            this.style.color = '#dc3545';
            this.style.transform = 'scale(1)';
            this.style.boxShadow = '0 2px 8px rgba(220, 53, 69, 0.15)';
        };
    }
    
    // Update icon
    if (personIcon) {
        personIcon.className = iconClass;
    }
    
    // Update dropdown content using existing function
    const dropdownContent = mobileUserElement.querySelector('.mobile-user-dropdown-content');
    if (dropdownContent) {
        updateMobileDropdownContent(dropdownContent);
    }
    
    // Update position to stay aligned
    updateMobileIconPosition();
}

// Function to update mobile dropdown content with red-white theme
function updateMobileDropdownContent(dropdownElement) {
    if (!dropdownElement) return;
    
    // Clear existing content
    dropdownElement.innerHTML = '';
    
    if (userData) {
        // User is logged in - show logged-in options
        const userType = userData.type || 'user';
        
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
        loggedInOptions.forEach((option, index) => {
            const link = document.createElement('a');
            link.href = '#';
            link.style.cssText = `
                display: flex;
                align-items: center;
                padding: 12px 16px;
                text-decoration: none;
                color: #333;
                border-bottom: 1px solid rgba(220, 53, 69, 0.1);
                transition: all 0.3s ease;
                font-size: 14px;
                font-weight: 500;
                position: relative;
                overflow: hidden;
            `;
            
            // Special styling for logout option
            if (option.text === 'Logout') {
                link.style.color = '#dc3545';
                link.style.fontWeight = '600';
            }
            
            link.addEventListener('mouseenter', function() {
                this.style.backgroundColor = 'rgba(220, 53, 69, 0.1)';
                this.style.color = '#dc3545';
                this.style.transform = 'translateX(5px)';
            });
            
            link.addEventListener('mouseleave', function() {
                this.style.backgroundColor = 'transparent';
                this.style.color = option.text === 'Logout' ? '#dc3545' : '#333';
                this.style.transform = 'translateX(0)';
            });
            
            link.onclick = function(e) {
                e.preventDefault();
                // Hide dropdown
                dropdownElement.style.display = 'none';
                // Execute action
                eval(option.action);
            };
            
            const iconElement = document.createElement('i');
            iconElement.className = option.icon;
            iconElement.style.cssText = `
                margin-right: 12px;
                width: 16px;
                text-align: center;
                color: #dc3545;
                font-size: 14px;
            `;
            
            const textElement = document.createElement('span');
            textElement.textContent = option.text;
            
            link.appendChild(iconElement);
            link.appendChild(textElement);
            
            // Remove border from last item
            if (index === loggedInOptions.length - 1) {
                link.style.borderBottom = 'none';
            }
            
            dropdownElement.appendChild(link);
        });
        
    } else {
        // User not logged in - show login/signup options
        const guestOptions = [
            { icon: 'fas fa-sign-in-alt', text: 'Login', action: 'redirectToWelcome()' },
            { icon: 'fas fa-user-plus', text: 'Sign Up', action: 'redirectToWelcome()' },
            { icon: 'fas fa-store', text: 'Seller Login', action: 'redirectToWelcome()' },
            { icon: 'fas fa-handshake', text: 'Dealer Login', action: 'redirectToWelcome()' }
        ];
        
        // Create dropdown items
        guestOptions.forEach((option, index) => {
            const link = document.createElement('a');
            link.href = '#';
            link.style.cssText = `
                display: flex;
                align-items: center;
                padding: 12px 16px;
                text-decoration: none;
                color: #333;
                border-bottom: 1px solid rgba(220, 53, 69, 0.1);
                transition: all 0.3s ease;
                font-size: 14px;
                font-weight: 500;
                position: relative;
                overflow: hidden;
            `;
            
            link.addEventListener('mouseenter', function() {
                this.style.backgroundColor = 'rgba(220, 53, 69, 0.1)';
                this.style.color = '#dc3545';
                this.style.transform = 'translateX(5px)';
            });
            
            link.addEventListener('mouseleave', function() {
                this.style.backgroundColor = 'transparent';
                this.style.color = '#333';
                this.style.transform = 'translateX(0)';
            });
            
            link.onclick = function(e) {
                e.preventDefault();
                // Hide dropdown
                dropdownElement.style.display = 'none';
                // Execute action
                eval(option.action);
            };
            
            const iconElement = document.createElement('i');
            iconElement.className = option.icon;
            iconElement.style.cssText = `
                margin-right: 12px;
                width: 16px;
                text-align: center;
                color: #dc3545;
                font-size: 14px;
            `;
            
            const textElement = document.createElement('span');
            textElement.textContent = option.text;
            
            link.appendChild(iconElement);
            link.appendChild(textElement);
            
            // Remove border from last item
            if (index === guestOptions.length - 1) {
                link.style.borderBottom = 'none';
            }
            
            dropdownElement.appendChild(link);
        });
    }
}

// Add mobile-specific CSS styles with aligned positioning
function addMobileStyles() {
    if (document.getElementById('mobileLoginStyles')) return;
    
    const style = document.createElement('style');
    style.id = 'mobileLoginStyles';
    style.textContent = `
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        /* Mobile user login styles */
        @media (max-width: 768px) {
            .mobile-user-login {
                display: flex !important;
            }
            
            .user-login:not(.mobile-user-login) {
                display: none !important;
            }
            
            .user-dropdown:not(.mobile-user-dropdown) {
                display: none !important;
            }
            
            /* Hide desktop header user elements */
            .header .user-login:not(.mobile-user-login),
            .navbar .user-login:not(.mobile-user-login),
            .nav .user-login:not(.mobile-user-login) {
                display: none !important;
            }
            
            /* Ensure proper alignment with navigation */
            #mobileLoginIcon {
                align-self: center;
            }
        }
        
        @media (min-width: 769px) {
            .mobile-user-login {
                display: none !important;
            }
        }
        
        /* Mobile dropdown specific styles */
        .mobile-user-dropdown-content {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        .mobile-user-dropdown-content a {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .mobile-user-dropdown-content a:hover {
            background-color: rgba(220, 53, 69, 0.1) !important;
            color: #dc3545 !important;
        }
        
        /* Responsive adjustments for different screen sizes */
        @media (max-width: 480px) {
            #mobileLoginIcon {
                width: 36px !important;
                height: 36px !important;
                padding: 6px !important;
            }
            
            #mobileLoginIcon i {
                font-size: 16px !important;
            }
            
            .mobile-user-dropdown-content {
                min-width: 180px !important;
            }
        }
        
        /* Extra small screens */
        @media (max-width: 360px) {
            #mobileLoginIcon {
                width: 32px !important;
                height: 32px !important;
                padding: 4px !important;
            }
            
            #mobileLoginIcon i {
                font-size: 14px !important;
            }
            
            .mobile-user-dropdown-content {
                min-width: 160px !important;
            }
        }
        
        /* Dynamic positioning for different screen sizes */
        @media (max-width: 375px) {
            .mobile-user-dropdown-content {
                right: -5px !important;
            }
        }
        
        @media (max-width: 320px) {
            .mobile-user-dropdown-content {
                right: -10px !important;
            }
        }
        
        /* Ensure consistent spacing between navigation icons */
        @media (max-width: 768px) {
            .cart, [class*="cart"], [id*="cart"],
            .hamburger, [class*="hamburger"], [class*="menu-toggle"],
            #mobileLoginIcon {
                margin: 0 8px;
            }
        }
    `;
    
    document.head.appendChild(style);
}

// Function to initialize mobile login system
function initializeMobileLogin() {
    if (isMobileDevice()) {
        addMobileStyles();
        createMobileLoginIcon();
        updateMobileLoginIcon();
        
        // Hide desktop login elements on mobile
        const desktopLoginElements = document.querySelectorAll('.user-login:not(.mobile-user-login), .user-dropdown:not(.mobile-user-dropdown)');
        desktopLoginElements.forEach(element => {
            element.style.display = 'none';
        });
    }
}

// Function to handle window resize and maintain alignment
function handleMobileResize() {
    const mobileElement = document.getElementById('mobileLoginIcon');
    
    if (isMobileDevice()) {
        if (!mobileElement) {
            initializeMobileLogin();
        } else {
            // Update position on resize to maintain alignment
            updateMobileIconPosition();
        }
    } else {
        if (mobileElement) {
            mobileElement.remove();
        }
        
        // Show desktop login elements
        const desktopLoginElements = document.querySelectorAll('.user-login:not(.mobile-user-login), .user-dropdown:not(.mobile-user-dropdown)');
        desktopLoginElements.forEach(element => {
            element.style.display = '';
        });
    }
}

// Enhanced initialization function that includes mobile support
function initializeUserLoginWithMobile() {
    // Call original initialization
    if (typeof initializeUserLogin === 'function') {
        initializeUserLogin();
    }
    
    // Initialize mobile login
    initializeMobileLogin();
    
    // Add resize listener
    window.addEventListener('resize', handleMobileResize);
    
    // Add orientation change listener for mobile devices
    window.addEventListener('orientationchange', function() {
        setTimeout(updateMobileIconPosition, 100);
    });
    
    // Add scroll listener to maintain position consistency
    window.addEventListener('scroll', function() {
        updateMobileIconPosition();
    });
}

// Override the original updateTopNavigation function to also update mobile element
const originalUpdateTopNavigation = window.updateTopNavigation || updateTopNavigation;
window.updateTopNavigation = function(user, userType) {
    if (typeof originalUpdateTopNavigation === 'function') {
        originalUpdateTopNavigation(user, userType);
    }
    
    // Update mobile element if it exists
    if (document.getElementById('mobileLoginIcon')) {
        updateMobileLoginIcon();
    }
};

// Override the original logout function to update mobile element
const originalLogout = window.logout || logout;
window.logout = function() {
    if (typeof originalLogout === 'function') {
        originalLogout();
    }
    
    // Update mobile element after logout
    setTimeout(() => {
        if (document.getElementById('mobileLoginIcon')) {
            updateMobileLoginIcon();
        }
    }, 100);
};

// Add mobile-specific event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Initialize mobile login system
    initializeUserLoginWithMobile();
    
    // Close mobile dropdown on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const mobileDropdown = document.querySelector('.mobile-user-dropdown-content');
            if (mobileDropdown && mobileDropdown.style.display === 'block') {
                mobileDropdown.style.display = 'none';
            }
        }
    });
    
    // Update position when DOM elements are loaded and periodically
    setTimeout(updateMobileIconPosition, 500);
    setTimeout(updateMobileIconPosition, 1000);
    setTimeout(updateMobileIconPosition, 2000);
    
    // Observer to watch for changes in navigation elements
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList' || mutation.type === 'attributes') {
                setTimeout(updateMobileIconPosition, 100);
            }
        });
    });
    
    // Observe changes in header/navigation area
    const headerElement = document.querySelector('header, nav, .header, .navbar') || document.body;
    observer.observe(headerElement, {
        childList: true,
        subtree: true,
        attributes: true,
        attributeFilter: ['style', 'class']
    });
});

// Export functions for use in other files if needed
window.mobileLogin = {
    initialize: initializeMobileLogin,
    updateIcon: updateMobileLoginIcon,
    updateDropdown: updateMobileDropdownContent,
    handleResize: handleMobileResize,
    addStyles: addMobileStyles,
    updatePosition: updateMobileIconPosition,
    calculatePosition: calculateAlignedPosition
};

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
// ==================== MOBILE MENU FUNCTIONALITY ====================

function initializeMobileMenu() {
    const menuToggle = document.getElementById('menuToggle') || document.getElementById('mobileMenuToggle');
    const closeMenu = document.getElementById('closeMenu');
    const mobileNav = document.getElementById('mobileNav') || document.querySelector('.mobile-nav');
    const overlay = document.getElementById('overlay') || document.querySelector('.overlay');
    const header = document.getElementById('header');
    const body = document.body;
    
    if (menuToggle && mobileNav) {
        // Toggle mobile menu
        menuToggle.addEventListener('click', function() {
            mobileNav.classList.toggle('show');
            if (overlay) overlay.classList.toggle('show');
            menuToggle.classList.toggle('active');
            if (header) header.classList.toggle('menu-open');
            body.classList.toggle('menu-open');
            
            // Animate menu toggle
            menuToggle.classList.add('animate');
            setTimeout(() => {
                menuToggle.classList.remove('animate');
            }, 500);
            
            // Control body overflow
            body.style.overflow = mobileNav.classList.contains('show') ? 'hidden' : '';
        });
    }
    
    if (closeMenu && mobileNav) {
        // Close mobile menu
        closeMenu.addEventListener('click', function() {
            mobileNav.classList.remove('show');
            if (overlay) overlay.classList.remove('show');
            if (menuToggle) menuToggle.classList.remove('active');
            if (header) header.classList.remove('menu-open');
            body.classList.remove('menu-open');
            body.style.overflow = '';
        });
    }
    
    if (overlay && mobileNav) {
        // Close mobile menu when clicking overlay
        overlay.addEventListener('click', function() {
            mobileNav.classList.remove('show');
            overlay.classList.remove('show');
            if (menuToggle) menuToggle.classList.remove('active');
            if (header) header.classList.remove('menu-open');
            body.classList.remove('menu-open');
            body.style.overflow = '';
        });
    }
}

// Mobile Menu Toggle (alternative function)
function toggleMenu() {
    const mobileNav = document.getElementById('mobileNav');
    const overlay = document.getElementById('overlay');
    if (mobileNav && overlay) {
        mobileNav.classList.toggle('show');
        overlay.classList.toggle('show');
        document.body.style.overflow = mobileNav.classList.contains('show') ? 'hidden' : '';
    }
}

// ==================== SLIDER FUNCTIONALITY ====================

let currentSlide = 0;
let autoSlideInterval;

function initializeSlider() {
    const slides = document.getElementById("slides");
    const dotsContainer = document.getElementById("dots");
    
    if (!slides || !dotsContainer) return;
    
    const totalSlides = slides.children.length;
    
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

    window.nextSlide = function() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlider();
    }

    window.prevSlide = function() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlider();
    }

    window.goToSlide = function(index) {
        currentSlide = index;
        updateSlider();
    }

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        autoSlideInterval = setInterval(nextSlide, 5000);
    }

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

// ==================== CART FUNCTIONALITY ====================

let cart = [];

function initializeCart() {
    console.log('DOM loaded, initializing cart...');
    loadCart();
    
    // Add click event listener to cart icon(s)
    const cartIcons = document.querySelectorAll('.cart-icon, #cartIcon, .header-cart, [data-cart-trigger]');
    cartIcons.forEach(icon => {
        icon.addEventListener('click', function(e) {
            e.preventDefault();
            goToCart();
        });
    });
    
    console.log('Cart functionality initialized');
}

// Load cart from in-memory storage (modified for Claude.ai compatibility)
function loadCart() {
    try {
        // In a real implementation, this would load from localStorage/sessionStorage
        // For Claude.ai compatibility, we'll use in-memory storage
        if (window.cartData) {
            cart = window.cartData;
            console.log('Cart loaded:', cart);
            
            // Validate cart items and ensure proper data types
            cart = cart.filter(item => item && item.id).map(item => ({
                id: String(item.id),
                name: item.name || 'Unknown Product',
                brand: item.brand || 'Unknown Brand',
                specs: item.specs || 'Standard Specs',
                price: parseFloat(item.price) || 0,
                qty: parseInt(item.qty) || 1,
                image: item.image || 'https://via.placeholder.com/100x100/333/fff?text=Tire'
            }));
        }
    } catch (e) {
        console.error('Error loading cart:', e);
        cart = [];
    }
    
    // Update cart count after loading
    updateCartCount();
}

// Save cart to in-memory storage (modified for Claude.ai compatibility)
function saveCart() {
    try {
        // For Claude.ai compatibility, save to window object instead of localStorage
        window.cartData = cart;
        console.log('Cart saved:', cart);
        
        // In a real implementation, you would use:
        // localStorage.setItem('unifiedTireShopCart', JSON.stringify(cart));
        // sessionStorage.setItem('unifiedTireShopCart', JSON.stringify(cart));
    } catch (e) {
        console.error('Error saving cart:', e);
    }
}

// Update cart count display
function updateCartCount() {
    const count = cart.reduce((sum, item) => sum + parseInt(item.qty || 0), 0);
    const cartCountElements = document.querySelectorAll('.cart-count, #cartCount');
    
    cartCountElements.forEach(element => {
        if (element) {
            element.textContent = count;
            // Show/hide count badge based on items in cart
            if (count > 0) {
                element.style.display = 'inline-block';
                element.classList.add('has-items');
            } else {
                element.style.display = 'none';
                element.classList.remove('has-items');
            }
        }
    });
    
    console.log('Cart count updated:', count);
}

// Add product to cart
function addToCart(product) {
    // Ensure product has required properties
    if (!product || !product.id) {
        console.error('Invalid product data:', product);
        showToast('Error adding product to cart');
        return;
    }

    const stringId = String(product.id);
    const existingItem = cart.find(item => String(item.id) === stringId);
    
    if (existingItem) {
        existingItem.qty = parseInt(existingItem.qty) + 1;
        showToast(`Updated ${product.name} quantity!`);
    } else {
        const newItem = {
            id: stringId,
            name: product.name || 'Unknown Product',
            brand: product.brand || 'Unknown Brand',
            specs: product.specs || 'Standard Specs',
            price: parseFloat(product.price) || 0,
            qty: 1,
            image: product.image || 'https://via.placeholder.com/100x100/333/fff?text=Tire'
        };
        
        cart.push(newItem);
        showToast(`${product.name} added to cart!`);
    }
    
    console.log('Cart after adding:', cart);
    saveCart();
    updateCartCount();
}

// Redirect to cart page
function goToCart() {
    window.location.href = 'cart.php';
}

// Show toast notification
function showToast(msg) {
    let toast = document.getElementById('toast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'toast';
        toast.className = 'toast';
        toast.style.cssText = `
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
            font-family: Arial, sans-serif;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        `;
        document.body.appendChild(toast);
    }
    
    toast.textContent = msg;
    toast.style.opacity = '1';
    toast.style.transform = 'translateX(0)';
    
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
    }, 3000);
}

// Add to cart button handler for product cards
function handleAddToCartClick(productId) {
    // Sample product data - replace with your actual product data source
    const featuredProducts = [
        {
            id: 'michelin-pilot-sport',
            name: 'Michelin Pilot Sport 4',
            brand: 'Michelin',
            price: 8500,
            image: 'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=200&h=200&fit=crop',
            specs: '205/55 R16 91V'
        },
        {
            id: 'bridgestone-potenza',
            name: 'Bridgestone Potenza RE-71R',
            brand: 'Bridgestone',
            price: 9200,
            image: 'https://images.unsplash.com/photo-1607860108855-64acf2078ed9?w=200&h=200&fit=crop',
            specs: '225/45 R17 94W'
        },
        {
            id: 'continental-sportcontact',
            name: 'Continental SportContact 6',
            brand: 'Continental',
            price: 7800,
            image: 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?w=200&h=200&fit=crop',
            specs: '195/65 R15 91H'
        },
        {
            id: 'pirelli-pzero',
            name: 'Pirelli P Zero',
            brand: 'Pirelli',
            price: 10500,
            image: 'https://images.unsplash.com/photo-1619767886558-efdc259cde1a?w=200&h=200&fit=crop',
            specs: '245/40 R18 97Y'
        },
        {
            id: 'goodyear-eagle',
            name: 'Goodyear Eagle F1 Asymmetric 5',
            brand: 'Goodyear',
            price: 8900,
            image: 'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=200&h=200&fit=crop',
            specs: '215/60 R16 95V'
        },
        {
            id: 'yokohama-advan',
            name: 'Yokohama Advan Sport V105',
            brand: 'Yokohama',
            price: 7500,
            image: 'https://images.unsplash.com/photo-1607860108855-64acf2078ed9?w=200&h=200&fit=crop',
            specs: '185/70 R14 88H'
        }
    ];
    
    const product = featuredProducts.find(p => p.id === productId);
    if (product) {
        addToCart(product);
    } else {
        console.error('Product not found:', productId);
        showToast('Product not found');
    }
}

// ==================== GLOBAL FUNCTIONS ====================

// Make functions globally available
window.addToCart = addToCart;
window.goToCart = goToCart;
window.handleAddToCartClick = handleAddToCartClick;
window.toggleMenu = toggleMenu;
window.logout = logout;

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
