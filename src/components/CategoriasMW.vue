<template>
  <div class="contenedor">
  <div v-for="categoria in categorias" :key="categoria.id" class="card border-success mb-3 gallery-outer" style="max-width: 18rem;">
  <h5 class="card-header">{{categoria.categoria}}</h5>
  <div class="card-body">
    <h5 class="card-title">mwreservation</h5>
    <p class="card-text">¡¡ Mira todos los sitios que hay !!, ver a ver los sitios de {{categoria.categoria}}s que tenemos para ti y calificalos
      para mas personas puedan saber tu opinión
    </p>
    <router-link :to="{ name:'CategoriasMW', params:{id: categoria.categoria} }" class="btn btn-primary">Ver sitios</router-link>
  </div>
</div>
</div>
</template>
<script>
export default {
  name: 'CategoriasMW',
  data () {
    return {
      categorias: []
    }
  },
  created: function () {
    this.traecategorias()
  },
  methods: {
    traecategorias () {
      fetch('http://localhost/mwreservation/categorias.php').then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        this.categorias = []
        if (typeof datosRespuest[0].success === 'undefined') {
          this.categorias = datosRespuest
        }
      }).catch(console.log)
    }
  }
}
</script>
<style scoped>
.categoria{
  margin-top: 10px;
  margin-right: 25px;
  margin-left: 25px;
  margin-bottom: 15px;
}
.contenedor{
  padding-bottom: 50px;
}
.gallery-outer{
  display: inline-block;
  zoom: 1;
  text-align: center;
  vertical-align: left;
  margin-left: 3%;
  margin-top: 2%;
}
</style>
