<?php

namespace backend\modules\business\controllers;

use common\models\MerchantPrice;
use common\models\MerchantPriceSearch;
use PHPExcel_IOFactory;
use Yii;
use common\models\Merchant;
use common\models\MerchantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MerchantController implements the CRUD actions for Merchant model.
 */
class MerchantController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Merchant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MerchantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIn($id) {
        if (Yii::$app->request->isPost && !empty($_FILES)) {
            set_time_limit(0);

            $phpExcelObj = PHPExcel_IOFactory::load($_FILES['price_file']['tmp_name']);
            $phpExcelObj->setActiveSheetIndex(0);
            $objWorksheet = $phpExcelObj->getActiveSheet();
            $highestRow = $objWorksheet->getHighestRow(); // 取得总行数
            $highestColumn = $objWorksheet->getHighestColumn(); // 总列数

            if ($highestColumn < 'C') {
                Yii::$app->session->setFlash('danger', 'EXCEL列数不对');
                return $this->redirect(['index']);
            }

            if ($highestRow <= 1) {
                Yii::$app->session->setFlash('danger', 'EXCEL不可以为空');
                return $this->redirect(['index']);
            }

            // 校验数据
            for ($row = 2; $row <= $highestRow; $row++) {
                for ($column = 0; $column <= MerchantPrice::EXCEL_MAX_COL; $column++) {
                    $value = trim($objWorksheet->getCellByColumnAndRow($column, $row)->getValue());
                    if (empty($value)) {
                        Yii::$app->session->setFlash('danger', $row.'行-'.$column.'列不可以为空');
                        return $this->redirect(['index']);
                    }
                }
            }

            /** @var FileMutex $mutex */
            $mutex = \Yii::$app->mutex;
            if($mutex->acquire('HolidaysSet')) {
                try {
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $tmp = [];
                        for ($column = 0; $column <= MerchantPrice::EXCEL_MAX_COL; $column++) {
                            if (in_array($column, [0, 1])) {
                                $item = trim($objWorksheet->getCellByColumnAndRow($column, $row)->getFormattedValue());
                            } else {
                                $item = trim($objWorksheet->getCellByColumnAndRow($column, $row)->getValue());
                            }

                            $tmp[] = trim($item);
                        }

                        $data = [
                            "merchant_id" => $id,
                            "start" => $tmp[0],
                            "end" => $tmp[1],
                            "price" => $tmp[2] * 10,
                            "status" => MerchantPrice::STATUS_Y,
                            "create_time" => date('Y-m-d H:i:s'),
                            "update_time" => date('Y-m-d H:i:s'),
                        ];

                        $result = Yii::$app->db->createCommand()->insert(MerchantPrice::tableName(), $data)->execute();
                        if (!$result) {
                            throw new \Exception('写入失败', -1);
                        }
                    }

                    Yii::$app->session->setFlash('success', '导入成功');
                } catch (Exception $e) {
                    $mutex->release('HolidaysSet');
                    Yii::$app->session->setFlash('danger', '导入失败');
                    throw $e;
                }

                $mutex->release('HolidaysSet');
            }

            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->render('in');
        }
    }

    /**
     * Displays a single Merchant model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new MerchantPriceSearch();
        $dataProvider = $searchModel->search([
            'MerchantPriceSearch' => [
                'merchant_id' => $id,
                'status' => MerchantPrice::STATUS_Y
            ]
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Creates a new Merchant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Merchant();

        if ($model->load(Yii::$app->request->post())) {
            $model->create_time = date('Y-m-d H:i:s');
            $model->update_time = date('Y-m-d H:i:s');

            $fileInstance = UploadedFile::getInstance($model, 'logo');
            if ($fileInstance) {
                $name = $fileInstance->baseName . time() . '.' . $fileInstance->extension;
                $path = Yii::$app->basePath . '/web/uploads/' . $name;
                $fileInstance->saveAs($path);
                $model->logo = $name;
            }

            $lat_lng = $model->geocodingAddress();
            $model->lat = !empty($lat_lng) ? (string)$lat_lng['lat'] : '0';
            $model->lng = !empty($lat_lng) ? (string)$lat_lng['lng'] : '0';

            if ($model->validate() && $model->save()) {
                return $this->redirect(['view', 'id' => $model->merchant_id]);
            } else {
                Yii::$app->session->setFlash('danger', '错误!'.json_encode($model->getErrors(), JSON_UNESCAPED_UNICODE));
                return $this->render('create', ['model' => $model]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Merchant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->update_time = date('Y-m-d H:i:s');

            $fileInstance = UploadedFile::getInstance($model, 'logo');
            if ($fileInstance) {
                $name = $fileInstance->baseName . time() . '.' . $fileInstance->extension;
                $path = Yii::$app->basePath . '/web/uploads/' . $name;
                $fileInstance->saveAs($path);
                $model->logo = $name;
            }

            $lat_lng = $model->geocodingAddress();
            $model->lat = !empty($lat_lng) ? (string)$lat_lng['lat'] : '0';
            $model->lng = !empty($lat_lng) ? (string)$lat_lng['lng'] : '0';

            if ($model->validate() && $model->save()) {
                return $this->redirect(['view', 'id' => $model->merchant_id]);
            } else {
                Yii::$app->session->setFlash('danger', '错误!'.json_encode($model->getErrors(), JSON_UNESCAPED_UNICODE));
                return $this->render('update', ['model' => $model]);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Merchant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $priceModel = $this->findPriceModel($id);
        $priceModel->updateAttributes(['status' => MerchantPrice::STATUS_N]);
        return $this->redirect(['view', 'id' => $priceModel->merchant_id]);
    }

    /**
     * Finds the Merchant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Merchant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Merchant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findPriceModel($id)
    {
        if (($model = MerchantPrice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
