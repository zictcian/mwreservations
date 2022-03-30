<template>
<div>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <nav class="navbar navbar-expand navbar-light">
      <a href="/"><i class="bi bi-house-fill colore" style="font-size: 1.5rem;color:black"></i></a>
      <div class=""><input v-model="busqueda" class="typeahead form-control" type="text" placeholder="Search place"></div>
      <button class="btn" v-on:click="buscar"><i class="fa fa-search"></i></button>
      <div class="container">
        <div class="collapse navbar-collapse">
          <button class="btn2" v-on:click="Zonaquitar()"><i class="bi bi-trash"></i></button>
          <select class="custom-select" style="width:300px;" id="zonaselected">
                <option selected>{{zonanombre}}</option>
                <option :value="index" v-for="(zona ,index) in zonas" :key="index">{{index+1}}. {{zona.estado}}</option>
              </select>
            <button class="btn" v-on:click="Zonaselec()"><i class="bi bi-arrow-right-circle"></i></button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="/inicio" class="nav-link"><i class="bi bi-shop-window colore"></i></a>
            </li>
            <li class="nav-item">
              <a href="/fav" class="nav-link"><i class="bi bi-heart-fill colore"></i>Favoritos</a>
            </li>
            <li class="nav-item">
              <a href="/categorias" class="nav-link">Categorias</a>
            </li>
            <li class="nav-item">
              <a href="/conocenos" class="nav-link">Conocenos</a>
            </li>
            <li class="nav-item">
              <a href="/login" class="nav-link">Login</a>
            </li>
            <li class="nav-item">
              <a href="/carrito" class="nav-link"><i class="bi bi-cart colore"></i></a>
            </li>
            <li class="nav-item">
              <a href="/usuario" class="nav-link"><i class="bi bi-person-circle colore"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    </div>
</template>

<script>
export default {
  name: 'NavMW',
  data () {
    return {
      busqueda: '',
      zonas: [],
      zonafija: localStorage.getItem('zona'),
      zonanombre: localStorage.getItem('zonaname')
    }
  },
  created: function () {
    this.traersitios()
  },
  methods: {
    traersitios () {
      const formdata = new FormData()
      formdata.append('IdUsua', localStorage.getItem('valor'))
      fetch('http://localhost/mwreservation/zone.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        this.zonas = []
        if (typeof datosRespuest[0].success === 'undefined') {
          this.zonas = datosRespuest
        }
      }).catch(console.log)
    },
    async buscar () {
      if (this.busqueda.length > 2) {
        await this.$router.push({ name: 'BusquedaEspecificaMW', params: { id: this.busqueda }, replace: true })
        this.$router.go(0)
      } else {
        this.$swal('Sin busqueda', 'ingresa una palabra de 3 o mas caracteres', 'info')
      }
    },
    async Zonaselec () {
      const newzona = document.getElementById('zonaselected').value
      console.log(newzona)
      localStorage.setItem('zona', newzona)
      localStorage.setItem('zonaname', this.zonas[newzona].estado)
      await this.$router.push({ path: '/inicio', replace: true })
      this.$router.go(0)
    },
    async Zonaquitar () {
      localStorage.setItem('zona', '0')
      localStorage.setItem('zonaname', '')
      await this.$router.push({ path: '/inicio', replace: true })
      this.$router.go(0)
    }
  }
}
</script>

<style scoped>

.typeahead{
  margin-left: 10%;
  width: 100%;
  border-bottom-right-radius: 0%;
}
button {
  background-color: orange; /* Blue background */
  border: none; /* Remove borders */
  color: white; /* White text */
  padding: 8px 12px; /* Some padding */
  font-size: 14px; /* Set a font size */
  cursor: pointer; /* Mouse pointer on hover */
  border-radius: 0%;
}
.btn:hover {
  background-color: green;
}
.btn2:hover {
  background-color: rgb(180, 0, 0);
  color: black;
}
.nav-item:hover{
  color: black;
  background-color: lightgray;
  text-decoration: underline;
}
.colore:hover{
  color: red;
}
</style>
