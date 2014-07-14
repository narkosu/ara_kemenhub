<?php

class AnggotaController extends Controller
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
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','rekapitulasi'),
				'expression'=>'$user->isSuperAdmin',
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('asesor'),
				'expression'=>'$user->isSuperAdmin || $user->isAdmin || $user->isAuthor',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','LoadProcessing','LoadProcessingByassessor','LoadProcessingLaporan'),
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
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
      $model->generatePassword($_POST['User']['password']);
			if($model->save())
				$this->redirect(array('index'));
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

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('index'));
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
		//$dataProvider=new CActiveDataProvider('Peserta');
		$model = User::model()->findAll();	
		$this->render('index',array(
			'dataProvider'=>$model,
		));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionAsesor()
	{
		$hasAccess = Userasesor::model()->hasAccess();
		
		$hasAccess->assessor_id;
		
		//$dataProvider=new CActiveDataProvider('Peserta');
		$model=new Peserta('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Peserta']))
			$model->attributes=$_GET['Peserta'];
			
		$this->render('indexassessor',array(
			'dataProvider'=>$model,
			'urlAjax'=> Yii::app()->createUrl('masters/peserta/LoadProcessingByassessor')
		));
	}

	public function actionLoadProcessing(){
		$criteria=new CDbCriteria;
		/*$criteria->compare('id_departemen',$this->module->current_departement_id);
		*/
		$Count = User::model()->count($criteria);
		
		//$criteria->with = array('dept');
		$criteria->offset = $_GET['iDisplayStart'];
		
		$criteria->limit = $_GET['iDisplayLength'];
		
		
		$items = User::model()
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
        
				if ( $field == 'username') {
					$row['username'] = $vale;
				}else{
					$row[] = $vale;
				}
			}
      
      $row['level'] = User::getAccessLevelList($iskj->accessLevel);
      //$row['nama_asesor'] = $iskj->asessor->asesor->nama_asesor;
			$row[] = $iskj->id;//for else
			$output['aaData'][] = $row;
     
     
      
		}
		
		//print_r($_GET);
		echo json_encode($output);
	}
	
	public function actionLoadProcessingByassessor(){
		$hasAccess = Userasesor::model()->hasAccess();
		
		$hasAccess->assessor_id;
		
		$criteria=new CDbCriteria;
		$criteria->compare('id_asesor',$hasAccess->assessor_id);
		$criteria->compare('id_departemen',$this->module->current_departement_id);
		$Count = Pesertaasesor::model()->count($criteria);
		
		$criteria->offset = $_GET['iDisplayStart'];
		
		$criteria->limit = $_GET['iDisplayLength'];
		
		
		$items = Pesertaasesor::model()
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
				
				if ( $field == 'id_peserta') { // relation
					$row['peserta'] = array(
											'nama_peserta'=>$iskj->peserta->nama_peserta,
											'nip'=>$iskj->peserta->nip,
									);	
				}
        
				$row[$field] = $vale;
				
			}
			$row['ids'] = $iskj->id;//for else
			$output['aaData'][] = $row;
		}
		
		//print_r($_GET);
		echo json_encode($output);
	}
	
	public function actionLoadProcessingLaporan(){
		//print_r($_GET);
		$DEFAULTCOL = array('id','id_departemen','nip','nama_peserta','persentase_pemenuhan');
		$hasAccess = Userasesor::model()->hasAccess();
		
		$hasAccess->assessor_id;
		
		$criteria=new CDbCriteria;
		$criteria->compare('id_asesor',$hasAccess->assessor_id);
		$criteria->compare('id_departemen',$this->module->current_departement_id);
		
		if ( !empty($_GET['sSearch'])){
			$criteria->compare('nama_peserta',$_GET['sSearch'],true,'AND',TRUE);
		}
		
		if ( !empty($_GET['iSortCol_0'])){
			 $criteria->order = $DEFAULTCOL[$_GET['iSortCol_0']].' '.$_GET['sSortDir_0'];
			//$criteria->ORDER('nama_peserta',$_GET['sSearch'],true,'AND',TRUE);
		}
		
		$Count = Peserta::model()->count($criteria);
		
		$criteria->offset = $_GET['iDisplayStart'];
		
		$criteria->limit = $_GET['iDisplayLength'];
		
		
		$items = Peserta::model()
			->findAll($criteria);
			
		/*$items = Pesertaasesor::model()
			->findAll($criteria);
		*/	
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $Count,
			"iTotalDisplayRecords" => $Count,
			"aaData" => array()
		);

		foreach ($items as $i=>$iskj){
			unset($row);
			
			foreach ($iskj as $field => $vale){
				
				/*if ( $field == 'id_peserta') { // relation
					$row['peserta'] = array(
											'nama_peserta'=>$iskj->peserta->nama_peserta,
											'nip'=>$iskj->peserta->nip,
									);	
										
					
				}*/ 
				$row[$field] = $vale;
				
			}
			
			$row['penilaian'] = $iskj->penilaian['persentase_pemenuhan'];
			if ( !empty($iskj->penilaian['persentase_pemenuhan'])){
				
				if ( $iskj->penilaian['persentase_pemenuhan'] < 70.5 ){
					$rekomendasi = 'Belum Disarankan';
				}else if ( $iskj->penilaian['persentase_pemenuhan'] < 90.5 ){
					$rekomendasi = 'Dipertimbangkan Dengan Catatan';
				}else{
					$rekomendasi = 'Dapat Disarankan';
				}
				$row['rekomendasi'] = $rekomendasi;
				
			}else{
				$row['rekomendasi'] = '';
			}
			
			$row['ids'] = $iskj->id;//for else
			$output['aaData'][] = $row;
		}
		
		//print_r($output);
		echo json_encode($output);
	}
	
	/*
	 * Laporan
	 */
	
	public function actionRekapitulasi()
	{
		$model=new Peserta('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Peserta']))
			$model->attributes=$_GET['Peserta'];
			
		$this->render('laporan',array(
			'dataProvider'=>$model,
			'urlAjax'=> Yii::app()->createUrl('masters/peserta/LoadProcessingLaporan')
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Peserta('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Peserta']))
			$model->attributes=$_GET['Peserta'];

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
		$model=User::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='peserta-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
