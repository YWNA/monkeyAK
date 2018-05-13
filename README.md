# monkeyAK
## 第三方依赖包
* Pimple
* Doctrine
* Symfony/Console
* Monolog
* Uuid
* Phpmig
* Codeception
## 项目配置

```
项目的更目录下的env.php
```
## 初始化数据库
```sql
CREATE DATABASE monkey
CREATE DATABASE monkey_test
```

```
bin/phpmig migrate
```

## 单元测试
```
vendor/bin/codecept run
```
## [PHP扩展Yar](https://github.com/laruence/yar)的安装
- **安装Yar的前提条件:**
    1. PHP 5.2+
    2. Curl
    3. Json
    4. Msgpack (Optional)
- **安装**
    ```
    pecl install yar
    ```


