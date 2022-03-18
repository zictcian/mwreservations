<template>
    <h1>{{sitios.nombre}}</h1>
    <div class="container fo">
    <h1 v-if="sitios== ''">No hay sitios registrados</h1>
    <i v-if="sitios== ''" class="bi bi-emoji-frown" style="font-size: 8rem;"></i>
  <div class="container">
    <div class="row">
    <div class="card espacio" style="width: 24rem;">
      <img class="card-img-top" :src="sitios.logo" alt="Card image cap">
      <div class="card-body bodycard">
        <h3>- {{sitios.categoria}} -</h3>
        <button v-on:click="prueba" class="btn btn-primary"><a style="color:white">Ir a reservar</a></button>
      </div>
      <div class="card-footer">
        <button class="btn valorar">Valorar</button><br>
      {{sitios.ponderacion}} estrellas
      <div class="Row">
        <div v-for="n in 5" :key="n" class="gallery-outer">
        <i v-if="sitios.ponderacion>=n" class="bi bi-star-fill estrella" style="font-size: 2rem;"></i>
        <i v-else-if="sitios.ponderacion%1!=0 && n-1<sitios.ponderacion" class="bi bi-star-half estrella" style="font-size: 2rem;"></i>
        <i v-else class="bi bi-star estrella" style="font-size: 2rem;"></i>
      </div>
      </div>
    </div>
    </div>
    <div class="card espacio" style="">
  <div class="card-header textocard">
    <button v-show="!confirmfav" v-on:click="prueba" class="btn add"><a><i class="bi bi-heart" style="color:black"></i> Agregar a favoritos</a></button>
    <button v-show="confirmfav" v-on:click="prueba" class="btn add"><a><i class="bi bi-heart-fill" style="color:red"></i> Eliminar de favoritos</a></button>
    </div>
  <div class="card-body">
    <h5 class="card-title">Datos de descripción</h5>
    <table style="">
      <tbody class="tablacuerpo" style="background-color:white">
        <tr>
          <td style="width: 150px"><i class="bi bi-telephone-forward"></i> telefono</td>
          <td style="width: 550px;">{{sitios.telefono}}</td>
        </tr>
        <tr>
          <td style="width: 150px"><i class="bi bi-geo-alt-fill"></i> ubicación</td>
          <td style="width: 550px;">{{sitios.ubicacion}}</td>
        </tr>
        <tr>
          <td style="width: 150px">Descripción</td>
          <td style="width: 550px;"><textarea :disabled="true" v-model="sitios.descripcion" name="textarea" rows="4" cols="50"></textarea></td>
        </tr>
      </tbody>
    </table>
    <div class="Container">
      <div class="row">
      <table class="tablacuerpo">
        <thead>
          <tr>
          <td style="width: 100px"><i class="bi bi-calendar2"></i> Dia</td>
          <td style="width: 150px;">Horario</td>
        </tr>
        </thead>
        <tbody>
          <tr v-for="(horar, index) in splitedList(sitios.horario)" :key="horar">
          <td style="width: 100px"><i class="bi bi-calendar-week-fill"></i> {{dias[index]}}</td>
          <td style="width: 100px;"><i class="bi bi-calendar-event"></i> {{horar}}</td>
        </tr>
        </tbody>
      </table>
      <div class="titulos" style="width:400px;">
        Catalogo
        <ol>
        <li value="0" v-if="false"></li>
        <li v-for="(catalogo, index) in catalogos" :key="index">{{catalogo.title}}</li>
        </ol>
      </div>
    </div>
    </div>
    </div>
</div>
</div>
  </div>
  <div v-show="catalogos != ''" class="slidercontrol">
      <div class="gallery-outer" v-for="(catalogo ,index) in catalogos" :key="index">
        <button :disabled="index == this.dato" v-on:click="mover(index)" class="sliderlinks">{{index+1}}</button>
        </div>
      </div>
  <div v-show="catalogos != ''" class="slider">
    <div v-for="(catalogo, index) in catalogos" :key="catalogo">
      <transition name="fade">
      <img v-show="index == this.dato"  class="imagen" :src="catalogo.link" alt=""></transition>
    </div>
  </div>

  <ul v-show="comentarios" class="list-unstyled">
  <li class="media tarjetas" v-for="(comentario, index) in comentarios" :key="comentario.id">
    <img class="mr-3 logo" :src="comentario.foto" alt="Generic placeholder image">
    <div class="media-body" style="background-color:white;margin-right: 10px;">
       <div class="Row">
        <h3 class="mt-0 mb-1">{{index+1}}° comentario de {{comentario.nombre}}</h3>
        <h2 class="gallery-outer">{{comentario.valoracion}} estrellas</h2>
        <div v-for="n in 5" :key="n" class="gallery-outer">
        <i v-if="comentario.valoracion>=n" class="bi bi-star-fill estrella" style="font-size: 2rem;"></i>
        <i v-else-if="comentario.valoracion%1!=0 && n-1<comentario.valoracion" class="bi bi-star-half estrella" style="font-size: 2rem;"></i>
        <i v-else class="bi bi-star estrella" style="font-size: 2rem;"></i>
      </div>
      </div>
      <hr>
      {{comentario.Mensaje}}
      </div>
  </li>
  </ul>
  </div>
</template>

<script>
export default {
  name: 'TarjetaMW',
  data () {
    return {
      confirmfav: '',
      dato: 0,
      catalogos: [],
      comentarios: [],
      sitios: [{
        horario: ''
      }],
      nombre: this.$route.params.id,
      id: this.$route.params.id,
      dias: ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo']
    }
  },
  created: async function () {
    await this.traersitios()
  },
  methods: {
    mover (n) {
      this.dato = n
      console.log(n, this.dato)
    },
    prueba () {
      this.$swal.fire({
        title: 'Alerta',
        text: '¿Quieres guardar este sitio en favoritos?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        showCloseButton: true,
        showLoaderOnConfirm: true
      }).then((result) => {
        if (result.value) {
          const us = localStorage.getItem('valor')
          console.log(us)
          if (us !== '0') {
            this.addfav()
          } else {
            this.$swal('Inicia sesión', 'operación anulada', 'info')
          }
        } else {
          this.$swal('Cancelado', 'operación cancelada', 'info')
        }
      })
    },
    splitedList (row) {
      return (row !== null) ? row.split(',') : ''
    },
    encryp: function (palabra) {
      const palabraencryp = btoa(palabra)
      console.log(palabra)
      console.log(palabraencryp)
      return palabraencryp
    },
    desencryp: async function (palabra) {
      const palabradesencryp = atob(palabra)
      console.log(palabra)
      console.log(palabradesencryp)
      return palabradesencryp
    },
    async traersitios () {
      const sit = await this.desencryp(this.id)
      const formdata = new FormData()
      formdata.append('Idsitio', sit)
      fetch('http://localhost/mwreservation/Tarjeta.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        this.sitios = []
        if (typeof datosRespuest.success === 'undefined') {
          this.sitios = datosRespuest
          this.traercatalogo()
          this.traerComentarios()
          this.validarFav()
        }
      }).catch(console.log)
    },
    async addfav () {
      const usua = localStorage.getItem('valor')
      if (usua !== '0') {
        const sit = await this.desencryp(this.id)
        const formdata = new FormData()
        formdata.append('IdSitio', sit)
        formdata.append('IdUsua', usua)
        formdata.append('fav', this.confirmfav ? '0' : '1')
        fetch('http://localhost/mwreservation/cambiofav.php', {
          method: 'POST',
          body: formdata
        }).then(
          respuest => respuest.json()
        ).then((datosRespuest) => {
          console.log('dato', datosRespuest)
          try {
            if (datosRespuest !== 'error') {
              this.validarFav()
              this.$swal('Sitio alterado', 'Modificacion de favorito', 'success')
            }
          } catch (e) {
          }
        }).catch(console.log)
      } else {
        this.prueba()
      }
    },
    async validarFav () {
      const usua = localStorage.getItem('valor')
      if (usua !== '0') {
        const sit = await this.desencryp(this.id)
        const formdata = new FormData()
        formdata.append('IdSitio', sit)
        formdata.append('IdUsua', usua)
        fetch('http://localhost/mwreservation/validfav.php', {
          method: 'POST',
          body: formdata
        }).then(
          respuest => respuest.json()
        ).then((datosRespuest) => {
          console.log('dato', datosRespuest.favorite)
          this.confirmfav = false
          try {
            if (datosRespuest.favorite !== '0') {
              this.confirmfav = true
              console.log('verdadero')
            }
          } catch (e) {
          }
        }).catch(console.log)
      }
    },
    async traercatalogo () {
      const sit = await this.desencryp(this.id)
      const formdata = new FormData()
      formdata.append('Idsitio', sit)
      fetch('http://localhost/mwreservation/catalogo.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        this.catalogos = []
        if (typeof datosRespuest[0].success === 'undefined') {
          this.catalogos = datosRespuest
        }
      }).catch(console.log)
    },
    async traerComentarios () {
      const sit = await this.desencryp(this.id)
      const formdata = new FormData()
      formdata.append('idsitio', sit)
      fetch('http://localhost/mwreservation/comentarios.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        this.comentarios = []
        if (typeof datosRespuest[0].success === 'undefined') {
          this.comentarios = datosRespuest
        }
      }).catch(console.log)
    }
  }
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0
}
.fo{
  margin-bottom: 50px;
}
.col{
  padding-left: 5%;
  margin-left: 5%;
  padding-right: 5%;
  margin-right: 5%;
  margin-bottom: 5%;
}
.logo{
  border-radius: 50%;
  background-color: black;
  width: 150px;
  height: 150px;
  margin: 10px;
}
.tarjetas{
  background-color: lightgrey;
  position:relative;
  width: 1085px;
  margin-bottom: 25px;
  border-radius: 0%;
  align-items: center;
  text-overflow: ellipsis;
}
.gallery-outer{
  display: inline-block;
  zoom: 1;
  text-align: center;
  vertical-align: top;
  margin-left: 5%;
}
.bodycard{
  height: 150px;
  width: 400px;
  overflow: hidden;
  text-overflow: ellipsis;
}
.textocard{
  overflow: ellipsis;
  text-align: left;
}
.estrella{
  color: red;
}

.espacio{
  height: 500px;
  width: 700px;
}
.tablacuerpo{
  text-align: left;
}
.tablacabeza{
  text-align: left;
}
.titulos {
  margin-left: 30px;
  text-align: left;
  align-content: left;
}
.slider{
  height: 500px;
  background-color: rgb(238, 238, 238);
  overflow: hidden;
  width: 1085px;
  contain:size;
  position: relative;
  scroll-snap-type: y mandatory;
  margin-bottom: 50px;
}
.slidercontrol{
  position:relative;
  width: 1085px;
  height: 3rem;
  background-color: goldenrod;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}
.imagen{
  background-position: center;
  background-size: contain;
  position: flex;
}
.fo{
  padding-bottom: 25px;
}
.valorar:hover{
  text-decoration: underline;
  color: blueviolet;
  cursor:grab;
}
.sliderlinks{
  border-radius: 50%;
  height: 3rem;
  background-color: aliceblue;
  justify-content: center;
  display: flex;
  width: 3rem;
  margin: 1rem 8;
  align-items: center;
}
.sliderlinks:hover{
  background-color: black;
  color: white;
  cursor: pointer;
}
.add:hover{
  text-decoration: underline;
}
</style>
