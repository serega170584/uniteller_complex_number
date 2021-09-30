<?php


use PHPUnit\Framework\TestCase;

class ComplexNumberTest extends TestCase
{
    /**
     * @param $real
     * @param $imaginary
     * @param $dividerReal
     * @param $dividerImaginary
     * @param $resultReal
     * @param $resultImaginary
     * @dataProvider divideProvider
     */
    public function testDivide(
        $real,
        $imaginary,
        $dividerReal,
        $dividerImaginary,
        $resultReal,
        $resultImaginary
    ): void
    {
        $complexNumber = new ComplexNumber($real, $imaginary);
        $dividerComplexNumber = new ComplexNumber($dividerReal, $dividerImaginary);
        $complexNumber->divide($dividerComplexNumber);
        $this->assertEquals($resultReal, $complexNumber->getReal());
        $this->assertEquals($resultImaginary, $complexNumber->getImaginary());
    }

    public function divideProvider(): array
    {
        return [
            [3.5, 4.5, 1.5, 2.5, (3.5 * 1.5 + 4.5 * 2.5) / (1.5 ** 2 + 2.5 ** 2), (4.5 * 1.5 - 3.5 * 2.5) / (1.5 ** 2 + 2.5 ** 2)],
            [1.5, 4.5, 3.5, 2.5, (3.5 * 1.5 + 4.5 * 2.5) / (3.5 ** 2 + 2.5 ** 2), (4.5 * 3.5 - 1.5 * 2.5) / (3.5 ** 2 + 2.5 ** 2)],
            [3.5, 2.5, 1.5, 4.5, (3.5 * 1.5 + 4.5 * 2.5) / (1.5 ** 2 + 4.5 ** 2), (2.5 * 1.5 - 3.5 * 4.5) / (1.5 ** 2 + 4.5 ** 2)],
            [1.5, 2.5, 3.5, 4.5, (3.5 * 1.5 + 4.5 * 2.5) / (3.5 ** 2 + 4.5 ** 2), (2.5 * 3.5 - 1.5 * 4.5) / (3.5 ** 2 + 4.5 ** 2)],
            [2.5, 4.5, 1.5, 3.5, (2.5 * 1.5 + 4.5 * 3.5) / (1.5 ** 2 + 3.5 ** 2), (4.5 * 1.5 - 2.5 * 3.5) / (1.5 ** 2 + 3.5 ** 2)],
            [3.5, 1.5, 4.5, 2.5, (3.5 * 4.5 + 1.5 * 2.5) / (4.5 ** 2 + 2.5 ** 2), (1.5 * 4.5 - 3.5 * 2.5) / (4.5 ** 2 + 2.5 ** 2)],
            [2.5, 1.5, 4.5, 3.5, (2.5 * 4.5 + 1.5 * 3.5) / (4.5 ** 2 + 3.5 ** 2), (1.5 * 4.5 - 2.5 * 3.5) / (4.5 ** 2 + 3.5 ** 2)],
        ];
    }

    /**
     * @param $real
     * @param $imaginary
     * @param $dividerReal
     * @param $dividerImaginary
     * @dataProvider divideByZeroProvider
     */
    public function testDivideByZeroException(
        $real,
        $imaginary,
        $dividerReal,
        $dividerImaginary
    )
    {
        $complexNumber = new ComplexNumber($real, $imaginary);
        $dividerComplexNumber = new ComplexNumber($dividerReal, $dividerImaginary);
        $this->expectException(DivisionByZeroError::class);
        $complexNumber->divide($dividerComplexNumber);
    }

    public function divideByZeroProvider(): array
    {
        return [
            [3.5, 4.5, 0, 0],
        ];
    }

    /**
     * @param $real
     * @param $imaginary
     * @param $multiplyReal
     * @param $multiplyImaginary
     * @param $resultReal
     * @param $resultImaginary
     * @dataProvider multiplyProvider
     */
    public function testMultiply(
        $real,
        $imaginary,
        $multiplyReal,
        $multiplyImaginary,
        $resultReal,
        $resultImaginary
    ): void
    {
        $complexNumber = new ComplexNumber($real, $imaginary);
        $multiplyComplexNumber = new ComplexNumber($multiplyReal, $multiplyImaginary);
        $complexNumber->multiply($multiplyComplexNumber);
        $this->assertEquals($resultReal, $complexNumber->getReal());
        $this->assertEquals($resultImaginary, $complexNumber->getImaginary());
    }

    public function multiplyProvider(): array
    {
        return [
            [3.5, 4.5, 1.5, 2.5, (3.5 * 1.5 - 4.5 * 2.5), (4.5 * 1.5 + 3.5 * 2.5)],
            [1.5, 4.5, 3.5, 2.5, (3.5 * 1.5 - 4.5 * 2.5), (4.5 * 3.5 + 1.5 * 2.5)],
            [3.5, 2.5, 1.5, 4.5, (3.5 * 1.5 - 4.5 * 2.5), (2.5 * 1.5 + 3.5 * 4.5)],
            [1.5, 2.5, 3.5, 4.5, (3.5 * 1.5 - 4.5 * 2.5), (2.5 * 3.5 + 1.5 * 4.5)],
            [2.5, 4.5, 1.5, 3.5, (2.5 * 1.5 - 4.5 * 3.5), (4.5 * 1.5 + 2.5 * 3.5)],
            [3.5, 1.5, 4.5, 2.5, (3.5 * 4.5 - 1.5 * 2.5), (1.5 * 4.5 + 3.5 * 2.5)],
            [2.5, 1.5, 4.5, 3.5, (2.5 * 4.5 - 1.5 * 3.5), (1.5 * 4.5 + 2.5 * 3.5)],
        ];
    }

    /**
     * @param $real
     * @param $imaginary
     * @param $addReal
     * @param $addImaginary
     * @param $resultReal
     * @param $resultImaginary
     * @dataProvider addProvider
     */
    public function testAdd(
        $real,
        $imaginary,
        $addReal,
        $addImaginary,
        $resultReal,
        $resultImaginary
    )
    {
        $complexNumber = new ComplexNumber($real, $imaginary);
        $addComplexNumber = new ComplexNumber($addReal, $addImaginary);
        $complexNumber->add($addComplexNumber);
        $this->assertEquals($resultReal, $complexNumber->getReal());
        $this->assertEquals($resultImaginary, $complexNumber->getImaginary());
    }

    public function addProvider(): array
    {
        return [
            [3.5, 4.5, 1.5, 2.5, 3.5 + 1.5, 4.5 + 2.5],
            [1.5, 4.5, 3.5, 2.5, 3.5 + 1.5, 4.5 + 2.5],
            [3.5, 2.5, 1.5, 4.5, 3.5 + 1.5, 4.5 + 2.5],
            [1.5, 2.5, 3.5, 4.5, 3.5 + 1.5, 4.5 + 2.5],
            [2.5, 4.5, 1.5, 3.5, 2.5 + 1.5, 4.5 + 3.5],
            [3.5, 1.5, 4.5, 2.5, 3.5 + 4.5, 1.5 + 2.5],
            [2.5, 1.5, 4.5, 3.5, 2.5 + 4.5, 1.5 + 3.5],
        ];
    }

    /**
     * @param $real
     * @param $imaginary
     * @param $subtractReal
     * @param $subtractImaginary
     * @param $resultReal
     * @param $resultImaginary
     * @dataProvider subtractProvider
     */
    public function testSubtract(
        $real,
        $imaginary,
        $subtractReal,
        $subtractImaginary,
        $resultReal,
        $resultImaginary
    ): void
    {
        $complexNumber = new ComplexNumber($real, $imaginary);
        $subtractComplexNumber = new ComplexNumber($subtractReal, $subtractImaginary);
        $complexNumber->subtract($subtractComplexNumber);
        $this->assertEquals($resultReal, $complexNumber->getReal());
        $this->assertEquals($resultImaginary, $complexNumber->getImaginary());
    }

    public function subtractProvider(): array
    {
        return [
            [3.5, 4.5, 1.5, 2.5, 3.5 - 1.5, 4.5 - 2.5],
            [1.5, 4.5, 3.5, 2.5, 1.5 - 3.5, 4.5 - 2.5],
            [3.5, 2.5, 1.5, 4.5, 3.5 - 1.5, 2.5 - 4.5],
            [1.5, 2.5, 3.5, 4.5, 1.5 - 3.5, 2.5 - 4.5],
            [2.5, 4.5, 1.5, 3.5, 2.5 - 1.5, 4.5 - 3.5],
            [3.5, 1.5, 4.5, 2.5, 3.5 - 4.5, 1.5 - 2.5],
            [2.5, 1.5, 4.5, 3.5, 2.5 - 4.5, 1.5 - 3.5],
        ];
    }
}
