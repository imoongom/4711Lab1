<?php
$name = 'Jim';
$what = 'geek';
$level = 10;
echo 'Hi, my name is '.$name,'. and I am a level '.$level.'
'.$what;

echo '</br>';

$hoursworked = 10;
$rate = 12;
$total = $hoursworked * $rate;
echo 'You owe me '.$total;

echo '</br></br>';

switch ($name) {
case 'Jim': $answer = 'great'; break;
case 'George': $answer = 'unknown'; break;
default: $answer = 'unknown';
}
echo $name.' is '.$answer;

echo '</br></br>';

if ($hoursworked > 40) {
$total = $hoursworked * $rate * 1.5;
} else {
$total = $hoursworked * $rate;
}
echo ($total > 0) ? 'You owe me '.$total : "You're welcome";

echo '</br></br></br></br>';

$position = $_GET['board'];
echo $position.'</br>';
$squares = str_split($position);


$theywon = false;
if (($squares[0] == 'x') && ($squares[1] == 'x') && ($squares[2] == 'x')){
    $theywon = true;
} else if (($squares[3] == 'x') && ($squares[4] == 'x') && ($squares[5]
== 'x')) {
    $theywon = true;    
}

echo ($theywon) ? 'They won. ' : 'We won';


?>


