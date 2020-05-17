//DROPDOWN MENU

{
    function dropdown() {
        let drop = document.getElementById('menu-hidden');

        if (drop.style.display === 'flex') {
            drop.style.display = 'none';
        } else {
            drop.style.display = 'flex';
        }

    }
}

// SLIDER AFFICHE GALLERY

{
    let slideId = 1;

    showSlideinktober(slideId);

    showSlideaffiche(slideId);

    showSlidesiteweb(slideId);

    function plusDivsinktober(n) {
        showSlideinktober(slideId += n);
    }

    function plusDivsaffiche(n) {
        showSlideaffiche(slideId += n);
    }

    function plusDivssiteweb(n) {
        showSlidesiteweb(slideId += n);
    }

    function showSlideinktober(n) {

        let inktober = document.getElementsByClassName("slide-inktober");

        if (n > inktober.length) {
            slideId = 1
        }

        if (n < 1) {
            slideId = inktober.length
        }

        for (let i = 0; i < inktober.length; i++) {
            inktober[i].style.display = "none";
        }
        inktober[slideId - 1].style.display = "flex";
    }

    function showSlideaffiche(n) {

        let affiche = document.getElementsByClassName("slide-affiche");

        if (n > affiche.length) {
            slideId = 1
        }

        if (n < 1) {
            slideId = affiche.length
        }

        for (let i = 0; i < affiche.length; i++) {
            affiche[i].style.display = "none";
        }
        affiche[slideId - 1].style.display = "flex";
    }

    function showSlidesiteweb(n) {

        let siteweb = document.getElementsByClassName("slide-siteweb");

        if (n > siteweb.length) {
            slideId = 1
        }

        if (n < 1) {
            slideId = siteweb.length
        }

        for (let i = 0; i < siteweb.length; i++) {
            siteweb[i].style.display = "none";
        }
        siteweb[slideId - 1].style.display = "flex";
    }
}