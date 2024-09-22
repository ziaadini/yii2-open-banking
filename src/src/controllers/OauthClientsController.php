<?php

namespace sadi01\openbanking\controllers;

use sadi01\openbanking\models\ObOauthClients;
use sadi01\openbanking\models\ObOauthClientsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ObOauthClientsController implements the CRUD actions for ObOauthClients model.
 */
class OauthClientsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => [
                                'index', 'view', 'create', 'update', 'delete'
                            ],
                            'roles' => [
                                '@'
                            ],
                            'allow' => true,
                        ],
                    ]
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ObOauthClients models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ObOauthClientsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ObOauthClients model.
     * @param int $id شناسه
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ObOauthClients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($platform)
    {
        $model = new ObOauthClients(['scenario' => $platform == ObOauthClients::PLATFORM_FARABOOM ? ObOauthClients::SCENARIO_FARABOOM : ObOauthClients::SCENARIO_FINNOTECH]);
        $model->client_id = $platform;

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }


        return $this->render('create', [
            'model' => $model,
            'platform' => $platform,

        ]);
    }

    /**
     * Updates an existing ObOauthClients model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id شناسه
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->scenario = $model->client_id == ObOauthClients::PLATFORM_FARABOOM ? ObOauthClients::SCENARIO_FARABOOM : ObOauthClients::SCENARIO_FINNOTECH;

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ObOauthClients model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id شناسه
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ObOauthClients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id شناسه
     * @return ObOauthClients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ObOauthClients::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('main', 'The requested page does not exist.'));
    }
}