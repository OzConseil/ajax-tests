# Ajax Tests

This project allows to implement some Ajax calls for testing purposes

# Implement php callback functions on server side

## ajax.php

- Add your callback function in the **actions array** :

````php
$actions = [
    'say-hello' => 'sayHello',
    'get-page-content' => 'getPageContent',
    'php-debug' => 'phpDebug',
    'your-function' => 'yourFunction'
];
````
- Add your function with the **following prototype** :

````php
function yourFunction(&$responseArray) {
}
````

If you need to get some **additional POST data**, use the **filter_input** php function. By exemple :
````php
$pageUrl = filter_input(INPUT_POST, 'page-url', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
````

On the response array, **you need to set** :
- the status `$responseArray['status']` (*'error'* by default, set it on *'success'* in case of success)
- the message `$responseArray['status']` (*'An error has occured'* by default, customize it)

And **you can return data** on `$responseArray['data']`

A fourth field is provided and automatically with the possible **php errors/warning/notice** : `$responseArray['debug']`

The server will send `$responseArray` to the client using the **JSON format** with the appropriate header.

# Call these functions on client side using Ajax (with jQuery) 

## index.php

- Add your form, by exemple :

````html
<h3>Get page content</h3>
<form id="getPageContent" action="ajax.php" method="post">
    <input type="hidden" name="action" value="get-page-content">
    <input type="text" name="page-url" placeholder="Enter the page url here" size="50"><br />
    <input type="submit" value="Test">
</form>
````
The *'hidden action'* input and the *'submit'* input are needed.

You can **add some other fields** like the *'page-url text'* input **to transmit data to your callback function**.

## scripts.js

You should not need to modify it.

# Apache config

## Virtual host

- Create the following Virtual Host file :

**/etc/apache2/site-available/ajax-tests.loc.conf**
````apacheconfig
<VirtualHost *:80>

    ServerName ajax-tests.loc
    ServerAlias ajax-tests.loc *.ajax-tests.loc
    DocumentRoot "/var/www/html/Dev/ajax-tests"
    
    ServerAdmin webmaster@localhost
    
    ErrorLog ${APACHE_LOG_DIR}/ajax-tests.log
    CustomLog ${APACHE_LOG_DIR}/ajax-tests.log combined
    
    <Directory /var/www/html/Dev/ajax-tests>
        Options +FollowSymLinks
        RewriteEngine On
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>

</VirtualHost>
````
> Think to **customize** `DocumentRoot` and `Directory` !

- Enable the new Virtual host :

````bash
cd /etc/apache2/sites-available
sudo a2ensite ajax-tests.loc.conf
````

## hosts file
- add the following line to your **hosts** file :

````bash
127.0.1.1      ajax-tests.loc
````

## Apache reload
Finally, reload apache :
````bash
sudo service apache2 reload
````
