# swim-skeleton

swim 框架

### 安装

```
$ composer create-project lvinkim/swim-skeleton [my-app-name]
```

### 配置

```
$ cp .env.example .env
```

### 启动

#### 开发模式(php -S)启动
```
$ php bin/server.php server:dev:start 0.0.0.0:6600

# 如果使用 docker 
$ docker-compose -f docker-compose-dev.yml up
```

#### 生产模式(swoole)启动
```
$ php bin/server.php server:start

# 如果使用 docker
$ docker-compose up
```