<?php

class GpController extends BaseController
{
    public $layout = '//layouts/main';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
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
            array(
                'allow',  // allow users with either the TaskViewGp or TaskCreateGp roles to view GP data
                'actions' => array('index', 'view'),
                'roles' => array('TaskViewGp', 'TaskCreateGp')
            ),
            array(
                'allow', // allow users with either the TaskCreateGp or TaskAddPatient roles to perform 'create' actions
                'actions' => array('create'),
                'roles' => array('TaskCreateGp', 'TaskAddPatient'),
            ),
            array(
                'allow', // allow users with the TaskCreateGp role to perform 'update' actions
                'actions' => array('update'),
                'roles' => array('TaskCreateGp'),
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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param $context string The context through which create action is invoked. Is either 'AJAX' or null.
     */
    public function actionCreate($context = null)
    {
        $gp = new Gp();
        $contact = new Contact();
        $this->performAjaxValidation($contact);

        if (isset($_POST['Contact'])) {
            $contact->attributes = $_POST['Contact'];

            list($contact, $gp) = $this->performGpSave($contact, $gp, $context === 'AJAX');
        }

        if ($context === 'AJAX') {
            echo CJSON::encode(array(
                'label' => $contact->getFullName(),
                'value' => $gp->getPrimaryKey(),
            ));
        } else {
            $this->render('create', array(
                'model' => $contact,
            ));
        }
    }

    public function performGpSave(Contact $contact, Gp $gp, $isAjax = false)
    {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            if ($contact->save()) {
                // No need to re-set these values if they already exist.
                if ($gp->contact_id === null) {
                    $gp->contact_id = $contact->getPrimaryKey();
                }

                if ($gp->nat_id === null) {
                    $gp->nat_id = 0;
                }

                if ($gp->obj_prof === null) {
                    $gp->obj_prof = 0;
                }

                if ($gp->save()) {
                    $transaction->commit();
                    if (!$isAjax) {
                        $this->redirect(array('view', 'id' => $gp->id));
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

        return array($contact, $gp);
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

        $this->performAjaxValidation($contact);

        if (isset($_POST['Contact'])) {
            $contact->attributes = $_POST['Contact'];

            list($contact, $model) = $this->performGpSave($contact, $model);
        }

        $this->render('update', array(
            'model' => $contact,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Gp', array(
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
        $model = Gp::model()->findByPk($id);
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
