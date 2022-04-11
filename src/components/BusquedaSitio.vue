<template>
    <h1 v-if="sitios== ''">No hay sitios sobre "{{busqueda}}"</h1>
    <i v-if="sitios== ''" class="bi bi-emoji-frown" style="font-size: 8rem;"></i>
    <h1 v-if="sitios!= ''">Sitios sobre "{{busqueda}}"<hr></h1>
  <div class="fo">
  <div class="gallery-outer" v-for="sitio in sitios" :key="sitio.id">
    <div class="card p-3" style="width: 18rem;">
      <img class="card-img-top" v-show="sitio.logo" :src="sitio.logo" alt="Card image cap" style="  width: 220px;height: 150px;">
        <img class="card-img-top" v-show="!sitio.logo" src="https://zictcian.000webhostapp.com/default.png" alt="Card image cap" style="  width: 220px;height: 150px;">
        <div class="card-body bodycard">
        <h5 class="card-title">{{sitio.nombre}}</h5>
        <p class="card-text textocard">{{sitio.descripcion}}</p>
        <a href="#" class="btn btn-primary">Reserva por ${{sitio.anticipo}}</a>
      </div>
      <div class="card-footer">
      <small v-if="1" class="text-muted">Abierto</small> <br>
      {{sitio.ponderacion}} estrellas
      <div class="Row">
        <div v-for="n in 5" :key="n" class="gallery-outer">
        <i v-if="sitio.ponderacion>=n" class="bi bi-star-fill estrella"></i>
        <i v-else-if="sitio.ponderacion%1!=0 && n-1<sitio.ponderacion" class="bi bi-star-half estrella"></i>
        <i v-else class="bi bi-star estrella"></i>
      </div>
      </div>
    </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  name: 'BusquedaEspecificaMW',
  data () {
    return {
      sitios: [],
      busqueda: this.$route.params.id
    }
  },
  created: function () {
    this.traersitios()
  },
  methods: {
    traersitios () {
      const formdata = new FormData()
      formdata.append('busqueda', this.$route.params.id)
      formdata.append('idZona', localStorage.getItem('zona'))
      fetch('https://expresstrip.mwcomeniusdocente.com/app/busquedaEspecifica.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        this.sitios = []
        if (typeof datosRespuest[0].success === 'undefined') {
          this.sitios = datosRespuest
        }
      }).catch(console.log)
    }
  }
}
</script>

<style scoped>
.fo{
  padding-bottom: 50px;
}
.col{
  padding-left: 5%;
  margin-left: 5%;
  padding-right: 5%;
  margin-right: 5%;
  margin-bottom: 5%;
}

.gallery-outer{
  display: inline-block;
  zoom: 1;
  text-align: center;
  vertical-align: top;
  margin-left: 5%;
}
.bodycard{
  height: 250px;
}
.textocard{
  height: 100px;
  overflow: ellipsis;
  text-align: left;
}
.estrella{
  color: red;
}
.card{
  background: rgb(192,185,123);
}
</style>
