<div class="speedbar">
    <div class="speedbar-content">
		
		<Div style="float:left;">
			<?php /*<ul class="menu-drop">
				<li><a href="#"><i class="icon-chevron-down"></i></a>
					<ul>
						<li><a href="<?php echo Yii::app()->createUrl('masters/departement')?>">Departement</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('masters/deputi')?>">Deputi</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('masters/unitkerja')?>">Unit Kerja</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('masters/jabatan')?>">Jabatan</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('masters/tingkatjabatan')?>">Tingkat Jabatan</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('masters/jeniskompetensi')?>">Jenis Kompetensi</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('masters/kompetensi')?>">Kompetensi</a></li>
					</ul>  
				</li>
			</ul>*/?>
			
			<span class="button-group">
				<a href="<?php echo Yii::app()->createUrl('skj')?>" class="button icon home">SKJ</a>
				<a href="<?php echo Yii::app()->createUrl($this->module->id.'/masterskj/create')?>" class="button icon add">Tambah</a>
				<a href="<?php echo Yii::app()->createUrl('skj')?>" class="button icon log">Daftar</a>
			</span>
			<?php /*
			<div style="float:left;text-transform:uppercase;color:#fff;margin-top:9px;padding:5px;"><?php echo $this->module->id?> : </div>
			<ul class="menu-speedbar">
				<li><a href="<?php echo Yii::app()->createUrl($this->module->id.'/masterskj/create')?>">Tambah Baru</a></li>
				<li><a href="<?php echo Yii::app()->createUrl($this->module->id.'/'.$this->id.'')?>" class="act_linkx">Daftar</a></li>
				
			</ul>*/?>
		</Div>
		<div style="clear:both;"></div>
	</div>
</div>