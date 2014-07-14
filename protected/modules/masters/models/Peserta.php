<?php

/**
 * This is the model class for table "{{peserta}}".
 *
 * The followings are the available columns in table '{{peserta}}':
 * @property integer $id
 * @property integer $id_departemen
 * @property string $nip
 * @property string $nama_peserta
 */
class Peserta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Peserta the static model class
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
		return '{{peserta}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_departemen, nip, nama_peserta', 'required'),
			array('id_departemen', 'numerical', 'integerOnly'=>true),
			array('nip, nama_peserta', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_departemen, nip, nama_peserta', 'safe', 'on'=>'search'),
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
			'penilaian'  => array(self::HAS_ONE, 'Penilaian', array( 'departement_id'=>'id_departemen','peserta_id'=>'id') ),
			'dept'=>array(self::BELONGS_TO,'Departement','id_departemen'),
      'asessor'=>array(self::HAS_ONE,'Pesertaasesor','id_peserta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_departemen' => 'Id Departemen',
			'nip' => 'Nip',
			'nama_peserta' => 'Nama Peserta',
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
		$criteria->compare('id_departemen',$this->id_departemen);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('nama_peserta',$this->nama_peserta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
  
  public function getRekap(){
      return $this->findAll();
  }
}