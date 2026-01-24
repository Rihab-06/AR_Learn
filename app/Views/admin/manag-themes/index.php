<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Thèmes - AR_Learn</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ===== RESET & BASE ===== */
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
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* ===== HEADER (Barre de navigation) ===== */
        .header {
            background: linear-gradient(to right, #16213e 0%, #1a1a2e 50%, #16213e 100%);
            padding: 18px 30px;
            border-radius: 12px;
            margin-bottom: 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 20px rgba(74, 112, 169, 0.2);
            border: 1px solid rgba(143, 171, 212, 0.15);
        }

        /* Section logo */
        .logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 8px 20px;
            background: rgba(143, 171, 212, 0.12);
            border-radius: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .logo-section:hover {
            background: rgba(143, 171, 212, 0.18);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(143, 171, 212, 0.2);
        }

        /* Image du logo */
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

        /* Texte du logo */
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

        .header-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        /* Bouton retour */
        .back-btn {
            background: linear-gradient(to right, #0a0f47ff, #6263b7ff);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .back-btn:hover {
            background: linear-gradient(to right, #6263b7ff, #0a0f47ff);
            transform: translateY(-1px);
        }

        /* Bouton ajouter */
        .add-btn {
            background: linear-gradient(to right, #10b981, #059669);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-block;
        }

        .add-btn:hover {
            background: linear-gradient(to right, #059669, #10b981);
            transform: translateY(-1px);
        }

        /* ===== TITRE DE LA PAGE ===== */
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            color: #EFECE3;
            margin-bottom: 20px;
            text-align: center;
        }

        .category-info {
            text-align: center;
            margin-bottom: 35px;
            padding: 15px;
            background: rgba(74, 112, 169, 0.1);
            border-radius: 12px;
            border: 1px solid rgba(143, 171, 212, 0.2);
        }

        .category-info p {
            color: #8FABD4;
            font-size: 14px;
        }

        .category-info strong {
            color: #EFECE3;
            font-size: 18px;
            font-weight: 600;
        }

        /* ===== BARRE D'INFORMATIONS ===== */
        .toolbar {
            background: rgba(26, 26, 46, 0.4);
            padding: 20px 25px;
            border-radius: 12px;
            margin-bottom: 30px;
            border: 1px solid rgba(143, 171, 212, 0.2);
        }

        .toolbar p {
            color: #8FABD4;
            font-size: 14px;
        }

        .toolbar strong {
            color: #EFECE3;
            font-size: 16px;
        }

        /* ===== CONTENEUR DU TABLEAU ===== */
        .table-container {
            background: rgba(26, 26, 46, 0.4);
            border-radius: 12px;
            border: 1px solid rgba(143, 171, 212, 0.2);
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
        }

        /* Wrapper pour le scroll horizontal si nécessaire */
        .table-wrapper {
            overflow-x: auto;
        }

        /* ===== TABLEAU ===== */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* En-tête du tableau */
        thead {
            background: rgba(22, 33, 62, 0.6);
        }

        /* Cellules d'en-tête */
        th {
            padding: 18px 15px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: #8FABD4;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(143, 171, 212, 0.2);
            white-space: nowrap;
        }

        /* Cellules de données */
        td {
            padding: 18px 15px;
            border-bottom: 1px solid rgba(143, 171, 212, 0.1);
            color: #EFECE3;
            font-size: 14px;
            vertical-align: middle;
        }

        /* Lignes du tableau */
        tbody tr {
            transition: all 0.3s;
        }

        /* Effet hover sur les lignes */
        tbody tr:hover {
            background: rgba(74, 112, 169, 0.1);
            transform: scale(1.001);
        }

        /* Supprimer la bordure de la dernière ligne */
        tbody tr:last-child td {
            border-bottom: none;
        }

        /* ===== BADGE POUR LE NOM DU THÈME ===== */
        .theme-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: linear-gradient(135deg, #4A70A9 0%, #8FABD4 100%);
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            color: white;
            box-shadow: 0 2px 8px rgba(74, 112, 169, 0.3);
            transition: all 0.3s;
        }

        .theme-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 112, 169, 0.5);
        }

        .theme-icon {
            font-size: 18px;
        }

        /* Badge de slug */
        .slug-badge {
            display: inline-block;
            padding: 4px 10px;
            background: rgba(143, 171, 212, 0.15);
            border: 1px solid rgba(143, 171, 212, 0.3);
            border-radius: 6px;
            font-size: 12px;
            font-family: monospace;
            color: #8FABD4;
        }

        /* Description */
        .description-text {
            color: rgba(239, 236, 227, 0.8);
            font-size: 13px;
            line-height: 1.5;
            max-width: 300px;
        }

        /* Icône standalone */
        .icon-display {
            font-size: 28px;
            text-align: center;
        }

        /* Badge de difficulté */
        .difficulty-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
            transition: all 0.3s;
        }

        .difficulty-badge:hover {
            transform: scale(1.05);
        }

        /* Couleurs selon difficulté */
        .difficulty-facile {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.4);
        }

        .difficulty-moyen {
            background: rgba(251, 146, 60, 0.2);
            color: #fb923c;
            border: 1px solid rgba(251, 146, 60, 0.4);
        }

        .difficulty-difficile {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.4);
        }

        /* Date */
        .date-text {
            color: rgba(239, 236, 227, 0.7);
            font-size: 13px;
            white-space: nowrap;
        }

        /* ===== BOUTONS D'ACTIONS ===== */
        .action-buttons {
            display: flex;
            gap: 6px;
            flex-direction: column;
            align-items: stretch;
            min-width: 120px;
        }

        /* Style de base pour les boutons d'action */
        .btn-action {
            padding: 8px 14px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            white-space: nowrap;
            text-align: center;
        }

        /* Bouton modifier (bleu) */
        .btn-edit {
            background: linear-gradient(135deg, #4A70A9 0%, #8FABD4 100%);
            color: white;
        }

        .btn-edit:hover {
            transform: translateX(3px);
            box-shadow: -3px 0 12px rgba(74, 112, 169, 0.4);
        }

        /* Bouton voir (violet) */
        .btn-view {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
        }

        .btn-view:hover {
            transform: translateX(3px);
            box-shadow: -3px 0 12px rgba(139, 92, 246, 0.4);
        }

        /* Bouton supprimer (rouge) */
        .btn-delete {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .btn-delete:hover {
            transform: translateX(3px);
            box-shadow: -3px 0 12px rgba(239, 68, 68, 0.4);
        }

        /* ===== ÉTAT VIDE (quand il n'y a pas de thèmes) ===== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: rgba(239, 236, 227, 0.5);
        }

        .empty-state-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #8FABD4;
        }

        .empty-state p {
            margin-bottom: 20px;
        }

        /* ===== GLOW EFFECT ===== */
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

        /* ===== ANIMATIONS ===== */
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

        .table-container {
            animation: fadeIn 0.5s ease-out;
        }

        /* ===== RESPONSIVE (adaptation mobile) ===== */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            /* Header en colonne sur mobile */
            .header {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
                text-align: center;
            }

            .header-actions {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }

            .page-title {
                font-size: 24px;
            }

            /* Permettre le scroll horizontal sur mobile */
            .table-wrapper {
                overflow-x: scroll;
            }

            table {
                min-width: 1000px;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="glow-effect"></div>

    <div class="container">
        <!-- ===== HEADER (Barre de navigation supérieure) ===== -->
        <div class="header">
            <!-- Section logo -->
            <div class="logo-section">
                <img src="<?= base_url('assets/images/logo-app.png') ?>" 
                     alt="AR_Learn Logo" 
                     class="logo-img">
                <span class="logo-text">AR_Learn</span>
            </div>
        </div>

        <!-- ===== TITRE DE LA PAGE ===== -->
        <h1 class="page-title">Gestion des Thèmes</h1>
        
        <!-- Afficher la catégorie parente -->
        <?php if (!empty($category)): ?>
            <div class="category-info">
                <p>Catégorie : <strong>📁 <?= esc($category['nom']) ?></strong></p>
            </div>
        <?php endif; ?>

        <!-- ===== BARRE D'INFORMATIONS ===== -->
        <div class="toolbar">
            <p>
                Nombre total de thèmes : 
                <strong><?= !empty($themes) && is_array($themes) ? count($themes) : 0 ?></strong>
            </p>
        </div>

        <!-- ===== TABLEAU DES THÈMES ===== -->
        <div class="table-container">
            <div class="table-wrapper">
                <!-- Vérifier si des thèmes existent -->
                <?php if (!empty($themes) && is_array($themes)): ?>
                <table>
                    <!-- En-tête du tableau -->
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom du thème</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Icône</th>
                            <th>Difficulté</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    
                    <!-- Corps du tableau -->
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($themes as $theme): ?>
                        <tr>
                            <!-- Numéro de ligne -->
                            <td><strong><?= $i ?></strong></td>
                            
                            <!-- Nom du thème avec badge -->
                            <td>
                                <span class="theme-badge">
                                    <span class="theme-icon"><?= esc($theme['icon'] ?? '📚') ?></span>
                                    <?= esc($theme['name']) ?>
                                </span>
                            </td>
                            
                            <!-- Slug du thème -->
                            <td>
                                <span class="slug-badge">
                                    <?= esc($theme['slug'] ?? '-') ?>
                                </span>
                            </td>
                            
                            <!-- Description (limitée à 80 caractères) -->
                            <td>
                                <span class="description-text">
                                    <?php 
                                    $description = $theme['description'] ?? 'Aucune description';
                                    echo esc(strlen($description) > 80 ? substr($description, 0, 80) . '...' : $description);
                                    ?>
                                </span>
                            </td>
                            
                            <!-- Icône -->
                            <td>
                                <span class="icon-display">
                                    <?= esc($theme['icon'] ?? '📚') ?>
                                </span>
                            </td>
                            
                            <!-- Difficulté avec badge coloré -->
                            <td>
                                <?php 
                                $difficulty = strtolower($theme['difficulty'] ?? 'moyen');
                                $difficultyClass = 'difficulty-' . $difficulty;
                                ?>
                                <span class="difficulty-badge <?= $difficultyClass ?>">
                                    <?= ucfirst($difficulty) ?>
                                </span>
                            </td>
                            
                            <!-- Date de création -->
                            <td>
                                <span class="date-text">
                                    <?= date('d/m/Y', strtotime($theme['created_at'] ?? 'now')) ?>
                                </span>
                            </td>
                            
                            <!-- Boutons d'actions -->
                            <td>
                                <div class="action-buttons">
                                    
                                    
                                    <!-- Bouton voir les quiz -->
                                    <a href="<?= base_url('admin/theme/quiz/' . $theme['id']) ?>" 
                                       class="btn-action btn-view"
                                       title="Voir les quiz de ce thème">
                                        👁️ Voir Quiz
                                    </a>
                                    
                                    <!-- Bouton supprimer avec confirmation -->
                                    <a href="<?= base_url('admin/theme/delete/' . $theme['id']) ?>" 
                                       class="btn-action btn-delete"
                                       title="Supprimer ce thème"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce thème ? Cette action est irréversible.')">
                                        🗑️ Supprimer
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <!-- ===== ÉTAT VIDE (si aucun thème) ===== -->
                <?php else: ?>
                <div class="empty-state">
                    <div class="empty-state-icon">📚</div>
                    <h3>Aucun thème trouvé</h3>
                    <p>Commencez par créer votre premier thème pour cette catégorie.</p>
                    <a href="<?= base_url('admin/theme/create/' . ($category['id_categorie'] ?? '')) ?>" 
                       class="add-btn">
                        + Créer un thème
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>