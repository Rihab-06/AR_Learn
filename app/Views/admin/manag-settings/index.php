<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs - AR_Learn</title>
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
            /* agrandit l'image */
            transform: scale(2.7);
            
            
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


        .header-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .back-btn, .logout-btn {
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

        .back-btn:hover, .logout-btn:hover {
            background: linear-gradient(to right, #6263b7ff, #0a0f47ff);
            transform: translateY(-1px);
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

        /* ========== SEARCH AND FILTER BAR ========== */
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
        }

      

        /* ========== USERS TABLE ========== */
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

        .btn-toggle {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .btn-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
        }

        /* ========== PAGINATION ========== */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 30px;
            padding: 20px;
        }

        .pagination a, .pagination span {
            padding: 10px 16px;
            background: rgba(26, 26, 46, 0.4);
            border: 1px solid rgba(143, 171, 212, 0.2);
            border-radius: 8px;
            color: #EFECE3;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
        }

        .pagination a:hover {
            background: rgba(74, 112, 169, 0.3);
            border-color: #4A70A9;
        }

        .pagination .active {
            background: linear-gradient(135deg, #4A70A9 0%, #8FABD4 100%);
            border-color: #4A70A9;
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
            }

            .page-title {
                font-size: 24px;
            }

            .toolbar {
                flex-direction: column;
            }

            .search-box {
                width: 100%;
            }

            .table-wrapper {
                overflow-x: scroll;
            }

            table {
                min-width: 800px;
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
            <!-- Logo et nom de l'application -->
            <div class="logo-section">
                <img src="<?= base_url('assets/images/logo-app.png') ?>" 
                 alt="AR_Learn Logo" 
                 class="logo-img">
            <span class="logo-text">AR_Learn</span>
            </div>
            <div class="header-actions">
                <a href="<?= base_url('/admin_dash') ?>" class="back-btn">← Retour au Dashboard</a>
                 <a href="<?= base_url('/admin/settings/admin/add') ?>" class="add-btn">+ Nouveau Admin</a>
            </div>
        </div>

        <!-- PAGE TITLE -->
        <h1 class="page-title">Gestion des Admins</h1>

        <!-- faire la barre de recherche et de filtre s'il reste du temps  -->
        <div class="toolbar"></div>

        <!-- USERS TABLE -->
        <div class="table-container">
            <div class="table-wrapper">
                <?php if (!empty($utilisateur) && is_array($utilisateur)): ?>
                <table id="usersTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom complet</th>
                            <th>Email</th>
                            <th>Date d'inscription</th>
                            <th>Derniere mise a jour </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        <?php foreach ($utilisateur as $user): ?>
                        <tr>

                            <td><?= $i ?></td>
                            <td><?= $user['nom'] ?> <?= $user['prenom'] ?></td>
                            <td><?= $user['email']?></td>
                            <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                            <td><?= date('d/m/Y', strtotime($user['updated_at'])) ?></td>

                            <td>
                                <div class="action-buttons">
                                    <a href="<?= base_url('/admin/settings/admin/edit/' . $user['id_utilisateur']) ?>" class="btn-action btn-edit">
                                        ✏️ Modifier
                                    </a>
                                    <a href="<?= base_url('/admin/settings/admin/delete/' . $user['id_utilisateur']) ?>" 
                                       class="btn-action btn-delete"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.')">
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

        <!-- PAGINATION (optionnel) -->
        <?php if (isset($pager)): ?>
        <div class="pagination">
            <?= $pager->links() ?>
        </div>
        <?php endif; ?>
    </div>

</body>
</html>