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
                minutos_gratis:''
            }
        }
    },

    methods:{
        registrar_tarifa(){
           
            axios.post('api/registrar_tarifa', this.datos).then((res)=>{

            });
        }
    }
}
</script>