# MVC Framework


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