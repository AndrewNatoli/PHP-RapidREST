#PHP-RapidREST
=============
**RapidREST allows you to have a working CRUD API in sixty seconds!**

# Background
=============
#### First I had a problem...
I've been looking build simple test applications that implement API's as a learning experience but dreaded the time commitment for designing databases and doing the actual programming for an application I'd abandon after three days. Architecting a clever, re-usable way to handle database access was my main problem so I started [PHP Model Buddy](https://github.com/AndrewNatoli/PHP-ModelBuddy). Months have gone by and my dwindling free time to experiment has left me with a half-finished database access framework. 

#### ...then came RedBeanPHP...
I recently discovered [RedBeanPHP](http://redbeanphp.com/) and my problem was solved. If you're not familiar with it, RedBeanPHP is an on-the-fly ORM for PHP. Want to create a record in a table that doesn't exist? Boom, the table and columns are made. It's absolutely perfect if you want to get up and running quickly. 

#### ...and the Slim Framework. Problem solved!
Rather than re-inventing the wheel I decided to use [Slim Framework](http://www.slimframework.com/) in RapidREST to handle the API routes. Check /config/routes.php and you'll thank me for doing so.


#Installation
=============
### Requirements...
You'll need an apache server with **mod_rewrite** and **PHP >= 5.3.0**

**Composer** is needed to install the dependencies.

## Install with Composer

	php composer.phar create-project andrew-natoli/rapid-rest -sdev


## OR... Use git & composer

### Clone the Repo!

	git clone https://github.com/AndrewNatoli/PHP-RapidREST.git

### Install the dependencies!
Now use [composer](https://getcomposer.org/download/) to install [Slim Framework](http://www.slimframework.com/) and [RedBeanPHP](http://redbeanphp.com).
	
	sudo php composer.phar update

## Once installed... connect to the database!
Open **/config/rapidrest-config.php** to configure your database connection.

## All Done!
Enjoy your CRUD API!

# Base Wildcard Endpoints
=============
There are five base universal routes in RapidREST. They're perfect for prototyping small applications but I suggest removing and re-writing their controllers before moving your app to production if it's going to be public. 

ReadBeanPHP will automatically build the table schema for you based on the information you send.

#### GET list - yourapi.com/:table/
Returns all of the records and their contents in the specified table.

```
{
  "statuscode": 200,
  "data": [{
    "id": "1",
    "title": "Important Message",
    "text": "Hello, world!"
  }, {
    "id": "2",
    "title": "Also important",
    "text": "This is a message"
  }],
  "count": 2
}
```

#### GET record - yourapi.com/:table/:id
Returns the specified record from a table.

```
{
  "statuscode": 200,
  "data": [{
	"id": "1",
	"text": "Bacon!",
	"title": "Important Message"
  }]
}
```

#### POST record - yourapi.com/:table/
Creates a new record in the table.

```
{
  "statuscode": 200,
  "data": {
	"id": 3
  }
}
```

#### PUT record - yourapi.com/:table/:id
Updates an existing record in the table.

```
{
  "statuscode": 200,
  "data": {
	"id": 2
  }
}
```

#### DELETE record - yourapi.com/:table/:id
Deletes a record from the table.

```
{
	"statuscode": 200,
	"deleted": true
}
```
	

# Response Formats
=============
These return a JSON response by the way. If a record can't be found, updated, created, etc. the program will spit out a JSON error message.

**GET** requests will list the found record(s) within the "data" array:



**POST** and **PUT** will return the ID of the created (or updated) record:


	
**DELETE** will response with whether not a record was deleted.



**Exceptions** look like this:

	{"message":"Record not found.","statusCode":404}
	
# Making Changes...
=============
As mentioned earlier, you'll probably want to remove the stock API routes and controllers when you take your application public. This is a quick guide to where everything is so you can evolve your RapidREST Prototype API into a production-worthy API.

#### Where everything is...

* Configure your database connection in **/config/rapidrest-config.php**
* Define your custom routes in **/config/routes.php**
* Include custom classes in **/config/loader.php**
* The stock API controllers are found in **/lib/RapidRest/RapidRest.php**
* You can also find the APIException and JSON Response classes within **/lib/RapidRest/**

#### Namespaces...
* RedBeanPHP operates in the root namespace.
* APIException() is in API\Exceptions
* JSON() is in API\Response

#### How to...
##### Throw an exception:
Kill the process and return a JSON-encoded error message!

	use API\Exceptions\APIException
	throw new APIException("Record not found!",404);

##### Output data to the client
It's reccomended you use the Response classes rather than simply using json_encode() to allow for easy changes to your code in the future. You can extend the base JSON or abstract Response class and define your own methods to whitelist values or output additional data. 

	use API\Response\JSON
	$response = array();
	$response['data'] = $array_or_object;
	return new JSON($response);


#### What else you'll need to know for production...
* While **/config/routes.php** shows you basically everything you need to know for creating custom routes, do a little research about Slim Framework to make yourself comfy.
* Learn how to use **RedBeanPHP4** for building your custom controllers. Be sure you understand its strict database conventions. 


# Contributing...
=============
Pull requests welcome :)


# Acknowledgements...
=============
Cheers to necenzurat for devising a way of installing RedBeanPHP through composer.

https://github.com/necenzurat/redbeanphp-composer

And of course, Cheers to the developers of [Slim Framework](http://www.slimframework.com/) and [RedBeanPHP](http://redbeanphp.com).


# License
=============
##The MIT License (MIT)

Copyright (c) 2014 Andrew Natoli

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.