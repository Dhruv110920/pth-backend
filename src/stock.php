<?php
require_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tire Stock Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: white;
            color: #333;
            line-height: 1.6;
        }

        .header {
            background: linear-gradient(135deg, #dc2626, #991b1b);
            color: white;
            padding: 2rem 0;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .stats-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .stat-card {
            background: white;
            border: 2px solid #dc2626;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            flex: 1;
            min-width: 200px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #dc2626;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .controls-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .search-bar {
            flex: 1;
            min-width: 300px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 1rem 1.5rem;
            border: 2px solid #e5e5e5;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .reset-btn {
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .reset-btn:hover {
            background: linear-gradient(135deg, #d97706, #b45309);
            transform: translateY(-2px);
        }

        .stock-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
        }

        .stock-card {
            background: white;
            border-radius: 15px;
            border: 1px solid #e5e5e5;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .stock-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .card-header {
            background: linear-gradient(135deg, #1f2937, #374151);
            color: white;
            padding: 1.5rem;
        }

        .tire-name {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .tire-brand {
            color: #dc2626;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .tire-specs {
            color: #d1d5db;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .price-stock-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #dc2626;
        }

        .stock-level {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stock-number {
            font-size: 1.3rem;
            font-weight: bold;
            color: #1f2937;
        }

        .stock-label {
            color: #666;
            font-size: 0.9rem;
        }

        .stock-status {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .in-stock {
            background: #dcfce7;
            color: #166534;
        }

        .low-stock {
            background: #fef3c7;
            color: #92400e;
        }

        .out-of-stock {
            background: #fecaca;
            color: #991b1b;
        }

        .stock-controls {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .quantity-input {
            flex: 1;
            padding: 0.7rem;
            border: 2px solid #e5e5e5;
            border-radius: 8px;
            text-align: center;
            font-size: 1rem;
        }

        .quantity-input:focus {
            outline: none;
            border-color: #dc2626;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            flex: 1;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-stock-in {
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: white;
        }

        .btn-stock-in:hover {
            background: linear-gradient(135deg, #15803d, #166534);
            transform: translateY(-2px);
        }

        .btn-stock-out {
            background: linear-gradient(135deg, #dc2626, #991b1b);
            color: white;
        }

        .btn-stock-out:hover {
            background: linear-gradient(135deg, #991b1b, #7f1d1d);
            transform: translateY(-2px);
        }

        .btn:active {
            transform: translateY(0);
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            z-index: 1000;
            transform: translateX(400px);
            transition: transform 0.3s ease;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success {
            background: linear-gradient(135deg, #16a34a, #15803d);
        }

        .notification.error {
            background: linear-gradient(135deg, #dc2626, #991b1b);
        }

        .notification.info {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .header h1 {
                font-size: 2rem;
            }

            .stock-grid {
                grid-template-columns: 1fr;
            }

            .stats-bar {
                flex-direction: column;
            }

            .action-buttons {
                flex-direction: column;
            }

            .controls-section {
                flex-direction: column;
                align-items: stretch;
            }

            .search-bar {
                min-width: auto;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🛞 Tire Stock Management</h1>
        <p>Efficient inventory control for your tire business</p>
    </div>

    <div class="container">
        <div class="stats-bar">
            <div class="stat-card">
                <div class="stat-number" id="total-items">68</div>
                <div class="stat-label">Total Items</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="total-stock">0</div>
                <div class="stat-label">Total Stock</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="low-stock-count">0</div>
                <div class="stat-label">Low Stock Items</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="total-value">₹0</div>
                <div class="stat-label">Total Inventory Value</div>
            </div>
        </div>

        <div class="controls-section">
            <div class="search-bar">
                <input type="text" class="search-input" id="search-input" placeholder="Search tires by name, brand, or specs...">
            </div>
            <button class="reset-btn" onclick="resetAllStock()">Reset All Stock</button>
        </div>

        <div class="stock-grid" id="stock-grid">
            <!-- Stock cards will be generated here -->
        </div>
    </div>

    <script>
  // Firebase Configuration - Replace with your own Firebase config
const firebaseConfig = {
    apiKey: "your-api-key-here",
    authDomain: "your-project.firebaseapp.com",
    projectId: "your-project-id",
    storageBucket: "your-project.appspot.com",
    messagingSenderId: "123456789",
    appId: "your-app-id"
};

// Initialize Firebase (Make sure to include Firebase SDK in your HTML)
let db = null;
let isFirebaseAvailable = false;

// Check if Firebase is available and initialize
function initializeFirebase() {
    try {
        if (typeof firebase !== 'undefined') {
            firebase.initializeApp(firebaseConfig);
            db = firebase.firestore();
            isFirebaseAvailable = true;
            console.log('✅ Firebase initialized successfully');
            setupRealtimeSync();
        } else {
            console.warn('⚠️ Firebase not available, falling back to localStorage');
            isFirebaseAvailable = false;
        }
    } catch (error) {
        console.error('❌ Firebase initialization failed:', error);
        isFirebaseAvailable = false;
    }
}

// Tire data
const tires = [
    {
        id: 1,
        name: "M751 HL",
        brand: "Bridgestone",
        specs: "295/90 R 20",
        price: 27700,
        image: "m751hl.jpg",
        redirectPage: "m751hl.php"
    },
    {
       id: 2,
        name: "R271",
        brand: "Bridgestone",
        specs: "295/90 R20",
        price: 26650,
        image: "R271.png",
        redirectPage: "R271.php"
    },
    {
        id: 3,
        name: "M725",
        brand: "Bridgestone",
        specs: "295/90 R20",
        price: 27000,
        image: "M725.jpg",
        redirectPage: "M725.php"
    },
    {
         id: 4,
        name: "R156(TL)",
        brand: "Bridgestone",
        specs: "295/80 R22.5",
        price: 27250,
        image: "R156.png",
        redirectPage: "R156.php"
    },
    {
         id: 5,
        name: "G611",
        brand: "Bridgestone",
        specs: "295/90 R20",
        price: 26800,
        image: "G611.png",
        redirectPage: "G611.php"
    },
    {
        id: 6,
         name: "BOSS TS 10",
        brand: "Ascenso",
        specs: "6.00-16",
        price: 3906,
        image: "ts-10.png",
        redirectPage: "TS.php"
    },
    {
        id: 7,
        name: "BOSS TS 10",
        brand: "Ascenso",
        specs: "6.50-16",
        price: 5053,
        image: "ts-10.png",
        redirectPage: "Ts.php"
    },
    {
         id: 8,
       name: "BOSS TS 10",
        brand: "Ascenso",
        specs: "7.50-16",
        price: 6085,
        image: "ts-10.png",
        redirectPage: "tS.php"
    },
    {
         id: 9,
        name: "BOSS TD 16",
        brand: "Ascenso",
        specs: "3.6-28",
        price: 20575,
        image: "td-16.png",
        redirectPage: "td-16.php"
    },
    {
        id: 10,
       name: "BOSS TD 16",
        brand: "Ascenso",
        specs: "4.9-28",
        price: 24107,
        image: "td-16.png",
        redirectPage: "Td.php"
    },
    {
         id: 11,
       name: "BOSS TD 16",
        brand: "Ascenso",
        specs: "6.9-28",
        price: 28520,
        image: "td-16.png",
        redirectPage: "tD.php"
    },
    {
        id: 12,
       name: "TDB 120",
        brand: "Ascenso",
        specs: "8.00-18 HD",
        price: 6573,
        image: "tdb120.png",
        redirectPage: "TDB.php"
    },
    {
        id: 13,
       name: "TDB 120",
        brand: "Ascenso",
        specs: "9.5-24",
        price: 10186,
        image: "tdb120.png",
        redirectPage: "tDB.php"
    },
    {
        id: 14,
      name: "TDB 120",
        brand: "Ascenso",
        specs: "9.5-24",
        price: 7724,
        image: "tdb120.png",
        redirectPage: "TDb.php"
    },
    {
        id: 15,
       name: "BOSS TR 20",
        brand: "Ascenso",
        specs: "9.00-16",
        price: 13048,
        image: "tr20.png",
        redirectPage: "TR.php"
    },
    {
        id: 16,
       name: "BOSS TR 21",
        brand: "Ascenso",
        specs: "10.00-20",
        price: 20247,
        image: "tr21.png",
        redirectPage: "tR.php"
    },
    {
        id: 17,
        name: "Endu Race LD",
        brand: "Apollo",
        specs: "295/90 R 20",
        price: 26400,
        image: "LD.png",
        redirectPage: "LD.php"
    },
    {
        id: 18,
        name: "Endu Race RD HD",
        brand: "Apollo",
        specs: "295/90 R20",
        price: 26500,
        image: "RDHD.png",
        redirectPage: "RDHA.php"
    },
    {
        id: 19,
        name: "Endu Race ED",
        brand: "Apollo",
        specs: "295/90 R20",
        price: 24500,
        image: "ED.png",
        redirectPage: "ED.php"
    },
    {
        id: 20,
        name: "Endu Race RA",
        brand: "Apollo",
        specs: "295/80 R20",
        price: 24400,
        image: "RA.png",
        redirectPage: "RA.php"
    },
    {
        id: 21,
        name: " Endu Race RA NRG",
        brand: "Apollo",
        specs: "295/90 R20",
        price: 24100,
        image: "NRG.png",
        redirectPage: "NRG.php"
    },
    {
        id: 22,
        name: " Endu Race RD NRG",
        brand: "Apollo",
        specs: "295/90 R20",
        price: 24650,
        image: "RDNRG.png",
        redirectPage: "RDNRG.php"
    },
    {
        id: 23,
        name: " Endu Race RA(T)",
        brand: "Apollo",
        specs: "295/90 R20",
        price: 24700,
        image: "RA(T).png",
        redirectPage: "RA(T).php"
    },
    {
        id: 24,
        name: " Endu Mile LHD",
        brand: "Apollo",
        specs: "295/90 R20",
        price: 25800,
        image: "LHD.png",
        redirectPage: "LHD.htmll"
    },
    {
        id: 25,
        name: " Endu Trax MA",
        brand: "Apollo",
        specs: "295/90 R20",
        price: 24100,
        image: "MA.png",
        redirectPage: "MA.php"
    },
    {
        id: 26,
        name: " Endu Trax MD+",
        brand: "Apollo",
        specs: "295/90 R20",
        price: 26050,
        image: "MD+.png",
        redirectPage: "MD+.php"
    },
    {
        id: 27,
        name: " Endu Race LD+",
        brand: "Apollo",
        specs: "9.00 R20",
        price: 20900,
        image: "LD+.png",
        redirectPage: "LD+.php"
    },
    {
        id: 28,
        name: " Endu Race RA",
        brand: "Apollo",
        specs: "9.00 R20",
        price: 19900,
        image: "RA.png",
        redirectPage: "ra.php"
    },
    {
        id: 29,
        name: " Endu Race LD",
        brand: "Apollo",
        specs: "8.25 R20",
        price: 18700,
        image: "LD.png",
        redirectPage: "ld.php"
    },
    {
        id: 30,
        name: " Endu Race RA",
        brand: "Apollo",
        specs: "8.25 R20",
        price: 17600,
        image: "RA.png",
        redirectPage: "rA.php"
    },
    {
        id: 31,
        name: " Endu Trax MD",
        brand: "Apollo",
        specs: "11.00 R20",
        price: 28000,
        image: "MD.png",
        redirectPage: "MD.php"
    },
    {
        id: 32,
        name: "  Endu Trax MA",
        brand: "Apollo",
        specs: "11.00 R20",
        price: 26650,
        image: "MA.png",
        redirectPage: "ma.php"
    },
    {
        id: 33,
        name: " Endu Race RA(N) TL-D ",
        brand: "Apollo",
        specs: "235/75 R17.5",
        price: 15249,
        image: "RA.png",
        redirectPage: "TL-D.php"
    },
    {
        id: 34,
        name: " Endu Race LD-D",
        brand: "Apollo",
        specs: "8.25 R16",
        price: 13940,
        image: "LD-D.png",
        redirectPage: "LD-D.php"
    },
    {
        id: 35,
        name: "  Endu Race RA-D",
        brand: "Apollo",
        specs: "8.25 R16",
        price: 13693,
        image: "RA.png",
        redirectPage: "RA-D.php"
    },
    {
        id: 36,
        name: " Endu Maxx LT HD(LV)-D",
        brand: "Apollo",
        specs: "7.00 R15",
        price: 8944,
        image: "LTHD.png",
        redirectPage: "LTHD.php"
    },
    {
        id: 37,
        name: " VIHAAN LUG (SV)-D",
        brand: "Apollo",
        specs: "7.00 R15",
        price: 8267,
        image: "lug.png",
        redirectPage: "LUG.php"
    },
    {
        id: 38,
        name: " VIHAAN RIB (SV)-D",
        brand: "Apollo",
        specs: "7.00 R15",
        price: 7148,
        image: "rib.png",
        redirectPage: "RIB.php"
    },
    {
        id: 39,
        name: " VIHAAN LUG (SV)-D",
        brand: "Apollo",
        specs: "7.00 R15",
        price: 8267,
        image: "lug.png",
        redirectPage: "LUG.php"
    },
    {
        id: 40,
        name: " VIHAAN LUG-D",
        brand: "Apollo",
        specs: "8.25 R16",
        price: 11977,
        image: "lug.png",
        redirectPage: "LUG-D.php"
    },
    {
        id: 41,
        name: " VIHAAN LUG HD-D",
        brand: "Apollo",
        specs: "8.25 R16",
        price: 12262,
        image: "lug.png",
        redirectPage: "LUGHD-D.php"
    },
    {
        id: 42,
        name: "  VIHAAN RIB-D",
        brand: "Apollo",
        specs: "8.25 R16",
        price: 10549,
        image: "rib.png",
        redirectPage: "RIB-D.php"
    },
    {
        id: 43,
        name: " Endu Comfort CA2",
        brand: "Apollo",
        specs: "295/80 R22.5",
        price: 25139,
        image: "ca2.png",
        redirectPage: "CA2.php"
    },
    {
        id: 44,
        name: "  Endu Race RA(N)",
        brand: "Apollo",
        specs: "295/80 R22.5",
        price: 24776,
        image: "RA.png",
        redirectPage: "RA(N).php"
    },
    {
        id: 45,
        name: " Endu Race RD",
        brand: "Apollo",
        specs: "295/80 R22.5",
        price: 25910,
        image: "rd.png",
        redirectPage: "RD.php"
    },
    {
        id: 46,
        name: " XT7 Gold HD-D",
        brand: "Apollo",
        specs: "9.00-20",
        price: 17246,
        image: "xt7.png",
        redirectPage: "XT7.php"
    },
    { 
        id: 47,
        name: " Amar Gold-D",
        brand: "Apollo",
        specs: "9.00-20",
        price: 16047,
        image: "amar.webp",
        redirectPage: "Amar.php"
    },
    {
        id: 48,
        name: " XT7 Gold HD-D",
        brand: "Apollo",
        specs: "8.25-20",
        price: 15719,
        image: "xt7.png",
        redirectPage: "XT7-D.php"
    },
    {
        id: 49,
        name: "  Amar Gold-D",
        brand: "Apollo",
        specs: "8.25-20",
        price: 13401,
        image: "amar.webp",
        redirectPage: "Amar-D.php"
    },
    {
        id: 50,
        name: " Amar Gold-D",
        brand: "Apollo",
        specs: "295/95 D20",
        price: 18477,
        image: "amar.webp",
        redirectPage: "amar-D.php"
    },
    {
        id: 51,
        name: " XT7 Gold HD-D",
        brand: "Apollo",
        specs: "10.00-20",
        price: 20428,
        image: "xt7.png",
        redirectPage: "XT7-d.php"
    },
    {
        id: 52,
        name: " Terra BT-D",
        brand: "Apollo",
        specs: "10.00-20",
        price: 22964,
        image: "terra.png",
        redirectPage: "Terra.php"
    },
    {
        id: 53,
        name: " Amar Deluxe X-D",
        brand: "Apollo",
        specs: "10.00-20",
        price: 17619,
        image: "deluxe.png",
        redirectPage: "Deluxe.php"
    },
    {
        id: 54,
        name: " XT 100 HD X-D",
        brand: "Apollo",
        specs: "10.00-20",
        price: 19624,
        image: "xt100.png",
        redirectPage: "XT.php"
    },
    {
        id: 55,
        name: " Haulug X-D",
        brand: "Apollo",
        specs: "10.00-20",
        price: 18827,
        image: "haulage.png",
        redirectPage: "Haulug.php"
    },
    {
        id: 56,
        name: " XT9 Gold-D",
        brand: "Apollo",
        specs: "295/95 D20",
        price: 19640,
        image: "xt9.png",
        redirectPage: "XT9.php"
    },
    {
        id: 57,
        name: " XT-100 HD-D",
        brand: "Apollo",
        specs: "295/95 D20",
        price: 20413,
        image: "xt100.png",
        redirectPage: "XT-100.php"
    },
    {
        id: 58,
        name: "Jet R Miles",
        brand: "JK",
        specs: "295/90 D20",
        price: 17566,
        image: "Rmile.png",
        redirectPage: "R.php"
    },
    {
        id: 59,
        name: "Jet R Xtra Miles",
        brand: "JK",
        specs: "10.00-20",
        price: 17831,
        image: "Rxtra.png",
        redirectPage: "RX.php"
    },
    {
        id: 60,
       name: "Jet Xtra XLM",
        brand: "JK",
        specs: "10.00-20",
        price: 19410,
        image: "XLM.png",
        redirectPage: "X.php"
    },
    {
        id: 61,
        name: "Vikrant Trak LUG+",
        brand: "JK",
        specs: "10.00-20",
        price: 16825,
        image: "lug+.png",
        redirectPage: "LUG+.php"
    },
    {
        id: 62,
       name: "JUH 5",
        brand: "JK",
        specs: "295/90 R20",
        price: 23523,
        image: "juh5.png",
        redirectPage: "JUH5.php"
    },
    {
        id: 63,
       name: "JDE++",
        brand: "JK",
        specs: "295/90 R20",
        price: 24965,
        image: "jde++.jpg",
        redirectPage: "jde++.php"
    },
    {
        id: 64,
       name: "JDC XD",
        brand: "JK",
        specs: "295/90 R20",
        price: 24855,
        image: "jdc.png",
        redirectPage: "jdc.php"
    },
    {
        id: 65,
        name: "X Multi Energy Z+",
        brand: "Michelin",
        specs: "295/80 R 22.5",
        price: 25187,
        image: "Z+.png.webp",
        redirectPage: "Z+.php"
    },
    {
        id: 66,
        name: "X Multi Energy D",
        brand: "Michelin",
        specs: "295/80 R22.5",
        price: 27700,
        image: "D.png.webp",
        redirectPage: "D.php"
    },
    {
        id: 67,
        name: "X Multi Z 2",
        brand: "Michelin",
        specs: "295/80 R22.5",
        price: 24551,
        image: "Z2.png.webp",
        redirectPage: "Z2.php"
    },
    {
        id: 68,
        name: "X Multi D+",
        brand: "Michelin",
        specs: "295/80 R22.5",
        price: 25426,
        image: "D+.png.webp",
        redirectPage: "D+.php"
    }
];

// Stock management system
let stockLevels = {};
let filteredTires = [...tires];
let isUpdating = false;
let lastSyncTime = 0;
let stockHistory = [];

// Firestore real-time synchronization
function setupRealtimeSync() {
    if (!isFirebaseAvailable || !db) {
        console.warn('⚠️ Firebase not available for real-time sync');
        return;
    }

    try {
        // Listen for real-time stock updates
        db.collection('tireStock').doc('inventory')
            .onSnapshot((doc) => {
                if (!isUpdating && doc.exists) {
                    const data = doc.data();
                    const serverLastUpdate = data.lastUpdate || 0;
                    
                    // Only update if server data is newer
                    if (serverLastUpdate > lastSyncTime) {
                        console.log('🔄 Receiving real-time stock update from server');
                        stockLevels = data.stockLevels || {};
                        lastSyncTime = serverLastUpdate;
                        
                        renderStockCards();
                        updateStatistics();
                        
                        // Show notification for real-time updates
                        showNotification('📱 Stock updated from another device', 'info');
                        
                        // Dispatch event for other pages
                        window.dispatchEvent(new CustomEvent('stockSyncReceived', {
                            detail: { 
                                stockLevels: { ...stockLevels },
                                timestamp: serverLastUpdate,
                                source: 'firebase'
                            }
                        }));
                    }
                }
            }, (error) => {
                console.error('❌ Firestore listener error:', error);
            });

        // Listen for stock history updates
        db.collection('stockHistory')
            .orderBy('timestamp', 'desc')
            .limit(100)
            .onSnapshot((snapshot) => {
                if (!isUpdating) {
                    stockHistory = [];
                    snapshot.forEach(doc => {
                        stockHistory.push({ id: doc.id, ...doc.data() });
                    });
                    console.log('📊 Stock history synchronized');
                }
            });

        console.log('✅ Real-time sync setup completed');
    } catch (error) {
        console.error('❌ Error setting up real-time sync:', error);
    }
}

// Enhanced save function with Firebase sync
async function saveStock() {
    const timestamp = Date.now();
    lastSyncTime = timestamp;
    
    // Save to localStorage first (immediate backup)
    try {
        const tireInventory = {};
        
        tires.forEach(tire => {
            const key = `${tire.brand}_${tire.specs}`.toLowerCase().replace(/[^a-z0-9]/g, '_');
            tireInventory[key] = {
                stock: stockLevels[tire.id] || 0,
                name: tire.name,
                brand: tire.brand,
                specs: tire.specs,
                price: tire.price,
                id: tire.id
            };
        });
        
        localStorage.setItem('tireInventory', JSON.stringify(tireInventory));
        localStorage.setItem('tireStockLevels', JSON.stringify(stockLevels));
        localStorage.setItem('lastStockUpdate', timestamp.toString());
        
        console.log('💾 Stock saved to localStorage');
    } catch (error) {
        console.error('❌ Error saving to localStorage:', error);
    }

    // Save to Firebase for cross-device sync
    if (isFirebaseAvailable && db) {
        try {
            isUpdating = true;
            
            await db.collection('tireStock').doc('inventory').set({
                stockLevels: stockLevels,
                lastUpdate: timestamp,
                deviceInfo: {
                    userAgent: navigator.userAgent,
                    timestamp: new Date().toISOString()
                }
            }, { merge: true });
            
            console.log('☁️ Stock synchronized to Firebase');
            showConnectionStatus('online');
            
        } catch (error) {
            console.error('❌ Error saving to Firebase:', error);
            showConnectionStatus('offline');
            showNotification('⚠️ Offline mode - changes saved locally', 'warning');
        } finally {
            isUpdating = false;
        }
    }

    // Dispatch local event
    window.dispatchEvent(new CustomEvent('stockUpdated', {
        detail: { 
            stockLevels: { ...stockLevels },
            timestamp: timestamp,
            source: 'local'
        }
    }));
}

// Enhanced load function with Firebase sync
async function loadStock() {
    let loaded = false;
    
    // Try loading from Firebase first
    if (isFirebaseAvailable && db) {
        try {
            console.log('☁️ Loading stock from Firebase...');
            const doc = await db.collection('tireStock').doc('inventory').get();
            
            if (doc.exists) {
                const data = doc.data();
                if (data.stockLevels && typeof data.stockLevels === 'object') {
                    stockLevels = data.stockLevels;
                    lastSyncTime = data.lastUpdate || 0;
                    loaded = true;
                    console.log('✅ Stock loaded from Firebase');
                    showConnectionStatus('online');
                }
            }
        } catch (error) {
            console.error('❌ Error loading from Firebase:', error);
            showConnectionStatus('offline');
        }
    }

    // Fallback to localStorage if Firebase fails
    if (!loaded) {
        try {
            console.log('💾 Loading stock from localStorage...');
            const savedStock = localStorage.getItem('tireStockLevels');
            const savedTimestamp = localStorage.getItem('lastStockUpdate');
            
            if (savedStock) {
                const parsedStock = JSON.parse(savedStock);
                if (typeof parsedStock === 'object' && parsedStock !== null) {
                    stockLevels = parsedStock;
                    lastSyncTime = parseInt(savedTimestamp) || 0;
                    loaded = true;
                    console.log('✅ Stock loaded from localStorage');
                }
            }
            
            // Try legacy format
            if (!loaded) {
                const tireInventory = localStorage.getItem('tireInventory');
                if (tireInventory) {
                    const inventory = JSON.parse(tireInventory);
                    stockLevels = {};
                    
                    tires.forEach(tire => {
                        const key = `${tire.brand}_${tire.specs}`.toLowerCase().replace(/[^a-z0-9]/g, '_');
                        if (inventory[key] && typeof inventory[key].stock === 'number') {
                            stockLevels[tire.id] = inventory[key].stock;
                        }
                    });
                    
                    loaded = true;
                    console.log('✅ Stock loaded from legacy localStorage format');
                }
            }
        } catch (error) {
            console.error('❌ Error loading from localStorage:', error);
        }
    }

    return loaded;
}

// Connection status indicator
function showConnectionStatus(status) {
    const statusElement = document.getElementById('connection-status');
    if (!statusElement) {
        // Create status indicator if it doesn't exist
        const statusDiv = document.createElement('div');
        statusDiv.id = 'connection-status';
        statusDiv.style.cssText = `
            position: fixed;
            top: 10px;
            left: 10px;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            z-index: 10001;
            transition: all 0.3s ease;
        `;
        document.body.appendChild(statusDiv);
    }
    
    const statusEl = document.getElementById('connection-status');
    if (status === 'online') {
        statusEl.textContent = '🟢 Online';
        statusEl.style.background = '#28a745';
        statusEl.style.color = 'white';
    } else {
        statusEl.textContent = '🔴 Offline';
        statusEl.style.background = '#dc3545';
        statusEl.style.color = 'white';
    }
}

// Enhanced stock history with Firebase sync
async function addToStockHistory(tireId, operation, quantity, oldStock, newStock, deviceInfo = null) {
    const tire = tires.find(t => t.id === tireId);
    if (!tire) return;
    
    const historyEntry = {
        timestamp: Date.now(),
        tireId: tireId,
        tireName: tire.name,
        tireBrand: tire.brand,
        tireSpecs: tire.specs,
        operation: operation,
        quantity: quantity,
        oldStock: oldStock,
        newStock: newStock,
        deviceInfo: deviceInfo || {
            userAgent: navigator.userAgent.substring(0, 100),
            platform: navigator.platform,
            timestamp: new Date().toISOString()
        }
    };
    
    // Add to local history
    stockHistory.unshift(historyEntry);
    
    // Keep only last 1000 entries locally
    if (stockHistory.length > 1000) {
        stockHistory = stockHistory.slice(0, 1000);
    }
    
    // Save to Firebase
    if (isFirebaseAvailable && db) {
        try {
            await db.collection('stockHistory').add(historyEntry);
            console.log('📊 Stock history saved to Firebase');
        } catch (error) {
            console.error('❌ Error saving stock history to Firebase:', error);
        }
    }
    
    // Save to localStorage as backup
    try {
        localStorage.setItem('stockHistory', JSON.stringify(stockHistory.slice(0, 100)));
    } catch (e) {
        console.warn('Could not save stock history to localStorage:', e);
    }
}

// Load stock history from Firebase and localStorage
async function loadStockHistory() {
    if (isFirebaseAvailable && db) {
        try {
            const snapshot = await db.collection('stockHistory')
                .orderBy('timestamp', 'desc')
                .limit(100)
                .get();
            
            stockHistory = [];
            snapshot.forEach(doc => {
                stockHistory.push({ id: doc.id, ...doc.data() });
            });
            
            console.log('📊 Stock history loaded from Firebase');
            return;
        } catch (error) {
            console.error('❌ Error loading stock history from Firebase:', error);
        }
    }
    
    // Fallback to localStorage
    try {
        const saved = localStorage.getItem('stockHistory');
        if (saved) {
            stockHistory = JSON.parse(saved);
        }
    } catch (e) {
        console.warn('Could not load stock history from localStorage:', e);
        stockHistory = [];
    }
}

// Initialize stock levels
async function initializeStock() {
    try {
        const loaded = await loadStock();
        
        if (!loaded) {
            // Initialize with default stock levels
            stockLevels = {};
            tires.forEach(tire => {
                stockLevels[tire.id] = Math.floor(Math.random() * 50) + 10;
            });
            await saveStock();
            showNotification('Stock initialized with default values', 'info');
            console.log('✅ Default stock initialized:', stockLevels);
        } else {
            showNotification('Stock data synchronized successfully!', 'success');
        }
    } catch (error) {
        console.error('Error initializing stock:', error);
        stockLevels = {};
        tires.forEach(tire => {
            stockLevels[tire.id] = Math.floor(Math.random() * 50) + 10;
        });
        await saveStock();
        showNotification('Stock initialized with fallback values', 'warning');
    }
}

// Get product by ID
function getProductById(productId) {
    const id = parseInt(productId);
    const product = tires.find(tire => tire.id === id);
    
    if (!product) {
        console.error(`Product with ID ${productId} not found`);
        return null;
    }
    
    return product;
}

// Show notification with better mobile support
function showNotification(message, type = 'info') {
    console.log(`[${type.toUpperCase()}] ${message}`);
    
    // Remove existing notification
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
        existingNotification.remove();
    }

    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <span class="notification-icon">${getNotificationIcon(type)}</span>
        <span class="notification-text">${message}</span>
    `;
    
    // Add enhanced styles for mobile
    if (!document.getElementById('notification-styles')) {
        const style = document.createElement('style');
        style.id = 'notification-styles';
        style.textContent = `
            .notification {
                position: fixed;
                top: 70px;
                right: 15px;
                left: 15px;
                padding: 12px 16px;
                border-radius: 8px;
                color: white;
                font-weight: 500;
                z-index: 10000;
                transform: translateY(-100px);
                opacity: 0;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                max-width: none;
                box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 14px;
                line-height: 1.4;
            }
            .notification.show {
                transform: translateY(0);
                opacity: 1;
            }
            .notification.success {
                background: linear-gradient(135deg, #28a745, #20c997);
            }
            .notification.error {
                background: linear-gradient(135deg, #dc3545, #e74c3c);
            }
            .notification.info {
                background: linear-gradient(135deg, #17a2b8, #3498db);
            }
            .notification.warning {
                background: linear-gradient(135deg, #ffc107, #f39c12);
                color: #000;
            }
            .notification-icon {
                flex-shrink: 0;
                font-size: 16px;
            }
            .notification-text {
                flex: 1;
                word-wrap: break-word;
            }
            
            @media (min-width: 768px) {
                .notification {
                    right: 20px;
                    left: auto;
                    max-width: 400px;
                }
            }
        `;
        document.head.appendChild(style);
    }
    
    document.body.appendChild(notification);

    // Show notification
    setTimeout(() => notification.classList.add('show'), 100);

    // Hide notification after 4 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 4000);
}

function getNotificationIcon(type) {
    switch(type) {
        case 'success': return '✅';
        case 'error': return '❌';
        case 'warning': return '⚠️';
        case 'info': return 'ℹ️';
        default: return '📱';
    }
}

// Enhanced stock update function
async function updateStock(tireId, change, operation = 'manual') {
    if (!stockLevels.hasOwnProperty(tireId)) {
        stockLevels[tireId] = 0;
    }
    
    const oldStock = stockLevels[tireId];
    const newStock = Math.max(0, oldStock + change);
    stockLevels[tireId] = newStock;
    
    const product = getProductById(tireId);
    if (product) {
        const operationType = change > 0 ? 'stock-in' : 'stock-out';
        
        // Add to history
        await addToStockHistory(tireId, operationType, Math.abs(change), oldStock, newStock);
        
        // Show appropriate notification
        if (change > 0) {
            showNotification(`Added ${change} units to ${product.name}`, 'success');
        } else {
            if (newStock === 0) {
                showNotification(`${product.name} is now out of stock!`, 'error');
            } else if (newStock <= 5) {
                showNotification(`${product.name} is now at critical level!`, 'warning');
            } else {
                showNotification(`Removed ${Math.abs(change)} units from ${product.name}`, 'success');
            }
        }
    }
    
    renderStockCards();
    updateStatistics();
    await saveStock();
}

// Enhanced stock in function
async function stockIn(tireId) {
    const input = document.getElementById(`qty-${tireId}`);
    const quantity = parseInt(input.value) || 1;
    
    if (quantity > 0) {
        await updateStock(tireId, quantity, 'stock-in');
        input.value = '';
    } else {
        showNotification('Please enter a valid quantity', 'error');
    }
}

// Enhanced stock out function
async function stockOut(tireId) {
    const input = document.getElementById(`qty-${tireId}`);
    const quantity = parseInt(input.value) || 1;
    
    if (quantity > 0) {
        const currentStock = stockLevels[tireId] || 0;
        if (quantity <= currentStock) {
            await updateStock(tireId, -quantity, 'stock-out');
            input.value = '';
        } else {
            showNotification('Insufficient stock!', 'error');
        }
    } else {
        showNotification('Please enter a valid quantity', 'error');
    }
}

// Get stock status with enhanced categories
function getStockStatus(stock) {
    if (stock === 0) return { class: 'out-of-stock', text: 'Out of Stock', priority: 4 };
    if (stock <= 3) return { class: 'critical-stock', text: 'Critical', priority: 3 };
    if (stock <= 10) return { class: 'low-stock', text: 'Low Stock', priority: 2 };
    if (stock <= 25) return { class: 'medium-stock', text: 'Medium Stock', priority: 1 };
    return { class: 'in-stock', text: 'In Stock', priority: 0 };
}

// Enhanced render stock cards function
function renderStockCards() {
    const stockGrid = document.getElementById('stock-grid');
    
    if (!stockGrid) {
        console.error('Stock grid element not found');
        return;
    }

    let html = '';
    
    filteredTires.forEach(tire => {
        const stock = stockLevels[tire.id] || 0;
        const status = getStockStatus(stock);
        
        html += `
            <div class="stock-card ${status.class}" data-priority="${status.priority}">
                <div class="card-header">
                    <div class="tire-info">
                        <div class="tire-name">${tire.name}</div>
                        <div class="tire-brand">${tire.brand}</div>
                        <div class="tire-specs">${tire.specs}</div>
                    </div>
                    <div class="stock-badge ${status.class}">${stock}</div>
                </div>
                
                <div class="card-body">
                    <div class="price-section">
                        <div class="price">₹${tire.price.toLocaleString()}</div>
                        <div class="stock-status ${status.class}">${status.text}</div>
                    </div>
                    
                    <div class="stock-controls">
                        <div class="quantity-section">
                            <input 
                                type="number" 
                                class="quantity-input" 
                                id="qty-${tire.id}" 
                                placeholder="Qty" 
                                min="1"
                                value="1"
                            >
                        </div>
                        
                        <div class="action-buttons">
                            <button class="btn btn-stock-in" onclick="stockIn(${tire.id})" title="Add Stock">
                                <span class="btn-icon">+</span>
                                <span class="btn-text">Add</span>
                            </button>
                            <button class="btn btn-stock-out" onclick="stockOut(${tire.id})" 
                                    ${stock === 0 ? 'disabled' : ''} title="Remove Stock">
                                <span class="btn-icon">−</span>
                                <span class="btn-text">Remove</span>
                            </button>
                        </div>
                    </div>
                    
                    ${stock <= 5 ? `<div class="alert-banner ${stock === 0 ? 'critical' : 'warning'}">
                        ${stock === 0 ? '⚠️ Out of Stock' : '⚠️ Low Stock Alert'}
                    </div>` : ''}
                </div>
            </div>
        `;
    });
    
    stockGrid.innerHTML = html;
    
    // Add enhanced mobile styles
    addMobileStyles();
}

// Add enhanced mobile-responsive styles
function addMobileStyles() {
    if (document.getElementById('mobile-stock-styles')) return;
    
    const style = document.createElement('style');
    style.id = 'mobile-stock-styles';
    style.textContent = `
        .stock-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            border-left: 4px solid #ddd;
        }
        
        .stock-card.critical-stock { border-left-color: #e74c3c; }
        .stock-card.out-of-stock { border-left-color: #c0392b; }
        .stock-card.low-stock { border-left-color: #f39c12; }
        .stock-card.medium-stock { border-left-color: #3498db; }
        .stock-card.in-stock { border-left-color: #27ae60; }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 16px;
            background: #f8f9fa;
            border-bottom: 1px solid #eee;
        }
        
        .tire-info {
            flex: 1;
        }
        
        .tire-name {
            font-weight: 600;
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 4px;
            line-height: 1.3;
        }
        
        .tire-brand {
            font-size: 14px;
            color: #7f8c8d;
            font-weight: 500;
        }
        
        .tire-specs {
            font-size: 12px;
            color: #95a5a6;
            margin-top: 2px;
        }
        
        .stock-badge {
            font-size: 20px;
            font-weight: bold;
            padding: 8px 12px;
            border-radius: 20px;
            min-width: 45px;
            text-align: center;
        }
        
        .stock-badge.critical-stock,
        .stock-badge.out-of-stock {
            background: #ffeaa7;
            color: #d63031;
        }
        
        .stock-badge.low-stock {
            background: #ffeaa7;
            color: #e17055;
        }
        
        .stock-badge.medium-stock {
            background: #e1f5fe;
            color: #0277bd;
        }
        
        .stock-badge.in-stock {
            background: #e8f5e8;
            color: #2e7d32;
        }
        
        .card-body {
            padding: 16px;
        }
        
        .price-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        
        .price {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .stock-status {
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 500;
        }
        
        .stock-status.critical-stock,
        .stock-status.out-of-stock {
            background: #ffebee;
            color: #c62828;
        }
        
        .stock-status.low-stock {
            background: #fff3e0;
            color: #ef6c00;
        }
        
        .stock-status.medium-stock {
            background: #e3f2fd;
            color: #1565c0;
        }
        
        .stock-status.in-stock {
            background: #e8f5e8;
            color: #2e7d32;
        }
        
        .stock-controls {
            display: flex;
            gap: 12px;
            align-items: center;
        }
        
        .quantity-section {
            flex: 0 0 80px;
        }
        
        .quantity-input {
            width: 100%;
            padding: 8px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            text-align: center;
            transition: border-color 0.3s ease;
        }
        
        .quantity-input:focus {
            outline: none;
            border-color: #3498db;
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
            flex: 1;
        }
        
        .btn {
            flex: 1;
            padding: 10px 8px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }
        
        .btn-stock-in {
            background: #27ae60;
            color: white;
        }
        
        .btn-stock-in:hover {
            background: #219a52;
            transform: translateY(-1px);
        }
        
        .btn-stock-out {
            background: #e74c3c;
            color: white;
        }
        
        .btn-stock-out:hover:not(:disabled) {
            background: #c0392b;
            transform: translateY(-1px);
        }
        
        .btn:disabled {
            background: #bdc3c7;
            cursor: not-allowed;
            transform: none;
        }
        
        .btn-icon {
            font-size: 16px;
            line-height: 1;
        }
        
        .alert-banner {
            margin-top: 12px;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
        }
        
        .alert-banner.warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        
        .alert-banner.critical {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }
        
        #stock-grid {
            display: grid;
            gap: 16px;
            padding: 16px;
        }
        
        @media (min-width: 768px) {
            #stock-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
                padding: 20px;
            }
            
            .btn-text {
                display: inline;
            }
        }
        
        @media (min-width: 1200px) {
            #stock-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 767px) {
            .btn-text {
                display: none;
            }
            
            .btn {
                min-width: 40px;
                padding: 10px 6px;
            }
            
            .tire-name {
                font-size: 14px;
            }
            
            .price {
                font-size: 16px;
            }
        }
    `;
    document.head.appendChild(style);
}

// Enhanced statistics update
function updateStatistics() {
    const totalItems = tires.length;
    let totalStock = 0;
    let criticalStockCount = 0;
    let lowStockCount = 0;
    let outOfStockCount = 0;
    let totalValue = 0;
    
    tires.forEach(tire => {
        const stock = stockLevels[tire.id] || 0;
        totalStock += stock;
        totalValue += stock * tire.price;
        
        if (stock === 0) {
            outOfStockCount++;
        } else if (stock <= 3) {
            criticalStockCount++;
        } else if (stock <= 10) {
            lowStockCount++;
        }
    });
    
    // Update DOM elements with better formatting
    const updateElement = (id, value, format = 'text') => {
        const element = document.getElementById(id);
        if (element) {
            if (format === 'currency') {
                element.textContent = `₹${value.toLocaleString()}`;
            } else {
                element.textContent = value.toLocaleString();
            }
        }
    };
    
    updateElement('total-items', totalItems);
    updateElement('total-stock', totalStock);
    updateElement('critical-stock-count', criticalStockCount);
    updateElement('low-stock-count', lowStockCount);
    updateElement('out-of-stock-count', outOfStockCount);
    updateElement('total-value', totalValue, 'currency');
    
    // Update progress bars if they exist
    updateProgressBar('stock-health', outOfStockCount, totalItems);
}

// Update progress bar
function updateProgressBar(id, value, total) {
    const progressBar = document.getElementById(id);
    if (progressBar && total > 0) {
        const percentage = ((total - value) / total) * 100;
        progressBar.style.width = `${percentage}%`;
        
        if (percentage < 50) {
            progressBar.className = 'progress-bar progress-bar-danger';
        } else if (percentage < 80) {
            progressBar.className = 'progress-bar progress-bar-warning';
        } else {
            progressBar.className = 'progress-bar progress-bar-success';
        }
    }
}

// Enhanced search functionality with mobile optimization
function searchTires(searchTerm) {
    if (!searchTerm || searchTerm.trim() === '') {
        filteredTires = [...tires];
    } else {
        const term = searchTerm.toLowerCase().trim();
        filteredTires = tires.filter(tire => 
            tire.name.toLowerCase().includes(term) ||
            tire.brand.toLowerCase().includes(term) ||
            tire.specs.toLowerCase().includes(term)
        );
    }
    renderStockCards();
    
    // Update search results count
    const searchResultsElement = document.getElementById('search-results-count');
    if (searchResultsElement) {
        if (searchTerm && searchTerm.trim() !== '') {
            searchResultsElement.textContent = `${filteredTires.length} results found`;
            searchResultsElement.style.display = 'block';
        } else {
            searchResultsElement.style.display = 'none';
        }
    }
}

// Enhanced tire finding with multiple fallback strategies
function findTireByDetails(name, brand, specs) {
    if (!name) return null;
    
    // Try exact match first
    let tire = tires.find(tire => 
        tire.name.toLowerCase().trim() === name.toLowerCase().trim() &&
        tire.brand.toLowerCase().trim() === (brand || '').toLowerCase().trim() &&
        tire.specs === specs
    );
    
    if (tire) return tire;
    
    // Try name and brand match (ignore specs differences)
    if (brand) {
        tire = tires.find(tire => 
            tire.name.toLowerCase().trim() === name.toLowerCase().trim() &&
            tire.brand.toLowerCase().trim() === brand.toLowerCase().trim()
        );
        
        if (tire) return tire;
    }
    
    // Try name match only
    tire = tires.find(tire => 
        tire.name.toLowerCase().trim() === name.toLowerCase().trim()
    );
    
    if (tire) return tire;
    
    // Try partial name match
    tire = tires.find(tire => 
        tire.name.toLowerCase().includes(name.toLowerCase()) ||
        name.toLowerCase().includes(tire.name.toLowerCase())
    );
    
    return tire;
}

// Enhanced function to find tire by ID
function findTireById(id) {
    return tires.find(tire => tire.id === parseInt(id));
}

// Enhanced stock reduction for orders with better error handling
async function reduceStockForOrder(orderItems) {
    console.log('🔄 Processing order for stock reduction:', orderItems);
    
    if (!orderItems || !Array.isArray(orderItems)) {
        console.error('Invalid order items provided:', orderItems);
        return { success: false, error: 'Invalid order items' };
    }
    
    let stockReduced = false;
    const stockChanges = [];
    const errors = [];
    
    for (const item of orderItems) {
        const itemName = item.name || item.tireName || item.productName;
        const itemBrand = item.brand || item.tireBrand;
        const itemSpecs = item.specs || item.tireSpecs || item.specifications;
        const itemQty = parseInt(item.qty || item.quantity || 1);
        const itemId = item.id || item.tireId;
        
        if (!itemName) {
            const error = `Item missing name: ${JSON.stringify(item)}`;
            console.warn(error);
            errors.push(error);
            continue;
        }
        
        // Try to find tire by ID first, then by details
        let tire = null;
        if (itemId) {
            tire = findTireById(itemId);
        }
        
        if (!tire && itemName) {
            tire = findTireByDetails(itemName, itemBrand, itemSpecs);
        }
        
        if (tire) {
            const currentStock = stockLevels[tire.id] || 0;
            
            if (currentStock >= itemQty) {
                // Reduce stock
                const oldStock = stockLevels[tire.id] || 0;
                stockLevels[tire.id] = Math.max(0, oldStock - itemQty);
                stockReduced = true;
                
                // Add to history
                await addToStockHistory(tire.id, 'order-sale', itemQty, oldStock, stockLevels[tire.id]);
                
                stockChanges.push({
                    tireId: tire.id,
                    tireName: tire.name,
                    oldStock: oldStock,
                    newStock: stockLevels[tire.id],
                    reducedBy: itemQty
                });
                
                console.log(`✅ Stock reduced for ${tire.name}: ${oldStock} → ${stockLevels[tire.id]} (reduced by ${itemQty})`);
            } else {
                const error = `Insufficient stock for ${tire.name}: Available: ${currentStock}, Requested: ${itemQty}`;
                console.warn(error);
                errors.push(error);
                showNotification(`⚠️ ${error}`, 'warning');
            }
        } else {
            const error = `Tire not found: ${itemName} (Brand: ${itemBrand})`;
            console.warn(error);
            errors.push(error);
            showNotification(`⚠️ ${error}`, 'warning');
        }
    }
    
    if (stockReduced) {
        // Save updated stock
        await saveStock();
        
        // Update UI if we're on the inventory page
        updateInventoryUI();
        
        // Show success notification
        const totalReduced = stockChanges.reduce((sum, change) => sum + change.reducedBy, 0);
        showNotification(`✅ Order processed! Stock reduced for ${stockChanges.length} products (${totalReduced} units)`, 'success');
        
        console.log('✅ Stock reduction completed successfully:', stockChanges);
        
        return {
            success: true,
            changes: stockChanges,
            errors: errors
        };
    } else {
        console.error('❌ No stock was reduced. Errors:', errors);
        if (errors.length > 0) {
            showNotification('❌ Unable to process order - check stock levels', 'error');
        }
    }
    
    return {
        success: false,
        changes: [],
        errors: errors
    };
}

// Helper function to update inventory UI
function updateInventoryUI() {
    if (typeof renderAllTires === 'function') {
        renderAllTires();
    } else {
        renderStockCards();
    }
    updateStatistics();
}

// Enhanced order event listeners
function setupOrderEventListeners() {
    console.log('🎯 Setting up enhanced order event listeners...');
    
    // Main event listener - matches the order confirmation system
    window.addEventListener('orderCompleted', async (e) => {
        console.log('🛒 Order completed event received:', e.detail);
        
        if (e.detail && e.detail.orderItems) {
            await reduceStockForOrder(e.detail.orderItems);
        } else if (e.detail && e.detail.items) {
            await reduceStockForOrder(e.detail.items);
        } else {
            console.warn('No orderItems found in orderCompleted event:', e.detail);
        }
    });
    
    // Additional event listeners for different scenarios
    window.addEventListener('paymentCompleted', async (e) => {
        console.log('💳 Payment completed event received:', e.detail);
        if (e.detail && (e.detail.orderItems || e.detail.items)) {
            await reduceStockForOrder(e.detail.orderItems || e.detail.items);
        }
    });
    
    window.addEventListener('cartCheckout', async (e) => {
        console.log('🛍️ Cart checkout event received:', e.detail);
        if (e.detail && e.detail.items) {
            await reduceStockForOrder(e.detail.items);
        }
    });
    
    // Firebase sync event listener
    window.addEventListener('stockSyncReceived', (e) => {
        console.log('🔄 Stock sync received from Firebase:', e.detail);
        // UI will be updated by the Firestore listener
    });
    
    console.log('✅ Enhanced order event listeners setup complete');
}

// Network status monitoring
function setupNetworkMonitoring() {
    // Monitor online/offline status
    window.addEventListener('online', () => {
        console.log('📶 Network connection restored');
        showConnectionStatus('online');
        showNotification('📶 Connection restored - syncing data...', 'info');
        
        // Attempt to sync when coming back online
        setTimeout(async () => {
            try {
                await saveStock();
                showNotification('✅ Data synchronized successfully', 'success');
            } catch (error) {
                console.error('Sync failed:', error);
            }
        }, 1000);
    });
    
    window.addEventListener('offline', () => {
        console.log('📵 Network connection lost');
        showConnectionStatus('offline');
        showNotification('📵 Working offline - changes saved locally', 'warning');
    });
    
    // Initial status
    showConnectionStatus(navigator.onLine ? 'online' : 'offline');
}

    // Enhanced event listeners
function setupEventListeners() {
    console.log('Setting up enhanced inventory event listeners...');
    
    // Handle page visibility change
    document.addEventListener('visibilitychange', async () => {
        if (document.hidden) {
            console.log('Page hidden, saving stock...');
            await saveStock();
        } else {
            console.log('Page visible, checking for updates...');
            // Small delay to allow Firebase listener to fire first
            setTimeout(() => {
                if (Date.now() - lastSyncTime > 30000) { // 30 seconds
                    initializeStock();
                }
            }, 1000);
        }
    });

    // Save data when user is about to leave
    window.addEventListener('beforeunload', async () => {
        console.log('Page unloading, saving stock...');
        await saveStock();
    });

    // Listen for storage changes (cross-tab sync fallback)
    window.addEventListener('storage', async (e) => {
        if (e.key === 'tireStockLevels' || e.key === 'tireInventory') {
            console.log('🔄 Storage sync event detected for key:', e.key);
            const timestamp = parseInt(localStorage.getItem('lastStockUpdate') || '0');
            
            if (timestamp > lastSyncTime) {
                await loadStock();
                updateInventoryUI();
                showNotification('📱 Stock updated from another tab', 'info');
            }
        }
    });
    
    // Setup order listeners
    setupOrderEventListeners();
    
    // Setup network monitoring
    setupNetworkMonitoring();
    
    console.log('✅ All enhanced event listeners setup complete');
}

// Enhanced search functionality
function setupSearch() {
    const searchInput = document.getElementById('search-input');
    
    if (searchInput) {
        let searchTimeout;
        
        searchInput.addEventListener('input', (e) => {
            // Debounce search for better performance
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                searchTires(e.target.value);
            }, 300);
        });
        
        // Add clear search functionality
        searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                searchInput.value = '';
                searchTires('');
            }
        });
    }
}

// Advanced filtering and sorting
function setupAdvancedFilters() {
    const brandFilter = document.getElementById('brand-filter');
    const stockFilter = document.getElementById('stock-filter');
    const sortBy = document.getElementById('sort-by');
    
    function applyFilters() {
        let filtered = [...tires];
        
        // Brand filter
        if (brandFilter && brandFilter.value !== 'all') {
            filtered = filtered.filter(tire => 
                tire.brand.toLowerCase() === brandFilter.value.toLowerCase()
            );
        }
        
        // Stock level filter
        if (stockFilter && stockFilter.value !== 'all') {
            filtered = filtered.filter(tire => {
                const stock = stockLevels[tire.id] || 0;
                switch (stockFilter.value) {
                    case 'in-stock': return stock > 10;
                    case 'low-stock': return stock > 0 && stock <= 10;
                    case 'critical': return stock > 0 && stock <= 5;
                    case 'out-of-stock': return stock === 0;
                    default: return true;
                }
            });
        }
        
        // Sorting
        if (sortBy && sortBy.value !== 'default') {
            filtered.sort((a, b) => {
                switch (sortBy.value) {
                    case 'name': return a.name.localeCompare(b.name);
                    case 'brand': return a.brand.localeCompare(b.brand);
                    case 'price-low': return a.price - b.price;
                    case 'price-high': return b.price - a.price;
                    case 'stock-low': return (stockLevels[a.id] || 0) - (stockLevels[b.id] || 0);
                    case 'stock-high': return (stockLevels[b.id] || 0) - (stockLevels[a.id] || 0);
                    default: return 0;
                }
            });
        }
        
        filteredTires = filtered;
        renderStockCards();
    }
    
    if (brandFilter) brandFilter.addEventListener('change', applyFilters);
    if (stockFilter) stockFilter.addEventListener('change', applyFilters);
    if (sortBy) sortBy.addEventListener('change', applyFilters);
}

// Bulk operations with confirmation
async function bulkStockOperation(operation, value) {
    const confirmMessage = `Are you sure you want to ${operation} ${value} units ${operation === 'add' ? 'to' : operation === 'set' ? 'for' : 'from'} all tires?`;
    
    if (!confirm(confirmMessage)) {
        return;
    }
    
    let updatedCount = 0;
    const changes = [];
    
    tires.forEach(tire => {
        const oldStock = stockLevels[tire.id] || 0;
        let newStock;
        
        switch (operation) {
            case 'add':
                newStock = oldStock + parseInt(value);
                break;
            case 'subtract':
                newStock = Math.max(0, oldStock - parseInt(value));
                break;
            case 'set':
                newStock = parseInt(value);
                break;
            default:
                return;
        }
        
        if (newStock !== oldStock && newStock >= 0) {
            stockLevels[tire.id] = newStock;
            changes.push({
                tire: tire.name,
                oldStock: oldStock,
                newStock: newStock,
                change: newStock - oldStock
            });
            updatedCount++;
        }
    });
    
    if (updatedCount > 0) {
        // Add bulk operation to history
        for (const change of changes) {
            const tire = tires.find(t => t.name === change.tire);
            if (tire) {
                await addToStockHistory(
                    tire.id, 
                    `bulk-${operation}`, 
                    Math.abs(change.change), 
                    change.oldStock, 
                    change.newStock
                );
            }
        }
        
        await saveStock();
        updateInventoryUI();
        showNotification(`✅ Bulk ${operation} completed! Updated ${updatedCount} tires.`, 'success');
        console.log('Bulk operation changes:', changes);
    }
}

// Enhanced CSV export with more details
function exportStockToCSV() {
    const csvData = [
        'ID,Tire Name,Brand,Specifications,Price,Current Stock,Stock Status,Stock Value,Last Updated'
    ];
    
    tires.forEach(tire => {
        const stock = stockLevels[tire.id] || 0;
        const status = getStockStatus(stock);
        const stockValue = (tire.price * stock).toFixed(2);
        const lastUpdated = new Date().toISOString().split('T')[0];
        
        csvData.push([
            tire.id,
            `"${tire.name}"`,
            `"${tire.brand}"`,
            `"${tire.specs}"`,
            tire.price,
            stock,
            `"${status.text}"`,
            stockValue,
            lastUpdated
        ].join(','));
    });
    
    const csvContent = csvData.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const url = window.URL.createObjectURL(blob);
    
    const a = document.createElement('a');
    a.href = url;
    a.download = `tire_inventory_${new Date().toISOString().split('T')[0]}.csv`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
    
    showNotification('📊 Stock data exported to CSV successfully!', 'success');
}

// Enhanced stock alerts
function checkStockAlerts() {
    const alerts = [];
    const criticalThreshold = 3;
    const lowThreshold = 10;
    
    tires.forEach(tire => {
        const stock = stockLevels[tire.id] || 0;
        
        if (stock === 0) {
            alerts.push({
                type: 'critical',
                priority: 3,
                tire: tire,
                message: `${tire.name} is completely out of stock!`,
                action: 'Restock immediately'
            });
        } else if (stock <= criticalThreshold) {
            alerts.push({
                type: 'warning',
                priority: 2,
                tire: tire,
                message: `${tire.name} has critical stock: ${stock} units remaining`,
                action: 'Order more stock soon'
            });
        } else if (stock <= lowThreshold) {
            alerts.push({
                type: 'info',
                priority: 1,
                tire: tire,
                message: `${tire.name} has low stock: ${stock} units remaining`,
                action: 'Consider restocking'
            });
        }
    });
    
    // Sort by priority (highest first)
    alerts.sort((a, b) => b.priority - a.priority);
    
    return alerts;
}

// Display stock alerts in UI
function displayStockAlerts() {
    const alerts = checkStockAlerts();
    const alertContainer = document.getElementById('stock-alerts');
    
    if (!alertContainer) return;
    
    if (alerts.length === 0) {
        alertContainer.innerHTML = '<div class="alert success">✅ All tires have adequate stock levels!</div>';
        return;
    }
    
    const alertHTML = alerts.map(alert => `
        <div class="alert ${alert.type}" data-priority="${alert.priority}">
            <div class="alert-header">
                <strong>${alert.tire.brand} ${alert.tire.name}</strong>
                <span class="alert-badge ${alert.type}">${alert.type.toUpperCase()}</span>
            </div>
            <div class="alert-message">${alert.message}</div>
            <div class="alert-action">${alert.action}</div>
        </div>
    `).join('');
    
    alertContainer.innerHTML = alertHTML;
}

// Manual sync function for troubleshooting
async function forceSyncStock() {
    console.log('🔄 Forcing stock synchronization...');
    showNotification('🔄 Synchronizing stock data...', 'info');
    
    try {
        await saveStock();
        await loadStock();
        updateInventoryUI();
        showNotification('✅ Stock data synchronized successfully!', 'success');
    } catch (error) {
        console.error('Sync error:', error);
        showNotification('❌ Synchronization failed. Check connection.', 'error');
    }
}

// Reset stock with confirmation
async function resetAllStock() {
    const confirmation = prompt(
        'Are you sure you want to reset all stock levels?\n\n' +
        'Type "RESET" to confirm this action (this cannot be undone):'
    );
    
    if (confirmation === 'RESET') {
        try {
            tires.forEach(tire => {
                const oldStock = stockLevels[tire.id] || 0;
                stockLevels[tire.id] = 0;
                
                // Add to history
                addToStockHistory(tire.id, 'system-reset', oldStock, oldStock, 0);
            });
            
            await saveStock();
            updateInventoryUI();
            showNotification('⚠️ All stock levels have been reset to 0', 'warning');
            console.log('🔄 Stock levels reset by user');
        } catch (error) {
            console.error('Error resetting stock:', error);
            showNotification('❌ Error resetting stock levels', 'error');
        }
    } else if (confirmation !== null) {
        showNotification('❌ Reset cancelled - confirmation text did not match', 'error');
    }
}

// Test functions for debugging
function testStockReduction() {
    console.log('🧪 Testing stock reduction...');
    
    const testOrder = [
        { name: "M751 HL", brand: "Bridgestone", specs: "295/90 R 20", qty: 2 },
        { name: "Endu Race LD", brand: "Apollo", specs: "295/90 R 20", qty: 1 }
    ];
    
    return reduceStockForOrder(testOrder);
}

// Get current stock levels
function getCurrentStockLevels() {
    return { ...stockLevels };
}

// Get stock level for specific tire
function getStockLevel(tireId) {
    return stockLevels[tireId] || 0;
}

// Check stock availability for order
function checkStockAvailability(orderItems) {
    const availability = [];
    let allAvailable = true;
    
    if (!orderItems || !Array.isArray(orderItems)) {
        return { allAvailable: false, availability: [], error: 'Invalid order items' };
    }
    
    orderItems.forEach(item => {
        const itemName = item.name || item.tireName;
        const itemBrand = item.brand || item.tireBrand;
        const itemSpecs = item.specs || item.tireSpecs;
        const itemQty = parseInt(item.qty || item.quantity || 1);
        const itemId = item.id || item.tireId;
        
        let tire = null;
        if (itemId) {
            tire = findTireById(itemId);
        }
        if (!tire) {
            tire = findTireByDetails(itemName, itemBrand, itemSpecs);
        }
        
        if (tire) {
            const currentStock = stockLevels[tire.id] || 0;
            const isAvailable = currentStock >= itemQty;
            
            availability.push({
                tireName: tire.name,
                tireId: tire.id,
                currentStock: currentStock,
                requestedQty: itemQty,
                isAvailable: isAvailable,
                shortfall: isAvailable ? 0 : itemQty - currentStock
            });
            
            if (!isAvailable) {
                allAvailable = false;
            }
        } else {
            availability.push({
                tireName: itemName || 'Unknown',
                tireId: null,
                currentStock: 0,
                requestedQty: itemQty,
                isAvailable: false,
                shortfall: itemQty,
                error: 'Product not found'
            });
            allAvailable = false;
        }
    });
    
    return {
        allAvailable: allAvailable,
        availability: availability,
        totalShortfall: availability.reduce((sum, item) => sum + (item.shortfall || 0), 0)
    };
}

// Initialize the application
async function initializeApp() {
    console.log('🚀 Initializing Enhanced Tire Stock Management System...');
    
    try {
        // Initialize Firebase
        initializeFirebase();
        
        // Small delay to allow Firebase to initialize
        await new Promise(resolve => setTimeout(resolve, 1000));
        
        // Load stock history
        await loadStockHistory();
        
        // Load saved stock or initialize with defaults
        const loaded = await initializeStock();
        
        // Set up search functionality
        setupSearch();
        
        // Set up advanced filters
        setupAdvancedFilters();
        
        // Set up event listeners
        setupEventListeners();
        
        // Initial render
        renderStockCards();
        updateStatistics();
        displayStockAlerts();
        
        // Set up periodic tasks
        setupPeriodicTasks();
        
        console.log('✅ Enhanced application initialized successfully');
        console.log(`📦 Managing ${tires.length} tire products`);
        console.log(`☁️ Firebase: ${isFirebaseAvailable ? 'Connected' : 'Not available'}`);
        
        showNotification('🚀 Tire Stock Management System loaded successfully!', 'success');
        
    } catch (error) {
        console.error('❌ Initialization error:', error);
        showNotification('⚠️ System initialized with limited functionality', 'warning');
    }
}

// Set up periodic tasks
function setupPeriodicTasks() {
    // Update statistics every 30 seconds
    setInterval(() => {
        updateStatistics();
    }, 30000);
    
    // Check stock alerts every 2 minutes
    setInterval(() => {
        displayStockAlerts();
    }, 120000);
    
    // Auto-sync every 5 minutes (only if Firebase is available)
    if (isFirebaseAvailable) {
        setInterval(async () => {
            try {
                await forceSyncStock();
            } catch (error) {
                console.warn('Auto-sync failed:', error);
            }
        }, 300000);
    }
    
    console.log('✅ Periodic tasks scheduled');
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', initializeApp);

// Global functions for external access
window.tireInventorySystem = {
    reduceStockForOrder,
    checkStockAvailability,
    getCurrentStockLevels,
    getStockLevel,
    exportStockToCSV,
    bulkStockOperation,
    testStockReduction,
    forceSyncStock,
    resetAllStock,
    checkStockAlerts,
    displayStockAlerts,
    initializeFirebase,
    saveStock,
    loadStock,
    
    // Firebase status
    isFirebaseAvailable: () => isFirebaseAvailable,
    
    // Direct stock manipulation (for testing)
    setStockLevel: async (tireId, newLevel) => {
        const oldLevel = stockLevels[tireId] || 0;
        stockLevels[tireId] = Math.max(0, newLevel);
        await addToStockHistory(tireId, 'manual-set', Math.abs(newLevel - oldLevel), oldLevel, stockLevels[tireId]);
        await saveStock();
        updateInventoryUI();
    }
};

// Export for use in other modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = window.tireInventorySystem;
}
    </script>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud Stock Manager - Implementation Guide</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
            padding: 20px;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        h1, h2, h3 {
            color: #ff4757;
            margin-bottom: 15px;
        }
        
        h1 {
            font-size: 2.5em;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .config-section {
            background: #0f3460;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            border: 2px solid #ff4757;
        }
        
        .input-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #ffa502;
        }
        
        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #444;
            border-radius: 5px;
            background: #1a1a2e;
            color: #fff;
            font-size: 16px;
        }
        
        input:focus {
            outline: none;
            border-color: #ff4757;
        }
        
        .code-section {
            background: #0f3460;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            border-left: 5px solid #ff4757;
        }
        
        .code-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .copy-btn {
            background: #ff4757;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }
        
        .copy-btn:hover {
            background: #e84118;
        }
        
        .copy-btn.copied {
            background: #27ae60;
        }
        
        pre {
            background: #000;
            padding: 20px;
            border-radius: 5px;
            overflow-x: auto;
            color: #00ff00;
            font-size: 13px;
        }
        
        .alert {
            background: #ffa502;
            color: #000;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        
        .success {
            background: #27ae60;
            color: white;
        }
        
        .steps {
            background: #0f3460;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .steps ol {
            margin-left: 20px;
        }
        
        .steps li {
            margin-bottom: 10px;
            padding: 10px;
            background: rgba(255, 71, 87, 0.1);
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔥 Cloud Stock Manager - Setup Guide</h1>
        
        <!-- Configuration Section -->
        <div class="config-section">
            <h2>📝 Step 1: Enter Your JSONBin.io Credentials</h2>
            <div class="alert">
                Don't have an account? Sign up at <a href="https://jsonbin.io/" target="_blank" style="color: #fff;">jsonbin.io</a>
            </div>
            <div class="input-group">
                <label>Bin ID:</label>
                <input type="text" id="binId" placeholder="e.g., 6abc123def456789" value="690f8c0643b1c97be9a130bc" />
            </div>
            <div class="input-group">
                <label>API Key:</label>
                <input type="text" id="apiKey" placeholder="Your API Key" value="$2a$10$yAGjYb8I.MP7lFZ8LLYH3OjxT3CD1hOz7g7bQey1rXtyxNQS6JJx2" />
            </div>
            <div id="configSuccess" class="alert success" style="display: none;">
                ✅ Configuration ready! Scroll down to copy the code.
            </div>
        </div>

        <!-- Setup Steps -->
        <div class="steps">
            <h2>🚀 Setup Instructions</h2>
            <ol>
                <li><strong>Create JSONBin Account:</strong> Go to jsonbin.io and sign up</li>
                <li><strong>Create New Bin:</strong> Click "Create Bin" and paste this initial data:
                    <pre>{"stocks": [], "lastUpdate": 0}</pre>
                </li>
                <li><strong>Get Credentials:</strong> Copy your Bin ID and API Key from the dashboard</li>
                <li><strong>Enter Above:</strong> Paste your credentials in the form above</li>
                <li><strong>Copy Code:</strong> Use the copy buttons below to get the code for each page</li>
                <li><strong>Paste Code:</strong> Add the code to your HTML files before the closing &lt;/body&gt; tag</li>
            </ol>
        </div>

        <!-- Code Section 1: Cloud Stock Manager Module -->
        <div class="code-section">
            <div class="code-header">
                <h3>📦 Cloud Stock Manager Module (Add to ALL pages)</h3>
                <button class="copy-btn" onclick="copyCode('cloudManager')">Copy Code</button>
            </div>
            <pre id="cloudManager">Loading...</pre>
        </div>

        <!-- Code Section 2: Stock Page Integration -->
        <div class="code-section">
            <div class="code-header">
                <h3>🛒 Stock Page Integration (stock.php)</h3>
                <button class="copy-btn" onclick="copyCode('stockPage')">Copy Code</button>
            </div>
            <pre id="stockPage">Loading...</pre>
        </div>

        <!-- Code Section 3: Login Page Integration -->
        <div class="code-section">
            <div class="code-header">
                <h3>🔐 Login Page Integration (welcome.php/login.php)</h3>
                <button class="copy-btn" onclick="copyCode('loginPage')">Copy Code</button>
            </div>
            <pre id="loginPage">Loading...</pre>
        </div>

        <!-- Code Section 4: Seller Page Integration -->
        <div class="code-section">
            <div class="code-header">
                <h3>👨‍💼 Seller Page Integration (seller.php)</h3>
                <button class="copy-btn" onclick="copyCode('sellerPage')">Copy Code</button>
            </div>
            <pre id="sellerPage">Loading...</pre>
        </div>
    </div>

    <script>
        // Update code when credentials change
        document.getElementById('binId').addEventListener('input', updateAllCode);
        document.getElementById('apiKey').addEventListener('input', updateAllCode);

        function updateAllCode() {
            const binId = document.getElementById('binId').value.trim() || '690f8c0643b1c97be9a130bc';
            const apiKey = document.getElementById('apiKey').value.trim() || '$2a$10$yAGjYb8I.MP7lFZ8LLYH3OjxT3CD1hOz7g7bQey1rXtyxNQS6JJx2';

            if (binId !== '690f8c0643b1c97be9a130bc' && apiKey !== '$2a$10$yAGjYb8I.MP7lFZ8LLYH3OjxT3CD1hOz7g7bQey1rXtyxNQS6JJx2') {
                document.getElementById('configSuccess').style.display = 'block';
            } else {
                document.getElementById('configSuccess').style.display = 'none';
            }

            // Cloud Stock Manager Module
            const cloudManagerCode = `<script>
// ================================================
// 🔥 CLOUD STOCK MANAGER - Add to ALL pages
// ================================================
const CloudStockManager = {
  BIN_ID: "${binId}",
  API_KEY: "${apiKey}",
  BASE_URL: function() {
    return \`https://api.jsonbin.io/v3/b/\${this.BIN_ID}\`;
  },

  // Fetch stock from cloud
  async getStock() {
    try {
      const response = await fetch(this.BASE_URL() + "/latest", {
        headers: { "X-Master-Key": this.API_KEY }
      });
      
      if (!response.ok) throw new Error('Failed to fetch');
      
      const data = await response.json();
      console.log('✅ Stock loaded from cloud:', data.record.stocks?.length || 0, 'items');
      return data.record.stocks || [];
    } catch (error) {
      console.error('❌ Cloud fetch error:', error);
      return this.loadFromLocalStorage();
    }
  },

  // Update stock in cloud
  async updateStock(stocks) {
    try {
      const response = await fetch(this.BASE_URL(), {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
          "X-Master-Key": this.API_KEY
        },
        body: JSON.stringify({ 
          stocks: stocks, 
          lastUpdate: Date.now() 
        })
      });
      
      if (!response.ok) throw new Error('Failed to update');
      
      this.saveToLocalStorage(stocks);
      console.log('✅ Stock synced to cloud');
      return true;
    } catch (error) {
      console.error('❌ Cloud update error:', error);
      this.saveToLocalStorage(stocks);
      return false;
    }
  },

  // Convert your format to cloud format
  convertToCloudFormat(stockLevels, tires) {
    if (!tires || !Array.isArray(tires)) return [];
    
    return tires.map(tire => ({
      id: tire.id,
      name: tire.name,
      brand: tire.brand,
      specs: tire.specs,
      price: tire.price,
      count: stockLevels[tire.id] || 0
    }));
  },

  // Convert cloud format to your format
  convertFromCloudFormat(stocks) {
    const stockLevels = {};
    if (stocks && Array.isArray(stocks)) {
      stocks.forEach(item => {
        if (item.id) stockLevels[item.id] = item.count || 0;
      });
    }
    return stockLevels;
  },

  // Local backup
  saveToLocalStorage(stocks) {
    try {
      localStorage.setItem('cloudStockBackup', JSON.stringify(stocks));
      localStorage.setItem('cloudStockBackupTime', Date.now().toString());
    } catch (e) {
      console.warn('LocalStorage save failed:', e);
    }
  },

  loadFromLocalStorage() {
    try {
      const backup = localStorage.getItem('cloudStockBackup');
      return backup ? JSON.parse(backup) : [];
    } catch (e) {
      console.warn('LocalStorage load failed:', e);
      return [];
    }
  },

  // Sync your stock with cloud
  async syncStock(stockLevels, tires) {
    console.log('🔄 Syncing stock...');
    const cloudStocks = this.convertToCloudFormat(stockLevels, tires);
    return await this.updateStock(cloudStocks);
  },

  // Load from cloud and apply
  async loadAndApplyStock(tires) {
    console.log('📥 Loading from cloud...');
    const cloudStocks = await this.getStock();
    return this.convertFromCloudFormat(cloudStocks);
  }
};

window.CloudStockManager = CloudStockManager;
console.log('✅ Cloud Stock Manager loaded');
<\/script>`;

            // Stock Page Integration
            const stockPageCode = `<script>
// ================================================
// 📦 STOCK PAGE INTEGRATION
// ================================================
// Add this AFTER the Cloud Stock Manager code in stock.php

// Override saveStock to sync with cloud
const originalSaveStock = window.saveStock;
window.saveStock = async function() {
  // Call original save
  if (originalSaveStock) await originalSaveStock();
  
  // Sync to cloud
  if (typeof tires !== 'undefined' && typeof stockLevels !== 'undefined') {
    const success = await CloudStockManager.syncStock(stockLevels, tires);
    if (success && typeof showNotification === 'function') {
      showNotification('✅ Stock saved to cloud!', 'success');
    }
  }
};

// Override loadStock to load from cloud
const originalLoadStock = window.loadStock;
window.loadStock = async function() {
  try {
    if (typeof tires !== 'undefined') {
      const cloudStockLevels = await CloudStockManager.loadAndApplyStock(tires);
      
      if (Object.keys(cloudStockLevels).length > 0) {
        window.stockLevels = cloudStockLevels;
        console.log('✅ Loaded from cloud');
        if (typeof showNotification === 'function') {
          showNotification('📥 Stock loaded from cloud', 'success');
        }
        return true;
      }
    }
  } catch (error) {
    console.error('Cloud load error:', error);
  }
  
  // Fallback to original
  if (originalLoadStock) return await originalLoadStock();
  return false;
};

// Add cloud sync button
window.addEventListener('DOMContentLoaded', function() {
  const controlsSection = document.querySelector('.controls-section');
  if (controlsSection) {
    const syncButton = document.createElement('button');
    syncButton.className = 'reset-btn';
    syncButton.innerHTML = '☁️ Sync to Cloud';
    syncButton.style.background = 'linear-gradient(135deg, #3498db, #2980b9)';
    syncButton.onclick = async function() {
      this.disabled = true;
      this.textContent = 'Syncing...';
      
      const success = await CloudStockManager.syncStock(stockLevels, tires);
      
      if (success) {
        if (typeof showNotification === 'function') {
          showNotification('✅ Stock synced successfully!', 'success');
        } else {
          alert('✅ Stock synced successfully!');
        }
      } else {
        if (typeof showNotification === 'function') {
          showNotification('❌ Sync failed', 'error');
        } else {
          alert('❌ Sync failed. Check console.');
        }
      }
      
      this.disabled = false;
      this.innerHTML = '☁️ Sync to Cloud';
    };
    controlsSection.appendChild(syncButton);
  }
});

console.log('✅ Stock page cloud integration active');
<\/script>`;

            // Login Page Integration
            const loginPageCode = `<script>
// ================================================
// 🔐 LOGIN PAGE INTEGRATION
// ================================================
// Add this AFTER the Cloud Stock Manager code in welcome.php

// Pre-load stock data on successful login
window.addEventListener('DOMContentLoaded', function() {
  // Wait for login functions to be available
  setTimeout(function() {
    // Wrap the existing login handlers
    if (typeof handleLogin === 'function') {
      const originalHandleLogin = handleLogin;
      window.handleLogin = async function(event) {
        await originalHandleLogin(event);
        
        // Pre-load stock
        try {
          await CloudStockManager.getStock();
          console.log('✅ Stock pre-loaded');
        } catch (error) {
          console.warn('Could not pre-load stock:', error);
        }
      };
    }

    if (typeof handleSellerLogin === 'function') {
      const originalHandleSellerLogin = handleSellerLogin;
      window.handleSellerLogin = async function(event) {
        await originalHandleSellerLogin(event);
        
        try {
          await CloudStockManager.getStock();
          console.log('✅ Stock pre-loaded for seller');
        } catch (error) {
          console.warn('Could not pre-load stock:', error);
        }
      };
    }

    if (typeof handleDealerLogin === 'function') {
      const originalHandleDealerLogin = handleDealerLogin;
      window.handleDealerLogin = async function(event) {
        await originalHandleDealerLogin(event);
        
        try {
          await CloudStockManager.getStock();
          console.log('✅ Stock pre-loaded for dealer');
        } catch (error) {
          console.warn('Could not pre-load stock:', error);
        }
      };
    }
  }, 1000);
});

console.log('✅ Login page cloud integration active');
<\/script>`;

            // Seller Page Integration
            const sellerPageCode = `<script>
// ================================================
// 👨‍💼 SELLER PAGE INTEGRATION
// ================================================
// Add this AFTER the Cloud Stock Manager code in seller.php

// Display cloud stock in dashboard
async function displayCloudStock() {
  try {
    const stocks = await CloudStockManager.getStock();
    
    // Calculate statistics
    const totalItems = stocks.length;
    const totalStock = stocks.reduce((sum, item) => sum + (item.count || 0), 0);
    const lowStockItems = stocks.filter(item => (item.count || 0) <= 10).length;
    const outOfStock = stocks.filter(item => (item.count || 0) === 0).length;
    
    // Update UI elements if they exist
    const updateElement = (id, value) => {
      const el = document.getElementById(id);
      if (el) el.textContent = value;
    };
    
    updateElement('recentOrdersCount', totalItems);
    updateElement('processingOrdersCount', totalStock);
    updateElement('completedOrdersCount', lowStockItems);
    updateElement('cancelledOrdersCount', outOfStock);
    
    console.log('✅ Seller dashboard updated');
  } catch (error) {
    console.error('Error displaying cloud stock:', error);
  }
}

// Call on page load
window.addEventListener('DOMContentLoaded', function() {
  displayCloudStock();
  
  // Refresh every 5 minutes
  setInterval(displayCloudStock, 300000);
});

// Add to refresh button if it exists
if (typeof refreshOrders === 'function') {
  const originalRefreshOrders = refreshOrders;
  window.refreshOrders = async function() {
    await originalRefreshOrders();
    await displayCloudStock();
  };
}

console.log('✅ Seller page cloud integration active');
<\/script>`;

            // Update the display
            document.getElementById('cloudManager').textContent = cloudManagerCode;
            document.getElementById('stockPage').textContent = stockPageCode;
            document.getElementById('loginPage').textContent = loginPageCode;
            document.getElementById('sellerPage').textContent = sellerPageCode;
        }

        function copyCode(elementId) {
            const code = document.getElementById(elementId).textContent;
            const button = event.target;
            
            navigator.clipboard.writeText(code).then(() => {
                button.textContent = '✅ Copied!';
                button.classList.add('copied');
                
                setTimeout(() => {
                    button.textContent = 'Copy Code';
                    button.classList.remove('copied');
                }, 2000);
            }).catch(err => {
                alert('Failed to copy. Please select and copy manually.');
            });
        }

        // Initialize with placeholder values
        updateAllCode();
    </script>
</body>
</html>
</body>
</html>