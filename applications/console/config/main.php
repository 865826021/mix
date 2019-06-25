<?php

// Console应用配置
return [

    // 应用名称
    'appName'          => 'mix-console',

    // 应用版本
    'appVersion'       => '0.0.0',

    // 应用调试
    'appDebug'         => getenv('APP_DEBUG'),

    // 基础路径
    'basePath'         => dirname(__DIR__),

    // 命令命名空间
    'commandNamespace' => 'Console\Commands',

    // 命令
    'commands'         => [

        'hl' => [
            'Hello',
            'description' => "\tEcho demo.",
            'options'     => [
                [['n', 'name'], 'description' => 'Your name'],
                ['say', 'description' => "\tSay ..."],
            ],
        ],

        'co' => [
            'Coroutine',
            'description' => "\tCoroutine demo",
        ],

        'wg' => [
            'WaitGroup',
            'description' => "\tWaitGroup demo",
        ],

        'cop' => [
            'CoroutinePool',
            'description' => "\tCoroutine pool demo",
        ],

        'copd' => [
            'CoroutinePoolDaemon',
            'description' => "\tCoroutine pool daemon demo",
            'options'     => [
                [['d', 'daemon'], 'description' => 'Run in the background'],
            ],
        ],

        'tr' => [
            'Timer',
            'description' => "\tTimer demo",
        ],

    ],

    // 依赖配置
    'beans'            => [

        // 错误
        [
            // 名称
            'name'            => 'error',
            // 类路径
            'class'           => Mix\Console\Error::class,
            // 构造函数注入
            'constructorArgs' => [
                [
                    // 错误级别
                    'level' => E_ALL,
                ],
            ],
        ],

        // 日志
        [
            // 名称
            'name'            => 'log',
            // 类路径
            'class'           => Mix\Log\Logger::class,
            // 构造函数注入
            'constructorArgs' => [
                [
                    // 日志记录级别
                    'levels'  => ['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'],
                    // 处理器
                    'handler' => [
                        // 依赖引用
                        'ref' => Mix\Log\MultiHandler::class,
                    ],
                ],
            ],
        ],

        // 日志处理器
        [
            // 类路径
            'class'           => Mix\Log\MultiHandler::class,
            // 构造函数注入
            'constructorArgs' => [
                [
                    // 日志处理器集合
                    'handlers' => [
                        // 标准输出处理器
                        [
                            // 依赖引用
                            'ref' => Mix\Log\StdoutHandler::class,
                        ],
                        // 文件处理器
                        [
                            // 依赖引用
                            'ref' => Mix\Log\FileHandler::class,
                        ],
                    ],
                ],
            ],
        ],

        // 日志标准输出处理器
        [
            // 类路径
            'class' => Mix\Log\StdoutHandler::class,
        ],

        // 日志文件处理器
        [
            // 类路径
            'class'           => Mix\Log\FileHandler::class,
            // 构造函数注入
            'constructorArgs' => [
                [
                    // 日志目录
                    'dir'         => 'logs',
                    // 日志轮转类型
                    'rotate'      => Mix\Log\FileHandler::ROTATE_DAY,
                    // 最大文件尺寸
                    'maxFileSize' => 0,
                ],
            ],
        ],

        // 连接池
        [
            // 名称
            'name'            => 'dbPool',
            // 类路径
            'class'           => Mix\Database\Pool\ConnectionPool::class,
            // 构造函数注入
            'constructorArgs' => [
                [
                    // 最多可空闲连接数
                    'maxIdle'   => 5,
                    // 最大连接数
                    'maxActive' => 50,
                    // 拨号器
                    'dialer'    => [
                        // 依赖引用
                        'ref' => Common\Dialers\DatabaseDialer::class,
                    ],
                ],
            ],
        ],

        // 连接池拨号
        [
            // 类路径
            'class' => Common\Dialers\DatabaseDialer::class,
        ],

        // 连接池
        [
            // 名称
            'name'            => 'redisPool',
            // 类路径
            'class'           => Mix\Redis\Pool\ConnectionPool::class,
            // 构造函数注入
            'constructorArgs' => [
                [
                    // 最多可空闲连接数
                    'maxIdle'   => 5,
                    // 最大连接数
                    'maxActive' => 50,
                    // 拨号器
                    'dialer'    => [
                        // 依赖引用
                        'ref' => Common\Dialers\RedisDialer::class,
                    ],
                ],
            ],
        ],

        // 连接池拨号
        [
            // 类路径
            'class' => Common\Dialers\RedisDialer::class,
        ],

        // 数据库
        [
            // 类路径
            'class'           => Mix\Database\Coroutine\PDOConnection::class,
            // 构造函数注入
            'constructorArgs' => [
                [
                    // 数据源格式
                    'dsn'           => getenv('DATABASE_DSN'),
                    // 数据库用户名
                    'username'      => getenv('DATABASE_USERNAME'),
                    // 数据库密码
                    'password'      => getenv('DATABASE_PASSWORD'),
                    // 驱动连接选项: http://php.net/manual/zh/pdo.setattribute.php
                    'driverOptions' => [
                        // 设置默认的提取模式: \PDO::FETCH_OBJ | \PDO::FETCH_ASSOC
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    ],
                ],
            ],
        ],

        // redis
        [
            // 类路径
            'class'           => Mix\Redis\Coroutine\RedisConnection::class,
            // 构造函数注入
            'constructorArgs' => [
                [
                    // 主机
                    'host'     => getenv('REDIS_HOST'),
                    // 端口
                    'port'     => getenv('REDIS_PORT'),
                    // 数据库
                    'database' => getenv('REDIS_DATABASE'),
                    // 密码
                    'password' => getenv('REDIS_PASSWORD'),
                ],
            ],
        ],

        // 数据库
        [
            // 类路径
            'class'           => Mix\Database\Persistent\PDOConnection::class,
            // 构造函数注入
            'constructorArgs' => [
                [
                    // 数据源格式
                    'dsn'           => getenv('DATABASE_DSN'),
                    // 数据库用户名
                    'username'      => getenv('DATABASE_USERNAME'),
                    // 数据库密码
                    'password'      => getenv('DATABASE_PASSWORD'),
                    // 驱动连接选项: http://php.net/manual/zh/pdo.setattribute.php
                    'driverOptions' => [
                        // 设置默认的提取模式: \PDO::FETCH_OBJ | \PDO::FETCH_ASSOC
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    ],
                ],
            ],
        ],

        // redis
        [
            // 类路径
            'class'           => Mix\Redis\Persistent\RedisConnection::class,
            // 构造函数注入
            'constructorArgs' => [
                [
                    // 主机
                    'host'     => getenv('REDIS_HOST'),
                    // 端口
                    'port'     => getenv('REDIS_PORT'),
                    // 数据库
                    'database' => getenv('REDIS_DATABASE'),
                    // 密码
                    'password' => getenv('REDIS_PASSWORD'),
                ],
            ],
        ],

    ],

];
