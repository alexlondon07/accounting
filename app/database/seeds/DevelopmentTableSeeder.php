<?php

class DevelopmentTableSeeder extends Seeder {

    public function run() {

        //se ingresa el libro de darwin
        //DB::statement("INSERT INTO lor_lecture (title, author, year, publisher, content, created_at, updated_at, deleted_at) VALUES ('El origen de las especies', 'Charles Darwin', '1859', 'Dominio publico', 'temas vivos.', NOW(),NOW(), NULL);");
        $user = User::create(array(
                    'profile' => 'super_admin',
                    'firstname' => 'Alexander Andres Londono Espejo',
                    'username' => 'admin',
                    'email' => 'admin@admin.com',
                    'password' => Hash::make('admin'),
        ));
        $user->roles()->attach(1);
        $user->roles()->attach(2);
        $user->roles()->attach(3);
        $user->roles()->attach(4);
        $user->roles()->attach(5);
        $user->roles()->attach(6);
        $user->roles()->attach(7);
        $user->roles()->attach(8);
        $user->roles()->attach(9);
        $user->roles()->attach(10);
        $user->roles()->attach(11);
        $user->roles()->attach(12);

        $faker = Faker\Factory::create();
        $count_client = 5;
        foreach (range(1, $count_client) as $index) {
            $user = User::create([
                        'firstname' => $faker->firstName,
                        'lastname' => $faker->lastName,
                        'username' => 'admin' . $index,
                        'email' => $faker->email,
                        'identification' => $faker->numberBetween(19999999, 99999999),
                        'password' => Hash::make('admin' . $index),
            ]);
            $client = Client::create([
                        'name' => $faker->company,
                        'address' => 'Caucasia Antioquia',
                        'enable' => 'SI',
            ]);
    }
}

}
