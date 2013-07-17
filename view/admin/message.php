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
                    <li><a href="admin/group"><i class="fa-icon-tasks"></i><span class="hidden-tablet"> Groupes</span></a></li>
                    <li class="active"><a href="admin/message"><i class="fa-icon-envelope"></i><span class="hidden-tablet"> Messages</span></a></li>
                    <li><a href="admin/profile"><i class="fa-icon-user"></i><span class="hidden-tablet"> Profil</span></a></li>
                    <li><a href="admin/logout"><i class="fa-icon-lock"></i><span class="hidden-tablet"> Déconnexion</span></a></li>
                </ul>
            </div>
        </div>
        <a id="main-menu-toggle" class="hidden-phone open"><i class="fa-icon-reorder"></i></a>

        <div id="content" class="span11">
			<div class="span6">
				<h1>Boite de récéption</h1>
				<ul class="messagesList">
                    <?php
                    foreach ($listMessages as $message)
                    {
                        if($message['readMessage'] != 1)
                        {
                            echo '<li style="font-weight: bold;">';
                        }
                        else
                        {
                            echo '<li>';
                        }

                        echo '<span class="from">' . $message['sender'] . '</span><a href="admin/message/' . $message['id'] . '"><span class="title">' . $message['object'] . '</span></a><span class="date">' . $message['date'] . '</span></li>';
                    }?>
				</ul>
			</div>
			<div class="span5 dark">
                <div class="message">
                    <?php
                    if($_GET['id'] != NULL)
                    {
                        $message = getMessage($_GET['id']);

                        if($message != NULL)
                        {
                            $user = getInfoUser($message['sender']);

                            getReadMessage($message['id']);

                            echo '<div class="header">
							        <h1>"' . $message['object'] . '"</h1>
							        <div class="from"><i class="halflings-icon user"></i> <b>' . $message['sender'] . '</b> / ' . $user['language'] . ' ' . $user['category'] . '</div>
							        <div class="date"><i class="halflings-icon calendar"></i> ' . $message['date'] . '</div>
							        <div class="menu"></div>
							      </div>
							      <div class="content">' . $message['body'] . '</div>
							      </br>
							      <form method="post" action="admin/message/reply" class="replyForm">
							        <fieldset>
							            <input type="hidden" name="id" value="' . $_GET['id'] . '">
							            <input type="hidden" name="receiver" value="' . $message['sender'] . '">
							            <input type="hidden" name="object" value="' . $message['object'] . '">
							            <textarea tabindex="3" class="input-xlarge span12" id="message" name="body" rows="12"></textarea>
							            <div class="actions">
							                <button tabindex="3" type="submit" class="btn btn-success">Envoyer</button>
							            </div>
							        </fieldset>
							      </form>';
                        }
                        else
                        {
                            echo '<div class="alert alert-error">Ce message n\'existe pas.</div>';
                        }
                    }
                    else
                    {
                        echo '<form method="post" action="admin/message/add" class="form-horizontal">
                                <fieldset>
                                    <h2>Nouveau message</h2>
                                    <div class="control-group">
                                        <label class="control-label">Objet</label>
                                        <div class="controls">
                                            <input type="text" name="object" placeholder="Objet">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Destinataire</label>
                                        <div class="controls">
                                            <select name="selectReceiver[]" multiple data-rel="chosen" style="width: 220px;">';

                        foreach($listTeachers as $teacher)
                        {
                            echo '<option>' . $teacher['username'] . '</option>';
                        }

                        echo '                <option>Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Message</label>
                                        <div class="controls">
                                            <textarea name="body"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" class="btn btn-primary" value="Envoyer">
                                    </div>
                                </fieldset>
                              </form>';
                    }?>
                </div>
            </div>
    	</div>
	</div>

    <footer>
        <p>
            <span style="text-align:left;float:left">HomeWARK par Dylan Delaporte et Guillaume Villena</span>
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