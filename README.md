# MAW1 - Exercise Looper

## Subject

Create a copy of this web application : [Exercise Looper](https://stormy-plateau-54488.herokuapp.com)

## Deadlines

Intermediate : `31.10.2022`  
Final : `21.12.2022`

## Requirements

We must use HTML5 and CSS.  
Frameworks and JavaScript are forbidden by default
___

## Installation

### Local installation (for development)

#### Prerequisites:

- Have a `Php` and `Mariadb` service installed and be able to reach them in a shell (test `php -v` and `mariadb -v` to verify. Successful verification if the command is recognized.
- Have the **PDO** extension activated on the Php server (change `;extension=pdo_mysql` to `extension=pdo_mysql` in the `php.ini` file or verify that it is already done).

#### Procedure:

1. **Get the repository** from GitHub (clone or `.zip` download) (example clone in a shell in the `C:/Users/Alice/Documents/GitHub/` folder)

        VS:
        cd C:/Users/Alice/Documents/GitHub/
        git clone https://github.com/CPNV-ES/MAW1-BPT-SMD.git

2. Open a shell and **install the PHP packages** (with `Composer`) in the folder ` app `!

        cd app
        composer install

3. Start the MySQL service. Log in (with an SQL client for example) as the `root` account. Execute the `MAW1-BPT-SMD\modelisation\createDatabase.sql` file, which will **create the `looper` database**
   and its tables. Then **create a new user** (named here `looper` with `looper` for password) and give him access to the previously created `looper` database. Connect to the new user to verify that
   it has been created and that it has access to the `looper` database.
4. Go to `app`. Duplicate the `.const.php.example` file and rename it to `.const.php`.
5. Start an IDE at the root of the repository. Modify the values ​​of the `.const.php` file in order to **register the identifiers** of connection to the database (4 values ​​+ a cartridge).

        $user = "looper";
        $pass = "looper"; //Special php characters must be preceded by \
        $dbhost = "localhost";
        $dbname = "looper";

6. Start a PHP server with the command : `php -S localhost:<PORT> -t public` on a free port (here 8888).
7. **Open a web browser** on the localhost address and the chosen port: `localhost:<PORT>`.

___

## ExerciseLooper features

### Exercise building

- [x] Create a new blank exercise with a title
- [x] Add a new field with a title and a value type
- [x] Edit an existing field to either rename it or change the value type
- [x] Destroy an existing field

### Exercise taking

- [x] List the exercises that are ready for answers
- [x] Take an exercise to see all the fields
- [x] Answer the taken exercise by filling the fields
- [x] Update the existing answers for a taken exercise

### Exercise management

- [x] List all the exercises in 3 columns based on their state
- [x] Destroy an exercise (only when building or closed)
- [x] Change state of an exercise through icon buttons
- [ ] Stats for an exercise: show the recap (all takes, all fields)
- [ ] Stats for an exercise: show the answers of all fields of one take
- [ ] Stats for an exercise: show the answers on one field of all takes

___
