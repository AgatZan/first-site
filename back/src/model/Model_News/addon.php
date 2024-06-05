<?php
namespace Model_News;
function addon_create_hp($title, $text, $page, $isnew = false){
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
            <h1>$title</h1>
            <section class="news__text">
                $text
            </section>
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

    $f= fopen($page, 'w');
    if (!$isnew && file_exists($page)|| !$f || fwrite($f, $html) === FALSE) {
        die(json_encode(['err'=>'Error creating the file']));
    }
}