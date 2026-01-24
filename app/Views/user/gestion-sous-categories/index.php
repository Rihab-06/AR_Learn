<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AR_Learn - Sous-Catégories</title>
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
            background: rgba(22, 33, 62, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            
            padding: 18px 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            
            position: sticky;
            top: 0;
            z-index: 1000;
            
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
            
            padding: 8px 20px;
            background: rgba(143, 171, 212, 0.12);
            border-radius: 15px;
            
            transition: all 0.3s ease;
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
            transform: scale(2.7);
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
            
            background: linear-gradient(135deg, #8FABD4, #EFECE3, #8FABD4);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            
            animation: gradient-shift 3s ease infinite;
        }

        @keyframes gradient-shift {
            0%, 100% { background-position: 0% center; }
            50% { background-position: 100% center; }
        }
        
        /* ========================================
           USER SECTION (Dropdown CSS pur)
        ======================================== */
        
        .back-link {
            display: inline-flex;
            align-items: left;
            gap: 8px;
            color: #0b9659;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 10px;
            transition: all 0.3s;
        }

        .back-link:hover {
            color: #EFECE3;
            transform: translateX(-5px);
        }

        .user-section {
            position: relative;
        }

        #user-menu-toggle {
            display: none;
        }

        .user-button {
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

        #user-menu-toggle:checked ~ .user-button .arrow {
            transform: rotate(180deg);
        }

        .user-dropdown {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            
            background: rgba(26, 26, 46, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(143, 171, 212, 0.25);
            border-radius: 12px;
            
            min-width: 220px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

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
           ACTION BUTTONS (NOUVEAUX BOUTONS)
        ======================================== */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .btn {
            padding: 14px 32px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            background: linear-gradient(to right, #4A70A9, #5c85c4);
            color: #EFECE3;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(74, 112, 169, 0.4);
        }

        .btn-secondary {
            background: rgba(143, 171, 212, 0.15);
            color: #8FABD4;
            border: 1px solid rgba(143, 171, 212, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(143, 171, 212, 0.25);
            border-color: #8FABD4;
            transform: translateY(-2px);
        }

        /* ========================================
           THEMES SECTION
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
            
            transition: all 0.4s ease;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .quiz-card:hover {
            transform: translateY(-8px);
            border-color: var(--card-color, #4A70A9);
            box-shadow: 0 15px 45px rgba(74, 112, 169, 0.3);
            background: rgba(26, 26, 46, 0.7);
        }

        .card-header {
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--card-color, #4A70A9), var(--card-color-light, #6a92d0));
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
            min-height: 60px;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid rgba(143, 171, 212, 0.1);
        }

        .themes-count {
            font-size: 13px;
            color: #8FABD4;
            font-weight: 500;
        }

        .start-btn {
            padding: 10px 24px;
            background: linear-gradient(to right, var(--card-color, #4A70A9), var(--card-color-light, #5c85c4));
            color: #EFECE3;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .start-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(74, 112, 169, 0.4);
        }

        /* ========================================
           NO CONTENT MESSAGE
        ======================================== */
        .no-content {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 20px;
        }

        .no-content-icon {
            font-size: 80px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .no-content-text {
            font-size: 18px;
            color: rgba(239, 236, 227, 0.5);
            margin-bottom: 30px;
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

            /* Boutons en colonne sur mobile */
            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- ========================================
         NAVIGATION BAR
    ======================================== -->
    <nav class="navbar">
        <!-- Logo de l'application -->
        <div class="logo-section">
            <img src="<?= base_url('assets/images/logo-app.png') ?>" 
                 alt="AR_Learn Logo" 
                 class="logo-img">
            <span class="logo-text">AR_Learn</span>
        </div>

        <!-- Menu utilisateur (dropdown sans JavaScript) -->
        <div class="user-section">
            <input type="checkbox" id="user-menu-toggle">
            <label for="user-menu-toggle" class="user-button">
                👤 <?= isset($user) ? esc($user['prenom'] . ' ' . $user['nom']) : 'Utilisateur' ?>
                <span class="arrow">▼</span>
            </label>
            
            <div class="user-dropdown">
                <a href="<?= base_url('user/profile') ?>" class="user-dropdown-item">
                    ✏️ Mon profil
                </a>
                <a href="<?= base_url('user/history') ?>" class="user-dropdown-item">
                    📊 Mon historique
                </a>
                <a href="<?= base_url('logout') ?>" class="user-dropdown-item logout-item">
                    🚪 Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <!-- ========================================
         HERO SECTION AVEC TITRE ET BOUTONS
    ======================================== -->
    <section class="hero-section">
        <div class="hero-content">
            <!-- Petit texte au-dessus du titre -->
            <p class="tagline">Explorez les thèmes</p>
            
            <!-- Titre principal : nom de la catégorie parent -->
            <h1 class="hero-title">
                <?= isset($categorieParent) ? esc($categorieParent['nom']) : 'Sous-catégories' ?>
            </h1>
            
            <!-- Sous-titre : description de la catégorie -->
            <p class="hero-subtitle">
                <?= isset($categorieParent) && !empty($categorieParent['explication']) 
                    ? esc($categorieParent['explication']) 
                    : 'Choisissez une sous-catégorie pour commencer votre apprentissage' ?>
            </p>

            <!-- ✅ NOUVEAUX BOUTONS D'ACTION -->
            <div class="action-buttons">
                <!-- Bouton 1 : Retour au tableau de bord -->
                <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">
                    ← Retour au tableau de bord
                </a>
                
                <!-- Bouton 2 : Ajouter une sous-catégorie -->
                <a href="<?= base_url('user/sous-categorie/creation/'. $categorieParent['id_categorie']) ?>" class="btn btn-primary">
                    ➕ Ajouter une sous-catégorie
                </a>
            </div>
        </div>
    </section>

    <!-- ========================================
         THEMES SECTION (Liste des sous-catégories)
    ======================================== -->
    <section class="themes-section">
        <div class="cards-grid">

            <!-- Si des sous-catégories existent -->
            <?php if (!empty($sousCategories)): ?>
                
                <!-- Boucle pour afficher chaque sous-catégorie -->
                <?php foreach ($sousCategories as $category): ?>
                    
                    <!-- Carte cliquable de la sous-catégorie -->
                    <a href="<?= base_url('/user/categorie/sous-categorie/'.$categorieParent['nom'].'/' . $category['id_categorie']) ?>" 
                       class="quiz-card"
                       style="--card-color: <?= esc($category['color']) ?>; 
                              --card-color-light: <?= esc($category['color']) ?>dd">
                        <!-- En-tête de la carte avec l'icône -->
                        <div class="card-header">
                            <span class="card-icon"><?= $category['icon'] ?></span>
                        </div>
                        
                        <!-- Contenu de la carte -->
                        <div class="card-body">
                            <!-- Nom de la sous-catégorie -->
                            <h3 class="card-title"><?= esc($category['nom']) ?></h3>
                            
                            <!-- Description de la sous-catégorie -->
                            <p class="card-description">
                                <?= !empty($category['explication']) 
                                    ? esc($category['explication']) 
                                    : 'Découvrez les thèmes de cette catégorie' ?>
                            </p>
                            
                            <!-- Pied de carte avec bouton -->
                            <div class="card-footer">
                                <span class="start-btn">Découvrir →</span>
                            </div>
                        </div>
                    </a>
                    
                <?php endforeach; ?>
                
            <?php else: ?>
                
                <!-- Message si aucune sous-catégorie n'existe -->
                <div class="no-content">
                    <div class="no-content-icon">📚</div>
                    <p class="no-content-text">
                        Aucune sous-catégorie disponible pour le moment.<br>
                        Cliquez sur "Ajouter une sous-catégorie" pour en créer une !
                    </p>
                </div>
                
            <?php endif; ?>
            
        </div>
    </section>

</body>
</html>