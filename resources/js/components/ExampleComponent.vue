<template >

    <div class="back">
                   
        <transition name>
           <div> <router-view></router-view></div>
        </transition>
           
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>
.back{
	background: url(https://www.elsetge.cat/myimg/f/197-1971142_wide-parking-lot.jpg); 
	background-size: 100% 100%;
	
	height: 100%;
	width: 100%;

    overflow: auto;
}
</style>
