
<template>	
	<div       >
		
		<el-menu background-color="#34495E" text-color="#fff"  class="el-menu-demo" mode="horizontal" >
		  <el-menu-item index="1">NeoPark</el-menu-item>
		  
		  <el-menu-item index="3" >Registro</el-menu-item>
		  <!-- <el-menu-item index="4"><a href="https://www.ele.me" target="_blank">Orders</a></el-menu-item> -->
		</el-menu>
	
	<div >
		<el-container>
		  <!-- <el-aside width="200px" style="background-color: rgb(238, 241, 246)">
		    <el-collapse v-model="activeNames" @change="handleChange">
			  <el-collapse-item title="Consistency" name="1">
			    <div>Consistent with real life: in line with the process and logic of real life, and comply with languages and habits that the users are used to;</div>
			    <div>Consistent within interface: all elements should be consistent, such as: design style, icons and texts, position of elements, etc.</div>
			  </el-collapse-item>
			</el-collapse>
		  </el-aside> -->
		  
		  <el-container>
		    
			    <transition name>
			      <router-view></router-view>
			    </transition>
		  </el-container>
		</el-container>
	</div>
</div>
</template>
<style>
/* .back{
	background: url(https://gpi-blog.s3.amazonaws.com/wp-content/uploads/2014/08/estacionamiento.jpg); 
	background-size: 100% 100%;
	padding:7px;
	height: 100%;
	width: 100%;
} */
  .el-header {
    background-color: #B3C0D1;
    color: #333;
    line-height: 60px;
  }
  
  .el-aside {
    color: #333;
  }
  .el-card__header {
    background:rgb(52, 73, 94);
	color:white;
	}

	
</style>

<script>
  export default {
    data() {
      const item = {
        date: '2016-05-02',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      };
      return {
        tableData: Array(20).fill(item)
      }
    }
  };
</script>

