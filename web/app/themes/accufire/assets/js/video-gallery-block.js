


document.addEventListener("DOMContentLoaded", function () {

    let teaserVideo = document.getElementsByClassName('video-gallery__teaser');
    let mainVideo = document.getElementById('video-gallery-main');

    var mainVideoPosition = mainVideo.offsetTop;

    let originalVideoUrl = teaserVideo;
    originalVideoUrl.toString().replace("watch?v=", "embed/");

    let originalMainVideoUrl = document.getElementById('video-gallery-main').getAttribute('src');
    originalMainVideoUrl = originalMainVideoUrl.replace("watch?v=", "embed/");

    mainVideo.setAttribute("src", originalMainVideoUrl);

    
    let clickedVideoUrl = teaserVideo;

    Array.from(clickedVideoUrl).forEach((item) => {
        item.classList.add('testclass');
        console.log("for EACH!!");
        item.querySelector('.video-gallery__teaser-url').addEventListener('click', (e) => {
            e.preventDefault();
            let activeUrl = e.target.innerText.toString().replace('watch?v=', 'embed/');
            console.log("active url is : " + e.target.innerText);
            mainVideo.src = activeUrl;
            console.log("Image url is : " + mainVideo.src + mainVideoPosition);
            document.getElementById('video-gallery-main').scrollIntoView();
        });
    });

    console.log("VIDEO GALLERY BLOCK  ");
});