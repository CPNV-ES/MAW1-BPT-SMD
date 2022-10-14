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
## Our beautiful technologies for our marvellous project
### Languages
- Php / 8.1
- Markdown
### Software
- PhpStorm / 2022.2
- IceScrum
- Github
- Chromium
### Server
- Apache
### Database
- MariaDB 10.9
- HeidiSQL
- MCD : Draw.io
- MLD : MySQL Workbench 8.0 CE
___
## Installation
## Local installation (for development)
### Prerequisites:
- Have a `Php` and `Mariadb` service installed and be able to reach them in a shell (test `php -v` and `mariadb -v` to verify. Successful verification if the command is recognized.
- Have the **PDO** extension activated on the Php server (change `;extension=pdo_mysql` to `extension=pdo_mysql` in the `php.ini` file or verify that it is already done).
### Procedure:
1. **Get the repository** from GitHub (clone or `.zip` download) (example clone in a shell in the `C:/Alice/Documents/GitHub/` folder)

        VS:
        cd C:/Alice/Documents/GitHub/
        git clone https://github.com/CPNV-ES/MAW1-BPT-SMD.git

1. Open a shell and **install the dependencies** with [`npm`](https://www.npmjs.com/get-npm), as well as the PHP packages (with `Composer`) in the ` folder app! A `node_modules` folder and a `package-lock.json` file appear.

        cd app
        npm install
        composer install

1. Start the MySQL service. Log in (with an SQL client for example) as the `root` account. Execute the `db/db-manage/create-db-kanff.sql` file, which will **create the `kanff` database** and its tables. Then **create a new user** (named here `kanffApp` with `Pa$$w0rd` for password) and give him access to the previously created `kanff` database. Connect to the new user to verify that it has been created and that it has access to the `kanff` database.
1. Go to `app`. Duplicate the `.const.php.example` file and rename it to `.const.php`.
1. Start an IDE at the root of the repository. Modify the values ​​of the `.const.php` file in order to **register the identifiers** of connection to the database (4 values ​​+ a cartridge).

        $user = "kanffApp";
        $pass = "Pa\$\$w0rd"; //Special php characters must be preceded by \
        $dbhost = "localhost";
        $dbname = "kanff";

1. Run the `db/db-manage/restore-db-kanff.bat` file (or run the `php -f restore-db.php` command in `db/db-manage/`) to * *insert data** from the "Collective Assoc Vaud" pack. The database is now created. This .bat script is useful for very quickly restoring the database during development or testing.
1. Start a PHP server **in the `app`** folder (not the repository root folder!) on a free port (here 8080).
1. **Open a web browser** on the localhost address and the chosen port: `localhost:8080`.
1. **Validation**: The installation is complete when the site is displayed correctly in the browser (login page displayed and CSS style similar to the version of the [test server](https://kanff.mycpnv. ch)) and when the login works.
___

## ExerciseLooper features

### Exercise building

- [ ] Create a new blank exercise with a title
- [ ] Add a new field with a title and a value type
- [ ] Edit an existing field to either rename it or change the value type
- [ ] Destroy an existing field

### Exercise taking

- [ ] List the exercises that are ready for answers
- [ ] Take an exercise to see all the fields
- [ ] Answer the taken exercise by filling the fields
- [ ] Update the existing answers for a taken exercise

### Exercise management

- [ ] List all the exercises in 3 columns based on their state
- [ ] Destroy an exercise (only when building or closed)
- [ ] Change state of an exercise through icon buttons
- [ ] Stats for an exercise: show the recap (all takes, all fields)
- [ ] Stats for an exercise: show the answers of all fields of one take
- [ ] Stats for an exercise: show the answers on one field of all takes
___