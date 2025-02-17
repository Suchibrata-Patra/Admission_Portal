<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Application - Centralised Admission Portal</title>
    <link rel="shortcut icon" href="./icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- <link rel="stylesheet" href="style.css"> -->
     <style>
        @font-face {
    font-family: neu;
    src: url(./NeueHaasDisplayMediu.ttf);
}

@font-face {
    font-family: neu;
    font-weight: 100;
    src: url(./NeueHaasDisplayLight.ttf);
}

@font-face {
    font-family: neu;
    font-weight: 200;
    src: url(./NeueHaasDisplayRoman.ttf);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: neu;
}

html, body {
    height: 100%;
    width: 100%;
}

#main {
    /* background-color: #000; */
    position: relative;
    z-index: 10;
}

#page1 {
    min-height: 100vh;
    width: 100%;
    background-color: #EFEAE3;
    position: relative;
    padding: 0 2vw;
}

nav {
    padding: 2vw 0vw;
    width: 100%;
    /* background-color: red; */
    display: flex;
    align-items: center;
    position: relative;
    z-index: 100;
    justify-content: space-between;
}

#nav-part2 {
    display: flex;
    align-items: center;
    gap: 1vw;
}

#nav-part2 h4 {
    padding: 10px 20px;
    border: 1px solid #0000003c;
    border-radius: 50px;
    font-weight: 500;
    color: #000000bb;
    transition: all ease 0.4s;
    position: relative;
    font-size: 18px;
    overflow: hidden;
}

#nav-part2 h4::after {
    content: "";
    position: absolute;
    height: 100%;
    width: 100%;
    background-color: black;
    left: 0;
    bottom: -100%;
    border-radius: 50%;
    transition: all ease 0.4s;
}

#nav-part2 h4:hover::after {
    bottom: 0;
    border-radius: 0;
}

#nav-part2 h4 a {
    color: #000000bb;
    text-decoration: none;
    position: relative;
    z-index: 9;
}

#nav-part2 h4:hover a {
    color: #fff;
}

nav h3 {
    display: none;
}

#center {
    height: 65vh;
    width: 100%;
    /* background-color: orange; */
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    border-bottom: 1px solid #0000003c;
    padding-bottom: 2.5vw;
}

#left h3 {
    width: 25vw;
    font-size: 1.8vw;
    line-height: 2vw;
}

#center h1 {
    font-size: 10vw;
    text-align: right;
    line-height: 8vw;
}

#page1 video {
    position: relative;
    border-radius: 30px;
    margin-top: 4vw;
    width: 100%;
}

#hero-shape {
    position: absolute;
    width: 46vw;
    height: 36vw;
    right: 0;
    top: 65vh;
}

#hero-1 {
    background-color: #FE320A;
    height: 100%;
    width: 100%;
    border-top-left-radius: 50%;
    border-bottom-left-radius: 50%;
    filter: blur(10px);
    position: absolute;
}

#hero-2 {
    background: linear-gradient(#FE320A, #fe3f0a);

    height: 30vw;
    width: 30vw;
    border-radius: 50%;
    position: absolute;
    animation-name: anime2;
    animation-duration: 5s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    animation-direction: alternate;
    filter: blur(25px);
}

#hero-3 {
    background: linear-gradient(#FE320A, #fe3f0a);
    height: 30vw;
    position: absolute;
    width: 30vw;
    border-radius: 50%;
    filter: blur(25px);
    animation-name: anime1;
    animation-duration: 5s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    animation-direction: alternate;
}

@keyframes anime1 {
    from {
        transform: translate(55%, -3%);
    }

    to {
        transform: translate(0%, 10%);
    }
}

@keyframes anime2 {
    from {
        transform: translate(5%, -5%);
    }

    to {
        transform: translate(-20%, 30%);
    }
}

#page2 {
    min-height: 100vh;
    width: 100%;
    background-color: #EFEAE3;
    padding: 8vw 0;
    position: relative;
}

#moving-text {
    overflow-x: auto;
    white-space: nowrap;
}

#moving-text::-webkit-scrollbar {
    display: none;
}

.con {
    white-space: nowrap;
    display: inline-block;
    animation-name: move;
    animation-duration: 10s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
}

#moving-text h1 {
    font-size: 9vw;
    /* background-color: lightblue; */
    display: inline-block;
}

#gola {
    height: 70px;
    width: 70px;
    border-radius: 50%;
    display: inline-block;
    background-color: #FE320A;
    margin: 1vw 2vw;
}

@keyframes move {
    from {
        transform: translateX(0);
    }

    to {
        transform: translateX(-100%);
    }
}

#page2-bottom {
    height: 80vh;
    width: 100%;
    /* background-color: aliceblue; */
    padding: 4.5vw;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
    z-index: 9;
}

#page2-bottom h1 {
    font-size: 4vw;
    width: 60%;
    line-height: 4vw;
}

#bottom-part2 {
    width: 20%;
    /* background-color: aqua; */
}

#bottom-part2 img {
    width: 100%;
    border-radius: 15px;
}

#bottom-part2 p {
    font-weight: 200;
    margin-top: 2vw;
    font-size: 1vw;
}

#page2 #gooey {
    height: 32vw;
    width: 32vw;
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(to top right, #ff2d03, #ff5c0b);
    /* background: linear-gradient(to top right,red,blue); */


    top: 58%;
    left: 25%;
    filter: blur(20px);
    animation-name: gooey;
    animation-duration: 6s;
    animation-iteration-count: infinite;
    animation-direction: alternate;
    animation-timing-function: ease-in-out;

}

@keyframes gooey {
    from {
        filter: blur(20px);
        transform: translate(10%, -10%) skew(0);
    }

    to {
        filter: blur(30px);
        transform: translate(-10%, 10%) skew(-12deg);
    }
}




#page3 {
    min-height: 100vh;
    width: 100%;
    background-color: #EFEAE3;
    padding: 4vw 0;
}

.elem {
    height: 150px;
    width: 100%;
    position: relative;

    border-bottom: 1px solid #38383864;
    overflow: hidden;
    display: flex;
    align-items: center;
    padding: 0 2vw;
}

.elem h2 {
    font-size: 3vw;
    position: relative;
    z-index: 9;
}

.elem .overlay {
    height: 100%;
    width: 100%;
    background-color: orange;
    position: absolute;
    left: 0;
    top: -100%;
    transition: all ease 0.25s;
}

.elem:hover .overlay {
    top: 0;
}



#fixed-image {
    height: 30vw;
    width: 24vw;
    /* background-color: red; */
    border-radius: 15px;
    position: fixed;
    z-index: 99;
    left: 50%;
    top: 25%;
    display: none;
    background-size: cover;
    background-position: center;
}

#page4 {
    height: 70vh;
    width: 100%;
    background-color: #EFEAE3;
    padding: 10vw 2vw;
}

.swiper {
    width: 100%;
    height: 100%;
}

.swiper-slide {
    width: 30%;
    border-left: 1px solid #aeadad;
    padding: 0 2vw;
}

#page5 {
    height: 100vh;
    width: 100%;
    /* background-color: #EFEAE3; */
}

#footer {
    position: fixed;
    height: 105vh;
    width: 100%;
    background-color: #000;
    color: #fff;
    z-index: 9;
    bottom: 0;
    display: flex;
    /* align-items: flex-end; */
    justify-content: flex-end;
    flex-direction: column;
    padding: 1vw 3vw;
}

#footer h1 {
    font-size: 23vw;
}

#footer-div {
    height: 20vh;
    width: 100%;
    background-color: red;
}

#footer-bottom {
    border-top: 1px solid #dadada;
    height: 10vh;
    width: 100%;
}

#full-scr {
    height: 100vh;
    width: 100%;
    background-color: #00000070;
    position: fixed;
    z-index: 99;
    top: -100%;
    transition: all ease 0.5s;
}

#full-div1 {
    height: 50%;
    width: 100%;
    background-color: #EFEAE3;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;

}

@media (max-width:600px) {

    #page1 {
        min-height: 100vh;
        width: 100vw;
        padding: 0 0vw;
    }

    nav {
        padding: 8vw 5vw;
        background-color: #EFEAE3;
        /* padding: 0 5vw; */
    }

    nav img {
        transition: all ease 0.2s;
        height: 9vh;
    }

    #nav-part2 {
        display: none;
    }

    nav h3 {
        display: block;
        padding: 3vw 5vw;
        border: 1px solid #ababab;
        border-radius: 50px;
        font-size: 4vw;
        font-weight: 200;
        padding-left: 10vw;
    }

    #center {
        height: 62vh;
        width: 100%;
        /* background-color: orange; */
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        border-bottom: 1px solid #0000003c;
        padding: 7vw 5vw;
        padding-bottom: 10vw;
        flex-direction: column-reverse;
        position: relative;
        z-index: 9;
    }

    #left h3 {
        width: 80%;
        font-size: 5.5vw;
        line-height: 6vw;
    }

    #center h1 {
        font-size: 17vw;
        text-align: right;
        line-height: 15vw;
    }

    #page1 video {
        position: relative;
        border-radius: 15px;
        margin-top: 4vw;
        height: 70vh;
        object-fit: cover;
        object-position: center;
        width: 92%;
        margin-left: 4%;
    }

    #page2 {
        min-height: 100vh;
        width: 100%;
        background-color: #EFEAE3;
        padding: 8vw 0;
        position: relative;
    }

    #moving-text {
        overflow-x: auto;
        white-space: nowrap;
    }

    #moving-text::-webkit-scrollbar {
        display: none;
    }

    .con {
        white-space: nowrap;
        display: inline-block;
        animation-name: move;
        animation-duration: 10s;
        animation-timing-function: linear;
        animation-iteration-count: infinite;
    }

    #moving-text h1 {
        font-size: 15vw;
        /* background-color: lightblue; */
        display: inline-block;
    }

    #gola {
        height: 25px;
        width: 25px;
        border-radius: 50%;
        display: inline-block;
        background-color: #FE320A;
        margin: 2vw 2vw;
    }

    #page2-bottom {
        height: 90vh;
        width: 100%;
        /* background-color: aliceblue; */
        padding: 10vw 4vw;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        position: relative;
        flex-direction: column;
        z-index: 9;
    }

    #page2-bottom h1 {
        font-size: 8.2vw;
        width: 100%;
        line-height: 9vw;
    }

    #bottom-part2 {
        width: 70%;
        /* background-color: aqua; */
    }

    #bottom-part2 img {
        width: 100%;
        border-radius: 10px;
    }

    #bottom-part2 p {
        font-weight: 200;
        margin-top: 2vw;
        font-size: 3vw;
    }

    #page2 #gooey {
        height: 62vw;
        width: 62vw;
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(to top right, #ff2d03, #ff5c0b);
        /* background: linear-gradient(to top right,red,blue); */


        top: 58%;
        left: 25%;
        filter: blur(20px);
        animation-name: gooey;
        animation-duration: 6s;
        animation-iteration-count: infinite;
        animation-direction: alternate;
        animation-timing-function: ease-in-out;

    }


}

#loader{
    height: 100%;
    width: 100%;
    background-color: #000;
    position: fixed;
    z-index: 999;
    top: 0;
    transition: all ease 0.7s;
    display: flex;
    align-items: center;
    justify-content: center;
}

#loader h1{
    font-size: 4vw;
    color: transparent;
    background: linear-gradient(to right,orange,orangered);
    -webkit-background-clip: text;
    position: absolute;
    opacity: 0;
    animation-name: load;
    animation-duration: 1s;
    animation-delay: 1s;
    animation-timing-function: linear;
}
#loader h1:nth-child(2){
    animation-delay: 2s;
}
#loader h1:nth-child(3){
    animation-delay: 3s;
}

@keyframes load {
    0%{
        opacity: 0;
    }
    10%{
        opacity: 1;
    }
    90%{
        opacity: 1;
    }
    100%{
        opacity: 0;
    }
}

@media (max-width:600px) {
    #loader h1{
        font-size: 9vw;
      
    }
}
     </style>
</head>

<body>
    <div id="loader">
        <h1>Integrated</h1>
        <h1>Admission</h1>
        <h1>Portal</h1>
    </div>
    <div id="fixed-image">

    </div>
    <div id="main">

        <div id="page1">
            <nav>
                <img src="https://trip-admin.000webhostapp.com/Assets/images/stopped_admission.png" style="width:50px;height:auto;"
                    alt="Haggle Studio">
                <div id="nav-part2">

                </div>
                <h3>Menu</h3>
            </nav>
            <div id="center">
                <div id="left">
                    <h3>TheApplication is a multi-disciplinary Software-studio focused on creating unique, end-to-end User Applications.
                    </h3>
                </div>
                <div id="right">
                    <h1>Code <br>
                        That Inspire <br><br>
                    </h1>
                    
                </div>

            </div>
            <div id="hero-shape">
                <div id="hero-1"></div>
                <div id="hero-2"></div>
                <div id="hero-3"></div>
            </div>
            <video autoplay loop muted src="./video.mp4"></video>
        </div>
        <div id="page2">
            <div id="moving-text">
                <div class="con">
                    <h1>UI UX</h1>
                    <div id="gola"></div>
                    <h1>CODE</h1>
                    <div id="gola"></div>
                    <h1>APPLICATIONS</h1>
                    <div id="gola"></div>
                </div>
                <div class="con">
                    <h1>UI UX</h1>
                    <div id="gola"></div>
                    <h1>CODE</h1>
                    <div id="gola"></div>
                    <h1>APPLICATIONS</h1>
                    <div id="gola"></div>
                </div>
                <div class="con">
                    <h1>UI UX</h1>
                    <div id="gola"></div>
                    <h1>CODE</h1>
                    <div id="gola"></div>
                    <h1>APPLICATIONS</h1>
                    <div id="gola"></div>
                </div>
            </div>
            <div id="page2-bottom">
                <h1>We are a group of design- driven, goal-focused Coders, and designers who
                    believe that the Precision  make all the difference.</h1>
                <div id="bottom-part2">
                    <img src="https://uploads-ssl.webflow.com/64d3dd9edfb41666c35b15b7/64d3dd9edfb41666c35b15d1_Holding_thumb-p-500.jpg"
                        alt="">
                    <p>We love to create, we love to solve, we love to collaborate, and we love to turn amazing ideas
                        into reality. We are here to partner with you through every step of the Institutions Admission process and know that
                        relationships are the most important things we build.</p>
                </div>
            </div>
            <div id="gooey">

            </div>
        </div>
        <div id="page3">
            <div id="elem-container">
                <div id="elem1" class="elem"
                    data-image="https://images.unsplash.com/photo-1701001308648-7b731a52b8d7?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwxNHx8fGVufDB8fHx8fA%3D%3D">
                    <div class="overlay"></div>
                    <h2>Makers Studio HOI</h2>
                </div>
                <div class="elem"
                    data-image="https://images.unsplash.com/photo-1700975928909-da4a46227a47?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0fHx8ZW58MHx8fHx8">
                    <div class="overlay"></div>
                    <h2>50th Anniversary</h2>
                </div>
                <div class="elem"
                    data-image="https://images.unsplash.com/photo-1701077137611-9be394bf62f0?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyMHx8fGVufDB8fHx8fA%3D%3D">
                    <div class="overlay"></div>
                    <h2>NYFW Popup</h2>
                </div>
                <div class="elem"
                    data-image="https://images.unsplash.com/photo-1701014159309-4a8b84faadfe?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwxOXx8fGVufDB8fHx8fA%3D%3D">
                    <div class="overlay"></div>
                    <h2>Air Force 1 2021</h2>
                </div>
                <div class="elem"
                    data-image="https://images.unsplash.com/photo-1700924546093-f914fd5b8814?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyOHx8fGVufDB8fHx8fA%3D%3D">
                    <div class="overlay"></div>
                    <h2>SOHO NYC</h2>
                </div>
                <div class="elem"
                    data-image="https://images.unsplash.com/photo-1700601437860-e66da79cf6d2?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw1OXx8fGVufDB8fHx8fA%3D%3D">
                    <div class="overlay"></div>
                    <h2>SOHO 2023</h2>
                </div>
                <div class="elem"
                    data-image="https://images.unsplash.com/photo-1700769025506-6c3dcb9ec9b7?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw2OXx8fGVufDB8fHx8fA%3D%3D">
                    <div class="overlay"></div>
                    <h2>Play New Kidvision</h2>
                </div>
            </div>
        </div>
        <div id="page4">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">Slide 1</div>
                    <div class="swiper-slide">Slide 2</div>
                    <div class="swiper-slide">Slide 3</div>
                    <div class="swiper-slide">Slide 4</div>
                    <div class="swiper-slide">Slide 5</div>
                    <div class="swiper-slide">Slide 6</div>
                    <div class="swiper-slide">Slide 7</div>
                </div>

            </div>
        </div>
        <div id="page5">

        </div>
        <div id="full-scr">
            <div id="full-div1">
                
            </div>
        </div>
    </div>
    <div id="footer">
        <div id="footer-div">

        </div>
        <h1>Haggle Inc.</h1>
        <div id="footer-bottom">

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- <script src="script.js"></script> -->
     <script>
        const scroll = new LocomotiveScroll({
    el: document.querySelector('#main'),
    smooth: true
});


function page4Animation() {
    var elemC = document.querySelector("#elem-container")
    var fixed = document.querySelector("#fixed-image")
    elemC.addEventListener("mouseenter", function () {
        fixed.style.display = "block"
    })
    elemC.addEventListener("mouseleave", function () {
        fixed.style.display = "none"
    })

    var elems = document.querySelectorAll(".elem")
    elems.forEach(function (e) {
        e.addEventListener("mouseenter", function () {
            var image = e.getAttribute("data-image")
            fixed.style.backgroundImage = `url(${image})`
        })
    })
}

function swiperAnimation() {
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: "auto",
        centeredSlides: true,
        spaceBetween: 100,
    });
}
function menuAnimation() {

    var menu = document.querySelector("nav h3")
    var full = document.querySelector("#full-scr")
    var navimg = document.querySelector("nav img")
    var flag = 0
    menu.addEventListener("click", function () {
        if (flag == 0) {
            full.style.top = 0
            navimg.style.opacity = 0
            flag = 1
        } else {
            full.style.top = "-100%"
            navimg.style.opacity = 1
            flag = 0
        }
    })
}

function loaderAnimation() {
    var loader = document.querySelector("#loader")
    setTimeout(function () {
        loader.style.top = "-100%"
    }, 4200)
}

swiperAnimation()
page4Animation()
menuAnimation()
loaderAnimation()
     </script>
</body>

</html>