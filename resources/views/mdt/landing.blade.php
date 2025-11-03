<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDT - Medical Token | Secure Medical Records on Blockchain</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold gradient-text">MDT</span>
                    <span class="ml-2 text-gray-600">Medical Token</span>
                </div>
                <div class="flex items-center space-x-8">
                    <a href="#features" class="text-gray-700 hover:text-purple-600 transition">Features</a>
                    <a href="#security" class="text-gray-700 hover:text-purple-600 transition">Security</a>
                    <a href="#how-it-works" class="text-gray-700 hover:text-purple-600 transition">How It Works</a>
                    <a href="/mdt/hospital-login" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">Hospital Login</a>
                    <a href="/mdt/patient-login" class="bg-white text-purple-600 border-2 border-purple-600 px-6 py-2 rounded-lg hover:bg-purple-50 transition">Patient Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-bg pt-32 pb-20 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">
                    Secure Medical Records<br>on the Blockchain
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-purple-100">
                    MDT Token revolutionizes healthcare data management with encryption, hashing, and smart contracts
                </p>
                <div class="flex justify-center space-x-4">
                    <a href="#how-it-works" class="bg-white text-purple-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition text-lg">
                        Learn More
                    </a>
                    <a href="/mdt/whitepaper" class="bg-purple-800 text-white px-8 py-4 rounded-lg font-semibold hover:bg-purple-900 transition text-lg">
                        Read Whitepaper
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Key Features</h2>
                <p class="text-xl text-gray-600">Empowering patients and healthcare providers</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover border border-gray-100">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Double Security</h3>
                    <p class="text-gray-600">Medical records protected with both encryption and hashing algorithms, ensuring maximum data security and privacy.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover border border-gray-100">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Smart Contract Access</h3>
                    <p class="text-gray-600">Patients control who can view their records through blockchain smart contracts. Grant or revoke access instantly.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover border border-gray-100">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Analytics Dashboard</h3>
                    <p class="text-gray-600">Hospitals get powerful analytics: disease tracking, patient statistics, mortality rates, and trend analysis.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Security Section -->
    <section id="security" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Military-Grade Security</h2>
                    <p class="text-lg text-gray-600 mb-6">
                        MDT uses a dual-layer security approach to protect sensitive medical data:
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-gray-900">Encryption</h4>
                                <p class="text-gray-600">All medical records are encrypted before storage, ensuring data confidentiality.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-gray-900">Hashing</h4>
                                <p class="text-gray-600">Data integrity verified through cryptographic hashing, preventing tampering.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-gray-900">Blockchain Immutability</h4>
                                <p class="text-gray-600">Records stored on blockchain cannot be altered or deleted, ensuring permanent history.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-xl">
                    <div class="bg-gray-900 text-green-400 p-6 rounded-lg font-mono text-sm">
                        <div class="mb-2">$ mdt encrypt record</div>
                        <div class="text-gray-500">Encrypting medical record...</div>
                        <div class="text-gray-500">Hash: 0x7a8f3c2e9b1d...</div>
                        <div class="text-gray-500">? Record secured</div>
                        <div class="mt-4">$ mdt grant-access 0x1234...</div>
                        <div class="text-gray-500">Smart contract deployed</div>
                        <div class="text-gray-500">? Access granted</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">How It Works</h2>
                <p class="text-xl text-gray-600">Simple, secure, and efficient</p>
            </div>

            <div class="space-y-12">
                <!-- Step 1 -->
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">1</div>
                    </div>
                    <div class="ml-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Patient Registration</h3>
                        <p class="text-gray-600 text-lg">Patients create an account with their blockchain wallet address. Their identity is secured on-chain.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">2</div>
                    </div>
                    <div class="ml-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Hospital Records Medical Data</h3>
                        <p class="text-gray-600 text-lg">When a patient visits a hospital, medical records are encrypted, hashed, and stored on the blockchain.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">3</div>
                    </div>
                    <div class="ml-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Patient Grants Access</h3>
                        <p class="text-gray-600 text-lg">Patients control access through smart contracts. They can grant or revoke hospital access at any time.</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">4</div>
                    </div>
                    <div class="ml-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Hospital Views History</h3>
                        <p class="text-gray-600 text-lg">With permission, hospitals can view complete medical history by entering the patient's wallet address.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Use Cases -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Use Cases</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Hospital -->
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">For Hospitals</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-purple-600 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600">Access complete patient medical history instantly</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-purple-600 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600">Track disease trends and patient statistics</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-purple-600 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600">Analyze monthly patient growth and mortality rates</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-purple-600 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600">Improve patient care with data-driven insights</span>
                        </li>
                    </ul>
                </div>

                <!-- Patient -->
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">For Patients</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-purple-600 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600">Own and control your medical data</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-purple-600 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600">View your complete medical history in one place</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-purple-600 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600">Grant access to hospitals with one click</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-purple-600 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600">Revoke access anytime to maintain privacy</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gradient-bg py-20 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold mb-6">Ready to Join the Future of Healthcare?</h2>
            <p class="text-xl mb-8 text-purple-100">Start using MDT today and take control of your medical data</p>
            <div class="flex justify-center space-x-4">
                <a href="/mdt/hospital-register" class="bg-white text-purple-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition text-lg">
                    Hospital Registration
                </a>
                <a href="/mdt/patient-register" class="bg-purple-800 text-white px-8 py-4 rounded-lg font-semibold hover:bg-purple-900 transition text-lg">
                    Patient Registration
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 gradient-text">MDT Token</h3>
                    <p class="text-gray-400">Revolutionizing healthcare with blockchain technology.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Product</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Features</a></li>
                        <li><a href="#" class="hover:text-white transition">Security</a></li>
                        <li><a href="#" class="hover:text-white transition">Pricing</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Documentation</a></li>
                        <li><a href="#" class="hover:text-white transition">Whitepaper</a></li>
                        <li><a href="#" class="hover:text-white transition">API</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Support</a></li>
                        <li><a href="#" class="hover:text-white transition">Twitter</a></li>
                        <li><a href="#" class="hover:text-white transition">GitHub</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 MDT Medical Token. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
