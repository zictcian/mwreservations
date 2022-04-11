<template>
  <div class="contenedor">
  <div v-for="(categoria, index) in categorias" :key="categoria.id" class="card border-dark gallery-outer">
  <p class="card-header">{{categoria.categoria}}</p>
  <div class="card-body tamano">
    <p class="card-title"><span class="badge badge-info"><span class="badge badge-light">#{{index+1}}</span> categoria mwreservation</span></p>
    <p class="card-text texto"> {{categoria.desgloze}}
    </p>
    <router-link :to="{ name:'CategoriasMW', params:{id: categoria.categoria} }" class="btn">Ver sitios</router-link>
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
      fetch('https://expresstrip.mwcomeniusdocente.com/app/categorias.php').then(
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
.contenedor{
  padding-bottom: 50px;
}
.gallery-outer{
  display: inline-block;
  zoom: 1;
  text-align: center;
  margin-left: 3%;
  margin-top: 2%;
}
.tamano{
  width: 300px;
  height: 200px;
  text-align: center;
}
.texto{
  text-align: left;
  overflow: hidden;
  width: 270px;
  height: 70px;
}
</style>
