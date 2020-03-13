<template>
<div style="width:100%">
    <br>
    <el-row :gutter="10" type="flex" justify="center">
        <el-col :sm="15" :md="15">
            <el-card class="box-card">
                <div >
                    <el-button @click="url('config_tiempo')" type="text">
                          <i class="fas fa-clock"></i>
                    </el-button>
                    <el-row :gutter="10" >
                       <el-col :xs="8" :sm="8" :md="8">
                           <center style="font-size:30px;color:green"><b>Disponible</b></center>
                            <center style="font-size:30px;color:green"><b>10</b></center>
                       </el-col>

                       <el-col :xs="8" :sm="8" :md="8">
                            <center style="font-size:50px"><i class="fas fa-car"></i></center>
                            <center style="font-size:50px"><i class="fas fa-motorcycle"></i></center>
                            
                       </el-col>

                       <el-col :xs="8" :sm="8" :md="8">
                            <center style="font-size:30px;color:red;"><b>En Uso</b></center>
                            <center style="font-size:30px;color:red;"><b>17</b></center>
                       </el-col>
                    </el-row>
                </div>
            </el-card>
        </el-col>
    </el-row>
<br>
    <el-row :gutter="10" type="flex" justify="center">
        <el-col :sm="15" :md="15">
            <el-card class="box-card">
                <div >
                    <el-row :gutter="10" >
                       <el-col :xs="12" :sm="12" :md="12">
                            <center><el-button
                            @click="modal_ingreso=true"
                             type="success">
                               INGRESO <i class="fas fa-sign-in-alt"></i>
                           </el-button> <br>
                           <el-button type="text" @click="url('lista_ingreso')">Lista de ingresos</el-button>
                           </center>
                       </el-col>

                       

                       <el-col :xs="12" :sm="12" :md="12">
                            <center> <el-button 
                                     @click="modal_salida=true"
                                     type="danger">
                               SALIDA <i class="fas fa-sign-out-alt"></i>
                           </el-button>
                            <br>
                           <el-button type="text" @click="url('config_tiempo')">Lista de salida</el-button>
                           </center>
                       </el-col>
                    </el-row>
                </div>
            </el-card>
        </el-col>
    </el-row>

    <el-dialog
        title="Ingreso de vehiculo"
        :visible.sync="modal_ingreso"
        width="80%">
        <div id="invoice"  style="">  
            <el-form   size="mini">
                <el-form-item label="Patente">
                    
                    <el-input v-model="patente"></el-input>
                </el-form-item>

                 <el-form-item label="Tipo vehiculo">
                    <el-radio-group text-color="red" v-model="tipo" size="medium">
                   <el-row :gutter="10">
                       <el-col :sm="8" :md="8">
                            <el-radio border label="Automovil">Coche <i class="fas fa-car"></i></el-radio>
                       </el-col>

                       <el-col :sm="8" :md="8">
                           <el-radio border label="Motocicleta">Moto <i class="fas fa-motorcycle"></i></el-radio>
                       </el-col>

                        <el-col :sm="8" :md="8">
                           <el-radio border label="Otros">Otros <i class="fas fa-asterisk"></i></el-radio>
                       </el-col>
                   </el-row>
                    </el-radio-group>
                </el-form-item>

                <el-row :gutter="10">
                    <el-col :sm="6">
                        <el-form-item label="Fecha">
                            <el-date-picker
                                v-model="fecha"
                                type="date"
                                placeholder="Fecha"
                                format="dd/MM/yyyy"
                                >
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="5">
                         <el-form-item label="Hora">
                            <!-- <el-time-select
                            arrow-control
                                placeholder="Hora"
                                v-model="hora"
                                :picker-options="{
                                    start: '05:00',
                                    step: '00:01',
                                    end: '23:59'
                                }">
                            </el-time-select> -->

                            <el-time-picker
                                :localTime="true"
                                value-format="HH:mm:ss"
                                placeholder="HH:MM:SS"
                                v-model="hora"
                                :picker-options="{
                                    start: '05:00',
                                    step: '00:01',
                                    end: '23:59'
                                }"
                               >
                            </el-time-picker>
                         </el-form-item>
                    </el-col>
                </el-row>

                <el-form-item label="Detalle">
                    <el-input v-model="detalle" type="textarea"></el-input>
                </el-form-item>

    

                <el-button @click="registro"  type="info">Registrar</el-button>
                
               
                <!-- <button type="button" onclick="printJS('printJS-form', 'html')">
                    Print Form
                </button> -->
                 <!-- <qrcode-vue :value="value" :size="size" level="H"></qrcode-vue> -->
            </el-form>
            
            <div>
             
                <div class="ticket" id="imprimir" style="display:none">
                  <table style="font-size:16px" width="48">
                        <tr >
                            <td style="border-bottom: 1px solid #17202A;" colspan="2"><center>Ticket de llegada</center></td>
                        </tr>

                        <tr style="border-bottom:1px solid black;">
                            <td  colspan="1"><b>Patente vehiculo:</b></td>
                            <td  colspan="1">{{boucher.patente}}</td>
                        </tr>

                        <tr >
                            <td  colspan="1"><b>fecha:</b></td>
                            <td  colspan="1">{{boucher.fecha_cl}}</td>
                        </tr>


                        <tr >
                            <td  colspan="1"><b>Hora de llegada:</b></td>
                            <td  colspan="1">{{boucher.hora}}</td>
                        </tr>

                         <tr >
                            <td style="border-bottom: 1px solid #17202A;" colspan="1"><b>Calle:</b></td>
                            <td style="border-bottom: 1px solid #17202A;" colspan="1">Satna maria, colo colo, Los Angeles.</td>
                        </tr>
                        

                        <tr >
                            <td  colspan="2">
                                    <center><small>Vea su tiempo escaneando este codigo</small>
                                    <br>
                                      <qrcode-vue :value="url_value" :size="size" level="H"></qrcode-vue>
                                    
                                    <small>Puede ver su tiempo en este enlace: {{ url_value }}</small>
                                    
                                    <barcode :value="boucher.patente" :options="{ displayValue: true }"></barcode>
                                    </center>
                            </td>
                            
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </el-dialog>



    <el-dialog
        title="Salida de vehiculo"
        :visible.sync="modal_salida"
        width="80%">
        <div id="invoice"  style="">  
            <el-form   size="mini">
                <el-form-item label="Patente">
                    
                    <el-input v-model="salida_patente"></el-input>
                </el-form-item>


    

                <el-button @click="salida"  type="info">Dar salida</el-button>
                
               
                <!-- <button type="button" onclick="printJS('printJS-form', 'html')">
                    Print Form
                </button> -->
                 <!-- <qrcode-vue :value="value" :size="size" level="H"></qrcode-vue> -->
            </el-form>
            
            <div>
             
                <div class="ticket" id="imprimir" style="display:none">
                  <table style="font-size:12px">
                        <tr >
                            <td style="border-bottom: 1px solid #17202A;" colspan="2"><center>Ticket de llegada</center></td>
                        </tr>

                        <tr style="border-bottom:1px solid black;">
                            <td  colspan="1"><b>Patente vehiculo:</b></td>
                            <td  colspan="1">{{boucher.patente}}</td>
                        </tr>

                        <tr >
                            <td  colspan="1"><b>fecha:</b></td>
                            <td  colspan="1">{{boucher.fecha_cl}}</td>
                        </tr>


                        <tr >
                            <td  colspan="1"><b>Hora de llegada:</b></td>
                            <td  colspan="1">{{boucher.hora}}</td>
                        </tr>

                         <tr >
                            <td style="border-bottom: 1px solid #17202A;" colspan="1"><b>Calle:</b></td>
                            <td style="border-bottom: 1px solid #17202A;" colspan="1">Satna maria, colo colo, Los Angeles.</td>
                        </tr>
                        

                        <tr >
                            <td  colspan="2">
                                    <center><small>Vea su tiempo escaneando este codigo</small>
                                    <br>
                                      <qrcode-vue :value="url_value" :size="size" level="H"></qrcode-vue>
                                    
                                    <small>Puede ver su tiempo en este enlace: {{ url_value }}</small>
                                    
                                    <barcode :value="boucher.patente" :options="{ displayValue: true }"></barcode>
                                    </center>
                            </td>
                            
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </el-dialog>
</div>
</template>


<script>
import QrcodeVue from 'qrcode.vue'

export default {
    data(){
        return {
            modal_ingreso:false,
            modal_salida:false,
            patente:'',
            tipo:'',
            fecha:'',
            hora:'',
            detalle:'',

            salida_patente:'',
            //qr
            url_value: '',
            size: 280,

            boucher : {
                patente:'-',
                fecha:''
            },
            get_patente:''
        }
    },
    components: {
        QrcodeVue,
    },
    created(){
           
    },
    methods:{
        registro(){
            // this.get_patente = '';
            const data = {
                patente: this.patente,
                tipo: this.tipo,
                fecha: this.fecha,
                hora: this.hora,
                detalle: this.detalle
            }

            axios.post('api/ingreso', data).then((res)=>{
                if (res.data.estado == 'success') {
                    
                    this.patente='';
                    this.tipo='';
                    this.fecha='';
                    this.hora='';
                    this.detalle='';
                   
                     this.$notify({
                    title: 'Exito',
                    message: ''+res.data.mensaje+'',
                    type: 'success'
                    });
               
                     
                    
                    
                    // printJS('imprimir', 'html')
                    this.boucher = res.data.ingreso;
                    this.url_value =res.data.server.SERVER_NAME+ '/#/cliente_servicio/'+res.data.ingreso.id

                    setTimeout(() => { 
                        document.getElementById('imprimir').setAttribute("style", "display:block");
                         printJS('imprimir', 'html');
                         document.getElementById('imprimir').setAttribute("style", "display:none");
                    }, 2000);
                    // document.getElementById('imprimir').setAttribute("style", "display:none");
                    
                }else{
                    this.$notify({
                    title: 'Info',
                    message: ''+res.data.mensaje+'',
                    type: 'info'
                    });
                }
            });
            // this.print();
        },

        salida(){

            const data = {
                patente: this.salida_patente
            };

            axios.post('api/salida_vehiculo', data).then((res)=>{

            });
        },
        url_params(name, json){
    		this.$router.push({name:name, params:json}).catch(error => {
			  if (error.name != "NavigationDuplicated") {
			    throw error;
			  }
			});
        },

        url(name){
    		this.$router.push({name:name}).catch(error => {
			  if (error.name != "NavigationDuplicated") {
			    throw error;
			  }
			});
        },

        // print () {
        //     // Pass the element id here
        //     this.$htmlToPaper('printMe');
        // }
    }
}
</script>

<style >
 .el-dialog__header {
        background:rgb(52, 73, 94);
        color:#fff;
    }

    span.el-dialog__title {
        color: #fff;
    }
    i.el-dialog__close.el-icon.el-icon-close {
        color: #fff;
    }

    .el-header{
         background:#3F51B5;
        color:#fff;
    }

    button.el-button.el-button--info {
        background: rgb(52, 73, 94);
    }

    .el-radio__input.is-checked+.el-radio__label {
        /* background: rgb(52, 73, 94); */
        color: rgb(52, 73, 94);
    }

    button.el-button.el-button--text {
        color: rgb(52, 73, 94);
    }
</style>