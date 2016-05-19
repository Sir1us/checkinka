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
                <?php
                $date = Yii::$app->request->post('datepicker');

                if (isset($date) && !empty($date)) { ?>

                    <?= Html::input('raw', 'datepicker', $date, ['class'=> 'form-control', 'id' => 'datepicker', 'pattern' => '(^(((\d\d)(([02468][048])|([13579][26]))-02-29)|(((\d\d)(\d\d)))-((((0\d)|(1[0-2]))-((0\d)|(1\d)|(2[0-8])))|((((0[13578])|(1[02]))-31)|(((0[1,3-9])|(1[0-2]))-(29|30)))))$)']) ?>


                <?php } else { ?>

                    <input type="text" id="datepicker" name="datepicker"  class="form-control" value="2016-01-01" />
                <?php } ?>
                <span class="input-group-btn">
                            <input type="submit" id="submit" value="Загрузить" title="При выборе любой даты интервал + месяц" class="btn btn-primary">
                        </span>
            </div>
        </div>
    </div>
    <hr />
    <hr />

    <p class="bg-danger" style="padding: 15px;">Что вы делаете?</p>
</form>

