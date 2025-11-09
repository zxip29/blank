## 1.register api

**Url** - `http://localhost/community/index.php`

- request json body

```json
{
    "request":"1000",
    "username":"ngasanngal",
    "email":"ngasanngal@gmail.com",
    "password":"hehe.password",
    "device":"redminote6pro"
}
```

- response json body

```json
{
    "status":"401", //email already in another account
    ----------------
    "status":"402", //device already in another account
    ----------------
    "status":"200", //success register
    "userprivate";"123483249"
}
```



## 2.authorized api

**Url** - `http://localhost/community/index.php`

- request json body
```json
{
    "request":"2000",
    "userprivate":"userprivatedata",
    "device":"redminote6pro"
}
```

- response json body

```json
{
    "status":"401" //account not found
    ---------------
    "status":"402" //account closed
    ---------------
    "status":"403" // device not equal
    ---------------
    "stauts":"200", //success
    "accountstatus":1 //true
    "username":"ngasanngal",
    "profile":"http://localhost/community/Storage/Profile/asdf.png"
}
```

## 3.authorization/login api

**Url** - `http://localhost/community/index.php`

- request json body

```json
{
    "request":"3000",
    "email":"ngasanngal@gmail.com",
    "password":"ngasannga.password",
    "device":"redminote6pro"
}
```

- response json body

```json
{
    "status":"401" //account not found
    --------------------------------
    "status":"402" //wrong password
    --------------------------------
    "status":"403" //account closed 
    --------------------------------
    "status":"404" //device not equal
    --------------------------------
    "status":"200" //success
    "userprivate":"129323"
}
```
