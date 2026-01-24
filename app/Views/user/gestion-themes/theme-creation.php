<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AR_Learn - Créer un thème</title>
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
            padding: 40px 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        /* En-tête */
        .header {
            text-align: center;
            margin-bottom: 50px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #8FABD4;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 30px;
            transition: all 0.3s;
        }

        .back-link:hover {
            color: #EFECE3;
            transform: translateX(-5px);
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 15px;
            background: linear-gradient(120deg, #EFECE3, #8FABD4);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-subtitle {
            font-size: 16px;
            color: rgba(239, 236, 227, 0.7);
        }

        /* Formulaire */
        .form-card {
            background: rgba(26, 26, 46, 0.7);
            border: 1px solid rgba(143, 171, 212, 0.25);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .form-group {
            margin-bottom: 30px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #8FABD4;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .required {
            color: #ef4444;
            margin-left: 4px;
        }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 14px 18px;
            background: rgba(10, 10, 10, 0.5);
            border: 1px solid rgba(143, 171, 212, 0.3);
            border-radius: 12px;
            color: #EFECE3;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s;
        }

        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: #8FABD4;
            box-shadow: 0 0 0 3px rgba(143, 171, 212, 0.1);
            background: rgba(10, 10, 10, 0.7);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-help {
            font-size: 13px;
            color: rgba(239, 236, 227, 0.5);
            margin-top: 8px;
        }

        /* Sélecteur d'icône */
        .icon-selector {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .icon-option {
            display: none;
        }

        .icon-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            background: rgba(10, 10, 10, 0.5);
            border: 2px solid rgba(143, 171, 212, 0.2);
            border-radius: 12px;
            font-size: 32px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .icon-option:checked + .icon-label {
            background: rgba(74, 112, 169, 0.3);
            border-color: #8FABD4;
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(143, 171, 212, 0.4);
        }

        .icon-label:hover {
            border-color: #8FABD4;
            transform: translateY(-3px);
        }

        /* Options de difficulté */
        .difficulty-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 10px;
        }

        .difficulty-option {
            display: none;
        }

        .difficulty-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            padding: 20px;
            background: rgba(10, 10, 10, 0.5);
            border: 2px solid rgba(143, 171, 212, 0.2);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
        }

        .difficulty-icon {
            font-size: 36px;
        }

        .difficulty-text {
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .difficulty-option:checked + .difficulty-label {
            transform: scale(1.05);
            box-shadow: 0 5px 25px rgba(143, 171, 212, 0.3);
        }

        .difficulty-label:hover {
            transform: translateY(-3px);
        }

        /* Facile */
        .difficulty-option:checked + .difficulty-label.difficulty-facile {
            background: rgba(16, 185, 129, 0.2);
            border-color: #10b981;
        }

        .difficulty-label.difficulty-facile .difficulty-text {
            color: #10b981;
        }

        /* Moyen */
        .difficulty-option:checked + .difficulty-label.difficulty-moyen {
            background: rgba(251, 146, 60, 0.2);
            border-color: #fb923c;
        }

        .difficulty-label.difficulty-moyen .difficulty-text {
            color: #fb923c;
        }

        /* Difficile */
        .difficulty-option:checked + .difficulty-label.difficulty-difficile {
            background: rgba(239, 68, 68, 0.2);
            border-color: #ef4444;
        }

        .difficulty-label.difficulty-difficile .difficulty-text {
            color: #ef4444;
        }

        /* Boutons */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
        }

        .btn {
            flex: 1;
            padding: 16px 32px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary {
            background: linear-gradient(to right, #4A70A9, #5c85c4);
            color: #EFECE3;
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
            transform: translateY(-2px);
        }

        /* Messages d'erreur */
        .error-message {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 12px;
            padding: 15px 20px;
            color: #ef4444;
            margin-bottom: 30px;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-card {
                padding: 25px;
            }

            .page-title {
                font-size: 36px;
            }

            .difficulty-options {
                grid-template-columns: 1fr;
            }

            .icon-selector {
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
        <!-- En-tête -->
        <div class="header">

         
            <a href="<?= base_url('user/categorie/sous-categorie/' . esc($categorie['slug']) . '/' . $categorie['id_categorie'])  ?>" class="back-link">
                ← Retour aux thèmes
            </a>
            <h1 class="page-title">Créer un nouveau thème</h1>
            <p class="page-subtitle">
                Ajoutez un thème à la catégorie "<?= esc($categorie['nom']) ?>"
            </p>
        </div>
<?php if (session()->getFlashdata('success')): ?>
    <div style="padding: 15px; background: rgba(16, 185, 129, 0.2); color: #10b981; border-radius: 8px; margin-bottom: 20px; border: 1px solid rgba(16, 185, 129, 0.3);">
        ✓ <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div style="padding: 15px; background: rgba(239, 68, 68, 0.2); color: #ef4444; border-radius: 8px; margin-bottom: 20px; border: 1px solid rgba(239, 68, 68, 0.3);">
        ✗ <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

        <!-- Formulaire -->
        <div class="form-card">
            <form action="<?= base_url('user/themes/store') ?>" method="POST">
                <?= csrf_field() ?>
                
                <!-- ID de la catégorie (caché) -->
                <input type="hidden" name="id_categorie" value="<?= esc($categorie['id_categorie']) ?>">

                <!-- Nom du thème -->
                <div class="form-group">
                    <label class="form-label">
                        Nom du thème <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        class="form-input" 
                        placeholder="Ex: Algèbre Niveau 1"
                        value="<?= old('name') ?>"
                        required>
                    <p class="form-help">Donnez un nom clair et descriptif</p>
                </div>

               <div class="form-group">
                    <label class="form-label">
                        Slug <span class="required">*</span>
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
                    
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea 
                        name="description" 
                        class="form-textarea" 
                        placeholder="Décrivez brièvement ce thème..."><?= old('description') ?></textarea>
                    <p class="form-help">Optionnel - Aidez les utilisateurs à comprendre ce thème</p>
                </div>

                <!-- Icône -->
                <div class="form-group">
                    <label class="form-label">
                        Icône <span class="required">*</span>
                    </label>
                    <div class="icon-selector">
                        <input type="radio" name="icon" value="📐" id="icon1" class="icon-option" <?= old('icon') === '📐' ? 'checked' : '' ?>>
                        <label for="icon1" class="icon-label">📐</label>

                        <input type="radio" name="icon" value="🔢" id="icon2" class="icon-option" <?= old('icon') === '🔢' ? 'checked' : '' ?>>
                        <label for="icon2" class="icon-label">🔢</label>

                        <input type="radio" name="icon" value="📊" id="icon3" class="icon-option" <?= old('icon') === '📊' ? 'checked' : '' ?>>
                        <label for="icon3" class="icon-label">📊</label>

                        <input type="radio" name="icon" value="🧮" id="icon4" class="icon-option" <?= old('icon') === '🧮' ? 'checked' : '' ?>>
                        <label for="icon4" class="icon-label">🧮</label>

                        <input type="radio" name="icon" value="📚" id="icon5" class="icon-option" <?= old('icon') === '📚' ? 'checked' : '' ?>>
                        <label for="icon5" class="icon-label">📚</label>

                        <input type="radio" name="icon" value="✏️" id="icon6" class="icon-option" <?= old('icon') === '✏️' ? 'checked' : '' ?>>
                        <label for="icon6" class="icon-label">✏️</label>

                        <input type="radio" name="icon" value="🎯" id="icon7" class="icon-option" <?= old('icon') === '🎯' ? 'checked' : '' ?>>
                        <label for="icon7" class="icon-label">🎯</label>

                        <input type="radio" name="icon" value="🧪" id="icon8" class="icon-option" <?= old('icon') === '🧪' ? 'checked' : '' ?>>
                        <label for="icon8" class="icon-label">🧪</label>

                        <input type="radio" name="icon" value="🌍" id="icon9" class="icon-option" <?= old('icon') === '🌍' ? 'checked' : '' ?>>
                        <label for="icon9" class="icon-label">🌍</label>

                        <input type="radio" name="icon" value="💡" id="icon10" class="icon-option" <?= old('icon') === '💡' ? 'checked' : '' ?>>
                        <label for="icon10" class="icon-label">💡</label>
                    </div>
                    <p class="form-help">Choisissez une icône représentative</p>
                </div>

                <!-- Difficulté -->
                <div class="form-group">
                    <label class="form-label">
                        Difficulté <span class="required">*</span>
                    </label>
                    <div class="difficulty-options">
                        <!-- Facile -->
                        <input 
                            type="radio" 
                            name="difficulty" 
                            value="facile" 
                            id="diff-facile" 
                            class="difficulty-option"
                            <?= old('difficulty') === 'facile' ? 'checked' : '' ?>>
                        <label for="diff-facile" class="difficulty-label difficulty-facile">
                            <span class="difficulty-icon">🟢</span>
                            <span class="difficulty-text">Facile</span>
                        </label>

                        <!-- Moyen -->
                        <input 
                            type="radio" 
                            name="difficulty" 
                            value="moyen" 
                            id="diff-moyen" 
                            class="difficulty-option"
                            <?= old('difficulty') === 'moyen' ? 'checked' : '' ?>>
                        <label for="diff-moyen" class="difficulty-label difficulty-moyen">
                            <span class="difficulty-icon">🟠</span>
                            <span class="difficulty-text">Moyen</span>
                        </label>

                        <!-- Difficile -->
                        <input 
                            type="radio" 
                            name="difficulty" 
                            value="difficile" 
                            id="diff-difficile" 
                            class="difficulty-option"
                            <?= old('difficulty') === 'difficile' ? 'checked' : '' ?>>
                        <label for="diff-difficile" class="difficulty-label difficulty-difficile">
                            <span class="difficulty-icon">🔴</span>
                            <span class="difficulty-text">Difficile</span>
                        </label>
                    </div>
                    <p class="form-help">Aidez les utilisateurs à choisir selon leur niveau</p>
                </div>

                <!-- Boutons d'action -->
                <div class="form-actions">
                    <a href="<?= base_url('user/categorie/sous-categorie/' . esc($categorie['slug']) . '/' . $categorie['id_categorie']) ?>" 
                       class="btn btn-secondary">
                        Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        ✓ Créer le thème
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>