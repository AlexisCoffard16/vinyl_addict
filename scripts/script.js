function carrousel() 
{
    const carrousel = document.querySelector(".carrousel");
    const btnGauche = document.getElementById("btn-gauche");
    const btnDroite = document.getElementById("btn-droite");
    const items = document.querySelectorAll(".item-carrousel");

    if (!carrousel || !btnGauche || !btnDroite || items.length === 0) return;

    let index = 0;
    const imagesVisible = 5; 
    const totalImages = items.length;

    function updateCarrousel() 
    {
        const imageWidth = items[0].offsetWidth + 15;
        carrousel.style.transform = `translateX(${-index * imageWidth}px)`;
    }

    btnDroite.addEventListener("click", () => 
    {
        if (index < (totalImages - imagesVisible)) 
        {
            index += imagesVisible; 
            if (index > totalImages - imagesVisible) {
                index = totalImages - imagesVisible;
            }
            updateCarrousel();
        }
    });

    btnGauche.addEventListener("click", () => 
    {
        if (index > 0) 
        {
            index -= imagesVisible; 
            if (index < 0) {
                index = 0;
            }
            updateCarrousel();
        }
    });
}

function rechercherElement() 
{
    // On cible la barre de recherche HTML grâce à son ID
    const inputRecherche = document.getElementById("barre-recherche");

    // On extrait le texte qui a été tapé à l'intérieur.
    const requete = inputRecherche.value.trim();

    // On vérifie que la barre n'est pas vide avant de travailler
    if (requete !== "") 
    {
        // encodeURIComponent() est une sécurité : elle transforme les espaces et les accents 
        // en caractères lisibles pour une URL (un espace devient %20 par exemple).
        window.location.href = "recherche.php?q=" + encodeURIComponent(requete);
    }

    // On écoute ce qu'il se passe sur la barre de recherche
    inputRecherche.addEventListener("keypress", function(event) 
    {
        // Si la touche appuyée est "Enter"
        if (event.key === "Enter") 
        {
            rechercherElement(); // On lance notre fonction*
        }
    });
}

document.addEventListener("DOMContentLoaded", carrousel);