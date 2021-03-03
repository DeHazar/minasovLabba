<!--TOP NAV-->
<div class="navbar-fixed">
    <nav class="top-nav nav-background">
        <div class="container">
            <div class="nav-wrapper">
                <a href="#" data-activates="mobile-render" class="button-collapse blue-grey-text"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a onclick="goTop(this)">Обо мне</a></li>
                    <li><a href="#skill">Навыки программирования</a></li>
                    <li><a href="#qualification">Обучение</a></li>
                </ul>
                <ul class="side-nav side-nav-cls" id="mobile-render">
                    <li><a onclick="goTop(this)">Обо мне</a></li>
                    <li><a href="#skill">Навыки программирования</a></li>
                    <li><a href="#qualification">Обучение</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="row">
    <div class="col s3 s3-width">
        <!--SIDE NAV-->
        <ul id="slide-out" class="side-nav nav-background fixed responsive-cls">
            <li><div class="user-view">
                    <div class="background">
                        <img src="image/photo_2021-03-03_21-09-56.jpg" class="nav-background-img">
                    </div>
                    <a><span class="user-color-cls name" style="padding-bottom: 100px"><b>Гараев Денис Нагимович СТС-407</b></span></a>
                </div></li>
            <li><a class="subheader"><i class="fa fa-address-card" aria-hidden="true"></i>Как связаться</a></li>
            <li><div class="divider"></div></li>
            <div class="address">
                <p>Гараев Денис Нагимович</p>
                <p>г.УФА УГАТУ ФИРТ СТС-407</p>
                <p>Номер телефона: + 7 (917) 791-48-07</p>
            </div>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
    <div class="col s9 s9-width">
        <div class="slider-margin">
            <?php require_once './masterpage.php'; ?>
        </div>
    </div>
</div>