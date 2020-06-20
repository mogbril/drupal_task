# How to run the project!
1- In your server root, clone the project
   

     git clone https://github.com/mogbril/drupal_task.git

2- Create an empty Database and import the sql dumb which exists on the `/_DB` folder.

3- Set the Database credentials on `/sites/default/settings/php`  by adding the following lines at the end of the file as below

     $databases['default']['default'] = [
       'database' => 'databasename',
        'username' => 'sqlusername',
        'password' => 'sqlpassword',
        'host' => 'localhost',
        'port' => '3306',
        'driver' => 'mysql',
        'prefix' => '',
       'collation' => 'utf8mb4_general_ci',
      ];

# After running the project , should see something like the videos below

 - https://drive.google.com/file/d/17AJRbwEovWaEUPGsEz6gANOYKkOsdq0A/view
 - https://drive.google.com/file/d/1_8Q9t9REPMXW8n5I-yPJU2i8w7WJFshO/view


## Custom Modules which I created.

You can review the modules which I created on `/modules/custom` folder espicially `products_list` & `execute_order` which contain the most of the code written.

## Super Admin Crednetials

URL `YOURDOMAIN/user`
Username `admin`
Password `***admin***`