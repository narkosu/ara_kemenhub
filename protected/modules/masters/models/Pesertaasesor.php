<?php

/**
 * This is the model class for table "{{pesertaasesor}}".
 *
 * The followings are the available columns in table '{{pesertaasesor}}':
 * @property integer $id
 * @property integer $id_departemen
 * @property integer $id_peserta
 * @property integer $id_asesor
 */
class Pesertaasesor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pesertaasesor the static model class
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
		return '{{pesertaasesor}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_departemen, id_peserta, id_asesor', 'required'),
			array('id_departemen, id_peserta, id_asesor', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_departemen, id_peserta, id_asesor', 'safe', 'on'=>'search'),
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
			'dept'=>array(self::BELONGS_TO,'Departement','id_departemen'),
			'peserta'=>array(self::BELONGS_TO,'Peserta','id_peserta'),
			'asesor'=>array(self::BELONGS_TO,'Masterasesor','id_asesor'),
			'penilaian'=>array(self::HAS_ONE,'Penilaian',array('peserta_id'=>'id_peserta','assessor_id'=>'id_asesor')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_departemen' => 'Departemen',
			'id_peserta' => 'Peserta',
			'id_asesor' => 'Asesor',
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
		$criteria->compare('id_peserta',$this->id_peserta);
		$criteria->compare('id_asesor',$this->id_asesor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function datatables($criteria){
		$Count = $this->count($criteria);
		
		//$criteria->with = array('dept');
		$criteria->offset = $_GET['iDisplayStart'];
		
		$criteria->limit = $_GET['iDisplayLength'];
		
		
		$items = $this->findAll($criteria);
			
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $Count,
			"iTotalDisplayRecords" => $Count,
			"aaData" => array()
		);

		foreach ($items as $i=>$iskj){
			unset($row);
			
			foreach ($iskj as $field => $vale){
				$row[] = $vale;
				if ( $field == 'id_departemen') {
					$row[] = $iskj->dept->name;
				}else 
				if ( $field == 'id_peserta') {
					$row['peserta']->nama_peserta = $iskj->peserta->nama_peserta;
					$row['peserta']->kode_peserta = $iskj->peserta->kode_peserta;
					$row['peserta']->nip = $iskj->peserta->nip;
					
				} else
				if ( $field == 'id_asesor') {
					$row[] = $iskj->asesor->nama_asesor;
					
				} 
			}
			$row['penilaian'] = $iskj->penilaian->persentase_pemenuhan;
			$row[] = $iskj->id;//for else
			$output['aaData'][] = $row;
		}
		return $output;
	}
}