<?php

namespace Tests\Labs\One;

use App\Labs\One\Generator;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class GeneratorTest extends TestCase
{
    public function validOptionsProvider(): array
    {
        return [
            [['m' => 32, 'a' => 7, 'c' => 0, 'x' => 1]],
        ];
    }

    public function invalidOptionsProvider(): array
    {
        return [
            [['m' => 0, 'a' => 0, 'c' => 0, 'x' => 0]],
            [['m' => 1, 'a' => 1, 'c' => 2, 'x' => 3]],
        ];
    }

    /**
     * @dataProvider validOptionsProvider
     */
    public function testWithValidOptions(array $options)
    {
        $generator = new Generator($options);

        self::assertGreaterThan(0, $generator->modulo());
        self::assertGreaterThanOrEqual(0, $generator->initial());
        self::assertGreaterThanOrEqual(0, $generator->increment());
        self::assertGreaterThanOrEqual(0, $generator->multiplier());

        self::assertLessThan($generator->modulo(), $generator->initial());
        self::assertLessThan($generator->modulo(), $generator->increment());
        self::assertLessThan($generator->modulo(), $generator->multiplier());
    }

    /**
     * @dataProvider invalidOptionsProvider
     */
    public function testWithInvalidOptions(array $options)
    {
        self::expectException(ValidationException::class);
        $generator = new Generator($options);
    }

    /**
     * @testWith [{"m": 32, "a": 7, "c": 0, "x": 1}, [7, 17, 23, 1]]
     */
    public function testNext(array $options, array $values)
    {
        $generator = new Generator($options);
        self::assertEquals($generator->value(), $generator->initial());

        foreach ($values as $value) {
            self::assertEquals($value, $generator->next());
        }
    }

    /**
     * @testWith [{"m": 32, "a": 7, "c": 0, "x": 1}, [7, 17, 23, 1]]
     */
    public function testIterator(array $options, array $values)
    {
        $generator = new Generator($options);
        self::assertEquals($generator->value(), $generator->initial());

        $numbers = $generator->iterator(count($values));
        foreach ($numbers as $key => $number) {
            self::assertEquals($values[$key], $number);
        }
    }

    /**
     * @testWith [{"m": 32, "a": 7, "c": 0, "x": 1}, 4]
     */
    public function testPeriod(array $options, int $period)
    {
        $generator = new Generator($options);
        self::assertEquals($period, $generator->period());
    }

    /**
     * @testWith [{"m": 4194303, "a": 729, "c": 233, "x": 5}, 1364]
     */
    public function testDefaultPeriod(array $options, int $period)
    {
        $generator = new Generator($options);
        self::assertEquals($period, $generator->period());
    }
}
