<?php
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



//parameter throw url
Route::get('/parameter/{email}/{password}', function ($email,$password) {
    return 'this is the email: '.$email.' and password: '.$password;
});

Route::get('/checking/{name}', '\App\Http\Controllers\userController@index');
Route::resource('user/','\App\Http\Controllers\userController');


// ineract with database
Route::get('/insert',function(){

    DB::insert('insert into posts (id, title, content) values (?, ?, ?)', [3,'mohmmed', 'Dayle']);

    return Post::all();
});


/* eloquent ORM */

// get from database
Route::get('/hello', function () {

    $post=Post::all();

    return $post;
});

Route::get('/where',function(){

$post=Post::where('id',2)->orderBy('id','desc')->take(1)->get();

return $post;
});


//insert into database
Route::get('/insertorm',function(){

// Post::create(['title'=>'sfafa','content'=>'hello i amfaf ahmed']);

User::create(['name'=>'hljlkjlj','email'=>'ali@gmail.com','password'=>'123']);


});

//update record
Route::get('/update',function(){

    Post::where('id',1)->update(['title'=>'ibraheem','content'=>'hello i am ibraheem']);


});



/* eloquent relationships */

//one to one relationship
Route::get('/relationships/onetoone',function(){

   return User::find(1)->post;
});

Route::get('/relationrevers/onetoone',function(){

    return Post::find(3)->user->name;
 });


 //one to many relationship
Route::get('relationships/onetomany',function(){

   $userPosts= User::find(1)->posts;
foreach($userPosts as $userPost){

    echo $userPost . "<br>";
};


});



//many to many

Route::get('relationships/manytomany',function(){

    $userRoles=User::find(1)->roles;



     return $userRoles;


});

// access to pivot table
Route::get('relationships/pivot',function(){

    $userRoles=User::find(1)->roles;

    foreach($userRoles as $userrole){

        return $userrole->pivot->user_id;
    }

});
