Todo-list Api
=============
API Symfony application

### HOW TO RUN PROJECT

From Docker-Compose use make command

```make dc_up```

#### HOW TO RUN TESTS
```make test```


#### Use JWT Tokens

#### For create user use console command
``` From make app_bash  -> php bin/console app:users:create-user ``` 

#### For user auth
``` use POST request with user json creds -> http://localhost/api/auth/token/login ``` 

