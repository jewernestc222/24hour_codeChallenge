
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
            // const data = new FormData;
            // data.append("method","getcsvPType")
            await axios.post("importcsv.php")
            .then((res)=>{
                //console.log(res.data);
                var pizzatype = [];
                res.data.forEach(function(i,v){
                    pizzatype.push(
                        [
                            i.pizza_type,
                            i.name,
                            i.category,
                            i.ingredients
                        ]
                    )
                })

                //console.log(pizzatype);//
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



        
	    

        