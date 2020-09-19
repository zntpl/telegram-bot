<?php

namespace App\Dialog\Domain\Actions;

use ZnLib\Telegram\Domain\Entities\RequestEntity;
use ZnLib\Telegram\Domain\Base\BaseAction;
use ZnLib\Telegram\Domain\Entities\MessageEntity;
use ZnLib\Telegram\Domain\Helpers\MatchHelper;
use App\Dialog\Domain\Helpers\WordHelper;
use App\Dialog\Domain\Libs\Parser;
use Illuminate\Container\Container;
use ZnCore\Base\Exceptions\NotFoundException;
use ZnCore\Base\Helpers\StringHelper;

class DataBaseAction extends BaseAction
{

    public function run(RequestEntity $requestEntity)
    {
        $request = $requestEntity->getMessage()->getText();
        $sentences = WordHelper::textToSentences($request);

        //return;
        foreach ($sentences as $sentence) {
            try {
                $answerText = $this->predict($sentence);
                if ($answerText) {
                    $this->response->sendMessage($requestEntity->getMessage()->getChat()->getId(), $answerText);
                    /*yield $this->messages->sendMessage([
                        'peer' => $update,
                        'message' => $answerText,
                        //'message' => implode(PHP_EOL, $sentences),
                        //'reply_to_msg_id' => isset($update['message']['id']) ? $update['message']['id'] : null,
                    ]);*/
                }
            } catch (NotFoundException $e) {}
        }
    }

    private function predict(string $request)
    {
        $request = MatchHelper::prepareString($request);
        $words = StringHelper::getWordArray($request);

        $container = Container::getInstance();
        /** @var \App\Dialog\Domain\Services\PredictService $predictService */
        $predictService = $container->get(\App\Dialog\Domain\Services\PredictService::class);
        $answerText = $predictService->predict($words);
        return $answerText;
    }

}