<template>
    <div style="width:100%">

        <el-row :gutter="10" type="flex" justify="center">
        <el-col :sm="15" :md="15">
            <el-card v-if="datos.estado_id == 1" class="box-card" v-loading="carga" >
                    <center><h3>Panel de llegada</h3></center>
                    <el-button @click="traer_ingreso" size="mini" type="info">Refrezcar <i class="fas fa-sync-alt"></i></el-button>
                        <hr>
                        <label><b>Codigo:</b> {{ datos.id }} </label><br>
                        <label><b>Patente:</b> {{ datos.patente }} </label> <br>
                        <label><b>Tipo:</b> {{ datos.tipo }} </label> <br>
                        <label><b>Fecha y hora de llegada:</b> {{ datos.fecha }} <b style="color:#5499C7">{{datos.hora_llegada}}</b> </label> <br>
                     
                        <label><b>Fecha y hora actual:</b> {{ datos.fecha_actual }} <b style="color:#5499C7">{{ datos.hora_actual }}</b></label><br>
                        <label><b>Tiempo transcurrido:</b> {{ datos.intervalo }} </label>
                        <hr>
                        <label><b>Estado:</b>
                             <label v-if="datos.estado_id == 1" style="color:#2ECC71"><i class="fas fa-check"></i> {{datos.estado}}</label>
                             <label v-if="datos.estado_id == 2" style="color:#EC7063"><i class="fas fa-times"></i> {{datos.estado}}</label>
                        </label>
                        <br>
                        <label style="font-size:19px"><b>Monto:</b> <b style="color:#73C6B6">{{ formatPrice(datos.monto) }}</b></label>
                        <hr>
                        <small>Valor de tarifa ${{ tarifa.valor }} cada {{tarifa.minutos}} Min(s). </small>
            </el-card>

            <el-card v-if="datos.estado_id == 2" class="box-card" v-loading="carga" >
                    <center><h3>Panel de llegada</h3></center>
                    <!-- <el-button @click="traer_ingreso" size="mini" type="info">Refrezcar <i class="fas fa-sync-alt"></i></el-button>
                        <hr>
                        <label><b>Codigo:</b> {{ datos.id }} </label><br>
                        <label><b>Patente:</b> {{ datos.patente }} </label> <br>
                        <label><b>Tipo:</b> {{ datos.tipo }} </label> <br>
                        <label><b>Fecha y hora de llegada:</b> {{ datos.fecha }} <b style="color:#5499C7">{{datos.hora_llegada}}</b> </label> <br>
                     
                        <label><b>Fecha y hora actual:</b> {{ datos.fecha_actual }} <b style="color:#5499C7">{{ datos.hora_actual }}</b></label><br>
                        <label><b>Tiempo transcurrido:</b> {{ datos.intervalo }} </label> -->
                        <hr>
                        <label><b>Estado:</b>
                             <label v-if="datos.estado_id == 1" style="color:#2ECC71"><i class="fas fa-check"></i> {{datos.estado}}</label>
                             <label v-if="datos.estado_id == 2" style="color:#EC7063"><i class="fas fa-times"></i> {{datos.estado}}</label>
                        </label>
                        <br>
                        <!-- <label style="font-size:19px"><b>Monto:</b> <b style="color:#73C6B6">{{ formatPrice(datos.monto) }}</b></label> -->
                        <hr>
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
            carga:true,
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

                this.carga = false;
            });
        },

        formatPrice(value) {
            let val = (value/1).toFixed(0).replace('.', ',')
            return '$ '+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }
    }
}
</script>