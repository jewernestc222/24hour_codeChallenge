
const {createApp} = Vue
createApp({
    data(){
        return{
            pizzatype:[]
        }
    },
    methods:{
        async getDTRlog(){
            const vm = this;
            const data = new FormData;
            data.append("method","getcsvPType")
            await axios.post("handler/adminHandler.php",data)
            .then((res)=>{
                console.log(res.data);
                var pizzatype = [];
                res.data.forEach(function(i,v){
                    pizzatype.push(
                        [
                            i[0],
                            i[1],
                            i[2],
                            i[3]
                        ]
                    )
                })
                vm.pizzatype.updateConfig({
                    data: pizzatype
                }).forceRender();
            })
        }
    },
    created(){
        this.getDTRlog();
    },
    mounted(){
        const vm = this;
        vm.pizzatype = new gridjs.Grid({
            columns: [
                "Pizza Type ID","Name", "Category", "Ingredients"],
            // pagination: { limit: 10 },
            search: false,
            sort:false,
            
            data: [],
        }).render(document.getElementById('dtr-log-table'));
    }
}).mount('#layout-wrapper')



        
	    

        