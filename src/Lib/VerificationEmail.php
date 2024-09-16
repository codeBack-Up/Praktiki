<?php

namespace App\SAE\Lib;

use App\SAE\Config\Conf;
use App\SAE\Controller\ControllerEntreprise;
use App\SAE\Lib\MessageFlash;
use App\SAE\Model\DataObject\AbstractDataObject;
use App\SAE\Model\DataObject\Entreprise;
use App\SAE\Model\Repository\EntrepriseRepository;

/**
 * La classe VerificationEmail gère l'envoi d'e-mails de validation et de changement de mot de passe.
 */
class VerificationEmail
{

    /**
     * Envoie un e-mail de validation pour l'entreprise donnée.
     *
     * @param Entreprise $Entreprise L'objet Entreprise pour lequel l'e-mail de validation est envoyé.
     * @return void
     */
    public static function envoiEmailValidation(Entreprise $Entreprise): void
    {

        $loginURL = rawurlencode($Entreprise->getSiret());
        $nonceURL = rawurlencode($Entreprise->getNonce());
        $absoluteURL = Conf::getAbsoluteURL();
        $lienValidationEmail = "$absoluteURL?controller=Entreprise&action=validerEmail&siret=$loginURL&nonce=$nonceURL";
        $corpsEmail = "<a href=\"$lienValidationEmail\">Validation</a>";
        $message = '
<!DOCTYPE html>
<html lang="fr">
<head>
<title>Validation mail</title>
    <meta charset="utf-8">
</head>
<body style="margin-right: 50px; 
            margin-left: 50px; ">
            <img style="height: 100px; width: 60%" src="https://ci3.googleusercontent.com/proxy/VbTXgeHPXmSDkB6hWmQjvtzKgr000etNNGdTMWePy6i5-iNTZ89d8m-MLzTwvOL5tOLip-crHsES-YOGjCOYf32a1KqoMLuwlNqyxChIoEVaixpHnzv_Z9zC98SF-m0630CmdsR5eD2GR1a1KeeIE25SESAHMzz9oaowuIKQLrw3Nq0jGEOlOLpRFTDB7X_KEOYm1c7WpSXyM3M-VZjXunAI5FZFzt5-=s0-d-e1-ft#https://xdabmy.stripocdn.email/content/guids/CABINET_45be2d3b2329a3ea9f6ae3e3c38bb6b6e4544dcf308fb36fd5c0cb7c0d78abcb/images/combine_um_iut_2023.png" alt="" >
    
    
    <!-- Contenu de la page -->
    <div style="font-size: 20px;
            background-color: #3a9ad6;
            color: #fff; 
            padding: 1px; 
            text-align: center; 
            margin-bottom: 20px;">
        <p><strong>Validation du mail</strong></p>
    </div>
    <br>
    <p>Bonjour,<br>
    Merci de suivre ce lien pour confirmer votre adresse électronique.
    </p>
    <a style="text-decoration: underline; color: #1f3ba2;" href= "'.$lienValidationEmail.'" >Valider mon mail</a>
    <br>
    <p style="margin-bottom: 30px">Bien cordialement,<br>
    Secrétariat du Département Informatique
    </p>
<footer>
    <p>Retrouvez l IUT Montpellier-Sète sur les réseaux !</p>
    <a href="https://www.facebook.com/iut.montpellier.sete">
    <img style="height:32px;" src="https://ci3.googleusercontent.com/proxy/OIHk4lYPhS--ANEr0bp4Bd-tiA-MGjYpkyJOy00KyRisvtWo4Qs02v0aMWkC7kOLGPF6U70sfMdAs9GfYU-1JO1U19Gq83x9upBDxngz-puAGpicjqe2t1nvOuWRFORvah7Qt6VUuZ8zNIHpFPyDCrH7ZiPgpmJBaMspKw=s0-d-e1-ft#https://qofjdx.stripocdn.email/content/assets/img/social-icons/circle-colored/facebook-circle-colored.png" alt="" ></a>
    <a href="https://www.instagram.com/iutmontpelliersete/">
    <img style="height:32px;" src="https://ci3.googleusercontent.com/proxy/HbMHTbAKYZbtJhXPgJmW3kPZrBSaIndx1K5sFyrUxWVpdPAjLax6iGBFs3hlBC91J3GvhfkMIfGQIiEKSipS0woGI6V6T4nl-r1Adrr8RgaGEqywNzejWjbc7ZKAEejup1c4ZoEWfoF-WI98Fvf5ya1d3hKsjU648NXNLek=s0-d-e1-ft#https://qofjdx.stripocdn.email/content/assets/img/social-icons/circle-colored/instagram-circle-colored.png" alt="" ></a>
    <a href="https://www.youtube.com/channel/UCfkvfqYwCSaCMy8_6U_EjDQ">
    <img style="height:32px;" src="https://ci6.googleusercontent.com/proxy/AdIXMcoQ6nlJts2QTGdTSuJXjy9vmL3pdpQiYZZtzRJUzFyST9SYUVHZDszFJBafZsyy295xK7G5JVtf5zg4J83hpxOOd77eiq3MGgqlUf7rRDLiQNa-RZn8e9YH6xs9nO2FG8a6gXRcpvPV3pi9mfSX0SqHzylgaOJ0=s0-d-e1-ft#https://qofjdx.stripocdn.email/content/assets/img/social-icons/circle-colored/youtube-circle-colored.png" alt="" ></a>
    <a href="https://www.linkedin.com/school/iut-de-montpellier-s%C3%A8te">
    <img style="height:32px;" src="https://ci6.googleusercontent.com/proxy/RA0M1Ma5VKEpV-OwDblgnalVQp49e8udqlIzNA-rsA1Tlf_TG4dvUOnjriT9VqQstbFIlzmmTtTijvlm0yg2iCyQhpzSjZbXrc5tsesz4vhEoG614-k776Sfl6DqC1N9jJgOGOPdzNmgn7B3mxHBB62ogrl9yzFvrbM6lQ=s0-d-e1-ft#https://qofjdx.stripocdn.email/content/assets/img/social-icons/circle-colored/linkedin-circle-colored.png" alt="" ></a>
  
  </footer>
</body>
</html>';
        $headers = "From: IUT-Montpellier-Sete \r\n";
        $headers .= "RReply-To: IUT-Montpellier-Sete \r\n";
        $headers .= "Cc: IUT-Montpellier-Sete\r\n";
        $headers.= 'Content-Type:text/html; charset="utf-8"'."\n";
        $headers.= 'Content-Transfert-Encoding: 8bit';

        mail($Entreprise->getMailAValider(), "Validation de votre email",
            $message, $headers);


        // Temporairement avant d'envoyer un vrai mail
        MessageFlash::ajouter("success", $corpsEmail);
    }

    /**
     * Envoie un e-mail de changement de mot de passe.
     *
     * @param string $login Le login de l'utilisateur pour lequel le mot de passe est changé.
     * @param string $mail L'adresse e-mail à laquelle envoyer l'e-mail.
     * @return void
     */
    public static function envoiEmailChangementPassword($entreprise): void{
        $loginURL = rawurlencode($entreprise->getSiret());
        $nonceURL = rawurlencode($entreprise->getNonce());
        $absoluteURL = Conf::getAbsoluteURL();
        $lienChangementPassword = "$absoluteURL?action=verifNonce&controller=Entreprise&siret=$loginURL&nonce=$nonceURL";
        $message = '
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Changement mot de passe</title>
    <meta charset="utf-8">
</head>
<body style="margin-right: 50px; 
            margin-left: 50px; ">
            <img style="height: 100px; width: 70%" src="https://ci3.googleusercontent.com/proxy/VbTXgeHPXmSDkB6hWmQjvtzKgr000etNNGdTMWePy6i5-iNTZ89d8m-MLzTwvOL5tOLip-crHsES-YOGjCOYf32a1KqoMLuwlNqyxChIoEVaixpHnzv_Z9zC98SF-m0630CmdsR5eD2GR1a1KeeIE25SESAHMzz9oaowuIKQLrw3Nq0jGEOlOLpRFTDB7X_KEOYm1c7WpSXyM3M-VZjXunAI5FZFzt5-=s0-d-e1-ft#https://xdabmy.stripocdn.email/content/guids/CABINET_45be2d3b2329a3ea9f6ae3e3c38bb6b6e4544dcf308fb36fd5c0cb7c0d78abcb/images/combine_um_iut_2023.png" alt="" >

    
    
    <!-- Contenu de la page -->
    <div style="font-size: 20px;
            background-color: #3a9ad6;
            color: #fff; 
            padding: 1px; 
            text-align: center; 
            margin-bottom: 50px; ">
            
        <p><strong>Changement de mot de passe</strong></p>
    </div>
    
    <p>Bonjour,<br>
    Merci de suivre ce lien pour changer votre mot de passe.        
    </p>

    <a style=" text-decoration: underline; color: #1f3ba2;" href= "'.$lienChangementPassword.'" >Changer de mot de passe</a>
    <br>
    <p style="margin-bottom: 30px;">Bien cordialement,<br>
    Secrétariat du Département Informatique
    </p>
 <footer>
    <p>Retrouvez l IUT Montpellier-Sète sur les réseaux !</p>
    <a href= "https://www.facebook.com/iut.montpellier.sete">
    <img style="height:32px;" src="https://ci3.googleusercontent.com/proxy/OIHk4lYPhS--ANEr0bp4Bd-tiA-MGjYpkyJOy00KyRisvtWo4Qs02v0aMWkC7kOLGPF6U70sfMdAs9GfYU-1JO1U19Gq83x9upBDxngz-puAGpicjqe2t1nvOuWRFORvah7Qt6VUuZ8zNIHpFPyDCrH7ZiPgpmJBaMspKw=s0-d-e1-ft#https://qofjdx.stripocdn.email/content/assets/img/social-icons/circle-colored/facebook-circle-colored.png" alt="" ></a>
    <a href= "https://www.instagram.com/iutmontpelliersete/">
    <img style="height:32px;" src="https://ci3.googleusercontent.com/proxy/HbMHTbAKYZbtJhXPgJmW3kPZrBSaIndx1K5sFyrUxWVpdPAjLax6iGBFs3hlBC91J3GvhfkMIfGQIiEKSipS0woGI6V6T4nl-r1Adrr8RgaGEqywNzejWjbc7ZKAEejup1c4ZoEWfoF-WI98Fvf5ya1d3hKsjU648NXNLek=s0-d-e1-ft#https://qofjdx.stripocdn.email/content/assets/img/social-icons/circle-colored/instagram-circle-colored.png" alt="" ></a>
    <a href= "https://www.youtube.com/channel/UCfkvfqYwCSaCMy8_6U_EjDQ">
    <img style="height:32px;" src="https://ci6.googleusercontent.com/proxy/AdIXMcoQ6nlJts2QTGdTSuJXjy9vmL3pdpQiYZZtzRJUzFyST9SYUVHZDszFJBafZsyy295xK7G5JVtf5zg4J83hpxOOd77eiq3MGgqlUf7rRDLiQNa-RZn8e9YH6xs9nO2FG8a6gXRcpvPV3pi9mfSX0SqHzylgaOJ0=s0-d-e1-ft#https://qofjdx.stripocdn.email/content/assets/img/social-icons/circle-colored/youtube-circle-colored.png" alt="" ></a>
    <a href="https://www.linkedin.com/school/iut-de-montpellier-s%C3%A8te">
    <img style="height:32px;" src="https://ci6.googleusercontent.com/proxy/RA0M1Ma5VKEpV-OwDblgnalVQp49e8udqlIzNA-rsA1Tlf_TG4dvUOnjriT9VqQstbFIlzmmTtTijvlm0yg2iCyQhpzSjZbXrc5tsesz4vhEoG614-k776Sfl6DqC1N9jJgOGOPdzNmgn7B3mxHBB62ogrl9yzFvrbM6lQ=s0-d-e1-ft#https://qofjdx.stripocdn.email/content/assets/img/social-icons/circle-colored/linkedin-circle-colored.png" alt="" ></a>
  
  
  </footer>
</body>
 
</html>';
        $headers = "From: IUT-Montpellier-Sete \r\n";
        $headers .= "RReply-To: IUT-Montpellier-Sete \r\n";
        $headers .= "Cc: IUT-Montpellier-Sete\r\n";
        $headers.= 'Content-Type:text/html; charset="utf-8"'."\n";
        $headers.= 'Content-Transfert-Encoding: 8bit';
        mail($entreprise->getMailEntreprise(), "Changement de votre mot de passe",
            $message, $headers);
    }

    /**
     * Traite la validation de l'e-mail en fonction du login et du nonce.
     *
     * @param string $login Le login de l'entreprise.
     * @param string $nonce Le nonce associé à l'e-mail de validation.
     * @return bool True si la validation est réussie, false sinon.
     */

    public static function traiterEmailValidation(string $login, string $nonce): bool
    {
        $user = (new EntrepriseRepository())->getById($login);
        if (!is_null($user)) {
            if ($user->formatTableau()["nonceTag"] == $nonce) {
                $user->setMailEntreprise($user->getMailAValider());
                $user->setMailAValider("");
                $user->setNonce("");
                (new EntrepriseRepository())->mettreAJour($user);
                return true;
            }
        }
        return false;
    }

    /**
     * Vérifie si l'entreprise a déjà validé son e-mail.
     *
     * @param Entreprise $Entreprise L'objet Entreprise à vérifier.
     * @return bool True si l'e-mail est validé, false sinon.
     */

    public static function aValideEmail(Entreprise $Entreprise): bool
    {
        return (bool) $Entreprise->getMailEntreprise();
    }
}