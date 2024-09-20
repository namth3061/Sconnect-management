<?php

namespace App\View\Components\Form;

class DateTimePicker extends Field
{

    protected string $view = 'components.form.datetimepicker';
    protected bool $date = false;

    protected string $before_or_equal = '';
    protected string $before = '';
    protected string $after_or_equal = '';
    protected string $after = '';
    protected string $format = '';
    protected string $timeZone = '';
    protected string $locale = 'vi';
    protected $minDate = null;
    protected $maxDate = null;

    public function mount()
    {

    }

    // dateTimePicker
    public function format(string $typeFormat): static
    {
        $this->format = $typeFormat;
        $this->rule("date_format:{$typeFormat}");
        return $this;
    }

    public function date(bool $date = true): static
    {
        $this->date = $date;
        $this->rule("date");
        return $this;
    }

    public function beforeOrEqual(string $date): static
    {
        $this->before_or_equal = $date;
        $this->rule("before_or_equal:{$date}");
        return $this;
    }

    public function before(string $date): static
    {
        $this->before = $date;
        $this->rule("before:{$date}");
        return $this;
    }

    public function afterOrEqual(string $date): static
    {
        $this->after_or_equal = $date;
        $this->rule("after_or_equal:{$date}");
        return $this;
    }

    public function after(string $date): static
    {
        $this->after = $date;
        $this->rule("after:{$date}");
        return $this;
    }

    public function timeZone(string $timeZone): static
    {
        $this->timeZone = $timeZone;

        return $this;
    }

    public function locale(string $locale)
    {
        $this->locale = $locale;

        return $this;
    }

//    public function minDate($value = false)
//    {
//        $this->minDate = $value;
//
//        return $this;
//    }
//
//    public function maxDate($value = false)
//    {
//        $this->maxDate = $value;
//
//        return $this;
//    }
    // endDateTimePicker

}
