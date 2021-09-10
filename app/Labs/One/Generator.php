<?php

namespace App\Labs\One;

class Generator
{
    protected float $value;
    protected array $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function options(?array $options = null): array
    {
        return $this->options;
    }

    public function modulo(): float
    {
        return $this->options['m'];
    }

    public function multiplier(): float
    {
        return $this->options['a'];
    }

    public function increment(): float
    {
        return $this->options['c'];
    }

    public function initial(): float
    {
        return $this->options['x'];
    }

    public function value(): float
    {
        return $this->value ?? $this->initial();
    }

    public function next(): float
    {
        return $this->value = ($this->multiplier() * $this->value() + $this->increment())
            % $this->modulo();
    }

    public function iterator(?int $amount = null): \Generator
    {
        if ($amount === null) {
            yield $this->next();
        }

        for ($i = 0; $i < $amount; $i++) {
            yield $this->next();
        }
    }

    public function numbers(int $amount): array
    {
        return iterator_to_array($this->iterator($amount));
    }

    public function period(int $max = 100000000): ?int
    {
        $value = $this->value();
        $this->value = $this->initial();

        foreach ($this->iterator($max) as $key => $number) {
            if ($number === $this->initial()) {
                $this->value = $value;
                return $key + 1;
            }
        }

        $this->value = $value;
        return null;
    }
}
