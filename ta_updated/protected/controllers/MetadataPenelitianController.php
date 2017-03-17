<?php

class MetadataPenelitianController extends Controller
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
				'actions'=>array('index','view','getData','changeDropDown','saveData'),
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
		$model=new MetadataPenelitian;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MetadataPenelitian']))
		{
			$model->attributes=$_POST['MetadataPenelitian'];
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

		if(isset($_POST['MetadataPenelitian']))
		{
			$model->attributes=$_POST['MetadataPenelitian'];
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
		$dataProvider=new CActiveDataProvider('MetadataPenelitian');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MetadataPenelitian('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MetadataPenelitian']))
			$model->attributes=$_GET['MetadataPenelitian'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MetadataPenelitian the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=MetadataPenelitian::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MetadataPenelitian $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='metadata-penelitian-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionGetData()
	{
		$parameter = $_POST['parameter'];
		$edge = $_POST['edge'];
		
		Yii::app()->session['Edge'] = $edge;
		Yii::app()->session['sbX'] = $_POST['sumbuX'];
		Yii::app()->session['sbY'] = $_POST['sumbuY'];
		
		//ambil col_name dari sumbu X
		$sql = "SELECT col_name FROM metadata_penelitian WHERE deskripsi = '" . $_POST['sumbuX'] . "'";
		$dbCommand = Yii::app()->db->createCommand($sql);
		$sumbuX = $dbCommand->queryAll();
		$sumbuX=$sumbuX[0]['col_name'];
			
		//ambil col_name dari sumbu Y
		$sql = "SELECT col_name FROM metadata_penelitian WHERE deskripsi = '" . $_POST['sumbuY'] . "'";
		$dbCommand = Yii::app()->db->createCommand($sql);
		$sumbuY = $dbCommand->queryAll();
		$sumbuY=$sumbuY[0]['col_name'];
		
		//ambil seluruh data
		if($parameter=='all')
		{
			$sql = "SELECT id, judul, peneliti FROM data_penelitian";
			$dbCommand = Yii::app()->db->createCommand($sql);
			$AllData[0] = $dbCommand->queryAll();
			
			$AllData[1] = "";
		}
		else
		{			
			Yii::app()->session['IdPaper'] = $parameter;
			$sql = "SELECT id, judul, peneliti FROM data_penelitian WHERE id in (".$parameter.")";
			$dbCommand = Yii::app()->db->createCommand($sql);
			$AllData[0] = $dbCommand->queryAll();
			
			$sql = "SELECT id, judul, peneliti FROM data_penelitian WHERE id not in (".$parameter.")";
			$dbCommand = Yii::app()->db->createCommand($sql);
			$AllData[1] = $dbCommand->queryAll();
		}
		
		// Mengambil id relasi
		$sql = "SELECT id FROM metadata_relasi WHERE deskripsi = '" . $edge . "'";
		$dbCommand = Yii::app()->db->createCommand($sql);
		$idEdge = $dbCommand->queryAll();
		$idEdge=$idEdge[0]['id'];
		
		// Mencari data paper terkait sesuai dengan id relasi di atas
		$sql = "SELECT id_paper_1, id_paper_2 FROM relasi WHERE id_relasi = '" . $idEdge . "'";
		$dbCommand = Yii::app()->db->createCommand($sql);
		$edgeData = $dbCommand->queryAll();
		
		//$edgeData=$idEdge[0]['id'];
		//$AllData=$sumbuY[0]['col_name'];

		// Ambil data penelitiannya
		// Parameter merupakan id dari paper yang dipilih oleh pengguna
		if($parameter == 'all')
		{
			$sql = "SELECT id,".$sumbuX.",".$sumbuY.", keyword FROM data_penelitian";
			$dbCommand = Yii::app()->db->createCommand($sql);
			$data = $dbCommand->queryAll();
			
			// Ambil data penelitian tanpa id
			$sql = "SELECT ".$sumbuX.",".$sumbuY.",keyword FROM data_penelitian";
			$dbCommand = Yii::app()->db->createCommand($sql);
			$data2 = $dbCommand->queryAll();
		}
		else
		{
			$sql = "SELECT id,".$sumbuX.",".$sumbuY.",keyword FROM data_penelitian where id in (".$parameter.")";
			$dbCommand = Yii::app()->db->createCommand($sql);
			$data = $dbCommand->queryAll();
			
			// Ambil data penelitian tanpa id
			$sql = "SELECT ".$sumbuX.",".$sumbuY.",keyword FROM data_penelitian where id in (".$parameter.")";
			$dbCommand = Yii::app()->db->createCommand($sql);
			$data2 = $dbCommand->queryAll();

		}
		
		// Set r = 0 pada data2
		
		/*
		foreach ($data2 as &$value) {						
			$value['r']=0;
		}*/
		
		$tmp = array ();
		$tmp2 = array ();
		
		// Buat data penelitian yang sudah diambil menjadi unik --> masukkan ke tmp
		foreach ($data2 as $row) 
			if (!in_array($row,$tmp)) array_push($tmp,$row);
		
		// Set r pada tmp = 0

		/*
		foreach ($tmp as &$value) {						
			$value['r']=0;
		}*/
		
		// Set id pada tmp dengan array
		foreach ($tmp as &$value) {						
			$value['id']=array();
			$value['keyword']=array();
		}
		
		// Masukkan id dan r pada tmp sesuai data sebenarnya (data)
		for ($i = 0; $i < count($tmp); $i++) {
			for ($j = 0; $j < count($data); $j++) {				
				if(($tmp[$i][''.$sumbuX.''] == $data[$j][''.$sumbuX.'']) && ($tmp[$i][''.$sumbuY.''] == $data[$j][''.$sumbuY.'']))
				{
					//$tmp[$i]['r']+=1;
					array_push($tmp[$i]['id'], $data[$j]['id']);
					array_push($tmp[$i]['keyword'], $data[$j]['keyword']);
				}				
			}
		}
		
		foreach ($tmp as $row) 
			if (!in_array($row, $tmp2)) array_push($tmp2, $row);
		
		
		// Ganti nama sumbu menjadi 'sumbu x'
		for ($i = 0; $i < count($tmp2); $i++) {
			$tmp2[$i]['sumbu_x'] = $tmp2[$i][''.$sumbuX.''];
			unset($tmp2[$i][''.$sumbuX.'']);
			$tmp2[$i]['sumbu_y'] = $tmp2[$i][''.$sumbuY.''];
			unset($tmp2[$i][''.$sumbuY.'']);
		}
		
		// Array untuk menyimpan child dan parent
		$tmp3 = array();
		for ($i = 0; $i < count($tmp2); $i++) {
			if(count($tmp2[$i]['id']) > 1) {
				for ($j = 0; $j < count($tmp2[$i]['id']); $j++) {
					$sql = "SELECT * FROM data_penelitian WHERE id=" .$tmp2[$i]['id'][$j];
					$dbCommand = Yii::app()->db->createCommand($sql);
					$tmp3 = $dbCommand->queryAll();

					$tmp2[$i]['children'][$j] = $tmp3[0];

					// for ($z = 0; $z < count($tmp2[$i]['id']); $z++) {

					// }
				}
			}
			else {
				$sql = "SELECT * FROM data_penelitian WHERE id=" .$tmp2[$i]['id'][0];
				$dbCommand = Yii::app()->db->createCommand($sql);
				$tmp3 = $dbCommand->queryAll();

				$tmp2[$i]['children'][0] = $tmp3[0];
			}
		}

		// Masukkan algoritma pengelompokkan data di sini
		for ($i = 0; $i < count($tmp2); $i++) {
			if(count($tmp2[$i]['children']) == 1) {
				$tmp2[$i]['size'] = [1];
			} else if(count($tmp2[$i]['children']) == 2) {
				$tmp2[$i]['size'] = [1, 1];
			} else if(count($tmp2[$i]['children']) == 3) {
				$tmp2[$i]['size'] = [1, 2];
			} else if(count($tmp2[$i]['children']) == 4) {
				$tmp2[$i]['size'] = [1, 1, 1, 1];
			} else if(count($tmp2[$i]['children']) == 5) {
				$tmp2[$i]['size'] = [3, 1, 1];
			} else if(count($tmp2[$i]['children']) == 6) {
				$tmp2[$i]['size'] = [1, 4, 1];
			} else if(count($tmp2[$i]['children']) == 7) {
				$tmp2[$i]['size'] = [1, 1, 1, 1, 1, 1, 1];
			} else if(count($tmp2[$i]['children']) == 8) {
				$tmp2[$i]['size'] = [3, 1, 1];
			} else if(count($tmp2[$i]['children']) > 8) {
				$tmp2[$i]['size'] = [intval(floor((count($tmp2[$i]['children']) / 8))), intval(floor((count($tmp2[$i]['children']) / 8))), intval(floor((count($tmp2[$i]['children']) / 8))), intval(floor((count($tmp2[$i]['children']) / 8))), intval(floor((count($tmp2[$i]['children']) / 8))), intval(floor((count($tmp2[$i]['children']) / 8))), intval(floor((count($tmp2[$i]['children']) / 8))), (count($tmp2[$i]['children']) % 8)];
			}
		}
		
		$data3 = array();
		
		// Untuk membuat citation
		$data3['nodes'] = $tmp2;
		$data3['links'] = array();
		
		for ($i = 0; $i < count($edgeData); $i++) {
		/*
			if($tmp2[$i]['citation']!=null)
			{
				for($j=0; $j < count($tmp2); $j++)
				{
					for($k=0; $k < count($tmp2[$j]['id']); $k++)
					{
						if($tmp2[$i]['citation']==$tmp2[$j]['id'][$k])
						{	*/						
							$data3['links'][$i]['source'] = $edgeData[$i]['id_paper_1'];
							$data3['links'][$i]['target'] = $edgeData[$i]['id_paper_2'];
							$data3['links'][$i]['value'] = 1;
							/*break;
						}						
					}					
				}
				$data3['links'][0]['target']=$i;
			}*/
		}
		//echo CJSON::encode($data3);
		
		$sql = "SELECT deskripsi,keterangan FROM metadata_relasi";
		$dbCommand = Yii::app()->db->createCommand($sql);
		$relation = $dbCommand->queryAll();
		
		$result = array(
			'data3' => $data3,
			'all_data' => $AllData,
			'parameter' => $data,
			'relation' => $relation
		);
		
		$parameter = "";
		file_put_contents("data3.json", CJSON::encode($data3));
		echo CJSON::encode($result);
		//$result=$edgeData;
	}

	public function actionChangeDropDown()
	{
		//$data=MetadataPenelitian::model()->findAll('deskripsi=:deskripsi', 
          //        array(':deskripsi'=>$_POST['sumbuY']));
		if(isset($_POST['sumbuX']))
		{
			$sql = "SELECT deskripsi FROM metadata_penelitian WHERE deskripsi = '" . $_POST['sumbuX'] . "'";
			$dbCommand = Yii::app()->db->createCommand($sql);
			$sumbuDiUbah = $dbCommand->queryAll();
		}
		else
		{
			$sql = "SELECT deskripsi FROM metadata_penelitian WHERE deskripsi = '" . $_POST['sumbuY'] . "'";
			$dbCommand = Yii::app()->db->createCommand($sql);
			$sumbuDiUbah = $dbCommand->queryAll();
		}
		
		$sql = "SELECT deskripsi FROM metadata_penelitian where flag=1";
		$dbCommand = Yii::app()->db->createCommand($sql);
		$sumbuPilihanDiUbah = $dbCommand->queryAll();
		
		$key = array_search('\"deskripsi\":\"'.$sumbuDiUbah[0]['deskripsi'].'\"',$sumbuPilihanDiUbah);
		foreach ($sumbuPilihanDiUbah as $key=>$value) {						
			if ($value['deskripsi']==$sumbuDiUbah[0]['deskripsi']){
				//unset($value['deskripsi']);
				unset($sumbuPilihanDiUbah[$key]['deskripsi']);
				unset($sumbuPilihanDiUbah[$key]);
				$sumbuPilihanDiUbah = array_values($sumbuPilihanDiUbah);
				//unset($sumbuY[$key]);
			}
		}
		
		$sumbuPilihanDiUbah=CHtml::listData($sumbuPilihanDiUbah,'deskripsi','deskripsi');
		
		foreach($sumbuPilihanDiUbah as $key=>$value)
		{
			if(isset($_POST['sumbuYselected']))
			{
				if($value==$_POST['sumbuYselected'])
				{
				echo CHtml::tag('option',
						   array('value'=>$key,'selected'=>'selected'),CHtml::encode($value),true);
				}
				else
				{	
				echo CHtml::tag('option',
						   array('value'=>$key),CHtml::encode($value),true);								 
				}
			}
			else
			{
				if($value==$_POST['sumbuXselected'])
				{
				echo CHtml::tag('option',
						   array('value'=>$key,'selected'=>'selected'),CHtml::encode($value),true);
				}
				else
				{	
				echo CHtml::tag('option',
						   array('value'=>$key),CHtml::encode($value),true);								 
				}
			}
		}
	}
	public function actionSaveData()
	{
		$userID = $_POST['userID'];
		$paperID = $_POST['paperID'];
		$sumbuX = $_POST['sumbuX'];
		$sumbuY = $_POST['sumbuY'];
		$relation = $_POST['relation'];
		$map_name = $_POST['map_name'];

		$sql = "insert into saved_map (id_user, id_paper, parameter_x, parameter_y, parameter_relation, map_name) values (:id_user, :id_paper, :parameter_x, :parameter_y, :parameter_relation, :map_name)";
		$parameters = array(":id_user"=>$userID, ':id_paper' => $paperID, ':parameter_x' => $sumbuX, ':parameter_y' => $sumbuY, ':parameter_relation' => $relation, ':map_name' => $map_name);
		$dbCommand = Yii::app()->db->createCommand($sql)->execute($parameters);
		echo $dbCommand;
	}
}