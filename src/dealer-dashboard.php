<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tire Demand Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: white;
            color: #1f2937;
            line-height: 1.6;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 24px;
            min-height: 100vh;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .dashboard-title h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .dashboard-title p {
            font-size: 1.125rem;
            color: #6b7280;
        }

        .home-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .home-button:hover {
            background: linear-gradient(135deg, #b91c1c, #991b1b);
            transform: translateY(-1px);
            box-shadow: 0 6px 8px -1px rgba(0, 0, 0, 0.15);
        }

        .home-button svg {
            width: 20px;
            height: 20px;
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .metric-card {
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
        }

        .metric-card.red {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
        }

        .metric-card.black {
            background: linear-gradient(135deg, #1f2937, #111827);
        }

        .metric-card.gray {
            background: linear-gradient(135deg, #4b5563, #374151);
        }

        .metric-info h3 {
            font-size: 0.875rem;
            margin-bottom: 8px;
            opacity: 0.8;
        }

        .metric-info .value {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .metric-info .subtitle {
            font-size: 0.875rem;
            opacity: 0.8;
        }

        .metric-icon {
            width: 48px;
            height: 48px;
            opacity: 0.7;
        }

        .chart-controls {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
        }

        .chart-btn {
            padding: 8px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .chart-btn.active {
            background-color: #dc2626;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .chart-btn:not(.active) {
            background-color: #e5e7eb;
            color: #374151;
        }

        .chart-btn:not(.active):hover {
            background-color: #d1d5db;
        }

        .brand-charts-section {
            margin-bottom: 32px;
        }

        .brand-chart-container {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            padding: 24px;
            margin-bottom: 24px;
        }

        .brand-chart-container:last-child {
            margin-bottom: 0;
        }

        .brand-chart-container h2 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-color-indicator {
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }

        .brand-chart-wrapper {
            position: relative;
            height: 300px;
        }

        .main-content {
            display: flex;
            justify-content: center;
            margin-bottom: 32px;
        }

        .chart-container {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            padding: 24px;
        }

        .chart-container h2 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 24px;
        }

        .chart-wrapper {
            position: relative;
            height: 400px;
        }

        .top-list {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            padding: 24px;
        }

        .top-list h3 {
            font-size: 1.25rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 24px;
        }

        .top-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            background-color: #f9fafb;
            border-radius: 8px;
            border-left: 4px solid #dc2626;
            margin-bottom: 8px;
        }

        .top-item:last-child {
            margin-bottom: 0;
        }

        .item-info {
            flex: 1;
        }

        .item-info h4 {
            font-weight: 600;
            color: #1f2937;
            margin: 0;
            font-size: 0.9rem;
        }

        .item-info p {
            font-size: 0.75rem;
            color: #6b7280;
            margin: 0;
            display: inline;
        }

        .category-badge {
            display: inline-block;
            padding: 1px 6px;
            background-color: #e5e7eb;
            color: #374151;
            font-size: 0.65rem;
            border-radius: 8px;
            margin-left: 8px;
        }

        .item-demand {
            text-align: right;
            min-width: 60px;
        }

        .item-demand .value {
            font-size: 1.1rem;
            font-weight: bold;
            color: #dc2626;
            margin: 0;
        }

        .item-demand .label {
            font-size: 0.65rem;
            color: #6b7280;
            margin: 0;
        }

        .table-container {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table-header {
            padding: 24px;
            border-bottom: 1px solid #e5e7eb;
        }

        .table-header h3 {
            font-size: 1.25rem;
            font-weight: bold;
            color: #1f2937;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f9fafb;
        }

        th, td {
            padding: 16px 24px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            font-weight: 600;
            color: #1f2937;
            font-size: 0.875rem;
        }

        td {
            font-size: 0.875rem;
        }

        tr:hover {
            background-color: #f9fafb;
        }

        .rank {
            color: #1f2937;
        }

        .brand {
            font-weight: 600;
            color: #1f2937;
        }

        .model {
            color: #6b7280;
        }

        .demand {
            font-weight: bold;
            color: #dc2626;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            font-size: 0.75rem;
            border-radius: 12px;
            font-weight: 500;
        }

        .status-high {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .status-medium {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-standard {
            background-color: #f3f4f6;
            color: #374151;
        }

        .brand-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 16px;
            padding: 16px;
            background-color: #f9fafb;
            border-radius: 8px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.875rem;
        }

        .legend-color {
            width: 16px;
            height: 16px;
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .dashboard-title h1 {
                font-size: 2rem;
            }
            
            .chart-controls {
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="dashboard-title">
                <h1>Tire Demand Analytics</h1>
                <p>Real-time insights into tire demand across all brands</p>
            </div>
            <a href="frontage.php" class="home-button">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Back to Home
            </a>
        </div>

        <!-- Key Metrics Cards -->
        <div class="metrics-grid">
            <div class="metric-card red">
                <div class="metric-info">
                    <h3>Total Demand</h3>
                    <div class="value">7,330</div>
                    <div class="subtitle">units per year</div>
                </div>
                <svg class="metric-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7 14l3-3 3 3 6-6" stroke="currentColor" stroke-width="2" fill="none"/>
                    <path d="M17 8h3v3" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
            </div>
            
            <div class="metric-card black">
                <div class="metric-info">
                    <!-- This will be dynamically updated -->
                </div>
                <svg class="metric-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L15.09 8.26L22 9L17 14L18.18 21L12 17.77L5.82 21L7 14L2 9L8.91 8.26L12 2Z"/>
                </svg> 
            </div>
            
            <div class="metric-card gray">
                <div class="metric-info">
                    <h3>Active Models</h3>
                    <div class="value">29</div>
                    <div class="subtitle">tyre models tracked(NOTE : All TYRES ARE NOT INCULDED IN THIS PAGE. THIS PAGE ONLY SHOW THE BEST SELLER.)</div>
                </div>
                <svg class="metric-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
            </div>
        </div>

        <!-- Chart Controls -->
        <div class="chart-controls" style="display: none;">
            <button class="chart-btn active" onclick="switchChart('bar')">Bar Chart</button>
            <button class="chart-btn" onclick="switchChart('line')">Line Chart</button>
            <button class="chart-btn" onclick="switchChart('pie')">Category View</button>
        </div>

        <!-- Brand Charts Section -->
        <div class="brand-charts-section">
            <div id="brandChartsContainer">
                <!-- Individual brand charts will be populated by JavaScript -->
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top 5 List -->
            <div class="top-list">
                <h3>Top 5 Most Demanded</h3>
                <div id="topList">
                    <!-- Top items will be populated by JavaScript -->
                </div>
            </div>
        </div>

        <!-- Detailed Table -->
        <div class="table-container">
            <div class="table-header">
                <h3>Complete Demand Report</h3>
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Category</th>
                            <th>Demand</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Table rows will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Sample tire demand data with 5+ models per brand
        const tireData = [
            // Michelin - 6 models
            { brand: 'Michelin', model: 'X Multi Energy Z+', demand: 4, category: 'Performance' },
            { brand: 'Michelin', model: 'X Multi Energy D', demand: 4, category: 'Eco' },
            { brand: 'Michelin', model: 'X Multi Z2', demand: 120, category: 'Touring' },
            { brand: 'Michelin', model: 'X Muti D+', demand: 4, category: 'All-Season' },
            // Bridgestone - 6 models
            { brand: 'Bridgestone', model: 'M751HL', demand: 2400, category: 'Touring' },
            { brand: 'Bridgestone', model: 'R271', demand: 1000, category: 'Eco' },
            { brand: 'Bridgestone', model: 'M725', demand: 600, category: 'Performance' },
            { brand: 'Bridgestone', model: 'R156', demand: 200, category: 'All-Season' },
            { brand: 'Bridgestone', model: 'G611', demand: 50, category: 'SUV' },
            
            // Apollo - 5 models
            { brand: 'Apollo', model: 'Endu Race LD(s)', demand: 400,  },
            { brand: 'Apollo', model: 'Endu Race RD HD', demand: 100, category: 'Eco' },
            { brand: 'Apollo', model: 'Endu Race RA', demand: 100, category: 'Performance' },
            { brand: 'Apollo', model: 'Endu Race RA(T)', demand: 100, category: 'SUV' },
            { brand: 'Apollo', model: 'Endu Mile LHD', demand: 10, category: 'Touring' },
            { brand: 'Apollo', model: 'Endu Race LD-D', demand: 50, category: 'Touring' },
            { brand: 'Apollo', model: 'Endu Trax MD+', demand: 10, category: 'Touring' },
            { brand: 'Apollo', model: 'Endu Race LD+', demand: 10, category: 'Touring' },
            { brand: 'Apollo', model: 'Endu Maxx LT HD(LV)-D', demand: 50, category: 'Touring' },
            { brand: 'Apollo', model: 'VIHAAN LUG', demand: 100, category: 'Touring' },
            { brand: 'Apollo', model: 'VIHAAN LUG', demand: 50, category: 'Touring' },
            { brand: 'Apollo', model: 'XT7 Gold HD-D', demand: 150, category: 'Touring' },
            { brand: 'Apollo', model: 'Amar Gold-D', demand: 150, category: 'Touring' },

            
            // Ascenso - 5 models
            { brand: 'Ascenso', model: 'BOSS TS 10', demand: 300, category: 'Performance' },
            { brand: 'Ascenso', model: 'BOSS TD 16', demand: 400, category: 'Touring' },
            { brand: 'Ascenso', model: 'TDB 120', demand: 16, category: 'Eco' },
            { brand: 'Ascenso', model: 'BOSS TR 20', demand: 100, category: 'SUV' },
            { brand: 'Ascenso', model: 'BOSS TR 21', demand: 50, category: 'Performance' },
            
            // JK - 6 models
            { brand: 'JK', model: 'JDE++', demand: 200, category: 'Touring' },
            { brand: 'JK', model: 'JUH 5', demand: 200, category: 'Eco' },
        ];

        // Brand color mapping
        const brandColors = {
            'Michelin': '#1E40AF',      // Deep Blue
            'Bridgestone': '#DC2626',   // Strong Red
            'Apollo': '#059669',        // Forest Green
            'Ascenso': '#D97706',       // Amber
            'JK': '#7C3AED',            // Violet
            'Continental': '#BE185D'    // Rose
        };

        let currentChart = null;
        let currentChartType = 'bar';

        // Initialize the dashboard
        function initDashboard() {
            populateTopList();
            populateTable();
            createBrandCharts();
            updateTopBrandMetric();
        }

        // Update top brand metric dynamically
        function updateTopBrandMetric() {
            // Calculate brand totals
            const brandTotals = tireData.reduce((acc, tire) => {
                acc[tire.brand] = (acc[tire.brand] || 0) + tire.demand;
                return acc;
            }, {});

            // Find the brand with highest total demand
            const topBrand = Object.entries(brandTotals)
                .sort(([,a], [,b]) => b - a)[0];

            // Update the metric card
            const topBrandCard = document.querySelector('.metric-card.black .metric-info');
            topBrandCard.innerHTML = `
                <h3>Top Brand</h3>
                <div class="value">${topBrand[0]}</div>
                <div class="subtitle">${topBrand[1].toLocaleString()} units demand</div>
            `;
        }

        // Create individual brand charts
        function createBrandCharts() {
            const container = document.getElementById('brandChartsContainer');
            const brands = [...new Set(tireData.map(tire => tire.brand))];
            
            // Sort brands by total demand
            const brandTotals = brands.map(brand => {
                const brandData = tireData.filter(tire => tire.brand === brand);
                const totalDemand = brandData.reduce((sum, tire) => sum + tire.demand, 0);
                return { brand, totalDemand, data: brandData };
            }).sort((a, b) => b.totalDemand - a.totalDemand);
            
            container.innerHTML = brandTotals.map((brandInfo, index) => `
                <div class="brand-chart-container">
                    <h2>
                        <div class="brand-color-indicator" style="background-color: ${brandColors[brandInfo.brand]}"></div>
                        ${brandInfo.brand} Tire Models
                        <span style="font-size: 1rem; font-weight: normal; color: #6b7280; margin-left: auto;">
                            Total: ${brandInfo.totalDemand} units
                        </span>
                    </h2>
                    <div class="brand-chart-wrapper">
                        <canvas id="brandChart${index}"></canvas>
                    </div>
                </div>
            `).join('');
            
            // Create charts for each brand
            brandTotals.forEach((brandInfo, index) => {
                const ctx = document.getElementById(`brandChart${index}`).getContext('2d');
                const sortedBrandData = brandInfo.data.sort((a, b) => b.demand - a.demand);
                
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: sortedBrandData.map(tire => tire.model),
                        datasets: [{
                            label: 'Demand',
                            data: sortedBrandData.map(tire => tire.demand),
                            backgroundColor: brandColors[brandInfo.brand],
                            borderColor: brandColors[brandInfo.brand],
                            borderWidth: 1,
                            borderRadius: 4,
                            maxBarThickness: 35,
                            barThickness: 25
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    title: function(context) {
                                        const index = context[0].dataIndex;
                                        return `${brandInfo.brand} ${sortedBrandData[index].model}`;
                                    },
                                    label: function(context) {
                                        return `Demand: ${context.parsed.y} units`;
                                    },
                                    afterLabel: function(context) {
                                        const index = context.dataIndex;
                                        return `Category: ${sortedBrandData[index].category}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    maxRotation: 45,
                                    minRotation: 45
                                },
                                categoryPercentage: 0.9,
                                barPercentage: 0.6
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        }

        // Populate top 5 list
        function populateTopList() {
            const topList = document.getElementById('topList');
            const sortedTires = [...tireData].sort((a, b) => b.demand - a.demand);
            const topTires = sortedTires.slice(0, 5);
            
            topList.innerHTML = topTires.map(tire => `
                <div class="top-item">
                    <div class="item-info">
                        <h4>${tire.brand}</h4>
                        <p>${tire.model}</p><span class="category-badge">${tire.category}</span>
                    </div>
                    <div class="item-demand">
                        <div class="value">${tire.demand}</div>
                        <div class="label">units</div>
                    </div>
                </div>
            `).join('');
        }

        // Populate table
        function populateTable() {
            const tableBody = document.getElementById('tableBody');
            const sortedTires = [...tireData].sort((a, b) => b.demand - a.demand);
            
            tableBody.innerHTML = sortedTires.map((tire, index) => {
                let statusClass = 'status-standard';
                let statusText = 'Standard Demand';
                
                if (tire.demand > 600) {
                    statusClass = 'status-high';
                    statusText = 'High Demand';
                } else if (tire.demand > 500) {
                    statusClass = 'status-medium';
                    statusText = 'Medium Demand';
                }
                
                return `
                    <tr>
                        <td class="rank">#${index + 1}</td>
                        <td class="brand">${tire.brand}</td>
                        <td class="model">${tire.model}</td>
                        <td><span class="category-badge">${tire.category}</span></td>
                        <td class="demand">${tire.demand} units</td>
                        <td><span class="status-badge ${statusClass}">${statusText}</span></td>
                    </tr>
                `;
            }).join('');
        }

        // Remove the old chart functions as they're no longer needed
        // Switch chart type
        function switchChart(type) {
            // This function is now deprecated but kept for compatibility
        }

        // Create chart
        function createChart(type) {
            // This function is now deprecated but kept for compatibility
        }

        // Create bar chart with brand colors
        function createBarChart(ctx) {
            // This function is now deprecated but kept for compatibility
        }

        // Create line chart with brand colors
        function createLineChart(ctx) {
            // This function is now deprecated but kept for compatibility
        }

        // Create pie chart by brand
        function createPieChart(ctx) {
            // This function is now deprecated but kept for compatibility
        }

        // Initialize dashboard when page loads
        document.addEventListener('DOMContentLoaded', initDashboard);
    </script>
</body>
</html>