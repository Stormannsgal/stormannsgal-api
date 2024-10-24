<?php declare(strict_types=1);

namespace Stormannsgal\Core\Validator;

use Laminas\InputFilter\InputFilter;
use Stormannsgal\Core\Validator\Input\PasswordInput;

class UserPasswordChangeValidator extends InputFilter
{
    public function __construct(
        private readonly PasswordInput $passwordInput,
    ) {
        $this->add($this->passwordInput);
    }
}
