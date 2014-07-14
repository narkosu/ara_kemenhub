<?php

class MasterasesorController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
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
				'actions'=>array('index','view','LoadProcessing','LoadPesertaProcessing'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','assesspeserta','Availablepeserta'),
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
			'params'=>array('assessor_id'=>$id)
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Masterasesor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Masterasesor']))
		{
			$model->attributes=$_POST['Masterasesor'];
			if($model->save()){
				$user = new User;
        $user->username = $model->kode_asesor;
        $user->accessLevel = User::LEVEL_AUTHOR;
        $user->generatePassword('demo');
        if ($user->save()){
          $this->redirect(array('index'));
        }else{
          
        }
        //$this->redirect(array('index','id'=>$model->id));
      }  
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates asses pesert
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAssesspeserta($id)
	{
		$assessor = Masterasesor::model()->findByPk($id);
		$criteria=new CDbCriteria;
		$criteria->compare('id_asesor',$id);
		$criteria->compare('id_departemen',$this->module->current_departement_id);
		
		//$model = Pesertaasesor::model()->findAll($criteria);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		$this->render('assessorpeserta',array(
			//'model'=>$model,
			'assessor'=>$assessor,
			'params'=>array('assessor_id'=>$id)
		));
	}
	
	/**
	 * Creates asses pesert
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAvailablepeserta($id)
	{
		$criteria=new CDbCriteria;
		$criteria->select = 't.*';
		$criteria->compare('t.id_departemen',$this->module->current_departement_id);
		$criteria->join = 'LEFT JOIN '.Pesertaasesor::model()->tableName().' a ON t.id = a.id_peserta ';
		$criteria->addCondition('a.id_asesor = null');
		
		$model = Peserta::model()->findAll($criteria);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		$this->render('peserta',array(
			'model'=>$model,
			'params'=>array('assessor_id'=>$id)
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

		if(isset($_POST['Masterasesor']))
		{
			$model->attributes=$_POST['Masterasesor'];
			if($model->save()){
				Yii::app()->user->setFlash('asessor_success', "Data sudah tersimpan");
				$this->redirect(array('update','id'=>$model->id));
			}
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
		/*$dataProvider=new CActiveDataProvider('Masterasesor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		*/
		/*$model=new Masterasesor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Masterasesor']))
			$model->attributes=$_GET['Masterasesor'];
		*/
		$this->render('admin',array(
			//'model'=>$model,
		));
	}

	/*
	 * Load Peserta Processing
	 * return json
	 */
	public function actionLoadPesertaProcessing($id){
		$criteria=new CDbCriteria;
		$criteria->compare('id_asesor',$id);
		$criteria->compare('id_departemen',$this->module->current_departement_id);
		$return = Pesertaasesor::model()->datatables($criteria);
		echo json_encode($return);
	}
	
	public function actionLoadProcessing(){
		$criteria=new CDbCriteria;
		//$criteria->compare('id_departemen',$this->module->current_departement_id);
		if ( !empty($_GET['sSearch'])){
			$criteria->compare('nama_asesor',$_GET['sSearch'],true,'AND',TRUE);
		}
    
		$Count = Masterasesor::model()->count($criteria);
		
		//$criteria->with = array('dept');
		$criteria->offset = $_GET['iDisplayStart'];
		
		$criteria->limit = $_GET['iDisplayLength'];
		
		
		$items = Masterasesor::model()
			->findAll($criteria);
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $Count,
			"iTotalDisplayRecords" => $Count,
			"aaData" => array()
		);

		foreach ($items as $i=>$iskj){
			unset($row);
			
			foreach ($iskj as $field => $vale){
				/*if ( $field == 'id_departemen') {
					$row[] = $iskj->dept->name;
				}else 
				if ( $field == 'deputi_id') {
					$row[] = $iskj->deput->deputi_name;
					
				} else
				if ( $field == 'unitkerja_id') {
					$row[] = $iskj->uk->unitkerja_name;
					
				} else if ( $field == 'jabatan_id') {
					$row[] = $iskj->jab->jabatan_name;
					
				} else if ( $field == 'tingkatjabatan_id') {
					$row[] = $iskj->t_jab->tingkat_jabatan;
					
				} else if ( $field == 'rumpunjabatan_id') {
					$row[] = $iskj->r_jab->rumpun_jabatan;
					
				} else {*/
					$row[] = $vale;
				//}
			}
			$row[] = $iskj->id;//for else
			$output['aaData'][] = $row;
		}
		
		//print_r($_GET);
		echo json_encode($output);
	}
	
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Masterasesor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Masterasesor']))
			$model->attributes=$_GET['Masterasesor'];

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
		$model=Masterasesor::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='masterasesor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
