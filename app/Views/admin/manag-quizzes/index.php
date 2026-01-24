<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Quizzes - AR_Learn</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
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

        /* ========== HEADER ========== */
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

        .header-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .back-btn, .add-btn {
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
            display: inline-block;
        }

        .back-btn:hover, .add-btn:hover {
            background: linear-gradient(to right, #6263b7ff, #0a0f47ff);
            transform: translateY(-1px);
        }

        .add-btn {
            background: linear-gradient(to right, #10b981, #059669);
        }

        .add-btn:hover {
            background: linear-gradient(to right, #059669, #10b981);
        }

        /* ========== PAGE TITLE ========== */
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            color: #EFECE3;
            margin-bottom: 35px;
            text-align: center;
        }

        /* ========== TOOLBAR ========== */
        .toolbar {
            background: rgba(26, 26, 46, 0.4);
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 30px;
            border: 1px solid rgba(143, 171, 212, 0.2);
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
        }

        .theme-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .theme-badge {
            display: inline-block;
            padding: 8px 16px;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            color: white;
        }

        /* ========== QUIZZES TABLE ========== */
        .table-container {
            background: rgba(26, 26, 46, 0.4);
            border-radius: 12px;
            border: 1px solid rgba(143, 171, 212, 0.2);
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: rgba(22, 33, 62, 0.6);
        }

        th {
            padding: 18px 15px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: #8FABD4;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(143, 171, 212, 0.2);
        }

        td {
            padding: 18px 15px;
            border-bottom: 1px solid rgba(143, 171, 212, 0.1);
            color: #EFECE3;
            font-size: 14px;
        }

        tbody tr {
            transition: all 0.3s;
        }

        tbody tr:hover {
            background: rgba(74, 112, 169, 0.1);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* ========== QUIZ BADGE ========== */
        .quiz-badge {
            display: inline-block;
            padding: 6px 12px;
            background: linear-gradient(135deg, #4A70A9 0%, #8FABD4 100%);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            color: white;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-published {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            border: 1px solid #10b981;
        }

        .status-draft {
            background: rgba(251, 146, 60, 0.2);
            color: #fb923c;
            border: 1px solid #fb923c;
        }

        /* ========== ACTION BUTTONS ========== */
        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            padding: 8px 12px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-edit {
            background: linear-gradient(135deg, #4A70A9 0%, #8FABD4 100%);
            color: white;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 112, 169, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        .btn-view {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
        }

        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4);
        }

        /* ========== EMPTY STATE ========== */
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

        /* ========== GLOW EFFECT ========== */
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

        /* ========== ANIMATIONS ========== */
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

        /* ========== RESPONSIVE ========== */
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

            .header-actions {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }

            .page-title {
                font-size: 24px;
            }

            .toolbar {
                flex-direction: column;
            }

            .table-wrapper {
                overflow-x: scroll;
            }

            table {
                min-width: 900px;
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
        <!-- HEADER -->
        <div class="header">
            <div class="logo-section">
                <img src="<?= base_url('assets/images/logo-app.png') ?>" 
                     alt="AR_Learn Logo" 
                     class="logo-img">
                <span class="logo-text">AR_Learn</span>
            </div>
        </div>

        <!-- PAGE TITLE -->
        <h1 class="page-title">Gestion des Quizzes</h1>

        <!-- TOOLBAR -->
        <div class="toolbar">
            <div class="theme-info">
                <p style="color: #8FABD4;">Thème :</p>
                <span class="theme-badge">📚 <?= esc($themes['name']) ?></span>
            </div>
            <p style="color: #8FABD4;">Nombre total de quizzes : <strong><?= isset($quizzes) ? count($quizzes) : 0 ?></strong></p>
        </div>

        <!-- QUIZZES TABLE -->
        <div class="table-container">
            <div class="table-wrapper">
                <?php if (!empty($quizzes) && is_array($quizzes)): ?>
                <table id="quizzesTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Titre du Quiz</th>
                            <th>Description</th>
                            <th>Date de Création</th>
                            <th>Dernière Mise à Jour</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($quizzes as $quiz): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <span class="quiz-badge">
                                    📝 <?= esc($quiz['title']) ?>
                                </span>
                            </td>
                            <td><?= esc(substr($quiz['description'] ?? 'Aucune description', 0, 100)) ?><?= strlen($quiz['description'] ?? '') > 100 ? '...' : '' ?></td>
                            
                            <td><?= $quiz['created_at'] ? date('d/m/Y ', strtotime($quiz['created_at'])) : 'N/A' ?></td>
                            <td><?= $quiz['updated_at'] ? date('d/m/Y ', strtotime($quiz['updated_at'])) : 'N/A' ?></td>
                            <td>
                                <div class="action-buttons">
                                   
                                    <a href="<?= base_url('/admin/quizzes/delete/' . $quiz['id']) ?>" 
                                       class="btn-action btn-delete"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce quiz ? Cette action supprimera également toutes les questions associées.')">
                                        🗑️ Supprimer
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>

    </div>

</body>
</html>