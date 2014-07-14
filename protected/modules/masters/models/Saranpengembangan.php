<?php

/**
 * This is the model class for table "{{saranpengembangan}}".
 *
 * The followings are the available columns in table '{{saranpengembangan}}':
 * @property integer $id
 * @property integer $departemen_id
 * @property integer $kompetensi_id
 * @property integer $jenispengembangan_id
 * @property string $nama_saran
 */
class Saranpengembangan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Saranpengembangan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{saranpengembangan}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('departemen_id, kompetensi_id, jenispengembangan_id, nama_saran', 'required'),
			array('id, departemen_id, kompetensi_id, jenispengembangan_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, departemen_id, kompetensi_id, jenispengembangan_id, nama_saran', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'jenpeng'=>array(self::BELONGS_TO,'Jenispengembangan','jenispengembangan_id'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'departemen_id' => 'Departemen',
			'kompetensi_id' => 'Kompetensi',
			'jenispengembangan_id' => 'Jenispengembangan',
			'nama_saran' => 'Nama Saran',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('departemen_id',$this->departemen_id);
		$criteria->compare('kompetensi_id',$this->kompetensi_id);
		$criteria->compare('jenispengembangan_id',$this->jenispengembangan_id);
		$criteria->compare('nama_saran',$this->nama_saran,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getsaranarray($depid){
		
		$r = $this->findAll('departemen_id = :deptid',array(':deptid'=>$depid));
		foreach ($r as $row){
			$return[$row->kompetensi_id][$row->jenispengembangan_id][$row->id]['jenis_pengembangan'] = $row->jenpeng->nama_pengembangan;
			$return[$row->kompetensi_id][$row->jenispengembangan_id][$row->id]['saran_pengembangan'] = $row->nama_saran;
		}
		//print_r($return);
		return $return;
	}
}