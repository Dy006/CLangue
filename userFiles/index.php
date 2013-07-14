<?php 
$ffmpeg_path ="./ffmpeg";
$input="wav/test.wav";
$output="out.mp3";
$arg ="-ab 96k -y";



/* $logfile='ffmpeg_'.$jobid.'.log';
$timelogFile='ffmpeg_time_'.$jobid.'.log'; */
$logfile='ffmpeg_test.log';
$timelogFile='ffmpeg_time_test.log';

//execution of ffmpeg
$line = $ffmpeg_path.' -i '.$input.' '.$arg.' '.$output.' >'.$logfile.' 2>&1 &';
shell_exec($line);
header('Location: getState.html');