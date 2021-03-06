<?php

use App\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<11;$i++)
        {
            $client = new Client();
            
            $client->id = $i;
            $client->name= 'name' . $i;
            $client->email= 'ahmed@gmail.com' . $i;  

            $client->created_at = now();  
            $client->updated_at = now();  

            $client->password = 'password' . $i;

            
            $client->save();
        }
    }
}
