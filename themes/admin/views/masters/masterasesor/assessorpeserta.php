<?php
/* @var $this MasterasesorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Masterasesors',
);

$this->menu=array(
	array('label'=>'Create Masterasesor', 'url'=>array('create')),
	array('label'=>'Manage Masterasesor', 'url'=>array('admin')),
);
?>
<div class="header-page">
	<div style="float:left;vertical-align: middle;">
		<h2 class="textTitle">Peserta Asesor : <?php echo $assessor->nama_asesor;?> (<?php echo $assessor->kode_asesor;?>)</h2>
	</div>
	
	<div style="float:right;">
		<?php $this->renderPartial('_submenu',array('params'=>$params)); ?>
	</div>
	<div style="clear:both;"></div>
	
</div>



<div class="container-page">
	<?php $this->widget('ext.cdatatables.cdatatables',array(
			'id'=>'example',
			'options'=>array(
					'bProcessing'=> true,
					'bServerSide'=> true,
					'sAjaxSource' => Yii::app()->createUrl('/masters/masterasesor/loadpesertaprocessing/id/'.$assessor->id),
					'aoColumns'=> array(
									  'null',
									  array("sName"=> "No_peserta",'fnRender'=>"js:function (oObj) {return oObj.aData['peserta']['kode_peserta'];}"),
									  array("sName"=> "nama",'fnRender'=>"js:function (oObj) {return oObj.aData['peserta']['nama_peserta'];}"),
									  array("sName"=> "penilaian",'fnRender'=>"js:function (oObj) {return oObj.aData['penilaian'];}"),

 							array("sName"=> "ID",
								"bSearchable"=> false,
								"bSortable"=> false,
								"fnRender"=> "js:function (oObj) {
								return '<span class=\"button-group\">'+
										'<a href=\"".Yii::app()->createUrl('masters/masterasesor/update/id/')."/' + oObj.aData[4] + '\" class=\"button icon edit\">Edit</a>'+
										'<a href=\"#\" class=\"button icon remove danger\">Remove</a>'+
										'<a href=\"".Yii::app()->createUrl('masters/masterasesor/assesspeserta/id/')."/' + oObj.aData[4] + '\" class=\"button icon user\">Peserta</a>'+
										'</span>';
									//return '<a class=\"table-action-deletelink\" href=\"DeleteData.php?test=test&id=' + oObj.aData[4] + '\">Edit</a>';
									
										}"
							)

 						)

				)
			));
?>

	<div style="width:100%">
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
		<thead>
			<tr>
				<th width="50">Id</th>
				<th width="100">No Peserta</th>
				<th >Nama Peserta</th>
				<th >Persentase / Nilai</th>
				<th width="215">--</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	
	</div>
</div>	
