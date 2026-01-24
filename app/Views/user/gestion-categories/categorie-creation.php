<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une catégorie - AR_Learn</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* === RESET & BASE === */
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
            padding: 40px 20px;
        }

        /* === CONTENEUR PRINCIPAL === */
        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        /* === EN-TÊTE DE PAGE === */
        .page-header {
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

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: #EFECE3;
            margin-bottom: 10px;
        }

        .page-subtitle {
            font-size: 16px;
            color: rgba(239, 236, 227, 0.6);
        }

        /* === CONTENEUR DU FORMULAIRE === */
        .form-container {
            background: rgba(26, 26, 46, 0.5);
            border: 1px solid rgba(143, 171, 212, 0.25);
            border-radius: 18px;
            padding: 40px;
            backdrop-filter: blur(10px);
        }

        /* === GROUPES DE CHAMPS === */
        .form-group {
            margin-bottom: 30px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #EFECE3;
            margin-bottom: 10px;
        }

        .form-label .required {
            color: #ff6b6b;
            margin-left: 4px;
        }

        /* === CHAMPS DE SAISIE === */
        .form-input,
        .form-textarea {
            width: 100%;
            padding: 14px 18px;
            background: rgba(16, 16, 36, 0.8);
            border: 1px solid rgba(143, 171, 212, 0.3);
            border-radius: 12px;
            color: #EFECE3;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #4A70A9;
            box-shadow: 0 0 0 3px rgba(74, 112, 169, 0.1);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-hint {
            font-size: 13px;
            color: rgba(239, 236, 227, 0.5);
            margin-top: 6px;
        }

        /* === SÉLECTEUR DE COULEUR === */
        .color-input-wrapper {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .form-input[type="color"] {
            width: 80px;
            height: 50px;
            padding: 5px;
            cursor: pointer;
        }

        .color-code {
            font-size: 14px;
            color: rgba(239, 236, 227, 0.7);
        }

        /* === GRILLE D'ICÔNES === */
        .icon-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
            gap: 12px;
            margin-top: 10px;
        }

        /* Chaque option d'icône */
        .icon-option {
            position: relative;
        }

        .icon-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .icon-label {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            aspect-ratio: 1;
            font-size: 28px;
            background: rgba(16, 16, 36, 0.8);
            border: 2px solid rgba(143, 171, 212, 0.3);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .icon-label:hover {
            transform: translateY(-3px);
            border-color: #4A70A9;
            background: rgba(74, 112, 169, 0.2);
        }

        /* Icône sélectionnée - utilise le sélecteur :checked */
        .icon-option input[type="radio"]:checked + .icon-label {
            border-color: #4A70A9;
            background: rgba(74, 112, 169, 0.3);
            box-shadow: 0 0 20px rgba(74, 112, 169, 0.4);
        }

        /* === MESSAGES D'ALERTE === */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .alert-error {
            background: rgba(255, 107, 107, 0.15);
            border: 1px solid rgba(255, 107, 107, 0.3);
            color: #ff8787;
        }

        .alert-success {
            background: rgba(81, 207, 102, 0.15);
            border: 1px solid rgba(81, 207, 102, 0.3);
            color: #51cf66;
        }

        /* Liste d'erreurs */
        .error-list {
            list-style: none;
            padding-left: 0;
        }

        .error-list li {
            margin-bottom: 8px;
        }

        .error-list li:before {
            content: "⚠ ";
            margin-right: 8px;
        }

        /* === BOUTONS === */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
        }

        .btn {
            padding: 14px 32px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(to right, #4A70A9, #5c85c4);
            color: #EFECE3;
            flex: 1;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(74, 112, 169, 0.4);
        }

        .btn-secondary {
            background: rgba(143, 171, 212, 0.15);
            color: #8FABD4;
            border: 1px solid rgba(143, 171, 212, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(143, 171, 212, 0.25);
            border-color: #8FABD4;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .form-container {
                padding: 30px 20px;
            }

            .icon-grid {
                grid-template-columns: repeat(auto-fill, minmax(50px, 1fr));
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        
        <!-- ============================================ -->
        <!-- EN-TÊTE DE LA PAGE -->
        <!-- ============================================ -->
        <div class="page-header">
            <a href="<?= base_url('dashboard') ?>" class="back-link">
                ← Retour au tableau de bord
            </a>
            <h1 class="page-title">Créer une catégorie</h1>
            <p class="page-subtitle">Ajoutez une nouvelle catégorie principale pour organiser vos quiz</p>
        </div>

        <!-- ============================================ -->
        <!-- MESSAGES D'ERREUR -->
        <!-- Affiche les erreurs de validation -->
        <!-- ============================================ -->
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-error">
                <strong>Erreurs de validation :</strong>
                <ul class="error-list">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- ============================================ -->
        <!-- MESSAGE D'ERREUR SIMPLE -->
        <!-- ============================================ -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- ============================================ -->
        <!-- MESSAGE DE SUCCÈS -->
        <!-- ============================================ -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- ============================================ -->
        <!-- FORMULAIRE DE CRÉATION -->
        <!-- ============================================ -->
        <div class="form-container">
            <form action="<?= base_url('user/categorie/store') ?>" method="POST">
                
                <!-- Protection CSRF obligatoire pour CodeIgniter 4 -->
                <?= csrf_field() ?>

                <!-- ========================================== -->
                <!-- CHAMP : NOM DE LA CATÉGORIE -->
                <!-- ========================================== -->
                <div class="form-group">
                    <label class="form-label">
                        Nom de la catégorie <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="nom" 
                        class="form-input" 
                        placeholder="Ex: Sciences, Mathématiques, Histoire"
                        value="<?= old('nom') ?>"
                        required
                        maxlength="50">
                    <p class="form-hint">Le nom sera visible par tous les utilisateurs</p>
                </div>

                <!-- ========================================== -->
                <!-- CHAMP : SLUG (URL conviviale) -->
                <!-- ========================================== -->
                <div class="form-group">
                    <label class="form-label">
                        Slug (URL) <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="slug" 
                        class="form-input" 
                        placeholder="Ex: sciences, mathematiques, histoire"
                        value="<?= old('slug') ?>"
                        required
                        maxlength="50"
                        pattern="[a-z0-9-]+"
                        title="Uniquement des lettres minuscules, chiffres et tirets">
                    <p class="form-hint">Utilisez uniquement des minuscules, chiffres et tirets (ex: mon-slug)</p>
                </div>

                <!-- ========================================== -->
                <!-- CHAMP : DESCRIPTION / EXPLICATION -->
                <!-- ========================================== -->
                <div class="form-group">
                    <label class="form-label">
                        Description
                    </label>
                    <textarea 
                        name="explication" 
                        class="form-textarea" 
                        placeholder="Décrivez cette catégorie en quelques mots..."
                        maxlength="255"><?= old('explication') ?></textarea>
                    <p class="form-hint">Une courte description pour aider les utilisateurs (optionnel)</p>
                </div>

                <!-- ========================================== -->
                <!-- CHAMP : COULEUR THÉMATIQUE -->
                <!-- ========================================== -->
                <div class="form-group">
                    <label class="form-label">
                        Couleur thématique <span class="required">*</span>
                    </label>
                    <div class="color-input-wrapper">
                        <input 
                            type="color" 
                            name="color" 
                            class="form-input"
                            value="<?= old('color', '#4A70A9') ?>"
                            required>
                        <span class="color-code">Choisissez une couleur pour identifier la catégorie</span>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- CHAMP : ICÔNE DE LA CATÉGORIE -->
                <!-- Utilise des radio buttons pour la sélection -->
                <!-- ========================================== -->
                <div class="form-group">
                    <label class="form-label">
                        Icône <span class="required">*</span>
                    </label>
                    <div class="icon-grid">
                        <?php 
                        // Liste des icônes disponibles
                        $icons = [
                            '🔬' => 'Sciences',
                            '📚' => 'Littérature', 
                            '💻' => 'Informatique',
                            '🌍' => 'Géographie',
                            '🎨' => 'Arts',
                            '⚛️' => 'Physique',
                            '📐' => 'Mathématiques',
                            '🌐' => 'Langues',
                            '🇪🇸' => 'Espagnol',
                            '🇬🇧' => 'Anglais',
                            '📖' => 'Histoire',
                            '🎯' => 'Général'
                        ];
                        
                        // Boucle pour générer chaque option d'icône
                        foreach ($icons as $emoji => $label): 
                        ?>
                            <div class="icon-option">
                                <!-- Radio button caché -->
                                <input 
                                    type="radio" 
                                    name="icon" 
                                    value="<?= $emoji ?>" 
                                    id="icon-<?= $emoji ?>"
                                    <?= old('icon', '📚') === $emoji ? 'checked' : '' ?>
                                    required>
                                
                                <!-- Label cliquable avec l'émoji -->
                                <label for="icon-<?= $emoji ?>" class="icon-label" title="<?= $label ?>">
                                    <?= $emoji ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <p class="form-hint">Sélectionnez une icône représentative</p>
                </div>

                <!-- ========================================== -->
                <!-- BOUTONS D'ACTION -->
                <!-- ========================================== -->
                <div class="form-actions">
                    <!-- Bouton Annuler : retour au dashboard -->
                    <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">
                        Annuler
                    </a>
                    
                    <!-- Bouton Soumettre : crée la catégorie -->
                    <button type="submit" class="btn btn-primary">
                        ✨ Créer la catégorie
                    </button>
                </div>

            </form>
        </div>

    </div>
</body>
</html>