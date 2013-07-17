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
                    <li><a href="admin/work"><i class="fa-icon-align-justify"></i><span class="hidden-tablet"> Travails</span></a></li>
                    <li class="active"><a href="admin/group"><i class="fa-icon-tasks"></i><span class="hidden-tablet"> Groupes</span></a></li>
                    <li><a href="admin/message"><i class="fa-icon-envelope"></i><span class="hidden-tablet"> Messages</span></a></li>
                    <li><a href="admin/profile"><i class="fa-icon-user"></i><span class="hidden-tablet"> Profil</span></a></li>
                    <li><a href="admin/logout"><i class="fa-icon-lock"></i><span class="hidden-tablet"> Déconnexion</span></a></li>
                </ul>
            </div>
        </div>
        <a id="main-menu-toggle" class="hidden-phone open"><i class="fa-icon-reorder"></i></a>

        <div id="content" class="span11">
            <?php
            if($_GET['id'] != NULL && $_GET['subjectId'] != NULL && $_GET['groupName'] != NULL)
            {
                $infoSubject = getInfoSubject($_GET['subjectId']);

                if($infoSubject != NULL)
                {
                    foreach($infoSubject as $subject)
                    {
                        $infoScore = getInfoScore($_GET['id']);

                        echo '<h1>' . $subject['name'] . ' - ' . $subject['type'] . '</h1>';

                        if($subject['type'] == 'QCM')
                        {
                            $good = NULL;
                            $medium = NULL;
                            $bad = NULL;

                            foreach($infoScore as $score)
                            {
                                if($score['average'] < 6)
                                {
                                    $level = 'A1';
                                }
                                elseif($score['average'] > 6 && $score['average'] < 11)
                                {
                                    $level = 'A2';
                                }
                                elseif($score['average'] > 10 && $score['average'] < 16)
                                {
                                    $level = 'B1';
                                }
                                elseif($score['average'] > 15 && $score['average'] < 20)
                                {
                                    $level = 'B2';
                                }
                                else
                                {
                                    $level = 'C1';
                                }

                                if($score['average'] > 14)
                                {
                                    $good .= '<div class="task low"><div class="desc"><div class="title">' . $score['username'] . '</div><div>La moyenne est de ' . $score['average'] . '/20 à ce QCM.</div><div class="time"><div class="date">' . $score['date'] . '</div><div>Level ' . $level . '</div></div></div></div>';
                                }
                                elseif($score['average'] > 9)
                                {
                                    $medium .= '<div class="task medium"><div class="desc"><div class="title">' . $score['username'] . '</div><div>La moyenne est de ' . $score['average'] . '/20 à ce QCM.</div><div class="time"><div class="date">' . $score['date'] . '</div><div>Level ' . $level . '</div></div></div></div>';
                                }
                                else
                                {
                                    $bad .= '<div class="task high"><div class="desc"><div class="title">' . $score['username'] . '</div><div>La moyenne est de ' . $score['average'] . '/20 à ce QCM.</div><div class="time"><div class="date">' . $score['date'] . '</div><div>Level ' . $level . '</div></div></div></div>';
                                }
                            }

                            echo '<div class="priority low"><span>Good Average</span></div>' . $good . '<div class="priority medium"><span>Medium Average</span></div>' . $medium . '<div class="priority high"><span>Bad Average</span></div>' . $bad . '';
                        }
                        else
                        {
                            echo '<div class="row-fluid">
                                    <div class="box span12">
                                        <div class="box-header" data-original-title>
                                            <h2><i class="halflings-icon list"></i><span class="break"></span>Enregistrements</h2>
                                        </div>
                                        <div class="box-content">
                                            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Pseudo</th>
                                                        <th>Enregistrement</th>
                                                        <th>Temps</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>';

                            foreach($infoScore as $score)
                            {
                                echo '<tbody>
                                        <tr>
                                            <td>' . $score['username'] . '</td>
                                            <td class="center"><embed allowfullscreen="false" autostart="false" loop="false" mtype="allMedias" pluginspage="http://activex.microsoft.com/" quality="high" src="' . $score['link'] . '" type="video/x-ms-asf-plugin" width="400" height="34"></embed></td>
                                            <td class="center">' . $score['time'] . '</td>
                                            <td class="center">' . $score['date'] . '</td>
                                        </tr>
                                      </tbody>';
                            }

                            echo '</table></div></div></div>';
                        }
                    }
                }
                else
                {
                    echo '<div class="alert alert-error">Une erreur est survenue lors du chargement de la page.</div>';
                }
            }
            else
            {
                echo '<div class="alert alert-error">Une erreur est survenue lors du chargement de la page.</div>';
            }?>

            <div class="clearfix"></div>
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
</body>
</html>