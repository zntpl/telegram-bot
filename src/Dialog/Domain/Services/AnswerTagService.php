<?php

namespace App\Dialog\Domain\Services;

use App\Dialog\Domain\Interfaces\Services\AnswerTagServiceInterface;
use App\Dialog\Domain\Interfaces\Repositories\AnswerTagRepositoryInterface;
use ZnCore\Base\Domain\Base\BaseCrudService;
use ZnCore\Base\Domain\Helpers\EntityHelper;

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
