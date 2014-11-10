<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */
define ('WPLANG', 'fr_FR');
// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'wordpress');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '!:]f_d6Aa*9i &=4Fd?Fu}U?O%h]0_Qr<*^~&yh.zG%#(.6_!4X/36zs9NWb/Wep');
define('SECURE_AUTH_KEY',  '$Z <{3Yl*q,QO=/w@I/g@=Av/2o%Q0;9L@*Q<em5FuMQ,WT/ze85Zk0%EoC}876e');
define('LOGGED_IN_KEY',    'm1uO$p,@EQECc]^^=U`B|wt1u,Y%:3W?|V>]Sl}<b3C^i1,W^<a/a5RmXW-}na ?');
define('NONCE_KEY',        '!sR`]fZ)cFZILnjTgXQkepJ#St>P>~wq(@zX1O`<tqZ>L^xmz}.3$&UR[8KpRMj+');
define('AUTH_SALT',        'zBmCXo0|g0c[1q$5)5D2Kn6Y75(Ks ]a^AP^y{i|AYxo|zl@+v!,Nv/ow`&(y8>/');
define('SECURE_AUTH_SALT', '0O`0ec2`lKF@BNHK=??C%btK~@j6_bxpkS6l77HXAsg~bLRY6zNJAt%^Z%>>fq60');
define('LOGGED_IN_SALT',   'u}kPbO`)c9KfAj7T=<>iK6,yKnN3eF1UFQ:f~WF/&JP.b lS%YqYjJ]I!?sDRwPm');
define('NONCE_SALT',       ')p)|CI/jH>ko:uOs|Jf,bC*m>^?UJxun3g,fzW}Zc7f|3&)>H(, ]e?J|(E%s)Y9');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');