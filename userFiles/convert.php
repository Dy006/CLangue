<?php
session_start();
$ffmpeg_path ="./ffmpeg";
$arg ="-ab 64k -y";


if ($_POST['homeworkId'] != null)
{
	

	$logfile='logs/ffmpeg_'.$_POST['homeworkId'].'_'.$_SESSION['user'].'.log';
	$timelogFile='logs/ffmpeg_time_'.$_POST['homeworkId'].'_'.$_SESSION['user'].'.log'; 
	
	//echo $logfile.'<br>'.$timelogFile;
	if (file_exists($logfile) == false)
	{
		
		$input="wav/record_".$_POST['homeworkId'].'_'.$_SESSION['user'].'.wav';
		$output="mp3/record_".$_POST['homeworkId'].'_'.$_SESSION['user'].'.mp3';
		$line = $ffmpeg_path.' -i '.$input.' '.$arg.' '.$output.' >'.$logfile.' 2>&1 &';
		shell_exec($line);
		echo '0';
		//echo 'exec'.$line;
	}
	else
	{
		$line = 'grep "Duration" '.$logfile;
		$duration = substr(shell_exec($line),11,12);
	//echo '<br>durre '.$duration;

		$line = 'grep "time=" '.$logfile.' > '.$timelogFile;
		shell_exec($line);
		$line = 'sed -i "s:.*time=::g;s: .*::g" '.$timelogFile;
		shell_exec($line);

		$tab = file($timelogFile);
		$last_ligne = $tab[count($tab)-1];
//echo '<br>last'.$last_ligne;
//echo 'lastline '.$last_ligne;

		$donneeD =explode(":",$duration); //chaines séparées par une virgule
		$heure = $donneeD[0];
		$minute = $donneeD[1];
		$seconds = explode(".",$donneeD[2]);
		$second = $seconds[0];
//echo '<br>'.$heure.' m'.$minute.' s'.$second.' ';
		$nbsecondduration = $second+($minute*60)+($heure*3600);
//echo '<br>'.$nbsecondduration;

		$donneeL =explode(":",$last_ligne); //chaines séparées par une virgule
		$heure = $donneeL[0];
		$minute = $donneeL[1];
		$seconds = explode(".",$donneeL[2]);
		$second = $seconds[0];

		$nbsecondactual = $second+($minute*60)+($heure*3600);
//echo '<br>'.$nbsecondactual;

		$persent = $nbsecondactual/$nbsecondduration*100;
		
		if ($persent == '100')
		{
			unlink($timelogFile); 
		}
		
		echo $persent;
	}
/* $logfile='ffmpeg_test.log';
$timelogFile='ffmpeg_time_test.log'; */

//execution of ffmpeg

	//shell_exec($line);
}