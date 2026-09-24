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

document.addEventListener("DOMContentLoaded", carrousel);