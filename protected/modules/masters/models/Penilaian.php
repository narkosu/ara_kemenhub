<?php

/**
 * This is the model class for table "{{penilaian}}".
 *
 * The followings are the available columns in table '{{penilaian}}':
 * @property string $id
 * @property integer $departement_id
 * @property integer $assessor_id
 * @property integer $peserta_id
 * @property integer $skj_id
 * @property string $created_at
 */
class Penilaian extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Penilaian the static model class
	 */
  public $_count;
  public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{penilaian}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('departement_id, assessor_id, peserta_id, skj_id,itemskj_id,', 'numerical', 'integerOnly'=>true),
			array('created_at,data_kinerja,matrix,CFIT,GATB,PAULI,file_cfit,file_gatb,file_pauli,persentase_kompetensi,gap_akhir', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, departement_id, assessor_id, peserta_id, skj_id, created_at', 'safe', 'on'=>'search'),
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
			'itemskj'=>array(self::BELONGS_TO,'Itemskj','itemskj_id'),
			'kompetensiskj'=>array(self::MANY_MANY,'Itemskj','tbl_kompetensiskj(skj_id,itemskj_id)'),
			'pesertaasesor' => array(self::BELONGS_TO, 'Pesertaasesor', 'assessor_id,peserta_id'),
			'peserta' => array(self::BELONGS_TO, 'Peserta', 'peserta_id'),
      'detail' => array(self::HAS_MANY, 'Detailpenilaian', 'penilaian_id'),
      'asesor' => array(self::BELONGS_TO, 'Masterasesor', 'assessor_id'),
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
			'assessor_id' => 'Assessor',
			'peserta_id' => 'Peserta',
			'skj_id' => 'Skj',
			'created_at' => 'Created At',
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
		$criteria->compare('assessor_id',$this->assessor_id);
		$criteria->compare('peserta_id',$this->peserta_id);
		$criteria->compare('skj_id',$this->skj_id);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
  
  public function jumlahKompetensiAvailable($jkid){
    return Kompetensiskj::model()->count('jeniskompetensi_id = :jkid and nilai != "" AND itemskj_id = :itk'
                ,array(':jkid'=>$jkid,':itk'=>$this->itemskj_id));
    
  }
}