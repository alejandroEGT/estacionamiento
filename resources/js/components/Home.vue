<template>
  <div style="width:100%">
    <br>
    <el-row type="flex" justify="center">
       <el-col :xs="24" :sm="12" :md="12" :lg="12" :xl="24">
         <!-- <div class="trans" style="z-index:1;filter:alpha(opacity=60);float:left;-moz-opacity:.60;opacity:.60">
           
            <h3>Neo Park - Log in Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti adipisci ut quisquam provident sequi repellendus distinctio perferendis a omnis deserunt, nihil alias? Atque tenetur consectetur nihil alias doloribus temporibus veniam.  </h3>

            <el-form label-width="120px">
                <el-form-item label="Activity name">
                  <el-input ></el-input>
                </el-form-item>

                <el-form-item label="Activity name">
                  <el-input ></el-input>
                </el-form-item>
            </el-form>

        </div> -->

      
        <div  id="capaTransparente">
          <div style="padding:3%;" >
            <h3>Neo park - Log in</h3>
          
                  <el-form ref="form" >
                      <el-form-item >
                        <label for="">Usuario</label>
                        <el-input v-model="email" type="text"></el-input>
                      </el-form-item>

                      <el-form-item >
                        <label for="">Contraseña</label>
                        <el-input v-model="pass" type="password" ></el-input>
                      </el-form-item>
                  </el-form>
                  <center> <el-button @click="login"  type="info">Entrar</el-button></center>
             
          </div>
           <center><img height="50" src="https://www.neofox.cl/img/neofox-nav.png" alt=""></center>
        </div>
     
       </el-col>
    </el-row>

     
  </div>
</template>

<script>
export default {
  data(){
    return{
      email:'',
      pass:''
    }
  },
  methods:{
    login() {
                var app = this;
                this.$auth.login({
                    params: {
                    email: app.email,
                    password: app.pass
                    },
                    success: function() {},
                    error: function() {},
                    rememberMe: true,
                    redirect: "/index",
                    fetchUser: true
                });
            },
  }
}
</script>

<style>
    /* .cnt{
      width:450px;
      background-color:#DDAADD;
      margin:0px;
      padding:15px;
      font-weight:bold
    } */
    .trans{
      background-color:black;
      color:white;
      padding: 2%;
      font-weight:bold;
      /* width:100%; */
      
    }



    #capaFondo {
          /* width:150px;
          height:350px; */
          background-color:gray;}
      #capaTransparente {
          width:100%;
          height:100%;
          /* font-size:40px; */
          z-index:1;
          color:white;  
          /* padding:3%;  */
     
          background-color:rgba(0, 0, 0, 0.5);
          filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#30111111,endColorstr=#30111111);}
         
      #capaTransparente div {
          position:relative;        
          opacity:1;
          filter:alpha(opacity=100);}
  </style>