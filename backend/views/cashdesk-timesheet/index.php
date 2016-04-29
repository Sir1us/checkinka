<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
use kartik\date\DatePicker;
?>
<h1>Check</h1>


    <table class="table table-striped table-bordered">

       <p><?php
           $layout3 = <<< HTML
    <span class="input-group-addon">From Date</span>
    {input1}
    <span class="input-group-addon">aft</span>
    {separator}
    <span class="input-group-addon">To Date</span>
    {input2}
    <span class="input-group-addon kv-date-remove">
        <i class="glyphicon glyphicon-remove"></i>
    </span>
HTML;

           echo DatePicker::widget([
               'type' => DatePicker::TYPE_RANGE,
               'name' => 'dp_addon_3a',
               'value' => '01-Jul-2015',
               'name2' => 'dp_addon_3b',
               'value2' => '18-Jul-2015',
               'separator' => '<i class="glyphicon glyphicon-resize-horizontal"></i>',
               'layout' => $layout3,
               'pluginOptions' => [
                   'autoclose' => true,
                   'format' => 'dd-M-yyyy'
               ]
           ]);







           /*echo '<label class="control-label">Birth Date</label>';
           echo DatePicker::widget([
               'name' => 'dp_2',
               'type' => DatePicker::TYPE_COMPONENT_PREPEND,
               'value' => '01-01-2016',
               'pluginOptions' => [
                   'autoclose'=>true,
                   'format' => 'dd-M-yyyy'
               ]
           ]);*/



           ?></p>
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
<?php foreach ($cashdesk as $value): ?>
    <tr>
    <td><?= Html::tag('id', $value['id']) ?></th>

    <td><?= Html::tag('id', $value['cashier']) ?></th>

    <td><?= Html::tag('id', $value['cashdesk']) ?></th>

    <td><?= Html::tag('id', $value['opendt']) ?></th>

    <td><?= Html::tag('id', $value['closedt']) ?></th>
    </tr>
<?php endforeach; ?>
        </tbody>
    </table>


<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>id</th>
        <th>cashdesk</th>
        <th>dt</th>
        <th>cs_action</th>
        <th>cashier</th>
    </tr>
    </thead>
    <tbody>

<?php foreach ($cashdeskActions as $values): ?>
    <tr>
        <td><?= Html::tag('id', $values['id']) ?></th>

        <td><?= Html::tag('id', $values['cashdesk']) ?></th>

        <td><?= Html::tag('id', $values['dt']) ?></th>

        <td><?= Html::tag('id', $values['cs_action']) ?></th>

        <td><?= Html::tag('id', $values['cashier']) ?></th>
    </tr>
<?php endforeach; ?>
        </tbody>
        </table>
