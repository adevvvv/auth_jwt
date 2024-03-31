Запустить:
1. Клонируй репозиторий, например в папку с OpenServer: git clone git@github.com:adevvvv/auth_jwt.git
2. Первый раз запусти команды в БД MySQL из файла start.sql
3. Запусти следующие HTTP запросы c JSON, например в Postman:

http://auth-jwt/register

```
{
  "email" : "vk@bk.ru",
  "password" : "Ddthbjjc1111?"
}
```

http://auth-jwt/authorize

```
{
  "email" : "vk@bk.ru",
  "password" : "Ddthbjjc1111?"
}
```

http://auth-jwt/feed
```
{
  "jwt" : #токен из предыдущего шага
}
```
Результат:
![image](https://github.com/adevvvv/auth_jwt/assets/126315394/c2867a40-8248-479e-808d-ee347a9a0418)

![image](https://github.com/adevvvv/auth_jwt/assets/126315394/53f1673c-1c65-492f-86a8-8bcd933e127c)

![image](https://github.com/adevvvv/auth_jwt/assets/126315394/c02de694-1258-4f6e-8b2e-51652e108983)

![image](https://github.com/adevvvv/auth_jwt/assets/126315394/8d75024e-4f6a-40ec-a6ac-8ddb4723f450)




