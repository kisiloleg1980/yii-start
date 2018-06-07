<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<h1>Registration Form</h1>

<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>

	<div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>