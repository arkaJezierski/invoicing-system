<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait ValidatesModel
{
    /**
     * Validation rules (in model)
     * @var array
     */
    protected array $modelRules = [];

    /**
     * Booting trait and adding validation to model
     */
    public static function bootValidatesModel(): void
    {
        static::saving(function ($model) {
            $model->validate();
        });
    }

    /**
     * Validate data with $modelRules
     */
    public function validate(): void
    {
        if (empty($this->modelRules)) {
            return;
        }

        $validator = Validator::make($this->attributesToArray(), $this->modelRules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * Getter for validation rules
     */
    public function getModelRules(): array
    {
        return $this->modelRules;
    }

    /**
     * Setter for validation rules
     */
    public function setModelRules(array $rules): void
    {
        $this->modelRules = $rules;
    }
}
