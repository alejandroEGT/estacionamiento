<template>
    <div style="width:100%">

        <el-row :gutter="10" type="flex" justify="center">
        <el-col :sm="15" :md="15">
            <el-card class="box-card">
                    <h3>Panel de llegada</h3>
                        <hr>
                        <label><b>Codigo:</b> {{ datos.id }} </label><br>
                        <label><b>Patente:</b> {{ datos.patente }} </label> <br>
                        <label><b>Codigo:</b> {{ datos.tipo }} </label> <br>
                        <label><b>Fecha:</b> {{ datos.fecha }} </label> <br>
                        <label><b>Hora de llegada:</b> {{ datos.hora_llegada }} </label>
                        <label><b>Hora Actual:</b> {{ datos.hora_actual }} </label>
                        <label><b>Tiempo transcurrido:</b> {{ datos.diferencia }} </label>
                    </el-card>
        </el-col>
    </el-row>
      


    </div>
</template>

<script>
export default {
    data(){
        return{
            ingreso_id : this.$route.params.id,
            datos:{}
        }
    },
    created(){
        this.traer_ingreso();
    },

    methods:{
        traer_ingreso(){
            axios.get('api/ingreso_vehiculo/'+this.ingreso_id).then((res)=>{
                this.datos = res.data[0];
            });
        }
    }
}
</script>