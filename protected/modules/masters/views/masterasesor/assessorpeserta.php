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

<?php $this->renderPartial('_submenu',array('params'=>$params)); ?>

<div id="subcontainer">
<div style="padding:10px 0px 0px 0px;font-weight:bold;border-bottom:1px solid #eee;"><?php echo $masterskj->skj_name;?></div>
<h1>Assess Peserta</h1>
<?php //$this->widget('ext.cdatatables.cdatatables');
//$kompetensi = Kompetensi::model()->findAll('departement_id = "'.$this->module->current_departement_id.'"');
?>

<div style="width:100%">
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th >No</th>
			<th >No Peserta</th>
			<th >Peserta</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		foreach ( (array) $model as $row=>$values){ ?> 
		<tr>
			<td><?php echo $no?></td>
			<td><?php echo $values->peserta->nip?></td>
			<td><?php echo $values->peserta->nama_peserta?></td>
		</tr>
		<?php
		$no++;
		} ?>
	</tbody>
</table>

</div>
