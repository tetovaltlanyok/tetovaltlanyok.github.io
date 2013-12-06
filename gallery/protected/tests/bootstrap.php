<?php

require_once dirname(__FILE__).'/../../../vendor/autoload.php';
require_once dirname(__FILE__).'/../../../vendor/yiisoft/yii/framework/yiit.php';
require_once dirname(__FILE__).'/../../protected/components/WebApplication.php';

$config = dirname(__FILE__).'/../config/test.php';

Yii::createApplication('WebApplication', $config);
