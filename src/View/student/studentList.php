<link rel="stylesheet" href="assets/css/offer.css">
<link rel="stylesheet" href="assets/css/filter.css">
<script src="assets/javascript/buildOfferTable.js"></script>

<div class="header">
    <h2>
        Liste des étudiants
    </h2>
</div>
<div class="container">
    <form method="get" action="frontController.php">

        <input type="hidden" name="action" value="getEtudiantBySearch">
        <input type="hidden" name="controller" value="Etudiant">

        <input type="text" placeholder="Rechercher un étudiant" name="keywords" id="search-bar"
            <?php
            if (isset($_GET["keywords"])) {
                echo "value=\"" . $_GET['keywords'] . "\"";
            }
            ?>>

        <button type="submit" class="custom-button" id="search-button">
            <img src="assets/images/loupe.png" alt="Loupe Icon" width="20" height="20">
        </button>

    </form>
</div>
<div class="VBox" id="center">

    <div class="header">

    </div>
    <?php
    foreach ($listEtudiants as $etudiant) {
        require "student.php";
    }
    ?>
</div>