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
        <hr/>
    </form>
<?php if (isset($date) && !empty($date)) : ?>




    <table class="table table-striped table-bordered table-hover table-inverse">
        <thead>
        <tr>
            <th>Запись</th>
            <th>Кассир</th>
            <th>Касса</th>
            <th>Дата открытия кассы</th>
            <th>Дата закрытия кассы</th>
        </tr>
        </thead>
        <tbody>

            <?php
            $warningMsg = false;
            foreach ($wrong_timesheets as $key => $value) : ?>
                <?php foreach ($value['error'] as $errorvalue) : ?>

                    <?php  if($errorvalue == 'Нет данных') : ?>
                        <?php  if($warningMsg == false) : ?>
                            <?= '<tr><td colspan="5" style="background: #f2dede">'."$errorvalue".'</td></tr>';
                            $warningMsg = true;
                            ?>
                            <?php endif; ?>

                        <tr>
                            <td><?= Html::tag('p', $value['id'], ['class'=> 'marginForP']) ?></td>

                            <td><?= Html::tag('p', $value['cashier'], ['class'=> 'marginForP']) ?></td>

                            <td><?= Html::tag('p', $value['cashdesk'], ['class'=> 'marginForP']) ?></td>

                            <td><?= Html::tag('p', $value['opendt'], ['class'=> 'marginForP']) ?></td>

                            <td><?= Html::tag('p', $value['closedt'] ,['class'=> 'marginForP']) ?></td>
                        </tr>

                    <?php endif; ?>



                <?php endforeach; ?>
            <?php endforeach; ?>


            <?php
            $warningMsg = false;
            foreach ($wrong_timesheets as $key => $value) : ?>
                <?php foreach ($value['error'] as $errorvalue) : ?>


                    <?php  if($errorvalue == 'Ошибка в данных') : ?>

                        <?php  if($warningMsg == false) : ?>
                            <?= '<tr><td colspan="5" style="background: #f2dede">'."$errorvalue".'</td></tr>';
                            $warningMsg = true;
                            ?>
                        <?php endif; ?>



                        <tr>
                            <td><?= Html::tag('p', $value['id'], ['class'=> 'marginForP']) ?></td>

                            <td><?= Html::tag('p', $value['cashier'], ['class'=> 'marginForP']) ?></td>

                            <td><?= Html::tag('p', $value['cashdesk'], ['class'=> 'marginForP']) ?></td>

                            <td><?= Html::tag('p', $value['opendt'], ['class'=> 'marginForP']) ?></td>

                            <td><?= Html::tag('p', $value['closedt'] ,['class'=> 'marginForP']) ?></td>
                        </tr>
                    <?php endif; ?>


                <?php endforeach; ?>
            <?php endforeach; ?>

    <?php
    $warningMsg = false;
    foreach ($wrong_timesheets as $key => $value) : ?>
        <?php foreach ($value['error'] as $errorvalue) : ?>




            <?php if($errorvalue == 'Ошибка с датой закрытия') : ?>
                <?php  if($warningMsg == false) : ?>
                    <?= '<tr><td colspan="5" style="background: #f2dede">'."$errorvalue".'</td></tr>';
                    $warningMsg = true;
                    ?>
                <?php endif; ?>



                <tr>
                    <td><?= Html::tag('p', $value['id'], ['class'=> 'marginForP']) ?></td>

                    <td><?= Html::tag('p', $value['cashier'], ['class'=> 'marginForP']) ?></td>

                    <td><?= Html::tag('p', $value['cashdesk'], ['class'=> 'marginForP']) ?></td>

                    <td><?= Html::tag('p', $value['opendt'], ['class'=> 'marginForP']) ?></td>

                    <td><?= Html::tag('p', $value['closedt'] ,['class'=> 'marginForP']) ?></td>
                </tr>
            <?php endif; ?>


        <?php endforeach; ?>
    <?php endforeach; ?>
        </tbody>
    </table>
<?php  else :
    echo "<p class=\"bg-info\" style=\"padding: 15px;\">Выберите дату</p>";
endif; ?>



