<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MDT Medical Token - jaringan blockchain untuk rekam medis terenkripsi dan berbasis consent">
    <title>{{ $title ?? 'MDT Medical Token' }} | {{ config('app.name', 'MDT') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-950 text-slate-100">
    <div class="relative min-h-screen">
        <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-cyan-500/10 via-slate-900 to-purple-600/10"></div>

        <header class="relative z-20 border-b border-white/5 bg-slate-950/80 backdrop-blur">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6">
                <a href="{{ route('mdt.landing') }}" class="flex items-center gap-3 text-lg font-semibold text-cyan-400">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-cyan-500/20 text-cyan-300">MDT</span>
                    <span>Medical Data Trust</span>
                </a>
                <nav class="hidden items-center gap-8 text-sm font-medium sm:flex">
                    <a href="{{ route('mdt.landing') }}" class="transition hover:text-cyan-300">Tentang Token</a>
                    <a href="{{ route('mdt.hospital') }}" class="transition hover:text-cyan-300">Dashboard Rumah Sakit</a>
                    <a href="{{ route('mdt.patient') }}" class="transition hover:text-cyan-300">Dashboard Pasien</a>
                    <a href="#roadmap" class="transition hover:text-cyan-300">Roadmap</a>
                </nav>
                <div class="hidden sm:block">
                    <a href="{{ route('mdt.patient') }}" class="rounded-full bg-cyan-500 px-5 py-2 text-sm font-semibold text-slate-950 shadow-lg shadow-cyan-500/30 transition hover:bg-cyan-400">Buka Dashboard</a>
                </div>
            </div>
        </header>

        <main class="relative z-10">
            @yield('content')
        </main>

        <footer class="relative z-20 border-t border-white/5 bg-slate-950/80">
            <div class="mx-auto flex max-w-7xl flex-col gap-2 px-6 py-8 text-sm text-slate-400 sm:flex-row sm:items-center sm:justify-between">
                <p>? {{ date('Y') }} MDT Medical Token. Seluruh hak cipta.</p>
                <div class="flex gap-4">
                    <a href="mailto:hello@mdt.health" class="hover:text-cyan-300">Kontak</a>
                    <a href="#" class="hover:text-cyan-300">Whitepaper</a>
                    <a href="#" class="hover:text-cyan-300">Explorer</a>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
