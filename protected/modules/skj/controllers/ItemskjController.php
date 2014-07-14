<?php

class ItemskjController extends Controller
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
				'actions'=>array('view','load_server_processing'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index'),
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
		$params['skjid'] = $id;
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'params'=>$params
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($skjid)
	{
		$model=new Itemskj;
		$params['skjid'] = $skjid; 
		$masterskj = Masterskj::model()->findByPk($skjid);
		$model->skj_id = $skjid;
		if ( !empty($this->module->current_departement_id) ) {
			$model->departement_id = $this->module->current_departement_id;
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Itemskj']))
		{
			$model->attributes=$_POST['Itemskj'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
			'params'=>$params,
			'masterskj'=>$masterskj
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($skjid,$id)
	{
		$params['skjid'] = $skjid; 
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$modelkompetensisjk = $this->getItemKompetensiById($skjid,$id);
		
		if(isset($_POST['Itemskj']))
		{
			$model->attributes=$_POST['Itemskj'];
					
			if($model->save()) {
				if ( !empty($_POST['Kompetensiskj']) )
				foreach ($_POST['Kompetensiskj'] as $jeniskompetensi=>$kompetensi) {
						
					if ( !empty($kompetensi))
					foreach ($kompetensi as $kompetensi_id => $nilai){
						
						$komptensiSkj = Kompetensiskj::model()->find('
											skj_id = "'.$model->skj_id.' "
											and itemskj_id ="'.$model->id.'"
											and jeniskompetensi_id = "'.$jeniskompetensi.'"
											and kompetensi_id = "'.$kompetensi_id.'"'
											);
						if ( empty($komptensiSkj->skj_id) )
							$komptensiSkj = new Kompetensiskj;
						
						
						$komptensiSkj->skj_id = $model->skj_id;
						
						$komptensiSkj->itemskj_id = $model->id;
						
						$komptensiSkj->jeniskompetensi_id = $jeniskompetensi;
						$komptensiSkj->kompetensi_id = $kompetensi_id;
						$komptensiSkj->nilai = $nilai;
						
						$komptensiSkj->save();
						
					}
				}
				
				$this->redirect(array('Update','skjid'=>$model->skj_id,'id'=>$model->id));
				
			}
		
		}

		$this->render('update',array(
			'model'=>$model,
			'params'=>$params,
			'itemkompetensi'=>$modelkompetensisjk
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
     
       public function actionIndex($id)
	{
		$params['skjid'] = $id;
		$masterSkj = Masterskj::model()->findByPk($id);
		/*$itemskjs = $this->loadItemskj($id);
		$model = Itemskj::model()->findAll('skj_id = :skjid',array(':skjid'=>$id));
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Itemskj']))
			$model->attributes=$_GET['Itemskj'];
		*/
		
		$this->render('index',array(
			//'model'=>$model,
			//'itemskjs'=>$itemskjs,
			'masterskj'=>$masterSkj,
			'params'=>$params
			
		));
	}
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Itemskj('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Itemskj']))
			$model->attributes=$_GET['Itemskj'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadKompetensiskj($skjid,$itemskjid)
	{
		$model=Kompetensiskj::model()->findAll('skj_id = :skjid and itemskj_id = :itemskjid',array(':skjid'=>$skjid,'itemskjid'=>$itemskjid));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function getItemKompetensiById($skjid,$itemskjid){
		static $return, $output;
		if (!$return) {
			$return = $this->loadKompetensiskj($skjid,$itemskjid);
			
			if ($return){
				foreach ($return as $value){
					$output[$value->jeniskompetensi_id][$value->kompetensi_id] = $value->nilai;
				}
			}
		}
		
		return $output;
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Itemskj::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='itemskj-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	private function loadItemskj($skjid){
		$itemSkj = Itemskj::model()->findAll(
					'skj_id = "'.$skjid.'" and departement_id ="'.$this->module->current_departement_id.'"');
		return $itemSkj;
	}
	
	public function actionload_server_processing($skjid){
		
		$itemSkjCount = Itemskj::model()->count('skj_id = "'.$skjid.'" and departement_id ="'.$this->module->current_departement_id.'"');
		
		$criteria=new CDbCriteria;
		$criteria->compare('skj_id',$skjid);
		$criteria->compare('departement_id',$this->module->current_departement_id);
		//$criteria->with = array('dept');
		$criteria->offset = $_GET['iDisplayStart'];
		
		$criteria->limit = $_GET['iDisplayLength'];
		$no = $_GET['iDisplayStart'] + 1;
		
		$itemSkj = Itemskj::model()
			->findAll($criteria);
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $itemSkjCount,
			"iTotalDisplayRecords" => $itemSkjCount,
			"aaData" => array()
		);

		foreach ($itemSkj as $i=>$iskj){
			unset($row);
			$row['no'] = $no;
			foreach ($iskj as $field => $vale){
				
				if ( $field == 'departement_id') {
					$row['departement'] = $iskj->dept->name;
				}else 
				if ( $field == 'deputi_id') {
					$row['deputi'] = $iskj->deput->deputi_name;
					
				} else
				if ( $field == 'unitkerja_id') {
					$row['unitkerja'] = $iskj->uk->unitkerja_name;
					
				} else if ( $field == 'jabatan_id') {
					$row['jabatan'] = $iskj->jab->jabatan_name;
					
				} else if ( $field == 'tingkatjabatan_id') {
					$row['tingkat_jabatan'] = $iskj->t_jab->tingkat_jabatan;
					
				} else if ( $field == 'rumpunjabatan_id') {
					$row['rumpun_jabatan'] = $iskj->r_jab->rumpun_jabatan;
					
				}else if ( $field == 'id') { 
					$row['id'] = $vale;
				}
				
				$row[] = $vale;
				
			}
			$output['aaData'][] = $row;
			$no++;
		}
		
		echo json_encode($output);
		
	}
}