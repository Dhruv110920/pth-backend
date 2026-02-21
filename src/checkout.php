<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Address Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ffffff 0%, #f8f8f8 50%, #ffffff 100%);
            color: #000000;
            min-height: 100vh;
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
        }

        /* Animated background elements */
        .bg-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            opacity: 0.03;
            background-image: 
                radial-gradient(circle at 25% 25%, #dc2626 0%, transparent 70%),
                radial-gradient(circle at 75% 75%, #000000 0%, transparent 70%);
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(1deg); }
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px 0;
            border-bottom: 3px solid #dc2626;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #ffffff, #f9f9f9);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(220, 38, 38, 0.1), transparent);
            animation: shine 3s ease-in-out infinite;
        }

        @keyframes shine {
            0% { left: -100%; }
            50% { left: 100%; }
            100% { left: 100%; }
        }

        .header h1 {
            font-size: 3rem;
            background: linear-gradient(135deg, #dc2626, #000000, #dc2626);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
            font-weight: 900;
            text-shadow: 0 0 30px rgba(220, 38, 38, 0.3);
            animation: gradientShift 4s ease-in-out infinite;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .header p {
            font-size: 1.2rem;
            color: #666666;
            font-weight: 300;
        }

        .checkout-container {
            max-width: 900px;
            margin: 0 auto;
            margin-bottom: 30px;
        }

        .address-section {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(248, 248, 248, 0.9));
            border-radius: 20px;
            padding: 30px;
            border: 2px solid rgba(220, 38, 38, 0.2);
            backdrop-filter: blur(15px);
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            position: relative;
            overflow: hidden;
        }

        .address-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #dc2626, #000000, #dc2626);
            background-size: 200% 100%;
            animation: borderGlow 3s linear infinite;
        }

        @keyframes borderGlow {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .section-title {
            font-size: 1.8rem;
            color: #dc2626;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(220, 38, 38, 0.2);
        }

        .address-form {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 248, 248, 0.8));
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid rgba(220, 38, 38, 0.15);
            box-shadow: 
                inset 0 2px 10px rgba(0, 0, 0, 0.05),
                0 5px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(10px);
            opacity: 0;
            animation: slideIn 0.5s ease-out forwards;
        }

        @keyframes slideIn {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #000000;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.9);
            color: #000000;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #dc2626;
            background: rgba(220, 38, 38, 0.05);
            box-shadow: 
                0 0 0 4px rgba(220, 38, 38, 0.1),
                0 0 20px rgba(220, 38, 38, 0.15);
            transform: translateY(-2px);
        }

        .form-group textarea {
            height: 100px;
            resize: vertical;
            font-family: inherit;
        }

        .form-buttons {
            display: flex;
            gap: 15px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            min-width: 140px;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: #ffffff;
            box-shadow: 
                0 8px 25px rgba(220, 38, 38, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            border: 2px solid transparent;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #b91c1c, #991b1b);
            transform: translateY(-3px) scale(1.02);
            box-shadow: 
                0 12px 35px rgba(220, 38, 38, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.9));
            color: #ffffff;
            border: 2px solid rgba(0, 0, 0, 0.2);
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 1));
            border-color: rgba(0, 0, 0, 0.4);
            transform: translateY(-3px) scale(1.02);
        }

        .btn-danger {
            background: linear-gradient(135deg, #7f1d1d, #991b1b);
            color: #ffffff;
            border: 2px solid rgba(127, 29, 29, 0.5);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #991b1b, #b91c1c);
            transform: translateY(-3px) scale(1.02);
        }

        .saved-addresses {
            margin-top: 30px;
        }

        .address-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(248, 248, 248, 0.9));
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .address-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(220, 38, 38, 0.1), transparent);
            transition: left 0.3s ease;
        }

        .address-card:hover {
            border-color: rgba(220, 38, 38, 0.4);
            transform: translateY(-5px) scale(1.02);
            box-shadow: 
                0 15px 35px rgba(0, 0, 0, 0.15),
                0 0 30px rgba(220, 38, 38, 0.1);
        }

        .address-card:hover::before {
            left: 100%;
        }

        .address-card.selected {
            border-color: #dc2626;
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.1), rgba(255, 255, 255, 0.95));
            box-shadow: 
                0 0 30px rgba(220, 38, 38, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .address-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .address-name {
            font-weight: 700;
            color: #dc2626;
            font-size: 1.2rem;
            text-shadow: 0 2px 4px rgba(220, 38, 38, 0.2);
        }

        .address-actions {
            display: flex;
            gap: 10px;
        }

        .btn-small {
            padding: 8px 16px;
            font-size: 12px;
            border-radius: 8px;
            min-width: auto;
        }

        .address-details {
            color: #333333;
            font-size: 15px;
            line-height: 1.6;
            background: rgba(255, 255, 255, 0.7);
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #dc2626;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .address-details strong {
            color: #000000;
        }

        .hidden {
            display: none;
        }

        .add-address-btn {
            width: 100%;
            margin-bottom: 25px;
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: #ffffff;
            border: 3px dashed rgba(220, 38, 38, 0.4);
            font-size: 16px;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .add-address-btn:hover {
            background: linear-gradient(135deg, #b91c1c, #991b1b);
            border-color: rgba(220, 38, 38, 0.7);
            transform: translateY(-2px);
        }

        .no-addresses {
            text-align: center;
            color: #666666;
            padding: 60px 20px;
            font-style: italic;
            font-size: 18px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 248, 248, 0.8));
            border-radius: 15px;
            border: 2px dashed rgba(0, 0, 0, 0.1);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            padding: 30px 0;
            border-top: 2px solid rgba(220, 38, 38, 0.2);
            flex-wrap: wrap;
            gap: 15px;
        }

        .btn-large {
            padding: 18px 40px;
            font-size: 18px;
            font-weight: 800;
            border-radius: 15px;
            min-width: 200px;
        }

        #continueToPayment:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            transform: none !important;
        }

        #continueToPayment:disabled:hover {
            transform: none !important;
            box-shadow: 0 8px 25px rgba(220, 38, 38, 0.3) !important;
        }

        /* Loading animation */
        .loading {
            position: relative;
            pointer-events: none;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Success notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transform: translateX(400px);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .notification.show {
            transform: translateX(0);
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.2rem;
            }
            
            .navigation-buttons {
                flex-direction: column;
                align-items: stretch;
            }
            
            .btn-large {
                width: 100%;
                min-width: auto;
            }
            
            .address-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .address-actions {
                align-self: flex-end;
            }
            
            .form-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }
            
            .address-section {
                padding: 20px;
            }
            
            .header h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="bg-pattern"></div>
    
    <div class="container">
        <div class="header">
            <h1>🛒 Checkout</h1>
            <p>Secure & Fast Delivery Address Management</p>
        </div>

        <div class="checkout-container">
            <div class="address-section">
                <h2 class="section-title">📍 Delivery Address</h2>
                
                <button class="btn btn-primary add-address-btn" onclick="showAddressForm()">
                    ➕ Add New Address
                </button>

                <div id="addressForm" class="address-form hidden">
                    <h3 style="margin-bottom: 20px; color: #dc2626; font-size: 1.3rem; font-weight: 700;">Add New Address</h3>
                    <form id="newAddressForm">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required placeholder="Enter your full name">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required placeholder="+91 98765 43210">
                        </div>
                        
                        <div class="form-group">
                            <label for="pincode">PIN Code *</label>
                            <input type="text" id="pincode" name="pincode" required placeholder="110001">
                        </div>
                        
                        <div class="form-group">
                            <label for="state">State *</label>
                            <input type="text" id="state" name="state" required placeholder="Delhi">
                        </div>
                        
                        <div class="form-group">
                            <label for="city">City *</label>
                            <input type="text" id="city" name="city" required placeholder="New Delhi">
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Full Address *</label>
                            <textarea id="address" name="address" placeholder="House No, Building Name, Street, Area, Landmark" required></textarea>
                        </div>
                        
                        <div class="form-buttons">
                            <button type="submit" class="btn btn-primary">💾 Save Address</button>
                            <button type="button" class="btn btn-secondary" onclick="cancelAddressForm()">❌ Cancel</button>
                        </div>
                    </form>
                </div>

                <div class="saved-addresses">
                    <h3 style="margin-bottom: 20px; color: #dc2626; font-size: 1.3rem; font-weight: 700;">Saved Addresses</h3>
                    <div id="addressList">
                        <div class="no-addresses">
                            📭 No addresses saved yet.<br>Add your first address above to get started!
                        </div>
                    </div>
                </div>

                <div class="navigation-buttons">
                    <button class="btn btn-secondary btn-large" onclick="goHome()">
                        🏠 Back to Home
                    </button>
                    
                    <button id="continueToPayment" class="btn btn-primary btn-large" onclick="proceedToPayment()" disabled>
                        💳 Continue to Payment
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="notification" class="notification"></div>
<script src="path/to/user-detector.js"></script>
    <script>
    let addresses = [];
let selectedAddressId = null;
let editingAddressId = null;

// Load addresses from localStorage on page load
function loadAddresses() {
    try {
        const savedAddresses = localStorage.getItem('userAddresses');
        if (savedAddresses) {
            addresses = JSON.parse(savedAddresses);
        }
    } catch (error) {
        console.error('Error loading addresses:', error);
        addresses = [];
    }
    renderAddresses();
}

// Save addresses to localStorage
function saveAddresses() {
    try {
        localStorage.setItem('userAddresses', JSON.stringify(addresses));
        
        // Also save selected address ID
        if (selectedAddressId) {
            localStorage.setItem('selectedAddressId', selectedAddressId);
        }
    } catch (error) {
        console.error('Error saving addresses:', error);
        showNotification('⚠️ Failed to save address. Please try again.', 'error');
    }
}

// Load selected address ID
function loadSelectedAddress() {
    try {
        const savedSelectedId = localStorage.getItem('selectedAddressId');
        if (savedSelectedId && addresses.find(addr => addr.id === savedSelectedId)) {
            selectedAddressId = savedSelectedId;
        }
    } catch (error) {
        console.error('Error loading selected address:', error);
    }
}

function showNotification(message, type = 'success') {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.classList.add('show');
    
    setTimeout(() => {
        notification.classList.remove('show');
    }, 3000);
}

function showAddressForm() {
    const form = document.getElementById('addressForm');
    form.classList.remove('hidden');
    editingAddressId = null;
    document.getElementById('newAddressForm').reset();
    document.querySelector('#addressForm h3').textContent = 'Add New Address';
    document.querySelector('#newAddressForm button[type="submit"]').innerHTML = '💾 Save Address';
    
    // Focus first input
    setTimeout(() => {
        document.getElementById('name').focus();
    }, 300);
}

function cancelAddressForm() {
    const form = document.getElementById('addressForm');
    form.style.transform = 'translateY(-10px)';
    form.style.opacity = '0';
    
    setTimeout(() => {
        form.classList.add('hidden');
        form.style.transform = '';
        form.style.opacity = '';
        document.getElementById('newAddressForm').reset();
        editingAddressId = null;
    }, 300);
}

function generateId() {
    return Date.now().toString(36) + Math.random().toString(36).substr(2);
}

document.getElementById('newAddressForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = e.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    // Add loading state
    submitBtn.classList.add('loading');
    submitBtn.innerHTML = '';
    submitBtn.disabled = true;
    
    // Simulate saving delay for better UX
    setTimeout(() => {
        const formData = new FormData(e.target);
        const addressData = {
            id: editingAddressId || generateId(),
            name: formData.get('name'),
            phone: formData.get('phone'),
            pincode: formData.get('pincode'),
            state: formData.get('state'),
            city: formData.get('city'),
            address: formData.get('address'),
            country: 'India',
            createdAt: new Date().toISOString(), // Add timestamp
            updatedAt: new Date().toISOString()
        };

        if (editingAddressId) {
            // Update existing address
            const index = addresses.findIndex(addr => addr.id === editingAddressId);
            if (index !== -1) {
                addressData.createdAt = addresses[index].createdAt; // Preserve original creation date
                addresses[index] = addressData;
                showNotification('✅ Address updated successfully!');
            }
        } else {
            // Add new address
            addresses.push(addressData);
            showNotification('✅ Address added successfully!');
        }

        saveAddresses(); // This will now persist to localStorage
        renderAddresses();
        cancelAddressForm();
        
        // Auto-select the newly added/updated address
        selectAddress(addressData.id);
        
        // Remove loading state
        submitBtn.classList.remove('loading');
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 1000);
});

function renderAddresses() {
    const addressList = document.getElementById('addressList');
    
    if (addresses.length === 0) {
        addressList.innerHTML = '<div class="no-addresses">📭 No addresses saved yet.<br>Add your first address above to get started!</div>';
        updateContinueButton();
        return;
    }

    addressList.innerHTML = addresses.map(addr => `
        <div class="address-card ${selectedAddressId === addr.id ? 'selected' : ''}" onclick="selectAddress('${addr.id}')">
            <div class="address-header">
                <div class="address-name">${addr.name}</div>
                <div class="address-actions">
                    <button class="btn btn-secondary btn-small" onclick="editAddress('${addr.id}'); event.stopPropagation();" title="Edit Address">
                        ✏️ Edit
                    </button>
                    <button class="btn btn-danger btn-small" onclick="deleteAddress('${addr.id}'); event.stopPropagation();" title="Delete Address">
                        🗑️ Delete
                    </button>
                </div>
            </div>
            <div class="address-details">
                <strong>📞 Phone:</strong> ${addr.phone}<br>
                <strong>📍 Address:</strong> ${addr.address}<br>
                <strong>🏙️ Location:</strong> ${addr.city}, ${addr.state} - ${addr.pincode}<br>
                <strong>🇮🇳 Country:</strong> ${addr.country}
            </div>
        </div>
    `).join('');
    
    updateContinueButton();
}

function selectAddress(addressId) {
    selectedAddressId = addressId;
    saveAddresses(); // Save the selection immediately
    renderAddresses();
    showNotification('📍 Address selected for delivery!');
}

function editAddress(addressId) {
    const address = addresses.find(addr => addr.id === addressId);
    if (!address) return;

    editingAddressId = addressId;
    
    // Fill form with existing data
    document.getElementById('name').value = address.name;
    document.getElementById('phone').value = address.phone;
    document.getElementById('pincode').value = address.pincode;
    document.getElementById('state').value = address.state;
    document.getElementById('city').value = address.city;
    document.getElementById('address').value = address.address;
    
    // Update form title and button
    document.querySelector('#addressForm h3').textContent = 'Edit Address';
    document.querySelector('#newAddressForm button[type="submit"]').innerHTML = '💾 Update Address';
    
    // Show form with animation
    showAddressForm();
}

function deleteAddress(addressId) {
    const address = addresses.find(addr => addr.id === addressId);
    if (!address) return;
    
    if (confirm(`Are you sure you want to delete the address for "${address.name}"?\n\nThis action cannot be undone.`)) {
        addresses = addresses.filter(addr => addr.id !== addressId);
        
        // If the deleted address was selected, clear selection
        if (selectedAddressId === addressId) {
            selectedAddressId = null;
            localStorage.removeItem('selectedAddressId');
        }
        
        saveAddresses();
        renderAddresses();
        showNotification('🗑️ Address deleted successfully!');
    }
}

function updateContinueButton() {
    const continueBtn = document.getElementById('continueToPayment');
    continueBtn.disabled = !selectedAddressId;
}

function goHome() {
    window.location.href = 'index.php';
}

function proceedToPayment() {
    if (!selectedAddressId) {
        showNotification('⚠️ Please select a delivery address first!', 'warning');
        return;
    }
    
    const continueBtn = document.getElementById('continueToPayment');
    const originalText = continueBtn.innerHTML;
    
    // Add loading state
    continueBtn.classList.add('loading');
    continueBtn.innerHTML = '';
    continueBtn.disabled = true;
    
    // Save selected address to localStorage for payment page
    const selectedAddress = addresses.find(addr => addr.id === selectedAddressId);
    localStorage.setItem('selectedDeliveryAddress', JSON.stringify(selectedAddress));
    
    // Simulate loading and redirect
    setTimeout(() => {
        window.location.href = 'payment.php';
    }, 1500);
}

// Clear all saved data (useful for testing or reset functionality)
function clearAllAddresses() {
    if (confirm('Are you sure you want to delete ALL saved addresses? This cannot be undone.')) {
        localStorage.removeItem('userAddresses');
        localStorage.removeItem('selectedAddressId');
        localStorage.removeItem('selectedDeliveryAddress');
        addresses = [];
        selectedAddressId = null;
        renderAddresses();
        showNotification('🗑️ All addresses cleared successfully!');
    }
}

// Initialize page
window.addEventListener('load', function() {
    loadAddresses();
    loadSelectedAddress(); // Load previously selected address
});

// Optional: Handle page visibility changes to save data
document.addEventListener('visibilitychange', function() {
    if (document.visibilityState === 'hidden') {
        saveAddresses(); // Save when user switches tabs or minimizes
    }
});

// Optional: Save before page unload
window.addEventListener('beforeunload', function() {
    saveAddresses();
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
    </script>
</body>
</html>