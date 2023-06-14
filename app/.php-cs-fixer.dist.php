<?php

/**
 * @see https://mlocati.github.io/php-cs-fixer-configurator/
 * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-12-extended-coding-style-guide.md
 */

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude([
        'var',
        'vendor',
    ])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        '@PHP81Migration' => true,
        'concat_space' => ['spacing' => 'one'],
        'phpdoc_summary' => false, // .つけたくない
        'phpdoc_to_comment' => false, // コメントにしたくない
//        'single_line_throw' => false,
        'ordered_imports' => [
            'imports_order' => [ // デフォだとclassとfunctionが同列に扱われる
                'class',
                'function',
                'const',
            ],
        ],
    ])
    ->setFinder($finder)
;
