<?php

class AjaxController extends Controller
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
					'actions'=>array('Recalculate','UpdateAllRekomenasi'),
					'users' => array('@'),
					),
				
				array('deny',  // deny all other users
						'users'=>array('*'),
						),
				);
	}
	
	public function actionIndex()
	{
		//echo Yii::app()->request->getQuery('user');
		/*$model=new Masterskj('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Masterskj']))
			$model->attributes=$_GET['Masterskj'];
		*/	
		$this->render('home',array(
			//'model'=>$model,
		));
	}
	
  /*
   * Ajax Action for calculate assessment
   * 
   * input is post only 
   */
  
  public function actionRecalculate()
	{
    $_POST['pid'] = 10;
    $PenilaianDetail  = Detailpenilaian::model()
                          ->findAll('penilaian_id = :pid'
                            ,array(':pid'=>$_POST['pid'])
                            );
    foreach ((array) $PenilaianDetail as $key=>$data){
      $asses = Assessment::model();
      //$inputNilai,$standard,$jenisNilai,$departement,$jumlahkompetensi,
      $jumlahkompetensi =  $data->penilaian->jumlahKompetensiAvailable($data->jeniskompetensi_id);
      
      $asses->inputNilai = $data->nilai;
      $asses->standard = $data->nilai_default;
      $asses->departement = $data->penilaian->departement_id;
      $asses->jumlahkompetensi = $jumlahkompetensi;
      
      $result += $asses->calculate();
    }
    
    echo $result;
	}
  
  public function actionUpdateAllRekomenasi($departement_id){
    $asses = Assessment::model();
    echo $departement_id;
    $asses->setAllRekomendasi($departement_id);
  }
  
	public function actionLoadProcessing(){
		$criteria=new CDbCriteria;
		if ($this->module->current_departement_id)
			$criteria->compare('departement_id',$this->module->current_departement_id);
		
		$Count = Masterskj::model()->count($criteria);
		
		//$criteria->with = array('dept');
		$criteria->offset = $_GET['iDisplayStart'];
		
		$criteria->limit = $_GET['iDisplayLength'];
		
		
		$items = Masterskj::model()
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
	
	
}