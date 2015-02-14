<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('patient/home');
});

/* Patient */

Route::get('/patient', function()
{
	return View::make('patient/home');
});

Route::get('/signup', array('before' => 'guest', function() {
            return View::make('sign_up');
        }
    )
);

Route::post('/signup', 
    array(
        'before' => 'csrf', 
        function() {
        	$user = new User;
            $user->name = Input::get('name');
            $user->email    = Input::get('email');
            $user->password = Hash::make(Input::get('password'));

   //          $user = new User;
   //          $user->email    = Input::get('email');
   //          $user->password = Hash::make(Input::get('password'));
       
			// $user->first_name = Input::get('first_name');
   //          $user->last_name = Input::get('last_name');
   //          $user->dentist_id = 1;
   //          $user->chart_number = 1;
   //          $user->phone = 1;
   //          $user->address = 1;
            # Try to add the user 
            try {
                $user->save();
            }
            # Fail
            catch (Exception $e) {
                //return Redirect::to('/signup')->with('flash_message', 'Sign up failed; please try again.')->withInput();
            	var_dump($user);
            }	

        	$patient = new Patient;
            $patient->first_name = Input::get('name');
            $patient->email    = Input::get('email');
            $patient->save();

            # Log the user in
            Auth::login($user);

            return Redirect::to('/patient')	;

        }
    )
);

Route::get('/login',
    array(
        'before' => 'guest',
        function() {
            return View::make('log_in');
        }
    )
);

Route::post('/login', 
    array(
        'before' => 'csrf', 
        function() {

            $credentials = Input::only('email', 'password');

            if (Auth::attempt($credentials, $remember = true)) {
                return Redirect::intended('/patient')->with('flash_message', 'Welcome Back!');
            }
            else {
                return Redirect::to('/login')->with('flash_message', 'Log in failed; please try again.');
            }

            return Redirect::to('login');
        }
    )
);

Route::get('/logout', function() {

    # Log out
    Auth::logout();

    # Send them to the homepage
    return Redirect::to('/patient');

});


/* Routes for Development */

Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

Route::get('/trigger-error',function() {

    # Class Foobar should not exist, so this should create an error
    $foo = new Foobar;

});

Route::get('mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    var_dump($results);

});

Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});