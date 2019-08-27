<?php

namespace app\controllers;

use Yii; 
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\Job;
use app\models\Category;

class JobController extends \yii\web\Controller{


/**
     * Access Control
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'edit', 'delete', 'details'],
                'rules' => [
                    [
                        'actions' => ['create', 'edit', 'delete', 'details'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
             
        ];
    }

    public function actionIndex($category = 0) {
       
        // Create Query
    $query = Job::find();

    $pagination = new Pagination([
                  'defaultPageSize' => 8,
                  'totalCount'       => $query->count() 
    ]);

     if (!empty($category)) {
        $jobs = $query->orderBy('create_date DESC')
                        ->offset($pagination->offset)
                        ->limit($pagination->limit)
                        ->where(['category_id' => $category])
                        ->all();
     } else {
         $jobs = $query->orderBy('create_date DESC')
                        ->offset($pagination->offset)
                        ->limit($pagination->limit)
                        ->all();
     }
     


    


        return $this->render('index' ,[
                  'jobs' => $jobs,
                  'pagination' => $pagination
        ]);
    }

 public function actionDetails($id) {
     $job = Job::find()
                ->where(['id' => $id ])
                ->one();


        return $this->render('details', ['job' => $job] );
    }

    public function actionCreate() {

       $job = new Job();

    if ($job->load(Yii::$app->request->post())) {
        if ($job->validate()) {
            // Save to DB
            $job->save();
            //Show Msessage
            yii::$app->getSession()->setFlash('success' , 'Job added successfully');
            return $this->redirect('index.php?r=job');
}
    }

    return $this->render('create', ['job' => $job]);
    }

   public function actionEdit($id) {
       $job = Job::findOne($id);


       // Check for owner
       if (yii::$app->user->identity->id != $job->user_id) {
        return $this->redirect('index.php?r=job');
       }

    if ($job->load(Yii::$app->request->post())) {
        if ($job->validate()) {
            // Save to DB
            $job->save();
            //Show Msessage
            yii::$app->getSession()->setFlash('success' , 'Job Updated successfully');
            return $this->redirect('index.php?r=job');
}
    }

    return $this->render('edit', ['job' => $job]);
    }



    public function actionDelete($id) {
      // Delete Job
        $job = Job::findOne($id);

        // Check for owner
       if (yii::$app->user->identity->id != $job->user_id) {
        return $this->redirect('index.php?r=job');
       }


        $job->delete();
        //Show Msessage
            yii::$app->getSession()->setFlash('success' , 'Job Delete successfully');
            return $this->redirect('index.php?r=job');

    }

   

    

}
