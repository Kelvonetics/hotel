
<template>

    <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

    <div class="row">
          <div class="col-xl-2 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px"> Room Types 

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

              <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addRoomTypeModal" data-toggle="modal" 
              data-original-title="Add New RoomType" @click="clearForm()">    <i class="icon wb-plus" aria-hidden="true"></i>
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
                              <th>Room Type Name</th>
                              <th style="text-align: right;">Action</th>
                            </tr>
                          </thead>
                          <tbody v-for="room_type in filteredRoomTypes" v-bind:key="room_type.id">
                            <tr style="background: #fff">
                              <td>{{room_type.id}}</td>
                              <td>{{room_type.room_name}}</td>
                              <td style="text-align: right;">

                                  <a class="pull-right" data-toggle="modal" data-target="#addRoomTypeModal" @click="editRoomType(room_type)"> 
                                      <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #202020"></span>
                                  </a>
                                  
                                  <a class="pull-right" @click="deleteRoomType(room_type.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span> </a>
                              </td>
                            </tr>
                          </tbody>
                      </table>
                  

                      <nav aria-label="Page navigation example pull-right">
                          <ul class="pagination pagination-sm">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchRoomTypes(pagination.prev_page_url)">Prev</a></li>
                            <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchRoomTypes(pagination.next_page_url)">Next</a></li>
                          </ul>
                      </nav>
                  </div>


                <!-- Modal -->
                <form @submit.prevent="addRoomType" class="form-horizontal">
                    <div class="modal fade modal-just-me" id="addRoomTypeModal" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1" style="">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">X</span>  </button>
                            <h4 class="modal-title">New Room Type</h4>
                          </div>

                          <div class="modal-body">

                                 <div class="example-wrap">
                                      <div class="example">

                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Room Type Name </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="room_type.room_name" required/>
                                            </div>
                                          </div>
                                            
                                                    

                                          <div class="form-group row">
                                            <div class="col-md-3 offset-md-0">
                                              <button type="reset" class="btn btn-default btn-outline">Reset</button>
                                            </div>
                                            <div class="col-md-5 offset-md-0">

                                            </div>
                                            <div class="col-md-4 offset-md-0">
                                              <button type="submit" class="btn btn-primary pull-right">Create New Room Type </button>
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
                allRoomTypes: [],
                search: '',
                room_types: [], 
                room_type: {
                    id: '',
                    room_name: ''
                },
                room_type_id: '',
                pagination: {},
                edit: false
            }
        },


        created()
        {
            this.fetchAllRoomTypes();
            this.fetchRoomTypes();
        },

        computed: {
            filteredRoomTypes: function()
            {
                return this.room_types.filter((room_type) => {
                    return room_type.room_name.toLowerCase().match(this.search.toLowerCase()) 
                });
            }
        },

        methods:{

            fetchAllRoomTypes(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/room_types?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allRoomTypes = res.data;
                })
                .catch(err => console.log(err));
            },


            fetchRoomTypes(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/room_types'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.room_types = res.data;
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

            deleteRoomType(id)
            {
                if(confirm('Are You Sure You Want To Delete This Room Type ?'))
                {
                    fetch(`api/room_type/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success('Room Type Record Has Been Deleted Successfully');
                        this.fetchRoomTypes();
                    })
                    .catch(err => console.log(err));
                }
            },

            addRoomType()
            {
                if(this.edit === false)
                {
                    fetch('api/room_type', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.room_type),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        toastr.success('Room Type Record Has Been Created Successfully');
                        this.fetchRoomTypes();
                    })
                    .catch(err => console.log(err)); 
                    $('#addRoomTypeModal').trigger('click');

                }
                else
                {
                    fetch('api/room_type', 
                    {
                        method: 'put',
                        body: JSON.stringify(this.room_type),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        toastr.success('Room Type Record Has Been Updated Successfully');
                        this.fetchRoomTypes();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                    $('#addRoomTypeModal').trigger('click');
                }
            },

            editRoomType(room_type)
            {
                this.edit = true;
                this.room_type.id = room_type.id;
                this.room_type.room_type_id = room_type.id;
                this.room_type.room_name = room_type.room_name;
            },



            clearForm()
            {
                this.room_type.id = '';
                this.room_type.room_type_id = '';
                this.room_type.room_name = '';
            },




        }
    };


</script>

