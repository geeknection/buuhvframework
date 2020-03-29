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
In **app** folder create some like this:  **view-name/index.html**
Then build page template inside it

How to build a route?
-
In your **app** folder open index.php.file and before **Routes::notFound()** write
"Routes::set('/**your-route-name**, function() {
       //here you will get your view
       View::build('**view-name**');
}"

How can I define css, js or image file?
-
Inside **layout** folder

How can I import path layout file?
-
In your view file use
"echo App::layout ('**file-path-in-folder**');"

How can I define values in html file?
-
Inside your html file write some likes this: {{variableName}}
When you are call View::build... You need to write View::build('**view-name**', array(
   'variableName' => **variable-value**
));

How can I translate my application?
-
Lang::translate('**text-slug**');
create your file language inside texts folder. Example: texts/en-us.txt

How can I use rest service api?
-
When you do request to your server, use: **yourdomain**/api.php?c=**controller-name-class**&m=**method-used**
