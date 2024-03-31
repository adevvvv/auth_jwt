Запустить:
1. Клонируй репозиторий, например в папку с OpenServer: git clone git@github.com:adevvvv/auth_jwt.git
2. Первый раз запусти команды в БД MySQL из файла start.sql
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
Результат:
![image](https://github.com/adevvvv/auth_jwt/assets/126315394/1bc00c9e-32f8-4634-8a87-4bdcbaf4f10b)
![image](https://github.com/adevvvv/auth_jwt/assets/126315394/96d06b70-5dd4-4b66-8d8f-9ce8c27c2ae7)
![image](https://github.com/adevvvv/auth_jwt/assets/126315394/cdf43021-dc99-4339-968e-bfe19772e0da)
![image](https://github.com/adevvvv/auth_jwt/assets/126315394/6833da43-565b-4a8b-89d9-0468899268a5)



