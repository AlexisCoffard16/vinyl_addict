<?php
// On branche la base de données
require_once 'connexion.php';

// On prépare nos requêtes
$rqArtistes = $pdo->query("SELECT id_art, nom_art, img_art FROM Artiste");

// On stocke les résultats
$artistes = $rqArtistes->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="Author" lang="fr" content="Alexis COFFARD" />
    <link rel="stylesheet" href="../styles/styleArtiste.css" type="text/css" />
    <script src="../scripts/script.js" type="text/javascript"></script>
    <title>Accueil</title>
</head>

<body>
<header>
    <h1><a href="index.php" style="color: black; text-decoration: none;">Vinyl'Addict</a></h1>
    
    <nav class="menu-principal">
        <a href="coups-de-coeur.html" class="bandeau">Nos Coups de Coeur</a>
        <a href="genres.html" class="bandeau">Genres</a>
        <a href="artistes.html" class="bandeau">Artistes</a>
        <a href="vinyles.html" class="bandeau">Nos Vinyles</a>
    </nav>
    
    <div class="actions-header">
        <div class="conteneur-recherche">
            <input type="search" id="barre-recherche" placeholder="Un vinyle, un artiste..."/>
            <button class="btn-recherche" onclick="rechercherElement()">
                <img src="../images/icones/icone-recherche.png" class="icone-btn" alt="Rechercher">
            </button>
        </div>

        <div class="conteneur-panier">
            <a href="panier.html" class="btn-panier" onclick="afficherPanier()">
                <img src="../images/icones/icone-panier.png" class="icone-panier" alt="Panier">
            </a>
        </div>
    </div>
</header>

<div>
    <div class="conteneur-ariane">
        <button class="btn-accueil" href="index.html">
            <img src="../images/icones/icone-accueil.png" class="icone-accueil" alt="Retourner à l'accueil">
        </button>

    </div>

</div>

<div>
    <div class="entete">
        <h2> Artistes :</h2>
    </div>
    
    <div class="grille-artistes">
    <?php foreach ($artistes as $artiste) { ?>
        <div class="bloc">
            <?php 
            $cheminImage = !empty($artiste['img_art']) ? $artiste['img_art'] : '../images/artistes-groupes/default.jpg'; 
            ?>
            <img src="<?php echo htmlspecialchars($cheminImage); ?>" alt="Photo de <?php echo htmlspecialchars($artiste['nom_art']); ?>" class="photo">
            
            <h3>
                <a href="artiste.php?id=<?php echo $artiste['id_art']; ?>">
                    <?php echo htmlspecialchars($artiste['nom_art']); ?>
                </a>
            </h3>
        </div>
    <?php } ?>
    </div>
</div>

<footer>
    <p>© 2026 Alexis COFFARD</p>
</footer>

</body>
</html>