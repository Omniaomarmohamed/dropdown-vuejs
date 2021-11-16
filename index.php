<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dynamic Dependent Select Box in Vue.js using PHP</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  
 </head>
 <body class="text-capitalize">
  <div class="container" id="dynamicApp">
   <br />
   <h1 class="text-success" >Dynamic data</h1>
   <br />
   <div class="panel panel-default">
    <div class="panel-heading">Select Data</div>
    <div class="panel-body">
     <div class="form-group">
      <label class="text-success">Select Country</label>
      <select class="form-control input-lg" v-model="select_country" @change="fetchState">
       <option value="">Select Country</option>
       <option v-for="data in country_data" :value="data.country_id">{{ data.country_name }}</option>
      </select>
           </div>
           <div class="form-group">
      <label class="text-success">Select State</label>
      <select class="form-control input-lg" v-model="select_state" @change="fetchCity">
       <option value="">Select state</option>
       <option v-for="data in state_data" :value="data.state_id">{{ data.state_name }}</option>
      </select>
           </div>
           <div class="form-group">
      <label class="text-success">Select City</label>
      <select class="form-control input-lg" v-model="select_city">
       <option value="">Select City</option>
       <option v-for="data in city_data" :value="data.city_id">{{ data.city_name }}</option>
      </select>
           </div>
    </div>
   </div>
  </div>
 </body>
</html>

<script>

var application = new Vue({
 el:'#dynamicApp',
 data:{
  select_country:'',
  country_data:'',
  select_state:'',
  state_data:'',
  select_city:'',
  city_data:''
 },
 methods:{
  fetchCountry:function(){
   axios.post("action.php", {
    request_for:'country'
   }).then(function(response){
    application.country_data = response.data;
    application.select_state = '';
    application.state_data = '';
    application.select_city = '';
    application.city_data = '';
   });
  },
  fetchState:function(){
   axios.post("action.php", {
    request_for:'state',
    country_id:this.select_country
   }).then(function(response){
    application.state_data = response.data;
    application.select_state = '';
    application.select_city = '';
    application.city_data = '';
   });
  },
  fetchCity:function(){
   axios.post("action.php", {
    request_for:'city', 
    state_id:this.select_state
   }).then(function(response){
    application.city_data = response.data;
    application.select_city = '';
   });
  }
 },
 created:function(){
  this.fetchCountry();
 }
});

</script>
