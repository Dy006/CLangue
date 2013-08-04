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
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">
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
                    <li><a href="#" class="scroller" data-section="#start">Accueil</a></li>
                    <li><a href="#" class="scroller" data-section="#homework">Devoirs</a></li>
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

<div id="intro">
    <div class="container">
        <h1>La simplicité des devoirs.</h1>
    </div>
</div>

<div id="start">
    <div class="container">
        <h2 class="section_header">
            <hr class="left visible-desktop">
            <span>Bien démarrer</span>
            <hr class="right visible-desktop">
        </h2>
        <div class="row">
            <div class="span4 feature">
                <img src="view/student/img/start1.png" alt="start1" class="thumb">
                <h3>Etape 1 : Connection</h3>
                <p class="description">
                    La connection est une étape obligatoire, elle permet de connaitre la personne ayant fait le QCM ou le fichier oral. Les identifiants vous appartenant vous seront donnés par un professeur. Après l'aqcuisition de ceux-ci vous pouvez cliquer sur "Sign In" en haut de la page.
                </p>
            </div>
            <div class="span4 feature">
                <img src="view/student/img/start2.png" alt="start2" class="thumb">
                <h3>Etape 2 : Devoirs</h3>
                <p class="description">
                    Lorsque vous avez achevé la connection, vous êtes redirigés vers la page page principale du site, pour visionner les devoirs vous concernant, vous devez cliquer sur "Homework" en haut de la page, il s'affichera ensuite un tableau avec la liste de vos devoirs ainsi de ceux expirés.
                </p>
            </div>
            <div class="span4 feature">
                <img src="view/student/img/start3.png" alt="start3" class="thumb">
                <h3>Etape 3 : Travailler</h3>
                <p class="description">Il faut que maintenant vous cliquiez sur la devoir vous concernant, il apparaitra ensuite une nouvelle fenêtre avec les consignes, selon le type de travaille vous aurez soit une liste de questions à répondre ou un système d'enregistrement audio.
                </p>
            </div>
        </div>
    </div>
</div>

<div id="homework">
    <div class="container">
        <h2 class="section_header">
            <hr class="left visible-desktop">
                <span>
                    Devoirs
                </span>
            <hr class="right visible-desktop">
        </h2>
        <div class="row-fluid">
            <div class="span12">
                <?php
                if (is_null($listHomeworks))
                {
                    echo '<div class="alert alert-warning" style="text-align:center;"><h4>Vous devez être connecté.</h4></div>';
                }
                else
                {
                    echo '<table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nom du devoir</th>
                		  	        <th>Type</th>
                		  	        <th>Professeur</th>
                		  	        <th>Date de fin</th>
               		 		        <th>Statut</th>
               		 	        </tr>
             		        </thead>
              		        <tbody>';

                    foreach ($listHomeworks as $homework)
                    {
                        $infoScoreUser = getInfoScoreUser($homework['id']);
                        $dispSubject = getDispSubject($homework['subjectId']);

                        if($homework['type'] == 'QCM')
                        {
                            $type = 'QCM';
                        }
                        else
                        {
                            $type = 'ORAL';
                        }

                        if($infoScoreUser != false)
                        {
                            echo '<tr class="success">';
                        }
                        else
                        {
                            echo '<tr>';
                        }

                        echo '<td><a href="' . $type . '/' . $homework['id'] . '/' . $homework['subjectId'] . '">' . $homework['name'] . '</a></td><td>' . $homework['type'] . '</td><td>' . $homework['username'] . '</td><td>'.$homework['dateEnd'].'</td>';

                        $timestamp = DateTime::createFromFormat('!d/m/Y', $homework['dateEnd'])->getTimestamp();

                        if (time() > $timestamp)
                        {
                            echo '<td><span class="label label-important">Expiré</span></td>';
                        }
                        elseif($dispSubject != true)
                        {
                            echo '<td><span class="label label-important">Indisponible</span></td>';
                        }
                        else
                        {
                            echo '<td><span class="label label-success">Disponible</span></td>';
                        }

                        echo '<tr>';
                    }

                    echo '</tbody></table>';
                }?>
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