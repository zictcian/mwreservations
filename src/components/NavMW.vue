<template>
<div>
  <div class="wrapper row0">
  <div id="topbar" class="hoc clear">
    <div class="fl_left">
      <ul class="faico clear">
        <li><abbr title="Home"><a href="/"><i class="bi bi-house-fill colore" style="font-size: 1.5rem;"></i></a></abbr></li>
      </ul>
    </div>
    <!-- ################################################################################################ -->
    <div class="fl_right">
      <ul class="nospace inline pushright">
          <li v-show="cliente=='2'">
              <abbr title="Local"><a v-on:click="ir(this.dato, this.nombre)" class="nav-link"><i class="bi bi-card-heading colore" style="font-size: 1.5rem;"></i></a></abbr>
            </li>
            <li>
              <abbr title="Lugares"><a href="/inicio" ><i class="bi bi-shop-window colore" style="font-size: 1.5rem;"></i></a></abbr>
            </li>
            <li >
              <abbr title="Favoritos"><a href="/fav" ><i class="bi bi-heart" style="font-size: 1.5rem;"></i></a></abbr>
            </li>
            <li>
              <abbr title="Categorias"><a href="/categorias" ><i class="bi bi-tags" style="font-size: 1.5rem;"></i></a></abbr>
            </li>
            <li>
              <abbr title="Login"><a href="/login" ><i class="bi bi-box-arrow-right" style="font-size: 1.5rem;"></i></a></abbr>
            </li>
            <li>
              <abbr title="Reservaciones"><a href="/carrito" ><i class="bi bi-cart colore" style="font-size: 1.5rem;"></i></a></abbr>
            </li>
            <li>
              <abbr title="Cuenta"><a href="/usuario" ><i v-show="cliente!='2'" class="bi bi-person-circle colore" style="font-size: 1.5rem;"></i><i v-show="cliente=='2'" class="bi bi-building" style="font-size: 1.5rem;"></i></a></abbr>
            </li>
      </ul>
    </div>
    <!-- ################################################################################################ -->
  </div>
  <div class="wrapper row1">
    <header id="header" class="hoc clear">
      <!-- ################################################################################################ -->
      <div id="logo" class="fl_left">
        <h1><a href="/">Express Trip</a></h1>
      </div>
      <nav id="mainav" class="fl_right">
        <ul class="clear">
          <li><a class="drop" href="#"><i class="bi bi-map"></i></a>
            <ul style="height:100px; overflow:hidden; overflow-y:scroll;background-color:white;">
              <li v-for="(zon, index) in zonas" :key="index" v-on:click="change(zon.estado)"><a href="#">{{zon.estado}}</a>
              </li>
            </ul>
          </li>
          <li><a class="drop" href="#">Zonas</a>
            <ul>
              <li>
              <i v-on:click="Zonaquitar()" class="bi bi-trash" style="position:absolute;display: block;bottom: .5rem;left: -.5rem;color:red"></i>
              <input v-model="zona" class="form-control" type="text" placeholder="Buscar zona" style="margin-left:10px">
              <i v-on:click="Zonaselec()" class="bi bi-arrow-right-circle" style="position:absolute;display: block;bottom: .5rem;right: 1rem;"></i>
              </li>
            </ul>
          </li>
          <li><a class="drop" href="#">Busqueda</a>
            <ul>
              <li><input v-model="busqueda" type="text" class="form-control" placeholder="Buscar lugar">
              <i v-on:click="buscar" class="fa fa-search" style="position:absolute;display: block;bottom: .5rem;right: 1rem;"></i>
              </li>
            </ul>
          </li>
          <li><i class="bi bi-question-circle"></i></li>
        </ul>
      </nav>
      <!-- ################################################################################################ -->
    </header>
  </div>
</div>
    </div>
</template>

<script>
import '../layout/styles/layout.css'
export default {
  name: 'NavMW',
  data () {
    return {
      busqueda: '',
      zona: localStorage.getItem('zonaname'),
      zonas: [],
      zonaid: localStorage.getItem('zona'),
      cliente: localStorage.getItem('nivel'),
      nombre: localStorage.getItem('Nlocal'),
      dato: localStorage.getItem('local')
    }
  },
  created: function () {
    this.traersitios()
  },
  methods: {
    encryp: function (palabra) {
      const palabraencryp = btoa(palabra)
      console.log(palabra)
      console.log(palabraencryp)
      return palabraencryp
    },
    async ir (dato, nombre) {
      dato = this.encryp(dato)
      await this.$router.push({ name: 'TarjetaMW', params: { nombre: nombre, id: dato } })
      this.$router.go(0)
    },
    traersitios () {
      const formdata = new FormData()
      formdata.append('IdUsua', localStorage.getItem('valor'))
      fetch('https://expresstrip.mwcomeniusdocente.com/app/zone.php', {
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
      console.log(this.zona)
      const formdata = new FormData()
      formdata.append('zona', this.zona)
      await fetch('https://expresstrip.mwcomeniusdocente.com/app/buscarzona.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        if (datosRespuest !== null) {
          localStorage.setItem('zona', datosRespuest.id)
          localStorage.setItem('zonaname', datosRespuest.estado)
        } else {
          localStorage.setItem('zona', '-1')
          localStorage.setItem('zonaname', this.zona)
        }
      }).catch(e => {
        console.log(e)
        localStorage.setItem('zona', '')
        localStorage.setItem('zonaname', '')
      })
      await this.$router.push({ path: '/inicio', replace: true })
      this.$router.go(0)
    },
    async Zonaquitar () {
      localStorage.setItem('zona', '0')
      localStorage.setItem('zonaname', '')
      await this.$router.push({ path: '/inicio', replace: true })
      this.$router.go(0)
    },
    change (a) {
      this.zona = a
    }
  }
}
</script>

<style scoped>
</style>
