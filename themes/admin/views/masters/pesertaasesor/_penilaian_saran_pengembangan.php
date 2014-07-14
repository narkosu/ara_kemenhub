
<style>
	#tblkompetensi td.nilaikompetensi{
		text-align:center;
		
	}
	<?php if ($preview ) { ?>
		#tblkompetensi{
		border: 1px solid #aaa;		
		}
		#tblkompetensi td.nilaikompetensi{
			text-align:center;
			border:1px solid #aaa;
		}
		
		#tblkompetensi tr td:first-child{
			padding-left:10px;
		}
		
		#tblkompetensi th{
			text-align:center;
			background: #eee;
			border:1px solid #aaa;
		}
		#tblkompetensi tr.jeniskompetensi td{
			text-align:center;
			border:1px solid #aaa;
			background: #fff;
			
		}
	<?php } ?>
	
</style>
<div style="float:left;width:90%;padding:0px 10px;">
		<?php 
			$kompetensi = Kompetensi::model()->findAll('departement_id = "'.$this->module->current_departement_id.'"');
			$getsaranarray = Saranpengembangan::model()->getsaranarray($this->module->current_departement_id);
		?>
		<table id="tblkompetensi" style="width:100%;font-size:12px;">
			<tr>
				<th width="20" style="border-left:1px solid #aaa;border-top:1px solid #aaa;">No</th>
				<th width="200" style="border-left:1px solid #aaa;border-top:1px solid #aaa;border-right:1px solid #aaa;">Kompetensi</th>
				<th width=150" style="border-left:1px solid #aaa;border-top:1px solid #aaa;border-right:1px solid #aaa;">Jenis Kegiatan Pengembangan</th>
				<th  style="border-left:1px solid #aaa;border-top:1px solid #aaa;border-right:1px solid #aaa;">Keterangan</th>
			</tr>
		<?php
			$nowjkom = '';
			$no = 1;
			foreach ((array) $kompetensi as $ko=>$value_komp) {
				$jkom 			= $value_komp->jeniskompetensi_id;
				unset($nilaiDefault);
				$nilaiDefault 	= $itemkompetensi[$jkom][$value_komp->id];
				unset($style);
				unset($selected);
				$nilaiselected 				= $nilai[$jkom][$value_komp->id]['nilai'];
				$nilaiakhir 				= $nilai[$jkom][$value_komp->id]['nilai_akhir'];
				$total_akhir				+= $nilaiakhir;
				$selected[$nilaiselected] 	= 'checked';
				$style[$nilaiDefault] 		= "background:#c0c;";
				
				if ( $jkom != $nowjkom ){
					$nowjkom = $jkom;
			?>
				<tr style="font-weight:bold;" dataid="<?php echo $jkom?>" >
					<td colspan="4" style="font-weight:bold;border-bottom:1px solid #aaa;border-top:1px solid #aaa;"><?php echo $value_komp->jenkom->name?></td>
					
				</tr>
			<?php	
				}
			?>
			<?php if (!empty($nilaiDefault) ) {
				$loadfirst = true;
				if ( $ringkasan['weakArray'][$jkom][$value_komp->id] ) {
				?>
				<?php foreach((array) $getsaranarray[$value_komp->id] as $jenispeng =>$sarpeng ) {
						$loadsubfirst = true;	
						foreach( $sarpeng  as $sarid=>$types){
					?>
						<tr >
							<td style="border-left:1px solid #aaa;border-bottom:1px solid #eee;padding:5px 5px;<?php echo ($loadfirst ? 'border-top:1px solid #aaa;' : '') ?>"><?php echo ($loadfirst ? $no : '') ?></td>
							<td style="border-left:1px solid #aaa;border-bottom:1px solid #eee;padding:5px 5px;<?php echo ($loadfirst ? 'border-top:1px solid #aaa;' : '') ?>">
								<?php
								if ( $loadfirst ){
									echo $ringkasan['weakArray'][$jkom][$value_komp->id];
								}?>
								
							</td>
							<td style="border-left:1px solid #aaa;border-bottom:1px solid #eee;padding:5px 5px;<?php echo ($loadfirst ? 'border-top:1px solid #aaa;' : '') ?>">
								
								<?php if ( $loadsubfirst ) {
									echo $types['jenis_pengembangan'];
									$loadsubfirst = false;
									
								}
								?>
								
							</td>
							<td style="border-left:1px solid #aaa;border-right:1px solid #aaa;border-bottom:1px solid #eee;padding:5px 5px;<?php echo ($loadfirst ? 'border-top:1px solid #aaa;' : '') ?>">
								<?php echo $types['saran_pengembangan']?>
							</td>
							</tr>
							<?php
								if ( $loadfirst ){
									$loadfirst = false;
									$no++;
								}	
							}
						
						}
					}
				}
				
			} ?>
			
		</table>	
</div>		