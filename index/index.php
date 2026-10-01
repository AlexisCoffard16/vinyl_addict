<?php
// On branche la base de données
require_once 'connexion.php';

// On prépare nos requêtes
$rqArtistes = $pdo->query("SELECT id_art, nom_art, img_art FROM Artiste LIMIT 4");
$rqGenre    = $pdo->query("SELECT DISTINCT genre FROM Artiste LIMIT 6");
$rqFavori   = $pdo->query("SELECT titre_album, img_album FROM Album WHERE est_coup_de_coeur = 1");

// On stocke les résultats
$artistes = $rqArtistes->fetchAll(PDO::FETCH_ASSOC);
$genres   = $rqGenre->fetchAll(PDO::FETCH_ASSOC);
$favoris  = $rqFavori->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="Author" lang="fr" content="Alexis COFFARD" />
    <link rel="stylesheet" href="../styles/style.css" type="text/css" />
    <script src="../scripts/script.js" type="text/javascript"></script>
    <title>Accueil</title>
</head>

<body>
<header>
    <h1><a href="index.php" style="color: black; text-decoration: none;">Vinyl'Addict</a></h1>
    
    <nav class="menu-principal">
        <a href="coups-de-coeur.html" class="bandeau">Nos Coups de Coeur</a>
        <a href="artiste.php" class="bandeau">Artistes</a>
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
    <div class="entete">
        <h2> Meilleurs ventes du moment :</h2>
        <a href="ventes.html" class="lien-voir">Voir tout</a>
    </div>
    
    <div class="conteneur-carrousel">
        <button id="btn-gauche">←</button>
        <div class="fenetre-carrousel">
            <div class="carrousel">
                <?php foreach ($favoris as $favori) { ?> 
                <div class="item-carrousel">
                    <?php
                        if (!empty($favori['img_album'])) 
                            $imgAlbum = '../images/pochettes/' . $favori['img_album'];
                        else 
                            $imgAlbum = '../images/default_vinyle.png'; 
                    ?>
                        <img src="<?php echo htmlspecialchars($imgAlbum); ?>" alt="Pochette de <?php echo htmlspecialchars($favori['titre_album']); ?>" class="photo">
                </div>
                <?php } ?>
            </div>
        </div>
        <button id="btn-droite">→</button>
    </div>
</div>
<!---
<div>
    <div class="entete">
        <h2> Genres :</h2>
        <a href="genres.html" class="lien-voir">Voir tous les genres</a>
    </div>
    <div class="grille-genres">
        <?php /* foreach ($genres as $genre) { */?>
        <div class="bloc">
            <h3>
                <a href="detail-genre.php?id=<?php /*echo urlencode($genre['genre']); */?>"><?php /*echo htmlspecialchars($genre['genre']); */ ?></a>
            </h3>
        </div>
        <?php /*} */?> */
    </div>
</div> -->

<div>
    <div class="entete">
        <h2> Artistes :</h2>
        <a href="artiste.php" class="lien-voir">Voir tous les artistes</a>
    </div>
    
    <div class="grille-artistes">
    <?php foreach ($artistes as $artiste) { ?>
        <div class="bloc">
            <?php 
            $cheminImage = !empty($artiste['img_art']) ? $artiste['img_art'] : '../images/default_artiste.png'; 
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