<?php

namespace App\Dialog\Domain\Interfaces\Services;

use App\Dialog\Domain\Entities\AnswerEntity;
use ZnCore\Base\Domain\Interfaces\Service\CrudServiceInterface;

interface AnswerServiceInterface extends CrudServiceInterface
{

    public function oneByRequestTextOrCreate(string $word): AnswerEntity;

}

