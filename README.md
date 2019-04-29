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
### Cutting the ammount of returned data with *Limit*
```javascript
{
	action: 'find',
	tbl: ['user'],		// Table name
	col: ['*'],		// Columns (use * for all columns)
	limit: 2		// Will return the first two rows
}
```
### Ordering data
```javascript
{
	action: 'find',
	tbl: ['user'],		// Table name
	col: ['*'],		// Columns (use * for all columns)
	ordby: 'id',		// Column to order
	ord: 'ASC'		// Use ASC or DESC
}
```

### Between
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

