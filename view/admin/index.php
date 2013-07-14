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
    <link href="view/admin/css/retina.css" rel="stylesheet">

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