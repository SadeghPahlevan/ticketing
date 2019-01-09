<?php

namespace frontend\controllers;

use common\models\Media;
use common\models\Rate;
use Yii;
use common\models\Stream;
use common\models\StreamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

/**
 * StreamController implements the CRUD actions for Stream model.
 */
class StreamController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Stream models.
     * @return mixed
     */
    public function actionList()
    {
       
            $user_id = Yii::$app->user->id ;
            $sql = Stream::find()->where(['user_id' => $user_id]) ;
            $dataProvider = new ActiveDataProvider(
                [
                    'query'=>$sql,
                ]

            );
            return $this->render('list',['dataProvider'=>$dataProvider]);


    }
    public function actionIndex()
    {

            $searchModel = new StreamSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,

            ]);


    }

    public function actionKartabl()
    {
        return $this->render('kartabl');

    }
    public function actionDone()
    {
        return $this->render('done');

    }


    /**
     * Displays a single Stream model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Stream model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       $user = Yii::$app->user->id ;
        $model = new Stream();
        $model -> user_id = $user ;
        $model -> status = 1 ;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $image_name = Media::uploadImage('name','600','400','stream');

            $model = new Media();

            $model -> type = "img";
            $model -> name = $image_name ;
            $model -> save();
            return $this->redirect(['list', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Stream model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Stream model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Stream model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stream the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stream::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionStatus(){
        if (isset($_POST['stream_id'])) {
           /* $stream_id=$_POST['stream_id'];
            $sql = "UPDATE stream SET status = 2 WHERE id = $stream_id";
            $stream=Yii::$app->db->createCommand($sql)->execute(); */
            $stream = Stream::findOne($_POST['stream_id']);
            $stream->status = 2;
            $stream->save();

            if ($stream) {
                $response = ['code' => 200, 'message' => ' تغییر وضعیت به اتمام '];
                return json_encode($response);
            } else {
                $response = ['code' => 400, 'message' => 'ایجاد مشکل'];
                return json_encode($response);
            }

        } else {
            return $this->render('error', [
                'message' => 'شما به این صفحه دسترسی ندارید',
            ]);
        }
    }

    public function actionRate(){
        if (isset($_POST['stream_id'])) {
            $rate = new Rate();
            $rate->stream_id = $_POST['stream_id'];
            $rate->text = $_POST['text'];
            $rate->rate = $_POST['rate'];
            $rate->save();
            if ($rate) {
                return $this->redirect('index');
            }

        } else {
            return $this->render('error', [
                'message' => 'شما به این صفحه دسترسی ندارید',
            ]);
        }
    }

}
