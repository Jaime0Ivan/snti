window.onload = function () {
    document.querySelector('.boton').addEventListener('click', function () {
        document.querySelector('.container').classList.toggle('invisiblem');
        this.classList.toggle('mif-chevron-right');
        this.classList.toggle('mif-chevron-left');
    });
};