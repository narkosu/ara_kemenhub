<div class="speedbar">
    <div class="speedbar-content">
		<ul class="menu-drop">
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
		</ul>
		<ul class="menu-speedbar">
			<li><a href="<?php echo Yii::app()->createUrl('masters/'.$this->id.'/create')?>">Tambah Baru</a></li>
			<li><a href="<?php echo Yii::app()->createUrl('masters/'.$this->id.'')?>" class="act_linkx">Daftar</a></li>
			
		</ul>
	</div>
</div>