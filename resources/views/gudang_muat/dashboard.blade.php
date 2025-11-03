<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudang Muat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsqr/1.4.0/jsQR.js"></script>
    <style>
        #video {
            width: 100%;
            height: auto;
            border: 1px solid black;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header>
        <div class="container mx-auto p-6">
            <nav class="flex justify-between items-center">
                <a href="#" class="logo text-2xl font-bold">PT <span class="text-blue-500">Big</span></a>
                <div class="nav-links flex items-center">
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="btn btn-sm mx-2 bg-red-500 text-white px-4 py-2 rounded">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm mx-2 bg-blue-500 text-white px-4 py-2 rounded">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-sm mx-2 bg-blue-500 text-white px-4 py-2 rounded">Register</a>
                        @endif
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Gudang Muat</h1>
        <div class="flex justify-center mb-4">
            <button id="masuk" class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-green-600 transition">Scan Masuk</button>
            <button id="keluar" class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-red-600 transition ml-4">Scan Keluar</button>
        </div>
        
        <div id="scanner" class="hidden mb-4">
            <video id="video" autoplay></video>
            <button id="stop" class="bg-gray-500 text-white px-4 py-2 rounded mt-4">Stop Scanning</button>
            <div id="result" class="mt-4 text-lg font-semibold"></div>
        </div>

        <h2 class="text-2xl font-semibold mt-6">Pesanan yang Sudah Dimasukkan</h2>
        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">No. Pesanan</th>
                        <th class="py-2 px-4 border-b">Nama Toko</th>
                        <th class="py-2 px-4 border-b">Nama Produk</th>
                        <th class="py-2 px-4 border-b">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $order->order_number }}</td>
                        <td class="py-2 px-4 border-b">{{ $order->store_location }}</td>
                        <td class="py-2 px-4 border-b">{{ $order->product->name ?? 'Produk tidak ditemukan' }}</td>
                        <td class="py-2 px-4 border-b">{{ $order->quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const video = document.getElementById('video');
        const resultDiv = document.getElementById('result');
        const scannerDiv = document.getElementById('scanner');
        const stopButton = document.getElementById('stop');

        document.getElementById('masuk').addEventListener('click', () => startScanner('Masuk'));
        document.getElementById('keluar').addEventListener('click', () => startScanner('Keluar'));

        function startScanner(action) {
            scannerDiv.classList.remove('hidden');
            resultDiv.innerHTML = `Scanning for ${action}...`;
            navigator.mediaDevices.getUser Media({ video: true })
                .then(stream => {
                    video.srcObject = stream;
                    video.play();
                    scanBarcode();
                })
                .catch(err => {
                    console.error("Error accessing camera: ", err);
                });
        }

        function scanBarcode() {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            const scan = () => {
                if (video.readyState === video.HAVE_ENOUGH_DATA) {
                    canvas.height = video.videoHeight;
                    canvas.width = video.videoWidth;
                    context.drawImage(video, 0, 0, canvas.width, canvas.height);
                    const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                    const code = jsQR(imageData.data, canvas.width, canvas.height);

                    if (code) {
                        resultDiv.innerHTML = `Scanned Code: ${code.data}`;
                        stopScanning();
                    }
                }
                requestAnimationFrame(scan);
            };
            scan();
        }

        function stopScanning() {
            const stream = video.srcObject;
            if (stream) {
                const tracks = stream.getTracks();
                tracks.forEach(track => track.stop());
            }
            video.srcObject = null;
            scannerDiv.classList.add('hidden');
        }

        stopButton.addEventListener('click', stopScanning);
    </script>
</body>
</html>
