<?php

/**
 * This is the model class for table "{{kompetensi}}".
 *
 * The followings are the available columns in table '{{kompetensi}}':
 * @property integer $id
 * @property integer $departement_id
 * @property integer $jeniskompetensi_id
 * @property string $name
 * @property string $alias
 * @property integer $nilai
 * @property string $status
 */
class Kompetensi extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Kompetensi the static model class
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
		return '{{kompetensi}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('departement_id, jeniskompetensi_id, name', 'required'),
			array('departement_id, jeniskompetensi_id, nilai', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>145),
			array('alias, status', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, departement_id, jeniskompetensi_id, name, alias, nilai, status', 'safe', 'on'=>'search'),
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
			'dept'=>array(self::BELONGS_TO,'Departement','departement_id'),
			'jenkom'=>array(self::BELONGS_TO,'Jeniskompetensi','jeniskompetensi_id')
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
			'jeniskompetensi_id' => 'Jeniskompetensi',
			'name' => 'Name',
			'alias' => 'Alias',
			'nilai' => 'Nilai',
			'status' => 'Status',
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
		$criteria->compare('jeniskompetensi_id',$this->jeniskompetensi_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('nilai',$this->nilai);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
  
  public function jumlahKompetensi(){
    return $this->count('jeniskompetensi_id = :jkid',array(':jkid'=>$this->jeniskompetensi_id));
  }
  
  public function listKompetensi($dept_id){
    return $this->findAll('departement_id = :dept_id',
            array(':dept_id'=>$dept_id));
  }
}