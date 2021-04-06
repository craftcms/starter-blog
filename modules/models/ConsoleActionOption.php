<?php

namespace modules\models;

use craft\base\Model;

class ConsoleActionOption extends Model
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $type;

    /**
     * @var mixed
     */
    public $default;

    /**
     * @var bool
     */
    public bool $required;

    /**
     * @var bool
     */
    public bool $deprecated;

    /**
     * @var string
     */
    public string $comment;

    /**
     * @var array
     */
    public array $aliases = [];

}