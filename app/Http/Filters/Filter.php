<?php

namespace App\Http\Filters;

abstract class Filter
{
    public function __construct(public array $filterData)
    {
        $this->validate($filterData);
    }

    /**
     * Apply filter query on related model.
     * @param  \Illuminate\Database\Eloquent\Builder &$query
     */
    abstract public function apply(&$query);

    /**
     * Get the validation rules that apply to the filter request.
     *
     * @return array
     */
    abstract public static function rules(): array;

    /**
     * Validate passed @param array $filterData according to filter rules
     */
    protected function validate($filterData): void
    {
        foreach ($filterData as $key => $value)
        {
            $this->validateIsKeyExists($key);
            $this->validateKey($key, $value);
        }
    }

    /**
     * Get the validation rules that apply to the filter request.
     *
     * @return array
     * @throws \BaraaDark\LaravelFilter\Exceptions\InvalidFilterKeyException
     */
    protected function validateKey($key, $value): bool
    {
        $validator = validator([$key => $value], [$key => static::rules()[$key]]);
        if ($validator->fails())
        {
            $this->failedValidation($validator);
        }
        return true;
    }

    /**
     * Validate is key exists in filter class rules keys.
     *
     * @throws \App\Exceptions\InvalidFilterKeyException
     */
    protected function validateIsKeyExists($filterKey): void
    {
        if(!key_exists($filterKey, static::rules()))
        {
            throw new \App\Exceptions\InvalidFilterKeyException($filterKey);
        }
    }

     /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $exception = $validator->getException();
        throw (new $exception($validator));
    }

    public function __get($key)
    {
        if (property_exists($this, $key))
        {
            return $this->$key;
        }

        $classPath = explode('\\',get_class($this));
        $className = $classPath[count($classPath) -1];

        return $this->filterData[$key] ?? throw new \App\Exceptions\InvalidModelFilterKeyException($key, $className);
    }
}
