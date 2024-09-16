<link rel="stylesheet" href="assets/css/connect.css">
<script src="assets/javascript/showPassword.js"></script>

<div class="container">
    <form method="get">
        <h2 id="remplaceBaliseLegend" class="connexionEtu">Connexion étudiant</h2>
        <p>
            <label for="username">Identifiant</label>
            <input type="text" name="username" id="username" required placeholder="Identifiant">
        <p>
            <label for="password">Mot de passe</label>
        <div class="password-input">
            <input type="password" name="password" id="password" required placeholder="mot de passe">
            <button type="button" id="showPassword"></button>
        </div>
        <p>
            <input type="hidden" name="action" value="connecterLDAP">
            <input type="hidden" name="controller" value="Connexion">
            <button type="submit" value="Connexion" id="connectButton" class="button">
                <span>Connexion</span>
            </button>
        </p>
    </form>
</div>