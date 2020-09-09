<?php

namespace App\Dialog\Domain;

use ZnCore\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'dialog';
    }


}

