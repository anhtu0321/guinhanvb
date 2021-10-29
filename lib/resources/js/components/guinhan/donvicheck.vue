<template>
    <div class="item-component">
		<div class="item" v-for="list in lists" :key="list.id">
			<span class="btn" @click="hide(list.id)" v-if="checkshow(list.id)"><i class="fas fa-minus"></i></span> 
			<span class="btn" @click="show(list.id)" v-else><i class="fas fa-plus"></i></span> 
			<div class="item__all">
				<div class="item__parent">
					<div class="item__info">
						<input type="checkbox" :value="list.id" v-model="donvinhan" @change="emitData()" :id="list.id"> <label :for="list.id">{{ list.ky_hieu }}</label>
					</div>
				</div>
				<transition name="showdonvi">
					<div class="item__children" v-if="checkshow(list.id)">
						<div v-for="list in list.donvicon" :key="list.id" class="item__info">
							<input type="checkbox" :value="list.id" v-model="donvinhan" @change="emitData()" :id="list.id"><label :for="list.id"> {{ list.ten_phong }}</label>
						</div>
					</div>
				</transition>
			</div>
		</div>
    </div>
</template>

<script>
export default {
    data(){
        return{
			donvinhan:[],
			test:"hoang van tu",
			key:[],
        }
	},
	props:["lists"],
    methods:{
        show(key){
			this.key.push(key);
		},
		hide(key){
			this.key = this.key.filter(e=>{
				return e != key;
			});
		},
		checkshow(key){
			return this.key.includes(key);
		},
		emitData(){
			var data = this.donvinhan;
			this.$emit('loadDonViNhan', data);
		}
    }
}
</script>

<style scoped>
.item-component{
	display: flex;
	flex-direction: row;
	width:100%;
}
.item{
	display:flex;
	align-items: baseline;
	justify-content: start;
	flex-basis: 50%;
}
.item-component label{
	cursor: pointer;
}
.item__all{
	display:flex;
	flex-direction: column;
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
	/* font-size:1.1rem; */
	/* font-weight: bold; */
	/* color:#ffffff;
	background: #00abe4; */
	/* padding:5px 15px; */
	/* border-radius:5px;
	border:1px solid #dadada; */
	position: relative;
}
.item__info:hover{
	/* color:#fff9bd; */
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