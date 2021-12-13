## How I created this application
## Requirments
mariadb
nginx
php7.4
###Creation of the symfony app
`$ composer create-project symfony/website-skeleton the-market  --no-interaction`


###Creation of the database
The name of the database is mentioned in the env file<br>
`$ php bin/console doctrine:database:create` <br>

###Creation of User entities with Security class to secure (parts of) application
First fo all,I create a login system and activate the firewall for authentication and define which parts of your application are secured.
For that, I use the command below to create SecurityController and link it to the User entity.<br>
`$ php bin/console make:user`<br>
created: src/Entity/Security.php<br>
created: src/Repository/SecurityRepository.php<br>
updated: src/Entity/Security.php<br>
updated: config/packages/security.yaml<br>


####Creating and Running migration file :<br>
To ensure of the creation of user table, I run the commands bellow
`$ php bin/console make:migration`
`$ php bin/console doctrine:migrations:migrate`

#### Creation of Home page
I use a Bootstrap Template to start the project. It helps to get results during the development.
The assets folder is in template folder

####Creation of Register page
I follow this Form workflow :
- Create a form type : 
` $ php console make:form` (RegisterType) <br>
- Build the form in RegisterController. Before that, I use the command below to create RegisterController to handle registration. <br>
  ` $ php console make:controller` (RegisterController) <br>
- Render the form in a template : templates/register/index.html.twig;<br>
- Process the form to validate the submitted data;

####Creation of Login page
Creation of guard authenticator to handle login and logout. All users authenticated will get a role 'ROLE_USER'<br>
` $ php console make:auth`<br>
this creates the class LoginFormAuthenticator which contains all the methods to handle user authentication.<br>
`created: src/Security/LoginFormAuthenticator.php`<br>
`created: src/Controller/SecurityController.php`<br>
`created: templates/security/login.html.twig.php`<br>

All users authenticated will bi redirected to account route which is private.

###Creations of the remaining entities

• Product (id, name, price, tax, stock).<br />
• Category (id, name).<br />
• Provider (id, name, address, country).<br />
• Client (id, name, address, country).<br />
• Transaction.<br />
• Company (id, name, balance, country).<br />
• Employee (id, name, birthday, country, first day).<br />
• Order (id, user_id, created_at)
• Order_details(id, order_id, product, quantity, price, total, address)
  => product and address will be a json object for history and don't affect data in this table if the product evolve. 


###Creation of Admin area
I choose to use EasyAdmin to create an admin interface for all admins users. This bundle helps to get rapidly an administration area which provide CRUDs on entities.  

`composer require easycorp/easyadmin-bundle`

It will create a DashboardController : 
`created : src/Controller/DashboardController`

This class controller provide us a controller to access the '/admin' route.
And we can create menu items by adding all the menus needed directly in the 'configureMenuItems' methods.

To activate crud on entities, we have to create controllers to manage it with the command bellow. This commands must be executed for all the entities: <br>
`$ php bin/console make:admin:crud`


###Creation of products page for public users












<br>
<br>
<br>
<br>
<br>
<br>
<br>

