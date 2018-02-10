<?php

$now=new \DateTime();
$date_start=new \DateTime('12/12/2017');
$diff=date_diff($now,$date_start);

echo utf8_decode("Ви зустрічаєтесь з ідіотом {$diff->y} років {$diff->m} місяців та {$diff->d} днів");