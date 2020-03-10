<template>
    <div>
       
        <el-menu background-color="#34495E" text-color="#fff"  class="el-menu-demo" mode="horizontal" >
		  <el-menu-item index="1">NeoPark</el-menu-item>
		  
		  <el-menu-item index="3" >Registro</el-menu-item>
		  <!-- <el-menu-item index="4"><a href="https://www.ele.me" target="_blank">Orders</a></el-menu-item> -->
		</el-menu>

        <el-container>
		    
			    <transition name>
			      <router-view></router-view>
			    </transition>
		</el-container>
    </div>
</template>