<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Posts;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('users')->delete();

        $users = array(
                ['fname' => 'Jhoana', 'lname' => 'Oblimar', 'role' => 'admin', 'email' => 'jkoblimar@dynamicobjx.com', 'password' => Hash::make('secret')],
                ['fname' => 'Zach', 'lname' => 'Lavine', 'role' => 'author', 'email' => 'zlavine@gmail.com', 'password' => Hash::make('secret')],
                ['fname' => 'Aaron', 'lname' => 'Gordon', 'role' => 'subscriber', 'email' => 'agordon@gmail.com', 'password' => Hash::make('secret')],
        );

        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            User::create($user);
        }

        DB::table('posts')->delete();

        $author = DB::table('users')->where('fname', '=', 'Zach')->select('id')->first();

        $posts = array(
                ['title' => 'Jhoana', 'body' => '<h1>HELLO WORLD</h1>','author_id' => $author->id],
                ['title' => 'Jhoana2', 'body' => '<h1>HELLO WORLD2</h1>','author_id' => $author->id],
        );

        // Loop through each post above and create the record for them in the database
        foreach ($posts as $post)
        {
            Posts::create($post);
        }



        Model::reguard();

    }
}
