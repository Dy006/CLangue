<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>HomeWARK - Admin</title>

    <base href="http://pox.alwaysdata.net/other/tutorials/workclasslangue/"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="view/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="view/admin/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="view/admin/css/style.min.css" rel="stylesheet">
    <link href="view/admin/css/style-responsive.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link id="ie-style" href="view/admin/css/ie.css" rel="stylesheet">
    <![endif]-->

    <!--[if IE 9]>
    <link id="ie9style" href="view/admin/css/ie9.css" rel="stylesheet">
    <![endif]-->

    <script type="text/javascript">
        function addQuestion()
        {
            var numberQuestion = parseInt(document.getElementById('numberQuestions').value) + 1;

            document.getElementById('qcmQuestions').innerHTML += '<div id="controlQuestion_' + numberQuestion + '" class="control-group"><label class="control-label">Question n°' + numberQuestion + '</label><div class="controls"><input type="text" onchange="saveInputValue(\'inputQuestion_' + numberQuestion + '\');" id="inputQuestion_' + numberQuestion + '" name="inputQuestion_' + numberQuestion + '"><div id="answers_' + numberQuestion + '"><div id="divAnswer' + numberQuestion + '_1" style="margin-top: 6px;">Réponse n°1 : <input type="text" id="inputAnswer' + numberQuestion + '_1" onchange="saveInputValue(\'inputAnswer' + numberQuestion + '_1\');" name="inputAnswer' + numberQuestion + '_1"><input type="radio" id="radioAnswer' + numberQuestion + '_1" name="radioAnswer' + numberQuestion + '" value="inputAnswer' + numberQuestion + '_1" checked="" style="margin-left: 4px;"></div><div id="divAnswer' + numberQuestion + '_2" style="margin-top: 6px;">Réponse n°2 : <input type="text" id="inputAnswer' + numberQuestion + '_2" onchange="saveInputValue(\'inputAnswer' + numberQuestion + '_2\');" name="inputAnswer' + numberQuestion + '_2"><input type="radio" id="radioAnswer' + numberQuestion + '_2" name="radioAnswer' + numberQuestion + '" value="inputAnswer' + numberQuestion + '_2" style="margin-left: 4px;"></div></div><div class="btn-group" style="margin-top: 6px;"><button type="button" onclick="addAnswer(' + numberQuestion + ');" class="btn"><i class="icon icon-plus"></i></button><button type="button" onclick="deleteAnswer(' + numberQuestion + ');" class="btn btn-danger"><i class="icon icon-remove"></i></button></div><input type="hidden" id="numberAnswers_' + numberQuestion + '" value="2" name="numberAnswers_' + numberQuestion + '"></div>';
            document.getElementById('numberQuestions').value = numberQuestion;
        }

        function addAnswer(questionId)
        {
            var numberAnswer = parseInt(document.getElementById('numberAnswers_' + questionId).value) + 1;

            document.getElementById('answers_' + questionId).innerHTML += '<div id="divAnswer' + questionId + '_' + numberAnswer + '" style="margin-top: 6px;">Réponse n°' + numberAnswer + ' : <input type="text" onchange="saveInputValue(\'inputAnswer' + questionId + '_' + numberAnswer + '\');" id="inputAnswer' + questionId + '_' + numberAnswer + '"  name="inputAnswer' + questionId + '_' + numberAnswer + '"><input type="radio" id="radioAnswer' + questionId + '_' + numberAnswer + '" name="radioAnswer' + questionId + '" value="inputAnswer' + questionId + '_' + numberAnswer + '" style="margin-left: 4px;"></div>';
            document.getElementById('numberAnswers_' + questionId).value = numberAnswer;
        }

        function deleteAnswer(questionId)
        {
            var numberAnswer = parseInt(document.getElementById('numberAnswers_' + questionId).value);

            if(numberAnswer > 2)
            {
                var parent = document.getElementById('answers_' + questionId);
                var object = document.getElementById('divAnswer' + questionId + '_' + numberAnswer);

                parent.removeChild(object);

                var changeNumberAnswer = numberAnswer - 1;

                document.getElementById('numberAnswers_' + questionId).value = changeNumberAnswer;
            }
        }

        function saveInputValue(inputId)
        {
            var inputValue = document.getElementById(inputId).value;

            document.getElementById(inputId).setAttribute('value', inputValue);
        }

        function showDivSelect()
        {
            var selectValue = document.getElementById('typeWorkSelect').options[document.getElementById('typeWorkSelect').selectedIndex].value;

            console.log(selectValue);
            console.log('select');

            if(selectValue == 'QCM')
            {
                document.getElementById('oralfile').style.display = 'none';
                document.getElementById('qcm').style.display = '';
            }
            else
            {
                document.getElementById('qcm').style.display = 'none';
                document.getElementById('oralfile').style.display = '';
            }
        }
    </script>
</head>

<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#"><img src="view/admin/img/logo.png" alt="" style="height: 25px;margin-left: 10px;"></a>

            <div class="nav-no-collapse header-nav">
                <ul class="nav pull-right">
                    <li class="dropdown hidden-phone">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="halflings-icon white tasks"></i>
                        </a>
                        <ul class="dropdown-menu tasks">
                            <li>
                                <span class="dropdown-menu-title">Vous avez <?php echo $countSubjects; ?> travail(s)</span>
                            </li>
                            <?php
                            foreach($listSubjects as $subject)
                            {
                                $percent = getPercentScoreSubject($subject['id']);

                                echo '<li>
                                        <a href="' . $subject['id'] . '">
										    <span class="header">
											    <span class="title">' . $subject['name'] . '</span>
											    <span class="percent"></span>
										    </span>
                                            <div class="taskProgress progressSlim progressBlue">' . $percent . '</div>
                                        </a>
                                      </li>';
                            }?>
                            <li>
                                <a href="admin/work">Voir tout les travails</a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown hidden-phone">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="halflings-icon white envelope"></i>
                        </a>
                        <ul class="dropdown-menu messages">
                            <li>
                                <span class="dropdown-menu-title">Vous avez <?php echo $countMessages; ?> message(s)</span>
                            </li>
                            <?php
                            foreach($listMessages as $message)
                            {
                                echo '<li>
                                        <a href="admin/message/' . $message['id'] . '">
										    <span class="header">
											    <span class="from">
										    	    ' . $message['sender'] . '
										        </span>
											    <span class="time">
										    	    ' . $message['date'] . '
										        </span>
										    </span>
                                            <span class="message">
                                                ' . $message['object'] . '
                                            </span>
                                        </a>
                                      </li>';
                            }?>
                            <li>
                                <a href="admin/message" class="dropdown-menu-sub-footer">Voir tout les messages</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="btn">
                            <i class="halflings-icon white user"></i> <?php echo $_SESSION['user']; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
<div class="row-fluid">
<div id="sidebar-left" class="span1">
    <div class="nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <li><a href="admin"><i class="fa-icon-bar-chart"></i><span class="hidden-tablet"> Acceuil</span></a></li>
            <li><a href="admin/addwork"><i class="fa-icon-edit"></i><span class="hidden-tablet"> Ajouter un travail</span></a></li>
            <li class="active"><a href="admin/work"><i class="fa-icon-align-justify"></i><span class="hidden-tablet"> Travails</span></a></li>
            <li><a href="admin/group"><i class="fa-icon-tasks"></i><span class="hidden-tablet"> Groupes</span></a></li>
            <li><a href="admin/message"><i class="fa-icon-envelope"></i><span class="hidden-tablet"> Messages</span></a></li>
            <li><a href="admin/profile"><i class="fa-icon-user"></i><span class="hidden-tablet"> Profil</span></a></li>
            <li><a href="admin/logout"><i class="fa-icon-lock"></i><span class="hidden-tablet"> Déconnexion</span></a></li>
        </ul>
    </div>
</div>
<a id="main-menu-toggle" class="hidden-phone open"><i class="fa-icon-reorder"></i></a>

        <div id="content" class="span11">
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2><i class="halflings-icon edit"></i><span class="break"></span>Editer un travail</h2>
                    </div>
                    <div class="box-content">
                        <form method="post" action="admin/work/edit/save" class="form-horizontal">
                            <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id">
                            <div class="control-group">
                                <label class="control-label">Nom</label>
                                <div class="controls">
                                    <input type="text" name="name" class="disabled" placeHolder="<?php echo $infoSubject[2] ?>" disabled=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Enoncé</label>
                                <div class="controls">
                                    <textarea name="enonce"><?php echo $infoSubject[3] ?></textarea>
                                </div>
                            </div>
                            <?php
                            if($infoSubject[4] == 'QCM')
                            {
                                echo '<input type="hidden" name="type" value="QCM">
                                      <div id="qcmQuestions">';

                                $numberQuestion = 0;

                                foreach ($questions as $question)
                                {
                                    $numberQuestion++;

                                    echo '<div id="controlQuestion_' . $numberQuestion . '" class="control-group">
                                            <label class="control-label">Question n°' . $numberQuestion . '</label>
                                            <div class="controls">
                                                <input type="text" onchange="saveInputValue(\'inputQuestion_' . $numberQuestion . '\');" id="inputQuestion_' . $numberQuestion . '" name="inputQuestion_' . $numberQuestion . '" value="' . $question['text'] . '"><br>
                                                <div id="answers_' . $numberQuestion . '">';

                                    $answers = getAnswersForQuestion($question['id']);

                                    $numberAnswer = 0;

                                    foreach ($answers as $answer)
                                    {
                                        $numberAnswer++;

                                        echo '<div id="divAnswer' . $numberQuestion . '_' . $numberAnswer . '" style="margin-top: 6px;">Réponse n°' . $numberAnswer . ' : <input type="text" onchange="saveInputValue(\'inputAnswer' . $numberQuestion . '_' . $numberAnswer . '\');" id="inputAnswer' . $numberQuestion . '_' . $numberAnswer . '" name="inputAnswer' . $numberQuestion . '_' . $numberAnswer . '" value="' . $answer['response'] . '">';

                                        if ($answer['valid'] == 1)
                                        {
                                            echo '<input type="radio" id="radioAnswer' . $numberQuestion . '_' . $numberAnswer . '" name="radioAnswer' . $numberQuestion . '" value="inputAnswer' . $numberQuestion . '_' . $numberAnswer . '" checked="" style="margin-left: 4px;">';
                                        }
                                        else
                                        {
                                            echo '<input type="radio" id="radioAnswer' . $numberQuestion . '_' . $numberAnswer . '" name="radioAnswer' . $numberQuestion . '" value="inputAnswer' . $numberQuestion . '_' . $numberAnswer . '" style="margin-left: 4px;">';
                                        }

                                        echo '</div>';
                                    }

                                    echo '</div>
                                          <div class="btn-group" style="margin-top: 6px;">
                                            <button type="button" onclick="addAnswer(' . $numberQuestion . ');" class="btn"><i class="icon icon-plus"></i></button>
                                            <button type="button" onclick="deleteAnswer(' . $numberQuestion . ');" class="btn btn-danger"><i class="icon icon-remove"></i></button>
                                          </div>
                                          <input id="numberAnswers_' . $numberQuestion . '" type="hidden" value="' . $numberAnswer . '" name="numberAnswers_' . $numberQuestion . '">
                                          </div>
                                          </div>';
                                }

                                echo '</div>
                                      <input type="hidden" id="numberQuestions" name="numberQuestions" value="' . $numberQuestion . '">
                                      <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                        <span id="button1">
                                            <button type="button" onclick="addQuestion();" class="btn">Ajouter une question</button>
                                        </span>
                                      </div>';
                            }
                            else
                            {
                                echo '<input type="hidden" name="type" value="Oralfile">
                                      <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                      </div>';
                            }?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>
            <span style="text-align:left;float:left">HomeWARK par Dylan Delaporte et Guillaume Villena</a></span>
            <span class="hidden-phone" style="text-align:right;float:right">2012 - 2013</span>
        </p>
    </footer>

</div>
<script src="view/admin/js/jquery-1.9.1.min.js"></script>
<script src="view/admin/js/jquery-migrate-1.0.0.min.js"></script>
<script src="view/admin/js/jquery-ui-1.10.0.custom.min.js"></script>
<script src="view/admin/js/modernizr.js"></script>
<script src="view/admin/js/bootstrap.min.js"></script>
<script src='view/admin/js/fullcalendar.min.js'></script>
<script src='view/admin/js/jquery.dataTables.min.js'></script>
<script src="view/admin/js/jquery.chosen.min.js"></script>
<script src="view/admin/js/custom.js"></script>
<script src="ckeditor/ckeditor.js"></script>

<script>
    window.onload = function()
    {
        CKEDITOR.replace('enonce');
    };
</script>
</body>
</html>