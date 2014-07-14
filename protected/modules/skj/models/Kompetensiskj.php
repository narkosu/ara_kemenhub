<?php

/**
 * This is the model class for table "{{kompetensiskj}}".
 *
 * The followings are the available columns in table '{{kompetensiskj}}':
 * @property integer $id
 * @property integer $skj_id
 * @property integer $itemskj_id
 * @property integer $jeniskompetensi_id
 * @property integer $kompetensi_id
 * @property string $nilai
 */
class Kompetensiskj extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Kompetensiskj the static model class
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
		return '{{kompetensiskj}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('skj_id, itemskj_id, jeniskompetensi_id, kompetensi_id', 'required'),
			array('skj_id, itemskj_id, jeniskompetensi_id, kompetensi_id', 'numerical', 'integerOnly'=>true),
			array('nilai', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, skj_id, itemskj_id, jeniskompetensi_id, kompetensi_id, nilai', 'safe', 'on'=>'search'),
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
			  'jenisKompetensi'=>array(self::BELONGS_TO,'Jeniskompetensi','jeniskompetensi_id'),
        'kompetensi'=>array(self::BELONGS_TO,'Kompetensi', 'kompetensi_id'),
        'penilaian'=>array(self::HAS_MANY,'Penilaian',array('skj_id'=>'skj_id','itemskj_id'=>'itemskj_id'))
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
			'itemskj_id' => 'Itemskj',
			'jeniskompetensi_id' => 'Jeniskompetensi',
			'kompetensi_id' => 'Kompetensi',
			'nilai' => 'Nilai',
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
		$criteria->compare('itemskj_id',$this->itemskj_id);
		$criteria->compare('jeniskompetensi_id',$this->jeniskompetensi_id);
		$criteria->compare('kompetensi_id',$this->kompetensi_id);
		$criteria->compare('nilai',$this->nilai,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function loadKompetensiskj($skjid,$itemskjid)
	{
		$model=Kompetensiskj::model()->findAll('skj_id = :skjid and itemskj_id = :itemskjid',array(':skjid'=>$skjid,'itemskjid'=>$itemskjid));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function getItemKompetensiById($skjid,$itemskjid){
		static $return, $output;
		if (!$return) {
			$return = $this->loadKompetensiskj($skjid,$itemskjid);
			
			if ($return){
				foreach ($return as $value){
					$output[$value->jeniskompetensi_id][$value->kompetensi_id] = $value->nilai;
				}
			}
		}
		
		return $output;
	}
  
  
  
}