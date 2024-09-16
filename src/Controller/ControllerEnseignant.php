<?php

namespace App\SAE\Controller;

use App\SAE\Lib\ConnexionUtilisateur;
use App\SAE\Lib\VerificationEmail;
use App\SAE\Lib\MessageFlash;
use App\SAE\Lib\MotDePasse;
use App\SAE\Model\DataObject\Enseignant;
use App\SAE\Model\DataObject\Entreprise;
use App\SAE\Model\Repository\EnseignantRepository;
use App\SAE\Model\Repository\EntrepriseRepository;
use mysql_xdevapi\Table;

/*
 * Controller gérant les actions liées aux enseignants
 */
class ControllerEnseignant extends ControllerGenerique{

}