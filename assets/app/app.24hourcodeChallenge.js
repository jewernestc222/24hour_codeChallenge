
const {createApp} = Vue
createApp({
    data(){
        return{
            islog:0,
            attendance:[],
            leaves:[],
            location:'BKK',
            timer:[],
            employeecount:0,
            empimg:'user-dummy-img.jpg',
            leavescount:0,
            punch:'AM IN',
            ampm:'AM',
            empid:'',
            empname:'Employee Name',
            inout:'AMIN',
            today:'',
            isTimeoff:0
        }
    },
    methods:{

        async getLatLng(){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(this.showLatLng);
            } else {
                document.querySelector('#demo').innerHTML = "Geolocation is not supported by this browser.";
            }
        },
        async showLatLng(position){
            document.querySelector('#demo').innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
        },
        async getTime(e,timezone){
            clearInterval(this.timer);
            const vm = this;
            function timer(){
                
                
                
                if(window.navigator.onLine)
                {
                    // if(Swal.isVisible()){
                    //     Swal.close()
                    // }
                    

                    const data = new FormData;
                    data.append("method","getserverdatetime");
                    axios.post("handler/adminHandler.php",data)
                    .then((res)=>{
                        
                        const date = new Date(res.data[0]['dt'].date);
                        const options = {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };
                        const date3 = date.toLocaleDateString('en-IN', options);
                        
                        var date4 = new Date(res.data[0]['dt'].date)

                        var gettime = date4.toLocaleString('en-PH', {second:'numeric',minute:'numeric', hour: 'numeric', hour12: true,  timeZone: timezone })

                        document.querySelector(".datetoday").innerHTML = "<div class='timer'>" + gettime + "</div>";

                        vm.today = "Today: " + date3;

                        var t = moment(gettime, "h:mm:ss A").format("H");

                        // if(t >= 5 && t <= 12){
                        //     document.querySelector('.am-in').classList.remove('disabled');
                        //     document.querySelector('.am-out').classList.remove('disabled');
                        //     document.querySelector('.pm-in').classList.add('disabled');
                        //     document.querySelector('.pm-out').classList.add('disabled');
                            

                        // }
                        // else if(t >= 13){
                        //     document.querySelector('.pm-in').classList.remove('disabled');
                        //     document.querySelector('.pm-out').classList.remove('disabled');
                        //     document.querySelector('.am-in').classList.add('disabled');
                        //     document.querySelector('.am-out').classList.add('disabled');
                        // }

                        // if(t >= 5 && t <= 12){
                        //     vm.inout = 'AMIN'
                        //     vm.punch = 'IN'
                        // }
                        // else if(t >= 15){
                        //     vm.inout = 'PMUT'
                        //     vm.punch = 'OUT'
                        // }

                        

                        console.log(vm.inout);
                        
                    })
                }
                else{
                    if(!Swal.isVisible())
                    {
                        Swal.fire({
                            title: "OFFLINE",
                            text: "Please contact PLDT",
                            icon: "error",
                            showConfirmButton: false,
                            allowOutsideClick: false
                          });
                    }
                    
                }

                


                
            }
            this.timer = setInterval(timer,1000);

        },
        async setAttendance(e){
            if(e.key == 'Enter'){
                this.getEmployeeByPincode(this.empid);
            }
        },
        async getEmployeeByPincode(rfid){
            const vm = this;
            const data = new FormData;
            data.append("rfid",rfid);
            data.append("method","getEmployeeByPincode")
            await axios.post("handler/adminHandler.php",data)
            .then((res)=>{

                // console.log(res.data);

                if(res.data.length == 0){
                    vm.empid = "";
                    Swal.fire({
                        title: "Oooopppssss!!",
                        text: "ID Number not found. Please contact IT support",
                        icon: "error"
                      });

                }
                else{
                    res.data.forEach(function(i,v){
                        vm.empimg = i[0] + '.jpg';
                        vm.empname = i[1];
                        vm.location = i[3];
                        //console.log(vm.inout + " " + i[0]);
                        if(i[2] == 0){
                            Swal.fire({
                                title: "Oooopppssss!!",
                                text: "You are not allowed for a Telework. Please contact support",
                                icon: "error"
                              });
                              vm.empid = "";
                        }
                        else{
                            vm.setDTRlog(i[0],vm.inout);
                        }
                        
                    });
    
                    
                }
                


            })
        },

        async setDTRlog(empid,inout){
            const vm = this;
            const data = new FormData;
            data.append("empid",empid);
            data.append("inout",inout);
            data.append("method","setDTRlog");
            await axios.post("handler/adminHandler.php",data)
            .then((res)=>{
                vm.getDTRlog();
                vm.empid = "";
                var audio = new Audio("assets/thankyou.wav");
                audio.play();
            })
        },

        fnMinuteToHour:function(totalMinutes){
            var hours = Math.floor(totalMinutes / 60);        
            var minutes = totalMinutes % 60;
            return hours + "." + minutes;
        },
        fnGetTrueHour:function(hours){
            var h = hours.split(".");
            var hour = h[0];
            var minutes = h.length == 1 ? "0" : h[1];
            //console.log(hours);
            return ((hour < 0 ? Math.abs(hour) : hour) < 10 ? hour : hour) + "h " + (minutes) + "m";
            
        },

        async getDTRlog(){
            const vm = this;
            const data = new FormData;
            data.append('location',this.location);
            data.append("method","getDTRlogTelework")
            await axios.post("handler/adminHandler.php",data)
            .then((res)=>{
                var attendance = [];
                res.data.forEach(function(i,v){
                    attendance.push(
                        [
                            i[1],
                            moment(i[2]).format("DD MMM yyyy"),
                            i[3],
                            i[4],
                            i[5],
                            i[6],
                            i[13],
                            i[14],
                            vm.fnGetTrueHour(vm.fnMinuteToHour(i[7])),
                            vm.fnGetTrueHour(vm.fnMinuteToHour(i[8])),
                            i[9]
                        ]
                    )
                    if(i[12] > 0){
                        vm.isTimeoff = i[12];
                    }
                })

                if(vm.isTimeoff > 0){
                    vm.isTimeoff = "Time Off for " + vm.isTimeoff + "hour/s";
                }
                else{
                    vm.isTimeoff = "";
                }
                //console.log(attendance);
                vm.attendance.updateConfig({
                    data: attendance
                }).forceRender();
            })
        }

     
    },
    created(){
        this.getTime(this.location,'Asia/Bangkok');
        this.getDTRlog();
        this.getLatLng();
    },
    mounted(){
        
        const vm = this;

        document.body.addEventListener('click', function(){
            document.querySelector('.rfid-input').focus();
            // if (document.documentElement.requestFullscreen) {
            //     document.documentElement.requestFullscreen();
            // }
        }); 

        document.body.addEventListener('keydown',function(e){
            // e.preventDefault();
            console.log(e.key);
            if(e.key == 'F9' || e.key == 'AudioVolumeUp'){
                vm.inout = 'AMIN';
                vm.punch = 'AM IN';
            }
            else if(e.key == 'F10' || e.key == 'AudioVolumeDown'){
                vm.inout = 'AMUT';
                vm.punch = 'AM OUT';
            }
            else if(e.key == 'F2' || e.key == 'AudioVolumeDown'){
                vm.inout = 'PMIN';
                vm.punch = 'PM IN';
            }
            else if(e.key == 'F4' || e.key == 'AudioVolumeDown'){
                vm.inout = 'PMUT';
                vm.punch = 'PM OUT';
            }
            else if(e.key == 'F8'){
                vm.inout = 'OTIN';
                vm.punch = 'OT IN';
            }
            else if(e.key == 'Escape'){
                vm.inout = 'OTUT';
                vm.punch = 'OT OUT';
            }
        })

        document.querySelector('.rfid-input').focus();

        vm.attendance = new gridjs.Grid({
            columns: [
                "Employee Name","Date", "AM IN", "AM OUT", "PM IN", "PM OUT", "OT IN", "OT OUT", "Late", "Undertime", {name:"Time Schedule",hidden:true}],
            // pagination: { limit: 10 },
            search: false,
            sort:false,
            
            data: [],
        }).render(document.getElementById('dtr-log-table'));

        const x = document.getElementById("demo");

        
        
        

        
        

    }
}).mount('#layout-wrapper')



        
	    

        