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
            [3.5, 4.5, 1.5, 2.5, (3.5 * 1.5 + 4.5 * 2.5), (4.5 * 1.5 - 3.5 * 2.5)],
            [1.5, 4.5, 3.5, 2.5, (3.5 * 1.5 + 4.5 * 2.5), (4.5 * 3.5 - 1.5 * 2.5)],
            [3.5, 2.5, 1.5, 4.5, (3.5 * 1.5 + 4.5 * 2.5), (2.5 * 1.5 - 3.5 * 4.5)],
            [1.5, 2.5, 3.5, 4.5, (3.5 * 1.5 + 4.5 * 2.5), (2.5 * 3.5 - 1.5 * 4.5)],
            [2.5, 4.5, 1.5, 3.5, (2.5 * 1.5 + 4.5 * 3.5), (4.5 * 1.5 - 2.5 * 3.5)],
            [3.5, 1.5, 4.5, 2.5, (3.5 * 4.5 + 1.5 * 2.5), (1.5 * 4.5 - 3.5 * 2.5)],
            [2.5, 1.5, 4.5, 3.5, (2.5 * 4.5 + 1.5 * 3.5), (1.5 * 4.5 - 2.5 * 3.5)],
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
     * @param $firstReal
     * @param $firstImaginary
     * @param $secondReal
     * @param $secondImaginary
     * @param $resultReal
     * @param $resultImaginary
     * @dataProvider multiplyProvider
     */
//    public function testMultiply(
//        $firstReal,
//        $firstImaginary,
//        $secondReal,
//        $secondImaginary,
//        $resultReal,
//        $resultImaginary
//    ): void
//    {
//        $this->assertEquals($a, $b);
//    }
//
//    public function multiplyProvider(): array
//    {
//        return [
//            [1, 1]
//        ];
//    }
//
//    /**
//     * @param $a
//     * @param $b
//     * @dataProvider addProvider
//     */
//    public function testAdd(
//        $firstReal,
//        $firstImaginary,
//        $secondReal,
//        $secondImaginary,
//        $resultReal,
//        $resultImaginary
//    )
//    {
//        $this->assertEquals($a, $b);
//    }
//
//    public function addProvider(): array
//    {
//        return [
//            [1, 1]
//        ];
//    }
//
//    /**
//     * @param $firstReal
//     * @param $firstImaginary
//     * @param $secondReal
//     * @param $secondImaginary
//     * @param $resultReal
//     * @param $resultImaginary
//     * @dataProvider addProvider
//     */
//    public function testSubtract(
//        $firstReal,
//        $firstImaginary,
//        $secondReal,
//        $secondImaginary,
//        $resultReal,
//        $resultImaginary
//    ): void
//    {
//        $this->assertEquals($a, $b);
//    }
//
//    public function subtractProvider(): array
//    {
//        return [
//            [1, 1]
//        ];
//    }
}
