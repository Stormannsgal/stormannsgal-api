<?php declare(strict_types=1);

namespace Stormannsgal\Core\Validator;

use Laminas\InputFilter\InputFilter;
use Stormannsgal\Core\Validator\Input\EmailInput;

class PasswordForgottenEmailValidator extends InputFilter
{
    public function __construct(
        private readonly EmailInput $emailInput,
    ) {
        $this->add($this->emailInput);
    }
}
