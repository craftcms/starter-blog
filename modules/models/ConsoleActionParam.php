<?php

namespace modules\models;

use craft\base\Model;

class ConsoleActionParam extends Model
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var bool
     */
    public bool $required;

    /**
     * @var string
     */
    public string $type;

    /**
     * @var mixed
     */
    public $default;

    /**
     * @var string
     */
    public string $comment;

    /**
     * @var bool
     */
    public bool $deprecated;
}