<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'HoaxChecker') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['DM Sans', 'system-ui', 'sans-serif'],
                        display: ['Playfair Display', 'Georgia', 'serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    }
                }
            }
        }
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; margin: 0; }

        .btn-primary {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            width: 100%; padding: 0.85rem 1.75rem;
            background: linear-gradient(135deg, #D4AF37 0%, #F0D060 100%);
            color: #0D0D0D; font-weight: 700; font-size: 0.9rem;
            border-radius: 10px; border: none; cursor: pointer;
            transition: all 0.3s ease; text-decoration: none;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 40px rgba(212,175,55,0.40); }

        .input-field {
            width: 100%; padding: 0.85rem 1rem;
            border-radius: 10px; border: 1px solid rgba(0,0,0,0.12);
            font-size: 0.9rem; font-family: 'DM Sans', sans-serif;
            background: white; color: #1A1A1A;
            transition: all 0.2s ease; outline: none;
        }
        .input-field:focus {
            border-color: #D4AF37;
            box-shadow: 0 0 0 3px rgba(212,175,55,0.12);
        }
        .input-field::placeholder { color: #AAAAAA; }

        .label { display: block; font-size: 0.8rem; font-weight: 600; color: #555555; margin-bottom: 0.5rem; letter-spacing: 0.02em; }

        .error-msg { font-size: 0.78rem; color: #DC2626; margin-top: 0.3rem; }

        .link { color: #D4AF37; font-weight: 600; text-decoration: none; transition: opacity 0.2s; }
        .link:hover { opacity: 0.75; }

        .divider {
            display: flex; align-items: center; gap: 12px;
            font-size: 0.75rem; color: #AAAAAA; margin: 1.25rem 0;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px; background: rgba(0,0,0,0.08);
        }

        /* Checkbox custom */
        input[type="checkbox"] {
            width: 16px; height: 16px; accent-color: #D4AF37; cursor: pointer;
        }
    </style>
</head>
<body>
    <div style="min-height: 100vh; display: flex;">

        {{-- ===== LEFT: BRANDING PANEL ===== --}}
        <div class="hidden lg:flex flex-col justify-between p-12" style="width: 45%; background: linear-gradient(145deg, #0D0D0D 0%, #1A1A1A 100%); position: relative; overflow: hidden;">
            {{-- Gold top line --}}
            <div style="position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, #D4AF37, transparent);"></div>

            {{-- Decorative circles --}}
            <div style="position: absolute; bottom: -80px; right: -80px; width: 320px; height: 320px; border-radius: 50%; border: 1px solid rgba(212,175,55,0.12);"></div>
            <div style="position: absolute; bottom: -40px; right: -40px; width: 200px; height: 200px; border-radius: 50%; border: 1px solid rgba(212,175,55,0.08);"></div>
            <div style="position: absolute; top: 40%; left: -60px; width: 150px; height: 150px; border-radius: 50%; border: 1px solid rgba(212,175,55,0.06);"></div>

            {{-- Logo --}}
            <div>
                <a href="{{ route('welcome') }}" style="display: inline-flex; align-items: center; gap: 12px; text-decoration: none;">
                    <div style="width: 42px; height: 42px; border-radius: 10px; background: linear-gradient(135deg, #D4AF37, #F0D060); display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 22px; height: 22px; color: #0D0D0D;" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L3.09 8.26L4 21h16l.91-12.74L12 2zm0 2.5l7.5 5L18.4 19H5.6L4.5 9.5 12 4.5zM11 10h2v5h-2zm0 6h2v2h-2z"/>
                        </svg>
                    </div>
                    <div>
                        <span style="font-family: 'Playfair Display', serif; font-weight: 900; font-size: 1.3rem; color: white; display: block; line-height: 1;">HoaxChecker</span>
                        <span style="font-family: 'JetBrains Mono', monospace; font-size: 0.65rem; color: #D4AF37; letter-spacing: 0.1em;">INDONESIA</span>
                    </div>
                </a>
            </div>

            {{-- Main copy --}}
            <div>
                <p style="font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 900; color: white; line-height: 1.2; margin-bottom: 1.25rem;">
                    Lawan Hoaks.<br>
                    <span style="color: #D4AF37;">Selamatkan</span><br>
                    Kebenaran.
                </p>
                <p style="font-size: 0.9rem; color: #888888; line-height: 1.7; max-width: 320px; margin-bottom: 2rem;">
                    Platform verifikasi berita berbasis AI untuk membantu masyarakat Indonesia mendeteksi misinformasi secara akurat dan cepat.
                </p>

                {{-- Stats --}}
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                    @foreach([['15K+', 'Berita'], ['92%', 'Akurasi'], ['8K+', 'User']] as [$num, $label])
                    <div style="padding: 16px; border-radius: 12px; border: 1px solid rgba(212,175,55,0.2); background: rgba(212,175,55,0.05);">
                        <div style="font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 900; color: #D4AF37; line-height: 1;">{{ $num }}</div>
                        <div style="font-size: 0.72rem; color: #888888; margin-top: 3px;">{{ $label }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Footer note --}}
            <p style="font-size: 0.75rem; color: #555555;">
                &copy; {{ date('Y') }} HoaxChecker Indonesia. Gratis untuk semua.
            </p>
        </div>

        {{-- ===== RIGHT: FORM PANEL ===== --}}
        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; background: #F8F8F7; min-height: 100vh;">

            {{-- Mobile logo --}}
            <div class="lg:hidden mb-8">
                <a href="{{ route('welcome') }}" style="display: inline-flex; align-items: center; gap: 10px; text-decoration: none;">
                    <div style="width: 36px; height: 36px; border-radius: 8px; background: linear-gradient(135deg, #D4AF37, #F0D060); display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 18px; height: 18px; color: #0D0D0D;" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L3.09 8.26L4 21h16l.91-12.74L12 2zm0 2.5l7.5 5L18.4 19H5.6L4.5 9.5 12 4.5zM11 10h2v5h-2zm0 6h2v2h-2z"/>
                        </svg>
                    </div>
                    <span style="font-family: 'Playfair Display', serif; font-weight: 900; font-size: 1.2rem; color: #1A1A1A;">HoaxChecker</span>
                </a>
            </div>

            {{-- Form Card --}}
            <div style="width: 100%; max-width: 420px; background: white; border-radius: 20px; padding: 2.5rem; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 20px 60px rgba(0,0,0,0.08);">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>