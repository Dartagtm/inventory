@php
    use Illuminate\Support\Str;

    $productsData = $products->map(function ($product) {
        $categoryName = optional($product->category)->name;

        return [
            'id' => $product->id,
            'name' => $product->name,
            'category' => Str::slug($categoryName ?? 'lainnya'),
            'categoryName' => $categoryName ?? 'Lainnya',
            'stock' => max(0, (int) ($product->quantity ?? 0)),
            'minOrder' => max(1, (int) data_get($product, 'minimum_order', 1)),
            'status' => data_get($product, 'status'),
            'description' => data_get($product, 'description') ?: 'Belum ada deskripsi produk dari database.',
            'image' => data_get($product, 'image_url'),
        ];
    });

    $categoryOptions = $categories->map(function ($category) {
        $categoryName = $category->name ?: 'Kategori ' . $category->id;

        return [
            'slug' => Str::slug($categoryName) ?: 'kategori-' . $category->id,
            'name' => $categoryName,
        ];
    });
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>PT BIG - Profil Perusahaan & Katalog Produk</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#1e3a8a',
            accent: '#f97316',
            success: '#10b981',
            warning: '#f97316'
          }
        }
      }
    }
  </script>
  <style>
    body { background-color: #f9fafb; font-family: 'Segoe UI', system-ui, sans-serif; scroll-behavior: smooth; }
    .product-card { transition: transform 0.2s, box-shadow 0.2s; }
    .product-card:hover { transform: translateY(-4px); box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); }
  </style>
</head>
<body class="text-gray-800">

  <!-- Header -->
  <header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center">
          <i class="fas fa-couch text-white text-xl"></i>
        </div>
        <div>
          <h1 class="text-2xl font-bold text-primary">PT BIG</h1>
          <p class="text-xs text-gray-500">Produsen & distributor furniture plastik sejak 2005</p>
        </div>
      </div>
      <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-3">
        <a href="#quotation-form" class="bg-primary hover:bg-blue-800 text-white px-4 py-2 rounded-lg font-medium text-center">
          Ajukan Penawaran
        </a>
        <div class="flex items-center gap-2 justify-end">
          @auth
            <a href="{{ route('dashboard') }}" class="text-primary hover:text-blue-800 font-medium">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="px-3 py-2 text-sm font-medium text-white bg-primary hover:bg-blue-800 rounded-lg">
                Logout
              </button>
            </form>
          @else
            <a href="{{ route('login') }}" class="text-primary hover:text-blue-800 font-medium">Login</a>
            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="px-3 py-2 text-sm font-medium text-white bg-primary hover:bg-blue-800 rounded-lg">Register</a>
            @endif
          @endauth
        </div>
      </div>
    </div>
  </header>

  <!-- Hero -->
  <div class="bg-gradient-to-r from-primary to-blue-700 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">Furniture Plastik Berkualitas untuk Mitra Bisnis</h1>
      <p class="text-xl max-w-3xl mx-auto opacity-90">
        Solusi furniture plastik tahan lama untuk toko, sekolah, kantor, dan UMKM sejak 2005.
      </p>
    </div>
  </div>

  <!-- Search & Filter -->
  <div class="max-w-7xl mx-auto px-4 -mt-6 relative z-10">
    <div class="bg-white rounded-xl shadow-lg p-6">
      <div class="flex flex-col md:flex-row gap-4">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-700 mb-1">Cari Produk</label>
          <div class="relative">
            <input
              type="text"
              id="searchInput"
              placeholder="Cari nama produk..."
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary"
            />
            <i class="fas fa-search absolute right-3 top-2.5 text-gray-400"></i>
          </div>
        </div>
        <div class="md:w-64">
          <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
          <select id="categoryFilter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary">
            <option value="all">Semua Kategori</option>
            @foreach ($categoryOptions as $category)
              <option value="{{ $category['slug'] }}">{{ $category['name'] }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div>

  <!-- Product Grid -->
  <main class="max-w-7xl mx-auto px-4 py-8">
    <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"></div>
  </main>

  <!-- Product Detail Modal -->
  <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
      <div class="p-6">
        <div class="flex justify-between items-start">
          <h2 id="modalTitle" class="text-2xl font-bold text-gray-900"></h2>
          <button id="closeModal" class="text-gray-500 hover:text-gray-700">
            <i class="fas fa-times text-2xl"></i>
          </button>
        </div>
        <div class="mt-4 flex flex-col md:flex-row gap-6">
          <img id="modalImage" src="" alt="Produk" class="w-full md:w-1/2 rounded-lg shadow object-cover">
          <div class="md:w-1/2">
            <p id="modalCategory" class="text-sm text-primary font-semibold mb-2"></p>
            <p id="modalStock" class="text-lg mb-2"></p>
            <p class="text-sm text-gray-600 mb-3">Minimal Order: <span id="modalMinOrder"></span> pcs</p>
            <div id="modalStatus" class="mb-4 inline-block px-3 py-1 rounded-full text-sm font-medium"></div>
            <p id="modalDescription" class="text-gray-600 leading-relaxed mb-4"></p>
            <button id="requestQuotationBtn" class="w-full bg-accent hover:bg-orange-600 text-white font-bold py-2.5 rounded-lg">
              Ajukan Penawaran untuk Produk Ini
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Quotation Form Section -->
  <section id="quotation-form" class="max-w-4xl mx-auto px-4 py-16 bg-white rounded-xl shadow-lg mt-12 mb-16">
    <h2 class="text-3xl font-bold text-center text-gray-900 mb-2">Ajukan Penawaran</h2>
    <p class="text-gray-600 text-center mb-8">Isi form berikut untuk menjadi mitra grosir PT BIG.</p>

    <form id="quotationForm" class="space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
          <input type="text" name="name" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nama Toko *</label>
          <input type="text" name="shop_name" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
          <input type="email" name="email" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp *</label>
          <input type="text" name="whatsapp" required placeholder="081234567890" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap *</label>
        <textarea name="address" required rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Produk yang Diminati *</label>
        <div id="productChecklist" class="grid grid-cols-1 sm:grid-cols-2 gap-3"></div>
      </div>

      <button type="submit" class="w-full bg-primary hover:bg-blue-800 text-white font-bold py-3.5 rounded-lg text-lg">
        Kirim Penawaran
      </button>
    </form>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-8">
    <div class="max-w-7xl mx-auto px-4 text-center space-y-3">
      <p class="text-sm text-gray-300">Jl. Industri Raya No. 123, Jakarta | (021) 12345678 | info@ptbig.co.id</p>
      <p>&copy; {{ now()->year }} PT BIG - Produsen Furniture Plastik Terkemuka</p>
    </div>
  </footer>

  <script>
    const products = @json($productsData);
    let lastClickedProductId = null;

    const fallbackImageBase = 'https://images.unsplash.com/featured/?furniture';

    function resolveImage(product) {
      if (product.image) {
        return product.image;
      }
      const seed = product.id ?? Math.floor(Math.random() * 1000);
      return `${fallbackImageBase}&auto=format&fit=crop&w=600&q=80&sig=${seed}`;
    }

    function getAvailabilityMeta(product) {
      const statusValue = (product.status || '').toString().trim();
      const statusLower = statusValue.toLowerCase();

      if (statusLower.includes('habis') || statusLower.includes('out')) {
        return { text: statusValue || 'Stok habis', className: 'bg-red-100 text-red-600' };
      }
      if (statusLower.includes('terbatas') || statusLower.includes('limited')) {
        return { text: statusValue || 'Stok terbatas', className: 'bg-warning/10 text-warning' };
      }
      if (statusLower.length) {
        return { text: statusValue, className: 'bg-success/10 text-success' };
      }

      if (product.stock >= 100) {
        return { text: 'Stok tersedia', className: 'bg-success/10 text-success' };
      }
      if (product.stock > 0) {
        return { text: 'Stok terbatas', className: 'bg-warning/10 text-warning' };
      }
      return { text: 'Stok habis', className: 'bg-red-100 text-red-600' };
    }

    function renderProducts(filteredProducts) {
      const grid = document.getElementById('productGrid');
      if (!grid) return;

      if (!filteredProducts.length) {
        grid.innerHTML = `
          <div class="col-span-full bg-white rounded-xl shadow p-6 text-center text-gray-600">
            Belum ada produk yang cocok dengan pencarian Anda.
          </div>
        `;
        return;
      }

      grid.innerHTML = '';

      filteredProducts.forEach(product => {
        const availability = getAvailabilityMeta(product);
        const card = document.createElement('div');
        card.className = 'product-card bg-white rounded-xl shadow p-4 cursor-pointer flex flex-col';

        card.innerHTML = `
          <div class="aspect-[4/3] bg-gray-100 rounded-lg overflow-hidden mb-3">
            <img src="${resolveImage(product)}" alt="${product.name}" class="w-full h-full object-cover">
          </div>
          <span class="text-xs font-semibold text-primary">${product.categoryName}</span>
          <h3 class="font-bold mt-1 line-clamp-2 min-h-[48px]">${product.name}</h3>
          <p class="text-xs text-gray-500 mt-1">Minimal Order: ${product.minOrder} pcs</p>
          <div class="mt-2 flex justify-between items-center">
            <span class="text-sm text-gray-600">Stok: ${product.stock}</span>
            <span class="px-2 py-1 text-xs font-medium rounded-full ${availability.className}">
              ${availability.text}
            </span>
          </div>
        `;

        card.addEventListener('click', () => openProductModal(product));
        grid.appendChild(card);
      });
    }

    function openProductModal(product) {
      lastClickedProductId = product.id;

      const availability = getAvailabilityMeta(product);
      const modal = document.getElementById('productModal');
      if (!modal) return;

      document.getElementById('modalTitle').textContent = product.name;
      document.getElementById('modalCategory').textContent = product.categoryName;
      document.getElementById('modalStock').textContent = `Stok: ${product.stock}`;
      document.getElementById('modalMinOrder').textContent = product.minOrder;
      document.getElementById('modalImage').src = resolveImage(product);
      document.getElementById('modalDescription').textContent = product.description;

      const statusElement = document.getElementById('modalStatus');
      statusElement.textContent = availability.text;
      statusElement.className = `mb-4 inline-block px-3 py-1 rounded-full text-sm font-medium ${availability.className}`;

      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }

    function renderProductChecklist() {
      const container = document.getElementById('productChecklist');
      if (!container) return;

      if (!products.length) {
        container.innerHTML = '<p class="text-sm text-gray-500">Belum ada data produk di sistem.</p>';
        return;
      }

      container.innerHTML = '';
      products.forEach(product => {
        const wrapper = document.createElement('label');
        wrapper.className = 'flex items-start gap-3 bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 hover:border-primary hover:bg-white transition';
        wrapper.setAttribute('for', `prod-${product.id}`);
        wrapper.innerHTML = `
          <input type="checkbox" id="prod-${product.id}" name="products[]" value="${product.id}" class="mt-1 h-5 w-5 text-primary rounded border-gray-300 focus:ring-primary">
          <div>
            <p class="text-sm font-medium text-gray-700">${product.name}</p>
            <p class="text-xs text-gray-500">Stok: ${product.stock} | Minimal order ${product.minOrder} pcs</p>
          </div>
        `;
        container.appendChild(wrapper);
      });
    }

    function getFilteredProducts() {
      const searchTerm = (document.getElementById('searchInput')?.value || '').toLowerCase();
      const category = document.getElementById('categoryFilter')?.value || 'all';

      return products.filter(product => {
        const matchesSearch = product.name.toLowerCase().includes(searchTerm);
        const matchesCategory = category === 'all' || product.category === category;
        return matchesSearch && matchesCategory;
      });
    }

    document.addEventListener('DOMContentLoaded', () => {
      const searchInput = document.getElementById('searchInput');
      const categoryFilter = document.getElementById('categoryFilter');
      const modal = document.getElementById('productModal');
      const closeModal = document.getElementById('closeModal');
      const requestQuotationBtn = document.getElementById('requestQuotationBtn');
      const quotationForm = document.getElementById('quotationForm');

      renderProducts(products);
      renderProductChecklist();

      if (searchInput) {
        searchInput.addEventListener('input', () => renderProducts(getFilteredProducts()));
      }

      if (categoryFilter) {
        categoryFilter.addEventListener('change', () => renderProducts(getFilteredProducts()));
      }

      if (closeModal) {
        closeModal.addEventListener('click', () => {
          modal.classList.add('hidden');
          modal.classList.remove('flex');
        });
      }

      if (modal) {
        modal.addEventListener('click', event => {
          if (event.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
          }
        });
      }

      if (requestQuotationBtn) {
        requestQuotationBtn.addEventListener('click', () => {
          modal.classList.add('hidden');
          modal.classList.remove('flex');

          if (lastClickedProductId) {
            const checkbox = document.querySelector(`input[value="${lastClickedProductId}"]`);
            if (checkbox) {
              checkbox.checked = true;
            }
          }

          document.getElementById('quotation-form')?.scrollIntoView({ behavior: 'smooth' });
        });
      }

      if (quotationForm) {
        quotationForm.addEventListener('submit', event => {
          event.preventDefault();
          const checkedProducts = quotationForm.querySelectorAll('input[name="products[]"]:checked');

          if (!checkedProducts.length) {
            alert('Silakan pilih minimal 1 produk.');
            return;
          }

          alert('Penawaran berhasil dikirim! Tim PT BIG akan segera menghubungi Anda.');
          quotationForm.reset();
        });
      }
    });
  </script>

</body>
</html>
