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
		<h2 class="textTitle">Daftar Anggota</h2>
	</div>
	<div style="float:right;">
		<?php $this->renderPartial('_submenu',array('params'=>$params)); ?>
	</div>
	<div style="clear:both;"></div>
	
</div>

<div class="container-page">
  <div id="editplace" style="display:none;border-bottom: 1px solid #666;">
    <h2 class="textTitle" style="padding:0px 10px;">Pilih Asessor</h2>
    <div id="tempatenya" class="form">

      <form id="pesertaasesor-form" action="/yii1.1.12/assestment/index.php/masters/pesertaasesor/create" method="post">
        
        <div class="rowrecord">
          <label for="Pesertaasesor_id_departemen" class="required">Id Departemen <span class="required">*</span></label>		<input name="Pesertaasesor[id_departemen]" id="Pesertaasesor_id_departemen" type="text">			</div>

        <div class="rowrecord">
          <label for="Pesertaasesor_id_peserta" class="required">Id Peserta <span class="required">*</span></label>		<input name="Pesertaasesor[id_peserta]" id="Pesertaasesor_id_peserta" type="text">			</div>

        <div class="rowrecord">
          <label for="Pesertaasesor_id_asesor" class="required">Id Asesor <span class="required">*</span></label>		<input name="Pesertaasesor[id_asesor]" id="Pesertaasesor_id_asesor" type="text">			</div>

        <div class="rowrecord buttons">
          <input type="submit" name="yt0" value="Create" class="button">	</div>

      </form>
    </div>
    
  </div>
  
<?php $this->widget('ext.cdatatables.cdatatables',array(
			'id'=>'example',
			'options'=>array(
					'bProcessing'=> true,
					'bServerSide'=> true,
					'sAjaxSource' => Yii::app()->createUrl('/masters/anggota/loadprocessing'),
					'aoColumns'=> array(
							'null',
              array(  "mDataProp"=> "username",
                      "sName"=> "username",
                      "bSearchable"=> false,
                      "bSortable"=> false,
                      "fnRender"=> "js:function (oObj) {
                          return ''+oObj.aData['username']+
                                  '';
                      }"
                  
                  )
              ,array(  "mDataProp"=> "level",
                      "sName"=> "level",
                      "bSearchable"=> false,
                      "bSortable"=> false,
                      "fnRender"=> "js:function (oObj) {
                          return ''+oObj.aData['level']+
                                  '';
                      }"
                  
                  )
              ,
              

 							array("sName"=> "ID",
								"bSearchable"=> false,
								"bSortable"=> false,
								"fnRender"=> "js:function (oObj) {
								return '<span class=\"button-group\">'+
										'<a href=\"".Yii::app()->createUrl('masters/anggota/update/id/')."/'+oObj.aData[0]+'\" class=\"button icon edit\">Edit</a>'+
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
				<th width="100">Username</th>
        <th >Level</th>
				
				<th width="240" >--</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	
	</div>
</div>
<?php
Yii::app()->clientScript->registerScript('peserta', "
  $(document).delegate('.pilihasessor','click',function(){
  var pid = $(this).attr('pid');
    $.ajax({
        url:'".Yii::app()->createUrl('masters/pesertaasesor/ajaxform/pid/')."/'+pid,
        success:function(form){
          $('#tempatenya').html(form);
          $('#editplace').show();
        }
      })
      
  });
");
/*$this->widget('zii.widgets.grid.CGridView', array(
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
