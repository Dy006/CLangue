<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>HomeWARK - Admin</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <base href="http://pox.alwaysdata.net/other/tutorials/workclasslangue/"/>

    <link href="view/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="view/admin/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="view/admin/css/style.min.css" rel="stylesheet">
    <link href="view/admin/css/style-responsive.min.css" rel="stylesheet">
    <link href="view/admin/css/retina.css" rel="stylesheet">

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
                    <li class="active"><a href="admin/addwork"><i class="fa-icon-edit"></i><span class="hidden-tablet"> Ajouter un travail</span></a></li>
                    <li><a href="admin/work"><i class="fa-icon-align-justify"></i><span class="hidden-tablet"> Travails</span></a></li>
                    <li><a href="admin/group"><i class="fa-icon-tasks"></i><span class="hidden-tablet"> Groupes</span></a></li>
                    <li><a href="admin/message"><i class="fa-icon-envelope"></i><span class="hidden-tablet"> Messages</span></a></li>
                    <li><a href="admin/profile"><i class="fa-icon-user"></i><span class="hidden-tablet"> Profil</span></a></li>
                    <li><a href="admin/logout"><i class="fa-icon-lock"></i><span class="hidden-tablet"> Déconnexion</span></a></li>
                </ul>
            </div>
        </div>
        <a id="main-menu-toggle" class="hidden-phone open"><i class="fa-icon-reorder"></i></a>

        <div id="content" class="span11">
            <form name="addwork" action="admin/work/add" method="post" class="form-horizontal">
                <div class="row-fluid sortable">
                    <div class="box span12">
                        <div class="box-header" data-original-title>
                            <h2><i class="halflings-icon edit"></i><span class="break"></span>Ajouter un travail</h2>
                        </div>
                        <div class="box-content">
                            <input type="hidden" name="pro" value="qcmlist">
                            <div class="control-group">
                                <label class="control-label">Nom</label>
                                <div class="controls">
                                    <input type="text" name="name"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Type</label>
                                <div class="controls">
                                    <select id="typeWorkSelect" name="typeWorkSelect" onchange="showDivSelect();">
                                        <option>QCM</option>
                                        <option>Oral</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Enoncé</label>
                                <div class="controls">
                                    <textarea name="enonce"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="qcm" class="row-fluid sortable">
                    <div class="box span12">
                        <div class="box-header" data-original-title>
                            <h2><i class="halflings-icon edit"></i><span class="break"></span>Type QCM</h2>
                        </div>
                        <div class="box-content">
                            <div id="qcmQuestions">
                                <div id="controlQuestion_1" class="control-group">
                                    <label class="control-label">Question n°1</label>
                                    <div class="controls">
                                        <input type="text" onchange="saveInputValue('inputQuestion_1');" id="inputQuestion_1" name="inputQuestion_1">
                                        <div id="answers_1">
                                            <div id="divAnswer1_1" style="margin-top: 6px;">
                                                Réponse n°1 :
                                                <input type="text" onchange="saveInputValue('inputAnswer1_1');" id="inputAnswer1_1" name="inputAnswer1_1">
                                                <input type="radio" id="radioAnswer1_1" name="radioAnswer1" value="inputAnswer1_1" checked="">
                                            </div>
                                            <div id="divAnswer1_2" style="margin-top: 6px;">
                                                Réponse n°2 :
                                                <input type="text" onchange="saveInputValue('inputAnswer1_2');" id="inputAnswer1_2" name="inputAnswer1_2">
                                                <input type="radio" id="radioAnswer1_2" name="radioAnswer1" value="inputAnswer1_2">
                                            </div>
                                        </div>
                                        <div class="btn-group" style="margin-top: 6px;">
                                            <button type="button" onclick="addAnswer(1);" class="btn"><i class="icon icon-plus"></i></button>
                                            <button type="button" onclick="deleteAnswer(1);" class="btn btn-danger"><i class="icon icon-remove"></i></button>
                                        </div>
                                        <input type="hidden" id="numberAnswers_1" value="2" name="numberAnswers_1">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="numberQuestions" name="numberQuestions" value="1">
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                <span id="button1">
                                    <button type="button" onclick="addQuestion();" class="btn">Ajouter une question</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="oralfile" class="row-fluid sortable" style="display: none;">
                    <div class="box span12">
                        <div class="box-header" data-original-title>
                            <h2><i class="halflings-icon edit"></i><span class="break"></span>Type Oral</h2>
                        </div>
                        <div class="alert alert-info">Ce type de travail ne requiert aucune option supplémentaire, l'élève aura un système d'enregistrement audio pour vous faire parvenir le fichier oral.</div>
                        <div class="box-content">
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        </div>
                    </div>
                </div>
            </form>
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

<script src="view/admin/js/jquery.ui.touch-punch.js"></script>

<script src="view/admin/js/modernizr.js"></script>

<script src="view/admin/js/bootstrap.min.js"></script>

<script src="view/admin/js/jquery.cookie.js"></script>

<script src='view/admin/js/fullcalendar.min.js'></script>

<script src='view/admin/js/jquery.dataTables.min.js'></script>

<script src="view/admin/js/excanvas.js"></script>
<script src="view/admin/js/jquery.flot.js"></script>
<script src="view/admin/js/jquery.flot.pie.js"></script>
<script src="view/admin/js/jquery.flot.stack.js"></script>
<script src="view/admin/js/jquery.flot.resize.min.js"></script>

<script src="view/admin/js/gauge.min.js"></script>

<script src="view/admin/js/jquery.chosen.min.js"></script>

<script src="view/admin/js/jquery.cleditor.min.js"></script>

<script src="view/admin/js/jquery.noty.js"></script>

<script src="view/admin/js/jquery.elfinder.min.js"></script>

<script src="view/admin/js/jquery.raty.min.js"></script>

<script src="view/admin/js/jquery.iphone.toggle.js"></script>

<script src="view/admin/js/jquery.uploadify-3.1.min.js"></script>

<script src="view/admin/js/jquery.gritter.min.js"></script>

<script src="view/admin/js/jquery.imagesloaded.js"></script>

<script src="view/admin/js/jquery.masonry.min.js"></script>

<script src="view/admin/js/jquery.knob.modified.js"></script>

<script src="view/admin/js/jquery.sparkline.min.js"></script>

<script src="view/admin/js/counter.js"></script>

<script src="view/admin/js/raphael.2.1.0.min.js"></script>
<script src="view/admin/js/justgage.1.0.1.min.js"></script>

<script src="view/admin/js/retina.js"></script>

<script src="view/admin/js/core.min.js"></script>

<script src="view/admin/js/charts.js"></script>

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