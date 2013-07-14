<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>HomeWARK - Elève</title>
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

<div id="profile">
    <div class="container">
        <h2 class="section_header">
            <hr class="left visible-desktop">
            <span>Profil</span>
            <hr class="right visible-desktop">
        </h2>
        <div class="row">
            <div class="span12">
                <form class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">Pseudo</label>
                        <div class="controls">
                            <input type="text" class="span4" disabled="" value="<?php echo $_SESSION['user']; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Catégorie</label>
                        <div class="controls">
                            <input type="text" class="span4" disabled="" value="<?php echo $_SESSION['category']; ?>">
                        </div>
                    </div>
                    <?php
                    $tabGroup = $_SESSION['groupName'];
                    $countTab = count($tabGroup);

                    for($i = 0; $i < $countTab; $i++)
                    {
                        $numberGroup = $i + 1;

                        echo '<div class="control-group">
                                <label class="control-label">Groupe n°' . $numberGroup . '</label>
                                <div class="controls">
                                    <input type="text" id="groupName' . $i . ' name="groupName' . $i . ' class="span4" disabled="" value="' . $tabGroup[$i] . '">
                                </div>
                              </div>';
                    }?>
                    <div class="control-group">
                        <label class="control-label">Etablissement</label>
                        <div class="controls">
                            <input type="text" class="span4" disabled="" value="<?php echo $_SESSION['etablishing']; ?>">
                        </div>
                    </div>
                </form>
                </br>
                <?php
                if($resultChangePassword != NULL)
                {
                    echo $resultChangePassword;
                }?>
                <form method="post" action="profile/changepassword" class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">Mot de passe</label>
                        <div class="controls">
                            <input type="password" name="password1" class="span4" placeHolder="Password">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Confirmation du mot de passe</label>
                        <div class="controls">
                            <input type="password" name="password2" class="span4" placeHolder="Confirm Password">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls action">
                            <button type="submit" class="btn">Changer de mot de passe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="footer">
    <div class="container">
        <div class="row">
            <div class="span5">
                HomeWARK par Dylan Delaporte et Guillaume Villena
            </div>
            <div class="pull-right">
                <p>2012 - 2013</p>
            </div>
        </div>
    </div>
</div>

<script src="view/student/js/jquery-latest.js"></script>
<script src="view/student/js/bootstrap.min.js"></script>
<script src="view/student/js/theme.js"></script>
</body>
</html>