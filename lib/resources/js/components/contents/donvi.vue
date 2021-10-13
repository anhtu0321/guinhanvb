<template>
    <div class="item-component">
        <button class="btn" @click="show" v-if="showMore"><i class="fas fa-minus"></i></button> 
        <button class="btn" @click="show" v-else><i class="fas fa-plus"></i></button> 
        <div class="item__all">
            <div class="item__parent">
                <div class="item__info">
                    {{ list.ky_hieu }}
                    <span class="item__total">12</span>
                </div>
            </div>
			<transition name="showdonvi">
				<div class="item__children" v-if="showMore">
					<div v-for="list in list.donvicon" :key="list.id" class="item__info">
						{{ list.ten_phong }}
						<span class="item__total">12</span>
					</div>
				</div>
			</transition>
        </div>
        
    </div>
</template>

<script>
export default {
    data(){
        return{
            showMore:false,
        }
	},
	props:["list"],
    methods:{
        show(){
            this.
            showMore = !this.showMore;
        }
    }
}
</script>

<style scoped>
.item-component{
	display:flex;
	align-items: baseline;
}
.item__all{
	display:flex;
	flex-direction: column;
	align-items: baseline;
}
.item__children{
	position:relative;
	display:flex;
	flex-direction: column;
	align-items: baseline;
	justify-content: space-evenly;
	margin-left:10px;
}
.item__children .item__info{
	margin-top:5px;
}
.item__children .item__info::before,.item__children .item__info::after{
	content:'';
	position:absolute;
	width:10px;
	height:50% ;
	left:-10px;
	top:-8px;
	border-left:1px solid #000000;
}
.item__children .item__info::before{
	padding-bottom:10px;
}
.item__children .item__info::after{
	top:50%;
	border-top:1px solid #000000;
}
.item__children .item__info:last-child::after{
	border-left:none;
}
.item__info{
	margin-left:10px;
	font-size:1.1rem;
	font-weight: bold;
	color:#ffffff;
	background: #00abe4;
	padding:5px 15px;
	border-radius:5px;
	border:1px solid #dadada;
	cursor: pointer;
	position: relative;
}
.item__info:hover{
	color:#fff9bd;
}
.item__total{
	position: absolute;
	width:25px;
	height: 25px;
	padding:5px;
	border-radius: 50%;
	background: crimson;
	color: white;
	top:-10px;
	right:-10px;
	font-size: 0.8rem;
	font-weight: 600;
	display: flex;
	justify-content: center;
	align-items: center;

}
.btn{
	padding:5px;
	background:white;
	border:1px solid #dadada;
	cursor: pointer;
}
@media (min-width: 768px){
.item{
	flex-basis: 30%;
	margin:1.666%;
}
}
@media (min-width: 1200px){
.item{
	flex-basis: 23%;
	margin:1%;
}
}
.showdonvi-enter-active, .showdonvi-leave-active {
  transition: opacity .5s;
}
.showdonvi-enter, .showdonvi-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>