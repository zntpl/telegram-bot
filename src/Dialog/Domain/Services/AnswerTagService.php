<?php

namespace App\Dialog\Domain\Services;

use App\Dialog\Domain\Interfaces\Services\AnswerTagServiceInterface;
use App\Dialog\Domain\Interfaces\Repositories\AnswerTagRepositoryInterface;
use ZnCore\Domain\Base\BaseCrudService;
use ZnCore\Domain\Helpers\EntityHelper;

class AnswerTagService extends BaseCrudService implements AnswerTagServiceInterface
{

    public function __construct(AnswerTagRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function answerIdsByTagIds(array $tagIds): array {
        $collection = $this->repository->allByTagIds($tagIds);
        return EntityHelper::getColumn($collection, 'answerId');
    }
}
