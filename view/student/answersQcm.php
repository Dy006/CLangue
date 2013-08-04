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

<div id="homework">
    <div class="container">
        <h2 class="section_header">
            <hr class="left visible-desktop">
                <span>
                    Réponses
                </span>
            <hr class="right visible-desktop">
        </h2>
        <div class="row">
            <div class="span12">
                <?php
                foreach ($listQuestions as $question)
                {
                    $numberOfQuestions++;

                    $listAnswer = getAnswersForQuestion($question['id']);

                    echo '</br><div class="well"><h2>' . $question['text'] . '</h2>';

                    $numberAnswer = 0;

                    foreach($listAnswer as $answer)
                    {
                        $numberAnswer++;

                        if($answer['valid'] == 1)
                        {
                            echo '<div><strong>' . $numberAnswer . '. ' . $answer['response'] . '</strong></div>';

                            if($_POST[$question['id']] == $answer['id'])
                            {
                                $return = '</br><p style="color: green;">Bonne réponse : ' . $answer['response'] . '</p>';

                                $score++;
                            }
                        }
                        else
                        {
                            echo '<div>' . $numberAnswer . '. ' . $answer['response'] . '</div>';

                            if($_POST[$question['id']] == $answer['id'])
                            {
                                $return = '</br><p style="color: red;">Mauvaise réponse : ' . $answer['response'] . '</p>';
                            }
                        }
                    }

                    echo $return;

                    echo '</div>';
                }

                $average = calculAverage($score, $numberOfQuestions);
                $level = getLevel($average);
                $globalAverage = getAverageWithScore($homeworkId);

                echo '<br/><div class="row-fluid"><p class="span8">Vous avez eu : ' . $score . '/' . $numberOfQuestions . ', votre moyenne est de : ' . $average . '/20, le niveau est : ' . $level . ', la moyenne générale de ce devoir est : ' . $globalAverage . '/20 </p><div class="pull-right"><a href="index" class="btn">Accueil</a></div></div>'; ?>
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