<?php
declare(strict_types=1);

class ComplexNumber
{
    private const PERMITTED_INDEXES = [-1, 1];
    private const INDEX_ERROR_MESSAGE = 'Index is not permitted. Available indexes are %s';
    private const DIVISION_BY_0_IS_NOT_PERMITTED = "Division by 0 is not permitted";
    private $real;
    private $imaginary;

    public function __construct(float $real, float $imaginary)
    {
        $this->real = $real;
        $this->imaginary = $imaginary;
    }

    /**
     * @param ComplexNumber $complexNumber
     * @return $this
     */
    public function add(ComplexNumber $complexNumber): self
    {
        return $this->increase($complexNumber);
    }

    /**
     * @param ComplexNumber $complexNumber
     * @return $this
     */
    public function subtract(ComplexNumber $complexNumber): self
    {
        return $this->increase($complexNumber, -1);
    }

    /**
     * @param ComplexNumber $complexNumber
     * @param int $index
     * @return $this
     */
    private function increase(ComplexNumber $complexNumber, int $index = 1): self
    {
        $this->checkIndex($index);
        $this->real = $this->real + $index * $complexNumber->getReal();
        $this->imaginary = $this->imaginary + $index * $complexNumber->getImaginary();
        return $this;
    }

    /**
     * @param int $index
     * @return $this
     */
    private function checkIndex(int $index = 1): self
    {
        if (!in_array($index, self::PERMITTED_INDEXES)) {
            throw new ArithmeticError(sprintf(
                    self::INDEX_ERROR_MESSAGE,
                    implode(', ', self::PERMITTED_INDEXES)
                )
            );
        }
        return $this;
    }

    /**
     * @param ComplexNumber $complexNumber
     * @return $this
     */
    public function multiply(ComplexNumber $complexNumber): self
    {
        return $this->time($complexNumber);
    }

    /**
     * @param ComplexNumber $complexNumber
     * @return $this
     */
    public function divide(ComplexNumber $complexNumber): self
    {
        $divider = $complexNumber->getReal() ** 2 + $complexNumber->getImaginary() ** 2;
        if (!$divider) {
            throw new DivisionByZeroError(self::DIVISION_BY_0_IS_NOT_PERMITTED);
        }
        $this->time($complexNumber, -1);
        $this->real /= $complexNumber->getReal() ** 2 + $complexNumber->getImaginary() ** 2;
        $this->imaginary /= $complexNumber->getReal() ** 2 + $complexNumber->getImaginary() ** 2;
        return $this;
    }

    private function time(ComplexNumber $complexNumber, int $index = 1): self
    {
        $this->checkIndex($index);
        $real = $this->real;
        $this->real = $this->real * $complexNumber->getReal() - $index * $this->imaginary * $complexNumber->getImaginary();
        $this->imaginary = $this->imaginary * $complexNumber->getReal() + $index * $real * $complexNumber->getImaginary();
        return $this;
    }

    /**
     * @return float
     */
    public function getReal(): float
    {
        return $this->real;
    }

    /**
     * @return float
     */
    public function getImaginary(): float
    {
        return $this->imaginary;
    }
}