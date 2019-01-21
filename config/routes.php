<?php

use yii\web\UrlRule;

return array(
    'class' => 'yii\rest\UrlRule',
    'controller' => 'ClienteController',
	'POST <controller:\w+>s' => '<controller>/create', // 'mode' => UrlRule::PARSING_ONLY will be implicit here
	'<controller:\w+>s'      => '<controller>/index',
	'PUT <controller:\w+>/<id:\d+>'    => '<controller>/update', // 'mode' => UrlRule::PARSING_ONLY will be implicit here
	'DELETE <controller:\w+>/<id:\d+>' => '<controller>/delete', // 'mode' => UrlRule::PARSING_ONLY will be implicit here
	'<controller:\w+>/<id:\d+>'        => '<controller>/view'
);