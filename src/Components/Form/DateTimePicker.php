<?php


namespace SmallRuralDog\Admin\Components\Form;


class DateTimePicker extends DatePicker
{
    protected $componentName = "DateTimePicker";

    protected $format = "yyyy-MM-dd HH:mm:ss";
    protected $valueFormat = "yyyy-MM-dd HH:mm:ss";

    static public function make($value = null, $type = "datetime")
    {
        $value = $value?$value:now()->toDateTimeString();

        return (new DateTimePicker($value))->type($type);
    }

}
