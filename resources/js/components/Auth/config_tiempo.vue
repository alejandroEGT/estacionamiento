<template>
    <div style="width:100%">
    <br>
    <el-row :gutter="10" type="flex" justify="center">
        <el-col :sm="15" :md="15">
            <el-card class="box-card">
                <div slot="header" class="clearfix">
                    <span>Configurar tarifa de tiempo</span>
                    <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button>
                </div>
                    <el-form :inline="true"  class="demo-form-inline">
                        <el-form-item label="Minuto(s)">
                            <el-input v-model="datos.minutos" placeholder="Minuto(s)"></el-input>
                        </el-form-item>
                        <el-form-item label="Valor">
                            
                            <el-input v-model="datos.valor" placeholder="Valor $"></el-input>
                       
                        </el-form-item>
                        <el-form-item label="Opcion">
                            
                         <el-checkbox v-model="datos.check">¿Minutos gratis?</el-checkbox>
                       
                        </el-form-item>
                        <el-form-item v-if="datos.check" label="Minutos gratis">
                            
                            <el-input v-model="datos.minutos_gratis" placeholder="Valor gr $"></el-input>
                       
                        </el-form-item>
                        <el-form-item>
                            <el-button type="info" @click="registrar_tarifa">Ingresar</el-button>
                        </el-form-item>
                    </el-form>

                    <hr>

            
                     <el-table
                        :data="get_lista"
                        height="350"
                        style="width: 100%">

                        <el-table-column  class="lol"  label="ID" width="90">
                             <template slot-scope="scope">
                                 {{ scope.row.id }}
                             </template>
                        </el-table-column>

                        <el-table-column  label="MINUTOS" width="90">
                             <template slot-scope="scope">
                                 {{ scope.row.minutos }}
                             </template>
                        </el-table-column>

                        <el-table-column  label="VALOR" width="95">
                             <template slot-scope="scope">
                                <b style="color:green"> {{ formatPrice(scope.row.valor) }}</b>
                             </template>
                        </el-table-column>

                         <el-table-column  label="¿MINUTOS GRATUITOS?" width="180">
                             <template slot-scope="scope">
                                 <b  v-if="scope.row.minutos_gratis == 'S'" style="color:green">{{ 'SI' }}</b>
                                 <b  v-if="scope.row.minutos_gratis == 'N'" style="color:red">{{ 'NO' }}</b>
                             </template>
                        </el-table-column>

                        <el-table-column  label="TIEMPO GRATUITO" width="180">
                             <template slot-scope="scope">
                                <b v-if="scope.row.valor_minutos_gratis == null" style="color:red"> -- </b>
                                <b v-if="scope.row.valor_minutos_gratis" style="color:red"> {{ scope.row.valor_minutos_gratis }}</b>
                             </template>
                        </el-table-column>

                         <el-table-column  label="ACTIVO" width="180">
                             <template slot-scope="scope">
                                 <!-- <b v-if="scope.row.activo == 'S'" style="color:green">{{ 'SI' }}</b>
                                 <b v-if="scope.row.activo == 'N'" style="color:red">{{ 'NO' }}</b> -->

                                  <el-button @click="activar('S', scope.row.id)" size="small" v-if="scope.row.activo == 'S'" type="success" round>SI</el-button>
                                  <el-button @click="activar('N', scope.row.id)" size="small" v-if="scope.row.activo == 'N'" type="danger" round>NO</el-button>
                             </template>
                        </el-table-column>
                        
                    </el-table>
            </el-card>
        </el-col>
    </el-row>
    </div>
</template>

<script>
export default {
    data(){
        return{
            datos:{
                minutos:'',
                valor:'',
                check:false,
                minutos_gratis:'',

            },
            get_lista:[]
        }
    },

    created(){
        this.listar();
    },

    methods:{
        registrar_tarifa(){
           
            axios.post('api/registrar_tarifa', this.datos).then((res)=>{
                this.listar();
            });
        },

        listar(){
            
            axios.get('api/listar_config_tiempo').then((res)=>{
                if (res.data.estado == 'success') {
                    
                    this.get_lista = res.data.lista;
                }
            });
        },

        activar(estado, id){
            axios.get('api/activar_config_tiempo/'+estado+'/'+id).then((res)=>{
               
                

                    this.listar();
                
            });
        },

        formatPrice(value) {
            let val = (value/1).toFixed(0).replace('.', ',')
            return '$ '+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }
    }
}
</script>