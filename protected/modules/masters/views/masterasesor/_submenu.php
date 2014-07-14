<div class="speedbar">
    <div class="speedbar-content">
		<?php /*<ul class="menu-drop">
			<li><a href="#"><i class="icon-chevron-down"></i></a>
				<ul>
					<?php $loadDepartement = Departement::model()->loadAll(); ?>
					<?php foreach((array) $loadDepartement as $dept) { ?>
					<li>
					<?php echo CHtml::ajaxLink($dept->name,
								Yii::app()->createUrl('masters/departement/setCurrentDepartement/id/'.$dept->id),
								array( // ajaxOptions
								  'type' => 'GET',
								  /*'beforeSend' => "function( request )
												   {
													 // Set up any pre-sending stuff like initializing progress indicators
												   }",* /
								  'success' => "function( data )
												{
												  $('.currentdeptname').html(data);
												}",
								  //'data' => array( 'val1' => '1', 'val2' => '2' )
								)
							);
					?>
					</li>
					<?php } ?>
				</ul>  
			</li>
		</ul> */?>
		<ul class="menu-speedbar">
			<li><a href="<?php echo Yii::app()->createUrl('masters/'.$this->id.'/assesspeserta/id/'.$params['assessor_id'])?>">Assess Peserta</a></li>
			<li><a href="<?php echo Yii::app()->createUrl('masters/'.$this->id.'/availablepeserta/id/'.$params['assessor_id'])?>" class="act_linkx">Daftar Peserta</a></li>
			
		</ul>
	</div>
</div>