# Poker Hands

Created using Laravel 7.* and Bootstrap.<br/>
Main functions:
<ul>
<li>User can login.</li>
<li>User upload a file with matches, which will be saved into a database.</li>
<li>There is a list with uploaded matches, which shows winner.</li>
<li>There is a way for user to know how many matches are won.</li>
</ul>

## Installation instructions
Repository already contains basic framework installation / file structure (except vendor, of course).
Once pulled, have to execute <code>composer install</code>.
Once that is done, execute <code>php artisan start:setup</code>. It will create local config files, db, ask for default 
user info and eventually will start the development server.

Additionally, development server can be accessed by executing <code>php artisan serve --port=9000</code> (assuming that port 9000 is
available).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
