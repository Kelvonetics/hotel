
<template>

    <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

    <div class="row">
          <div class="col-xl-2 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px"> Price Listing 

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

              <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addPriceListModal" data-toggle="modal" 
              data-original-title="Add New PriceList" @click="clearForm()">    <i class="icon wb-plus" aria-hidden="true"></i>
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
                              <th>Prices in USD</th>
                              <th>Room Type</th>
                              <th style="text-align: right;">Action</th>
                            </tr>
                          </thead>
                          <tbody v-for="price_list in filteredPriceLists" v-bind:key="price_list.id">
                            <tr style="background: #fff">
                              <td>{{price_list.id}}</td>
                              <td>{{price_list.price}}</td>
                              <td>{{price_list.room_type.room_name}}</td>
                              <td style="text-align: right;">

                                  <a class="pull-right" data-toggle="modal" data-target="#addPriceListModal" @click="editPriceList(price_list)"> 
                                      <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #202020"></span>
                                  </a>
                                  
                                  <a class="pull-right" @click="deletePriceList(price_list.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span> </a>
                              </td>
                            </tr>
                          </tbody>
                      </table>
                  

                      <nav aria-label="Page navigation example pull-right">
                          <ul class="pagination pagination-sm">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchPriceLists(pagination.prev_page_url)">Prev</a></li>
                            <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchPriceLists(pagination.next_page_url)">Next</a></li>
                          </ul>
                      </nav>
                  </div>


                <!-- Modal -->
                <form @submit.prevent="addPriceList" class="form-horizontal">
                    <div class="modal fade modal-just-me" id="addPriceListModal" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1" style="">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">X</span>  </button>
                            <h4 class="modal-title">New PriceList</h4>
                          </div>

                          <div class="modal-body">

                                 <div class="example-wrap">
                                      <div class="example">

                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Price </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="price_list.price" required/>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Room Type </label>
                                            <div class="col-md-9">
                                              <select class="form-control" v-model="price_list.room_type_id" required>
                                                  <option value=""> Select Room Type </option>
                                                  <option v-for="room_type in room_types" v-bind:key="room_type.id" v-bind:value="room_type.id"> {{ room_type.room_name }} </option>
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
                                              <button type="submit" class="btn btn-primary pull-right">Create New Price </button>
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
                allPriceLists: [],
                search: '',
                room_types: [],
                price_lists: [], 
                price_list: {
                    id: '',
                    price: '',
                    room_type_id: ''
                },
                price_list_id: '',
                pagination: {},
                edit: false
            }
        },


        created()
        {
            this.fetchAllPriceLists();
            this.fetchPriceLists();
            this.fetchRoomTypes();
        },

        computed: {
            filteredPriceLists: function()
            {
                return this.price_lists.filter((price_list) => {
                    return price_list.price.toLowerCase().match(this.search.toLowerCase()) 
                          //  price_list.room_type.room_type_name.toLowerCase().match(this.search.toLowerCase()) 
                });
            }
        },

        methods:{

            fetchAllPriceLists(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/price_lists?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allPriceLists = res.data;
                })
                .catch(err => console.log(err));
            },


            fetchPriceLists(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/price_lists'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.price_lists = res.data;
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

            deletePriceList(id)
            {
                if(confirm('Are You Sure You Want To Delete This PriceList ?'))
                {
                    fetch(`api/price_list/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success('Price Record Has Been Deleted Successfully');
                        this.fetchPriceLists();
                    })
                    .catch(err => console.log(err));
                }
            },

            addPriceList()
            {
                if(this.edit === false)
                {
                    fetch('api/price_list', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.price_list),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        toastr.success('PriceList Record Has Been Created Successfully');
                        this.fetchPriceLists();
                    })
                    .catch(err => console.log(err)); 
                    $('#addPriceListModal').trigger('click');

                }
                else
                {
                    fetch('api/price_list', 
                    {
                        method: 'put',
                        body: JSON.stringify(this.price_list),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        toastr.success('Price Record Has Been Updated Successfully');
                        this.fetchPriceLists();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                    $('#addPriceListModal').trigger('click');
                }
            },

            editPriceList(price_list)
            {                
                this.edit = true;
                this.price_list.id = price_list.id;
                this.price_list.price_list_id = price_list.id;
                this.price_list.price = price_list.price;
                this.price_list.room_type_id = price_list.room_type_id;
            },



            clearForm()
            {
                this.price_list.id = '';
                this.price_list.price_list = '';
                this.price_list.price = '';
                this.price_list.room_type_id = '';
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

