<?php

class DefaultController extends Controller
{
	public $layout = '//layouts/main';
	
	public function filters()
	{
		return array(
			'accessControl',
		);
	}	

	public function accessRules() {
		return array(
				array('allow',
					'actions'=>array('index'),
					'users' => array('@'),
					),
				array('allow',
					'actions'=>array('admin','delete', 'view', 'slip', 'invoice'),
					'users' => array('admin'),
					),
				array('deny',  // deny all other users
						'users'=>array('*'),
						),
				);
	}
	
	public function actionIndex()
	{
		//echo Yii::app()->request->getQuery('user');
		
		$this->render('home');
	}
	
	public function actionReviews()
	{
		$getUser = User::model()->find("username='".Yii::app()->request->getQuery('user')."'");
		
		$criteria = new CDbCriteria();
		
		$criteria->compare("user_id",$getUser->id);
		$criteria->order = 'create_date desc';
		
		$count = AdvisorReviews::model()->count($criteria);
		$data->factoryReview->num_reviews = $count;
		$pages=new CPagination($count);

		// results per page
		$pages->pageSize=20;
		$pages->applyLimit($criteria);
		
		
		$reviews = AdvisorReviews::model()->findAll($criteria);
		$this->render('userreviews',array('reviews'=>$reviews,'pages'=>$pages,'total_reviews'=>$count));
		//echo 'write review';
	}
	
	public function actionFactories()
	{
		$getUser = User::model()->find("username='".Yii::app()->request->getQuery('user')."'");
		
		$criteria = new CDbCriteria();
		
		$criteria->compare("user_created",$getUser->id);
		//$criteria->order = 'create_date desc';
		
		$count = Factory::model()->count($criteria);
		//$data->factoryReview->num_reviews = $count;
		$pages=new CPagination($count);

		// results per page
		$pages->pageSize=20;
		$pages->applyLimit($criteria);
		
		
		$reviews = Factory::model()->findAll($criteria);
		$this->render('userfactories',array('reviews'=>$reviews,'pages'=>$pages,'total_reviews'=>$count,'user'=>Yii::app()->request->getQuery('user')));
		//echo 'write review';
	}
	
	public function actionMakereview($id)
	{	
		print_r($_GET);
		echo 'asdasd';
		//$this->render('formwritereview');
		//echo 'write review';
	}
	
	/* search company by using ajax */
	public function actionSearchAjax()
	{
		if ( !empty($_POST['query']) ) {
			$criteria = new CDbCriteria;
			$criteria->compare('company_name',$_POST['query'],true);
			$searchQuery = Factory::model()->findAll($criteria);
		}
		echo $this->renderPartial('search_company',array('searchQuery'=>$searchQuery));
		
	}
	
	/* search company by using ajax */
	public function actionSearch()
	{
		if ( !empty($_GET['query']) ) {
			$criteria = new CDbCriteria;
			$criteria->compare('company_name',$_GET['query'],true);
			$searchQuery = Factory::model()->findAll($criteria);
		}
		echo $this->render('search_company',array('searchQuery'=>$searchQuery));
		
	}
	
}