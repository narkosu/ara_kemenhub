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
?>

<h1>Peserta</h1>
<?php $this->widget('ext.cdatatables.cdatatables',array(
			'id'=>'example',
			'options'=>array(
					'bProcessing'=> true,
					'bServerSide'=> true,
					'sAjaxSource' =>  $urlAjax,
					'aoColumns'=> array(
									  array( "mDataProp"=> "id" ),array( "mDataProp"=> "id_departemen" ),
									  array( "mDataProp"=> "peserta.nip" ),array( "mDataProp"=> "peserta.nama_peserta" ),

 							array(
									"mDataProp"=> "ids",
									"sName"=> "ID",
								"bSearchable"=> false,
								"bSortable"=> false,
								"fnRender"=> "js:function (oObj) {
									return '<a class=\"table-action-deletelinks\" href=\"".Yii::app()->createUrl('masters/pesertaasesor/penilaian/id')."/' + oObj.aData['id'] + '\">Penilaian</a>';
									
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
			<th width="100">Departemen</th>
			<th >Nip</th>
			<th >Nama</th>
			<th >edit</th>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
</table>

</div>
<?php /*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'peserta-grid',
	'dataProvider'=>$dataProvider->search(),
	'filter'=>$dataProvider,
	'columns'=>array(
		'id',
		'id_departemen',
		'nip',
		'nama_peserta',
		array(
			'class'=>'CButtonColumn',
		),
	),
));*/ ?>

<?php
/*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/ ?>
