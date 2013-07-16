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
    <link href="view/admin/css/retina.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link id="ie-style" href="view/admin/css/ie.css" rel="stylesheet">
    <![endif]-->

    <!--[if IE 9]>
    <link id="ie9style" href="view/admin/css/ie9.css" rel="stylesheet">
    <![endif]-->

    <script type="text/javascript">
        function addStudent(username, etablishing, groupName)
        {
            var OAjax;
            var password = generatePasswordStudent();

            if (window.XMLHttpRequest) OAjax = new XMLHttpRequest();
            else if (window.ActiveXObject) OAjax = new ActiveXObject('Microsoft.XMLHTTP');
            OAjax.open('POST',"admin.php?type=group&a=addStudent",true);
            OAjax.onreadystatechange = function()
            {
                if (OAjax.readyState == 4 && OAjax.status==200)
                {
                    if (document.getElementById)
                    {
                        if(OAjax.responseText == 'notMatch')
                        {
                            document.getElementById('alertStudent').innerHTML = '<div class="alert alert-error">Le pseudo ne correspond pas.</div>';
                        }
                        else if(OAjax.responseText == 'alreadyInGroup')
                        {
                            document.getElementById('alertStudent').innerHTML = '<div class="alert alert-error">Cet élève est déjà dans ce groupe.</div>';
                        }
                        else
                        {
                            var tabInfoUser = JSON.parse(OAjax.responseText);

                            if(tabInfoUser[0] == 'addStudent')
                            {
                                document.getElementById('alertStudent').innerHTML = '<div class="alert alert-info">Cet élève a été ajouté au groupe, il a été crée par vous, son mot de passe est : ' + tabInfoUser[2] + '.</div>';
                            }
                            else
                            {
                                document.getElementById('alertStudent').innerHTML = '<div class="alert alert-info">Cet élève a été ajouté à votre groupe, il a déjà été crée par un professeur qui lui remettra son mot de passe.</div>';
                            }

                            console.log(tabInfoUser);

                            console.log('table' + tabInfoUser[5]);

                            addRowTableStudent('table' + tabInfoUser[5], tabInfoUser[1], tabInfoUser[3], tabInfoUser[4]);
                        }

                        console.log(OAjax.responseText);
                    }
                }
            }

            OAjax.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            OAjax.send('username=' + username + '&password=' + password + '&category=Student&etablishing=' + etablishing + '&groupName=' + groupName);
        }

        function generatePasswordStudent()
        {
            var cars = 'az0erty2ui3op4qs5df6gh7jk8lm9wxcvbn', long = cars.length;

            var wpas = "";
            var wpos;
            var taille = 6;

            for (i = 0; i < taille; i++)
            {
                wpos = Math.round(Math.random() * long);
                wpas += cars.substring(wpos, wpos + 1);
            }

            return wpas;
        }

        function addRowTableStudent(tableId, username, category, etablishing)
        {
            var newRow = document.getElementById(tableId).insertRow(-1);

            var newCell = newRow.insertCell(0);

            newCell.innerHTML = username;

            newCell = newRow.insertCell(1);

            newCell.innerHTML = category;

            newCell = newRow.insertCell(2);

            newCell.innerHTML = etablishing;
        }

        function deleteStudent(username, groupName, currentRow)
        {
            var OAjax;

            if (window.XMLHttpRequest) OAjax = new XMLHttpRequest();
            else if (window.ActiveXObject) OAjax = new ActiveXObject('Microsoft.XMLHTTP');
            OAjax.open('POST',"admin.php?type=group&a=deleteStudent",true);
            OAjax.onreadystatechange = function()
            {
                if (OAjax.readyState == 4 && OAjax.status==200)
                {
                    if (document.getElementById)
                    {
                        if(OAjax.responseText == 'true')
                        {
                            var tableId = 'table' + groupName;

                            document.getElementById(tableId).deleteRow(currentRow);

                            document.getElementById('alertStudent').innerHTML = '<div class="alert alert-info">Cet élève a bien été supprimé du groupe.</div>';
                        }
                        else
                        {
                            document.getElementById('alertStudent').innerHTML = '<div class="alert alert-error">Une erreur est survenue lors de la suppression de cet élève.</div>';
                        }
                    }
                }
            }

            OAjax.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            OAjax.send('username=' + username + '&groupName=' + groupName);
        }

        function confirmdelete(id)
        {
            document.getElementById('returne').innerHTML = '<center><a href="admin/homework/delete/'+ id +'" class="btn btn-danger">Confirmation de suppression</a> <a href="#" data-dismiss="modal" class="btn">Annuler</a></center> '
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
            <div class="row-fluid">
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2><i class="halflings-icon list"></i><span class="break"></span>Devoirs</h2>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Travail</th>
                                <th>Groupe</th>
                                <th>Fini</th>
                                <th>Ajouté le</th>
                                <th>Date de fin</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <?php
                            foreach($listHomeworks as $homework)
                            {
                                $nameSubject = getNameWithTypeSubject($homework['subjectId']);
                                $numberUsersScore = getNumberUsersScore($homework['id'], $homework['groupName']);

                                echo '<tbody>
                                        <tr>
                                            <td>' . $homework['name'] . '</td>
                                            <td class="center">' . $nameSubject . '</td>
                                            <td class="center">' . $homework['groupName'] . '</td>
                                            <td class="center">' . $numberUsersScore . '</td>
                                            <td class="center">' . $homework['date'] . '</td>
                                            <td class="center">' . $homework['dateEnd'] . '</td>
                                            <td>
                                                <a class="btn btn-success" href="admin/result/' . $homework['groupName'] . '/' . $homework['subjectId'] . '/' . $homework['id'] . '">
                                                    Result
                                                </a>
                                                <a class="btn btn-danger" href="#confirmDelete" onclick="confirmdelete(' . $homework['id'] . ');" data-toggle="modal">
                                                    <i class="halflings-icon trash halflings-icon"></i>
                                                </a>
                                            </td>
                                        </tr>
                                      </tbody>';
                            }?>
                        </table>
                    </div>
                </div>
            </div>
            <a href="#addHomework" class="btn" data-toggle="modal">Ajouter un devoir</a>
            <h1>Vos groupes</h1>
            <p>Les tableaux affichés ci-dessous sont les groupes auquels vous appartenez. Vous avez la possibilité d'ajouter les élèves.</p>
            <div id="alertStudent"></div>
            <div class="row-fluid">
                <?php
                foreach($listGroups as $group)
                {
                    $numberRow = 0;

                    $listUsers = getListUsersGroup($group['groupName']);

                    echo '<div class="box span6">
					        <div class="box-header">
						        <h2><i class="halflings-icon align-justify"></i><span class="break"></span>' . $group['groupName'] . '</h2>
					        </div>
					        <div class="box-content">
						        <table id="table' . $group['groupName'] . '" class="table">
							        <thead>
								        <tr>
									        <th>Pseudo</th>
									        <th>Catégorie</th>
									        <th>Etablissement</th>
									        <th>Options</th>
								        </tr>
							        </thead>
							        <tbody>';

                    foreach($listUsers as $user)
                    {
                        $numberRow++;

                        echo '<tr><td>' . $user['username'] . '</td><td>' . $user['category'] . '</td><td>' . $user['etablishing'] . '</td><td><button type="button" onclick="deleteStudent(\'' . $user['username'] . '\', \'' . $group['groupName'] . '\', \'' . $numberRow . '\');" class="btn btn-danger"><i class="icon icon-remove"></i></button></td></tr>';
                    }

					echo '          </tbody>
						        </table>
					        </div>
					        <form method="post" action="#" onsubmit="addStudent(this.username.value, this.etablishing.value, this.groupName.value);return false" class="form-inline" style="margin-top: 10px;">
					            <div class="control-group">
					                <label class="control-label">Pseudo (Nom et initaliale du prénom, DelaporteD) :</label>
					                <div class="controls">
					                    <input type="text" name="username' . $group['groupName'] . '" id="username' . $group['groupName'] . '">
					                </div>
					            </div>
					            <input type="hidden" name="etablishing" id="etablishing" value="' . $_SESSION['etablishing'] . '">
					            <input type="hidden" name="groupName" id="groupName" value="' . $group['groupName'] . '">
					            <input type="submit" value="Ajouter un utilisateur" class="btn">
					        </form>
				          </div>';
                }?>
            </div>
            <div id="addHomework" class="modal hide fade">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h3>Ajouter un devoir</h3>
                </div>
                <div class="modal-body">
                    <form method="post" action="admin/homework/add">
                        <div class="control-group">
                            <label class="control-label">Nom</label>
                            <div class="controls">
                                <input type="text" name="name">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Travail</label>
                            <div class="controls">
                                <select name="work">
                                    <?php
                                    foreach($listSubjects as $subject)
                                    {
                                        echo '<option>' . $subject['name'] . '</option>';
                                    }?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Groupe</label>
                            <div class="controls">
                                <select name="selectGroupName[]" multiple data-rel="chosen" style="width: 220px;">
                                    <?php
                                    foreach($listGroups as $group)
                                    {
                                        echo '<option>' . $group['groupName'] . '</option>';
                                    }?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Date de fin</label>
                            <div class="controls">
                                <input type="text" name="dateEnd" class="datepicker">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn">Sauvegarder</button>
                        </div>
                    </form>
                </div>
            </div>
            <div id="confirmDelete" class="modal hide fade">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h3>Confirmation de suppression</h3>
                </div>
                <div class="modal-body">
                    <div id="returne">
                        <center>Nothing ...</center>
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

<script src="view/admin/js/jquery.uniform.min.js"></script>

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
</body>
</html>