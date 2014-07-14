<div class="header-page">
	<div style="float:left;vertical-align: middle;">
		<h2 class="textTitle">Daftar SKJ</h2>
	</div>
	<div style="float:right;">
		<?php $this->renderPartial('_submenu'); ?>
	</div>
	<div style="clear:both;"></div>
</div>

<div class="container-page">
	<?php $this->widget('ext.cdatatables.cdatatables',array(
			'id'=>'example',
			'options'=>array(
					'bProcessing'=> true,
					'bServerSide'=> true,
					'sAjaxSource' => Yii::app()->createUrl('/skj/default/loadprocessing'),
					'aoColumns'=> array(
									  'null','null','null','null',

 							array("sName"=> "ID",
								"bSearchable"=> false,
								"bSortable"=> false,
								"fnRender"=> "js:function (oObj) {
								return '<span class=\"button-group\">'+
										'<a href=\"".Yii::app()->createUrl('skj/masterskj/update/id/')."/' + oObj.aData[4] + '\" class=\"button icon edit\">Edit</a>'+
										'<a href=\"#\" class=\"button icon remove danger\">Remove</a>'+
										'<a href=\"".Yii::app()->createUrl('skj/itemskj/index/id/')."/' + oObj.aData[4] + '\" class=\"button icon settings\">View</a>'+
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
				<th width="100">Departement</th>
				<th >Nama Skj</th>
				<th >Status</th>
				<th width="200">--</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
<?php /*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'masterskj-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'dept.name',
		'skj_name',
		'status',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{view}{delete}',
			'buttons'=>array(
				'update'=>array(
						'url'=>'$this->grid->controller->createUrl("/Extras/update", array("id"=>$data->id,"asDialog"=>1,"gridId"=>$this->grid->id))',
						'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
							'visible'=>'($data->id===null)?false:true;'
						),
				
				'delete'=>array(
						'url'=>'$this->grid->controller->createUrl("/Extras/delete", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
						),
				'view' => array(
						'url'=>'$this->grid->controller->createUrl("/skj/itemskj/index/id/$data->primaryKey")',
						
						),
	Ê
			),

		),
	),
)); */ ?>
</div>