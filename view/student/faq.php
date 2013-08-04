<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CLangue - Elève</title>
    <base href="http://pox.alwaysdata.net/other/tutorials/workclasslangue/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="view/student/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="view/student/css/theme.css">
    <link rel="stylesheet" type="text/css" href="view/student/css/animate.css">
    <link rel="stylesheet" type="text/css" href="view/student/css/external-pages.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
</head>
<body>
<a href="#" class="scrolltop">
    <span>Haut</span>
</a>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand scroller" data-section="body" href="index">
                <img src="view/student/img/clangue.png" alt="logo"/>
            </a>
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <li><a href="index">Accueil</a></li>
                    <li><a href="index#homework">Devoirs</a></li>
                    <li><a href="profile">Profil</a></li>
                    <li><a href="faq">FAQ</a></li>
                    <?php
                    if($_SESSION['user'] != NULL)
                    {
                        echo '<li><a class="btn-header" href="logout">Déconnexion</a></li>';
                    }
                    else
                    {
                        echo '<li><a class="btn-header" href="login">Connexion</a></li>';
                    }?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="faq" class="faq_page">
    <div class="container">
        <!-- header -->
        <h2 class="section_header">
            <hr class="left visible-desktop">
            <span>FAQ</span>
            <hr class="right visible-desktop">
        </h2>

        <!-- list -->
        <div class="row">
            <div class="span12">
                <div class="faq">
                    <div class="number">1</div>
                    <div class="question">
                        There are many variatons of passages from Lorem Ipsum available?
                    </div>
                    <div class="answer">
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                        <br><br>
                        All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
                        Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius
                    </div>
                </div>
                <div class="faq">
                    <div class="number">2</div>
                    <div class="question">
                        Majority have suffered alteration in some form injected humour these randomised?
                    </div>
                    <div class="answer">
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                        <br><br>
                        All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
                        Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius
                    </div>
                </div>
                <div class="faq">
                    <div class="number">3</div>
                    <div class="question">
                        Injected humour these randomised words which don't look even slightly believable?
                    </div>
                    <div class="answer">
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                        <br><br>
                        All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
                        Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius
                    </div>
                </div>
                <div class="faq">
                    <div class="number">4</div>
                    <div class="question">
                        It has survived not only five centuries, but also the leap into electronic typesetting?
                    </div>
                    <div class="answer">
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                        <br><br>
                        All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
                        Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius
                    </div>
                </div>
                <div class="faq">
                    <div class="number">5</div>
                    <div class="question">
                        There are many variatons of passages from Lorem Ipsum available?
                    </div>
                    <div class="answer">
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                        <br><br>
                        All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
                        Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius
                    </div>
                </div>
                <div class="faq">
                    <div class="number">6</div>
                    <div class="question">
                        Majority have suffered alteration in some form injected humour these randomised?
                    </div>
                    <div class="answer">
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                        <br><br>
                        All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
                        Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius
                    </div>
                </div>
                <div class="faq">
                    <div class="number">7</div>
                    <div class="question">
                        Injected humour these randomised words which don't look even slightly believable alteration form injected humour?
                    </div>
                    <div class="answer">
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                        <br><br>
                        All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
                        Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius
                    </div>
                </div>
                <div class="faq">
                    <div class="number">8</div>
                    <div class="question">
                        There are many variatons of passages from Lorem Ipsum available?
                    </div>
                    <div class="answer">
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                        <br><br>
                        All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
                        Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius
                    </div>
                </div>
                <div class="faq">
                    <div class="number">9</div>
                    <div class="question">
                        It has survived not only five centuries, but also the leap into electronic typesetting?
                    </div>
                    <div class="answer">
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                        <br><br>
                        All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
                        Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius
                    </div>
                </div>
                <div class="faq">
                    <div class="number">10</div>
                    <div class="question">
                        There are many variatons of passages from Lorem Ipsum available?
                    </div>
                    <div class="answer">
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                        <br><br>
                        All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
                        Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="footer">
    <div class="container">
        <div class="row">
            <div class="span5">
                CLangue par Dylan Delaporte et Guillaume Villena
            </div>
            <div class="pull-right">
                <p>2013</p>
            </div>
        </div>
    </div>
</div>

<script src="view/student/js/jquery-latest.js"></script>
<script src="view/student/js/bootstrap.min.js"></script>
<script src="view/student/js/theme.js"></script>
</body>
</html>