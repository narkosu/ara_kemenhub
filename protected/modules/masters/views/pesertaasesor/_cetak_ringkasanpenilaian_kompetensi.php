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

		<?php 
			$kompetensi = Kompetensi::model()->findAll('departement_id = "'.$this->module->current_departement_id.'"');
		?>
		<table id="tblkompetensi" style="border: 1px solid #aaa;width:90%;font-size:12pt;font-family: 'arial narrow';">
			<tr>
				<th style="border-left:1px solid #aaa;border-top:1px solid #aaa;">Area Kekuatan</th>
				<th style="border-left:1px solid #aaa;border-top:1px solid #aaa;border-right:1px solid #aaa;">Area yang Memerlukan Peningkatan</th>
			</tr>
			<tr>
			<td style="vertical-align: top;">
				<ul>
				<?php
				foreach ( $ringkasan['strongArray'] as $strong){
				foreach ( $strong as $valstrong){
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
				foreach ( $ringkasan['weakArray'] as $weak){
				foreach ( $weak as $valweak){
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
