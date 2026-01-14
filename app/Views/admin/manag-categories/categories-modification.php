<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Catégorie - AR_Learn</title>
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
            max-width: 900px;
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
            display: inline-block;
        }

        .back-btn:hover {
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

        /* ========== INFO BOX ========== */
        .info-box {
            background: rgba(74, 112, 169, 0.1);
            border: 1px solid rgba(143, 171, 212, 0.3);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .info-box-icon {
            font-size: 24px;
        }

        .info-box-text {
            font-size: 14px;
            color: #8FABD4;
        }

        /* ========== FORM CONTAINER ========== */
        .form-container {
            background: rgba(26, 26, 46, 0.4);
            border-radius: 12px;
            border: 1px solid rgba(143, 171, 212, 0.2);
            padding: 40px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========== FORM STYLES ========== */
        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #8FABD4;
        }

        .required {
            color: #ef4444;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 12px 15px;
            background: rgba(22, 33, 62, 0.6);
            border: 1px solid rgba(143, 171, 212, 0.2);
            border-radius: 8px;
            color: #EFECE3;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #4A70A9;
            background: rgba(22, 33, 62, 0.8);
            box-shadow: 0 0 0 3px rgba(74, 112, 169, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        select {
            cursor: pointer;
        }

        select option {
            background: #16213e;
            color: #EFECE3;
        }

        .help-text {
            font-size: 12px;
            color: rgba(143, 171, 212, 0.6);
            margin-top: 5px;
        }

        /* ========== ALERT MESSAGES ========== */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #6ee7b7;
        }

        /* ========== FORM ACTIONS ========== */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 35px;
            justify-content: space-between;
        }

        .form-actions-left {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(to right, #4A70A9, #8FABD4);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #8FABD4, #4A70A9);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 112, 169, 0.4);
        }

        .btn-secondary {
            background: rgba(74, 112, 169, 0.2);
            color: #8FABD4;
            border: 1px solid rgba(143, 171, 212, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(74, 112, 169, 0.3);
            border-color: #4A70A9;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        /* ========== METADATA ========== */
        .metadata {
            background: rgba(22, 33, 62, 0.4);
            border-radius: 8px;
            padding: 15px;
            margin-top: 25px;
            font-size: 13px;
            color: rgba(143, 171, 212, 0.7);
        }

        .metadata-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid rgba(143, 171, 212, 0.1);
        }

        .metadata-item:last-child {
            border-bottom: none;
        }

        .metadata-label {
            font-weight: 500;
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

        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .header {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
            }

            .form-container {
                padding: 25px;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions-left {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .page-title {
                font-size: 24px;
            }

            .metadata-item {
                flex-direction: column;
                gap: 5px;
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
            <a href="<?= base_url('/admin/categories') ?>" class="back-btn">← Retour à la liste</a>
        </div>

        <!-- PAGE TITLE -->
        <h1 class="page-title">Modifier la Catégorie</h1>

        <!-- INFO BOX -->
        <div class="info-box">
            <span class="info-box-icon">ℹ️</span>
            <span class="info-box-text">
                Vous modifiez la catégorie : <strong><?= esc($category['nom']) ?></strong>
            </span>
        </div>

        <!-- FORM -->
        <div class="form-container">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error">
                    ⚠️ <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    ✓ <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-error">
                    <strong>Erreurs de validation :</strong>
                    <ul style="margin-top: 10px; margin-left: 20px;">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('/admin/categories/update/' . $category['id_categorie']) ?>" method="POST">
                <?= csrf_field() ?>

                <!-- Nom de la catégorie -->
                <div class="form-group">
                    <label for="nom">
                        Nom de la Catégorie <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nom" 
                        name="nom" 
                        placeholder="Ex: Mathématiques, Sciences, Histoire..."
                        value="<?= old('nom', $category['nom']) ?>"
                        required
                    >
                    <div class="help-text">Entrez un nom court et descriptif</div>
                </div>

                <!-- Explication -->
                <div class="form-group">
                    <label for="explication">
                        Explication / Description
                    </label>
                    <textarea 
                        id="explication" 
                        name="explication" 
                        placeholder="Décrivez brièvement cette catégorie..."
                    ><?= old('explication', $category['explication'] ?? '') ?></textarea>
                    <div class="help-text">Description optionnelle de la catégorie</div>
                </div>
                <!-- Actions -->

                 <div class="form-actions">
                    <a href="<?= base_url('/admin/categories') ?>" class="btn btn-secondary">
                        Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        ✓ Modifier la Catégorie
                    </button>
                </div>                       


            </form>
        </div>
    </div>

</body>
</html>