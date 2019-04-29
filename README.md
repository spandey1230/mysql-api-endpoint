# Mysql-Api-Endpoint

A mysql api endpoint to manage any database in mysql without coding.
More time to focus on your FrontEnd design, UI/UX.
Full prepared to manage all your database requests without coding

## How to use

Clone the repository to a server and start sending you requests to build **path/to/mysql-api-endpoint/endpoint/PhpDataTarget.php**

## Database settings

To set the database connection go to **/path/to/mysql-api-endpoint/config.php** and set you database connection settings
```php
$config = array('db' => array(
	'host' => "", 		# Host address
	'database' => "", 	# Database name
	'username' => "", 	# Username
	'password' => "", 	# Password
	'port' => 3306		# Port
));
```

## Documentation

Find the complete documentation on https://emagombe.github.io/projects/mysql-api-endpoint (*Documentation page in development*)


## Store

Storing data on database

**Request**

```javascript
{
  action: 'store',
  tbl: 'tablename',
  val: {
    fruit: 'banana',
    stock: 16,
    is_eatable: 1
  }
}
```
| Key   | Description                                             		| Data type	 |
|------ | ----------------------------------------------------------------------|-----------------
|**tbl**| the name of the table                                   		| String 	 |
|**val**| values(key is the column name and value is the value of the column)   | JSON		 |
|**action**| The action to be excuted (store, find, update, delete, Remove, ...)| String	 |


## Find

Find stored data in the database

```javascript
{
	action: 'find',
	tbl: ['user'],		// Table name
	col: ['*'],		// Columns (use * for all columns)
	cond: {			// Condition (Apply conditions to filter your data)
		id: 1
	}
}
```
#### Cutting the ammount of returned data with (*Limit*)
Cut returned data from the database
```javascript
{
	action: 'find',
	tbl: ['user'],		// Table name
	col: ['*'],		// Columns (use * for all columns)
	limit: 2		// Will return the first two rows
}
```
#### Ordering data
Order the returned data
```javascript
{
	action: 'find',
	tbl: ['user'],		// Table name
	col: ['*'],		// Columns (use * for all columns)
	ordby: 'id',		// Column to order
	ord: 'ASC'		// Use ASC or DESC
}
```

#### Between
Select column data range
```javascript
{
	action: 'find',
	tbl: ['user'],		// Table name
	col: ['*'],		// Columns (use * for all columns)
	cond: {
		userType: 'Admin'
	},
	between: ['id', 1, 3],		// Between depends of cond 
					// First the column then the range
}
```

## Udate

Update data in the database

```javascript
{
	action: 'update',
	tbl: 'user',		// Table name
	col: {			// Columns to be updated. The key indicates the column and the value is the new value to be set
		userType: 'Admin',
	},
	cond: {
		userType: 'employee',
	}
}
```

## Remove

Remove data from the database

```javascript
{
	action: 'update',
	tbl: 'user',		// Table name
	cond: {
		id: 1,
	}
}
```

## Athenetication

In case that you need to create a login system, you can use the authentication parametes to authenticate.
This authentication method uses **password_hash** to hash the password and **password_verify** method to verify your password.

**Hasing password**

This will return a encrypted password
```javascript
{
	action: 'hash',
	key: 'my-password'
}
```
**Authenticating the stored enctrypted user data**

If success this will return the whole user data
```javascript
{
	action: 'authenticate',
	tbl: 'user',			// Table name
	username: 'my.username',	
	password: 'my.secret.password',
}
```
## MD5

Encrypt data using php md5 method
```javascript
{
	action: 'md5',
	key: 'sometimes i wish to stop coding',
}
```
## Upload

File upload

```javascript
{
	action: 'upload',
	multiple: 'false',		// Set  to true if you wish to upload multiple files from an input
}

// This will return the file information (path, size, filetype)


```
