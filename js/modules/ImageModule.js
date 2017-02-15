var ImageModule = (function(){
    var adjustHeight = (objects) => {
        objects.forEach((card) => {
            card.style.height = card.width + "px";
        });
    }

    return { adjustHeight : adjustHeight };
})();
