
import Home from './components/Home.vue';
import Hotel from './components/Hotel.vue';
import Room from './components/Room.vue';
import RoomType from './components/RoomType.vue';
import PriceList from './components/PriceList.vue';
import Booking from './components/Booking.vue';
import calendar from './components/calendar.vue';

export default 
[

	{ path: '/home', component: Home },
	
	{path: '/hotel', component: Hotel},
	
	{path: '/room', component: Room},
	
	{path: '/room_type', component: RoomType},
	
	{path: '/price', component: PriceList},
	
	{path: '/booking', component: Booking},
	
	{path: '/calendar/:id', component: calendar}
]