# Rest Api without framework
To install, copy this project into some dir, and write this
command:
```
composer update
```

Configure /config/db.php and change url to yours in
/config/jwt-config.php like this:

```
$iss = "http://localhost:8000";
$aud = "http://localhost:8000";
```

After that, use this command:

```
composer migrate
```

to migrate tables in your database.

If everything is ok, going to public repo, and use:

```

```

to host project.

## Wasted time 
>2h to install and configure all lib.

>2h to hate doctrine.

>3h to write code.

>1h to install and config jwt lib.

>1h to create guard and api tokens for auth.

>1h to test functionality.

## Endpoints

### Without auth

>GET /get_categories

>GET /get_products_in_category/{id}

In query must be fields username and password, to register user.
>POST /register_user

In query must be fields username and password, to login user.
>POST /login

>GET /get_products


### With jwt token in Header Authorization
to use it, just write your token from login
 
 ```
 //Example
 eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMCIsImF1Z
 CI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwiaWF0IjoxMzU2OTk5NTI0LCJuYmYiOjEzNTcwMDAwMDAsImR
 hdGEiOnsiaWQiOjEsImZpcnN0bmFtZSI6InRlc3QifX0.FzP6a0SIQpDc-itg57_UylR01ZLgA0vG_-OU7VjEK
 3Aqgjghrqd0AUKvgoZDTsXxwpjHwNDeGLQmy1JE4kjuDWK77oEgrO9D_5RSev9qVdZ9GlzB2M1q9g3oiFUrTGO
 8Nz9d6v1JugvtEelN5iYflQdVQUt-momY0w6hJdtw9hU
 ```

into header named Authorization

to create product, you need field asin and sku in your query, optionally - category
>POST /create_product

to update product, you need field asin and sku in your query, optionally - category
>PUT /update_product/{id}

>Delete /delete_product/{id}

In query must be field - title
>POST /create_category

In query must be field - title
>PUT /update_category/{id}

>Delete /delete_category/{id}