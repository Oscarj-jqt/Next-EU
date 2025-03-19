# Backend

## Run lint

```bash
    docker exec -it backend composer fix
```

## Run phpstan

```bash
    docker exec -it backend composer analyse
```

## Install package

```bash
    docker exec -it backend composer require <package_name>
```

## Mysql

Inside container:
```bash
    mysql -u root -p
```

## Create migration

Inside container:
```bash
    php bin/console make:migration
```
