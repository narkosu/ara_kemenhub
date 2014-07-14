<?php

class Assessment extends CModel
{
	/**
	 * The followings are the available columns in table 'tbl_comment':
	 * @var integer $id
	 * @var string $content
	 * @var integer $status
	 * @var integer $create_time
	 * @var string $author
	 * @var string $email
	 * @var string $url
	 * @var integer $post_id
	 */
	const STATUS_PENDING=1;
	const STATUS_APPROVED=2;
	public $inputNilai;
  public $standard;
  public $jenisNilai; //pengelompokan perhitungan (persentase) per jenis kopetensi
  public $departement;
  public $jumlahkompetensi; // jumlah kompetensi dalan satu jenis kompetensi
  public $nilaiakhir;
	/*
	 * $FORMULA = array('DEPARTEMENT'=>array('SKJ'=>array('ITEMSKJ' => '(input/standard)/15*100'))); // kemenhub
	 */
	public $FORMULA = array('2' => '(input/standard)/15*100', // kemenhub
							'1'=> '(((input/standard)*(jenis/100))/jumlahkompetensi)*100', // KPK
							); 
	
	public $REKOMENDASI = array('2' => array("KP" => array('caption'=>'KURANG POTENSIAL',
														   'MAX'=>80.49,
														   'MIN'=>0),
											 "PC" => array('caption'=>'POTENSIAL DENGAN CATATAN',
														   'MAX'=>95.49,
														   'MIN'=>80.50),
											 "P" => array('caption'=>'POTENSIAL',
														   //'MAX'=>100,
														   'MIN'=>95.50),
											 ), // kemenhub
							'1'=> '(((input/standard)*(jenis/100))/jumlahkompetensi)*100', // KPK
							);
	
	public $MATRIX = array('2' => array("KP" => array('K'=>9,'C'=>6,'B'=>5),
										"PC" => array('K'=>8,'C'=>4,'B'=>2),
										"P" =>  array('K'=>1,'C'=>3,'B'=>1),
										), // kemenhub
							'1'=> '(((input/standard)*(jenis/100))/jumlahkompetensi)*100', // KPK
							);
	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return new $className;
	}

	public function attributeNames()
	{
	
		return array('inputNilai'=>'inputNilai');	
	
	}

	public function rekomendasi($iddepartement='',$nilaiakhir = ''){
		if (empty($iddepartement) ) return;
		if (empty($nilaiakhir) ) return;
		
		$getRekomendasi = $this->REKOMENDASI[$iddepartement];
    
		foreach ((array) $getRekomendasi as $key=>$data){
      if ( !empty($data['MAX']) ){
        if ($nilaiakhir >= $data['MIN'] && $nilaiakhir <= ($data['MAX']+1)){
          
          $rekomendasi = array('id'=>$key,'caption'=>$data['caption']);
        }
      } else {
        if ($nilaiakhir >= $data['MIN'] ){
        
          $rekomendasi = array('id'=>$key,'caption'=>$data['caption']);
          
        }
      }  
        
		}
    //echo $nilaiakhir.' '.$rekomendasi['id'].'<br>';
		return array('result'=>$rekomendasi,'data'=>$getRekomendasi);
	}
	
  
  
	public function matrix($iddepartement='',$rekomendasi = '',$datakinerja = ''){
		if (empty($iddepartement) ) return;
		if (empty($rekomendasi) ) return;
		if (empty($datakinerja) ) return;
		
		$getMatrix = $this->MATRIX[$iddepartement];
		
		return $getMatrix[$rekomendasi][$datakinerja];
	}
	
	public function calculate(){
		$getFormula = $this->FORMULA[$this->departement];
		
		$string = $this->rechange($getFormula,array(
									'input'=>$this->inputNilai(),
									'standard'=>$this->standard(),
									'jenis'=>$this->jenis(),
									'jumlahkompetensi'=>$this->countGroup(),
									)
								  );
		
		//$string = ' ($this->inputNilai()/$this->standard())/15*100';
		return $this->calculate_string($string);  // outputs 92
		
	}
	
	function calculate_string( $string )    {
		$string = trim($string);
		$string = preg_replace('/[^0-9\+\-\*\/\(\) ]/i', '', $string);
    
		$compute = create_function('', 'return (' . $string . ');' );
		return 0 + $compute();
	}
	
	public function inputNilai(){
		return (!empty($this->inputNilai) ? $this->inputNilai : 0);
	}
	
	public function standard(){
		return $this->standard;
	}
	
	public function jenis(){
		return (!empty($this->jenisNilai) ? $this->jenisNilai : 0);
	}
	
	public function countGroup(){
		return $this->jumlahkompetensi;
	}
	
	function rechange($string,$params){
		return preg_replace('/([a-z_]+)/e', '$params[$1]', $string);
	}
	
  function setAllRekomendasi($departement){
    
    $updatePenilaian->rekomendasi = $this->__getRekomendasi($departement,$nilai);
    
    $penilaian = Penilaian::model()->findAll('departement_id = :dp',array(':dp'=>$departement));
    foreach ((array) $penilaian as $row){
      $pid = $row->id;
      unset($nilai);
      $nilai = round($this->__calculation($pid));
      $updatePenilaian = $row;
      $updatePenilaian->persentase_pemenuhan = $nilai;
      $updatePenilaian->rekomendasi = $this->__getRekomendasi($departement,$nilai);
      $updatePenilaian->save();
      echo '<br>peserta '.$row->peserta_id.' =>  '.$pid.' = '.$nilai.' : '.$updatePenilaian->rekomendasi.'<br>';
      
    }
  }
  
  private function __calculation($pid){
    $PenilaianDetail  = Detailpenilaian::model()
                          ->findAll('penilaian_id = :pid'
                            ,array(':pid'=>$pid)
                            );
    foreach ((array) $PenilaianDetail as $key=>$data){
      $asses = Assessment::model();
      //$inputNilai,$standard,$jenisNilai,$departement,$jumlahkompetensi,
      $jumlahkompetensi =  $data->penilaian->jumlahKompetensiAvailable($data->jeniskompetensi_id);
      
      $asses->inputNilai = $data->nilai;
      $asses->standard = $data->nilai_default;
      $asses->departement = $data->penilaian->departement_id;
      $asses->jumlahkompetensi = $jumlahkompetensi;
      $calculasi = $asses->calculate();
      $result += $calculasi;
      echo '<br>'.$result .' = '.$calculasi.' -> '.round($calculasi) .'<br>';
    }
    
    return $result;
  } 
  
  private function __getRekomendasi($iddepartement='',$nilaiakhir = ''){
    $result = $this->rekomendasi($iddepartement,$nilaiakhir);
    return $result['result']['id'];
  }
}