# MVC Framework


## Usage

### Config

Change the config in ./app/config/config.php to your settings
```php
// Database Parameters
define('DB_HOST', 'localhost'); 
define('DB_USER', '_YOUR_USER_');
define('DB_PASSWORD', '_YOUR_PASSWORD_');
define('DB_NAME', '_YOUR_DBNAME_');

// App Root
define ('APPROOT', dirname(dirname(__FILE__)));
// URL Root
define ('URLROOT', '_YOUR_URL_');
// Site Name
define('SITENAME', '_YOUR_SITENAME_');

// Header and Foot HTML
define('HEADER', APPROOT . '/views/Inc/header.php');
define('FOOTER', APPROOT . '/views/Inc/footer.php');
```

### .htaccess

Change the RewriteBase your own
```
<IfModule mod_rewrite.c>
    Options -Multiviews
    RewriteEngine On
    RewriteBase _YOUR_REWRITEBASE_
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]
</IfModule>
```



## Simple Views
With header and footer tags cleaning a lot of the html clutter.
```php
<?php require HEADER; ?>

<h1><?php echo $data['title']; ?></h1>
<ul>
    <?php foreach($data['posts'] as $post) : ?>
        <li><?php echo $post->title; ?></li>
    <?php endforeach; ?>
</ul>

<?php require FOOTER; ?>
```

## Passing Data
Passing data from the controller into the Page

```php
// ./app/controllers/Pages.php
public function about(){
        $data =  [
            'title' => 'About Page',
        ];
        $this->view('Pages/about', $data);
}

// ./app/views/Pages/about.php
<?php require HEADER; ?>

<h1><?php echo $data['title']; ?></h1>

<?php require FOOTER; ?>
```