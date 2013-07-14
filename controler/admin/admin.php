<?php
include_once 'model/admin/main.php';
include_once 'model/admin/admin.php';

if($_SESSION['user'] != NULL && $_SESSION['category'] == 'Admin')
{
    if ($_GET['a'] == "addUser")
    {
		$resultAddUser = addUser($_POST['username'], $_POST['password'], $_POST['lv1'], $_POST['lv2'], $_POST['category'], $_POST['etablishing'], $_POST['group']);
    }
    elseif ($_GET['a'] == 'deleteUser' && $_GET['id'] != NULL && is_numeric($_GET['id']))
    {
        deleteUser($_GET['id']);
    }
    elseif ($_GET['a'] == 'addGroup')
    {
        $resultAddGroup = addGroup($_POST['namegroup'], $_POST['languagegroup'], $_SESSION['etablishing']);

        /*
        require('fpdf/fpdf.php');

        $pdf = new FPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);

        $header ='Ce document comprend les identifiants de HomeWARK pour le groupe ' . $_POST['namegroup'] . '.';

        $pdf->Cell(0, 10, $header, 0, 1);

        $pdf->Cell(0, 10, '', 0, 1);

        for($i = 0; $i < $_POST['numberOfStudents']; $i++)
        {
            $numberStudent = $i + 1;

            $username = $_POST['usernameStudent' . $numberStudent];
            $password = $_POST['passwordStudent' . $numberStudent];

            $contentFile = NULL;

            for($i2 = 0; $i2 < 4; $i2++)
            {
                if($i2 == 0)
                {
                    $contentFile = 'Bonjour, voici vos identifiants pour la connection sur HomeWARK. Vous appartenez au groupe ' . $_POST['namegroup'] . '.';

                    $pdf->Cell(0, 10, $contentFile, 0, 1);
                }
                elseif($i2 == 1)
                {
                    $contentFile = 'Votre username est : ' . $username;

                    $pdf->Cell(0, 10, $contentFile, 0, 1);
                }
                elseif($i2 == 2)
                {
                    $contentFile = 'Votre password est : ' . $password;

                    $pdf->Cell(0, 10, $contentFile, 0, 1);
                }
                else
                {
                    $pdf->Cell(0, 10, '', 0, 1);
                }
            }
			
			if (VerifyUser($username))
			{
			addStudent($username, $password, 'Student', $_POST['etablishing']);
			addGroupForStudent($username, $_POST['namegroup'], $_POST['etablishing'], $_POST['langue']);
			}
			else{
				addGroupForStudent($username, $_POST['namegroup'], $_POST['etablishing'], $_POST['langue']);
			}
        }

        $pdf->Output();
        */
    }
    elseif($_GET['a'] == 'addEtablishing')
    {
        $resultAddEtablishing = addEtablishing($_POST['header'] . ' ' . $_POST['nameetablishing']);
    }
	elseif($_GET['a'] == 'getGroups')
	{
		//echo $_POST['etab'];
		echo getGroups($_POST['etab']);
		exit();
	}
    elseif ($_GET['a'] == 'edit')
    {
        include_once 'view/admin/admin_edit.php';

    }
    elseif ($_GET['a'] == 'reinit')
    {
        if ($_GET['u'] != null)
        {
            $retour = reinitPassword($_GET['u']);
        }

    }
    elseif ($_GET['a'] == 'del')
    {
        if ($_GET['u'] != null)
        {
            deleteUser($_GET['u']);
        }
    }

    $listSubjects = getListSubjects();
    $countSubjects = getCountSubjects();

    $listMessages = getListMessages();
    $countMessages = getCountMessages();

    $listGroups = getListGroups();
    $listEtablishings = getListEtablishings();

    include_once 'view/admin/admin.php';
}
else
{
    header("HTTP/1.1 403 Forbidden");

    echo '<html><head><title>403 Forbidden</title></head><body><h1>Forbidden</h1><p>You don\'t have permission to access to this resource on this server.</p></body></html>';

    exit();
}