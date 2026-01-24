<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Quiz - AR_Learn</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #0a0a0a; min-height: 100vh; color: #EFECE3; }
        
        .navbar { 
            background: linear-gradient(to right, #16213e 0%, #1a1a2e 50%, #16213e 100%); 
            padding: 18px 50px; 
            display: flex; 
            align-items: center; 
            justify-content: space-between;
            border-bottom: 1px solid rgba(143, 171, 212, 0.15); 
        }
        
        .logo-section { display: flex; gap: 10px; align-items: center; }
        .logo-icon { font-size: 28px; }
        .logo-text { font-size: 22px; font-weight: 700; color: #EFECE3; }
        .user-name { color: #8FABD4; }
        
        .container { max-width: 900px; margin: 50px auto; padding: 0 20px; }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #8FABD4;
            text-decoration: none;
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s;
            margin-bottom: 20px;
        }
        .back-link:hover { background: rgba(143, 171, 212, 0.15); }
        
        .page-header { text-align: center; margin-bottom: 40px; }
        .page-title { 
            font-family: 'Playfair Display'; 
            font-size: 42px; 
            background: linear-gradient(120deg, #EFECE3, #8FABD4); 
            -webkit-background-clip: text; 
            -webkit-text-fill-color: transparent; 
            margin-bottom: 10px; 
        }
        .page-subtitle {
            color: #8FABD4;
            font-size: 16px;
            margin-top: 10px;
        }
        
        .form-container { 
            background: rgba(26, 26, 46, 0.6); 
            border: 1px solid rgba(143, 171, 212, 0.3); 
            border-radius: 20px; 
            padding: 40px; 
        }
        
        .section-title {
            color: #EFECE3;
            font-size: 24px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(143, 171, 212, 0.2);
        }
        
        .form-group { margin-bottom: 25px; }
        .form-label { 
            display: block; 
            color: #8FABD4; 
            font-weight: 500; 
            margin-bottom: 10px; 
            font-size: 14px; 
        }
        .form-input, .form-select, .form-textarea { 
            width: 100%; 
            padding: 15px; 
            background: rgba(26, 26, 46, 0.8); 
            border: 1px solid rgba(143, 171, 212, 0.3); 
            border-radius: 10px; 
            color: #EFECE3; 
            font-size: 15px; 
            font-family: 'Inter', sans-serif; 
            transition: all 0.3s; 
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus { 
            outline: none; 
            border-color: #4A70A9; 
            box-shadow: 0 0 0 3px rgba(74, 112, 169, 0.15); 
        }
        .form-textarea { min-height: 100px; resize: vertical; }
        
        .theme-badge {
            display: inline-block;
            padding: 8px 16px;
            background: rgba(143, 171, 212, 0.2);
            color: #8FABD4;
            border-radius: 20px;
            font-size: 14px;
            margin-bottom: 20px;
        }
        
        .question-block { 
            background: rgba(74, 112, 169, 0.08); 
            border: 1px solid rgba(143, 171, 212, 0.2); 
            border-radius: 12px; 
            padding: 25px; 
            margin-bottom: 20px; 
        }
        
        .question-number { 
            color: #4caf50; 
            font-weight: 600; 
            font-size: 16px;
            margin-bottom: 20px;
            display: block;
        }
        
        .answer-item { 
            display: flex; 
            gap: 10px; 
            align-items: center;
            margin-bottom: 12px;
        }
        .answer-item input[type="text"] { flex: 1; }
        .answer-item input[type="radio"] { 
            width: 20px; 
            height: 20px; 
            cursor: pointer; 
            accent-color: #4A70A9; 
        }
        .answer-label-text {
            color: #8FABD4;
            font-size: 13px;
            min-width: 80px;
        }
        
        .btn-group { 
            display: flex; 
            gap: 15px; 
            margin-top: 30px; 
        }
        .btn { 
            padding: 15px 30px; 
            border: none; 
            border-radius: 10px; 
            font-size: 16px; 
            font-weight: 600; 
            cursor: pointer; 
            transition: all 0.3s; 
            flex: 1; 
            text-decoration: none;
            text-align: center;
            display: block;
        }
        .btn-primary { 
            background: linear-gradient(to right, #4A70A9, #5c85c4); 
            color: white; 
        }
        .btn-primary:hover { transform: scale(1.02); }
        .btn-secondary { 
            background: rgba(143, 171, 212, 0.2); 
            border: 2px solid #8FABD4; 
            color: #8FABD4; 
        }
        
        .alert { 
            padding: 15px; 
            border-radius: 10px; 
            margin-bottom: 20px; 
        }
        .alert-error { 
            background: rgba(220, 38, 38, 0.2); 
            border: 1px solid #dc2626; 
            color: #dc2626; 
        }
        .alert-success { 
            background: rgba(76, 175, 80, 0.2); 
            border: 1px solid #4CAF50; 
            color: #4CAF50; 
        }

        .helper-text {
            color: rgba(143, 171, 212, 0.7);
            font-size: 13px;
            margin-top: 5px;
        }

        #questionsSection {
            display: none;
        }

        #questionsSection.show {
            display: block;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo-section">
            <span class="logo-icon">📚</span>
            <span class="logo-text">AR_Learn</span>
        </div>
        <div class="user-section">
            <span class="user-name">👤 <?= esc($user['prenom'] . ' ' . $user['nom']) ?></span>
        </div>
    </nav>

    <div class="container">
        <a href="<?= base_url('dashboard') ?>" class="back-link">
            ← Retour aux table de bord 
        </a>

        <div class="page-header">
            <h1 class="page-title">Créer un Nouveau Quiz</h1>
            <div class="theme-badge">
                📚 <?= esc($theme['name'] ?? 'Thème') ?> • <?= esc($categorie['nom'] ?? 'Catégorie') ?>
            </div>
        </div>

        <div class="form-container">
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
            

            <form method="POST" action="<?= base_url('user/quiz/store') ?>">
                <?= csrf_field() ?>
                
                <!-- Thème caché -->
                <input type="hidden" name="theme_id" value="<?= $theme['id'] ?? '' ?>">
                
                <!-- Informations du Quiz -->
                <h2 class="section-title">📋 Informations du Quiz</h2>
                
                <div class="form-group">
                    <label class="form-label">Titre du Quiz *</label>
                    <input type="text" name="quiz_title" class="form-input" placeholder="Ex: Les Bases de l'Algèbre" required value="<?= old('quiz_title') ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Description (optionnel)</label>
                    <textarea name="quiz_description" class="form-textarea" placeholder="Décrivez brièvement votre quiz..."><?= old('quiz_description') ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Nombre de questions *</label>
                    <input type="number" id="questionCount" class="form-input" min="1" max="20" value="5" required>
                    <p class="helper-text">Entre 1 et 20 questions</p>
                </div>

                <button type="button" class="btn btn-primary" onclick="generateQuestions()" style="width: 100%;">
                    ✓ Générer les questions
                </button>

                <!-- Section des questions (cachée au début) -->
                <div id="questionsSection">
                    <h2 class="section-title" style="margin-top: 40px;">✍️ Vos Questions</h2>
                    
                    <div id="questionsContainer"></div>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">✓ Créer le Quiz</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function generateQuestions() {
            const count = parseInt(document.getElementById('questionCount').value);
            
            if (!count || count < 1 || count > 20) {
                alert('Veuillez entrer un nombre entre 1 et 20');
                return;
            }

            const container = document.getElementById('questionsContainer');
            container.innerHTML = '';

            for (let i = 1; i <= count; i++) {
                const questionBlock = document.createElement('div');
                questionBlock.className = 'question-block';
                questionBlock.innerHTML = `
                    <span class="question-number">📝 Question ${i}</span>
                    
                    <div class="form-group">
                        <label class="form-label">Texte de la question *</label>
                        <textarea name="questions[${i}][text]" class="form-textarea" placeholder="Écrivez votre question..." required style="min-height: 80px;"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Réponses *</label>
                        <p class="helper-text" style="margin-bottom: 15px;">Cochez la case à côté de la bonne réponse</p>
                        
                        <div class="answer-item">
                            <input type="radio" name="questions[${i}][correct]" value="1" required>
                            <span class="answer-label-text">Réponse A:</span>
                            <input type="text" name="questions[${i}][answers][1]" class="form-input" placeholder="Première réponse" required>
                        </div>
                        
                        <div class="answer-item">
                            <input type="radio" name="questions[${i}][correct]" value="2" required>
                            <span class="answer-label-text">Réponse B:</span>
                            <input type="text" name="questions[${i}][answers][2]" class="form-input" placeholder="Deuxième réponse" required>
                        </div>
                        
                        <div class="answer-item">
                            <input type="radio" name="questions[${i}][correct]" value="3" required>
                            <span class="answer-label-text">Réponse C:</span>
                            <input type="text" name="questions[${i}][answers][3]" class="form-input" placeholder="Troisième réponse" required>
                        </div>
                        
                        <div class="answer-item">
                            <input type="radio" name="questions[${i}][correct]" value="4" required>
                            <span class="answer-label-text">Réponse D:</span>
                            <input type="text" name="questions[${i}][answers][4]" class="form-input" placeholder="Quatrième réponse" required>
                        </div>
                    </div>
                `;
                
                container.appendChild(questionBlock);
            }

            // Afficher la section des questions
            document.getElementById('questionsSection').classList.add('show');
            
            // Scroll vers les questions
            document.getElementById('questionsSection').scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</body>
</html>