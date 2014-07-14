<?php
class cdatatables extends CWidget {
 
    public $buttons = array();
    public $delimiter = ' / ';
	protected $path;
	public $options = array();
	public function init()
    {
		$id = $this->getId();
		$defaultOptions = array(
			'baseUrl'			=> CJSON::encode(Yii::app()->baseUrl),
			/*'bootstrap'			=> $this->bootstrap,
			// options inherited from CGridView JS scripts
			'ajaxUpdate'		=> $this->ajaxUpdate===false ? false : array_unique(preg_split('/\s*,\s* /',$this->ajaxUpdate.','.$id,-1,PREG_SPLIT_NO_EMPTY)),
			'ajaxOpts'			=> array_merge(array($this->ajaxVar => $this->getId()), $this->serverData),
			'pagerClass'		=> $this->bootstrap ? 'paging_bootstrap pagination' : $this->pagerCssClass,
			'loadingClass'		=> $this->loadingCssClass,
			'filterClass'		=> $this->filterCssClass,
			//'tableClass'		=> $this->itemsCssClass,
			'selectableRows'	=> $this->selectableRows,
			'editableSelectsRow'=> $this->editableSelectsRow,
			// dataTables options
			'asStripClasses'	=> $this->rowCssClass,
			'iDeferLoading'		=> $this->dataProvider->getTotalItemCount(),
			'sAjaxSource'		=> CHtml::normalizeUrl($this->ajaxUrl),
			'aoColumnDefs'		=> $columnDefs,
			'sDom'				=> $this->bootstrap ? "<><'row'<'span3'l><'dataTables_toolbar'><'pull-right'f>r>t<'row'<'span3'i><'pull-right'p>>" : "<><'H'l<'dataTables_toolbar'>fr>t<'F'ip>",
			'bScrollCollapse'	=> false,
			'bStateSave'		=> false,
			'bPaginate'			=> true,
			'sCookiePrefix'		=> 'edt_',
			'bJQueryUI'			=> !$this->bootstrap,
			'relatedOnlyLabel'	=> Yii::t('EDataTables.edt', 'Only related'),
			*/
		);
		
		$options=array_merge($defaultOptions, $this->options);
		
		$doScript = '';
        
		$doScript .= "
				$(document).ready( function () {
					var oTable = $('#example').dataTable( {
						'sScrollY': '300px',
						'bPaginate': true,
						'sScrollX': '90%',
						'sScrollXInner': '150%',
						'bScrollCollapse': true,
						'sPaginationType': 'full_numbers',
						'bProcessing': true,
						'bServerSide': true,
						'sAjaxSource': '".Yii::app()->createUrl('/skj/itemskj/load_server_processing/skjid/1')."' ,
						'fnServerData': function ( sSource, aoData, fnCallback ) {
											/* Add some extra data to the sender */
											//aoData.push( { 'name': 'more_data', 'value': 'my_value' } );
											$.ajax({
											  'dataType' : 'json',
											  'type' : 'GET',
											  'url' : sSource,
											  'data' : aoData,
											  'success' : function(json) {
												fnCallback(json);
												//new FixedColumns( oTable );
												/*oTable.$('td').editable( '../examples_support/editable_ajax.php', {
													'callback': function( sValue, y ) {
														var aPos = oTable.fnGetPosition( this );
														oTable.fnUpdate( sValue, aPos[0], aPos[1] );
													},
													'submitdata': function ( value, settings ) {
														return {
															'row_id': this.parentNode.getAttribute('id'),
															'column': oTable.fnGetPosition( this )[2]
														};
													},
													'height': '14px',
													'width': '100%'
												} );
												*/
												
											}
											}); //AJAX
										}
					}
					); // DATATABLES

					
        function fnCreateSelect( aData )
        {
          var r='<select><option value=\"\"></option>', i, iLen=aData.length;
          for ( i=0 ; i<iLen ; i++ )
          {
            r += '<option value=\"'+aData[i]+'\">'+aData[i]+'</option>';
          }
          return r+'</select>';
        }
        
					$('tfoot th').each( function ( i ) {
              this.innerHTML = fnCreateSelect( oTable.fnGetColumnData(i) );
              $('select', this).change( function () {
                oTable.fnFilter( $(this).val(), i );
              } );
            } );
					
				} );
		";
		$options=CJavaScript::encode($options);
		$doScripts = "var oTable = jQuery('#$id').dataTable($options);
						  /*oTable.makeEditable({
							sDeleteURL: '/Home/DeleteData.php'
						})*/;	
		
		";	
		//$cs = Yii::app()->clientScript;
		
		$cs=Yii::app()->getClientScript();
		//$cs->registerScript(__CLASS__.'#'.$id,"jQuery('#$id').dataTable($options);");
		//$cs->registerScript(__CLASS__.'#'.$id,"jQuery('#$id').eDataTables($options);");
		$cs->registerScript('cdatatables',$doScripts);
        $this->path = Yii::app()->getAssetManager()->publish(dirname(__FILE__).DIRECTORY_SEPARATOR."assets",false,-1,true);
		$cs->registerScriptFile($this->path . '/js/jquery.jeditable.js');
		$cs->registerScriptFile($this->path . '/js/jquery.dataTables.editable.js');
		$cs->registerScriptFile($this->path . '/js/jquery.dataTables.js');
		$cs->registerScriptFile($this->path . '/js/FixedColumns.js');
		
		
        $cs->registerCssFile( $this->path . '/css/demo_table.css?'.time());
        //$cs->registerScriptFile( $this->path . '/jquery.wookmark.js?'.time());
       
        
    }
	
    public function run() {
		/*
		*/
       // $this->render();
    }
 
}
?>