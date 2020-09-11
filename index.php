<?php

/**
 * Système d'authetification en PHP
 * Il nous faudra 4 pages : 
 * Inscription (/register)
 *  Connexion (/login)
 *  MDP oublié (/forget)
 *  Formulaire de changement de MDP (/reset/123)
 * 
 * 
 *  On va devoir stocker les utilisateurs donc il nous faut une table user : 
 * id
 * email
 * password
 * pseudo
 * 
 * 
 * On va stocker les tokens de réinitialisation du MDP dans une table reset_token : 
 * id
 * token
 * expired_at
 * user_id
 */