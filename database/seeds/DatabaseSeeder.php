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
                ['title' => 'Jhoana', 'body' => '<h1>HELLO WORLD2</h1>','author_id' => $author->id],
                ['title' => 'Man must explore, and this is exploration at its greatest',
                  'subheading' => 'Problems look mighty small from 150 miles up' ,
                  'body' => "<p>Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe, a round earth in which all the directions eventually meet, in which there is no center because every point, or none, is center — an equal earth which all men occupy as equals. The airman\'s earth, if free men make it, will be truly round: a globe in practice, not in theory.</p><p>Science cuts two ways, of course; its products can be used for both good and evil. But there\'s no turning back from science. The early warnings about technological dangers also come from science.</p>",
                  'author_id' => $author->id],
                 ['title' => 'Failure is not an option',
                  'subheading' => 'Many say exploration is part of our destiny, but it’s actually our duty to future generations.' ,
                  'body' => "<p>Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe, a round earth in which all the directions eventually meet, in which there is no center because every point, or none, is center — an equal earth which all men occupy as equals. The airman\'s earth, if free men make it, will be truly round: a globe in practice, not in theory.</p><p>Science cuts two ways, of course; its products can be used for both good and evil. But there\'s no turning back from science. The early warnings about technological dangers also come from science.</p>",
                  'author_id' => $author->id],
        );

        // Loop through each post above and create the record for them in the database
        foreach ($posts as $post)
        {
            Posts::create($post);
        }



        Model::reguard();

    }
}
