<template>
    <span class="badge badge-pill badge-success" v-if="user.nombre">Bienvenido, {{user.nombre}}</span>
    <span class="badge badge-pill badge-danger" v-if="!user.nombre">No estas registrado</span>
    <span class="badge badge-pill badge-warning">es {{valor}}</span>
  <div class="container fo">
  <div class="gallery-outer" v-for="sitio in sitios" :key="sitio.id">
    <div class="card p-3" style="width: 18rem;">
      <img class="card-img-top" :src="sitio.logo" alt="Card image cap">
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
  name: 'InicioMW',
  data () {
    return {
      user: [],
      sitios: [],
      valor: ''
    }
  },
  created: function () {
    this.traersitios()
    this.valor = JSON.parse(localStorage.getItem('valor'))
    this.traerdatos()
  },
  methods: {
    traerdatos () {
      const formdata = new FormData()
      formdata.append('id', this.valor)
      fetch('http://localhost/mwreservation/traerdatos.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuesta => respuesta.json()
      ).then((datosRespuesta) => {
        console.log(datosRespuesta)
        this.user = datosRespuesta[0]
      }).catch(console.log)
    },
    traersitios () {
      fetch('http://localhost/mwreservation/home.php').then(
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
  height: 130px;
  overflow: ellipsis;
  text-align: left;
}
.estrella{
  color: red;
}
</style>
