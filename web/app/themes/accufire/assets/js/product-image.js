
document.addEventListener("DOMContentLoaded", function () {
    let mainProductImage = document.getElementById('main-image');
    let clickedImageUrl = document.getElementsByClassName('woocommerce-product-gallery__image');
    Array.from(clickedImageUrl).forEach((button) => {
        button.classList.add('testclass');
        button.querySelector('a').addEventListener('click', (e) => {
            e.preventDefault();
            let activeUrl = e.target.getAttribute('src').toString().replace('-100x100', '');
            console.log("active url is : " + e.target.getAttribute('src'));
            mainProductImage.src = activeUrl;
            console.log("Image url is : " + mainProductImage.src);
        });
    });
});