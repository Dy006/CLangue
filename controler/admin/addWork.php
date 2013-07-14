<?php
include_once 'model/admin/main.php';
include_once 'model/admin/addWork.php';

if($_SESSION['user'] != NULL && $_SESSION['category'] != 'Student')
{
    if($_GET['a'] == 'addWork' && $_POST['pro'] == 'qcmlist')
    {
        $subjectId = addSubject($_POST['name'], $_POST['enonce'], $_POST['typeWorkSelect']);

        if($_POST['typeWorkSelect'] == 'QCM')
        {
            for ($i = 0; $i < $_POST['numberQuestions']; $i++)
            {
                $questionIdForm = $i + 1;
                $inputQuestion = $_POST['inputQuestion_' . $questionIdForm];

                if ($inputQuestion != NULL && $inputQuestion != "")
                {
                    $numberAnswers = $_POST['numberAnswers_' . $questionIdForm];
                    $questionId = addQuestion($subjectId, $questionIdForm, $inputQuestion);

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
    }

    $listSubjects = getListSubjects();
    $countSubjects = getCountSubjects();

    $listMessages = getListMessages();
    $countMessages = getCountMessages();

    include_once 'view/admin/addWork.php';
}
else
{
    header("HTTP/1.1 403 Forbidden");

    echo '<html><head><title>403 Forbidden</title></head><body><h1>Forbidden</h1><p>You don\'t have permission to access to this resource on this server.</p></body></html>';

    exit();
}