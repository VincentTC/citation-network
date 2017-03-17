<?php

/**
 * This is the model class for table "data_penelitian".
 *
 * The followings are the available columns in table 'data_penelitian':
 * @property string $judul
 * @property integer $tahun_publikasi
 * @property string $tempat_diterbitkan
 * @property integer $jumlah_data
 * @property string $sumber_data
 * @property string $nama_metode
 * @property string $pendekatan_metode
 * @property string $deskripsi_metode
 * @property integer $akurasi
 * @property string $metode_evaluasi
 * @property string $skenario_evaluasi
 * @property string $kategori_hasil
 * @property string $nama_masalah
 */
class DataPenelitian extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'data_penelitian';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('judul, tahun_publikasi, tempat_diterbitkan, jumlah_data, sumber_data, nama_metode, pendekatan_metode, deskripsi_metode, akurasi, metode_evaluasi, skenario_evaluasi, kategori_hasil, nama_masalah', 'required'),
			array('tahun_publikasi, jumlah_data, akurasi', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('judul, tahun_publikasi, tempat_diterbitkan, jumlah_data, sumber_data, nama_metode, pendekatan_metode, deskripsi_metode, akurasi, metode_evaluasi, skenario_evaluasi, kategori_hasil, nama_masalah', 'safe', 'on'=>'search'),
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
			'judul' => 'Judul',
			'tahun_publikasi' => 'Tahun Publikasi',
			'tempat_diterbitkan' => 'Tempat Diterbitkan',
			'jumlah_data' => 'Jumlah Data',
			'sumber_data' => 'Sumber Data',
			'nama_metode' => 'Nama Metode',
			'pendekatan_metode' => 'Pendekatan Metode',
			'deskripsi_metode' => 'Deskripsi Metode',
			'akurasi' => 'Akurasi',
			'metode_evaluasi' => 'Metode Evaluasi',
			'skenario_evaluasi' => 'Skenario Evaluasi',
			'kategori_hasil' => 'Kategori Hasil',
			'nama_masalah' => 'Nama Masalah',
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

		$criteria->compare('judul',$this->judul,true);
		$criteria->compare('tahun_publikasi',$this->tahun_publikasi);
		$criteria->compare('tempat_diterbitkan',$this->tempat_diterbitkan,true);
		$criteria->compare('jumlah_data',$this->jumlah_data);
		$criteria->compare('sumber_data',$this->sumber_data,true);
		$criteria->compare('nama_metode',$this->nama_metode,true);
		$criteria->compare('pendekatan_metode',$this->pendekatan_metode,true);
		$criteria->compare('deskripsi_metode',$this->deskripsi_metode,true);
		$criteria->compare('akurasi',$this->akurasi);
		$criteria->compare('metode_evaluasi',$this->metode_evaluasi,true);
		$criteria->compare('skenario_evaluasi',$this->skenario_evaluasi,true);
		$criteria->compare('kategori_hasil',$this->kategori_hasil,true);
		$criteria->compare('nama_masalah',$this->nama_masalah,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DataPenelitian the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
