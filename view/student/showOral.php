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
	<link rel="stylesheet" type="text/css" href="view/student/css/signin.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
	<script type="text/javascript">
		var seconde=0 //initialise les secondes
		var minute=0 //initialise les minutes		
		var loaded  = false;	
		var numberofSeconde = 0;
		var added = false;
		function changeUploadStat(etat)
		{
			if (etat == "executing request")
			{
				document.getElementById('bare').style.width = '20%';
				document.getElementById('txtState').innerHTML = '<span class="alert alert-info">Envoi en cours ... 30%</span><br>'
			}
			else if (etat == "HTTP/1.1 200 OK"){
				
				document.getElementById('bare').style.width = '40%';
				document.getElementById('txtState').innerHTML = '<span class="alert alert-info">Envoi en cours ... 60%</span><br>'
			
			}
			else if (etat == "success")
			{
				document.getElementById('bare').style.width = '50%';
				document.getElementById('bare').className = 'bar bar-success';
				document.getElementById('txtState').innerHTML = '<span class="alert alert-success">Convertion ...</span><br>'
				pourcen = window.setInterval('ConvertFile();' , 400);
				//ConvertFile()
			}

			else if (etat == "faild")
			{
				document.getElementById('bare').style.width = '100%';
				document.getElementById('bare').className = 'bar bar-danger';
				document.getElementById('txtState').innerHTML = ' <span class="alert alert-danger">Une erreur est survenue</span><br>'
			}
			else
			{
				document.getElementById('bare').style.width = '100%';
				document.getElementById('bare').className = 'bar bar-danger';
				document.getElementById('txtState').innerHTML = ' <span class="alert alert-danger">Une erreur est survenue</span><br>'

			}	
		}
		
		
		function changeStatue(str)
		{
			if (str == "Inited")
			{
				loaded = true;
				document.getElementById('loaded').style.display = ""
				document.getElementById('notLoaded').style.display = "none";
			}
		}
		
		function record()
		{
			if(loaded)
			{
                document.applets[0].recordAudio();
                seconde = 0;
                minute = 0;

                activateButton('stopButton');

                disableButton('playButton');
                disableButton('recordButton');
                disableButton('selectFileButton');
                disableButton('sendButton');

                chrono();
			}
		}

        function play()
        {
            if(loaded)
            {
                document.applets[0].playAudio();

                activateButton('playButton');
                activateButton('stopButton');

                disableButton('selectFileButton');
                disableButton('sendButton');
                disableButton('recordButton');
            }
        }

		function stop()
		{
			if(loaded)
			{
                document.applets[0].stopAudio();

                window.clearTimeout(compte);

                activateButton('playButton');
                activateButton('recordButton');
                activateButton('selectFileButton');
                activateButton('sendButton');

                disableButton('stopButton');

                document.applets[0].saveAudio();
			}
		}

        function choseFile()
        {
            if(loaded)
            {
                document.applets[0].choose_file();

                activateButton('recordButton');
                activateButton('selectFileButton');

                var pathValue = document.getElementById('path').innerHTML;

                if(pathValue != 'Aucun fichier')
                {
                    activateButton('sendButton');
                }

                disableButton('playButton');
                disableButton('stopButton');
            }
        }

		function send()
		{
			if(loaded)
			{
                document.applets[0].UploadToServer();

                disableButton('playButton');
                disableButton('recordButton');
                disableButton('stopButton');
                disableButton('selectFileButton');
                disableButton('sendButton');

                document.getElementById('state').style.display = '';
                document.getElementById('bare').style.width = '1%';
			}			
			
		}

        function activateButton(id)
        {
            document.getElementById(id).classList.remove('disabled');
        }

		function disableButton(id)
		{
			document.getElementById(id).classList.add('disabled');
		}

		function hideProgress()
		{
			document.getElementById('state').style.display = 'none';
		}

		function chrono()
		{			
			seconde++;
			numberofSeconde++;

			if (seconde>59)
			{
				seconde=0;
				minute++;
			}

			document.getElementById('recordTime').innerHTML = minute + ' minutes ' + seconde + ' secondes';
			compte = setTimeout('chrono()',1000)
		}

		function changeFilePath(path)
		{
			document.getElementById('path').innerHTML = path;
		}
		
		function AddScore()
		{
            added =true;

    	var OAjax;
    	if (window.XMLHttpRequest) OAjax = new XMLHttpRequest();
    	else if (window.ActiveXObject) OAjax = new ActiveXObject('Microsoft.XMLHTTP');
			OAjax.open('POST',"index.php?type=showQcm&a=addScoreOral",true);
    	OAjax.onreadystatechange = function()
    	{
    	    if (OAjax.readyState == 4 && OAjax.status==200)
        	{
            	if (document.getElementById)
            	{
            	    if (OAjax.responseText != 'Something wrong')
                    {
						document.getElementById('txtState').innerHTML = ' <span class="alert alert-success">Terminé et validé</span><br>'
						setTimeout("window.location = 'index'", 2000);
            	    }
    	        }
        	}
    	}

            OAjax.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            OAjax.send('subjectId=<?php echo $_GET["subjectId"]; ?>&homeworkId=<?php echo $_GET["homeworkId"]; ?>&type=ORAL&time='+document.getElementById('recordTime').innerHTML+'' );
		}

		function ConvertFile()
		{
    	var OAjax;
    	if (window.XMLHttpRequest) OAjax = new XMLHttpRequest();
    	else if (window.ActiveXObject) OAjax = new ActiveXObject('Microsoft.XMLHTTP');
			OAjax.open('POST',"userFiles/convert.php",true);
    	OAjax.onreadystatechange = function()
    	{
    	    if (OAjax.readyState == 4 && OAjax.status==200)
        	{
            	if (document.getElementById)
            	{
            	    if (OAjax.responseText !='Erreur') {
						//document.getElementById('txtState').innerHTML = ' <span class="alert alert-succes">Terminé et validé</span><br>'
						var divid = Math.floor(parseInt(OAjax.responseText)/2);
						var newPercent = divid+50;
						if (newPercent == 100)
						{							
							window.clearInterval(pourcen);
							if (!added)
                            {
                                AddScore();
                            }

						}
						document.getElementById('bare').style.width = newPercent+'%';	
						console.log(OAjax.responseText);
            	    }
					else
					{
					}
	
    	        }
        	}
    	}
    	OAjax.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    	OAjax.send('homeworkId=<?php echo $homeworkId ?>' );
		}
	</script>
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
				<p>
					<?php echo $subject[3] . 'Par ' . $subject[1]; ?>
				</p>
            </div>
        </div>

        <h2 class="section_header team">
            <hr class="left visible-desktop">
            <span><?php echo $subject[4]; ?></span>
            <hr class="right visible-desktop">
        </h2>
		
		<applet name="AudioApplet" code=fr.gv.AudioRecorder.class codebase="http://pox.alwaysdata.net/other/tutorials/workclasslangue/view/student/applet/" 
							archive="AudioRecorder.jar,commons-codec-1.6.jar,commons-logging-1.1.1.jar,fluent-hc-4.2.5.jar,httpclient-4.2.5.jar,httpclient-cache-4.2.5.jar,plugin.jar,httpcore-4.2.4.jar,httpmime-4.2.5.jar" 
							width    = "0"
  							height   = "0"
  							hspace   = "0"
  							vspace   = "0"
  							align    = "left">
							<param name=W value="<?php echo $homeworkId; ?>">
							<param name=U value="<?php echo $_SESSION['user']; ?>">
						</applet>

        <div class="row">
				<div class="span12">					
						<div class="span7 offset2">
                            <div class="well well-large" id="notLoaded" >
                                <div class="alert alert-warning">
                                    L'applet n'est pas encore lancé, veuillez accepter son lancement et<br>
                                    les boutons de commande seront disponnible.	Si rien ne se passe tentez de recharger la page, ou de verrifier votre installation de Java ( disponnible <a href="http://www.java.com/fr/download/">ici</a>).
                                </div>
                            </div>
							<div id="loaded" style="display : none;">
                                <div class="well">
                                    <h4 class="section_header" style="margin-top: -10px;">
                                        <hr class="left visible-desktop">
                                        <span>Enregistrement</span>
                                        <hr class="right visible-desktop">
                                    </h4>
                                    <div class="row-fluid">
                                        <div class="span4">
                                            <button type="button" data-toggle="tooltip" title="Enregistrer" id="recordButton" onclick="record();" class="btn btn-large tooltipButton"><i class="icon icon-plus-sign"></i></button>
                                            <button type="button" data-toggle="tooltip" title="Démarrer la lecture" id="playButton" onclick="play();" class="btn btn-large tooltipButton disabled"><i class="icon icon-play"></i></button>
                                            <button type="button" data-toogle="tooltip" title="Stopper la lecture" id="stopButton" onclick="stop();" class="btn btn-large tooltipButton disabled"><i class="icon icon-stop"></i></button>
                                        </div>
                                        <div class="span8">
                                            <div id="recordInfo" class="well well-small">
                                                <span> Temps d'enregistrement : <span id="recordTime">0 minute(s) 0 seconde(s)</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="well">
                                    <h4 class="section_header" style="margin-top: -10px;">
                                        <hr class="left visible-desktop">
                                        <span>Fichier</span>
                                        <hr class="right visible-desktop">
                                    </h4>
                                    <div class="row-fluid">
                                        <div class="span2">
                                            <button type="button" data-toggle="tooltip" title="Envoyer un fichier" id="selectFileButton" onclick="choseFile()" class="btn btn-large tooltipButton"><i class="icon icon-folder-open"></i></button>
                                        </div>
                                        <div class="span10">
                                            <div class="well well-small">
                                                <span id="path">Aucun fichier</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    <a href="#confirm" id="sendButton" data-toggle="modal" class="btn btn-large disabled">Envoyer</a>
                                    <span id="state"><span id="txtState"><br></span><br>
                                        <div class="progress progress-striped active">
                                            <div class="bar" id="bare" style="width: 0%;"></div>
                                        </div>
                                    </span>
                                </p>
                            </div>
						</div>
					</div>
			</div>
			<div class="row">
				<div class="span8 alert alert-info offset2">
					<p style="text-align: center;">
							C'est votre premiere utilisation du service ?
							<br> Ne panniquez pas Ceci est une aide rapide:
						</p>
						<ul>
							<li>En premier acceptez les demandes de permition demandéés par java. Si Java n'est pas installé cliquez ici pour le télécharger.</li>
							<li>Assurez vous que votre ordinateur possède un micro ou que un micro est branché.<br>
							Si vous n'en avez pas vous pouvez simplement envoyer un fichier enregistré via un téléphone portable ou dictaphone avec le bouton "parcourir"</li>
							<li>Quand Vous êtes pret cliquez sur le bouton enregistrer. Si le temps n'avance pas, verrifiez simplement que java ne demande pas une nouvelle permition pour votre micro<br>
							Dans ce cas cliquez sur "ne pas bloquer"</li>
							<li>Quand vous penssez que l'enregitrement est terminé cliquez sur arrêter</li>
							<li>Cliquez sur le bouton "ecouter" pour réentendre votre enregistrement. si vous n'êtes pas satisfait cliquez sur le bouton "Enregistrer"</li>
							<li>Quand vous êtes satisfait de votre travail cliquez sur le bouton Envoyer et votre travaille sera envoyé. Apres cette action il est impossible de refaire le sujet, il est considéré comme validé</li>
							<li>Pour ceux qui ont choisi un fichier enregistré depuis leur pc il faut s'assurer que celui-ci est le bon et qu'il vous convient. De même que pour un enregistrement une fois envoyé c'est Terminé !</li>
						</ul>
					</div>
				</div>
        </div>
	</div>
<div id="confirm" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Confirmation de l'envoie</h3>
	</div>
	<div class="modal-body">
		<p>
			<div class="alert alert-warning>">
			Apres avoir cliqué sur le bouton "Envoyer" il ne sera plus possible de revenir en arrière.
			Assurez-vous donc, que votre enregistrement vous convient.
			</div>
		</p>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
		<button class="btn btn-primary" onclick="send();" data-dismiss="modal">Envoyer</button>
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
<script type="text/javascript">
    $(function() {
        $('.tooltipButton').tooltip('show');
    });

	hideProgress();
</script>
</body>
</html>