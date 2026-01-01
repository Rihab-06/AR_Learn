<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AR_Learn - Accueil</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* ========================================
           RESET & BASE STYLES
        ======================================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0a;
            min-height: 100vh;
            color: #EFECE3;
        }

        /* ========================================
           NAVIGATION BAR
        ======================================== */
        .navbar {
            /* Effet glassmorphism pour un look moderne */
            background: rgba(22, 33, 62, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            
            padding: 18px 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            
            /* Fixe la navbar en haut lors du scroll */
            position: sticky;
            top: 0;
            z-index: 1000;
            
            /* Ombres et bordures pour la profondeur */
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
            border-bottom: 1px solid rgba(143, 171, 212, 0.2);
        }

        /* ========================================
           LOGO SECTION
        ======================================== */
        .logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
            
            /* Container arrondi avec fond subtil */
            padding: 8px 20px;
            background: rgba(143, 171, 212, 0.12);
            border-radius: 15px;
            
            /* Animation douce au hover */
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .logo-section:hover {
            background: rgba(143, 171, 212, 0.18);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(143, 171, 212, 0.2);
        }

        .logo-img {
            width: 45px;
            height: 45px;
            object-fit: contain;
            
            /* Effet de lueur autour du logo */
            filter: drop-shadow(0 0 12px rgba(143, 171, 212, 0.6));
            transition: filter 0.3s;
        }

        .logo-section:hover .logo-img {
            filter: drop-shadow(0 0 18px rgba(143, 171, 212, 0.9));
        }

        .logo-text {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 2.5px;
            
            /* Gradient de texte élégant */
            background: linear-gradient(135deg, #8FABD4, #EFECE3, #8FABD4);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            
            /* Animation du gradient */
            animation: gradient-shift 3s ease infinite;
        }

        @keyframes gradient-shift {
            0%, 100% { background-position: 0% center; }
            50% { background-position: 100% center; }
        }

        /* ========================================
           USER SECTION (Dropdown CSS pur)
        ======================================== */
        .user-section {
            position: relative;
        }

        /* Cache la checkbox utilisée pour le toggle */
        #user-menu-toggle {
            display: none;
        }

        .user-button {
            /* Style bouton moderne */
            background: rgba(74, 112, 169, 0.25);
            border: 1px solid rgba(143, 171, 212, 0.35);
            padding: 11px 20px;
            border-radius: 30px;
            
            display: flex;
            align-items: center;
            gap: 10px;
            
            font-size: 14px;
            font-weight: 500;
            color: #EFECE3;
            
            cursor: pointer;
            user-select: none;
            transition: all 0.3s ease;
        }

        .user-button:hover {
            background: rgba(74, 112, 169, 0.4);
            border-color: #8FABD4;
            box-shadow: 0 5px 20px rgba(74, 112, 169, 0.35);
            transform: translateY(-2px);
        }

        .arrow {
            font-size: 10px;
            transition: transform 0.3s ease;
        }

        /* Rotation de la flèche quand le menu est ouvert */
        #user-menu-toggle:checked ~ .user-button .arrow {
            transform: rotate(180deg);
        }

        /* Dropdown menu */
        .user-dropdown {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            
            /* Style moderne avec glassmorphism */
            background: rgba(26, 26, 46, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(143, 171, 212, 0.25);
            border-radius: 12px;
            
            min-width: 220px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            
            /* Caché par défaut */
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        /* Affiche le dropdown quand la checkbox est cochée */
        #user-menu-toggle:checked ~ .user-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .user-dropdown-item {
            display: block;
            padding: 14px 20px;
            color: #EFECE3;
            text-decoration: none;
            font-size: 14px;
            
            border-bottom: 1px solid rgba(143, 171, 212, 0.1);
            transition: all 0.2s ease;
        }

        .user-dropdown-item:first-child {
            border-radius: 11px 11px 0 0;
        }

        .user-dropdown-item:last-child {
            border-bottom: none;
            border-radius: 0 0 11px 11px;
        }

        .user-dropdown-item:hover {
            background: rgba(74, 112, 169, 0.25);
            padding-left: 26px;
        }

        /* Style spécial pour le bouton de déconnexion */
        .user-dropdown-item.logout-item {
            color: #ff6b6b;
        }

        .user-dropdown-item.logout-item:hover {
            background: rgba(255, 107, 107, 0.15);
            color: #ff8787;
        }

        /* ========================================
           HERO SECTION
        ======================================== */
        .hero-section {
            padding: 80px 50px 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Effet de lumière radiale en arrière-plan */
        .hero-section::before {
            content: '';
            position: absolute;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(74, 112, 169, 0.2) 0%, transparent 65%);
            z-index: 0;
            pointer-events: none;
            animation: pulse-glow 4s ease-in-out infinite;
        }

        @keyframes pulse-glow {
            0%, 100% { opacity: 0.5; transform: translateX(-50%) scale(1); }
            50% { opacity: 0.8; transform: translateX(-50%) scale(1.1); }
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .tagline {
            font-size: 13px;
            color: #8FABD4;
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-bottom: 20px;
            font-weight: 500;
            opacity: 0.9;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 62px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 20px;
            
            /* Gradient animé sur le titre */
            background: linear-gradient(120deg, #EFECE3, #8FABD4, #EFECE3);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient-shift 4s ease infinite;
        }

        .hero-subtitle {
            font-size: 18px;
            color: #EFECE3;
            opacity: 0.75;
            max-width: 620px;
            margin: 0 auto 40px;
            line-height: 1.6;
        }

        /* ========================================
           THEMES SECTION (Cards Grid)
        ======================================== */
        .themes-section {
            padding: 40px 50px 80px;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }

        /* ========================================
           QUIZ CARDS
        ======================================== */
        .quiz-card {
            background: rgba(26, 26, 46, 0.5);
            border: 1px solid rgba(143, 171, 212, 0.25);
            border-radius: 18px;
            overflow: hidden;
            
            cursor: pointer;
            transition: all 0.4s ease;
        }

        .quiz-card:hover {
            transform: translateY(-8px);
            border-color: #4A70A9;
            box-shadow: 0 15px 45px rgba(74, 112, 169, 0.3);
            background: rgba(26, 26, 46, 0.7);
        }

        /* Header avec icon et gradient */
        .card-header {
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            position: relative;
            overflow: hidden;
        }

        /* Gradient de fond pour chaque thème */
        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.9;
            transition: opacity 0.3s;
        }

        .quiz-card:hover .card-header::before {
            opacity: 1;
        }

        .card-icon {
            position: relative;
            z-index: 1;
            transition: transform 0.3s;
        }

        .quiz-card:hover .card-icon {
            transform: scale(1.15);
        }

        /* Couleurs thématiques */
        .card-math .card-header::before {
            background: linear-gradient(135deg, #4A70A9, #6a92d0);
        }

        .card-php .card-header::before {
            background: linear-gradient(135deg, #5c85c4, #4A70A9);
        }

        .card-spanish .card-header::before {
            background: linear-gradient(135deg, #16213e, #4A70A9);
        }

        /* Corps de la carte */
        .card-body {
            padding: 24px;
        }

        .card-title {
            font-size: 22px;
            font-weight: 600;
            color: #EFECE3;
            margin-bottom: 15px;
        }

        .card-description {
            font-size: 14px;
            color: rgba(239, 236, 227, 0.7);
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* Bouton de démarrage */
        .start-btn {
            width: 100%;
            padding: 12px;
            
            background: linear-gradient(to right, #4A70A9, #5c85c4);
            color: #EFECE3;
            border: none;
            border-radius: 10px;
            
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            
            transition: all 0.3s ease;
        }

        .start-btn:hover {
            background: linear-gradient(to right, #5c85c4, #6a92d0);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(74, 112, 169, 0.4);
        }

        /* ========================================
           EMPTY CARD (Ajouter un thème)
        ======================================== */
        .card-empty {
            /* Gradient subtil en arrière-plan */
            background: linear-gradient(135deg, 
                rgba(74, 112, 169, 0.08), 
                rgba(143, 171, 212, 0.05));
            
            /* Bordure en pointillés élégante */
            border: 2px dashed rgba(143, 171, 212, 0.4);
            border-radius: 18px;
            
            min-height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s ease;
        }

        /* Effet de lueur au hover */
        .card-empty::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, 
                rgba(74, 112, 169, 0.2), 
                transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .card-empty:hover::before {
            opacity: 1;
        }

        .card-empty:hover {
            border-color: #4A70A9;
            border-style: solid;
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 18px 50px rgba(74, 112, 169, 0.35);
            background: linear-gradient(135deg, 
                rgba(74, 112, 169, 0.15), 
                rgba(143, 171, 212, 0.1));
        }

        .empty-content {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .empty-icon {
            font-size: 55px;
            margin-bottom: 18px;
            opacity: 0.65;
            transition: all 0.4s ease;
        }

        .card-empty:hover .empty-icon {
            opacity: 1;
            transform: rotate(90deg) scale(1.25);
        }

        .empty-text {
            font-size: 16px;
            font-weight: 600;
            color: #8FABD4;
            transition: color 0.3s;
        }

        .card-empty:hover .empty-text {
            color: #EFECE3;
        }

        /* ========================================
           RESPONSIVE DESIGN
        ======================================== */
        @media (max-width: 1024px) {
            .navbar {
                padding: 15px 35px;
            }

            .hero-title {
                font-size: 50px;
            }

            .cards-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                gap: 25px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
                flex-direction: column;
                gap: 15px;
            }

            .logo-section {
                width: 100%;
                justify-content: center;
            }

            .user-section {
                width: 100%;
            }

            .user-button {
                width: 100%;
                justify-content: center;
            }

            .user-dropdown {
                left: 0;
                right: 0;
            }

            .hero-title {
                font-size: 38px;
            }

            .hero-subtitle {
                font-size: 16px;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }

            .themes-section {
                padding: 30px 20px 60px;
            }
        }
    </style>
</head>
<body>
    <!-- ========================================
         NAVIGATION BAR
    ======================================== -->
    <nav class="navbar">
        <!-- Logo et nom de l'application -->
        <div class="logo-section">
            <img src="<?= base_url('assets/images/logo-app.png') ?>" 
                 alt="AR_Learn Logo" 
                 class="logo-img">
            <span class="logo-text">AR_Learn</span>
        </div>

        <!-- Section utilisateur avec dropdown CSS pur -->
        <div class="user-section">
            <!-- Checkbox cachée pour contrôler le dropdown -->
            <input type="checkbox" id="user-menu-toggle">
            
            <!-- Bouton utilisateur (label pour la checkbox) -->
            <label for="user-menu-toggle" class="user-button">
                👤 Utilisateur
                <span class="arrow">▼</span>
            </label>
            
            <!-- Menu dropdown -->
            <div class="user-dropdown">
                <a href="/profile/edit" class="user-dropdown-item">
                    ✏️ Éditer le profil
                </a>
                <a href="/logout" class="user-dropdown-item logout-item">
                    🚪 Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <!-- ========================================
         HERO SECTION (En-tête principal)
    ======================================== -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="tagline">EMPOWER YOUR MIND</div>
            <h1 class="hero-title">Master Every Challenge</h1>
            <p class="hero-subtitle">
                Découvrez des quiz interactifs, suivez votre progression et dépassez vos limites avec AR_Learn
            </p>
        </div>
    </section>

    <!-- ========================================
         THEMES SECTION (Grille de cartes)
    ======================================== -->
    <section class="themes-section">
        <div class="cards-grid">
            <!-- Carte Mathématiques -->
            <div class="quiz-card card-math">
                <div class="card-header">
                    <span class="card-icon">🔢</span>
                </div>
                <div class="card-body">
                    <h3 class="card-title">Mathématiques</h3>
                    <p class="card-description">
                        Algèbre, géométrie, statistiques et plus encore pour maîtriser les maths
                    </p>
                    <button class="start-btn">Commencer</button>
                </div>
            </div>

            <!-- Carte PHP -->
            <div class="quiz-card card-php">
                <div class="card-header">
                    <span class="card-icon">💻</span>
                </div>
                <div class="card-body">
                    <h3 class="card-title">PHP</h3>
                    <p class="card-description">
                        Programmation web, POO, frameworks et bonnes pratiques PHP
                    </p>
                    <button class="start-btn">Commencer</button>
                </div>
            </div>

            <!-- Carte Español -->
            <div class="quiz-card card-spanish">
                <div class="card-header">
                    <span class="card-icon">🇪🇸</span>
                </div>
                <div class="card-body">
                    <h3 class="card-title">Español</h3>
                    <p class="card-description">
                        Vocabulaire, grammaire, conjugaison pour parler espagnol couramment
                    </p>
                    <button class="start-btn">Commencer</button>
                </div>
            </div>

            <!-- Carte vide pour ajouter un nouveau thème -->
            <div class="quiz-card card-empty">
                <div class="empty-content">
                    <div class="empty-icon">➕</div>
                    <div class="empty-text">Ajouter un nouveau thème</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================
         SCRIPT (Fermeture du menu au clic extérieur)
    ======================================== -->
    <script>
        // Ferme le menu utilisateur quand on clique en dehors
        document.addEventListener('click', function(e) {
            const userSection = document.querySelector('.user-section');
            const checkbox = document.getElementById('user-menu-toggle');
            
            // Si le clic est en dehors de la section utilisateur
            if (!userSection.contains(e.target)) {
                checkbox.checked = false;
            }
        });
    </script>
</body>
</html>