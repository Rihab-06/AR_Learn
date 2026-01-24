<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AR_Learn - Quiz</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* ===== RESET & BASE ===== */
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
            display: flex;
            flex-direction: column;
        }
        
        /* ===== NAVBAR ===== */
        .navbar { 
            background: linear-gradient(to right, #16213e, #1a1a2e); 
            padding: 18px 50px; 
            display: flex; 
            align-items: center; 
            justify-content: space-between;
            border-bottom: 1px solid rgba(143, 171, 212, 0.15); 
        }
        
        .logo-section { 
            display: flex; 
            gap: 10px; 
            align-items: center; 
        }
        
        .logo-icon { 
            font-size: 28px; 
        }
        
        .logo-text { 
            font-size: 22px; 
            font-weight: 700; 
            color: #EFECE3; 
        }
        
        .user-name { 
            color: #8FABD4; 
        }
        
        /* ===== CONTENEUR PRINCIPAL - CENTRÉ VERTICALEMENT ===== */
        .quiz-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .quiz-container { 
            max-width: 800px; 
            width: 100%;
        }
        
        /* ===== EN-TÊTE DU QUIZ ===== */
        .quiz-header { 
            text-align: center; 
            margin-bottom: 30px;
            padding: 20px;
            background: rgba(26, 26, 46, 0.4);
            border-radius: 12px;
            border: 1px solid rgba(143, 171, 212, 0.2);
        }
        
        .quiz-title { 
            font-size: 28px; 
            font-weight: 700;
            color: #EFECE3;
            margin-bottom: 10px; 
        }
        
        .quiz-meta {
            color: #8FABD4;
            font-size: 14px;
        }
        
        /* ===== CARTE DE QUESTION ===== */
        .question-card { 
            background: rgba(26, 26, 46, 0.4); 
            border: 1px solid rgba(143, 171, 212, 0.2); 
            border-radius: 12px; 
            padding: 30px;
        }
        
        /* Badge numéro de question */
        .question-number {
            background: linear-gradient(to right, #4A70A9, #5c85c4);
            color: #EFECE3;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        /* Texte de la question */
        .question-text { 
            font-size: 20px; 
            color: #EFECE3; 
            line-height: 1.6;
            margin-bottom: 25px;
        }
        
        /* ===== RÉPONSES ===== */
        .answers-form { 
            margin-top: 20px;
        }
        
        /* Chaque option de réponse */
        .answer-option { 
            margin-bottom: 12px;
        }
        
        /* Label de réponse */
        .answer-label {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 18px;
            background: rgba(26, 26, 46, 0.6);
            border: 2px solid rgba(143, 171, 212, 0.2);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        /* Hover sur les réponses */
        .answer-label:hover {
            border-color: rgba(143, 171, 212, 0.5);
            background: rgba(26, 26, 46, 0.8);
        }
        
        /* Radio button */
        .answer-radio {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        
        /* Texte de la réponse */
        .answer-text {
            color: #EFECE3;
            font-size: 16px;
            flex: 1;
        }
        
        /* ===== FEEDBACK APRÈS SOUMISSION ===== */
        
        /* Réponse correcte (vert) */
        .correct {
            border-color: rgba(46, 125, 50, 0.8);
            background: rgba(46, 125, 50, 0.2);
        }
        
        /* Réponse incorrecte (rouge) */
        .incorrect {
            border-color: rgba(211, 47, 47, 0.8);
            background: rgba(211, 47, 47, 0.2);
        }
        
        /* Désactiver les réponses après soumission */
        .disabled {
            cursor: not-allowed;
            opacity: 0.8;
        }
        
        /* Message de feedback */
        .feedback-message {
            margin-top: 20px;
            padding: 14px 20px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
        }
        
        /* Feedback positif */
        .feedback-correct {
            background: rgba(46, 125, 50, 0.2);
            border: 1px solid rgba(46, 125, 50, 0.5);
            color: #4caf50;
        }
        
        /* Feedback négatif */
        .feedback-incorrect {
            background: rgba(211, 47, 47, 0.2);
            border: 1px solid rgba(211, 47, 47, 0.5);
            color: #f44336;
        }
        
        /* ===== BOUTONS ===== */
        .btn-submit, .btn-next {
            width: 100%;
            padding: 14px 30px;
            background: linear-gradient(to right, #4A70A9, #5c85c4);
            color: #EFECE3;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
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
        /* Effet hover sur les boutons */
        .btn-submit:hover, .btn-next:hover {
            opacity: 0.9;
        }
        
        /* Bouton désactivé */
        .btn-submit:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        /* Lien stylisé comme bouton */
        .btn-next {
            text-decoration: none; 
            text-align: center; 
            display: block;
        }
        
        /* Message d'erreur */
        .error-message {
            background: rgba(211, 47, 47, 0.2);
            border: 1px solid rgba(211, 47, 47, 0.5);
            color: #f44336;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- ===== BARRE DE NAVIGATION ===== -->
    <nav class="navbar">
        <div class="logo-section">
            <img src="<?= base_url('assets/images/logo-app.png') ?>" 
                 alt="AR_Learn Logo" 
                 class="logo-img">
            <span class="logo-text">AR_Learn</span>
        </div>
        <div class="user-section">
            <span class="user-name">
                👤 <?= esc(($user['prenom'] ?? '') . ' ' . ($user['nom'] ?? '')) ?>
            </span>
        </div>
    </nav>




    <!-- ===== WRAPPER POUR CENTRER VERTICALEMENT ===== -->
    <div class="quiz-wrapper">
        <div class="quiz-container">
            <!-- ===== EN-TÊTE DU QUIZ ===== -->
            <div class="quiz-header">
                <h2 class="quiz-title"><?= esc($quiz_title ?? 'Quiz') ?></h2>
                
                <!-- Description optionnelle -->
                <?php if (!empty($quiz_description)): ?>
                    <p style="color: rgba(239, 236, 227, 0.7); font-size: 15px; margin-top: 8px;">
                        <?= esc($quiz_description) ?>
                    </p>
                <?php endif; ?>
                
                <!-- Thème et catégorie -->
                <p class="quiz-meta">
                    <?= esc($theme_name ?? 'Thème') ?> • <?= esc($categorie_name ?? 'Catégorie') ?>
                </p>
            </div>

            <!-- ===== MESSAGE D'ERREUR (si existe) ===== -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="error-message">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- ===== CARTE DE QUESTION ===== -->
            <div class="question-card">
                <!-- Numéro de la question -->
                <span class="question-number">
                    Question <?= $questionNumber ?? 1 ?> / <?= $totalQuestions ?? 1 ?>
                </span>
                
                <!-- Texte de la question -->
                <h2 class="question-text">
                    <?= esc($question['question_text'] ?? 'Question') ?>
                </h2>
                
                <!-- ===== CAS 1: FORMULAIRE AVANT SOUMISSION ===== -->
                <?php if (!isset($submitted_answer_id)): ?>
                    <form method="POST" action="<?= base_url('quiz/submit') ?>" class="answers-form">
                        <!-- Boucle sur les réponses -->
                        <?php if (!empty($question['answers'])): ?>
                            <?php foreach ($question['answers'] as $answer): ?>
                                <div class="answer-option">
                                    <label class="answer-label">
                                        <!-- Radio button -->
                                        <input type="radio" 
                                               name="answer_id" 
                                               value="<?= $answer['id'] ?>" 
                                               class="answer-radio"
                                               required>
                                        <!-- Texte de la réponse -->
                                        <span class="answer-text">
                                            <?= esc($answer['answer_text']) ?>
                                        </span>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                        <!-- Bouton de soumission -->
                        <button type="submit" class="btn-submit">
                            Valider la réponse
                        </button>
                    </form>
                    
                <!-- ===== CAS 2: AFFICHAGE DU FEEDBACK APRÈS SOUMISSION ===== -->
                <?php else: ?>
                    <div class="answers-form">
                        <!-- Boucle sur les réponses avec feedback -->
                        <?php if (!empty($question['answers'])): ?>
                            <?php foreach ($question['answers'] as $answer): ?>
                                <div class="answer-option">
                                    <label class="answer-label disabled 
                                        <?php 
                                        // Marquer la bonne réponse en vert
                                        if ($answer['is_correct']): ?>
                                            correct
                                        <?php 
                                        // Marquer la mauvaise réponse sélectionnée en rouge
                                        elseif ($answer['id'] == $submitted_answer_id && !$is_correct): ?>
                                            incorrect
                                        <?php endif; ?>">
                                        
                                        <!-- Radio button désactivé -->
                                        <input type="radio" 
                                               name="answer_id" 
                                               value="<?= $answer['id'] ?>" 
                                               class="answer-radio"
                                               <?= $answer['id'] == $submitted_answer_id ? 'checked' : '' ?>
                                               disabled>
                                        
                                        <!-- Texte avec checkmark pour la bonne réponse -->
                                        <span class="answer-text">
                                            <?php if ($answer['is_correct']): ?>
                                                ✓ 
                                            <?php endif; ?>
                                            <?= esc($answer['answer_text']) ?>
                                        </span>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Message de feedback -->
                    <div class="feedback-message <?= ($is_correct ?? false) ? 'feedback-correct' : 'feedback-incorrect' ?>">
                        <?= $feedback ?? 'Réponse enregistrée' ?>
                    </div>
                    
                    <!-- Bouton pour passer à la question suivante ou voir résultats -->
                    <a href="<?= base_url('quiz/next') ?>" class="btn-next">
                        <?= ($questionNumber ?? 1) < ($totalQuestions ?? 1) ? 'Question suivante →' : 'Voir les résultats →' ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>