<?php

$currentMinets = mktime(date('H'), date('m') - 1, date('s'), date('m'), date('d'), date('Y'));

$timeStart = microtime();
$timeStart2 = explode(' ', $timeStart);
$timeStart2[1] = $timeStart2[1] - $currentMinets;
$timeStart2 = $timeStart2[1] + $timeStart2[0];

require $_SERVER['DOCUMENT_ROOT'] . '/Wings/Wings.php';

$wings = new Wings();

$wings->Start();

$wings->View();

$timeEnd = microtime();
$timeEnd2 = explode(' ', $timeEnd);
$timeEnd2[1] = $timeEnd2[1] - $currentMinets;
$timeEnd2 = $timeEnd2[1] + $timeEnd2[0];

$timeDur = $timeEnd - $timeStart;

trace($timeDur);

?>