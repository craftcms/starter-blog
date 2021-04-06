<?php

namespace modules\models;

use craft\base\Model;

class ConsoleCommand extends Model
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $description;

    /**
     * @var bool
     */
    public bool $deprecated;

    /**
     * @var ConsoleAction[]
     */
    public array $actions;
}