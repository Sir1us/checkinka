<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;




?>


<h1>Check</h1>
    <form method="POST">
        <div class="row">
            <div class="col-lg-3">
                <div class="input-group">
                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <!--Хороший варинт выбора дат по году и месяцу
                    <input type="text" class="datepicker-here form-control" data-min-view="months" data-view="months" data-date-format="MM yyyy" />-->
                        <input type="text" id="datepicker" name="datepicker" class="form-control" />
                    <span class="input-group-btn">
                        <input type="submit" id="submit" value="Submit" class="btn btn-default">

                </span>

                </div>
            </div>
        </div>
        <hr />
    </form>
<?php if (isset($_POST["datepicker"])) {  ?>




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
    echo "<p class=\"bg-success\" style=\"padding: 15px;\">Choose Date</p>";

} ?>