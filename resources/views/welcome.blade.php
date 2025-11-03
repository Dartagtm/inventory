<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PT Big - Spesialis Lemari Plastik Berkualitas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --success: #2ecc71;
            --warning: #f39c12;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: var(--dark);
            line-height: 1.6;
        }
        
        header {
            background-color: var(--primary);
            color: white;
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }
        
        .logo span {
            color: var(--secondary);
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-links a:hover {
            color: var(--secondary);
        }
        
        .hero {
            height: 80vh;
            background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/71c8eeba-207a-4e6a-9f46-831ce4e53bf0.png');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            text-align: center;
            color: white;
            margin-top: 60px;
        }
        
        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .hero-content p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto 2rem;
        }
        
        .btn {
            display: inline-block;
            padding: 0.8rem 1.8rem;
            background-color: var(--secondary);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
        }
        
        section {
            padding: 5rem 0;
        }
        
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: var(--primary);
        }
        
        .about {
            background-color: white;
        }
        
        .about-content {
            display: flex;
            gap: 3rem;
            align-items: center;
        }
        
        .about-text {
            flex: 1;
        }
        
        .about-image {
            flex: 1;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .about-image img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        .products {
            background-color: #f9f9f9;
        }
        
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .product-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            max-width: 800px;
            width: 90%;
            position: relative;
        }

        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .product-filter {
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .search-input {
            padding: 0.8rem;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 300px;
        }

        .filter-select {
            padding: 0.8rem;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        /* Login Form Styles */
        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .product-image {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }
        
        .product-info {
            padding: 1.5rem;
        }
        
        .product-name {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }
        
        .product-price {
            font-size: 1.1rem;
            color: var(--secondary);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .stock-status {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .in-stock {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--success);
        }
        
        .out-stock {
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--accent);
        }
        
        .pre-order {
            background-color: rgba(243, 156, 18, 0.2);
            color: var(--warning);
        }
        
        footer {
            background-color: var(--dark);
            color: white;
            padding: 3rem 0 1rem;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-column h3 {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .footer-column h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background-color: var(--secondary);
        }
        
        .footer-column p {
            margin-bottom: 1rem;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 50%;
            color: white;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background-color: var(--secondary);
            transform: translateY(-3px);
        }
        
        .copyright {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .hero-content h1 {
                font-size: 2.2rem;
            }
            
            .about-content {
                flex-direction: column;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
        
        /* Loading spinner for product status */
        .loader {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top: 4px solid var(--secondary);
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <a href="#" class="logo">PT <span>Big</span></a>
                <div class="nav-links">
                    <a href="#home">Beranda</a>
                    <a href="#about">Tentang Kami</a>
                    <a href="#products">Produk</a>
                    <a href="#contact">Kontak</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-sm">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-sm">Register</a>
                        @endif
                    @endauth
                </div>
            </nav>
        </div>
    </header>
    
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <h1>Spesialis Lemari Plastik Berkualitas</h1>
                <p>PT Big menyediakan berbagai macam lemari plastik dengan kualitas terbaik dan harga kompetitif untuk kebutuhan rumah dan bisnis Anda.</p>
                <a href="#products" class="btn">Lihat Produk Kami</a>
            </div>
        </div>
    </section>
    
    <section class="about" id="about">
        <div class="container">
            <h2 class="section-title">Tentang Kami</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>PT Big adalah perusahaan yang bergerak dalam bidang produksi dan distribusi lemari plastik berkualitas tinggi. Didirikan pada tahun 2010, kami telah menjadi pilihan utama bagi ribuan pelanggan di seluruh Indonesia.</p>
                    <p>Dengan komitmen untuk menyediakan produk yang tahan lama, fungsional, dan ramah lingkungan, kami terus berinovasi dalam desain dan material untuk memenuhi kebutuhan pelanggan kami.</p>
                    <p>Produk kami telah mendapatkan sertifikasi kualitas dari lembaga terpercaya dan telah digunakan di berbagai sektor mulai dari rumah tangga, perkantoran, hingga industri.</p>
                </div>
                <div class="about-image">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/0b69814b-6b7c-4bf9-bd09-5ab1d8713dff.png" alt="Gedung pabrik PT Big dengan logo perusahaan di depan pintu masuk utama" />
                </div>
            </div>
        </div>
    </section>
    
    <section class="products" id="products">
        <div class="container">
            <h2 class="section-title">Produk Kami</h2>
            <div class="product-filter">
                <input type="text" id="product-search" placeholder="Cari produk..." class="search-input">
                <select id="stock-filter" class="filter-select">
                    <option value="all">Semua Stok</option>
                    <option value="in-stock">Tersedia</option>
                    <option value="limited">Terbatas</option>
                    <option value="out">Habis</option>
                </select>
            </div>
            <div class="product-grid" id="product-container">
                <!-- Product cards will be loaded dynamically from database -->
                <div class="product-card">
                    <div class="loader"></div>
                    <p>Memuat data produk...</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Login Modal -->
    <div id="login-modal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Login Admin</h2>
            <form id="login-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>

    <footer id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Tentang PT Big</h3>
                    <p>Spesialis lemari plastik berkualitas dengan berbagai macam pilihan untuk kebutuhan rumah dan bisnis Anda.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Kontak Kami</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Jl. Industri Raya No. 123, Jakarta</p>
                    <p><i class="fas fa-phone"></i> (021) 12345678</p>
                    <p><i class="fas fa-envelope"></i> info@ptbig.co.id</p>
                </div>
                <div class="footer-column">
                    <h3>Jam Operasional</h3>
                    <p>Senin - Jumat: 08:00 - 17:00</p>
                    <p>Sabtu: 09:00 - 14:00</p>
                    <p>Minggu & Hari Libur: Tutup</p>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2023 PT Big. Semua Hak Dilindungi.</p>
            </div>
        </div>
    </footer>
    
    <script>
        // Simulasi data produk dari database
        const productData = [
            {
                id: 1,
                name: "Lemari Plastik 2 Pintu",
                description: "Lemari plastik dengan 2 pintu dan 4 rak untuk menyimpan berbagai kebutuhan rumah tangga.",
                price: "Rp 550.000",
                image: "https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/2d63a2a8-0984-4b88-8843-283558c7dc32.png"
            },
            {
                id: 2,
                name: "Lemari Plastik 3 Pintu",
                description: "Lemari plastik besar dengan 3 pintu dan 6 rak, sangat cocok untuk penyimpanan yang lebih banyak.",
                price: "Rp 750.000",
                stock: 8,
                image: "https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/93d6ee34-a5b4-4ddf-83b9-886866f009d8.png"
            },
            {
                id: 3,
                name: "Lemari Plastik Dapur",
                description: "Lemari plastik khusus dapur dengan desain compact dan tahan air.",
                price: "Rp 350.000",
                stock: 0,
                image: "https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/81587e34-4b12-4df4-acfe-6aec4d821865.png"
            },
            {
                id: 4,
                name: "Lemari Plastik Arsip",
                description: "Lemari plastik untuk menyimpan dokumen penting dengan sistem penarikan yang mudah.",
                price: "Rp 450.000",
                stock: 3,
                image: "https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/0768b0a2-5a58-4f3c-828e-786f708160d6.png"
            },
            {
                id: 5,
                name: "Lemari Plastik Kamar Mandi",
                description: "Lemari plastik tahan air khusus kamar mandi dengan berbagai kompartemen.",
                price: "Rp 300.000",
                stock: 20,
                image: "https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/2410437f-854c-46d9-8606-5c0db0a38e5b.png"
            },
            {
                id: 6,
                name: "Lemari Plastik Serbaguna",
                description: "Lemari plastik serbaguna dengan desain modular yang bisa disesuaikan kebutuhan.",
                price: "Rp 650.000",
                stock: 5,
                image: "https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/0b51be5d-067a-437f-b355-bd58d2765c9d.png"
            }
        ];
        
        // Fungsi untuk mendapatkan status stok
        function getStockStatus(stock) {
            if (stock > 10) {
                return { status: 'Tersedia', class: 'in-stock' };
            } else if (stock > 0) {
                return { status: 'Stok Terbatas', class: 'pre-order' };
            } else {
                return { status: 'Habis', class: 'out-stock' };
            }
        }
        
        // Fungsi untuk menampilkan produk
        async function displayProducts(productsToShow = productData) {
            // Get live stock data
            const stockData = await fetchStockData();
            const productContainer = document.getElementById('product-container');
            productContainer.innerHTML = '';
            
            if (productsToShow.length === 0) {
                productContainer.innerHTML = '<p style="grid-column: 1/-1; text-align: center;">Produk tidak ditemukan</p>';
                return;
            }
            
            // Simulasi delay loading dari database
            setTimeout(() => {
                productsToShow.forEach(product => {
                    // Find matching stock for this product
                    const productStock = stockData?.find(item => item.id === product.id)?.stock || 0;
                    const stockInfo = getStockStatus(productStock);
                    
                    const productCard = document.createElement('div');
                    productCard.className = 'product-card';
                    productCard.innerHTML = `
                        <img src="${product.image}" alt="${product.name}" class="product-image" />
                        <div class="product-info">
                            <h3 class="product-name">${product.name}</h3>
                            <p class="product-price">${product.price}</p>
                            <p>${product.description}</p>
                            <p>
                                <span class="stock-status ${stockInfo.class}" data-product-id="${product.id}">
                                    ${stockInfo.status} (${productStock} unit)
                                </span>
                            </p>
                        </div>
                    `;
                    
                    productCard.addEventListener('click', () => showProductModal(product.id));
                    productContainer.appendChild(productCard);
                });
            }, 1500); // Simulasikan loading data dari database
        }
        
        // Filter products based on search and stock
        function filterProducts() {
            const searchTerm = document.getElementById('product-search').value.toLowerCase();
            const stockFilter = document.getElementById('stock-filter').value;
            
            const filtered = productData.filter(product => {
                const matchesSearch = product.name.toLowerCase().includes(searchTerm) || 
                                     product.description.toLowerCase().includes(searchTerm);
                
                // Get stock status from API data
                const productStock = stockData?.find(item => item.id === product.id)?.stock || 0;
                let matchesStock = true;
                if (stockFilter === 'in-stock') {
                    matchesStock = productStock > 10;
                } else if (stockFilter === 'limited') {
                    matchesStock = productStock > 0 && productStock <= 10;
                } else if (stockFilter === 'out') {
                    matchesStock = productStock === 0;
                }
                
                return matchesSearch && matchesStock;
            });
            
            displayProducts(filtered);
        }

        // Show product detail modal
        function showProductModal(productId) {
            const product = productData.find(p => p.id === productId);
            if (!product) return;
            
            const modal = document.querySelector('.modal');
            const details = document.getElementById('modal-product-details');
            
            const productStock = stockData?.find(item => item.id === product.id)?.stock || 0;
            const stockInfo = getStockStatus(productStock);
            
            details.innerHTML = `
                <div style="display: flex; gap: 2rem; margin-bottom: 2rem;">
                    <img src="${product.image}" alt="${product.name}" style="width: 300px; height: auto; border-radius: 8px;">
                    <div>
                        <h2>${product.name}</h2>
                        <p style="font-size: 1.5rem; color: var(--secondary); margin: 1rem 0;">${product.price}</p>
                        <span class="stock-status ${stockInfo.class}" style="font-size: 1rem;">
                            ${stockInfo.status} (${productStock} unit)
                        </span>
                    </div>
                </div>
                <div>
                    <h3>Deskripsi Produk</h3>
                    <p>${product.description}</p>
                    <p>Untuk informasi lebih lanjut dan pemesanan, silakan hubungi kami melalui kontak yang tersedia.</p>
                </div>
            `;
            
            modal.style.display = 'flex';
        }

        // Fungsi untuk mengambil data stok dari PHP API
        async function fetchStockData() {
            try {
                const response = await fetch('/api/stocks', {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'same-origin'
                });
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return await response.json();
            } catch (error) {
                console.error('Error fetching stock:', error);
                return [];
            }
        }
        
        // Handle login form submission
        function handleLogin(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            // Here you would typically send to your Laravel login endpoint
            fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({email, password})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Login berhasil!');
                    document.getElementById('login-modal').style.display = 'none';
                    // Update UI for logged in state
                } else {
                    alert('Login gagal: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat login');
            });
        }

        // Function to update stock display
        function updateStockDisplay(productId, newStock) {
            const stockElement = document.querySelector(`[data-product-id="${productId}"]`);
            if (stockElement) {
                const stockInfo = getStockStatus(newStock);
                stockElement.className = `stock-status ${stockInfo.class}`;
                stockElement.textContent = `${stockInfo.status} (${newStock} unit)`;
            }
        }

        // Event listener untuk ketika dokumen selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Login button click
            document.getElementById('login-btn').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('login-modal').style.display = 'flex';
            });

            // Login form submission
            document.getElementById('login-form').addEventListener('submit', handleLogin);
            
            
            // Close login modal when clicking X
            document.querySelector('#login-modal .close-modal').addEventListener('click', () => {
                document.getElementById('login-modal').style.display = 'none';
            });

            // Close login modal when clicking outside
            document.getElementById('login-modal').addEventListener('click', function(e) {
                if (e.target === this) {
                    this.style.display = 'none';
                }
            });

            displayProducts();
            
            // Filter products
            document.getElementById('product-search').addEventListener('input', filterProducts);
            document.getElementById('stock-filter').addEventListener('change', filterProducts);

            // Initialize product modal
            const modal = document.createElement('div');
            modal.className = 'modal';
            modal.innerHTML = `
                <div class="modal-content">
                    <span class="close-modal">&times;</span>
                    <div id="modal-product-details"></div>
                </div>
            `;
            document.body.appendChild(modal);
            
            // Contoh cara menghubungkan ke API nyata (jika sudah ada)
            /* 
            fetchProductsFromAPI().then(products => {
                // Proses data dari API
                displayProducts(products);
            }).catch(error => {
                console.error('Error fetching products:', error);
            });
            */
        });
    </script>
</body>
</html>
