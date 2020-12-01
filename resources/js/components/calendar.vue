<style lang='scss'>

@import '~@fullcalendar/core/main.css';
@import '~@fullcalendar/daygrid/main.css';

</style>

<script>

import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'

import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'


export default 
{
  components: 
  {
    FullCalendar // make the <FullCalendar> tag available

    
  },
  data: function() 
  {
    return {
      calendarPlugins: [ // plugins must be defined in the JS
        dayGridPlugin,
        timeGridPlugin,
        interactionPlugin // needed for dateClick
      ],
      calendarWeekends: true,
      calendarEvents: [ // initial event data
    
      ],
      
      
      

                
    }
  },

  created()
        {
            this.getEvents();
        },

  methods: {
    toggleWeekends() 
    {
      this.calendarWeekends = !this.calendarWeekends // update a property
    },

    

    gotoPast() 
    {
      let calendarApi = this.$refs.fullCalendar.getApi() // from the ref="..."
      calendarApi.gotoDate('2000-01-01') // call a method on the Calendar object
    },

    handleDateClick(arg) 
    {

        
        $('#BookingDetailsModal').modal('show');
        // this.showModal();
    //   if (confirm('Date : ' + arg.dateStr + ' <br>')) 
    //   {

          
    //     // add new event data
    //     this.calendarEvents.push(
    //         { 
    //             title: 'New Event',
    //             start: arg.date,
    //             allDay: arg.allDay
    //         })
    //   }

    },

    showModal() 
    {
        $('#BookingDetailsModal').modal('show');
    },

    getEvents()
    {
        fetch('/api/bookings/calendar')
        .then(res => res.json())
        .then(res => {
            this.calendarEvents = res.data;
        })
        .catch(err => console.log(err));
    }
  }
}




</script>

<template> 

<div class="page" style="padding: -25px 0px 0px 0px;">

    <div class="page-content">

        <div class="row">
            <div class="col-md-12" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px"> Calendar  </h2> 
                <div class="panel" style="padding:15px 20px">

                    <FullCalendar class='demo-app-calendar' ref="fullCalendar" defaultView="dayGridMonth"
                                  :header="{left: 'prev,next today', center: 'title', right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'}"
                                  :plugins="calendarPlugins"
                                  :weekends="calendarWeekends"
                                  :events="calendarEvents"
                                  @dateClick="handleDateClick" />                    

                </div>
            </div>
            
           
        </div>
    </div>

    <!-- <button class="btn btn-info" data-target="#BookingDetailsModal" data-toggle="modal">show</button> -->

    <div class="modal fade modal-3d-slit" id="BookingDetailsModal" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1" style="">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">X</span>  </button>
            <h4 class="modal-title"> Booking Details</h4>
            </div>

            <div class="modal-body">

                    <div class="example-wrap">
                        <div class="example">
                            

                            <div class="form-group row">
                                <label class="col-md-3 control-label"> Customer </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control round" autocomplete="off" readonly value="" />
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-3 control-label"> Date </label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control round" autocomplete="off" readonly value="" />
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-3 control-label"> Price </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control round" autocomplete="off" readonly value="" />
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <div class="col-md-3 offset-md-9">
                                    <button type="reset" class="btn btn-danger btn-outline pull-right">Close</button>
                                </div>
                            <div class="col-md-5 offset-md-0">

                            </div>
                            </div>




                        </div>
                    </div>

            </div>

        </div>
        </div>
    </div>

</div>

</template>





