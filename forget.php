<?php

// Formulaire ou on saisit son email
// On vérifie que l'email et s'il existe, il va falloir générer un
// token dans la BDD lié à cet user

// INSERT INTO reset_token (token, expired at, user_id)
// VALUES (abc456, '2020-09-11 16:30:00', 1)

// Le token doit être généré aléatoirement avec 64 caractères
// Regarder du côté de random_bytes()
// Le expired_at doit être l'heure actuelle + 1 (Il faut modifier la 
// structure de la BDD en datetime)

require 'config/config.php';
require 'views/partials/header.php'; 

if(!empty($POST)) {
    $email = sanitize($_POST['email']);

    // - Vérifier que l'email est présent en BDD
    $query = $db->prepare('SELECT * FROM user WHERE email = :email OR pseudo = :email');
    $query->execute(['email' => $email]);
    $user = $query->fetch();

    if($user) { // On génère le token
        $token = bin2hex(random_bytes(32));
        $expiredAt = (new \DateTime())->add(new DateInterval('PT1H'));

        $query = $db->prepare('INSERT INTO reset_token (token, expired_at, user_id)
        VALUES (:token, :expired_at, :user_id)');
        $query->execute([
            'token' => $token,
            'expired_at' => $expiredAt->format('Y-m-d'),
            'user_id' => $user['id'],
        ]);

        echo $baseUrl.'reset.php?token='.$token;
    } else {
        $error = 'Si le compte existe, le token a été envoyé';
    }
}
?>

<div class="container">
    <form action="" method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" 
        class="form-control" value="<?= $email; ?>">

        <button class="btn btn-primary">Demander un nouveau mot de passe</button>
    </form>
</div>


<?php require 'views/partials/footer.php';