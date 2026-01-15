<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur - AR_Learn</title>
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
            max-width: 800px;
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

        /* ========== FORM CONTAINER ========== */
        .form-container {
            background: rgba(26, 26, 46, 0.4);
            border-radius: 12px;
            border: 1px solid rgba(143, 171, 212, 0.2);
            padding: 40px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-out;
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
            letter-spacing: 0.5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"] {
            width: 100%;
            padding: 12px 15px;
            background: rgba(22, 33, 62, 0.3);
            border: 1px solid rgba(143, 171, 212, 0.2);
            border-radius: 8px;
            color: #EFECE3;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="date"]:focus {
            outline: none;
            border-color: #4A70A9;
            background: rgba(22, 33, 62, 0.5);
            box-shadow: 0 0 0 3px rgba(74, 112, 169, 0.1);
        }

        input::placeholder {
            color: rgba(239, 236, 227, 0.4);
        }

        /* ========== PASSWORD INFO ========== */
        .password-info {
            font-size: 12px;
            color: rgba(239, 236, 227, 0.6);
            margin-top: 6px;
            font-style: italic;
        }

        /* ========== FORM ACTIONS ========== */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 35px;
            justify-content: flex-end;
        }

        .btn-submit,
        .btn-cancel {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-submit {
            background: linear-gradient(135deg, #4A70A9 0%, #8FABD4 100%);
            color: white;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74, 112, 169, 0.4);
        }

        .btn-cancel {
            background: rgba(143, 171, 212, 0.1);
            color: #8FABD4;
            border: 1px solid rgba(143, 171, 212, 0.3);
        }

        .btn-cancel:hover {
            background: rgba(143, 171, 212, 0.2);
            border-color: #8FABD4;
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

            .form-container {
                padding: 25px;
            }

            .page-title {
                font-size: 24px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
                text-align: center;
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
            <a href="<?= base_url('/admin/setting') ?>" class="back-btn">← Retour</a>
        </div>

        <!-- PAGE TITLE -->
        <h1 class="page-title">Modifier l'Administrateur</h1>

        <!-- EDIT FORM -->
        <div class="form-container">
            <form action="<?= base_url('/admin/settings/admin/update/' . $admin['id_utilisateur']) ?>" method="POST">
                <!-- Hidden ID field -->
                <input type="hidden" name="id_utilisateur" value="<?= $admin['id_utilisateur'] ?>">

                <!-- Nom -->
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" 
                           id="nom" 
                           name="nom" 
                           value="<?= $admin['nom'] ?>" 
                           placeholder="Entrez le nom"
                           required>
                </div>

                <!-- Prénom -->
                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" 
                           id="prenom" 
                           name="prenom" 
                           value="<?= $admin['prenom'] ?>" 
                           placeholder="Entrez le prénom"
                           required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="<?= $admin['email'] ?>" 
                           placeholder="exemple@email.com"
                           required>
                </div>

                <!-- Date de naissance -->
                <div class="form-group">
                    <label for="date_naissance">Date de naissance</label>
                    <input type="date" 
                           id="date_naissance" 
                           name="date_naissance" 
                           value="<?= $admin['date_naissance'] ?>" required>
                </div>

                <!-- Mot de passe -->
                <div class="form-group">
                    <label for="password">Nouveau mot de passe</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           placeholder="Laisser vide pour ne pas changer">
                    <div class="password-info">
                        * Laissez vide si vous ne souhaitez pas modifier le mot de passe
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="<?= base_url('/admin/setting')?>" class="btn-cancel">Annuler</a>
                    <button type="submit" class="btn-submit">💾 Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>