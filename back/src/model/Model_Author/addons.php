<?php
namespace Model_Author;
function addon_create_album($page_name, $album_id, $album_cover, $album_name){
    return <<<EOF
    <div class="album-container">
        <a href="/author/$page_name/$album_id" class="album-container__link">
            <div class="art"><img src="../../media/images/albums/$album_cover" alt=""></div>
            <p class="title">$album_name</p>
        </a>
    </div>
    EOF;
}
function addon_create_disc($page_name, $album_id, $album_cover, $album_name, $release){
    return <<<EOF
    <li>
        <div class="discography__image-container"><a href="/author/$page_name/$album_id"><img src="../../media/images/albums/$album_cover" alt="A"></a></div>
        <div class="discography__album-title"><a href="/author/$page_name/$album_id"><span class="table-song__song-name">$album_name</span></a></div>
        <div class="discography__year album-page__secondary-text">$release</div>
    </li>
    EOF;
}
function addon_create_tag($tag_name){
    return <<<EOF
    <a href="" class="tag album-page__secondary-text">$tag_name</a>
    EOF;
}
function addon_create_hp($user_name, $user_page, $isnew=false){
    $html = <<<EOF
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/static/css/album-style.min.css">
        <link rel="icon" type="image/x-icon" href="/media/images/Favicon.ico">
        <title>M store</title>
    </head>
    <body>
        <header class="header" id="header">
            <div class="top-panel">
                <div class="social">
                    <a href="https://www.facebook.com" class="facebook"></a>
                    <a href="https://dribbble.com" class="drible"></a> 
                    <a href="https://twitter.com" class="twitter"></a>
                    <a href="mailto:tinderbox@foo.invalid" class="mail"></a>
                    <a href="https://vimeo.com" class="vimeo"></a>
                </div>
                <div class="registration-panel">
                    <dialog id="logDialog">
                        <form method="dialog">
                            <fieldset>
                                <label for="log-log">Login: </label>
                                    <input id="log-log" type="text" required>
                            </fieldset>
                            <fieldset>
                                <label for="log-pass">Password: </label>
                                    <input id="log-pass" type="password" required>
                            </fieldset>
                            <button type="submit">Log in</button>
                            <button class="close" onclick="logDialog.close()">Close</button>
                        </form>
                    </dialog>
                    <dialog id="regDialog">
                        <form method="dialog">
                            <fieldset>
                                <label for="login">Login: </label>
                                <input id="login" type="text" placeholder="Alini" required>
                            </fieldset>
                            <fieldset>
                                <label for="email">Email: </label>
                                <input id="email" type="email" placeholder="exemaple@mail" pattern="/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i" required>
                            </fieldset>
                            <fieldset>
                                <label for="pass">Password: </label>
                                <input id="pass" type="password" placeholder="123456" required>
                            </fieldset>
                            <fieldset>
                                <label for="cpass">Confirm Password: </label>
                                <input id="cpass" type="password"  required>
                            </fieldset>
                            <button type="submit">Sign up</button>
                            <button class="close" onclick="regDialog.close()">Close</button>
                        </form>
                    </dialog>
                    <a href="#" class="registration-panel__login" onclick="logDialog.showModal()">Login</a>
                    <a href="#" class="registration-panel__register" onclick="regDialog.showModal()">Register</a>
                   
    
                    <div class="basket">
                        <a href="#drop-down" class="basket__goods">
                            <p>Cart</p>
                        </a>                     
                        <div id="drop-down" class="drop-down-menu">
                            <div class="basket__albums">     
                            </div>
                            <div class="drop-down-menu__total-price">
                                <div class="drop-down-menu__total-cost-text">Total delivery cost: </div>
                                <div class="drop-down-menu__total-cost-value album-card__price_price-type_dollar">42,58</div>
                            </div>
                            <div class="drop-down-menu__user-choose">
                                <a href="" class="drop-down-menu__view styled-text_grey-border">View Card</a>
                                <a href="" class="drop-down-menu__checkout styled-text_grey-border">Proceed to Checkout</a></div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="sub-panel">
                <a href="../../index.html" class="header__logo">
                    <img id="logo" src="../../media/images/logo.png" alt="logo" class="header__logo-image" > <!--srcset="../../media/images/logo.svg" -->
                    <span class="header__logo-decore">M</span>
                    <span class="header__logo-title">Store</span>
                </a>    
                <nav class="navigation">
                    <div class="navigation__elements"><a href="../../index.html">HOME        </a></div>
                    <div class="navigation__elements"><a href="../../cd.html">CD's        </a></div>
                    <div class="navigation__elements"><a href="../../charts.html">CHARTS      </a></div>
                    <div class="navigation__elements"><a href="../../collection.html">COLLECTION's</a></div>
    
                </nav>
            </div>
        </header>
    
    
         <section class="main">
            <div class="album-page">
                <div class="album-page__header">
                    <div class="album-page__cover-container">
                        <img src="https://kartinkin.net/uploads/posts/2022-12/1670585830_kartinkin-net-p-estetichnie-golubie-kartinki-vkontakte-8.jpg" alt="header" class="main__cover">
                    </div>
                    <nav class="album-page__navigation">
                        <div><a href="" class="album-page__nav-lin active">Music</a></div>
                        <div><a href="" class="album-page__nav-lin">Community</a></div>
                    </nav>
                </div>
    
                <div class="album-page__main-container album-page__main-container_list-album">
                </div>
    
                <div class="bio-container">
                    <div class="bio-container__picture">
                        <a href="">
                            <img src="https://avatars.yandex.net/get-music-content/2808981/6fc13b90.a.11855616-1/m1000x1000?webp=false" alt="artist image" class="bio-container__image">
                        </a>
                    </div>
                    <div class="bio-container__art-info">
                        <div class="artist">$user_name</div>
                        <div class="location album-page__secondary-text">Moscow</div>
                    </div>
                    <div class="bio-contianer__follow-panel">
                        <button class="fol-unfol" type="button"><span>Follow</span></button>
                    </div>
                    <div class="bio-container__text-block">
                        <p class="bio-container__text">
                            text text text text text text
                        </p>
                    </div>
                    <ul class="bio-container__band-link">
                        <li>
                            <a href="http://soundcloud.com" target="_blank">SoundCloud</a>
                        </li>
                        <li>
                            <a href="https://archive.org/" target="_blank">archieve.org</a>
                        </li>
                        <li>
                            <a href="https://funkwhale.audio/" target="_blank">Funkwhale</a>
                        </li>
                    </ul>
                    <div class="discography">
                        <h3 class="discography__title"><a href="" class="discography__link-dusc album-page__primary-text">Discography</a></h3>
                            <ul class="discography__discos">
                            </ul>
                            <div class="discography__show-more">
                                <a href="/author/$user_page">more releases...</a>
                            </div>
                        
                    </div>
                </div>
            
            </div>
            <div class="album-page__tag-block">
                <h3 class="Tag-label">Tag</h3>
                <div class="album-page__tags"></div>
            </div>
            
        </section>
        <div class="lover-info">
            <ul class="lover-info__menu-list">
                <li class="lover-info__element-list"><a href="index.html" class="lover-info__menu-link">Home</a></li>
                <li class="lover-info__element-list"><a href="#" class="lover-info__menu-link">Portfolio</a></li>
                <li class="lover-info__element-list"><a href="#" class="lover-info__menu-link">Sitemap</a></li>
                <li class="lover-info__element-list"><a href="#" class="lover-info__menu-link">Contact</a></li>
            </ul>
            <p class="lover-info__copyright-block">Musica @2013 by PremiumCoding | All Rights Reserved</p>
        </div>
    </body>
    </html>
    EOF;

    $f= fopen($user_page, 'w');
    if (!$isnew&&file_exists($user_page)|| !$f || fwrite($f, $html) === FALSE) {
        die(json_encode(['err'=>'Error creating the file']));
    }
    
}