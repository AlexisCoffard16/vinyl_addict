<?php
require_once 'connexion.php';

$mot_cle = isset($_GET['q']) ? trim($_GET['q']) : "";

$resultats_artistes = [];
$resultats_albums = [];

if (!empty($mot_cle)) {
    // 1. Recherche des Vinyles
    $stmtAlbums = $pdo->prepare("
        SELECT Album.id_album, Album.titre_album, Album.img_album, Artiste.img_art 
        FROM Album 
        JOIN Artiste ON Album.id_art = Artiste.id_art 
        WHERE Album.titre_album LIKE :recherche
    ");
    $stmtAlbums->execute(['recherche' => '%' . $mot_cle . '%']);
    $resultats_albums = $stmtAlbums->fetchAll(PDO::FETCH_ASSOC);

    // 2. Recherche des Artistes
    $stmtArtistes = $pdo->prepare("SELECT id_art, nom_art, img_art FROM Artiste WHERE nom_art LIKE :recherche");
    $stmtArtistes->execute(['recherche' => '%' . $mot_cle . '%']);
    $resultats_artistes = $stmtArtistes->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/style.css" type="text/css" />
    <script src="../scripts/script.js" type="text/javascript"></script>
    <title>Recherche : <?php echo htmlspecialchars($mot_cle); ?></title>
</head>
<body>
    
<header>
    <h1><a href="index.php" style="color: black; text-decoration: none;">Vinyl'Addict</a></h1>
    
    <nav class="menu-principal">
        <a href="coups-de-coeur.html" class="bandeau">Nos Coups de Coeur</a>
        <a href="genres.html" class="bandeau">Genres</a>
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
    <div class="entete" style="margin-top: 50px;">
        <h2>Résultats de recherche pour : "<?php echo htmlspecialchars($mot_cle); ?>"</h2>
    </div>

    <!-- Message si rien n'est trouvé -->
    <?php if (empty($resultats_artistes) && empty($resultats_albums) && !empty($mot_cle)): ?>
        <p style="margin-left: 50px;">Aucun résultat ne correspond à votre recherche.</p>
    <?php endif; ?>

    <!-- Affichage des VINYLES -->
    <?php if (!empty($resultats_albums)): ?>
        <div class="entete">
            <h2 style="color: #555; font-size: 16px;">Vinyles trouvés :</h2>
        </div>
        <div class="grille-artistes"> 
            <?php foreach ($resultats_albums as $album) { ?>
                <div class="bloc">
                    <?php 
                    // On utilise directement la valeur de la base de données
                    if (!empty($album['img_album'])) 
                    {
                        $cheminAlbum = '../images/pochettes/' . $album['img_album'];
                    } else 
                    {
                        $cheminAlbum = '../images/default_vinyle.png'; 
                    }
                    ?>
                    <!-- Le onerror reste là en sécurité si une image a été supprimée ou renommée -->
                    <img src="<?php echo htmlspecialchars($cheminAlbum); ?>" alt="Pochette de <?php echo htmlspecialchars($album['titre_album']); ?>" class="photo" onerror="this.src='../images/default_vinyle.png';">
                    <h3>
                        <a href="detail-vinyle.php?id=<?php echo $album['id_album']; ?>">
                            <?php echo htmlspecialchars($album['titre_album']); ?>
                        </a>
                    </h3>
                </div>
            <?php } ?>
        </div>
    <?php endif; ?>

    <!-- Affichage des ARTISTES -->
    <?php if (!empty($resultats_artistes)): ?>
        <div class="entete" style="margin-top: 40px;">
            <h2 style="color: #555; font-size: 16px;">Artistes trouvés :</h2>
        </div>
        <div class="grille-artistes">
            <?php foreach ($resultats_artistes as $artiste) { ?>
                <div class="bloc">
                    <?php 
                    $cheminArtiste = !empty($artiste['img_art']) ? '../images/artistes-groupes/' . $artiste['img_art'] : '../images/default_artiste.png'; 
                    ?>
                    <!-- Idem, onerror garantit l'affichage de l'image de secours -->
                    <img src="<?php echo htmlspecialchars($cheminArtiste); ?>" alt="Photo de <?php echo htmlspecialchars($artiste['nom_art']); ?>" class="photo" onerror="this.src='../images/default_artiste.png';">
                    <h3>
                        <a href="artiste.php?id=<?php echo $artiste['id_art']; ?>">
                            <?php echo htmlspecialchars($artiste['nom_art']); ?>
                        </a>
                    </h3>
                </div>
            <?php } ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>