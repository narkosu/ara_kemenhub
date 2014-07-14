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
<?php $this->widget('zii.widgets.grid.CGridView', array(
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
)); ?>
</div>