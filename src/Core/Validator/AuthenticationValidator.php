<?php declare(strict_types=1);

namespace Stormannsgal\Core\Validator;

use Laminas\InputFilter\InputFilter;
use Stormannsgal\Core\Validator\Input\EmailInput;
use Stormannsgal\Core\Validator\Input\PasswordInput;

class AuthenticationValidator extends InputFilter
{
    public function __construct(
        readonly private EmailInput $emailInput,
        readonly private PasswordInput $passwordInput,
    ) {
        $this->add($this->emailInput);
        $this->add($this->passwordInput);
    }
}
