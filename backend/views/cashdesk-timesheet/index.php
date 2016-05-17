<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
?>

<h2>Checking</h2>
    <form method="POST">
        <div class="row">
            <div class="col-lg-3">
                <div class="input-group">
                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <?php if (isset($_POST["datepicker"])) {
                      $date =  $_POST["datepicker"]; ?>
                       <?= "<input type="."text"." id="."datepicker"." title="."При выборе любой даты интервал + месяц"." name="."datepicker"." class="."form-control"." value="."$date"." />" ?>
                       <?php } else { ?>
                        <input type="text" id="datepicker" name="datepicker" title="При выборе любой даты интервал + месяц" class="form-control" value="2016-01-01" />
                   <?php } ?>
                        <span class="input-group-btn">
                            <input type="submit" id="submit" value="Download" class="btn btn-primary">
                        </span>
                </div>
            </div>
        </div>
        <hr />
    </form>
<?php if (isset($_POST["datepicker"])) : ?>




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


<hr/>

<?php  foreach ($wrong_timesheets as $value) :  ?>


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
<?php  else :
    echo "<p class=\"bg-info\" style=\"padding: 15px;\">Выберите дату</p>";
endif; ?>


