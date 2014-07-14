<?php

/**
 * This is the model class for table "{{detailpenilaian}}".
 *
 * The followings are the available columns in table '{{detailpenilaian}}':
 * @property string $id
 * @property integer $penilaian_id
 * @property integer $jeniskompetensi_id
 * @property integer $kompetensi_id
 * @property integer $nilai_default
 * @property integer $nilai
 * @property integer $nilai_akhir
 */
class Detailpenilaian extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Detailpenilaian the static model class
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
		return '{{detailpenilaian}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('penilaian_id, jeniskompetensi_id, kompetensi_id, nilai_default, nilai, nilai_akhir', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, penilaian_id, jeniskompetensi_id, kompetensi_id, nilai_default, nilai, nilai_akhir', 'safe', 'on'=>'search'),
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
			'jenkom'=>array(self::BELONGS_TO,'Jeniskompetensi','jeniskompetensi_id'),
			'komp'=>array(self::BELONGS_TO,'Kompetensi','jeniskompetensi_id,kompetensi_id'),
			'penilaian'=>array(self::BELONGS_TO,'Penilaian','penilaian_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'penilaian_id' => 'Penilaian',
			'jeniskompetensi_id' => 'Jeniskompetensi',
			'kompetensi_id' => 'Kompetensi',
			'nilai_default' => 'Nilai Default',
			'nilai' => 'Nilai',
			'nilai_akhir' => 'Nilai Akhir',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('penilaian_id',$this->penilaian_id);
		$criteria->compare('jeniskompetensi_id',$this->jeniskompetensi_id);
		$criteria->compare('kompetensi_id',$this->kompetensi_id);
		$criteria->compare('nilai_default',$this->nilai_default);
		$criteria->compare('nilai',$this->nilai);
		$criteria->compare('nilai_akhir',$this->nilai_akhir);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function kompetensinilaiArray($id){
		$result = $this->findAll('penilaian_id = :penid',array(':penid'=>$id));
		foreach ($result as $value){
			$return[$value->jeniskompetensi_id][$value->kompetensi_id]['nilai'] = $value->nilai;
			$return[$value->jeniskompetensi_id][$value->kompetensi_id]['nilai_default'] = $value->nilai_default;
			$return[$value->jeniskompetensi_id][$value->kompetensi_id]['nilai_akhir'] = $value->nilai_akhir;
			$return[$value->jeniskompetensi_id][$value->kompetensi_id]['title'] = $value->komp->name;
		}
		return $return;
	}
}