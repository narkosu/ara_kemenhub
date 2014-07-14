<?php

/**
 * This is the model class for table "{{itemskj}}".
 *
 * The followings are the available columns in table '{{itemskj}}':
 * @property integer $id
 * @property integer $skj_id
 * @property integer $departement_id
 * @property integer $deputi_id
 * @property integer $unitkerja_id
 * @property integer $jabatan_id
 * @property integer $tingkatjabatan_id
 * @property integer $rumpunjabatan_id
 * @property string $status
 */
class Itemskj extends CActiveRecord
{
	private $fullField;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Itemskj the static model class
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
		return '{{itemskj}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('skj_id, departement_id, deputi_id, unitkerja_id, jabatan_id', 'required'),
			array('skj_id, departement_id, deputi_id, unitkerja_id, jabatan_id, tingkatjabatan_id, rumpunjabatan_id', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, skj_id, departement_id, deputi_id, unitkerja_id, jabatan_id, tingkatjabatan_id, rumpunjabatan_id, status', 'safe', 'on'=>'search'),
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
			'skj'=>array(self::BELONGS_TO,'Masterskj','skj_id'),
			'dept'=>array(self::BELONGS_TO,'Departement','departement_id'),
			'deput'=>array(self::BELONGS_TO,'Deputi','deputi_id'),
			'uk'=>array(self::BELONGS_TO,'Unitkerja','unitkerja_id'),
			'jab'=>array(self::BELONGS_TO,'Jabatan','jabatan_id'),
			't_jab'=>array(self::BELONGS_TO,'Tingkatjabatan','tingkatjabatan_id'),
			'r_jab'=>array(self::BELONGS_TO,'Rumpunjabatan','rumpunjabatan_id'),
      'kompetensiskj'=>array(self::HAS_MANY,'Kompetensiskj','itemskj_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'skj_id' => 'Skj',
			'departement_id' => 'Departement',
			'deputi_id' => 'Deputi',
			'unitkerja_id' => 'Unitkerja',
			'jabatan_id' => 'Jabatan',
			'tingkatjabatan_id' => 'Tingkatjabatan',
			'rumpunjabatan_id' => 'Rumpunjabatan',
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
		$criteria->compare('skj_id',$this->skj_id);
		$criteria->compare('departement_id',$this->departement_id);
		$criteria->compare('deputi_id',$this->deputi_id);
		$criteria->compare('unitkerja_id',$this->unitkerja_id);
		$criteria->compare('jabatan_id',$this->jabatan_id);
		$criteria->compare('tingkatjabatan_id',$this->tingkatjabatan_id);
		$criteria->compare('rumpunjabatan_id',$this->rumpunjabatan_id);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getFullField(){
		return $this->deput->deputi_name.' - '.$this->uk->unitkerja_name.' - '.$this->jab->jabatan_name
										.' - '.$this->t_jab->tingkat_jabatan
										.' - '.$this->r_jab->rumpun_jabatan;
	}
  
  
}