<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\ChatUser;

/* @var $this yii\web\View */
/* @var @comments json old comments*/
/* @var $model common\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'project_id',
            'executor_id',
            'completed_id',
            'updater_id',
            'created_at',
            'updated_at',
            'status',
            'deadline'
        ],
    ]) ?>

</div>

<?= common\modules\chat\widgets\WidgetChat::widget(//['port' => Yii::$app->params['chat.port']],
   // ['comments' => ChatUser::getTasks($model['id'])]
); ?>

<script>
    let oldComments = '<?=$comments?>';
    //console.log(oldComments);
</script>
