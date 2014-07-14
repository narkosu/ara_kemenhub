<?php

class MastersModule extends CWebModule
{
	public $filefolder = 'files/'; // Approot/...
	public $current_departement_id;
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'masters.models.*',
			'skj.models.*',
		));
		$this->current_departement_id = Yii::app()->user->getState('current_departement_id');

	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			/*if ( Yii::app()->user->isGuest ){
				Yii::app()->request->redirect(Yii::app()->homeUrl);
			}*/
			return true;
		}
		else
			return false;
	}
}
