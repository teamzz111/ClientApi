<?php 

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;

class ClienteController extends ActiveController
{
    public $modelClass = 'app\models\Cliente';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'create' => ['POST'],
                    'update' => ['PUT', 'POST'],
                    'delete' => ['POST', 'DELETE'],
                ],
            ],
        ];
    }


}