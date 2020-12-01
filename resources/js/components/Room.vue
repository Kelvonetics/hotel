
<template>

    <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

    <div class="row">
          <div class="col-xl-2 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px"> Rooms 

            </h2> 
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

              <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addRoomModal" data-toggle="modal" 
              data-original-title="Add New Room" @click="clearForm()">    <i class="icon wb-plus" aria-hidden="true"></i>
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
                              <th>Room Name</th>
                              <th>Room Type</th>
                              <th>Hotel</th>
                              <th>Photo</th>
                              <th style="text-align: right;">Action</th>
                            </tr>
                          </thead>
                          <tbody v-for="room in filteredRooms" v-bind:key="room.id">
                            <tr style="background: #fff">
                              <td>{{room.id}}</td>
                              <td>{{room.room_name}}</td>
                              <td>{{room.room_type.room_name}}</td>
                              <td>{{room.hotel.name}}</td>
                              <td><img :src="getHotelPhoto()" alt="avatar" style="width:10;height:0;"> </td>
                              <td style="text-align: right;">

                                  <a class="pull-right" data-toggle="modal" data-target="#addRoomModal" @click="editRoom(room)"> 
                                      <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #202020"></span>
                                  </a>
                                  
                                  <a class="pull-right" @click="deleteRoom(room.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span> </a>
                              </td>
                            </tr>
                          </tbody>
                      </table>
                  

                      <nav aria-label="Page navigation example pull-right">
                          <ul class="pagination pagination-sm">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchRooms(pagination.prev_page_url)">Prev</a></li>
                            <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchRooms(pagination.next_page_url)">Next</a></li>
                          </ul>
                      </nav>
                  </div>


                <!-- Modal -->
                <form @submit.prevent="addRoom" class="form-horizontal">
                    <div class="modal fade modal-just-me" id="addRoomModal" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1" style="">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">X</span>  </button>
                            <h4 class="modal-title">New Room</h4>
                          </div>

                          <div class="modal-body">

                                 <div class="example-wrap">
                                      <div class="example">

                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Room Name </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="room.room_name" required/>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Room Type </label>
                                            <div class="col-md-9">
                                              <select class="form-control" v-model="room.room_type_id" required>
                                                  <option value=""> Select Room Type </option>
                                                  <option v-for="room_type in room_types" v-bind:key="room_type.id" v-bind:value="room_type.id"> {{ room_type.room_name }} </option>
                                              </select>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Hotel </label>
                                            <div class="col-md-9">
                                              <select class="form-control" v-model="room.hotel_id" required>
                                                  <option value=""> Select Hotel </option>
                                                  <option v-for="hotel in hotels" v-bind:key="hotel.id" v-bind:value="hotel.id"> {{ hotel.name }} </option>
                                              </select>
                                            </div>
                                          </div>
                                            
                                          
                                            
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Photo </label>
                                            <div class="col-md-9">
                                              <input type="file" class="form-control round" name="room_image" placeholder="Photo" autocomplete="off" multiple="" @change="getImage"/>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Preview </label>
                                            <div class="col-md-9">
                                              <img :src="avatar" alt="Preview" style="max-width: 200px; max-height: 100px">
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <div class="col-md-3 offset-md-0">
                                              <button type="reset" class="btn btn-default btn-outline">Reset</button>
                                            </div>
                                            <div class="col-md-5 offset-md-0">

                                            </div>
                                            <div class="col-md-4 offset-md-0">
                                              <button type="submit" class="btn btn-primary pull-right">Create New Room </button>
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
                allRooms: [],
                search: '',
                hotels: [],
                room_types: [],
                rooms: [], 
                room: {
                    id: '',
                    room_name: '',
                    room_type_id: '',
                    hotel_id: '',
                    room_image: ''
                },
                room_id: '',
                pagination: {},
                avatar: null,
                edit: false
            }
        },


        created()
        {
            this.fetchAllRooms();
            this.fetchRooms();
            this.fetchHotels();
            this.fetchRoomTypes();
        },

        computed: {
            filteredRooms: function()
            {
                return this.rooms.filter((room) => {
                    return room.room_name.toLowerCase().match(this.search.toLowerCase()) 
                          //  room.hotel.name.toLowerCase().match(this.search.toLowerCase()) || 
                          //  room.room_type.room_type_name.toLowerCase().match(this.search.toLowerCase()) 
                });
            }
        },

        methods:{
            getImage(e)
            {
                let room_image = e.target.files[0];
                let reader = new FileReader();    
                reader.readAsDataURL(room_image);
                reader.onload = e =>{
                    this.avatar = e.target.result;
                    this.room.room_image = e.target.result;
                }

            },

            getHotelPhoto()
            {
                //return "images/uploads/"+ this.hotel.image;
            },


            fetchAllRooms(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/rooms?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allRooms = res.data;
                })
                .catch(err => console.log(err));
            },


            fetchRooms(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/rooms'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.rooms = res.data;
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

            deleteRoom(id)
            {
                if(confirm('Are You Sure You Want To Delete This Room ?'))
                {
                    fetch(`api/room/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success('Room Record Has Been Deleted Successfully');
                        this.fetchRooms();
                    })
                    .catch(err => console.log(err));
                }
            },

            addRoom()
            {
                if(this.edit === false)
                {
                    fetch('api/room', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.room),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        toastr.success('Room Record Has Been Created Successfully');
                        this.fetchRooms();
                    })
                    .catch(err => console.log(err)); 
                    $('#addRoomModal').trigger('click');

                }
                else
                {
                    fetch('api/room', 
                    {
                        method: 'put',
                        body: JSON.stringify(this.room),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        toastr.success('Room Record Has Been Updated Successfully');
                        this.fetchRooms();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                    $('#addRoomModal').trigger('click');
                }
            },

            editRoom(room)
            {
                this.edit = true;
                this.room.id = room.id;
                this.room.room_id = room.id;
                this.room.room_name = room.room_name;
                this.room.hotel_id = room.hotel_id;
                this.room.room_type_id = room.room_type_id;
                this.room.room_image = room.room_image;
            },



            clearForm()
            {
                this.room.id = '';
                this.room.room_id = '';
                this.room.room_name = '';
                this.room.hotel_id = '';
                this.room.room_type_id = '';
                this.room.room_image = '';
            },





            fetchHotels()
            {
                let hotels = '/api/hotels'
                fetch(hotels)
                .then(res => res.json())
                .then(res => {
                    this.hotels = res.data;
                })
                .catch(err => console.log(err));            
            },

            fetchRoomTypes()
            {
                let room_types = '/api/room_types'
                fetch(room_types)
                .then(res => res.json())
                .then(res => {
                    this.room_types = res.data;
                })
                .catch(err => console.log(err));            
            },


        }
    };


</script>

