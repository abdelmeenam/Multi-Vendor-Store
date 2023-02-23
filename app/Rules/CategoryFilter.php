<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CategoryFilter implements Rule
{

    /**
     * @var $forbidden
     */
    protected $forbidden;


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($forbidden)
    {
        $this->forbidden = $forbidden;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (strtolower($value) == $this->forbidden)
        {
            return  false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'this name is forbidden';
    }
}
