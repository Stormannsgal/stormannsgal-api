<?php declare(strict_types=1);

namespace Stormannsgal\Mock\Validator;

use Stormannsgal\Core\Validator\AuthenticationValidator;
use Stormannsgal\Core\Validator\Input\EmailInput;
use Stormannsgal\Core\Validator\Input\PasswordInput;

class MockAuthenticationValidator extends AuthenticationValidator
{
    public function __construct()
    {
        parent::__construct(new EmailInput(), new PasswordInput());
    }

    public function isValid($context = null)
    {
        return true;
    }
}
