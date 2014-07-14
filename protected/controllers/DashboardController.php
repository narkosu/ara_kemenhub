<?php

class DashboardController extends Controller
{
	public $layout='column1';

	 /* @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	//in your controller
	function accessRules(){
	  return array(
		//only accessable by admins
		array('allow',
		  'expression'=>'$user->isSuperAdmin',
		   //the 'user' var in an accessRule expression is a reference to Yii::app()->user
		),
		//deny all other users
		array('deny',
		  'users'=>array('*')
		),
	  );
	}

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

	public function actionIndex(){
		$this->render('home');
		/*echo Yii::app()->user->accessLevel.' '.Yii::app()->user->name;
		
		if(Yii::app()->user->isAdmin){
			echo 'Welcome, administrator!';
		 }
		 if(Yii::app()->user->isSuperAdmin){
			echo 'You are the man!';
		 }*/
	}
}