<?php

/**
 * This is the model class for table "{{uraiankompetensi}}".
 *
 * The followings are the available columns in table '{{uraiankompetensi}}':
 * @property string $id
 * @property integer $departement_id
 * @property integer $penilaian_id
 * @property integer $jenis_kompetensi
 * @property string $uraian
 */
class Uraiankompetensi extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Uraiankompetensi the static model class
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
		return '{{uraiankompetensi}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('departement_id, penilaian_id, jenis_kompetensi', 'numerical', 'integerOnly'=>true),
			array('uraian', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, departement_id, penilaian_id, jenis_kompetensi, uraian', 'safe', 'on'=>'search'),
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
			'penilaian_id' => 'Penilaian',
			'jenis_kompetensi' => 'Jenis Kompetensi',
			'uraian' => 'Uraian',
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
		$criteria->compare('departement_id',$this->departement_id);
		$criteria->compare('penilaian_id',$this->penilaian_id);
		$criteria->compare('jenis_kompetensi',$this->jenis_kompetensi);
		$criteria->compare('uraian',$this->uraian,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function uraianKompetensiArray($id){
		$result = $this->findAll('penilaian_id = :penid',array(':penid'=>$id));
		foreach ($result as $value){
			$return[$value->jenis_kompetensi] = $value->uraian;
		}
		return $return;
	}
}