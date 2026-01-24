<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AR_Learn - Quiz</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
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
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 280px;
            background: rgba(26, 26, 46, 0.8);
            border-right: 1px solid rgba(143, 171, 212, 0.2);
            padding: 30px 20px;
        }

        .theme-info {
            margin-bottom: 30px;
        }

        .theme-icon {
            font-size: 48px;
            text-align: center;
            margin-bottom: 15px;
        }

        .theme-name {
            font-size: 20px;
            font-weight: 700;
            color: #EFECE3;
            text-align: center;
            margin-bottom: 10px;
        }

        .theme-category {
            font-size: 13px;
            color: #8FABD4;
            text-align: center;
            margin-bottom: 20px;
        }

        .theme-description {
            font-size: 14px;
            color: rgba(239, 236, 227, 0.7);
            line-height: 1.6;
            padding: 15px;
            background: rgba(10, 10, 10, 0.3);
            border-radius: 8px;
        }

        .divider {
            height: 1px;
            background: rgba(143, 171, 212, 0.2);
            margin: 25px 0;
        }

        .stats {
            margin-top: 20px;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            background: rgba(10, 10, 10, 0.3);
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 13px;
            color: rgba(239, 236, 227, 0.7);
        }

        .stat-value {
            font-size: 16px;
            font-weight: 600;
            color: #8FABD4;
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            padding: 40px 50px;
            overflow-y: auto;
        }

        .header {
            margin-bottom: 40px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #8FABD4;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .back-link:hover {
            color: #EFECE3;
            transform: translateX(-5px);
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-title {
            font-size: 36px;
            font-weight: 700;
            color: #EFECE3;
        }

        .btn-add {
            padding: 12px 24px;
            background: linear-gradient(to right, #4A70A9, #5c85c4);
            color: #EFECE3;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74, 112, 169, 0.4);
        }

        .page-subtitle {
            font-size: 16px;
            color: rgba(239, 236, 227, 0.6);
        }

        /* QUIZ GRID */
        .quiz-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .quiz-card {
            background: rgba(26, 26, 46, 0.5);
            border: 1px solid rgba(143, 171, 212, 0.2);
            border-radius: 12px;
            padding: 25px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .quiz-card:hover {
            transform: translateY(-5px);
            border-color: #8FABD4;
            box-shadow: 0 10px 30px rgba(74, 112, 169, 0.3);
        }

        .quiz-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }

        .quiz-title {
            font-size: 18px;
            font-weight: 600;
            color: #EFECE3;
            margin-bottom: 8px;
        }

        .quiz-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-published {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .status-draft {
            background: rgba(251, 146, 60, 0.2);
            color: #fb923c;
            border: 1px solid rgba(251, 146, 60, 0.3);
        }

        .quiz-description {
            font-size: 14px;
            color: rgba(239, 236, 227, 0.7);
            line-height: 1.6;
            margin-bottom: 20px;
            min-height: 60px;
        }

        .quiz-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid rgba(143, 171, 212, 0.1);
        }

        .quiz-meta {
            font-size: 12px;
            color: rgba(239, 236, 227, 0.5);
        }

        .quiz-actions {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-view {
            background: rgba(143, 171, 212, 0.15);
            color: #8FABD4;
            border: 1px solid rgba(143, 171, 212, 0.3);
        }

        .btn-view:hover {
            background: rgba(143, 171, 212, 0.25);
        }

        .btn-edit {
            background: rgba(251, 146, 60, 0.15);
            color: #fb923c;
            border: 1px solid rgba(251, 146, 60, 0.3);
        }

        .btn-edit:hover {
            background: rgba(251, 146, 60, 0.25);
        }

        /* NO CONTENT */
        .no-content {
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

        /* RESPONSIVE */
        @media (max-width: 968px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid rgba(143, 171, 212, 0.2);
            }

            .main-content {
                padding: 30px 20px;
            }

            .header-top {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .quiz-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="theme-info">
                <div class="theme-icon"><?= esc($theme['icon'] ?? '📚') ?></div>
                <h2 class="theme-name"><?= esc($theme['name'] ?? 'Thème') ?></h2>
                <p class="theme-category">📂 <?= esc($categorie['nom'] ?? 'Catégorie') ?></p>
                <p class="theme-description">
                    <?= esc($theme['description'] ?? 'Description du thème') ?>
                </p>
            </div>

            <div class="divider"></div>

            <div class="stats">
                <div class="stat-item">
                    <span class="stat-label">Difficulté</span>
                    <span class="stat-value"><?= ucfirst(esc($theme['difficulty'] ?? 'Moyen')) ?></span>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <div class="header">
               
                
                <div class="header-top">
                    <div>
                        <h1 class="page-title">Quiz - <?= esc($theme['name']) ?></h1>
                        <p class="page-subtitle">Liste des quiz disponibles pour ce thème</p>
                    </div>
                    <a href="<?= base_url('user/quiz/creation/' . $theme['id']) ?>" class="btn-add">
                        + Créer un quiz
                    </a>
                </div>
            </div>

            <!-- LISTE DES QUIZ -->
            <?php if (!empty($quizzes)): ?>
                <div class="quiz-grid">
                    <?php foreach ($quizzes as $quiz): ?>
                        <div class="quiz-card">
                            <div class="quiz-header">
                                <div>
                                    <h3 class="quiz-title"><?= esc($quiz['title']) ?></h3>
                                </div>
                                <span class="quiz-status <?= $quiz['is_published'] ? 'status-published' : 'status-draft' ?>">
                                    <?= $quiz['is_published'] ? '✓ Publié' : '📝 Brouillon' ?>
                                </span>
                            </div>

                            <p class="quiz-description">
                                <?= !empty($quiz['description']) 
                                    ? esc($quiz['description']) 
                                    : 'Aucune description disponible' ?>
                            </p>

                            <div class="quiz-footer">
                                <span class="quiz-meta">
                                    Créé le <?= date('d/m/Y', strtotime($quiz['created_at'])) ?>
                                </span>
                                <div class="quiz-actions">
                                    <a href="<?= base_url('user/quiz/view/' . $quiz['id']) ?>" class="btn-action btn-view">
                                         Passer
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-content">
                    <div class="no-content-icon">📝</div>
                    <p class="no-content-text">
                        Aucun quiz disponible pour ce thème.<br>
                        Cliquez sur "Créer un quiz" pour commencer !
                    </p>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>