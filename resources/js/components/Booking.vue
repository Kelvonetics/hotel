
<template>

    <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

    <div class="row">
          <div class="col-xl-2 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px">
            <h2 style="margin-top: -1px"> Bookings </h2> 
          </div>
          <div class="col-xl-3 col-md-3 col-sm-3" style="text-align: left; padding-bottom: 0px"> 
              <div class="form-group">
                  <div class="input-search">
                    <button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
                    <input type="text" class="form-control pull-right" placeholder="Search" v-model="search" />
                  </div>
              </div>
          </div>              
          <div class="col-xl-7 col-md-2 col-sm-3" style="text-align: right; padding-bottom: 0px">           

              <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addBookingModal" data-toggle="modal" 
              data-original-title="Add New Booking" @click="clearForm()">    <i class="icon wb-plus" aria-hidden="true"></i>
              </button>              
          </div>
      </div>

    

      <div class="panel" style="margin-top: -10px">
        <div class="row page-content">
          <div class="col-md-12">


            <!-- Example Basic -->
              <div class="example-wrap">
                <div class="page-header" style="padding: 0px 0px 1px 0px; margin-top: -20px">

                  <div class="table-responsive">
                      <table class="table table-striped table-hover table-sm">
                          <thead class="thead-dark">
                            <tr>
                              <th>#</th>
                              <th>Room</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Customer Name</th>
                              <th>Customer email</th>
                              <th>Total Night</th>
                              <th>Total Price</th>
                              <th>User</th>
                              <th style="text-align: right;">Action</th>
                            </tr>
                          </thead>
                          <tbody v-for="booking in filteredBookings" v-bind:key="booking.id">
                            <tr style="background: #fff">
                              <td>{{booking.id}}</td>
                              <td>{{booking.room.room_name}}</td>
                              <td>{{booking.start_date}}</td>
                              <td>{{booking.end_date}}</td>
                              <td>{{booking.cust_fullname}}</td>
                              <td>{{booking.cust_email}}</td>
                              <td>{{booking.total_night}}</td>
                              <td>{{booking.total_price}}</td>
                              <td>{{booking.user.name}}</td>
                              <td style="text-align: right;">

                                  <a class="pull-right" data-toggle="modal" data-target="#addBookingModal" @click="editBooking(booking)"> 
                                      <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #202020"></span>
                                  </a>
                                  
                                  <a class="pull-right"> 
                                    <router-link class="" v-bind:to="'/calendar/' + booking.id" style=""> 
                                      <span class="fa fa-calendar text-inverse m-r-10" style="margin :1px 2px; color: #396"></span> 
                                    </router-link> 
                                  </a>
                                  
                                  <a class="pull-right" @click="deleteBooking(booking.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span> </a>
                              </td>
                            </tr>
                          </tbody>
                      </table>
                  

                      <nav aria-label="Page navigation example pull-right">
                          <ul class="pagination pagination-sm">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchBookings(pagination.prev_page_url)">Prev</a></li>
                            <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchBookings(pagination.next_page_url)">Next</a></li>
                          </ul>
                      </nav>
                  </div>


                <!-- Modal -->
                <form @submit.prevent="addBooking" class="form-horizontal">
                    <div class="modal fade modal-just-me" id="addBookingModal" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1" style="">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">X</span>  </button>
                            <h4 class="modal-title">New Booking</h4>
                          </div>

                          <div class="modal-body">

                                 <div class="example-wrap">
                                      <div class="example">
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Room </label>
                                            <div class="col-md-9">
                                              <select class="form-control" v-model="booking.room_id" required>
                                                  <option value=""> Select Room </option>
                                                  <option v-for="room in rooms" v-bind:key="room.id" v-bind:value="room.id"> {{ room.room_name }} </option>
                                              </select>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Start Date </label>
                                            <div class="col-md-9">
                                              <input type="date" class="form-control round" autocomplete="off" v-model="booking.start_date" required/>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">End Date </label>
                                            <div class="col-md-9">
                                              <input type="date" class="form-control round" autocomplete="off" v-model="booking.end_date" required/>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Customer Name </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="booking.cust_fullname" required/>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Customer email </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="booking.cust_email" required/>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Total Night </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="booking.total_night" required readonly/>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Total Price </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="booking.total_price" required readonly/>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">User </label>
                                            <div class="col-md-9">
                                              <select class="form-control" v-model="booking.user_id">
                                                  <option value=""> Select User </option>
                                                  <option v-for="user in users" v-bind:key="user.id" v-bind:value="user.id"> {{ user.name }} </option>
                                              </select>
                                            </div>
                                          </div>
                                                                                    
                                          
                                            
                                            

                                          <div class="form-group row">
                                            <div class="col-md-3 offset-md-0">
                                              <button type="reset" class="btn btn-default btn-outline">Reset</button>
                                            </div>
                                            <div class="col-md-5 offset-md-0">

                                            </div>
                                            <div class="col-md-4 offset-md-0">
                                              <button type="submit" class="btn btn-primary pull-right">Create New Booking </button>
                                            </div>
                                          </div>




                                      </div>
                                    </div>

                            </div>

                        </div>
                      </div>
                    </div>
                </form>
                <!-- End Modal -->

              </div>
            </div>
          </div>

            
        </div>  

      </div>
    </div>


   </div>


</template>












<script>
    export default
    {
        data()
        {
            return{
                allBookings: [],
                search: '',
                rooms: [],
                users: [],
                bookings: [], 
                booking: {
                    id: '',
                    room_id: '',
                    start_date: '',
                    end_date: '',
                    cust_fullname: '',
                    cust_email: '',
                    total_night: '',
                    total_price: '',
                    user_id: ''
                },
                booking_id: '',
                pagination: {},
                edit: false
            }
        },


        created()
        {
            this.fetchAllBookings();
            this.fetchBookings();
            this.fetchRooms();
            this.fetchUsers();
        },

        computed: {
            filteredBookings: function()
            {
                return this.bookings.filter((booking) => {
                    return booking.start_date.toLowerCase().match(this.search.toLowerCase())  ||
                           booking.room.room_name.toLowerCase().match(this.search.toLowerCase())  ||
                           booking.end_date.toLowerCase().match(this.search.toLowerCase())  ||
                           booking.cust_fullname.toLowerCase().match(this.search.toLowerCase())  ||
                           booking.cust_email.toLowerCase().match(this.search.toLowerCase())  ||
                           booking.total_night.toLowerCase().match(this.search.toLowerCase())  ||
                           booking.total_price.toLowerCase().match(this.search.toLowerCase()) ||
                           booking.user.name.toLowerCase().match(this.search.toLowerCase()) 
                });
            }
        },

        methods:{

            fetchAllBookings(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/bookings?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allBookings = res.data;
                })
                .catch(err => console.log(err));
            },


            fetchBookings(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/bookings'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.bookings = res.data;
                    vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
            },
            makePagination(meta, links) 
            {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };

                this.pagination = pagination;
            },

            deleteBooking(id)
            {
                if(confirm('Are You Sure You Want To Delete This Booking Details ?'))
                {
                    fetch(`api/booking/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success('Booking Record Has Been Deleted Successfully');
                        this.fetchBookings();
                    })
                    .catch(err => console.log(err));
                }
            },

            addBooking()
            {
                if(this.edit === false)
                {
                    fetch('api/booking', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.booking),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        toastr.success('Booking Record Has Been Created Successfully');
                        this.fetchBookings();
                    })
                    .catch(err => console.log(err)); 
                    $('#addBookingModal').trigger('click');

                }
                else
                {
                    fetch('api/booking', 
                    {
                        method: 'put',
                        body: JSON.stringify(this.booking),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        toastr.success('Booking Record Has Been Updated Successfully');
                        this.fetchBookings();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                    $('#addBookingModal').trigger('click');
                }
            },

            editBooking(booking)
            {                
                this.edit = true;
                this.booking.id = booking.id;
                this.booking.booking_id = booking.id;
                this.booking.room_id = booking.room_id;
                this.booking.start_date = booking.start_date;
                this.booking.end_date = booking.end_date;
                this.booking.cust_fullname = booking.cust_fullname;
                this.booking.cust_email = booking.cust_email;
                this.booking.total_night = booking.total_night;
                this.booking.total_price = booking.total_price;
                this.booking.user_id = booking.user_id;
            },



            clearForm()
            {
                this.booking.id = '';
                this.booking.booking = '';
                this.booking.room_id = '';
                this.booking.start_date = '';
                this.booking.end_date = '';
                this.booking.cust_fullname = '';
                this.booking.cust_email = '';
                this.booking.total_night = '';
                this.booking.total_price = '';
                this.booking.user_id = '';
            },





            fetchRooms()
            {
                let rooms = '/api/rooms'
                fetch(rooms)
                .then(res => res.json())
                .then(res => {
                    this.rooms = res.data;
                })
                .catch(err => console.log(err));            
            },

            fetchUsers()
            {
                let users = '/api/users'
                fetch(users)
                .then(res => res.json())
                .then(res => {
                    this.users = res.data;
                })
                .catch(err => console.log(err));            
            },


        }
    };


</script>

