<template>
    <div style="width:100%">
    <br>
        <el-row :gutter="10" type="flex" justify="center">
            <el-col :sm="20" :md="20">
                <el-card class="box-card">
                 <div slot="header" class="clearfix">
                    <span>Lista de ingresos</span>
                    
                </div>
                    <el-table
                        :data="lista"
                        height="350"
                        style="width: 100%">

                        <el-table-column  class="lol"  label="ID" width="180">
                             <template slot-scope="scope">
                                 {{ scope.row.id }}
                             </template>
                        </el-table-column>

                        <el-table-column  label="PATENTE" width="180">
                             <template slot-scope="scope">
                                 <div style="
                                    width:100%;
                                    height:100%;
                                    padding:2px;
                                    background:#E5E7E9;
                                 ">
                                    <div style="
                                        float:left;
                                        width:80%;
                                        height:80%;
                                       
                                        background:#E5E7E9;
                                        border:1px solid black;
                                        margin-left:2px;
                                        padding-left:2px;
                                    "

                                    > {{ scope.row.patente }}</div>
                                    <img height="20" src="estrella.png" alt="">
                                 </div>
                             </template>
                        </el-table-column>

                        <el-table-column  label="TIPO" width="180">
                             <template slot-scope="scope">
                                 {{ scope.row.tipo }}
                             </template>
                        </el-table-column>

                         <el-table-column  label="ESTADO" width="180">
                             <template slot-scope="scope">
                                <label v-if="scope.row.estado_id == 1" style="color:green"><b>{{ scope.row.estado }}</b></label>
                                 <!-- <label v-if="scope.row.estado_id == 2" style="color:red">{{ scope.row.estado }}</label> -->
                             </template>
                        </el-table-column>

                        <el-table-column  label="FECHA INGRESO" width="180">
                             <template slot-scope="scope">
                                 {{ scope.row.fecha }}
                             </template>
                        </el-table-column>

                         <el-table-column  label="HORA INGRESO" width="180">
                             <template slot-scope="scope">
                                 <b style="color:#2471A3">{{ scope.row.hora }}</b>
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
            lista:[],
        }
    },
    created(){
        this.listar();
    },
    methods:{
        listar(){
            axios.get('api/listar_ingreso').then((res)=>{
                this.lista = res.data.lista;
            });
        },
        tableRowClassName({row, rowIndex}) {
            if (row.launch_success == true) {
            return 'success-row';
            } else if (row.launch_success == false) {
            return 'warning-row';
            }
            return 'other-row';
        }
    },
}
</script>