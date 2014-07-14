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

<div class="header-page">
	
	<div style="float:left;vertical-align: middle;">
		<h2 class="textTitle">Peserta </h2>
	</div>
	<div style="float:right;">
		<?php $this->renderPartial('_submenulaporan',array('params'=>$params)); ?>
	</div>
	<div style="clear:both;"></div>
	
</div>

<div class="container-page">
<?php $this->widget('ext.cdatatables.cdatatables',array(
			'id'=>'example',
			'options'=>array(
					'bProcessing'=> true,
					'bServerSide'=> true,
					'sAjaxSource' =>  $urlAjax,
					'aoColumns'=> array(
            array(
                "mDataProp"=> "id",
                "sName"=> "NUMBER",
								"bSearchable"=> false,
								"bSortable"=> false,
								"fnRender"=> "js:function (oObj) {
                    return '<SPAN><input type=\"checkbox\" name=\"ckb\" class=\"checkboxrow\" value=\"'+oObj.aData['id']+'\"></input> '+oObj.aData['id']+'.</SPAN>';
                    }"
                ),
            array( "mDataProp"=> "id_departemen" ),
						array( "mDataProp"=> "nip" ),
						array(
								"mDataProp"=> "nama_peserta",
								"sName"=> "nama_peserta",
								"bSearchable"=> true,
								"bSortable"=> true,
								"fnRender"=> "js:function (oObj) {
									return '<a class=\"table-action-deletelinks\" href=\"".Yii::app()->createUrl('masters/pesertaasesor/penilaian/id')."/' + oObj.aData['ids'] + '\">'+ oObj.aData['nama_peserta']+'</a>';
									
										}"
							),
						
						array( "mDataProp"=> "penilaian","bSearchable"=> false,
								"bSortable"=> false, ),
						array( "mDataProp"=> "rekomendasi","bSearchable"=> false,
								"bSortable"=> false, ),
 						)

				)
			));
?>

<div style="width:100%">
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead style="font-size:12px;">
		<tr>
			<th width="50">Id</th>
			<th width="100">Departemen</th>
			<th >Nip</th>
			<th >Nama</th>
			<th style="text-align:center;width:70px;">Pemenuhan Kompetensi (%)</th>
			<th style="text-align:center;width:70px;">Rekomendasi</th>
		</tr>
	</thead>
	<tbody style="font-size:12px;">
		
	</tbody>
</table>

</div>
</div>
<?php 
Yii::app()->clientScript->registerScript('formnilai_s', "
$(document).delegate('.tulisnilai','click',function(){

}
)");
?>

