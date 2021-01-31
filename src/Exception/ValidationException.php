<?php


namespace App\Exception;

use Throwable;

/**
 * Class ValidationException
 * @package App\Exception
 */
final class ValidationException extends \RuntimeException
{
    private $errors;

    /**
     * ValidationException constructor.
     * @param string $message Message
     * @param array $errors Errors
     * @param int $code Code
     * @param Throwable|null $previous Previous
     */
    public function __construct(string $message = "", array $errors = [], int $code = 422, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
