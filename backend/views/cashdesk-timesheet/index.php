<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>


<h1 xmlns="http://www.w3.org/1999/html">Check</h1>
    <form method="POST">
        <div class="picker">
        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        <p><input type="text" id="datepicker" name="datepicker"><input type="submit" id="submit" value="Submit"></p>
        </div>
    </form>
<?php if (!empty($_POST["datepicker"])) {  ?>




    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>id</th>
            <th>cashier</th>
            <th>cashdesk</th>
            <th>opendt</th>
            <th>closedt</th>
        </tr>
        </thead>
        <tbody>
<?php foreach ($wrong_timesheets as $value): ?>
    <tr>
    <td><?= Html::tag('id', $value['id']) ?></td>

    <td><?= Html::tag('cashier', $value['cashier']) ?></td>

    <td><?= Html::tag('cashdesk', $value['cashdesk']) ?></td>

    <td><?= Html::tag('opendt', $value['opendt']) ?></td>

    <td><?= Html::tag('closedt', $value['closedt']) ?></td>
    </tr>
<?php endforeach; ?>
        </tbody>
    </table>
<?php } else {
    echo "choose date";

} ?>