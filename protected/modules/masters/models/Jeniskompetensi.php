<?php

/**
 * This is the model class for table "{{jeniskompetensi}}".
 *
 * The followings are the available columns in table '{{jeniskompetensi}}':
 * @property integer $id
 * @property integer $departement_id
 * @property string $name
 * @property string $keterangan
 */
class Jeniskompetensi extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Jeniskompetensi the static model class
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
		return '{{jeniskompetensi}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('departement_id, name', 'required'),
			array('departement_id', 'numerical', 'integerOnly'=>true),
			array('name, keterangan', 'length', 'max'=>145),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, departement_id, name, keterangan', 'safe', 'on'=>'search'),
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
			'dept'=>array(self::BELONGS_TO,'Departement','departement_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'departement_id' => 'Departement',
			'name' => 'Name',
			'keterangan' => 'Keterangan',
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
		$criteria->compare('departement_id',$this->departement_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('keterangan',$this->keterangan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}