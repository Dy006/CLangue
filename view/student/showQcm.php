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
                    <li><a href="#" class="scroller" data-section="#home">Accueil</a></li>
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

<div id="subject" class="about_page">
    <div class="container">
        <h2 class="section_header">
            <hr class="left visible-desktop">
            <span>Sujet</span>
            <hr class="right visible-desktop">
        </h2>

        <div class="row">
            <div class="span12">
                <h3 class="intro"><?php echo $subject[2]; ?></h3>
            </div>
            <div class="span12">
                <p><?php echo $subject[3] . 'Par ' . $subject[1]; ?></p>
            </div>
        </div>

        <h2 class="section_header team">
            <hr class="left visible-desktop">
            <span><?php echo $subject[4]; ?></span>
            <hr class="right visible-desktop">
        </h2>

        <div class="row-fluid">
            <?php
            echo '<form action="result/' . $homeworkId . '/' . $subjectId . '" method="post">';

            $numberQuestion = 0;

            foreach ($listQuestions as $question)
            {
                $numberQuestion++;

                echo '<div class="span3 teammate">
                        <h5>' . $numberQuestion . '. ' . $question['text'] . '</h5>
                        <hr>
                        <p class="description">';

                $listAnswers = getAnswersForQuestion($question['id']);

                foreach ($listAnswers as $answer)
                {
                    echo '<input type="radio" value="' . $answer['id'] . '" name="' . $question['id'] . '"> ' . $answer['response'] . '</br></br>';
                }

                echo '</p>
                      </div>';
            }

            echo '<div class="span6 offset5">
                    <input type="submit" class="btn btn-large" value="Send">
                  </div>
                  </form>'; ?>
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