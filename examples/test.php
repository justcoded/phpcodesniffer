<?php

class Model {
	public $a;
}

function foo($model) {
	/* @var Model $model */
	$model->a = 111;
}

$b = new Model();
foo($b);
