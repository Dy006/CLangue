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
        function generatePassword() {
            document.getElementById('password').type = 'text';

            var cars = 'az0erty2ui3op4qs5df6gh7jk8lm9wxcvbn', long = cars.length;

            wpas = "";
            taille = 6;

            for (i = 0; i < taille; i++) {
                wpos = Math.round(Math.random() * long);
                wpas += cars.substring(wpos, wpos + 1);
            }

            document.getElementById('password').value = wpas;
        }

        function generatePasswordStudent() {
            var cars = 'az0erty2ui3op4qs5df6gh7jk8lm9wxcvbn', long = cars.length;

            var wpas = "";
            var wpos;
            var taille = 6;

            for (i = 0; i < taille; i++) {
                wpos = Math.round(Math.random() * long);
                wpas += cars.substring(wpos, wpos + 1);
            }

            return wpas;
        }

        function managerValueTableStudents() {
            console.log('managerValueTableStudent');

            var name = document.getElementById('namegroup').value;
            var numberOfStudents = document.getElementById('numberOfStudents').value;
            var etablishing = document.getElementById('etablishing').value;

            console.log(numberOfStudents);

            var contentTable;

            contentTable = '<table class="table"><thead><tr><th>Username</th><th>Password</th><th>Category</th><th>Group</th><th>Etablishing</th></tr></thead><tbody>';

            for (var x = 0; x < numberOfStudents; x++) {
                var numberStudent = x + 1;
                var password = generatePasswordStudent();

                contentTable += '<tr><td><input type="text" name="usernameStudent' + numberStudent + '" id="usernameStudent' + numberStudent + '" onchange="CheckValues(\'usernameStudent' + numberStudent + '\')" ></td><td class="center"><input type="text" name="passwordStudent' + numberStudent + '" id="passwordStudent' + numberStudent + '" value="' + password + '"><td class="center">Student</td><td class="center">' + name + '</td><td class="center">' + etablishing + '</td></tr>';
            }

            contentTable += '</tbody></table>';

            document.getElementById('tableStudents').innerHTML = contentTable;
        }
        function getGroupList() {
            var OAjax;
            if (window.XMLHttpRequest) OAjax = new XMLHttpRequest();
            else if (window.ActiveXObject) OAjax = new ActiveXObject('Microsoft.XMLHTTP');
            OAjax.open('POST', "admin.php?type=admin&a=getGroups", true);
            OAjax.onreadystatechange = function () {
                if (OAjax.readyState == 4 && OAjax.status == 200) {
                    if (document.getElementById) {
                        if (OAjax.responseText != 'true') {
                            arrayList = OAjax.responseText
                            list = arrayList.split(',');
                            list.shift();
                            $("#groups").empty();

                            if (document.getElementById('cat').value != 'Student') {
                                newoption = new Option('', '');
                                $("#groups").append(newoption);
                                $("#groups").trigger("liszt:updated");
                            }
                            for (i = 0; i < list.length; i++) {
                                newoption = new Option(list[i], list[i]);
                                $("#groups").append(newoption);
                                $("#groups").trigger("liszt:updated");
                            }
                            console.log(arrayList, list, OAjax.responseText);
                            //$("#goups").chosen().change();
                        }

                    }
                }
            }
            OAjax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            OAjax.send('etab=' + document.getElementById('etabL').value + '');
        }
        function CheckValues(id) {
            text = document.getElementById(id).value
            text2 = text[0].toUpperCase() + text.substring(1, text.length - 1) + text[text.length - 1].toUpperCase();
            document.getElementById(id).value = text2;
        }
        function changeText(user)
        {
            document.getElementById('buttonS').innerHTML = '<a href="admin/admin/user/delete/'+user+'" class="btn btn-danger">Suprimer</a>';
        }
    </script>
</head>

<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse"
               data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
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
                                <span class="dropdown-menu-title">Vous avez <?php echo $countSubjects; ?>
                                    travail(s)</span>
                            </li>
                            <?php
                            foreach ($listSubjects as $subject) {
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
                                <span class="dropdown-menu-title">Vous avez <?php echo $countMessages; ?>
                                    message(s)</span>
                            </li>
                            <?php
                            foreach ($listMessages as $message) {
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
            <li class="active"><a href="admin"><i class="fa-icon-bar-chart"></i><span
                        class="hidden-tablet"> Acceuil</span></a></li>
            <li><a href="admin/addwork"><i class="fa-icon-edit"></i><span
                        class="hidden-tablet"> Ajouter un travail</span></a></li>
            <li><a href="admin/work"><i class="fa-icon-align-justify"></i><span
                        class="hidden-tablet"> Travails</span></a></li>
            <li><a href="admin/group"><i class="fa-icon-tasks"></i><span class="hidden-tablet"> Groupes</span></a></li>
            <li><a href="admin/message"><i class="fa-icon-envelope"></i><span class="hidden-tablet"> Messages</span></a>
            </li>
            <li><a href="admin/profile"><i class="fa-icon-user"></i><span class="hidden-tablet"> Profil</span></a></li>
            <li><a href="admin/logout"><i class="fa-icon-lock"></i><span class="hidden-tablet"> Déconnexion</span></a>
            </li>
        </ul>
    </div>
</div>
<a id="main-menu-toggle" class="hidden-phone open"><i class="fa-icon-reorder"></i></a>

<div id="content" class="span11">
<?php
if ($resultAddUser != NULL) {
    echo $resultAddUser;
}?>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Ajouter un utilisateur</h2>
        </div>
        <div class="box-content">
            <form method="post" action="admin/admin/adduser" class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">Pseudo</label>

                    <div class="controls">
                        <input name="username" id="pseudoUsername" onchange="CheckValues('pseudoUsername')" type="text"
                               value="<?php echo $_POST['username']; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Mot de passe</label>

                    <div class="controls">
                        <input id="password" name="password" type="password">
                        <input type="button" class="btn btn-info" onclick="generatePassword();"
                               value="Générer un mot de passe">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Catégorie</label>

                    <div class="controls">
                        <select name="category" id="cat">
                            <option>Teacher</option>
                            <option>Student</option>
                            <option>Admin</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Etablissement</label>

                    <div class="controls">
                        <select name="etablishing" id="etabL" onchange="getGroupList()">
                            <option></option>
                            <?php
                            foreach ($listEtablishings as $etablishing) {
                                echo '<option>' . $etablishing['name'] . '</option>';
                            }?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Groupe</label>

                    <div class="controls">
                        <select name="group[]" id="groups" multiple data-rel="chosen"></select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">LV1</label>

                    <div class="controls">
                        <select name="lv1">
                            <option>English</option>
                            <option>Español</option>
                            <option>Italiano</option>
                            <option>Duits</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">LV2</label>

                    <div class="controls">
                        <select name="lv2">
                            <option></option>
                            <option>English</option>
                            <option>Español</option>
                            <option>Italiano</option>
                            <option>Duits</option>
                        </select>
                    </div>
                </div>
                <div class="form-actions">
                    <input value="Add" class="btn btn-primary" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if ($resultAddGroup != NULL) {
    echo $resultAddGroup;
}?>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Ajouter un groupe</h2>
        </div>
        <div class="box-content">
            <form method="post" action="admin/admin/addgroup" class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">Nom</label>

                    <div class="controls">
                        <input type="text" name="namegroup" id="namegroup" value="<?php echo $_POST['namegroup']; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Langue</label>

                    <div class="controls">
                        <select name="languagegroup" id="languagegroup">
                            <option>English</option>
                            <option>Español</option>
                            <option>Italiano</option>
                            <option>Duits</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Etablissement</label>

                    <div class="controls">
                        <input type="text" name="etablishinggroup" id="etablishinggroup" disabled=""
                               value="<?php echo $_SESSION['etablishing']; ?>">
                    </div>
                </div>
                <div class="form-actions">
                    <input value="Add" class="btn btn-primary" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Ajouter des élèves</h2>
        </div>
        <div class="box-content">
            <form method="post" action="admin/admin/addstudent" class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">Groupe</label>

                    <div class="controls">
                        <select name="groupStudent[]" multiple data-rel="chosen">
                            <?php
                            foreach ($listGroups as $group) {
                                echo '<option>' . $group['name'] . '</option>';
                            }?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Etablissement</label>

                    <div class="controls">
                        <input type="text" name="etablishinggroup" id="etablishinggroup" disabled=""
                               value="<?php echo $_SESSION['etablishing']; ?>">
                    </div>
                </div>
                <div class="form-actions">
                    <input value="Add" class="btn btn-primary" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Ajouter un groupe</h2>
        </div>
        <div class="box-content">
            <div class="alert alert-info">Le nom d'utilisateur doit être contitué du nom de l'élève plus la premiere
                lettre du prenom. <br>
                Par exemple pour un élève qui s'apellerait Villena Guillaume sont nom d'utilisateur serait
                <b>VillenaG</b></div>
            <form method="post" action="admin/admin/addgroup" class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">Nom</label>

                    <div class="controls">
                        <input type="text" name="namegroup" id="namegroup" value="<?php echo $_POST['namegroup']; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Nombre d'élèves</label>

                    <div class="controls">
                        <input type="text" onchange="managerValueTableStudents();" name="numberOfStudents"
                               id="numberOfStudents" value="<?php echo $_POST['numberOfStudents']; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Etablissement</label>

                    <div class="controls">
                        <select name="etablishing" id="etablishing">
                            <?php
                            foreach ($listEtablishings as $etablishing) {
                                echo '<option>' . $etablishing['name'] . '</option>';
                            }?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Langue</label>

                    <div class="controls">
                        <select name="langue" id="langue">
                            <option>English</option>
                            <option>Español</option>
                            <option>Italiano</option>
                            <option>Duits</option>
                        </select>
                    </div>
                </div>
                <div id="tableStudents">Vous devez rentrer un nombre d'élèves.</div>
                <div class="form-actions">
                    <input value="Add" class="btn btn-primary" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if ($resultAddEtablishing != NULL) {
    echo $resultAddEtablishing;
}?>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Ajouter un établissement</h2>
        </div>
        <div class="box-content">
            <form method="post" action="admin/admin/addetablishing" class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">En-tête</label>

                    <div class="controls">
                        <select name="header">
                            <option>Lycee</option>
                            <option>College</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Nom</label>

                    <div class="controls">
                        <input name="nameetablishing" type="text" value="<?php echo $_POST['nameetablishing']; ?>">
                    </div>
                </div>
                <div class="form-actions">
                    <input value="Add" class="btn btn-primary" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Liste des utilisateurs classé par groupe
            </h2>
        </div>
        <div class="box-content">
            <div class="accordion" id="accordion2">
                <?php
                if ($retour != null)
                {
                    echo '<div class="alert alert-info">Le nouveau mot de passe pour l\'utilisateur ' . $_GET['u'] . ' est : '.$retour.'</div>';
                }
                $i =0;
                foreach ($listGroups as $group) {
                    $i++;
                    echo '<div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
                           href="#collapse'.$i.'">
                            ' . $group['name'] . '
                        </a>
                    </div>
                    <div id="collapse'.$i.'" class="accordion-body collapse">
                        <div class="accordion-inner">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Non d\'utilisateur</th>
                                    <th>Catégorie</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>';
                    $userList = getListStudents($group['name']);
                    foreach ($userList as $user) {
                        echo '<tr>
                                    <td>' . $user['username'] . '</td>
                                    <td>Student</td>
                                    <td><a href="admin/admin/user/edit/'.$user['username'].'" class="btn btn-info">Editer</a>
                                        <a href="#confirm" data-toggle="modal" onclick="changeText(\''.$user['username'].'\')" class="btn btn-danger">Suprimer</a>
                                        <a href="admin/admin/user/reinitpassword/'.$user['username'].'" class="btn btn-warning">Réinitialiser le mot de passe</a>
                                    </td>
                                </tr>';
                    }

                    echo '</tbody>
                            </table>
                        </div>
                    </div>
                </div>';
                }
                ?>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
<div id="confirm" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="myModalLabel">Confirmation</h3>
    </div>
    <div class="modal-body">
        <p>Êtes vous sure de vouloir surprimer cet utilisateur</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
        <span id="buttonS"></span>
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