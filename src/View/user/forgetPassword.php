<link rel="stylesheet" href="assets/css/connect.css">
<div class="container">
    <form method="get">
        <h2 class="remplaceBaliseLegend">Entrez votre mail</h2>
        <p>
            <label for="siret">Siret</label>
            <input type="text" name="siret" id="siret" required placeholder="01234567891011">
        </p>
        <p>
            <label for="mail">Email</label>
            <input type="text" name="mail" id="mail" required placeholder="rick.astley@roll.com">
        <p>
            <input type="hidden" name="action" value="changePassword">
            <input type="hidden" name="controller" value="Entreprise">
            <input type="submit" value="Envoyer mail">
        </p>
    </form>
</div>