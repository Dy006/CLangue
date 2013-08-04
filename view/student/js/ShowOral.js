/**
 * Created with JetBrains PhpStorm.
 * User: Guillaume
 * Date: 15/07/13
 * Time: 10:03
 * To change this template use File | Settings | File Templates.
 */
var seconde=0 //initialise les secondes
var minute=0 //initialise les minutes
var loaded  = false;
var numberofSeconde = 0;
var added = false;
var HomeworkID, SubjectID;
function setIds(homId,SujID)
{
    HomeworkID = homId;
    SubjectID = SujID;
}
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
        pourcen = window.setInterval('ConvertFile(SubjectID,HomeworkID);' , 400);
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
        document.AudioApplet.recordAudio();
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
        document.AudioApplet.playAudio();

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
        document.AudioApplet.stopAudio();

        window.clearTimeout(compte);

        activateButton('playButton');
        activateButton('recordButton');
        activateButton('selectFileButton');
        activateButton('sendButton');

        disableButton('stopButton');

        document.AudioApplet.saveAudio();
    }
}

function choseFile()
{
    if(loaded)
    {
        document.AudioApplet.choose_file();

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
        document.AudioApplet.UploadToServer();

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
    document.getElementById(id).removeAttribute("disabled")
}

function disableButton(id)
{
    document.getElementById(id).classList.add('disabled');
    document.getElementById(id).setAttribute("disabled", "disabled");
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

function AddScore(subjectId,homeworkId)
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
    OAjax.send('subjectId='+subjectId+'&homeworkId='+homeworkId+'&type=ORAL&time='+document.getElementById('recordTime').innerHTML+'' );
}

function ConvertFile(subjectId,homeworkId)
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
                            AddScore(subjectId,homeworkId);
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
    OAjax.send('homeworkId='+homeworkId );
}
$(function() {
    $('.tooltipButton').tooltip('show');
    $('#help').modal('toggle')
});

activateButton('recordButton');
activateButton('selectFileButton');
hideProgress();