<?php
// Simple signup page – front-end only
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up · Mindflayer Coffee</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <style>
        :root {
            --espresso: #3B2A2A;
            --mocha: #6F4C3E;
            --sand: #C2B280;
            --cream: #E8D8B0;
            --linen: #F5F5F0;
            --white: #FFFFFF;
            --text-dark: #2A1E1E;
            --text-light: #9C8878;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body: 'DM Sans', sans-serif;
            --transition: 0.3s ease;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: stretch;
            justify-content: center;
            font-family: var(--font-body);
            background: radial-gradient(circle at top left, #C2B28022, #3B2A2A 55%, #000000 100%);
            color: var(--white);
        }

        .auth-page {
            width: 100%;
            max-width: 1100px;
            margin: 2rem auto;
            background: rgba(26, 18, 18, 0.96);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 24px 70px rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(194, 178, 128, 0.25);
        }

        .auth-hero {
            flex: 0 0 50%;
            padding: 2.5rem 2.75rem;
            background:
                radial-gradient(circle at top left, rgba(194, 178, 128, 0.2), transparent 60%),
                linear-gradient(145deg, #3B2A2A 0%, #1C1412 40%, #000000 100%);
            position: relative;
            color: var(--linen);
        }

        .auth-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
            mix-blend-mode: soft-light;
            pointer-events: none;
        }

        .brand-link {
            position: relative;
            z-index: 1;
            font-family: var(--font-display);
            font-weight: 900;
            font-size: 1.6rem;
            color: var(--cream);
            text-decoration: none;
            letter-spacing: -0.03em;
        }

        .brand-link .dot {
            color: var(--sand);
        }

        .hero-heading {
            position: relative;
            z-index: 1;
            margin-top: 3rem;
            font-family: var(--font-display);
            font-size: clamp(2.4rem, 3vw, 3.2rem);
            font-weight: 900;
            line-height: 1.05;
            letter-spacing: -0.03em;
        }

        .hero-heading em {
            font-style: italic;
            color: var(--sand);
        }

        .hero-text {
            position: relative;
            z-index: 1;
            margin-top: 1.2rem;
            font-size: 0.98rem;
            color: rgba(245, 245, 240, 0.75);
            max-width: 320px;
        }

        .hero-note {
            position: relative;
            z-index: 1;
            margin-top: 2.5rem;
            font-size: 0.8rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(245, 245, 240, 0.55);
        }

        .auth-card {
            flex: 0 0 50%;
            padding: 2.5rem 2.5rem;
            background: linear-gradient(145deg, #FDF7ED 0%, #FAF1DF 35%, #F5E6CC 100%);
            color: var(--text-dark);
        }

        .social-login-btn {
            width: 100%;
            border-radius: 999px;
            border: 1px solid rgba(194, 178, 128, 0.6);
            background-color: #FFFFFF;
            color: var(--espresso);
            font-size: 0.9rem;
            padding: 0.7rem 0.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 0.55rem;
            transition: background-color var(--transition), transform 0.15s ease, box-shadow 0.15s ease;
        }

        .social-login-btn i {
            font-size: 1rem;
        }

        .social-login-btn:hover {
            background-color: var(--cream);
            box-shadow: 0 8px 22px rgba(59, 42, 42, 0.18);
            transform: translateY(-1px);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 1.4rem 0 1.1rem;
            font-size: 0.78rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-light);
        }

        .divider span {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(194, 178, 128, 0.7), transparent);
        }

        .auth-title {
            font-family: var(--font-display);
            font-size: 1.9rem;
            font-weight: 700;
            color: var(--espresso);
            letter-spacing: -0.02em;
        }

        .auth-subtitle {
            font-size: 0.92rem;
            color: rgba(42, 46, 67, 0.7);
            margin-top: 0.5rem;
            margin-bottom: 1.8rem;
        }

        .form-label {
            font-size: 0.8rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: rgba(42, 46, 67, 0.75);
            margin-bottom: 0.35rem;
        }

        .form-control {
            background-color: #FFFFFF;
            border-radius: 999px;
            border: 1px solid rgba(194, 178, 128, 0.65);
            padding: 0.65rem 0.95rem;
            font-size: 0.9rem;
            color: var(--espresso);
        }

        .form-control:focus {
            outline: none;
            box-shadow: 0 0 0 1px rgba(194, 178, 128, 0.55);
            border-color: rgba(194, 178, 128, 0.95);
            background-color: #FFFFFF;
        }

        .form-control.is-valid {
            border-color: #4caf50;
            box-shadow: 0 0 0 1px rgba(76, 175, 80, 0.5);
        }

        .form-control.is-invalid {
            border-color: #ff5252;
            box-shadow: 0 0 0 1px rgba(255, 82, 82, 0.4);
        }

        .field-hint {
            font-size: 0.8rem;
            color: #5A6480;
            font-weight: 500;
        }

        .field-error {
            font-size: 0.75rem;
            color: #ff8080;
            margin-top: 0.25rem;
            display: none;
        }

        .field-error.visible {
            display: block;
        }

        .btn-submit {
            width: 100%;
            border-radius: 999px;
            border: none;
            background: linear-gradient(135deg, var(--sand), var(--cream));
            color: var(--espresso);
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 0.9rem 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
            filter: brightness(1.02);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.85rem;
            color: rgba(245, 245, 240, 0.9);
            text-decoration: none;
            margin-top: 1.4rem;
            padding: 0.45rem 0.9rem;
            border-radius: 999px;
            border: 1px solid rgba(232, 216, 176, 0.7);
            background-color: rgba(14, 9, 8, 0.4);
            transition: background-color var(--transition), border-color var(--transition), transform 0.15s ease;
        }

        .back-link:hover {
            color: var(--espresso);
            background-color: var(--cream);
            border-color: var(--cream);
            transform: translateY(-1px);
        }

        .helper-text {
            font-size: 0.8rem;
            color: #5A6480;
            font-weight: 500;
        }

        .form-check-label {
            font-size: 0.8rem;
            color: rgba(245, 245, 240, 0.7);
        }

        .text-link {
            color: var(--sand);
            text-decoration: none;
        }

        .text-link:hover {
            color: var(--cream);
            text-decoration: underline;
        }

        @media (max-width: 991.98px) {
            body {
                background: #0E0908;
            }

            .auth-page {
                margin: 0;
                max-width: 100%;
                border-radius: 0;
                box-shadow: none;
                border: none;
            }

            .auth-hero {
                display: none;
            }

            .auth-card {
                flex: 1 1 auto;
                padding: 2.25rem 1.5rem 2.5rem;
            }
        }
    </style>
</head>

<body>

    <div class="d-flex auth-page">
        <div class="d-lg-flex flex-column justify-content-between auth-hero d-none">
            <div>
                <a href="../../index.php" class="brand-link">
                    ☕ Mindflayer<span class="dot">.</span>
                </a>
                <h1 class="hero-heading">
                    Join the<br>
                    <em>Mindflayer</em> circle.
                </h1>
                <p class="hero-text">
                    Save your favourites, earn rewards on every cup, and get first dibs on limited small-batch roasts.
                </p>
            </div>
            <p class="hero-note">
                Members-only drops · Early access · Birthday drink on us
            </p>
        </div>

        <div class="d-flex flex-column justify-content-between auth-card">
            <div>
                <h2 class="auth-title">Create your account</h2>
                <p class="auth-subtitle">Sign up in seconds or continue with social.</p>

                <!-- Social login first (reduces friction) -->
                <button type="button" class="social-login-btn">
                    <i class="bi bi-google"></i>
                    Continue with Google
                </button>
                <button type="button" class="social-login-btn">
                    <i class="bi bi-facebook"></i>
                    Continue with Facebook
                </button>

                <div class="divider">
                    <span></span>
                    <div>or sign up with email</div>
                    <span></span>
                </div>

                <form id="signup-form" novalidate>
                    <div class="mb-3">
                        <label class="form-label" for="name">Full name</label>
                        <input type="text" class="form-control" id="name" placeholder="e.g. Alex Reyes" required>
                        <div class="field-error" id="error-name">Please enter your full name.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com" required>
                        <div class="field-error" id="error-email">Enter a valid email address.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="phone">Mobile number</label>
                        <input type="tel" class="form-control" id="phone" placeholder="+63 912 345 6789" maxlength="17" required>
                        <div class="field-error" id="error-phone">Use the format +63 912 345 6789.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="birthdate">Birthday</label>
                        <input type="text" class="form-control" id="birthdate" placeholder="MM/DD/YYYY" maxlength="10" required>
                        <div class="field-error" id="error-birthdate">Enter a valid date (MM/DD/YYYY).</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="At least 8 characters" minlength="8" required>
                        <div class="field-error" id="error-password">Password must be at least 8 characters.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="confirm_password">Confirm password</label>
                        <input type="password" class="form-control" id="confirm_password" placeholder="Repeat your password" minlength="8" required>
                        <div class="field-error" id="error-confirm">Passwords do not match.</div>
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" value="" id="newsletter">
                        <label class="form-check-label" for="newsletter">
                            Send me limited-run drink announcements and perks.
                        </label>
                    </div>

                    <button type="submit" class="btn-submit">
                        Create account
                    </button>

                    <p class="mt-3 mb-0 helper-text">
                        By signing up, you agree to our
                        <a href="#" class="text-link">Terms</a> and
                        <a href="#" class="text-link">Privacy Policy</a>.
                    </p>
                </form>
            </div>

            <div class="mt-3">
                <a href="../../index.php" class="back-link">
                    Back to home
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Auth JS -->
    <script src="../../assets/js/auth.js"></script>
    <script>
        const form = document.getElementById('signup-form');

        // Social login handlers
        document.querySelectorAll('.social-login-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const provider = this.textContent.trim().replace('Continue with ', '');
                setLoggedIn(`${provider.toLowerCase()}@example.com`);
                alert(`Signup with ${provider} successful! Redirecting to home page...`);
                setTimeout(() => {
                    window.location.href = '../../index.php';
                }, 500);
            });
        });

        const fields = {
            name: document.getElementById('name'),
            email: document.getElementById('email'),
            phone: document.getElementById('phone'),
            birthdate: document.getElementById('birthdate'),
            password: document.getElementById('password'),
            confirm: document.getElementById('confirm_password')
        };

        function setValidity(input, isValid, errorId) {
            const errorEl = document.getElementById(errorId);
            if (isValid) {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                if (errorEl) errorEl.classList.remove('visible');
            } else {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
                if (errorEl) errorEl.classList.add('visible');
            }
        }

        // Phone input mask: +63 912 345 6789
        fields.phone.addEventListener('input', function() {
            let value = this.value.replace(/[^\d]/g, '');

            if (value.startsWith('0')) value = value.slice(1);
            if (!value.startsWith('63')) value = '63' + value;

            let formatted = '+' + value.substring(0, 2);
            if (value.length > 2) formatted += ' ' + value.substring(2, 5);
            if (value.length > 5) formatted += ' ' + value.substring(5, 8);
            if (value.length > 8) formatted += ' ' + value.substring(8, 12);

            this.value = formatted;

            const isValid = /^\+63 \d{3} \d{3} \d{4}$/.test(this.value);
            setValidity(this, isValid, 'error-phone');
        });

        // Birthdate input mask: MM/DD/YYYY
        fields.birthdate.addEventListener('input', function() {
            let v = this.value.replace(/[^\d]/g, '');
            if (v.length > 2 && v.length <= 4) {
                v = v.slice(0, 2) + '/' + v.slice(2);
            } else if (v.length > 4) {
                v = v.slice(0, 2) + '/' + v.slice(2, 4) + '/' + v.slice(4, 8);
            }
            this.value = v.slice(0, 10);

            const parts = this.value.split('/');
            let isValid = false;
            if (parts.length === 3) {
                const m = parseInt(parts[0], 10);
                const d = parseInt(parts[1], 10);
                const y = parseInt(parts[2], 10);
                const date = new Date(y, m - 1, d);
                isValid =
                    m >= 1 && m <= 12 &&
                    d >= 1 && d <= 31 &&
                    !isNaN(date.getTime()) &&
                    date.getMonth() === m - 1 &&
                    date.getDate() === d;
            }
            setValidity(this, isValid, 'error-birthdate');
        });

        // Inline validation for other fields
        fields.name.addEventListener('input', function() {
            setValidity(this, this.value.trim().length > 1, 'error-name');
        });

        fields.email.addEventListener('input', function() {
            const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            setValidity(this, pattern.test(this.value.trim()), 'error-email');
        });

        fields.password.addEventListener('input', function() {
            const isValid = this.value.length >= 8;
            setValidity(this, isValid, 'error-password');
            // Also re-check confirm field
            if (fields.confirm.value.length > 0) {
                const confirmValid = fields.confirm.value === this.value && isValid;
                setValidity(fields.confirm, confirmValid, 'error-confirm');
            }
        });

        fields.confirm.addEventListener('input', function() {
            const isValid = this.value.length >= 8 && this.value === fields.password.value;
            setValidity(this, isValid, 'error-confirm');
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Trigger all validators
            fields.name.dispatchEvent(new Event('input'));
            fields.email.dispatchEvent(new Event('input'));
            fields.phone.dispatchEvent(new Event('input'));
            fields.birthdate.dispatchEvent(new Event('input'));
            fields.password.dispatchEvent(new Event('input'));
            fields.confirm.dispatchEvent(new Event('input'));

            const hasError = document.querySelector('.form-control.is-invalid');
            if (hasError) {
                alert('Please fix the highlighted fields before continuing.');
                return;
            }

            // Set user as logged in
            setLoggedIn(fields.email.value);

            alert('Signup successful! Redirecting to home page...');

            // Redirect to home page
            setTimeout(() => {
                window.location.href = '../../index.php';
            }, 500);
        });
    </script>
</body>

</html>