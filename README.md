# BuuhV Framework

Easily create your PHP applications with the BuuhV Framework

Folders Structure
-
app/views/pages - it has your views page. Example: home/index.html <br/>
app/views/components - it has your components page. Example: sidebar.html <br/>
app/views/layout - it has your design dependencies as css, js or image files <br/>
 <br/>
app/controllers/ - it has your app controllers. Example: home/index.php <br/>
app/models/ - it has your models of controllers. Example: home/index.php <br/>
 <br/>
texts/ - it has your language files. Example: texts/en-us.tx <br/>
 <br/>
How can I build my app?
-
In folder App you have controllers, models and views. <br/>
Pages are in views folder <br/>
Controllers are in controllers folder <br/>
Models are in models folder. <br/>
 <br/>
How to build a view?
-
In **app** folder create some like this:  **view-name/index.html** <br/>
Then build page template inside it <br/>

How to build a route?
-
In your **app** folder open index.php.file and before **Routes::notFound()** write <br/>
"Routes::set('/**your-route-name**, function() { <br/>
       //here you will get your view <br/>
       View::build('**view-name**'); <br/>
}" <br/>

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
Lang::translate('**text-slug**'); <br/>
create your file language inside texts folder. Example: texts/en-us.txt <br/>

How can I use rest service api?
-
When you do request to your server, use: **yourdomain**/api.php?c=**controller-name-class**&m=**method-used** <br/>

How can I create session ?
-
Session::set('**session-name**', '**session-value**'); <br/>

How can I load component html?
-
View::component('**component-name**'); <br/>

How can I define values in component html ?
-
Inside your html file write some likes this: {{variableName}} <br/>
When you are call View::component... You need to write View::component('**component-name**', array( <br/>
   'variableName' => **variable-value** <br/>
)); <br/>
