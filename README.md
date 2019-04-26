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
| Key   | Description                                             |
|------ | --------------------------------------------------------|
|**tbl**| the name of the table                                   |
|**val**| values(key is the column name and the value is the )    |
|
