<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard - MDT Medical Token</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                    <span class="ml-2 text-gray-600">Patient Dashboard</span>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-600">{{ $patient_name ?? 'John Doe' }}</p>
                        <p class="text-xs text-gray-500">0x742d...bEb0</p>
                    </div>
                    <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Section -->
        <div class="gradient-bg rounded-xl shadow-lg p-8 mb-8 text-white">
            <h1 class="text-3xl font-bold mb-2">Welcome back, {{ $patient_name ?? 'John' }}!</h1>
            <p class="text-purple-100">Manage your medical records and control your data access</p>
            <div class="mt-4 flex items-center space-x-4">
                <div class="bg-white bg-opacity-20 backdrop-blur-sm px-4 py-2 rounded-lg">
                    <p class="text-sm text-purple-100">Your Wallet</p>
                    <p class="font-mono font-semibold">0x742d35Cc6634C0532925a3b844Bc9e7595f0bEb0</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Records</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">12</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Hospitals w/ Access</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">3</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Last Updated</p>
                        <p class="text-xl font-bold text-gray-900 mt-2">2 days ago</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Medical History (Left - 2 columns) -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Medical History</h3>
                        <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition text-sm">
                            Download Records
                        </button>
                    </div>

                    <div class="space-y-4">
                        <!-- Record 1 -->
                        <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900">Diabetes Type 2 - Follow-up</h4>
                                    <p class="text-sm text-gray-600 mt-1">St. Mary's Hospital</p>
                                </div>
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">Ongoing</span>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-3">
                                <div>
                                    <p class="text-xs text-gray-600">Date</p>
                                    <p class="font-semibold text-gray-900">2025-10-15</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600">Doctor</p>
                                    <p class="font-semibold text-gray-900">Dr. Sarah Johnson</p>
                                </div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <p class="text-sm text-gray-700"><strong>Diagnosis:</strong> Regular blood sugar monitoring required. HbA1c levels stable.</p>
                                <p class="text-sm text-gray-700 mt-2"><strong>Treatment:</strong> Metformin 500mg twice daily, diet modification</p>
                            </div>
                            <div class="mt-3 flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Encrypted & Hashed on Blockchain
                            </div>
                        </div>

                        <!-- Record 2 -->
                        <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900">Annual Health Checkup</h4>
                                    <p class="text-sm text-gray-600 mt-1">General Hospital</p>
                                </div>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">Completed</span>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-3">
                                <div>
                                    <p class="text-xs text-gray-600">Date</p>
                                    <p class="font-semibold text-gray-900">2025-09-03</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600">Doctor</p>
                                    <p class="font-semibold text-gray-900">Dr. Michael Chen</p>
                                </div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <p class="text-sm text-gray-700"><strong>Results:</strong> Overall health condition good. Blood pressure normal (120/80).</p>
                                <p class="text-sm text-gray-700 mt-2"><strong>Recommendations:</strong> Continue regular exercise, maintain healthy diet</p>
                            </div>
                            <div class="mt-3 flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Encrypted & Hashed on Blockchain
                            </div>
                        </div>

                        <!-- Record 3 -->
                        <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900">Hypertension Treatment</h4>
                                    <p class="text-sm text-gray-600 mt-1">City Medical Center</p>
                                </div>
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-medium">Stable</span>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-3">
                                <div>
                                    <p class="text-xs text-gray-600">Date</p>
                                    <p class="font-semibold text-gray-900">2025-07-22</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600">Doctor</p>
                                    <p class="font-semibold text-gray-900">Dr. Emily Davis</p>
                                </div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <p class="text-sm text-gray-700"><strong>Diagnosis:</strong> Stage 1 Hypertension, well controlled with medication.</p>
                                <p class="text-sm text-gray-700 mt-2"><strong>Treatment:</strong> Lisinopril 10mg daily, low sodium diet</p>
                            </div>
                            <div class="mt-3 flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Encrypted & Hashed on Blockchain
                            </div>
                        </div>

                        <!-- Record 4 -->
                        <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900">COVID-19 Vaccination</h4>
                                    <p class="text-sm text-gray-600 mt-1">Community Health Center</p>
                                </div>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">Completed</span>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-3">
                                <div>
                                    <p class="text-xs text-gray-600">Date</p>
                                    <p class="font-semibold text-gray-900">2025-05-10</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600">Vaccine</p>
                                    <p class="font-semibold text-gray-900">Pfizer-BioNTech</p>
                                </div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <p class="text-sm text-gray-700"><strong>Record:</strong> Second dose administered. No adverse reactions reported.</p>
                                <p class="text-sm text-gray-700 mt-2"><strong>Next:</strong> Booster recommended in 6 months</p>
                            </div>
                            <div class="mt-3 flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Encrypted & Hashed on Blockchain
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Access Management (Right - 1 column) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-4">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Access Management</h3>
                    <p class="text-sm text-gray-600 mb-6">Control which hospitals can view your medical records</p>

                    <!-- Access List -->
                    <div class="space-y-4">
                        <!-- Hospital 1 -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h4 class="font-semibold text-gray-900">St. Mary's Hospital</h4>
                                    <p class="text-xs text-gray-600 mt-1">0x8a5d...3f2e</p>
                                </div>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium">Active</span>
                            </div>
                            <div class="text-xs text-gray-600 mb-3">
                                <p>Granted: Oct 15, 2025</p>
                                <p>Last Access: 2 days ago</p>
                            </div>
                            <button onclick="revokeAccess('St. Mary\'s Hospital')" class="w-full bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 transition text-sm font-medium">
                                Revoke Access
                            </button>
                        </div>

                        <!-- Hospital 2 -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h4 class="font-semibold text-gray-900">General Hospital</h4>
                                    <p class="text-xs text-gray-600 mt-1">0x3b9c...7a1d</p>
                                </div>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium">Active</span>
                            </div>
                            <div class="text-xs text-gray-600 mb-3">
                                <p>Granted: Sep 03, 2025</p>
                                <p>Last Access: 5 days ago</p>
                            </div>
                            <button onclick="revokeAccess('General Hospital')" class="w-full bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 transition text-sm font-medium">
                                Revoke Access
                            </button>
                        </div>

                        <!-- Hospital 3 -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h4 class="font-semibold text-gray-900">City Medical Center</h4>
                                    <p class="text-xs text-gray-600 mt-1">0x6f2a...9c4b</p>
                                </div>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium">Active</span>
                            </div>
                            <div class="text-xs text-gray-600 mb-3">
                                <p>Granted: Jul 22, 2025</p>
                                <p>Last Access: 1 week ago</p>
                            </div>
                            <button onclick="revokeAccess('City Medical Center')" class="w-full bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 transition text-sm font-medium">
                                Revoke Access
                            </button>
                        </div>
                    </div>

                    <!-- Grant New Access -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h4 class="font-semibold text-gray-900 mb-3">Grant New Access</h4>
                        <input 
                            type="text" 
                            id="hospitalAddress"
                            placeholder="Hospital Wallet Address" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 mb-3 text-sm"
                        >
                        <button onclick="grantAccess()" class="w-full bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition font-medium">
                            Grant Access
                        </button>
                    </div>

                    <!-- Security Info -->
                    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h5 class="text-sm font-semibold text-blue-900 mb-1">Smart Contract Protected</h5>
                                <p class="text-xs text-blue-700">All access permissions are managed via blockchain smart contracts. You can revoke access at any time.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for confirmation -->
    <div id="confirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-8 max-w-md w-full mx-4">
            <h3 class="text-xl font-bold text-gray-900 mb-4" id="modalTitle">Confirm Action</h3>
            <p class="text-gray-600 mb-6" id="modalMessage"></p>
            <div class="flex space-x-4">
                <button onclick="closeModal()" class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition font-medium">
                    Cancel
                </button>
                <button onclick="confirmAction()" class="flex-1 bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition font-medium">
                    Confirm
                </button>
            </div>
        </div>
    </div>

    <script>
        let pendingAction = null;

        function revokeAccess(hospitalName) {
            document.getElementById('modalTitle').textContent = 'Revoke Access';
            document.getElementById('modalMessage').textContent = `Are you sure you want to revoke access for ${hospitalName}? They will no longer be able to view your medical records.`;
            pendingAction = () => {
                // Simulate blockchain transaction
                alert(`Access revoked for ${hospitalName}. Smart contract updated on blockchain.`);
                closeModal();
                // In real implementation, this would call the smart contract
            };
            document.getElementById('confirmModal').classList.remove('hidden');
        }

        function grantAccess() {
            const address = document.getElementById('hospitalAddress').value;
            if (!address) {
                alert('Please enter a hospital wallet address');
                return;
            }
            
            document.getElementById('modalTitle').textContent = 'Grant Access';
            document.getElementById('modalMessage').textContent = `Grant access to hospital at address ${address}? This will allow them to view your medical records.`;
            pendingAction = () => {
                // Simulate blockchain transaction
                alert(`Access granted successfully! Smart contract deployed on blockchain.`);
                document.getElementById('hospitalAddress').value = '';
                closeModal();
                // In real implementation, this would call the smart contract
            };
            document.getElementById('confirmModal').classList.remove('hidden');
        }

        function confirmAction() {
            if (pendingAction) {
                pendingAction();
                pendingAction = null;
            }
        }

        function closeModal() {
            document.getElementById('confirmModal').classList.add('hidden');
            pendingAction = null;
        }
    </script>
</body>
</html>
