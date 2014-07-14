<?php
/* @var $this MasterasesorController */
/* @var $model Masterasesor */

$this->breadcrumbs=array(
	'Masterasesors'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Masterasesor', 'url'=>array('index')),
	array('label'=>'Create Masterasesor', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('masterasesor-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="header-page">
	<h2 class="textTitle">Daftar Asesor</h2>
</div>
<div class="container-page">
	<?php $this->widget('ext.cdatatables.cdatatables',array(
			'id'=>'example',
			'options'=>array(
					'bProcessing'=> true,
					'bServerSide'=> true,
					'sAjaxSource' => Yii::app()->createUrl('/masters/masterasesor/loadprocessing'),
					'aoColumns'=> array(
									  'null','null','null','null',

 							array("sName"=> "ID",
								"bSearchable"=> false,
								"bSortable"=> false,
								"fnRender"=> "js:function (oObj) {
								return '<span class=\"button-group\">'+
										'<a href=\"".Yii::app()->createUrl('masters/masterasesor/update/id/')."/' + oObj.aData[4] + '\" class=\"button icon edit\">Edit</a>'+
										'<a href=\"#\" class=\"button icon remove danger\">Remove</a>'+
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
				<th width="100">Kode Asesor</th>
				<th >Nama Asesor</th>
				<th >Telp</th>
				<th >--</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	
	</div>
<?php /*	
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'masterasesor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id','htmlOptions'=>array('width'=>'40px','style'=>'text-align:center;')),
		'kode_asesor',
		'nama_asesor',
		'telpon_asesor',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
*/?>
</div>
<div class="container-footer"></div>