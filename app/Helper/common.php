<?php

use Ramsey\Uuid\Uuid;



function getUID()
{
    $uuid = Uuid::uuid4();
    return $uuid->toString();
}



