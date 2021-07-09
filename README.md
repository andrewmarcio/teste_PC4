## Instalação 

#### 1° - Instale os pacotes do app
```
    composer install
```
#### 2° - Configure o seu .env 
#### 3° - Execute as migrations
```
   php artisan migrate
```
#### 4° - Execute os seeders
```
    php artisan db:seed 
    php artisan db:seed --class=EducationalLevelsSeeder 
    php artisan db:seed --class=SchoolSeeder 
    php artisan db:seed --class=ClasseSeeder 
    php artisan db:seed --class=StudentSeeder 
```

#### Para criar as chaves de acesso para o Usuário e o Prestador use:
```
    php artisan passport:keys
    php artisan passport:client --password
```

#### Instalação do client
- Primeiro execute o comando

```
    npm install
```
- Configure o .env do seu client com os seguintes parametros com seus devidos valores
```
VUE_APP_BASE_URL=
VUE_APP_CLIENT_ID=
VUE_APP_CLIENT_SECRET=
```
- Por fim, execute o seu client.