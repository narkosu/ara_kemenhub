
		<?php 
			$kompetensi = Kompetensi::model()->findAll('departement_id = "'.$this->module->current_departement_id.'"');
			$getsaranarray = Saranpengembangan::model()->getsaranarray($this->module->current_departement_id);
		?>
		<table id="tblkompetensi" style="font-family:'arial narrow';border:1px solid #000;width:610px;font-size:9pt;" cellpadding="0" cellspacing="0">
			<tr style="font-size:12pt;background: #000;color: #fff;">
				<td style="width:50px;text-align: center;">No.</td>
				<td style="border-left:1px solid #fff;text-align: center;width:100px">Kompetensi</td>
				<td  style="border-left:1px solid #fff;text-align: center;width:170px">Jenis Kegiatan Pengembangan</td>
				<td  style="border-left:1px solid #fff;text-align: center;width:290px">Keterangan</td>
			</tr>
		<?php
			$nowjkom = '';
			$no = 1;
			foreach ($kompetensi as $ko=>$value_komp) {
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
					$nowjkom = $jkom;/*
			?>
				<tr style="font-weight:bold;" dataid="<?php echo $jkom?>" >
					<td colspan="4" style="font-weight:bold;border-bottom:1px solid #aaa;border-top:1px solid #aaa;"><?php echo $value_komp->jenkom->name?></td>
					
				</tr>
			<?php	
				*/}
			?>
			<?php if (!empty($nilaiDefault) ) {
				$loadfirst = true;
				if ( $ringkasan['weakArray'][$jkom][$value_komp->id] ) {
				?>
				<?php foreach($getsaranarray[$value_komp->id] as $jenispeng =>$sarpeng ) {
						$loadsubfirst = true;	
						foreach( $sarpeng  as $sarid=>$types){
					?>
						<tr >
							<td style="text-align: center;border-right:1px solid #000;padding:5px 5px;<?php echo ($loadfirst ? 'border-top:1px solid #000;' : '') ?>"><?php echo ($loadfirst ? $no.'.' : '') ?></td>
							<td style="border-right:1px solid #000;padding:5px 5px;<?php echo ($loadfirst ? 'border-top:1px solid #000;' : '') ?>">
								<?php
								if ( $loadfirst ){
									echo $ringkasan['weakArray'][$jkom][$value_komp->id];
								}?>
								
							</td>
							<td style="border-right:1px solid #000;padding:5px 5px;<?php echo ($loadfirst ? 'border-top:1px solid #000;' : ( $loadsubfirst ? 'border-top:1px solid #000;': '')) ?>">
								<?php
								$forsub = $loadsubfirst;
								if ( $loadsubfirst ) {
									echo $types['jenis_pengembangan'];
									$loadsubfirst = false;
								}
								?>
							</td>
							<td style="padding:5px 5px;<?php echo ($loadfirst ? 'border-top:1px solid #000;' : ( $forsub ? 'border-top:1px solid #000;': '')) ?>">
							<table cellspacing="0" cellpadding="0" style="font-size: 9pt;font-family: 'arial narrow';"><tr><td style="vertical-align: top;width:10px;">&bull;</td><td><?php echo $types['saran_pengembangan'];?></td></tr></table>
								
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