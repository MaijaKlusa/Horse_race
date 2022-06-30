<?php

$distance = 20;

$minSpeed = 1;
$maxSpeed = 3;

$players = explode(' ', readline('Enter players: '));

$yourFavourite = readline('Select a player: ');
$bet = readline('Place your bet: ');

$firstPlace = $bet * 3;
$secondPlace = $bet * 2;
$thirdPlace = $bet;

$track = [];

for ($i = 0; $i < count($players); $i++) {
    $track[$i] = array_fill(0, $distance, '-');
    $track[$i][0] = $players[$i];
}

$iterations = 0;

$winners = [];

while (count($winners) < count($players))
{
    system('clear');

    for ($i = 0; $i < count($players); $i++) {

        $currentPosition = array_search($players[$i], $track[$i]);

        if ($currentPosition === false) continue;

        $step = rand($minSpeed, $maxSpeed);
        $nextPosition = $currentPosition + $step;

        if ($nextPosition > $distance) {
            $nextPosition = $distance;
        }

        if (! in_array($players[$i], $winners)) {
            $track[$i][$nextPosition] = $players[$i];
            $track[$i][$currentPosition] = '-';
        }

        if ($nextPosition === $distance && ! in_array($players[$i], $winners)) {
            $winners[] = $players[$i];
        }
    }

    foreach ($track as $line) {
        echo implode('', $line);
        echo "\n";
    }

    $iterations++;

    sleep(1);
}

foreach ($winners as $place => $player) {
    $place = $place + 1;
    echo "#{$place} - $player" . "\n";
}

if (in_array($yourFavourite, $winners)) {
    if ($yourFavourite == $winners[0]) {
        echo "You won {$firstPlace}!!!" . "\n";
    } elseif ($yourFavourite == $winners[1]) {
        echo "You won {$secondPlace}!!" . "\n";
    } elseif ($yourFavourite === $winners[2]) {
        echo "You won {$thirdPlace}!" . "\n";
    } else {
        echo "Try again." . "\n";
    }
}
