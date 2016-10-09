<?php

namespace mageekguy\atoum\standard_edition\composer\tests\units;

use
    mageekguy\atoum,
    mageekguy\atoum\standard_edition\composer\autoloadPathsLister as testedClass
;

require_once __DIR__ . '/../../../classes/composer/autoloadPathsLister.php';

class autoloadPathsLister extends atoum\test
{

    /**
     * @dataProvider listPathsDataProvider
     */
    public function testListPaths($case, $composerContent, $expected)
    {
        $this
            ->assert($case)
            ->given($lister = new testedClass())
            ->array($paths = $lister->listPaths($composerContent))
                ->isEqualTo($expected)
        ;
    }

    public function listPathsDataProvider()
    {
        return [
            [
                'case' => 'no autoload',
                'content' => [],
                'expected' => [],
            ],

            [
                'case' => 'no autoload content',
                'content' => ['autoload' => []],
                'expected' => [],
            ],

            [
                'case' => 'psr-0 with multiple namespaces',
                'content' => [
                    'autoload' => [
                        'psr-0' => [
                            "Monolog\\" => 'src/',
                            "Vendor\\Namespace\\" => 'src/',
                            "Vendor_Namespace_" => 'classes/',
                        ]
                    ]
                ],
                'expected' => ['src/', 'classes/'],
            ],
            [
                'case' => 'psr-0 with multiple folders',
                'content' => [
                    'autoload' => [
                        'psr-0' => [
                            "Monolog\\" => ['src/', 'lib/'],
                        ]
                    ]
                ],
                'expected' => ['src/', 'lib/'],
            ],

            [
                'case' => 'only classmap',
                'content' => [
                    'autoload' => [
                        'classmap' => ["src/", "lib/", "Something.php"],
                    ]
                ],
                'expected' => ['src/', 'lib/', "Something.php"],
            ],

            [
                'case' => 'classmap and psr-0',
                'content' => [
                    'autoload' => [
                        'psr-0' => [
                            "Monolog\\" => ['src/', 'lib/'],
                        ],
                        'classmap' => ["Something.php"]
                    ]
                ],
                'expected' => ['src/', 'lib/', "Something.php"],
            ],

            [
                'case' => 'files',
                'content' => [
                    'autoload' => [
                        "files" => ["src/MyLibrary/functions.php"]
                    ]
                ],
                'expected' => ['src/MyLibrary/functions.php'],
            ],

            [
                'case' => 'files and psr-0',
                'content' => [
                    'autoload' => [
                        'psr-0' => [
                            "Monolog\\" => ['src/', 'lib/'],
                        ],
                        "files" => ["src/MyLibrary/functions.php"]
                    ]
                ],
                'expected' => ['src/', 'lib/', 'src/MyLibrary/functions.php'],
            ],

            [
                'case' => 'only psr-4',
                'content' => [
                    "autoload" => [
                        'psr-4' => [
                            'namespace' => 'path',
                        ]
                    ]
                ],
                'expected' => ['path'],
            ],

            [
                'case' => 'only psr-4 with array of folders',
                'content' => [
                    "autoload" => [
                        'psr-4' => [
                            'namespace' => ['path', 'path2'],
                        ]
                    ]
                ],
                'expected' => ['path', 'path2'],
            ],

            [
                'case' => 'psr-4 and psr-0',
                'content' => [
                    "autoload" => [
                        'psr-0' => [
                            "Monolog\\" => ['src/', 'lib/'],
                        ],
                        'psr-4' => [
                            'namespace' => 'path',
                        ]
                    ]
                ],
                'expected' => ['src/', 'lib/', 'path'],
            ],
        ];
    }

}
