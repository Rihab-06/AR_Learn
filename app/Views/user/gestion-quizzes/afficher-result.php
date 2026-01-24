<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AR_Learn - Résultats</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
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
            color: #EFECE3;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* ===== NAVBAR ===== */
        .navbar { 
            background: linear-gradient(to right, #16213e, #1a1a2e); 
            padding: 18px 50px; 
            display: flex; 
            align-items: center; 
            justify-content: space-between;
            border-bottom: 1px solid rgba(143, 171, 212, 0.15); 
        }
        
        .logo-section { 
            display: flex; 
            gap: 10px; 
            align-items: center; 
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
            font-size: 22px; 
            font-weight: 700; 
            color: #EFECE3; 
        }
        
        .user-name { 
            color: #8FABD4; 
        }
        
        /* ===== CONTENEUR PRINCIPAL - CENTRÉ ===== */
        .results-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
        }
        
        .results-container { 
            max-width: 700px; 
            width: 100%;
        }
        
        /* ===== CARTE DE RÉSULTATS ===== */
        .results-card { 
            text-align: center;
            padding: 40px 30px;
            background: rgba(26, 26, 46, 0.4);
            border-radius: 16px;
            border: 1px solid rgba(143, 171, 212, 0.2);
        }
        
        /* Icône emoji */
        .results-icon {
            font-size: 70px;
            margin-bottom: 15px;
        }
        
        /* Message principal */
        .results-message {
            font-size: 14px;
            font-weight: 600;
            color: #EFECE3;
            margin-bottom: 15px;
        }
        
        /* Titre du quiz */
        .quiz-title { 
            font-size: 18px; 
            font-weight: 700;
            color: #EFECE3;
            margin-bottom: 10px; 
        }
        
        /* Badge du thème */
        .theme-badge {
            display: inline-block;
            padding: 6px 14px;
            background: rgba(143, 171, 212, 0.2);
            color: #8FABD4;
            border-radius: 20px;
            font-size: 13px;
            margin-bottom: 30px;
        }
        
        /* ===== AFFICHAGE DU SCORE ===== */
        .score-display {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 25px;
            margin-top: 25px;
            flex-wrap: wrap;
        }
        
        /* Cercle du pourcentage */
        .score-circle {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4A70A9, #5c85c4);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        /* Pourcentage */
        .score-percentage {
            font-size: 48px;
            font-weight: 700;
            color: #EFECE3;
        }
        
        /* Label sous le pourcentage */
        .score-label {
            font-size: 13px;
            color: rgba(239, 236, 227, 0.9);
            margin-top: 5px;
        }
        
        /* Détails du score */
        .score-details {
            text-align: left;
        }
        
        /* Chaque ligne de détail */
        .score-item {
            padding: 12px 20px;
            background: rgba(26, 26, 46, 0.6);
            border: 1px solid rgba(143, 171, 212, 0.2);
            border-radius: 10px;
            margin-bottom: 10px;
        }
        
        /* Label du détail */
        .score-item-label {
            color: rgba(239, 236, 227, 0.7);
            font-size: 13px;
            margin-bottom: 4px;
        }
        
        /* Valeur du détail */
        .score-item-value {
            color: #EFECE3;
            font-size: 22px;
            font-weight: 600;
        }
        
        /* ===== BOUTON ===== */
        .actions-section {
            margin-top: 30px;
        }
        
        .btn {
            padding: 12px 28px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s;
            display: inline-block;
            background: rgba(26, 26, 46, 0.6);
            color: #8FABD4;
            border: 1px solid rgba(143, 171, 212, 0.3);
        }
        
        .btn:hover {
            background: rgba(26, 26, 46, 0.8);
            border-color: rgba(143, 171, 212, 0.5);
        }
        
        /* ===== COULEURS SELON LE SCORE ===== */
        
        /* Excellent: 80%+ (Vert) */
        .excellent .score-circle {
            background: linear-gradient(135deg, #2e7d32, #4caf50);
        }
        
        /* Bon: 60-79% (Bleu) */
        .good .score-circle {
            background: linear-gradient(135deg, #1976d2, #42a5f5);
        }
        
        /* Moyen: 40-59% (Orange) */
        .average .score-circle {
            background: linear-gradient(135deg, #f57c00, #ff9800);
        }
        
        /* Faible: 0-39% (Rouge) */
        .low .score-circle {
            background: linear-gradient(135deg, #c62828, #ef5350);
        }
    </style>
</head>
<body>
    <?php
    // Protection contre les variables non définies
    $percentage = $percentage ?? 0;
    $score = $score ?? 0;
    $total = $total ?? 0;
    $message = $message ?? '📚 Résultat';
    $quiz_title = $quiz_title ?? 'Quiz';
    $theme_name = $theme_name ?? 'Thème';
    $user = $user ?? ['prenom' => '', 'nom' => ''];
    ?>
    
    <!-- ===== BARRE DE NAVIGATION ===== -->
    <nav class="navbar">
        <div class="logo-section">
            <img src="<?= base_url('assets/images/logo-app.png') ?>" 
                 alt="AR_Learn Logo" 
                 class="logo-img">
            <span class="logo-text">AR_Learn</span>
        </div>
        <div class="user-section">
            <span class="user-name">
                👤 <?= esc($user['prenom'] . ' ' . $user['nom']) ?>
            </span>
        </div>
    </nav>

    <!-- ===== WRAPPER POUR CENTRER ===== -->
    <div class="results-wrapper">
        <div class="results-container">
            <!-- ===== CARTE DE RÉSULTATS ===== -->
            <!-- Classe dynamique selon le score -->
            <div class="results-card <?php 
                if ($percentage >= 80) echo 'excellent';
                elseif ($percentage >= 60) echo 'good';
                elseif ($percentage >= 40) echo 'average';
                else echo 'low';
            ?>">
                <!-- Icône emoji -->
                <div class="results-icon"><?= $message ?></div>
                
                <!-- Message -->
                <h3 class="results-message">Quiz Terminé !</h3>
                
                <!-- Titre du quiz -->
                <h2 class="quiz-title"><?= esc($quiz_title) ?></h2>
                
                <!-- Badge du thème -->
                <span class="theme-badge"><?= esc($theme_name) ?></span>
                
                <!-- ===== AFFICHAGE DU SCORE ===== -->
                <div class="score-display">
                    <!-- Cercle avec pourcentage -->
                    <div class="score-circle">
                        <div class="score-percentage"><?= $percentage ?>%</div>
                        <div class="score-label">Score global</div>
                    </div>
                    
                    <!-- Détails numériques -->
                    <div class="score-details">
                        <!-- Bonnes réponses -->
                        <div class="score-item">
                            <div class="score-item-label">Bonnes réponses</div>
                            <div class="score-item-value" style="color: #4caf50;">
                                <?= $score ?>
                            </div>
                        </div>
                        
                        <!-- Mauvaises réponses -->
                        <div class="score-item">
                            <div class="score-item-label">Mauvaises réponses</div>
                            <div class="score-item-value" style="color: #f44336;">
                                <?= $total - $score ?>
                            </div>
                        </div>
                        
                        <!-- Total de questions -->
                        <div class="score-item">
                            <div class="score-item-label">Questions totales</div>
                            <div class="score-item-value">
                                <?= $total ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- ===== BOUTON RETOUR ===== -->
                <div class="actions-section">
                    <a href="<?= base_url('dashboard') ?>" class="btn">
                        📊 Tableau de bord
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>