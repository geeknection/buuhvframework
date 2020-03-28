# BuuhV Framework

Easily create your PHP applications with the BuuhV Framework

How can I build my app?
-
In folder App you have controllers, models and views.
Pages are in views folder
Controllers are in controllers folder
Models are in models folder.

How to build a view?
-
In **app** folder create some like this:  **view-name/index.php**
Then build page template inside it

How to build a route?
-
In your **app** folder open index.php.file and before **Routes::notFound()** write
"Routes::set('/**your-route-name**, function() {
       //here you will get your view
       Routes::get('**view-name**');
}"

How can I define css, js or image file?
-
Inside **layout** folder

How can I import path layout file?
-
In your view file use
"<?php acho App::layout ('**file-path-in-folder**'); ?>"
