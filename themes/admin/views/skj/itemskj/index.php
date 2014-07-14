<?php
/* @var $this ItemskjController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Itemskjs',
);

$this->menu=array(
	array('label'=>'Create Itemskj', 'url'=>array('create')),
	array('label'=>'Manage Itemskj', 'url'=>array('admin')),
);
?>
<div class="header-page">
	<div style="float:left;vertical-align: middle;">
		<h2 class="textTitle"><?php echo $masterskj->skj_name;?></h2>
	</div>
	<div style="float:right;">
		<?php $this->renderPartial('_submenu',array('params'=>$params)); ?>
	</div>
	<div style="clear:both;"></div>
</div>

<div class="container-page">	
<div style="padding:10px 0px 0px 0px;font-weight:bold;border-bottom:1px solid #eee;"><?php echo $masterskj->skj_name;?></div>
<div style="padding:10px 0px">
<?php $this->widget('ext.cdatatables.cdatatables',array(
			'id'=>'example',
			'options'=>array(
					'bProcessing'=> true,
					'bServerSide'=> true,
					'sAjaxSource' => Yii::app()->createUrl('/skj/itemskj/load_server_processing/skjid/'.$masterskj->id),
					'aoColumns'=> array(
									array("sName"=> "NO",
										  "bSearchable"=> false,
										  "bSortable"=> false,
										  "fnRender"=> "js:function (oObj) {
											  return oObj.aData['no'];
										  }"
									),
									array("sName"=> "DEPUTI",
										  "bSearchable"=> false,
										  "bSortable"=> false,
										  "fnRender"=> "js:function (oObj) {
											  return oObj.aData['deputi'];
										  }"
									  ),
									array("sName"=> "UNITKERJA",
										  "bSearchable"=> false,
										  "bSortable"=> false,
										  "fnRender"=> "js:function (oObj) {
											  return oObj.aData['unitkerja'];
										  }"
									),
									array("sName"=> "JABATAN",
										  "bSearchable"=> false,
										  "bSortable"=> false,
										  "fnRender"=> "js:function (oObj) {
											  return oObj.aData['jabatan'];
										  }"
									),array("sName"=> "TINGKATJABATAN",
										  "bSearchable"=> false,
										  "bSortable"=> false,
										  "fnRender"=> "js:function (oObj) {
											  return oObj.aData['tingkat_jabatan'];
										  }"
									),
									array("sName"=> "RUMPUNJABATAN",
										  "bSearchable"=> false,
										  "bSortable"=> false,
										  "fnRender"=> "js:function (oObj) {
											  return oObj.aData['rumpun_jabatan'];
										  }"
									),

 							array("sName"=> "ID",
								"bSearchable"=> false,
								"bSortable"=> false,
								"fnRender"=> "js:function (oObj) {
									return '<span class=\"button-group\">'+
										'<a href=\"".Yii::app()->createUrl('skj/itemskj/update/skjid/'.$masterskj->id.'/id/')."/' + oObj.aData['id'] + '\" class=\"button icon edit\">Edit</a>'+
										'<a href=\"#\" class=\"button icon remove danger\">Remove</a>'+
										//'<a href=\"".Yii::app()->createUrl('skj/itemskj/index/id/')."/' + oObj.aData['id'] + '\" class=\"button icon settings\">View</a>'+
										'</span>';
									//'<a class=\"table-action-deletelink\" href=\"DeleteData.php?test=test&id=' + oObj.aData['id'] + '\">Edit</a>';
									
										}"
							)

 						)
					
				)
			));

$kompetensi = Kompetensi::model()->findAll('departement_id = "'.$this->module->current_departement_id.'"');

?>

<div style="width:100%">
	
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th width="20">No</th>
			<th width="100">Deputi</th>
			<th width="100">Unit Kerja</th>
			<th >Nama Jab</th>
			<th width="50">Tkt Jabatan</th>
			<th width="100">Rumpun Jab</th>
			<th width="200">-</th>
		</tr>
		<?php /*
		<tr>
			<?php
			foreach ($kompetensi as $ko=>$value_komp) {
			?>
			<th class="rotatex"><?php echo $value_komp->alias?></th>
			<?php } ?>
		</tr>
		*/?>
	</thead>
	<tbody>
		<?php /* foreach ( (array) $itemskjs as $row=>$values){ ?> 
		<tr>
			<td><?php echo $values->deput->deputi_name?></td>
			<td><?php echo $values->uk->unitkerja_name?></td>
			<td><?php echo $values->jab->jabatan_name?></td>
			<td><?php echo $values->t_jab->tingkat_jabatan?></td>
			<td><?php echo $values->r_jab->rumpun_jabatan?></td>
		</tr>
		<?php } */ ?>
	</tbody>
</table>
</div>
</div>
<?php /*	
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th >Rendering engine</th>
			<th>Browser</th>
			<th>Platform(s)</th>
			<th>Engine version</th>
			<th>CSS grade</th>
		</tr>
		<tr>
			<th>Name and version</th>
			<th>Operating systems</th>
			<th>Rendering engine</th>
			<th>Support level</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="5" class="dataTables_empty">Loading data from server</td>
		</tr>
	</tbody>
</table>
</div>
<?php
	
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'itemskj-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		//'dept.name',
		//'skj.skj_name',
		
		'deput.deputi_name',
		'uk.unitkerja_name',
		'jab.jabatan_name',
		/*
		'tingkatjabatan_id',
		'rumpunjabatan_id',
		'status',
		* /
		array(
			'class'=>'CButtonColumn',
		),
	),
)); */?>

