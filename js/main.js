(function() {
    const cards = document.querySelectorAll('.card__image');

    ImageModule.adjustHeight(cards);
    window.addEventListener('resize', () => { ImageModule.adjustHeight(cards) } );
})();
