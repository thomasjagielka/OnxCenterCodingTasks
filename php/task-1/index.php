<?php
class Pipeline {
    public static function make(...$functions) {
        return fn($arg) => array_reduce(
            $functions,
            fn($carry, $function) => $function($carry),
            $arg);
    }
}

$f = Pipeline::make(
    fn($var) => $var * 3,
    fn($var) => $var + 1,
    fn($var) => $var / 2,
);
?>