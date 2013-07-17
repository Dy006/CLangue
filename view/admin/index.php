<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>HomeWARK - Admin</title>

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

    <style type="text/css">
        body { background: url(view/admin/img/bg-login.jpg) !important; }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="row-fluid">
            <div class="login-box">
                <h2>Entrez vos identifiants</h2>
                <?php
                if($resultLogin != NULL)
                {
                    echo $resultLogin;
                }?>
                <form class="form-horizontal" action="" method="post">
                    <div class="input-prepend" title="User">
                        <span class="add-on"><i class="halflings-icon user"></i></span>
                        <input class="input-large span10" name="username" id="username" type="text" placeholder="Pseudo" value="<?php echo $_POST['username']; ?>"/>
                    </div>
                    <div class="clearfix"></div>

                    <div class="input-prepend" title="Password">
                        <span class="add-on"><i class="halflings-icon lock"></i></span>
                        <input class="input-large span10" name="password" id="password" type="password" placeholder="Mot de passe"/>
                    </div>
                    <div class="clearfix"></div>
                    <div class="input-prepend" title="Etablishing">
                        <select name="etablishing" class="input-large span10">
                            <?php
                            foreach($listEtablishings as $etablishing)
                            {
                                echo '<option>' . $etablishing['name'] . '</option>';
                            }?>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                    <div class="button-login">
                        <button type="submit" class="btn btn-primary">Connexion</button>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="view/admin/js/jquery-1.9.1.min.js"></script>
<script src="view/admin/js/jquery-migrate-1.0.0.min.js"></script>
<script src="view/admin/js/jquery-ui-1.10.0.custom.min.js"></script>
<script src="view/admin/js/modernizr.js"></script>
<script src="view/admin/js/bootstrap.min.js"></script>
<script src='view/admin/js/fullcalendar.min.js'></script>
<script src='view/admin/js/jquery.dataTables.min.js'></script>
<script src="view/admin/js/jquery.chosen.min.js"></script>
<script src="view/admin/js/custom.js"></script></body>
</html>