<?php

namespace app\controllers;

use app\models\Author;
use app\models\Subscription;
use Throwable;
use Yii;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SubscriptionController extends Controller
{
    /**
     * @param $author_id
     * @return Response|string
     * @throws NotFoundHttpException
     * @throws Exception
     */
    public function actionSubscribe($author_id): Response|string
    {
        $author = Author::findOne($author_id);
        if (!$author) {
            throw new NotFoundHttpException('Автор не найден.');
        }

        $model = new Subscription();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Вы успешно подписались на автора.');
            return $this->redirect(['author/view', 'id' => $author_id]);
        }

        return $this->render('subscribe', [
            'model' => $model,
            'author' => $author,
        ]);
    }

    /**
     * @param $author_id
     * @return Response|string
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function actionUnsubscribe($author_id): Response|string
    {
        $author = Author::findOne($author_id);
        if (!$author) {
            throw new NotFoundHttpException('Автор не найден.');
        }

        if (Yii::$app->request->isPost) {
            $model = Subscription::findOne(['author_id' => $author_id, 'phone' => Yii::$app->request->post('Subscription')['phone']]);
            if ($model) {
                $model->delete();
                Yii::$app->session->setFlash('success', 'Вы успешно отписались от автора.');
                return $this->redirect(['author/view', 'id' => $author_id]);
            }
        }

        return $this->render('unsubscribe', [
            'model' => new Subscription(),
            'author' => $author,
        ]);
    }
}
