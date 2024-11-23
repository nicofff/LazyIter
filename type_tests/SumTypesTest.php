<?php declare(strict_types=1);
use LazyIter\LazyIter;

// We should notify if the iterator type is not summable
// TODO: Make this warn
LazyIter::fromArray(["uno","dos","tres"])
    ->sum();