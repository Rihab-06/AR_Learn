<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - AR_Learn</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            height: 100vh;
            overflow: hidden;
            background: #0a0a0a;
        }

        .auth-container {
            display: flex;
            height: 100vh;
        }

        /* ========== LEFT SIDE ========== */
        .left-side {
            flex: 1;
            background: linear-gradient(to bottom right, #16213e 0%, #1a1a2e 50%, #0f3460 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 70px 50px;
        }

        /* Animated Background */
        .bg-animation {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
        }

        .wave {
            position: absolute;
            width: 200%;
            height: 200%;
            border-radius: 40%;
            opacity: 0.12;
        }

        .wave-1 {
            background: linear-gradient(to bottom right, #4A70A9, #6a92d0);
            animation: wave 18s linear infinite;
            bottom: -50%;
            left: -50%;
        }

        .wave-2 {
            background: linear-gradient(to top left, #5c85c4, #4A70A9);
            animation: wave 23s linear infinite reverse;
            bottom: -40%;
            left: -60%;
        }

        .wave-3 {
            background: radial-gradient(circle, #4A70A9 0%, transparent 65%);
            animation: wave 28s ease-in-out infinite;
            top: -50%;
            right: -50%;
        }

        @keyframes wave {
            0% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(180deg) scale(1.08); }
            100% { transform: rotate(360deg) scale(1); }
        }

        /* Floating Particles */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: rgba(239, 236, 227, 0.35);
            border-radius: 50%;
            animation: float 14s infinite;
        }

        .particle:nth-child(1) { left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { left: 20%; animation-delay: 2s; }
        .particle:nth-child(3) { left: 30%; animation-delay: 4s; }
        .particle:nth-child(4) { left: 40%; animation-delay: 1s; }
        .particle:nth-child(5) { left: 50%; animation-delay: 3s; }
        .particle:nth-child(6) { left: 60%; animation-delay: 5s; }
        .particle:nth-child(7) { left: 70%; animation-delay: 2.5s; }
        .particle:nth-child(8) { left: 80%; animation-delay: 4.5s; }

        @keyframes float {
            0%, 100% { 
                transform: translateY(100vh) translateX(0); 
                opacity: 0;
            }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { 
                transform: translateY(-100px) translateX(50px); 
                opacity: 0;
            }
        }

        /* Content */
        .left-content {
            position: relative;
            z-index: 10;
            text-align: left;
            max-width: 580px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 55px;
        }

        .logo-icon {
            font-size: 42px;
        }

        .logo-text {
            font-size: 28px;
            font-weight: 700;
            color: #EFECE3;
            letter-spacing: 1.5px;
        }

        .tagline {
            font-size: 13px;
            color: #8FABD4;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            margin-bottom: 28px;
            font-weight: 500;
        }

        .main-heading {
            font-family: 'Playfair Display', serif;
            font-size: 64px;
            font-weight: 700;
            line-height: 1.1;
            color: #EFECE3;
            margin-bottom: 38px;
        }

        .main-heading span {
            background: linear-gradient(120deg, #8FABD4, #4A70A9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .quote-box {
            position: relative;
            padding-left: 28px;
            border-left: 3px solid #4A70A9;
            margin-bottom: 28px;
        }

        .quote-text {
            font-size: 20px;
            line-height: 1.5;
            color: #EFECE3;
            font-style: italic;
            margin-bottom: 14px;
            font-weight: 300;
        }

        .quote-author {
            font-size: 15px;
            color: #8FABD4;
            font-weight: 500;
        }

        .features {
            display: flex;
            gap: 35px;
            margin-top: 45px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .feature-icon {
            font-size: 22px;
            color: #4A70A9;
        }

        .feature-text {
            font-size: 14px;
            color: #EFECE3;
            font-weight: 500;
        }

        /* ========== RIGHT SIDE ========== */
        .right-side {
            flex: 1;
            background: #0a0a0a;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            position: relative;
        }

        .right-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 1px;
            height: 100%;
            background: linear-gradient(180deg, transparent, #4A70A9, transparent);
        }

        .form-wrapper {
            width: 100%;
            max-width: 460px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 45px;
        }

        .form-logo {
            font-size: 19px;
            color: #EFECE3;
            font-weight: 600;
            margin-bottom: 28px;
            letter-spacing: 1px;
        }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 44px;
            color: #EFECE3;
            margin-bottom: 10px;
        }

        .form-subtitle {
            color: #666;
            font-size: 14px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            display: block;
            margin-bottom: 9px;
            color: #EFECE3;
            font-weight: 500;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 15px 18px;
            background: rgba(26, 26, 46, 0.5);
            border: 1px solid rgba(143, 171, 212, 0.25);
            border-radius: 10px;
            font-size: 15px;
            color: #EFECE3;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #4A70A9;
            background: rgba(26, 26, 46, 0.7);
            box-shadow: 0 0 0 3px rgba(74, 112, 169, 0.12);
        }

        .form-input::placeholder {
            color: #666;
        }

        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 19px;
            color: #666;
            transition: color 0.3s;
        }

        .password-toggle:hover {
            color: #4A70A9;
        }

        /* Form Options */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #EFECE3;
            font-size: 14px;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 17px;
            height: 17px;
            cursor: pointer;
            accent-color: #4A70A9;
        }

        .forgot-link {
            color: #4A70A9;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .forgot-link:hover {
            color: #8FABD4;
        }

        /* Button */
        .btn-primary {
            width: 100%;
            padding: 16px;
            background: linear-gradient(to right, #4A70A9, #5c85c4);
            color: #EFECE3;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(74, 112, 169, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 30px rgba(74, 112, 169, 0.35);
            background: linear-gradient(to right, #5c85c4, #6a92d0);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        /* Switch Form */
        .form-switch {
            text-align: center;
            margin-top: 28px;
            color: #666;
            font-size: 14px;
        }

        .form-switch a {
            color: #4A70A9;
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
            transition: color 0.3s;
        }

        .form-switch a:hover {
            color: #8FABD4;
        }

        /* Alerts */
        .alert {
            padding: 13px 17px;
            border-radius: 9px;
            margin-bottom: 22px;
            font-size: 14px;
            border-left: 3px solid;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border-color: #10b981;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border-color: #ef4444;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .auth-container {
                flex-direction: column;
            }

            .left-side {
                min-height: 50vh;
                padding: 40px 30px;
            }

            .main-heading {
                font-size: 46px;
            }

            .features {
                flex-direction: column;
                gap: 20px;
            }

            .right-side {
                padding: 30px 20px;
            }
        }

        @media (max-width: 640px) {
            .main-heading {
                font-size: 34px;
            }

            .quote-text {
                font-size: 17px;
            }

            .form-title {
                font-size: 34px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- LEFT SIDE - ARTISTIC -->
        <div class="left-side">
            <!-- Animated Background -->
            <div class="bg-animation">
                <div class="wave wave-1"></div>
                <div class="wave wave-2"></div>
                <div class="wave wave-3"></div>
            </div>

            <!-- Floating Particles -->
            <div class="particles">
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
            </div>

            <!-- Content -->
            <div class="left-content">
                <div class="logo-section">
                    <span class="logo-icon">📚</span>
                    <span class="logo-text">AR_Learn</span>
                </div>

                <div class="tagline">LIBÉREZ VOTRE POTENTIEL</div>

                <h1 class="main-heading">
                    Maîtrisez <span>Chaque</span><br>
                    Défi
                </h1>

               
                    <p class="quote-text">
                        "L'apprentissage est un trésor qui suivra son propriétaire partout."
                    </p>
                    <p class="quote-author">*** Proverbe chinois</p>


                <div class="features">
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span class="feature-text">Suivez votre progression</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span class="feature-text">Tests pratiques</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span class="feature-text">Résultats instantanés</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE - LOGIN FORM -->
        <div class="right-side">
            <div class="form-wrapper">
                <div class="form-header">
                    <div class="form-logo">AR_Learn</div>
                    <h2 class="form-title">Bienvenue de nouveau</h2>
                    <p class="form-subtitle">Entrez vos identifiants pour continuer</p>
                </div>

                <!-- Success Alert -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        ✓ <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <!-- Error Alert -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-error">
                        ✕ <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action='/process-login' method="POST">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-input"
                            placeholder="Entrez votre email"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="password-wrapper">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="form-input"
                                placeholder="Entrez votre mot de passe"
                                required
                            >
                            <span class="password-toggle" onclick="togglePassword()">👁️</span>
                        </div>
                    </div>

                    

                    <button type="submit" class="btn-primary">Se connecter</button>
                </form>

                <div class="form-switch">
                    Pas encore de compte ?
                    <a href="register">Créez-en un</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
        }
    </script>
</body>
</html>