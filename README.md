# File Upload 

## Requisitos
* Docker

```
https://docs.docker.com/v17.09/engine/installation/linux/docker-ce/ubuntu
```

* Docker Compose

```
https://docs.docker.com/compose/install
```

## INSTALAÇÃO

1. Clone o projeto:
```
git clone https://github.com/fabiom2211/file_upload_laravel.git
```

2. Setar as permissões de escrita e leitura para as pastas storage e cache:
```
cd file_upload_laravel
sudo chmod -R 777 src/storage src/bootstrap/cache
```

3. Criar os parametros de configuração da aplicação:
```
cp src/.env.dev src/.env
```

4. Suba os containers para iniciar a aplicação:
```
sudo docker-compose up -d
```

5. Entre no container para em seguida rodar o migrate:
```
sudo docker exec -it php_laravel sh
```

6. Dentro do container php_laravel rode o migrate:
```
php artisan migrate

```

## Acesso:
http://localhost:7000