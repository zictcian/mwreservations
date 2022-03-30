<template>
<button v-on:click="irareservar" class="btn btn-success reserva"><i class="bi bi-cart-check"></i> Reservar </button>
    <h1>{{sitios.nombre}}</h1>
    <div class="container fo">
    <h1 v-if="sitios== ''">No hay sitios registrados</h1>
    <i v-if="sitios== ''" class="bi bi-emoji-frown" style="font-size: 8rem;"></i>
    <span v-show="false"><vue-qr id="elqr" :text="palabra" :size="200"></vue-qr></span>
  <div class="container">
    <div class="row">
    <div class="card espacio" style="width: 24rem;">
      <img class="card-img-top" :src="sitios.logo" alt="Card image cap">
      <div class="card-body bodycard">
        <h3>- {{sitios.categoria}} -</h3>
        <button v-on:click="hacerqr" class="btn valorar btn-primary" style="margin-top: 10px"><h6>antes</h6></button>
        <button v-on:click="hacerpdf('comentario','70','2022/03/28','08:22','2')" class="btn valorar btn-primary" style="margin-top: 10px"><h6>Pruebas</h6></button>
        <button v-on:click="nuevavaloracion" class="btn valorar btn-primary" style="margin-top: 10px"><h5>Valorar sitio</h5></button>
      </div>
      <div class="card-footer">
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
    <button v-show="!confirmfav" v-on:click="addfav" class="btn add"><a><i class="bi bi-heart" style="color:black"></i> Agregar a favoritos</a></button>
    <button v-show="confirmfav" v-on:click="addfav" class="btn add"><a><i class="bi bi-heart-fill" style="color:red"></i> Eliminar de favoritos</a></button>
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
        <li value="0" v-show="catalogos == ''">Sin imagenes registradas</li>
        <li v-for="(catalogo, index) in catalogos" :key="index">{{catalogo.title}}</li>
        </ol>
      </div>
    </div>
    </div>
    </div>
</div>
</div>
  <div class="row">
  <ul class="list-group list-group-flush limitacion"><h3 class="list-group-item" style="background-color:goldenrod">Experiencias</h3>
    <ol class="list-group-item" v-show="sitios.que_haras != ''">Qué harás: <br>{{sitios.que_haras}}</ol>
    <ol class="list-group-item" v-show="sitios.en_detalle != ''">Detalle: <br>{{sitios.en_detalle}}</ol>
    <ol class="list-group-item" v-show="sitios.incluye != ''">Incluye: <br>{{sitios.incluye}}</ol>
    <ol class="list-group-item" v-show="sitios.no_apto_para != ''">No apto para: <br>{{sitios.no_apto_para}}</ol>
    <ol class="list-group-item" v-show="sitios.covid_precauciones != ''">Precauciones del Covid-19: <br>{{sitios.covid_precauciones}}</ol>
    <ol class="list-group-item" v-show="sitios.covid_requisitos!= ''">Requisitos del Covid-19: <br>{{sitios.covid_requisitos}}</ol>
    <ol class="list-group-item" v-show="sitios.que_llevar != ''">Qué llevar: <br>{{sitios.que_llevar}}</ol>
    <ol class="list-group-item" v-show="sitios.no_permitido != ''">No permitido: <br>{{sitios.no_permitido}}</ol>
  </ul>
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
  <div class="comentarios">
    <h2>Comentarios de los clientes</h2>
    <hr style="top:0%">
    <h3 v-show="comentarios == ''">Sin Comentarios</h3>
  <ul v-show="comentarios" class="list-unstyled">
  <li v-show="numcomentarios > index" class="media tarjetas" v-for="(comentario, index) in comentarios" :key="index">
    <img class="mr-3 logo" :src="comentario.foto" alt="Generic placeholder image">
    <div class="media-body" style="margin-right: 10px;">
       <i class="bi bi-bookmark-check" style="top:0%;margin-top:0%">Cuenta verificada</i>
       <div class="row" style="margin-left:3px">
        <h6 class="mt-0 mb-1" style="text-align:left;width:200px">{{comentario.nombre}} {{comentario.Apaterno}} {{comentario.Amaterno}}</h6>
        <p class="">{{comentario.valoracion}} estrellas {</p>
        <div v-for="n in 5" :key="n" class="gallery-outer" style="">
        <i v-if="comentario.valoracion>=n" class="bi bi-star-fill estrella" style="font-size: 1rem;"></i>
        <i v-else-if="comentario.valoracion%1!=0 && n-1<comentario.valoracion" class="bi bi-star-half estrella" style="font-size: 1rem;"></i>
        <i v-else class="bi bi-star estrella" style="font-size: 1rem;"></i>
      </div>
                                                                            <p class="gallery-outer">}</p>
  <p style="margin-left:10%">{{comentario.fecha.split(' ')[0].split('-')[2]}}/{{comentario.fecha.split(' ')[0].split('-')[1]}}/{{comentario.fecha.split(' ')[0].split('-')[0]}} {{comentario.fecha.split(' ')[1]}}</p>
      </div>
      <div class="cuerpotarjeta">{{comentario.Mensaje}}</div>
      </div>
  </li>
  <div>
    <button class="btn more" v-show="this.comentarios.length > numcomentarios" v-on:click="actualizarcomentarios">mostrar más</button>
    <button class="btn more" v-show="numcomentarios > 3" v-on:click="actualizarcomentarios2">mostrar menos</button>
    </div>
  </ul>
  </div>
  </div>
  <div class="container fo">
    <h2 style="margin-top:25px">Otros sitios similares</h2>
    <hr>
  <div class="gallery-outer" v-for="otrositio in otrositios" :key="otrositio.id">
    <div class="card p-3" style="width: 18rem;">
      <img class="card-img-top" :src="otrositio.logo" alt="Card image cap">
      <div class="card-body bodycard2">
        <h5 class="card-title">{{otrositio.nombre}}</h5>
      </div>
      <button v-on:click="ir(otrositio.id, otrositio.nombre)" class="btn btn-primary">Reserva por ${{otrositio.anticipo}}</button>
      <div class="card-footer">
      {{otrositio.ponderacion}} estrellas
      <div class="Row">
        <div v-for="n in 5" :key="n" class="gallery-outer">
        <i v-if="otrositio.ponderacion>=n" class="bi bi-star-fill estrella"></i>
        <i v-else-if="otrositio.ponderacion%1!=0 && n-1<otrositio.ponderacion" class="bi bi-star-half estrella"></i>
        <i v-else class="bi bi-star estrella"></i>
      </div>
      </div>
    </div>
    </div>
  </div>
  </div>
</template>

<script>
import JsPDF from 'jspdf'
import VueQr from 'vue-qr/src/packages/vue-qr.vue'
export default {
  name: 'TarjetaMW',
  data () {
    return {
      numcomentarios: 3,
      confirmfav: '',
      dato: 0,
      catalogos: [],
      comentarios: [],
      sitios: [{
        horario: ''
      }],
      palabra: '',
      otrositios: [],
      nombre: this.$route.params.nombre,
      id: this.$route.params.id,
      dias: ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'],
      options: { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }
    }
  },
  created: async function () {
    await this.traersitios()
  },
  components: { VueQr },
  methods: {
    hacerqr: async function () {
      return new Promise((resolve, reject) => {
        // here our function should be implemented
        setTimeout(() => {
          console.log('Hello from inside the testAsync function')
          this.palabra = this.encryp('1' + this.id + this.nombre + Date())
        }, 2000
        )
      })
    },
    async hacerpdf (comentario, minutosR, fecha, hora, personas) {
      return new Promise((resolve, reject) => {
        let timerInterval
        this.$swal.fire({
          title: 'Procesando reservacion',
          html: 'Tiempo estimado <b></b> milisegundos.',
          timer: 2500,
          timerProgressBar: true,
          didOpen: () => {
            this.$swal.showLoading()
            const b = this.$swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
              b.textContent = this.$swal.getTimerLeft()
            }, 100)
          },
          willClose: () => {
            clearInterval(timerInterval)
          }
        }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === this.$swal.DismissReason.timer) {
            console.log('Reservacion realizada')
          }
        }).catch(console.log)
        const usua = localStorage.getItem('valor')
        if (usua !== '') {
          this.palabra = this.encryp(usua + this.id + this.nombre + Date())
          setTimeout(() => {
            const imgData = new Image()
            const doc = new JsPDF()
            imgData.src = 'https://media.istockphoto.com/photos/german-stimulus-packages-after-the-corona-crisis-exchange-wooden-cube-picture-id1313171624?k=20&m=1313171624&s=612x612&w=0&h=N-xzDl1llX-1IlT8WzMruog7313DkWuIa9NL8nmJ6sY='
            const qr = document.getElementById('elqr')
            doc.addFont('Roboto-Bold.ttf', 'Roboto', 'normal')
            doc.setFont('Roboto')
            doc.addImage(imgData, 'png', 50, 30, 90, 60, 'mono')
            doc.setFontSize(22)
            doc.text(70, 20, 'MWReservation')
            doc.setFontSize(14)
            doc.text(20, 110, 'Comentarios: ' + comentario)
            doc.text(20, 120, 'Tiempo reservado: ' + minutosR + ' minutos')
            doc.text(20, 130, 'Fecha reservada: ' + new Date(fecha).toLocaleDateString('es-ES', this.options))
            doc.text(20, 140, 'Hora reservada: ' + hora)
            doc.text(20, 150, 'Lugares reservados: ' + personas)
            doc.text(20, 160, 'Reservacion realizada por: ' + localStorage.getItem('nombre') +
      ' ' + localStorage.getItem('Apaterno') + ' ' + localStorage.getItem('Amaterno'))
            doc.text(70, 170, 'QR registrado para uso de reservación')
            doc.addImage(qr, 'PNG', 50, 175, 100, 100)
            doc.addPage()
            doc.text(20, 20, 'Te gusto la aplicación?')
            window.open(URL.createObjectURL(doc.output('blob')))
            // doc.save('Test.pdf')
            this.$swal('Reservacion realizada', 'Validación realizada', 'success')
          }, 2000
          )
        } else {
          this.$swal('Inicio de sesión necesario', 'ingresa sesión primero', 'info')
        }
      })
    },
    async ir (dato, nombre) {
      dato = this.encryp(dato)
      await this.$router.push({ name: 'TarjetaMW', params: { nombre: nombre, id: dato } })
      this.$router.go(0)
    },
    async irareservar () {
      await this.$router.push({ name: 'ReservacionMW', params: { nombre: this.nombre, id: this.id } })
      this.$router.go(0)
    },
    actualizarcomentarios () {
      this.numcomentarios = this.numcomentarios + 3
    },
    actualizarcomentarios2 () {
      this.numcomentarios = this.numcomentarios - 3
    },
    mover (n) {
      this.dato = n
      console.log(n, this.dato)
    },
    nuevavaloracion () {
      this.$swal.fire({
        title: 'Escribe tu comentario',
        html: `
  <div class="input-group">
  <div class="input-group-prepend">
  <span class="input-group-text">Comentario</span>
  </div>
  <textarea id="input1" class="form-control" aria-label="With textarea"></textarea>
  </div>
  <br>
  <label>Clasificación por estrellas</label>
  <p class="clasificacion">
    <input id="radio1" type="radio" name="estrellas" value="1"><!--
    --><label for="radio1" onclick="document.getElementById('valor').style.display = 'none';">★</label><!--
    --><input id="radio2" type="radio" name="estrellas" value="2"><!--
    --><label for="radio2" onclick="document.getElementById('valor').style.display = 'inline';">★</label><!--
    --><input id="radio3" type="radio" name="estrellas" value="3"><!--
    --><label for="radio3" onclick="document.getElementById('valor').style.display = 'inline';">★</label><!--
    --><input id="radio4" type="radio" name="estrellas" value="4"><!--
    --><label for="radio4" onclick="document.getElementById('valor').style.display = 'inline';">★</label><!--
    --><input id="radio5" type="radio" name="estrellas" value="5"><!--
    --><label for="radio5" onclick="document.getElementById('valor').style.display = 'inline';">★</label>
  </p><label id="valor">Decimales: <input type="number" min="0" max="9" id="numero" value="0"></label>
  <style scoped>
  input[type = "radio"]{ display:none;}
label{ color:grey;}
.clasificacion{
      direction: rtl;/* right to left */
      unicode-bidi: bidi-override;/* bidi de bidireccional */
  }
  label:hover{color:orange;}
  label:hover ~ label{color:orange;}
  input[type = "radio"]:checked ~ label{color:orange;}
  </style>`,
        showCancelButton: true,
        confirmButtonText: 'Comentar',
        showLoaderOnConfirm: true,
        preConfirm: function () {
          const memo = document.getElementsByName('estrellas')
          let memory
          for (let i = 0; i < memo.length; i++) {
            if (memo[i].checked) {
              memory = 5 - i
            }
          }
          if (typeof memory === 'undefined') {
            memory = 0
          }
          return [
            document.getElementById('input1').value,
            memory,
            document.getElementById('numero').value
          ]
        },
        allowOutsideClick: () => !this.$swal.isLoading()
      }).then(async (result) => {
        console.log(result.value)
        const comen = result.value[0]
        const d = result.value[2].charAt(0)
        let ponde = result.value[1] + '.' + d
        console.log(ponde, comen)
        if (d !== '.') {
          if (result.value[1] === 5) {
            console.log('bien')
            ponde = '5.0'
          }
          if (comen !== '') {
            if (ponde <= 5 && ponde >= 0) {
              const usua = localStorage.getItem('valor')
              if (usua !== '0') {
                const sit = await this.desencryp(this.id)
                const formdata = new FormData()
                formdata.append('IdSitio', sit)
                formdata.append('IdUsua', usua)
                formdata.append('comentario', comen)
                formdata.append('ponderacion', ponde)
                fetch('http://localhost/mwreservation/agregarcomentario.php', {
                  method: 'POST',
                  body: formdata
                }).then(
                  respuest => respuest.json()
                ).then((datosRespuest) => {
                  console.log('dato', datosRespuest)
                  if (datosRespuest !== 'error') {
                    this.traerComentarios()
                    this.$swal('valoración exitosa', 'Comentario realizado', 'success')
                  } else {
                    this.$swal('Error de carga', 'Comentario no realizado', 'error')
                  }
                }).catch(console.log)
              } else {
                this.$swal('Inicia sesión', 'operación anulada', 'info')
              }
            } else {
              this.$swal('ingresa una ponderacion valida', 'valores aceptados del 0 al 5', 'info')
            }
          } else {
            this.$swal('error de comentario', 'Es requerido contar con un comentario', 'info')
          }
        } else {
          this.$swal('Error de ponderacion', 'las ponderacion no valida', 'info')
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
          this.traerotrositios()
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
        this.$swal('Inicia sesión', 'operación anulada', 'info')
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
    async traerotrositios () {
      const formdata = new FormData()
      const sit = await this.desencryp(this.id)
      formdata.append('IdSitio', sit)
      await fetch('http://localhost/mwreservation/home2.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        this.otrositios = []
        if (typeof datosRespuest[0].success === 'undefined') {
          this.otrositios = datosRespuest
        }
      }).catch(console.log)
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
.limitacion{
  width: 1080px;
  background-color: goldenrod;
  text-align: left;
  padding-left: 5%;
  padding-right: 5%;
}
.col{
  padding-left: 5%;
  margin-left: 5%;
  padding-right: 5%;
  margin-right: 5%;
  margin-bottom: 5%;
}
.comentarios{
  align-items: left;
  padding-left: 0px;
  width: 1080px;
  padding-bottom: 50px;
  background:white
}
.more{
  box-decoration-break: none;
}
.more:hover{
  text-decoration: underline;
}

.logo{
  border-radius: 50%;
  width: 50px;
  height: 50px;
  margin: 10px;
}
.cuerpotarjeta{
  height: 55px;
  text-align: justify;
  text-overflow: ellipsis;
  align-content: left;
  align-items: left;
}
.tarjetas{
  position:relative;
  height: 125px;
  width: 1000px;
  margin-bottom: 25px;
  border-radius: 0%;
  text-align: justify;
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
.bodycard2{
  height: 50px;
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
  margin-bottom: 20px;
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
.reserva{
  color:white;
  position: fixed;
  bottom: 70px;
  right: 40px;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border-color: black;
}
</style>
