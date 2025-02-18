<?php

namespace app\queue;

use app\models\Subscription;
use Yii;
use yii\base\BaseObject;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use yii\queue\JobInterface;

class SmsNotify extends BaseObject implements JobInterface
{
    public int $authorId;
    public string $bookTitle;

    private string $apiUrl = 'https://smspilot.ru/api.php';

    /**
     * @param $queue
     * @return void
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function execute($queue): void
    {
        $subscribers = Subscription::find()
            ->joinWith('author')
            ->where(['author.id' => $this->authorId])
            ->all();

        foreach ($subscribers as $subscriber) {
            $message = "Новая книга \"{$this->bookTitle}\" от {$subscriber->author->full_name}!";
            $this->sendMessage($message, $subscriber->phone);
        }
    }

    /**
     * @return void
     * @throws InvalidConfigException
     * @throws Exception
     */
    private function sendMessage(string $message, string $phone): void
    {
        $apiKey = Yii::$app->params['smsPilotApiKey'];
        $client = new Client();

        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl($this->apiUrl)
            ->setData([
                'send' => $message,
                'to' => $phone,
                'apikey' => $apiKey,
                'format' => 'json',
            ])
            ->send();

        if (!$response->isOk) {
            throw new Exception('Failed to send SMS');
        }

        Yii::info('SMS sent to ' . $phone);
    }
}