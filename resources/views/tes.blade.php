<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoMinGo - Jelajahi Keindahan Nusantara</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #fff;
            color: #333;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255,255,255,0.95);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 999;
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 5%;
        }

        .logo {
            font-weight: bold;
            font-size: 1.4rem;
            color: #009688;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 25px;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #009688;
        }

        /* ===== BANNER ===== */
        .banner {
            position: relative;
            height: 100vh;
            background-image: url('{{ asset("assets/img/hero/2.png") }}');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .banner::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.45);
        }

        .banner-content {
            position: relative;
            z-index: 1;
            animation: fadeInUp 1.5s ease-out;
        }

        .banner h2 {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .banner p {
            font-size: 1.2rem;
            margin-bottom: 25px;
        }

        .btn {
            padding: 12px 30px;
            background: #009688;
            color: white;
            border: none;
            border-radius: 30px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn:hover {
            background: #00796b;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== SECTION UMUM ===== */
        .section {
            padding: 80px 5%;
        }

        .bg-light {
            background: #f8f8f8;
        }

        .section h2 {
            text-align: center;
            margin-bottom: 40px;
        }

        /* ===== DESTINASI ===== */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-8px);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card h3 {
            margin: 15px;
            color: #009688;
        }

        .card p {
            margin: 0 15px 20px;
        }

        /* ===== FORM KONTAK ===== */
        form {
            max-width: 500px;
            margin: auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input, textarea {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        /* ===== FOOTER ===== */
        footer {
            background: #009688;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar">
        <div class="container">
            <h1 class="logo">GoMinGo</h1>
            <ul class="nav-links">
                <li><a href="#home">Beranda</a></li>
                <li><a href="#destinasi">Destinasi</a></li>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#kontak">Kontak</a></li>
            </ul>
        </div>
    </nav>

    {{-- Banner --}}
    <section id="home" class="banner">
        <div class="banner-content" data-parallax-speed="3">
            <h2>Selamat Datang di GoMinGo</h2>
            <p>Temukan destinasi wisata terbaik di Indonesia 🌴</p>
            <a href="#destinasi" class="btn">Jelajahi Sekarang</a>
        </div>
    </section>

    {{-- Destinasi --}}
    <section id="destinasi" class="section">
        <div class="container">
            <h2>Destinasi Populer</h2>
            <div class="grid">
                <div class="card">
                    <img src="https://source.unsplash.com/600x400/?bali" alt="Bali">
                    <h3>Bali</h3>
                    <p>Pulau surga dengan pantai dan budaya yang memikat.</p>
                </div>
                <div class="card">
                    <img src="https://source.unsplash.com/600x400/?raja-ampat" alt="Raja Ampat">
                    <h3>Raja Ampat</h3>
                    <p>Surga bawah laut dengan panorama menakjubkan.</p>
                </div>
                <div class="card">
                    <img src="https://source.unsplash.com/600x400/?bromo" alt="Bromo">
                    <h3>Gunung Bromo</h3>
                    <p>Destinasi sunrise terbaik dengan keindahan alam eksotis.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Tentang --}}
    <section id="tentang" class="section bg-light">
        <div class="container">
            <h2>Tentang Kami</h2>
            <p style="max-width:800px; margin:auto; text-align:center;">
                GoMinGo hadir untuk membantu wisatawan menemukan destinasi terbaik dengan mudah.
                Kami percaya bahwa setiap perjalanan membawa cerita baru dan kenangan indah yang tak terlupakan.
            </p>
        </div>
    </section>

    {{-- Kontak --}}
    <section id="kontak" class="section">
        <div class="container">
            <h2>Hubungi Kami</h2>
            <form>
                <input type="text" placeholder="Nama Anda" required>
                <input type="email" placeholder="Email" required>
                <textarea placeholder="Pesan Anda" rows="4" required></textarea>
                <button type="submit" class="btn">Kirim Pesan</button>
            </form>
        </div>
    </section>

    {{-- Footer --}}
    <footer>
        <p>&copy; {{ date('Y') }} GoMinGo - Jelajahi Keindahan Nusantara</p>
    </footer>

    <script>
        document.addEventListener('scroll', function () {
            const elements = document.querySelectorAll('[data-parallax-speed]');
            let scrollTop = window.pageYOffset;
            elements.forEach(el => {
                let speed = el.getAttribute('data-parallax-speed');
                el.style.transform = `translateY(${scrollTop * speed / 100}px)`;
            });
        });
    </script>
</body>
</html>
