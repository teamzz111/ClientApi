<?php 

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use app\models\Cliente;
class ClienteController extends ActiveController
{
    public $modelClass = 'app\models\Cliente';

    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    // restrict access to
                    'Origin' => ['*'],
                    // Allow only POST and PUT methods
                    'Access-Control-Request-Method' => ['POST', 'PUT'],
                    // Allow only headers 'X-Wsse'
                    'Access-Control-Request-Headers' => ['X-Wsse'],
                    // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
                    'Access-Control-Allow-Credentials' => true,
                    // Allow OPTIONS caching
                    'Access-Control-Max-Age' => 3600,
                    // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                    'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
                ],
    
            ],
        ];
    }


    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['delete']);
        unset($actions['update']);
        return $actions;
    }

    public function actionCreate()
    {
        $model = new Cliente();
        $model->load(Yii::$app->request->post(), '');

        $errors = '';

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if(!$model->validate())
        {
            return ['status' => 0, 'message' => $model->errors, 'object' => 'Estado: 200, proceso de verificación de datos fallido.'];
        }


        if($model->save())
        {
            return ['status' => 1, 'message' => 'Registro exitoso ¡enhorabuena!', 'object' => 'Estado: 200, éxito.'];
        }
        else
        {
            return ['status' => 0, 'message' => 'Ups.. Pasó algo inesperado.', 'object' => 'Error desconocido'];
        }
    }

     public function actionDelete($id)
     {
        try  
        {
            $cliente = Cliente::findOne($id);    
        } 
        catch (Exception $e) 
        {
            return ['status' => 0, 'message' => 'Hubo un problema borrando el registro', 'object' => $e->getMessage()];
        }
        if($cliente->delete())
        {
            return ['status' => 1, 'message' => 'Registro eliminado', 'object' => 'Estado: 200, éxito.'];
        }        
        else 
        {
            return ['status' => 0, 'message' => 'Hubo un problema borrando el registro', 'object' => $cliente->errors];
        }
     }   

     public function actionUpdate($id)
     {
        $client = Cliente::find()->where(['ID' => $id ])->one();

        if(count($client) > 0)
        {
            $client->attributes = \yii::$app->request->post();
            if($client->save()){
                return array('status' => 1, 'message'=> 'Actualización exitosa', "object" => "Estado: 200, éxito.");
            } 
            else 
            {
                return ['status' => 0, 'message' => ['Hubo un problema actualizando el registro'], 'object' => $client->errors];
            }
        }
        else
        {
            return ['status' => 0, 'message' => 'El usuario no existe', 'object' => '404 id no encontrado'];
        }
     }
}