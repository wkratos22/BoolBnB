<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = config( 'habitation_tags' );

        foreach($tags as $tag){
            $new_tag = new Tag();
            $new_tag->label = $tag['label'];
            $new_tag->icon = $tag['icon'];
            $new_tag->save();
        };

    }
}
