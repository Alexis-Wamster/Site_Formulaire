<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp'; // Protocole d'envoi des e-mails (smtp, sendmail, mail)
$config['smtp_host'] = 'messagerie.u-pec.fr'; // Adresse du serveur SMTP
$config['smtp_port'] = 587; // Port du serveur SMTP
$config['smtp_user'] = 'alexis.wamster@etu.u-pec.fr'; // Adresse e-mail à utiliser pour l'authentification SMTP
$config['smtp_pass'] = '32201909'; // Mot de passe de l'adresse e-mail
$config['mailtype'] = 'html'; // Type de contenu des e-mails (text ou html)
$config['charset'] = 'utf-8'; // Jeu de caractères des e-mails
$config['newline'] = "\r\n"; // Caractère de nouvelle ligne à utiliser (CRLF recommandé pour la plupart des serveurs)
$config['smtp_crypto'] = "STARTLS";

//$config['smtp_user'] = 'sae2.02.doodle.like@gmail.com'; // Adresse e-mail à utiliser pour l'authentification SMTP
//$config['smtp_pass'] = 'SDF = (Site De Fou)'; // Mot de passe de l'adresse e-mail