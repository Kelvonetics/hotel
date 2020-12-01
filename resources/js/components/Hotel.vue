
<template>

    <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

    <div class="row">
          <div class="col-xl-2 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px"> Hotels 

              <!-- <button class="btn btn-sm pull-right" style="border:thin line black; background:#202020; color:#fff;" @click="exportPDF"><i class="fa fa-file-excel-o"> </i>  </button> -->
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
              <!-- <staffExcelExport :data="allStaffs" :file_name="'All Staff'"></staffExcelExport> -->           

              <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addHotelModal" data-toggle="modal" 
              data-original-title="Add New Hotel" @click="clearForm()">    <i class="icon wb-plus" aria-hidden="true"></i>
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
                              <th>Name</th>
                              <th>Address</th>
                              <th>City</th>
                              <th>State</th>
                              <th>Country</th>
                              <th>Zip Code</th>
                              <th>Phone Number</th>
                              <th>Email</th>
                              <th>Photo</th>
                              <th style="text-align: right;">Action</th>
                            </tr>
                          </thead>
                          <tbody v-for="hotel in filteredHotels" v-bind:key="hotel.id">
                            <tr style="background: #fff">
                              <td>{{hotel.id}}</td>
                              <td>{{hotel.name}}</td>
                              <td>{{hotel.address}}</td>
                              <td>{{hotel.city}}</td>
                              <td>{{hotel.state}}</td>
                              <td>{{hotel.country}}</td>
                              <td>{{hotel.zip_code}}</td>
                              <td>{{hotel.phone_number}}</td>
                              <td>{{hotel.email}}</td>
                              <td><img :src="getHotelPhoto()" alt="avatar" style="width:10;height:0;"> </td>
                              <td style="text-align: right;">

                                  <a class="pull-right" data-toggle="modal" data-target="#addHotelModal" @click="editHotel(hotel)"> 
                                      <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #202020"></span>
                                  </a>
                                  
                                  <a class="pull-right" @click="deleteHotel(hotel.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span> </a>
                              </td>
                            </tr>
                          </tbody>
                      </table>
                  

                      <nav aria-label="Page navigation example pull-right">
                          <ul class="pagination pagination-sm">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchHotels(pagination.prev_page_url)">Prev</a></li>
                            <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchHotels(pagination.next_page_url)">Next</a></li>
                          </ul>
                      </nav>
                  </div>


                <!-- Modal -->
                <form @submit.prevent="addHotel" class="form-horizontal">
                    <div class="modal fade modal-just-me" id="addHotelModal" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1" style="">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">X</span>  </button>
                            <h4 class="modal-title">New Hotel</h4>
                          </div>

                          <div class="modal-body">



                                 <div class="example-wrap">
                                      <div class="example">

                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Name </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="hotel.name" required/>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Address </label>
                                            <div class="col-md-9">
                                              <textarea rows="2" class="form-control round" autocomplete="off" v-model="hotel.address" required></textarea>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">City </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="hotel.city" required/>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">State </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="hotel.state" required/>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Country </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="hotel.country" required/>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Zip Code </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="hotel.zip_code" required/>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label"> Phone Number </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="hotel.phone_number" required/>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Email </label>
                                            <div class="col-md-9">
                                              <input type="email" class="form-control round" autocomplete="off" v-model="hotel.email" required>
                                            </div>
                                          </div>
                                            
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Photo </label>
                                            <div class="col-md-9">
                                              <input type="file" class="form-control round" name="image" placeholder="Photo" autocomplete="off" multiple="" @change="getImage"/>
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
                                              <button type="submit" class="btn btn-primary pull-right">Create New Hotel </button>
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

   import jsPDF from 'jspdf';
   // eslint-disable-next-line
   import autoTable from 'jspdf-autotable';


    export default
    {
        data()
        {
            return{
                allHotel: [],
                search: '',
                hotels: [], 
                hotel: {
                    id: '',
                    name: '',
                    address: '',
                    city: '',
                    state: '',
                    country: '',
                    zip_code: '',
                    phone_number: '',
                    email: '',
                    image: ''
                },
                hotel_id: '',
                pagination: {},
                avatar: null,
                edit: false
            }
        },


        created()
        {
            this.fetchAllHotels();
            this.fetchHotels();
        },

        computed: {
            filteredHotels: function()
            {
                return this.hotels.filter((hotel) => {
                    return hotel.name.toLowerCase().match(this.search.toLowerCase()) || 
                           hotel.address.toLowerCase().match(this.search.toLowerCase()) || 
                           hotel.city.toLowerCase().match(this.search.toLowerCase()) || 
                           hotel.state.toLowerCase().match(this.search.toLowerCase()) || 
                           hotel.country.toLowerCase().match(this.search.toLowerCase()) || 
                        //    hotel.zip_code.toLowerCase().match(this.search.toLowerCase()) ||
                           hotel.phone_number.toLowerCase().match(this.search.toLowerCase())  ||
                           hotel.email.toLowerCase().match(this.search.toLowerCase())
                });
            }
        },

        methods:{
            getImage(e)
            {
                let image = e.target.files[0];
                let reader = new FileReader();    
                reader.readAsDataURL(image);
                reader.onload = e =>{
                    this.avatar = e.target.result;
                    this.hotel.image = e.target.result;
                }

            },

            getHotelPhoto()
            {
                return "images/uploads/"+ this.hotel.image;
            },


            fetchAllHotels(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/hotels?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allHotels = res.data;
                })
                .catch(err => console.log(err));
            },


            fetchHotels(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/hotels'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.hotels = res.data;
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

            deleteHotel(id)
            {
                if(confirm('Are You Sure You Want To Delete This Hotel ?'))
                {
                    fetch(`api/hotel/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success('Hotel Record Has Been Deleted Successfully');
                        this.fetchHotels();
                    })
                    .catch(err => console.log(err));
                }
            },

            addHotel()
            {
                if(this.edit === false)
                {
                    fetch('api/hotel', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.hotel),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm()
                        toastr.success('Hotel Record Has Been Created Successfully');
                        this.fetchHotels();
                    })
                    .catch(err => console.log(err)); 
                    $('#addHotelModal').trigger('click');

                }
                else
                {
                    fetch('api/hotel', 
                    {
                        method: 'put',
                        body: JSON.stringify(this.hotel),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        toastr.success('Hotel Record Has Been Updated Successfully');
                        this.fetchHotels();
                        this.edit = false;
                        console.log(this.edit);
                    }) 
                    .catch(err => console.log(err));
                    $('#addHotelModal').trigger('click');
                }
            },

            editHotel(hotel)
            {
                this.edit = true;
                this.hotel.id = hotel.id;
                this.hotel.hotel_id = hotel.id;
                this.hotel.name = hotel.name;
                this.hotel.address = hotel.address;
                this.hotel.city = hotel.city;
                this.hotel.state = hotel.state;
                this.hotel.country = hotel.country;
                this.hotel.zip_code = hotel.zip_code;
                this.hotel.phone_number = hotel.phone_number;
                this.hotel.email = hotel.email;
                this.hotel.image = hotel.image;
            },



            clearForm()
            {
                this.hotel.id = '';
                this.hotel.hotel_id = '';
                this.hotel.name = '';
                this.hotel.address = '';
                this.hotel.city = '';
                this.hotel.state = '';
                this.hotel.country = '';
                this.hotel.zip_code = '';
                this.hotel.phone_number = '';
                this.hotel.email = '';
                this.hotel.image = '';
            },

            exportPDF()
            {
                var vm = this
                var columns = [
                    {id: "hotel_id", dataKey: "hotel_id"},
                    {name: "name", dataKey: "name"},
                    {address: "address", dataKey: "address"},
                    {city: "city", dataKey: "city"},
                    {state: "state", dataKey: "state"},
                    {country: "country", dataKey: "country"},
                    {zip_code: "zip_code", dataKey: "zip_code"},
                    {phone_number: "phone_number", dataKey: "phone_number"},
                    {email: "email", dataKeygender: "email"},
                    {image: "image", dataKey: "image"}
                ];

                var doc = new jsPDF('p', 'pt');
                doc.autoTable(columns, vm.allHotels );
                doc.save('Hotels.pdf');
            },




        }
    };


</script>

