<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Dashboard - MDT Medical Token</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-purple-800 bg-clip-text text-transparent">MDT</span>
                    <span class="ml-2 text-gray-600">Hospital Dashboard</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ $hospital_name ?? 'General Hospital' }}</span>
                    <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Total Patients -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Patients</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $total_patients ?? 1247 }}</p>
                        <p class="text-green-600 text-sm mt-2">+12% from last month</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- This Month -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">This Month</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $patients_this_month ?? 89 }}</p>
                        <p class="text-green-600 text-sm mt-2">+8% increase</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Last Month -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Last Month</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $patients_last_month ?? 82 }}</p>
                        <p class="text-gray-600 text-sm mt-2">Previous period</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Mortality Rate -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Deaths</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $total_deaths ?? 23 }}</p>
                        <p class="text-gray-600 text-sm mt-2">1.8% mortality rate</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Patient Trend Chart -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Patient Trend (Last 6 Months)</h3>
                <canvas id="patientTrendChart"></canvas>
            </div>

            <!-- Disease Distribution -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Top Diseases Distribution</h3>
                <canvas id="diseaseChart"></canvas>
            </div>
        </div>

        <!-- Disease Statistics Table -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Disease Statistics</h3>
                <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                    Export Report
                </button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Disease Name</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Total Cases</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">This Month</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Last Month</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Change</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Severity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $diseases = [
                                ['name' => 'Diabetes Mellitus', 'total' => 245, 'this_month' => 18, 'last_month' => 15, 'severity' => 'Medium'],
                                ['name' => 'Hypertension', 'total' => 312, 'this_month' => 22, 'last_month' => 19, 'severity' => 'Medium'],
                                ['name' => 'COVID-19', 'total' => 187, 'this_month' => 8, 'last_month' => 12, 'severity' => 'High'],
                                ['name' => 'Influenza', 'total' => 156, 'this_month' => 14, 'last_month' => 11, 'severity' => 'Low'],
                                ['name' => 'Pneumonia', 'total' => 98, 'this_month' => 7, 'last_month' => 8, 'severity' => 'High'],
                                ['name' => 'Heart Disease', 'total' => 134, 'this_month' => 10, 'last_month' => 9, 'severity' => 'High'],
                                ['name' => 'Asthma', 'total' => 89, 'this_month' => 6, 'last_month' => 7, 'severity' => 'Medium'],
                                ['name' => 'Tuberculosis', 'total' => 67, 'this_month' => 4, 'last_month' => 5, 'severity' => 'High'],
                            ];
                        @endphp
                        
                        @foreach($diseases as $disease)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="py-4 px-4 font-medium text-gray-900">{{ $disease['name'] }}</td>
                            <td class="py-4 px-4 text-gray-700">{{ $disease['total'] }}</td>
                            <td class="py-4 px-4 text-gray-700">{{ $disease['this_month'] }}</td>
                            <td class="py-4 px-4 text-gray-700">{{ $disease['last_month'] }}</td>
                            <td class="py-4 px-4">
                                @php
                                    $change = $disease['this_month'] - $disease['last_month'];
                                    $percentage = $disease['last_month'] > 0 ? round(($change / $disease['last_month']) * 100, 1) : 0;
                                @endphp
                                @if($change > 0)
                                    <span class="text-red-600 font-semibold">+{{ $change }} (+{{ $percentage }}%)</span>
                                @elseif($change < 0)
                                    <span class="text-green-600 font-semibold">{{ $change }} ({{ $percentage }}%)</span>
                                @else
                                    <span class="text-gray-600">No change</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                @if($disease['severity'] == 'High')
                                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">High</span>
                                @elseif($disease['severity'] == 'Medium')
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">Medium</span>
                                @else
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Low</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Patient Lookup -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Patient Medical Records Lookup</h3>
            <p class="text-gray-600 mb-4">Enter patient's wallet address to view their medical history (requires patient permission via smart contract)</p>
            
            <div class="flex gap-4 mb-4">
                <input 
                    type="text" 
                    id="patientAddress" 
                    placeholder="0x742d35Cc6634C0532925a3b844Bc9e7595f0bEb0" 
                    class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600"
                >
                <button 
                    onclick="lookupPatient()" 
                    class="bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition font-semibold"
                >
                    Search
                </button>
            </div>

            <!-- Results (Hidden by default) -->
            <div id="patientResults" class="hidden mt-6 border-t pt-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h4 class="text-lg font-bold text-gray-900">Patient: John Doe</h4>
                        <p class="text-gray-600 text-sm">Wallet: 0x742d...bEb0</p>
                    </div>
                    <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-medium">Access Granted</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm">Age</p>
                        <p class="text-2xl font-bold text-gray-900">45 years</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm">Blood Type</p>
                        <p class="text-2xl font-bold text-gray-900">O+</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm">Total Visits</p>
                        <p class="text-2xl font-bold text-gray-900">12</p>
                    </div>
                </div>

                <h5 class="font-bold text-gray-900 mb-3">Medical History</h5>
                <div class="space-y-3">
                    <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-blue-500">
                        <div class="flex justify-between items-start mb-2">
                            <h6 class="font-semibold text-gray-900">Diabetes Type 2</h6>
                            <span class="text-sm text-gray-600">2025-10-15</span>
                        </div>
                        <p class="text-gray-600 text-sm">Hospital: St. Mary's Hospital</p>
                        <p class="text-gray-600 text-sm mt-1">Status: Under Treatment</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-green-500">
                        <div class="flex justify-between items-start mb-2">
                            <h6 class="font-semibold text-gray-900">Annual Checkup</h6>
                            <span class="text-sm text-gray-600">2025-09-03</span>
                        </div>
                        <p class="text-gray-600 text-sm">Hospital: General Hospital</p>
                        <p class="text-gray-600 text-sm mt-1">Status: Completed</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-yellow-500">
                        <div class="flex justify-between items-start mb-2">
                            <h6 class="font-semibold text-gray-900">Hypertension</h6>
                            <span class="text-sm text-gray-600">2025-07-22</span>
                        </div>
                        <p class="text-gray-600 text-sm">Hospital: City Medical Center</p>
                        <p class="text-gray-600 text-sm mt-1">Status: Stable</p>
                    </div>
                </div>
            </div>

            <!-- No Access Message -->
            <div id="noAccessMessage" class="hidden mt-6 border-t pt-6">
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div>
                            <h5 class="font-bold text-red-900">Access Denied</h5>
                            <p class="text-red-700 text-sm">Patient has not granted permission to access their medical records. Please request access from the patient.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Patient Trend Chart
        const trendCtx = document.getElementById('patientTrendChart').getContext('2d');
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: ['June', 'July', 'August', 'September', 'October', 'November'],
                datasets: [{
                    label: 'Total Patients',
                    data: [65, 72, 78, 82, 89, 97],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Disease Distribution Chart
        const diseaseCtx = document.getElementById('diseaseChart').getContext('2d');
        new Chart(diseaseCtx, {
            type: 'doughnut',
            data: {
                labels: ['Hypertension', 'Diabetes', 'COVID-19', 'Influenza', 'Heart Disease', 'Other'],
                datasets: [{
                    data: [312, 245, 187, 156, 134, 213],
                    backgroundColor: [
                        '#667eea',
                        '#764ba2',
                        '#f093fb',
                        '#4facfe',
                        '#43e97b',
                        '#ffd89b'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Patient Lookup Function
        function lookupPatient() {
            const address = document.getElementById('patientAddress').value;
            
            if (!address) {
                alert('Please enter a patient wallet address');
                return;
            }

            // Simulate API call
            setTimeout(() => {
                // Randomly show access granted or denied for demo
                const hasAccess = Math.random() > 0.3;
                
                document.getElementById('patientResults').classList.toggle('hidden', !hasAccess);
                document.getElementById('noAccessMessage').classList.toggle('hidden', hasAccess);
            }, 500);
        }
    </script>
</body>
</html>
