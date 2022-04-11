<template>
<button v-on:click="irareservar" class="reserva"><i class="bi bi-cart-check">Reservar</i></button>
    <div class="">
    </div>
    <div class="container fo">
    <h1 v-if="sitios== ''">No hay sitios registrados</h1>
    <i v-if="sitios== ''" class="bi bi-emoji-frown" style="font-size: 8rem;"></i>
    <span v-show="false"><vue-qr id="elqr" :text="palabra" :size="200"></vue-qr></span>
    <div class="group">
        <h1>
        <button v-show="!confirmfav" v-on:click="addfav" class="btn add"><a><i class="bi bi-heart" style="color:black"></i> Agregar a favoritos</a></button>
    <button v-show="confirmfav" v-on:click="addfav" class="btn add"><a><i class="bi bi-heart-fill" style="color:red"></i> Eliminar de favoritos</a></button>
    {{sitios.nombre}} <button v-on:click="hacerpdf('comentario','70','2022/03/28','08:22','2')" class="btn valorar">Pruebas</button></h1>
      <div class="row">
        <button v-on:click="mover(0)" class="one_third sliderlinks"><i class="bi bi-arrow-left"></i></button>
        <button v-on:click="mover(1)" class="one_third sliderlinks"><i class="bi bi-arrow-right"></i></button>
      </div>
      <div class="one_third first"><a href="#">
      <img class="card-img-top" v-show="this.dato == -1" :src="sitios.logo" alt="Card image cap">
      <div v-for="(catalogo, index) in catalogos" :key="catalogo">
      <img class="card-img-top" v-show="index == this.dato"  :src="catalogo.link" alt=""></div></a></div>
      <div class="two_third">
        <div class="btmspace-50">
          <h3 class="heading">- {{sitios.categoria}} -</h3>
          <p class="nospace">{{sitios.descripcion}}</p>
        </div>
        <ul class="fa-ul clear">
          <li class="one_half first"><i class="fa-li fa fa-globe"></i>
            <h6 class="heading btmspace-10 font-x1"><a href="#">ubicación</a></h6>
            <p>{{sitios.ubicacion}}</p>
          </li>
          <li class="one_half"><i class="fa-li fa bi bi-stars"></i>
            <h6 class="heading btmspace-10 font-x1"><a href="#">{{sitios.ponderacion}} estrellas</a></h6>
            <div class="Row">
                <div v-for="n in 5" :key="n" class="gallery-outer">
                <i v-if="sitios.ponderacion>=n" class="bi bi-star-fill estrella" style="font-size: 2rem;"></i>
                <i v-else-if="sitios.ponderacion%1!=0 && n-1<sitios.ponderacion" class="bi bi-star-half estrella" style="font-size: 2rem;"></i>
                <i v-else class="bi bi-star estrella" style="font-size: 2rem;"></i>
              </div>
              </div>
          </li>
          <li class="one_half first"><i class="fa-li fa fa-whatsapp"></i>
            <h6 class="heading btmspace-10 font-x1"><a href="#">telefono</a></h6>
            <p>{{sitios.telefono}}</p>
          </li>
          <li class="one_half"><i class="fa-li fa bi bi-envelope-check-fill"></i>
            <h6 class="heading btmspace-10 font-x1"><a href="#">Correo</a></h6>
            <p>{{sitios.correo}}</p>
          </li>
        </ul>
      </div>
    </div>
    <div class="scrollable">
        <table>
          <thead>
            <tr>
              <th>Día</th>
              <th>Horario</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(horar, index) in splitedList(sitios.horario)" :key="horar">
          <td ><i class="bi bi-calendar-week-fill"></i> {{dias[index]}}</td>
          <td><i class="bi bi-calendar-event"></i> {{horar}}</td>
        </tr>
          </tbody>
        </table>
      </div>
      <iframe v-show="sitios.mapa != 'NA'" width="100%" height="270"
                  :src="sitios.mapa">
                </iframe>
    <div class="grid" style="text-align:left">
      <ul class="list-group list-group-flush"><h3>Experiencias</h3>
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
    <div id="comments">
        <h2>Comentarios de los clientes</h2>
        <ul v-show="comentarios" class="list-unstyled"></ul>
        <ul v-show="numcomentarios > index" v-for="(comentario, index) in comentarios" :key="index">
          <li>
            <article>
              <header style="text-align:left">
                <i class="bi bi-bookmark-check" style="top:0%;margin-top:0%">Cuenta verificada</i>
                <figure class="avatar"><img :src="comentario.foto" alt=""></figure>
                <address>
                By <a href="#">{{comentario.nombre}} {{comentario.Apaterno}} {{comentario.Amaterno}}</a>
                </address>
                <time><sup>°</sup>{{comentario.fecha.split(' ')[0].split('-')[2]}}/{{comentario.fecha.split(' ')[0].split('-')[1]}}/{{comentario.fecha.split(' ')[0].split('-')[0]}}   @{{comentario.fecha.split(' ')[1].split(':')[0]}}:{{comentario.fecha.split(' ')[1].split(':')[1]}}</time>
              </header>
              <div class="comcont" style="text-align:justify">
                <p>{{comentario.Mensaje}}</p>
              </div>
              <div class="row">
                <p style="margin-left:15px">{{comentario.valoracion}} estrellas {</p>
                  <div v-for="n in 5" :key="n" class="gallery-outer" style="">
                  <i v-if="comentario.valoracion>=n" class="bi bi-star-fill estrella" style="font-size: 1rem;"></i>
                  <i v-else-if="comentario.valoracion%1!=0 && n-1<comentario.valoracion" class="bi bi-star-half estrella" style="font-size: 1rem;"></i>
                  <i v-else class="bi bi-star estrella" style="font-size: 1rem;"></i>
                </div><p class="gallery-outer">}</p>
              </div>
            </article>
          </li>
        </ul>
        <div>
          <button class="btn more" v-show="this.comentarios.length > numcomentarios" v-on:click="actualizarcomentarios">mostrar más</button>
          <button class="btn more" v-show="numcomentarios > 3" v-on:click="actualizarcomentarios2">mostrar menos</button>
        </div>
        </div>
  </div>
  <div class="fo">
    <h2 style="margin-top:25px">Otros sitios similares</h2>
    <hr>
  <div class="gallery-outer" v-for="otrositio in otrositios" :key="otrositio.id">
    <div class="card p-3" style="width: 18rem;">
      <img class="card-img-top" v-show="otrositio.logo" :src="otrositio.logo" alt="Card image cap" style="  width: 220px;height: 150px;">
      <img class="card-img-top" v-show="!otrositio.logo" src="https://zictcian.000webhostapp.com/default.png" alt="Card image cap" style="  width: 220px;height: 150px;">
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
      dato: -1,
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
            const imglogo = new Image()
            const doc = new JsPDF()
            doc.addFont('bromellonavidadregular', 'bromellonavidadregular', 'normal')
            doc.setFont('bromellonavidadregular')
            imgData.src = 'https://media.istockphoto.com/photos/german-stimulus-packages-after-the-corona-crisis-exchange-wooden-cube-picture-id1313171624?k=20&m=1313171624&s=612x612&w=0&h=N-xzDl1llX-1IlT8WzMruog7313DkWuIa9NL8nmJ6sY='
            imglogo.src = 'https://media.istockphoto.com/photos/german-stimulus-packages-after-the-corona-crisis-exchange-wooden-cube-picture-id1313171624?k=20&m=1313171624&s=612x612&w=0&h=N-xzDl1llX-1IlT8WzMruog7313DkWuIa9NL8nmJ6sY='
            const qr = document.getElementById('elqr')
            doc.addImage(imgData, 'png', 55, 30, 90, 60, 'mono')
            doc.setFontSize(22)
            doc.text(70, 20, 'MWReservation')
            doc.setFontSize(14)
            doc.text(20, 110, 'Reservación realizada por: ' + localStorage.getItem('nombre') +
      ' ' + localStorage.getItem('Apaterno') + ' ' + localStorage.getItem('Amaterno'))
            doc.text(20, 115, 'Comentarios: ' + comentario)
            doc.text(20, 140, 'Fecha reservada: ' + new Date(fecha).toLocaleDateString('es-ES', this.options))
            doc.text(20, 145, 'Hora reservada: ' + hora)
            doc.text(20, 150, 'Lugares reservados: ' + personas + ' lugares')
            doc.text(55, 180, 'QR registrado para uso de reservación')
            doc.addImage(qr, 'PNG', 55, 185, 100, 100)
            doc.text(50, 280, 'Fecha de registro' + new Date().toLocaleDateString('es-ES', this.options))
            doc.setFontSize(8)
            doc.text(10, 285, this.palabra)
            doc.setFontSize(14)
            doc.addPage()
            doc.text(20, 220, 'Te gusto la aplicación?')
            doc.text(20, 20, 'Sitio: ' + this.nombre)
            doc.addImage(imglogo, 'PNG', 20, 25, 50, 50)
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
      if (n === 0) {
        this.dato = this.dato - 1
      } else {
        this.dato = this.dato + 1
      }
      if (this.catalogos.length <= this.dato) {
        this.dato = -1
      }
      if (this.dato < (-1)) {
        this.dato = this.catalogos.length - 1
      }
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
                fetch('https://expresstrip.mwcomeniusdocente.com/app/agregarcomentario.php', {
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
      fetch('https://expresstrip.mwcomeniusdocente.com/app/Tarjeta.php', {
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
        console.log(!this.confirmfav)
        if (!this.confirmfav) {
          formdata.append('fav', '1')
        } else {
          formdata.append('fav', '0')
        }
        await fetch('https://expresstrip.mwcomeniusdocente.com/app/cambiofav.php', {
          method: 'POST',
          body: formdata
        }).then(
          respuest => respuest.json()
        ).then((datosRespuest) => {
          console.log('dato', datosRespuest)
          this.validarFav()
          this.$swal('Sitio alterado', 'Modificacion de favorito', 'success')
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
        fetch('https://expresstrip.mwcomeniusdocente.com/app/validfav.php', {
          method: 'POST',
          body: formdata
        }).then(
          respuest => respuest.json()
        ).then((datosRespuest) => {
          console.log('dato', datosRespuest.favorite)
          this.confirmfav = false
          try {
            if (datosRespuest.favorite === '1') {
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
      await fetch('https://expresstrip.mwcomeniusdocente.com/app/home2.php', {
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
      fetch('https://expresstrip.mwcomeniusdocente.com/app/catalogo.php', {
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
      fetch('https://expresstrip.mwcomeniusdocente.com/app/comentarios.php', {
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
.more{
  box-decoration-break: none;
}
.more:hover{
  text-decoration: underline;
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

.estrella{
  color: red;
}
.fo{
  padding-bottom: 10px;
}
.valorar:hover{
  text-decoration: underline;
}
.sliderlinks{
  border-radius: 50%;
  height: 3rem;
  background-color: aliceblue;
  justify-content: center;
  display: inline-block;
  width: 3rem;
  margin: 1rem 8;
  align-items: center;
  justify-content: center;
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
  background-color: #A3BF00;
  color:white;
  position:fixed;
  bottom: 70%;
  right: 90%;
  width: 100px;
  height: 100px;
  border-radius: 50%;
}
.reserva:hover{
  background-color: white;
  color: lightgray;
  text-decoration: underline;
}
</style>
