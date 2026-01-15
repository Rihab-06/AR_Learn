<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creer Un Admin - AR_Learn</title>
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

        

        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 19px;
            color: #666;
            transition: color 0.3s;
            user-select: none;
        }

        .password-toggle:hover {
            color: #4A70A9;
        }

        /* Message d'erreur pour chaque champ */
        .field-error {
            color: #ef4444;
            font-size: 13px;
            margin-top: 6px;
            display: none;
        }

        .field-error.show {
            display: block;
            animation: slideIn 0.3s ease;
        }
        
        /* Alerts */
        .alert {
            padding: 13px 17px;
            border-radius: 9px;
            margin-bottom: 22px;
            font-size: 14px;
            border-left: 3px solid;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border-color: #10b981;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border-color: #ef4444;
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }

        .alert li {
            margin: 5px 0;
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
            <a href="<?= base_url('/admin/users') ?>" class="back-btn">← Retour</a>
        </div>

        <!-- PAGE TITLE -->
        <h1 class="page-title">Creer Un Admin</h1>

        <!-- Alerts PHP -->
                <?php if (session()->has('errors')): ?>
                    <div class="alert alert-error">
                        <strong>✕ Erreurs de validation:</strong>
                        <ul>
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-error">
                        ✕ <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('status')): ?>
                    <div class="alert alert-success">
                        ✓ <?= session()->getFlashdata('status') ?>
                    </div>
                <?php endif; ?>

        <!-- EDIT FORM -->
        <div class="form-container">
            <form action="<?= base_url('/admin/settings/admin/store') ?>" method="POST">
               
                        <div class="form-group">
                            <label for="nom" class="form-label">Nom</label>
                            <input 
                                type="text" 
                                id="nom" 
                                name="nom" 
                                class="form-input <?= (session('errors.nom')) ? 'error' : '' ?>"
                                placeholder="Entrez votre nom"
                                value="<?= old('nom') ?>"
                                required
                            >
                            <!-- Message d'erreur spécifique au champ NOM -->
                            <?php if(session('errors.nom')): ?>
                                <div class="field-error show"><?= session('errors.nom') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- 
                            ========================================
                            CHAMP 2 : PRÉNOM
                            ========================================
                            Validation : identique au champ NOM
                        -->
                        <div class="form-group">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input 
                                type="text" 
                                id="prenom" 
                                name="prenom" 
                                class="form-input <?= (session('errors.prenom')) ? 'error' : '' ?>"
                                placeholder="Entrez votre prénom"
                                value="<?= old('prenom') ?>"
                                required
                            >
                            <!-- Message d'erreur spécifique au champ PRÉNOM -->
                            <?php if(session('errors.prenom')): ?>
                                <div class="field-error show"><?= session('errors.prenom') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- 
                            ========================================
                            CHAMP 3 : EMAIL
                            ========================================
                            Validation côté serveur :
                            - required : obligatoire
                            - valid_email : format email valide (ex: user@example.com)
                            - is_unique[utilisateurs.email] : IMPORTANT - vérifie que l'email n'existe pas déjà dans la table 'utilisateurs'
                            
                            Message personnalisé :
                            Si l'email existe déjà → "Cet email est déjà utilisé. Veuillez en choisir un autre."
                        -->
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-input <?= (session('errors.email')) ? 'error' : '' ?>"
                                placeholder="votre.email@exemple.com"
                                value="<?= old('email') ?>"
                                required
                            >
                            <!-- Message d'erreur spécifique au champ EMAIL -->
                            <?php if(session('errors.email')): ?>
                                <div class="field-error show"><?= session('errors.email') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- 
                            ========================================
                            CHAMP 4 : DATE DE NAISSANCE
                            ========================================
                            Validation côté serveur :
                            - required : obligatoire
                            - valid_date : vérifie que la date est au format valide
                        -->
                        <div class="form-group">
                            <label for="date_naissance" class="form-label">Date de naissance</label>
                            <input 
                                type="date" 
                                id="date_naissance" 
                                name="date_naissance" 
                                class="form-input <?= (session('errors.date_naissance')) ? 'error' : '' ?>"
                                value="<?= old('date_naissance') ?>"
                                required
                            >
                            <!-- Message d'erreur spécifique au champ DATE DE NAISSANCE -->
                            <?php if(session('errors.date_naissance')): ?>
                                <div class="field-error show"><?= session('errors.date_naissance') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- 
                            ========================================
                            CHAMP 5 : MOT DE PASSE
                            ========================================
                            Validation côté serveur :
                            - required : obligatoire
                            - min_length[8] : IMPORTANT - au moins 8 caractères
                            
                            Message personnalisé :
                            "Le mot de passe doit contenir au moins 8 caractères"
                            
                            Fonctionnalité supplémentaire :
                            - Icône œil (👁️) pour afficher/masquer le mot de passe
                        -->
                        <div class="form-group">
                            <label for="password" class="form-label">Mot de passe</label>
                            <div class="password-wrapper">
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="form-input <?= (session('errors.password')) ? 'error' : '' ?>"
                                    placeholder="Créez un mot de passe fort (min. 8 caractères)"
                                    required
                                >
                                <!-- Icône pour afficher/masquer le mot de passe -->
                                <span class="password-toggle" onclick="togglePassword('password', this)">👁️</span>
                            </div>
                            <!-- Message d'erreur spécifique au champ MOT DE PASSE -->
                            <?php if(session('errors.password')): ?>
                                <div class="field-error show"><?= session('errors.password') ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- 
                            ========================================
                            CHAMP 6 : CONFIRMATION DU MOT DE PASSE
                            ========================================
                            Validation côté serveur :
                            - required : obligatoire
                            - matches[password] : IMPORTANT - doit être identique au champ 'password'
                            
                            Message personnalisé :
                            "Les mots de passe ne correspondent pas"
                        -->
                        <div class="form-group">
                            <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                            <div class="password-wrapper">
                                <input 
                                    type="password" 
                                    id="confirm_password" 
                                    name="confirm_password" 
                                    class="form-input <?= (session('errors.confirm_password')) ? 'error' : '' ?>"
                                    placeholder="Confirmez votre mot de passe"
                                    required
                                >
                                <!-- Icône pour afficher/masquer la confirmation du mot de passe -->
                                <span class="password-toggle" onclick="togglePassword('confirm_password', this)">👁️</span>
                            </div>
                            <!-- Message d'erreur spécifique au champ CONFIRMATION MOT DE PASSE -->
                            <?php if(session('errors.confirm_password')): ?>
                                <div class="field-error show"><?= session('errors.confirm_password') ?></div>
                            <?php endif; ?>
                        </div>
                        <!-- Champ pour définir le rôle en tant qu'admin -->
                         <div class="form-group">
                            <label for="role" class="form-label">Role</label>
                            <input 
                                type="text" 
                                id="role" 
                                name="role" 
                                class="form-input <?= (session('errors.role')) ? 'error' : '' ?>"
                                value="admin"
                                readonly
                            >
                                </div>
                        </div>


                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="<?= base_url('admin/settings')?>" class="btn-cancel">Annuler</a>
                    <button type="submit" class="btn-submit">💾 Enregistrer le Nouveau Admin</button>
                </div>
            </form>
        </div>
    </div>

    <script>
/*
       SCRIPT SIMPLIFIÉ POUR LE FORMULAIRE D'INSCRIPTION
       Fonctionnalités :
       1. Afficher/masquer le mot de passe (icône œil)
       2. Auto-suppression des alertes après 5 secondes
       Note : La validation du formulaire est faite côté SERVEUR (PHP/CodeIgniter)
       FONCTION 1 : AFFICHER/MASQUER LE MOT DE PASSE
*/
    
    function togglePassword(inputId, icon) {
        // Récupérer le champ input par son ID
        const passwordInput = document.getElementById(inputId);
        
        // Déterminer le nouveau type (si c'est 'password', on passe à 'text', et vice-versa)
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        
        // Appliquer le nouveau type au champ
        passwordInput.type = type;
        
        // Changer l'icône selon l'état
        icon.textContent = type === 'password' ? '👁️' : '🙈';
    }

/*
    FONCTION 2 : AUTO-SUPPRESSION DES ALERTES
     * Supprime automatiquement les messages d'alerte (succès/erreur) après 5 secondes
     * Les alertes concernées :
     * - Messages d'erreur de validation PHP
     * - Messages de succès
     * - Messages d'erreur généraux
     * Animation : Fade out + Translation vers le haut avant suppression
*/
    
    // Sélectionner toutes les alertes présentes dans la page
    document.querySelectorAll('.alert').forEach(alert => {
        
        // Attendre 5 secondes (5000 millisecondes)
        setTimeout(() => {
            // Animer la disparition de l'alerte
            alert.style.opacity = '0'; // Rendre transparent
            alert.style.transform = 'translateY(-10px)'; // Déplacer vers le haut
            
            // Attendre la fin de l'animation (300ms) avant de supprimer l'élément du DOM
            setTimeout(() => alert.remove(), 300);
            
        }, 5000); // 5000ms = 5 secondes
    });

    
     
</script>
</body>
</html>