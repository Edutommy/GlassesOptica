new Vue({
    el: '#cargaCBO',
    data: {
        id_material_cristal: "",
        materiales: [],
        id_tipo_cristal: "",
        tipos: [],
        id_armazon: '',
        armazones: [],
        url: "https://glassesoptica.herokuapp.com/",
    },
    methods: {
        cargaMateriales: async function(){
            try {
                var recurso = "controllers/GetMaterialCristal.php";
                const res = await fetch(this.url + recurso);
                const data = await res.json();
                this.materiales = data;
            } catch (error) {
                console.log(error);
            }
        },
        cargaTipos: async function(){
            try {
                var recurso = "controllers/GetTipoCristal.php";
                const res = await fetch(this.url + recurso);
                const data = await res.json();
                this.tipos = data;
            } catch (error) {
                console.log(error);
            }
        },
        cargaArmazon: async function(){
            try {
                var recurso = "controllers/GetArmazon.php";
                const res = await fetch(this.url + recurso);
                const data = await res.json();
                this.armazones = data;
            } catch (error) {
                console.log(error);
            }
        }
    },
    created(){
        this.cargaMateriales();
        this.cargaTipos();
        this.cargaArmazon();
    }
});