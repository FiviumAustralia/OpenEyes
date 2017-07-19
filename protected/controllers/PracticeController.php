<?php

class PracticeController extends BaseController
{
    public $layout = '//layouts/main';

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                // allow users with either the TaskViewPractice or TaskCreatePractice roles to view Practice data
                'actions' => array('index', 'view'),
                'roles' => array('TaskViewPractice', 'TaskCreatePractice'),
            ),
            array(
                'allow',
                // allow users with either the TaskCreatePractice or TaskAddPatient roles to perform 'create' actions
                'actions' => array('create'),
                'roles' => array('TaskCreatePractice', 'TaskAddPatient'),
            ),
            array(
                'allow', // allow users with the TaskCreatePractice role to perform 'update' actions
                'actions' => array('update'),
                'roles' => array('TaskCreatePractice'),
            ),
            array(
                'deny',  // deny all other users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate($context = null)
    {
        $contact = new Contact();
        $address = new Address();
        $practice = new Practice();

        $this->performAjaxValidation($contact);

        if (isset($_POST['Contact'])) {
            $contact->attributes = $_POST['Contact'];
            $address->attributes = $_POST['Address'];
            $practice->attributes = $_POST['Practice'];
            list($contact, $practice, $address) = $this->performPracticeSave($contact, $practice, $address,
                $context === 'AJAX');
        }
        if ($context === 'AJAX') {
            echo CJSON::encode(array(
                'label' => $practice->getAddressLines()
            ,
                'value' => $practice->getPrimaryKey(),
            ));
        } else {
            $this->render('create', array(
                'model' => $practice,
                'address' => $address,
                'contact' => $contact,
            ));
        }
    }

    public function performPracticeSave(Contact $contact, Practice $practice, Address $address, $isAjax = false)
    {
        $transaction = Yii::app()->db->beginTransaction();
        try {

            if ($contact->save()) {
                $practice->contact_id = $contact->getPrimaryKey();
                $address->contact_id = $contact->id;
                if ($practice->save()) {
                    if (isset($address)) {
                        if ($address->save()) {
                            $transaction->commit();
                        } else {
                            $transaction->rollback();
                        }
                    } else {
                        $transaction->commit();
                    }
                    if (!$isAjax) {
                        $this->redirect(array('view', 'id' => $practice->id));
                    }
                } else {
                    $transaction->rollback();
                }
            } else {
                $transaction->rollback();
            }
        } catch (Exception $ex) {
            OELog::logException($ex);
            $transaction->rollback();
        }

        return array($contact, $practice, $address);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $contact = $model->contact;
        $address = isset($contact->address) ? $contact->address : new Address();

        $this->performAjaxValidation($contact);

        if (isset($_POST['Address']) || isset($_POST['Contact'])) {

            $contact->attributes = $_POST['Contact'];
            $address->attributes = $_POST['Address'];
            $model->attributes = $_POST['Practice'];
            list($contact, $model, $address) = $this->performPracticeSave($contact, $model, $address);
        }

        $this->render('update', array(
            'model' => $model,
            'address' => $address,
            'contact' => $contact,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Practice', array(
            'criteria' => array(
                'with' => array('contact'),
                'order' => 'last_name, first_name',
            ),
        ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Gp the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Practice::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param CModel $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'patient-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
