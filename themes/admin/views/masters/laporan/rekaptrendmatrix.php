<?php
/* @var $this PesertaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pesertas',
);

$this->menu=array(
	array('label'=>'Create Peserta', 'url'=>array('create')),
	array('label'=>'Manage Peserta', 'url'=>array('admin')),
);

$depid = $this->module->current_departement_id;
?>

<div class="header-page">
	
	<div style="float:left;vertical-align: middle;">
		<h2 class="textTitle" style="float:left;">Trend Matrix </h2>
    <div>
      <?php echo CHtml::dropDownList('trend_matrix','',
              array('{"rekomendasi":"P","data_kinerja":"B"}'=>'Trend Matrix 1',
                    '{"rekomendasi":"PC","data_kinerja":"B"}'=>'Trend Matrix 2',
                    '{"rekomendasi":"P","data_kinerja":"C"}'=>'Trend Matrix 3',
                    '{"rekomendasi":"PC","data_kinerja":"C"}'=>'Trend Matrix 4',
                    '{"rekomendasi":"KP","data_kinerja":"B"}'=>'Trend Matrix 5',
                    '{"rekomendasi":"KP","data_kinerja":"C"}'=>'Trend Matrix 6'
                  ),
              array('empty' => 'Trend Matrix'));
		?>
      
    </div>
    
	</div>
	<div style="float:right;">
		<?php $this->renderPartial('_submenulaporan',array('params'=>$params)); ?>
	</div>
	<div style="clear:both;"></div>
	
</div>

<div class="container-page" style="overflow-x: scroll;">
<div style="width:100%">
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead style="font-size:12px;">
		<tr>
			<th width="50">No.</th>
			<th width="100">Departemen</th>
			<th >Nip</th>
			<th >Nama</th>
      <?php $kompetensis = Kompetensi::model()->listKompetensi($depid)?>
      <?php foreach ($kompetensis as $kompetensi){
        $__column[] = array( "mDataProp"=> "komp_".$kompetensi->id,"bSearchable"=> false,
								"bSortable"=> false);
        ?>
        <th width="20"><div class="smallhead" title="<?php echo $kompetensi->name ?>"><?php echo substr($kompetensi->name,0,2)?></div></th>
        
      <?php } ?>
			<th style="text-align:center;width:50px;">JPM</th>
			<th style="text-align:center;width:70px;">Rekomendasi</th>
      <th style="text-align:center;width:70px;">Kinerja</th>
		</tr>
	</thead>
	<tbody style="font-size:12px;">
		
	</tbody>
</table>

</div>
</div>
<?php 
$column[] = array(
                "mDataProp"=> "urut",
                "sName"=> "NUMBER",
								"bSearchable"=> false,
								"bSortable"=> false,
								"fnRender"=> "js:function (oObj) {
                    return '<SPAN>'+oObj.aData['urut']+'.</SPAN>';
                    }"
                );
$column[] = array( "mDataProp"=> "departement" );
$column[] = array( "mDataProp"=> "nip" );
$column[] = array(
								"mDataProp"=> "nama_peserta",
								"sName"=> "nama_peserta",
								"bSearchable"=> true,
								"bSortable"=> true,
								"fnRender"=> "js:function (oObj) {
									return '<a class=\"table-action-deletelinks\" href=\"".Yii::app()->createUrl('masters/pesertaasesor/penilaian/id')."/' + oObj.aData['ids'] + '\">'+ oObj.aData['nama_peserta']+'</a>';
									
										}"
							);
if ( is_array($__column))
$column = array_merge($column, $__column);

$column[] = array( "mDataProp"=> "penilaian","bSearchable"=> false,
								"bSortable"=> false, );
$column[] = array( "mDataProp"=> "rekomendasi","bSearchable"=> false,
								"bSortable"=> false, );
$column[] = array( "mDataProp"=> "kinerja","bSearchable"=> false,
								"bSortable"=> false, );

$this->widget('ext.cdatatables.cdatatables',array(
			'id'=>'example',
			'options'=>array(
					'bProcessing'=> true,
					'bServerSide'=> true,
					'sAjaxSource' =>  $urlAjax,
					'aoColumns'=> $column

				)
			));
?>

<?php 
Yii::app()->clientScript->registerScript('formnilai_s', "
$(document).delegate('#trend_matrix','change',function(){
  
  oTable.fnFilter( $(this).val(), 20 );
}
)");
?>

