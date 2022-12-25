<img src="https://raw.githubusercontent.com/amitleuva1987/laravel_vue_live_chat/master/screenshot.jpg" style="max-width:200px">

<p>This is a Live chat project with multiple users using <b>Laravel 8</b> and <b>Vue JS 2.</b> </p>
<p>The application will have multiple users registered. Any registered user can login to the application and the user will see the other online users over the system. Online users can chat in the real time and online users can also post messages to the offline users. Offline users later can reply the messages, they have received from other users.  </p>

<h2>Installation</h2>

This project use Laravel/UI package for authentication. 

<h2>Database Configuration</h2>

To configure database settings, please replace '.env.example' file to .env file in the root directory.Find below code and enter your database name, username and password as shown below. 
<div style="background:#ccc">
<pre>
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=chat_project_2
DB_USERNAME=username
DB_PASSWORD=password
</pre>
</div>

After this, please run "php artisan migrate" from the console.

<h2>Setting up Pusher</h2>
Please create an account with <a href="https://pusher.com">pusher</a> and create an app with pusher. Then, update your pusher settings in .env file as shown in below code.

<div style="background:#ccc">
<pre>
PUSHER_APP_ID=id
PUSHER_APP_KEY=key
PUSHER_APP_SECRET=secreat
PUSHER_APP_CLUSTER=cluster
</pre>
</div>


<h2>Run the project</h2>
run the 'npm run dev' command along with 'php artisan serve' and open your browser and type http://localhost:8000
<div style="background:#ccc">
<pre>
npm run dev
php artisan serve
</pre>
</div>