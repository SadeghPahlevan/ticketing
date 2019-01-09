<?php

namespace frontend\controllers;

use common\models\Stream;
use Yii;
use common\models\Ticket;
use common\models\TicketSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends Controller
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
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TicketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ticket model.
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
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ticket();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ticket model.
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
     * Deletes an existing Ticket model.
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
     * Finds the Ticket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ticket::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionTickets()
    {


        return $this->render('tickets');

    }

    public function actionAddTicket()
    {
        if( Yii::$app->user->identity-> role == 3 ){
            $user_type = 0 ; /* user */
        }else{
            $user_type = 1 ; /* expert */
        }

        if (isset($_POST['response'])) {
            $stream_id = $_POST['stream_id'];
            $response = $_POST['response'];
            $user_type = $user_type ;
            $sql = "insert into ticket (stream_id , response , user_type) VALUES ('$stream_id' , '$response' , '$user_type' ) ";
            $insert = Yii::$app->db->createCommand($sql)->execute();
            if ($insert) {
                $response = ['code' => 200, 'message' => 'کامنت ایجاد شد'];
                return json_encode($response);
            } else {
                $response = ['code' => 400, 'message' => 'ثبت کامنت با مشکل مواجه شد'];
                return json_encode($response);
            }

        } else {
            return $this->render('error', [
                'message' => 'شما به این صفحه دسترسی ندارید',
            ]);
        }
    }

  /*  static function actionTrain(){
        $strem = Stream::findOne(8);

        $tickets = $strem->tickets;

       foreach ($tickets as $ticket){
           echo $ticket['response'];
       }
    } */



}
