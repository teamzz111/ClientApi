<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id
 * @property string $cedula
 * @property string $correo
 * @property string $nit
 * @property string $nombres
 * @property string $apellidos
 * @property int $tipo_usuario
 * @property string $telefono
 */
class Cliente extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'cliente';
    }

    public function rules()
    {
        return [
            [['cedula', 'correo', 'nombres', 'apellidos', 'tipo_usuario', 'telefono', 'nit'],
                'required', 'message' => 'El campo está {attribute} incompleto', ],
            [['tipo_usuario'], 'integer', 'message' => '{attribute} Acepta únicamente números.'],
            [['cedula', 'telefono'], 'string', 'max' => 11, 'message' => '{attribute} no debe sobrepasar los 11 carácteres.'],
            [['correo'], 'string', 'max' => 50, 'message' => '{attribute} no debe sobrepasar los 50 carácteres.'],
            [['nit'], 'string', 'max' => 16, 'message' => '{attribute} no debe sobrepasar los 16 carácteres.'],
            [['nombres', 'apellidos'], 'string', 'max' => 64, 'message' => '{attribute} no debe sobrepasar los 64 carácteres.'],
            [['cedula', 'correo', 'nit'], 'unique', 'message' => "{attribute} está registrado actualmente."],        
        ];
    }
 
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cedula' => 'Cedula',
            'correo' => 'Correo',
            'nit' => 'Nit',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'tipo_usuario' => 'TipoUsuario',
            'telefono' => 'Telefono',
        ];
    }
}


