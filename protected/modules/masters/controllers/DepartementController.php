<?php

class DepartementController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/main', meaning
	 * using two-column layout. See 'protected/views/layouts/main.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','setCurrentDepartement'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Departement;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Departement']))
		{
			$model->attributes=$_POST['Departement'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Departement']))
		{
			$model->attributes=$_POST['Departement'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Departement('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Departement']))
			$model->attributes=$_GET['Departement'];
		
		
		/*$criteria = new CDbCriteria;
		// bro-tip: $_REQUEST is like $_GET and $_POST combined
		if (isset($_REQUEST['Departement']) && isset($_REQUEST['Departement']{0})) {
			// use operator ILIKE if using PostgreSQL to get case insensitive search
			$criteria->addSearchCondition('name', $_REQUEST['Departement'], true, 'AND', 'ILIKE');
		}
		 
		$sort = new EDTSort('Departement', $sortableColumnNamesArray);
		$sort->defaultOrder = 'id';
		$pagination = new EDTPagination();
		 
		$dataProvider = new CActiveDataProvider('Departement', array(
			'criteria'      => $criteria,
			'pagination'    => $pagination,
			'sort'          => $sort,
		));
		*/
		$columns = array(
				'id',
				'name',
				'status',
				array(
					'class'=>'CButtonColumn',
				));
		/*
		$widget=$this->createWidget('ext.EDataTables.EDataTables', array(
			'id'            => 'departement',
			'dataProvider'  => $model->search(),
			'ajaxUrl'       => Yii::app()->getBaseUrl().'/index.php/masters/departement',
			'columns'       => $columns,
		   ));
		
		if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
			$this->render('index', array('widget' => $widget,));
		  return;
		} else {
		  echo json_encode($widget->getFormattedData(intval($_REQUEST['sEcho'])));
		  Yii::app()->end();
		}
		*/
		$this->render('index',array(
			'dataProvider'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Departement('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Departement']))
			$model->attributes=$_GET['Departement'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Departement::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='departement-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionsetCurrentDepartement($id)
	{
		$currentDepartement = $this->loadModel($id);
		Yii::app()->user->setState('current_departement',null);
		Yii::app()->user->setState('current_departement_id',$id);
		Yii::app()->user->setState('current_departement_name',$currentDepartement->name);
		echo Yii::app()->user->getState('current_departement_name');
	}
}
