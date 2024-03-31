Запустить:
1. Клонируй репозиторий, например в папку с OpenServer: git clone git@github.com:adevvvv/auth_jwt.git
2. Первый раз запусти команды в БД MySQL из файда start.sql
3. Запусти следующие HTTP запросы c JSON, например в Postman:

http://auth-jwt/register

```
{
  "email" : "vk@bk.ru",
  "password" : "1111"
}
```

http://auth-jwt/authorize

```
{
  "email" : "vk@bk.ru",
  "password" : "1111"
}
```

http://auth-jwt/feed
```
{
  "jwt" : #токен из предыдущего шага
}
```
