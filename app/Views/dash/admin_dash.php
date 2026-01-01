<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - AR_Learn</title>
    <!-- Import des polices Google : Playfair Display pour les titres, Inter pour le texte -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* ========== RESET ET BASE ========== */
        /* Reset des marges et paddings pour tous les éléments */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box; /* Inclut padding et border dans la largeur totale */
        }

        /* Configuration du body avec fond sombre et police Inter */
        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0a; /* Fond noir profond */
            min-height: 100vh;
            color: #EFECE3; /* Couleur texte claire */
            padding: 20px;
        }

        /* ========== CONTENEUR PRINCIPAL ========== */
        /* Conteneur centré avec largeur maximale */
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* ========== HEADER / NAVIGATION ========== */
        /* En-tête avec dégradé horizontal et effet de transparence */
        .header {
            background: linear-gradient(to right, #16213e 0%, #1a1a2e 50%, #16213e 100%);
            padding: 18px 30px;
            border-radius: 12px; /* Coins arrondis subtils */
            margin-bottom: 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 20px rgba(74, 112, 169, 0.2); /* Ombre douce */
            border: 1px solid rgba(143, 171, 212, 0.15); /* Bordure fine */
        }

        /* Section logo avec icône et texte */
        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            font-size: 28px;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 700;
            color: #EFECE3;
            letter-spacing: 1.5px;
        }

        /* Titre de bienvenue */
        .header h1 {
            color: #EFECE3;
            font-size: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Bouton de déconnexion avec dégradé rouge */
        .logout-btn {
            background: linear-gradient(to right, #0a0f47ff, #6263b7ff);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px; /* Coins légèrement arrondis */
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s; /* Animation fluide */
        }

        .logout-btn:hover {
            background: linear-gradient(to right, #6263b7ff, #0a0f47ff);
            transform: translateY(-1px); /* Légère élévation au hover */
        }

        /* ========== SECTION STATISTIQUES ========== */
        /* Grille responsive pour les cartes de statistiques */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* S'adapte automatiquement */
            gap: 28px;
            margin-bottom: 35px;
        }

        /* Carte individuelle de statistique */
        .stat-card {
            background: rgba(26, 26, 46, 0.4); /* Fond semi-transparent */
            padding: 28px;
            border-radius: 12px;
            border: 1px solid rgba(143, 171, 212, 0.2); /* Bordure fine */
            text-align: center;
            transition: all 0.3s;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
        }

        /* Effet hover sur les cartes de stats */
        .stat-card:hover {
            transform: translateY(-4px); /* Légère élévation */
            border-color: #4A70A9;
            background: rgba(26, 26, 46, 0.6);
        }

        /* Titre de la statistique */
        .stat-card h3 {
            color: #8FABD4;
            font-size: 13px;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 500;
        }

        /* Nombre affiché avec dégradé */
        .stat-card .number {
            font-size: 44px;
            font-weight: 800;
            background: linear-gradient(120deg, #8FABD4, #4A70A9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ========== SECTION ACTIONS ========== */
        /* Titre de section avec police Playfair */
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: #EFECE3;
            margin-bottom: 28px;
            text-align: center;
        }

        /* Grille des boutons d'action */
        .actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 28px;
        }

        /* Bouton d'action individuel */
        .action-btn {
            background: rgba(26, 26, 46, 0.4);
            padding: 35px 25px;
            border-radius: 16px;
            text-align: center;
            text-decoration: none;
            color: #EFECE3;
            border: 1px solid rgba(143, 171, 212, 0.2);
            transition: all 0.3s;
            cursor: pointer;
            display: block;
        }

        /* Effet hover interactif sur les boutons d'action */
        .action-btn:hover {
            transform: translateY(-6px); /* Élévation plus prononcée */
            border-color: #4A70A9;
            box-shadow: 0 12px 35px rgba(74, 112, 169, 0.25);
            background: rgba(26, 26, 46, 0.6);
        }

        /* Icône du bouton d'action */
        .icon {
            font-size: 46px;
            margin-bottom: 18px;
            display: block;
        }

        /* Titre du bouton d'action */
        .action-btn h2 {
            font-size: 20px;
            margin-bottom: 10px;
            font-weight: 600;
            color: #EFECE3;
        }

        /* Description du bouton d'action */
        .action-btn p {
            color: rgba(239, 236, 227, 0.65);
            font-size: 14px;
            line-height: 1.5;
        }

        /* ========== SECTION GLOW EFFECT ========== */
        /* Effet de lueur décoratif en arrière-plan */
        .glow-effect {
            position: fixed;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(74, 112, 169, 0.15) 0%, transparent 60%);
            z-index: -1;
            pointer-events: none;
        }

        /* ========== RESPONSIVE DESIGN ========== */
        /* Tablettes et écrans moyens */
        @media (max-width: 1024px) {
            .container {
                padding: 0 20px;
            }

            .stats {
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            }

            .actions {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }

        /* Smartphones et petits écrans */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
                padding: 20px;
            }

            .logo-section {
                margin-bottom: 10px;
            }

            .header h1 {
                font-size: 18px;
            }

            .stats {
                grid-template-columns: 1fr; /* Une colonne sur mobile */
                gap: 20px;
            }

            .actions {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .section-title {
                font-size: 24px;
            }

            .stat-card .number {
                font-size: 36px;
            }

            .action-btn {
                padding: 30px 20px;
            }
        }

        /* Très petits écrans */
        @media (max-width: 480px) {
            .logo-text {
                font-size: 18px;
            }

            .stat-card {
                padding: 22px;
            }

            .action-btn h2 {
                font-size: 18px;
            }
        }

        /* ========== ANIMATIONS ========== */
        /* Animation de fondu à l'apparition */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Application de l'animation aux cartes */
        .stat-card,
        .action-btn {
            animation: fadeIn 0.5s ease-out;
        }

        /* Délai d'animation échelonné pour les cartes */
        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }

        .action-btn:nth-child(1) { animation-delay: 0.4s; }
        .action-btn:nth-child(2) { animation-delay: 0.5s; }
        .action-btn:nth-child(3) { animation-delay: 0.6s; }
    </style>
</head>
<body>
    <!-- Effet de lueur décoratif en arrière-plan -->
    <div class="glow-effect"></div>

    <!-- Conteneur principal de la page -->
    <div class="container">
        <!-- ========== EN-TÊTE ========== -->
        <div class="header">
            <!-- Logo et nom de l'application -->
            <div class="logo-section">
                <span class="logo-icon">📚</span>
                <span class="logo-text">AR_Learn</span>
            </div>

    
            <!-- Bouton de déconnexion pointant vers la route logout -->
            <a href="<?= base_url('admin_logout') ?>" class="logout-btn">Déconnexion</a>
        </div>

        <!-- ========== STATISTIQUES ========== -->
        <!-- Grille affichant les statistiques principales du système -->
        <div class="stats">
            <!-- Carte : Total des utilisateurs -->
            <div class="stat-card">
                <h3>Total Utilisateurs</h3>
                <div class="number"><?= $totalUsers ?? 0 ?></div>
            </div>

            <!-- Carte : Total des catégories -->
            <div class="stat-card">
                <h3>Total Catégories</h3>
                <div class="number"><?= $totalCategories ?? 0 ?></div>
            </div>

            <!-- Carte : Total des tests -->
            <div class="stat-card">
                <h3>Total Tests</h3>
                <div class="number"><?= $totalTests ?? 0 ?></div>
            </div>
        </div>

        <!-- ========== TITRE SECTION ACTIONS ========== -->
        <h2 class="section-title">Gestion de la Plateforme</h2>

        <!-- ========== ACTIONS PRINCIPALES ========== -->
        <!-- Grille des actions administratives disponibles -->
        <div class="actions">
            <!-- Bouton : Gestion des utilisateurs -->
            <a href="<?= base_url('admin/users') ?>" class="action-btn">
                <span class="icon">👥</span>
                <h2>Gérer les Utilisateurs</h2>
                <p>Consulter, modifier et supprimer les comptes utilisateurs</p>
            </a>

            <!-- Bouton : Gestion des catégories -->
            <a href="<?= base_url('admin/categories') ?>" class="action-btn">
                <span class="icon">📁</span>
                <h2>Gérer les Catégories</h2>
                <p>Créer, organiser et supprimer les catégories de quiz</p>
            </a>

            <!-- Bouton : Gestion des tests -->
            <a href="<?= base_url('admin/tests') ?>" class="action-btn">
                <span class="icon">📝</span>
                <h2>Gérer les Tests</h2>
                <p>Réviser, valider et supprimer les tests créés</p>
            </a>
        </div>
    </div>
</body>
</html>