<?php

class PesertaasesorController extends Controller {

  /**
   * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
   * using two-column layout. See 'protected/views/layouts/column2.php'.
   */
  public $layout = '//layouts/main';

  /**
   * @return array action filters
   */
  public function filters() {
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
  public function accessRules() {
    return array(
        array('allow', // allow all users to perform 'index' and 'view' actions
            'actions' => array('index', 'view', 'loadkompetensi'),
            'users' => array('*'),
        ),
        array('allow', // allow authenticated user to perform 'create' and 'update' actions
            'actions' => array('create', 'update', 'penilaian', 'preview', 'download', 'downloadtemp', 'calculate', 'ajaxform'),
            'expression' => '$user->isSuperAdmin || $user->isAdmin || $user->isAuthor',
        ),
        array('allow', // allow admin user to perform 'admin' and 'delete' actions
            'actions' => array('admin', 'delete'),
            'users' => array('admin'),
        ),
        array('deny', // deny all users
            'users' => array('*'),
        ),
    );
  }

  /**
   * Displays a particular model.
   * @param integer $id the ID of the model to be displayed
   */
  public function actionView($id) {
    $this->render('view', array(
        'model' => $this->loadModel($id),
    ));
  }

  public function actionajaxform($pid) {
    $model = $this->loadModelByPeserta($pid);

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if (isset($_POST['Pesertaasesor'])) {
      $model->attributes = $_POST['Pesertaasesor'];
      if ($model->save())
        $this->redirect(array('view', 'id' => $model->id));
    }

    $this->renderPartial('_formajax', array(
        'model' => $model,
    ));
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate() {
    $model = new Pesertaasesor;

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if (isset($_POST['Pesertaasesor'])) {
      $model->attributes = $_POST['Pesertaasesor'];
      if ($model->save())
        $this->redirect(array('view', 'id' => $model->id));
    }

    $this->render('create', array(
        'model' => $model,
    ));
  }

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionUpdate($id) {
    $model = $this->loadModel($id);

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if (isset($_POST['Pesertaasesor'])) {
      $model->attributes = $_POST['Pesertaasesor'];
      if ($model->save())
        $this->redirect(array('view', 'id' => $model->id));
    }

    $this->render('update', array(
        'model' => $model,
    ));
  }

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'admin' page.
   * @param integer $id the ID of the model to be deleted
   */
  public function actionDelete($id) {
    $this->loadModel($id)->delete();

    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
    if (!isset($_GET['ajax']))
      $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
  }

  /**
   * Lists all models.
   */
  public function actionIndex() {
    $dataProvider = new CActiveDataProvider('Pesertaasesor');
    $this->render('index', array(
        'dataProvider' => $dataProvider,
    ));
  }

  public function actionPreview($id) {
    $hasAccess = Userasesor::model()->hasAccess();
    $loadPeserta = Peserta::model()->findByPk($id);
    $loadPenilaian = Penilaian::model()->find('peserta_id = :pid', array(':pid' => $id));
    if (!isset($loadPenilaian))
      $this->redirect(array('/masters/pesertaasesor/penilaian/id/' . $id));

    $model = $loadPenilaian;
    $detailNilai = Detailpenilaian::model()->kompetensinilaiArray($model->id);
    $detailUraian = Uraiankompetensi::model()->uraianKompetensiArray($model->id);
    $kompetensiForm = $this->renderFormKompetensi($model->skj_id, $model->itemskj_id, array('nilai' => $detailNilai, 'uraian' => $detailUraian, 'model' => $model, 'preview' => true));
    $kompetensiForm['ringkasan'] = $this->ringkasanProfil($detailNilai);
    $kompetensiForm['jabatan'] = Jabatan::model()->findByPk($model->itemskj->jabatan_id);
    $this->render('_preview_penilaian', array(
        'model' => $model,
        'peserta' => $loadPeserta,
        'output' => $kompetensiForm,
            /* 'model'=>$model,
              'output'=> $kompetensiForm,
             */
    ));
  }

  /**
   * Manages all models.
   */
  public function actionPenilaian($id) {
    $hasAccess = Userasesor::model()->hasAccess();

    $loadPenilaian = Penilaian::model()->find('peserta_id = :pid', array(':pid' => $id));
    if (isset($loadPenilaian)) {
      $model = $loadPenilaian;
      $detailNilai = Detailpenilaian::model()->kompetensinilaiArray($model->id);
      $detailUraian = Uraiankompetensi::model()->uraianKompetensiArray($model->id);
    } else {
      $model = new Penilaian;
    }

    $loadPeserta = Peserta::model()->findByPk($id);
    //$model->unsetAttributes();  // clear any default values


    if ($_POST) {

      if (isset($loadPenilaian)) {
        $model = $loadPenilaian;
        $model->skj_id = $_POST['Penilaian']['skj_id'];
        $model->itemskj_id = $_POST['Penilaian']['itemskj_id'];
        $model->kesimpulan_umum = $_POST['Penilaian']['kesimpulan_umum'];
        $model->gap_akhir = $_POST['Kompetensiskj_final'];
        $model->data_kinerja = $_POST['Penilaian']['data_kinerja'];
        $model->matrix = $_POST['Penilaian']['matrix'];
        $model->persentase_pemenuhan = $_POST['persentase_kompetensi'];
      } else {
        $model->departement_id = $this->module->current_departement_id;
        $model->assessor_id = $hasAccess->assessor_id;
        $model->peserta_id = $_POST['peserta_id'];
        $model->skj_id = $_POST['Penilaian']['skj_id'];
        $model->itemskj_id = $_POST['Penilaian']['itemskj_id'];
        $model->kesimpulan_umum = $_POST['Penilaian']['kesimpulan_umum'];
        $model->gap_akhir = $_POST['Kompetensiskj_final'];
        $model->data_kinerja = $_POST['Penilaian']['data_kinerja'];
        $model->matrix = $_POST['Penilaian']['matrix'];
        $model->persentase_pemenuhan = $_POST['persentase_kompetensi'];
      }
     // print_r($_POST);
      if ($model->save()) {
        //echo $model->persentase_pemenuhan;
        $komp = $_POST['Kompetensiskj'];

        foreach ((array) $komp as $jenisKomp => $groupKomptensi) {

          foreach ((array) $groupKomptensi as $idKompetensi => $valueKomptensi) {

            $loadNilaiKompetensi = Detailpenilaian::model()
                    ->find('penilaian_id = :penid and jeniskompetensi_id = :jkid and kompetensi_id = :kid', array(':penid' => $model->id,
                ':jkid' => $jenisKomp,
                ':kid' => $idKompetensi
                    )
            );

            if (isset($loadNilaiKompetensi)) {
              $loadNilaiKompetensi->nilai_default = $valueKomptensi['default'];
              $loadNilaiKompetensi->nilai = $valueKomptensi['nilai'];
              $loadNilaiKompetensi->nilai_akhir = ( $valueKomptensi['nilai'] -  $valueKomptensi['default']);
            } else {
              $loadNilaiKompetensi = new Detailpenilaian;
              $loadNilaiKompetensi->penilaian_id = $model->id;
              $loadNilaiKompetensi->jeniskompetensi_id = $jenisKomp;
              $loadNilaiKompetensi->kompetensi_id = $idKompetensi;
              $loadNilaiKompetensi->nilai_default = $valueKomptensi['default'];
              $loadNilaiKompetensi->nilai = $valueKomptensi['nilai'];
              $loadNilaiKompetensi->nilai_akhir = ( $valueKomptensi['nilai'] -  $valueKomptensi['default']);
            }

            if ($loadNilaiKompetensi->save()) {
              
            }
          }

          /* uraian */
          $loadUraianKompetensi = Uraiankompetensi::model()
                  ->find('penilaian_id = :penid and jenis_kompetensi = :jkid', array(':penid' => $model->id,
              ':jkid' => $jenisKomp
                  )
          );
          if (isset($loadUraianKompetensi)) {
            $loadUraianKompetensi->uraian = $_POST['uraian'][$jenisKomp];
          } else {
            $loadUraianKompetensi = new Uraiankompetensi;
            $loadUraianKompetensi->penilaian_id = $model->id;
            $loadUraianKompetensi->jenis_kompetensi = $jenisKomp;
            $loadUraianKompetensi->departement_id = $this->module->current_departement_id;
            $loadUraianKompetensi->uraian = $_POST['uraian'][$jenisKomp];
          }

          if ($loadUraianKompetensi->save()) {
            
          }
        }

        $detailNilai = Detailpenilaian::model()->kompetensinilaiArray($model->id);
        $detailUraian = Uraiankompetensi::model()->uraianKompetensiArray($model->id);
      } else {
        echo 'error';
      }
    }

    if (!$model->isNewRecord) {
      $kompetensiForm = $this->renderFormKompetensi($model->skj_id, $model->itemskj_id, array('nilai' => $detailNilai, 'uraian' => $detailUraian, 'model' => $model));
      //$kompetensiForm['nilai'] = $detailNilai;
      $kompetensiForm['jabatan'] = Jabatan::model()->findByPk($loadPenilaian->itemskj->jabatan_id);
    }

    $kompetensiForm['ringkasan'] = $this->ringkasanProfil($detailNilai);
    $this->render('formpenilaian', array(
        'peserta' => $loadPeserta,
        'model' => $model,
        'output' => $kompetensiForm,
    ));
  }

  private function ringkasanProfil($detailNilai) {
    $kuat = 0;
    $lemah = 0;
    foreach ((array) $detailNilai as $jk => $gkomp) {
      foreach ((array) $gkomp as $kompid => $values) {
        //print_r($values);
        if ($values['nilai'] < $values['nilai_default']) {
          $output['weak'] .= '<li>' . $values['title'] . '</li>';
          $output['weakArray'][$jk][$kompid] = $values['title'];
          $lemah++;
        } else {
          $output['strong'] .= '<li>' . $values['title'] . '</li>';
          $output['strongArray'][$jk][$kompid] = $values['title'];
          $kuat++;
        }
      }
    }

    /* if ( $kuat > $lemah){
      $output['recomend'] = 'disarankan';
      }else if ( $kuat < $lemah ) {
      $output['recomend'] = 'belumdisarankan';
      }else{
      $output['recomend'] = 'dipertimbangkan';
      }
     */
    return $output;
  }

  private function renderFormKompetensi($skjid, $itemskjid, $params = array()) {
    $modelkompetensisjk = Kompetensiskj::model()->getItemKompetensiById($skjid, $itemskjid);
    $params['itemkompetensi'] = $modelkompetensisjk;
    switch ($params['onview']) {
      case 'doc':
        $output['loadkompetensi'] = $this->renderPartial('_cetak_penilaian_kompetensi', $params, true, true);

        $output['uraianKompetensi'] = $this->renderPartial('_cetak_penilaian_uraian_kompetensi', $params, true, true);
        $params['ringkasan'] = $this->ringkasanProfil($params['nilai']);
        $output['ringkasanKompetensi'] = $this->renderPartial('_cetak_ringkasanpenilaian_kompetensi', $params, true, true);
        $output['saranpengembangan'] = $this->renderPartial('_cetak_saran_pengembangan', $params, true, true);
        break;
      default:

        $output['loadkompetensi'] = $this->renderPartial('_form_penilaian_kompetensi', $params, true, true);

        $output['uraianKompetensi'] = $this->renderPartial('_form_penilaian_uraian_kompetensi', $params, true, true);
        $params['ringkasan'] = $this->ringkasanProfil($params['nilai']);
        $output['ringkasanKompetensi'] = $this->renderPartial('_ringkasan_penilaian_kompetensi', $params, true, true);
        $output['saranpengembangan'] = $this->renderPartial('_penilaian_saran_pengembangan', $params, true, true);
        break;
    }
    return $output;
  }

  /**
   * Manages all models.
   */
  public function actionLoadkompetensi() {
    $peserta = $_POST['peserta_id'];
    //$_POST['penilaian_id'];
    $skjid = $_POST['Penilaian']['skj_id'];
    $itemskjid = $_POST['Penilaian']['itemskj_id'];
    if (empty($itemskjid)) {
      $listItems = CHtml::encodeArray(CHtml::listData(Itemskj::model()->findAll('departement_id = :dept AND skj_id = :skjid', array(':dept' => $this->module->current_departement_id,
                                  ':skjid' => $skjid
                              )), 'id', 'fullField'));
      $opt = '<option value="">Item Skj</option>';
      foreach ((array) $listItems as $id => $caption) {
        $opt .= '<option value="' . $id . '">' . $caption . '</option>';
      }
    }
    $penilaian_id = Penilaian::model()->find('peserta_id = :pid and skj_id = :skid and itemskj_id = :itskjid', array(':pid' => $peserta,
        ':skid' => $skjid,
        ':itskjid' => $itemskjid,
            )
    );
    $params['nilai'] = $detailNilai = Detailpenilaian::model()->kompetensinilaiArray($penilaian_id->id);
    $output = $this->renderFormKompetensi($skjid, $itemskjid, $params);
    $output['itemskj'] = $opt;
    echo json_encode($output);
  }

  /**
   * Manages all models.
   */
  public function actionAdmin() {
    $model = new Pesertaasesor('search');
    $model->unsetAttributes();  // clear any default values
    if (isset($_GET['Pesertaasesor']))
      $model->attributes = $_GET['Pesertaasesor'];

    $this->render('admin', array(
        'model' => $model,
    ));
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadModel($id) {
    $model = Pesertaasesor::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  public function loadModelByPeserta($pid) {
    $model = Pesertaasesor::model()->find('id_peserta = :pid', array(':pid' => $pid));
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  /**
   * Performs the AJAX validation.
   * @param CModel the model to be validated
   */
  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'pesertaasesor-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

  public function actionDownload($id) {
    $hasAccess = Userasesor::model()->hasAccess();
    $loadPeserta = Peserta::model()->findByPk($id);
    $loadPenilaian = Penilaian::model()->find('peserta_id = :pid', array(':pid' => $id));
    if (!isset($loadPenilaian)) {
      $this->redirect(array('/masters/pesertaasesor/penilaian/id/' . $id));
      exit;
    }

    $model = $loadPenilaian;
    $detailNilai = Detailpenilaian::model()->kompetensinilaiArray($model->id);
    $detailUraian = Uraiankompetensi::model()->uraianKompetensiArray($model->id);
    $kompetensiForm = $this->renderFormKompetensi($model->skj_id, $model->itemskj_id, array('nilai' => $detailNilai,
        'uraian' => $detailUraian,
        'model' => $model,
        'preview' => true, 'onview' => 'doc')
    );
    $kompetensiForm['ringkasan'] = $this->ringkasanProfil($detailNilai);
    $kompetensiForm['jabatan'] = Jabatan::model()->findByPk($model->itemskj->jabatan_id);

    $footer_text = strtoupper($loadPeserta->nama_peserta . '/Seleksi/' . $kompetensiForm['jabatan']->jabatan_name . '/' . $loadPeserta->nip);
    $filename = $loadPeserta->nama_peserta;

    if ($model->persentase_pemenuhan > 90) {
      $saran = '<table cellspacing="0" cellpadding="0" style="border:1px solid #000;margin-top:2px;"><tr><td style="width:20px;height:20px;background:#000;color:#000">.</td></tr></table>';
    } else if ($model->persentase_pemenuhan <= 90 && $model->persentase_pemenuhan > 70) {
      $timbang = '<table cellspacing="0" cellpadding="0" style="border:1px solid #000;margin-top:2px;"><tr><td style="width:20px;height:20px;background:#000;color:#000">.</td></tr></table>';
    } else if ($model->persentase_pemenuhan <= 70 && !empty($model->persentase_pemenuhan)) {
      $belum = '<table cellspacing="0" cellpadding="0" style="border:1px solid #000;margin-top:2px;"><tr><td style="width:20px;height:20px;background:#000;color:#000">.</td></tr></table>';
    }

    $empty = '<table cellspacing="0" cellpadding="0" style="border:1px solid #aaa;margin-top:2px;"><tr><td style="width:20px;height:20px;background:#fff;color:#fff">.</td></tr></table>';
    Yii::import('application.extensions.phpdocx.Phpdocx', array('options' => array('filetemp' => 'satu')));

    $phpdocx = new Phpdocx(array('filetemp' => $this->getCurrentViewPath()));
    $docx = new CreateDocx();


    /* load template */

    $docx->setTemporaryDirectory($this->getCurrentViewPath());
    $docx->addTemplate($this->getCurrentViewPath() . '/templatekpk.docx');

    $docx->addTemplateVariable('nomortest', $loadPeserta->kode_peserta);
    $docx->addTemplateVariable('nip', '');
    $docx->addTemplateVariable('timbang', ($timbang ? $timbang : $empty), 'html');
    $docx->addTemplateVariable('saran', ($saran ? $saran : $empty), 'html');
    $docx->addTemplateVariable('belum', ($belum ? $belum : $empty), 'html');
    $docx->addTemplateVariable('alamat', '');
    $docx->addTemplateVariable('pendidikan', '');
    $docx->addTemplateVariable('ttl', '');
    $docx->addTemplateVariable('jabatan', '');
    $docx->addTemplateVariable('tujuan', 'Seleksi');
    $docx->addTemplateVariable('tta', 'Jakarta,');
    $docx->addTemplateVariable('footer', $footer_text);
    $docx->addTemplateVariable('namapeserta', $loadPeserta->nama_peserta);
    $docx->addTemplateVariable('hasilKompetensi', $kompetensiForm['loadkompetensi'], 'html');
    $docx->addTemplateVariable('uraian_profile_kompetensi', $kompetensiForm['uraianKompetensi'], 'html');
    $docx->addTemplateVariable('ringkasan_profile_kompetensi', $kompetensiForm['ringkasanKompetensi'], 'html');
    $docx->addTemplateVariable('saran_pengembangan', $kompetensiForm['saranpengembangan'], 'html');
    $docx->addTemplateVariable('kesimpulan', nl2br($model->kesimpulan_umum), 'html');
    $docx->addTemplateVariable('untuk_posisi', $kompetensiForm['jabatan']->jabatan_name);

    //$docx->addFooter($footer_text, $paramsFooter);
    /* halaman depan */
    $onlyfilename = $filename . '.docx';
    $filename = $this->getCurrentViewPath() . '/' . $filename;

    $filename_path = $docx->createDocx($filename);

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . $onlyfilename);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename_path));
    ob_clean();
    flush();
    readfile($filename_path);
    unlink($filename_path);
    exit;
  }

  public function actionCalculate() {
   // print_r($_GET);
    $Kompetensiskj = $_GET['Kompetensiskj'];
    $datapersentase = $_GET['datapersentase'];
    $total = 0;
    foreach ((array) $Kompetensiskj as $idkompetensi =>$valueItem ){
      $jumlahKompetensi = count($valueItem);
      foreach ((array) $valueItem as $valueKompetensi =>$valueNilai ){
        $assessment = Assessment::model();
        $assessment->inputNilai = $valueNilai['nilai'];
        $assessment->standard = $valueNilai['default'];
        $assessment->jenisNilai = $datapersentase[$idkompetensi];
        $assessment->departement = $_GET['departement'];
        $assessment->jumlahkompetensi = $jumlahKompetensi;
        $calculate = $assessment->calculate();
        $total +=$calculate; 
      }
    }
    
    $return['totalCalculate'] = round($total,2);
    echo json_encode($return);
    //echo $calculate;
  }

  public function getCurrentViewPath() {
    $controllername = $this->getId();
    $modulename = $this->module->getName();
    $newPath = "application.modules.{$modulename}.views.{$controllername}";
    $newPath = YiiBase::getPathOfAlias($newPath);
    return $newPath;
  }

}
