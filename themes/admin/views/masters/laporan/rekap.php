<?php
/* @var $this PesertaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Peserta',
);

$selectSKJ = (empty($_GET['skj']) ? '' : $_GET['skj']);

$this->menu=array(
	array('label'=>'Create Peserta', 'url'=>array('create')),
	array('label'=>'Manage Peserta', 'url'=>array('admin')),
);
$depid = $this->module->current_departement_id;
?>

<div class="header-page">
	
	<div style="float:left;vertical-align: middle;">
		<h2 class="textTitle">REKAPITULASI </h2>
	</div>
	<div style="float:right;">
		<?php $this->renderPartial('_submenulaporan',array('params'=>$params)); ?>
	</div>
	<div style="clear:both;"></div>
	
</div>
<div style="margin-bottom:10px;">
    <div style="padding:10px 5px; display: -moz-inline-box;
  display: inline-block;line-height: 20px;">Jenis Assessment</div>
    <div style="display: -moz-inline-box;
  display: inline-block;">
        <?php
        $list=CHtml::listData(Masterskj::model()->findAll('departement_id = :dept',array(':dept'=>$this->module->current_departement_id)), 'id', 'skj_name');
        ?>
        <?php echo CHTML::dropDownList('skj_id',$selectSKJ,$list,
                array('empty' => 'SKJ','id'=>'selectSKJ','style'=>'margin-bottom:0px;'));
        ?>
    </div>
</div>
<div class="container-page" style="padding:0px">
  
  <div CLASS="rekapitulasi" style="margin-top:10px;">
    <h2 class="textTitle" style="padding-left:10px;">PENDIDIKAN</h2>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example_pendidikan" >
      <thead style="font-size:12px;">
        <tr>
          <th width="100">PENDIDIKAN</th>
          <th >COUNT</th>
          <th >% COUNT</th>

        </tr>
      </thead>
      <tbody style="font-size:12px;">

      </tbody>
    </table>
    
  </div>
  
  <div  CLASS="rekapitulasi" style="margin-top:10px;">
    <h2 class="textTitle" style="padding-left:10px;">TANGGAL ASSESSMENT</h2>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example_tanggal" >
      <thead style="font-size:12px;">
        <tr>
          <th width="100">TANGGAL</th>
          <th >COUNT</th>
          <th >% COUNT</th>

        </tr>
      </thead>
      <tbody style="font-size:12px;">

      </tbody>
    </table>
    
  </div>
  
  <div  CLASS="rekapitulasi" reltype="rekomendasi" style="margin-top:10px;">
    <h2 class="textTitle" style="padding-left:10px;">BERDASARKAN REKOMENDASI</h2>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example_rekomendasi" >
      <thead style="font-size:12px;">
        <tr>
          <th width="100">REKOMENDASI</th>
          <th >COUNT</th>
          <th >% COUNT</th>

        </tr>
      </thead>
      <tbody style="font-size:12px;" id="body_rekomendasi">

      </tbody>
    </table>
    
  </div>

  <div  CLASS="rekapitulasi" reltype="kinerja" style="margin-top:10px;">
    <h2 class="textTitle" style="padding-left:10px;">BERDASARKAN KINERJA</h2>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example_kinerja" >
      <thead style="font-size:12px;">
        <tr>
          <th width="100">KINERJA</th>
          <th >COUNT</th>
          <th >% COUNT</th>

        </tr>
      </thead>
      <tbody style="font-size:12px;" id="body_kinerja">

      </tbody>
    </table>
    
  </div>
</div>
<?php 
Yii::app()->clientScript->registerScript('REKAPITULASI', "
    
  $('#selectSKJ').change(function(){
  //alert(window.location.pathname+'?skj='+$(this).val());
    window.location.href = window.location.pathname+'?skj='+$(this).val();
  });
  
  /* ajax */
	$('.rekapitulasi').each(function() {
    if ( $(this).attr('reltype') != undefined ) {
      var typelaporan = $(this).attr('reltype');
      $.ajax(
        { url: '".Yii::app()->createUrl('masters/laporan/LoadRekapitulasi/departement_id/'.$depid.'?skj='.$selectSKJ)."' ,
          data:'typelaporan='+typelaporan,
          success:function(data){

            $('#body_'+typelaporan).html(data);

          }	
          }
        );
      }
  });
  /* khsuus rekomendasi */
  
  
");
?>

