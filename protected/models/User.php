<?php

class User extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_user':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $salt
	 * @var string $email
	 * @var string $profile
	 */
	
	const LEVEL_REGISTERED=0, LEVEL_AUTHOR=1, LEVEL_VIEW=3,LEVEL_ADMIN=100, LEVEL_SUPERADMIN=99;
	
	
	//define the label for each level
	static function getAccessLevelList( $level = null ){
		$levelList=array(
			self::LEVEL_REGISTERED => 'Registered',
			self::LEVEL_AUTHOR => 'Author',
			self::LEVEL_ADMIN => 'Administrator',
			self::LEVEL_VIEW => 'Pengawas',
			self::LEVEL_SUPERADMIN => 'Super Administrator'
		);
		
		if( $level === null)
			return $levelList;
		return $levelList[ $level ];
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, salt', 'required'),
			array('username, password, salt, email', 'length', 'max'=>128),
			array('profile,accessLevel', 'safe'),
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
			'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'username' => 'Username',
			'password' => 'Password',
			'salt' => 'Salt',
			'email' => 'Email',
			'profile' => 'Profile',
			'accessLevel'=>'accessLevel'
		);
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt)===$this->password;
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	public function hashPassword($password,$salt)
	{
		return md5($salt.$password);
	}

	/**
	 * Generates a salt that can be used to generate a password hash.
	 * @return string the salt
	 */
	protected function generateSalt()
	{
		return uniqid('',true);
	}
  
  public function generatePassword($password)
	{	
		$this->salt = $this->generateSalt();
		$this->password = $this->hashPassword($password,$this->salt);
	}
  
}