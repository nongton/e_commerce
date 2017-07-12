<?php
namespace backend\controllers;

use Yii;
use app\Ui;

use yii\helpers\Url;
use yii\helpers\Html;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\web\Controller;

use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\data\Pagination;

use common\models\LoginForm;
use common\models\User;


/**
 * Product controller
 */
class UserController extends Controller
{
	public function actionAdd()
	{
		
		$request = \Yii::$app->request;
		$id = $request->get('id');
		
		if($id){
		$query = User::find();
		$query->andWhere(['id' => $id]);
		$model = $query->one();
		}else {
		$model = new User();
		}
		if (\Yii::$app->request->isPost)
		{
			$model->attributes = $_POST['User'];
			$model->position = $_POST['position'];
			$model->status = 10 ;
			if( ($_POST['password']) ){
				$model->setPassword($_POST['password']);
				$model->generateAuthKey();
			}
			
			if($model->save()){
				Ui::setMessage('บันทึกข้อมูลสำเร็จ','success');
				return $this->redirect(Url::toRoute('user/list'));
			}
			else {
				Ui::setMessage('การบันทึกข้อมูลผิดพลาด','danger');
			}
		}
			
		echo $this->render('add',['model' => $model]);
	}
	
	public function actionList()
	{	
		$query = User::find();
		
	
		if (\Yii::$app->request->isPost) {
			if ($_REQUEST['op'] == "delete") {
				$arrId = $_REQUEST['selectUser'];
				foreach ($arrId as $lst){
					$queryUser = User::find();
					$User = $queryUser->where(['id' => $lst])->one();
					$User->status = User::STATUS_DELETED ;
					
					if($User->save()){
						Ui::setMessage('ลบข้อมูลสำเร็จ','success');
					}
					else {
						Ui::setMessage('ลบข้อมูลผิดพลาด','danger');
					}
					
				}
			}
			
			if ($_REQUEST['op'] == "search") {
				$searchText = $_REQUEST['searchText'];
				switch ($_REQUEST['chooseType']){
						case "username":
							$query->andWhere(['LIKE' ,'username','%'.$searchText.'%', false]);
							break;
						case "firstName":
							$query->andWhere(['LIKE' ,'firstName','%'.$searchText.'%', false]);
							break;
						case "lastName":
							$query->andWhere(['LIKE' , 'lastName' , '%'.$searchText.'%', false]);
							break;
					}
					if (!empty($_REQUEST['type'])) {
						$query->andWhere('type=:type',[':type'=> $_REQUEST['type']]);
					}
			}
			
		}

		
		$pagination = new Pagination([
				'defaultPageSize' => 20,
				'totalCount' => $query->count(),
		]);
		
		
		$model = $query
		->orderBy('createTime DESC')
		->offset($pagination->offset)
		->limit($pagination->limit)
		->all();
		
		echo $this->render('list',['model' => $model , 'pagination'=>$pagination]);
	}
	
	public function actionProfile()
	{
		
		return $this->render('profile');
	}
	
	
	
	
}