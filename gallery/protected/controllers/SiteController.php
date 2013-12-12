<?php

use \Doctrine\DBAL\Configuration;
use \Doctrine\DBAL\DriverManager;
use \Doctrine\DBAL\Connection;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $config = new Configuration();
//..
        $connectionParams = array(
            'dbname' => 'facebookgallery',
            'user' => 'facebookgallery',
            'password' => 'facebookgallery',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );

        $conn = DriverManager::getConnection($connectionParams, $config);

        $stmt = $conn->executeQuery(
            "SELECT * FROM album WHERE id = :id",
            array('id' => 1)
        );
        $stmt = $conn->executeQuery(
            "SELECT * FROM album WHERE id IN(?)",
            array(array(1, 2, 3)),
            array(Connection::PARAM_INT_ARRAY)
        );

        $schema = new \Doctrine\DBAL\Schema\Schema();


        var_dump($stmt->fetchAll());
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
        $paths = array(__DIR__ ."/../doctrine_models");
        $isDevMode = true;

        $dbParams = array(
            'dbname' => 'facebookgallery',
            'user' => 'facebookgallery',
            'password' => 'facebookgallery',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $entityManager = EntityManager::create($dbParams, $config);

//        $product = new Product();
//        $product->name = 'Amidala';
//
//        $entityManager->persist($product);
//        $entityManager->flush();

//        $repository = $entityManager->getRepository('Product');
//        $products = $repository->findAll();

        $product = $entityManager->find('Product', 1);

        if ($product === null) {
            echo "Product 1 does not exist.\n";
            exit(1);
        }


        $product->name = 'New name';

        $entityManager->flush();

        var_dump($product);

		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}