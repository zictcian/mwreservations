<template>
    <h1 v-if="false">No hay sitios registrados</h1>
    <i v-if="false" class="bi bi-emoji-frown" style="font-size: 8rem;"></i>
    <ul class="list-group-item list-group-item-success">Ubicacion</ul>
    <li class="list-group-item">{{sitios.ubicacion}}</li>
    <table class="table">
        <tbody>
            <tr>
                <td class="tablaimg">
                    <div class="text-center">
                       <img :src="sitios.logo" class="tablaimg">
                    </div>
                </td>
                <td>
                <iframe v-show="sitios.mapa != 'NA'" width="100%" height="270"
                  :src="sitios.mapa">
                </iframe>
                <h3 v-show="sitios.mapa == 'NA'"><hr>No se ha podido cargar el mapa</h3>
                </td>
                <td class="fila2">
                    <li v-for="(horar,index) in splitedList(sitios.horario)" :key="horar" class="letra list-group-item">{{dias[index]}}: {{horar}}</li>
                </td>
            </tr>
        </tbody>
    </table>
    <div class=" fo">
  <div class="form-group delimitado">
        <h2><i class="bi bi-cart-check"></i> Realizar Reservacion</h2><hr>
        <div class="input-group mb-3">
        <div class="input-group-prepend">
        <span class="input-group-text">fecha</span>
        </div>
        <input v-model="fecha" type="date" class="form-control" v-on:change="cambiofecha(fecha)">
        </div>
        <div class="input-group mb-3">
        <span class="input-group-text">Reservacion para: el {{FechaSelect}}</span>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Horarios</label>
          </div>
          <select class="custom-select" id="horarioseleccionado">
            <option selected></option>
            <option :value="horar.id" v-for="(horar, index) in horarios" :key="index" :disabled="!(horar.limite > 0)">{{horar.horaIni}} a {{horar.horaFin}}. Reservaciones disponibles: {{horar.limite}}</option>
          </select>
        </div>
        <div class="input-group mb-3">
        <div class="input-group-prepend">
        <span class="input-group-text">Personas</span>
        </div>
        <input v-model="personas" type="number" class="form-control" placeholder="ejemplo: 2" min="1">
        </div>
        <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text">Comentario</span>
        </div>
        <textarea v-model="comentario" class="form-control" maxlength="250" placeholder="ejemplo: Orden de nachos"></textarea>
        </div>
        <button v-on:click="reservar" style="margin:15px" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Reservar</button>
        <button v-on:click="cancelar" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Cancelar</button>
  </div>
  </div>
</template>

<script>
import JsPDF from 'jspdf'
import moment from 'moment'
export default {
  name: 'ReservacionMW',
  data: function () {
    return {
      fecha: '',
      FechaSelect: '',
      personas: '',
      comentario: '',
      nombre: this.$route.params.id,
      id: this.$route.params.id,
      sitios: [],
      horarios: [],
      limites: [],
      seleccion: [],
      dias: ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'],
      options: { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }
    }
  },
  created: async function () {
    await this.traersitios()
  },
  methods: {
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
    async cambiofecha (defecha) {
      const fechita = new Date(defecha)
      const refecha = fechita.getDate() + 1
      fechita.setDate(refecha)
      const sit = await this.desencryp(this.id)
      const formdata = new FormData()
      const newfecha = fechita.toLocaleDateString('es-ES', this.options).split(',')[0]
      this.FechaSelect = fechita.toLocaleDateString('es-ES', this.options)
      formdata.append('Idsitio', sit)
      formdata.append('fecha', defecha)
      formdata.append('dia', newfecha)
      console.log(newfecha)
      await fetch('http://localhost/mwreservation/prereservahorario.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        // recorrer todo el horario buscando id = y asi restar antes de guardar horario *ya esta XD
        const horario = datosRespuest.horario
        this.limites = datosRespuest.maximo
        this.seleccion = datosRespuest.seleccion
        console.log(horario.length, this.limites.length)
        for (let i = 0; i < horario.length; i++) {
          for (let j = 0; j < this.limites.length; j++) {
            console.log(i, j)
            if (horario[i].id === this.seleccion[j].id) {
              horario[i].limite = horario[i].limite - this.limites[j].limite
            }
          }
        }
        this.horarios = horario
      }).catch(console.log)
    },
    async traersitios () {
      const sit = await this.desencryp(this.id)
      const formdata = new FormData()
      formdata.append('Idsitio', sit)
      await fetch('http://localhost/mwreservation/prereserva.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        this.sitios = datosRespuest
        console.log(datosRespuest)
      }).catch(console.log)
    },
    async cancelar () {
      this.$router.go(-1)
    },
    probar () {
      const dato = moment(new Date()).format('YYYY-MM-DD')
      console.log(dato, this.fecha)
      if (this.fecha > dato) {
        this.$swal('ok', 'correcto', 'success')
      } else {
        this.$swal('ok', 'correcto', 'error')
      }
    },
    async realizarReservacion (comentario, fecha, elhorario, personas) {
      const usua = localStorage.getItem('valor')
      if (usua !== '0') {
        const sit = await this.desencryp(this.id)
        const palabra = await this.encryp(usua + this.id + this.nombre + Date())
        const formdata = new FormData()
        formdata.append('IdSitio', sit)
        formdata.append('IdUsua', usua)
        formdata.append('comentario', comentario)
        formdata.append('fecha', fecha)
        formdata.append('IdHorario', elhorario)
        formdata.append('personas', personas)
        formdata.append('qr', palabra)
        await fetch('http://localhost/mwreservation/hacerreservacion.php', {
          method: 'POST',
          body: formdata
        }).then(
          respuest => respuest.json()
        ).then((datosRespuest) => {
          console.log('dato', datosRespuest)
          try {
            if (datosRespuest) {
              this.$swal('Exito', 'Reservación realizada', 'success')
              this.hacerpdf(comentario, '2', fecha, '2:20', personas)
              this.$router.push({ name: 'CarritoMW' })
            } else {
              this.$swal('Error interno', 'Fallo al reservar sitio', 'error')
            }
          } catch (e) {
            this.$swal('Error al generar pdf', 'Recibo detenido', 'error')
            console.log('error')
          }
        }).catch(console.log)
      } else {
        this.$swal('Inicia sesión', 'operación anulada', 'info')
      }
    },
    hacerpdf (comentario, minutosR, fecha, hora, personas) {
      const doc = new JsPDF()
      const imgData = new Image()
      imgData.src = 'https://media.istockphoto.com/photos/-picture-id1311690310'
      doc.addImage(imgData, 'png', 120, 20, 70, 50, 'mono')
      doc.setFont('Verdana')
      doc.setFontSize(22)
      doc.text(20, 20, 'MWReservation ')
      doc.setFont('Arial')
      doc.setFontSize(14)
      doc.text(20, 30, 'Comentarios: ' + comentario)
      doc.text(20, 40, 'Tiempo reservado: ' + minutosR + ' minutos')
      doc.text(20, 50, 'Fecha reservada: ' + new Date(fecha).toLocaleDateString('es-ES', this.options))
      doc.text(20, 60, 'Hora reservada: ' + hora)
      doc.text(20, 70, 'Lugares reservados: ' + personas)
      doc.text(20, 80, 'Reservacion realizada por: ' + localStorage.getItem('nombre') +
      ' ' + localStorage.getItem('Apaterno') + ' ' + localStorage.getItem('Amaterno'))
      doc.addPage()
      doc.text(20, 20, 'Te gusto la aplicación?')
      window.open(URL.createObjectURL(doc.output('blob')))
      // doc.save('Test.pdf')
    },
    reservar () {
      const elhorario = document.getElementById('horarioseleccionado').value
      const usua = localStorage.getItem('valor')
      const dato = moment(new Date()).format('YYYY-MM-DD')
      console.log(this.fecha)
      if (usua !== '0') {
        if (this.personas > 0) {
          if (this.fecha >= dato) {
            if (elhorario !== '') {
              // this.$swal('ok', elhorario, 'success')
              this.realizarReservacion(this.comentario, this.fecha, elhorario, this.personas)
            } else {
              this.$swal('No hay horario seleccionado', 'Es necesario seleccionar un horario', 'info')
            }
          }
        } else {
          this.$swal('ingresa una ponderacion valida', 'personas a registrar minimo 1', 'info')
        }
      } else {
        this.$swal('Inicia sesión', 'operación anulada', 'info')
      }
    }
  }
}
</script>

<style scoped>
.delimitado{
    margin-top: 25px;
    margin-left: 15%;
    margin-right: 15%;
    align-content: center;
    align-items: center;
    background-color: rgb(233, 178, 150);
    padding: 25px;
}
.tablaimg{
    height: 270px;
    width: 330px;
    position: relative;
}
.fila2{
    margin-left:0%;
    text-align:left;
    width: 270px;
}
.letra{
    font-size: xx-small;
    font-family: sans-serif;
}
.fo{
  padding-bottom: 50px;
}
</style>
