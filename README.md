# BuuhV Framework

<a href='https://buuhv.brjnascimento.com'>Documentation</a>

**composer create-project geeknection/buuhvframework**

Easily create your PHP applications with the BuuhV Framework

Folders Structure
-
app/views/pages - it has your views page. Example: home/index.html  
app/views/components - it has your components page. Example: sidebar.html  
app/views/layout - it has your design dependencies as css, js or image files  
  
app/controllers/ - it has your app controllers. Example: home/index.php  
app/models/ - it has your models of controllers. Example: home/index.php  
  
texts/ - it has your language files. Example: texts/en-us.tx  
  
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

How can I create session ?
-
Session::set('**session-name**', '**session-value**');  

How can I load component html?
-
View::component('**component-name**');  

How can I define values in component html ?
-
Inside your html file write some likes this: {{variableName}}  
When you are call View::component... You need to write View::component('**component-name**', array(  
   'variableName' => **variable-value**  
));  
