<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
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

<div class ="forum-main">
    <div id="oldMessage">
    </div>
    <input type="button" id="newMessage" value="Write a message">

    <form id = "myForm" class="hidden">
        <label for = "author"> Login </label>
        <input type="text" id="author" required>
        <br>
        <label for = "text">Message</label>
        <br>
        <textarea id="text" rows="10" required></textarea>
        <br>
        <button type="submit" id = "addMessage">Add a message</button>
    </form>
</div>

