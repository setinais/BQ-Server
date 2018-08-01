<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;

class Email implements Rule
{

    private $id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
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
        $user = User::find($this->id);

        if($user->email == $value)
            return true;
        return (count(User::where("email", $value)->get()) === 0 ? true : false);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Este e-mail ja existe!';
    }
}
