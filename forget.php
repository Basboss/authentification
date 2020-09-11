<?php

// Formulaire ou on saisit son email
// On vérifie que l'email et s'il existe, il va falloir générer un
// token dans la BDD lié à cet user

// INSERT INTO reset_token (token, expired at, user_id)
// VALUES (abc456, '2020-09-11 16:30:00', 1)

// Le token doit être généré aléatoirement avec 64 caractères
// Le expired_at doit être l'heure actuelle + 1 (Il faut modifier la 
// structure de la BDD en datetime)

require 'config/config.php';
require 'views/partials/header.php'; ?>

<div class="container">
    <form action="" method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" 
        class="form-control" value="<?= $email; ?>">
    </form>
</div>


<?php require 'views/partials/footer.php';