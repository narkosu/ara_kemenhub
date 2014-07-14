<style>
	#tblkompetensi td.nilaikompetensi{
		text-align:center;
		
	}
	<?php if ($preview ) { ?>
		#tblkompetensi{
				
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

		<?php 
			$kompetensi = Kompetensi::model()->findAll('departement_id = "'.$this->module->current_departement_id.'"');
		?>
		<table id="tblkompetensi" style="width:90%;font-size:12pt;font-family: 'arial narrow';">
			<tr>
				<th style="text-align:left;">Area Kekuatan</th>
				<th style="text-align:left;">Area yang Memerlukan Peningkatan</th>
			</tr>
			<tr>
			<td style="vertical-align: top;">
				<ul>
				<?php
				foreach ( (array) $ringkasan['strongArray'] as $strong){
				foreach ( (array) $strong as $valstrong){
				?>
				<li><?php echo $valstrong?></li>
				<?php
				}
				}
				?>
				</ul>
			</td>
			<td style="vertical-align: top;">
				<ul>
				<?php
				foreach ( (array) $ringkasan['weakArray'] as $weak){
				foreach ( (array) $weak as $valweak){
				?>
				<li><?php echo $valweak?></li>
				<?php
				}
				}
				?>
				</ul>
			</td>
			</tr>
		</table>	
