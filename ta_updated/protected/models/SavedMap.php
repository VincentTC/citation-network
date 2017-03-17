<?php

/**
 * This is the model class for table "saved_map".
 *
 * The followings are the available columns in table 'saved_map':
 * @property integer $id_user
 * @property integer $id_paper
 * @property string $parameter_x
 * @property string $parameter_Y
 * @property string $parameter_relation
 * @property string $map_name
 */
class SavedMap extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'saved_map';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_paper, parameter_x, parameter_Y, parameter_relation, map_name', 'required'),
			array('id_user, id_paper', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user, id_paper, parameter_x, parameter_Y, parameter_relation, map_name', 'safe', 'on'=>'search'),
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
			'id_user' => 'Id User',
			'id_paper' => 'Id Paper',
			'parameter_x' => 'Parameter X',
			'parameter_Y' => 'Parameter Y',
			'parameter_relation' => 'Parameter Relation',
			'map_name' => 'Map Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_paper',$this->id_paper);
		$criteria->compare('parameter_x',$this->parameter_x,true);
		$criteria->compare('parameter_Y',$this->parameter_Y,true);
		$criteria->compare('parameter_relation',$this->parameter_relation,true);
		$criteria->compare('map_name',$this->map_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SavedMap the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
