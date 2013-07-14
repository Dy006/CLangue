<?php
include_once 'model/admin/main.php';
include_once 'model/admin/addWork.php';
include_once 'model/admin/editWork.php';

if($_SESSION['user'] != NULL && $_SESSION['category'] != 'Student')
{
    if ($_GET['id'] != NULL && is_numeric($_GET['id']))
    {
        $infoSubject = getSubject($_GET['id']);

        if($infoSubject[1] == $_SESSION['user'] || $_SESSION['category'] == 'Admin')
        {
            $questions = getQuestionsForSubject($_GET['id']);

            include_once 'view/admin/editWork.php';
        }
        else
        {
            header("HTTP/1.1 403 Forbidden");

            echo '<html><head><title>403 Forbidden</title></head><body><h1>Forbidden</h1><p>You don\'t have permission to access to this resource on this server.</p></body></html>';

            exit();
        }
    }
    elseif($_POST['id'] != NULL && is_numeric($_POST['id']))
    {
        if($_POST['type'] == 'QCM')
        {
            deleteQuestionsAndAnswers($_POST['id']);
            saveEditSubject($_POST['enonce'], $_POST['id']);

            for ($i = 0; $i < $_POST['numberQuestions']; $i++)
            {
                $questionIdForm = $i + 1;
                $inputQuestion = $_POST['inputQuestion_' . $questionIdForm];

                if ($inputQuestion != NULL && $inputQuestion != "")
                {
                    $numberAnswers = $_POST['numberAnswers_' . $questionIdForm];
                    $questionId = addQuestion($_POST['id'], $questionIdForm, $inputQuestion);

                    for ($i2 = 0; $i2 < $numberAnswers; $i2++)
                    {
                        $answerId = $i2 + 1;
                        $inputAnswer = 'inputAnswer' . $questionIdForm . '_' . $answerId;

                        if ($inputAnswer == $_POST['radioAnswer' . $questionIdForm])
                        {
                            $valid = 1;
                        }
                        else
                        {
                            $valid = 0;
                        }

                        if($_POST[$inputAnswer] != NULL && $_POST[$inputAnswer] != "")
                        {
                            addAnswer($_POST[$inputAnswer], $questionId, $valid);
                        }
                    }
                }
            }
        }
        else
        {
            saveEditSubject($_POST['enonce'], $_POST['id']);
        }

        header('Location: ../../../admin/work');
    }
    else
    {
        header("HTTP/1.1 403 Forbidden");

        echo '<html><head><title>403 Forbidden</title></head><body><h1>Forbidden</h1><p>You don\'t have permission to access to this resource on this server.</p></body></html>';

        exit();
    }
}
else
{
    header("HTTP/1.1 403 Forbidden");

    echo '<html><head><title>403 Forbidden</title></head><body><h1>Forbidden</h1><p>You don\'t have permission to access to this resource on this server.</p></body></html>';

    exit();
}