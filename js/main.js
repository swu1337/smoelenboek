var ImageModule = (function(){
    var adjustHeight = (objects) => {
        console.log(objects);
        objects.forEach((card) => {
            card.style.height = card.width + "px";
        });
    }

    return { adjustHeight : adjustHeight };
})();

(function() {
    const cards = document.querySelectorAll('.card__image');

    ImageModule.adjustHeight(cards);
    window.addEventListener('resize', () => { ImageModule.adjustHeight(cards) } );
})();
