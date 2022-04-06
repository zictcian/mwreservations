<template>
  <div v-show="this.nombre" class="alert alert-success" role="alert">Bienvenido, {{this.nombre}}</div>
  <div v-show="!this.nombre" class="alert alert-danger" role="alert">
  No estas registrado
  </div>
    <div class="fo">
      <h1 v-if="sitios== ''">No hay sitios registrados en {{zonanombre}}</h1>
      <i v-if="sitios== ''" class="bi bi-emoji-frown" style="font-size: 8rem;"></i>
    <div class="gallery-outer" v-for="sitio in sitios" :key="sitio.id">
      <div class="card p-3" style="width: 18rem;">
        <img class="card-img-top" :src="sitio.logo" alt="Card image cap">
        <div class="card-body bodycard">
          <h5 class="card-title">{{sitio.nombre}}</h5>
          <p class="card-text textocard">{{sitio.descripcion}}</p>
          <button v-on:click="ir(sitio.id, sitio.nombre)" class="btn btn-primary">Reserva por ${{sitio.anticipo}}</button>
        </div>
        <div class="card-footer">
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
      // user: [],
      zonanombre: localStorage.getItem('zonaname'),
      sitios: [],
      valor: '',
      nombre: '',
      cliente: ''
    }
  },
  created: function () {
    this.cliente = localStorage.getItem('nivel')
    this.traersitios()
    this.valor = localStorage.getItem('valor')
    this.nombre = localStorage.getItem('nombre')
  },
  methods: {
    async ir (dato, nombre) {
      dato = this.encryp(dato)
      await this.$router.push({ name: 'TarjetaMW', params: { nombre: nombre, id: dato } })
      this.$router.go(0)
    },
    async traersitios () {
      const formdata = new FormData()
      formdata.append('idZona', localStorage.getItem('zona'))
      await fetch('http://localhost/mwreservation/home.php', {
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
    },
    encryp: function (palabra) {
      const palabraencryp = btoa(palabra)
      console.log(palabra)
      console.log(palabraencryp)
      return palabraencryp
    },
    desencryp: function (palabra) {
      const palabradesencryp = atob(palabra)
      console.log(palabra)
      console.log(palabradesencryp)
      return palabradesencryp
    }
  }
}
</script>
<style scoped>
.fo{
  padding-bottom: 50px;
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
  overflow: hidden;
  text-overflow: ellipsis;
  text-align: left;
}
.estrella{
  color: red;
}
.card{
  background: rgb(192,185,123);
}
</style>
