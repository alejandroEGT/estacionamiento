<template>
    <div style="width:100%">

        <el-row :gutter="10" type="flex" justify="center">
        <el-col :sm="15" :md="15">
            <el-card class="box-card">
                    <h3>Panel de llegada</h3>
                        <hr>
                        <label><b>Codigo:</b> {{ datos.id }} </label><br>
                        <label><b>Patente:</b> {{ datos.patente }} </label> <br>
                        <label><b>Tipo:</b> {{ datos.tipo }} </label> <br>
                        <label><b>Fecha y hora de llegada:</b> {{ datos.fecha }} <b style="color:#5499C7">{{datos.hora_llegada}}</b> </label> <br>
                     
                        <label><b>Fecha y hora actual:</b> {{ datos.fecha_actual }} <b style="color:#5499C7">{{ datos.hora_actual }}</b></label><br>
                        <label><b>Tiempo transcurrido:</b> {{ datos.intervalo }} </label>
                        <br>
                        <label><b>Monto:</b> {{ formatPrice(datos.monto) }}</label>
                        <br>
                        <small>Valor de tarifa ${{ tarifa.valor }} cada {{tarifa.minutos}} Min(s). </small>
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
            datos:{},
            tarifa:{}
        }
    },
    created(){
        this.traer_ingreso();
    },

    methods:{
        traer_ingreso(){
            axios.get('api/ingreso_vehiculo/'+this.ingreso_id).then((res)=>{
                this.datos = res.data.lista[0];
                this.tarifa = res.data.tarifa;
            });
        },

        formatPrice(value) {
            let val = (value/1).toFixed(0).replace('.', ',')
            return '$ '+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }
    }
}
</script>