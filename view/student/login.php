<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>HomeWARK - Elève</title>
    <base href="http://pox.alwaysdata.net/other/tutorials/workclasslangue/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="view/student/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="view/student/css/signin.css">
    <link rel="stylesheet" type="text/css" href="view/student/css/theme.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
</head>
<body>
<a href="#" class="scrolltop">
    <span>up</span>
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
                <img src="view/student/img/logo.png" alt="logo"/>
            </a>
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <li><a href="index" class="scroller" data-section="#home">Accueil</a></li>
                    <li><a href="index" class="scroller" data-section="#homework">Devoirs</a></li>
                    <li><a href="profile">Profil</a></li>
                    <li><a href="faq">FAQ</a></li>
                    <li><a class="btn-header" href="login">Connexion</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="box_login">
    <div class="container">
        <div class="span12 box_wrapper">
            <div class="span12 box">
                <div>
                    <div class="head">
                        <h4>Entrez vos identifiants</h4>
                    </div>
                    <div class="form">
                        <form method="post" action="">
                            <?php
                            if($resultLogin != NULL)
                            {
                                echo $resultLogin;
                            }?>
                            <input type="text" name="username" id="username" placeholder="Pseudo" value="<?php echo $_POST['username']; ?>"/>
                            <input type="password" name="password" id="password" placeholder="Mot de passe"/>

                            <select name="etablishing" id="etablishing">
                                <?php
                                foreach($listEtablishings as $etablishing)
                                {
                                    echo '<option>' . $etablishing['name'] . '</option>';
                                }?>
                            </select>

                            <div class="remember">
                                <div class="left">
                                    <input id="remember_me" type="checkbox">
                                    <label for="remember_me">Se rappeler de moi</label>
                                </div>
                                <div class="right">
                                    <a href="forgotpassword">Mot de passe oublié ?</a>
                                </div>
                            </div>
                            <input type="submit" class="btn" value="Connexion">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="view/student/js/jquery-latest.js"></script>
<script src="view/student/js/bootstrap.min.js"></script>
<script src="view/student/js/theme.js"></script>
</body>
</html>