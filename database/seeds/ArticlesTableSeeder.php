<?php

use Illuminate\Database\Seeder;
use \App\Booking;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // factory(App\Article::class, 30)->create();
        $faker=Faker\Factory::create();
        
        $hotel=\App\Hotel::create(['name'=>$faker->company, 'address', 'city','state', 'country','zip_code', 'phone_number','email', 'images']);
        $room_type=\App\RoomType::create('room_name');
        $room=\App\Room::create(['room_name', 'hotel_id'=>$hotel->id, 'room_type_id'=>$roomtype->id,'room_image']);

        \App\Booking::create(['room_id'=>$room->id, 'start_date', 'end_date','cust_fullname', 'cust_email','total_night', 'total_price','user_id']);
    }
}
