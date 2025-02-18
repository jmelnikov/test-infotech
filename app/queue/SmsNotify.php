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
            ->where(['author_id' => $this->authorId])
            ->all();

        foreach ($subscribers as $subscriber) {
            $message = "Новая книга \"{$this->bookTitle}\" от {$subscriber->author->full_name}!";
            $this->sendMessage($message, $subscriber->phone);
        }
    }

    /**
     * @param string $message
     * @param string $phone
     * @return void
     * @throws Exception
     * @throws InvalidConfigException
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
            ->send()->getContent();

        $response = json_decode($response, true);

        if (!empty($response['send'])) {
            file_put_contents(
                Yii::getAlias('@runtime/logs/sms.log'),
                sprintf('На номер %s отправлено сообщение со следующим текстом: %s', $phone, $message) . PHP_EOL,
                FILE_APPEND
            );
        } elseif (!empty($response['error'])) {
            file_put_contents(
                Yii::getAlias('@runtime/logs/sms.log'),
                sprintf('Ошибка при отправке сообщения на номер %s: %s', $phone, $response['error']['description']) . PHP_EOL,
                FILE_APPEND
            );
        } else {
            file_put_contents(
                Yii::getAlias('@runtime/logs/sms.log'),
                sprintf('Неизвестная ошибка при отправке сообщения на номер %s', $phone) . PHP_EOL,
                FILE_APPEND
            );
        }
    }
}