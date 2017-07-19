<?php

/**
 * This is the model class for table "patient_referral".
 *
 * The followings are the available columns in table 'patient_referral':
 * @property integer $id
 * @property string $patient_id
 * @property string $file_content
 * @property string $file_type
 * @property string $file_size
 * @property string $file_name
 * @property string $last_modified_user_id
 * @property string $last_modified_date
 * @property string $created_user_id
 * @property string $created_date
 *
 * The followings are the available model relations:
 * @property Patient $patient
 * @property User $lastModifiedUser
 * @property User $createdUser
 */
class PatientReferral extends CActiveRecord
{
    public $uploadedFile;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'patient_referral';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('uploadedFile', 'file', 'allowEmpty' => true, 'on' => 'self_register'),
            array('uploadedFile', 'file', 'allowEmpty' => true, 'on' => 'other_register'),
            array('uploadedFile', 'file', 'allowEmpty' => false, 'on' => 'referral'),
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
            'patient' => array(self::BELONGS_TO, 'Patient', 'patient_id'),
            'lastModifiedUser' => array(self::BELONGS_TO, 'User', 'last_modified_user_id'),
            'createdUser' => array(self::BELONGS_TO, 'User', 'created_user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'uploadedFile' => 'Referral'
        );
    }

    public function beforeSave()
    {
        if ($file = CUploadedFile::getInstance($this, 'uploadedFile')) {
            $this->file_size = $file->size;
            $this->file_name = $file->name;
            $this->file_content = file_get_contents($file->tempName);
            $this->file_type = $file->type;
        }
        return parent::beforeSave();
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PatientReferral the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
