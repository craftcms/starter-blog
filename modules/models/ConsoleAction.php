<?php

namespace modules\models;

use craft\base\Model;

class ConsoleAction extends Model
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $summary;

    /**
     * @var string
     */
    public string $description;

    /**
     * @var string
     */
    public string $comment;

    /**
     * @var bool
     */
    public bool $isDefault;

    /**
     * @var bool
     */
    public bool $deprecated;

    /**
     * @var array
     */
    public array $args = [];

    /**
     * @var array
     */
    public array $options = [];
}