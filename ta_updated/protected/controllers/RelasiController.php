<?php

class RelasiController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','lookup','lookup2'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Relasi;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Relasi']))
		{
			
			$sql = "SELECT id FROM metadata_relasi where deskripsi='".$_POST['Relasi']['id_relasi']."'";
			$dbCommand = Yii::app()->db->createCommand($sql);
			$id_relasi = $dbCommand->queryAll();
			$_POST['Relasi']['creater']=Yii::app()->user->id;
			
			$_POST['Relasi']['id_relasi']=$id_relasi[0]['id'];
			$sql = "SELECT id FROM data_penelitian where judul='".$_POST['Relasi']['id_paper_1']."'";
			$dbCommand = Yii::app()->db->createCommand($sql);
			$id_paper_1 = $dbCommand->queryAll();
			$_POST['Relasi']['id_paper_1']=$id_paper_1[0]['id'];
			$sql = "SELECT id FROM data_penelitian where judul='".$_POST['Relasi']['id_paper_2']."'";
			$dbCommand = Yii::app()->db->createCommand($sql);
			$id_paper_2 = $dbCommand->queryAll();
			$_POST['Relasi']['id_paper_2']=$id_paper_2[0]['id'];
			$model->attributes=$_POST['Relasi'];
			var_dump($model->attributes);
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Relasi']))
		{
			$sql = "SELECT id FROM metadata_relasi where deskripsi='".$_POST['Relasi']['id_relasi']."'";
			$dbCommand = Yii::app()->db->createCommand($sql);
			$id_relasi = $dbCommand->queryAll();
			
			$_POST['Relasi']['id_relasi']=$id_relasi[0]['id'];
			$sql = "SELECT id FROM data_penelitian where judul='".$_POST['Relasi']['id_paper_1']."'";
			$dbCommand = Yii::app()->db->createCommand($sql);
			$id_paper_1 = $dbCommand->queryAll();
			
			$_POST['Relasi']['id_paper_1']=$id_paper_1[0]['id'];
			$sql = "SELECT id FROM data_penelitian where judul='".$_POST['Relasi']['id_paper_2']."'";
			$dbCommand = Yii::app()->db->createCommand($sql);
			$id_paper_2 = $dbCommand->queryAll();
			
			$_POST['Relasi']['id_paper_2']=$id_paper_2[0]['id'];
			$_POST['Relasi']['creater']=(int)Yii::app()->user->id;
			//var_dump($_POST['Relasi']);
			//var_dump($_POST['Relasi']);
			
			$model->attributes=$_POST['Relasi'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Relasi');
		//var_dump($dataProvider);
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Relasi('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Relasi']))
			{
			$model->attributes=$_GET['Relasi'];
			}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Relasi the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Relasi::model()->with('metadata_relasi')->findByPk($id);
		//CVarDumper::dump($model->data_penelitian->judul,10,true);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Relasi $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='relasi-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionLookup() {
		$term=$_GET['term'];
		if (isset($_GET['term'])) {
			 $users = MetadataRelasi::model()->findAll(array(
						'condition' => 'deskripsi LIKE :deskripsi',
						'params' => array(
							':deskripsi' => "%$term%",
						),
							));
			$return=array();
			$i=0;
			foreach ($users as $user) {
					$return[$i]=$user->deskripsi;
					$i++;
			}
		}
		echo CJSON::encode($return);
    }
	
	public function actionLookup2(){
		$term=$_GET['term'];
		if (isset($_GET['term'])) {
		$users = DataPenelitian::model()->findAll(array(
						'condition' => 'judul LIKE :judul',
						'params' => array(
							':judul' => "%$term%",
						),
		));
		$return = array();
		$i=0;
		foreach ($users as $user) {
				$return[$i] = $user->judul;
				$i++;
		}
		}
		echo CJSON::encode($return);
	}
}
