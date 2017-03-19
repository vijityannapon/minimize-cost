<?php 

$days = [1,3,5,8,9,10];
$tickets =  ['1' => 2, '7' => 7, '30' => 25];

// Set Matrix Array
foreach($days as $day) {

    foreach($days as $min) {

        $period = (($day+1) - $min);

        $dimentions[$day][$min] = $period;
        $minCost[$day][$min] = $tickets[1];

    }
}

foreach($dimentions as $key => $dimens) {

    foreach($dimens as $dimKey => $item) {

        if (array_key_exists($item, $tickets) && $item>1) {

            foreach(range($key, $dimKey) as $remove) {
                unset($dimentions[$key][$remove]);
                unset($minCost[$key][$remove]);
            }
            $minCost[$key][$dimKey] = $item;
        }

    }
}

foreach($minCost as $minKey => $min) {
    $sum = array_sum($min);

    if (!isset($lastCost)) {
        $lastCost = $sum;
        $minTicket = $min;
    } else {
       if ($sum < $lastCost) {
            $lastCost = $sum;
            $minTicket = $min;

       }
    } 
}

foreach($minTicket  as $buy) {
    echo 'Ticket : '.array_search($buy, $tickets)." Days <br />";
}
echo 'Minimize cost is '.$lastCost." THB <br />";
