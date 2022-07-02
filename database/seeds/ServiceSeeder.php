<?php

use Illuminate\Database\Seeder;

use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $services = config( 'habitation_services' );

        foreach($services as $service){
            $new_service = new Service();
            $new_service->label = $service['label'];
            $new_service->icon = $service['icon'];
            $new_service->save();
        };
    }
}
