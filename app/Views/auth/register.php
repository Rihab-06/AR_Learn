<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - AR_Learn</title>
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
        }

        .auth-container {
            display: flex;
            min-height: 100vh;
        }

        /* ========== LEFT SIDE ========== */
        .left-side {
            flex: 1;
            background: linear-gradient(to bottom right, #16213e 0%, #1a1a2e 50%, #0f3460 100%);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 70px 50px;
            min-height: 100vh;
        }

        /* Animated Background */
        .bg-animation {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
        }

        .wave {
            position: absolute;
            width: 200%;
            height: 200%;
            border-radius: 40%;
            opacity: 0.12;
        }

        .wave-1 {
            background: linear-gradient(to bottom right, #4A70A9, #6a92d0);
            animation: wave 18s linear infinite;
            bottom: -50%;
            left: -50%;
        }

        .wave-2 {
            background: linear-gradient(to top left, #5c85c4, #4A70A9);
            animation: wave 23s linear infinite reverse;
            bottom: -40%;
            left: -60%;
        }

        .wave-3 {
            background: radial-gradient(circle, #4A70A9 0%, transparent 65%);
            animation: wave 28s ease-in-out infinite;
            top: -50%;
            right: -50%;
        }

        @keyframes wave {
            0% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(180deg) scale(1.08); }
            100% { transform: rotate(360deg) scale(1); }
        }

        /* Floating Particles */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: rgba(239, 236, 227, 0.35);
            border-radius: 50%;
            animation: float 14s infinite;
        }

        .particle:nth-child(1) { left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { left: 20%; animation-delay: 2s; }
        .particle:nth-child(3) { left: 30%; animation-delay: 4s; }
        .particle:nth-child(4) { left: 40%; animation-delay: 1s; }
        .particle:nth-child(5) { left: 50%; animation-delay: 3s; }
        .particle:nth-child(6) { left: 60%; animation-delay: 5s; }
        .particle:nth-child(7) { left: 70%; animation-delay: 2.5s; }
        .particle:nth-child(8) { left: 80%; animation-delay: 4.5s; }

        @keyframes float {
            0%, 100% { 
                transform: translateY(100vh) translateX(0); 
                opacity: 0;
            }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { 
                transform: translateY(-100px) translateX(50px); 
                opacity: 0;
            }
        }

        /* Content */
        .left-content {
            position: relative;
            z-index: 10;
            text-align: left;
            max-width: 580px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 55px;
        }

        .logo-icon {
            font-size: 42px;
        }

        .logo-text {
            font-size: 28px;
            font-weight: 700;
            color: #EFECE3;
            letter-spacing: 1.5px;
        }

        .tagline {
            font-size: 13px;
            color: #8FABD4;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            margin-bottom: 28px;
            font-weight: 500;
        }

        .main-heading {
            font-family: 'Playfair Display', serif;
            font-size: 64px;
            font-weight: 700;
            line-height: 1.1;
            color: #EFECE3;
            margin-bottom: 38px;
        }

        .main-heading span {
            background: linear-gradient(120deg, #8FABD4, #4A70A9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .quote-box {
            position: relative;
            padding-left: 28px;
            border-left: 3px solid #4A70A9;
            margin-bottom: 28px;
        }

        .quote-text {
            font-size: 20px;
            line-height: 1.5;
            color: #EFECE3;
            font-style: italic;
            margin-bottom: 14px;
            font-weight: 300;
        }

        .quote-author {
            font-size: 15px;
            color: #8FABD4;
            font-weight: 500;
        }

        .features {
            display: flex;
            gap: 35px;
            margin-top: 45px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .feature-icon {
            font-size: 22px;
            color: #4A70A9;
        }

        .feature-text {
            font-size: 14px;
            color: #EFECE3;
            font-weight: 500;
        }

        /* ========== RIGHT SIDE ========== */
        .right-side {
            flex: 1;
            background: #0a0a0a;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            position: relative;
            min-height: 100vh;
        }

        .right-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 1px;
            height: 100%;
            background: linear-gradient(180deg, transparent, #4A70A9, transparent);
        }

        .form-wrapper {
            width: 100%;
            max-width: 460px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 45px;
        }

        .form-logo {
            font-size: 19px;
            color: #EFECE3;
            font-weight: 600;
            margin-bottom: 28px;
            letter-spacing: 1px;
        }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 44px;
            color: #EFECE3;
            margin-bottom: 10px;
        }

        .form-subtitle {
            color: #666;
            font-size: 14px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            display: block;
            margin-bottom: 9px;
            color: #EFECE3;
            font-weight: 500;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 15px 18px;
            background: rgba(26, 26, 46, 0.5);
            border: 1px solid rgba(143, 171, 212, 0.25);
            border-radius: 10px;
            font-size: 15px;
            color: #EFECE3;
            transition: all 0.3s ease;
        }

        /* Style pour les champs avec erreur */
        .form-input.error {
            border-color: #ef4444;
            background: rgba(239, 68, 68, 0.05);
        }

        .form-input:focus {
            outline: none;
            border-color: #4A70A9;
            background: rgba(26, 26, 46, 0.7);
            box-shadow: 0 0 0 3px rgba(74, 112, 169, 0.12);
        }

        .form-input::placeholder {
            color: #666;
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

        /* Button */
        .btn-primary {
            width: 100%;
            padding: 16px;
            background: linear-gradient(to right, #4A70A9, #5c85c4);
            color: #EFECE3;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(74, 112, 169, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 30px rgba(74, 112, 169, 0.35);
            background: linear-gradient(to right, #5c85c4, #6a92d0);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Switch Form */
        .form-switch {
            text-align: center;
            margin-top: 28px;
            color: #666;
            font-size: 14px;
        }

        .form-switch a {
            color: #4A70A9;
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
            transition: color 0.3s;
        }

        .form-switch a:hover {
            color: #8FABD4;
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

        /* Responsive */
        @media (max-width: 1024px) {
            .auth-container {
                flex-direction: column;
                height: auto;
            }

            .left-side {
                min-height: 60vh;
                padding: 40px 30px;
                height: auto;
            }

            .main-heading {
                font-size: 46px;
            }

            .features {
                flex-direction: column;
                gap: 20px;
            }

            .right-side {
                padding: 40px 30px;
                height: auto;
                min-height: auto;
            }
            
            .form-wrapper {
                width: 100%;
                max-width: 500px;
            }
        }

        @media (max-width: 640px) {
            .left-side {
                padding: 30px 20px;
                min-height: 50vh;
            }
            
            .right-side {
                padding: 30px 20px;
            }
            
            .main-heading {
                font-size: 34px;
            }

            .quote-text {
                font-size: 17px;
            }

            .form-title {
                font-size: 34px;
            }
            
            .logo-section {
                margin-bottom: 30px;
            }
            
            .tagline {
                margin-bottom: 20px;
            }
            
            .features {
                margin-top: 30px;
            }
        }
        
        @media (min-width: 1600px) {
            .left-content {
                max-width: 700px;
            }
            
            .form-wrapper {
                max-width: 550px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- LEFT SIDE - ARTISTIC -->
        <div class="left-side">
            <!-- Animated Background -->
            <div class="bg-animation">
                <div class="wave wave-1"></div>
                <div class="wave wave-2"></div>
                <div class="wave wave-3"></div>
            </div>

            <!-- Floating Particles -->
            <div class="particles">
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
            </div>

            <!-- Content -->
            <div class="left-content">
                <div class="logo-section">
                    <span class="logo-icon">📚</span>
                    <span class="logo-text">AR_Learn</span>
                </div>

                <div class="tagline">COMMENCEZ VOTRE VOYAGE</div>

                <h1 class="main-heading">
                    Écrivez Votre<br>
                    Histoire de <span>Succès</span>
                </h1>

                <div class="quote-box">
                    <p class="quote-text">
                        "L'éducation n'est pas la préparation à la vie ; l'éducation est la vie elle-même."
                    </p>
                    <p class="quote-author">— John Dewey</p>
                </div>

                <div class="features">
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span class="feature-text">Gratuit pour toujours</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span class="feature-text">Installation facile</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span class="feature-text">Accès instantané</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE - REGISTER FORM -->
        <div class="right-side">
            <div class="form-wrapper">
                <div class="form-header">
                    <div class="form-logo">AR_Learn</div>
                    <h2 class="form-title">Créer un Compte</h2>
                    <p class="form-subtitle">Rejoignez des milliers d'apprenants dans le monde</p>
                </div>

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

                <form action="<?= base_url('/signup') ?>" method="POST" id="registerForm">
                    <?= csrf_field() ?>

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


                    <button type="submit" class="btn-primary" id="submitBtn">Créer un compte</button>
                </form>

                <div class="form-switch">
                    Vous avez déjà un compte ?
                    <a href="<?= base_url('/') ?>">Se connecter</a>
                </div>
            </div>
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