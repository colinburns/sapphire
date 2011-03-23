<?php
/**
 * TextareaField creates a multi-line text field,
 * allowing more data to be entered than a standard
 * text field. It creates the <textarea> tag in the
 * form HTML.
 * 
 * <b>Usage</b>
 * 
 * <code>
 * new TextareaField(
 *    $name = "description",
 *    $title = "Description",
 *    $rows = 8,
 *    $cols = 3,
 *    $value = "This is the default description"
 * );
 * </code>
 * 
 * @package forms
 * @subpackage fields-basic
 */
class TextareaField extends FormField {

	protected $rows, $cols;

	/**
	 * Create a new textarea field.
	 * 
	 * @param $name Field name
	 * @param $title Field title
	 * @param $rows The number of rows
	 * @param $cols The number of columns
	 * @param $value The current value
	 * @param $form The parent form.  Auto-set when the field is placed in a form.
	 */
	function __construct($name, $title = null, $rows = 5, $cols = 20, $value = "", $form = null) {
		$this->rows = $rows;
		$this->cols = $cols;
		parent::__construct($name, $title, $value, $form);
	}

	function Field($attributes = array()) {
		if(!$attributes) $attributes = array(
			'Rows' => $this->rows,
			'Cols' => $this->cols,
		);

		return $this->customise($attributes)->renderWith('TextareaField');
	}

	/**
	 * Performs a readonly transformation on this field. You should still be able
	 * to copy from this field, and it should still send when you submit
	 * the form it's attached to.
	 * The element shouldn't be both disabled and readonly at the same time.
	 */
	function performReadonlyTransformation() {
		$clone = clone $this;
		$clone->setReadonly(true);
		$clone->setDisabled(false);
		return $clone;
	}
	
	/**
	 * Performs a disabled transformation on this field. You shouldn't be able to
	 * copy from this field, and it should not send any data when you submit the 
	 * form it's attached to.
	 * The element shouldn't be both disabled and readonly at the same time.
	 */
	function performDisabledTransformation() {
		$clone = clone $this;
		$clone->setDisabled(true);
		$clone->setReadonly(false);
		return $clone;
	}

	function Type() {
		return parent::Type() . ($this->readonly ? ' readonly' : ''); 
	}
	
	/**
	 * Set the number of rows in the textarea
	 *
	 * @param int
	 */
	function setRows($rows) {
		$this->rows = $rows;
	}
	
	/**
	 * Set the number of columns in the textarea
	 *
	 * @return int
	 */
	function setColumns($cols) {
		$this->cols = $cols;
	}
}